<?php
class sistemas_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
function tabla_reporte($tit)
{
   $nivel= $this->session->userdata('nivel');
    $sql="select a.*,b.nombre as sucx,c.completo 
    from compras.reporte_c a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_empleado c on c.nomina=a.solicita and c.tipo=1
    where a.tipo='A'";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>$tit</strong></th>
        </tr>
        <tr>
        <th><strong>Departamento</strong></th>
        <th><strong>Solicita</strong></th>
        <th><strong>Peticion</strong></th>
       </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {

 $l1 = anchor('sistemas/tabla_reporte_detalle/'.$row->id, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));; 
 $l2 = anchor('sistemas/reporte_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));;
 $l3 = anchor('sistemas/reporte_val/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));;
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->sucx."<br />".$l2."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"left\"> ".$row->problema."<br />".$l3."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            <tr bgcolor=\"#F4ECEC\">
            <td  colspan=\"4\" align=\"left\">".$row->solucion."</td>
            </tr>
            <tr bgcolor=\"#F4ECEC\">
            <td  colspan=\"4\" align=\"left\">".$row->antes."</td>
            </tr>
            
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"4\" align=\"left\">".$row->ahora."</td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE REPORTES:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_reporte($id,$tit)
{
   $nivel= $this->session->userdata('nivel');
    $sql="select a.*,b.nombre as sucx,c.completo ,c.puestox
    from compras.reporte_c a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_empleado c on c.nomina=a.solicita and c.tipo=1
    where a.tipo='A' and a.id=$id";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"2\" align=\"center\"><strong>$tit</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr>
            <td align=\"left\">Departamento</td>
            <td align=\"left\">".$row->sucx."</td>
            </tr>
            <tr>
            <td align=\"left\">Solicitante</td>
            <td align=\"left\">".$row->completo."<br />".$row->puestox."</td>
            </tr>
            <tr>
            <td align=\"left\">Peticion</td>
            <td align=\"left\">".$row->problema."</td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="

</table>";
        
        
        return $tabla;

}

function tabla_reporte_his($tit)
{
   $nivel= $this->session->userdata('nivel');
    $sql="select a.*,b.nombre as sucx,c.completo 
    from compras.reporte_c a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_empleado c on c.nomina=a.solicita and c.tipo=1
    where a.tipo='C' order by id desc";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>$tit</strong></th>
        </tr>
        <tr>
        <th><strong>Departamento</strong></th>
        <th><strong>Solicita</strong></th>
        <th><strong>Peticion</strong></th>
       </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {

 $l1 = anchor('sistemas/reportes_his_imp_uno/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));; 
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"left\"> ".$row->problema."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            <tr bgcolor=\"#F4ECEC\">
            <td  colspan=\"4\" align=\"left\">".$row->solucion."</td>
            </tr>
            <tr bgcolor=\"#F4ECEC\">
            <td  colspan=\"4\" align=\"left\">".$row->antes."</td>
            </tr>
            
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"4\" align=\"left\">".$row->ahora."</td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE REPORTES:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_impresion($tit)
{
   $nivel= $this->session->userdata('nivel');
    $sql="select a.*,b.nombre as sucx,c.completo ,c.puestox,d.completo as sis ,d.puestox as sisp
    from compras.reporte_c a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_empleado c on c.nomina=a.solicita and c.tipo=1
    left join catalogo.cat_empleado d on d.nomina=a.atiende 
    where a.tipo='C'";
	  	$query = $this->db->query($sql);
  $l0="<img src=\"img/logo.png\" border=\"0\" width=\"50px\" />"; 
$tabla="
        <table border=\"0\">
        
        <thead>
        <tr>
        <th colspan=\"2\" align=\"center\"><strong>$tit</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr>
            <td align=\"left\" width=\"656\"><strong>$l0</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"100\"><strong>Departamento</strong></td>
            <td align=\"left\" width=\"556\">".$row->sucx."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"100\"><strong>Solicitante</strong></td>
            <td align=\"left\" width=\"556\">".$row->completo."<br />".$row->puestox."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><strong>Peticion</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\">".$row->problema."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><strong>Solucion</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\">".$row->solucion."<br /></td>
            </tr>
            
            <tr>
            <td align=\"center\" width=\"328\"><strong>Antes</strong></td>
            <td align=\"center\" width=\"328\"><strong>Ahora</strong><br /></td>
            </tr>
            <table border=\"1\">
            <tr>
            <td align=\"left\" width=\"328\">".$row->antes."</td>
            <td align=\"left\" width=\"328\">".$row->ahora."<br /></td>
            </tr>
            </table>
            <tr>
            <td align=\"left\" width=\"536\"></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><br />".$row->sis."<br />".$row->sisp."</td>
            </tr>
            <tr>
            <td align=\"left\" width=\"200\"><strong>La solicitud esta elaborada.:</strong></td>
            <td align=\"left\" width=\"456\">".$row->fecha."</td>
            </tr>
            <tr>
            <td align=\"left\" width=\"200\"><strong>Se liber&oacute;.:</strong></td>
            <td align=\"left\" width=\"456\">".$row->libero."<br /><br /><br /><br /><br /><br /><br /></td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="

</table>";
        
        
        return $tabla;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_impresion_una($id)
{
   $nivel= $this->session->userdata('nivel');
    $sql="select a.*,b.nombre as sucx,c.completo ,c.puestox,d.completo as sis ,d.puestox as sisp
    from compras.reporte_c a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_empleado c on c.nomina=a.solicita and c.tipo=1
    left join catalogo.cat_empleado d on d.nomina=a.atiende 
    where a.tipo='C' and a.id=$id";
	  	$query = $this->db->query($sql);
  $l0="<img src=\"img/logo.png\" border=\"0\" width=\"50px\" />"; 
$tabla="
        <table border=\"0\">
        
        <thead>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr>
            <td align=\"left\" width=\"656\"><strong>$l0</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"100\"><strong>Departamento</strong></td>
            <td align=\"left\" width=\"556\">".$row->sucx."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"100\"><strong>Solicitante</strong></td>
            <td align=\"left\" width=\"556\">".$row->completo."<br />".$row->puestox."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><strong>Peticion</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\">".$row->problema."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><strong>Solucion</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\">".$row->solucion."<br /></td>
            </tr>
            
            <tr>
            <td align=\"center\" width=\"328\"><strong>Antes</strong></td>
            <td align=\"center\" width=\"328\"><strong>Ahora</strong><br /></td>
            </tr>
            <table border=\"1\">
            <tr>
            <td align=\"left\" width=\"328\">".$row->antes."</td>
            <td align=\"left\" width=\"328\">".$row->ahora."<br /></td>
            </tr>
            </table>
            <tr>
            <td align=\"left\" width=\"536\"></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><br />".$row->sis."<br />".$row->sisp."</td>
            </tr>
            <tr>
            <td align=\"left\" width=\"200\"><strong>La solicitud esta elaborada.:</strong></td>
            <td align=\"left\" width=\"456\">".$row->fecha."</td>
            </tr>
            <tr>
            <td align=\"left\" width=\"200\"><strong>Se liber&oacute;.:</strong></td>
            <td align=\"left\" width=\"456\">".$row->libero."<br /><br /><br /><br /><br /><br /><br /></td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="

</table>";
        
  // echo $tabla;
   //die();     
        return $tabla;

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function busca_nominaa($suc)
    {
    $sql = "SELECT nomina, completo FROM CATALOGO.cat_empleado where succ=$suc and tipo=1 order by completo";
        $query = $this->db->query($sql);
        $tabla = "<option value=\"-\">Seleccione Personal</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->nomina."\">".$row->completo." - ".$row->nomina."</option>
            ";
        }
        
        return $tabla; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function busca_sis()
    {
    $sql = "SELECT nomina, completo FROM CATALOGO.cat_empleado where succ=90006 or succ=90028";
        $query = $this->db->query($sql);
        $per = array();
        $per[0] = "Seleccione Personal";
        
        foreach($query->result() as $row){
            $per[$row->nomina] = $row->completo;
        }
        
         
        return $per; 
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function agrega_member_reporte($suc,$nomina,$problema)
{
    $new_member_insert_data = array(
            'suc'   =>$suc,
            'solicita'=>$nomina,
            'solucion'=>' ',
            'antes'=>' ',
            'ahora'=>' ',
            'problema'=>$problema,
            'fecha'=>date('Y-m-d')
            
		);
		$insert = $this->db->insert('compras.reporte_c', $new_member_insert_data);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function borrar_member_reporte($id)
{
        $datac = array('tipo'=>'X');
		$this->db->where('id', $id);
        $this->db->update('compras.reporte_c', $datac);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function val_member_reporte($id)
{
        $datac = array('tipo'=>'C','libero'=>date('Y-m-d'));
		$this->db->where('id', $id);
        $this->db->update('compras.reporte_c', $datac);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_reporte($id,$solucion,$antes,$ahora,$per)
{
        $datac = array('solucion'=>$solucion,'antes'=>$antes,'ahora'=>$ahora,'libero'=>date('Y-m-d'),'atiende'=>$per);
		$this->db->where('id', $id);
        $this->db->update('compras.reporte_c', $datac);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function campos_reporte($id)
{
        $s="select *from compras.reporte_c where id=$id";
        $q=$this->db->query($s);
        return $q;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_imprime_deptos($fec1,$fec2,$tit)
{
   $nivel= $this->session->userdata('nivel');
    $sql="select a.*,b.nombre as sucx,c.completo ,c.puestox,d.completo as sis ,d.puestox as sisp
    from compras.reporte_c a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_empleado c on c.nomina=a.solicita and c.tipo=1
    left join catalogo.cat_empleado d on d.nomina=a.atiende 
    where a.tipo='C'";
	  	$query = $this->db->query($sql);
  $l0="<img src=\"img/logo.png\" border=\"0\" width=\"50px\" />"; 
$tabla="
        <table border=\"0\">
        
        <thead>
        <tr>
        <th colspan=\"2\" align=\"center\"><strong>$tit</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr>
            <td align=\"left\" width=\"656\"><strong>$l0</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"100\"><strong>Departamento</strong></td>
            <td align=\"left\" width=\"556\">".$row->sucx."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"100\"><strong>Solicitante</strong></td>
            <td align=\"left\" width=\"556\">".$row->completo."<br />".$row->puestox."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><strong>Peticion</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\">".$row->problema."<br /></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><strong>Solucion</strong></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\">".$row->solucion."<br /></td>
            </tr>
            
            <tr>
            <td align=\"center\" width=\"328\"><strong>Antes</strong></td>
            <td align=\"center\" width=\"328\"><strong>Ahora</strong><br /></td>
            </tr>
            <table border=\"1\">
            <tr>
            <td align=\"left\" width=\"328\">".$row->antes."</td>
            <td align=\"left\" width=\"328\">".$row->ahora."<br /></td>
            </tr>
            </table>
            <tr>
            <td align=\"left\" width=\"536\"></td>
            </tr>
            <tr>
            <td align=\"left\" width=\"656\"><br />".$row->sis."<br />".$row->sisp."</td>
            </tr>
            <tr>
            <td align=\"left\" width=\"200\"><strong>La solicitud esta elaborada.:</strong></td>
            <td align=\"left\" width=\"456\">".$row->fecha."</td>
            </tr>
            <tr>
            <td align=\"left\" width=\"200\"><strong>Se liber&oacute;.:</strong></td>
            <td align=\"left\" width=\"456\">".$row->libero."<br /><br /><br /><br /><br /><br /><br /></td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="

</table>";
        
        
        return $tabla;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





















function personal_oficinas($fec1,$fec2)
{
$s="SELECT count(*)as num FROM CATALOGO.CAT_EMPLEADO WHERE ID_CHECADOR>0 AND CHECA=1 AND TIPO=1";
$q=$this->db->query($s);
$r=$q->row();
$num=$r->num;
$s1="select count(*)as retardos_aplicados 
from faltante 
where clave=613 and id_user=939  and tipo>0 and tipo<=2 and fecha>='$fec1'  and fecha<='$fec2' and 
observacion='FALTA - RETARDOS ACUMULADOS'";
$q1=$this->db->query($s1);
$r1=$q1->row();
$retardos_aplicados=$r1->retardos_aplicados;

$retardos=$this->__personal_retardos($fec1,$fec2);

$op1=round(($retardos/$num)*100,2);
$op2=round(($retardos_aplicados/$num)*100,2);

$tex="<table  border=\"0\">
        <tr>
        <td colspan=\"5\" align=\"center\"><strong>Reporte de justificaciones en retardos</strong></td>
        </tr>
        <tr>
        <td  align=\"center\"  width=\"70\">Total de empleados</td>
        <td  align=\"center\"  width=\"70\">Emp.3 Retardos o mas</td>
        <td  align=\"center\"  width=\"70\"></td>
        <td  align=\"center\"  width=\"70\">Sanciones <br />Aplicadas</td>
        <td  align=\"center\"  width=\"70\"></td>
        </tr>
        <tr>
        <td align=\"center\"  width=\"70\">".$num."</td>
        <td align=\"center\"  width=\"70\">".$retardos."</td>
        <td align=\"center\"  width=\"70\">% ".number_format($op1,2)."</td>
        <td align=\"center\"  width=\"70\">".$retardos_aplicados."</td>
        <td align=\"center\"  width=\"70\">% ".number_format($op2,2)."</td>
        </tr>
        </table>
        ";
$tex.=$this->__personal_retardos1($fec1,$fec2,$num,$retardos,$op1,$retardos_aplicados,$op2);
return $tex;    
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __personal_retardos($fec1,$fec2)
{
$s="SELECT  b.fechahis,b.checa,c.dias, b.succ,d.nombre as sucx, b.nomina,b.completo,b.puestox,empleado_id,a.fecha,sum(retardo)as retardo,sum(falta)as faltas

FROM checador_asistencia a
left join catalogo.cat_empleado b on b.id=a.empleado_id
left join reg_vacaciones c on c.nomina=b.nomina and a.fecha between c.fec1 and c.fec2
left join catalogo.sucursal d on d.suc=b.succ
where
a.fecha>='$fec1' and a.fecha<='$fec2' and retardo>0  and falta=0 and dias is  null and b.checa=1 and a.fecha>=fechahis
group by empleado_id order by b.succ";
$q=$this->db->query($s);
$rr=0;
 foreach($q->result() as $r)
        {if($r->retardo>=3){$rr=$rr+1;}}
$retardos=$rr;
return $rr;    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __personal_retardos1($fec1,$fec2,$num,$retardos,$op1,$retardos_aplicados,$op2)
{
$s="SELECT  b.fechahis,b.checa,c.dias, b.succ,d.nombre as sucx, b.nomina,b.completo,b.puestox,empleado_id,a.fecha,sum(retardo)as retardo,sum(falta)as faltas

FROM checador_asistencia a
left join catalogo.cat_empleado b on b.id=a.empleado_id
left join reg_vacaciones c on c.nomina=b.nomina and a.fecha between c.fec1 and c.fec2
left join catalogo.sucursal d on d.suc=b.succ
where
a.fecha>='$fec1' and a.fecha<='$fec2' and retardo>0  and falta=0 and dias is  null and b.checa=1 and a.fecha>=fechahis
group by empleado_id order by succ";
$q=$this->db->query($s);
$rr=0;
$tabla="<table cellpadding=\"3\">
        
        
        <thead>
        
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>Detalle de Retardos</strong></th>
        </tr>
        
        <tr>
        <th>Departamento</th>
        <th>Puesto</th>
        <th width=\"250\">Nombre</th>
        <th>Justificacion</th>
        <th>Retardo</th>
        </tr>
        </thead>
 
        <tbody>
        
        
        
        ";

 foreach($q->result() as $r)
        {
            if($r->retardo>=3){
 $s2="select date_format(entrada,'%H:%i')as ent,date_format(salida,'%H:%i')as sal, a.*from checador_asistencia a 
 where motivo<>' 'and retardo>0 and fecha between '$fec1' and '$fec2' and empleado_id=$r->empleado_id";
 

$q2=$this->db->query($s2);
$tabla.="
            <tr>
            
            <td align=\"left\">".$r->sucx."</td>
            <td align=\"left\">".$r->puestox."</td>
            <td align=\"left\" width=\"250\">".$r->nomina." <strong>".$r->completo."</strong></td>
            <td align=\"right\">".$r->retardo."</td>
            </tr>
            ";
                $rr=$rr+1;
 foreach($q2->result() as $r2)
        {
 $tabla.="
            <tr>
            <td align=\"right\"></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$r2->fecha." ___ ".$r2->ent." - ".$r2->sal."</td>
            <td align=\"left\" width=\"250\">".trim($r2->motivo)."</td>
            
            </tr>
            ";       
            
        }
        $tabla.="
            <tr>
             <td align=\"left\" colspan=\"5\">----</td>
            
            </tr>
            ";      
        
        }
        }
$tabla.="
</tbody>
</table>";
$retardos=$rr;
return $tabla;    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function personal_oficinas_faltas($fec1,$fec2)
{
$s="SELECT count(*)as num FROM CATALOGO.CAT_EMPLEADO WHERE ID_CHECADOR>0 AND CHECA=1 AND TIPO=1";
$q=$this->db->query($s);
$r=$q->row();
$num=$r->num;
$s1="select count(*)as faltas_aplicadas 
from faltante 
where clave=613 and id_user=939  and tipo>0 and tipo<=2 and fecha>='$fec1'  and fecha<='$fec2' and 
observacion='FALTA'";
$q1=$this->db->query($s1);
$r1=$q1->row();
$faltas_aplicadas=$r1->faltas_aplicadas;

$faltas=$this->__personal_faltas($fec1,$fec2);

$op1=round(($faltas/$num)*100,2);
$op2=round(($faltas_aplicadas/$num)*100,2);

$tex="<table  border=\"0\">
        <tr>
        <td colspan=\"5\" align=\"center\"><strong>Reporte de Faltas</strong></td>
        </tr>
        <tr>
        <td  align=\"center\"  width=\"70\">Total de empleados</td>
        <td  align=\"center\"  width=\"70\">Faltas</td>
        <td  align=\"center\"  width=\"70\"></td>
        <td  align=\"center\"  width=\"70\">Faltas <br />Aplicadas</td>
        <td  align=\"center\"  width=\"70\"></td>
        </tr>
        <tr>
        <td align=\"center\"  width=\"70\">".$num."</td>
        <td align=\"center\"  width=\"70\">".$faltas."</td>
        <td align=\"center\"  width=\"70\">% ".number_format($op1,2)."</td>
        <td align=\"center\"  width=\"70\">".$faltas_aplicadas."</td>
        <td align=\"center\"  width=\"70\">% ".number_format($op2,2)."</td>
        </tr>
        </table>
        ";
$tex.=$this->__personal_faltas1($fec1,$fec2,$num,$faltas,$op1,$faltas_aplicadas,$op2);
return $tex;    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __personal_faltas($fec1,$fec2)
{
$s="SELECT  b.fechahis,b.checa,c.dias, b.succ,d.nombre as sucx, b.nomina,b.completo,b.puestox,empleado_id,
a.fecha,sum(retardo)as retardo,sum(falta)as faltas

FROM checador_asistencia a
left join catalogo.cat_empleado b on b.id=a.empleado_id
left join reg_vacaciones c on c.nomina=b.nomina and a.fecha between c.fec1 and c.fec2
left join catalogo.sucursal d on d.suc=b.succ
where
a.fecha>='$fec1' and a.fecha<='$fec2' and falta>0  and retardo=0 and dias is  null and b.checa=1 and 
a.fecha>=fechahis and a.motivo not like 'VACACIONES%' and motivo not like 'INCAPACIDAD LABORAL%'
and a.motivo not like'RUTA%'
group by empleado_id";
$q=$this->db->query($s);
$rr=0;
 foreach($q->result() as $r){
        $rr=$rr+1;
        }
$faltas=$rr;
return $rr;    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __personal_faltas1($fec1,$fec2,$num,$faltas,$op1,$faltas_aplicadas,$op2)
{
$s="SELECT  b.fechahis,b.checa,c.dias, b.succ,d.nombre as sucx, b.nomina,b.completo,b.puestox,empleado_id,
a.fecha,sum(retardo)as retardo,sum(falta)as falta

FROM checador_asistencia a
left join catalogo.cat_empleado b on b.id=a.empleado_id
left join reg_vacaciones c on c.nomina=b.nomina and a.fecha between c.fec1 and c.fec2
left join catalogo.sucursal d on d.suc=b.succ
where
a.fecha>='$fec1' and a.fecha<='$fec2' and falta>0  and dias is  null and b.checa=1 and a.fecha>=fechahis
and a.motivo not like 'VACACIONES%' and motivo not like 'INCAPACIDAD LABORAL%'
and a.motivo not like'RUTA%'
group by empleado_id order by succ";

$q=$this->db->query($s);

$rr=0;
$tabla="<table cellpadding=\"3\">
        
        
        <thead>
        
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>Detalle de Faltas</strong></th>
        </tr>
        
        <tr>
        <th>Departamento</th>
        <th>Puesto</th>
        <th width=\"250\">Nombre</th>
        <th>Justificacion</th>
        <th>falta</th>
        </tr>
        </thead>
 
        <tbody>
        
        
        
        ";

 foreach($q->result() as $r)
        {
          
 $s2="select date_format(entrada,'%H:%i')as ent,date_format(salida,'%H:%i')as sal, a.*from checador_asistencia a 
 where motivo<>' ' and motivo<>'VACACIONES' and falta>0 and a.fecha>='$fec1' and a.fecha<='$fec2' 
  and empleado_id=$r->empleado_id and fecha>=$r->fechahis"; 
 

$q2=$this->db->query($s2);
$tabla.="
            <tr>
            
            <td align=\"left\">".$r->sucx."</td>
            <td align=\"left\">".$r->puestox."</td>
            <td align=\"left\" width=\"250\">".$r->nomina." <strong>".$r->completo."</strong></td>
            <td align=\"right\">".$r->falta."</td>
            </tr>
            ";
                $rr=$rr+1;
 foreach($q2->result() as $r2)
        {
 $tabla.="
            <tr>
            <td align=\"right\"></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$r2->fecha." ___ ".$r2->ent." - ".$r2->sal."</td>
            <td align=\"left\" width=\"250\">".trim($r2->motivo)."</td>
            
            </tr>
            ";       
            
      
        }
        $tabla.="
            <tr>
             <td align=\"left\" colspan=\"5\">----</td>
            
            </tr>
            ";        
        }
$tabla.="
</tbody>
</table>";
$retardos=$rr;
return $tabla;    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function rh_retencion()
{
$s="select a.causaj,a.fecha_i,a.suc,b.nombre as sucx,empleado,concat(a.nom,' ',a.pat,' ',a.mat)as completo,a.causa,c.clave as causax
from catalogo.cat_alta_empleado a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_claves_rh c on c.id=a.id_causa
where a.motivo='RETENCION' AND a.id_causa<>7 and a.activo=1
order by a.fecha_i ";

$q=$this->db->query($s);

$tabla="<table>
       <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>RETENCION DE SALARIOS</strong></th>
        </tr>
        <tr>
        <th width=\"70\"><strong>FECHA</strong></th>
        <th width=\"150\"><strong>SUCURSAL</strong></th>
        <th width=\"260\"><strong>EMPLEADO</strong></th>
        <th width=\"180\"><strong>CAUSA</strong></th>
        <th width=\"120\"><strong>ESTATUS</strong></th>
        <th width=\"100\"><strong>JURIDICO</strong></th>
        </tr>
        <tr><td colspan=\"6\"></td></tr>
        </thead>
        <tbody>
        ";
$num=0;
 foreach($q->result() as $r)
        {
   $num=$num+1;
$tabla.="
            <tr>
            
            <td align=\"left\" width=\"70\">".$r->fecha_i."</td>
            <td align=\"left\" width=\"150\">".$r->sucx."</td>
            <td align=\"left\" width=\"260\">".$r->empleado." ".$r->completo."</td>
            <td align=\"left\" width=\"180\">".$r->causa."</td>
            <td align=\"left\" width=\"120\">".$r->causax."</td>
            <td align=\"left\" width=\"100\">".$r->causaj."</td>
            </tr>
            ";
               

            
        }
$tabla.="
</tbody>
<tfoot>
<tr>
<td  colspan=\"6\">Total de retenciones $num</td>
</tr>
</tfoot>
</table>";

return $tabla;    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function rh_medicos()
{
$s="SELECT tipo2,suc,nombre,pobla,
(select count(*) from catalogo.cat_empleado where succ=a.suc and tipo=1 and trim(puestox)='MEDICO') as medico
 FROM catalogo.sucursal a where suc>100 and suc<=2000 and tlid=1
and suc<>170 and suc<>171 and suc<>172 and suc<>173 and suc<>174 and suc<>175 and suc<>176 and suc<>177 and suc<>178
and suc<>179 and suc<>180 and suc<>181 and suc<>182 and suc<>187 and tipo2<>'F' order by medico, a.suc";

$q=$this->db->query($s);

$tabla="<table>
       <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>MEDICOS EN SUCURSALES</strong></th>
        </tr>
        <tr>
        <th width=\"30\"><strong>TIPO</strong></th>
        <th width=\"30\"><strong>NID</strong></th>
        <th width=\"200\"><strong>SUCURSAL</strong></th>
        <th width=\"200\"><strong>ESTADO</strong></th>
        <th width=\"60\"><strong>MEDICOS</strong></th>
        
        </tr>
        <tr><td colspan=\"5\"></td></tr>
        </thead>
        <tbody>
        ";
$num=0;$med0=0;$med1=0;$med2=0;$med3=0;
 foreach($q->result() as $r)
        {
   $num=$num+1;
   if($r->medico==0){$med0=$med0+1;}elseif($r->medico==1){$med1=$med1+1;}elseif($r->medico==2){$med2=$med2+1;}
   elseif($r->medico==3){$med3=$med3+1;}
$tabla.="
            <tr>
            
            <td align=\"left\" width=\"30\">".$r->tipo2."</td>
            <td align=\"left\" width=\"30\">".$r->suc."</td>
            <td align=\"left\" width=\"200\">".$r->nombre."</td>
            <td align=\"left\" width=\"200\">".$r->pobla."</td>
            <td align=\"left\" width=\"60\">".$r->medico."</td>
            </tr>
            ";
               
$totmed=$totmed+$r->medico;
            
        }
$tabla.="
</tbody>
<tfoot>
<tr>
<td  colspan=\"5\"><strong></strong></td>
</tr>
<tr>
<td  colspan=\"5\"><strong>
Total de sucursales $num<br />
$med0 no tienen medicos<br />
$med1 tienen 1 medico<br />
$med2 tienen 2 medicos<br />
$med3 tienen 3 medicos<br />
Total de medicos $totmed;</strong>
</td>
</tr>
</tfoot>
</table>";

return $tabla;    
}












//SELECT  b.fechahis,b.checa,c.dias, b.succ,d.nombre as sucx, b.nomina,b.completo,b.puestox,empleado_id,a.fecha,sum(retardo),sum(falta)as faltas

//FROM checador_asistencia a
//left join catalogo.cat_empleado b on b.id=a.empleado_id
//left join reg_vacaciones c on c.nomina=b.nomina and a.fecha between c.fec1 and c.fec2
//left join catalogo.sucursal d on d.suc=b.succ
//where
//a.fecha>='2013-08-01' and a.fecha<='2013-08-15' and retardo>0 and dias is  null and b.checa=1 and a.fecha>=fechahis
//or
//a.fecha>='2013-08-01' and a.fecha<='2013-08-15' and falta>0 and dias is  null and b.checa=1 and a.fecha>=fechahis
//group by empleado_id
//order by  SUCC desc
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}