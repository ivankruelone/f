<?php
class Proceso_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function almacen_ped_sur($fec){

$aaa=substr($fec,0,4);    
$s1="insert into desarrollo.ped_sur_periodo (aaa, sec, ped01, sur01, ped02, sur02, ped03, sur03, ped04, sur04, ped05, sur05, ped06, sur06, ped07, sur07, ped08, sur08, ped09, sur09, ped10, sur10, ped11, sur11, ped12, sur12)
(select $aaa,sec,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 from catalogo.sec_generica where sec>0 and sec<=2000)
on duplicate key update aaa=values(aaa)";
$this->db->query($s1);


}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_cat(){
$s1="LOAD DATA INFILE 'c:/wamp/www/subir10/EMPLEADO.txt' INTO TABLE subir10.p_cat_nomina LINES TERMINATED BY '\r\n';";
$this->db->query($s1);
$s2="update catalogo.cat_empleado  set succ=suc_far, suc=suc_far where suc_far>0";
$this->db->query($s2);
$s3="update mov_supervisor a, catalogo.cat_empleado b set a.suc_as400=b.succ where a.nomina=b.nomina and a.cia=b.cia and a.motivo=3 and a.suc2<>a.suc_as400";
$this->db->query($s3);
$s9="update mov_supervisor a, catalogo.cat_empleado b set a.activo=b.tipo where a.nomina=b.nomina and a.cia=b.cia";
$this->db->query($s9);
$s4="update catalogo.cat_alta_empleado a, catalogo.cat_empleado b set a.activo=b.tipo where a.empleado=b.nomina and a.cia=b.cia;";
$this->db->query($s4);    
$s5="update usuarios a, catalogo.cat_empleado b set a.activo=b.tipo where a.nomina=b.nomina and a.cia=b.cia;";
$this->db->query($s5);
$s6="update catalogo.cat_empleado a, catalogo.sucursal b set a.id_plaza=b.id_plaza where a.succ=b.suc and b.id_plaza>0;";
$this->db->query($s6);
$s8="update catalogo.cat_alta_empleado a, catalogo.cat_empleado b set a.nomina=b.nomina where a.pat=b.pat and a.mat=b.mat and a.nom=b.nom and a.motivo='ALTA' and a.nomina=0 and b.tipo=1";
$this->db->query($s8);
$s10="update cortes_c a,  catalogo.sucursal b set a.id_plaza=b.id_plaza where a.suc=b.suc and b.id_plaza>0;";
$this->db->query($s10);
$s11="update faltante a,  catalogo.sucursal b set a.id_plaza=b.id_plaza where a.suc=b.suc and b.id_plaza>0;";
$this->db->query($s11);
$s12="update fal_c a,  catalogo.sucursal b set a.id_plaza=b.id_plaza where a.suc=b.suc and b.id_plaza>0;";
$this->db->query($s12);

$l1="update catalogo.cat_empleado a, catalogo.cat_deptos b
set a.depto=b.depto
where a.succ=b.num";
$this->db->query($l1);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_cat_rh(){
$s1="LOAD DATA INFILE 'c:/wamp/www/subir10/EMPLEADO.txt' INTO TABLE subir10.p_cat_nomina LINES TERMINATED BY '\r\n';";
$this->db->query($s1);
$s2="update catalogo.cat_empleado  set succ=suc_far, suc=suc_far where suc_far>0";
$this->db->query($s2);
$s3="update mov_supervisor a, catalogo.cat_empleado b set a.suc_as400=b.succ where a.nomina=b.nomina and a.cia=b.cia and a.motivo=3 and a.suc2<>a.suc_as400";
$this->db->query($s3);
$s9="update mov_supervisor a, catalogo.cat_empleado b set a.activo=b.tipo where a.nomina=b.nomina and a.cia=b.cia";
$this->db->query($s9);
$s4="update catalogo.cat_alta_empleado a, catalogo.cat_empleado b set a.activo=b.tipo where a.empleado=b.nomina and a.cia=b.cia;";
$this->db->query($s4);    
$s5="update usuarios a, catalogo.cat_empleado b set a.activo=b.tipo where a.nomina=b.nomina and a.cia=b.cia;";
$this->db->query($s5);
$s6="update catalogo.cat_empleado a, catalogo.sucursal b set a.id_plaza=b.id_plaza where a.succ=b.suc and b.id_plaza>0;";
$this->db->query($s6);
$s8="update catalogo.cat_alta_empleado a, catalogo.cat_empleado b set a.nomina=b.nomina where a.pat=b.pat and a.mat=b.mat and a.nom=b.nom and a.motivo='ALTA' and a.nomina=0 and b.tipo=1";
$this->db->query($s8);
$s10="update cortes_c a,  catalogo.sucursal b set a.id_plaza=b.id_plaza where a.suc=b.suc and b.id_plaza>0;";
$this->db->query($s10);
$s11="update faltante a,  catalogo.sucursal b set a.id_plaza=b.id_plaza where a.suc=b.suc and b.id_plaza>0;";
$this->db->query($s11);
$s12="update fal_c a,  catalogo.sucursal b set a.id_plaza=b.id_plaza where a.suc=b.suc and b.id_plaza>0;";
$this->db->query($s12);
$l1="update catalogo.cat_empleado a, catalogo.cat_deptos b
set a.depto=b.depto
where a.succ=b.num";
$this->db->query($l1);

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_ofer(){
$s1="load data infile 'c:/wamp/www/subir10/mirfac.txt' replace into table vtadc.oferta_nota_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, facha, prv, suc, fac, labor, lin, codigo_saba, descri, can, costo, codigo, tipo_nota, descuento, nota)
";
$this->db->query($s1);
$s2="load data infile 'c:/wamp/www/subir10/mirfag.txt' replace into table vtadc.oferta_nota_ctl FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, prv, labor, tipo_nota, nota, tipo)
";
$this->db->query($s2);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


     
public function llena_member_inv($aaa,$mes,$sem,$dia)
{
 $fecha=date('Y-m-d');
    //echo $aaa.$mes.$dia.$sem;
     //die();
$this->db->select('*');
$this->db->from('desarrollo.inv_almacenes');
$this->db->where('sem',$sem);
$this->db->where('aaa',$aaa);
$this->db->group_by('aaa');
$this->db->group_by('sem');
$query = $this->db->get();
if($query->num_rows()==0){
    
$this->db->select(' a.aaa,a.mes,a.dia,a.tipo,a.tipo3,a.folio,b.claves,b.inv,lin,costo');
$this->db->from('almacen.inventario_c a');
$this->db->join('almacen.inventario_d b','b.folio=a.folio and a.tipo=b.tipo','left');
$this->db->where('dia',$dia);
$this->db->where('mes',$mes);
$this->db->where('aaa',$aaa);
$this->db->where('a.tipo3','C');
$this->db->where('b.inv>0','',false);
$query = $this->db->get();
foreach($query->result() as $row)
        {
if($row->tipo=='ver'){$suc=9900;}
if($row->tipo=='mic'){$suc=12000;}
if($row->tipo=='cht'){$suc=16000;}
if($row->tipo=='zac'){$suc=17000;}
if($row->tipo=='agu'){$suc=14000;}
if($row->tipo=='con'){$suc=100;}    
    //sem, suc, sec, clave, can, cos, ven, lin, aaa, mes
      $new = array(
			'suc' => $suc,
            'sem' => $sem,
            'sec' =>0,
			'clave' => $row->claves,
			'cos' => $row->costo,
            'ven'=>0,
			'can' => $row->inv,
            'lin' => $row->lin,
            'aaa' => $aaa,
            'mes' => $mes
		);
		
		$insert = $this->db->insert('desarrollo.inv_almacenes', $new);      

}

        }
$s1="insert into inv_almacenes (sem, suc, sec, clave, can, cos, ven, lin,aaa,mes)
(SELECT $sem,900,sec,0,sum(inv1),0,0,0,$aaa,$mes FROM inv_cedis  where inv1>0 group by sec)on duplicate key update ven=values(ven)";

$s0="select *from inv_r where sem=$sem group by sem";
$q0 = $this->db->query($s0);
 if($q0->num_rows() == 0){  
 $s3="update inv_almacenes a, catalogo.almacen b set a.cos=b.costo, a.ven =round((b.costo*1.10),2),a.lin=b.lin  where a.sec=b.sec and a.sec>0 and a.sem=$sem";
$q3 = $this->db->query($s3);
$s4="update inv_almacenes a, catalogo.segpop b set a.cos=b.costo, a.ven = round((b.costo*1.10),2),a.lin=b.lin  where a.clave=b.claves and a.sec=0 and a.sem=$sem";
$q4 = $this->db->query($s4);

$s5="Insert into inv_r (sem,tsuc,suc, mov, codigo, cantidad, fechai, fechag, sec, cia, lin, cos, ven, clave,aaaa,mes)
(select sem,'', suc,0,0,can,'$fecha','$fecha', sec,0,lin, cos, ven, clave,aaa,mes from inv_almacenes WHERE sem=$sem)
on duplicate key update sem=values(sem)
";
$q5 = $this->db->query($s5);
$s6="insert into inv_r (tsuc, suc, mov, codigo, cantidad, fechai, fechag, sec, cia,sem, aaaa, mes)
(select tsuc, suc, mov, codigo, cantidad, fechai, fechag, sec, cia,$sem, $aaa, $mes from inv where cantidad>0)
on duplicate key update cantidad=values(cantidad);";
$q6 = $this->db->query($s6);

}

$s7="update  inv_r a, catalogo.sucursal b set a.tsuc=b.tipo2, a.cia=b.cia ,a.descu=b.descu, a.plaza=b.plaza,a.succ=b.suc_contable where a.suc=b.suc and a.sem=$sem";
$q7 = $this->db->query($s7);
$s8="update inv_r a set sec=codigo where mov=7 and a.sem=$sem";
$q8 = $this->db->query($s8);
$s9="update inv_r a, catalogo.almacen b set a.sec=b.sec, a.lin=b.lin where a.codigo=b.codigo and a.mov=3 and a.sem=$sem";
$q9 = $this->db->query($s9);
$s10="update inv_r a, catalogo.almacen b set a.cos=b.costo, a.ven=round((b.costo*1.10),2),a.lin=b.lin where a.sec=b.sec and a.cia=13 and a.sem=$sem";
$q10 = $this->db->query($s10);
$s11="update inv_r a, catalogo.almacen b set a.cos=round((b.costo*1.10),2), a.ven=round(((b.costo*1.10)*1.10),2),a.lin=b.lin where a.sec=b.sec and a.cia<>13 and a.sem=$sem";
$q11 = $this->db->query($s11);
$s12="update inv_r a, catalogo.fenix b set a.cos=b.costo, a.ven=b.publico, a.lin=b.lin where a.codigo=b.codigo and a.sec=0 and a.sem=$sem";
$q12 = $this->db->query($s12);
$s13="update inv_r a, catalogo.fenix b set a.cos=b.costo, a.ven=round((b.publico*(1-a.descu)),2), a.lin=b.lin where a.codigo=b.codigo and a.sec=0 and a.lin=1 and a.tsuc='F' and a.sem=$sem";
$q13 = $this->db->query($s13);
$s14="insert into inv_cosvta (cia, suc, sem, aaaa, mes, lin, plaza, succ, importe)
(select a.cia, a.suc, sem, aaaa, mes, a.lin,a.plaza, a.succ, sum(cos*cantidad) from inv_r a  where  sem=$sem group by sem,suc,lin)";
$q14 = $this->db->query($s14);


$sqlx="select *from inv_cosvta where importe>0 and sem=$sem";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosvta.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
    $Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->sem,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->aaaa,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->lin,5,"0",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->succ,4,"0",STR_PAD_LEFT)
        .str_pad(round($rowx->importe*100,2),11,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////


$servidor_ftp    = "10.10.0.7";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/cosvta.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'candado/invliw';


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
//**************************************************************
//**************************************************************
public function envia_una_inv($aaa,$sem)
{
$sqlx="select *from inv_cosvta where importe>0 and sem=$sem and aaaa=$aaa";
//$sqlx="select *from inv_cosvta where importe>0 and sem>7 and aaaa=$aaa order by sem";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosvta.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
    $Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->sem,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->aaaa,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->lin,5,"0",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->succ,4,"0",STR_PAD_LEFT)
        .str_pad(round($rowx->importe*100,2),11,"0",STR_PAD_LEFT)
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

$archivo = './txt/cosvta.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'candado/invliw';


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
//**************************************************************
//**************************************************************

//**************************************************************proceso de nilsen
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function proceso_vta_direccion($aaa,$mes)
{
ini_set('memory_limit','20000M');
    set_time_limit(0);
$fec=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT);
if($mes==1){$importe='importe1';$costo='costo1';}
if($mes==2){$importe='importe2';$costo='costo2';}
if($mes==3){$importe='importe3';$costo='costo3';}
if($mes==4){$importe='importe4';$costo='costo4';}
if($mes==5){$importe='importe5';$costo='costo5';}
if($mes==6){$importe='importe6';$costo='costo6';}
if($mes==7){$importe='importe7';$costo='costo7';}
if($mes==8){$importe='importe8';$costo='costo8';}
if($mes==9){$importe='importe9';$costo='costo9';}
if($mes==10){$importe='importe10';$costo='costo10';};
if($mes==11){$importe='importe11';$costo='costo11';}
if($mes==12){$importe='importe12';$costo='costo12';}
$m1=1;
$m2=2;
$m3=3;
$m4=4;
$m5=5;
$m6=6;
$m7=7;
$m8=8;
$m9=9;
$m10=10;
$m11=11;
$m12=12;

//$sx0="update vtadc.venta a,catalogo.sucursal b set a.tipo=b.tipo2  where a.sucursal=b.suc and a.mes=$mes and a.tipo=' '";
//$qx0 = $this->db->query($sx0);
//$sx1="update  vtadc.venta a, catalogo.almacen b set a.cos=b.costo and a.sec=b.sec where a.codigo=b.codigo and a.tipo<>'F' and b.sec>0 and b.sec<=2005 and a.cos=0";
//$qx1 = $this->db->query($sx1);
//$sx3="update  vtadc.venta a, catalogo.cat_costo_anual  b set a.cos=b.$costo where a.codigo=b.codigo  and a.cos=0 and b.$costo>0 and a.mes=$mes and a.aaa=$aaa";
//$qx3 = $this->db->query($sx3);
//////////////////////////////////////////*************************************************************ENERO
if($m1==$mes){

 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
importe,
0,0,0,0,0,0,0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
imp+(imp*iva),
0,0,0,0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel



/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
sum(a.venta*a.cos),
0,0,0,0,0,0,0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes  group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10x = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*((( c.$importe*100)/b.$importe)/100))
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 
";
$q10x = $this->db->query($s10x);


///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
(a.$importe-b.$importe),
0,0,0,0,0,0,0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10 )
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);




/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
(a.neto),
0,0,0,0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
(a.com),
0,0,0,0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
sum(a.nota),
0,0,0,0,0,0,0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
}
//////////////////////////////////////////*************************************************************ENERO
//////////////////////////////////////////*************************************************************FEBRERO
if($m2==$mes){
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,importe,
0,0,0,0,0,0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,imp+(imp*iva),
0,0,0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel



/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,sum(a.venta*a.cos),
0,0,0,0,0,0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes  group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10x = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*((( c.$importe*100)/b.$importe)/100))
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 
";
$q10x = $this->db->query($s10x);


///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,(a.$importe-b.$importe),
0,0,0,0,0,0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10 )
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);




/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,(a.neto),
0,0,0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,(a.com),
0,0,0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,sum(a.nota),
0,0,0,0,0,0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
}
//////////////////////////////////////////*************************************************************FEBRERO
//////////////////////////////////////////*************************************************************MARZO
if($m3==$mes){

///////generar utilidad contado
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,importe,
0,0,0,0,0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,imp+(imp*iva),
0,0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel



/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,sum(a.venta*a.cos),
0,0,0,0,0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes  group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10x = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*((( c.$importe*100)/b.$importe)/100))
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 
";
$q10x = $this->db->query($s10x);


///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,(a.$importe-b.$importe),
0,0,0,0,0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10 )
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);




/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,(a.neto),
0,0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,(a.com),
0,0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,sum(a.nota),
0,0,0,0,0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
}
//////////////////////////////////////////*************************************************************MARZO
//////////////////////////////////////////*************************************************************ABRIL
if($m4==$mes){

///////generar utilidad contado
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,importe,
0,0,0,0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,imp+(imp*iva),
0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel



/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,sum(a.venta*a.cos),
0,0,0,0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes  group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10x = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*((( c.$importe*100)/b.$importe)/100))
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 
";
$q10x = $this->db->query($s10x);


///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,(a.$importe-b.$importe),
0,0,0,0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10 )
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);




/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,(a.neto),
0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,(a.com),
0,0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,sum(a.nota),
0,0,0,0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
}
//////////////////////////////////////////*************************************************************ABRIL
//////////////////////////////////////////*************************************************************MAYO
if($m5==$mes){
/////utilidad credito
/////actualizar el precio costo venta contado-

///////generar utilidad contado
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,importe,
0,0,0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,imp+(imp*iva),
0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel



/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,sum(a.venta*a.cos),
0,0,0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes  group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10x = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*((( c.$importe*100)/b.$importe)/100))
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 
";
$q10x = $this->db->query($s10x);


///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,(a.$importe-b.$importe),
0,0,0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10 )
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);




/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,(a.neto),
0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,(a.com),
0,0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,sum(a.nota),
0,0,0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
}
//////////////////////////////////////////*************************************************************MAYO

//////////////////////////////////////////*************************************************************JUNIO
if($m6==$mes){
///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,importe,
0,0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,imp+(imp*iva),
0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,siniva,
0,0,0,0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,round((siniva*.065),2),
0,0,0,0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,corregido,
0,0,0,0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,round((corregido*.30),2),
0,0,0,0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,sum(corregido),
0,0,0,0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,sum(corregido*.07),
0,0,0,0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);


$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,sum(siniva),
0,0,0,0,0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>10 and clave1<>20 and clave1<=29 and fecha='$fec' and tipo2='F' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,sum(siniva),
0,0,0,0,0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>20 and clave1<=29 and fecha='$fec' and tipo2<>'F' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,sum(a.venta*a.cos),
0,0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10x = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*((( c.$importe*100)/b.$importe)/100))
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0
";
$q10x = $this->db->query($s10x);


///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,(a.$importe-b.$importe),
0,0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10 )
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);




/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,(a.neto),
0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,(a.com),
0,0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,sum(a.nota),
0,0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,sum(siniva),
0,0,0,0,0,0
 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}
//////////////////////////////////////////*************************************************************JUNIO
//////////////////////////////////////////*************************************************************JULIO
if($m7==$mes){
///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,0,importe,
0,0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,imp+(imp*iva),
0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,0,siniva,
0,0,0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,0,round((siniva*.065),2),
0,0,0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,0,corregido,
0,0,0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,0,round((corregido*.30),2),
0,0,0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,0,sum(corregido),
0,0,0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,0,sum(corregido*.07),
0,0,0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);


$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,sum(siniva),
0,0,0,0,0
 from desarrollo.cortes_g where
 clave1>0  and clave1<>10 and clave1<>20 and clave1<=29 and tipo2='F' and  fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9x = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,sum(siniva),
0,0,0,0,0
 from desarrollo.cortes_g where
 clave1>0  and clave1<>20 and clave1<=29 and tipo2<>'F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,0,sum(a.venta*a.cos),
0,0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes and tipo='F' and sec=0 group by a.sucursal 
)
on duplicate key update  $importe=values($importe)
";
$q10 = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*(( c.$importe*100)/b.$importe)/100)
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0  and c.$importe>0 
";
$q10x = $this->db->query($s10x);
///////generar utilidad contado
///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,0,(a.$importe-b.$importe),
0,0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc
where a.aaa=$aaa and a.auxi=1 and b.auxi=10)
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);

/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,0,(a.neto),
0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,0,(a.com),
0,0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,0,sum(a.nota),
0,0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,0,sum(siniva),
0,0,0,0,0
 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}

//////////////////////////////////////////*************************************************************JULIO
//////////////////////////////////////////*************************************************************AGOSTO
if($m8==$mes){
///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,0,0,importe,
0,0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,imp+(imp*iva),
0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,0,0,siniva,
0,0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,0,0,round((siniva*.065),2),
0,0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,0,0,corregido,
0,0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,0,0,round((corregido*.30),2),
0,0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,0,0,sum(corregido),
0,0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,0,0,sum(corregido*.07),
0,0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);


$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,sum(siniva),
0,0,0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>10  and clave1<>20 and clave1<=29 and tipo2='F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9x = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,sum(siniva),
0,0,0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>20 and clave1<=29 and tipo2<>'F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,0,0,sum(a.venta*a.cos),
0,0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10 = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*(( c.$importe*100)/b.$importe)/100)
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 and c.$importe>0
";
$q10x = $this->db->query($s10x);
///////generar utilidad contado
///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,0,0,(a.$importe-b.$importe),
0,0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10)
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);

/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,0,0,(a.neto),
0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,0,0,(a.com),
0,0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,0,0,sum(a.nota),
0,0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,0,0,sum(siniva),
0,0,0,0
 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}

//////////////////////////////////////////*************************************************************AGOSTO
//////////////////////////////////////////*************************************************************SEPTIEMBRE
if($m9==$mes){
    
    ///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,0,0,0,importe,
0,0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,imp+(imp*iva),
0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,0,0,0,siniva,
0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,0,0,0,round((siniva*.065),2),
0,0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,0,0,0,corregido,
0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,0,0,0,round((corregido*.30),2),
0,0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,0,0,0,sum(corregido),
0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,0,0,0,sum(corregido*.07),
0,0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);

$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,sum(siniva),
0,0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>10  and clave1<>20 and clave1<=29 and tipo2='F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9x = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,sum(siniva),
0,0,0
 from desarrollo.cortes_g where
 clave1>0  and clave1<>20 and clave1<=29 and tipo2<>'F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,0,0,0,sum(a.venta*a.cos),
0,0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10 = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*(( c.$importe*100)/b.$importe)/100)
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0 and c.$importe>0
";
$q10x = $this->db->query($s10x);
///////generar utilidad contado
///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,0,0,0,(a.$importe-b.$importe),
0,0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10)
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);

/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,0,0,0,(a.neto),
0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,0,0,0,(a.com),
0,0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,0,0,0,sum(a.nota),
0,0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,0,0,0,sum(siniva),
0,0,0
 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}
//////////////////////////////////////////*************************************************************SEPTIEMBRE
//////////////////////////////////////////*************************************************************OCTUBRE
if($m10==$mes){
        ///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,importe,
0,0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,imp+(imp*iva),
0,0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0,0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,0,0,0,0,siniva,
0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,0,0,0,0,round((siniva*.065),2),
0,0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,0,0,0,0,corregido,
0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,0,0,0,0,round((corregido*.30),2),
0,0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,0,0,0,0,sum(corregido),
0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,0,0,0,0,sum(corregido*.07),
0,0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);

$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,0,sum(siniva),
0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>10 and clave1<>20  and clave1<=29 and tipo2='F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9x = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,0,sum(siniva),
0,0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>20  and clave1<=29  and tipo2<>'F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,0,0,0,0,sum(a.venta*a.cos),
0,0
from vtadc.venta a
where aaa=$aaa and mes=$mes group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10 = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*(( c.$importe*100)/b.$importe)/100)
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0  and c.$importe>0
";
$q10x = $this->db->query($s10x);
///////generar utilidad contado
///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,0,0,0,0,(a.$importe-b.$importe),
0,0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10)
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);

/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,0,0,0,0,(a.neto),
0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,0,0,0,0,(a.com),
0,0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,0,0,0,0,sum(a.nota),
0,0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,0,0,0,0,sum(siniva),
0,0
 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}
//////////////////////////////////////////*************************************************************OCTUBRE
//////////////////////////////////////////*************************************************************NOVIEMBRE
if($m11==$mes){
            ///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,0,importe,
0
from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,0,imp+(imp*iva),
0
from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2),
0
from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,0,0,0,0,0,siniva,
0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,0,0,0,0,0,round((siniva*.065),2),
0
 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,0,0,0,0,0,corregido,
0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,0,0,0,0,0,round((corregido*.30),2),
0
 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,0,0,0,0,0,sum(corregido),
0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,0,0,0,0,0,sum(corregido*.07),
0
 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);


$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,0,0,sum(siniva),
0
 from desarrollo.cortes_g where
 clave1>0 and clave1<>10  and clave1<>20 and clave1<=29 and tipo='F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9x = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,0,0,sum(siniva),
0
 from desarrollo.cortes_g where
 clave1>0  and clave1<>20 and clave1<=29 and tipo<>'F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,0,0,0,0,0,sum(a.venta*a.cos),
0
from vtadc.venta a
where aaa=$aaa and mes=$mes group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10 = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*(( c.$importe*100)/b.$importe)/100)
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0  and c.$importe>0
";
$q10x = $this->db->query($s10x);
///////generar utilidad contado
///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,0,0,0,0,0,(a.$importe-b.$importe),
0
from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10)
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);

/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,0,0,0,0,0,(a.neto),
0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,0,0,0,0,0,(a.com),
0
from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,0,0,0,0,0,sum(a.nota),
0
from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,0,0,0,0,0,sum(siniva),
0
 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}

//////////////////////////////////////////*************************************************************NOVIEMBRE
//////////////////////////////////////////*************************************************************DICIEMBRE
if($m12==$mes){
            ///Gastos contables del as 400 rembolsos
 $s1="insert into vtadc.gastos_c(
aaa,  auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,0,0,importe

from vtadc.gasto where aaa=$aaa and mes=$mes)
on duplicate key update  $importe=values($importe)
";
$q1 = $this->db->query($s1);
////rentas personas morales
 $s2="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,0,0,imp+(imp*iva)

from catalogo.cat_bene_auxi_suc where auxi=7004)
on duplicate key update  $importe=values($importe)
";
$q2 = $this->db->query($s2);
////rentas personas fisicas
 $s3="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,auxi,suc,
0,0,0,0,0,0,0,0,0,0,0,round((imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))),2)

from catalogo.cat_bene_auxi_suc where auxi=7003 and suc>100 and suc<1999)
on duplicate key update  $importe=values($importe)
";
$q3 = $this->db->query($s3);
//////venta recarga telcel
 $s4="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,3,suc,
0,0,0,0,0,0,0,0,0,0,0,siniva

 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q4 = $this->db->query($s4);
///////utilidad recarga telcel
 $s5="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,13,suc,
0,0,0,0,0,0,0,0,0,0,0,round((siniva*.065),2)

 from desarrollo.cortes_g where clave1=20 and fecha='$fec')
on duplicate key update  $importe=values($importe)
";
$q5 = $this->db->query($s5);

//////venta Gontor solo fenix
 $s6="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,4,suc,
0,0,0,0,0,0,0,0,0,0,0,corregido

 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q6 = $this->db->query($s6);

///utilidad gontor solo fenix
 $s7="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,14,suc,
0,0,0,0,0,0,0,0,0,0,0,round((corregido*.30),2)

 from desarrollo.cortes_g where clave1=10 and fecha='$fec' and tipo2='F')
on duplicate key update  $importe=values($importe)
";
$q7 = $this->db->query($s7);

////venta credito
 $s8="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,2,suc,
0,0,0,0,0,0,0,0,0,0,0,sum(corregido)

 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q8 = $this->db->query($s8);

/////utilidad credito
 $s9="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,12,suc,
0,0,0,0,0,0,0,0,0,0,0,sum(corregido*.07)

 from desarrollo.cortes_g where
 clave1=30 and fecha='$fec'
 or
 clave1=40 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)
";
$q9 = $this->db->query($s9);


$s9x="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,0,0,0,sum(siniva)

 from desarrollo.cortes_g where
 clave1>0 and clave1<>10  and clave1<>20 and clave1<=29 and tipo2='F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9x = $this->db->query($s9x);
$s9xx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,1,suc,
0,0,0,0,0,0,0,0,0,0,0,sum(siniva)

 from desarrollo.cortes_g where
 clave1>0   and clave1<>20 and clave1<=29 and tipo2<>'F' and fecha='$fec' group by suc)
on duplicate key update  $importe=values($importe)
";
$q9xx = $this->db->query($s9xx);
/////actualizar el precio costo venta contado-
 $s10="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
aaa,10,a.sucursal,
0,0,0,0,0,0,0,0,0,0,0,sum(a.venta*a.cos)

from vtadc.venta a
where aaa=$aaa and mes=$mes group by a.sucursal
)
on duplicate key update  $importe=values($importe)
";
$q10 = $this->db->query($s10);
/////actualizar el precio costo venta contado-
 $s10x="update vtadc.gastos_c a, vtadc.gastos_c_1_2 b, vtadc.gastos_c c
set a.$importe=a.$importe-(a.$importe*(( c.$importe*100)/b.$importe)/100)
where a.auxi=10 and  a.suc=b.suc and a.suc=c.suc and a.aaa=$aaa and b.aaa=$aaa and c.aaa=$aaa and c.auxi=2 and a.$importe>0  and c.$importe>0
";
$q10x = $this->db->query($s10x);
///////generar utilidad contado
///////generar utilidad contado
 $s11="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,11,a.suc,
0,0,0,0,0,0,0,0,0,0,0,(a.$importe+b.$importe)

from vtadc. gastos_c a
left join vtadc.gastos_c b on a.suc=b.suc

where a.aaa=$aaa and a.auxi=1 and b.auxi=10)
on duplicate key update  $importe=values($importe)
";
$q11 = $this->db->query($s11);

/////////////gastos de nomina
 $s12="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1004,a.suc,
0,0,0,0,0,0,0,0,0,0,0,(a.neto)

from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)
";
$q12 = $this->db->query($s12);

/////////////nomina de premiso y comisiones
 $s13="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,1005,a.suc,
0,0,0,0,0,0,0,0,0,0,0,(a.com)

from desarrollo.nomina_mes a
where a.aaa=$aaa and a.mes=$mes and a.suc>100 and a.suc<1999)
on duplicate key update  $importe=values($importe)";
$q13 = $this->db->query($s13);
///////////// notas de credito de mercadotecnia u ofertas
 $s14="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,21,a.suc,
0,0,0,0,0,0,0,0,0,0,0,sum(a.nota)

from vtadc.oferta_nota_det a
where a.aaa=$aaa and a.mes=$mes group by a.mes,a.suc)
on duplicate key update  $importe=values($importe)";
$q14 = $this->db->query($s14);
///////////// solo perfumeria para evaluar notas
 $s15="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
$aaa,20,suc,
0,0,0,0,0,0,0,0,0,0,0,sum(siniva)

 from desarrollo.cortes_g where
 clave1=2 and fecha='$fec'  group by suc)
on duplicate key update  $importe=values($importe)";
$q15 = $this->db->query($s15);
}

//////////////////////////////////////////*************************************************************DICIEMBRE    
$sllx="insert into vtadc.gastos_c(
aaa, auxi, suc,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12)
(select
a.aaa,2037,a.suc,
sum(importe1)*.27,
sum(importe2)*.27,
sum(importe3)*.27,
sum(importe4)*.27,
sum(importe5)*.27,
sum(importe6)*.27,
sum(importe7)*.27,
sum(importe8)*.27,
sum(importe9)*.27,
sum(importe10)*.27,
sum(importe11)*.27,
sum(importe12)*.27
from vtadc.gastos_c a
where 
a.aaa=$aaa and a.suc>100 and a.suc<1999 and a.auxi=1004 
or
a.aaa=$aaa and a.suc>100 and a.suc<1999 and a.auxi=1005
group by suc)
on duplicate key update  
importe1=values(importe1),
importe2=values(importe2),
importe3=values(importe3),
importe4=values(importe4),
importe5=values(importe5),
importe6=values(importe6),
importe7=values(importe7),
importe8=values(importe8),
importe9=values(importe9),
importe10=values(importe10),
importe11=values(importe11),
importe12=values(importe12)
";
$qllx = $this->db->query($sllx);
///////////////////////////////////////////actualiza cia en gastos_c
$scia="update vtadc.gastos_c a, catalogo.sucursal b set a.cia=b.cia where a.suc=b.suc";
$qcia = $this->db->query($scia);

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_cat_pdv()
{
    
$sqlx="select *from catalogo.almacen where 
sec>=1 and sec<=2000  and codigo<>0 and vtagen>0 and tsec<>'M'
or 
sec>=3000 and sec<=3999 and codigo<>0 and vtagen>0  and tsec<>'M'";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
  
    $File = "./txt/catgen.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
if($rowx->lin==1 and $rowx->sublin==5){$sublin=4;}else{$sublin=$rowx->sublin;}
$inv='S';
if($rowx->sec>=3032 and $rowx->sec<=3043){$inv='N';}
$susa1=substr($rowx->susa1,0,50);
$susa2=substr($rowx->susa2,0,50);
$s1="select *from catalogo.cat_naturistas where sec=$rowx->sec";
$q1 = $this->db->query($s1);
if($q1->num_rows() > 0){$natur=1;}else{$natur=0;}
$s2="select *from catalogo.antibiotico where sec=$rowx->sec or cod=$rowx->codigo";
$q2 = $this->db->query($s2);
if($q2->num_rows() > 0){$antibio='S';}else{$antibio='N';} 
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa1),50," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($sublin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->vtagen,12,"0",STR_PAD_LEFT)
        .str_pad($rowx->sec,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa2),50," ",STR_PAD_RIGHT)
        .str_pad($antibio,1," ",STR_PAD_LEFT)
        .str_pad($natur,1," ",STR_PAD_LEFT)
        .str_pad($inv,1," ",STR_PAD_LEFT)
        .str_pad($rowx->vtagen,12,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 
}

///////////////////doctor descuento

$sqlx="select *from catalogo.almacen where 
sec>=1 and sec<=2000 and codigo<>0 and vtaddr>0 and tsec<>'M'
or 
sec>=3000 and sec<=3999 and codigo<>0 and vtaddr>0 and tsec<>'M'";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/catddr.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
if($rowx->lin==1 and $rowx->sublin==5){$sublin=4;}else{$sublin=$rowx->sublin;}
$susa1=substr($rowx->susa1,0,50);
$susa2=substr($rowx->susa2,0,50);

  $inv ='S';
  if($rowx->sec>=3032 and $rowx->sec<=3043){$inv='N';}
$s1="select *from catalogo.cat_naturistas where sec=$rowx->sec";
$q1 = $this->db->query($s1);
if($q1->num_rows() > 0){$natur=1;}else{$natur=0;}
$s2="select *from catalogo.antibiotico where sec=$rowx->sec or cod=$rowx->codigo";
$q2 = $this->db->query($s2);
if($q2->num_rows() > 0){$antibio='S';}else{$antibio='N';} 
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa1),50," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($sublin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->vtaddr,12,"0",STR_PAD_LEFT)
        .str_pad($rowx->sec,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa2),50," ",STR_PAD_RIGHT)
        .str_pad($antibio,1," ",STR_PAD_LEFT)
        .str_pad($natur,1," ",STR_PAD_LEFT)
        .str_pad($inv,1," ",STR_PAD_LEFT)
        .str_pad($rowx->vtaddr,12,"0",STR_PAD_LEFT)

        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle);
}
///////////////////FARMABODEGA

$sqlx="select *from catalogo.almacen where sec>0 and sec<=2000 and vtabo>0 and codigo>0  and tsec<>'M'";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
     $File = "./txt/catbod.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
if($rowx->lin==1 and $rowx->sublin==5){$sublin=4;}else{$sublin=$rowx->sublin;}
$susa1=substr($rowx->susa1,0,50);
$susa2=substr($rowx->susa2,0,50);

$inv ='S';
if($rowx->sec>=3032 and $rowx->sec<=3043){$inv='N';}
$natur=0;
$s2="select *from catalogo.antibiotico where sec=$rowx->sec or cod=$rowx->codigo";
$q2 = $this->db->query($s2);
if($q2->num_rows() > 0){$antibio='S';}else{$antibio='N';} 
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa1),50," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($sublin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->vtabo,12,"0",STR_PAD_LEFT)
        .str_pad($rowx->clabo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa2),50," ",STR_PAD_RIGHT)
        .str_pad($antibio,1," ",STR_PAD_LEFT)
        .str_pad($natur,1," ",STR_PAD_LEFT)
        .str_pad($inv,1," ",STR_PAD_LEFT)
        .str_pad($rowx->vtabo,12,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle);
}


$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\arcenv.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\SUC1601.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\SUC1602.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\SUC1603.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\arcenv.zip') === TRUE) {
$zip->addFile('./txt/catgen.txt', 'catgen.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\arcenv.zip') === TRUE) {
$zip->addFile('./txt/catddr.txt', 'catddr.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}  
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function proceso_vtas_diarias($aaa,$mes){
    $me1=1;
	$me2=2;
	$me3=3;
	$me4=4;
	$me5=5;
	$me6=6;
	$me7=7;
	$me8=8;
	$me9=9;
	$me10=10;
	$me11=11;
	$me12=12;
$fecc=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);    
$s1="insert into vtadc.venta_detalle (suc, fecha, tiket, codigo, descri, can, vta, des, importe, iva,  nombre, dire, cedula, tarjeta, tipo,tventa,cancela)
(select suc, fecha, tic, cod, des, cann, round((imp/cann),2),0, imp,0,'','',0,0,0,vtatip,cancelado from vtadc.vta_backoffice where date_format(fecha,'%Y')=$aaa and date_format(fecha,'%m')=$mes)
on duplicate key update can=values(can),importe=values(importe),vta=values(vta),tventa=values(tventa),cancela=values(cancela)";
$this->db->query($s1);
$sjorge="insert ignore into vtadc.venta_detalle_nat
(suc, fecha, tiket, codigo, descri, can, vta, des, importe, iva, nombre, dire, cedula, tarjeta, tipo, tventa, consecu, nomina, cancela, sec)
(SELECT
v.suc, v.fecha, v.tiket, v.codigo, v.descri, v.can, v.vta, v.des, v.importe, v.iva,  v.nombre, v.dire, v.cedula, v.tarjeta, v.tipo, v.tventa, v.consecu, v.nomina, v.cancela, b.sec
FROM vtadc.venta_detalle v
left join catalogo.almacen a on v.codigo=a.codigo
left join catalogo.cat_naturistas b on b.sec=a.sec
left join catalogo.sucursal c on c.suc=v.suc
where date_format(fecha, '%Y-%m') >='$fecc'  and tipo2<>'F'
and b.sec is not null)";
$this->db->query($sjorge);

$sjorge1="update
vtadc.venta_detalle_nat a, vtadc.cancelados b
set a.cancela=b.pieza, a.imp_cancela=b.impor
where a.suc=b.suc and a.fecha=b.fecha and a.tiket=b.tiket and a.codigo=b.codigo and date_format(a.fecha,'%Y')=$aaa and date_format(a.fecha,'%m')=$mes
";
$this->db->query($sjorge1);


$s3="insert into vtadc.venta_ctl(fecha, suc, can, imp )
(select fecha, suc, sum(can), sum(importe) from vtadc.venta_detalle where date_format(fecha,'%Y')=$aaa and date_format(fecha,'%m')=$mes and can>0
group by fecha,suc)
on duplicate key update can=values(can),imp=values(imp)";
$this->db->query($s3);
$s="update vtadc.venta_ctl a, desarrollo.cortes_c b, desarrollo.cortes_d_c01_c40 c
set cortes=corregido
where a.fecha=b.fechacorte and b.id=c.id_cc and  a.suc=b.suc and a.fecha>='2013-03-01' ";
$this->db->query($s);

$sfec="update catalogo.sucursal a
set fecha_ultima_vta=
case when
(SELECT max(fecha) FROM vtadc.venta_ctl where fecha>=date_sub(date(now()),interval 7 day) and suc=a.suc group by suc order by suc,fecha desc) is not null
then
(SELECT max(fecha) FROM vtadc.venta_ctl where fecha>=date_sub(date(now()),interval 7 day) and suc=a.suc group by suc order by suc,fecha desc)
else
'0000-00-00'
end
where tlid=1 and suc>100 and suc<=1999 and dia<>' '
";
$this->db->query($sfec);
$s2="INSERT INTO VTADC.venta(aaa, mes, sucursal, codigo, descripcion, venta, importe, lin, sublin)
(SELECT date_format(fecha,'%Y'), date_format(fecha,'%m'), suc,  codigo, descri, sum(can)-sum(cancela), sum(importe)-(sum(cancela*vta)-sum(cancela*des)), 0,0 
from vtadc.venta_detalle where date_format(fecha,'%Y')=$aaa and date_format(fecha,'%m')=$mes group by date_format(fecha,'%Y-%m'),suc,codigo)
on duplicate key update venta=values(venta),importe=values(importe)";
$this->db->query($s2);

///Procesos generados mara mirey y marysol de desplazamientos.
//$sx="insert vtadc.fe_prox (
//aaa, grupo, nlab, lab, codigo, descri,
//venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5, venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10, venta_act_11, venta_act_12, venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5, venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10, venta_ant_11, venta_ant_12, importe_act_1, importe_act_2, importe_act_3, importe_act_4, importe_act_5, importe_act_6, importe_act_7, importe_act_8, importe_act_9, importe_act_10, importe_act_11, importe_act_12, importe_ant_1, importe_ant_2, importe_ant_3, importe_ant_4, importe_ant_5, importe_ant_6, importe_ant_7, importe_ant_8, importe_ant_9, importe_ant_10, importe_ant_11, importe_ant_12, inv
//)
//(select $aaa,'FERNANDO', 105,'NATURISTAS',b.codigo,b.susa2,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0 from catalogo.cat_naturistas a
//left join catalogo.almacen b on b.sec=a.sec)
//on duplicate key update descri=values(descri);";
//$this->db->query($sx);

if($mes==$me1){

$sx1="insert into vtadc.producto_mes_suc (aaa, codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12 ,suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab, sum(venta),0,0,0,0,0,0,0,0,0,0,0, sum(importe),0,0,0,0,0,0,0,0,0,0,0, sucursal,descripcion,sum(inv),sec, cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me1 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta1=values(venta1),importe1=values(importe1),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////mes febrero
if($mes==$me2){
$sx1="insert into vtadc.producto_mes_suc (aaa, codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab, 0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0,0,0,0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo 
from vtadc.venta where aaa=$aaa and mes=$me2 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta2=values(venta2),importe2=values(importe2),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me3){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab, 0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0,0,0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me3 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta3=values(venta3),importe3=values(importe3),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me4){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0,0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me4 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta4=values(venta4),importe4=values(importe4),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me5){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me5 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta5=values(venta5),importe5=values(importe5),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me6){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me6 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta6=values(venta6),importe6=values(importe6),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me7){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me7 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta7=values(venta7),importe7=values(importe7),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me8){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me8 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta8=values(venta8),importe8=values(importe8),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me9){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me9 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta9=values(venta9),importe9=values(importe9),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me10){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,0, sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me10 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta10=values(venta10),importe10=values(importe10),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}
//////////////////////////////////////////////////////
if($mes==$me11){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),0,sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me11 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta11=values(venta11),importe11=values(importe11),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);

}
//////////////////////////////////////////////////////
if($mes==$me12){
$sx1="insert into vtadc.producto_mes_suc (aaa,  codigo, lin, sublin, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, suc,descripcion,inv,sec,cia,sup,ger,tipo)(SELECT aaa,  codigo, lin, sublin,lab,0,0,0,0,0,0,0,0,0,0,0,sum(venta),0,0,0,0,0,0,0,0,0,0, 0,sum(importe),sucursal,descripcion,sum(inv),sec,cia, sup,ger,tipo
from vtadc.venta where aaa=$aaa and mes=$me12 group by aaa,mes,codigo,sucursal,sec)
on duplicate key update venta12=values(venta12),importe12=values(importe12),lab=values(lab),descripcion=values(descripcion),inv=values(inv)";
$this->db->query($sx1);
}

$sz1="update vtadc.producto_mes_suc a, catalogo.sucursal b
set a.tipo=b.tipo2
where a.suc=b.suc and a.tipo=' '";
$this->db->query($sz1);
$sz2="update vtadc.producto_mes_suc a, catalogo.almacen b
set a.sec=b.sec
where a.codigo=b.codigo and a.sec=0 and b.sec>0 and b.sec<=2000";
$this->db->query($sz2);
$sz2="insert into vtadc.producto_mes(
aaa, codigo, lin, sublin, descripcion, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9,
venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9,
importe10, importe11, importe12, inv, sec)
(select aaa, codigo, lin, sublin, descripcion, lab,
sum(venta1),sum(venta2),
sum(venta3),sum(venta4),
sum(venta5),sum(venta6),
sum(venta7),sum(venta8),
sum(venta9),sum(venta10),
sum(venta11),sum(venta12),
sum(importe1),sum(importe2),
sum(importe3),sum(importe4),
sum(importe5),sum(importe6),
sum(importe7),sum(importe8),
sum(importe9),sum(importe10),
sum(importe11),sum(importe12),
0,sec
from vtadc.producto_mes_suc group by aaa,sec,codigo)
on duplicate key update
venta1=values(venta1),importe1=values(importe1),
venta2=values(venta2),importe2=values(importe2),
venta3=values(venta3),importe3=values(importe3),
venta4=values(venta4),importe4=values(importe4),
venta5=values(venta5),importe5=values(importe5),
venta6=values(venta6),importe6=values(importe6),
venta7=values(venta7),importe7=values(importe7),
venta8=values(venta8),importe8=values(importe8),
venta9=values(venta9),importe9=values(importe9),
venta10=values(venta10),importe10=values(importe10),
venta11=values(venta11),importe11=values(importe11),
venta12=values(venta12),importe12=values(importe12)
";
$this->db->query($sz2);
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////grabar CONCENTRADOS EN DESPLAZAMIENTOS ESPECIFICOS DE DIRECCION
$sa1="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,

venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,c.suc,a.fami,

b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,

0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.n_prox a
left join vtadc.producto_mes_suc b on a.codigo=b.codigo
left join catalogo.suc_fenix c on c.suc=b.suc
where c.suc>0 and c.filtro=2)
on duplicate key update
venta_act_1=values(venta_act_1),
venta_act_2=values(venta_act_2),
venta_act_3=values(venta_act_3),
venta_act_4=values(venta_act_4),
venta_act_5=values(venta_act_5),
venta_act_6=values(venta_act_6),
venta_act_7=values(venta_act_7),
venta_act_8=values(venta_act_8),
venta_act_9=values(venta_act_9),
venta_act_10=values(venta_act_10),
venta_act_11=values(venta_act_11),
venta_act_12=values(venta_act_12);
"; $this->db->query($sa1);
///////////////////////////////////////////////////////////////////////////////

$sa2="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,
inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,c.suc,a.fami,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.n_prox a
left join vtadc.producto_mes_suc12 b on a.codigo=b.codigo
left join catalogo.suc_fenix c on c.suc=b.suc
where c.suc>0 and c.filtro=2)
on duplicate key update
venta_ant_1=values(venta_ant_1),
venta_ant_2=values(venta_ant_2),
venta_ant_3=values(venta_ant_3),
venta_ant_4=values(venta_ant_4),
venta_ant_5=values(venta_ant_5),
venta_ant_6=values(venta_ant_6),
venta_ant_7=values(venta_ant_7),
venta_ant_8=values(venta_ant_8),
venta_ant_9=values(venta_ant_9),
venta_ant_10=values(venta_ant_10),
venta_ant_11=values(venta_ant_11),
venta_ant_12=values(venta_ant_12);
"; $this->db->query($sa2);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////fernando fierro

//$sa3="insert into vtadc.fe_prox_det(aaa, grupo, lab,nlab, codigo, descri,suc,
//venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
//venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
//venta_act_11, venta_act_12,
//importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
//importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
//importe_act_11,importe_act_12,

//venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
//venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
//venta_ant_11, venta_ant_12,
//importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
//importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
//importe_ant_11,importe_ant_12,
//inv)

//(SELECT a.aaa, a.grupo,a.lab,a.nlab, a.codigo, a.descri,b.suc,
//b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
//b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
//b.venta11,b.venta12,
//b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
//b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
//b.importe11,b.importe12,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0
//from vtadc.fe_prox a
//left join vtadc.producto_mes_suc b on a.codigo=b.codigo
//where b.suc>0 and a.lab<>'NATURISTAS')
//on duplicate key update
//venta_act_1=values(venta_act_1),
//venta_act_2=values(venta_act_2),
//venta_act_3=values(venta_act_3),
//venta_act_4=values(venta_act_4),
//venta_act_5=values(venta_act_5),
//venta_act_6=values(venta_act_6),
//venta_act_7=values(venta_act_7),
//venta_act_8=values(venta_act_8),
//venta_act_9=values(venta_act_9),
//venta_act_10=values(venta_act_10),
//venta_act_11=values(venta_act_11),
//venta_act_12=values(venta_act_12),
//importe_act_1=values(importe_act_1),
//importe_act_2=values(importe_act_2),
//importe_act_3=values(importe_act_3),
//importe_act_4=values(importe_act_4),
//importe_act_5=values(importe_act_5),
//importe_act_6=values(importe_act_6),
//importe_act_7=values(importe_act_7),
//importe_act_8=values(importe_act_8),
//importe_act_9=values(importe_act_9),
//importe_act_10=values(importe_act_10),
//importe_act_11=values(importe_act_11),
//importe_act_12=values(importe_act_12)
//;
//"; $this->db->query($sa3);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
//$sa4="insert into vtadc.fe_prox_det(aaa, grupo, lab,nlab, codigo, descri,suc,
//venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
//venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
//venta_act_11, venta_act_12,
//importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
//importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
//importe_act_11,importe_act_12,

//venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
//venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
//venta_ant_11, venta_ant_12,
//importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
//importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
//importe_ant_11,importe_ant_12,
//inv)

//(SELECT a.aaa, a.grupo,a.lab,a.nlab, a.codigo, a.descri,b.suc,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
//b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
//b.venta11,b.venta12,
//b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
//b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
//b.importe11,b.importe12,
//0
//from vtadc.fe_prox a
//left join vtadc.producto_mes_suc12 b on a.codigo=b.codigo
//where b.suc>0 and a.lab<>'NATURISTAS')
//on duplicate key update
//venta_ant_1=values(venta_ant_1),
//venta_ant_2=values(venta_ant_2),
//venta_ant_3=values(venta_ant_3),
//venta_ant_4=values(venta_ant_4),
//venta_ant_5=values(venta_ant_5),
//venta_ant_6=values(venta_ant_6),
//venta_ant_7=values(venta_ant_7),
//venta_ant_8=values(venta_ant_8),
//venta_ant_9=values(venta_ant_9),
//venta_ant_10=values(venta_ant_10),
//venta_ant_11=values(venta_ant_11),
//venta_ant_12=values(venta_ant_12),
//importe_ant_1=values(importe_ant_1),
//importe_ant_2=values(importe_ant_2),
//importe_ant_3=values(importe_ant_3),
//importe_ant_4=values(importe_ant_4),
//importe_ant_5=values(importe_ant_5),
//importe_ant_6=values(importe_ant_6),
//importe_ant_7=values(importe_ant_7),
//importe_ant_8=values(importe_ant_8),
//importe_ant_9=values(importe_ant_9),
//importe_ant_10=values(importe_ant_10),
//importe_ant_11=values(importe_ant_11),
//importe_ant_12=values(importe_ant_12)
//;
//"; $this->db->query($sa4);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
//$sa5="insert into vtadc.fe_prox_det(aaa, grupo, lab,nlab, codigo, descri,suc,
//venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
//venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
//venta_act_11, venta_act_12,
//importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
//importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
//importe_act_11,importe_act_12,

//venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
//venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
//venta_ant_11, venta_ant_12,
//importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
//importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
//importe_ant_11,importe_ant_12,
//inv)

//(SELECT a.aaa, a.grupo,a.lab,a.nlab, a.codigo, a.descri,b.suc,
//b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
//b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
//b.venta11,b.venta12,
//b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
//b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
//b.importe11,b.importe12,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0
//from vtadc.fe_prox a
//left join vtadc.producto_mes_suc b on a.codigo=b.codigo
//left join catalogo.sucursal c on c.suc=b.suc
//where (c.suc>0 and a.lab='NATURISTAS' and c.tipo2='G')
//or(c.suc>0 and a.lab='NATURISTAS' and c.tipo2='D'))

//on duplicate key update
//venta_act_1=values(venta_act_1),
//venta_act_2=values(venta_act_2),
//venta_act_3=values(venta_act_3),
//venta_act_4=values(venta_act_4),
//venta_act_5=values(venta_act_5),
//venta_act_6=values(venta_act_6),
//venta_act_7=values(venta_act_7),
//venta_act_8=values(venta_act_8),
//venta_act_9=values(venta_act_9),
//venta_act_10=values(venta_act_10),
//venta_act_11=values(venta_act_11),
//venta_act_12=values(venta_act_12),
//importe_act_1=values(importe_act_1),
//importe_act_2=values(importe_act_2),
//importe_act_3=values(importe_act_3),
//importe_act_4=values(importe_act_4),
//importe_act_5=values(importe_act_5),
//importe_act_6=values(importe_act_6),
//importe_act_7=values(importe_act_7),
//importe_act_8=values(importe_act_8),
//importe_act_9=values(importe_act_9),
//importe_act_10=values(importe_act_10),
//importe_act_11=values(importe_act_11),
//importe_act_12=values(importe_act_12)
//;
//"; $this->db->query($sa5);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
//$sa6="insert into vtadc.fe_prox_det(aaa, grupo, lab, nlab, codigo, descri,suc,
//venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
//venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
//venta_act_11, venta_act_12,
//importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
//importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
//importe_act_11,importe_act_12,

//venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
//venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
//venta_ant_11, venta_ant_12,
//importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
//importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
//importe_ant_11,importe_ant_12,
//inv)

//(SELECT a.aaa, a.grupo,a.lab,a.nlab, a.codigo, a.descri,b.suc,
//0,0,0,0,0,0,0,0,0,0,0,0,
//0,0,0,0,0,0,0,0,0,0,0,0,
//b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
//b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
//b.venta11,b.venta12,
//b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
//b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
//b.importe11,b.importe12,
//0
//from vtadc.fe_prox a
//left join vtadc.producto_mes_suc12 b on a.codigo=b.codigo
//left join catalogo.sucursal c on c.suc=b.suc
//where (c.suc>0 and a.lab='NATURISTAS' and c.tipo2='G')
//or(c.suc>0 and a.lab='NATURISTAS' and c.tipo2='D'))
//on duplicate key update
//venta_ant_1=values(venta_ant_1),
//venta_ant_2=values(venta_ant_2),
//venta_ant_3=values(venta_ant_3),
//venta_ant_4=values(venta_ant_4),
//venta_ant_5=values(venta_ant_5),
//venta_ant_6=values(venta_ant_6),
//venta_ant_7=values(venta_ant_7),
//venta_ant_8=values(venta_ant_8),
//venta_ant_9=values(venta_ant_9),
//venta_ant_10=values(venta_ant_10),
//venta_ant_11=values(venta_ant_11),
//venta_ant_12=values(venta_ant_12),
//importe_ant_1=values(importe_ant_1),
//importe_ant_2=values(importe_ant_2),
//importe_ant_3=values(importe_ant_3),
//importe_ant_4=values(importe_ant_4),
//importe_ant_5=values(importe_ant_5),
//importe_ant_6=values(importe_ant_6),
//importe_ant_7=values(importe_ant_7),
//importe_ant_8=values(importe_ant_8),
//importe_ant_9=values(importe_ant_9),
//importe_ant_10=values(importe_ant_10),
//importe_ant_11=values(importe_ant_11),
//importe_ant_12=values(importe_ant_12)
//;
//"; $this->db->query($sa6);
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////grabar CONCENTRADOS EN DESPLAZAMIENTOS ESPECIFICOS DE DIRECCION
$sb1="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,
inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,b.suc,a.fami,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.n_prox a
left join vtadc.producto_mes_suc b on a.codigo=b.codigo
where b.suc>0)
on duplicate key update
venta_actt_1=values(venta_actt_1),
venta_actt_2=values(venta_actt_2),
venta_actt_3=values(venta_actt_3),
venta_actt_4=values(venta_actt_4),
venta_actt_5=values(venta_actt_5),
venta_actt_6=values(venta_actt_6),
venta_actt_7=values(venta_actt_7),
venta_actt_8=values(venta_actt_8),
venta_actt_9=values(venta_actt_9),
venta_actt_10=values(venta_actt_10),
venta_actt_11=values(venta_actt_11),
venta_actt_12=values(venta_actt_12)
"; $this->db->query($sb1);

///////////////////////////////////////////////////////////////////////////////
$sb2="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,
inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,b.suc,a.fami,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
0
from vtadc.n_prox a
left join vtadc.producto_mes_suc12 b on a.codigo=b.codigo
where b.suc>0)
on duplicate key update
venta_antt_1=values(venta_antt_1),
venta_antt_2=values(venta_antt_2),
venta_antt_3=values(venta_antt_3),
venta_antt_4=values(venta_antt_4),
venta_antt_5=values(venta_antt_5),
venta_antt_6=values(venta_antt_6),
venta_antt_7=values(venta_antt_7),
venta_antt_8=values(venta_antt_8),
venta_antt_9=values(venta_antt_9),
venta_antt_10=values(venta_antt_10),
venta_antt_11=values(venta_antt_11),
venta_antt_12=values(venta_antt_12);
"; $this->db->query($sb2);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
//Cuando necesitan de todas las surcursales lo que se ha vendido
///////////////////////////////////////////////////////////////////////////////
$sb3="insert into vtadc.nn_prox_det(aaa, grupo, lab,nlab, codigo, descri,suc,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
importe_act_11,importe_act_12,

venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
importe_ant_11,importe_ant_12,
inv)

(SELECT a.aaa, a.grupo,a.lab,a.nlab, a.codigo, a.descri,b.suc,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
b.importe11,b.importe12,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.nn_prox a
left join vtadc.producto_mes_suc b on a.codigo=b.codigo
where b.suc>0)
on duplicate key update
venta_act_1=values(venta_act_1),
venta_act_2=values(venta_act_2),
venta_act_3=values(venta_act_3),
venta_act_4=values(venta_act_4),
venta_act_5=values(venta_act_5),
venta_act_6=values(venta_act_6),
venta_act_7=values(venta_act_7),
venta_act_8=values(venta_act_8),
venta_act_9=values(venta_act_9),
venta_act_10=values(venta_act_10),
venta_act_11=values(venta_act_11),
venta_act_12=values(venta_act_12),
importe_act_1=values(importe_act_1),
importe_act_2=values(importe_act_2),
importe_act_3=values(importe_act_3),
importe_act_4=values(importe_act_4),
importe_act_5=values(importe_act_5),
importe_act_6=values(importe_act_6),
importe_act_7=values(importe_act_7),
importe_act_8=values(importe_act_8),
importe_act_9=values(importe_act_9),
importe_act_10=values(importe_act_10),
importe_act_11=values(importe_act_11),
importe_act_12=values(importe_act_12)
;
"; $this->db->query($sb3);
///////////////////////////////////////////////////////////////////////////////
$sb4="insert into vtadc.nn_prox_det(aaa, grupo, lab,nlab, codigo, descri,suc,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
importe_act_11,importe_act_12,

venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
importe_ant_11,importe_ant_12,
inv)

(SELECT a.aaa, a.grupo,a.lab,a.nlab, a.codigo, a.descri,b.suc,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
b.importe11,b.importe12,

0
from vtadc.nn_prox a
left join vtadc.producto_mes_suc12 b on a.codigo=b.codigo
where b.suc>0)
on duplicate key update
venta_ant_1=values(venta_ant_1),
venta_ant_2=values(venta_ant_2),
venta_ant_3=values(venta_ant_3),
venta_ant_4=values(venta_ant_4),
venta_ant_5=values(venta_ant_5),
venta_ant_6=values(venta_ant_6),
venta_ant_7=values(venta_ant_7),
venta_ant_8=values(venta_ant_8),
venta_ant_9=values(venta_ant_9),
venta_ant_10=values(venta_ant_10),
venta_ant_11=values(venta_ant_11),
venta_ant_12=values(venta_ant_12),
importe_ant_1=values(importe_ant_1),
importe_ant_2=values(importe_ant_2),
importe_ant_3=values(importe_ant_3),
importe_ant_4=values(importe_ant_4),
importe_ant_5=values(importe_ant_5),
importe_ant_6=values(importe_ant_6),
importe_ant_7=values(importe_ant_7),
importe_ant_8=values(importe_ant_8),
importe_ant_9=values(importe_ant_9),
importe_ant_10=values(importe_ant_10),
importe_ant_11=values(importe_ant_11),
importe_ant_12=values(importe_ant_12)
;
"; $this->db->query($sb4);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////s_prox
////////////////////
$sb5="insert into vtadc.s_prox_det(aaa, lab,nlab, codigo, descri,suc,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
importe_act_11,importe_act_12,

venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
importe_ant_11,importe_ant_12,
inv)

(SELECT a.aaa, a.lab, a.nlab,a.codigo, a.descri,b.suc,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
b.importe11,b.importe12,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.s_prox a
left join vtadc.producto_mes_suc b on a.codigo=b.codigo
where b.suc>0)
on duplicate key update
venta_act_1=values(venta_act_1),
venta_act_2=values(venta_act_2),
venta_act_3=values(venta_act_3),
venta_act_4=values(venta_act_4),
venta_act_5=values(venta_act_5),
venta_act_6=values(venta_act_6),
venta_act_7=values(venta_act_7),
venta_act_8=values(venta_act_8),
venta_act_9=values(venta_act_9),
venta_act_10=values(venta_act_10),
venta_act_11=values(venta_act_11),
venta_act_12=values(venta_act_12),
importe_act_1=values(importe_act_1),
importe_act_2=values(importe_act_2),
importe_act_3=values(importe_act_3),
importe_act_4=values(importe_act_4),
importe_act_5=values(importe_act_5),
importe_act_6=values(importe_act_6),
importe_act_7=values(importe_act_7),
importe_act_8=values(importe_act_8),
importe_act_9=values(importe_act_9),
importe_act_10=values(importe_act_10),
importe_act_11=values(importe_act_11),
importe_act_12=values(importe_act_12)
;
"; $this->db->query($sb5);
///////////////////////////////////////////////////////////////////////////////
$sb6="insert into vtadc.s_prox_det(aaa, lab,nlab, codigo, descri,suc,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
importe_act_1,importe_act_2,importe_act_3,importe_act_4,importe_act_5,
importe_act_6,importe_act_7,importe_act_8,importe_act_9,importe_act_10,
importe_act_11,importe_act_12,

venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
importe_ant_1,importe_ant_2,importe_ant_3,importe_ant_4,importe_ant_5,
importe_ant_6,importe_ant_7,importe_ant_8,importe_ant_9,importe_ant_10,
importe_ant_11,importe_ant_12,
inv)

(SELECT a.aaa, a.lab,a.nlab, a.codigo, a.descri,b.suc,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
b.importe1,b.importe2,b.importe3,b.importe4,b.importe5,
b.importe6,b.importe7,b.importe8,b.importe9,b.importe10,
b.importe11,b.importe12,

0
from vtadc.s_prox a
left join vtadc.producto_mes_suc12 b on a.codigo=b.codigo
where b.suc>0)
on duplicate key update
venta_ant_1=values(venta_ant_1),
venta_ant_2=values(venta_ant_2),
venta_ant_3=values(venta_ant_3),
venta_ant_4=values(venta_ant_4),
venta_ant_5=values(venta_ant_5),
venta_ant_6=values(venta_ant_6),
venta_ant_7=values(venta_ant_7),
venta_ant_8=values(venta_ant_8),
venta_ant_9=values(venta_ant_9),
venta_ant_10=values(venta_ant_10),
venta_ant_11=values(venta_ant_11),
venta_ant_12=values(venta_ant_12),
importe_ant_1=values(importe_ant_1),
importe_ant_2=values(importe_ant_2),
importe_ant_3=values(importe_ant_3),
importe_ant_4=values(importe_ant_4),
importe_ant_5=values(importe_ant_5),
importe_ant_6=values(importe_ant_6),
importe_ant_7=values(importe_ant_7),
importe_ant_8=values(importe_ant_8),
importe_ant_9=values(importe_ant_9),
importe_ant_10=values(importe_ant_10),
importe_ant_11=values(importe_ant_11),
importe_ant_12=values(importe_ant_12)
;
"; $this->db->query($sb6);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sc1="update vtadc.s_prox set inv=0"; $this->db->query($sc1);
$sc2="update vtadc.n_prox set inv=0"; $this->db->query($sc2);
$sc3="update vtadc.nn_prox set inv=0"; $this->db->query($sc3);

$sc4="update vtadc.s_prox_det set inv=0"; $this->db->query($sc4);
$sc5="update vtadc.n_prox_det set inv=0"; $this->db->query($sc5);
$sc6="update vtadc.nn_prox_det set inv=0"; $this->db->query($sc6);

$sc7="insert into vtadc.n_prox_det(aaa, codigo, lab, nlab,suc,fami,inv)
(SELECT a.aaa, a.codigo, a.lab, a.nlab, b.suc,a.fami,cantidad
from vtadc.n_prox a
left join desarrollo.inv b on a.codigo=b.codigo
where b.suc>0 and date_format(fechai,'%Y')=$aaa)
on duplicate key update inv=values(inv)"; $this->db->query($sc7);

$sc8="insert into vtadc.nn_prox_det(aaa, codigo, lab,nlab, suc,grupo,descri,inv)
(SELECT a.aaa, a.codigo, a.lab, a.nlab, b.suc,a.grupo,a.descri,cantidad
from vtadc.nn_prox a
left join desarrollo.inv b on a.codigo=b.codigo
where b.suc>0 and date_format(fechai,'%Y')=$aaa)
on duplicate key update inv=values(inv)"; $this->db->query($sc8);

$sc9="insert into vtadc.s_prox_det(aaa, codigo, lab,nlab, suc,descri,inv)
(SELECT a.aaa, a.codigo, a.lab, a.nlab, b.suc,a.descri,cantidad
from vtadc.s_prox a
left join desarrollo.inv b on a.codigo=b.codigo
where b.suc>0 and date_format(fechai,'%Y')=$aaa)
on duplicate key update inv=values(inv)"; $this->db->query($sc9);
///////////////////////////////////////////////////////////////////////////////
    
	
//AÑO ANTERIOR Y ACTUAC DEL FILTRO DE LAS 75 FARMACIAS SOLAMENTE.
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
$sc10="update vtadc.n_prox a,vtadc.n_prox_det_aaa_lab_cod b set
a.venta_act_1=b.venta_act_1,
a.venta_act_2=b.venta_act_2,
a.venta_act_3=b.venta_act_3,
a.venta_act_4=b.venta_act_4,
a.venta_act_5=b.venta_act_5,
a.venta_act_6=b.venta_act_6,
a.venta_act_7=b.venta_act_7,
a.venta_act_8=b.venta_act_8,
a.venta_act_9=b.venta_act_9,
a.venta_act_10=b.venta_act_10,
a.venta_act_11=b.venta_act_11,
a.venta_act_12=b.venta_act_12,

a.venta_ant_1=b.venta_ant_1,
a.venta_ant_2=b.venta_ant_2,
a.venta_ant_3=b.venta_ant_3,
a.venta_ant_4=b.venta_ant_4,
a.venta_ant_5=b.venta_ant_5,
a.venta_ant_6=b.venta_ant_6,
a.venta_ant_7=b.venta_ant_7,
a.venta_ant_8=b.venta_ant_8,
a.venta_ant_9=b.venta_ant_9,
a.venta_ant_10=b.venta_ant_10,
a.venta_ant_11=b.venta_ant_11,
a.venta_ant_12=b.venta_ant_12,

a.venta_actt_1=b.venta_actt_1,
a.venta_actt_2=b.venta_actt_2,
a.venta_actt_3=b.venta_actt_3,
a.venta_actt_4=b.venta_actt_4,
a.venta_actt_5=b.venta_actt_5,
a.venta_actt_6=b.venta_actt_6,
a.venta_actt_7=b.venta_actt_7,
a.venta_actt_8=b.venta_actt_8,
a.venta_actt_9=b.venta_actt_9,
a.venta_actt_10=b.venta_actt_10,
a.venta_actt_11=b.venta_actt_11,
a.venta_actt_12=b.venta_actt_12,

a.venta_antt_1=b.venta_antt_1,
a.venta_antt_2=b.venta_antt_2,
a.venta_antt_3=b.venta_antt_3,
a.venta_antt_4=b.venta_antt_4,
a.venta_antt_5=b.venta_antt_5,
a.venta_antt_6=b.venta_antt_6,
a.venta_antt_7=b.venta_antt_7,
a.venta_antt_8=b.venta_antt_8,
a.venta_antt_9=b.venta_antt_9,
a.venta_antt_10=b.venta_antt_10,
a.venta_antt_11=b.venta_antt_11,
a.venta_antt_12=b.venta_antt_12,
a.inv=b.inv
where a.aaa=b.aaa and a.nlab=b.nlab and a.codigo=b.codigo
"; $this->db->query($sc10);
///////////////////////////////////////////////////////////////////////////////

$sc11="update vtadc.nn_prox a,vtadc.nn_prox_det_aaa_grup_lab_cod b set
a.venta_act_1=b.venta_act_1,
a.venta_act_2=b.venta_act_2,
a.venta_act_3=b.venta_act_3,
a.venta_act_4=b.venta_act_4,
a.venta_act_5=b.venta_act_5,
a.venta_act_6=b.venta_act_6,
a.venta_act_7=b.venta_act_7,
a.venta_act_8=b.venta_act_8,
a.venta_act_9=b.venta_act_9,
a.venta_act_10=b.venta_act_10,
a.venta_act_11=b.venta_act_11,
a.venta_act_12=b.venta_act_12,

a.venta_ant_1=b.venta_ant_1,
a.venta_ant_2=b.venta_ant_2,
a.venta_ant_3=b.venta_ant_3,
a.venta_ant_4=b.venta_ant_4,
a.venta_ant_5=b.venta_ant_5,
a.venta_ant_6=b.venta_ant_6,
a.venta_ant_7=b.venta_ant_7,
a.venta_ant_8=b.venta_ant_8,
a.venta_ant_9=b.venta_ant_9,
a.venta_ant_10=b.venta_ant_10,
a.venta_ant_11=b.venta_ant_11,
a.venta_ant_12=b.venta_ant_12,

a.importe_act_1=b.importe_act_1,
a.importe_act_2=b.importe_act_2,
a.importe_act_3=b.importe_act_3,
a.importe_act_4=b.importe_act_4,
a.importe_act_5=b.importe_act_5,
a.importe_act_6=b.importe_act_6,
a.importe_act_7=b.importe_act_7,
a.importe_act_8=b.importe_act_8,
a.importe_act_9=b.importe_act_9,
a.importe_act_10=b.importe_act_10,
a.importe_act_11=b.importe_act_11,
a.importe_act_12=b.importe_act_12,

a.importe_ant_1=b.importe_ant_1,
a.importe_ant_2=b.importe_ant_2,
a.importe_ant_3=b.importe_ant_3,
a.importe_ant_4=b.importe_ant_4,
a.importe_ant_5=b.importe_ant_5,
a.importe_ant_6=b.importe_ant_6,
a.importe_ant_7=b.importe_ant_7,
a.importe_ant_8=b.importe_ant_8,
a.importe_ant_9=b.importe_ant_9,
a.importe_ant_10=b.importe_ant_10,
a.importe_ant_11=b.importe_ant_11,
a.importe_ant_12=b.importe_ant_12,

a.inv=b.inv
where a.aaa=b.aaa and a.nlab=b.nlab and a.codigo=b.codigo
"; $this->db->query($sc11);
///////////////////////////////////////////////////////////////////////////////
$sc12="update vtadc.s_prox a,vtadc.s_prox_det_aaa_lab_cod b set
a.venta_act_1=b.venta_act_1,
a.venta_act_2=b.venta_act_2,
a.venta_act_3=b.venta_act_3,
a.venta_act_4=b.venta_act_4,
a.venta_act_5=b.venta_act_5,
a.venta_act_6=b.venta_act_6,
a.venta_act_7=b.venta_act_7,
a.venta_act_8=b.venta_act_8,
a.venta_act_9=b.venta_act_9,
a.venta_act_10=b.venta_act_10,
a.venta_act_11=b.venta_act_11,
a.venta_act_12=b.venta_act_12,

a.venta_ant_1=b.venta_ant_1,
a.venta_ant_2=b.venta_ant_2,
a.venta_ant_3=b.venta_ant_3,
a.venta_ant_4=b.venta_ant_4,
a.venta_ant_5=b.venta_ant_5,
a.venta_ant_6=b.venta_ant_6,
a.venta_ant_7=b.venta_ant_7,
a.venta_ant_8=b.venta_ant_8,
a.venta_ant_9=b.venta_ant_9,
a.venta_ant_10=b.venta_ant_10,
a.venta_ant_11=b.venta_ant_11,
a.venta_ant_12=b.venta_ant_12,

a.importe_act_1=b.importe_act_1,
a.importe_act_2=b.importe_act_2,
a.importe_act_3=b.importe_act_3,
a.importe_act_4=b.importe_act_4,
a.importe_act_5=b.importe_act_5,
a.importe_act_6=b.importe_act_6,
a.importe_act_7=b.importe_act_7,
a.importe_act_8=b.importe_act_8,
a.importe_act_9=b.importe_act_9,
a.importe_act_10=b.importe_act_10,
a.importe_act_11=b.importe_act_11,
a.importe_act_12=b.importe_act_12,

a.importe_ant_1=b.importe_ant_1,
a.importe_ant_2=b.importe_ant_2,
a.importe_ant_3=b.importe_ant_3,
a.importe_ant_4=b.importe_ant_4,
a.importe_ant_5=b.importe_ant_5,
a.importe_ant_6=b.importe_ant_6,
a.importe_ant_7=b.importe_ant_7,
a.importe_ant_8=b.importe_ant_8,
a.importe_ant_9=b.importe_ant_9,
a.importe_ant_10=b.importe_ant_10,
a.importe_ant_11=b.importe_ant_11,
a.importe_ant_12=b.importe_ant_12,

a.inv=b.inv
where a.aaa=b.aaa and a.nlab=b.nlab and a.codigo=b.codigo
"; $this->db->query($sc12);
///////////////////////////////////////////////////////////////////////////////
//$sc13="update vtadc.fe_prox a,vtadc.fe_prox_det_aaa_grupo_lab_cod b set
//a.venta_act_1=b.venta_act_1,
//a.venta_act_2=b.venta_act_2,
//a.venta_act_3=b.venta_act_3,
//a.venta_act_4=b.venta_act_4,
//a.venta_act_5=b.venta_act_5,
//a.venta_act_6=b.venta_act_6,
//a.venta_act_7=b.venta_act_7,
//a.venta_act_8=b.venta_act_8,
//a.venta_act_9=b.venta_act_9,
//a.venta_act_10=b.venta_act_10,
//a.venta_act_11=b.venta_act_11,
//a.venta_act_12=b.venta_act_12,

//a.venta_ant_1=b.venta_ant_1,
//a.venta_ant_2=b.venta_ant_2,
//a.venta_ant_3=b.venta_ant_3,
//a.venta_ant_4=b.venta_ant_4,
//a.venta_ant_5=b.venta_ant_5,
//a.venta_ant_6=b.venta_ant_6,
//a.venta_ant_7=b.venta_ant_7,
//a.venta_ant_8=b.venta_ant_8,
//a.venta_ant_9=b.venta_ant_9,
//a.venta_ant_10=b.venta_ant_10,
//a.venta_ant_11=b.venta_ant_11,
//a.venta_ant_12=b.venta_ant_12,

//a.importe_act_1=b.importe_act_1,
//a.importe_act_2=b.importe_act_2,
//a.importe_act_3=b.importe_act_3,
//a.importe_act_4=b.importe_act_4,
//a.importe_act_5=b.importe_act_5,
//a.importe_act_6=b.importe_act_6,
//a.importe_act_7=b.importe_act_7,
//a.importe_act_8=b.importe_act_8,
//a.importe_act_9=b.importe_act_9,
//a.importe_act_10=b.importe_act_10,
//a.importe_act_11=b.importe_act_11,
//a.importe_act_12=b.importe_act_12,

//a.importe_ant_1=b.importe_ant_1,
//a.importe_ant_2=b.importe_ant_2,
//a.importe_ant_3=b.importe_ant_3,
//a.importe_ant_4=b.importe_ant_4,
//a.importe_ant_5=b.importe_ant_5,
//a.importe_ant_6=b.importe_ant_6,
//a.importe_ant_7=b.importe_ant_7,
//a.importe_ant_8=b.importe_ant_8,
//a.importe_ant_9=b.importe_ant_9,
//a.importe_ant_10=b.importe_ant_10,
//a.importe_ant_11=b.importe_ant_11,
//a.importe_ant_12=b.importe_ant_12,

//a.inv=b.inv
//where a.aaa=b.aaa and a.grupo=b.grupo and a.nlab=b.nlab and a.codigo=b.codigo
//"; $this->db->query($sc13);
   
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


































}