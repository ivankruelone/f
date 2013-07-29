<?php
class Compara_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function genera($archivo)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "SELECT a.* FROM compara.original a  where nombre='$archivo'";
        $q = $this->db->query($s);
         foreach($q->result() as $r)
    {
///**
        $s1 = "SELECT a.* FROM catalogo.almacen a  where susa1 like '%$r->sustancia%' and tsec='G' and sec>0 and sec<=2000 and costo>0";
        $q1 = $this->db->query($s1);
       foreach($q1->result() as $r1)
        {
        $s2 = "insert into compara.detalle (nombre, id_cc, susa1, descri, prv, prvx, costo, archi, persona, clave, sec, tsec)values
        ('$archivo',$r->num,'$r1->susa1','$r1->susa2',$r1->prv,'$r1->prvx',$r1->costo,'GENERICO','$r1->persona','',$r1->sec,'$r1->tsec')
        on duplicate key update susa1=values(susa1)";
        $q2 = $this->db->query($s2);  
        }   
///**
        $s3 = "SELECT a.*,max(costo)as costo FROM catalogo.segpop a  where susa1 like '%$r->sustancia%' and tip<>'X' and costo>0 group by prv,claves,persona";
        $q3 = $this->db->query($s3);
       foreach($q3->result() as $r3)
        {
        $s4 = "insert into compara.detalle (nombre, id_cc, susa1, descri, prv, prvx, costo, archi, persona, clave, sec, tsec)values
        ('$archivo',$r->num,'$r3->susa1','$r3->susa2',$r3->prv,'$r3->prvx',$r3->costo,'GENERICO','$r3->persona','$r3->claves',0,'')
        on duplicate key update susa1=values(susa1)";
        $q4 = $this->db->query($s4);  
        }
///**
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tipo, fecha, orden, prv, id_user, id, fechai, fac, cxp
     function control($archivo)
     {
       $s = "SELECT a.* FROM compara.original a  where nombre='$archivo'";
       $q = $this->db->query($s);
       $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"10\">RECIBA DE CERRAR MEDICAMENTOS</th>
        </tr>
        <tr>
        <th>id</th>
        <th>SUSTANCIA</th>
        <th colspan=\"6\">NOMBRE COMPLETO</th>
        <th>COSTO</th>
        <th>DIF</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
       $s1="select *from compara.detalle where nombre='$archivo' and id_cc=$r->num and marca=1";
        $q1 = $this->db->query($s1);
           $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\blue\>".$r->num."</font></td>
            <td align=\"left\"><font color=\blue\>".$r->sustancia."</font></td>
            <td align=\"left\" colspan=\"6\"><font color=\blue\>".$r->completa."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->precio."</font></td>
            </tr>
            ";
//////////////
             if($q1->num_rows()>0){
                foreach($q1->result() as $r1)
                    {
                    if($r1->persona=='LE'){$persona='GENERICO LEO';}
                    elseif($r1->persona=='ES'){$persona='ESPECIALIDAD VERO';}
                    elseif($r1->persona=='PA'){$persona='PATENTE MIREY';}
                    elseif($r1->persona=='MA'){$persona='GENERICO ALE';}
                    elseif($r1->persona=='KI'){$persona='MAT.CUR MARICARMEN';}
                    else{$persona='';}
                    if($r1->marca>0){$color='green';}else{$color='black';} 
                    $dif=($r->precio)-($r1->costo);
                        $tabla.="
                    <tr>
                    <td align=\"left\"></td>
                    <td align='right'><font size='-1'><input name='marca_$r1->id' type='text' id='marca_$r1->id' size='1' maxlength='1' value='$r1->marca' /></font></td>
                    
                    <td align=\"left\"><font color=\"$color\">".$r1->tsec." ".$r1->sec."<br />".$r1->clave."</font></td>
                    <td align=\"left\"><font color=\"$color\">".$r1->marca." ".$r1->susa1."</font></td>
                    <td align=\"left\"><font color=\"$color\">".$r1->prv."</font></td>
                    <td align=\"left\"><font color=\"$color\">".$r1->prvx."</font></td>
                    <td align=\"left\"><font color=\"$color\">".$r1->costo."</font></td>
                    <td align=\"left\"><font color=\"$color\">".$persona."</font></td>
                    <td align=\"left\"><font color=\"$color\"></font></td>
                    <td align=\"left\"><font color=\"red\">".number_format($dif,2)."</font></td>
                    </tr>";
                    }
             }
        }
         $tabla.="</tbody>
		 </table>";
   
//////////////
$tabla.="        
<script language=\"javascript\" type=\"text/javascript\">
$('input:text[name^=\"marca_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_marca_dato(id, valor);

});

function actualiza_marca_dato(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/compara/actualiza_marca/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}

</script>
";

      return $tabla;
    
        
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tipo, fecha, orden, prv, id_user, id, fechai, fac, cxp
     function control_c()
     {
       $s = "SELECT a.* FROM compara.original a  group by nombre";
       $q = $this->db->query($s);
       $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"10\">RECIBA DE CERRAR MEDICAMENTOS</th>
        </tr>
        <tr>
        <th>id</th>
        <th>FECHA</th>
        <th>NOMBRE</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $num=1;
         foreach($q->result() as $r)
        {
            $l2 = anchor('direccion/tabla_compara_detalle/'.$r->nombre.'/'.$r->fecha, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
           $tabla.="
            <tr>
            <td align=\"left\"><font color=\blue\>".$num."</font></td>
            <td align=\"left\"><font color=\blue\>".$r->fecha."</font></td>
            <td align=\"left\"><font color=\blue\>".$r->nombre."</font></td>
            <td align=\"left\"><font color=\blue\>".$l2."</font></td>
            </tr>
            ";
$num=$num+1;
}             
         $tabla.="</tbody>
		 </table>";
   

      return $tabla;
    
        
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_detalle($archivo)
     {
       $s = "SELECT a.* FROM compara.original a  where nombre='$archivo'";
       $q = $this->db->query($s);
       $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"10\">COMPARATIVO DE ARCHIVO CON CATALOGOS SEGPOP y CEDIS</th>
        </tr>
        <tr>
        <th>id</th>
        <th>SUSTANCIA</th>
        <th colspan=\"6\">NOMBRE COMPLETO</th>
        <th>COSTO</th>
        <th>DIF</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
       $s1="select *from compara.detalle where nombre='$archivo' and id_cc=$r->num and marca=1";
        $q1 = $this->db->query($s1);
           $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\blue\>".$r->num."</font></td>
            <td align=\"left\"><font color=\blue\>".$r->sustancia."</font></td>
            <td align=\"left\" colspan=\"6\"><font color=\blue\>".$r->completa."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->precio."</font></td>
            </tr>
            ";
//////////////
             $color='black';   
             if($q1->num_rows()>0){
                foreach($q1->result() as $r1)
                    {
                    if($r1->persona=='LE'){$persona='GENERICO LEO';}
                    elseif($r1->persona=='ES'){$persona='ESPECIALIDAD VERO';}
                    elseif($r1->persona=='PA'){$persona='PATENTE MIREY';}
                    elseif($r1->persona=='MA'){$persona='GENERICO ALE';}
                    elseif($r1->persona=='KI'){$persona='MAT.CUR MARICARMEN';}
                    else{$persona='';}
                   
                    $dif=($r->precio)-($r1->costo);
                        $tabla.="
                    <tr>
                    <td align=\"left\"></td>
                    <td align=\"left\"></td>
                    <td align=\"left\"><font color=\"red\">".$r1->tsec." ".$r1->sec."<br />".$r1->clave."</font></td>
                    <td align=\"left\" colspan=\"2\"><font color=\"red\">".$r1->susa1."</font></td>
                    <td align=\"left\"><font color=\"red\">".$r1->prv."</font></td>
                    <td align=\"left\"><font color=\"red\">".$r1->prvx."</font></td>
                    <td align=\"left\"><font color=\"red\">".$persona."</font></td>
                    <td align=\"left\"><font color=\"red\">".$r1->costo."</font></td>
                    <td align=\"left\"><font color=\"red\">".number_format($dif,2)."</font></td>
                    </tr>";
                    }
             }
        }
         $tabla.="</tbody>
		 </table>";
      echo $tabla;
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_segpop()
     {
       $s = "SELECT a.*,
       case
       when persona='LE'
       then 'GENERICOS LEO'
       when persona='MA'
       then 'GENERICOS ALE'
       when persona='ES'
       then 'ESPECIALIDAD VERO'
       when persona='PA'
       then 'PATENTE MIREY'
        when persona='KI'
       then 'MAT.CUR. MARY'
       end as nn
       FROM catalogo.segpop a where tip<>'X' and costo>0 group by persona,claves,prv
       order by persona";
       $q = $this->db->query($s);
       $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"10\">CATALOGO DE SEGPOP</th>
        </tr>
        <tr>
        <th>#</th>
        <th>CLAVES<br />CODIGO</th>
        <th>SUSTANCIA ACTIVA<BR />DESCRIPCION</th>
        <th>PROVEEDOR</th>
        <th>COSTO</th>
        <th>PERSONA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $num=1;
         foreach($q->result() as $r){
                    
           $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\blue\>".$num."</font></td>
            <td align=\"left\"><font color=\blue\>".$r->claves."<br />".$r->codigo."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->susa1."<br />".$r->susa2."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->prv."<br />".$r->prvx."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\blue\>".number_format($r->costo,2)."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->nn."</font></td>
            </tr>
            ";
            $num=$num+1;
        }
         $tabla.="
         </tbody>
		 </table>";

      return $tabla;
    
        
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cedis()
     {
       $s = "SELECT a.*,b.tipo as clasi
       FROM catalogo.almacen a 
       left join catalogo.cat_almacen_clasifica b on b.sec=a.sec
       where tsec='G' and a.sec>0 and a.sec<=2000 group by a.sec
       order by clasi";
       $q = $this->db->query($s);
       $tabla= "
        <table cellpadding=\"3\" border=\"1\" id=\"example\" width=\"100%\">
        <thead>
        
        <tr>
        <th colspan=\"10\">CATALOGO CEDIS</th>
        </tr>
        <tr>
        <th>#</th>
        <th>CLAS</th>
        <th>SEC<br />CODIGO</th>
        <th>SUSTANCIA ACTIVA<BR />DESCRIPCION</th>
        <th>PROVEEDOR</th>
        <th>COSTO</th>
        <th>P. GEN.</th>
        <th>P. DRD.</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $num=1;
         foreach($q->result() as $r){
                    
           $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\blue\>".$num."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->clasi."</font></td>
            <td align=\"left\"><font color=\blue\>".$r->sec."<br />".$r->codigo."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->susa1."<br />".$r->susa2."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\blue\>".$r->prv."<br />".$r->prvx."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\blue\>".number_format($r->costo,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\blue\>".number_format($r->vtagen,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\blue\>".number_format($r->vtaddr,2)."</font></td>
            
            </tr>
            ";
            $num=$num+1;
        }
         $tabla.="
         </tbody>
		 </table>
         <script>
         $('#example').dataTable();
         </script>
         
         ";

      return $tabla;
    
        
     }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////














}