	<?php
class Mercadotecnia_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function catalogo_ofertas()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT *from catalogo.cat_mirey order by labor,fec1";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>FECHA</strong></th>
        <th><strong>MAYORISTA</strong></th>
        <th><strong>CODIGO<br />DESCRIPCION</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>DESCUENTO</strong></th>
        <th><strong>DESCUENTO EN VTA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
if($row->vta>0){$color='blue';}else{$color='black';} 

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->fec1." ".$row->fec2."</td>
            <td align=\"left\">".$row->prv."</td>
            <td align=\"left\">".$row->codigo."<br /> ".$row->descri."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"left\">% ".$row->descu."</td>
            <td align=\"right\"><font color=\"$color\">% ".$row->vta."</font></td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function catalogo_labor()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    (select count(*) from catalogo.laboratorios_pro where num=lab group by lab)as pro
    from catalogo.laboratorios a";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>CATALOGO DE LABORATORIOS</strong></th>
        </tr>
        <tr>
        <th><strong>ID</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>PRODUCTOS</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
         $l1 = anchor('mercadotecnia/tabla_catalogo_lab_det/'.$row->num, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->num."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"right\">".$row->pro."</td>
            <td>$l1</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function catalogo_labor_det($lab)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT * from catalogo.laboratorios_pro where lab=$lab order by descri";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>CATALOGO DE LABORATORIOS</strong></th>
        </tr>
        <tr>
        <th><strong>TIPO</strong></th>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"center\">".$row->tipo."</td>
            <td align=\"right\">".$row->codigo."</td>
            <td align=\"left\">".$row->descri."</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_ofertas()
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.* from catalogo.cat_mirey a 
    left join vtadc.codigo_prox b on b.codigo=a.codigo
    where b.aaa=$aaa
    group by a.codigo order by descri";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        <th width=\"300\"></th>
        <th width=\"300\">___________________________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        <th width=\"140\" colspan=\"1\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"250\">CODIGO</th>
        <th width=\"250\">DESCRIPCION</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        foreach($query->result() as $row){
            
$color='blue';
$color1='blue';$color2='blue';$color3='blue';$color4='blue';$color5='blue';$color6='blue';
$color7='blue';$color8='blue';$color9='blue';$color10='blue';$color11='blue';$color12='blue';           
if($row->venta_act_1>$row->venta_ant_1){$color1='purple';}
if($row->venta_act_2>$row->venta_ant_2){$color2='purple';}
if($row->venta_act_3>$row->venta_ant_3){$color3='purple';}
if($row->venta_act_4>$row->venta_ant_4){$color4='purple';}
if($row->venta_act_5>$row->venta_ant_5){$color5='purple';}
if($row->venta_act_6>$row->venta_ant_6){$color6='purple';}
if($row->venta_act_7>$row->venta_ant_7){$color7='purple';}
if($row->venta_act_8>$row->venta_ant_8){$color8='purple';}
if($row->venta_act_9>$row->venta_ant_9){$color9='purple';}
if($row->venta_act_10>$row->venta_ant_10){$color10='purple';}
if($row->venta_act_11>$row->venta_ant_11){$color11='purple';}
if($row->venta_act_12>$row->venta_ant_12){$color12='purple';}
if($xnum==1){$colorcelda='#C2E8FB';}
if($xnum==0){$colorcelda='#EDF3F9';}
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"right\"><font>".$row->codigo."</td>
            <td align=\"left\"><font>".$row->descri."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($row->venta_act_1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color2\">".number_format($row->venta_act_2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color3\">".number_format($row->venta_act_3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color4\">".number_format($row->venta_act_4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color5\">".number_format($row->venta_act_5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color6\">".number_format($row->venta_act_6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color7\">".number_format($row->venta_act_7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color8\">".number_format($row->venta_act_8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color9\">".number_format($row->venta_act_9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color10\">".number_format($row->venta_act_10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color11\">".number_format($row->venta_act_11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color12\">".number_format($row->venta_act_12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->inv,0)."</td>
            </tr>
            
            ";
$act1=$act1+($row->venta_act_1);
$act2=$act2+($row->venta_act_2);
$act3=$act3+($row->venta_act_3);
$act4=$act4+($row->venta_act_4);
$act5=$act5+($row->venta_act_5);
$act6=$act6+($row->venta_act_6);
$act7=$act7+($row->venta_act_7);
$act8=$act8+($row->venta_act_8);
$act9=$act9+($row->venta_act_9);
$act10=$act10+($row->venta_act_10);
$act11=$act11+($row->venta_act_11);
$act12=$act12+($row->venta_act_12);
$actt1=$actt1+($row->venta_actt_1);
$actt2=$actt2+($row->venta_actt_2);
$actt3=$actt3+($row->venta_actt_3);
$actt4=$actt4+($row->venta_actt_4);
$actt5=$actt5+($row->venta_actt_5);
$actt6=$actt6+($row->venta_actt_6);
$actt7=$actt7+($row->venta_actt_7);
$actt8=$actt8+($row->venta_actt_8);
$actt9=$actt9+($row->venta_actt_9);
$actt10=$actt10+($row->venta_actt_10);
$actt11=$actt11+($row->venta_actt_11);
$actt12=$actt12+($row->venta_actt_12);
$antt1=$antt1+($row->venta_antt_1);
$antt2=$antt2+($row->venta_antt_2);
$antt3=$antt3+($row->venta_antt_3);
$antt4=$antt4+($row->venta_antt_4);
$antt5=$antt5+($row->venta_antt_5);
$antt6=$antt6+($row->venta_antt_6);
$antt7=$antt7+($row->venta_antt_7);
$antt8=$antt8+($row->venta_antt_8);
$antt9=$antt9+($row->venta_antt_9);
$antt10=$antt10+($row->venta_antt_10);
$antt11=$antt11+($row->venta_antt_11);
$antt12=$antt12+($row->venta_antt_12);
$ant1=$ant1+($row->venta_ant_1);
$ant2=$ant2+($row->venta_ant_2);
$ant3=$ant3+($row->venta_ant_3);
$ant4=$ant4+($row->venta_ant_4);
$ant5=$ant5+($row->venta_ant_5);
$ant6=$ant6+($row->venta_ant_6);
$ant7=$ant7+($row->venta_ant_7);
$ant8=$ant8+($row->venta_ant_8);
$ant9=$ant9+($row->venta_ant_9);
$ant10=$ant10+($row->venta_ant_10);
$ant11=$ant11+($row->venta_ant_11);
$ant12=$ant12+($row->venta_ant_12);
$inv=$inv+($row->inv);
$num=$num+1;
if($xnum==1){$xnum=0;}else{$xnum=1;}
        }
$tabla.="
<tr  bgcolor=\"#88A7C7\">
        <th width=\"300\"></th>
        <th width=\"300\">___________________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        <th width=\"70\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"><strong></strong></th>
        
        
        </tr>
        <tr>
        <th colspan=\"2\">TOTAL DE MEDICAMENTOS $num</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
<tr bgcolor=\"#F5FBFB\">
            <td align=\"left\" colspan=\"2\"><font  width=\"70\">TOTAL</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
            
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab()
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    sum(venta_act_1)as venta_act_1,
    sum(venta_act_2)as venta_act_2,
    sum(venta_act_3)as venta_act_3,
    sum(venta_act_4)as venta_act_4,
    sum(venta_act_5)as venta_act_5,
    sum(venta_act_6)as venta_act_6,
    sum(venta_act_7)as venta_act_7,
    sum(venta_act_8)as venta_act_8,
    sum(venta_act_9)as venta_act_9,
    sum(venta_act_10)as venta_act_10,
    sum(venta_act_11)as venta_act_11,
    sum(venta_act_12)as venta_act_12,
    sum(venta_ant_1)as venta_ant_1,
    sum(venta_ant_2)as venta_ant_2,
    sum(venta_ant_3)as venta_ant_3,
    sum(venta_ant_4)as venta_ant_4,
    sum(venta_ant_5)as venta_ant_5,
    sum(venta_ant_6)as venta_ant_6,
    sum(venta_ant_7)as venta_ant_7,
    sum(venta_ant_8)as venta_ant_8,
    sum(venta_ant_9)as venta_ant_9,
    sum(venta_ant_10)as venta_ant_10,
    sum(venta_ant_11)as venta_ant_11,
    sum(venta_ant_12)as venta_ant_12,
    sum(venta_antt_1)as venta_antt_1,
    sum(venta_antt_2)as venta_antt_2,
    sum(venta_antt_3)as venta_antt_3,
    sum(venta_antt_4)as venta_antt_4,
    sum(venta_antt_5)as venta_antt_5,
    sum(venta_antt_6)as venta_antt_6,
    sum(venta_antt_7)as venta_antt_7,
    sum(venta_antt_8)as venta_antt_8,
    sum(venta_antt_9)as venta_antt_9,
    sum(venta_antt_10)as venta_antt_10,
    sum(venta_antt_11)as venta_antt_11,
    sum(venta_antt_12)as venta_antt_12,
    sum(venta_actt_1)as venta_actt_1,
    sum(venta_actt_2)as venta_actt_2,
    sum(venta_actt_3)as venta_actt_3,
    sum(venta_actt_4)as venta_actt_4,
    sum(venta_actt_5)as venta_actt_5,
    sum(venta_actt_6)as venta_actt_6,
    sum(venta_actt_7)as venta_actt_7,
    sum(venta_actt_8)as venta_actt_8,
    sum(venta_actt_9)as venta_actt_9,
    sum(venta_actt_10)as venta_actt_10,
    sum(venta_actt_11)as venta_actt_11,
    sum(venta_actt_12)as venta_actt_12,
    sum(inv)as inv,
    c.labor 
    from catalogo.laboratorios_pro a 
    left join vtadc.codigo_prox b on b.codigo=a.codigo
    left join catalogo.laboratorios c on c.num=a.lab
    where b.aaa=$aaa
    group by a.lab order by labor";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"center\"><strong>CATALOGO DE LABORATORIOS</strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"300\">_______________________________________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        <th width=\"70\" colspan=\"4\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"  colspan=\"2\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"250\">LABORATORIO</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
$l1 = anchor('mercadotecnia/tabla_desplazamientos_lab_ctl/'.$row->lab.'/'.$row->labor,'CTL', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado', 'target' => 'blank'));
$l2 = anchor('mercadotecnia/tabla_desplazamientos_lab_ctl/'.$row->lab,'DET', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado', 'target' => 'blank'));           
$color='blue';
$color1='blue';$color2='blue';$color3='blue';$color4='blue';$color5='blue';$color6='blue';
$color7='blue';$color8='blue';$color9='blue';$color10='blue';$color11='blue';$color12='blue';           
if($row->venta_act_1>$row->venta_ant_1){$color1='purple';}
if($row->venta_act_2>$row->venta_ant_2){$color2='purple';}
if($row->venta_act_3>$row->venta_ant_3){$color3='purple';}
if($row->venta_act_4>$row->venta_ant_4){$color4='purple';}
if($row->venta_act_5>$row->venta_ant_5){$color5='purple';}
if($row->venta_act_6>$row->venta_ant_6){$color6='purple';}
if($row->venta_act_7>$row->venta_ant_7){$color7='purple';}
if($row->venta_act_8>$row->venta_ant_8){$color8='purple';}
if($row->venta_act_9>$row->venta_ant_9){$color9='purple';}
if($row->venta_act_10>$row->venta_ant_10){$color10='purple';}
if($row->venta_act_11>$row->venta_ant_11){$color11='purple';}
if($row->venta_act_12>$row->venta_ant_12){$color12='purple';}
if($xnum==1){$colorcelda='#C2E8FB';}
if($xnum==0){$colorcelda='#EDF3F9';}
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font  width=\"70\">".$l1."</td>
            <td align=\"left\"><font  width=\"70\">".$l2."</td>
            <td align=\"left\"><font  width=\"70\">".$row->labor."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($row->venta_act_1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color2\">".number_format($row->venta_act_2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color3\">".number_format($row->venta_act_3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color4\">".number_format($row->venta_act_4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color5\">".number_format($row->venta_act_5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color6\">".number_format($row->venta_act_6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color7\">".number_format($row->venta_act_7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color8\">".number_format($row->venta_act_8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color9\">".number_format($row->venta_act_9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color10\">".number_format($row->venta_act_10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color11\">".number_format($row->venta_act_11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color12\">".number_format($row->venta_act_12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->inv,0)."</td>
            </tr>
            
            ";
$act1=$act1+($row->venta_act_1);
$act2=$act2+($row->venta_act_2);
$act3=$act3+($row->venta_act_3);
$act4=$act4+($row->venta_act_4);
$act5=$act5+($row->venta_act_5);
$act6=$act6+($row->venta_act_6);
$act7=$act7+($row->venta_act_7);
$act8=$act8+($row->venta_act_8);
$act9=$act9+($row->venta_act_9);
$act10=$act10+($row->venta_act_10);
$act11=$act11+($row->venta_act_11);
$act12=$act12+($row->venta_act_12);
$actt1=$actt1+($row->venta_actt_1);
$actt2=$actt2+($row->venta_actt_2);
$actt3=$actt3+($row->venta_actt_3);
$actt4=$actt4+($row->venta_actt_4);
$actt5=$actt5+($row->venta_actt_5);
$actt6=$actt6+($row->venta_actt_6);
$actt7=$actt7+($row->venta_actt_7);
$actt8=$actt8+($row->venta_actt_8);
$actt9=$actt9+($row->venta_actt_9);
$actt10=$actt10+($row->venta_actt_10);
$actt11=$actt11+($row->venta_actt_11);
$actt12=$actt12+($row->venta_actt_12);
$antt1=$antt1+($row->venta_antt_1);
$antt2=$antt2+($row->venta_antt_2);
$antt3=$antt3+($row->venta_antt_3);
$antt4=$antt4+($row->venta_antt_4);
$antt5=$antt5+($row->venta_antt_5);
$antt6=$antt6+($row->venta_antt_6);
$antt7=$antt7+($row->venta_antt_7);
$antt8=$antt8+($row->venta_antt_8);
$antt9=$antt9+($row->venta_antt_9);
$antt10=$antt10+($row->venta_antt_10);
$antt11=$antt11+($row->venta_antt_11);
$antt12=$antt12+($row->venta_antt_12);
$ant1=$ant1+($row->venta_ant_1);
$ant2=$ant2+($row->venta_ant_2);
$ant3=$ant3+($row->venta_ant_3);
$ant4=$ant4+($row->venta_ant_4);
$ant5=$ant5+($row->venta_ant_5);
$ant6=$ant6+($row->venta_ant_6);
$ant7=$ant7+($row->venta_ant_7);
$ant8=$ant8+($row->venta_ant_8);
$ant9=$ant9+($row->venta_ant_9);
$ant10=$ant10+($row->venta_ant_10);
$ant11=$ant11+($row->venta_ant_11);
$ant12=$ant12+($row->venta_ant_12);

$inv=$inv+($row->inv);
$num=$num+1;
if($xnum==1){$xnum=0;}else{$xnum=1;}
        }
$tabla.="
<tr  bgcolor=\"#88A7C7\">
<th width=\"70\"></th>
<th width=\"70\"></th>
        <th width=\"300\">_______________________________________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"250\">TOTAL DE MEDICAMENTOS $num</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
<tr bgcolor=\"#F5FBFB\">
            <td align=\"left\" colspan=\"3\"><font  width=\"70\">TOTAL</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab_ctl($lab,$labx)
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.* 
    from catalogo.laboratorios_pro a 
    left join vtadc.codigo_prox b on b.codigo=a.codigo
    where b.aaa=$aaa and a.lab=$lab
    order by a.codigo";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"center\"><strong></strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        <th width=\"300\"></th>
        <th width=\"300\">_________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        <th width=\"300\"></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"300\"></th>
        
        </tr>
        <tr>
        <th width=\"250\">CODIGO</th>
        <th width=\"300\">DESCRIPCION</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"300\">INV</th>
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
            
$color='blue';
$color1='blue';$color2='blue';$color3='blue';$color4='blue';$color5='blue';$color6='blue';
$color7='blue';$color8='blue';$color9='blue';$color10='blue';$color11='blue';$color12='blue';           
if($row->venta_act_1>$row->venta_ant_1){$color1='purple';}
if($row->venta_act_2>$row->venta_ant_2){$color2='purple';}
if($row->venta_act_3>$row->venta_ant_3){$color3='purple';}
if($row->venta_act_4>$row->venta_ant_4){$color4='purple';}
if($row->venta_act_5>$row->venta_ant_5){$color5='purple';}
if($row->venta_act_6>$row->venta_ant_6){$color6='purple';}
if($row->venta_act_7>$row->venta_ant_7){$color7='purple';}
if($row->venta_act_8>$row->venta_ant_8){$color8='purple';}
if($row->venta_act_9>$row->venta_ant_9){$color9='purple';}
if($row->venta_act_10>$row->venta_ant_10){$color10='purple';}
if($row->venta_act_11>$row->venta_ant_11){$color11='purple';}
if($row->venta_act_12>$row->venta_ant_12){$color12='purple';}
if($xnum==1){$colorcelda='#C2E8FB';}
if($xnum==0){$colorcelda='#EDF3F9';}
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font  width=\"70\">".$row->codigo."</td>
            <td align=\"left\"><font  width=\"70\">".$row->descri."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($row->venta_act_1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color2\">".number_format($row->venta_act_2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color3\">".number_format($row->venta_act_3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color4\">".number_format($row->venta_act_4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color5\">".number_format($row->venta_act_5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color6\">".number_format($row->venta_act_6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color7\">".number_format($row->venta_act_7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color8\">".number_format($row->venta_act_8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color9\">".number_format($row->venta_act_9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color10\">".number_format($row->venta_act_10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color11\">".number_format($row->venta_act_11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color12\">".number_format($row->venta_act_12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->inv,0)."</td>
            </tr>
            
            ";
$act1=$act1+($row->venta_act_1);
$act2=$act2+($row->venta_act_2);
$act3=$act3+($row->venta_act_3);
$act4=$act4+($row->venta_act_4);
$act5=$act5+($row->venta_act_5);
$act6=$act6+($row->venta_act_6);
$act7=$act7+($row->venta_act_7);
$act8=$act8+($row->venta_act_8);
$act9=$act9+($row->venta_act_9);
$act10=$act10+($row->venta_act_10);
$act11=$act11+($row->venta_act_11);
$act12=$act12+($row->venta_act_12);
$actt1=$actt1+($row->venta_actt_1);
$actt2=$actt2+($row->venta_actt_2);
$actt3=$actt3+($row->venta_actt_3);
$actt4=$actt4+($row->venta_actt_4);
$actt5=$actt5+($row->venta_actt_5);
$actt6=$actt6+($row->venta_actt_6);
$actt7=$actt7+($row->venta_actt_7);
$actt8=$actt8+($row->venta_actt_8);
$actt9=$actt9+($row->venta_actt_9);
$actt10=$actt10+($row->venta_actt_10);
$actt11=$actt11+($row->venta_actt_11);
$actt12=$actt12+($row->venta_actt_12);
$antt1=$antt1+($row->venta_antt_1);
$antt2=$antt2+($row->venta_antt_2);
$antt3=$antt3+($row->venta_antt_3);
$antt4=$antt4+($row->venta_antt_4);
$antt5=$antt5+($row->venta_antt_5);
$antt6=$antt6+($row->venta_antt_6);
$antt7=$antt7+($row->venta_antt_7);
$antt8=$antt8+($row->venta_antt_8);
$antt9=$antt9+($row->venta_antt_9);
$antt10=$antt10+($row->venta_antt_10);
$antt11=$antt11+($row->venta_antt_11);
$antt12=$antt12+($row->venta_antt_12);
$ant1=$ant1+($row->venta_ant_1);
$ant2=$ant2+($row->venta_ant_2);
$ant3=$ant3+($row->venta_ant_3);
$ant4=$ant4+($row->venta_ant_4);
$ant5=$ant5+($row->venta_ant_5);
$ant6=$ant6+($row->venta_ant_6);
$ant7=$ant7+($row->venta_ant_7);
$ant8=$ant8+($row->venta_ant_8);
$ant9=$ant9+($row->venta_ant_9);
$ant10=$ant10+($row->venta_ant_10);
$ant11=$ant11+($row->venta_ant_11);
$ant12=$ant12+($row->venta_ant_12);

$inv=$inv+($row->inv);
$num=$num+1;
if($xnum==1){$xnum=0;}else{$xnum=1;}
        }
$tabla.="
<tr  bgcolor=\"#88A7C7\">
        <th width=\"300\"></th>
        <th width=\"300\">_____________________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        
        
        </tr>
        <tr>
        <th width=\"250\">TOTAL DE MEDICAMENTOS $num</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
<tr bgcolor=\"#F5FBFB\">
            <td align=\"left\"><font  width=\"70\">TOTAL</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
            
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab_det($lab,$labx)
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.*,b.suc 
    from catalogo.laboratorios_pro a 
    left join vtadc.codigo_prox b on b.codigo=a.codigo
    left join catalogo.sucursal c on c.suc=a.suc
    where b.aaa=$aaa and a.lab=$lab
    order by a.codigo";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"center\"><strong></strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        <th width=\"300\"></th>
        <th width=\"300\">_________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        <th width=\"300\"></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"300\"></th>
        
        </tr>
        <tr>
        <th width=\"250\">CODIGO</th>
        <th width=\"300\">DESCRIPCION</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"300\">INV</th>
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
            
$color='blue';
$color1='blue';$color2='blue';$color3='blue';$color4='blue';$color5='blue';$color6='blue';
$color7='blue';$color8='blue';$color9='blue';$color10='blue';$color11='blue';$color12='blue';           
if($row->venta_act_1>$row->venta_ant_1){$color1='purple';}
if($row->venta_act_2>$row->venta_ant_2){$color2='purple';}
if($row->venta_act_3>$row->venta_ant_3){$color3='purple';}
if($row->venta_act_4>$row->venta_ant_4){$color4='purple';}
if($row->venta_act_5>$row->venta_ant_5){$color5='purple';}
if($row->venta_act_6>$row->venta_ant_6){$color6='purple';}
if($row->venta_act_7>$row->venta_ant_7){$color7='purple';}
if($row->venta_act_8>$row->venta_ant_8){$color8='purple';}
if($row->venta_act_9>$row->venta_ant_9){$color9='purple';}
if($row->venta_act_10>$row->venta_ant_10){$color10='purple';}
if($row->venta_act_11>$row->venta_ant_11){$color11='purple';}
if($row->venta_act_12>$row->venta_ant_12){$color12='purple';}
if($xnum==1){$colorcelda='#C2E8FB';}
if($xnum==0){$colorcelda='#EDF3F9';}
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font  width=\"70\">".$row->codigo."</td>
            <td align=\"left\"><font  width=\"70\">".$row->descri."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($row->venta_act_1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color2\">".number_format($row->venta_act_2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color3\">".number_format($row->venta_act_3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color4\">".number_format($row->venta_act_4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color5\">".number_format($row->venta_act_5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color6\">".number_format($row->venta_act_6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color7\">".number_format($row->venta_act_7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color8\">".number_format($row->venta_act_8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color9\">".number_format($row->venta_act_9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color10\">".number_format($row->venta_act_10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color11\">".number_format($row->venta_act_11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color12\">".number_format($row->venta_act_12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($row->venta_ant_12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_actt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->venta_antt_12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($row->inv,0)."</td>
            </tr>
            
            ";
$act1=$act1+($row->venta_act_1);
$act2=$act2+($row->venta_act_2);
$act3=$act3+($row->venta_act_3);
$act4=$act4+($row->venta_act_4);
$act5=$act5+($row->venta_act_5);
$act6=$act6+($row->venta_act_6);
$act7=$act7+($row->venta_act_7);
$act8=$act8+($row->venta_act_8);
$act9=$act9+($row->venta_act_9);
$act10=$act10+($row->venta_act_10);
$act11=$act11+($row->venta_act_11);
$act12=$act12+($row->venta_act_12);
$actt1=$actt1+($row->venta_actt_1);
$actt2=$actt2+($row->venta_actt_2);
$actt3=$actt3+($row->venta_actt_3);
$actt4=$actt4+($row->venta_actt_4);
$actt5=$actt5+($row->venta_actt_5);
$actt6=$actt6+($row->venta_actt_6);
$actt7=$actt7+($row->venta_actt_7);
$actt8=$actt8+($row->venta_actt_8);
$actt9=$actt9+($row->venta_actt_9);
$actt10=$actt10+($row->venta_actt_10);
$actt11=$actt11+($row->venta_actt_11);
$actt12=$actt12+($row->venta_actt_12);
$antt1=$antt1+($row->venta_antt_1);
$antt2=$antt2+($row->venta_antt_2);
$antt3=$antt3+($row->venta_antt_3);
$antt4=$antt4+($row->venta_antt_4);
$antt5=$antt5+($row->venta_antt_5);
$antt6=$antt6+($row->venta_antt_6);
$antt7=$antt7+($row->venta_antt_7);
$antt8=$antt8+($row->venta_antt_8);
$antt9=$antt9+($row->venta_antt_9);
$antt10=$antt10+($row->venta_antt_10);
$antt11=$antt11+($row->venta_antt_11);
$antt12=$antt12+($row->venta_antt_12);
$ant1=$ant1+($row->venta_ant_1);
$ant2=$ant2+($row->venta_ant_2);
$ant3=$ant3+($row->venta_ant_3);
$ant4=$ant4+($row->venta_ant_4);
$ant5=$ant5+($row->venta_ant_5);
$ant6=$ant6+($row->venta_ant_6);
$ant7=$ant7+($row->venta_ant_7);
$ant8=$ant8+($row->venta_ant_8);
$ant9=$ant9+($row->venta_ant_9);
$ant10=$ant10+($row->venta_ant_10);
$ant11=$ant11+($row->venta_ant_11);
$ant12=$ant12+($row->venta_ant_12);

$inv=$inv+($row->inv);
$num=$num+1;
if($xnum==1){$xnum=0;}else{$xnum=1;}
        }
$tabla.="
<tr  bgcolor=\"#88A7C7\">
        <th width=\"300\"></th>
        <th width=\"300\">_____________________</th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ENERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>FEBRERO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MARZO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>ABRIL</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>MAYO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JUNIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>JULIO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>AGOSOTO</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>SEPTIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>OCTUBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>NOVIEMBRE</strong></th>
        <th width=\"280\" align=\"center\" colspan=\"4\"><strong>DICIEMBRE</strong></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        
        
        </tr>
        <tr>
        <th width=\"250\">TOTAL DE MEDICAMENTOS $num</th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaa</strong></font></th>
        <th width=\"70\"><font color=\"blue\"><strong>$aaax</strong></font></th>
        <th width=\"70\"><strong>$aaa</strong></th>
        <th width=\"70\"><strong>$aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
<tr bgcolor=\"#F5FBFB\">
            <td align=\"left\"><font  width=\"70\">TOTAL</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act1,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant1,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt1,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt1,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act2,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant2,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt2,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt2,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act3,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant3,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt3,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt3,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act4,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant4,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt4,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt4,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act5,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant5,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt5,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt5,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act6,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant6,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt6,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt6,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act7,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant7,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt7,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt7,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act8,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant8,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt8,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt8,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act9,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant9,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt9,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt9,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act10,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant10,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt10,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt10,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act11,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant11,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt11,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt11,0)."</td>
            <td width=\"70\" align=\"right\"><font color=\"$color1\">".number_format($act12,0)."</font></td>
            <td width=\"70\" align=\"right\"><font color=\"$color\">".number_format($ant12,0)."</font></td>
            <td width=\"70\" align=\"right\">".number_format($actt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($antt12,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
            
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_ofertas()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.corto 
    from vtadc.oferta_nota_ctl a 
    left join catalogo.provedor b on b.prov=a.prv
    order by aaa desc, mes desc";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>NOTAS DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>AAA</strong></th>
        <th><strong>MES</strong></th>
        <th><strong>MAYORISTA</strong></th>
        <th><strong>NOTA<br />DESCRIPCION</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>IMPORTE</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $l1 = anchor('mercadotecnia/tabla_notas_ofertas_det/'.$row->id,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver codigos!', 'class' => 'encabezado'));
        $l2 = anchor('mercadotecnia/tabla_notas_ofertas_suc/'.$row->id,'<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver sucursal!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->aaa."</td>
            <td align=\"left\">".$row->mes."</td>
            <td align=\"left\">".$row->prv." - ".$row->corto."</td>
            <td align=\"left\">".$row->tipo_nota."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"right\"> ".number_format($row->nota,2)."</td>
            <td align=\"left\">".$l1."<br /> ".$l2."</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE NOTAS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function busco_nota($id)
    {
     $sql = "SELECT *from vtadc.oferta_nota_ctl where id= ?";
    $query = $this->db->query($sql,array($id));
    return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_ofertas_det($id,$aaa,$mes,$prv,$labor,$tipo_nota)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.aaa,a.mes,a.prv,a.labor,a.descri,a.codigo,sum(a.can)as can,sum(a.costo*a.can)as impo,sum(nota)as nota
    from vtadc.oferta_nota_det a 
    where aaa=$aaa and mes=$mes and prv=$prv and labor='$labor' and tipo_nota='$tipo_nota'
    group by codigo";
 	  	$query = $this->db->query($sql);
    	
$tcan=0;$timpo=0;$tnota=0;	    
$tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>NOTAS DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>PIEZAS</strong></th>
        <th><strong>IMPORTE</strong></th>
        <th><strong>NOTA</strong></th>
        <th></th>
        
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
         $l1 = anchor('mercadotecnia/tabla_notas_ofertas_det_cod/'.$id.'/'.$row->codigo,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"right\">".$row->codigo."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\">".$row->can."</td>
            
            <td align=\"right\"> ".number_format($row->impo,2)."</td>
            <td align=\"right\"> ".number_format($row->nota,2)."</td>
            <td align=\"left\">".$l1."</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
$tcan=$tcan+($row->can);
$timpo=$timpo+($row->impo);
$tnota=$tnota+($row->nota);
        }
$tabla.="
<tr>
<td colspan=\"2\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tcan,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($timpo,2)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tnota,2)."</strong></td>
</tr> 
</table>";
        return $tabla;  
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_ofertas_det_cod($aaa,$mes,$prv,$labor,$tipo_nota,$cod)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,(a.can*a.costo) as impo
    from vtadc.oferta_nota_det a
    left join catalogo.sucursal b on b.suc=a.suc 
    where aaa=$aaa and mes=$mes and prv=$prv and labor='$labor' and tipo_nota='$tipo_nota' and codigo=$cod
   ";
 	  	$query = $this->db->query($sql);
    	
$tcan=0;$timpo=0;$tnota=0;	    
$tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>NOTAS DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>PIEZAS</strong></th>
        <th><strong>COSTO</strong></th>
        <th><strong>IMPORTE</strong></th>
        <th><strong>NOTA</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"right\">".$row->nombre."</td>
            <td align=\"right\">".$row->codigo."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\">".$row->can."</td>
            <td align=\"right\">".$row->costo."</td>
            <td align=\"right\"> ".number_format($row->impo,2)."</td>
            <td align=\"right\"> ".number_format($row->nota,2)."</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
$tcan=$tcan+($row->can);
$timpo=$timpo+($row->impo);
$tnota=$tnota+($row->nota);
        }
$tabla.="
<tr>
<td colspan=\"3\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tcan,0)."</strong></td>
<td></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($timpo,2)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tnota,2)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
        
    
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_ofertas_suc($id,$aaa,$mes,$prv,$labor,$tipo_nota)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.aaa,a.mes,a.prv,a.labor,a.suc,b.nombre,sum(a.can)as can,sum(a.costo*a.can)as impo,sum(nota)as nota
    from vtadc.oferta_nota_det a 
    left join catalogo.sucursal b on b.suc=a.suc
    where aaa=$aaa and mes=$mes and prv=$prv and labor='$labor' and tipo_nota='$tipo_nota'
    group by a.suc order by nota desc";
 	  	$query = $this->db->query($sql);
    	
$tcan=0;$timpo=0;$tnota=0;	    
$tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>NOTAS DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>NID</strong></th>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>PIEZAS</strong></th>
        <th><strong>IMPORTE</strong></th>
        <th><strong>NOTA</strong></th>
        <th></th>
        
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
         $l1 = anchor('mercadotecnia/tabla_notas_ofertas_det_suc/'.$id.'/'.$row->suc,'<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"right\">".$row->suc."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".$row->can."</td>
            
            <td align=\"right\"> ".number_format($row->impo,2)."</td>
            <td align=\"right\"> ".number_format($row->nota,2)."</td>
            <td align=\"left\">".$l1."</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
$tcan=$tcan+($row->can);
$timpo=$timpo+($row->impo);
$tnota=$tnota+($row->nota);
        }
$tabla.="
<tr>
<td colspan=\"2\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tcan,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($timpo,2)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tnota,2)."</strong></td>
</tr> 
</table>";
        return $tabla;  
    
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_ofertas_det_suc($aaa,$mes,$prv,$labor,$tipo_nota,$suc)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,(a.can*a.costo) as impo
    from vtadc.oferta_nota_det a
    left join catalogo.sucursal b on b.suc=a.suc 
    where aaa=$aaa and mes=$mes and prv=$prv and labor='$labor' and tipo_nota='$tipo_nota' and a.suc=$suc
   ";
 	  	$query = $this->db->query($sql);
    	
$tcan=0;$timpo=0;$tnota=0;	    
$tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>NOTAS DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>PIEZAS</strong></th>
        <th><strong>COSTO</strong></th>
        <th><strong>IMPORTE</strong></th>
        <th><strong>NOTA</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"right\">".$row->nombre."</td>
            <td align=\"right\">".$row->codigo."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\">".$row->can."</td>
            <td align=\"right\">".$row->costo."</td>
            <td align=\"right\"> ".number_format($row->impo,2)."</td>
            <td align=\"right\"> ".number_format($row->nota,2)."</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
$tcan=$tcan+($row->can);
$timpo=$timpo+($row->impo);
$tnota=$tnota+($row->nota);
        }
$tabla.="
<tr>
<td colspan=\"3\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tcan,0)."</strong></td>
<td></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($timpo,2)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tnota,2)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
        
    
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function notas_oferta_cod()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.corto, sum(c.can)as can 
    from catalogo.cat_mirey a
    left join catalogo.provedor b on b.prov=a.prv
    left join vtadc.oferta_nota_det c on c.codigo=a.codigo
    group by a.codigo
    order by can desc
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"3\" align=\"center\"><strong>COMPRA DE OFERTAS EN NOTA</strong></th>
        </tr>
        <tr>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>COMPRA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
           $l1 = anchor('mercadotecnia/tabla_notas_oferta_cod_mes/'.$row->codigo,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->codigo."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\"><font color=\"blue\">".number_format($row->can,0)."</font></td>
            <td align=\"left\">".$l1."</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_solof()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;

     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.tipo2, b.nombre, c.nom
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    join catalogo.cat_gastos c on c.num=a.auxi
    where a.auxi=21 and aaa=$aaa and importe1>0
    or a.auxi=21 and aaa=$aaa and importe2>0
    or a.auxi=21 and aaa=$aaa and importe3>0
    or a.auxi=21 and aaa=$aaa and importe4>0
    or a.auxi=21 and aaa=$aaa and importe5>0
    or a.auxi=21 and aaa=$aaa and importe6>0
    or a.auxi=21 and aaa=$aaa and importe7>0
    or a.auxi=21 and aaa=$aaa and importe8>0
    or a.auxi=21 and aaa=$aaa and importe9>0
    or a.auxi=21 and aaa=$aaa and importe10>0
    or a.auxi=21 and aaa=$aaa and importe11>0
    or a.auxi=21 and aaa=$aaa and importe12>0
    order by suc
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"14\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">SUCURSALES CON NOTAS DE MERCADOTECNIA</div></th>
        </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th><strong>|------ENE-----|</strong></th>
        <th><strong>|------FEB-----|</strong></th>
        <th><strong>|------MAR-----|</strong></th>
        <th><strong>|------ABR-----|</strong></th>
        <th><strong>|------MAY-----|</strong></th>
        <th><strong>|------JUN-----|</strong></th>
        <th><strong>|------JUL-----|</strong></th>
        <th><strong>|------AGO-----|</strong></th>
        <th><strong>|------SEP-----|</strong></th>
        <th><strong>|------OCT-----|</strong></th>
        <th><strong>|------NOV-----|</strong></th>
        <th><strong>|------DIC-----|</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="select a.*, b.nom from vtadc.gastos_c a left join catalogo.cat_gastos b on b.num=a.auxi
        where 
        
        a.suc=$row->suc and a.auxi=20 
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"14\"><strong>".$row->tipo2." ".$row->suc." ".$row->nombre."</strong></td>
            </tr>";
foreach($q->result() as $r)
        {
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            </tr>";
if($r->importe1>0){$por1=($row->importe1*100)/$r->importe1;}else{$por1=0;}
if($r->importe2>0){$por2=($row->importe2*100)/$r->importe2;}else{$por2=0;}
if($r->importe3>0){$por3=($row->importe3*100)/$r->importe3;}else{$por3=0;}
if($r->importe4>0){$por4=($row->importe4*100)/$r->importe4;}else{$por4=0;}
if($r->importe5>0){$por5=($row->importe5*100)/$r->importe5;}else{$por5=0;}
if($r->importe6>0){$por6=($row->importe6*100)/$r->importe6;}else{$por6=0;}
if($r->importe7>0){$por7=($row->importe7*100)/$r->importe7;}else{$por7=0;}
if($r->importe8>0){$por8=($row->importe8*100)/$r->importe8;}else{$por8=0;}
if($r->importe9>0){$por9=($row->importe9*100)/$r->importe9;}else{$por9=0;}
if($r->importe10>0){$por10=($row->importe10*100)/$r->importe10;}else{$por10=0;}
if($r->importe11>0){$por11=($row->importe11*100)/$r->importe11;}else{$por11=0;}
if($r->importe12>0){$por12=($row->importe12*100)/$r->importe12;}else{$por12=0;}
$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;

 }
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$row->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            </tr>
            ";

$num=$num+1;

$tabla.="           
            
            <tr>
            <td align=\"left\"><font color=\"red\"></font></td>
            <td align=\"left\"><font color=\"red\">% QUE REPRESENTA </font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por12,2)."</font></td>
            </tr>
            ";
$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
$impoz1=$impoz1+$row->importe1;$impoz2=$impoz2+$row->importe2;$impoz3=$impoz3+$row->importe3;
$impoz4=$impoz4+$row->importe4;$impoz5=$impoz5+$row->importe5;$impoz6=$impoz6+$row->importe6;
$impoz7=$impoz7+$row->importe7;$impoz8=$impoz8+$row->importe8;$impoz9=$impoz9+$row->importe9;
$impoz10=$impoz10+$row->importe10;$impoz11=$impoz11+$row->importe11;$impoz12=$impoz12+$row->importe12;

}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"14\"><strong>TOTAL DE SUCURSALES:".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA PERFUMERIA </strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>NOTAS MERCADOTECNIA</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz1,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz2,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz3,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz4,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz5,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz6,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz7,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz8,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz9,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz10,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz11,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz12,2)."</font></td>

</tr> 
</table>";
        
        
        echo $tabla;
    
       
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_ciaf()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;

     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    b.razon,bb.nom 
    from vtadc.gastos_c a
     left join catalogo.cat_gastos bb on bb.num =a.auxi
    left join catalogo.compa b on b.cia=a.cia
    where a.auxi=21 and aaa=$aaa and importe1>0
    or a.auxi=21 and aaa=$aaa and importe2>0
    or a.auxi=21 and aaa=$aaa and importe3>0
    or a.auxi=21 and aaa=$aaa and importe4>0
    or a.auxi=21 and aaa=$aaa and importe5>0
    or a.auxi=21 and aaa=$aaa and importe6>0
    or a.auxi=21 and aaa=$aaa and importe7>0
    or a.auxi=21 and aaa=$aaa and importe8>0
    or a.auxi=21 and aaa=$aaa and importe9>0
    or a.auxi=21 and aaa=$aaa and importe10>0
    or a.auxi=21 and aaa=$aaa and importe11>0
    or a.auxi=21 and aaa=$aaa and importe12>0
    group by a.cia
    order by a.cia
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"14\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">COMPA&Ntilde;IAS CON NOTAS DE MERCADOTECNIA</div></th>
        </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th><strong>|------ENE-----|</strong></th>
        <th><strong>|------FEB-----|</strong></th>
        <th><strong>|------MAR-----|</strong></th>
        <th><strong>|------ABR-----|</strong></th>
        <th><strong>|------MAY-----|</strong></th>
        <th><strong>|------JUN-----|</strong></th>
        <th><strong>|------JUL-----|</strong></th>
        <th><strong>|------AGO-----|</strong></th>
        <th><strong>|------SEP-----|</strong></th>
        <th><strong>|------OCT-----|</strong></th>
        <th><strong>|------NOV-----|</strong></th>
        <th><strong>|------DIC-----|</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    left join vtadc.gastos_c c on c.cia=a.cia and c.auxi=21 and c.suc=a.suc
    where
    a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe1>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe2>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe3>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe4>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe5>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe6>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe7>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe8>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe9>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe10>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe11>0
    or a.auxi=20 and a.aaa=$aaa and a.cia=$row->cia and c.importe12>0
    group by a.cia
    order by a.cia
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"14\"><strong>".$row->cia." ".$row->razon."</strong></td>
            </tr>";
foreach($q->result() as $r)
        {
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            </tr>";
 if($r->importe1>0){$por1=($row->importe1*100)/$r->importe1;}else{$por1=0;}
if($r->importe2>0){$por2=($row->importe2*100)/$r->importe2;}else{$por2=0;}
if($r->importe3>0){$por3=($row->importe3*100)/$r->importe3;}else{$por3=0;}
if($r->importe4>0){$por4=($row->importe4*100)/$r->importe4;}else{$por4=0;}
if($r->importe5>0){$por5=($row->importe5*100)/$r->importe5;}else{$por5=0;}
if($r->importe6>0){$por6=($row->importe6*100)/$r->importe6;}else{$por6=0;}
if($r->importe7>0){$por7=($row->importe7*100)/$r->importe7;}else{$por7=0;}
if($r->importe8>0){$por8=($row->importe8*100)/$r->importe8;}else{$por8=0;}
if($r->importe9>0){$por9=($row->importe9*100)/$r->importe9;}else{$por9=0;}
if($r->importe10>0){$por10=($row->importe10*100)/$r->importe10;}else{$por10=0;}
if($r->importe11>0){$por11=($row->importe11*100)/$r->importe11;}else{$por11=0;}
if($r->importe12>0){$por12=($row->importe12*100)/$r->importe12;}else{$por12=0;}
$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 }
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$row->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            </tr>
            ";

$num=$num+1;

$tabla.="           
            
            <tr>
            <td align=\"left\"><font color=\"red\"></font></td>
            <td align=\"left\"><font color=\"red\">% QUE REPRESENTA </font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"red\">% ".number_format($por12,2)."</font></td>
            </tr>
            ";
$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
$impoz1=$impoz1+$row->importe1;$impoz2=$impoz2+$row->importe2;$impoz3=$impoz3+$row->importe3;
$impoz4=$impoz4+$row->importe4;$impoz5=$impoz5+$row->importe5;$impoz6=$impoz6+$row->importe6;
$impoz7=$impoz7+$row->importe7;$impoz8=$impoz8+$row->importe8;$impoz9=$impoz9+$row->importe9;
$impoz10=$impoz10+$row->importe10;$impoz11=$impoz11+$row->importe11;$impoz12=$impoz12+$row->importe12;
}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"14\"  align=\"center\"><strong>TOTAL DE TODAS LAS COMPA&Ntilde;IAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA PERFUMERIA </strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>NOTAS MERCADOTECNIA</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz1,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz2,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz3,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz4,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz5,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz6,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz7,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz8,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz9,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz10,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz11,2)."</font></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoz12,2)."</font></td>

</tr> 
</table>";
        
        
        echo $tabla;
    
       
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////DIRECCION
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_total_ciaf()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.razon,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.compa b on b.cia=a.cia and auxi<=4
    where aaa=$aaa and importe1>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe2>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe3>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe4>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe5>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe6>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe7>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe8>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe9>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe10>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe11>0 and a.cia>0 and auxi<=4
    or aaa=$aaa and importe12>0 and a.cia>0 and auxi<=4
    group by a.cia
    order by a.cia
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">COMPA&Ntilde;IAS REPORTE DE VENTAS</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    
    where
    a.aaa=$aaa and a.cia=$row->cia and a.importe1>0 and a.auxi>0 and auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe2>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe3>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe4>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe5>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe6>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe7>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe8>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe9>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe10>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe11>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and a.cia=$row->cia and a.importe12>0 and a.auxi>0 and a.auxi<5
    group by a.cia,a.auxi
    order by a.cia,a.auxi
        ";
        $q = $this->db->query($s);   

            

$l1 = anchor('mercadotecnia/tabla_ventas_total_cia_suc/'.$row->cia.'/'.$row->razon, '<img src="'.base_url().'img/pharmacy.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$l1." ".$row->cia." ".$row->razon."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS COMPA&Ntilde;IAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_total_ciaf_suc($cia)
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    where aaa=$aaa and importe1>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.cia=$cia and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.cia=$cia and a.auxi<=4
    group by suc
    order by b.nombre
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    (a.importe1)as importe1,
    (a.importe2)as importe2,
    (a.importe3)as importe3,
    (a.importe4)as importe4,
    (a.importe5)as importe5,
    (a.importe6)as importe6,
    (a.importe7)as importe7,
    (a.importe8)as importe8,
    (a.importe9)as importe9,
    (a.importe10)as importe10,
    (a.importe11)as importe11,
    (a.importe12)as importe12,
    (importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    
    where
    a.aaa=$aaa and a.cia=$row->cia and a.importe1>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe2>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe3>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe4>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe5>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe6>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe7>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe8>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe9>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe10>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe11>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.cia=$row->cia and a.importe12>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    order by a.cia,a.auxi
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$row->suc." ".$row->nombre."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
            <td></td>
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;

}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS SUCURSALES ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_total_cadena()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.tipo2,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    where 
       aaa=$aaa and importe1>0 and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.auxi<=4
    group by b.tipo2
    
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS POR CADENA</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            if($row->tipo2=='D'){$tipox='DOCTOR DESCUENTO';}
            if($row->tipo2=='F'){$tipox='FENIX';}
            if($row->tipo2=='G'){$tipox='GENERICOS';}
        $s="SELECT a.*,b.tipo2,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    c.nom
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_gastos c on c.num=a.auxi
    where
       a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe1>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe2>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe3>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe4>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe5>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe6>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe7>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe8>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe9>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe10>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe11>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe12>0 and a.auxi>0 and a.auxi<5
    group by b.tipo2,a.auxi
    order by b.tipo2,a.auxi
        ";
        $q = $this->db->query($s);   

            

$l1 = anchor('mercadotecnia/tabla_ventas_total_cadena_suc/'.$row->tipo2.'/'.$tipox, '<img src="'.base_url().'img/pharmacy.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$l1." ".$row->tipo2." - ".$tipox."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS CADENAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_total_cadena_suc($tipo)
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    where aaa=$aaa and importe1>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe2>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe3>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe4>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe5>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe6>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe7>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe8>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe9>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe10>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe11>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe12>0 and b.tipo2='$tipo' and a.auxi<=4
    group by suc
    order by b.nombre
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    (a.importe1)as importe1,
    (a.importe2)as importe2,
    (a.importe3)as importe3,
    (a.importe4)as importe4,
    (a.importe5)as importe5,
    (a.importe6)as importe6,
    (a.importe7)as importe7,
    (a.importe8)as importe8,
    (a.importe9)as importe9,
    (a.importe10)as importe10,
    (a.importe11)as importe11,
    (a.importe12)as importe12,
    (importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    
    where
    a.aaa=$aaa  and a.importe1>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe2>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe3>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe4>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe5>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe6>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe7>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe8>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe9>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe10>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe11>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe12>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    order by a.suc,a.auxi
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$row->suc." ".$row->nombre."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
            
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;

}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS SUCURSALES DE LA CADENA ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_total_lin()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nom,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num=a.auxi
    where 
       aaa=$aaa and importe1>0 and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.auxi<=4
    group by aaa
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS POR LINEA</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
        $s="SELECT a.*,b.nom,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num=a.auxi
    where 
       aaa=$aaa and importe1>0 and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.auxi<=4
    group by a.auxi
    order by a.auxi
        ";
        $q = $this->db->query($s);   
$tabla.="
            
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
            $l2 = anchor('mercadotecnia/tabla_ventas_total_lin_suc/'.$r->auxi.'/'.$r->nom, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$l2." ".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS CADENAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_total_lin_suc($lin)
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    c.nom,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_gastos c on c.num=a.auxi
    where 
       aaa=$aaa and importe1>0  and a.auxi=$lin
    or aaa=$aaa and importe2>0  and a.auxi=$lin
    or aaa=$aaa and importe3>0  and a.auxi=$lin
    or aaa=$aaa and importe4>0  and a.auxi=$lin
    or aaa=$aaa and importe5>0  and a.auxi=$lin
    or aaa=$aaa and importe6>0  and a.auxi=$lin
    or aaa=$aaa and importe7>0  and a.auxi=$lin
    or aaa=$aaa and importe8>0  and a.auxi=$lin
    or aaa=$aaa and importe9>0  and a.auxi=$lin
    or aaa=$aaa and importe10>0 and a.auxi=$lin
    or aaa=$aaa and importe11>0 and a.auxi=$lin
    or aaa=$aaa and importe12>0 and a.auxi=$lin
    group by aaa
    
    ";
    
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS </div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,b.nombre,
    (a.importe1)as importe1,
    (a.importe2)as importe2,
    (a.importe3)as importe3,
    (a.importe4)as importe4,
    (a.importe5)as importe5,
    (a.importe6)as importe6,
    (a.importe7)as importe7,
    (a.importe8)as importe8,
    (a.importe9)as importe9,
    (a.importe10)as importe10,
    (a.importe11)as importe11,
    (a.importe12)as importe12,
   
    (importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc =a.suc
    
    where aaa=$aaa and importe1>0 and a.auxi=$lin
    or aaa=$aaa and importe2>0  and a.auxi=$lin
    or aaa=$aaa and importe3>0  and a.auxi=$lin
    or aaa=$aaa and importe4>0  and a.auxi=$lin
    or aaa=$aaa and importe5>0  and a.auxi=$lin
    or aaa=$aaa and importe6>0  and a.auxi=$lin
    or aaa=$aaa and importe7>0  and a.auxi=$lin
    or aaa=$aaa and importe8>0  and a.auxi=$lin
    or aaa=$aaa and importe9>0  and a.auxi=$lin
    or aaa=$aaa and importe10>0 and a.auxi=$lin
    or aaa=$aaa and importe11>0 and a.auxi=$lin
    or aaa=$aaa and importe12>0 and a.auxi=$lin
    order by b.nombre
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$row->nom." </strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->suc."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nombre."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";
$num=$num+1;
$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }


$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
            
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;

}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS SUCURSALES DE LA LINEA ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_ciaf()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.razon,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.compa b on b.cia=a.cia 
    where aaa=$aaa and importe1>0 and a.cia>0 and auxi<5  
    or aaa=$aaa and importe2>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe3>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe4>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe5>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe6>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe7>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe8>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe9>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe10>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe11>0 and a.cia>0 and auxi<5
    or aaa=$aaa and importe12>0 and a.cia>0 and auxi<5
    group by a.cia
    order by a.cia
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">COMPA&Ntilde;IAS REPORTE DE VENTAS</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    
    where
    a.aaa=$aaa and a.cia=$row->cia and a.importe1>0 and a.auxi>=10 and auxi=20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe2>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe3>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe4>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe5>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe6>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe7>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe8>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe9>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe10>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe11>0 and a.auxi>=10 and a.auxi<>20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe12>0 and a.auxi>=10 and a.auxi<>20
    group by a.cia,a.auxi
    order by a.cia,a.auxi
        ";
        $q = $this->db->query($s);   

            

$l1 = anchor('mercadotecnia/tabla_utilidad_total_cia_suc/'.$row->cia.'/'.$row->razon, '<img src="'.base_url().'img/pharmacy.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

$tabla.="<thead>
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$l1." ".$row->cia." ".$row->razon."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
         </thead>   
 ";
foreach($q->result() as $r)
        {
if($r->auxi==10){$color='purple'; $bgcolor='#EEDCFC';}else{$color='black';$bgcolor='white';}
if($r->auxi>10 and $r->auxi==11){$tabla.="<tr><td  align=\"center\" colspan=\"27\"><strong>UTILIDAD</strong></td></tr>";}
if( $r->auxi==1004){$tabla.="<tr><td  align=\"center\" colspan=\"27\"><strong>GASTOS </strong></td></tr>";}
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}

$tabla.="
            <tr bgcolor=\"$bgcolor\">
            <td align=\"left\"><font color=\"$color\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";
if($r->auxi<=4){
$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }
if($r->auxi>=11 and $r->auxi<=21){
$impoxu1=$impoxu1+$r->importe1;$impoxu2=$impoxu2+$r->importe2;$impoxu3=$impoxu3+$r->importe3;$impoxu4=$impoxu4+$r->importe4;
$impoxu5=$impoxu5+$r->importe5;$impoxu6=$impoxu6+$r->importe6;$impoxu7=$impoxu7+$r->importe7;$impoxu8=$impoxu8+$r->importe8;
$impoxu9=$impoxu9+$r->importe9;$impoxu10=$impoxu10+$r->importe10;$impoxu11=$impoxu11+$r->importe11;$impoxu12=$impoxu12+$r->importe12;
 $anualu=$impoxu1+$impoxu2+$impoxu3+$impoxu4+$impoxu5+$impoxu6+$impoxu7+$impoxu8+$impoxu9+$impoxu10+$impoxu11+$impoxu12;
}
if($r->auxi>=1004){
$impoxg1=$impoxg1+$r->importe1;$impoxg2=$impoxg2+$r->importe2;$impoxg3=$impoxg3+$r->importe3;$impoxg4=$impoxg4+$r->importe4;
$impoxg5=$impoxg5+$r->importe5;$impoxg6=$impoxg6+$r->importe6;$impoxg7=$impoxg7+$r->importe7;$impoxg8=$impoxg8+$r->importe8;
$impoxg9=$impoxg9+$r->importe9;$impoxg10=$impoxg10+$r->importe10;$impoxg11=$impoxg11+$r->importe11;$impox12g=$impoxg12+$r->importe12;
 $anualg=$impoxg1+$impoxg2+$impoxg3+$impoxg4+$impoxg5+$impoxg6+$impoxg7+$impox8+$impoxg9+$impoxg10+$impoxg11+$impoxg12;
}
 
if($r->auxi==4){
$tabla.="</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL VENTA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>";    
}
if($r->auxi==21){
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualu,2)."</strong></font></td>
<td></td>
</tr>";    
}
}
$num=$num+1;
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualg,2)."</strong></font></td>
<td></td>
</tr>";


$tabla.="
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
<tr>
<td  colspan=\"27\"><strong>CONCENTRADO DE LA COMPACIA</strong></td>
</tr>
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
            <td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualu,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#FADCDC\">
<td colspan=\"2\"><strong>MENOS TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualg,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#FADCDC\">
<td colspan=\"2\"><strong>GANANCIA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu1-$impoxg1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu2-$impoxg2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu3-$impoxg3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu4-$impoxg4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu5-$impoxg5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu6-$impoxg6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu7-$impoxg7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu8-$impoxg8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu9-$impoxg9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu10-$impoxg10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu11-$impoxg11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu12-$impoxg12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualu-$anualg,2)."</strong></font></td>
<td></td>
</tr>";
$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;

    }
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS COMPA&Ntilde;IAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        return $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_ciaf_suc($cia)
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc 
    where aaa=$aaa and importe1>0 and a.cia=$cia and a.auxi<5  
    or aaa=$aaa and importe2>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe3>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe4>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe5>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe6>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe7>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe8>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe9>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe10>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe11>0 and a.cia=$cia and a.auxi<5
    or aaa=$aaa and importe12>0 and a.cia=$cia and a.auxi<5
    group by a.suc
    order by a.suc
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">COMPA&Ntilde;IAS REPORTE DE VENTAS</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    (a.importe1)as importe1,
    (a.importe2)as importe2,
    (a.importe3)as importe3,
    (a.importe4)as importe4,
    (a.importe5)as importe5,
    (a.importe6)as importe6,
    (a.importe7)as importe7,
    (a.importe8)as importe8,
    (a.importe9)as importe9,
    (a.importe10)as importe10,
    (a.importe11)as importe11,
    (a.importe12)as importe12,
    (importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    
    where
    a.aaa=$aaa and a.cia=$row->suc and a.importe1>0 and a.auxi>0 and auxi<>5
    or a.aaa=$aaa and a.suc=$row->suc and a.importe2>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe3>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe4>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe5>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe6>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe7>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe8>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe9>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe10>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe11>0 and a.auxi>0 and a.auxi<>20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe12>0 and a.auxi>0 and a.auxi<>20
    
    order by a.auxi
        ";
        $q = $this->db->query($s);   

            

$l1 = anchor('mercadotecnia/tabla_utilidad_total_cia_suc/'.$row->suc.'/'.$row->nombre, '<img src="'.base_url().'img/pharmacy.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

$tabla.="<thead>
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$l1." ".$row->suc." ".$row->nombre."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
         </thead>   
 ";
foreach($q->result() as $r)
        {
if($r->auxi==10){$color='purple'; $bgcolor='#EEDCFC';}else{$color='black';$bgcolor='white';}
if($r->auxi>10 and $r->auxi==11){$tabla.="<tr><td  align=\"center\" colspan=\"27\"><strong>UTILIDAD</strong></td></tr>";}
if( $r->auxi==1004){$tabla.="<tr><td  align=\"center\" colspan=\"27\"><strong>GASTOS </strong></td></tr>";}
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"$bgcolor\">
            <td align=\"left\"><font color=\"$color\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";
if($r->auxi<=4){
$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }
if($r->auxi>=11 and $r->auxi<=21){
$impoxu1=$impoxu1+$r->importe1;$impoxu2=$impoxu2+$r->importe2;$impoxu3=$impoxu3+$r->importe3;$impoxu4=$impoxu4+$r->importe4;
$impoxu5=$impoxu5+$r->importe5;$impoxu6=$impoxu6+$r->importe6;$impoxu7=$impoxu7+$r->importe7;$impoxu8=$impoxu8+$r->importe8;
$impoxu9=$impoxu9+$r->importe9;$impoxu10=$impoxu10+$r->importe10;$impoxu11=$impoxu11+$r->importe11;$impoxu12=$impoxu12+$r->importe12;
 $anualu=$impoxu1+$impoxu2+$impoxu3+$impoxu4+$impoxu5+$impoxu6+$impoxu7+$impoxu8+$impoxu9+$impoxu10+$impoxu11+$impoxu12;
}
if($r->auxi>=1004){
$impoxg1=$impoxg1+$r->importe1;$impoxg2=$impoxg2+$r->importe2;$impoxg3=$impoxg3+$r->importe3;$impoxg4=$impoxg4+$r->importe4;
$impoxg5=$impoxg5+$r->importe5;$impoxg6=$impoxg6+$r->importe6;$impoxg7=$impoxg7+$r->importe7;$impoxg8=$impoxg8+$r->importe8;
$impoxg9=$impoxg9+$r->importe9;$impoxg10=$impoxg10+$r->importe10;$impoxg11=$impoxg11+$r->importe11;$impox12g=$impoxg12+$r->importe12;
 $anualg=$impoxg1+$impoxg2+$impoxg3+$impoxg4+$impoxg5+$impoxg6+$impoxg7+$impox8+$impoxg9+$impoxg10+$impoxg11+$impoxg12;
}
 
if($r->auxi==4){
$tabla.="</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL VENTA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impox12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>";    
}
if($r->auxi==21){
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualu,2)."</strong></font></td>
<td></td>
</tr>";    
}
}
$num=$num+1;
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualg,2)."</strong></font></td>
<td></td>
</tr>";


$tabla.="
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
<tr>
<td  colspan=\"27\"><strong>CONCENTRADO DE LA COMPACIA</strong></td>
</tr>
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
            <td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualu,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#FADCDC\">
<td colspan=\"2\"><strong>MENOS TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxg12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualg,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#FADCDC\">
<td colspan=\"2\"><strong>GANANCIA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu1-$impoxg1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu2-$impoxg2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu3-$impoxg3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu4-$impoxg4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu5-$impoxg5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu6-$impoxg6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu7-$impoxg7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu8-$impoxg8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu9-$impoxg9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu10-$impoxg10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu11-$impoxg11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($impoxu12-$impoxg12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualu-$anualg,2)."</strong></font></td>
<td></td>
</tr>";
$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;

    }
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS COMPA&Ntilde;IAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_cadena()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.tipo2,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    where 
       aaa=$aaa and importe1>0 and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.auxi<=4
    group by b.tipo2
    
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS POR CADENA</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            if($row->tipo2=='D'){$tipox='DOCTOR DESCUENTO';}
            if($row->tipo2=='F'){$tipox='FENIX';}
            if($row->tipo2=='G'){$tipox='GENERICOS';}
        $s="SELECT a.*,b.tipo2,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    c.nom
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_gastos c on c.num=a.auxi
    where
       a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe1>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe2>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe3>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe4>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe5>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe6>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe7>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe8>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe9>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe10>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe11>0 and a.auxi>0 and a.auxi<5
    or a.aaa=$aaa and b.tipo2='$row->tipo2' and a.importe12>0 and a.auxi>0 and a.auxi<5
    group by b.tipo2,a.auxi
    order by b.tipo2,a.auxi
        ";
        $q = $this->db->query($s);   

            

$l1 = anchor('mercadotecnia/tabla_utilidad_total_cadena_suc/'.$row->tipo2.'/'.$tipox, '<img src="'.base_url().'img/pharmacy.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$l1." ".$row->tipo2." - ".$tipox."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS CADENAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_cadena_suc($tipo)
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    where aaa=$aaa and importe1>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe2>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe3>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe4>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe5>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe6>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe7>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe8>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe9>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe10>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe11>0 and b.tipo2='$tipo' and a.auxi<=4
    or aaa=$aaa and importe12>0 and b.tipo2='$tipo' and a.auxi<=4
    group by suc
    order by b.nombre
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,
    (a.importe1)as importe1,
    (a.importe2)as importe2,
    (a.importe3)as importe3,
    (a.importe4)as importe4,
    (a.importe5)as importe5,
    (a.importe6)as importe6,
    (a.importe7)as importe7,
    (a.importe8)as importe8,
    (a.importe9)as importe9,
    (a.importe10)as importe10,
    (a.importe11)as importe11,
    (a.importe12)as importe12,
    (importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual,
    b.nom
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num =a.auxi
    
    where
    a.aaa=$aaa  and a.importe1>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe2>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe3>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe4>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe5>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe6>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa  and a.importe7>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe8>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe9>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe10>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe11>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    or a.aaa=$aaa and a.importe12>0 and auxi>0 and auxi<5 and a.suc=$row->suc
    order by a.suc,a.auxi
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$row->suc." ".$row->nombre."</strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
            
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;

}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS SUCURSALES DE LA CADENA ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_lin()
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nom,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num=a.auxi
    where 
       aaa=$aaa and importe1>0 and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.auxi<=4
    group by aaa
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS POR LINEA</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
        $s="SELECT a.*,b.nom,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.cat_gastos b on b.num=a.auxi
    where 
       aaa=$aaa and importe1>0 and a.auxi<=4
    or aaa=$aaa and importe2>0 and a.auxi<=4
    or aaa=$aaa and importe3>0 and a.auxi<=4
    or aaa=$aaa and importe4>0 and a.auxi<=4
    or aaa=$aaa and importe5>0 and a.auxi<=4
    or aaa=$aaa and importe6>0 and a.auxi<=4
    or aaa=$aaa and importe7>0 and a.auxi<=4
    or aaa=$aaa and importe8>0 and a.auxi<=4
    or aaa=$aaa and importe9>0 and a.auxi<=4
    or aaa=$aaa and importe10>0 and a.auxi<=4
    or aaa=$aaa and importe11>0 and a.auxi<=4
    or aaa=$aaa and importe12>0 and a.auxi<=4
    group by a.auxi
    order by a.auxi
        ";
        $q = $this->db->query($s);   
$tabla.="
            
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
            $l2 = anchor('mercadotecnia/tabla_utilidad_total_lin_suc/'.$r->auxi.'/'.$r->nom, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$l2." ".$r->auxi."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nom."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";

$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
 $anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }

$num=$num+1;
$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;
}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS CADENAS ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
<td></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_lin_suc($lin)
    {
    $aaa=date('Y');
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
     $l1 = '<img src="'.base_url().'img/logo.jpg" border="0" width="100px" /></a>';
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,
    sum(a.importe1)as importe1,
    sum(a.importe2)as importe2,
    sum(a.importe3)as importe3,
    sum(a.importe4)as importe4,
    sum(a.importe5)as importe5,
    sum(a.importe6)as importe6,
    sum(a.importe7)as importe7,
    sum(a.importe8)as importe8,
    sum(a.importe9)as importe9,
    sum(a.importe10)as importe10,
    sum(a.importe11)as importe11,
    sum(a.importe12)as importe12,
    c.nom,
    sum(importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc=a.suc
    left join catalogo.cat_gastos c on c.num=a.auxi
    where 
       aaa=$aaa and importe1>0  and a.auxi=$lin
    or aaa=$aaa and importe2>0  and a.auxi=$lin
    or aaa=$aaa and importe3>0  and a.auxi=$lin
    or aaa=$aaa and importe4>0  and a.auxi=$lin
    or aaa=$aaa and importe5>0  and a.auxi=$lin
    or aaa=$aaa and importe6>0  and a.auxi=$lin
    or aaa=$aaa and importe7>0  and a.auxi=$lin
    or aaa=$aaa and importe8>0  and a.auxi=$lin
    or aaa=$aaa and importe9>0  and a.auxi=$lin
    or aaa=$aaa and importe10>0 and a.auxi=$lin
    or aaa=$aaa and importe11>0 and a.auxi=$lin
    or aaa=$aaa and importe12>0 and a.auxi=$lin
    group by aaa
    
    ";
    
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">REPORTE DE VENTAS </div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $s="SELECT a.*,b.nombre,
    (a.importe1)as importe1,
    (a.importe2)as importe2,
    (a.importe3)as importe3,
    (a.importe4)as importe4,
    (a.importe5)as importe5,
    (a.importe6)as importe6,
    (a.importe7)as importe7,
    (a.importe8)as importe8,
    (a.importe9)as importe9,
    (a.importe10)as importe10,
    (a.importe11)as importe11,
    (a.importe12)as importe12,
   
    (importe1+importe2+importe3+importe4+importe5+importe6+importe7+importe8+importe9+importe10+importe11+importe12)as anual
    from vtadc.gastos_c a
    left join catalogo.sucursal b on b.suc =a.suc
    
    where aaa=$aaa and importe1>0 and a.auxi=$lin
    or aaa=$aaa and importe2>0  and a.auxi=$lin
    or aaa=$aaa and importe3>0  and a.auxi=$lin
    or aaa=$aaa and importe4>0  and a.auxi=$lin
    or aaa=$aaa and importe5>0  and a.auxi=$lin
    or aaa=$aaa and importe6>0  and a.auxi=$lin
    or aaa=$aaa and importe7>0  and a.auxi=$lin
    or aaa=$aaa and importe8>0  and a.auxi=$lin
    or aaa=$aaa and importe9>0  and a.auxi=$lin
    or aaa=$aaa and importe10>0 and a.auxi=$lin
    or aaa=$aaa and importe11>0 and a.auxi=$lin
    or aaa=$aaa and importe12>0 and a.auxi=$lin
    order by b.nombre
        ";
        $q = $this->db->query($s);   

            



$tabla.="
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$row->nom." </strong></td>
            </tr>
        <tr>
        <th colspan=\"2\"><strong>VENTA</strong></th>
        <th colspan=\"2\"><strong>|------ENE-----|</strong></th>
        <th colspan=\"2\"><strong>|------FEB-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAR-----|</strong></th>
        <th colspan=\"2\"><strong>|------ABR-----|</strong></th>
        <th colspan=\"2\"><strong>|------MAY-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUN-----|</strong></th>
        <th colspan=\"2\"><strong>|------JUL-----|</strong></th>
        <th colspan=\"2\"><strong>|------AGO-----|</strong></th>
        <th colspan=\"2\"><strong>|------SEP-----|</strong></th>
        <th colspan=\"2\"><strong>|------OCT-----|</strong></th>
        <th colspan=\"2\"><strong>|------NOV-----|</strong></th>
        <th colspan=\"2\"><strong>|------DIC-----|</strong></th>
        <th colspan=\"1\"><strong>|------ANUAL-----|</strong></th>
        </tr>
            
            
            
            </tr>";
foreach($q->result() as $r)
        {
if($row->importe1>0){$por1=(($r->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($r->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($r->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($r->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($r->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($r->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($r->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($r->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($r->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($r->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($r->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($r->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$r->suc."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->nombre."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($r->anual,2)."</strong></font></td>
            </tr>";
$num=$num+1;
$impox1=$impox1+$r->importe1;$impox2=$impox2+$r->importe2;$impox3=$impox3+$r->importe3;$impox4=$impox4+$r->importe4;
$impox5=$impox5+$r->importe5;$impox6=$impox6+$r->importe6;$impox7=$impox7+$r->importe7;$impox8=$impox8+$r->importe8;
$impox9=$impox9+$r->importe9;$impox10=$impox10+$r->importe10;$impox11=$impox11+$r->importe11;$impox12=$impox12+$r->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;
 }


$tabla.="
<tr bgcolor=\"#FADCDC\">
            <td  colspan=\"2\"><strong>TOTAL</strong></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe1,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe2,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe3,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe4,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe5,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe6,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe7,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe8,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe9,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe10,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe11,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"black\">".number_format($row->importe12,2)."</font></td>
            <td></td>
            <td align=\"right\" colspan=\"1\"><font color=\"red\"><strong>".number_format($row->anual,2)."</strong></font></td>
            
";

$por1=0;$por2=0;$por3=0;$por4=0;$por5=0;$por6=0;$por7=0;$por8=0;$por9=0;$por10=0;$por11=0;$por12=0;

}
$tabla.="
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"27\"  align=\"center\"><strong>TOTAL DE TODAS LAS SUCURSALES DE LA LINEA ".number_format($num,0)."</strong></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>VENTA TOTAL</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impox12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anual,2)."</strong></font></td>
</tr>

</table>";
        
        
        echo $tabla;
    
       
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////










































































}

