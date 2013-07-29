<?php
	class Genera_pdv_model extends CI_Model {


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////    
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////envio a fenix4 nominas
   function gernera()
    {
$aaa=date('Y');  
$this->load->helper('file');
$id_user= $this->session->userdata('id');
$linea=null;
$tipo0='CTP';
$ss="update  vtadc.tarjetas
set vigencia=date_add(venta,interval 1 year)
where tipo=1 and date_format(venta,'%Y')=$aaa";
$s="select *from catalogo.cat_tarjetas";
$q = $this->db->query($s);
foreach($q->result() as $r)
{
$linea.=
     str_pad($tipo0,3)
    .str_pad($r->num,13,"0",STR_PAD_LEFT)
    .str_pad($r->nombre,30)
    .str_pad($r->descuento,6,"0",STR_PAD_LEFT)
    .str_pad($r->dias,5,"0",STR_PAD_LEFT)
    .str_pad($r->costo,12,"0",STR_PAD_LEFT)
    .str_pad($r->renova,12,"0",STR_PAD_LEFT)
    .str_pad($r->desren,6,"0",STR_PAD_LEFT)
    .str_pad($r->aviso,5,"0",STR_PAD_LEFT)
    .str_pad($r->folpre,1,"0",STR_PAD_LEFT)
    ."\n";    
}
$tipo='NTP';
$sqlx="select *from vtadc.tarjetas where tipo=1 ORDER BY SUC";
$queryx = $this->db->query($sqlx);
foreach($queryx->result() as $rowx)
{
$aaa=substr($rowx->vigencia,0,4);
$mes=substr($rowx->vigencia,5,2);
$dia=substr($rowx->vigencia,8,2);
$vigencia=$aaa.str_pad($mes,2,"0",STR_PAD_LEFT).str_pad($dia,2,"0",STR_PAD_LEFT);
$linea.=
     str_pad($tipo,3)
    .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
    .str_pad($rowx->tipo,13,"0",STR_PAD_LEFT)
    .str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
    .str_pad($vigencia,8,"0",STR_PAD_LEFT)
    ."\n";
}
if ( ! write_file('./txt/TRACLI2.txt', $linea))
{
    $mensaje=2;
}
else
{
    $mensaje=1;
}

    return $mensaje;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////