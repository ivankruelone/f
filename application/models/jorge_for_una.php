<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

///////////////////////////////////////
///////////////////////////////////////


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
die();
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


///////////////////////////////////////
///////////////////////////////////////


?>