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
where a.motivo=2 and b.tipo=1 and a.tipo<>4";
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
 elseif($far=='GEN'){$condicion="a.suc>100 and a.suc<=1600  
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

(select sum(corregido) from cortes_c ac left join cortes_d cc on ac.id=cc.id_cc and clave1=20
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
        <th colspan=\"1\">RENTAS</th>
        <th colspan=\"1\">NOMINA</th>
        <th colspan=\"1\">IMPUESTOS <br />DE NOMINA</th>
        <th colspan=\"1\">VARIOS<br />GASTOS</th>
        <th colspan=\"1\">TOTAL<br />GASTOS</th>
        <th colspan=\"1\">COSTO<br />DE PRODUCTOS</th>
        <th colspan=\"1\">VENTA DE<br />CONTADO</th>
        <th colspan=\"1\">CREDITO</th>
        <th colspan=\"1\">UTILIDAD</th>
        <th colspan=\"1\">UTILIDAD<br />RECARGA</th>
        <th colspan=\"1\">PAGO</th>
        
        
        </tr>
        </thead>
        <tbody>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;$tot9=0;$tot10=0;$tot11=0;
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
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($ren,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($r->rentas,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($nom,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($r->nomina,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($nomi,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format(($r->nomina)*.3,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($vari,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format(($r->contado)*.1,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($gas,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($gastos,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($cos,2)."</font><br /><font size=\"1\" color=\"$color\">".number_format($r->costo,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\"><br /><font size=\"1\" color=\"green\">".number_format($r->contado,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\"><br /><font size=\"1\" color=\"green\">".number_format($r->credito,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($uti,2)."</font><br /><font size=\"1\" color=\"blue\">".number_format($utilidad,2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\">% ".number_format($utir,2)."</font><br /><font size=\"1\" color=\"blue\">".number_format(($r->recargas*.057),2)."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"orange\"><br /><font size=\"1\" color=\"black\"><strong>".number_format($pago,2)."</strong></font></font></td>
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
         $tot9=$tot9+$utilidad; 
         $tot10=$tot10+($r->recargas*.06);
         $tot11=$tot11+$pago;   
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
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot9,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot10,2)."</strong></font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\"><strong>".number_format($tot11,2)."</strong></font></font></td>
             </tr>
        </tfoot>
        </table>";
        return $tabla;    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////


















//**************************************************************
//**************************************************************
//**************************************************************
}