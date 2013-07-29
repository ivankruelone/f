<?php
class Pedidos_model extends CI_Model
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
    function control()
    {
        $dianombre=date('D');  
       // $dianombre='VIE';
        $num=0;
        $numx=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
if($nivel==10){
        $l0 = anchor('pedido/imprime_pedidos_ctl_fol', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" />IMPRIME CONCENTRADO</a>', array('title' => 'Haz Click aqui para imprimir 0-5!', 'class' => 'encabezado'));       
        $l0x = anchor('pedido/imprime_pedidos_ctl_fal', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" />IMPRIME SUCURSALES FALTANTES</a>', array('title' => 'Haz Click aqui para imprimir Sucursales faltantes!', 'class' => 'encabezado'));
        $l00 = anchor('pedido/imprime_pedidos_ctl_sec', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" />IMPRIME CONCENTRADO POR SEC</a>', array('title' => 'Haz Click aqui para imprimir 0-5!', 'class' => 'encabezado'));
        $l000 = anchor('contacto/imprime_pedidos', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" />Genera los documentos pdf</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
}else{
$l0='';
$l0x='';
$l00='';
$l000='';    
}
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"8\">$l000</th>
        </tr>
        <tr>
        <th colspan=\"4\">$l0</th>
        <th colspan=\"4\">$l0x</th>
        </tr>
        <tr>
        <th colspan=\"8\">$l00</th>
        </tr>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>FECHA</th>
        <th>FOLIO</th>
        <th>CANTIDAD</th>
        <th>IMPRESION</th>
        <th>BORRAR</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*,d.nombre as sucx,d.dia,b.mue,sum(b.ped) as ped,b.fechas as trasmitio
          FROM catalogo.folio_pedidos_cedis a
          left join desarrollo.pedidos b on b.fol=a.id
          left join catalogo.sucursal d on d.suc=a.suc
          where a.fechas between '$fecha' and '$fecha 23:59:59' and (tid='A' or tid='C') 
          group by a.id
          order by a.id";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       
       if($r->mue==6){
       
       $l1 = anchor('pedido/imprime_pedidos_06/'.$r->id.'/'.$r->suc, '<font size="-1" color= "#FA0606">Mueble 6</font><img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir 6!', 'class' => 'encabezado', 'target' => '_blank')); 
       }else{
       $num=$num+1;
       $numx=$numx+1;
       $l1 = anchor('pedido/imprime_pedidos/'.$r->id.'/'.$r->suc, 'Mueble 5<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir 0-5!', 'class' => 'encabezado', 'target' => '_blank'));  
       }
       
       $lll = anchor('pedido/imprime_pedidos_pagina/'.$r->id.'/'.$r->suc, 'Mueble 5<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir 0-5!', 'class' => 'encabezado', 'target' => '_blank'));    
 if($nivel==10){  
           $l3 = anchor('pedido/borrar_pedidos/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado', 'id' => 'borra_pedido_'.$r->id));
}else{
$l3='';    
}           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->suc." - ".$r->sucx."</td>
            <td align=\"right\">".$r->trasmitio."</td>
            <td align=\"right\">".$r->id."</td>
            <td align=\"right\">".$r->ped."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l3."</td>
            <td align=\"right\">".$lll."</td>
            </tr>
            ";
         
        }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

      
        $sx = "SELECT * FROM 
        catalogo.sucursal 
        where dia='$diax' and suc not in (select suc from pedidos  where fol<11000000 and  date(fechas)=date(now()))";
        $qx = $this->db->query($sx);
        foreach($qx->result() as $rx)
        {    
          $num=$num+1;  
           $l1 = '';
           $l2 = '';
           $l3 = '';
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$rx->suc." - ".$rx->nombre."</td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            <td align=\"right\">".$l3."</td>
            
            
            </tr>
            ";
        
        }
        
        
        
        $tabla.="
        </tbody>
        <tr>
            
          
            <td align=\"left\" colspan=\"8\" ><font size=\"3\" color=\"#0D28AE\">PEDIDOS RECIBIDOS <strong>".$numx."</strong></font></td>
            
            
            </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function imprime_en_pagina($fol,$cabe)
    {
$e='';
$f='';
$totfal=0; 
       $s = "select * from pedidos where fol = $fol and tipo = 1 and ped > 0  and mue <> 6  and invcedis>0 order by mue, sec";
        $q = $this->db->query($s);
        $numrows = $q->num_rows();
        $e=$cabe;
        if($numrows > 0){
        
           $e.="<table border=\"1\" cellpadding=\"1\">
           <tr>
           <th width=\"40\" align=\"center\"><strong></strong></th>
           <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
          </tr>
          
          ";
        
        
         foreach($q->result() as $r)
         {
          $sx = "select *from catalogo.almacen where sec=$r->sec and tsec='G'";
          $qx = $this->db->query($sx);   
          if($qx->num_rows() > 0){
            $rx=$qx->row();
            $des=$rx->susa2;
            if($rx->persona=='LE'){$per='GENERICO';}if($rx->persona=='MA'){$per='ALEJANDRA';}if($rx->persona=='ES'){$per='MAYORISTA';}
            if($rx->persona=='KI'){$per='MAT.CUR';}
            
            }else{
            $des='';    
            }
       $e.="
            <tr>
            <td width=\"40\" align=\"center\">".$per."</td>
            <td width=\"40\" align=\"center\">".$r->mue."</td>
            <td width=\"40\" align=\"left\">".$r->sec."</td>
            <td width=\"310\" align=\"left\">".$r->susa."</td>
            <td width=\"220\" align=\"left\">".$des."</td>
            <td width=\"70\" align=\"right\">".number_format($r->ped,0)."</td>
            </tr>
            ";   
            
         
        $totfal=$totfal+$r->ped; 
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"610\" align=\"right\"><strong>TOTAL CANTIDAD</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totfal,0)."</strong></td>
         </tr>
        </table>";
echo $e;
die();
    }
    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function delete_member($fol)
    {
         $sql = "SELECT * FROM pedidos where fol = ? ";
        $query = $this->db->query($sql,array($fol));
        foreach($query->result() as $row)
        {

     $new_member_insert_data = array(
        'suc'=>$row->suc, 
        'fecha'=>$row->fecha, 
        'sec'=>$row->sec, 
        'can'=>$row->can, 
        'fechas'=>$row->fechas, 
        'id'=>$row->id, 
        'tipo'=>$row->tipo, 
        'mue'=>$row->mue, 
        'susa'=>$row->susa, 
        'ped'=>$row->ped, 
        'fol'=>$row->fol, 
        'bloque'=>$row->bloque, 
        'tsuc'=>$row->tsuc
		);
		$insert = $this->db->insert('desarrollo.pedidos_borrados', $new_member_insert_data);
        }
        
        
         
         $data = array(
			'tid'    =>'X'
		);
		$this->db->where('id', $fol);
        $this->db->update('catalogo.folio_pedidos_cedis', $data);

           $datam = array(
			'tid'    =>'X'
		);
		$this->db->where('id', $fol);
        $this->db->update('catalogo.folio_pedidos_cedis_especial', $datam);
        
        $this->db->delete('desarrollo.pedidos', array('fol' => $fol));


    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////envio a fenix5 pedidos de almacen cedis
   function envio_member($fechax)
    {

 $aaa=substr($fechax,0,4);
 $mes=substr($fechax,5,2);
 $dia=substr($fechax,8,2);          

$fecxx=$aaa.str_pad($mes,2,"0",STR_PAD_LEFT).str_pad($dia,2,"0",STR_PAD_LEFT);

$this->load->helper('file');
$id_user= $this->session->userdata('id');
$sqlx="select a.*,b.cia,'G' as tsec, 0 as prv, '' as prvx, 0 as vta,0 as cos, 0 as cod
from pedidos a 
left join catalogo.sucursal b on b.suc=a.suc
where date_format(a.fechas,'%Y-%m-%d')='$fechax' and a.tipo=1 ";
$queryx = $this->db->query($sqlx);
$linea=null;
$cero=0;
foreach($queryx->result() as $rowx)
{
$tip=$rowx->tsuc;
//***************************************************
$sql="select *from catalogo.almacen 
where sec=$rowx->sec and tsec='G'";
$query = $this->db->query($sql);
if($query->num_rows() > 0){
$row=$query->row(); 
$prv=$row->prv;
$cos=($row->costo*100);
$pub=($row->publico*100);
if($tip=='D'){$vta=($row->vtaddr*100);}else{$vta=($row->vtagen*100);}
}else{
$sqlq="select *from catalogo.almacen
where sec=$rowx->sec ";
$queryq = $this->db->query($sqlq);
if($queryq->num_rows() > 0){
$rowq=$queryq->row(); 
$prv=$rowq->prv;
$cos=($rowq->costo*100);
$pub=($rowq->publico*100);
if($tip=='D'){$vta=($rowq->vtaddr*100);}else{$vta=($rowq->vtagen*100);}    
}
}
//***************************************************


$susa=substr($rowx->susa,0,40);
$susa1=substr($rowx->susa,0,35);

$linea.=
     str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->tsuc,1,"0",STR_PAD_LEFT)
    .str_pad($rowx->suc,8," ",STR_PAD_LEFT)
    .str_pad($rowx->mue,3,"0",STR_PAD_LEFT)
    .str_pad($rowx->sec,4,"0",STR_PAD_LEFT)
    .str_pad($rowx->tsec,1,"0",STR_PAD_LEFT)
    .str_pad($susa,40,"0",STR_PAD_LEFT)
    .str_pad($rowx->ped,7,"0",STR_PAD_LEFT)
    .str_pad($rowx->fol,9,"0",STR_PAD_LEFT)
    .str_pad($fecxx,8,"0",STR_PAD_LEFT)
    .str_pad($prv,4,"0",STR_PAD_LEFT)
    .str_pad($cos,7,"0",STR_PAD_LEFT)
    .str_pad($pub,7,"0",STR_PAD_LEFT)
    .str_pad($vta,7,"0",STR_PAD_LEFT)
    ."\n";
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////


if ( ! write_file('./txt/pedido.txt', $linea))
{
    $mensaje=2;
}
else
{
    $mensaje=1;
}


$servidor_ftp    = "10.10.0.7";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/pedido.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'FORMULA/MOVWEB';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
  
    return $mensaje; 

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function busca_pedidos($fec)
    {
     $sql = "SELECT  * FROM  pedidos where date_format(fechas,'%Y-%m-%d')= ?";
    $query = $this->db->query($sql,array($fec));
    return $query; 
    }
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////pedidos historico
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_ped_his($fec)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $num=0;
 $s = "SELECT a.*,count(*)as num,d.nombre as sucx,d.dia
          FROM catalogo.folio_pedidos_cedis a
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fechas,'%Y-%m')='$fec' and a.id_user=0 group by suc order by suc";
 $q = $this->db->query($s);
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>PEDIDOS</th>
        <th>DIA</th>
        <th>VER</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        foreach($q->result() as $r)
        {
            $l1=anchor('pedido/tabla_control_fol/'.$r->suc.'/'.$fec, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver folios!', 'class' => 'encabezado'));
            $num=+1;
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->suc." - ".$r->sucx."</td>
            <td align=\"center\">".$r->num."</td>
            <td align=\"center\">".$r->dia."</td>
            <td align=\"center\">".$l1."</td>
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
    function control_ped_suc($suc,$fec)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $num=0;
 $s = "SELECT * FROM catalogo.folio_pedidos_cedis
          where date_format(fechas,'%Y-%m')='$fec' and suc=$suc";
 $q = $this->db->query($s);
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>FOLIO</th>
        <th>FECHA</th>
        <th>VER</th>
        </tr>

        </thead>
        <tbody>
        ";
        foreach($q->result() as $r)
        {
            $l1=anchor('pedido/tabla_control_compara/'.$r->id.'/'.$fec, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver folios!', 'class' => 'encabezado'));
            $num=+1;
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->id."</td>
            <td align=\"center\">".$r->fechas."</td>
            <td align=\"center\">".$l1."</td>
            </tr>
            ";
         
        }
  $tabla.="
        </tbody>
         </table>";
        
        return $tabla;        
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_ped_compara($fol,$fec)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $num=0;
        $totped=0;
        $totcom=0;
        $porce=0;
 $s = "SELECT * FROM pedidos
          where fol=$fol and tipo=1";
 $q = $this->db->query($s);
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>PEDIDO</th>
        <th>SUCURSAL</th>
        <th></th>
        </tr>

        </thead>
        <tbody>
        ";
        foreach($q->result() as $r)
        {
        $sx = "SELECT sum(can)as can FROM vtadc.compra_detalle where folio like '%$fol%' and sec=$r->sec group by sec";
        $qx = $this->db->query($sx);
        if($qx->num_rows() > 0){
        $rx= $qx->row();    
        $com=$rx->can;
        $color='#060101';
        }else{
        $com=0;
        $color='#FD0505';    
        }
            $num=+1;
            $tabla.="
            <tr>
            
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($com,0)."</font></td>
            </tr>
            ";
        $totped=$totped+$r->ped;
        $totcom=$totcom+$com;         
        }
        $porce=($totcom*100)/$totped;
        $porce=0;
  $tabla.="
        </tbody>
            <tr>
            <td align=\"left\" colspan=\"3\"><font size=\"-1\"><strong> % DE SUTIDO ".$porce." TOTAL </strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totped,0)."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totcom,0)."</strong></font></td>
            </tr>
         </table>";
        
        return $tabla;        
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function sucursales($hora,$fec1)
    {
        $num=1;
 $s = "SELECT a.*,d.nombre as sucx,d.dia,b.mue,sum(b.ped) as ped,b.fechas as trasmitio, e.tel, e.tel1, e.tel_iu
            FROM catalogo.folio_pedidos_cedis a
            left join desarrollo.pedidos b on b.fol=a.id
            left join catalogo.sucursal d on d.suc=a.suc
            left join desarrollo.sucursales e on e.suc=a.suc
            where date_format(a.fechas,'%Y-%m-%d')='$fec1' and (tid='A' or tid='C') and date_format(b.fechas,'%h-%m-%s')>'$hora'
            group by suc
            order by b.fechas";
 $q = $this->db->query($s);
 //echo $this->db->last_query();
 //die();
        
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>TRANSMITIO</th>
        <th>DIA</th>
        <th>TELEFONO</th>
        <th>MOVIL</th>
        </tr>

        </thead>
        <tbody>
        ";
        foreach($q->result() as $r)
        {

            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->suc." ".$r->sucx."</td>
            <td align=\"center\">".$r->trasmitio."</td>
            <td align=\"center\">".$r->dia."</td>
            <td align=\"center\">".$r->tel." / ".$r->tel1."</td>
            <td align=\"center\">".$r->tel_iu."</td>
            </tr>
            ";
         $num++;
        }
  $tabla.="
        </tbody>
         </table>";
        
        return $tabla;        
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}