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
date_format(fechasur,'%d')as dia, b.plaza,b.suc_contable,a.lin,a.iva,
a.suc
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
if($rowx->cia==13){$sub=$rowx->bb;}else{$sub=$rowx->bb*1.15;}
if($rowx->lin==2 || $rowx->lin==5){$iva=$sub*$rowx->iva;}else{$iva=0;}
$subx=round($sub*100);
$ivax=round($iva*100);
$tot=round($sub*100)+round($iva*100);
echo $subx.'suc-'.$ivax.'-'.'<br />';   
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
a.costo,sum(sur*costo)as bb, b.plaza,b.suc_contable,a.lin,a.iva,
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
        .str_pad($subx,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($ivax,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($tot,15,"0",STR_PAD_LEFT)
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
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

 


}

/////////////////////////////////////////////////////////////////////////////////////////////////////////