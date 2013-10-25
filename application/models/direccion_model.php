<?php
class Direccion_model extends CI_Model
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
function ver_premios_dias()
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select tipo, fecha,count(suc)as numero 
       from desarrollo.comision_ctl where motivo='premio' and tipo='C' group by fecha order by fecha desc";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">FECHA</th>
        <th colspan=\"1\"># SUC</th>
        <th colspan=\"1\">DETALLE</th>
        <th colspan=\"1\">IMPRIMIR</th>
        </tr>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
               

$l1 = anchor('direccion/premio_ctl_his/'.$r->fecha, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
$l3 = anchor('ventas/premio_ctl_imp/'.$r->fecha, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
    
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->fecha."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">" .$r->numero."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l3."</font></td>
            
             </tr>
            ";
         }
         $tabla.="
        </tbody>
        </table>";


        return $tabla;
       
}
//**************************************************************

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function control_premio_ctl_his($fec)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select d.completo as gerx,d.importe as imp_ger, c.completo as supx,c.importe as imp_sup,
       b.nombre as sucx, a.*,b.plantilla,
       (select count(*) from comision_det aa where aa.fecha='$fec' and a.suc=aa.suc and motivo='premio' and tipo='C')as persona
        from comision_ctl a
       left join catalogo.sucursal b on a.suc=b.suc
       left join comision_det c on c.suc=a.suc and c.fecha=a.fecha and c.motivo='premios' and c.tipo='C'
       left join comision_det d on d.suc=a.suc and d.fecha=a.fecha and d.motivo='premiog' and d.tipo='C'
       where a.fecha='$fec' and a.tipo='C'  and a.motivo like '%premio%' order by a.ger,a.sup,a.suc";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">GERENTE</th>
        
        <th colspan=\"1\">NID</th>
        <th colspan=\"1\">SUCURSAL</th>
        <th colspan=\"1\">HISTORICO</th>
        <th colspan=\"1\">GONT.IMP</th>
        <th colspan=\"1\">DIAS</th>
        <th colspan=\"1\">PERS.<br />ACTUAL</th>
        <th colspan=\"1\">PLANT.<br /> AUTOR.</th>
        <th colspan=\"1\">IMP<br />GERENTE</th>
        <th colspan=\"1\">IMP<br />SUPERVISOR</th>
        </tr>
        ";
        $color='black';
        $num=0;
        $tot1=0;$tot3=0;
        $tot2=0;$tot4=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        $l1 = anchor('direccion/premio_ctl_suc_his/'.$r->fecha.'/'.$r->suc, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
               
        
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"blue\">".$r->gerx."</font><br />".$r->supx."</td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->suc."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->sucx."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".number_format($r->base,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->importe,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->comision,0)."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$r->persona."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$r->plantilla."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$r->imp_ger."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$r->imp_sup."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            </tr>
            ";
            $tot1=$tot1+$r->persona;
            $tot2=$tot2+$r->plantilla;
            $tot3=$tot3+$r->imp_ger;
            $tot4=$tot4+$r->imp_sup;
         }
         $tabla.="
         <tr>
            <td align=\"right\"colspan=\"7\"><font size=\"1\" color=\"$color\">TOTAL</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$tot1."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$tot2."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($tot3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($tot4,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".number_format($tot3+$tot4,2)."</font></td>
            </tr>
         
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
       
}
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function control_premio_ctl_suc_his($fec,$suc)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*,b.completo,b.puestox,c.completo as completon,c.puestox as puestonx
       from desarrollo.comision_det a 
       left join catalogo.cat_empleado b on b.nomina=a.nomina and a.cia=b.cia and b.tipo=1
       left join catalogo.cat_empleado c on c.nomina=a.nueva_nomina and a.nueva_cia=c.cia and c.tipo=1
       where a.fecha='$fec' and a.suc=$suc and motivo='premio' and a.tipo='C'";
       
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NOMINA</th>
        <th colspan=\"1\">NOMBRE</th>
        <th colspan=\"1\">PUESTO</th>
        <th colspan=\"1\">DIAS</th>
        <th colspan=\"1\">TRANSFERIDO A</th>
        </tr>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
        if($r->nomina<>$r->nueva_nomina){$color='red';}else{$color='black';}
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
               
        
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->nomina."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->completo."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->puestox."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->dias."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->nueva_nomina." ".$r->completon."</font></font></td>
             </tr>
            ";
         }
         $tabla.="
         
         
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
       
}
//**************************************************************
//**************************************************************

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_comision()
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select tipo, fecha,count(suc)as numero 
       from desarrollo.comision_ctl where motivo='comision' and tipo='C' group by fecha order by fecha desc";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">FECHA</th>
        <th colspan=\"1\"># SUC</th>
        <th colspan=\"1\">DETALLE</th>
        <th colspan=\"1\">IMPRIMIR</th>
        </tr>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
               

$l1 = '';
$l3 = anchor('ventas/comision_ctl_imp/'.$r->fecha, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
    
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->fecha."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">" .$r->numero."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l3."</font></td>
            
             </tr>
            ";
         }
         $tabla.="
        </tbody>
        </table>";


        return $tabla;
       
}
//**************************************************************

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function rh_bajas($tit)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select e.motivo,a.id_user,c.nombre as supx,b.succ,d.nombre as sucx, b.tipo,a.cia,a.nomina,b.completo,b.puestox,
a.causa,obser2,a.fecha_c,fecha_mov,a.id_plaza
from mov_supervisor a
left join catalogo.cat_empleado b on b.nomina=a.nomina and a.cia=b.cia
left join usuarios c on c.id=a.id_user
left join catalogo.sucursal d on d.suc=b.succ
left join catalogo.cat_alta_empleado e on e.cia=a.cia and e.empleado=a.nomina and e.motivo='RETENCION'
where a.motivo=2 and b.tipo=1 and a.tipo<>4 group by nomina";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit </caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        
        <th colspan=\"1\">Captura</th>
        <th colspan=\"1\">Sucursal</th>
        <th colspan=\"1\">Nomina</th>
        <th colspan=\"1\"></th>
        <th colspan=\"1\">Empleado</th>
        <th colspan=\"1\">Puesto</th>
        <th colspan=\"1\">Causa</th>
        <th colspan=\"1\">Observacion</th>
        <th colspan=\"1\">Fec.Captura</th>
        <th colspan=\"1\">Fec.Mov</th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
       $num=$num+1; 
        if($r->motivo=='RETENCION'){$color='red';}else{$color='black';}
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->supx."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->sucx."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">" .$r->nomina."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$r->motivo."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->completo."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->puestox."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->causa."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->obser2."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">" .$r->fecha_c."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">" .$r->fecha_mov."</font></font></td>
             </tr>
            ";
         }
         $perdida=(76*15)*$num;
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
        <td colspan=\"11\" align=\"center\"><font size=\"5\" color=\"$color\">$num Empleados sin dar de baja</font></font></td>
        </tr>
        <tr>
        <td colspan=\"11\" align=\"center\"><font size=\"5\" color=\"$color\">Si todos los empleados ganaran $76.00 la perdida en 1 quincena es de $ ".number_format($perdida,2)." </font></font></td>
        </tr>
        </tfoot>
        </table>";


        return $tabla;
       
}
//**************************************************************

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function rh_cambios($tit)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select count(*) as num_suc,e.motivo,a.id_user,c.nombre as supx,b.succ,d.nombre as sucx, b.tipo,a.cia,a.nomina,b.completo,b.puestox,
a.causa,obser2,a.fecha_c,fecha_mov,a.id_plaza
from mov_supervisor a
left join catalogo.cat_empleado b on b.nomina=a.nomina and a.cia=b.cia
left join usuarios c on c.id=a.id_user
left join catalogo.sucursal d on d.suc=b.succ
left join catalogo.cat_alta_empleado e on e.cia=a.cia and e.empleado=a.nomina and e.motivo='RETENCION'
where a.motivo=3 and b.tipo=1 group by a.nomina";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit </caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        
        <th colspan=\"1\">Sucursal Actual</th>
        <th colspan=\"1\">Nomina</th>
        <th colspan=\"1\">Empleado</th>
        <th colspan=\"1\">Puesto</th>
        <th colspan=\"1\">Mov.Solic.</th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
       $num=$num+1; 
        if($r->motivo=='RETENCION'){$color='red';}else{$color='black';}
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->sucx."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">" .$r->nomina."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">" .$r->completo."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->puestox."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">" .$r->num_suc."</font></font></td>
             </tr>
            ";
         }
         $perdida=(76*15)*$num;
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
        <td colspan=\"11\" align=\"center\"><font size=\"5\" color=\"$color\">$num Empleados con cambios de sucursal</font></font></td>
        </tr>
        </tfoot>
        </table>";


        return $tabla;
       
}
//**************************************************************

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos($tit)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$aaa=date('Y');        
       $s = "SELECT b.mes as mesx,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vales,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,

sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos+a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn+
a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale+a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv+
a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san+a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as total,

sum(a.turno1_fal+a.turno2_fal+a.turno3_fal+a.turno4_fal)as faltante,
sum(a.turno1_sob+a.turno2_sob+a.turno3_sob+a.turno4_sob)as sobrante

fROM cortes_c a
left join catalogo.mes b on b.num=date_format(fechacorte,'%m')
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')>0 and a.suc>100
group by date_format(fechacorte,'%Y-%m')
order by mes,aaa

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">A&Ntilde;O</th>
        <th colspan=\"1\">MES</th>
        <th colspan=\"1\">MONEDA NACIONAL</th>
        <th colspan=\"1\">CONV.DE DOLAR</th>
        <th colspan=\"1\">VALES</th>
        <th colspan=\"1\">TARJETA BBV</th>
        <th colspan=\"1\">TARJETA SANTANDER</th>
        <th colspan=\"1\">TARJETA <br />AMERICAN EXP</th>
        <th colspan=\"1\">TOTAL</th>
        </tr>
        </thead>
        </tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
$l1 = anchor('direccion/tabla_depositos_tipo/'.$r->mes, $r->mesx, array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
    
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->aaa."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$l1."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->pesos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->mn,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->vales,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->bbv,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->san,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->exp,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->total,2)."</font></font></td>
             </tr>
            ";
         $tot1=$tot1+$r->pesos;
         $tot2=$tot2+$r->mn;
         $tot3=$tot3+$r->vales;
         $tot4=$tot4+$r->bbv;
         $tot5=$tot5+$r->san;
         $tot6=$tot6+$r->exp;
         $tot7=$tot7+$r->total;   
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"3\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot6,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot7,2)."</strong></font></font></td>
             </tr>
        </tfoot>
        </table>";
        return $tabla;
       
}
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos_tipo($mes,$tit)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$aaa=date('Y');        
       $s = "SELECT a.tsuc,b.nombre as tipox,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vales,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,

sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos+a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn+
a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale+a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv+
a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san+a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as total,

sum(a.turno1_fal+a.turno2_fal+a.turno3_fal+a.turno4_fal)as faltante,
sum(a.turno1_sob+a.turno2_sob+a.turno3_sob+a.turno4_sob)as sobrante

fROM cortes_c a
left join catalogo.cat_imagen b on b.tipo=a.tsuc
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes  and a.suc>100
group by tsuc
order by a.tsuc

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">TIPO</th>
        <th colspan=\"1\">FARMACIA</th>
        <th colspan=\"1\">MONEDA NACIONAL</th>
        <th colspan=\"1\">CONV.DE DOLAR</th>
        <th colspan=\"1\">VALES</th>
        <th colspan=\"1\">TARJETA BBV</th>
        <th colspan=\"1\">TARJETA SANTANDER</th>
        <th colspan=\"1\">TARJETA <br />AMERICAN EXP</th>
        <th colspan=\"1\">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
$l1 = anchor('direccion/tabla_depositos_cia_suc/'.$mes.'/'.$r->tsuc, $r->tipox, array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
    
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->tsuc."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$l1."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->pesos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->mn,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->vales,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->bbv,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->san,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->exp,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->total,2)."</font></font></td>
            
            
            
             </tr>
            ";
         $tot1=$tot1+$r->pesos;
         $tot2=$tot2+$r->mn;
         $tot3=$tot3+$r->vales;
         $tot4=$tot4+$r->bbv;
         $tot5=$tot5+$r->san;
         $tot6=$tot6+$r->exp;
         $tot7=$tot7+$r->total;   
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"3\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot6,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot7,2)."</strong></font></font></td>
             </tr>
        </tfoot>
        </table>
        ";
        return $tabla;
       
}
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos_cia_suc($mes,$tipo,$tit)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$aaa=date('Y');        
       $s = "SELECT a.suc,a.cia,b.nombre as sucx,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vales,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,

sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos+a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn+
a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale+a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv+
a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san+a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as total,

sum(a.turno1_fal+a.turno2_fal+a.turno3_fal+a.turno4_fal)as faltante,
sum(a.turno1_sob+a.turno2_sob+a.turno3_sob+a.turno4_sob)as sobrante

fROM cortes_c a
left join catalogo.sucursal b on b.suc=a.suc
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes and a.tsuc='$tipo' and a.suc>100
group by a.suc
order by a.suc

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NID</th>
        <th colspan=\"1\">SUCURSAL</th>
        <th colspan=\"1\">MONEDA NACIONAL</th>
        <th colspan=\"1\">CONV.DE DOLAR</th>
        <th colspan=\"1\">VALES</th>
        <th colspan=\"1\">TARJETA BBV</th>
        <th colspan=\"1\">TARJETA SANTANDER</th>
        <th colspan=\"1\">TARJETA <br />AMERICAN EXP</th>
        <th colspan=\"1\">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
            $l1 = anchor('direccion/tabla_depositos_cia_suc_dia/'.$mes.'/'.$tipo.'/'.$r->suc, $r->sucx, array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->suc."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$l1."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->pesos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->mn,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->vales,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->bbv,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->san,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->exp,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->total,2)."</font></font></td>
            
            
            
             </tr>
            ";
         $tot1=$tot1+$r->pesos;
         $tot2=$tot2+$r->mn;
         $tot3=$tot3+$r->vales;
         $tot4=$tot4+$r->bbv;
         $tot5=$tot5+$r->san;
         $tot6=$tot6+$r->exp;
         $tot7=$tot7+$r->total;   
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"3\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot6,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot7,2)."</strong></font></font></td>
             </tr>
        </tfoot>
        </table>";
        return $tabla;
       
}
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos_cia_suc_dia($mes,$suc,$tit)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$aaa=date('Y');        
       $s = "SELECT a.tsuc,a.fechacorte,a.cia,a.suc,a.cia,b.nombre as sucx,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vales,
(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,

(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos+a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn+
a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale+a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv+
a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san+a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as total,

(a.turno1_fal+a.turno2_fal+a.turno3_fal+a.turno4_fal)as faltante,
(a.turno1_sob+a.turno2_sob+a.turno3_sob+a.turno4_sob)as sobrante

fROM cortes_c a
left join catalogo.sucursal b on b.suc=a.suc
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes  and a.suc=$suc
order by a.fechacorte

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NID</th>
        <th colspan=\"1\">SUCURSAL</th>
        <th colspan=\"1\">MONEDA NACIONAL</th>
        <th colspan=\"1\">CONV.DE DOLAR</th>
        <th colspan=\"1\">VALES</th>
        <th colspan=\"1\">TARJETA BBV</th>
        <th colspan=\"1\">TARJETA SANTANDER</th>
        <th colspan=\"1\">TARJETA <br />AMERICAN EXP</th>
        <th colspan=\"1\">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
         $farmacia=' ';
        $incremento=' ';
        $dif=0;
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->fechacorte."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->sucx."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->pesos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->mn,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->vales,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->bbv,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->san,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->exp,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->total,2)."</font></font></td>
              </tr>
            ";
         $tot1=$tot1+$r->pesos;
         $tot2=$tot2+$r->mn;
         $tot3=$tot3+$r->vales;
         $tot4=$tot4+$r->bbv;
         $tot5=$tot5+$r->san;
         $tot6=$tot6+$r->exp;
         $tot7=$tot7+$r->total;   
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"3\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot6,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot7,2)."</strong></font></font></td>
             </tr>
        </tfoot>
        </table>";
        return $tabla;
       
}
//**************************************************************
//**************************************************************

    public function venta_tiempo_aire($fecha_inicial, $fecha_final)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/SucursalMes_/wsdl", false);
        $client->soap_defencoding = 'UTF-8';
        
        $err = $client->getError();
        if ($err) {
        	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
        	exit();
        }
        // This is an archaic parameter list
        $params = array(
                            'fecha_inicial' => $fecha_inicial,
                            'fecha_final'   => $fecha_final
                            );
        
        
        $result = $client->call('SucursalMes', $params, 'urn:wsta', 'urn:wsta#SucursalMes');
        
        if ($client->fault) {
        	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
        } else {
        	$err = $client->getError();
        	if ($err) {
        		echo '<h2>Error</h2><pre>' . $err . '</pre>';
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['json'];
                
        	}
        }
        
        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';


    }


    public function venta_tiempo_aire_producto($fecha_inicial, $fecha_final)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/MontoMes_/wsdl", false);
        $client->soap_defencoding = 'UTF-8';
        
        $err = $client->getError();
        if ($err) {
        	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
        	exit();
        }
        // This is an archaic parameter list
        $params = array(
                            'fecha_inicial' => $fecha_inicial,
                            'fecha_final'   => $fecha_final
                            );
        
        
        $result = $client->call('MontoMes', $params, 'urn:wsta', 'urn:wsta#MontoMes');
        
        if ($client->fault) {
        	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
        } else {
        	$err = $client->getError();
        	if ($err) {
        		echo '<h2>Error</h2><pre>' . $err . '</pre>';
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['json'];
                
        	}
        }
        
        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';


    }

    public function venta_tiempo_aire_cia($fecha_inicial, $fecha_final)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/CiaMes_/wsdl", false);
        $client->soap_defencoding = 'UTF-8';
        
        $err = $client->getError();
        if ($err) {
        	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
        	exit();
        }
        // This is an archaic parameter list
        $params = array(
                            'fecha_inicial' => $fecha_inicial,
                            'fecha_final'   => $fecha_final
                            );
        
        
        $result = $client->call('CiaMes', $params, 'urn:wsta', 'urn:wsta#CiaMes');
        
        if ($client->fault) {
        	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
        } else {
        	$err = $client->getError();
        	if ($err) {
        		echo '<h2>Error</h2><pre>' . $err . '</pre>';
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['json'];
                
        	}
        }
        
        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';


    }

    public function venta_tiempo_aire_comisiones()
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/Comisiones_/wsdl", false);
        $client->soap_defencoding = 'UTF-8';
        
        $err = $client->getError();
        if ($err) {
        	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
        	exit();
        }
        // This is an archaic parameter list
        $params = array(
                            'mac' => 'ALGO'
                            );
        
        
        $result = $client->call('Comisiones', $params, 'urn:wsta', 'urn:wsta#Comisiones');
        
        if ($client->fault) {
        	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
        } else {
        	$err = $client->getError();
        	if ($err) {
        		echo '<h2>Error</h2><pre>' . $err . '</pre>';
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['json'];
                
        	}
        }
        
        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';


    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_ventas($aaa,$mes,$far,$tit)
{
 if($far=='FAR'){$condicion="a.suc>=1600 and a.suc<=1603  and a.tipo2<>'F'";
 $archivo='producto_mes_suc';}
 elseif($far=='GEN'){$condicion="a.suc>100 and a.suc<1600  
and a.suc<>171
and a.suc<>172
and a.suc<>173
and a.suc<>174
and a.suc<>175
and a.suc<>176
and a.suc<>177
and a.suc<>178
and a.suc<>179
and a.suc<>180
and a.suc<>181
and a.suc<>187 and a.tipo2<>'F'";
$archivo='producto_mes_suc';}
 $var='venta'.$mes;
 
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
 $fec=$aaa.'-'.str_pad($mes,2,'0',STR_PAD_LEFT);     
       $s = "select date_format(fechacorte,'%Y-%m'),a.suc,a.nombre as sucx, fechacorte, sum(bb.siniva)as contado,

(select sum(siniva) from cortes_c ac left join cortes_d cc on ac.id=cc.id_cc and clave1=20
where ac.suc=a.suc and date_format(ac.fechacorte,'%Y-%m%')=date_format(aa.fechacorte,'%Y-%m%'))as recargas,

(select sum(siniva) from cortes_c ac left join cortes_d cc on ac.id=cc.id_cc and clave1 in(30,40)
where ac.suc=a.suc and date_format(ac.fechacorte,'%Y-%m%')=date_format(aa.fechacorte,'%Y-%m%'))as credito,

(select sum(neto+com)  from nomina af where aaa=$aaa and mes=$mes and af.suc=a.suc group by af.suc)as nomina,

(SELECT sum($var*costo) FROM vtadc.$archivo  where suc=a.suc group by suc)as costo,
(select sum(case
when ad.auxi=7004  and pago='MN' then (imp*iva)+imp
when ad.auxi=7003  and pago='MN' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
when ad.auxi=7004  and pago='USD' then ((imp*iva)+imp)*tipo_cambio
when ad.auxi=7003  and pago='USD' then (imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo)*tipo_cambio
end)from  rentas ad where aaa=$aaa and mes=$mes  and ad.suc=a.suc group by ad.suc)as rentas

from catalogo.sucursal a
left join  cortes_c aa on  aa.suc=a.suc
left join cortes_d bb on bb.id_cc=aa.id and bb.clave1>0 and bb.clave1<30 and bb.clave1<>20

where tlid=1 and $condicion  and  date_format(fechacorte,'%Y-%m')='$fec'  
group by a.suc
";


        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NID</th>
        <th colspan=\"1\">SUCURSAL</th>
        <th colspan=\"1\">COSTO<br />DE PRODUCTOS</th>
        <th colspan=\"1\">% COSTO</th>
        <th colspan=\"1\">VENTA DE<br />CONTADO</th>
        <th colspan=\"1\">CONTADO %</th>
        <th colspan=\"1\">CREDITO</th>
        <th colspan=\"1\">% CREDITO</th>
        <th colspan=\"1\">VENTA DE<br />TIEMPO AIRE</th>
        <th colspan=\"1\">% TIEMPO AIRE</th>
        <th colspan=\"1\">TOTAL VENTA</th>
        <th colspan=\"1\">TOTAL UTILIDAD</th>
        <th colspan=\"1\">RENTAS</th>
        <th colspan=\"1\">% RENTAS</th>
        <th colspan=\"1\">NOMINA</th>
        <th colspan=\"1\">% NOMINA</th>
        <th colspan=\"1\">IMPUESTOS <br />DE NOMINA</th>
        <th colspan=\"1\">% IMPUESTOS <br />DE NOMINA</th>
        <th colspan=\"1\">TOTAL<br />GASTOS</th>
        <th colspan=\"1\">UTILIDAD FINAL</th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;$tot8r=0;$tot9=0;$tot10=0;$tot11=0;
         foreach($q->result() as $r)
        {
        $utilidad_contado=100-(($r->costo/(($r->contado)+($r->credito)))*100);
        $utilidad_total=((($r->contado)+($r->credito))-($r->costo))+(($r->recargas*.057));
        $total_venta=$r->contado+$r->credito+$r->recargas;
        $cos=($r->costo/($r->contado+$r->credito))*100;
        $contado=($r->contado/$total_venta)*100;
        $credito=($r->credito/$total_venta)*100;
        $recargas=($r->recargas/$total_venta)*100;
        $nom=($r->nomina/$total_venta)*100;
        $nomi=(($r->nomina*.27)/$total_venta)*100;
        $ren=($r->rentas/$total_venta)*100;
        $total_gastos=round(($r->rentas)+($r->nomina)+(($r->nomina)*.27),2);
        
        $gastos=round(($r->rentas)+($r->nomina)+(($r->nomina)*.3)+(($r->contado)*.1),2);
        $utilidad=round($r->credito+$r->contado-(($r->rentas)+($r->nomina)+(($r->nomina)*.27)+(($r->contado)*.1)+($r->costo)),2);
        
           
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->suc."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->sucx."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($r->costo,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">% ".number_format($cos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".number_format($r->contado,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">% ".number_format($contado,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".number_format($r->credito,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">% ".number_format($credito,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".number_format($r->recargas,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">% ".number_format($recargas,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\"><strong>".number_format($total_venta,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"blue\"> ".number_format($utilidad_total,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\"> ".number_format($r->rentas,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\">% ".number_format($ren,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\"> ".number_format($r->nomina,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\">% ".number_format($nom,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\"> ".number_format($r->nomina*.27,2)."</font></font</td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\">% ".number_format($nomi,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\">".number_format($total_gastos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#824E4E\">".number_format($utilidad_total-$total_gastos,2)."</font></font></td>
            </tr>
            ";
         $tot1=$tot1+$r->costo;
         $tot2=$tot2+$r->contado;
         $tot3=$tot3+($r->credito);
         $tot4=$tot4+($r->recargas);
         $tot5=$tot5+$total_venta;
         $tot6=$tot6+$utilidad_total;
         $tot7=$tot7+$r->rentas;  
         $tot8=$tot8+$r->nomina;
         $tot8r=$tot8r+($r->nomina)*.27;   
         $tot9=$tot9+$total_gastos; 
         $tot10=$tot10+($utilidad_total-$total_gastos);
            
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"3\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot6,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot7,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot8,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot8r,2)."</strong></font></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot9,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot10,2)."</strong></font></font></td>
            
             </tr>
        </tfoot>
        </table>";
        return $tabla;    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_ventas_respaldo($aaa,$mes,$far,$tit)
{
 if($far=='FAR'){$condicion="a.suc>=1600 and a.suc<=1603  and a.tipo2<>'F'";
 $archivo='producto_mes_suc';}
 elseif($far=='GEN'){$condicion="a.suc>100 and a.suc<1600  
and a.suc<>171
and a.suc<>172
and a.suc<>173
and a.suc<>174
and a.suc<>175
and a.suc<>176
and a.suc<>177
and a.suc<>178
and a.suc<>179
and a.suc<>180
and a.suc<>181
and a.suc<>187 and a.tipo2<>'F'";
$archivo='producto_mes_suc';}
 $var='venta'.$mes;
 
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
 $fec=$aaa.'-'.str_pad($mes,2,'0',STR_PAD_LEFT);     
       $s = "select date_format(fechacorte,'%Y-%m'),a.suc,a.nombre as sucx, fechacorte, sum(bb.siniva)as contado,

(select sum(siniva) from cortes_c ac left join cortes_d cc on ac.id=cc.id_cc and clave1=20
where ac.suc=a.suc and date_format(ac.fechacorte,'%Y-%m%')=date_format(aa.fechacorte,'%Y-%m%'))as recargas,

(select sum(siniva) from cortes_c ac left join cortes_d cc on ac.id=cc.id_cc and clave1 in(30,40)
where ac.suc=a.suc and date_format(ac.fechacorte,'%Y-%m%')=date_format(aa.fechacorte,'%Y-%m%'))as credito,

(select sum(neto+com)  from nomina af where aaa=$aaa and mes=$mes and af.suc=a.suc group by af.suc)as nomina,

(SELECT sum($var*costo) FROM vtadc.$archivo  where suc=a.suc group by suc)as costo,
(select sum(case
when ad.auxi=7004  and pago='MN' then (imp*iva)+imp
when ad.auxi=7003  and pago='MN' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
when ad.auxi=7004  and pago='USD' then ((imp*iva)+imp)*tipo_cambio
when ad.auxi=7003  and pago='USD' then (imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo)*tipo_cambio
end)from  rentas ad where aaa=$aaa and mes=$mes  and ad.suc=a.suc group by ad.suc)as rentas

from catalogo.sucursal a
left join  cortes_c aa on  aa.suc=a.suc
left join cortes_d bb on bb.id_cc=aa.id and bb.clave1>0 and bb.clave1<30 and bb.clave1<>20

where tlid=1 and $condicion  and  date_format(fechacorte,'%Y-%m')='$fec'  
group by a.suc
";


        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NID</th>
        <th colspan=\"1\">SUCURSAL</th>
        <th colspan=\"1\">VENTA DE<br />CONTADO</th>
        <th colspan=\"1\">CREDITO</th>
        <th colspan=\"1\">VENTA DE<br />TIEMPO AIRE</th>
        <th colspan=\"1\">RENTAS</th>
        <th colspan=\"1\">NOMINA</th>
        <th colspan=\"1\">IMPUESTOS <br />DE NOMINA</th>
        <th colspan=\"1\">VARIOS<br />GASTOS</th>
        <th colspan=\"1\">TOTAL<br />GASTOS</th>
        <th colspan=\"1\">COSTO<br />DE PRODUCTOS</th>
        
        <th colspan=\"1\">UTILIDAD</th>
        <th colspan=\"1\">UTILIDAD<br />RECARGA</th>
        
        
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;$tot8r=0;$tot9=0;$tot10=0;$tot11=0;
         foreach($q->result() as $r)
        {
        $gastos=round(($r->rentas)+($r->nomina)+(($r->nomina)*.3)+(($r->contado)*.1),2);
        $utilidad=round($r->credito+$r->contado-(($r->rentas)+($r->nomina)+(($r->nomina)*.27)+(($r->contado)*.1)+($r->costo)),2);
        $ren=($r->rentas/$r->contado)*100;
        $nom=($r->nomina/$r->contado)*100;
        $nomi=(($r->nomina*.27)/$r->contado)*100;
        $vari=1;
        $gas=($gastos/($r->contado))*100;
        $cos=($r->costo/$r->contado)*100;
        $uti=($utilidad/($r->contado))*100;
        $utir=($r->recargas*.06)/$r->contado;
        
        $num=$num+1; 
        $pago=($r->contado+$r->recargas*.07)-$gastos;
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->suc."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->sucx."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\"><br /><font size=\"1\" color=\"green\">".number_format($r->contado,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\"><br /><font size=\"1\" color=\"green\">".number_format($r->credito,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\"><br /><font size=\"1\" color=\"green\">".number_format($r->recargas,2)."</font></font></td>
            
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($ren,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($r->rentas,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($nom,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($r->nomina,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($nomi,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format(($r->nomina)*.3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($vari,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format(($r->contado)*.1,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($gas,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($gastos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($cos,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($r->costo,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($uti,2)."</font><br /><font size=\"1\" color=\"blue\">".number_format($utilidad,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($utir,2)."</font><br /><font size=\"1\" color=\"blue\">".number_format(($r->recargas*.057),2)."</font></font></td>
            </tr>
            ";
         $tot1=$tot1+$r->rentas;
         $tot2=$tot2+$r->nomina;
         $tot3=$tot3+($r->nomina)*.27;
         $tot4=$tot4+($r->contado)*.1;
         $tot5=$tot5+$gastos;
         $tot6=$tot6+($r->costo);
         $tot7=$tot7+$r->contado;  
         $tot8=$tot8+$r->credito;
         $tot8r=$tot8r+$r->recargas;   
         $tot9=$tot9+$utilidad; 
         $tot10=$tot10+($r->recargas*.057);
            
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"3\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot6,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot7,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot8,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot8r,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot9,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot10,2)."</strong></font></font></td>
            
             </tr>
        </tfoot>
        </table>";
        return $tabla;    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cons_ventas($tit)
{
$totc1=0;$totc2=0;$totc3=0;$totc4=0;$totc5=0;$totc6=0;$totc7=0;$totc8=0;$totc9=0;$totc10=0;$totc11=0;$totc12=0;
$totr1=0;$totr2=0;$totr3=0;$totr4=0;$totr5=0;$totr6=0;$totr7=0;$totr8=0;$totr9=0;$totr10=0;$totr11=0;$totr12=0;
$tott1=0;$tott2=0;$tott3=0;$tott4=0;$tott5=0;$tott6=0;$tott7=0;$tott8=0;$tott9=0;$tott10=0;$tott11=0;$tott12=0;
$totl1=0;$totl2=0;$totl3=0;$totl4=0;$totl5=0;$totl6=0;$totl7=0;$totl8=0;$totl9=0;$totl10=0;$totl11=0;$totl12=0;
$totg=0;$general=0;

        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
       $s = "select aaa, tipo2,b.nombre,
sum(ta1)as ta1,sum(ta2)as ta2,sum(ta3)as ta3,sum(ta4)as ta4,sum(ta5)as ta5,sum(ta6)as ta6,
sum(ta7)as ta7,sum(ta8)as ta8,sum(ta9)as ta9,sum(ta10)as ta10,sum(ta11)as ta11,sum(ta12)as ta12,
sum(con1)as con1,sum(con2)as con2,sum(con3)as con3,sum(con4)as con4,sum(con5)as con5,sum(con6)as con6,
sum(con7)as con7,sum(con8)as con8,sum(con9)as con9,sum(con10)as con10,sum(con11)as con11,sum(con12)as con12,
sum(cre1)as cre1,sum(cre2)as cre2,sum(cre3)as cre3,sum(cre4)as cre4,sum(cre5)as cre5,sum(cre6)as cre6,
sum(cre7)as cre7,sum(cre8)as cre8,sum(cre9)as cre9,sum(cre10)as cre10,sum(cre11)as cre11,sum(cre12)as cre12
from vtadc.gc_venta_nueva a 
left join catalogo.cat_imagen b on b.tipo=a.tipo2 group by a.tipo2
";
$color1='blue';$color2='green';

        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th colspan=\"1\"></th>
        <th colspan=\"4\">ENERO</th>
        <th colspan=\"4\">FEBRERO</th>
        <th colspan=\"4\">MARZO</th>
        <th colspan=\"4\">ABRIL</th>
        <th colspan=\"4\">MAYO</th>
        <th colspan=\"4\">JUNIO</th>
        <th colspan=\"4\">JULIO</th>
        <th colspan=\"4\">AGOSTO</th>
        <th colspan=\"4\">SEPTIEMBRE</th>
        <th colspan=\"4\">OCTUBRE</th>
        <th colspan=\"4\">NOVIEMBRE</th>
        <th colspan=\"4\">DICIEMBRE</th>
        <th colspan=\"1\"></th>
        </tr>
        <th colspan=\"1\">IMAGEN</th>
        <th colspan=\"1\"><font color=\"$color1\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color1\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color2\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color1\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color2\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color1\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color2\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color1\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color2\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color1\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color2\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color1\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color1\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CONTADO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">CREDITO</font></th>
        <th colspan=\"1\"><font color=\"$color2\">T.AIRE</font></th>
        <th colspan=\"1\"><font color=\"$color2\">TOTAL</font></th>
        <th colspan=\"1\"><font color=\"black\">TOTAL ANUAL</font></th>
        
        
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
         $general=$general+(
$r->con1+$r->con2+$r->con3+$r->con4+$r->con5+$r->con6+$r->con7+$r->con8+$r->con9+$r->con10+$r->con11+$r->con12+
$r->cre1+$r->cre2+$r->cre3+$r->cre4+$r->cre5+$r->cre6+$r->cre7+$r->cre8+$r->cre9+$r->cre10+$r->cre11+$r->cre12+
$r->ta1+$r->ta2+$r->ta3+$r->ta4+$r->ta5+$r->ta6+$r->ta7+$r->ta8+$r->ta9+$r->ta10+$r->ta11+$r->ta12);
            
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"black\">".$r->nombre."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con1,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->cre1,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->ta1,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con1+$r->ta1+$r->cre1,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con2,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->cre2,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->ta2,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con2+$r->ta2+$r->cre2,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->cre3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->ta3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con3+$r->ta3+$r->cre3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con4,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->cre4,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->ta4,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con4+$r->ta4+$r->cre4,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con5,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->cre5,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->ta5,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con5+$r->ta5+$r->cre5,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con6,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->cre6,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->ta6,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con6+$r->ta6+$r->cre6,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con7,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->cre7,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->ta7,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con7+$r->ta7+$r->cre7,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con8,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->cre8,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->ta8,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con8+$r->ta8+$r->cre8,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con9,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->cre9,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->ta9,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con9+$r->ta9+$r->cre9,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con10,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->cre10,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->ta10,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con10+$r->ta10+$r->cre10,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con11,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->cre11,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->ta11,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color1\">".number_format($r->con11+$r->ta11+$r->cre11,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con12,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->cre12,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->ta12,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($r->con12+$r->ta12+$r->cre12,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color2\">".number_format($general,2)."</font></font></td>
            </tr>
            ";
$totc1=$totc1+$r->con1;$totc2=$totc2+$r->con2;$totc3=$totc3+$r->con3;$totc4=$totc4+$r->con4;
$totc5=$totc5+$r->con5;$totc6=$totc6+$r->con6;$totc7=$totc7+$r->con7;$totc8=$totc8+$r->con8;
$totc9=$totc9+$r->con9;$totc10=$totc10+$r->con10;$totc11=$totc11+$r->con11;$totc12=$totc12+$r->con12;
$totr1=$totr1+$r->cre1;$totr2=$totr2+$r->cre2;$totr3=$totr3+$r->cre3;$totr4=$totr4+$r->cre4;
$totr5=$totr5+$r->cre5;$totr6=$totr6+$r->cre6;$totr7=$totr7+$r->cre7;$totr8=$totr8+$r->cre8;
$totr9=$totr9+$r->cre9;$totr10=$totr10+$r->cre10;$totr11=$totr11+$r->cre11;$totr12=$totr12+$r->cre12;
$tott1=$tott1+$r->ta1;$tott2=$tott2+$r->ta2;$tott3=$tott3+$r->ta3;$tott4=$tott4+$r->ta4;
$tott5=$tott5+$r->ta5;$tott6=$tott6+$r->ta6;$tott7=$tott7+$r->ta7;$tott8=$tott8+$r->ta8;
$tott9=$tott9+$r->ta9;$tott10=$tott10+$r->ta10;$tott11=$tott11+$r->ta11;$tott12=$tott12+$r->ta12;
$totl1=$totl1+$r->ta1+$r->cre1+$r->con1;$totl2=$totl2+$r->ta2+$r->cre2+$r->con2;
$totl3=$totl3+$r->ta3+$r->cre3+$r->con3;$totl4=$totl4+$r->ta4+$r->cre4+$r->con4;
$totl5=$totl5+$r->ta5+$r->cre5+$r->con5;$totl6=$totl6+$r->ta6+$r->cre6+$r->con6;
$totl7=$totl7+$r->ta7+$r->cre7+$r->con7;$totl8=$totl8+$r->ta8+$r->cre8+$r->con8;
$totl9=$totl9+$r->ta9+$r->cre9+$r->con9;$totl10=$totl10+$r->ta10+$r->cre10+$r->con10;
$totl11=$totl11+$r->ta11+$r->cre11+$r->con11;$totl12=$totl12+$r->ta12+$r->cre12+$r->con12;
$totg=$totg+$general;
         
$general=0;            
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totc1,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totr1,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($tott1,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totl1,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totc2,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totr2,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($tott2,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totl2,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totc3,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totr3,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($tott3,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totl3,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totc4,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totr4,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($tott4,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totl4,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totc5,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totr5,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($tott5,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totl5,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totc6,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totr6,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($tott6,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totl6,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totc7,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totr7,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($tott7,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totl7,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totc8,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totr8,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($tott8,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totl8,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totc9,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totr9,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($tott9,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totl9,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totc10,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totr10,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($tott10,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totl10,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totc11,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totr11,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($tott11,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($totl11,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totc12,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totr12,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($tott12,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color2\"><strong>".number_format($totl12,2)."</strong></font></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color\"><strong>".number_format($totg,2)."</strong></font></font></td>
             </tr>
        </tfoot>
        </table>";
        return $tabla;    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function diagnostico($tit)
{

        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
       $s = "select a.reporta,a.id_captura,a.depto,count(a.nomina)as empleados,b.nombre 
       from oficinas.actividad a 
       left join catalogo.sucursal b on b.suc=a.depto where a.tipo='A' 
       group by id_captura
       
";
$color1='blue';$color2='green';

        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th colspan=\"1\">DEPTO</th>
        <th colspan=\"1\">DEPARTAMENTO</th>
        <th colspan=\"1\">EMPLEADOS</th>
        <th colspan=\"1\"></th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
            $l0 = anchor('direccion/imprime_diagnostico/'.$r->id_captura, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"black\">".$r->depto."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"black\">".$r->nombre."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"black\">".$r->empleados."</font></td>
            <td>$l0</td>
            </tr>";           
         $num=$num+1;
         }
         $tabla.="
        </tbody>
        <tfoot>
            <tr>
            <td align=\"right\" colspan=\"2\"><font size=\"1\" color=\"$color\"><strong>TOTAL</strong></font></td>
            <td align=\"right\" colspan=\"1\"><font size=\"1\" color=\"$color1\"><strong>".number_format($num,0)."</strong></font></td>
            <td></td>            
        </tr>
        </tfoot>
        </table>";
        return $tabla;    
}

















//**************************************************************
//**************************************************************
//**************************************************************
}