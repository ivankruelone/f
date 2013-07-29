<?php
class Ventas_model extends CI_Model
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
    function control($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
		<th>NID</th>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DIAS</th>
        <th>DETALLE</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*, sum(can)as can,sum(importe)as importe,d.nombre as sucx,d.tipo2
          
          from vtadc.venta_detalle a          
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha,'%Y-%m')='$fec'
           group by suc order by a.suc";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
        $sx = "SELECT count(*)as dias from vtadc.venta_ctl where suc=$r->suc and date_format(fecha,'%Y-%m')='$fec'";
        $qx = $this->db->query($sx);
        if($qx->num_rows() > 0){
        $rx=$qx->row();
        $dias=$rx->dias; 
        }else{
        $dias=0;	
        }	
       	
	   
       $num=$num+1;
       $l1 = anchor('ventas/detalle/'.$r->suc.'/'.$fec, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('ventas/control_dia/'.$r->suc.'/'.$fec, $dias);
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tipo2."</td>
            <td align=\"left\">".$r->suc."</td>
            <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
             <td align=\"right\">".$l2."</td>
            <td align=\"right\">".$l1."</td>
           
            </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_dia($fec,$suc)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*
          FROM vtadc.venta_detalle_suc_dia a
          where date_format(a.fecha,'%Y-%m')='$fec' and suc=$suc";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe; 
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detalle_codigo($fec,$suc)
       {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
		<th>NID</th>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*, sum(can)as can,sum(importe)as importe,d.nombre as sucx,d.tipo2
          FROM vtadc.venta_detalle a
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha,'%Y-%m')='$fec' and a.suc=$suc 
           group by codigo";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"left\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\" colspan=\"4\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
   
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_tar($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
		<th>NID</th>
        <th>SUCURSAL</th>
        <th>FOL.INICIAL</th>
        <th>FOL.FINAL</th>
        <th>TARJETAS</th>
        <th>VENTA</th>
        <th>INV</th>
        <th>OTRAS TARJETAS</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*,(a.fol2-a.fol1+1)as tar ,d.nombre as sucx,d.tipo2
          from vtadc.tarjetas_suc a
          left join catalogo.sucursal d on d.suc=a.suc
          order by suc";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
                                                                        //cliente preferente
        $sx = "SELECT * from vtadc.tarjetas where tipo=1 and suc=$r->suc and codigo>=$r->fol1 and codigo<=$r->fol2";
        $qx = $this->db->query($sx);
        
        if($qx->num_rows() > 0){
        $ventaa=$qx->num_rows();
        $inv=$r->tar-$ventaa; 
        $color='#051AFC';
        $l1 = anchor('ventas/detalle_tar/'.$r->suc.'/'.$r->fol1.'/'.$r->fol2, $ventaa, array('title' => 'Haz Click aqui para capturar!', 'class' => 'encabezado'));
        }else{
        $ventaa='';
        $inv=$r->tar;
        $color='#080101';
        $l1='';    
        }
                                                                         //otras tarjetas
       
        $sx1 = "SELECT * from vtadc.tarjetas where tipo<>1 and suc=$r->suc";
        $qx1 = $this->db->query($sx1);
        
        if($qx1->num_rows() > 0){
        $ventaa1=$qx1->num_rows();
        $color1='#FD0202';
        $l2 = anchor('ventas/detalle_tar_otras/'.$r->suc.'/'.$r->fol1.'/'.$r->fol2, $ventaa1, array('title' => 'Haz Click aqui para capturar!', 'class' => 'encabezado'));
        }else{
        $color1='#090101';
        $ventaa1='';
        $l2='';
        }
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tipo2."</td>
            <td align=\"left\">".$r->suc."</td>
            <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\">".$r->fol1."</td>
            <td align=\"right\">".$r->fol2."</td>
            <td align=\"right\">".$r->tar."</td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\"><strong>".$l1."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\"><strong>".$inv."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color1\"><strong>".$l2."</strong></font></td>
            
           
            </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detalle_codigo_tar($suc,$fol1,$fol2)
       {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
		<th>CLIENTE</th>
        <th>DIRECCION</th>
        <th>FEC.VENTA</th>
        <th>VENCIMIENTO</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.* 
        FROM vtadc.tarjetas a
        where suc=$suc and codigo>=$fol1 and codigo<=$fol2 and tipo=1"; 
          
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->venta."</td>
            <td align=\"left\">".$r->vigencia."</td>
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
   
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detalle_codigo_tar_otras($suc)
       {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO DE TARJETA</th>
        <th>TARJETA</th>
		<th>CLIENTE</th>
        <th>DIRECCION</th>
        <th>FEC.VENTA</th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*,b.nombre as tipox 
        FROM vtadc.tarjetas a
        left join catalogo.cat_tarjetas b on b.num=a.tipo
          where suc=$suc and tipo<>1"; 
          
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tipox."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->venta."</td>
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
   
    }
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detalle_pro($fec)
       {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>CODIGO</th>
		<th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT *from vtadc.venta_detalle_pro_tar 
		where date_format(fecha,'%Y-%m')='$fec' and importe>0
		order by can desc";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
        $l1 = anchor('ventas/detalle_tar_pro_g/'
        .$fec.'/'.$r->codigo.'/'.str_replace(
        array('.','+','/','(',')','*','%C2%A4'),
        array('','-','-',' ',' ',' ','N'),$r->descri), 'Detalle', array('title' => 'Haz Click aqui para ver en que sucursal se vendieron!', 'class' => 'encabezado'));
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            <td align=\"right\">".$l1."</td>
            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\" colspan=\"3\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
   
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detalle_tar_pro($fec,$cod,$descri)
       {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"11\" align=\"center\"><font size=\"+2\">$cod - ".str_replace('%20',' ',$descri)."</font></th>
        </tr>
        <tr>
        <th>#</th>
        <th>TIPO</th>
		<th>NID</th>
        <th>SUCURSAL</th>
        <th>FECHA</th>
        <th>TICKET</th>
        <th>TARJETA</th>
        <th>TIPO</th>
        <th>CLIENTE</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*, d.nombre as sucx,d.tipo2,b.nombre as tarjetax,c.nombre as cliente
          FROM vtadc.venta_detalle a
          left join catalogo.cat_tarjetas b on b.num=a.tipo
          left join vtadc.tarjetas c on c.codigo=a.tarjeta and c.suc=a.suc
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha,'%Y-%m')='$fec' and a.codigo=$cod and tarjeta and a.importe>0 order by a.suc,fecha";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"center\">".$r->tipo2."</td>
            <td align=\"left\">".$r->suc."</td>
            <td align=\"left\">".$r->sucx."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"left\">".$r->tiket."</td>
            <td align=\"right\">".$r->tarjeta."</td>
            <td align=\"left\">".$r->tarjetax."</td>
            <td align=\"left\">".$r->cliente."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\" colspan=\"9\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
   
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// clientes preferentes
    function control_cli($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>CODIGO</th>
		<th>CLIENTE</th>
        <th>DIRECCION</th>
        <th>VIGENCIA</th>
        <th>SUCURSAL</th>
        <th>PIEZAS</th>
        <th>IMPORTE</th>
        <th>DETALLE</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*,b.nombre as sucx,c.can,c.importe
        from vtadc.tarjetas a 
        left join catalogo.sucursal b on b.suc=a.suc 
        left join vtadc.venta_detalle_tarjeta_ctl c on c.tarjeta=a.codigo and c.fec='$fec'
        where a.tipo=1 order by can desc";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
       if($r->can>0){
       $l1 = anchor('ventas/detalle_cli/'.$r->codigo.'/'.$fec, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));  
       }else{
        $l1='';
       }
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->codigo."</td>
            <td align=\"left\">".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->vigencia."</td>
            <td align=\"left\">".str_pad($r->suc,4,0,STR_PAD_LEFT)." - ".$r->sucx."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            <td align=\"right\">".$l1."</td>
           
            </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detalle_codigo_cli($cod,$fec)
       {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
$num=0;
$totcan=0;
$totimp=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
		<th>NID</th>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.* 
          FROM vtadc.venta_detalle_tarjeta_1 a
          where fec='$fec' and a.tarjeta=$cod
          ";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->fec."</td>
            <td align=\"left\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\" colspan=\"4\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
function comision_empleado($fecha)
    {
$val="select *from vtadc.comision where fecha='$fecha' group by fecha";
$valq = $this->db->query($val); 
if($valq->num_rows() == 0){  
$s = "select b.regional,b.superv,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,
       (select sum(aa.siniva)from desarrollo.cortes_g aa where fecha='$fecha' and aa.suc=a.suc and aa.clave1<>20)as total_vta
       from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc
       where
       fecha='$fecha' and a.tipo2<>'F' and clave1=10
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=11
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=16
        or
       fecha='$fecha' and a.tipo2<>'F' and clave1=24
       group by suc
       order by tipo2,siniva desc
       ";
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
        
        foreach($q->result() as $r)
        {
        $dif=0;
        $farmacia=0;
        $incremento=0;
        $sup=0;
        $ger=0;
        $nat_ger=0;
        $nat_sup=0;
        if($r->his_vta>0){$dif=$r->siniva-$r->his_vta;}
        if($dif>=15000 and $dif<=19999){$incremento=15;}
        if($dif>=20000 and $dif<=24999){$incremento=20;}
        if($dif>=25000){$incremento=25;}
        if($r->his_vta==0 and $r->siniva>=100000 and $r->tipo2=='G'){$incremento=30;}
        if($r->his_vta==0 and $r->siniva>=150000 and $r->tipo2=='D'){$incremento=30;}
        
        if($r->vta_naturista>=7000){$porce=round(($r->vta_naturista*100)/$r->total_vta,2);}else{$porce=0;}
        $sx1 = "select *from catalogo.cat_comision  where tipo='$r->tipo2' and $r->siniva between monto1 and monto2";
        $qx1 = $this->db->query($sx1);
        if($qx1->num_rows() > 0){    
        $rx1=$qx1->row();
        $farmacia=$rx1->farmacia;
        $ger=$rx1->gere;
        $sup=$rx1->sup;
        }        
        
        if($porce>=13){
            $nat_ger=($r->vta_naturista*.003);
            $nat_sup=($r->vta_naturista*.005);
            $enc_nat=($r->vta_naturista*.01);
            $jef_nat=($r->vta_naturista*.005);
            }else{
            $nat_ger=0;
            $nat_sup=0;
            $enc_nat=0;
            $jef_nat=0;
            }
$sx = "select a.succ,a.tipo,a.cia,trim(a.puestox)as puestox,a.nomina,a.pat,a.mat,a.nom,b.bon_pri
from catalogo.cat_empleado_ant a
left join catalogo.cat_puesto b on b.puesto=a.puestox
where succ=$r->suc and b.bon_pri='S' and tipo=1";

        $qx = $this->db->query($sx);
foreach($qx->result() as $rx)
{

if($rx->puestox == 'ENCARGADO "A"'
|| $rx->puestox == 'ENCARGADO "B"'
|| $rx->puestox == 'ENCARGADO "C"'){$enc_nat_x=$enc_nat;}else{$enc_nat_x=0;}
if($rx->puestox == 'JEFE MOSTRADOR "A"'
|| $rx->puestox == 'JEFE MOSTRADOR "B"'
|| $rx->puestox == 'JEFE MOSTRADOR "C"'){$jef_nat_x=$jef_nat;}else{$jef_nat_x=0;}
//fecha, suc, cianom, nomina, pat, mat, nom, vta_dias, incre_dias, natur, 
            //ger_vta, ger_nat, sup_vta, sup_nat, enc_nat, jef_nat
            $new_member_insert_data = array(
			'fecha'     =>$fecha,
            'suc'       =>$r->suc,
            'cianom'    =>$rx->cia,
            'nomina'    =>$rx->nomina,
            'pat'       =>$rx->pat,
            'mat'       =>$rx->mat,
            'nom'       =>$rx->nom,
            'vta_dias'  =>$farmacia,
            'incre_dias'=>$incremento,
            'natur'     =>0,
            'ger_vta'   =>0,
            'ger_nat'   =>0,
            'sup_vta'   =>0,
            'sup_nat'   =>0,
            'enc_nat'   =>$enc_nat_x,   
            'jef_nat'   =>$jef_nat_x,
            'puestox'   =>'',
            'puesto'    =>utf8_encode($rx->puestox)   
		);
        $insert = $this->db->insert('vtadc.comision', $new_member_insert_data); 
}    

$sxx = "select a.nomina,a.cia,a.plaza,b.pat,b.mat,b.nom,b.puestox
 from desarrollo.usuarios a
left join catalogo.cat_empleado_ant b on b.nomina=a.nomina and b.cia=a.cia
where a.plaza=$r->superv and nivel=14 and a.nomina>0;";
        $qxx = $this->db->query($sxx);            
if($qxx->num_rows() > 0){
$numero=0;
foreach($qxx->result() as $rxx)
{
    $numero=$numero+1;
//fecha, suc, cianom, nomina, pat, mat, nom, vta_dias, incre_dias, natur, 
            //ger_vta, ger_nat, sup_vta, sup_nat, enc_nat, jef_nat
            $new_member_insert_data = array(
			'fecha'     =>$fecha,
            'suc'       =>$r->suc,
            'cianom'    =>$rxx->cia,
            'nomina'    =>$rxx->nomina,
            'pat'       =>$rxx->pat,
            'mat'       =>$rxx->mat,
            'nom'       =>$rxx->nom,
            'vta_dias'  =>0,
            'incre_dias'=>0,
            'natur'     =>0,
            'ger_vta'   =>0,
            'ger_nat'   =>0,
            'sup_vta'   =>$sup,
            'sup_nat'   =>$nat_sup,
            'enc_nat'   =>0,   
            'jef_nat'   =>0,
            'puestox'   =>'SUP',
            'puesto'    =>utf8_encode($rxx->puestox)   
		);
        $insert = $this->db->insert('vtadc.comision', $new_member_insert_data); 
}}
$numero=0;
$natur=0;

$sxxg = "select a.nomina,a.cia,a.plaza,b.pat,b.mat,b.nom,b.puestox
 from desarrollo.usuarios a
left join catalogo.cat_empleado_ant b on b.nomina=a.nomina and b.cia=a.cia
where a.plaza=$r->regional and nivel=21 and a.nomina>0";

        $qxxg = $this->db->query($sxxg);            
if($qxxg->num_rows() > 0){
foreach($qxxg->result() as $rxxg)
{
//fecha, suc, cianom, nomina, pat, mat, nom, vta_dias, incre_dias, natur, 
            //ger_vta, ger_nat, sup_vta, sup_nat, enc_nat, jef_nat
            $new_member_insert_data = array(
			'fecha'     =>$fecha,
            'suc'       =>$r->suc,
            'cianom'    =>$rxxg->cia,
            'nomina'    =>$rxxg->nomina,
            'pat'       =>$rxxg->pat,
            'mat'       =>$rxxg->mat,
            'nom'       =>$rxxg->nom,
            'vta_dias'  =>0,
            'incre_dias'=>0,
            'natur'     =>0,
            'ger_vta'   =>$ger,
            'ger_nat'   =>$nat_ger,
            'sup_vta'   =>0,
            'sup_nat'   =>0,
            'enc_nat'   =>0,   
            'jef_nat'   =>0,
            'puestox'   =>'GER',
            'puesto'    =>utf8_encode($rxxg->puestox)   
		);
        $insert = $this->db->insert('vtadc.comision', $new_member_insert_data); 
}}         
         
         
}
$new= array('tipo'=>3);$this->db->where('fecha', $fecha);$this->db->update('desarrollo.cortes_g', $new); 
}}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_ventas_premios_genera($fec)
    {
        
        $fec1=$fec.'-10';
        $feccambio=$fec.'-20';
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$a="delete FROM catalogo.cat_empleado_ant";
$this->db->query($a);
$b="insert into catalogo.cat_empleado_ant(cia, plaza, succ, nomina, pat, mat, nom, completo, id, id_user, suc, contador, tipo, puesto, suc_far, puestox, rfc, curp, afiliacion, registro_pat, fecha_as400, id_plaza, checa, entrada, salida, tolerancia, codtar, personal, id_checador, pass, observacion, imagen, fechahis, fechaalta, depto)
(select cia, plaza, succ, nomina, pat, mat, nom, completo, id, id_user, suc, contador, tipo, puesto, suc_far, puestox, rfc, curp, afiliacion, registro_pat, fecha_as400, id_plaza, checa, entrada, salida, tolerancia, codtar, personal, id_checador, pass, observacion, imagen, fechahis, fechaalta, depto from catalogo.cat_empleado)";
$this->db->query($b);
$c="update  catalogo.cat_empleado_ant a, mov_supervisor b
set a.succ=b.suc1
where a.nomina=b.nomina and a.cia=b.cia and b.tipo>1 and b.tipo<>4 and b.motivo=3 and b.fecha_mov>='$feccambio'";
$this->db->query($c);

        $s="select a.regional,a.superv, a.tipo2, a.suc,a.nombre,a.his_venta,
(select count(fecha) from desarrollo.cortes_c where suc=a.suc and date_format(fechacorte,'%Y-%m')='$fec')as dias,
(select sum(siniva) from desarrollo.cortes_c aa
left join cortes_d bb on aa.id=bb.id_cc
where
suc=a.suc and date_format(aa.fechacorte,'%Y-%m')='$fec' and clave1=10
or
suc=a.suc and date_format(aa.fechacorte,'%Y-%m')='$fec' and clave1=11
or
suc=a.suc and date_format(aa.fechacorte,'%Y-%m')='$fec' and clave1=16
group by aa.suc
)as gon_imp,
(select farmacia from catalogo.cat_comision cc where cc.tipo=a.tipo2 and gon_imp between monto1 and monto2
)as farmacia

from catalogo.sucursal a
where  a.tlid=1 and a.suc>100 and a.suc<=1600 and tipo2<>'F'
";   

$q = $this->db->query($s);
        foreach($q->result() as $r)
        {
        if($r->farmacia>0){
        $s1="select a.*,b.farmacia as far from catalogo.cat_empleado_ant a
        left join catalogo.cat_puesto b on b.puesto=a.puestox 
        where a.tipo=1 and a.succ=$r->suc and farmacia='S' and trim(a.puestox)<>'MEDICO' and fechahis<='$fec1'"; 
        
$q1 = $this->db->query($s1);
        foreach($q1->result() as $r1)
        {
       
$ss="insert into desarrollo.comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, no_dias,motivo,ger,sup,nueva_nomina,nueva_cia,puestox,completo)
values($r->suc,'$fec',$r1->cia,$r1->nomina,$r->farmacia,0,'0000-00-00',$r->farmacia,'premio',
$r->regional,$r->superv,$r1->nomina,$r1->cia,trim('$r1->puestox'),trim('$r1->completo'))
on duplicate key update dias=values(dias)";
$this->db->query($ss);
        }        
$sc="insert into desarrollo.comision_ctl(suc, fecha, importe, tipo, motivo, ger, sup, comision, base)
values($r->suc,'$fec','$r->gon_imp','A','premio',$r->regional,$r->superv,$r->farmacia,'$r->his_venta')
on duplicate key update comision=values(comision),base=values(base),importe=values(importe)";
$this->db->query($sc);        
    }
    }

}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_comision_pendiente()
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select tipo, fecha,count(suc)as numero 
       from desarrollo.comision_ctl where motivo='premio'  group by fecha order by fecha desc";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">FECHA</th>
        <th colspan=\"1\">VALIDAR</th>
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
        
               
if($r->tipo=='C'){
$l1='';$l2='';
$l1 = anchor('ventas/premio_ctl_his/'.$r->fecha, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
$l3 = anchor('ventas/premio_ctl_imp/'.$r->fecha, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
}else{
$l1 = anchor('ventas/premio_ctl/'.$r->fecha, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
$l2 = anchor('ventas/premio_ctl_val/'.$r->fecha, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
$l3='';}
    
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->fecha."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$l2."</font></font></td>
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
////////////////////////////////////////////////////////////////////////////////////////////////////
function control_premio_ctl($fec)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select b.plantilla,a.*,b.nombre as sucx,c.nombre as supx,d.nombre as gerx,
       (select count(nomina) from desarrollo.comision_det where motivo='premio' and fecha='$fec' and suc=a.suc)as empleado
       from desarrollo.comision_ctl a 
       left join catalogo.sucursal b on b.suc=a.suc 
       left join usuarios c on a.sup=c.plaza and c.nivel=14 and c.activo=1 
       left join usuarios d on a.ger=d.plaza and d.nivel=21 and d.activo=1
       where a.fecha='$fec' and motivo='premio'
       group by a.suc order by a.ger,a.sup,a.suc";
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
        </tr>
        ";
        $color='black';
        $num=0;
        $tot1=0;
        $tot2=0;
         foreach($q->result() as $r)
        {
        if($r->importe>$r->base){$color='blue';}else{$color='black';}
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        $l1 = anchor('ventas/premio_ctl_suc/'.$r->fecha.'/'.$r->suc, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
               
        
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
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$r->empleado."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$r->plantilla."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            </tr>
            ";
            $tot1=$tot1+$r->empleado;
            $tot2=$tot2+$r->plantilla;
         }
         $tabla.="
         <tr>
            <td align=\"right\"colspan=\"7\"><font size=\"1\" color=\"$color\">TOTAL</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$tot1."</font></font></td>
            <td align=\"center\"><font size=\"1\" color=\"$color\">".$tot2."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\"></font></td>
            </tr>
         
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
       
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function control_premio_ctl_suc($fec,$suc)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*,b.completo,b.puestox,c.completo as completon,c.puestox as puestonx
       from desarrollo.comision_det a 
       left join catalogo.cat_empleado b on b.nomina=a.nomina and a.cia=b.cia and b.tipo=1
       left join catalogo.cat_empleado c on c.nomina=a.nueva_nomina and a.nueva_cia=c.cia and c.tipo=1
       where a.fecha='$fec' and a.suc=$suc and motivo='premio' ";
       
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NOMINA</th>
        <th colspan=\"1\">NOMBRE</th>
        <th colspan=\"1\">PUESTO</th>
        <th colspan=\"1\">DIAS</th>
        <th colspan=\"1\">OBSERV</th>
        <th colspan=\"1\">TRANSFERIDO A</th>
        </tr>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
        
        if($r->tipo=='X'|| $r->nomina<>$r->nueva_nomina){
        $color='red';$var='BORRADO';$l1='';
        }else{$color='black';$var='';
        $l1 = anchor('ventas/borrar_pre/'.$r->fecha.'/'.$suc.'/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
        }
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
               
        
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->nomina."<br />".$l1."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->completo."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->puestox."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->dias."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\"></font>$var</font></td>
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
function borrar_premio($id)
    {
    $id_user=$this->session->userdata('id');            
                     $uno = array(
                    'tipo'     => 'X',
                    'fecham'     => date('Y-m-d H:i:s'),
                    'id_user'     => $id_user
                    );
                    $this->db->where('id', $id);
                    $this->db->update('desarrollo.comision_det', $uno);
    }
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
       where a.fecha='$fec' and a.tipo='C'   and a.motivo = 'premio'  order by a.sup,a.suc";
      
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
        $l1 = anchor('ventas/premio_ctl_suc_his/'.$r->fecha.'/'.$r->suc, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
               
        
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
            <td align=\"right\"><font size=\"1\" color=\"green\"></font></td>
            </tr>
         
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
       
}
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
//**************************************************************
function control_ventas_premios_val($fec)
    {
$fecha_pre='2013-07-31';
$fecmes=$fec.'-01';
    $id_user=$this->session->userdata('id');            
$s="insert into comision_det(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox,
completo, nueva_nomina, nueva_cia,id_user, fecham,clave)

(select a.suc,a.fecha,d.cia,d.nomina,0,(c.gere),LAST_DAY(now()),'C',0,'premiog',a.ger,a.sup,d.puesto,e.completo,d.nomina,d.cia,
$id_user,date(now('%Y-%m-%d %H:%i:%s')),143
from comision_ctl a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_comision c on c.tipo=b.tipo2 and comision=farmacia
left join usuarios d on d.plaza=a.ger  and d.activo=1 and nivel=21
left join catalogo.cat_empleado e on e.nomina=d.nomina and e.cia=d.cia
where motivo='premio' and fecha='$fec') 

on duplicate key update importe=values(importe)";
$this->db->query($s);
$s1="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, nueva_nomina,
 nueva_cia,id_user, fecham,clave)
 (select a.suc,a.fecha,d.cia,d.nomina,0,(c.sup),LAST_DAY(now()),'C',0,'premios',a.ger,a.sup,e.puestox,e.completo,d.nomina,d.cia,
0,date(now('%Y-%m-%d %H:%i:%s')),143
from comision_ctl a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_comision c on c.tipo=b.tipo2 and comision=farmacia
left join usuarios d on d.plaza=a.sup and d.activo=1 and nivel=14
left join catalogo.cat_empleado e on e.nomina=d.nomina and e.cia=d.cia
where motivo='premio' and fecha='$fec'
order by cia) on duplicate key update importe=values(importe)";
$this->db->query($s1);
                     $uno = array(
                    'tipo'     => 'C'
                    );
                    $this->db->where('fecha', $fec);
                    $this->db->where('motivo', 'premio');
                    $this->db->where('tipo', 'A');
                    $this->db->update('desarrollo.comision_ctl', $uno);

                     $dos = array(
                    'tipo'     => 'C',
                    'fecham'   => date('Y-m-d H:i:s'),
                    'clave'    =>344,
                    'id_user'  => $id_user
                    );
                    $this->db->where('fecha', $fec);
                    $this->db->where('motivo', 'premio');
                    $this->db->where('tipo', 'A');
                    $this->db->update('desarrollo.comision_det', $dos);
    
$ss="insert into faltante(fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom,  tipo, clave,
observacion, succ, fecpre, fechai, varios)
(select date_sub(LAST_DAY(now()),interval 1 month),0,nueva_nomina, 0,sum(importe),0,id_user,suc,0,0,nueva_cia,0,2,clave,
'Bono por venta',
suc,LAST_DAY(now()),date(now()),
CASE when motivo ='comision' or motivo ='comisions' or motivo ='comisiong'
then 1
else
0
end
from comision_det
where fecha='$fec'  and tipo='C' and clave=143 and nueva_nomina>0 and importe>0
group by nueva_cia,nueva_nomina,motivo order by nueva_nomina)";

$ss="insert into faltante(fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom,  tipo, clave,
observacion, succ, fecpre, fechai, varios)
(select date_sub(LAST_DAY(now()),interval 1 month),0,nueva_nomina, 0,no_dias,0,id_user,suc,0,0,nueva_cia,0,2,clave,
'Bono por venta',
suc,LAST_DAY(now()),date(now()),
CASE when motivo ='comision' or motivo ='comisions' or motivo ='comisiong'
then 1
else
0
end
from comision_det
where fecha='$fec'  and tipo='C' and clave=344 and nueva_nomina>0
group by nueva_cia,nueva_nomina,motivo order by nueva_nomina)";    
    
    
    }
//**************************************************************
//**************************************************************
//**************************************************************
  function busca_control_ventas_naturistas($fec)
    {
        
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
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
        where tipo2<>'F'  and date_format(fecha, '%Y-%m') = '$fec' and a.suc<1600 group by suc order by porce desc

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
   
         <tr>
        <th colspan=\"13\">COMISIONES NATURISTAS</th>
        </tr>
        <tr>
         <th>#</th>
         <th>SUCURSAL</th>
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
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
            if($r->venta_glo<55000){$color='#FE9292';}else{$color='#FDFAFA';}
        if($r->porce>=13 and $r->suc<1600){
       $i='<a><img src="'.base_url().'img/feliz.jpeg" border="0" width="20px" /></a>';
       $comision=$r->comision;
       }else{
       $i='<a><img src="'.base_url().'img/triste.jpeg" border="0" width="20px" /></a>';
       $comision=0; 
       }
	   $num=$num+1;
        
            $tabla.="
            <tr bgcolor=\"$color\">
            <td align=\"right\">".$num."</td>
            <th align=\"left\" colspan=\"1\">".$r->tipo2." - ".$r->suc." <br />".$r->nombre."</th>
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
        <td align=\"right\" colspan=\"6\">TOTAL</td>
        <td align=\"right\">".number_format($totcan,0)."</td>
        <td align=\"right\">".number_format($totimp,2)."</td>
        <td align=\"right\">".number_format($totdes,2)."</td>
        <td align=\"right\">".number_format($totimp_b,2)."</td>
        <td align=\"right\">".number_format($totimp_b_c,2)."</td>
        <td align=\"right\">".number_format($totimp_b_c_iva,2)."</td>
        <td align=\"right\">".number_format($totcomision,2)."</td>
        </tr>
        </table>";
        
        echo $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function calcula_control_ventas_naturistas($fec)
    {
//////////////////////////////////////////////////////////////////////////////medicos
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $sm="select  a.nomina,d.cia,b.regional,b.superv,d.completo, d.puestox,a.suc,b.nombre as sucx,sum(can) as can, sum(can*vta)as imp, sum(can*des)as des,sum(importe)imp_bruto,sum(imp_cancela)as imp_cancela,

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
        left join catalogo.cat_empleado d on d.nomina=a.nomina and d.tipo=1
        where  date_format(fecha, '%Y-%m')='$fec' and trim(d.puestox)='MEDICO'
		group by a.suc,a.nomina
        ";
           
        $qm = $this->db->query($sm);
  foreach($qm->result() as $rm)
        {
      
       if($rm->comision>=300){
       
$f="insert into desarrollo.comision_ctl(suc, fecha, importe, tipo, motivo, ger, sup, comision,base,medico)values
($rm->suc,'$fec','$rm->imp_menos_iva_menos_cancela','A','comision',$rm->regional,$rm->superv,'$rm->comision',0,'S')
on duplicate key update comision=values(comision),importe=values(importe),base=values(base),medico=values(medico)
";
 $this->db->query($f);
$fdm="insert into comision_det
 (suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, nueva_nomina,
  nueva_cia)values
($rm->suc,'$fec',$rm->cia,$rm->nomina,0,'$rm->comision','0000-00-00','A',0,'comision',$rm->regional,
$rm->superv,'$rm->puestox','$rm->completo',$rm->nomina,$rm->cia)
on duplicate key update importe=values(importe),tipo=values(tipo)";
$this->db->query($fdm);	 	    
        }   
        }
  
//////////////////////////////////////////////////////////////////////////////////
       
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.suc,b.nombre,b.tipo2,b.superv,b.regional,
(select  sum(siniva)
        from cortes_c aa
        left join cortes_d bb on bb.id_cc=aa.id
        where  clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and aa.suc=a.suc
        group by suc)as venta_glo,

sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

(sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)*.01)as uno,
        
        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision,
(sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)
*100)/
(select  sum(siniva)
        from cortes_c aa
        left join cortes_d bb on bb.id_cc=aa.id
        where    clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and aa.suc=a.suc
        group by suc)as porce

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where tipo2<>'F'  and date_format(fecha, '%Y-%m') = '$fec'   group by suc order by porce desc
        ";   
        
        $q = $this->db->query($s);
  foreach($q->result() as $r)
        {
       if($r->porce>=13 and $r->suc<1600 and $r->venta_glo>0){
       
$f="insert into desarrollo.comision_ctl(suc, fecha, importe, tipo, motivo, ger, sup, comision,base,medico)values
($r->suc,'$fec','$r->imp_menos_iva_menos_cancela','A','comision',$r->regional,$r->superv,0,'$r->venta_glo','N')
on duplicate key update comision=values(comision),importe=values(importe),base=values(base),medico=values(medico)
";
 $this->db->query($f);	    
        
        }   
        }
 ////suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo

 $fd="insert into comision_det
 (suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo,nueva_cia,nueva_nomina)
(select a.suc, a.fec,
case when a.cia is null then 0 else a.cia end as cia, a.nomina, 0,a.comision,'0000-00-00',
case when a.comision <300 and a.puestox='MEDICO' then 'X' when puestox is null then 'X'else 'A' end as tipo,0,'comision',
 a.regional, a.superv,
 case when a.puestox is null then '-'else a.puestox end as puestox,
 case when a.completo is null then '-'else a.completo end as completo,
 case when a.cia is null then 0 else a.cia end as cia,a.nomina
 from comision_det_agrupado a
left join comision_ctl c on c.suc=a.suc and c.fecha='$fec'
where c.medico='N' and a.fec='$fec')on duplicate key update importe=values(importe),tipo=values(tipo)";
        $this->db->query($fd);	
////
 $fc="update comision_ctl a
 set a.comision=
 case when (select sum(importe) from comision_det b where a.suc=b.suc and a.fecha=b.fecha and tipo<>'X' group by b.fecha,b.suc) is null
then
0
else
(select sum(importe) from comision_det b where a.suc=b.suc and a.fecha=b.fecha and tipo<>'X' group by b.fecha,b.suc)
end,
 i_enc=
case when (select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%ENCARGADO %' group by suc) is null
then 0
else
(select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%ENCARGADO %' group by suc)
end,

i_jef=case when (select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%JEFE %' group by suc) is null
then 0
else
(select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%JEFE %' group by suc)
end where fecha='$fec' and motivo='comision' and tipo='A' and medico='N'";
 $this->db->query($fc);
 $final="SELECT ger,sup,fecha,suc,importe,((importe*.01)/i_enc)as encargado, ((importe*.01)/i_jef)as jefe FROM comision_ctl
where
fecha='$fec' and motivo='comision' and i_enc>0 and medico='N'
or
fecha='$fec' and motivo='comision' and i_jef>0 and medico='N'";
$finalq=$this->db->query($final);
 foreach($finalq->result() as $finalr)
 {
 $valor2=(($finalr->importe)*.01)/2;
 $valor=($finalr->importe)*.01;
if($finalr->importe>6999.99){
if($finalr->encargado<>null){
$graba="update comision_det set i_enc='$finalr->encargado' where motivo='comision' and fecha='$fec' and puestox like '%ENCARGADO %' and suc=$finalr->suc";    
$this->db->query($graba);
}else{
$graba="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, 
nueva_nomina, nueva_cia, i_enc, i_jef)
values($finalr->suc,'$fec',0,0,0,0,'0000-00-00','A',0,'comision',$finalr->ger,$finalr->sup,
'ENCARGADO','NINGUNO',0,0,'$valor',0)on duplicate key update cia=values(cia)"; 
$this->db->query($graba);   
}     
if($finalr->jefe<>null or $finalr->jefe < $finalr->encargado){
$graba1="update comision_det set i_jef='$finalr->jefe' where motivo='comision' and fecha='$fec' and puestox like '%JEFE M%' and suc=$finalr->suc";    
$this->db->query($graba1);
}else{
$graba1="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, 
nueva_nomina, nueva_cia, i_enc, i_jef)
values($finalr->suc,'$fec',0,0,0,0,'0000-00-00','A',0,'comision',$finalr->ger,$finalr->sup,
'JEFE','NINGUNO',0,0,0,'$valor2')on duplicate key update cia=values(cia)"; 
$this->db->query($graba1);
$graba2="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, 
nueva_nomina, nueva_cia, i_enc, i_jef)
values($finalr->suc,'$fec',99,0,0,0,'0000-00-00','A',0,'comision',$finalr->ger,$finalr->sup,
'JEFE','NINGUNO',0,0,0,'$valor2')on duplicate key update cia=values(cia)"; 
$this->db->query($graba2);   
}
}
}

//// quita empleados que no llegaron al 13 % de la venta total.
$fin="update comision_ctl a ,comision_det b
set b.tipo='Z'
where a.suc=b.suc and a.fecha=b.fecha and a.motivo=b.motivo and trim(b.puestox)<>'MEDICO' and a.fecha='$fec' and a.motivo='comision' and a.base=0";
$this->db->query($fin);
$fin1="select *from comision_det where tipo='Z' and fecha='$fec'  and motivo='comision'";
$this->db->query($fin1);
}


//**************************************************************
/////////////////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//**************************************************************
//**************************************************************
//**************************************************************
   function calcula_control_ventas_naturistas_una($fec,$suc)
    {
//////////////////////////////////////////////////////////////////////////////medicos
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $sm="select  a.nomina,d.cia,b.regional,b.superv,d.completo, d.puestox,a.suc,b.nombre as sucx,sum(can) as can, sum(can*vta)as imp, sum(can*des)as des,sum(importe)imp_bruto,sum(imp_cancela)as imp_cancela,

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
        left join catalogo.cat_empleado d on d.nomina=a.nomina and d.tipo=1
        where  date_format(fecha, '%Y-%m')='$fec' and trim(d.puestox)='MEDICO' and a.suc=$suc
		group by a.suc,a.nomina
        ";
           
        $qm = $this->db->query($sm);
  foreach($qm->result() as $rm)
        {
      
       if($rm->comision>=300){
       
$f="insert into desarrollo.comision_ctl(suc, fecha, importe, tipo, motivo, ger, sup, comision,base,medico)values
($rm->suc,'$fec','$rm->imp_menos_iva_menos_cancela','A','comision',$rm->regional,$rm->superv,'$rm->comision',0,'S')
on duplicate key update comision=values(comision),importe=values(importe),base=values(base),medico=values(medico)
";

 $this->db->query($f);
$fdm="insert into comision_det
 (suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, nueva_nomina,
  nueva_cia)values
($rm->suc,'$fec',$rm->cia,$rm->nomina,0,'$rm->comision','0000-00-00','A',0,'comision',$rm->regional,
$rm->superv,'$rm->puestox','$rm->completo',$rm->nomina,$rm->cia)
on duplicate key update importe=values(importe),tipo=values(tipo)";
$this->db->query($fdm);	 	    
        }   
        }
  
//////////////////////////////////////////////////////////////////////////////////
       
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.suc,b.nombre,b.tipo2,b.superv,b.regional,
(select  sum(siniva)
        from cortes_c aa
        left join cortes_d bb on bb.id_cc=aa.id
        where  clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and aa.suc=a.suc
        group by suc)as venta_glo,

sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

(sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)*.01)as uno,
        
        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision,
(sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)
*100)/
(select  sum(siniva)
        from cortes_c aa
        left join cortes_d bb on bb.id_cc=aa.id
        where    clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and aa.suc=a.suc
        group by suc)as porce

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where tipo2<>'F'  and date_format(fecha, '%Y-%m') = '$fec'    and a.suc=$suc group by suc order by porce desc
        ";   
        $q = $this->db->query($s);
  foreach($q->result() as $r)
        {
       if($r->porce>=13 and $r->suc<1600 and $r->venta_glo>0){
       
$f="insert into desarrollo.comision_ctl(suc, fecha, importe, tipo, motivo, ger, sup, comision,base,medico)values
($r->suc,'$fec','$r->imp_menos_iva_menos_cancela','A','comision',$r->regional,$r->superv,0,'$r->venta_glo','N')
on duplicate key update comision=values(comision),importe=values(importe),base=values(base),medico=values(medico)
";
 $this->db->query($f);	    
        
        }   
        }
 ////suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo

 $fd="insert into comision_det
 (suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo,nueva_cia,nueva_nomina)
(select a.suc, a.fec,
case when a.cia is null then 0 else a.cia end as cia, a.nomina, 0,a.comision,'0000-00-00',
case when a.comision <300 and a.puestox='MEDICO' then 'X' when puestox is null then 'X'else 'A' end as tipo,0,'comision',
 a.regional, a.superv,
 case when a.puestox is null then '-'else a.puestox end as puestox,
 case when a.completo is null then '-'else a.completo end as completo,
 case when a.cia is null then 0 else a.cia end as cia,a.nomina
 from comision_det_agrupado a
left join comision_ctl c on c.suc=a.suc and c.fecha='$fec'
where c.medico='N' and a.fec='$fec'  and a.suc=$suc)on duplicate key update importe=values(importe),tipo=values(tipo)";
$this->db->query($fd);	
echo 
      "insert into comision_det
 (suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo,nueva_cia,nueva_nomina)
(select a.suc, a.fec,
case when a.cia is null then 0 else a.cia end as cia, a.nomina, 0,a.comision,'0000-00-00',
case when a.comision <300 and a.puestox='MEDICO' then 'X' when puestox is null then 'X'else 'A' end as tipo,0,'comision',
 a.regional, a.superv,
 case when a.puestox is null then '-'else a.puestox end as puestox,
 case when a.completo is null then '-'else a.completo end as completo,
 case when a.cia is null then 0 else a.cia end as cia,a.nomina
 from comision_det_agrupado a
left join comision_ctl c on c.suc=a.suc and c.fecha='$fec'
where c.medico='N' and a.fec='$fec'  and a.suc=$suc)on duplicate key update importe=values(importe),tipo=values(tipo)";
  
        //die();
        
////
 $fc="update comision_ctl a
 set a.comision=
 (select sum(importe) from comision_det b where a.suc=b.suc and a.fecha=b.fecha and tipo<>'X'),
 i_enc=
case when (select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%ENCARGADO %' group by suc) is null
then 0
else
(select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%ENCARGADO %' group by suc)
end,

i_jef=case when (select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%JEFE %' group by suc) is null
then 0
else
(select count(nomina) from comision_det where suc=a.suc and motivo='comision' and fecha='$fec' and puestox like '%JEFE %' group by suc)
end where fecha='$fec' and motivo='comision' and tipo='A' and medico='N' and a.suc=$suc";
 $this->db->query($fc);
 $final="SELECT ger,sup,fecha,suc,importe,((importe*.01)/i_enc)as encargado, ((importe*.01)/i_jef)as jefe FROM comision_ctl
where
fecha='$fec' and motivo='comision' and i_enc>0 and medico='N' and suc=$suc
or
fecha='$fec' and motivo='comision' and i_jef>0 and medico='N' and suc=$suc";
$finalq=$this->db->query($final);
 foreach($finalq->result() as $finalr)
 {
 $valor2=(($finalr->importe)*.01)/2;
 $valor=($finalr->importe)*.01;
if($finalr->importe>6999.99){
if($finalr->encargado<>null){
$graba="update comision_det set i_enc='$finalr->encargado' where motivo='comision' and fecha='$fec' and puestox like '%ENCARGADO %' and suc=$finalr->suc  and suc=$suc";    
$this->db->query($graba);
}else{
$graba="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, 
nueva_nomina, nueva_cia, i_enc, i_jef)
values($finalr->suc,'$fec',0,0,0,0,'0000-00-00','A',0,'comision',$finalr->ger,$finalr->sup,
'ENCARGADO','NINGUNO',0,0,'$valor',0)on duplicate key update cia=values(cia)"; 
$this->db->query($graba);   
}     
if($finalr->jefe<>null or $finalr->jefe < $finalr->encargado){
$graba1="update comision_det set i_jef='$finalr->jefe' where motivo='comision' and fecha='$fec' and puestox like '%JEFE M%' and suc=$finalr->suc  and suc=$suc";    
$this->db->query($graba1);
}else{
$graba1="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, 
nueva_nomina, nueva_cia, i_enc, i_jef)
values($finalr->suc,'$fec',0,0,0,0,'0000-00-00','A',0,'comision',$finalr->ger,$finalr->sup,
'JEFE','NINGUNO',0,0,0,'$valor2')on duplicate key update cia=values(cia)"; 
$this->db->query($graba1);
$graba2="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, 
nueva_nomina, nueva_cia, i_enc, i_jef)
values($finalr->suc,'$fec',99,0,0,0,'0000-00-00','A',0,'comision',$finalr->ger,$finalr->sup,
'JEFE','NINGUNO',0,0,0,'$valor2')on duplicate key update cia=values(cia)"; 
$this->db->query($graba2);   
}
}
}

//// quita empleados que no llegaron al 13 % de la venta total.
$fin="update comision_ctl a ,comision_det b
set b.tipo='Z'
where a.suc=b.suc and a.fecha=b.fecha and a.motivo=b.motivo and trim(b.puestox)<>'MEDICO' and a.fecha='$fec' and a.motivo='comision' and a.base=0";
$this->db->query($fin);
$fin1="select *from comision_det where tipo='Z' and fecha='$fec'  and motivo='comision'";
$this->db->query($fin1);


}


//**************************************************************
/////////////////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//**************************************************************
function ctl_ventas_naturistas()
    {
 $s = "select *from desarrollo.comision_ctl where motivo='comision' group by fecha";
 
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"2\">FECHA</th>
        <th colspan=\"1\">VALIDA</th>
        <th colspan=\"1\">EDITA</th>
        <th colspan=\"1\">IMPRIME</th>
        </tr>
        ";
        $color='black';
        $num=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
               
        if($r->tipo=='C'){
$l1='';$l2='';
$l1 = anchor('ventas/comision_ctl_his/'.$r->fecha, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
$l3 = anchor('ventas/comision_ctl_imp/'.$r->fecha, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
}else{
$l1 = anchor('ventas/tabla_control_ventas_naturistas/'.$r->fecha.'/'.$r->fecha, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
$l2 = anchor('ventas/comision_ctl_val/'.$r->fecha, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
$l3='';}

        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->fecha."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$l2."</font></font></td>
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
//**************************************************************
//**************************************************************
//**************************************************************

   function control_ventas_naturistas($fec)
    {
        
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as sucx,b.tipo2,
        case when a.importe>7000 and medico='N' then a.importe*.01  else 0 end as uno ,
        ((a.importe*100)/base)as porce,
         case when ((a.importe*100)/base)>=13 and a.importe>=7000 then a.importe*.003 else 0 end as imp_ger,
         case when ((a.importe*100)/base)>=13 and a.importe>=7000 then a.importe*.005 else 0 end as imp_sup,
        sum(c.i_enc)as enc_d,sum(c.i_jef)as jef_d
        from desarrollo.comision_ctl a
        
left join catalogo.sucursal b on b.suc=a.suc
left join  desarrollo.comision_det c on c.suc=a.suc and c.motivo=a.motivo and c.fecha=a.fecha and c.tipo='A'
where a.motivo='comision' and a.fecha='$fec' and a.tipo='A'
group by a.suc
        ";
        
       
        $q = $this->db->query($s);
       
        $num=0;
            $tbase=0;
            $timporte=0;
            $totdes=0;
            $totimp_b=0;
            $totimp_b_c=0;
            $totimp_b_c_iva=0;
            $totcomision=0;
            $totsup=0;
            $totenc=0;
            $totger=0;
            $totjef=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th></th>
        <th colspan=\"14\">COMISIONES NATURISTAS</th>
        </tr>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>VTA-IVA<br />
        -T.AIRE<br />DEPTO.CORTES</th>
        <th>IMP.CANC - IVA<br />NATURISTA</th>
        <th colspan=\"1\">% </th>
        <th>COMISION</th>
        <th>COM.<br />JEF</th>
        <th>COM.<br />ENC</th>
        <th>COM.<br />SUP</th>
        <th>COM.<br />GER</th>
        <th>COM.<br />TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
   $totimp_ger=0;
   $totimp_sup=0;     
  $color='blue'; $dif=0;
        foreach($q->result() as $r)
        {
        $dif=($r->uno*2)-$r->enc_d-$r->jef_d;
         if($dif>1 ||$dif<'-1'){$color='red';}else{$color='blue';}   
       $num=$num+1;
       $conta=$num;
       $l1 = anchor('ventas/venta_producto_naturistas/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->sucx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
        
          $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$conta."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->base,2)."<br /></font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."<br /></td>
            <td align=\"right\"><font color=\"$color\">% ".number_format($r->porce,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->comision,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\"><font color=\"orange\">".number_format($r->enc_d,2)."</font><br />".number_format($r->uno,2)."</font></td>
            <td align=\"right\"><font color=\"green\"><font color=\"orange\">".number_format($r->jef_d,2)."</font><br />".number_format($r->uno,2)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->imp_sup,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->imp_ger,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\"><strong>
            ".number_format(($r->comision)+($r->jef_d)+($r->enc_d)+($r->imp_sup)+($r->imp_ger),2)."<br /></strong></font></td>
            </tr>
            ";
           $tbase=$tbase+$r->base;
           $timporte=$timporte+$r->importe;
           $totcomision=$totcomision+$r->comision;
           $totjef=$totjef+$r->jef_d;
           $totenc=$totenc+$r->enc_d;
           $totimp_sup=$totimp_sup+$r->imp_sup;
           $totimp_ger=$totimp_ger+$r->imp_ger;
        }
         $tabla.="
        </tbody>
        <tr>
        <th></th>
        <th></th>
        <th>VTA-IVA<br />
        -T.AIRE<br />DEPTO.CORTES</th>
        <th>IMP.CANC - IVA<br />NATURISTA</th>
        <th colspan=\"1\">% </th>
        <th>COMISION</th>
        <th>COM.<br />JEF</th>
        <th>COM.<br />ENC</th>
        <th>COM.<br />SUP</th>
        <th>COM.<br />GER</th>
        <th>COM.<br />TOTAL</th>
        </tr>
        <tr>
        <td align=\"right\" colspan=\"2\">TOTAL</td>
        <td align=\"right\">".number_format($tbase,2)."</td>
        <td align=\"right\">".number_format($timporte,2)."</td>
        <td align=\"right\"></td>
        <td align=\"right\">".number_format($totcomision,2)."</td>
        <td align=\"right\">".number_format($totjef,2)."</td>
        <td align=\"right\">".number_format($totenc,2)."</td>
        <td align=\"right\">".number_format($totimp_sup,2)."</td>
        <td align=\"right\">".number_format($totimp_ger,2)."</td>
        
        <td align=\"left\" colspan=\"1\"><font size=\"+2\">".number_format($totcomision+$totjef+$totenc+$totimp_sup+$totimp_ger,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A FARMACIA 10%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totcomision,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A ENCARGADO 1%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totenc,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A JEFES 0.5% A CADA JEFE, SI HAY MAS DE 2 JEFES SE DIVIDE EL 1% ENTRE TODOS</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totjef,2)."</td>
        </tr> 
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A SUPERVISORES 0.5%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totimp_sup,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A GERENTES 0.3%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totimp_ger,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">TOTAL COMISION</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totcomision+$totjef+$totenc+$totimp_sup+$totimp_ger,2)."</td>
        </tr> 
        </table>
         ";
        
        echo $tabla;
    
    }
//**************************************************************
/////////////////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
   function control_ventas_producto_naturistas($fec,$suc)
    {
        
        $s="select a.* from comision_det a where suc=$suc and fecha='$fec' and motivo='comision' order by puestox";
        echo    "select a.* from comision_det a where suc=$suc and fecha='$fec' and motivo='comision' order by puestox";
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>EMPLEADO PDV<BR />NOMINA</th>
        <th>SE TRANSFIERE</th>
        <th>COMISION</th>
        <th align=\"center\">COM.FINAL</th>
        <th align=\"center\" colspan=\"2\">ENCARGADO</th>
        <th align=\"center\" colspan=\"2\">JEFE</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $totimporte=0;
        $totcomision=0;
   $tot=0;
   $totenc=0;
   $totjef=0;    
        foreach($q->result() as $r)
        {
        $s1="select *from catalogo.cat_empleado where nomina=$r->nueva_nomina and cia=$r->nueva_cia";
        
        $q1=$this->db->query($s1);
        if($q1->num_rows()>0){
        $r1 = $q1->row();
        $nombre=$r1->completo;
        $puestox=$r1->puestox;    
        }else{
        $nombre='-';
        $puestox='-';    
        }   
if($r->tipo=='X')
{
$color='red';$mot='SE PIERDE COMISION, No es transferible el monto';
$comision=0; 
}else{
$color='black';$mot='';
$comision=$r->importe;
}
        $l1 = anchor('ventas/cambia_naturistas_empleado/'.$r->suc.'/'.$fec.'/'.$r->nomina, $r->nomina.' '.$r->completo.'<br />'.$r->puestox.'<br /><font color=red>'.$mot.'</font>');
if($r->tipo=='A'){
$l2 = anchor('ventas/borrar_com/'.$r->suc.'/'.$fec.'/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));
}else{$l2='';}
$tot=$comision+($r->i_enc)+($r->i_jef);		    
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"left\">".$r->nueva_nomina." ".$nombre."<br />".$puestox."<br /> ".$l2."</td>
            <td align=\"right\"><font color='$color'>".number_format($r->importe,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($comision,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->i_enc,2)."</font></td>
            ";
if(trim($r->puestox)<>'MEDICO'){
            $tabla.="
            <td align='right'><font size='-1'><input name='canenc_$r->id' type='text' id='canenc_$r->id' size='7' maxlength='7' aling='center' value='$r->i_enc' /></font></td>
            ";
}else{$tabla.="<td></td>";}
            $tabla.="
            <td align=\"right\"><font color='$color'>".number_format($r->i_jef,2)."</font></td>
            ";

if(trim($r->puestox)<>'MEDICO'){
            $tabla.="
            <td align='right'><font size='-1'><input name='canjef_$r->id' type='text' id='canjef_$r->id' size='7' maxlength='7' value='$r->i_jef' /></font></td>
            ";
}else{$tabla.="<td></td>";}
            $tabla.="
            <td align=\"right\"><font color='$color'>".number_format($tot,2)."</font></td>
            </tr>
            ";
		$totimporte=$totimporte+$r->importe;
     	$totcomision=$totcomision+$comision;
        $totenc=$totenc+$r->i_enc;
        $totjef=$totjef+$r->i_jef;
        }
        $encargado=round($totcomision/100,2);
        $jefe=round($encargado/2,2);
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totimporte,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            <td align=\"right\">".number_format($totenc,2)."</td>
            <td></td>
            <td align=\"right\">".number_format($totjef,2)."</td>
            <td></td>
            <td align=\"right\">".number_format($totcomision+$totenc+$totjef,2)."</td>
            <td align=\"right\"></td>
            </tr>
        </tbody>
        </table>
        
<script language=\"javascript\" type=\"text/javascript\">
$('input:text[name^=\"canenc_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');

    var id = nombre.split('_');
    id = id[1];
    actualiza_encargado(id, valor);

});

function actualiza_encargado(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/ventas/actualiza_enc/\", data: ({ id: id, valor: valor}),
            success: function(data){
        },
        beforeSend: function(data){
        }
        });
}
</script>

<script language=\"javascript\" type=\"text/javascript\">
$('input:text[name^=\"canjef_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');

    var id = nombre.split('_');
    id = id[1];
    actualiza_jefe(id, valor);

});

function actualiza_jefe(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/ventas/actualiza_jef/\", data: ({ id: id, valor: valor }),
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

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
function control_ventas_comision_val($fec)
    {
    
    $id_user=$this->session->userdata('id');            
$s="insert into comision_det(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox,
completo, nueva_nomina, nueva_cia,id_user, fecham,clave)
(select a.suc,a.fecha,d.cia,d.nomina,0,(a.importe*.003),LAST_DAY(now()),'C',0,'comisiong',a.ger,a.sup,d.puesto,e.completo,d.nomina,d.cia,
$id_user,date(now('%Y-%m-%d %H:%i:%s')),150
from comision_ctl a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_comision c on c.tipo=b.tipo2 and comision=farmacia
left join usuarios d on d.plaza=a.ger  and d.activo=1 and nivel=21
left join catalogo.cat_empleado e on e.nomina=d.nomina and e.cia=d.cia
where motivo='comision' and a.importe>=7000 and medico='N' and fecha='$fec' and a.tipo='A') 
on duplicate key update importe=values(importe)";
$this->db->query($s);
$s1="insert into comision_det
(suc, fecha, cia, nomina, dias, importe, aplica, tipo, no_dias, motivo, ger, sup, puestox, completo, nueva_nomina,
 nueva_cia,id_user, fecham,clave)
(select a.suc,a.fecha,d.cia,d.nomina,0,(a.importe*.005),LAST_DAY(now()),'C',0,'comisions',a.ger,a.sup,e.puestox,e.completo,d.nomina,d.cia,
0,date(now('%Y-%m-%d %H:%i:%s')),150
from comision_ctl a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_comision c on c.tipo=b.tipo2 and comision=farmacia
left join usuarios d on d.plaza=a.sup and d.activo=1 and nivel=14 and responsable='R'
left join catalogo.cat_empleado e on e.nomina=d.nomina and e.cia=d.cia
where motivo='comision'  and a.importe>=7000 and medico='N' and fecha='$fec'  and a.tipo='A') 
on duplicate key update importe=values(importe)";
$this->db->query($s1);
                     $uno = array(
                    'tipo'     => 'C'
                    );
                    $this->db->where('fecha', $fec);
                    $this->db->where('motivo', 'comision');
                    $this->db->where('tipo', 'A');
                    $this->db->update('desarrollo.comision_ctl', $uno);
    
                
                     $dos = array(
                    'tipo'     => 'C',
                    'fecham'     => date('Y-m-d H:i:s'),
                    'clave'     => 150,
                    'id_user'     => $id_user
                    );
                    $this->db->where('fecha', $fec);
                    $this->db->where('motivo', 'comision');
                    $this->db->where('tipo', 'A');
                    $this->db->update('desarrollo.comision_det', $dos);
    
$ss="insert into faltante(fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom,  tipo, clave,
observacion, succ, fecpre, fechai, varios)
(select date_sub(LAST_DAY(now()),interval 1 month),0,nueva_nomina, 0,sum(importe+i_enc+i_jef),0,id_user,suc,0,0,nueva_cia,0,2,clave,
case
when motivo='comision' and i_enc>0 and importe>0
then 'COMISION DEL 10 % Y 1% POR SER ENCARGADO DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='comision' and i_jef>0 and importe>0
then 'COMISION DEL 10 % Y 0.5% POR SER JEFE DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='comision' and i_jef=0 and i_enc=0 and importe>0
then 'COMISION DEL 10 % DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='comision' and i_jef>0 and importe=0
then 'COMISION DEL 0.5% POR SER JEFE DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='comision' and i_enc>0 and importe=0
then 'COMISION DEL 1% POR SER ENCARGADO DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='comisions'
then 'COMISION SUPERVISOR DEL 0.5% DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='comisiong'
then 'COMISION GERENTE DEL 0.3% DEL date_sub(LAST_DAY(now()),interval 1 month)'
when motivo='premiog'
then 'PREMIO GERENTE POR VTA ALCANZADA DELdate_sub(LAST_DAY(now()),interval 1 month)'
when motivo='premios'
then 'PREMIO SUPERVISOR POR VTA ALCANZADA DEL date_sub(LAST_DAY(now()),interval 1 month)'

end as obser,
suc,LAST_DAY(now()),date(now()),
CASE when motivo ='comision' or motivo ='comisions' or motivo ='comisiong'
then 1
else
0
end
from comision_det
where fecha='$fec'  and tipo='C' and clave=150 and nueva_nomina>0
group by nueva_cia,nueva_nomina,motivo order by nueva_nomina)";

    
    
    
    
    }
//**************************************************************
//**************************************************************
//**************************************************************
function control_comision_ctl_his($fec)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
      $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as sucx,b.tipo2, sum(c.importe)as com_d,
        case when a.importe>7000 and medico='N' then a.importe*.01  else 0 end as uno ,
        ((a.importe*100)/base)as porce,
         case when ((a.importe*100)/base)>=13 and a.importe>=7000 then a.importe*.003 else 0 end as imp_ger,
         case when ((a.importe*100)/base)>=13 and a.importe>=7000 then a.importe*.005 else 0 end as imp_sup,
        sum(c.i_enc)as enc_d,sum(c.i_jef)as jef_d
        from desarrollo.comision_ctl a
left join catalogo.sucursal b on b.suc=a.suc
left join  desarrollo.comision_det c on c.suc=a.suc and c.motivo=a.motivo and c.fecha=a.fecha and c.tipo='C' and nueva_nomina>0
where a.motivo='comision' and a.fecha='$fec' and a.tipo='C'
group by ger,medico,sup,suc
        ";
       
        $q = $this->db->query($s);
       
        $num=0;
            $tbase=0;
            $timporte=0;
            $totdes=0;
            $totimp_b=0;
            $totimp_b_c=0;
            $totimp_b_c_iva=0;
            $totcomision=0;
            $totsup=0;
            $totenc=0;
            $totger=0;
            $totjef=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th></th>
        <th colspan=\"14\">COMISIONES NATURISTAS</th>
        </tr>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>VTA-IVA<br />
        -T.AIRE<br />DEPTO.CORTES</th>
        <th>IMP.CANC - IVA<br />NATURISTA</th>
        <th colspan=\"1\">% </th>
        <th>COMISION</th>
        <th>COM.<br />JEF</th>
        <th>COM.<br />ENC</th>
        <th>COM.<br />SUP</th>
        <th>COM.<br />GER</th>
        <th>COM.<br />TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
   $totimp_ger=0;
   $totimp_sup=0;     
  $color='blue'; $dif=0;
        foreach($q->result() as $r)
        {
            if($r->base<100000 and $r->base>0){$bgcolor='#E7E0E0';}else{$bgcolor='white';}
        $dif=($r->uno*2)-$r->enc_d-$r->jef_d;
         if($dif>1 ||$dif<'-1'){$color='red';}else{$color='blue';}   
       $num=$num+1;
       $conta=$num;
       $l1 = anchor('ventas/comision_ctl_suc_his/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->sucx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
   
          $tabla.="
            <tr bgcolor=\"$bgcolor\">
            <td align=\"left\"><font color=\"$color\">".$conta."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->base,2)."<br /></font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."<br /></td>
            <td align=\"right\"><font color=\"$color\">% ".number_format($r->porce,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->com_d,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\"><font color=\"orange\">".number_format($r->enc_d,2)."</font><br />".number_format($r->uno,2)."</font></td>
            <td align=\"right\"><font color=\"green\"><font color=\"orange\">".number_format($r->jef_d,2)."</font><br />".number_format($r->uno,2)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->imp_sup,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->imp_ger,2)."<br /></font></td>
            <td align=\"right\"><font color=\"green\"><strong>
            ".number_format(($r->com_d)+($r->jef_d)+($r->enc_d)+($r->imp_sup)+($r->imp_ger),2)."<br /></strong></font></td>
            </tr>
            ";
           $tbase=$tbase+$r->base;
           $timporte=$timporte+$r->importe;
           $totcomision=$totcomision+$r->com_d;
           $totjef=$totjef+$r->jef_d;
           $totenc=$totenc+$r->enc_d;
           $totimp_sup=$totimp_sup+$r->imp_sup;
           $totimp_ger=$totimp_ger+$r->imp_ger;
        }
         $tabla.="
        </tbody>
        <tr>
        <th></th>
        <th></th>
        <th>VTA-IVA<br />
        -T.AIRE<br />DEPTO.CORTES</th>
        <th>IMP.CANC - IVA<br />NATURISTA</th>
        <th colspan=\"1\">% </th>
        <th>COMISION</th>
        <th>COM.<br />JEF</th>
        <th>COM.<br />ENC</th>
        <th>COM.<br />SUP</th>
        <th>COM.<br />GER</th>
        <th>COM.<br />TOTAL</th>
        </tr>
        <tr>
        <td align=\"right\" colspan=\"2\">TOTAL</td>
        <td align=\"right\">".number_format($tbase,2)."</td>
        <td align=\"right\">".number_format($timporte,2)."</td>
        <td align=\"right\"></td>
        <td align=\"right\">".number_format($totcomision,2)."</td>
        <td align=\"right\">".number_format($totjef,2)."</td>
        <td align=\"right\">".number_format($totenc,2)."</td>
        <td align=\"right\">".number_format($totimp_sup,2)."</td>
        <td align=\"right\">".number_format($totimp_ger,2)."</td>
        
        <td align=\"left\" colspan=\"1\"><font size=\"+2\">".number_format($totcomision+$totjef+$totenc+$totimp_sup+$totimp_ger,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A FARMACIA 10%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totcomision,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A ENCARGADO 1%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totenc,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A JEFES 0.5% A CADA JEFE, SI HAY MAS DE 2 JEFES SE DIVIDE EL 1% ENTRE TODOS</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totjef,2)."</td>
        </tr> 
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A SUPERVISORES 0.5%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totimp_sup,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">COMISION A GERENTES 0.3%</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totimp_ger,2)."</td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"4\"><font size=\"+2\">TOTAL COMISION</td>
        <td align=\"right\" colspan=\"2\"><font size=\"+2\">".number_format($totcomision+$totjef+$totenc+$totimp_sup+$totimp_ger,2)."</td>
        </tr> 
        </table>
         ";
         echo $tabla;
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function control_comision_ctl_suc_his($suc,$fec)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*,b.completo,b.puestox,c.completo as completon,c.puestox as puestonx
       from desarrollo.comision_det a 
       left join catalogo.cat_empleado b on b.nomina=a.nomina and a.cia=b.cia and b.tipo=1
       left join catalogo.cat_empleado c on c.nomina=a.nueva_nomina and a.nueva_cia=c.cia and c.tipo=1
       where a.fecha='$fec' and a.suc=$suc and motivo like '%comision%' and a.tipo='C' and nueva_nomina>0";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">NOMINA</th>
        <th colspan=\"1\">NOMBRE</th>
        <th colspan=\"1\">PUESTO</th>
        <th colspan=\"1\">COMISION</th>
        <th colspan=\"1\">TRANSFERIDO A</th>
        </tr>
        ";
        $color='black';
        $num=0;
        $tot=0;
        $comision=0;
         foreach($q->result() as $r)
        {
        if($r->nomina<>$r->nueva_nomina){$color='red';}else{$color='black';}
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
               
        
        $num=$num+1; 
        $comision=$r->importe+$r->i_jef+$r->i_enc;
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->nomina."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->completo."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->puestox."</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($comision,2)."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->nueva_nomina." ".$r->completon."</font></font></td>
             </tr>
         ";
         $tot=$tot+$comision;
         $comision=0;
         }
         $tabla.="
         </tbody>
         <tr>
            <td align=\"right\" colspan=\"4\"><font size=\"1\" color=\"$color\">TOTAL</font></font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($tot,2)."</font></font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\"></font></font></td>
             </tr>
            </table>";


        return $tabla;
       
}
//**************************************************************
//**************************************************************








































//**************************************************************
//**************************************************************
   function control_ventas_medico_naturistas($fec)
    {
        
        $s="SELECT b.suc, a.*,b.importe,b.puestox,c.nombre as turno1, d.nombre as turno2
FROM catalogo.cat_medicos  a
left join comision_det b on a.nomina=b.nomina
left join catalogo.sucursal c on c.suc=matutino
left join catalogo.sucursal d on d.suc=a.vespertino
where matutino=vespertino and b.suc is not null and b.tipo<>'X' and importe<750 and b.fecha='$fec'
order by importe
";   
 		$q = $this->db->query($s);
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>EMPLEADO(A)<BR />NOMINA</th>
        <th>TURNO 1</th>
        <th>TURNO 2</th>
        <th>COMISION</th>
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
        $color='blue';
        foreach($q->result() as $r)
        {
        $ss="select a.nomina,
case
when tiket between turno1_folio1 and turno1_folio2
then 1
when tiket between turno2_folio1 and turno2_folio2
then 2
when tiket between turno3_folio1 and turno3_folio2
then 3
else
0
end as turno,sum(importe-(can*iva))as imp,
b.turno1_folio1,b.turno1_folio2,b.turno1_folio2,b.turno2_folio2,a.suc,a.fecha,a.tiket,codigo,can,importe

from vtadc.venta_detalle_nat a
left join cortes_c b on b.suc=a.suc and a.fecha=b.fechacorte
where
   date_format(a.fecha,'%Y-%m')='$fec' and a.nomina=$r->nomina group by a.nomina,turno,a.suc";
$qq=$this->db->query($ss);
        $num=$num+1;
         
        $l1 = anchor('ventas/venta_medico_naturistas_empleado/'.$r->suc.'/'.$fec.'/'.$r->nomina, $r->nomina.' '.$r->nombre.'<br /> '.$r->puestox);
		    
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">$l1</td>
            <td align=\"left\"><font color='$color'>".$r->matutino." ".$r->turno1."</font></td>
            <td align=\"left\"><font color='$color'>".$r->vespertino." ".$r->turno1."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->importe,2)."</font></td>
            </tr>
            ";
  foreach($qq->result() as $rr)
        {
        $tabla.="
            <tr>
            <td align=\"right\" colspan=\"4\">TURNO ".$rr->turno."</td>
            <td align=\"right\"><font color='$color'>".number_format($rr->imp,2)."</font></td>
            </tr>
            ";    
        }
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            
            <td align=\"right\"></td>
            </tr>
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************










































































































































































































































































































































  function comision()
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*
       from desarrollo.cortes_g a
       where tipo>=2
       group by fecha";
        $q = $this->db->query($s); 
 $color='#F9075C';        
$totgere=0;
$totsup=0;

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th></th>
        <th>MOVIMIENTO</th>
        <th>CON PREMIO VENTA</th>
        <th>CON COMISION NATURISTAS</th>
        <th>SIN PREMIO NI COMISION </th>
        <th>BORRAR</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $num=1;
        foreach($q->result() as $r)
        {
             if($r->tipo==2){
             $l0 = anchor('ventas/calculo_comision_detalle/'.$r->fecha, 'GENERAR', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l1='';
             $l2='';
             $l3='';
             $color='red';
             }
             if($r->tipo==3){
             $l0 = anchor('ventas/calculo_comision_val/'.$r->fecha, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
             $l1 = anchor('ventas/comision_det/'.$r->fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l1x = anchor('ventas/comision_det_nat/'.$r->fecha, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l2 = anchor('ventas/comision_det_sin/'.$r->fecha, '<img src="'.base_url().'img/no.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l3 = anchor('ventas/calculo_comision_bor/'.$r->fecha, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
             $color='black';   
             }
             if($r->tipo==4){
             $l0 = '';
             $l1 = anchor('ventas/comision_det/'.$r->fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l1x = anchor('ventas/comision_det_nat/'.$r->fecha, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l2 = anchor('ventas/comision_det_sin/'.$r->fecha, '<img src="'.base_url().'img/no.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             $l3 = '';
             $color='gray';   
             }
             
        
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"4\" color=\"$color\"> VENTAS MENSUALES PARA COMISIONES DE ".$r->fecha."</font></td>
            <td align=\"center\"><font color=\"$color\">$l0</font></td>
            <td align=\"center\"><font color=\"$color\">$l1</font></td>
            <td align=\"center\"><font color=\"$color\">$l1x</font></td>
            <td align=\"center\"><font color=\"$color\">$l2</font></td>
            <td align=\"center\"><font color=\"$color\">$l3</font></td>
            </tr>
            ";
            $num=$num+1;
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
 function comision_det($fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
       $s = "select a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,
       (select sum(aa.siniva)from desarrollo.cortes_g aa where fecha='$fecha' and aa.suc=a.suc and aa.clave1<>20)as total_vta
       from desarrollo.cortes_g a
       
       where
       fecha='$fecha' and a.tipo2<>'F' and clave1=10 and tipo>2
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=11 and tipo>2
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=16 and tipo>2
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=24 and tipo>2
       group by suc
       order by tipo2,siniva desc
       ";
       
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
$cosup1 = anchor('ventas/imprimir_det_sup1/'.$fecha, '<font size="2"> IMPRIME SUPERVISOR</font>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
$cog1 = anchor('ventas/imprimir_det_ger1/'.$fecha, '<font size="2"> IMPRIME GERENTE</font>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"5\">$cosup1</th>
        <th colspan=\"5\">$cog1</th>
        </tr>
        <tr>
        <th></th>
        <th></th>
        <th align=\"center\" colspan=\"3\"><strong>Venta</strong></th>
        <th align=\"center\" colspan=\"2\">COMISION</th>
        <th></th>
        
        </tr>
        
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Total</th>
        <th>Historico <br />Gontor e Imperial</th>
        <th>Gontor e Imperial</th>
        <th align=\"center\">Vta<br />Dias</th>
        <th align=\"center\">Incremento<br />Dias</th>
        <th></th>
        </tr>
        <tbody>
        ";
        
  
        $num=0;
        $sup=0;
        $ger=0;
        $nat_ger=0;
        $nat_sup=0;
         $color='black';
        foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        if($r->his_vta>0){$dif=$r->siniva-$r->his_vta;}
        if($dif>=15000 and $dif<=19999){$incremento=15;}
        if($dif>=20000 and $dif<=24999){$incremento=20;}
        if($dif>=25000){$incremento=25;}
        if($r->his_vta==0 and $r->siniva>=100000 and $r->tipo2=='G'){$incremento=30;}
        if($r->his_vta==0 and $r->siniva>=150000 and $r->tipo2=='D'){$incremento=30;}
        $l1 = anchor('ventas/imprimir_det1/'.$fecha.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
         $sx1 = "select *from catalogo.cat_comision  where tipo='$r->tipo2' and $r->siniva between monto1 and monto2";
        $qx1 = $this->db->query($sx1);
        if($qx1->num_rows() > 0){    
        $rx1=$qx1->row();
        $farmacia=$rx1->farmacia;
        $ger=$ger+$rx1->gere;
        $sup=$sup+$rx1->sup;
        }     
if($farmacia>0 || $incremento>0){
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->tipo2." ".str_pad( $r->suc,4,"0",STR_PAD_LEFT)." - ".$r->sucx."<br /><font color=\"gray\">".$r->diac." - ".$r->diad."</font></font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->total_vta,2)."<br />_</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->his_vta,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->siniva,2)."</font></td>
            
            <td align=\"right\"><font size=\"1\" color=\"blue\">".$farmacia."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"red\">".$incremento."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            
             </tr>
            ";
         }
         }
         $tabla.="
        
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
 function comision_det_nat($fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,(vta_naturista*100)/sum(a.siniva) as porce
       from desarrollo.cortes_g a
where clave1<>20 and fecha='$fecha' and a.tipo2<>'F' and vta_naturista>=7000
group by suc
       order by tipo2,porce desc
       ";
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
$cosup2 = anchor('ventas/imprimir_det_sup2/'.$fecha, '<font size="2"> IMPRIME SUPERVISOR ENERGIA Y VIDA</font>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
$cog2 = anchor('ventas/imprimir_det_ger2/'.$fecha, '<font size="2"> IMPRIME GERENTE ENERGIA Y VIDA</font>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));

       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
         <th colspan=\"3\">$cosup2</th>
        <th colspan=\"3\">$cog2</th>
         </tr>
         <tr>
        <th></th>
        <th></th>
        <th align=\"center\" colspan=\"2\"><strong>Venta</strong></th>
        <th align=\"center\" colspan=\"1\">Premios</th>
        <th></th>
        
        </tr>
        
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Total</th>
        <th>Naturista</th>
        <th align=\"center\">Naturista<br />%</th>
        <th></th>
        </tr>
        <tbody>
        ";
        
  
        $num=0;
        $sup=0;
        $ger=0;
        $nat_ger=0;
        $nat_sup=0;
         $color='black';
        foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        $l1 = anchor('ventas/imprimir_det2/'.$fecha.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
               
        if($r->porce>=13){
            $porce_natur=10;
            $nat_ger=$nat_ger+($r->vta_naturista*.03);
            $nat_sup=$nat_sup+($r->vta_naturista*.05);
            
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->tipo2." ".str_pad( $r->suc,4,"0",STR_PAD_LEFT)." - ".$r->sucx."<br /><font color=\"gray\">".$r->diac." - ".$r->diad."</font></font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->siniva,2)."<br />_</font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->vta_naturista,2)."<br />% ".number_format($r->porce,2)."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$porce_natur."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            
             </tr>
            ";
         }
         }
         $tabla.="
         
         
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////

 function comision_det_sin($fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,
       (select sum(aa.siniva)from desarrollo.cortes_g aa where fecha='$fecha' and aa.suc=a.suc and aa.clave1<>20)as total_vta
       from desarrollo.cortes_g a
       
       where
       fecha='$fecha' and a.tipo2<>'F' and clave1=10 and tipo>2
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=11 and tipo>2
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=16 and tipo>2
       or
       fecha='$fecha' and a.tipo2<>'F' and clave1=24 and tipo>2
       group by suc
       order by tipo2,siniva desc
       ";
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
       $tabla= "
        <table cellpadding=\"3\">
        <tr>
        <th></th>
        <th></th>
        <th align=\"center\" colspan=\"5\"><strong>Venta</strong></th>
        </tr>
        
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Total</th>
        <th>Naturista</th>
        <th>Historico <br />Gontor e Imperial</th>
        <th>Gontor e Imperial</th>
        <th></th>
        </tr>
        <tbody>
        ";
        
 
        $num=0;
        foreach($q->result() as $r)
        {

        $farmacia=0;
        $incremento=0;
        $l1 = anchor('ventas/imprimir_det1/'.$fecha.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
        if($r->vta_naturista>0){$porce=round(($r->vta_naturista*100)/$r->total_vta,2);}else{$porce=0;}
        $sx1 = "select *from catalogo.cat_comision  where tipo='$r->tipo2' and $r->siniva between monto1 and monto2";
        $qx1 = $this->db->query($sx1);
        if($qx1->num_rows() > 0){    
        $rx1=$qx1->row();
        $farmacia=$rx1->farmacia;
        }        
        $sx2 = "select *from catalogo.cat_comision  where $r->siniva between incremento2 and incremento1 and  tipo='$r->tipo2'";
        $qx2 = $this->db->query($sx2);
        if($qx2->num_rows() > 0 and $r->his_vta > $r->siniva and $r->his_vta>0){    
        $rx2=$qx2->row();
        $incremento=$rx2->dias;
        }
if($r->his_vta==0 and $r->siniva>=100000 and $r->tipo2=='G'){$incremento=30;}
if($r->his_vta==0 and $r->siniva>=150000 and $r->tipo2=='D'){$incremento=30;}

if($farmacia==0 and $incremento==0){
    
        $num=$num+1; 
         $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->tipo2." ".str_pad( $r->suc,4,"0",STR_PAD_LEFT)." - ".$r->sucx."<br /><font color=\"gray\">".$r->diac." - ".$r->diad."</font></font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->total_vta,2)."<br />_</font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->vta_naturista,2)."<br />% ".number_format($porce,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->his_vta,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->siniva,2)."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            
            
             </tr>
            ";
         }
         }
         $tabla.="
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function comision_empleado_val($fecha){

$new_member_insert_data = array(
            'tipo'      =>4            
		);
        $this->db->where('fecha', $fecha);
        $this->db->update('desarrollo.cortes_g', $new_member_insert_data);    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function comision_empleado_bor($fecha){
$new_member_insert_data = array(
            'tipo'      =>2            
		);
        $this->db->where('fecha', $fecha);
        $this->db->update('desarrollo.cortes_g', $new_member_insert_data);
$this->db->delete('vtadc.comision', array('fecha' => $fecha));  
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////






























//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}