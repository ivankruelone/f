<?php
class Encargado_model extends CI_Model
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
//**************************************************************
//**************************************************************
   function control_ventas_producto_nat($aaa,$suc)
    {
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
        $s="select * from vtadc.fe_prox_det where suc=$suc and aaa=$aaa and lab='NATURISTAS'";     
 		$q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        </tr>
        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		     
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"12\">".$r->codigo." - ".$r->descri."</td>
            </tr>
            <tr>
            <td align=\"right\">".number_format($r->venta_act_1,0)."<br /><font color=\"blue\">".number_format($r->importe_act_1,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_2,0)."<br /><font color=\"blue\">".number_format($r->importe_act_2,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_3,0)."<br /><font color=\"blue\">".number_format($r->importe_act_3,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_4,0)."<br /><font color=\"blue\">".number_format($r->importe_act_4,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_5,0)."<br /><font color=\"blue\">".number_format($r->importe_act_5,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_6,0)."<br /><font color=\"blue\">".number_format($r->importe_act_6,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_7,0)."<br /><font color=\"blue\">".number_format($r->importe_act_7,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_8,0)."<br /><font color=\"blue\">".number_format($r->importe_act_8,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_9,0)."<br /><font color=\"blue\">".number_format($r->importe_act_9,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_10,0)."<br /><font color=\"blue\">".number_format($r->importe_act_10,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_11,0)."<br /><font color=\"blue\">".number_format($r->importe_act_11,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_12,0)."<br /><font color=\"blue\">".number_format($r->importe_act_12,2)."</font></td>
          
            </tr>
            ";
     
$tim01=$tim01+$r->importe_act_1;
$tim02=$tim02+$r->importe_act_2;
$tim03=$tim03+$r->importe_act_3;
$tim04=$tim04+$r->importe_act_4;
$tim05=$tim05+$r->importe_act_5;
$tim06=$tim06+$r->importe_act_6;
$tim07=$tim07+$r->importe_act_7;
$tim08=$tim08+$r->importe_act_8;
$tim09=$tim09+$r->importe_act_9;
$tim10=$tim10+$r->importe_act_10;
$tim11=$tim11+$r->importe_act_11;
$tim12=$tim12+$r->importe_act_12;
        }
         $tabla.="
         <tr>
          <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim01,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim02,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim03,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim04,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim05,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim06,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim07,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim08,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim09,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim10,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim11,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim12,2)."</strong></font></td>
        </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }


//**************************************************************
//**************************************************************
//**************************************************************
function captura_de_mov($clave)
    {
    $id_user= $this->session->userdata('id');
    $nivel= $this->session->userdata('nivel');
    $suc= $this->session->userdata('suc');
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_user=$id_user and a.tipo=1
      or
       a.suc1=$suc and a.tipo=1
      ";
      
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>MOVIMIENTOS DE EMPLEADOS".$this->session->userdata('nombre')."</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
       
            $l3 = anchor('encargado/tabla_empleados_borrar/'.$row->id.'/'.$row->motivo.'/'.$row->fecha_mov.'/'.$clave, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('encargado/tabla_empleados_validar/'.$row->id.'/'.$row->motivo.'/'.$row->fecha_mov.'/'.$clave, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
        
            
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa." ".$row->obser2." ".$row->dias."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox." ".$row->folio_inca."</font></td>
            <td>$l3</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td>$l4</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

//**************************************************************
function captura_de_mov_his($motivo,$fecha_i,$titulo)
    {
    $id_user= $this->session->userdata('id');
    $suc= $this->session->userdata('username');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where a.suc2=$suc and a.tipo=2  and motivo=$motivo and fecha_mov='$fecha_i'";
     
      	$query = $this->db->query($sql);
        $l1 = anchor('encargado/imprimir_concentrado/'.$motivo.'/'.$fecha_i, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>".$titulo.'__________'.$l1."__________</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
            
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_mov."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.: <br />".$row->rhx." <br />".$row->rhpuestox."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_c."</font></td>
            <td>FECHA QUE APLICA.: <font color=\"green\">".substr($row->fecha_rh,0,10)."</font></td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"4\"><font color=\"red\">".$row->obser2."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

//**************************************************************
function imprimir_concentrado_modelo($motivo,$fecha_i,$titulo)
    {
    $id_user= $this->session->userdata('id');
    $suc= $this->session->userdata('username');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where a.suc2=$suc and a.tipo>1 and a.tipo<=3 and motivo=$motivo and fecha_mov='$fecha_i'";
     
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>".$titulo."</strong></th>
        </tr>
        
        <tr>
        <th><strong>EMPLEADO</strong></th>
        <th colspan=\"2\"><strong>FECHAS</strong></th>
        
        <th><strong>OBSERVACION</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
            
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"1\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br />
            ".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">CAPTURA<BR />MOVIMIENTO<BR />APLICA<BR />
            <td align=\"left\">
            <font color=\"blue\">".$row->fecha_c."</font><BR />
            <font color=\"green\">".$row->fecha_mov."</font><BR />
            <font color=\"red\">".substr($row->fecha_rh,0,10)."</font></td>
            <td>_______________________</td>
            </tr>
            
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr>
<tr>
<td align=\"left\" colspan=\"4\">SUPERVISOR</td>
</tr> 
</table>";
        
        
        echo $tabla;
    
    }
//**************************************************************
//**************************************************************
//**************************************************************
/////////////////////////////////////////////////////////////////////////////////

function busca_fes($mot)
	{

		
        $sql1 = "SELECT * FROM catalogo.cat_festivo where farmacia>='$nuevafecha' and farmacia<='$fec'";
        $query1 = $this->db->query($sql1,array($clave));
        if( $query1->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<option value=\"-\">Seleccione Festivo</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->farmacia."\">".$row->farmacia."</option>
            ";
        }
        }
        
        return $tabla;
	}

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
   function control_ventas_naturistas($fec)
    {
        
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $suc= $this->session->userdata('suc');
        $s="select sum(can*vta)as venta,
        (select count(fecha) from desarrollo.cortes_c where suc=a.suc and date_format(fechacorte,'%Y-%m')='$fec')as dias,
        
(select sum(siniva) from cortes_c aa left join cortes_d bb on bb.id_cc=aa.id where  clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and aa.suc=a.suc
        group by suc)as venta_glo,

        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),4)
        else
        round(((importe-imp_cancela)*.10),4)
        end)as comision,
        
(sum(case when c.iva='S' then round((importe-imp_cancela)/(1+b.iva),4)else(importe-imp_cancela)end)
*100)/(select  sum(siniva)
        from cortes_c aa
        left join cortes_d bb on bb.id_cc=aa.id
        where    clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and aa.suc=a.suc
        group by suc)as porce,

a.suc,b.nombre,b.tipo2,b.superv,b.regional,sum(can)as can,sum(importe)importe,sum(can*des)as descuento,sum(can*cancela)cancela,




sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

(sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)*.01)as uno
        


        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where tipo2<>'F'  and date_format(fecha, '%Y-%m') = '$fec'    and a.suc=$suc group by suc order by porce desc

        ";   
        $q = $this->db->query($s);
        
$lp = anchor('supervisor/venta_producto_naturistas_premio/'.$fec,'PREMIOS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));       
        $num=0;
            $totcan=0;
            $totimp=0;
            $totdes=0;
            $totimp_b=0;
            $totimp_b_c=0;
            $totimp_b_c_iva=0;
            $totcomision=0;
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
        if($r->porce>=13 and $r->suc<1600){
       $i='<a><img src="'.base_url().'img/feliz.jpeg" border="0" width="20px" /></a>';
       $comision=$r->comision;
       }else{
       $i='<a><img src="'.base_url().'img/triste.jpeg" border="0" width="20px" /></a>';
       $comision=0; 
       }
	   $num=$num+1;
       $l1 = anchor('encargado/venta_producto_naturistas/'.$r->suc.'/'.$fec.'/'.$r->porce,'Empleados</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('encargado/venta_dia_naturistas/'.$r->suc.'/'.$fec,'DIAS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));    
       
            $tabla.="
            <tr>
            <th align=\"center\" colspan=\"13\">".$r->tipo2." - ".$r->suc." - ".$r->nombre."</th>
            </tr>
            
        <tr>
        <th colspan=\"13\">COMISIONES NATURISTAS</th>
        </tr>
        <tr>
        <th></th>
        <th>DIAS TRAB.COR</th>
        <th>VTA-IVA<br />
        -T.AIRE<br />DEPTO.CORTES</th>
        <th colspan=\"2\">% PORCENTAJE</th>
        <th>CANT.</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>CANC.</th>
        <th>IMP.CANC - IVA</th>
        <th>COMISION</th>
        <th></th>
        </tr>

		    <tr>
		    <td align=\"right\">".($l1)."</td>
            <td align=\"right\">".($r->dias)."</td>
            <td align=\"right\">".number_format($r->venta_glo,4)."</td>
            <td align=\"right\">".$i."</td>
            <td align=\"right\">% ".round ($r->porce,2)."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->venta,2)."</td>
            <td align=\"right\">".number_format($r->descuento,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            <td align=\"right\">".number_format($r->cancela,2)."</td>
            <td align=\"right\">".number_format($r->imp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($comision,2)."</td>
            <td align=\"left\">$l2</td>
            
            </tr>
            ";
           $totcan=$totcan+$r->can;
           $totimp=$totimp+$r->venta;
           $totdes=$totdes+$r->descuento;
           $totimp_b=$totimp_b+$r->importe;
           $totimp_b_c=$totimp_b_c+$r->cancela;
           $totimp_b_c_iva=$totimp_b_c_iva+$r->imp_menos_iva_menos_cancela;
           $totcomision=$totcomision+$comision;
     
        }
         $tabla.="
        </tbody>
        <tr>
        <td align=\"right\" colspan=\"5\">TOTAL</td>
        <td align=\"right\">".number_format($totcan,0)."</td>
        <td align=\"right\">".number_format($totimp,2)."</td>
        <td align=\"right\">".number_format($totdes,2)."</td>
        <td align=\"right\">".number_format($totimp_b,2)."</td>
        <td align=\"right\">".number_format($totimp_b_c,2)."</td>
        <td align=\"right\">".number_format($totimp_b_c_iva,2)."</td>
        <td align=\"right\">".number_format($totcomision,2)."</td>
        <td align=\"left\"></td>
		</tr>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
   function control_ventas_producto_naturistas($fec,$suc,$meta)
    {
        
        $s="select  a.suc, a.nomina, sum(can) as can, sum(can*vta)as imp, sum(can*des)as des,sum(importe)imp_bruto,sum(imp_cancela)as imp_cancela,

        sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where  a.suc=$suc and date_format(fecha, '%Y-%m')='$fec' group by nomina order by can";   
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>EMPLEADO(A)<BR />NOMINA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>I.B. - CANC</th>
        <th>I.B.-CANC-IVA</th>
        <th>COMISION NETA</th>
        <th>SUC.ACTUAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $totcan=0;
        $totimp=0;
        $totdes=0;
        $totimp_bruto=0;
        $totimp_menos_cancela=0;
        $totimp_menos_iva_menos_cancela=0;
        $totcomision=0;
        
        foreach($q->result() as $r)
        {
         $s1="select min(tipo)as tipo, a.*,e.nombre as suce 
         from catalogo.cat_empleado a 
         left join catalogo.sucursal e on e.suc=a.succ
         where a.NOMINA=$r->nomina and tipo=1 group by nomina";
         $q1=$this->db->query($s1); 
         if($q1->num_rows()==1){
         $r1=$q1->row();
         $nom=trim($r1->pat).' '.trim($r1->mat).' '.trim($r1->nom);
         $tipo=$r1->tipo; 
         $suce=$r1->suce;
         $puesto=trim($r1->puestox); 
         }else{$nom='';$tipo=0; $suce='';$puesto='';}
         
            if($tipo=='2'||$tipo==0 || $puesto=='SUPERVISOR ANALISIS' || $puesto=='MEDICO')
            	{$color='red';$mot='SE PIERDE COMISION, No es transferible el monto'; 
           	}else{
            	$color='black';$mot='';
            	}
               
          if($meta<13){$comision=0;}else{$comision=$r->comision;}  
        $num=$num+1;
         
        $l1 = anchor('encargado/venta_producto_naturistas_empleado/'.$r->suc.'/'.$fec.'/'.$r->nomina.'/'.$meta, $r->nomina.' '.$nom.'<br /> '.$puesto.'<br ><font color=red>'.$mot.'</font>');
		    
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color='$color'>".number_format($r->can,0)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->des,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp_bruto,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp_cancela,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp_menos_iva_menos_cancela,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($comision,2)."</font></td>
            <td align=\"right\">".($suce)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
        $totimp=$totimp+$r->imp;
        $totdes=$totdes+$r->des;
		$totimp_bruto=$totimp_bruto+$r->imp_bruto;
        $totimp_menos_cancela=$totimp_menos_cancela+$r->imp_cancela;
 	    $totimp_menos_iva_menos_cancela=$totimp_menos_iva_menos_cancela+$r->imp_menos_iva_menos_cancela;
     	$totcomision=$totcomision+$r->comision;
   
        }
        $encargado=round($totimp_menos_iva_menos_cancela/100,2);
        $jefe=round($encargado/2,2);
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp_bruto,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            <td align=\"right\"></td>
            </tr>
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
    //**************************************************************
//**************************************************************
   function control_ventas_dia_naturistas($fec,$suc)
    {
        
        $s="select b.suc, fecha, sum(can) as can, sum(can*vta)as imp,sum(can*des)as des,sum(importe)imp_bruto,sum(imp_cancela)imp_cancela,
        sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,
        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where a.suc=$suc and date_format(fecha, '%Y-%m') = '$fec' group by fecha";   
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
         	 	
        <tr>
        <th>FECHA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>I.B. - CANC</th>
        <th>I.B. - CANC - IVA</th>
        <th>COMISION NETA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $totcan=0;
        $totimp=0;
        $totdes=0;
        $totimp_bruto=0;
        $totimp_menos_cancela=0;
        $totimp_menos_iva_menos_cancela=0;
        $totcomision=0;
        foreach($q->result() as $r)
        {
       	$l1 = anchor('encargado/venta_detalle_naturistas/'.$r->suc.'/'.$fec.'/'.$r->fecha,$r->fecha.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
		     
            $tabla.="
            <tr>
            <td align=\"right\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->imp,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->imp_bruto,2)."</td>
            <td align=\"right\">".number_format($r->imp_cancela,2)."</td>
            <td align=\"right\">".number_format($r->imp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($r->comision,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->imp;
 	    $totdes=$totdes+$r->des;
     	$totimp_bruto=$totimp_bruto+$r->imp_bruto;
        $totimp_menos_cancela=$totimp_menos_cancela+$r->imp_cancela;
        $totimp_menos_iva_menos_cancela=$totimp_menos_iva_menos_cancela+$r->imp_menos_iva_menos_cancela;
        $totcomision=$totcomision+$r->comision;
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp_bruto,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
    
 //////////////////////////////////////////////////////////////   
     function busca_medico()
    {
        
    $sql = "select * from catalogo.cat_medicos where tipo=1 and (matutino = ? or vespertino = ?)";
     
    $query = $this->db->query($sql, array($this->session->userdata('suc'), $this->session->userdata('suc')));
        
        $nombre = array();
        $nombre[0] = "Selecciona Un Medico";
        
        foreach($query->result() as $row){
            $nombre[$row->nomina] = $row->nombre;
        }
        
        return $nombre;    
        
    }
    
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
 function agrega_ticket_medicos()
    {   
    $s = "SELECT * FROM vtadc.ticket_med ";
    $q = $this->db->query($s);
    $si= $q->num_rows();
           
        $data = array(
           'nomina' => $this->input->post('nombre'),
           'suc' => $this->session->userdata('suc'),
           'ticket' => $this->input->post('ticket'),
          
      
        );
     $this->db->set('fecha', 'now()', false);
     $this->db->insert('vtadc.ticket_med', $data);
    
    
    
    }


        function tickets_med()
        {
        
        $sql = "SELECT t.id, t.nomina, m.nombre, t.suc, s.nombre as sucursal, t.ticket, t.fecha FROM vtadc.ticket_med t 
        left join catalogo.cat_medicos m on t.nomina = m.nomina
        left join catalogo.sucursal s on t.suc = s.suc
        where t.suc = ?";
        $query = $this->db->query($sql, $this->session->userdata('suc'));
        
        $tabla= "
        <table style=\"font-size: medium; \">
        <thead>
        <tr>
        <th>No. Control</th>
        <th>Nomina</th>
        <th>Medico</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>ticket</th>
        <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
        ";
     
        foreach($query->result() as $row)
        {
            //$l1 = anchor('catalogo/cambiar_usuario/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar ticket!', 'class' => 'encabezado'));        
            $tabla.="
            <tr>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucursal."</td>
            <td align=\"left\">".anchor('encargado/captura_ticket/'.$row->id, $row->ticket)."</td>
            <td align=\"left\">".$row->fecha."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
    
    
    function actualiza_ticket_model($id, $ticket)
    {
     $data = array(
           
           'ticket' => $ticket,
        );
 	 $this->db->where('id', $id);
     $this->db->update('vtadc.ticket_med', $data);
     return $this->db->affected_rows(); 	 
     }
          
/////////////////////////////////////////////////////
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
/////**************************************************************
//**************************************************************
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////**************************************************************
//**************************************************************
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////**************************************************************
//**************************************************************
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///


//**************************************************************
//**************************************************************
//**************************************************************
}