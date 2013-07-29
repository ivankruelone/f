<?php
	class Envio_model_todo extends CI_Model {


    function cortes_a()
{
$s1="select a.suc,fecha,sum(corregido)as venta from cortes_a a where clave1>=1 and clave1<=29 group by suc,fecha";
$q1 = $this->db->query($s1);

$linea=null;
$mensaje=null;
    $File = "./txt/todo.txt";
    $Handle = fopen($File, 'w');

foreach($q1->result() as $r1)
{
$s2="select suc,fecha,sum(corregido)as credito from cortes_a where clave1=30 and fecha='$r1->fecha' and suc=$r1->suc 
or clave1=40 and fecha='$r1->fecha' and suc=$r1->suc group by suc,fecha";
$q2 = $this->db->query($s2);
if($q->num_rows()== 0){
$r2= $q2->row();
$credito=$r2->credito;
    
}
$s3="select suc,fecha,sum(corregido)as fal from cortes_a where clave1=92 and fecha='$r1->fecha' and suc=$r1->suc group by suc,fecha";
$q3 = $this->db->query($s3);
if($q->num_rows()== 0){
$r3= $q3->row();    
}
$s4="select suc,fecha,sum(corregido)as sob from cortes_a where clave1=93 and fecha='$r1->fecha' and suc=$r1->suc group by suc,fecha";
$q4 = $this->db->query($s4);
if($q->num_rows()== 0){
$r4= $q4->row();    
}
$s5="select suc,fecha,sum(corregido)as asalto from cortes_a  where clave1=94 and fecha='$r1->fecha' and suc=$r1->suc group by suc,fecha";
$q5 = $this->db->query($s5);
if($q->num_rows()== 0){
$r5= $q5->row();    
}
$s6="select suc,fecha,sum(corregido)as entrega from cortes_a where clave1>=50 and clave1<=78 and clave1>=82 and clave<=82 and fecha='$r1->fecha' and suc=$r1->suc group by suc,fecha";
$q6 = $this->db->query($s6);
if($q->num_rows()== 0){
$r6= $q6->row();
$entrega=(int)($r6->entrega*100);    
}
$s7="select suc,fecha,sum(corregido)as asalto from cortes_a where clave1=49 and fecha='$r1->fecha' and suc=$r1->suc group by suc,fecha";
$q7 = $this->db->query($s7);
if($q->num_rows()== 0){
$r7= $q7->row(); 
$iva=round($r7->iva*100);   
}


$venta=($r2->venta*100);
$id=$rowx->id;
$cero=0;
$stat='';
$stid='9';
$var='SUC';
$folio1=0;
$folio2=0;

$suc=$rowx->suc;
$fechac=$rowx->fecha;
$sucx=substr($rowx->sucx,0,25);
$total=$venta+$credito;

$Data=
     str_pad($var,3)
    .str_pad($stat,1)
    .str_pad($stid,1) 
    .str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->dia,2,"0",STR_PAD_LEFT)
    .str_pad(1,1,"0",STR_PAD_LEFT)
    .str_pad(2,1,"0",STR_PAD_LEFT)
    .str_pad($venta,9,"0",STR_PAD_LEFT)
    
    .str_pad($credito,9,"0",STR_PAD_LEFT)
    .str_pad($total,9,"0",STR_PAD_LEFT)
    .str_pad($venta,9,"0",STR_PAD_LEFT)
    .str_pad($rowx->faltante*100,9,"0",STR_PAD_LEFT)
    .str_pad($rowx->sobrante*100,9,"0",STR_PAD_LEFT)
    .str_pad($rowx->asalto*100,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($entrega,9,"0",STR_PAD_LEFT)
    .str_pad($iva,9,"0",STR_PAD_LEFT)
    .str_pad($folio1,8,"0",STR_PAD_LEFT)
    .str_pad($folio2,8,"0",STR_PAD_LEFT)
    ."\n";
fwrite($Handle, $Data);


}
}
/////////////////////////////////////
    function cortes()
    {
 
$fec='2012-07';
    
$this->load->helper('file');
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlx="select a.id,a.fechacorte,turno1_folio1, turno1_folio2,turno2_folio1, turno2_folio2,turno3_folio1, turno3_folio2,turno4_folio1, turno4_folio2,
a.cia, a.suc, e.nombre as sucx,
turno1_folio1, turno1_folio2,turno2_folio1, turno2_folio2,
turno3_folio1, turno3_folio2,turno4_folio1, turno4_folio2,
date_format(a.fechacorte, '%Y') as aaa,date_format(a.fechacorte, '%m') as mes,date_format(a.fechacorte, '%d') as dia,
a.caja,2 as turno,
f.corregido as venta,
c.corregido as credito1,
d.corregido as credito2,
sum(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as faltante,
sum(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sobrante,
b.corregido as iva,

sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,
sum(
a.turno1_exp+a.turno1_bbv+a.turno1_san+a.turno1_vale+a.turno1_pesos+a.turno1_mn+
a.turno2_exp+a.turno2_bbv+a.turno2_san+a.turno2_vale+a.turno2_pesos+a.turno2_mn+
a.turno3_exp+a.turno3_bbv+a.turno3_san+a.turno3_vale+a.turno3_pesos+a.turno3_mn+
a.turno4_exp+a.turno4_bbv+a.turno4_san+a.turno4_vale+a.turno4_pesos+a.turno4_mn
)as entrega


FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=40
left join catalogo.sucursal e on e.suc=a.suc
left join cortes_d_c1_c29 f on f.id_cc=a.id 
         where date_format(a.fechacorte, '%Y-%m')='$fec' and a.tipo>=3 and a.suc>403
group by  a.suc, fechacorte
";

$queryx = $this->db->query($sqlx);

$linea=null;
$mensaje=null;
    $File = "./txt/todo.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)
{
$id=$rowx->id;
$cero=0;
$stat='';
$stid='9';
$var='SUC';
$credito=0;
$credito1=0;
$credito2=0;
if($rowx->credito1 ==null){$credito1=0;}else{$credito1=$rowx->credito1*100;}
if($rowx->credito2 ==null){$credito2=0;}else{$credito2=$rowx->credito2*100;}
if($rowx->iva ==null){$iva=0;}else{$iva=round($rowx->iva*100);}



if($rowx->turno2_folio2 > 0 and $rowx->turno3_folio2 > 0 and $rowx->turno4_folio2 == 0){$folio2=$rowx->turno1_folio2;}
if($rowx->turno3_folio2 ==0 and $rowx->turno4_folio2 == 0){$folio2=$rowx->turno2_folio2;}
if($rowx->turno3_folio2 > 0 and $rowx->turno4_folio2 == 0){$folio2=$rowx->turno3_folio2;}
if($rowx->turno3_folio2 > 0 and $rowx->turno4_folio2  > 0){$folio2=$rowx->turno4_folio2;}
$entrega=(int)($rowx->entrega*100);

$folio1=$rowx->turno1_folio1;

$suc=$rowx->suc;
$fechac=$rowx->fechacorte;
$sucx=substr($rowx->sucx,0,25);
$venta=($rowx->venta*100);
$credito=($credito1+$credito2);
$total=$venta+$credito;
$Data=
     str_pad($var,3)
    .str_pad($stat,1)
    .str_pad($stid,1) 
    .str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->dia,2,"0",STR_PAD_LEFT)
    .str_pad($rowx->caja,1,"0",STR_PAD_LEFT)
    .str_pad($rowx->turno,1,"0",STR_PAD_LEFT)
    .str_pad($venta,9,"0",STR_PAD_LEFT)
    .str_pad($credito,9,"0",STR_PAD_LEFT)
    .str_pad($total,9,"0",STR_PAD_LEFT)
    .str_pad($venta,9,"0",STR_PAD_LEFT)
    .str_pad($rowx->faltante*100,9,"0",STR_PAD_LEFT)
    .str_pad($rowx->sobrante*100,9,"0",STR_PAD_LEFT)
    .str_pad($rowx->asalto*100,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($entrega,9,"0",STR_PAD_LEFT)
    .str_pad($iva,9,"0",STR_PAD_LEFT)
    .str_pad($folio1,8,"0",STR_PAD_LEFT)
    .str_pad($folio2,8,"0",STR_PAD_LEFT)
    ."\n";
fwrite($Handle, $Data);
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************

$sqlxx="select a.id,a.cia, a.suc, e.nombre as sucx,a.tipo,
date_format(a.fechacorte, '%Y') as aaa,date_format(a.fechacorte, '%m') as mes,date_format(a.fechacorte, '%d') as dia,
a.caja,2 as turno,
f.corregido as venta,
c.corregido as credito1,
d.corregido as credito2,
turno1_fal, turno2_fal, turno3_fal, turno4_fal,
turno1_sob, turno2_sob, turno3_sob, turno4_sob,
b.corregido as iva,
g.corregido as impiva,
turno1_folio1, turno1_folio2,turno2_folio1, turno2_folio2,
turno3_folio1, turno3_folio2,turno4_folio1, turno4_folio2,
a.turno1_asalto,a.turno2_asalto,a.turno3_asalto,a.turno4_asalto,
a.turno1_corte,a.turno2_corte,a.turno3_corte,a.turno4_corte,

(a.turno1_exp+a.turno1_bbv+a.turno1_san+a.turno1_vale+a.turno1_pesos+a.turno1_mn)as turno1,
(a.turno2_exp+a.turno2_bbv+a.turno2_san+a.turno2_vale+a.turno2_pesos+a.turno2_mn)as turno2,
(a.turno3_exp+a.turno3_bbv+a.turno3_san+a.turno3_vale+a.turno3_pesos+a.turno3_mn)as turno3,
(a.turno4_exp+a.turno4_bbv+a.turno4_san+a.turno4_vale+a.turno4_pesos+a.turno4_mn)as turno4




FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=40
left join catalogo.sucursal e on e.suc=a.suc
left join cortes_d_c1_c29 f on f.id_cc=a.id
left join cortes_d_civa g on g.id_cc=a.id

         where a.id=$id and a.tipo=4 
group by  a.suc, fechacorte
";


$queryxx = $this->db->query($sqlxx);


$mensaje=null;
$cero=0;
$stat='';
$stid='9';
$var='CTL';
$credito=0;
foreach($queryxx->result() as $rowxx)
{
if($rowxx->credito1 ==null){$credito1=0;}else{$credito1=$rowxx->credito1*100;}
if($rowxx->credito2 ==null){$credito2=0;}else{$credito2=$rowxx->credito2*100;}
if($rowx->iva ==null){$iva=0;}else{$iva=round($rowx->iva*100);}
if($rowxx->impiva ==null){$impiva=0;}else{$impiva=round($rowxx->impiva*100);}

$sucx=substr($rowxx->sucx,0,25);
$venta=($rowxx->venta*100);
$credito=$credito1+$credito2;
$total=$venta+$credito;


$Data=
     str_pad($var,3)
    .str_pad($rowxx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowxx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowxx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->dia,2,"0",STR_PAD_LEFT)
    .str_pad('0',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad($venta,9,"0",STR_PAD_LEFT)
    .str_pad($credito,9,"0",STR_PAD_LEFT)
    .str_pad($total,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($venta,9,"0",STR_PAD_LEFT)
    .str_pad($total,9,"0",STR_PAD_LEFT)
    .str_pad($venta+$credito,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($iva,9,"0",STR_PAD_LEFT)
    .str_pad($impiva,9,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno1_folio1,8,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno1_folio2,8,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
fwrite($Handle, $Data);
if($rowxx->turno1>0){
$Data=
     str_pad($var,3)
    .str_pad($rowxx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowxx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowxx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno1_corte*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno1_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno1_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno1_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno1_corte*100)-(($rowxx->turno1_corte*100)*2),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno1*100),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno1_folio1,8,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno1_folio2,8,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
fwrite($Handle, $Data);
}
if($rowxx->turno2>0){
$Data=
     str_pad($var,3)
    .str_pad($rowxx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowxx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowxx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno2_corte*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno2_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno2_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno2_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno2_corte*100)-(($rowxx->turno2_corte*100)*2),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno2*100),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno2_folio1,8,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno2_folio2,8,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
fwrite($Handle, $Data);
}
if($rowxx->turno3>0){
$Data=
     str_pad($var,3)
    .str_pad($rowxx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowxx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowxx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno3_corte*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno3_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno3_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno3_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno3_corte*100)-(($rowxx->turno3_corte*100)*2),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno3*100),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno3_folio1,8,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno3_folio2,8,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
fwrite($Handle, $Data);
}
if($rowxx->turno4>0){
$Data=
     str_pad($var,3)
    .str_pad($rowxx->cia,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->suc,4,"0",STR_PAD_LEFT)
    .str_pad($sucx,25," ",STR_PAD_RIGHT)
    .str_pad($rowxx->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($rowxx->mes,2,"0",STR_PAD_LEFT)
    .str_pad($rowxx->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno4_corte*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno4_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno4_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno4_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno4_corte*100)-(($rowxx->turno4_corte*100)*2),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($rowxx->turno4*100),9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno4_folio1,8,"0",STR_PAD_LEFT)
    .str_pad($rowxx->turno4_folio2,8,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
fwrite($Handle, $Data);
}    
}
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////DETCOR

$sql="select a.tipo, a.id,a.cia, a.suc, e.nombre as sucx,
date_format(a.fechacorte, '%Y') as aaa,date_format(a.fechacorte, '%m') as mes,date_format(a.fechacorte, '%d') as dia,
turno1_fal, turno2_fal, turno3_fal, turno4_fal,
turno1_sob, turno2_sob, turno3_sob, turno4_sob,
a.turno1_exp,a.turno2_exp,a.turno3_exp,a.turno4_exp,
a.turno1_bbv,a.turno2_bbv,a.turno3_bbv,a.turno4_bbv,
a.turno1_san,a.turno2_san,a.turno3_san,a.turno4_san,
a.turno1_vale,a.turno2_vale,a.turno3_vale,a.turno4_vale,
a.turno1_pesos,a.turno2_pesos,a.turno3_pesos,a.turno4_pesos,
a.turno1_mn,a.turno2_mn,a.turno3_mn,a.turno4_mn,
a.turno1_cambio,a.turno2_cambio,a.turno3_cambio,a.turno4_cambio,
a.turno1_asalto,a.turno2_asalto,a.turno3_asalto,a.turno4_asalto
FROM cortes_c a
left join catalogo.sucursal e on e.suc=a.suc
where a.id=$id and a.tipo=4
group by  a.suc, fechacorte
";
$query = $this->db->query($sql);
$mensaje=null;
$cero=0;
$stat='';
$stid='9';
$var='DET';
foreach($query->result() as $row)
{
$id_cc=$row->id;
$sqlx="SELECT a.*,g.linx as lin1x FROM cortes_d  a left join catalogo.lineas_cortes g on g.lin=clave1 where id_cc=$id_cc and tipo=4";
$queryx = $this->db->query($sqlx);    
foreach($queryx->result() as $rowx)
{
$clave1x=100+$rowx->clave1;
$clave2x=200+$rowx->clave1;
$clave3x=300+$rowx->clave1;
$cla=$rowx->clave1;
if($cla ==49){
   $iva=round($rowx->corregido*100);
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('0',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($rowx->clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($rowx->lin1x,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave1x,3,"0",STR_PAD_LEFT)
    .str_pad($iva,9,"0",STR_PAD_LEFT)
    .str_pad($clave2x,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3x,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($iva,9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";     
fwrite($Handle, $Data);
}else{
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('0',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($rowx->clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($rowx->lin1x,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave1x,3,"0",STR_PAD_LEFT)
    .str_pad(($rowx->venta*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave2x,3,"0",STR_PAD_LEFT)
    .str_pad(($rowx->cancel*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3x,3,"0",STR_PAD_LEFT)
    .str_pad(($rowx->aumento*100),9,"0",STR_PAD_LEFT)
    .str_pad(($rowx->corregido*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";    
fwrite($Handle, $Data);
}
}



//////////////////////////////////////////////////////////////////////////////////////////////////////////turno 1
$varx='EFECTIVO M.N';
$clave1=50;
$clave2=150;
$clave3=250;
$clave4=350;
if($row->turno1_pesos>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
   fwrite($Handle, $Data);  
}
$varx='T.AMERICAN EXPRESS';
$clave1=62;
$clave2=162;
$clave3=262;
$clave4=362;
if($row->turno1_exp>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='T.BANCOMER';
$clave1=64;
$clave2=164;
$clave3=264;
$clave4=364;
if($row->turno1_bbv>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='T.SANTANDER';
$clave1=66;
$clave2=166;
$clave3=266;
$clave4=366;
if($row->turno1_san>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='VALES';
$clave1=70;
$clave2=170;
$clave3=270;
$clave4=370;
if($row->turno1_vale>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='TIPO DE CAMBIO';
$clave1=81;
$clave2=181;
$clave3=281;
$clave4=381;
if($row->turno1_cambio>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='EQUIVALENTE EN M.N';
$clave1=82;
$clave2=182;
$clave3=282;
$clave4=382;
if($row->turno1_mn>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='FALTANTE';
$clave1=93;
$clave2=193;
$clave3=293;
$clave4=393;
if($row->turno1_fal>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='SOBRANTE';
$clave1=92;
$clave2=192;
$clave3=292;
$clave4=392;
if($row->turno1_sob>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='ASALTO';
$clave1=94;
$clave2=194;
$clave3=294;
$clave4=394;
if($row->turno1_asalto>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno1_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////turno 2
$varx='EFECTIVO M.N';
$clave1=50;
$clave2=150;
$clave3=250;
$clave4=350;
if($row->turno2_pesos>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='T.AMERICAN EXPRESS';
$clave1=62;
$clave2=162;
$clave3=262;
$clave4=362;
if($row->turno2_exp>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='T.BANCOMER';
$clave1=64;
$clave2=164;
$clave3=264;
$clave4=364;
if($row->turno2_bbv>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='T.SANTANDER';
$clave1=66;
$clave2=166;
$clave3=266;
$clave4=366;
if($row->turno2_san>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='VALES';
$clave1=70;
$clave2=170;
$clave3=270;
$clave4=370;
if($row->turno2_vale>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='TIPO DE CAMBIO';
$clave1=81;
$clave2=181;
$clave3=281;
$clave4=381;
if($row->turno2_cambio>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='EQUIVALENTE EN M.N';
$clave1=82;
$clave2=182;
$clave3=282;
$clave4=382;
if($row->turno2_mn>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='FALTANTE';
$clave1=93;
$clave2=193;
$clave3=293;
$clave4=393;
if($row->turno2_fal>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='SOBRANTE';
$clave1=92;
$clave2=192;
$clave3=292;
$clave4=392;
if($row->turno2_sob>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='ASALTO';
$clave1=94;
$clave2=194;
$clave3=294;
$clave4=394;
if($row->turno2_asalto>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('2',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno2_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////turno 3
$varx='EFECTIVO M.N';
$clave1=50;
$clave2=150;
$clave3=250;
$clave4=350;
if($row->turno3_pesos>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='T.AMERICAN EXPRESS';
$clave1=62;
$clave2=162;
$clave3=262;
$clave4=362;
if($row->turno3_exp>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='T.BANCOMER';
$clave1=64;
$clave2=164;
$clave3=264;
$clave4=364;
if($row->turno3_bbv>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='T.SANTANDER';
$clave1=66;
$clave2=166;
$clave3=266;
$clave4=366;
if($row->turno3_san>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='VALES';
$clave1=70;
$clave2=170;
$clave3=270;
$clave4=370;
if($row->turno3_vale>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";
    fwrite($Handle, $Data);  
}
$varx='TIPO DE CAMBIO';
$clave1=81;
$clave2=181;
$clave3=281;
$clave4=381;
if($row->turno3_cambio>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='EQUIVALENTE EN M.N';
$clave1=82;
$clave2=182;
$clave3=282;
$clave4=382;
if($row->turno3_mn>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='FALTANTE';
$clave1=93;
$clave2=193;
$clave3=293;
$clave4=393;
if($row->turno3_fal>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='SOBRANTE';
$clave1=92;
$clave2=192;
$clave3=292;
$clave4=392;
if($row->turno3_sob>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='ASALTO';
$clave1=94;
$clave2=194;
$clave3=294;
$clave4=394;
if($row->turno3_asalto>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('3',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno3_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////turno 4
$varx='EFECTIVO M.N';
$clave1=50;
$clave2=150;
$clave3=250;
$clave4=350;
if($row->turno4_pesos>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_pesos*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='T.AMERICAN EXPRESS';
$clave1=62;
$clave2=162;
$clave3=262;
$clave4=362;
if($row->turno4_exp>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_exp*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='T.BANCOMER';
$clave1=64;
$clave2=164;
$clave3=264;
$clave4=364;
if($row->turno4_bbv>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_bbv*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='T.SANTANDER';
$clave1=66;
$clave2=166;
$clave3=266;
$clave4=366;
if($row->turno4_san>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_san*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='VALES';
$clave1=70;
$clave2=170;
$clave3=270;
$clave4=370;
if($row->turno4_vale>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_vale*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='TIPO DE CAMBIO';
$clave1=81;
$clave2=181;
$clave3=281;
$clave4=381;
if($row->turno4_cambio>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_cambio*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='EQUIVALENTE EN M.N';
$clave1=82;
$clave2=182;
$clave3=282;
$clave4=382;
if($row->turno4_mn>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_mn*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='FALTANTE';
$clave1=93;
$clave2=193;
$clave3=293;
$clave4=393;
if($row->turno4_fal>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_fal*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n"; 
    fwrite($Handle, $Data); 
}
$varx='SOBRANTE';
$clave1=92;
$clave2=192;
$clave3=292;
$clave4=392;
if($row->turno4_sob>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_sob*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);
}
$varx='ASALTO';
$clave1=94;
$clave2=194;
$clave3=294;
$clave4=394;
if($row->turno4_asalto>0){
$Data=
     str_pad($var,3)
    .str_pad($row->cia,2,"0",STR_PAD_LEFT)
    .str_pad($row->suc,4,"0",STR_PAD_LEFT)
    .str_pad($row->aaa,4,"0",STR_PAD_LEFT)
    .str_pad($row->mes,2,"0",STR_PAD_LEFT)
    .str_pad($row->dia,2,"0",STR_PAD_LEFT)
    .str_pad('1',1,"0",STR_PAD_LEFT)
    .str_pad('4',1,"0",STR_PAD_LEFT)
    .str_pad('0',6,"0",STR_PAD_LEFT)
    .str_pad($clave1,3,"0",STR_PAD_LEFT)
    .str_pad(substr($varx,0,25),25," ",STR_PAD_RIGHT)
    .str_pad($clave2,3,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($clave3,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad($clave4,3,"0",STR_PAD_LEFT)
    .str_pad($cero,9,"0",STR_PAD_LEFT)
    .str_pad(($row->turno4_asalto*100),9,"0",STR_PAD_LEFT)
    .str_pad($stid,1)."\n";  
    fwrite($Handle, $Data);

}

//concentradopor linenaaaa/ 
   
}


///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
///////////////////////////////////*************************************************************************
}
fclose($Handle); 
die();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////    
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////




