<?php
	class Proceso_model_pedido extends CI_Model {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        
    }
function inserta_pedido_for($por1,$por2,$por3,$por4,$por5)
    {
    ini_set('memory_limit','15000M');
    set_time_limit(0);
        $dianombre=date('D');
//$dianombre='Wed';
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($dianombre=='Mon'){$dia='LUN';}
if($dianombre=='Tue'){$dia='MAR';}
if($dianombre=='Wed'){$dia='MIE';}
if($dianombre=='Thu'){$dia='JUE';}
if($dianombre=='Fri'){$dia='VIE';}
$l0="insert ignore into almacen.max_sucursal (sec, suc, susa, m2011, m2012, m2013, m2014, final, paquete)
(select b.sec,a.suc,b.susa,0,0,0,0,2,0 from catalogo.sucursal a,  catalogo.cat_almacen_clasifica b
where tipo2<>'F' and suc>100 and suc<=1600 and tlid=1
and suc<>170
and suc<>171
and suc<>172
and suc<>173
and suc<>174
and suc<>175
and suc<>176
and suc<>177
and suc<>178
and suc<>179
and suc<>180
and suc<>181
and suc<>187)";
$this->db->query($l0);
$n1="update catalogo.sucursal a
set dia='PEN'
where dia='$dia' and 
(select fechai from desarrollo.inv b where a.suc=b.suc group by suc)<
subdate(date(now()),2)";
$this->db->query($n1);


        $x1="SELECT * FROM catalogo.sucursal where dia='$dia' and tlid=1";
        $q1=$this->db->query($x1);
 foreach($q1->result() as $r1)
        {
        $suc=$r1->suc;
        
        $a = $this->__arreglo_pedido_formulado_una($suc,$por1,$por2,$por3,$por4,$por5);
        $fec=date('Y-m-d');
        $b = "insert ignore into desarrollo.pedido_formulado (promant, fecg, tsuc, suc, sec, porce, descri, promact, 
        maxi, inv, ped, exc, costo, venta, impo, lin, iva,inv_cedis,mue,bloque) values ";
        
        foreach($a as $ped)
        {
            //id, cia, nomina, aaa1, aaa2, dias, aaa, dias_ley
              foreach($ped as $fin)
            {
                
        
                $b .= "(".$fin['promeant'].",date(now()),'".$fin['tsuc']."',".$fin['suc'].",".$fin['sec'].",".$fin['por'].",
                '".$fin['susa1']."',".$fin['promeact'].",".round($fin['promeact']*$fin['por'],2).",".$fin['inv'].",
                ".$fin['ped'].",".$fin['exc'].",".$fin['costo'].",".$fin['venta'].",".$fin['venta']*$fin['ped'].",
                ".$fin['lin'].",".$fin['iva'].",".$fin['inv_cedis'].",".$fin['mue'].",".$fin['ruta']."),";
            }
            
        }
        
        $b = substr($b, 0, -1) . ";";
     $this->db->query($b);



$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6 and a.mue=6 order by a.suc)";
$this->db->query($sx10);
$sx11="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0  and a.mue<>6 order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  pedidos set sur=0 where fecha='$fec' and sur>0 and invcedis=0 and suc=$suc";
$this->db->query($sx12);


$sx13="insert into desarrollo.pedido_formulado_resp
(promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,fec_respaldo)
(select
 promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,date(now())
from desarrollo.pedido_formulado)";
$this->db->query($sx13);
$sx14="delete FROM pedido_formulado";
$this->db->query($sx14);
}
    
 //echo "<pre>";
  //print_r($a);
  //echo "</pre>";
  //die();
		
        
    }
    
   function __arreglo_pedido_formulado_una($suc,$por1,$por2,$por3,$por4,$por5)
    {
$dianombre=date('D');
//$dianombre='Wed';
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($dianombre=='Mon'){$dia='LUN';}
if($dianombre=='Tue'){$dia='MAR';}
if($dianombre=='Wed'){$dia='MIE';}
if($dianombre=='Thu'){$dia='JUE';}
if($dianombre=='Fri'){$dia='VIE';}

$l0="insert ignore into almacen.max_sucursal (sec, suc, susa, m2011, m2012, m2013, m2014, final, paquete)
(select b.sec,a.suc,b.susa,0,0,0,0,2,0 from catalogo.sucursal a,  catalogo.cat_almacen_clasifica b
where tipo2<>'F' and suc>100 and suc<=1600 and tlid=1
and suc<>170
and suc<>171
and suc<>172
and suc<>173
and suc<>174
and suc<>175
and suc<>176
and suc<>177
and suc<>178
and suc<>179
and suc<>180
and suc<>181
and suc<>187 and suc=$suc)";
$this->db->query($l0);
$sql = "SELECT * FROM catalogo.sucursal where dia='$dia' and suc=$suc and tlid=1";
        
        $sql2 = "select a.*,b.final from catalogo.almacen a
        left join almacen.max_sucursal b on b.sec=a.sec 
        where a.tsec='G' and a.sec>0 and a.sec<=2000 and b.suc=$suc group by a.sec";
        
        $query = $this->db->query($sql);
        $a = array();
        
        $query2 = $this->db->query($sql2);
        
        $c = array();
        $d = array();
        $e = array();
        $b = 0;
        foreach($query2->result() as $row2)
        {
        foreach($query->result() as $row)
        {



$s2="select suc,sec,sum(cantidad)as cantidad  from desarrollo.inv where suc=$row->suc and sec=$row2->sec group by sec;";   
$q2 = $this->db->query($s2);
if($q2->num_rows()==1){
$r2 = $q2->row();
$inv=$r2->cantidad;    
}else{
$inv=0;
}
$s3="select * from desarrollo.inv_cedis_sec1 where sec=$row2->sec and inv1>0;";   
$q3 = $this->db->query($s3);
if($q3->num_rows()==1){
$r3 = $q3->row();
$inv_cedis=$r3->inv1;    
}else{
$inv_cedis=0;
}
$s4="select * from catalogo.almacen_mue where sec=$row2->sec;";   
$q4 = $this->db->query($s4);
if($q4->num_rows()==1){
$r4 = $q4->row();
$mue=$r4->mueble;    
}else{
$mue=0;
}
$s5="select * from catalogo.almacen_rutas where suc=$row->suc;";   
$q5 = $this->db->query($s5);
if($q5->num_rows()==1){
$r5 = $q5->row();
$ruta=$r5->ruta;    
}else{
$ruta=0;
}
$s6="select * from catalogo.almacen_paquetes  where sec=$row2->sec";
$q6 = $this->db->query($s6);
if($q6->num_rows()==1){
$r6 = $q6->row();
$paq=$r6->can;    
}else{
$paq=0;
}
$s7="select * from catalogo.cat_almacen_clasifica  where sec=$row2->sec";
$q7 = $this->db->query($s7);
if($q7->num_rows()==1){
$r7 = $q7->row();
$tip=$r7->tipo;    
}else{
$tip=0;
}
$promeant=0;
$promeact=$row2->final;
if($tip=='a'){$por=$por1;}elseif($tip=='b'){$por=$por2;}elseif($tip=='c'){$por=$por3;}elseif($tip=='d'){$por=$por4;}elseif($tip=='e'){$por=$por5;}else{$por=0;}
if($promeact==0){$maxi=round($promeant*$por);}else{$maxi=round($promeact*$por);}
if($maxi > $inv){$ped=$maxi-$inv;$exc=0;}else{$ped=0;$exc=$inv-$maxi;}

if($paq > 0 and $ped>0){$ped=round(($ped/$paq),0)*$paq;}
if($inv==0 & $ped==0 & $exc=0 & $paq>0){$ped=$paq;} 

if($row->tipo2=='D'){$vta=$row2->vtaddr;}else{$vta=$row2->vtagen;}
            $a[$row->suc][$row2->sec]['tsuc'] = $row->tipo2;
			$a[$row->suc][$row2->sec]['suc'] = $row->suc;
            $a[$row->suc][$row2->sec]['iva'] = $row->iva;
			$a[$row->suc][$row2->sec]['sec'] = $row2->sec;
            $a[$row->suc][$row2->sec]['susa1'] = $row2->susa1;
            $a[$row->suc][$row2->sec]['lin'] = $row2->lin;
            $a[$row->suc][$row2->sec]['costo'] = $row2->costo;
            $a[$row->suc][$row2->sec]['venta'] = $vta;
            $a[$row->suc][$row2->sec]['promeact'] = round($promeact);
            $a[$row->suc][$row2->sec]['promeant'] = round($promeant);
            $a[$row->suc][$row2->sec]['inv'] = $inv;
            $a[$row->suc][$row2->sec]['inv_cedis'] = $inv_cedis;
            $a[$row->suc][$row2->sec]['maxi'] = $maxi;
            $a[$row->suc][$row2->sec]['ped'] = $ped;
            $a[$row->suc][$row2->sec]['exc'] = $exc;
            $a[$row->suc][$row2->sec]['ruta'] = $ruta;
            $a[$row->suc][$row2->sec]['mue'] = $mue;
            $a[$row->suc][$row2->sec]['por'] = $por;
        }
        $b++;
		}
   
 //echo "<pre>";
 //print_r($a);
 //echo "</pre>";
 //die();
        return $a;
    
}    
    
   function inserta_pedido_for_una($suc,$por1,$por2,$por3,$por4,$por5)
    {
        $a = $this->__arreglo_pedido_formulado_una($suc,$por1,$por2,$por3,$por4,$por5);
        $fec=date('Y-m-d');
        $b = "insert ignore into desarrollo.pedido_formulado (promant, fecg, tsuc, suc, sec, porce, descri, promact, 
        maxi, inv, ped, exc, costo, venta, impo, lin, iva,inv_cedis,mue,bloque) values ";
        
        foreach($a as $ped)
        {
            //id, cia, nomina, aaa1, aaa2, dias, aaa, dias_ley
            
            foreach($ped as $fin)
            {
                $b .= "(".$fin['promeant'].",date(now()),'".$fin['tsuc']."',".$fin['suc'].",".$fin['sec'].",".$fin['por'].",
                '".$fin['susa1']."',".$fin['promeact'].",".round($fin['promeact']*$fin['por'],2).",".$fin['inv'].",
                ".$fin['ped'].",".$fin['exc'].",".$fin['costo'].",".$fin['venta'].",".$fin['venta']*$fin['ped'].",
                ".$fin['lin'].",".$fin['iva'].",".$fin['inv_cedis'].",".$fin['mue'].",".$fin['ruta']."),";
            }
            
        }
        
        $b = substr($b, 0, -1) . ";";
     $this->db->query($b);
//
$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec'  and suc=$suc  GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec'  and suc=$suc  GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6 and a.mue=6  and a.suc=$suc and tid='A' order by a.suc)";
$this->db->query($sx10);
$sx11="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0  and a.mue<>6 and a.suc=$suc and tid='A' order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  pedidos set sur=0 where fecha='$fec' and invcedis=0 and sur>0 and suc=$suc";
$this->db->query($sx12);
$sx13="insert into desarrollo.pedido_formulado_resp
(promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,fec_respaldo)
(select
 promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,date(now())
from desarrollo.pedido_formulado)";
$this->db->query($sx13);
$sx14="delete FROM pedido_formulado";
$this->db->query($sx14);

    
 //echo "<pre>";
 // print_r($a);
 // echo "</pre>";
 // die();
		
        
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////************
///////////////////////////////////////
///////////////////////////////////////
function invd()
{
$dianombre=date('D');
//$dianombre='Wed';
if($dianombre=='Mon'){$dia='LUN';}
if($dianombre=='Tue'){$dia='MAR';}
if($dianombre=='Wed'){$dia='MIE';}
if($dianombre=='Thu'){$dia='JUE';}
if($dianombre=='Fri'){$dia='VIE';}
    $s="select a.tlid,SUBDATE(date(now()),INTERVAL 2 DAY)as dia_lim, DATEDIFF(SUBDATE(date(now()),INTERVAL 1 DAY), fechai) AS diferencia, b.fechai,fechag, sum(cantidad)as can, a.suc,a.nombre from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc
where a.dia='$dia' and sec>0
group by a.suc ORDER BY FECHAI";
$q=$this->db->query($s);
$tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Fecha Limite</th>
        <th>Fecha de archivo</th>
        <th>Fecha de procesos</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Piezas</th>
        <th>Tlid</th>
        <th>Editar</th>
        </tr>
        </thead>
        <tbody>
        ";
        
  $num=1;      
        foreach($q->result() as $r)
        {
            if($r->diferencia>1){
            $l= anchor('procesos/editar_dia/'.$r->suc, '<img src="'.base_url().'img/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar', 'class' => 'encabezado'));
            }else{
                $l=null;
            }
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->dia_lim."</td>
            <td align=\"left\">".$r->fechai."</td>
            <td align=\"left\">".$r->fechag."</td>
            <td align=\"left\">".$r->suc."</td>
            <td align=\"left\">".$r->nombre."</td>
            <td align=\"center\">".number_format($r->can,0)."</td>
            <td align=\"left\">".$r->tlid."</td>
            <td style=\"text-align: center;\">".$l."</td>
            </tr>
            ";
            $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
}
//////////////////////////////////////////////////////////////////////////////////////*********************************
//////////////////////////////////////////////////////////////////////////////////////*********************************


///////////////////////////////////////
///////////////////////////////////////

   function formulado_una_respaldo($fec1,$fec2,$suc)
    {
$aaa1=substr($fec1,0,4);
$aaa2=substr($fec2,0,4);
$mes1=substr($fec1,5,2);
$mes2=substr($fec2,5,2);
$dianombre=date('D');
$aaa=date('Y');
//$dianombre='wed';
$fec=date('Y-m-d');
//$uno=1.83;
//$dos=1.33;
$uno=1.5;
$dos=1;
$pag=0;
//$s1="";
//$q1 = $this->db->query($s1);
//echo $this->db->last_query();
$sx1="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,inv,vta,impo)
(select '$fec1','$fec',tsuc,a.suc,sec,0,'',sum(cantidad),0,0 from desarrollo.inv a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.dias c on b.dia=c.dia
where
tsuc='G' and cantidad>0 and a.sec>0 and c.par='$dianombre' and b.tlid=1 and a.sec>0 and a.sec<=2000 and a.suc=$suc  or
tsuc='D' and cantidad>0 and a.sec>0 and c.par='$dianombre' and b.tlid=1 and a.sec>0 and a.sec<=2000 and a.suc=$suc 
group by a.suc,a.sec)
on duplicate key update inv=values(inv)";

$this->db->query($sx1);
$sx2="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,vta,impo,inv)
(select '$fec1','$fec',tipo,sucursal,sec,0,'',sum(venta),sum(importe),0 
from vtadc.venta12 a
left join catalogo.sucursal b on a.sucursal=b.suc
left join catalogo.dias c on b.dia=c.dia
where 
tipo='G' and venta>0 and a.sec>0 and a.sec<=2000  and aaa>=$aaa1 and mes>=$mes1 and aaa<=$aaa2 and mes<=$mes2 and c.par='$dianombre' and b.tlid=1 and a.sucursal=$suc
or 
tipo='D' and venta>0 and a.sec>0 and a.sec<=2000  and aaa>=$aaa1 and mes>=$mes1 and aaa<=$aaa2 and mes<=$mes2 and c.par='$dianombre' and b.tlid=1 and a.sucursal=$suc 
group by sucursal,sec)
on duplicate key update vta=values(vta),impo=values(impo)";
$this->db->query($sx2);

$sxx2="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,vta,impo,inv)
(select '$fec1','$fec',tipo,sucursal,sec,0,'',sum(venta),sum(importe),0
from vtadc.venta a
left join catalogo.cat_suc_dic b on a.sucursal=b.suc
left join catalogo.dias c on b.dia=c.dia
where
venta>0 and a.sec>0 and a.sec<=2000  and aaa>=$aaa and mes=03  and b.suc is not null and 

c.par='$dianombre' and a.sucursal=$suc


group by sucursal,sec)
on duplicate key update vta=values(vta),impo=values(impo)";
$this->db->query($sxx2); 
$sx3="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,venta,costo,vta,impo,inv,lin,mue,iva)
(select '$fec1','$fec',a.tipo2,a.suc,c.sec,0,c.susa1,0,c.costo,0,0,0,c.lin,c.mue,a.iva
FROM catalogo.sucursal a
LEFT JOIN catalogo.dias b on b.dia=a.dia
LEFT JOIN catalogo.almacen c on c.sec>1 AND c.sec<=2000
LEFT JOIN catalogo.almacen_borrar d on d.sec=c.sec 
WHERE a.tlid=1 AND b.par='$dianombre' AND d.sec is null and tsec='G'  and c.sec>0 and c.sec<=2000  and a.suc=$suc group by a.suc,c.sec)
on duplicate key update mue=values(mue),lin=values(lin),iva=values(iva)";
$this->db->query($sx3);
$sx3x="update pedido_formulado a, catalogo.sucursal b set a.tsuc=b.tipo2 where a.suc=b.suc";
$this->db->query($sx3x);

$sx4="update pedido_formulado a,catalogo.almacen b set 
a.costo=b.costo,a.descri=b.susa1,
venta=
case when tsuc='G'
then vtagen
else
vtaddr
end
where a.sec=b.sec and fecg='$fec'  and a.suc=$suc";
$this->db->query($sx4);

$sx5="select fec1,a.suc from pedido_formulado a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.dias c on b.dia=c.dia
where tlid=1 and c.par='$dianombre' and a.suc=$suc
 group by fec1,suc";
$qx5= $this->db->query($sx5);
foreach($qx5->result() as $rx5)
{$num=1;
$aa="select *from pedido_formulado where suc=$rx5->suc and fecg='$fec'  and suc=$suc order by vta desc";
$aa1 = $this->db->query($aa);
foreach($aa1->result() as $bb)
{
$cc="update pedido_formulado 
set 
producto=$num, 
maxi =
case when $num < 150
then vta*$uno
else
vta*$dos
end
where suc=$rx5->suc and fecg='$fec' and sec=$bb->sec and suc=$suc";
$this->db->query($cc);
$num=$num+1;
}
}
$sx5i="update pedido_formulado a, impulsar_venta b 
set a.maxi=b.can where a.suc=b.suc and a.sec=b.sec";
$this->db->query($sx5i);
$sx6="update pedido_formulado 
set 
ped=
case 
when maxi > inv
then (maxi-inv)
else
0
end,

exc=
cast(case when maxi < inv
then (inv-maxi)
else
0
end as signed)
where  fecg='$fec'  and suc=$suc";
$this->db->query($sx6);

$sx7="update pedido_formulado a, catalogo.almacen_rutas c
set a.bloque=c.ruta
where c.suc=a.suc  and a.suc=$suc";
$this->db->query($sx7);
$sx70="update pedido_formulado a, catalogo.almacen_borrar b
set descon=4,ped=0
where a.sec=b.sec  and a.suc=$suc ";
$this->db->query($sx70);

$sx71="update pedido_formulado a,inv_cedis_sec1 b, catalogo.almacen_rutas c
set a.inv_cedis=b.inv1,a.bloque=c.ruta
where c.suc=a.suc and a.sec=b.sec and b.inv1>0  and a.suc=$suc";
$this->db->query($sx71);

$sx74x="update desarrollo.pedido_formulado
set ped=2
where maxi=0 and  ped=0 and inv=0 and inv_cedis>=200 and descon=1";
$this->db->query($sx74x);

$sx72="update pedido_formulado a, catalogo.almacen_paquetes b
set ped=round((ped/can),0)*can
 where a.sec=b.sec and b.sec>0 and a.ped>0  and a.suc=$suc";
$this->db->query($sx72);
$sx73="delete from pedido_formulado where sec>2000  and suc=$suc";
$this->db->query($sx73);
$sx74="update desarrollo.pedido_formulado a, catalogo.almacen_mue b
set a.mue=b.mueble
where a.sec=b.sec and a.sec>0 and a.sec<=899";
$this->db->query($sx74);


$sx12s="update  pedido_formulado a, catalogo.almacen_mue b set a.mue=b.mueble where a.sec=b.sec and a.fecg='$fec'";
$this->db->query($sx12s);

$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec'  and suc=$suc  GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec'  and suc=$suc  GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6  and a.suc=$suc and tid='A' order by a.suc)";
$this->db->query($sx10);
$sx11="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0  and a.suc=$suc and tid='A' order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  pedidos set sur=0 where fecha='$fec' and invcedis=0  and suc=$suc";
$this->db->query($sx12);
$sx13="insert into desarrollo.pedido_formulado_resp
(fec1, fecg, tsuc, suc, sec, codigo, descri, vta, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,fec_respaldo)
(select
 fec1, fecg, tsuc, suc, sec, codigo, descri, vta, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,date(now())
from desarrollo.pedido_formulado)";
$this->db->query($sx13);
$sx14="delete FROM pedido_formulado";
$this->db->query($sx14);
$sx15="delete FROM desarrollo.borra_ped_f";
$this->db->query($sx15);
die();


$l="select SUBDATE(date(now()),INTERVAL 2 DAY),b.fechai,fechag, sum(cantidad), a.suc,a.nombre from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc
where a.dia='mie' and sec>0
group by a.suc";

$ll="select a.suc,a.nombre,sum(b.venta)as venta
from catalogo.sucursal a
left join vtadc.venta12 b on b.sucursal=a.suc
where dia='mie' and b.aaa=2012 and b.mes=12
group by a.suc
order by venta";
}

///////////////////////////////////////
///////////////////////////////////////
   function formulado($fec1,$fec2)
    {
$aaa1=substr($fec1,0,4);
$aaa2=substr($fec2,0,4);
$mes1=substr($fec1,5,2);
$mes2=substr($fec2,5,2);
$aaa=date('Y');
$dianombre=date('D');
if($dianombre=='Mon'){$ddd='LUN';}
if($dianombre=='Tue'){$ddd='MAR';}
if($dianombre=='Wed'){$ddd='MIE';}
if($dianombre=='Thu'){$ddd='JUE';}
if($dianombre=='Fri'){$ddd='VIE';}
//$dianombre='wed';
$fec=date('Y-m-d');

//$uno=1.83;
//$dos=1.33;
$uno=1.5;
$dos=1;
$s1="insert into desarrollo.borra_ped_f(suc,si)
(select a.suc,'N'
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and SUBDATE(date(now()),INTERVAL 2 DAY)<=fechai
where a.suc<>170 and a.suc<>171 and a.suc<>173 and a.suc<>174 and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178
and a.suc<>179 and a.suc<>180 and a.suc<>181 and a.suc<>187 and a.suc<>1600 and a.suc<>1601 and a.suc<>1602 and a.suc<>1603
and dia='$ddd' and b.suc is null
group by a.suc)
on duplicate key update suc=values(suc)";
$q1 = $this->db->query($s1);
//echo $this->db->last_query();
$sx1="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,inv,vta,impo)
(select '$fec1','$fec',tsuc,a.suc,sec,0,'',sum(cantidad),0,0 
from desarrollo.inv a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.dias c on b.dia=c.dia
where
tsuc='G' and cantidad>0 and a.sec>0 and c.par='$dianombre' and b.tlid=1 and a.sec>0 and a.sec<=2000 and SUBDATE(date(now()),INTERVAL 2 DAY)<=fechai or
tsuc='D' and cantidad>0 and a.sec>0 and c.par='$dianombre' and b.tlid=1 and a.sec>0 and a.sec<=2000 and SUBDATE(date(now()),INTERVAL 2 DAY)<=fechai
group by a.suc,a.sec)
on duplicate key update inv=values(inv)";

$this->db->query($sx1);
$sx2="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,vta,impo,inv)
(select '$fec1','$fec',tipo,sucursal,sec,0,'',sum(venta),sum(importe),0 
from vtadc.venta12 a
left join catalogo.sucursal b on a.sucursal=b.suc
left join catalogo.dias c on b.dia=c.dia
where 
tipo='G' and venta>0 and a.sec>0 and a.sec<=2000  and aaa>=$aaa1 and mes>=$mes1 and aaa<=$aaa2 and mes<=$mes2 and c.par='$dianombre' and b.tlid=1
or 
tipo='D' and venta>0 and a.sec>0 and a.sec<=2000  and aaa>=$aaa1 and mes>=$mes1 and aaa<=$aaa2 and mes<=$mes2 and c.par='$dianombre' and b.tlid=1 
group by sucursal,sec)
on duplicate key update vta=values(vta),impo=values(impo)";
$this->db->query($sx2);

$sxx2="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,vta,impo,inv)
(select '$fec1','$fec',tipo,sucursal,sec,0,'',sum(venta),sum(importe),0
from vtadc.venta a
left join catalogo.cat_suc_dic b on a.sucursal=b.suc
left join catalogo.dias c on b.dia=c.dia
where
venta>0 and a.sec>0 and a.sec<=2000  and aaa>=$aaa and mes=03  and b.suc is not null and 

c.par='$dianombre'


group by sucursal,sec)
on duplicate key update vta=values(vta),impo=values(impo)";
$this->db->query($sxx2); 
$sx3="insert into pedido_formulado (fec1,fecg,tsuc,suc,sec,codigo,descri,venta,costo,vta,impo,inv,lin,mue,iva)
(select '$fec1','$fec',a.tipo2,a.suc,c.sec,0,c.susa1,0,c.costo,0,0,0,c.lin,c.mue,a.iva
FROM catalogo.sucursal a
LEFT JOIN catalogo.dias b on b.dia=a.dia
LEFT JOIN catalogo.almacen c on c.sec>1 AND c.sec<=2000
LEFT JOIN catalogo.almacen_borrar d on d.sec=c.sec 
WHERE a.tlid=1 AND b.par='$dianombre' AND d.sec is null and tsec='G'  and c.sec>0 and c.sec<=2000 group by a.suc,c.sec)
on duplicate key update mue=values(mue),lin=values(lin),iva=values(iva)";
$this->db->query($sx3);
$sx3x="update pedido_formulado a, catalogo.sucursal b set a.tsuc=b.tipo2 where a.suc=b.suc";
$this->db->query($sx3x);
$sx4="update pedido_formulado a,catalogo.almacen b set 
a.costo=b.costo,a.descri=b.susa1,
venta=
case when tsuc='G'
then vtagen
else
vtaddr
end
where a.sec=b.sec and fecg='$fec'";
$this->db->query($sx4);

$sx5="select fec1,a.suc from pedido_formulado a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.dias c on b.dia=c.dia
where tlid=1 and c.par='$dianombre'
 group by fec1,suc";
$qx5= $this->db->query($sx5);
foreach($qx5->result() as $rx5)
{$num=1;
$aa="select *from pedido_formulado where suc=$rx5->suc and fecg='$fec' order by vta desc";
$aa1 = $this->db->query($aa);
foreach($aa1->result() as $bb)
{
$cc="update pedido_formulado 
set 
producto=$num, 

maxi =
case when $num < 150
then vta*$uno
else
vta*$dos
end
where suc=$rx5->suc and fecg='$fec' and sec=$bb->sec";
$this->db->query($cc);
$num=$num+1;
}
}
$sx5i="update pedido_formulado a, impulsar_venta b 
set a.maxi=b.can where a.suc=b.suc and a.sec=b.sec";
$this->db->query($sx5i);
$sx6="update pedido_formulado 
set 
ped=
case 
when maxi > inv
then (maxi-inv)
else
0
end,

exc=
cast(case when maxi < inv
then (inv-maxi)
else
0
end as signed)
where  fecg='$fec'";
$this->db->query($sx6);

$sx7="update pedido_formulado a, catalogo.almacen_rutas c
set a.bloque=c.ruta
where c.suc=a.suc";
$this->db->query($sx7);
$sx70="update pedido_formulado a, catalogo.almacen_borrar b
set descon=4,ped=0
where a.sec=b.sec ";
$this->db->query($sx70);

$sx71="update pedido_formulado a,inv_cedis_sec1 b, catalogo.almacen_rutas c
set a.inv_cedis=b.inv1,a.bloque=c.ruta
where c.suc=a.suc and a.sec=b.sec and b.inv1>0";
$this->db->query($sx71);

$sx74x="update desarrollo.pedido_formulado
set ped=2
where maxi=0 and ped=0 and inv=0 and inv_cedis>=200 and descon=1";
$this->db->query($sx74x);


$sx72="update pedido_formulado a, catalogo.almacen_paquetes b
set ped=round((ped/can),0)*can
 where a.sec=b.sec and b.sec>0 and a.ped>0";
$this->db->query($sx72);
$sx73="delete from pedido_formulado where sec>2000";
$this->db->query($sx73);


$sxx="select *from desarrollo.borra_ped_f";
$qxx=$this->db->query($sxx);
foreach($qxx->result() as $rxx)
        {
$sxxx="delete from pedido_formulado where suc=$rxx->suc";
$this->db->query($sxxx);
        }

$sx12s="update  pedido_formulado a, catalogo.almacen_mue b set a.mue=b.mueble where a.sec=b.sec and a.fecg='$fec'";
$this->db->query($sx12s);

$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6 order by a.suc)";
$this->db->query($sx10);
$sx11="insert into pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0 order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  pedidos set sur=0 where fecha='$fec' and invcedis=0";
$this->db->query($sx12);


$sx13="insert into desarrollo.pedido_formulado_resp
(fec1, fecg, tsuc, suc, sec, codigo, descri, vta, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,fec_respaldo)
(select
 fec1, fecg, tsuc, suc, sec, codigo, descri, vta, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,date(now())
from desarrollo.pedido_formulado)";
$this->db->query($sx13);
$sx14="delete FROM pedido_formulado";
$this->db->query($sx14);
$sx15="delete FROM desarrollo.borra_ped_f";
$this->db->query($sx15);
die();


$l="select SUBDATE(date(now()),INTERVAL 2 DAY),b.fechai,fechag, sum(cantidad), a.suc,a.nombre from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc
where a.dia='mie' and sec>0
group by a.suc";

$ll="select a.suc,a.nombre,sum(b.venta)as venta
from catalogo.sucursal a
left join vtadc.venta12 b on b.sucursal=a.suc
where dia='mie' and b.aaa=2012 and b.mes=12
group by a.suc
order by venta";
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function previo_orden_cedis($aaa1,$mes1,$dia1)
    {
$aaa=date('Y');
$mes=date('m');
$dia=date('d');
$di=2.5;

$s1="insert into almacen.compra_for_cedis (fecha, sec, desplaza, transito, inv_cedis, pedido, prv, prvx, costo)
(select date(now()),sec,0,0,0,0,0,'',0 from catalogo.sec_generica WHERE SEC>0 and sec<=2000)";
$this->db->query($s1);    
$s2="update almacen.compra_for_cedis a, desarrollo.inv_cedis_sec1 b
set inv_cedis=inv1
where a.sec=b.sec and inv1>0";
$this->db->query($s2);    
$s3="update almacen.compra_for_cedis a, catalogo.almacen b
set a.costo=b.costo,a.prv=b.prv,a.prvx=b.prvx
where a.sec=b.sec and b.tsec='G'
";
$this->db->query($s3);    
$s4="update almacen.compra_for_cedis a, catalogo.almacen_borrar b
set a.descon='S'
where a.sec=b.sec";
$this->db->query($s4);    
$s5="update almacen.compra_for_cedis a, vtadc.producto_mes_sec12 b
set a.desplaza=ventaa1
where a.sec=b.sec";
$this->db->query($s5);    
$s6="update almacen.compra_for_cedis a, vtadc.producto_mes_sec12 b
set a.desplaza=ventaa12
where a.sec=b.sec and a.sec and desplaza<100 and ventaa12>desplaza";
$this->db->query($s6);    
$s7="update almacen.compraped a, desarrollo.compra_d_orden_sec b
set a.aplica=b.can
where a.folprv=b.orden and a.sec=b.sec and a.sec>0 and a.tipo='alm'";
$this->db->query($s7);

$sx="select sec,(sum(cans)-sum(aplica))as transito FROM almacen.compraped where tipo='alm' and aaap>=$aaa1 and mesp>=$mes1 and diap>$dia1 and tipo='alm' and sec>0 and cans>0 group by sec";
$qx=$this->db->query($sx);
 foreach($qx->result() as $rx)
{ $s8="update almacen.compra_for_cedis set transito=$rx->transito where sec=$rx->sec and $rx->transito>0";
  $this->db->query($s8);       
}
    
    
$s9="update almacen.compra_for_cedis
set maxi=cast(desplaza*($di) as signed) order by desplaza desc limit 150";
$this->db->query($s9);    
$s10="update almacen.compra_for_cedis
set maxi=cast(desplaza*($di) as signed) where maxi=0";
$this->db->query($s10);    
$s11="update almacen.compra_for_cedis
set pedido=cast(maxi-(inv_cedis+transito) as signed)
";
$this->db->query($s11);    
$s12="insert into almacen.pedido1(tipo, sec, can, metro)
(select 'alm',sec,pedido,0 from almacen.compra_for_cedis where pedido>0 and descon='N')
on duplicate key update can=values(can)
";
$this->db->query($s12);

  
$s13="select a.tipo,b.num FROM almacen.pedido1 a left join catalogo.foliador b on a.tipo=b.clav
group by tipo";
$q13 = $this->db->query($s13);
if($q13->num_rows()== 1){
$r13= $q13->row();
$num=$r13->num;
  
}    
    
$s15="select * FROM almacen.pedido1";
$q15=$this->db->query($s15);
 foreach($q15->result() as $r15)
        {
if($r15->can<=10){$can=$r15->can;}
if($r15->can>10 and $r15->can<=100){$can=round(($r15->can/1000),2)*1000;}
if($r15->can>100){$can=round(($r15->can/10000),2)*10000;}
if($r15->metro<=10){$metro=$r15->metro;}
if($r15->metro>10 and $r15->metro<=100){$metro=round(($r15->metro/1000),2)*1000;}
if($r15->metro>100){$metro=round(($r15->metro/10000),2)*10000;}        
$s16="insert into almacen.compra (tipo, sec, nped, aaap, mesp, diap, susa, descri, costo, prv, cprv, persona, lin, canp, canm, cans, tipo3, codigo, cia, clabo, canpbo, maxbo,metro,metrom)
values('alm',$r15->sec,$num,$aaa,$mes,$dia,'','',0,0,'','',0,$r15->can,$can,$can,'B',0,13,0,0,0,$metro,$metro);";
$this->db->query($s16);    
        }
$s17="update 
almacen.compra a, catalogo.almacen b 
set 
a.susa=b.susa1,a.descri=b.susa2,a.costo=b.costo,a.prv=b.prv,a.cprv=b.prvx,a.persona=b.persona,a.lin=b.lin,
a.codigo=b.codigo,a.maxbo=b.maxbo,a.clabo=b.clabo where a.nped=$num and a.sec=b.sec and b.tsec='G' ";
$this->db->query($s17);


$sx1="select *from catalogo.catalogo_bodega";
$qx1 = $this->db->query($sx1);
 foreach($qx1->result() as $rx1)
{
$sx2="update almacen.compra  set clabo=$rx1->clabo, maxbo=$rx1->maxbo where sec=$rx1->sec and prv=$rx1->prv and nped=$num";
$this->db->query($sx2);            
$sx3="insert into almacen.compra(
tipo, sec, nped, aaap, mesp, diap, susa, descri, costo, prv, cprv, persona,
lin, canp, canm, cans, tipo3, codigo, cia,maxbo,clabo,canpbo)
(SELECT
'alm',$rx1->sec,$num,$aaa,$mes ,$dia,'$rx1->susa1', '$rx1->susa2', $rx1->costo, $rx1->prv, '$rx1->prvx','LE',$rx1->lin, 
0, 0, 0,'B',  $rx1->codigo,  13,  $rx1->maxbo, $rx1->clabo, $rx1->maxbo FROM catalogo.catalogo_bodega)
on duplicate key update canpbo=values(canpbo),clabo=values(clabo),descri=values(descri)";
$this->db->query($sx3);
}

$sx4="select *
from farmabodega.inventario_d_clave a
left join almacen.compra b on a.clave=b.clabo
where a.cantidad>0 and nped=$num and maxbo>cantidad";
$qx4 = $this->db->query($sx4);
 foreach($qx4->result() as $rx4)
{
$sx5="update almacen.compra set canpbo = maxbo-$rx4->cantidad where nped=$num and clabo=$rx4->clave and maxbo>$rx4->cantidad
";
$this->db->query($sx5);
}


$sx6="select *
from farmabodega.inventario_d_clave a
left join almacen.compra b on a.clave=b.clabo
where a.cantidad>0 and nped=$num and maxbo<=cantidad";
$qx6 = $this->db->query($sx6);
 foreach($qx6->result() as $rx6)
{
$sx7="update almacen.compra set canpbo =0 where nped=$num and clabo=$rx6->clave";
$this->db->query($sx7);
}



$sx8="delete from almacen.compra  where nped=$num and cans=0 and canpbo=0 and metro=0";
$this->db->query($sx8);
$sx9="insert into almacen.compraped(
tipo, sec, nped, aaap, mesp, diap, susa, descri, costo, prv, prvx, persona,
folprv, lin, sublin, canp, canm, cans, canres, aaae, mese, diae, aaas, mess,
dias, pedidor, surtidor,  claves, clavep, tipo3, codigo, cia, nuevof, stat1,clabo,canpbo,cansbo,metro,metrom)
(SELECT
tipo, sec, nped, aaap, mesp, diap, susa, descri, costo, prv, cprv, persona,
0, lin, 0, canp, canm, cans, 0, 0, 0, 0, 0, 0,
0, 99, 0,  '-', '-', 'B',  codigo,  cia, 0, 'B',clabo,canpbo,canpbo,metro,metrom FROM almacen.compra where nped=$num)
on duplicate key update canp=values(canp);";
$this->db->query($sx9);
$sx10="insert into almacen.compraa(
folio, tipo, tipo2, aaap, mesp, diap, nivel, persona, userid)
VALUES($num,'A','alm',$aaa,$mes,$dia,1,'LE',0)";
$this->db->query($sx10);
$sx11="delete from almacen.pedido1";
$this->db->query($sx11);
$sx11="insert into almacen.compra_for_cedis_res(fecha, sec, desplaza, transito, inv_cedis, pedido, prv, prvx, costo, descon, maxi, nped)
VALUES(select fecha, sec, desplaza, transito, inv_cedis, pedido, prv, prvx, costo, descon, maxi, $num from almacen.compra_for_cedis)";
$this->db->query($sx11);
$sx11="delete from almacen.compra_for_cedis";
$this->db->query($sx11);



$s14="update catalogo.foliador set num=$num+1 where clav='alm'";
$this->db->query($s14); 
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function inv_ceros()
    {
$aaa=date('Y');
$aaax=(date('Y')-1);
$mes=date('m');
$fechai=(date('Y-m-d')-3);
if($mes==01){$m=1;}elseif($mes==02){$m=2;}elseif($mes==03){$m=3;}elseif($mes==04){$m=4;}elseif($mes==05){$m=5;}
 elseif($mes==06){$m=6;}elseif($mes==07){$m=7;}elseif($mes==08){$m=8;}elseif($mes==09){$m=9;}elseif($mes>=10){$m=$mes;}
 $valux='venta_sec'.$m;
 
$sx1="update  vtadc.venta  a, catalogo.sucursal b
set a.tipo=b.tipo2
where a.sucursal=b.suc and aaa=$aaa";
$this->db->query($sx1);
$sx2="update  vtadc.venta  a, catalogo.almacen b
set a.sec=b.sec,a.cos=b.costo
where a.codigo=b.codigo and a.sec=0 and a.tipo<>'F' and b.sec>=1 and a.sec<=1999 and aaa=$aaa";
$this->db->query($sx2);
$sx3="insert into vtadc.producto_semana_ceros (aaa, suc, sec, descripcion, perdida, venta_act, venta_ant, costo,fechai)
(select $aaa, suc, sec, '', 0, 0, 0, 0,fechai from inv where sec>0 and cantidad=0 and mov<>41 and suc>100 and suc<=1600 and fechai>='$fechai')";
$this->db->query($sx3);

$sx4="update  vtadc.producto_semana_ceros a, catalogo.almacen_borrar b
set descon='S'
where a.sec=b.sec";
$this->db->query($sx4);
$sx5="delete from  vtadc.producto_semana_ceros  where descon='S'";
$this->db->query($sx5);
$s5="update  vtadc.producto_semana_ceros a, catalogo.sucursal b
set a.tipo=b.tipo2
where a.suc=b.suc";
$this->db->query($s5);


$sx6="update  vtadc.producto_semana_ceros a, vtadc.venta_sec b
set venta_act=venta
where a.sec=b.sec and a.suc=b.sucursal and b.aaa=$aaa and b.mes=$mes";
$this->db->query($sx6);
$sx7="update  vtadc.producto_semana_ceros a, vtadc.$valux b
set venta_ant=venta
where a.sec=b.sec and a.suc=b.sucursal and b.aaa=$aaax and b.mes=$mes";
$this->db->query($sx7);

$sx8="update  vtadc.producto_semana_ceros a, catalogo.almacen b
set
a.costo=b.costo,
a.venta=
case when tipo='D'
then b.vtaddr
else
b.vtagen
end

where a.sec=b.sec and b.tsec='G'";
$this->db->query($sx8);

$sx9="update vtadc.producto_semana_ceros
set perdida=venta_ant-venta_act";
$this->db->query($sx9);

}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function editar_dia_suc($suc)
    {
        $this->db->where('suc', $suc);
        $query = $this->db->get('catalogo.sucursal');
        //echo $this->db->last_query();
        
        return $query;
        
    }

function editar_dia($dia, $suc)
    {
        $data = array(
           'dia' => $this->input->post('dia')
           
        );
        
        $this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        //echo $this->db->last_query();
        //die();
        
        return $this->db->affected_rows(); 
    }

function invd1()
{

    $s="select a.tlid,SUBDATE(date(now()),INTERVAL 2 DAY)as dia_lim, DATEDIFF(now(), SUBDATE(date(now()),INTERVAL 2 DAY)) AS diferencia,
b.fechai,fechag, sum(cantidad)as can, a.suc,a.nombre from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc
where a.dia='PEN' and sec>0
group by a.suc ORDER BY FECHAI";
$q=$this->db->query($s);
$tabla1= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Fecha Limite</th>
        <th>Fecha de archivo</th>
        <th>Fecha de procesos</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Piezas</th>
        <th>Tlid</th>
        <th>Editar</th>
        </tr>
        </thead>
        <tbody>
        ";
        
  $num=1;      
        foreach($q->result() as $r)
        {
           
            $l= anchor('procesos/editar_dia/'.$r->suc, '<img src="'.base_url().'img/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar', 'class' => 'encabezado'));
           
            $tabla1.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->dia_lim."</td>
            <td align=\"left\">".$r->fechai."</td>
            <td align=\"left\">".$r->fechag."</td>
            <td align=\"left\">".$r->suc."</td>
            <td align=\"left\">".$r->nombre."</td>
            <td align=\"center\">".number_format($r->can,0)."</td>
            <td align=\"left\">".$r->tlid."</td>
            <td style=\"text-align: center;\">".$l."</td>
            </tr>
            ";
            $num=$num+1;
        }
        
        $tabla1.="
        </tbody>
        </table>";
        
        return $tabla1;
}
///////////////////////////////////////
///////////////////////////////////////



}



















/////////////////////////////////////////////////////////////////////////////////////////////////////////