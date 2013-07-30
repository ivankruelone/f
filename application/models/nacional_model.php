<?php
class Nacional_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
        $this->load->helper('html');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_gral($var,$tit,$numero)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$totpor=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
$aaa=date('Y');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         
         $s="select a.*,b.inv1
         
         from catalogo.cat_almacen_clasifica a
left join inv_cedis_sec b on b.sec=a.sec
where a.tipo in ($var0)
";
$q = $this->db->query($s);
        
$num=0;

        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit <br />Clasificacion $varx</caption>
        <thead>
        <tr>
        <th>#</th>
        <th>T</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
        <th>Prom.<br />de 3 <br />meses</th>
        <th>Inv<br />Cedis</th>
        <th>Dias<br />Cedis</th>
        <th>Inv<br />Farmacia</th>
        <th>Dias<br />Farmacia</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;$por=0;
        foreach($q->result() as $r)
        {
$s1="SELECT  sum(cantidad)as cantidad FROM desarrollo.inv a where sec=$r->sec and tsuc<>'F' and mov=07 group by sec"; 
$q1 = $this->db->query($s1);
if($q1->num_rows()>0 ){$r1= $q1->row();
    $inv=$r1->cantidad;}else{$inv=0;}
$s2="select 
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome

from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
where a.sec=$r->sec and b.tipo2<>'F' and a.suc<1600 and b.tlid=1
and b.dia<>' '
group by a.sec"; 
$q2 = $this->db->query($s2);
if($q2->num_rows()>0 ){$r2= $q2->row();
    $prome=$r2->prome;}else{$prome=0;}
    $dias=$inv/($r2->prome/30); 
    $dias_cedis=$r->inv1/($r2->prome/30);  
		$num=$num+1;
       $l1 = anchor('nacional/tabla_desplaza_t_ger_suc_gral/'.$var.'/'.$r->sec,$r->sec.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->tipo."</td>
            <td align=\"left\">".$l1."</td>
             <td align=\"left\">".$r->susa."</td>
            <td align=\"right\"><font color=\"green\">".number_format($prome,0)."</font></td>
            <td align=\"right\">".number_format($r->inv1,0)."</td>
            <td align=\"right\">".number_format($dias_cedis,0)."</td>
            <td align=\"right\">".number_format($inv,0)."</td>
            <td align=\"right\">".number_format($dias,0)."</td>
            </tr>
            ";

}

        $totpor=($por)/$num;

         $tabla.="
         </tbody>
          </table>";
        
        
        return $tabla;
        
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_ger_suc_gral($var,$sec,$tit)
  {
        $numero=100;$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        
$base2='vtadc.producto_mes_suc'.(date('y')-1);  
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
$aaa=date('Y');
    if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select b.dia, a.aaa,b.tipo2, a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where a.sec=$sec and b.tipo2<>'F' and c.tipo in($var0) and a.suc<1600 and b.tlid=1
and b.dia<>' '
group by regional,a.suc
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit <br />Clasificacion $varx</caption>
        <thead>
        <tr>
        <th>#</th>
        <th>Far</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Prom.<br />de 3 mes.<br />A&ntilde;o<br />Ant.</th>
        <th>Prom.<br />de 3 mes.</th>
        <th>Ene</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Abr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Ago</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dic</th>
        <th>Exis.</th>
        <th>Dias Act.</th>
        <th>Dias Ant.</th>
        
        </tr>

        </thead>
        <tbody>
        ";
  $texi=0;$texi=0;      
  $pedtot=0;
        foreach($q->result() as $r)
        {
        $s1="SELECT  sum(cantidad)as exi FROM desarrollo.inv where mov<>41 and suc=$r->suc and sec=$sec group by sec"; 
$q1 = $this->db->query($s1);
if($q1->num_rows()>0){
    $r1= $q1->row();
    $exi=$r1->exi;
    }else{
    $exi=0;    
    }
     $s2="select
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome_ant
from $base2 a
where a.sec=$sec and a.suc=$r->suc
group by sec";
$q2 = $this->db->query($s2);
 if($q2->num_rows()>0){$r2= $q2->row();$prome_ant=$r2->prome_ant;}else{$prome_ant=0;}
 if($exi>0){
    if($r->prome>0){$dias_act=$exi/($r->prome/30);}else{$dias_act=$exi/1;}
    if($prome_ant>0){$dias_ant=$exi/($prome_ant/30);}else{$dias_ant=$exi/1;}
  }else{$dias_act=0;$dias_ant=0;}
		$num=$num+1;
             $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->tipo2."</td>
            <td align=\"left\">".$r->suc."</td>
             <td align=\"left\">".$r->sucx."</td>
             <td align=\"right\"><font color=\"green\">".number_format($prome_ant,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            <td align=\"right\">".number_format($exi,0)."</td>
            <td align=\"right\">".number_format($dias_act,0)."</td>
            <td align=\"right\">".number_format($dias_ant,0)."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12); 
$texi=$texi+($exi); 
        }
            $tabla.="
         </tbody>
         <tfoot>
        <tr>   
            <td align=\"right\" colspan=\"6\">TOTAL</td>
            <td align=\"right\" id=\"ene\">".number_format($t1,0)."</td>
            <td align=\"right\" id=\"feb\">".number_format($t2,0)."</td>
            <td align=\"right\" id=\"mar\">".number_format($t3,0)."</td>
            <td align=\"right\" id=\"abr\">".number_format($t4,0)."</td>
            <td align=\"right\" id=\"may\">".number_format($t5,0)."</td>
            <td align=\"right\" id=\"jun\">".number_format($t6,0)."</td>
            <td align=\"right\" id=\"jul\">".number_format($t7,0)."</td>
            <td align=\"right\" id=\"ago\">".number_format($t8,0)."</td>
            <td align=\"right\" id=\"sep\">".number_format($t9,0)."</td>
            <td align=\"right\" id=\"oct\">".number_format($t10,0)."</td>
            <td align=\"right\" id=\"nov\">".number_format($t11,0)."</td>
            <td align=\"right\" id=\"dic\">".number_format($t12,0)."</td>
            <td align=\"right\">".number_format($texi,0)."</td>
            
           </tr>
           
            
        </tfoot>
        </table>";
         
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_gral_nid($var,$tit,$numero)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
$aaa=date('Y');
    if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select b.fecha_ultima_vta,b.dia, a.aaa,b.tipo2, a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) and a.suc<1600 and b.tlid=1
and b.dia<>' '
group by regional,a.suc
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit <br />Clasificacion $varx</caption>
        <thead>
        <tr>
        <th>#</th>
        <th>F</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Promedio de 3 meses</th>
        <th>Ene</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Abr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Ago</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dic</th>
        <th>Reng.<br />Ceros</th>
        <th>% en Ceros</th>
        <th>Ult.Vta</th>
        </tr>

        </thead>
        <tbody>
        ";
  $neg=0;$por=0;      
  $pedtot=0;
        foreach($q->result() as $r)
        {
        $s1="SELECT  count(b.sec)as negados FROM catalogo.cat_almacen_clasifica a
left join  desarrollo.inv b on b.sec=a.sec and mov<>41
 where tipo in ($var0) and cantidad=0 and suc=$r->suc
"; 
$q1 = $this->db->query($s1);
if($q1->num_rows()>0 and $r->suc<1600){
    $r1= $q1->row();
    $negado=$r1->negados;
    $fin=(($negado*100)/$numero);
    }else{
    $negado=0;    
    $fin=0;    
    }
       
		$num=$num+1;
       $l1 = anchor_popup('nacional/tabla_desplaza_t_ger_suc_gral_nid/'.$var.'/'.$r->suc,$r->suc, array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->tipo2."</td>
            <td align=\"left\">".$l1."</td>
             <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            <td align=\"right\">".number_format($negado,0)."</td>
            <td align=\"right\">".number_format($fin,2)." %</td>
            <td align=\"right\">".$r->fecha_ultima_vta."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12); 
$neg=$neg+($negado); 
$por=$por+($fin);      
        }
        $totpor=($por)/$num;
        
        $img =  img('./img/chart_line_add.png');
        $atts = array(
              'width'      => '800',
              'height'     => '400',
              'scrollbars' => 'no',
              'status'     => 'no',
              'resizable'  => 'no',
              'screenx'    => '0',
              'screeny'    => '0'
            );
        
        $p1=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/1',$img, $atts);
        $p2=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/2',$img, $atts);
        $p3=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/3',$img, $atts);
        $p4=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/4',$img, $atts);
        $p5=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/5',$img, $atts);
        $p6=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/6',$img, $atts);
        $p7=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/7',$img, $atts);
        $p8=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/8',$img, $atts);
        $p9=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/9',$img, $atts);
        $p10=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/10',$img, $atts);
        $p11=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/11',$img, $atts);
        $p12=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por/'.$var.'/'.$aaa.'/12',$img, $atts);
         $tabla.="
         </tbody>
         <tfoot>
        <tr>   
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\" id=\"ene\">".number_format($t1,0)."</td>
            <td align=\"right\" id=\"feb\">".number_format($t2,0)."</td>
            <td align=\"right\" id=\"mar\">".number_format($t3,0)."</td>
            <td align=\"right\" id=\"abr\">".number_format($t4,0)."</td>
            <td align=\"right\" id=\"may\">".number_format($t5,0)."</td>
            <td align=\"right\" id=\"jun\">".number_format($t6,0)."</td>
            <td align=\"right\" id=\"jul\">".number_format($t7,0)."</td>
            <td align=\"right\" id=\"ago\">".number_format($t8,0)."</td>
            <td align=\"right\" id=\"sep\">".number_format($t9,0)."</td>
            <td align=\"right\" id=\"oct\">".number_format($t10,0)."</td>
            <td align=\"right\" id=\"nov\">".number_format($t11,0)."</td>
            <td align=\"right\" id=\"dic\">".number_format($t12,0)."</td>
            <td align=\"right\">".number_format($neg,0)."</td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
           </tr>
           
           <tr>
           <td align=\"right\" colspan=\"5\"></td>
           <td align=\"right\"></td>
           <td align=\"right\"></td>
           <td align=\"right\"></td>
           <td align=\"right\"></td>
           <td align=\"right\">".$p5."</td>
           <td align=\"right\">".$p6."</td>
           <td align=\"right\">".$p7."</td>
           <td align=\"right\">".$p8."</td>
           <td align=\"right\">".$p9."</td>
           <td align=\"right\">".$p10."</td>
           <td align=\"right\">".$p11."</td>
           <td align=\"right\">".$p12."</td>
           <td colspan=\"3\"></td>
           </tr>
           <tr> 
           <td align=\"right\" colspan=\"10\">PROMEDIO GENERAL DE RENGLONES EN CEROS</td>
           <td align=\"right\" colspan=\"10\"><font size=\"+5\">% ".number_format($totpor,2)."</font></td>
           </tr>   
        </tfoot>
        </table>";
         
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
    function control_desplaza_ab_ger_suc_gral_nid($var,$suc,$tit)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select aa.*,a.suc,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
ifnull(final,2)as final,
ifnull(sum(venta1),0)as venta1,
ifnull(sum(venta2),0)as venta2,
ifnull(sum(venta3),0)as venta3,
ifnull(sum(venta4),0)as venta4,
ifnull(sum(venta5),0)as venta5,
ifnull(sum(venta6),0)as venta6,
ifnull(sum(venta7),0)as venta7,
ifnull(sum(venta8),0)as venta8,
ifnull(sum(venta9),0)as venta9,
ifnull(sum(venta10),0)as venta10,
ifnull(sum(venta11),0)as venta11,
ifnull(sum(venta12),0)as venta12
         from catalogo.cat_almacen_clasifica aa
        left join vtadc.producto_mes_suc_gen a on aa.sec=a.sec and a.suc=$suc
  where aa.tipo in($var0) 
  group by aa.sec order by prome desc"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit <br />Clasificacion $varx</caption>
        <thead>
        
        <tr>
        <th>#</th>
        <th>Clasifica</th>
        <th>Sec</th>
        <th>Sustancia activa</th>
        <th>Promedio de 3 meses</th>
        <th>Nuevo Maximo</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        <th>Inv</th>
        <th>Fec.Inv</th>
        </tr>

        </thead>
        <tbody>
        ";
  $ceros=0;      
  $pedtot=0;$tinv=0;
        foreach($q->result() as $r)
        {
      $ss="select sec,(fechai+ INTERVAL 1 day)as fechai,(cantidad)as cantidad from desarrollo.inv where suc=$suc and sec=$r->sec and mov<>41 and  suc<=1600 group by suc,sec";
         $qq=$this->db->query($ss);
         if($qq->num_rows() == 1){
            $rr=$qq->row();
            $inv=$rr->cantidad; 
            $fechai=$rr->fechai; 
         }else{$inv=0; $fechai='';}   
		$num=$num+1;
        if($inv==0){$ceros=$ceros+1;}    
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->tipo."</td>
            <td align=\"left\">".$r->sec."</td>
            <td align=\"left\">".$r->susa."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->final,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            <td align=\"right\">".number_format($inv,0)."</td>
            <td align=\"right\">".$fechai."</td>

            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12); 
$tinv=$tinv+($inv);
    
        }
$prome=round(($ceros*100)/$num,2);
         $tabla.="
         </tbody>
         <tfoot>
        <tr>   
            <td align=\"right\" colspan=\"5\">$ceros TOTAL</td>
            <td align=\"right\" id=\"ene\">".number_format($t1,0)."</td>
            <td align=\"right\" id=\"feb\">".number_format($t2,0)."</td>
            <td align=\"right\" id=\"mar\">".number_format($t3,0)."</td>
            <td align=\"right\" id=\"abr\">".number_format($t4,0)."</td>
            <td align=\"right\" id=\"may\">".number_format($t5,0)."</td>
            <td align=\"right\" id=\"jun\">".number_format($t6,0)."</td>
            <td align=\"right\" id=\"jul\">".number_format($t7,0)."</td>
            <td align=\"right\" id=\"ago\">".number_format($t8,0)."</td>
            <td align=\"right\" id=\"sep\">".number_format($t9,0)."</td>
            <td align=\"right\" id=\"oct\">".number_format($t10,0)."</td>
            <td align=\"right\" id=\"nov\">".number_format($t11,0)."</td>
            <td align=\"right\" id=\"dic\">".number_format($t12,0)."</td>
            <td align=\"right\" id=\"inv\">".number_format($tinv,0)."</td>
         </tr>
         <tr>
         <td align=\"left\" colspan=\"18\"><font size=\"+2\">Productos en ceros $ceros ______Porcentaje % $prome</font></td>
         </tr> 
         <tr>
         <td align=\"left\" colspan=\"18\"><font size=\"+2\">Total de inventario en piezas ".number_format($tinv,2)." de la fecha $fechai</font></td>
         </tr>  
        </tfoot>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_gral_nid_por($var,$aaa,$mes)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
       $ss="select fecha,dia,
case
when dia='Monday'
then 'LUN'
when dia='Tuesday'
then 'MAR'
when dia='Wednesday'
then 'MIE'
when dia='Thursday'
then 'JUE'
when dia='Friday'
then 'VIE'
end as diaa,
case
when dia='Monday'
then 'Lun'
when dia='Tuesday'
then 'Mar'
when dia='Wednesday'
then 'Mie'
when dia='Thursday'
then 'Jue'
when dia='Friday'
then 'Vie'
end as etiqueta,

(SELECT count(aa.sec)  FROM inv_ceros aa
left join catalogo.cat_almacen_clasifica b on b.sec=aa.sec
 where fecha=a.fecha and b.tipo  in($var0))/((select count(sec) from catalogo.cat_almacen_clasifica where tipo  in($var0))*
(select count(*) from catalogo.sucursal where dia=diaa and tlid=1 and suc<1600)/100)as porce

from inv_ceros_fecha a
where aaa=$aaa and mes=$mes";
$qq = $this->db->query($ss);
$dato = '';$etiqueta = '';$fecha='';$num=0;$prome=0;
     foreach($qq->result() as $rr)
        {       
$dato.=round($rr->porce,2).',';
$etiqueta.="'".$rr->etiqueta."<br />".$rr->fecha."',";
        $t1=$t1+$rr->porce;
        $num=$num+1;
        }
  $prome=round(($t1/$num),2);
  $dato=substr($dato,0,-1);
  $etiqueta=substr($etiqueta,0,-1);
  return $dato."//".$etiqueta."//".$prome;
        
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_gral_nid_campa($var,$tit,$numero)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
$aaa=date('Y');
    if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select a.aaa, a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.suc_campana b on b.nid=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where a.sec>0 and a.sec<=2000  and c.tipo in($var0) and b.nid is not null
group by a.suc
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit <br />Clasificacion $varx</caption>
        <thead>
        <tr>
        <th>#</th>
        <th>Farmacia</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Promedio de 3 meses</th>
        <th>Ene</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Abr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Ago</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dic</th>
        <th>Reng.Ceros</th>
        <th>% en Ceros</th>
        </tr>

        </thead>
        <tbody>
        ";
  $neg=0;$por=0;      
  $pedtot=0;
        foreach($q->result() as $r)
        {
        $s1="SELECT  count(b.sec)as negados FROM catalogo.cat_almacen_clasifica a
left join  desarrollo.inv b on b.sec=a.sec and mov<>41
 where tipo in ($var0) and cantidad=0 and suc=$r->suc
"; 
$q1 = $this->db->query($s1);
if($q1->num_rows()>0 and $r->suc<1600){
    $r1= $q1->row();
    $negado=$r1->negados;
    $fin=(($negado*100)/$numero);
    }else{
    $negado=0;    
    $fin=0;    
    }
       
		$num=$num+1;
       $l1 = anchor_popup('nacional/tabla_desplaza_t_ger_suc_gral_nid/'.$var.'/'.$r->suc,$r->suc, array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$l1."</td>
             <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            <td align=\"right\">".number_format($negado,0)."</td>
            <td align=\"right\">".number_format($fin,2)." %</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12); 
$neg=$neg+($negado); 
$por=$por+($fin);      
        }
        $totpor=($por)/$num;
        
        $img =  img('./img/chart_line_add.png');
        $atts = array(
              'width'      => '800',
              'height'     => '400',
              'scrollbars' => 'no',
              'status'     => 'no',
              'resizable'  => 'no',
              'screenx'    => '0',
              'screeny'    => '0'
            );
        
        $p1=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/1',$img, $atts);
        $p2=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/2',$img, $atts);
        $p3=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/3',$img, $atts);
        $p4=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/4',$img, $atts);
        $p5=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/5',$img, $atts);
        $p6=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/6',$img, $atts);
        $p7=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/7',$img, $atts);
        $p8=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/8',$img, $atts);
        $p9=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/9',$img, $atts);
        $p10=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/10',$img, $atts);
        $p11=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/11',$img, $atts);
        $p12=anchor_popup('nacional/tabla_desplaza_t_gral_nid_por_campa/'.$var.'/'.$aaa.'/12',$img, $atts);
         $tabla.="
         </tbody>
         <tfoot>
        <tr>   
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\" id=\"ene\">".number_format($t1,0)."</td>
            <td align=\"right\" id=\"feb\">".number_format($t2,0)."</td>
            <td align=\"right\" id=\"mar\">".number_format($t3,0)."</td>
            <td align=\"right\" id=\"abr\">".number_format($t4,0)."</td>
            <td align=\"right\" id=\"may\">".number_format($t5,0)."</td>
            <td align=\"right\" id=\"jun\">".number_format($t6,0)."</td>
            <td align=\"right\" id=\"jul\">".number_format($t7,0)."</td>
            <td align=\"right\" id=\"ago\">".number_format($t8,0)."</td>
            <td align=\"right\" id=\"sep\">".number_format($t9,0)."</td>
            <td align=\"right\" id=\"oct\">".number_format($t10,0)."</td>
            <td align=\"right\" id=\"nov\">".number_format($t11,0)."</td>
            <td align=\"right\" id=\"dic\">".number_format($t12,0)."</td>
            <td align=\"right\">".number_format($neg,0)."</td>
            <td align=\"right\"></td>
           </tr>
           
           <tr>
           <td align=\"right\" colspan=\"5\"></td>
           <td align=\"right\"></td>
           <td align=\"right\"></td>
           <td align=\"right\"></td>
           <td align=\"right\"></td>
           <td align=\"right\">".$p5."</td>
           <td align=\"right\">".$p6."</td>
           <td align=\"right\">".$p7."</td>
           <td align=\"right\">".$p8."</td>
           <td align=\"right\">".$p9."</td>
           <td align=\"right\">".$p10."</td>
           <td align=\"right\">".$p11."</td>
           <td align=\"right\">".$p12."</td>
           <td colspan=\"2\"></td>
           </tr>
           <tr> 
           <td align=\"right\" colspan=\"10\">PROMEDIO GENERAL DE RENGLONES EN CEROS</td>
           <td align=\"right\" colspan=\"9\"><font size=\"+5\">% ".number_format($totpor,2)."</font></td>
           </tr>   
        </tfoot>
        </table>";
         
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_gral_nid_por_campa($var,$aaa,$mes)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
       $ss="select fecha,dia,
case
when dia='Monday'
then 'LUN'
when dia='Tuesday'
then 'MAR'
when dia='Wednesday'
then 'MIE'
when dia='Thursday'
then 'JUE'
when dia='Friday'
then 'VIE'
end as diaa,
case
when dia='Monday'
then 'Lun'
when dia='Tuesday'
then 'Mar'
when dia='Wednesday'
then 'Mie'
when dia='Thursday'
then 'Jue'
when dia='Friday'
then 'Vie'
end as etiqueta,

(SELECT count(aa.sec)  FROM inv_ceros aa
left join catalogo.cat_almacen_clasifica b on b.sec=aa.sec
left join catalogo.suc_campana cc on cc.nid=aa.suc
 where fecha=a.fecha and b.tipo  in($var0) and cc.nid is not null)/
 
 ((select count(sec) from catalogo.cat_almacen_clasifica where tipo  in($var0))*
(select count(*) from catalogo.sucursal a,catalogo.suc_campana b where a.suc=b.nid and a.dia=diaa and tlid=1 and suc<1600)/100)as porce

from inv_ceros_fecha_campa a
where aaa=$aaa and mes=$mes";
$qq = $this->db->query($ss);
$dato = '';$etiqueta = '';$fecha='';$num=0;$prome=0;
     foreach($qq->result() as $rr)
        {       
$dato.=round($rr->porce,2).',';
$etiqueta.="'".$rr->etiqueta."<br />".$rr->fecha."',";
        $t1=$t1+$rr->porce;
        $num=$num+1;
        }
  $prome=round(($t1/$num),2);
  $dato=substr($dato,0,-1);
  $etiqueta=substr($etiqueta,0,-1);
  return $dato."//".$etiqueta."//".$prome;
        
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_modulos($tit)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$totpor=0;
        
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
$aaa=date('Y');
         $s="select a.tipo2,a.suc,a.nombre,
         sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
         from catalogo.sucursal a
         left join vtadc.producto_mes_suc b on b.suc=a.suc
         where a.suc=187 or a.suc=176 or a.suc=177 or a.suc=178 or a.suc=179 or a.suc=180 
        group by  a.suc
";
$q = $this->db->query($s);
        
$num=0;

        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit </caption>
        <thead>
        <tr>
        <th>#</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Ene</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Abr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Ago</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dic</th>
        <th></th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;$por=0;
        foreach($q->result() as $r)
        {


		$num=$num+1;
       $l1 = anchor('direccion/tabla_desplaza_modulos_suc/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$l1."</td>
             <td align=\"left\">".$r->nombre."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta12,0)."</font></td>
            </tr>
            ";

}

        $totpor=($por)/$num;

         $tabla.="
         </tbody>
          </table>";
        
        
        return $tabla;
        
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_modulos_suc($tit,$suc)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$totpor=0;
        
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
$aaa=date('Y');
         $s="select *from vtadc.producto_mes_suc where suc=$suc order by sec desc
";
$q = $this->db->query($s);
        
$num=0;

        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit </caption>
        <thead>
        <tr>
        <th>#</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Ene</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Abr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Ago</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dic</th>
        <th></th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;$por=0;
        foreach($q->result() as $r)
        {


		$num=$num+1;
       $l1 = anchor('direccion/tabla_desplaza_modulos_suc/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->codigo."</td>
            <td align=\"left\">".$r->sec."</td>
             <td align=\"left\">".$r->descripcion."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->venta12,0)."</font></td>
            </tr>
            ";

}

        $totpor=($por)/$num;

         $tabla.="
         </tbody>
          </table>";
        
        
        return $tabla;
        
    
    }

























































































































































































































































































////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedidos_ger($fec)
    {
        $aa=date('y');
        $bb=substr($fec,2,2);
        echo $bb;
        die();
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select b.*, 
        (SELECT count(*) FROM catalogo.sucursal_ger_sup where regional=b.plaza)as numsup,
        (select count(*) from catalogo.sucursal where regional=b.plaza and tlid=1 and suc>100 and suc<=1999)as numsuc
        from  usuarios b  where  b.nivel=21 and  b.activo=1"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>GERENTE</th>
        <th>SUCURSALES</th>
        <th>CORREO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
       $l1 = anchor('nacional/tabla_control_pedidos_ger_ger/'.$fec.'/'.$r->plaza,$r->numsup.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"left\">".$r->nombre."</td>
            <td align=\"center\">".$r->numsuc."</td>
            <td align=\"left\">".$r->email."</td>
            
            </tr>
            ";
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab($var)
    {
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select d.nombre_e, b.regional,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
left join catalogo.gerente d on d.ger=b.regional
where  b.regional>0 and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0)

group by regional
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"14\">Clasificacion $varx</th>
        </tr>
        <tr>
        <th>Gerente</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
       $l1 = anchor('nacional/tabla_desplaza_t_ger/'.$var.'/'.$r->regional,$r->regional.' '.$r->nombre_e.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">".$l1."</td>
            <td align=\"center\">".number_format($r->venta1,0)."</td>
            <td align=\"center\">".number_format($r->venta2,0)."</td>
            <td align=\"center\">".number_format($r->venta3,0)."</td>
            <td align=\"center\">".number_format($r->venta4,0)."</td>
            <td align=\"center\">".number_format($r->venta5,0)."</td>
            <td align=\"center\">".number_format($r->venta6,0)."</td>
            <td align=\"center\">".number_format($r->venta7,0)."</td>
            <td align=\"center\">".number_format($r->venta8,0)."</td>
            <td align=\"center\">".number_format($r->venta9,0)."</td>
            <td align=\"center\">".number_format($r->venta10,0)."</td>
            <td align=\"center\">".number_format($r->venta11,0)."</td>
            <td align=\"center\">".number_format($r->venta12,0)."</td>
            </tr>
            ";
      
        }
         $tabla.="
        </tbody>
        </table>";
        
        echo $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_ger($var,$reg,$tit)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where  
b.regional=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0)
or
b.superv=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) 
group by regional,a.sec
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;

        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"17\">$tit <br />Clasificacion $varx</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Tipo</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
        <th>Promedio de 3 meses</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
       $l1 = anchor('nacional/tabla_desplaza_t_ger_suc/'.$var.'/'.$reg.'/'.$r->sec,$r->sec.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$l1."</td>
            <td align=\"left\">".$r->tipo."</td>
             <td align=\"left\">".$r->susa."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);      
        }
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
            <td align=\"right\">".number_format($t2,0)."</td>
            <td align=\"right\">".number_format($t3,0)."</td>
            <td align=\"right\">".number_format($t4,0)."</td>
            <td align=\"right\">".number_format($t5,0)."</td>
            <td align=\"right\">".number_format($t6,0)."</td>
            <td align=\"right\">".number_format($t7,0)."</td>
            <td align=\"right\">".number_format($t8,0)."</td>
            <td align=\"right\">".number_format($t9,0)."</td>
            <td align=\"right\">".number_format($t10,0)."</td>
            <td align=\"right\">".number_format($t11,0)."</td>
            <td align=\"right\">".number_format($t12,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        echo $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_ger_suc($var,$reg,$sec,$tit)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where  
b.regional=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) and a.sec=$sec 
or
b.superv=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) and a.sec=$sec 

group by regional,a.sec,a.suc
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"17\">$tit <br /> Clasificacion $varx Secuencia $sec</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Promedio de 3 meses</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->suc."</td>
             <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);      
        }
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"4\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
            <td align=\"right\">".number_format($t2,0)."</td>
            <td align=\"right\">".number_format($t3,0)."</td>
            <td align=\"right\">".number_format($t4,0)."</td>
            <td align=\"right\">".number_format($t5,0)."</td>
            <td align=\"right\">".number_format($t6,0)."</td>
            <td align=\"right\">".number_format($t7,0)."</td>
            <td align=\"right\">".number_format($t8,0)."</td>
            <td align=\"right\">".number_format($t9,0)."</td>
            <td align=\"right\">".number_format($t10,0)."</td>
            <td align=\"right\">".number_format($t11,0)."</td>
            <td align=\"right\">".number_format($t12,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        echo $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_nid($var)
    {
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select d.nombre_e, b.regional,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
left join catalogo.gerente d on d.ger=b.regional
where  b.regional>0 and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0)

group by regional
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"14\">Clasificacion $varx</th>
        </tr>
        <tr>
        <th>Gerente</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
       $l1 = anchor('nacional/tabla_desplaza_t_ger_nid/'.$var.'/'.$r->regional,$r->regional.' '.$r->nombre_e.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">".$l1."</td>
            <td align=\"center\">".number_format($r->venta1,0)."</td>
            <td align=\"center\">".number_format($r->venta2,0)."</td>
            <td align=\"center\">".number_format($r->venta3,0)."</td>
            <td align=\"center\">".number_format($r->venta4,0)."</td>
            <td align=\"center\">".number_format($r->venta5,0)."</td>
            <td align=\"center\">".number_format($r->venta6,0)."</td>
            <td align=\"center\">".number_format($r->venta7,0)."</td>
            <td align=\"center\">".number_format($r->venta8,0)."</td>
            <td align=\"center\">".number_format($r->venta9,0)."</td>
            <td align=\"center\">".number_format($r->venta10,0)."</td>
            <td align=\"center\">".number_format($r->venta11,0)."</td>
            <td align=\"center\">".number_format($r->venta12,0)."</td>
            </tr>
            ";
      
        }
         $tabla.="
        </tbody>
        </table>";
        
        echo $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_ger_nid($var,$reg,$tit)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select b.tipo2, a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where  
b.regional=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) or
b.superv=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0)
group by regional,a.suc
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"19\">$tit <br />Clasificacion $varx</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Farmacia</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Promedio de 3 meses</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
       $l1 = anchor('nacional/tabla_desplaza_t_ger_suc_nid/'.$var.'/'.$reg.'/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$l1."</td>
            <td align=\"left\">".$r->tipo2."</td>
             <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);      
        }
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
            <td align=\"right\">".number_format($t2,0)."</td>
            <td align=\"right\">".number_format($t3,0)."</td>
            <td align=\"right\">".number_format($t4,0)."</td>
            <td align=\"right\">".number_format($t5,0)."</td>
            <td align=\"right\">".number_format($t6,0)."</td>
            <td align=\"right\">".number_format($t7,0)."</td>
            <td align=\"right\">".number_format($t8,0)."</td>
            <td align=\"right\">".number_format($t9,0)."</td>
            <td align=\"right\">".number_format($t10,0)."</td>
            <td align=\"right\">".number_format($t11,0)."</td>
            <td align=\"right\">".number_format($t12,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        echo $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_ger_suc_nid($var,$reg,$suc,$tit,$sucx)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');

         $s="select a.*,
ifnull(m2013,0)as m2013,
ifnull(m2012,0)as m2012,
ifnull(m2011,0)as m2011,
ifnull(final,2)as final,
ifnull(venta1,0)as venta1,
ifnull(venta2,0)as venta2,
ifnull(venta3,0)as venta3,
ifnull(venta4,0)as venta4,
ifnull(venta5,0)as venta5,
ifnull(venta6,0)as venta6,
ifnull(venta7,0)as venta7,
ifnull(venta8,0)as venta8,
ifnull(venta9,0)as venta9,
ifnull(venta10,0)as venta10,
ifnull(venta11,0)as venta11,
ifnull(venta12,0)as venta12
from catalogo.cat_almacen_clasifica a
left join vtadc.producto_mes_suc_gen b on a.sec=b.sec  and  b.suc=$suc
where  a.tipo in($var0) 
order by final desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"25\">$tit <br /> Clasificacion $varx Sucursal $sucx</th>
        </tr>
        <tr>
        <th colspan=\"4\"></th>
        <th colspan=\"5\">Nuevo maximo aun no aplicado hasta autorizacion de Gerencia comercial</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Sec</th>
        <th>Clasificacion</th>
        <th>Sustancia Activa</th>
        <th>2011</th>
        <th>2012</th>
        <th>2013</th>
        <th>Final</th>
        <th>Nuevo<br />Maximo</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        <th>Inv</th>
        <th>Fecha de inv</th>
        <th>Detalle</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
       	
         $ss="select sec,(fechai+ INTERVAL 1 day)as fechai,(cantidad)as cantidad from desarrollo.inv where suc=$suc and sec=$r->sec and mov<>41 group by suc,sec";
         $qq=$this->db->query($ss);
         if($qq->num_rows() == 1){
            $rr=$qq->row();
            $inv=$rr->cantidad; 
            $fechai=$rr->fechai; 
         }else{$inv=0; $fechai='';}
         
         
           if($r->tipo=='a'){$maxi=$r->final*1.5; $finalm=$r->final*1.5;}////45
       	elseif($r->tipo=='b'){$maxi=$r->final*1.333333; $finalm=$r->final*1.333333;}////40
       	elseif($r->tipo=='c'){$maxi=$r->final*1; $finalm=$r->final*1;}/////30
       	elseif($r->tipo=='d'){$maxi=$r->final*1; $finalm=$r->final*1;}/////30  
		$num=$num+1;
         $l1 = anchor('nacional/tabla_desplaza_t_ger_suc_nid_ped/'.$var.'/'.$reg.'/'.$suc.'/'.$r->sec,'Detalle'.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->sec."</td>
            <td align=\"center\">".$r->tipo."</td>
            <td align=\"left\">".$r->susa."</td>
            <td align=\"right\"><font color=\"red\">".number_format($r->m2011,0)."</font></td>
            <td align=\"right\"><font color=\"red\">".number_format($r->m2012,0)."</font></td>
            <td align=\"right\"><font color=\"red\">".number_format($r->m2013,0)."</font></td>
            <td align=\"right\"><font color=\"red\">".number_format($r->final,0)."</font></td>
            <td align=\"right\"><font color=\"red\">".number_format($finalm,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            <td align=\"right\">".number_format($inv,0)."</td>
            <td align=\"right\">".$fechai."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);      
}
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"9\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
            <td align=\"right\">".number_format($t2,0)."</td>
            <td align=\"right\">".number_format($t3,0)."</td>
            <td align=\"right\">".number_format($t4,0)."</td>
            <td align=\"right\">".number_format($t5,0)."</td>
            <td align=\"right\">".number_format($t6,0)."</td>
            <td align=\"right\">".number_format($t7,0)."</td>
            <td align=\"right\">".number_format($t8,0)."</td>
            <td align=\"right\">".number_format($t9,0)."</td>
            <td align=\"right\">".number_format($t10,0)."</td>
            <td align=\"right\">".number_format($t11,0)."</td>
            <td align=\"right\">".number_format($t12,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        
        echo $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_desplaza_ab_ger_suc_nid_sec($var,$reg,$suc,$tit,$sucx,$sec)
    {
        $t1=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        $s0="select * from catalogo.sec_generica where sec=$sec"; 
        $q0=$this->db->query($s0);
        if($q0->num_rows()>0){
        $r0=$q0->row();
        $susa=$r0->susa1;    
        }else{$susa='';}
         $s="select a.* from pedidos a where  a.suc=$suc and a.sec=$sec order by fechasur"; 
      
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"4\">$tit <br /> Clasificacion $varx Sucursal $sucx</th>
        </tr>
        <tr>
        <th colspan=\"4\"> $sec - $susa </th>
        </tr>
        <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Folio</th>
        <th>Piezas</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
        $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"right\">".$r->fechasur."</td>
            <td align=\"right\">".$r->fol."</td>
            <td align=\"right\">".number_format($r->sur,0)."</td>
            </tr>
            ";
$t1=$t1+$r->sur;  
}
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"3\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        echo $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_desplaza_ab_ger_suc_nid_ped($var,$reg,$suc,$tit,$sucx)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select c.tipo,c.susa,a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12

from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where  b.regional=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) and a.suc=$suc 
group by regional,a.suc,a.sec
order by prome desc
"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"20\">$tit <br /> Clasificacion $varx Sucursal $sucx</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Sec</th>
        <th>Clasificacion</th>
        <th>Sucursal</th>
        <th>Promedio de 3 meses</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        <th>Inv</th>
         <th>Fecha de inv</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
         $ss="select sec,(fechai+ INTERVAL 1 day)as fechai,(cantidad)as cantidad from desarrollo.inv where suc=$suc and sec=$r->sec and mov<>41 group by suc,sec";
         $qq=$this->db->query($ss);
         if($qq->num_rows() == 1){
            $rr=$qq->row();
            $inv=$rr->cantidad; 
            $fechai=$rr->fechai; 
         }else{$inv=0; $fechai='';}   
		$num=$num+1;
         $l1 = anchor('nacional/tabla_desplaza_t_ger_suc_nid_ped/'.$var.'/'.$reg.'/'.$r->suc.'/'.$r->sec,'Detalle'.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$r->sec."</td>
            <td align=\"center\">".$r->tipo."</td>
             <td align=\"left\">".$r->susa."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            <td align=\"right\">".number_format($inv,0)."</td>
            <td align=\"right\">".$fechai."</td>
            <td align=\"right\">".$l1."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);      
}
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
            <td align=\"right\">".number_format($t2,0)."</td>
            <td align=\"right\">".number_format($t3,0)."</td>
            <td align=\"right\">".number_format($t4,0)."</td>
            <td align=\"right\">".number_format($t5,0)."</td>
            <td align=\"right\">".number_format($t6,0)."</td>
            <td align=\"right\">".number_format($t7,0)."</td>
            <td align=\"right\">".number_format($t8,0)."</td>
            <td align=\"right\">".number_format($t9,0)."</td>
            <td align=\"right\">".number_format($t10,0)."</td>
            <td align=\"right\">".number_format($t11,0)."</td>
            <td align=\"right\">".number_format($t12,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        echo $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedidos_ger_ger($fec,$ger)
    {
        
        $id_user= $this->session->userdata('id');
        $s="select a.*, b.nombre as superx,b.puesto
		from catalogo.sucursal_ger_sup a
		left join usuarios b on b.plaza=a.superv and b.nivel=14 and responsable='R'
		where regional=$ger and b.activo=1 order by a.superv";
        
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>PLAZA</th>
        <th>SUPERVISOR</th>
        <th>PEDIDOS EN EL MES</th>
        <th>DIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
  $pedtot1=0;
        foreach($q->result() as $r)
        {
		$sx="select a.suc,count(a.suc)as ped
from catalogo.folio_pedidos_cedis a
left join catalogo.sucursal b on a.suc=b.suc and tlid=1 and b.suc>=100 and b.suc<=1999
		 where b.superv=$r->superv and date_format(fechas,'%Y-%m')='$fec'  and tid<>'X' group by superv";
        ;       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $numped=$rx->ped;}else{$numped=0;}
      $sx="select a.suc,count(a.suc)as ped
from catalogo.folio_pedidos_cedis_especial a
left join catalogo.sucursal b on a.suc=b.suc and tlid=1 and b.suc>=100 and b.suc<=1999
		 where b.superv=$r->superv and date_format(fechas,'%Y-%m')='$fec'  and tid<>'X' group by superv";       
	    $qx1 = $this->db->query($sx);
	    if($qx1->num_rows()> 0){
 		   $rx1= $qx1->row();
           $numped1=$rx1->ped;}else{$numped1=0;}
	   $pedtot=$numped+$numped1;
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_pedidos_ger_det/'.$ger.'/'.$r->superv.'/'.$fec,$r->superv.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"left\">".$r->superx."</td>
            <td align=\"center\">".$pedtot."</td>
            <td align=\"right\"></td>
            
            </tr>
            ";
         
         $pedtot1=$pedtot1+$pedtot;
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\"></td>
            <td align=\"left\">TOTAL</td>
            <td align=\"center\">".$pedtot1."</td>
            <td align=\"right\"></td>
            
            </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedidos_ger_sup($ger,$sup,$fec)
    {
        
        $id_user= $this->session->userdata('id');
        $s="select a.*,b.nombre as superx,b.puesto
		from catalogo.sucursal a
		left join usuarios b on b.plaza=a.superv and b.nivel=14 and responsable='R'
		where regional=$ger and b.activo=1 and superv=$sup and tlid=1 and a.suc>100 and a.suc<=1999
		order by suc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>SUPERVISOR</th>
        <th>PEDIDOS EN EL MES</th>
        <th>DIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
  $pedtot1=0;
        foreach($q->result() as $r)
        {
		$sx="select count(*)as ped from catalogo.folio_pedidos_cedis
		 where suc=$r->suc and date_format(fechas,'%Y-%m')='$fec'  and tid<>'X' group by suc";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $numped=$rx->ped;}else{$numped=0;}
      $sx="select count(*)as ped from catalogo.folio_pedidos_cedis_especial
		 where suc=$r->suc and date_format(fechas,'%Y-%m')='$fec'  and tid<>'X' group by suc";       
	    $qx1 = $this->db->query($sx);
	    if($qx1->num_rows()> 0){
 		   $rx1= $qx1->row();
           $numped1=$rx1->ped;}else{$numped1=0;}
	   $pedtot=$numped+$numped1;
	   $num=$num+1;
       $l1 = anchor('nacional/pedido_folio/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"left\">".$r->superx."</td>
            <td align=\"center\">".$pedtot."</td>
            <td align=\"right\">".$r->dia."</td>
            
            </tr>
            ";
         $pedtot1=$pedtot1+$pedtot;
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\"></td>
            <td align=\"left\">TOTAL</td>
            <td align=\"center\">".$pedtot1."</td>
            <td align=\"right\"></td>
            
            </tr>
        </table>";
        
        return $tabla;
    
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedido_folio($fec,$suc)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.folio_pedidos_cedis
		 where suc=$suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X'";
          $q = $this->db->query($s);

$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
		<th colspan=\"4\"></th>
		<th colspan=\"5\">NO SE TOMAN LOS DESCONTINUADOS</th>
		</tr>
        <tr>
        <th>FOLIO</th>
        <th>STATUS</th>
        <th>FECHA</th>
        <th>DESCONTI.</th>
        <th>PEDIDO</th>
        <th>GENERADO</th>
        <th>SURTIDO</th>
        <th>ABASTO<BR />SOLICITADO<BR /> v<BR /> SURTIDO</th>
        <th>ABASTO<BR />GENERADO<BR /> v<BR /> SURTIDO</th>
        </tr>

        </thead>
        <tbody>
        ";
if($q->num_rows()> 0){              
 $tipox=''; 
        foreach($q->result() as $r)
        {
		$sx="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos
		 where fol=$r->id and tipo=1";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $ped=$rx->ped;$sur=$rx->sur;$can=$rx->can;}else{$ped=0;$sur=0;$can=0;}
      $sxd="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos
		 where fol=$r->id and tipo=4";       
	    $qxd = $this->db->query($sxd);
	    if($qxd->num_rows()> 0){
 		   $rxd= $qxd->row();
           $desco=$rxd->ped;}else{$desco=0;}
	   
	   if($sur==0){$abasto=0;}else{$abasto=($sur*100)/$ped;}
	   if($sur==0){$abastos=0;}else{$abastos=($sur*100)/$can;}
	   $num=$num+1;
       $l1 = anchor('nacional/pedido_detalle/'.$r->suc.'/'.$fec.'/'.$r->id,$r->id.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('a_surtido/imprime_pedidos_rem/'.$r->id.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank')); 
	   if($r->tid=='C'){$tipox='SURTIDO'; $color='black';}
       if($r->tid=='S'){$tipox='SIN EXISTENCIA'; $color='orange';}
       if($r->tid=='A'){$tipox='PENDIENTE'; $color='red';}	       
              $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"center\"><font color=\"$color\">".$tipox."</td>
            <td align=\"left\">".$r->fechas."</td>
            <td align=\"right\">".$desco."</td>
			<td align=\"right\">".$can."</td>
            <td align=\"right\">".$ped."</td>
            <td align=\"right\">".$sur."</td>
            <td align=\"right\"> % ".number_format($abastos,2)."</td>
            <td align=\"right\"> % ".number_format($abasto,2)."</td>
            <td align=\"right\">$l2</td>
            </tr>
            ";
         
        }}
        
        $l1e='';
        $se="select *from catalogo.folio_pedidos_cedis_especial
		 where suc=$suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X' ";  
        $qe = $this->db->query($se);
         if($qe->num_rows()> 0){
       	$tipox='';
        foreach($qe->result() as $re)
        {
         $sxe="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos 
		 where fol=$re->id and tipo=1";       
	    $qxe = $this->db->query($sxe);
	    if($qxe->num_rows()> 0){
 		   $rxe= $qxe->row();
           $pede=$rxe->ped;$sure=$rxe->sur;$cane=$rxe->can;}else{$sure=0;$pede=0;$cane=0;}
           $sxde="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos
		 where fol=$re->id and tipo=4";       
	    $qxde = $this->db->query($sxde);
	    if($qxde->num_rows()> 0){
 		   $rxde= $qxde->row();
           $descoe=$rxde->ped;}else{$descoe=0;}
	  
	   if($sure==0){$abastoe=0;}else{$abastoe=($sure*100)/$pede;}
	   if($sure==0){$abastoes=0;}else{$abastoes=($sure*100)/$cane;}
	   $num=$num+1;
       $l1e = anchor('supervisor/pedido_detalle/'.$re->suc.'/'.$fec.'/'.$re->id,$re->id.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
       $l2e = anchor('a_surtido/imprime_pedidos_rem/'.$re->id.'/'.$re->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank')); 
	   if($re->tid=='C'){$tipox='SURTIDO'; $color='black';}
       if($re->tid=='S'){$tipox='SIN EXISTENCIA'; $color='orange';}
       if($re->tid=='A'){$tipox='PENDIENTE'; $color='red';}	       
  
         
         $tabla.="
         <tr>
            <td align=\"left\">$l1e</td>
            <td align=\"center\"><font color=\"$color\">".$tipox."</td>
            <td align=\"left\">".$re->fechas."</td>
            <td align=\"right\">".$descoe."</td>
            <td align=\"right\">".$pede."</td>
            <td align=\"right\">".$cane."</td>
            <td align=\"right\">".$sure."</td>
            <td align=\"right\"> % ".number_format($abastoes,2)."</td>
            <td align=\"right\"> % ".number_format($abastoe,2)."</td>
            <td align=\"right\">$l2e</td>
			</tr>";
       
        
        
    
    }}
$tabla.=" </tbody>
        </table>";    
return $tabla;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedido_detalle($suc,$fec,$fol)
    {
    $totped=0;
    $totcom=0;
	$totcan=0; 
   
	 $s = "SELECT * FROM pedidos
          where fol=$fol order by tipo,sec";
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
        $de='';
        $totpeds=0;
        foreach($q->result() as $r)
        {
        if($r->ped<>$r->sur){
        $color='red';
        }else{
        $color='black';    
        }
        if($r->tipo==4){$de='DESCONTINUADO';$color='blue';}else{$totpeds=$totpeds+$r->ped;   
        }
            $num=+1;
            $tabla.="
            <tr>
            
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->can,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->sur,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$de."</font></td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
        $totped=$totped+$r->ped;
        $totcom=$totcom+$r->sur;         
        }
        $porce=0;
		$porce=($totcom*100)/$totpeds;
        
        
  $tabla.="
        </tbody>
            <tr>
            <td align=\"left\" colspan=\"3\"><font size=\"-1\"><strong> % DE SUTIDO ".$porce." TOTAL </strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totcan,0)."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totped,0)."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totcom,0)."</strong></font></td>
            </tr>
         </table>";
        
        return $tabla;        
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




























































////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_ventas_ger($fec)
    {
        
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
        $bb=substr($fec,2,2);
        $aa=date('y');echo $bb;
        if($bb==$aa){
        	$nombre='vtadc.venta';
        }else{
        $nombre='vtadc.venta'.$bb;	
        }
		
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*, b.nombre as regionalx, 
        sum(venta)as can, 
        sum(total)as sub,
        sum(descuento)as des, 
        sum(importe)as vta
        from catalogo.sucursal a
        left join usuarios b on b.plaza=a.regional 
        left join $nombre c on a.suc=c.sucursal and aaa=$aaa and mes=$mes
        where tlid=1 and a.suc>100 and a.suc<=2000 and b.nivel=21 and b.activo=1 group by a.regional   ";   
        $q = $this->db->query($s);
       
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
	   $num=$num+1;
       $l1 = anchor('nacional/ventas_sup/'.$r->regional.'/'.$fec,$r->regionalx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->sub,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
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
  function control_ventas_sup($ger,$fec)
    {
        
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*, b.nombre as supervx, 
        sum(venta)as can, 
        sum(total)as sub,
        sum(descuento)as des, 
        sum(importe)as vta
        from catalogo.sucursal a
        left join usuarios b on b.plaza=a.superv and activo=1 and nivel=14 and responsable='R'
        left join vtadc.venta c on a.suc=c.sucursal and aaa=$aaa and mes=$mes
        where regional=$ger  and a.suc>100 and a.suc<=2000 and tlid=1 group by a.superv 
        order by superv";   
        $q = $this->db->query($s);
       
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th
        </tr>

        </thead>
        <tbody>
        ";
        
$tot1=0;
$tot2=0;
$tot3=0;
$tot4=0;  
        foreach($q->result() as $r)
        {
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_ventas/'.$r->superv.'/'.$fec,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->sub,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            </tr>
            ";
 $tot1=$tot1+($r->can);
 $tot2=$tot2+($r->sub);
 $tot3=$tot3+($r->des);
 $tot4=$tot4+($r->vta);          
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\">TOTAL</td>
            <td align=\"right\">".number_format($tot1,0)."</td>
            <td align=\"right\">".number_format($tot2,2)."</td>
            <td align=\"right\">".number_format($tot3,2)."</td>
            <td align=\"right\">".number_format($tot4,2)."</td>
            </tr>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_ventas($superv,$fec)
    {
$aaa=substr($fec,0,4);
$mes=substr($fec,5,2);        
        $id_user= $this->session->userdata('id');
        $s="select a.*, b.nombre as supervx, 
        sum(venta)as can, 
        sum(total)as sub,
        sum(descuento)as des, 
        sum(importe)as vta
        from catalogo.sucursal a
        left join usuarios b on b.plaza=a.superv and b.activo=1  and responsable='R'
        left join vtadc.venta c on a.suc=c.sucursal and aaa=$aaa and mes=$mes
        where superv=$superv and a.suc>100 and a.suc<=2000 and a.tlid=1 group by a.suc
        order by superv";   
        $q = $this->db->query($s);
       
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th
        </tr>

        </thead>
        <tbody>
        ";
$tot1=0;
$tot2=0;        
$tot3=0;
$tot4=0;
        foreach($q->result() as $r)
        {
            
		$sx="select sum(can)as can, sum(importe)as importe, sum(can*des)as des, sum(can*vta)as vta  from vtadc.venta_detalle
		 where suc=$r->suc and date_format(fecha,'%Y-%m')='$fec' group by suc";       
	            $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $can=$rx->can; $imp=$rx->importe;
           $vta=$rx->vta; $des=$rx->des;
           }else{$can=0;$imp=0;
           $vta=0;$des=0;
           }
	   
	   $num=$num+1;
       $l1 = anchor('nacional/venta_producto/'.$r->suc.'/'.$fec,$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('nacional/venta_dia/'.$r->suc.'/'.$fec,'DIAS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));     
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
             <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->sub,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"left\">$l2</td>
            </tr>
            ";
 $tot1=$tot1+($r->can);
 $tot2=$tot2+($r->sub);
 $tot3=$tot3+($r->des);
 $tot4=$tot4+($r->vta);          
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\">TOTAL</td>
            <td align=\"right\">".number_format($tot1,0)."</td>
            <td align=\"right\">".number_format($tot2,2)."</td>
            <td align=\"right\">".number_format($tot3,2)."</td>
            <td align=\"right\">".number_format($tot4,2)."</td>
            </tr>
        </table>";
        
        
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function control_ventas_dia($fec,$suc)
    {
        
        $s="select suc,fecha,sum(can)as can, sum(importe)as importe, sum(can*des)as des, sum(can*vta)as vta  from vtadc.venta_detalle
		 where suc=$suc and date_format(fecha,'%Y-%m')='$fec' group by fecha order by fecha";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>FECHA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totvta=0;
        foreach($q->result() as $r)
        {
       	$l1 = anchor('gerente/venta_detalle/'.$r->suc.'/'.$fec.'/'.$r->fecha,$r->fecha.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
		     
            $tabla.="
            <tr>
            <td align=\"right\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->importe;
 	    $totdes=$totdes+$r->des;
     	$totvta=$totvta+$r->vta;
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"1\">TOTAl</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_ger($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as supervx,
        sum(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as fal,
sum(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sob,
sum(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv+ 
turno1_san + turno2_san + turno3_san + turno4_san)as tar,
sum(turno1_vale + turno2_vale + turno3_vale + turno4_vale)as vale,
sum(turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos)as pesos,
sum(turno1_mn + turno2_mn + turno3_mn + turno4_mn)as mn,
sum(turno1_corte + turno2_corte + turno3_corte + turno4_corte)as corte,
sum(turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as asalto
		from catalogo.sucursal a 
        left join usuarios b on b.plaza=a.regional and b.activo=1 and b.nivel=21
        left join cortes_c c on c.suc=a.suc and date_format(c.fechacorte,'%Y-%m')='$fec'
        where tlid=1 and a.suc>100 and a.suc<=2000 and date_format(c.fechacorte,'%Y-%m')='$fec' group by regional
         
		order by a.regional";
        
        $q = $this->db->query($s);
        
$num=0;
		   $totfal=0;
           $totsob=0;
           $tottar=0;
           $totvale=0;
           $totpesos=0;
           $totasalto=0;
           $totcorte=0;
           $totmn=0;
           $totarqueo=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>EFEC.</th>
        <th>CONV.</th>
        <th>TAR.</th>
        <th>VALE</th>
        <th>ASALTO</th>
        <th>ARQUEO</th>
        <th>CORTE</th>
        <th>FAL</th>
        <th>SOB</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
       $arqueo=0;
       $arqueo=$r->tar+$r->vale+$r->pesos+$r->asalto+$r->mn;
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_cortes_sup/'.$r->regional.'/'.$fec,$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->pesos,2)."</td>
            <td align=\"right\">".number_format($r->mn,2)."</td>
			<td align=\"right\">".number_format($r->tar,2)."</td>
            <td align=\"right\">".number_format($r->vale,2)."</td>
            <td align=\"right\">".number_format($r->asalto,2)."</td>
            <td align=\"right\">".number_format($arqueo,2)."</td>
            <td align=\"right\">".number_format($r->corte,2)."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"right\">".number_format($r->sob,2)."</td>
            
             
            </tr>
            ";
           $totfal=$totfal+$r->fal;
           $totsob=$totsob+$r->sob;
           $tottar=$tottar+$r->tar;
           $totvale=$totvale+$r->vale;
           $totpesos=$totpesos+$r->pesos;
           $totasalto=$totasalto+$r->asalto;
           $totcorte=$totcorte+$r->corte;
           $totmn=$totmn+$r->mn;
           $totarqueo=$totarqueo+$arqueo;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totpesos,2)."</td>
            <td align=\"right\">".number_format($totmn,2)."</td>
			<td align=\"right\">".number_format($tottar,2)."</td>
            <td align=\"right\">".number_format($totvale,2)."</td>
            <td align=\"right\">".number_format($totasalto,2)."</td>
            <td align=\"right\">".number_format($totarqueo,2)."</td>
            <td align=\"right\">".number_format($totcorte,2)."</td>
            <td align=\"right\">".number_format($totfal,2)."</td>
            <td align=\"right\">".number_format($totsob,2)."</td>
            
        </tr>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_sup($ger,$fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as supervx,
        sum(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as fal,
sum(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sob,
sum(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv+ 
turno1_san + turno2_san + turno3_san + turno4_san)as tar,
sum(turno1_vale + turno2_vale + turno3_vale + turno4_vale)as vale,
sum(turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos)as pesos,
sum(turno1_mn + turno2_mn + turno3_mn + turno4_mn)as mn,
sum(turno1_corte + turno2_corte + turno3_corte + turno4_corte)as corte,
sum(turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as asalto
		from catalogo.sucursal a 
        left join usuarios b on b.plaza=a.superv and b.activo=1 and b.nivel=14 and responsable='R'
        left join cortes_c c on c.suc=a.suc and date_format(c.fechacorte,'%Y-%m')='$fec'
        where a.regional=$ger and a.tlid=1 and a.suc>100 and a.suc<=2000 and date_format(c.fechacorte,'%Y-%m')='$fec' group by superv
         
		order by a.superv";
        
        $q = $this->db->query($s);
        
$num=0;
		   $totfal=0;
           $totsob=0;
           $tottar=0;
           $totvale=0;
           $totpesos=0;
           $totasalto=0;
           $totcorte=0;
           $totmn=0;
           $totarqueo=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>EFEC.</th>
        <th>CONV.</th>
        <th>TAR.</th>
        <th>VALE</th>
        <th>ASALTO</th>
        <th>ARQUEO</th>
        <th>CORTE</th>
        <th>FAL</th>
        <th>SOB</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
       $arqueo=0;
       $arqueo=$r->tar+$r->vale+$r->pesos+$r->asalto+$r->mn;
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_cortes/'.$r->superv.'/'.$fec,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->pesos,2)."</td>
            <td align=\"right\">".number_format($r->mn,2)."</td>
			<td align=\"right\">".number_format($r->tar,2)."</td>
            <td align=\"right\">".number_format($r->vale,2)."</td>
            <td align=\"right\">".number_format($r->asalto,2)."</td>
            <td align=\"right\">".number_format($arqueo,2)."</td>
            <td align=\"right\">".number_format($r->corte,2)."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"right\">".number_format($r->sob,2)."</td>
            
             
            </tr>
            ";
           $totfal=$totfal+$r->fal;
           $totsob=$totsob+$r->sob;
           $tottar=$tottar+$r->tar;
           $totvale=$totvale+$r->vale;
           $totpesos=$totpesos+$r->pesos;
           $totasalto=$totasalto+$r->asalto;
           $totcorte=$totcorte+$r->corte;
           $totmn=$totmn+$r->mn;
           $totarqueo=$totarqueo+$arqueo;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totpesos,2)."</td>
            <td align=\"right\">".number_format($totmn,2)."</td>
			<td align=\"right\">".number_format($tottar,2)."</td>
            <td align=\"right\">".number_format($totvale,2)."</td>
            <td align=\"right\">".number_format($totasalto,2)."</td>
            <td align=\"right\">".number_format($totarqueo,2)."</td>
            <td align=\"right\">".number_format($totcorte,2)."</td>
            <td align=\"right\">".number_format($totfal,2)."</td>
            <td align=\"right\">".number_format($totsob,2)."</td>
            
        </tr>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes($superv,$fec)
    {
        
        $id_user= $this->session->userdata('id');
        $s="select a.*
		from catalogo.sucursal a where a.superv=$superv 
		order by a.superv,suc";   
        $q = $this->db->query($s);
        
$num=0;
		   $totfal=0;
           $totsob=0;
           $tottar=0;
           $totvale=0;
           $totpesos=0;
           $totasalto=0;
           $totcorte=0;
           $totmn=0;
           $totarqueo=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>DIAS</th>
        <th>EFEC.</th>
        <th>CONV.</th>
        <th>TAR.</th>
        <th>VALE</th>
        <th>ASALTO</th>
        <th>ARQUEO</th>
        <th>CORTE</th>
        <th>FAL</th>
        <th>SOB</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		$sx="select count(*)as dias,
sum(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as fal,
sum(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sob,
sum(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv+ 
turno1_san + turno2_san + turno3_san + turno4_san)as tar,
sum(turno1_vale + turno2_vale + turno3_vale + turno4_vale)as vale,
sum(turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos)as pesos,
sum(turno1_mn + turno2_mn + turno3_mn + turno4_mn)as mn,
sum(turno1_corte + turno2_corte + turno3_corte + turno4_corte)as corte,
sum(turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as asalto

		 from desarrollo.cortes_c where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec' group by suc";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $dias=$rx->dias;	
           $fal=$rx->fal;
           $sob=$rx->sob;
           $tar=$rx->tar;
           $vale=$rx->vale;
           $pesos=$rx->pesos;
           $asalto=$rx->asalto;
           $corte=$rx->corte;
           $mn=$rx->mn;
           $arqueo=$tar+$vale+$pesos+$asalto+$mn;
	    }else{
	       $dias=0;
	       $fal=0;
           $sob=0;
           $tar=0;
           $vale=0;
           $pesos=0;
           $asalto=0;
           $corte=0;
           $mn=0;
           $arqueo=0;
	    }
	   
	   $num=$num+1;
       $l1 = anchor('nacional/corte_dia/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".$dias."</td>
            <td align=\"right\">".number_format($pesos,2)."</td>
            <td align=\"right\">".number_format($mn,2)."</td>
			<td align=\"right\">".number_format($tar,2)."</td>
            <td align=\"right\">".number_format($vale,2)."</td>
            <td align=\"right\">".number_format($asalto,2)."</td>
            <td align=\"right\">".number_format($arqueo,2)."</td>
            <td align=\"right\">".number_format($corte,2)."</td>
            <td align=\"right\">".number_format($fal,2)."</td>
            <td align=\"right\">".number_format($sob,2)."</td>
            
             
            </tr>
            ";
           $totfal=$totfal+$fal;
           $totsob=$totsob+$sob;
           $tottar=$tottar+$tar;
           $totvale=$totvale+$vale;
           $totpesos=$totpesos+$pesos;
           $totasalto=$totasalto+$asalto;
           $totcorte=$totcorte+$corte;
           $totmn=$totmn+$mn;
           $totarqueo=$totarqueo+$arqueo;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totpesos,2)."</td>
            <td align=\"right\">".number_format($totmn,2)."</td>
			<td align=\"right\">".number_format($tottar,2)."</td>
            <td align=\"right\">".number_format($totvale,2)."</td>
            <td align=\"right\">".number_format($totasalto,2)."</td>
            <td align=\"right\">".number_format($totarqueo,2)."</td>
            <td align=\"right\">".number_format($totcorte,2)."</td>
            <td align=\"right\">".number_format($totfal,2)."</td>
            <td align=\"right\">".number_format($totsob,2)."</td>
            
        </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function control_corte_dia($fec,$suc)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$s="select fechacorte,id,
(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as fal,
(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sob,
(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv+ 
turno1_san + turno2_san + turno3_san + turno4_san)as tar,
(turno1_vale + turno2_vale + turno3_vale + turno4_vale)as vale,
(turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos)as pesos,
(turno1_mn + turno2_mn + turno3_mn + turno4_mn)as mn,
(turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as asalto,
(turno1_corte + turno2_corte + turno3_corte + turno4_corte)as corte,

(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv + 
turno1_san + turno2_san + turno3_san + turno4_san +
turno1_vale + turno2_vale + turno3_vale + turno4_vale +
turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos +
turno1_mn + turno2_mn + turno3_mn + turno4_mn +
turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as arqueo


		 from desarrollo.cortes_c where suc=$suc and date_format(fechacorte,'%Y-%m')='$fec'";       
$q = $this->db->query($s);
        
$num=0;
		   $totfal=0;
           $totsob=0;
           $tottar=0;
           $totvale=0;
           $totpesos=0;
           $totasalto=0;
           $totcorte=0;
           $totmn=0;
           $totarqueo=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>FECHA</th>
        <th>EFEC.</th>
        <th>CONV.</th>
        <th>TAR.</th>
        <th>VALE</th>
        <th>ASALTO</th>
        <th>ARQUEO</th>
        <th>CORTE</th>
        <th>FAL</th>
        <th>SOB</th>
        </tr>

        </thead>
        <tbody>
        ";
          
        foreach($q->result() as $r)
        {
	   
	   $num=$num+1;
       $l1 = anchor('nacional/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $tabla.="
            <tr>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".number_format($r->pesos,2)."</td>
            <td align=\"right\">".number_format($r->mn,2)."</td>
			<td align=\"right\">".number_format($r->tar,2)."</td>
            <td align=\"right\">".number_format($r->vale,2)."</td>
            <td align=\"right\">".number_format($r->asalto,2)."</td>
            <td align=\"right\">".number_format($r->arqueo,2)."</td>
            <td align=\"right\">".number_format($r->corte,2)."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"right\">".number_format($r->sob,2)."</td>
            
             
            </tr>
            ";
           $totfal=$totfal+$r->fal;
           $totsob=$totsob+$r->sob;
           $tottar=$tottar+$r->tar;
           $totvale=$totvale+$r->vale;
           $totpesos=$totpesos+$r->pesos;
           $totasalto=$totasalto+$r->asalto;
           $totcorte=$totcorte+$r->corte;
           $totmn=$totmn+$r->mn;
           $totarqueo=$totarqueo+$r->arqueo;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totpesos,2)."</td>
            <td align=\"right\">".number_format($totmn,2)."</td>
			<td align=\"right\">".number_format($tottar,2)."</td>
            <td align=\"right\">".number_format($totvale,2)."</td>
            <td align=\"right\">".number_format($totasalto,2)."</td>
            <td align=\"right\">".number_format($totarqueo,2)."</td>
            <td align=\"right\">".number_format($totcorte,2)."</td>
            <td align=\"right\">".number_format($totfal,2)."</td>
            <td align=\"right\">".number_format($totsob,2)."</td>
            
        </tr>
        </table>";
        
        return $tabla;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_recarga_ger($fec)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,d.nombre as supervx, sum(c.corregido) as recarga
        from catalogo.sucursal a
        left join cortes_c b on b.suc=a.suc
        left join cortes_d c on c.id_cc=b.id and c.clave1=20
        left join usuarios d on d.plaza=a.regional and d.nivel=21 and d.activo=1
         where  a.tlid=1 and a.suc>100 and a.suc<=2000 and c.clave1=20 and date_format(b.fechacorte,'%Y-%m')='$fec'
          group by a.regional";   
        $q = $this->db->query($s);
        
$num=0;
		   $totrec=0;
          
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>RECARGA PDV</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  		$monto=0;
  		$totcom=0;
        foreach($q->result() as $r)
        {
        



	   
	   $num=$num+1;
       $l1 = anchor('nacional/cortes_comanche_sup/'.$r->regional.'/'.$fec,$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color=\"blue\">".number_format($r->recarga,2)."</font></td>
            
            
            
             
            </tr>
            ";
           $totrec=$totrec+$r->recarga;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_recarga_sup($ger,$fec)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,d.nombre as supervx, sum(c.corregido) as recarga
        from catalogo.sucursal a
        left join cortes_c b on b.suc=a.suc
        left join cortes_d c on c.id_cc=b.id and c.clave1=20
        left join usuarios d on d.plaza=a.superv and d.nivel=14 and d.activo=1  and responsable='R'
         where a.regional= $ger and a.tlid=1 and a.suc>100 and a.suc<=2000 and c.clave1=20 and date_format(b.fechacorte,'%Y-%m')='$fec' group by a.superv";   
        $q = $this->db->query($s);
        
$num=0;
		   $totrec=0;
          
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>RECARGA PDV</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  		$monto=0;
  		$totcom=0;
        foreach($q->result() as $r)
        {
        



	   
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_recarga/'.$r->superv.'/'.$fec,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color=\"blue\">".number_format($r->recarga,2)."</font></td>
            
            
            
             
            </tr>
            ";
           $totrec=$totrec+$r->recarga;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_recarga($superv,$fec)
    {
        $ci=& get_instance();
        $ci->load->model('cortes_model');
        
        $id_user= $this->session->userdata('id');
        $s="select *from catalogo.sucursal where superv=$superv order by superv,suc"; 
        $q = $this->db->query($s);
        
$num=0;
$totrec=0;
          
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>DIAS</th>
        <th>RECARGA PDV</th>
        <th>COMANCHE.</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  		$monto=0;
  		$totcom=0;
        foreach($q->result() as $r)
        {
        $suc=$r->suc;
            
        
        $monto=$ci->cortes_model->tam($suc,$fec);
            
		$sx="select count(fechacorte)as dias
		 from desarrollo.cortes_c a
         where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec' group by suc";
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){$rx= $qx->row();
           $dias=$rx->dias;	
	    }else{$dias=0;}
		$sx1="select a.id, sum(b.corregido)as recarga
		 from desarrollo.cortes_c a
         left join desarrollo.cortes_d b on b.id_cc=a.id and b.clave1=20
          where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec' group by suc";       
	    $qx1 = $this->db->query($sx1);
	    if($qx1->num_rows()> 0){$rx1= $qx1->row();
         $recarga=$rx1->recarga;
	    }else{$recarga=0;}



	   
	   $num=$num+1;
       $l1 = anchor('nacional/corte_dia_comanche/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
        if($recarga<>$monto){$color='red';}else{$color='black';}   
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color=\"$color\">".$dias."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($recarga,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($monto,2)."</font></td>
            
            
             
            </tr>
            ";
           $totrec=$totrec+$recarga;
           $totcom=$totcom+$monto;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
            <td align=\"right\">".number_format($totcom,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   function __tablo($sucursal, $fecha)
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_tar_ger()
    {
  $fol1=0;
  $fol2=0;
  $tar1=0;
  $tottar=0;
  $inv=0;
  $l1=0;
  $l2=0;
  $l3=0;
  $l4=0;      
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,sum(b.fol2-b.fol1+1)as inv,c.nombre as supervx
        from catalogo.sucursal a
        left join  vtadc.tarjetas_suc b on b.suc=a.suc
        left join usuarios c on c.plaza=a.regional and c.nivel=21 and c.activo=1
        where  a.suc>100 and a.suc<=2000 and tlid=1 and fol1 is not null group by a.regional";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"2\" align=\"center\">CLIENTE PREFERENTE</th>
        </tr>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>ENTREGAN</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
        	
	
       $l0 = anchor('nacional/tarjetas_sup_sup/'.$r->regional,$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
        
            $tabla.="
            <tr>
            <td align=\"left\">".$l0."</td>
            <td align=\"center\">".$r->inv."</td>
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
  function control_tar($ger)
    {
  $fol1=0;
  $fol2=0;
  $tar1=0;
  $tottar=0;
  $inv=0;
  $l1=0;
  $l2=0;
  $l3=0;
  $l4=0;      
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,sum(b.fol2-b.fol1+1)as inv,c.nombre as supervx
        from catalogo.sucursal a
        left join  vtadc.tarjetas_suc b on b.suc=a.suc
        left join usuarios c on c.plaza=a.superv and nivel=14 and c.activo=1 and responsable='R'
        where regional=$ger and a.suc>100 and a.suc<=2000 and tlid=1 and fol1 is not null group by a.superv";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"2\" align=\"center\">CLIENTE PREFERENTE</th>
        </tr>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>ENTREGAN</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
        	
	
       $l0 = anchor('nacional/tarjetas_sup/'.$r->superv,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
        
            $tabla.="
            <tr>
            <td align=\"left\">".$l0."</td>
            <td align=\"center\">".$r->inv."</td>
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_tar_sup($superv)
    {
  $fol1=0;
  $fol2=0;
  $tar1=0;
  $tottar=0;
  $inv=0;
  $l1=0;
  $l2=0;
  $l3=0;
  $l4=0;      
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.fol1,b.fol2,(b.fol2-b.fol1+1)inv
        from catalogo.sucursal a
        left join  vtadc.tarjetas_suc b on b.suc=a.suc
        where superv=$superv and fol1 is not null"; 
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th></th>
        <th colspan=\"6\" align=\"center\">CLIENTE PREFERENTE</th>
        <th colspan=\"2\" align=\"center\">OTRAS</th>
        </tr>
        
        <tr>
        <th>SUCURSAL</th>
        <th>FOLIO INI.</th>
        <th>FOLIO FIN.</th>
        <th>ENTREGAN</th>
        <th>VENTA</th>
        <th>EXIS.</th>
        <th>DETALLE</th>
        <th>OTRAS</th>
        <th>DETALLE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
        	$fol1=0;
            $fol2=0;
            $fol1=$r->fol1;
        	$fol2=$r->fol2;
        $tottar=$r->fol2-$r->fol1+1;
        
        if($fol1>0){
		$sx="select count(*)as tar from vtadc.tarjetas where suc=$r->suc and tipo=1 and codigo>=$fol1 and codigo<=$fol2";       
        $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $tar=$rx->tar; }else{ $tar=0;}
        $sx1="select count(*)as tar from vtadc.tarjetas where suc=$r->suc and tipo<>1";       
        $qx1 = $this->db->query($sx1);
	    if($qx1->num_rows()> 0){
 		   $rx1= $qx1->row();
           $tar1=$rx1->tar; }else{ $tar1=0;}   
           
	  $tottar=$r->inv-$tar;
	   $num=$num+1;
       $l0 = anchor('nacional/tabla_control_tarjetas_fol/'.$r->suc,$tar.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
       $l1 = anchor('nacional/tabla_control_tarjetas_fol_otras/'.$r->suc,$tar1.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('nacional/tabla_control_tarjetas_pro/'.$r->suc,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el detalle de productos con descuento de cliente preferente!', 'class' => 'encabezado'));
       $l3 = anchor('nacional/tabla_control_tarjetas_pro_otras/'.$r->suc,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el detalle de productos con descuento de otras tarjetas!', 'class' => 'encabezado'));     
       }
       if($tottar==0){$color='red';}else{$color='black';}
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$r->tipo2." - ".$r->suc." - ".$r->nombre."</font></td>
            <td align=\"right\"><font color=\"$color\">".$r->fol1."</font></td>
            <td align=\"right\"><font color=\"$color\">".$r->fol2."</font></td>
            <td align=\"center\"><font color=\"$color\">".$r->inv."</font></td>
            <td align=\"center\"><font color=\"$color\">$l0</font></td>
            <td align=\"center\"><font color=\"$color\">".$tottar."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l2."</font></td>
            <td align=\"center\"><font color=\"$color\">$l1</font></td>
             <td align=\"center\"><font color=\"$color\">$l3</font></td>
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
 function control_tar_folio($suc)
    {
        
        $s="select *  from vtadc.tarjetas where suc=$suc and tipo=1 order by codigo";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
        <th>DIRECCION</th>
        <th>VENTA</th>
        <th>VIGENCIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {

        $l1 = anchor('nacional/tabla_control_tarjetas_fol_pro/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$l1."<br />".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->venta."</td>
            <td align=\"left\">".$r->vigencia."</td>
            </tr>
            ";
         
         }
         $tabla.="
       	    
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_folio_pro($suc,$tar)
    {
        
        $s="select * from vtadc.venta_detalle a 
        left join catalogo.sucursal b on b.suc=a.suc
        where tarjeta=$tar and tipo=1"; 
       
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>APLICO</th>
        <th>FECHA</th>
        <th>TIKET</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"center\">".$r->suc."<br />".$r->nombre."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         
        $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"6\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
  function control_tar_pro($suc)
    {
        
        $s="select codigo,descri,sum(can)as can,sum(importe)as importe, sum(can*vta)as vta, sum(can*des)as des from vtadc.venta_detalle a 
        where a.suc=$suc and tipo=1 and importe>0 group by codigo order by can desc ";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totvta=0;
        foreach($q->result() as $r)
        {
        $l1 = anchor('nacional/tabla_control_tarjetas_pro_det/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>

            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
         $totvta=$totvta+$r->vta;
         $totdes=$totdes+$r->des;
          }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"3\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
              
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_pro_det($suc,$cod)
    {
        
        $s="select * from vtadc.venta_detalle a 
        where codigo=$cod and suc=$suc and tipo=1";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>APLICO</th>
        <th>FECHA</th>
        <th>TIKET<BR />CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totdes=0;
  $totvta=0;     
  $totcan=0;
  $totimp=0;
  
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tarjeta."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."<BR />".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
             <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->des*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        
         $totcan=$totcan+$r->can;
         $totvta=$totvta+$r->vta*$r->can;
         $totdes=$totdes+$r->des*$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
//**************************************************************otras tarjetas que han aplicado descuentos
   function control_tar_folio_otras($suc)
    {
        
        $s="select a.*,b.nombre as tarjetax
from vtadc.tarjetas a
left join catalogo.cat_tarjetas b on b.num=a.tipo
where suc=$suc and tipo>1 order by tipo";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
        <th>DIRECCION</th>
        <th>VENTA</th>
        <th>VIGENCIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        $l1 = anchor('nacional/tabla_control_tarjetas_fol_pro_otras/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
    	
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$l1." <font color=\"blue\">".$r->tarjetax."</font><br />".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->venta."</td>
            <td align=\"left\">".$r->vigencia."</td>
             </tr>
            ";
         
         }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_folio_pro_otras($suc,$tar)
    {
        
        $s="select * from vtadc.venta_detalle a 
        left join catalogo.sucursal b on b.suc=a.suc
        where tarjeta=$tar  and a.suc=$suc"; 
         $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>APLICO</th>
        <th>FECHA</th>
        <th>TIKET<BR />CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
  $totdes=0;
  $totvta=0;     
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"center\">".$r->suc."<br />".$r->nombre."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."<BR />".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->des*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         
         $totcan=$totcan+$r->can;
         $totvta=$totvta+$r->vta*$r->can;
         $totdes=$totdes+$r->des*$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
  function control_tar_pro_otras($suc)
    {
        
        $s="select codigo,descri,sum(can)as can,sum(importe)as importe from vtadc.venta_detalle a 
        where a.suc=$suc and tipo>1 and importe>0 group by codigo order by can desc ";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        $l1 = anchor('nacional/tabla_control_tarjetas_pro_det_otras/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
    	$sx="select sum(can)as can,sum(importe)as imp from vtadc.venta_detalle where tarjeta=$r->codigo group by tarjeta";       
        $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $can=$rx->can;
           $imp=$rx->imp; }else{ $can=0; $imp=0;}
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>

            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
          }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"3\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
              
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_pro_det_otras($suc,$cod)
    {
        
        $s="select * from vtadc.venta_detalle a 
        where codigo=$cod and suc=$suc and tipo>1";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
        <th>FECHA</th>
        <th>TIKET</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tarjeta."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"6\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_ventas_nat($aaa)
    {
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
$tima01=0;$tima02=0;$tima03=0;$tima04=0;$tima05=0;$tima06=0;$tima07=0;$tima08=0;$tima09=0;$tima10=0;$tima11=0;$tima12=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$aaax=$aaa-1;
        $s="SELECT b.regional, c.nombre as supervx,
sum(importe_act_1)as imp01,
sum(importe_act_2)as imp02,
sum(importe_act_3)as imp03,
sum(importe_act_4)as imp04,
sum(importe_act_5)as imp05,
sum(importe_act_6)as imp06,
sum(importe_act_7)as imp07,
sum(importe_act_8)as imp08,
sum(importe_act_9)as imp09,
sum(importe_act_10)as imp10,
sum(importe_act_11)as imp11,
sum(importe_act_12)as imp12,
sum(importe_ant_1)as impn01,
sum(importe_ant_2)as impn02,
sum(importe_ant_3)as impn03,
sum(importe_ant_4)as impn04,
sum(importe_ant_5)as impn05,
sum(importe_ant_6)as impn06,
sum(importe_ant_7)as impn07,
sum(importe_ant_8)as impn08,
sum(importe_ant_9)as impn09,
sum(importe_ant_10)as impn10,
sum(importe_ant_11)as impn11,
sum(importe_ant_12)as impn12
FROM vtadc.fe_prox_det_nat  a
left join catalogo.sucursal b on b.suc=a.suc
left join  desarrollo.usuarios c on c.plaza=b.regional and c.nivel=21 and c.activo=1
where aaa=$aaa and tlid=1 and b.suc>100 and b.suc<=2000 and b.tipo2<>'F'
group by b.regional";
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <th colspan=\"7\">REPORTE DE VENTAS DE PRODUCTOS NATURISTAS</th>
        </thead>
        <tbody>
        ";
        
  $por01=0;$por02=0;$por03=0;$por04=0;$por05=0;$por06=0;$por07=0;$por08=0;$por09=0;$por10=0;$por11=0;$por12=0;
        foreach($q->result() as $r)
        {
if($r->impn01 > $r->imp01 && $r->impn01 > 0){$por01=(($r->imp01*100)/$r->impn01);}
if($r->impn02 > $r->imp02 && $r->impn02 > 0){$por02=(($r->imp02*100)/$r->impn02);}
if($r->impn03 > $r->imp03 && $r->impn03 > 0){$por03=(($r->imp03*100)/$r->impn03);}
if($r->impn04 > $r->imp04 && $r->impn04 > 0){$por04=(($r->imp04*100)/$r->impn04);}
if($r->impn05 > $r->imp05 && $r->impn05 > 0){$por05=(($r->imp05*100)/$r->impn05);}
if($r->impn06 > $r->imp06 && $r->impn06 > 0){$por06=(($r->imp06*100)/$r->impn06);}
if($r->impn07 > $r->imp07 && $r->impn07 > 0){$por07=(($r->imp07*100)/$r->impn07);}
if($r->impn08 > $r->imp08 && $r->impn08 > 0){$por08=(($r->imp08*100)/$r->impn08);}
if($r->impn09 > $r->imp09 && $r->impn09 > 0){$por09=(($r->imp09*100)/$r->impn09);}
if($r->impn10 > $r->imp10 && $r->impn10 > 0){$por10=(($r->imp10*100)/$r->impn10);}
if($r->impn11 > $r->imp11 && $r->impn11 > 0){$por11=(($r->imp11*100)/$r->impn11);}
if($r->impn12 > $r->imp12 && $r->impn12 > 0){$por12=(($r->imp12*100)/$r->impn12);}
	   
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_ventas_nat_ger/'.$r->regional.'/'.$aaa,$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"1\">Sup</td>
            <td align=\"left\" colspan=\"6\">$l1</td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"right\">Ene <font color=\"red\">% ".number_format($por01,2)."</font></td>
            <td align=\"right\">Feb <font color=\"red\">% ".number_format($por02,2)."</font></td>
            <td align=\"right\">Mar <font color=\"red\">% ".number_format($por03,2)."</font></td>
            <td align=\"right\">Abr <font color=\"red\">% ".number_format($por04,2)."</font></td>
            <td align=\"right\">May <font color=\"red\">% ".number_format($por05,2)."</font></td>
            <td align=\"right\">Jun <font color=\"red\">% ".number_format($por06,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp01,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp02,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp03,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp04,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp05,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp06,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn01,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn02,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn03,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn04,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn05,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn06,2)."</font></td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"right\">Jul  <font color=\"red\">% ".number_format($por07,2)."</font></td>
            <td align=\"right\">Ago  <font color=\"red\">% ".number_format($por08,2)."</font></td>
            <td align=\"right\">Sep  <font color=\"red\">% ".number_format($por09,2)."</font></td>
            <td align=\"right\">Oct  <font color=\"red\">% ".number_format($por10,2)."</font></td>
            <td align=\"right\">Nov  <font color=\"red\">% ".number_format($por11,2)."</font></td>
            <td align=\"right\">Dic  <font color=\"red\">% ".number_format($por12,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp07,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp08,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp09,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp10,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp11,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp12,2)."</font></td>
			</tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn07,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn08,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn09,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn10,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn11,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn12,2)."</font></td>
<td align=\"right\"><font color=\"blue\"></font></td>	
			</tr>";
$tim01=$tim01+$r->imp01;
$tim02=$tim02+$r->imp02;
$tim03=$tim03+$r->imp03;
$tim04=$tim04+$r->imp04;
$tim05=$tim05+$r->imp05;
$tim06=$tim06+$r->imp06;
$tim07=$tim07+$r->imp07;
$tim08=$tim08+$r->imp08;
$tim09=$tim09+$r->imp09;
$tim10=$tim10+$r->imp10;
$tim11=$tim11+$r->imp11;
$tim12=$tim12+$r->imp12;
$tima01=$tima01+$r->impn01;
$tima02=$tima02+$r->impn02;
$tima03=$tima03+$r->impn03;
$tima04=$tima04+$r->impn04;
$tima05=$tima05+$r->impn05;
$tima06=$tima06+$r->impn06;
$tima07=$tima07+$r->impn07;
$tima08=$tima08+$r->impn08;
$tima09=$tima09+$r->impn09;
$tima10=$tima10+$r->impn10;
$tima11=$tima11+$r->impn11;
$tima12=$tima12+$r->impn12;
        }
         $tabla.="
         <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"black\">$aaa</font></td>
            <td align=\"right\"><font color=\"black\">ENE: ".number_format($tim01,2)."</font><br /><font color=\"blue\">JUL: ".number_format($tim07,2)."</font></td>
            <td align=\"right\"><font color=\"black\">FEB: ".number_format($tim02,2)."</font><br /><font color=\"blue\">AGO: ".number_format($tim08,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAR: ".number_format($tim03,2)."</font><br /><font color=\"blue\">SEP: ".number_format($tim09,2)."</font></td>
            <td align=\"right\"><font color=\"black\">ABR: ".number_format($tim04,2)."</font><br /><font color=\"blue\">OCT: ".number_format($tim10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAY: ".number_format($tim05,2)."</font><br /><font color=\"blue\">NOV: ".number_format($tim11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">JUN: ".number_format($tim06,2)."</font><br /><font color=\"blue\">DEC: ".number_format($tim12,2)."</font></td>
         </tr>
            
         <tr>
            <td align=\"right\"><font color=\"black\">$aaax</font></td>
            <td align=\"right\"><font color=\"black\">ENE: ".number_format($tima01,2)."</font><br /><font color=\"blue\">JUL: ".number_format($tima07,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAR: ".number_format($tima02,2)."</font><br /><font color=\"blue\">SEP: ".number_format($tima08,2)."</font></td>
            <td align=\"right\"><font color=\"black\">ABR: ".number_format($tima03,2)."</font><br /><font color=\"blue\">OCT: ".number_format($tima09,2)."</font></td>
            <td align=\"right\"><font color=\"black\">FEB: ".number_format($tima04,2)."</font><br /><font color=\"blue\">AGO: ".number_format($tima10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAY: ".number_format($tima05,2)."</font><br /><font color=\"blue\">NOV: ".number_format($tima11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">JUN: ".number_format($tima06,2)."</font><br /><font color=\"blue\">DEC: ".number_format($tima12,2)."</font></td>
        </tr>    
        </tbody>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_ventas_nat_ger($ger,$aaa)
    {
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
$tima01=0;$tima02=0;$tima03=0;$tima04=0;$tima05=0;$tima06=0;$tima07=0;$tima08=0;$tima09=0;$tima10=0;$tima11=0;$tima12=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$aaax=$aaa-1;
        $s="SELECT b.superv, c.nombre as supervx,
sum(importe_act_1)as imp01,
sum(importe_act_2)as imp02,
sum(importe_act_3)as imp03,
sum(importe_act_4)as imp04,
sum(importe_act_5)as imp05,
sum(importe_act_6)as imp06,
sum(importe_act_7)as imp07,
sum(importe_act_8)as imp08,
sum(importe_act_9)as imp09,
sum(importe_act_10)as imp10,
sum(importe_act_11)as imp11,
sum(importe_act_12)as imp12,
sum(importe_ant_1)as impn01,
sum(importe_ant_2)as impn02,
sum(importe_ant_3)as impn03,
sum(importe_ant_4)as impn04,
sum(importe_ant_5)as impn05,
sum(importe_ant_6)as impn06,
sum(importe_ant_7)as impn07,
sum(importe_ant_8)as impn08,
sum(importe_ant_9)as impn09,
sum(importe_ant_10)as impn10,
sum(importe_ant_11)as impn11,
sum(importe_ant_12)as impn12
FROM vtadc.fe_prox_det_nat  a
left join catalogo.sucursal b on b.suc=a.suc
left join  desarrollo.usuarios c on c.plaza=b.superv and c.nivel=14 and c.activo=1 and responsable='R'
where aaa=$aaa and b.regional=$ger and tlid=1 and b.suc>100 and b.suc<=2000 and b.tipo2<>'F'
group by b.superv";
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <th colspan=\"7\">REPORTE DE VENTAS DE PRODUCTOS NATURISTAS</th>
        </thead>
        <tbody>
        ";
        
  $por01=0;$por02=0;$por03=0;$por04=0;$por05=0;$por06=0;$por07=0;$por08=0;$por09=0;$por10=0;$por11=0;$por12=0;
        foreach($q->result() as $r)
        {
if($r->impn01 > $r->imp01 && $r->impn01 > 0){$por01=(($r->imp01*100)/$r->impn01);}
if($r->impn02 > $r->imp02 && $r->impn02 > 0){$por02=(($r->imp02*100)/$r->impn02);}
if($r->impn03 > $r->imp03 && $r->impn03 > 0){$por03=(($r->imp03*100)/$r->impn03);}
if($r->impn04 > $r->imp04 && $r->impn04 > 0){$por04=(($r->imp04*100)/$r->impn04);}
if($r->impn05 > $r->imp05 && $r->impn05 > 0){$por05=(($r->imp05*100)/$r->impn05);}
if($r->impn06 > $r->imp06 && $r->impn06 > 0){$por06=(($r->imp06*100)/$r->impn06);}
if($r->impn07 > $r->imp07 && $r->impn07 > 0){$por07=(($r->imp07*100)/$r->impn07);}
if($r->impn08 > $r->imp08 && $r->impn08 > 0){$por08=(($r->imp08*100)/$r->impn08);}
if($r->impn09 > $r->imp09 && $r->impn09 > 0){$por09=(($r->imp09*100)/$r->impn09);}
if($r->impn10 > $r->imp10 && $r->impn10 > 0){$por10=(($r->imp10*100)/$r->impn10);}
if($r->impn11 > $r->imp11 && $r->impn11 > 0){$por11=(($r->imp11*100)/$r->impn11);}
if($r->impn12 > $r->imp12 && $r->impn12 > 0){$por12=(($r->imp12*100)/$r->impn12);}
	   
	   $num=$num+1;
       $l1 = anchor('nacional/tabla_control_ventas_nat_sup/'.$r->superv.'/'.$aaa,$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"1\">Sup</td>
            <td align=\"left\" colspan=\"6\">$l1</td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"right\">Ene <font color=\"red\">% ".number_format($por01,2)."</font></td>
            <td align=\"right\">Feb <font color=\"red\">% ".number_format($por02,2)."</font></td>
            <td align=\"right\">Mar <font color=\"red\">% ".number_format($por03,2)."</font></td>
            <td align=\"right\">Abr <font color=\"red\">% ".number_format($por04,2)."</font></td>
            <td align=\"right\">May <font color=\"red\">% ".number_format($por05,2)."</font></td>
            <td align=\"right\">Jun <font color=\"red\">% ".number_format($por06,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp01,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp02,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp03,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp04,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp05,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp06,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn01,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn02,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn03,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn04,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn05,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn06,2)."</font></td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"right\">Jul <font color=\"red\">% ".number_format($por07,2)."</font></td>
            <td align=\"right\">Ago <font color=\"red\">% ".number_format($por08,2)."</font></td>
            <td align=\"right\">Sep <font color=\"red\">% ".number_format($por09,2)."</font></td>
            <td align=\"right\">Oct <font color=\"red\">% ".number_format($por10,2)."</font></td>
            <td align=\"right\">Nov <font color=\"red\">% ".number_format($por11,2)."</font></td>
            <td align=\"right\">Dic <font color=\"red\">% ".number_format($por12,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp07,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp08,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp09,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp10,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp11,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp12,2)."</font></td>
			</tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn07,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn08,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn09,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn10,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn11,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn12,2)."</font></td>
<td align=\"right\"><font color=\"blue\"></font></td>	
			</tr>";
$tim01=$tim01+$r->imp01;
$tim02=$tim02+$r->imp02;
$tim03=$tim03+$r->imp03;
$tim04=$tim04+$r->imp04;
$tim05=$tim05+$r->imp05;
$tim06=$tim06+$r->imp06;
$tim07=$tim07+$r->imp07;
$tim08=$tim08+$r->imp08;
$tim09=$tim09+$r->imp09;
$tim10=$tim10+$r->imp10;
$tim11=$tim11+$r->imp11;
$tim12=$tim12+$r->imp12;
$tima01=$tima01+$r->impn01;
$tima02=$tima02+$r->impn02;
$tima03=$tima03+$r->impn03;
$tima04=$tima04+$r->impn04;
$tima05=$tima05+$r->impn05;
$tima06=$tima06+$r->impn06;
$tima07=$tima07+$r->impn07;
$tima08=$tima08+$r->impn08;
$tima09=$tima09+$r->impn09;
$tima10=$tima10+$r->impn10;
$tima11=$tima11+$r->impn11;
$tima12=$tima12+$r->impn12;
        }
         $tabla.="
         <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"black\">$aaa</font></td>
            <td align=\"right\"><font color=\"black\">ENE: ".number_format($tim01,2)."</font><br /><font color=\"blue\">JUL: ".number_format($tim07,2)."</font></td>
            <td align=\"right\"><font color=\"black\">FEB: ".number_format($tim02,2)."</font><br /><font color=\"blue\">AGO: ".number_format($tim08,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAR: ".number_format($tim03,2)."</font><br /><font color=\"blue\">SEP: ".number_format($tim09,2)."</font></td>
            <td align=\"right\"><font color=\"black\">ABR: ".number_format($tim04,2)."</font><br /><font color=\"blue\">OCT: ".number_format($tim10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAY: ".number_format($tim05,2)."</font><br /><font color=\"blue\">NOV: ".number_format($tim11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">JUN: ".number_format($tim06,2)."</font><br /><font color=\"blue\">DEC: ".number_format($tim12,2)."</font></td>
         </tr>
            
         <tr>
            <td align=\"right\"><font color=\"black\">$aaax</font></td>
            <td align=\"right\"><font color=\"black\">ENE: ".number_format($tima01,2)."</font><br /><font color=\"blue\">JUL: ".number_format($tima07,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAR: ".number_format($tima02,2)."</font><br /><font color=\"blue\">SEP: ".number_format($tima08,2)."</font></td>
            <td align=\"right\"><font color=\"black\">ABR: ".number_format($tima03,2)."</font><br /><font color=\"blue\">OCT: ".number_format($tima09,2)."</font></td>
            <td align=\"right\"><font color=\"black\">FEB: ".number_format($tima04,2)."</font><br /><font color=\"blue\">AGO: ".number_format($tima10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAY: ".number_format($tima05,2)."</font><br /><font color=\"blue\">NOV: ".number_format($tima11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">JUN: ".number_format($tima06,2)."</font><br /><font color=\"blue\">DEC: ".number_format($tima12,2)."</font></td>
        </tr>    
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_ventas_nat_sup($superv,$aaa)
    {
$aaax=$aaa-1;
$fec1=$aaa.'-'.'01';$fec2=$aaa.'-'.'02';$fec3=$aaa.'-'.'03';$fec4=$aaa.'-'.'04';$fec5=$aaa.'-'.'05';$fec6=$aaa.'-'.'06';
$fec7=$aaa.'-'.'07';$fec8=$aaa.'-'.'08';$fec9=$aaa.'-'.'09';$fec10=$aaa.'-'.'10';$fec11=$aaa.'-'.'11';$fec12=$aaa.'-'.'12';
$m01=0;$m02=0;$m03=0;$m04=0;$m05=0;$m06=0;$m07=0;$m08=0;$m09=0;$m10=0;$m11=0;$m12=0;
$im01=0;$im02=0;$im03=0;$im04=0;$im05=0;$im06=0;$im07=0;$im08=0;$im09=0;$im10=0;$im11=0;$im12=0;
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.sucursal where 
        superv=$superv and tipo2<>'F'
        ";
		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		$sx="select 
sum(importe_act_1)as imp01,
sum(importe_act_2)as imp02,
sum(importe_act_3)as imp03,
sum(importe_act_4)as imp04,
sum(importe_act_5)as imp05,
sum(importe_act_6)as imp06,
sum(importe_act_7)as imp07,
sum(importe_act_8)as imp08,
sum(importe_act_9)as imp09,
sum(importe_act_10)as imp10,
sum(importe_act_11)as imp11,
sum(importe_act_12)as imp12,
sum(importe_ant_1)as impn01,
sum(importe_ant_2)as impn02,
sum(importe_ant_3)as impn03,
sum(importe_ant_4)as impn04,
sum(importe_ant_5)as impn05,
sum(importe_ant_6)as impn06,
sum(importe_ant_7)as impn07,
sum(importe_ant_8)as impn08,
sum(importe_ant_9)as impn09,
sum(importe_ant_10)as impn10,
sum(importe_ant_11)as impn11,
sum(importe_ant_12)as impn12
from vtadc.fe_prox_det
		 where suc=$r->suc and aaa=$aaa and lab='NATURISTAS'";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
$im01=$rx->imp01;$im02=$rx->imp02;$im03=$rx->imp03;$im04=$rx->imp04;$im05=$rx->imp05;$im06=$rx->imp06;
$im07=$rx->imp07;$im08=$rx->imp08;$im09=$rx->imp09;$im10=$rx->imp10;$im11=$rx->imp11;$im12=$rx->imp12;
$imn01=$rx->impn01;$imn02=$rx->impn02;$imn03=$rx->impn03;$imn04=$rx->impn04;$imn05=$rx->impn05;$imn06=$rx->impn06;
$imn07=$rx->impn07;$imn08=$rx->impn08;$imn09=$rx->impn09;$imn10=$rx->impn10;$imn11=$rx->impn11;$imn12=$rx->impn12;
}
$s01="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec1' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q01 = $this->db->query($s01);if($q01->num_rows()> 0){$r01= $q01->row();$v01=$r01->vta;}else{$v01=0;}
$s02="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec2' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q02 = $this->db->query($s02);if($q02->num_rows()> 0){$r02= $q02->row();$v02=$r02->vta;}else{$v02=0;}
$s03="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec3' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q03 = $this->db->query($s03);if($q03->num_rows()> 0){$r03= $q03->row();$v03=$r03->vta;}else{$v03=0;}
$s04="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec4' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q04 = $this->db->query($s04);if($q04->num_rows()> 0){$r04= $q04->row();$v04=$r04->vta;}else{$v04=0;}
$s05="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec5' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q05 = $this->db->query($s05);if($q05->num_rows()> 0){$r05= $q05->row();$v05=$r05->vta;}else{$v05=0;}
$s06="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec6' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q06 = $this->db->query($s06);if($q06->num_rows()> 0){$r06= $q06->row();$v06=$r06->vta;}else{$v06=0;}
$s07="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec7' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q07= $this->db->query($s07);if($q07->num_rows()> 0){$r07= $q07->row();$v07=$r07->vta;}else{$v07=0;}
$s08="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec8' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q08 = $this->db->query($s08);if($q08->num_rows()> 0){$r08= $q08->row();$v08=$r08->vta;}else{$v08=0;}
$s09="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec9' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q09 = $this->db->query($s09);if($q09->num_rows()> 0){$r09= $q09->row();$v09=$r09->vta;}else{$v09=0;}
$s10="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec10' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q10 = $this->db->query($s10);if($q10->num_rows()> 0){$r10= $q10->row();$v10=$r10->vta;}else{$v10=0;}
$s11="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec11' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q11 = $this->db->query($s11);if($q11->num_rows()> 0){$r11= $q11->row();$v11=$r11->vta;}else{$v11=0;}
$s12="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec12' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q12 = $this->db->query($s12);if($q12->num_rows()> 0){$r12= $q12->row();$v12=$r12->vta;}else{$v12=0;}

if($v01>0){$p01=($im01*100)/$v01;}else{$p01=0;}
if($v02>0){$p02=($im02*100)/$v02;}else{$p02=0;}
if($v03>0){$p03=($im03*100)/$v03;}else{$p03=0;}
if($v04>0){$p04=($im04*100)/$v04;}else{$p04=0;}
if($v05>0){$p05=($im05*100)/$v05;}else{$p05=0;}
if($v06>0){$p06=($im06*100)/$v06;}else{$p06=0;}
if($v07>0){$p07=($im07*100)/$v07;}else{$p07=0;}
if($v08>0){$p08=($im08*100)/$v08;}else{$p08=0;}
if($v09>0){$p09=($im09*100)/$v09;}else{$p09=0;}
if($v10>0){$p10=($im10*100)/$v10;}else{$p10=0;}
if($v11>0){$p11=($im11*100)/$v11;}else{$p11=0;}
if($v12>0){$p12=($im12*100)/$v12;}else{$p12=0;}
	   
	   $num=$num+1;
       $l1 = anchor('nacional/venta_producto_nat/'.$r->suc.'/'.$aaa,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"1\">Sucursal</td>
            <td align=\"left\" colspan=\"6\">$l1</td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"center\">Ene</td>
            <td align=\"center\">Feb</td>
            <td align=\"center\">Mar</td>
            <td align=\"center\">Abr</td>
            <td align=\"center\">May</td>
            <td align=\"center\">Jun</td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Venta $aaa</td>
<td align=\"right\"><font color=\"green\">".number_format($v01,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v02,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v03,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v04,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v05,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v06,2)."</font></td>
            </tr>
            
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($im01,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im02,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im03,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im04,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im05,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im06,2)."</font></td>
            </tr>

            <tr>
<td align=\"left\" colspan=\"1\">%</td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p01,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p02,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p03,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p04,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p05,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p06,2)."</font></td>	
			</tr>
<tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($imn01,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn02,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn03,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn04,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn05,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn06,2)."</font></td>
            </tr>
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>            
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"center\">Jul</td>
            <td align=\"center\">Ago</td>
            <td align=\"center\">Sep</td>
            <td align=\"center\">Oct</td>
            <td align=\"center\">Nov</td>
            <td align=\"center\">Dic</td>
            </tr>
             
            <tr>
<td align=\"left\" colspan=\"1\">Venta</td>
<td align=\"right\"><font color=\"green\">".number_format($v07,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v08,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v09,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v10,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v11,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v12,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista</td>
<td align=\"right\"><font color=\"blue\">".number_format($im07,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im08,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im09,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im10,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im11,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im12,2)."</font></td>	
			</tr>
			<tr>
<td align=\"left\" colspan=\"1\">%</td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p07,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p08,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p09,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p10,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p11,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p12,2)."</font></td>	
			</tr>
<tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($imn07,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn08,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn09,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn10,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn11,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn12,2)."</font></td>
            </tr> 
            ";
$tim01=$tim01+$im01;
$tim02=$tim02+$im02;
$tim03=$tim03+$im03;
$tim04=$tim04+$im04;
$tim05=$tim05+$im05;
$tim06=$tim06+$im06;
$tim07=$tim07+$im07;
$tim08=$tim08+$im08;
$tim09=$tim09+$im09;
$tim10=$tim10+$im10;
$tim11=$tim11+$im11;
$tim12=$tim12+$im12;
        }
         $tabla.="
         <tr>
          <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim01,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim02,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim03,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim04,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim05,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim06,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim07,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim08,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim09,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim10,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim11,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim12,2)."</strong></font></td>
        </tr>    
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

  function comision()
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*
       from desarrollo.cortes_g a
       where tipo>=2
       group by fecha
       order by fecha desc";
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
        <th>FECHA</th>
        <th></th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $num=1;
        foreach($q->result() as $r)
        {
        $l1 = anchor('nacional/tabla_comision_ger/'.$r->fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             
        
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"4\" color=\"$color\"> VENTAS MENSUALES</font></td>
            <td align=\"left\"><font size=\"4\" color=\"$color\">".$r->fecha."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
            $num=$num+1;
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////
 function comision_ger($fecha)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
         
       $s = "select b.regional,c.nombre as supervx,
       b.superv,
	    a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva
       
       from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc 
       left join usuarios c on c.plaza=b.regional and nivel=21 and activo=1
       where
       fecha='$fecha' and clave1<>20 and tlid=1 and b.suc>100 and b.suc<=2000
       group by b.regional";
        $q = $this->db->query($s); 
 $color='#F9075C';        
$totgere=0;
$totsup=0;

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>VTA SIN RECARGA</th>
        
        <th></th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $num=1;
        foreach($q->result() as $r)
        {
        $l1 = anchor('nacional/tabla_comision_sup/'.$r->regional.'/'.$fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             
        
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"4\" color=\"$color\">".$r->supervx."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->siniva,2)."<br />_</font></td>
            
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
            $num=$num+1;
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 function comision_sup($ger,$fecha)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
         
       $s = "select c.nombre as supervx,
       b.superv,
	    a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva
        from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc
       left join desarrollo.usuarios c on c.plaza=b.superv and c.nivel=14 and c.activo=1 and responsable='R'
       where
       fecha='$fecha' and clave1<>20 and regional=$ger and b.suc>100 and b.suc<=2000 and tlid=1
       group by b.superv";

        $q = $this->db->query($s); 
 $color='#F9075C';        
$totgere=0;
$totsup=0;

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>VTA SIN RECARGA</th>
        
        <th></th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $tot1=0;
        $num=1;
        foreach($q->result() as $r)
        {
        $l1 = anchor('nacional/comision_det/'.$r->superv.'/'.$fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             
        
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"4\" color=\"$color\">".$r->superv." - ".$r->supervx."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->siniva,2)."<br />_</font></td>
            
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
            $num=$num+1;
$tot1=$tot1+($r->siniva);
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\"><font size=\"4\" color=\"$color\">TOTAL</font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($tot1,2)."<br />_</font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            </tr>
        </table>";
        
        return $tabla;
    
    }

///////////////////////////////////////////////////////////////////////////////////////

 function comision_det($superv,$fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,
       (select sum(aa.siniva)from desarrollo.cortes_g aa where fecha='$fecha' and aa.suc=a.suc and aa.clave1<>20)as total_vta
       from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc 
       where
       fecha='$fecha' and clave1=10 and superv=$superv and b.tlid=1 and b.suc>100 and b.suc<=2000
       or
       fecha='$fecha' and clave1=11 and superv=$superv and b.tlid=1 and b.suc>100 and b.suc<=2000
       or
       fecha='$fecha' and clave1=16 and superv=$superv and b.tlid=1 and b.suc>100 and b.suc<=2000
       or
       fecha='$fecha' and clave1=24 and superv=$superv and b.tlid=1 and b.suc>100 and b.suc<=2000
       group by suc
       order by tipo2,siniva desc
       ";
       
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
       $tabla= "
       
        <table cellpadding=\"3\">
        
        <tr>
        <th></th>
        <th></th>
        <th align=\"center\" colspan=\"3\"><strong>Venta</strong></th>
        <th align=\"center\" colspan=\"2\">COMISION</th>
        <th></th>
        
        </tr>
        
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Total</th>
        <th>Historico <br />Gontor e Imperial</th>
        <th>Gontor e Imperial</th>
        <th align=\"center\">Vta<br />Dias</th>
        <th align=\"center\">Incremento<br />Dias</th>
        <th></th>
        </tr>
        <tbody>
        ";
        
  
        $num=0;
        $sup=0;
        $ger=0;
        $nat_ger=0;
        $nat_sup=0;
        $tot1=0;
        $tot2=0;
        $tot3=0;
        $tot4=0;
         $color='black';
        foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        if($r->his_vta>0){$dif=$r->siniva-$r->his_vta;}
        if($dif>=15000 and $dif<=19999){$incremento=15;}
        if($dif>=20000 and $dif<=24999){$incremento=20;}
        if($dif>=25000){$incremento=25;}
        if($r->his_vta==0 and $r->siniva>=100000 and $r->tipo2=='G'){$incremento=30;}
        if($r->his_vta==0 and $r->siniva>=150000 and $r->tipo2=='D'){$incremento=30;}
        $l1 = anchor('ventas/imprimir_det1/'.$fecha.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
         $sx1 = "select *from catalogo.cat_comision  where tipo='$r->tipo2' and $r->siniva between monto1 and monto2";
        $qx1 = $this->db->query($sx1);
        if($qx1->num_rows() > 0){    
        $rx1=$qx1->row();
        $farmacia=$rx1->farmacia;
        $ger=$ger+$rx1->gere;
        $sup=$sup+$rx1->sup;
        }     

        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->tipo2." ".str_pad( $r->suc,4,"0",STR_PAD_LEFT)." - ".$r->sucx."<br /><font color=\"gray\">".$r->diac." - ".$r->diad."</font></font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->total_vta,2)."<br />_</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->his_vta,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->siniva,2)."</font></td>
            
            <td align=\"right\"><font size=\"1\" color=\"blue\">".$farmacia."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"red\">".$incremento."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            
             </tr>
            ";
$tot1=$tot1+($r->total_vta);
$tot2=$tot2+($r->his_vta);
$tot3=$tot3+($r->siniva);
         }
         $tabla.="
        
           
       </tbody>
       <tr>
            <td align=\"right\"  COLSPAN=\"2\"><font size=\"2\" color=\"blue\">TOTAL </font></td>
            <td align=\"right\"><font size=\"2\" green=\"blue\">".number_format($tot1,2)."</font></td>
            <td align=\"right\"><font size=\"2\" green=\"blue\">".number_format($tot2,2)."</font></td>
            <td align=\"right\"><font size=\"2\" green=\"blue\">".number_format($tot3,2)."</font></td>
            <td align=\"right\"  COLSPAN=\"3\"><font size=\"2\" color=\"blue\"></font></td></tr>
       </table>";


        return $tabla;
        }

//**************************************************************
//**************************************************************
//**************************************************************
function captura_de_mov_his($clave,$fec,$clavex)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $s="SELECT a.*,b.regional, sum(fal)as mov,d.nombre as gerx
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios d on d.plaza=b.regional and d.nivel=21 and d.activo=1 
      
      where  a.tipo=2 and a.clave=$clave and date_format(fecha,'%Y-%m')='$fec'and a.suc>100 and a.suc<=2000
	  group by regional";
      	$q = $this->db->query($s);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>MOVIMIENTOS $clavex</strong></th>
        </tr>
        <tr>
        
        <th><strong>GERENTE</strong></th>
        <th><strong>MOVIMIENTOS</strong></th>
        </tr>
        </thead>
        ";
        $tot=0;
        $num=0;
        foreach($q->result() as $r)
        {
 		$num=$num+1;
       $l1 = anchor('nacional/movimiento_his_sup/'.$clave.'/'.$clavex.'/'.$fec.'/'.$r->regional,$r->gerx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->mov,2)."</td>
            </tr>
            ";
         $tot=$tot+($r->mov);  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\">TOTAL</td>
            <td align=\"right\">".number_format($tot,2)."</td>
            </tr>
            
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
function captura_de_mov_his_sup($clave,$clavex,$fec,$ger)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $s="SELECT a.*,b.regional,b.superv, sum(fal)as mov,d.nombre as supervx
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios d on d.plaza=b.superv and d.nivel=14 and d.activo=1  and responsable='R'
      
      where b.regional=$ger and  a.tipo=2 and a.clave=$clave and date_format(fecha,'%Y-%m')='$fec'and a.suc>100 and a.suc<=2000
	  group by superv";
      	$q = $this->db->query($s);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>MOVIMIENTOS $clavex</strong></th>
        </tr>
        <tr>
        
        <th><strong>SUPERVISOR</strong></th>
        <th><strong>MOVIMIENTOS</strong></th>
        </tr>
        </thead>
        ";
        $tot=0;
        $num=0;
        foreach($q->result() as $r)
        {
 		$num=$num+1;
       $l1 = anchor('nacional/movimiento_his_suc/'.$clave.'/'.$clavex.'/'.$fec.'/'.$r->superv,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->mov,2)."</td>
            </tr>
            ";
         $tot=$tot+($r->mov);  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\">TOTAL</td>
            <td align=\"right\">".number_format($tot,2)."</td>
            </tr>
            
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
function captura_de_mov_his_suc($clave,$clavex,$fec,$sup)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $s="SELECT a.*,b.nombre,b.superv, sum(fal)as mov
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.suc
      where b.superv=$sup and  a.tipo=2 and a.clave=$clave and date_format(fecha,'%Y-%m')='$fec'and a.suc>100 and a.suc<=2000
	  group by a.suc";
      	$q = $this->db->query($s);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>MOVIMIENTOS $clavex</strong></th>
        </tr>
        <tr>
        
        <th><strong>SUCURSAL</strong></th>
        <th><strong>MOVIMIENTOS</strong></th>
        </tr>
        </thead>
        ";
        $tot=0;
        $num=0;
        foreach($q->result() as $r)
        {
 		$num=$num+1;
       $l1 = anchor('nacional/movimiento_his_det/'.$clave.'/'.$clavex.'/'.$fec.'/'.$r->suc,$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->mov,2)."</td>
            </tr>
            ";
         $tot=$tot+($r->mov);  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\">TOTAL</td>
            <td align=\"right\">".number_format($tot,2)."</td>
            </tr>
            
        </table>";
        
        return $tabla;
    
    }
function captura_de_mov_his_det($clave,$clavex,$fec,$suc)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $s="SELECT a.*,b.nombre as sucx,bb.nombre as clavex,aa.completo
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_empleado aa on aa.cia=a.cianom and aa.nomina=a.nomina
      left join catalogo.cat_nom_claves bb on bb.clave=a.clave
      where a.suc=$suc and  a.tipo=2 and a.clave=$clave and date_format(fecha,'%Y-%m')='$fec'order by nomina";
      	$q = $this->db->query($s);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>MOVIMIENTOS $clavex</strong></th>
        </tr>
        <tr>
        <th><strong>FECHA</strong></th>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>NOMINA</strong></th>
        <th><strong>EMPLEADO</strong></th>
        <th><strong>$clavex</strong></th>
        <th><strong>APLICA</strong></th>
        </tr>
        </thead>
        ";
        $tot=0;
        $num=0;
        foreach($q->result() as $r)
        {
 		$num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"left\">".$r->sucx."</td>
            <td align=\"left\">".$r->nomina."</td>
            <td align=\"left\">".$r->completo."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"center\">".$r->fecpre."</td>
            </tr>
            ";
         $tot=$tot+($r->fal);  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"left\" colspan=\"4\">TOTAL</td>
            <td align=\"right\">".number_format($tot,2)."</td>
            <td align=\"left\" colspan=\"1\">TOTAL</td>
            </tr>
            
        </table>";
        
        return $tabla;
    
    }




//**************************************************************
//**************************************************************
//**************************************************************
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///


//**************************************************************
//**************************************************************
//**************************************************************
}