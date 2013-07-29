<?php
class Audita_model extends CI_Model
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
    function control_cortes($fec)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $mes=substr($fec,5,2);
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $sql = "select a.suc,a.nombre as sucx, b.nombre as usua ,c.nombre as cortes,b.puesto
        from catalogo.sucursal a 
        left join usuarios b on b.id=a.user_id
        left join usuarios c on c.id=a.gere
        where tlid=1 and a.suc>100 and a.suc<1999 order by  suc";
        $query = $this->db->query($sql);
$a="select *from catalogo.mes where num=$mes";
$b=$this->db->query($a);
$c=$b->row();
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>D.MES</th>
        <th>D.TRANS.</th>
        <th>CONTADOR</th>
        <th>PLAZA</th>
        <th>CORTES</th>
        
        <th></th>
        

        </thead>
        <tbody>
        ";
          foreach($query->result() as $row)
        {
        $s = "select count(fechacorte)as dias from cortes_c a where date_format(a.fechacorte, '%Y-%m')=? and a.suc= $row->suc group by suc";
        $q = $this->db->query($s,array($fec));
        if($q->num_rows() > 0){
            $r=$q->row();$dias=$r->dias;
            $l1 = anchor('audita/tabla_control_cortes_bloque_det/'.$row->suc.'/'.$fec, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            }else{$dias=0;$l1='';}
            
if($c->dos<>$dias){$color='red';}else{$color='black';}
            
            $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$num."<font/></td>
            <td align=\"left\"><font color=\"$color\">".$row->suc." - ".$row->sucx."<font/></td>
            <td align=\"center\"><font color=\"$color\">".$c->dos."<font/></td>
            <td align=\"center\"><font color=\"$color\">".$dias."<font/></td>
            <td align=\"left\"><font color=\"$color\">".$row->usua."<font/></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."<font/></td>
            <td align=\"left\"><font color=\"$color\">".$row->cortes."<font/></td>
            <td align=\"right\"><font color=\"$color\">".$l1."<font/></td>
            
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
   function control_cortes_det($suc,$fec)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        
        $sql = "select a.*,b.nombre,b.puesto 
        from cortes_c a 
        left join usuarios b on b.id=a.id_user 
        where  a.suc=? and date_format(a.fechacorte, '%Y-%m')=?";
        $query = $this->db->query($sql,array($suc,$fec));
        $l0='';
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>FECHA DEL CORTE</th>
        <th>LIN.20</th>
        <th>COMANCHE</th>
        <th>STATUS</th>
        <th>RESPONSABLE DEL CORTE</th>
        <th>CONTABILIDAD</th>

        </thead>
        <tbody>
        ";
        // date_format(a.fechacorte, '%Y-%m')
        foreach($query->result() as $row)
        {
         $s="select *from cortes_d where clave1=20 and id_cc=$row->id";
         $q=$this->db->query($s);
         if($q->num_rows() > 0){
            $r=$q->row();
            $telcel=$r->corregido;}else{$telcel=0;}
            
        $fecha=$row->fechacorte;    
        $recarga=$this->ta($suc,$fecha);    
        if($row->tipo==2){$tipox='RECIBIDO SIN TRABAJAR';}
        if($row->tipo>2){$tipox='TRABAJADO Y REVISADO';}
        
        if($telcel==$recarga){$color='#070101';}else{$color='#FC0909';}
        
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$row->fechacorte."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($telcel,2)."</font></td>
             <td align=\"right\"><font size=\"1\" color=\"$color\">".number_format($recarga,2)."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$tipox."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$row->puesto."</font></td>
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

    public function ta($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
$client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false);
$client->soap_defencoding = 'UTF-8';

$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
// This is an archaic parameter list
$params = array(
                    'user'		    => 'ivankruel',
                    'password'		=> 'garigol',
                    'sucursal'      => $sucursal,
                    'fecha'         => $fecha
                    );


$result = $client->call('MontoSucursalDia', $params, 'http://ResultadoWSDL', 'ResultadoWSDL#MontoSucursalDia');

if ($client->fault) {
	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
        return $result['monto'];
        
	}
}

    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_decena($decena,$fec1,$fec2)
    {
        $num=1;
        $fecha= date('Y-m-d');
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $sql = "SELECT a.id_cc, lin_g,sum(a.siniva)as venta,c.linx
FROM cortes_d a
left join cortes_c b on b.id=a.id_cc
left join catalogo.gerencia_lin  c on c.id=a.lin_g
where a.clave1>0 and a.clave1<30 and date(b.fechacorte)>='$fec1'and date(b.fechacorte)<='$fec2' group by a.lin_g";
        $query = $this->db->query($sql);

       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>LIN</th>
        <th>DESCRIPCION</th>
        <th>IMPORTE</th>
        <th></th>
        

        </thead>
        <tbody>
        ";
          foreach($query->result() as $row)
        {
            $l1 = anchor('audita/tabla_control_cortes_bloque_det/'.$row->lin_g.'/'.$fec1, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            

            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            
            <td align=\"left\">".$row->lin_g."</td>
            <td align=\"left\">".$row->linx."</td>
            
            <td align=\"right\">".number_format($row->venta,2)."</td>
            <td align=\"right\">".$l1."</td>
            
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
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
   function pre_comision_cortes($aaa,$mes)
    {
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        //$this->__comision_empleado($fec);
        //die();    
        if($mes==1){$campo='importe_act_1';}
        elseif($mes==2){$campo='importe_act_2';}
        elseif($mes==3){$campo='importe_act_3';}
        elseif($mes==4){$campo='importe_act_4';}
        elseif($mes==5){$campo='importe_act_5';}
        elseif($mes==6){$campo='importe_act_6';}
        elseif($mes==7){$campo='importe_act_7';}
        elseif($mes==8){$campo='importe_act_8';}
        elseif($mes==9){$campo='importe_act_9';}
        elseif($mes==10){$campo='importe_act_10';}
        elseif($mes==11){$campo='importe_act_11';}
        elseif($mes==12){$campo='importe_act_12';}
  
 $s = "select a.nombre,a.tipo2,a.suc,a.his_venta
from catalogo.sucursal a
where a.suc>100 and a.suc<1604 and a.tlid=1
";
        $q = $this->db->query($s); 
        foreach($q->result() as $r)
        {
        $sx="SELECT sum($campo)as campo FROM vtadc.fe_prox_det asa where asa.lab='NATURISTAS' and asa.suc=$r->suc group by asa.suc";
        $qx = $this->db->query($sx); 
        if($qx->num_rows() == 1){$rx=$qx->row();$campo_vta=$rx->campo;}else{$campo_vta=0;}
       
         $svta = "SELECT count(*)as diasd FROM vtadc.venta_ctl where suc=$r->suc and date_format(fecha,'%Y-%m')='$fec'";
        $qvta = $this->db->query($svta);
        if($qvta->num_rows() > 0){
        $rvta=$qvta->row();
        $diasd=$rvta->diasd;
        }else{$diasd=0;}
        $svta = "SELECT count(*)as diasc FROM cortes_c where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec'";
        $qvta = $this->db->query($svta);
        if($qvta->num_rows() > 0){
        $rvta=$qvta->row();
        $diasc=$rvta->diasc;
        }else{$diasc=0;}   
         $stotal = "
         select aa.suc,clave1,sum(bb.corregido)as corregido,sum(bb.siniva)as siniva
from cortes_c aa
join cortes_d bb on bb.id_cc=aa.id
where aa.suc=$r->suc and  aa.tipo>2 and date_format(aa.fechacorte,'%Y-%m')='$fec' and clave1<>49
group by aa.suc,bb.clave1
         ";
        $qtotal = $this->db->query($stotal);
         if($qtotal->num_rows() > 0){
        foreach($qtotal->result() as $rtotal)
        {
            //suc, fecha, clave1, corregido, siniva, fechag, tipo2, his_vta
         $new_member_insert_data = array(
			'tipo2'     =>$r->tipo2,
            'fecha'     =>$fec,
            'suc'       =>$r->suc,
            'sucx'      =>$r->nombre,
            'his_vta'   =>$r->his_venta,
            'clave1'    =>$rtotal->clave1,
            'corregido' =>$rtotal->corregido,
            'siniva'    =>$rtotal->siniva,
            'fechag'    =>date('Y-m-d H:i:s'),
            'diad'      =>$diasd,
            'diac'      =>$diasc,
            'vta_naturista'=>$campo_vta,
            'tipo'      =>1            
		);
        $insert = $this->db->insert('desarrollo.cortes_g', $new_member_insert_data);   
        }
         
        }else{
         $new_member_insert_data = array(
			'tipo2'     =>$r->tipo2,
            'fecha'     =>$fec,
            'suc'       =>$r->suc,
            'sucx'      =>$r->nombre,
            'his_vta'   =>0,
            'clave1'    =>0,
            'corregido' =>0,
            'siniva'    =>0,
            'fechag'    =>date('Y-m-d H:i:s'),
            'diad'      =>$diasd,
            'diac'      =>$diasc,
            'vta_naturista'=>$campo_vta,
            'tipo'      =>1            
		);
        $insert = $this->db->insert('desarrollo.cortes_g', $new_member_insert_data);     
        
        }
        }
        
        
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function comision()
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*
       from desarrollo.cortes_g a
       group by fecha order by fecha desc";
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
        <th>Borrar</th>
        <th>Ver</th>
        <th>validar</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $num=1;
        foreach($q->result() as $r)
        {
            $l1 = anchor('audita/comision_det/'.$r->fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
            if($r->tipo==1){
            $l0 = anchor('audita/borra_comision_detalle/'.$r->fecha, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l2 = anchor('audita/valida_comision_detalle/'.$r->fecha, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            $color='red';
            }else{
            $color='black';
            $l0='';
            $l2='';         
            }
        
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"3\" color=\"$color\"> CORTES GENERADOS DE ".$r->fecha."</font></td>
            <td align=\"center\"><font color=\"$color\">$l0</font></td>
            <td align=\"center\"><font color=\"$color\">$l1</font></td>
            <td align=\"center\"><font color=\"$color\">$l2</font></td>
            
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
 function comision_det($fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $mes=substr($fecha,5,2);
        echo $fecha;
       $s = "select a.id,a.diad,a.diac,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,sum(corregido)total_vta,b.dos
       from desarrollo.cortes_g a
       left join catalogo.mes b on b.num=$mes
       where  fecha='$fecha'  group by suc
       order by diac,suc
       ";
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
$co = anchor('ventas/genera_comision/'.$fecha, '<font size="2"> GENERA DETALLE POR EMPLEADO</font>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"10\">$co</th>
         </tr>
        
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>VTA CON IVA</th>
        <th>VTA SIN IVA</th>
        <th>DIAS CAPTURADOS</th>
        <th>DIAS DEL MES</th>
        
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
        $l1 = anchor('ventas/imprimir_det/'.$fecha.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
        $num=$num+1; 
         if($r->diac <> $r->dos){$color='red';}else{$color='black';}
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->tipo2." - ".str_pad( $r->suc,4,"0",STR_PAD_LEFT)." - ".$r->sucx."</font></font></td>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".number_format($r->total_vta,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".number_format($r->siniva,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$r->diac."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$r->dos."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$l1."</font></td>
            
             </tr>
            ";
        
         }
            
$tabla.="</table>";


        return $tabla;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function valida_comision_cortes($fecha){

$new_member_insert_data = array(
            'tipo'      =>2            
		);
        $this->db->where('fecha', $fecha);
        $this->db->update('desarrollo.cortes_g', $new_member_insert_data);    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function borra_comision_cortes($fecha){

$this->db->delete('desarrollo.cortes_g', array('fecha' => $fecha,'tipo' => 1));  
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos()
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
       
        <table cellpadding=\"3\">
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
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
$l1 = anchor('audita/tabla_depositos_cia/'.$r->mes, $r->mesx, array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
    
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
        </table>";
        return $tabla;
       
}
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos_cia($mes)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$aaa=date('Y');        
       $s = "SELECT a.cia,b.razon,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
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
left join catalogo.compa b on b.cia=a.cia
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes  and a.suc>100
group by cia
order by a.cia

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
        <tr>
        <th colspan=\"1\">#</th>
        <th colspan=\"1\">CIA</th>
        <th colspan=\"1\">COMPA&Ntilde;IA</th>
        <th colspan=\"1\">MONEDA NACIONAL</th>
        <th colspan=\"1\">CONV.DE DOLAR</th>
        <th colspan=\"1\">VALES</th>
        <th colspan=\"1\">TARJETA BBV</th>
        <th colspan=\"1\">TARJETA SANTANDER</th>
        <th colspan=\"1\">TARJETA <br />AMERICAN EXP</th>
        <th colspan=\"1\">TOTAL</th>
        </tr>
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        
$l1 = anchor('audita/tabla_depositos_cia_suc/'.$mes.'/'.$r->cia, $r->razon, array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
    
        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"$color\">".$r->cia."</font></font></td>
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
        </table>";
        return $tabla;
       
}
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos_cia_suc($mes,$cia)
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
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes and a.cia=$cia and a.suc>100
group by a.suc
order by a.suc

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
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
        ";
        $color='black';
        $num=0;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
         foreach($q->result() as $r)
        {
            $l1 = anchor('audita/tabla_depositos_cia_suc_dia/'.$mes.'/'.$cia.'/'.$r->suc, $r->sucx, array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
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
        </table>";
        return $tabla;
       
}
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_depositos_cia_suc_dia($mes,$cia,$suc)
{
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$aaa=date('Y');        
       $s = "SELECT a.fechacorte,a.cia,a.suc,a.cia,b.nombre as sucx,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
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
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes and a.cia=$cia and a.suc=$suc
order by a.fechacorte

";
        $q = $this->db->query($s); 
    
       $tabla= "
       
        <table cellpadding=\"3\">
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
        </table>";
        return $tabla;
       
}
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//**************************************************************
//**************************************************************
function pru()
{
    return $this->ta(906,'2011-12-05');
    
}
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}