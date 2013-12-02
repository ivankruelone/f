<?php
	class Envio_model_as400 extends CI_Model {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
public function poliza_almacen($fecha)
{

$as="update  pedidos a, catalogo.almacen b set a.lin=b.lin where a.sec=b.sec and a.lin=0";
$this->db->query($as);

$sqlx="SELECT b.cia,34 as pol,date_format(fechasur,'%Y')as aaa,date_format(fechasur,'%m')as mes,a.costo,sum(sur*costo)as bb,
date_format(fechasur,'%d')as dia, b.plaza,b.suc_contable,a.lin,b.iva,
a.suc,

case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end as sub,

case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)
*b.iva)
else
0
end as ivaimp,



(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)+(case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)
*b.iva)
else
0
end)
as total

FROM  PEDIDOS a
left join catalogo.sucursal b on b.suc=a.suc
WHERE a.SUC>100  AND DATE_FORMAT(FECHASUR,'%Y-%m')='$fecha' and sur>0 
group by suc, lin
order by suc ";


$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosalm.txt";
    $Handle = fopen($File, 'w');
$cero=0;
foreach($queryx->result() as $rowx)  
{
    

$subx=round($rowx->sub*100);
$ivax=round($rowx->ivaimp*100);
$tot=round($rowx->total*100);



echo $subx.' suc-'.$ivax.'-'.$rowx->suc.'<br />';   
$Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->pol,7,"0",STR_PAD_LEFT)
        .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad('31',2,"0",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc_contable,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->lin,5,"0",STR_PAD_LEFT)
        .str_pad($subx,11,"0",STR_PAD_LEFT)
        .str_pad($cero,4,"0",STR_PAD_LEFT)
        .str_pad($ivax,11,"0",STR_PAD_LEFT)
        .str_pad($cero,4,"0",STR_PAD_LEFT)
        .str_pad($tot,11,"0",STR_PAD_LEFT)
        .str_pad($cero,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    
    fwrite($Handle, $Data);
}

fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//die();
$servidor_ftp    = "10.10.0.5";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/cosalm.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'formula/almcona';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
public function poliza_almacen_exel($fecha)
{


$sqlx="SELECT b.cia,34 as pol,date_format(fechasur,'%Y')as aaa,date_format(fechasur,'%m')as mes,
a.costo,

case when b.cia=13
then sum(sur*costo)*1.20
else
sum(sur*costo)*1.20
end as sub,

case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.20
else
sum(sur*costo)*1.20
end)
*b.iva)
else
0
end as ivaimp,



(case when b.cia=13
then sum(sur*costo)*1.20
else
sum(sur*costo)*1.20
end)+(case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.20
else
sum(sur*costo)*1.20
end)
*b.iva)
else
0
end)
as total,
sum(sur*costo)as bb, b.plaza,b.suc_contable,a.lin,a.iva,
a.suc,a.sec,a.vta,a.susa,b.nombre,sum(sur)as sur
FROM  PEDIDOS a
left join catalogo.sucursal b on b.suc=a.suc
WHERE a.SUC>100  AND DATE_FORMAT(FECHASUR,'%Y-%m')='$fecha' and sur>0 
group by suc, sec
order by suc ";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosalmdet.txt";
    $Handle = fopen($File, 'w');
$cero=0;
$corte='|';
$Data=
         str_pad('CIA',3," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('POL',7," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('AAAA',4," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('MES',3," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUC',8," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUCURSAL',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('PLAZA',5," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUCC',2," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SEC',4," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUSTANCIA ACTIVA',60," ",STR_PAD_RIGHT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('PIEZAS',7," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUB_COST',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('IVA_COS',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('TOT_COS',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUB_VTA',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('IVA_VTA',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('TOT_VTA',15," ",STR_PAD_LEFT)
        
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);

foreach($queryx->result() as $rowx)  
{
if($rowx->cia==13){$sub=$rowx->bb;$sub_vta=$sub*1.15;}else{$sub=$rowx->bb*1.15;$sub_vta=($rowx->bb*1.15)*1.15;}
if($rowx->lin==2 || $rowx->lin==5){$iva=$sub*$rowx->iva;$iva_vta=$sub_vta*$rowx->iva;}else{$iva=0;$iva_vta=0;}
$subx=round($sub,2);
$ivax=round($iva,2);
$tot=round($sub,2)+round($iva,2);
$sub_vtax=round($sub_vta,2);
$iva_vtax=round($iva_vta,2);
$tot_vta=round($sub_vta,2)+round($iva_vta,2);

echo $subx.'suc-'.$ivax.'-'.'<br />';   
$Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->pol,7,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->nombre,15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->suc_contable,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->sec,4,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->susa,60," ",STR_PAD_RIGHT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->sur,7,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->sub,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->ivaimp,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->total,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($sub_vtax,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($iva_vtax,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($tot_vta,15,"0",STR_PAD_LEFT)
        
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//die();

$servidor_ftp    = "10.10.0.5";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/cosvta.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'formula/invliw';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 
    
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
public function factura_nadro()
{
$sqlx="SELECT concat(prefijo,factura)as factura,'P'as fija,0 as codigo_arti,lin,
(select descripcion from catalogo.cat_nadro where codigo=a.codigo group by codigo)as descri

,piezas,0 as regalo,round(oferta*100)as oferta,round(farmacia*100)as farmacia,
0 as venta,round((piezas*farmacia)*100)as importe,0 as venta_renglon,round(iva*100)as iva,0 as ieps,
0 as acomodo,codigo,round((financiero*100))as financiero,0,
0 as clasifica,''as referencia,' 'as venta_neta,0 as des_limi,round(((piezas*farmacia)*(oferta/100))*100)as bonifica
 FROM compras.factura_nadro A";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/facdet.txt";
    $Handle = fopen($File, 'w');
$cero=0;
foreach($queryx->result() as $rowx)  
{
$Data=
         str_pad($rowx->factura,10," ",STR_PAD_RIGHT)
        .str_pad($rowx->fija,1," ",STR_PAD_RIGHT)
        .str_pad($rowx->codigo_arti,8," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->descri,35," ",STR_PAD_RIGHT)
        .str_pad($rowx->piezas,6,"0",STR_PAD_LEFT)
        .str_pad($rowx->regalo,6,"0",STR_PAD_LEFT)
        .str_pad($rowx->oferta,5,"0",STR_PAD_LEFT)
        .str_pad($rowx->farmacia,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->venta,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->importe,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->venta_renglon,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->iva,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->ieps,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->acomodo,1,"0",STR_PAD_LEFT)
        .str_pad($rowx->codigo,14," ",STR_PAD_RIGHT)
        .str_pad($rowx->financiero,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->clasifica,1," ",STR_PAD_RIGHT)
        .str_pad($rowx->referencia,1," ",STR_PAD_RIGHT)
        .str_pad($rowx->venta_neta,1," ",STR_PAD_RIGHT)
        .str_pad($rowx->des_limi,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->bonifica,8,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    
    fwrite($Handle, $Data);
}

fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//die();
$servidor_ftp    = "10.10.0.5";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/facdet.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'catalogo/detnad';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
public function factura_nadro_c()
{
$sqlx="SELECT a.suc,b.cia,400 as prv,codigo_nadro,a.fecha_fac,concat(prefijo,factura)as factura,lin,count(*)as reg,0 as codigo_cliente,
sum(piezas*farmacia)as importe,
sum((piezas*farmacia)*(oferta/100))+sum(((piezas*farmacia)-(piezas*farmacia)*(oferta/100))*(financiero/100))as descuento,
sum(a.iva)as iva,

(sum(piezas*farmacia))-
(sum((piezas*farmacia)*(oferta/100))+sum(((piezas*farmacia)-(piezas*farmacia)*(oferta/100))*(financiero/100)))+
(sum(a.iva))as total

 FROM compras.factura_nadro a
left join catalogo.sucursal b on b.suc=a.suc
 where prefijo='PM' and a.factura=7554438
group by prefijo,a.factura";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/facdet.txt";
    $Handle = fopen($File, 'w');
$cero=0;
foreach($queryx->result() as $rowx)  
{
$Data=
         str_pad('B',1," ",STR_PAD_RIGHT)
        .str_pad('FE',2," ",STR_PAD_RIGHT)
        .str_pad($rowx->cia,2," ",STR_PAD_RIGHT)
        .str_pad($rowx->suc,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->prv,35," ",STR_PAD_RIGHT)
        .str_pad('C',1," ",STR_PAD_LEFT)
        .str_pad($rowx->codigo_nadro,6,"0",STR_PAD_LEFT)
        .str_pad($rowx->fecha_fac,5,"0",STR_PAD_LEFT)
        .str_pad($rowx->reg,8,"0",STR_PAD_LEFT)
        .str_pad('C:',2," ",STR_PAD_LEFT)
        .str_pad($rowx->codigo_clente,8,"0",STR_PAD_LEFT)
        .str_pad('F',8,"0",STR_PAD_LEFT)
        .str_pad($rowx->factura,8,"0",STR_PAD_LEFT)
        .str_pad(' ',4," ",STR_PAD_LEFT)
        .str_pad($rowx->fecha_fac,1,"0",STR_PAD_LEFT)
        .str_pad($rowx->total,14," ",STR_PAD_RIGHT)
        .str_pad($rowx->descuento,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->iva,1," ",STR_PAD_RIGHT)
        .str_pad(0,1,"0",STR_PAD_RIGHT)
        .str_pad($rowx->reg,1," ",STR_PAD_RIGHT)
        
        
        
        .str_pad('0',1,"0",STR_PAD_LEFT)
        .str_pad('0',1,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    
    fwrite($Handle, $Data);
}

fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//die();
$servidor_ftp    = "10.10.0.5";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/facdet.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'catalogo/detnad';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

 


}

/////////////////////////////////////////////////////////////////////////////////////////////////////////