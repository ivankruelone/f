<?php
	class Envio_model_prenomina extends CI_Model {


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////    
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////envio a fenix4 nominas
   function faltante_nom($fec,$quin,$mes,$aaa)
    {
if($quin==1){
   $dia=15;
   }
if($quin==2){
$s="select * from catalogo.mes where num = $mes";
$q = $this->db->query($s);
$r = $q->row();
$dia=$r->dos;
}   
$fec1=$fec.'-'.str_pad($dia,2,0,STR_PAD_LEFT);
$aa=date('Y');
$mm=date('m');
$dd=date('d');   
$hoy=$aa.str_pad($mm,2,0,STR_PAD_LEFT).str_pad($dd,2,0,STR_PAD_LEFT);
           

//$m1="insert into faltante(
//fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom,  tipo, clave,
//observacion, succ, fecpre,id_plaza,fechacaptura)
//(select
//fecha_mov,0,nomina,0,1,id_user,id_user,suc2,0,cia,cia,0,tipo,331,causa,suc2,'$fec1',id_plaza,fecha_c
//from mov_supervisor where motivo=7 and tipo=2 and dias>0 and date_format(fecha_rh,'%Y-%m-%d')='0000-00-00')
//on duplicate key update fal=values(fal)";
//$this->db->query($m1);

//$m2="update mov_supervisor set fecha_rh='$fec1' 
//where motivo=7 and tipo=2 and dias>0 and date_format(fecha_rh,'%Y-%m-%d')='0000-00-00'
//";
//$this->db->query($m2);



$this->load->helper('file');
$id_user= $this->session->userdata('id');
$sqlx="select a.*,sum(a.fal)as importe,b.puesto
from faltante a
left join usuarios b on b.id=a.id_user
where

a.fecpre='$fec1' and a.tipo=2  and a.nomina<99999990 and clave<>644
or
a.fecpre='$fec1' and a.tipo=2  and a.nomina<99999990 and a.clave=644 and a.id_plaza<>999
group by a.id_user,a.cianom, a.nomina,a.clave
order by clave";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){
    $File = "./txt/nomina.txt";
    $Handle = fopen($File, 'w');



$cero=0;
foreach($queryx->result() as $rowx)
{
$ax=substr($rowx->fecpre,0,4);
$mx=substr($rowx->fecpre,5,2);
$dx=substr($rowx->fecpre,8,2);
$genera=$ax.str_pad($mx,2,0,STR_PAD_LEFT).str_pad($dx,2,0,STR_PAD_LEFT);

$puesto="WEB ".substr($rowx->puesto,0,45);
$importe=$rowx->importe*100;
 $Data=
     str_pad($rowx->cianom,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->nomina,8,"0",STR_PAD_LEFT)
    .str_pad($rowx->clave,3," ",STR_PAD_LEFT)
    .str_pad($importe,11,"0",STR_PAD_LEFT)
    .str_pad($cero,11,"0",STR_PAD_LEFT)
    .str_pad($cero,11,"0",STR_PAD_LEFT)
    .str_pad($cero,11,"0",STR_PAD_LEFT)
    .str_pad($genera,8,"0",STR_PAD_LEFT)
    .str_pad($puesto,50)
    .str_pad($hoy,8,"0",STR_PAD_LEFT)
    ."\n";
fwrite($Handle, $Data);
$importe=0;
}
fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////



$servidor_ftp    = "192.168.1.83";
$ftp_nombre_usuario = "transfer";
$ftp_contrasenya = "transfer";

$archivo = './txt/nomina.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'fnxnomdata/fndweb';



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
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////