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
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_ofertas()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT b.corto,c.corto as corto2, a.* from catalogo.cat_mirey a 
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.provedor c on b.prov=a.prv2 
    order by fec2 desc";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>FECHA</strong></th>
        <th><strong>MAYORISTA</strong></th>
        <th><strong>CODIGO<br />DESCRIPCION</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>DESCUENTO LAB</strong></th>
        <th><strong>DESCUENTO VTA</strong></th>
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
            <td align=\"left\">".$row->prv." ".$row->corto."<br />".$row->prv2." ".$row->corto2."</td>
            <td align=\"left\">".$row->codigo."<br /> ".$row->descri."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"right\">% ".number_format(($row->descu*100),2)."</td>
            <td align=\"right\"><font color=\"$color\">% ".$row->desvta."</font></td>
            <td align=\"right\"><font color=\"$color\">$ ".$row->vta."</font></td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function catalogo_ofertas_act()
    {
    $fec=date('Y-m-d');    
    $id_user= $this->session->userdata('id');
    $sql="SELECT b.corto,c.corto as corto2, a.* from catalogo.cat_mirey a 
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.provedor c on b.prov=a.prv2
    where fec2>='$fec' 
    order by labor desc ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>FECHA</strong></th>
        <th><strong>MAYORISTA</strong></th>
        <th><strong>CODIGO<br />DESCRIPCION</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>DESCUENTO LAB</strong></th>
        <th><strong>DESCUENTO VTA</strong></th>
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
            <td align=\"left\"><font color=\"green\"> Ini.</font>".$row->fec1." <br /><font color=\"green\">Fin.</font>".$row->fec2."</td>
            <td align=\"left\">".$row->prv." ".$row->corto."<br />".$row->prv2." ".$row->corto2."</td>
            <td align=\"left\">".$row->codigo."<br /> ".$row->descri."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"right\">% ".number_format(($row->descu*100),2)."</td>
            <td align=\"right\"><font color=\"$color\">% ".$row->desvta."</font></td>
            <td align=\"right\"><font color=\"$color\">$ ".$row->vta."</font></td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_ofertas_back()
    {
        $fec=date('Y-m-d');
    $id_user= $this->session->userdata('id');
    $sql="SELECT b.corto, a.* from catalogo.cat_mirey a 
    left join catalogo.provedor b on b.prov=a.prv
    where fec2>='$fec' 
    order by fec2 desc";
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
        <th><strong>% DESCUENTO EN PUB</strong></th>
        <th><strong>PRECIO VENTA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
if($row->vta>0){$color='blue';$ven=$row->vta;}else{$color='black';$ven='';}
if($row->desvta>0){$color1='blue';$desven=$row->desvta;}else{$color1='black';$desven='';} 

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->fec1."<font color=\"blue\"> al </font>".$row->fec2."</td>
            <td align=\"left\">".$row->prv." ".$row->corto."</td>
            <td align=\"left\">".$row->codigo."<br /> ".$row->descri."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"right\"><font color=\"$color1\">% ".$desven."</font></td>
            <td align=\"right\"><font color=\"$color\">$ ".$ven."</font></td>
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
/////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_labor()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT nlab, lab, count(*)as pro from vtadc.n_prox where aaa=2013 group by lab order by lab";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>CATALOGO DE LABORATORIOS</strong></th>
        </tr>
        <tr>
         <th><strong>#</strong></th>
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
            $num=$num+1;
         $l1 = anchor('mercadotecnia/tabla_catalogo_lab_det/'.$row->nlab, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\"><font color=\"green\">".$num."</font></td>
            <td align=\"left\">".$row->nlab."</td>
            <td align=\"left\">".$row->lab."</td>
            <td align=\"right\">".$row->pro."</td>
            <td>$l1</td>
            </tr>
            ";

        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE LABORATORIOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function catalogo_labor_det($lab)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT * from vtadc.n_prox where nlab=$lab order by fami,descri";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>CATALOGO DE LABORATORIOS</strong></th>
        </tr>
        <tr>
        <th><strong>TIPO</strong></th>
        <th><strong>FAMILIA</strong></th>
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
            <td align=\"left\">".$row->fami."</td>
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
function act_as400()
    {
$s1="load data infile 'c:/wamp/www/subir10/prv.txt' replace into table catalogo.provedor FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(prov, razo, dire, cp, pobla, rfc, tipo, corto, tel,control);
";
$this->db->query($s1);
$s2="load data infile 'c:/wamp/www/subir10/ofe.txt' replace into table catalogo.cat_mirey FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(tipo, codigo, descri, labor, fec1, fec2, descu, vta, prv, pago,desvta,prv2);
";
$this->db->query($s2);
$s3="load data infile 'c:/wamp/www/subir10/suc.txt' replace into table subir10.p_cat_suc  FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
";
$this->db->query($s3);
$s4="insert into CATALOGO.SUCURSAL
(tipo1, tipo2, suc, nombre, cia, estado, iva, dire, cp, col, pobla, rfc, descu, user_id, suc_contable)
(select tipo10, tipo20, suc0, nombre0, cia0, estado0, iva0, dire0, cp0, col0, pobla0, rfc0, descu0, plaza0, suc_contable0
from subir10.p_cat_suc )
on duplicate key update nombre=values(nombre),dire=values(dire),cp=values(cp),pobla=values(pobla),
rfc=values(rfc),tipo1=values(tipo1),tipo2=values(tipo2),descu=values(descu),cia=values(cia),
plaza=values(plaza),suc_contable=values(suc_contable);
";
$this->db->query($s4);
$s5="load data infile 'c:/wamp/www/subir10/mirfac.txt' replace into table vtadc.oferta_nota_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, facha, prv, suc, fac, labor, lin, codigo_saba, descri, can, costo, codigo, tipo_nota, descuento, nota)

";
$this->db->query($s5);
$s6="load data infile 'c:/wamp/www/subir10/mirfag.txt' replace into table vtadc.oferta_nota_ctl FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, prv, tipo_nota, labor, nota, tipo)
";
$this->db->query($s6);
$s7="load data infile 'c:/wamp/www/subir10/gas.txt' replace into table vtadc.gasto FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
";
//$this->db->query($s7);
//$s8="";
//$this->db->query($s8);
//$s9="";
//$this->db->query($s9);

    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function usuarios_lab()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.labor from vtadc.users a left join catalogo.laboratorios b on b.num=a.lab where a.nivel=11 order by a.lab";
	  	$query = $this->db->query($sql);
$l0 = anchor('mercadotecnia/agrega_usuario', '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>'.'AGREGA USUARIO', array('title' => 'Haz Click aqui para  agregar usuario!', 'class' => 'encabezado'));    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"8\" align=\"center\"><strong>$l0</strong></th>
        </tr>
        <tr>
        <th colspan=\"8\" align=\"center\"><strong>USUARIOS DE LABORATORIOS</strong></th>
        </tr>
        <tr>
        <th><strong>Laboratorio</strong></th>
        <th><strong>Nombre</strong></th>
        <th><strong>Usuario</strong></th>
        <th><strong>Contrase&ntilde;a</strong></th>
        <th><strong>Activo</strong></th>
        <th><strong>Borrar</strong></th>
        <th><strong>Activar</strong></th>
        <th><strong>Cambiar</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
        $l1 = anchor('mercadotecnia/borrar_usuario/'.$row->userID, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para  borrar!', 'class' => 'encabezado'));    
        $l2 = anchor('mercadotecnia/activar_usuario/'.$row->userID, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para activar!', 'class' => 'encabezado'));
        
        if($row->active==1){
            $color='blue';
            $l3 = anchor('mercadotecnia/cambiar_usuario/'.$row->userID, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para cambiar!', 'class' => 'encabezado'));
            }else{$color='red';$l3='';}
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\"><font color=\"$color\">".$row->labor."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->username."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->password."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->active."</font></td>
            <td align=\"right\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".$l2."</font></td>
            <td align=\"right\"><font color=\"$color\">".$l3."</font></td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"8\"><strong>TOTAL DE USUARIOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_dato($id)
    {
        $sql = "SELECT a.*,b.labor FROM vtadc.users a left join catalogo.laboratorios b on b.num=a.lab where a.userID= ?";
        $query = $this->db->query($sql,array($id));
         return $query;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_labor()
    {
        
        $sql = "SELECT * FROM  catalogo.laboratorios";
        $query = $this->db->query($sql);
        
        $labo = array();
        $labo[0] = "Selecciona un Laboratorio";
        
        foreach($query->result() as $row){
            $labo[$row->num] = $row->labor;
        }
        
        
        return $labo;  
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function delete_member($id)
{
     $dataf = array(
        'active'     => 2
        );
        $this->db->where('userID', $id);
        $this->db->update('vtadc.users', $dataf);
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function activar_member($id)
{
     $dataf = array(
        'active'     => 1
        );
        $this->db->where('userID', $id);
        $this->db->update('vtadc.users', $dataf);
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function update_member($id,$user,$pass,$email)
{
     $dataf = array(
        'username'     => strtolower($user),
        'password'     => strtolower($pass),
        'email'     => strtoupper($email)
        );
        $this->db->where('userID', $id);
        $this->db->update('vtadc.users', $dataf);
}/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function add_member($labor,$user,$pass,$email)
{
     $dataf = array(
        'username'=> strtolower($user),
        'password'=> strtolower($pass),
        'email'   => strtoupper($email),
        'lab'     => strtoupper($labor),
        'ger'     => 0,
        'sup'     => 0,
        'active'  => 1,
        'nivel'   =>11
        );
$insert = $this->db->insert('vtadc.users', $dataf);
}
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
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
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->aaa."</td>
            <td align=\"left\">".$row->mes."</td>
            <td align=\"left\">".$row->prv." - ".$row->corto."</td>
            <td align=\"left\">".$row->tipo_nota."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"right\"> ".number_format($row->nota,2)."</td>
            <td align=\"left\">".$l1."</td>
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
    group by codigo order by can desc";
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
function notas_suc($aaa,$mes)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.aaa,a.mes,a.prv,a.labor,a.suc,b.nombre,sum(a.can)as can,sum(a.costo*a.can)as impo,sum(nota)as nota
    from vtadc.oferta_nota_det a 
    left join catalogo.sucursal b on b.suc=a.suc
    where aaa=$aaa and mes=$mes 
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
         $l1 = anchor('mercadotecnia/tabla_notas_suc_mes/'.$aaa.'/'.$mes.'/'.$row->suc,'<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
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
<td colspan=\"2\"><strong>TOTAL DE NOTAS:".number_format($num,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tcan,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($timpo,2)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tnota,2)."</strong></td>
</tr> 
</table>";
        return $tabla;  
    
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_suc_mes($aaa,$mes,$suc)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,b.nombre,(a.can*a.costo) as impo
    from vtadc.oferta_nota_det a
    left join catalogo.sucursal b on b.suc=a.suc 
    where aaa=$aaa and mes=$mes  and a.suc=$suc
   ";
 	  	$query = $this->db->query($sql);
    	
$tcan=0;$timpo=0;$tnota=0;	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"10\" align=\"center\"><strong>NOTAS DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>FECHA</strong></th>
        <th><strong>FACTURA</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>PIEZAS</strong></th>
        <th><strong>$ FARMACIA</strong></th>
        <th><strong>$ IMPORTE</strong></th>
        <th><strong>$ NOTA</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->facha."</td>
            <td align=\"left\">".$row->fac."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"left\">".$row->codigo."</td>
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
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tcan,0)."</strong></td>
<td></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($timpo,2)."</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($tnota,2)."</strong></td>
</tr> 
</table>";
        
        
        echo $tabla;
        
    
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function notas_oferta_cod($aaa,$mes)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT c.*,b.corto, sum(a.can)as can 
    from vtadc.oferta_nota_det a
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.cat_mirey_codigo c on c.codigo=a.codigo
    where a.aaa=$aaa and a.mes=$mes group by a.codigo
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
           $l1 = anchor('mercadotecnia/tabla_notas_oferta_cod_mes/'.$row->codigo.'/'.$aaa.'/'.$mes,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
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
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function notas_oferta_cod_mes($cod,$aaa,$mes)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT c.*,a.*,b.corto, d.nombre as sucx
    from vtadc.oferta_nota_det a
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.sucursal d on d.suc=a.suc
    left join catalogo.cat_mirey_codigo c on c.codigo=a.codigo
    where a.aaa=$aaa and a.mes=$mes and a.codigo=$cod 
    
    order by suc,can desc
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"3\" align=\"center\"><strong>COMPRA DE OFERTAS EN NOTA</strong></th>
        </tr>
        <tr>
        <th><strong>FACTURA</strong></th>
        <th><strong>NID</strong></th>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>FECHA</strong></th>
        <th><strong>CODIGO</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>COMPRA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        $tot=0;
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->fac."</td>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->facha."</td>
            <td align=\"left\">".$row->codigo."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\"><font color=\"blue\">".number_format($row->can,0)."</font></td>
            
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$tot=$tot+$row->can;
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td align=\"right\"><strong>".number_format($tot,0)."</strong></td>
</tr> 
</table>";
        
        
        echo $tabla;
    
    }
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
function desplazamiento_lab()
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
$me=date('m')-1;
$ss="select *from catalogo.suc_fenix where suc<>999";
$qq = $this->db->query($ss);
$numero_suc=$qq->num_rows();
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
    sum(inv)as inv,b.labor
    from vtadc.n_prox a 
    left join catalogo.laboratorios b  on b.num=a.nlab
    where a.aaa=$aaa
    group by a.nlab order by nlab";
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
        <th width=\"70\" colspan=\"2\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
$l0 = anchor('mercadotecnia/tabla_desplazamientos_lab_lab/'.$row->nlab.'/'.$row->labor,$row->labor, array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
$l1 = anchor('mercadotecnia/tabla_desplazamientos_lab_ctl/'.$row->nlab.'/'.$row->labor,'CTL', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado', 'target' => 'blank'));
$l2 = anchor('mercadotecnia/tabla_desplazamientos_lab_det/'.$row->nlab.'/'.$row->labor,'DET', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado', 'target' => 'blank'));           
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
$prome=round(($row->venta_ant_1+$row->venta_ant_2+$row->venta_ant_3+$row->venta_ant_4+$row->venta_ant_5+$row->venta_ant_6+$row->venta_ant_7+$row->venta_ant_8+$row->venta_ant_9+$row->venta_ant_10+$row->venta_ant_11+$row->venta_ant_12)/12,0);


if($xnum==1){$colorcelda='#C2E8FB';}
if($xnum==0){$colorcelda='#EDF3F9';}
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font  width=\"70\">".$l1."</td>
            <td align=\"left\"><font  width=\"70\">".$l2."</td>
            <td align=\"left\"><font  width=\"70\">".$l0."</td>
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
             <td width=\"70\" align=\"right\"><font color=\"green\">".number_format($prome,0)."</font></td>
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
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"250\">TOTAL DE LABORATORIOS $num</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
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
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab_det($lab,$labor)
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
$ss="select *from catalogo.suc_fenix where suc<>999";
$qq = $this->db->query($ss);
$numero_suc=$qq->num_rows();
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    (a.venta_act_1)as venta_act_1,
    (a.venta_act_2)as venta_act_2,
    (a.venta_act_3)as venta_act_3,
    (a.venta_act_4)as venta_act_4,
    (a.venta_act_5)as venta_act_5,
    (a.venta_act_6)as venta_act_6,
    (a.venta_act_7)as venta_act_7,
    (a.venta_act_8)as venta_act_8,
    (a.venta_act_9)as venta_act_9,
    (a.venta_act_10)as venta_act_10,
    (a.venta_act_11)as venta_act_11,
    (a.venta_act_12)as venta_act_12,
    (a.venta_ant_1)as venta_ant_1,
    (a.venta_ant_2)as venta_ant_2,
    (a.venta_ant_3)as venta_ant_3,
    (a.venta_ant_4)as venta_ant_4,
    (a.venta_ant_5)as venta_ant_5,
    (a.venta_ant_6)as venta_ant_6,
    (a.venta_ant_7)as venta_ant_7,
    (a.venta_ant_8)as venta_ant_8,
    (a.venta_ant_9)as venta_ant_9,
    (a.venta_ant_10)as venta_ant_10,
    (a.venta_ant_11)as venta_ant_11,
    (a.venta_ant_12)as venta_ant_12,
    (a.venta_antt_1)as venta_antt_1,
    (a.venta_antt_2)as venta_antt_2,
    (a.venta_antt_3)as venta_antt_3,
    (a.venta_antt_4)as venta_antt_4,
    (a.venta_antt_5)as venta_antt_5,
    (a.venta_antt_6)as venta_antt_6,
    (a.venta_antt_7)as venta_antt_7,
    (a.venta_antt_8)as venta_antt_8,
    (a.venta_antt_9)as venta_antt_9,
    (a.venta_antt_10)as venta_antt_10,
    (a.venta_antt_11)as venta_antt_11,
    (a.venta_antt_12)as venta_antt_12,
    (a.venta_actt_1)as venta_actt_1,
    (a.venta_actt_2)as venta_actt_2,
    (a.venta_actt_3)as venta_actt_3,
    (a.venta_actt_4)as venta_actt_4,
    (a.venta_actt_5)as venta_actt_5,
    (a.venta_actt_6)as venta_actt_6,
    (a.venta_actt_7)as venta_actt_7,
    (a.venta_actt_8)as venta_actt_8,
    (a.venta_actt_9)as venta_actt_9,
    (a.venta_actt_10)as venta_actt_10,
    (a.venta_actt_11)as venta_actt_11,
    (a.venta_actt_12)as venta_actt_12,
    (a.inv)as inv,b.descri,c.nombre as sucx
    from vtadc.n_prox_det a 
    left join vtadc.n_prox b on b.codigo=a.codigo and a.nlab=b.nlab
    left join catalogo.sucursal c on c.suc=a.suc
    where a.aaa=$aaa and b.nlab=$lab
     order by a.suc,a.codigo";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"left\"><strong>DESPLAZAMIENTO DE LABORATORIO $labor</strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        <th width=\"70\"></th>
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
        <th width=\"70\" colspan=\"1\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"  colspan=\"1\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"70\">Nid</th>
        <th width=\"70\">Sucursal</th>
        <th width=\"70\">Codigo</th>
        <th width=\"250\">Descripcion</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
if($row->venta_ant_1 > 0 || $row->venta_ant_2 > 0 || $row->venta_ant_3 > 0 || $row->venta_ant_4 > 0 || $row->venta_ant_5
 > 0 || $row->venta_ant_6 > 0 || $row->venta_ant_7 > 0 || $row->venta_ant_8 > 0 || $row->venta_ant_9 > 0 || 
 $row->venta_ant_10 > 0 || $row->venta_ant_11 > 0 || $row->venta_ant_12){
$prome=round(($row->venta_ant_1+$row->venta_ant_2+$row->venta_ant_3+$row->venta_ant_4+$row->venta_ant_5+$row->venta_ant_6+$row->venta_ant_7+$row->venta_ant_8+$row->venta_ant_9+$row->venta_ant_10+$row->venta_ant_11+$row->venta_ant_12)/12,4);    
 }else{$prome=0;}
 if($row->venta_act_1 > 0 || $row->venta_act_2 > 0 || $row->venta_act_3 > 0 || $row->venta_act_4 > 0 || $row->venta_act_5
 > 0 || $row->venta_act_6 > 0 || $row->venta_act_7 > 0 || $row->venta_act_8 > 0 || $row->venta_act_9 > 0 || 
 $row->venta_act_10 > 0 || $row->venta_act_11 > 0 || $row->venta_act_12){
$p=1;    
 }else{$p=0;}
if($prome>0 || $row->inv>0 || $p==1){
    
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
            <td align=\"left\"><font  width=\"70\">".$row->suc."</td>
            <td align=\"left\"><font  width=\"70\">".$row->sucx."</td>
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
            <td width=\"70\" align=\"right\"><font color=\"green\">".number_format($prome,4)."</font></td>
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
}
$tabla.="
<tr  bgcolor=\"#88A7C7\">
<th width=\"70\"></th>
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
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"70\"></th>
        <th width=\"250\">TOTAL DE LABORATORIOS $num</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
<tr bgcolor=\"#F5FBFB\">

            <td align=\"left\" colspan=\"4\"><font  width=\"70\">TOTAL</td>
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
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
</tbody> 
</table>
";
        echo $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab_ctl($lab,$labor)
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
$ss="select *from catalogo.suc_fenix where suc<>999";
$qq = $this->db->query($ss);
$numero_suc=$qq->num_rows();
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    (a.venta_act_1)as venta_act_1,
    (a.venta_act_2)as venta_act_2,
    (a.venta_act_3)as venta_act_3,
    (a.venta_act_4)as venta_act_4,
    (a.venta_act_5)as venta_act_5,
    (a.venta_act_6)as venta_act_6,
    (a.venta_act_7)as venta_act_7,
    (a.venta_act_8)as venta_act_8,
    (a.venta_act_9)as venta_act_9,
    (a.venta_act_10)as venta_act_10,
    (a.venta_act_11)as venta_act_11,
    (a.venta_act_12)as venta_act_12,
    (a.venta_ant_1)as venta_ant_1,
    (a.venta_ant_2)as venta_ant_2,
    (a.venta_ant_3)as venta_ant_3,
    (a.venta_ant_4)as venta_ant_4,
    (a.venta_ant_5)as venta_ant_5,
    (a.venta_ant_6)as venta_ant_6,
    (a.venta_ant_7)as venta_ant_7,
    (a.venta_ant_8)as venta_ant_8,
    (a.venta_ant_9)as venta_ant_9,
    (a.venta_ant_10)as venta_ant_10,
    (a.venta_ant_11)as venta_ant_11,
    (a.venta_ant_12)as venta_ant_12,
    (a.venta_antt_1)as venta_antt_1,
    (a.venta_antt_2)as venta_antt_2,
    (a.venta_antt_3)as venta_antt_3,
    (a.venta_antt_4)as venta_antt_4,
    (a.venta_antt_5)as venta_antt_5,
    (a.venta_antt_6)as venta_antt_6,
    (a.venta_antt_7)as venta_antt_7,
    (a.venta_antt_8)as venta_antt_8,
    (a.venta_antt_9)as venta_antt_9,
    (a.venta_antt_10)as venta_antt_10,
    (a.venta_antt_11)as venta_antt_11,
    (a.venta_antt_12)as venta_antt_12,
    (a.venta_actt_1)as venta_actt_1,
    (a.venta_actt_2)as venta_actt_2,
    (a.venta_actt_3)as venta_actt_3,
    (a.venta_actt_4)as venta_actt_4,
    (a.venta_actt_5)as venta_actt_5,
    (a.venta_actt_6)as venta_actt_6,
    (a.venta_actt_7)as venta_actt_7,
    (a.venta_actt_8)as venta_actt_8,
    (a.venta_actt_9)as venta_actt_9,
    (a.venta_actt_10)as venta_actt_10,
    (a.venta_actt_11)as venta_actt_11,
    (a.venta_actt_12)as venta_actt_12,
    (a.inv)as inv,a.descri
    from vtadc.n_prox a 
    where a.aaa=$aaa and a.nlab=$lab
     order by a.codigo";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"left\"><strong>DESPLAZAMIENTO DE LABORATORIO $labor</strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        
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
        <th width=\"70\" colspan=\"2\"><strong></strong></th>
        </tr>
        <tr>
        
        <th width=\"70\"></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"  colspan=\"2\"><strong></strong></th>
        
        </tr>
        <tr>
        
        <th width=\"70\">Codigo</th>
        <th width=\"250\">Descripcion</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
if($row->venta_ant_1 > 0 || $row->venta_ant_2 > 0 || $row->venta_ant_3 > 0 || $row->venta_ant_4 > 0 || $row->venta_ant_5
 > 0 || $row->venta_ant_6 > 0 || $row->venta_ant_7 > 0 || $row->venta_ant_8 > 0 || $row->venta_ant_9 > 0 || 
 $row->venta_ant_10 > 0 || $row->venta_ant_11 > 0 || $row->venta_ant_12){
$prome=round(($row->venta_ant_1+$row->venta_ant_2+$row->venta_ant_3+$row->venta_ant_4+$row->venta_ant_5+$row->venta_ant_6+$row->venta_ant_7+$row->venta_ant_8+$row->venta_ant_9+$row->venta_ant_10+$row->venta_ant_11+$row->venta_ant_12)/12,4);    
 }else{$prome=0;}
 if($row->venta_act_1 > 0 || $row->venta_act_2 > 0 || $row->venta_act_3 > 0 || $row->venta_act_4 > 0 || $row->venta_act_5
 > 0 || $row->venta_act_6 > 0 || $row->venta_act_7 > 0 || $row->venta_act_8 > 0 || $row->venta_act_9 > 0 || 
 $row->venta_act_10 > 0 || $row->venta_act_11 > 0 || $row->venta_act_12){
$p=1;    
 }else{$p=0;}
if($prome>0 || $row->inv>0 || $p==1){
    
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
            <td width=\"70\" align=\"right\"><font color=\"green\">".number_format($prome,4)."</font></td>
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
}
$tabla.="
<tr  bgcolor=\"#88A7C7\">

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
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        </tr>
        <tr>
        
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
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        
        </tr>
        <tr>
        
        <th width=\"70\"></th>
        <th width=\"250\">TOTAL DE LABORATORIOS $num</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
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
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab_ctl_fam($lab,$labor)
    {
    	
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
$ss="select *from catalogo.suc_fenix where suc<>999";
$qq = $this->db->query($ss);
$numero_suc=$qq->num_rows();
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    sum(a.venta_act_1)as venta_act_1,
    sum(a.venta_act_2)as venta_act_2,
    sum(a.venta_act_3)as venta_act_3,
    sum(a.venta_act_4)as venta_act_4,
    sum(a.venta_act_5)as venta_act_5,
    sum(a.venta_act_6)as venta_act_6,
    sum(a.venta_act_7)as venta_act_7,
    sum(a.venta_act_8)as venta_act_8,
    sum(a.venta_act_9)as venta_act_9,
    sum(a.venta_act_10)as venta_act_10,
    sum(a.venta_act_11)as venta_act_11,
    sum(a.venta_act_12)as venta_act_12,
    sum(a.venta_ant_1)as venta_ant_1,
    sum(a.venta_ant_2)as venta_ant_2,
    sum(a.venta_ant_3)as venta_ant_3,
    sum(a.venta_ant_4)as venta_ant_4,
    sum(a.venta_ant_5)as venta_ant_5,
    sum(a.venta_ant_6)as venta_ant_6,
    sum(a.venta_ant_7)as venta_ant_7,
    sum(a.venta_ant_8)as venta_ant_8,
    sum(a.venta_ant_9)as venta_ant_9,
    sum(a.venta_ant_10)as venta_ant_10,
    sum(a.venta_ant_11)as venta_ant_11,
    sum(a.venta_ant_12)as venta_ant_12,
    sum(a.venta_antt_1)as venta_antt_1,
    sum(a.venta_antt_2)as venta_antt_2,
    sum(a.venta_antt_3)as venta_antt_3,
    sum(a.venta_antt_4)as venta_antt_4,
    sum(a.venta_antt_5)as venta_antt_5,
    sum(a.venta_antt_6)as venta_antt_6,
    sum(a.venta_antt_7)as venta_antt_7,
    sum(a.venta_antt_8)as venta_antt_8,
    sum(a.venta_antt_9)as venta_antt_9,
    sum(a.venta_antt_10)as venta_antt_10,
    sum(a.venta_antt_11)as venta_antt_11,
    sum(a.venta_antt_12)as venta_antt_12,
    sum(a.venta_actt_1)as venta_actt_1,
    sum(a.venta_actt_2)as venta_actt_2,
    sum(a.venta_actt_3)as venta_actt_3,
    sum(a.venta_actt_4)as venta_actt_4,
    sum(a.venta_actt_5)as venta_actt_5,
    sum(a.venta_actt_6)as venta_actt_6,
    sum(a.venta_actt_7)as venta_actt_7,
    sum(a.venta_actt_8)as venta_actt_8,
    sum(a.venta_actt_9)as venta_actt_9,
    sum(a.venta_actt_10)as venta_actt_10,
    sum(a.venta_actt_11)as venta_actt_11,
    sum(a.venta_actt_12)as venta_actt_12,
    sum(a.inv)as inv,a.descri
    from vtadc.n_prox a 
    where a.aaa=$aaa and a.nlab=$lab
    group by fami
     order by a.codigo";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"left\"><strong>DESPLAZAMIENTO DE LABORATORIO $labor</strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
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
        <th width=\"70\" colspan=\"2\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"  colspan=\"2\"><strong></strong></th>
        
        </tr>
        <tr>
       <th width=\"250\">Familia</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
if($row->venta_ant_1 > 0 || $row->venta_ant_2 > 0 || $row->venta_ant_3 > 0 || $row->venta_ant_4 > 0 || $row->venta_ant_5
 > 0 || $row->venta_ant_6 > 0 || $row->venta_ant_7 > 0 || $row->venta_ant_8 > 0 || $row->venta_ant_9 > 0 || 
 $row->venta_ant_10 > 0 || $row->venta_ant_11 > 0 || $row->venta_ant_12){
$prome=round(($row->venta_ant_1+$row->venta_ant_2+$row->venta_ant_3+$row->venta_ant_4+$row->venta_ant_5+$row->venta_ant_6+$row->venta_ant_7+$row->venta_ant_8+$row->venta_ant_9+$row->venta_ant_10+$row->venta_ant_11+$row->venta_ant_12)/12,4);    
 }else{$prome=0;}
 if($row->venta_act_1 > 0 || $row->venta_act_2 > 0 || $row->venta_act_3 > 0 || $row->venta_act_4 > 0 || $row->venta_act_5
 > 0 || $row->venta_act_6 > 0 || $row->venta_act_7 > 0 || $row->venta_act_8 > 0 || $row->venta_act_9 > 0 || 
 $row->venta_act_10 > 0 || $row->venta_act_11 > 0 || $row->venta_act_12){
$p=1;    
 }else{$p=0;}
if($prome>0 || $row->inv>0 || $p==1){
    
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
$l0 = anchor('mercadotecnia/tabla_desplazamientos_lab_lab_fami/'.$row->nlab.'/'.$labor.'/'.$row->fami,$row->fami, array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font  width=\"70\">".$l0."</td>
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
            <td width=\"70\" align=\"right\"><font color=\"green\">".number_format($prome,4)."</font></td>
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
}
$tabla.="
<tr  bgcolor=\"#88A7C7\">
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
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        </tr>
        <tr>
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
        <th width=\"70\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"250\">TOTAL DE FAMILIAS $num</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
<tr bgcolor=\"#F5FBFB\">

            <td align=\"left\" colspan=\"1\"><font  width=\"70\">TOTAL</td>
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
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_lab_ctl_fam_det($lab,$labor,$fami)
    {
$fami=str_replace('%20',' ',$fami);
$labor=str_replace('%20',' ',$labor);
$act1=0;$act2=0;$act3=0;$act4=0;$act5=0;$act6=0;$act7=0;$act8=0;$act9=0;$act10=0;$act11=0;$act12=0;
$actt1=0;$actt2=0;$actt3=0;$actt4=0;$actt5=0;$actt6=0;$actt7=0;$actt8=0;$actt9=0;$actt10=0;$actt11=0;$actt12=0;
$antt1=0;$antt2=0;$antt3=0;$antt4=0;$antt5=0;$antt6=0;$antt7=0;$antt8=0;$antt9=0;$antt10=0;$antt11=0;$antt12=0;
$ant1=0;$ant2=0;$ant3=0;$ant4=0;$ant5=0;$ant6=0;$ant7=0;$ant8=0;$ant9=0;$ant10=0;$ant11=0;$ant12=0;        
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
$ss="select *from catalogo.suc_fenix where suc<>999";
$qq = $this->db->query($ss);
$numero_suc=$qq->num_rows();
    $id_user= $this->session->userdata('id');
    $sql="SELECT a.*,
    (a.venta_act_1)as venta_act_1,
    (a.venta_act_2)as venta_act_2,
    (a.venta_act_3)as venta_act_3,
    (a.venta_act_4)as venta_act_4,
    (a.venta_act_5)as venta_act_5,
    (a.venta_act_6)as venta_act_6,
    (a.venta_act_7)as venta_act_7,
    (a.venta_act_8)as venta_act_8,
    (a.venta_act_9)as venta_act_9,
    (a.venta_act_10)as venta_act_10,
    (a.venta_act_11)as venta_act_11,
    (a.venta_act_12)as venta_act_12,
    (a.venta_ant_1)as venta_ant_1,
    (a.venta_ant_2)as venta_ant_2,
    (a.venta_ant_3)as venta_ant_3,
    (a.venta_ant_4)as venta_ant_4,
    (a.venta_ant_5)as venta_ant_5,
    (a.venta_ant_6)as venta_ant_6,
    (a.venta_ant_7)as venta_ant_7,
    (a.venta_ant_8)as venta_ant_8,
    (a.venta_ant_9)as venta_ant_9,
    (a.venta_ant_10)as venta_ant_10,
    (a.venta_ant_11)as venta_ant_11,
    (a.venta_ant_12)as venta_ant_12,
    (a.venta_antt_1)as venta_antt_1,
    (a.venta_antt_2)as venta_antt_2,
    (a.venta_antt_3)as venta_antt_3,
    (a.venta_antt_4)as venta_antt_4,
    (a.venta_antt_5)as venta_antt_5,
    (a.venta_antt_6)as venta_antt_6,
    (a.venta_antt_7)as venta_antt_7,
    (a.venta_antt_8)as venta_antt_8,
    (a.venta_antt_9)as venta_antt_9,
    (a.venta_antt_10)as venta_antt_10,
    (a.venta_antt_11)as venta_antt_11,
    (a.venta_antt_12)as venta_antt_12,
    (a.venta_actt_1)as venta_actt_1,
    (a.venta_actt_2)as venta_actt_2,
    (a.venta_actt_3)as venta_actt_3,
    (a.venta_actt_4)as venta_actt_4,
    (a.venta_actt_5)as venta_actt_5,
    (a.venta_actt_6)as venta_actt_6,
    (a.venta_actt_7)as venta_actt_7,
    (a.venta_actt_8)as venta_actt_8,
    (a.venta_actt_9)as venta_actt_9,
    (a.venta_actt_10)as venta_actt_10,
    (a.venta_actt_11)as venta_actt_11,
    (a.venta_actt_12)as venta_actt_12,
    (a.inv)as inv,a.descri
    from vtadc.n_prox a 
    where a.aaa=$aaa and a.nlab=$lab and fami='$fami'
    
     order by a.codigo";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"left\"><strong>DESPLAZAMIENTO DE LABORATORIO $labor -  $fami</strong></th>
        </tr>
        
        <tr  bgcolor=\"#88A7C7\">
        <th width=\"70\" colspan=\"1\"><strong></strong></th>
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
        <th width=\"70\" colspan=\"2\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"70\" colspan=\"1\"><strong></strong></th>
        <th width=\"300\"></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"140\" colspan=\"2\"><font color=\"blue\"><strong>FENIX $numero_suc</strong></font></th>
        <th width=\"140\" colspan=\"2\"><strong>TODAS</strong></th>
        <th width=\"70\"  colspan=\"2\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"70\" colspan=\"1\"><strong>Codigo</strong></th>
       <th width=\"250\">Descripcion</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
        <th width=\"70\"><strong>INV</strong></th>
        
        </tr>
        
        </thead>
        
         <tbody>";
        $num=0;
        $xnum=0;
        $colorcelda='#BBEAFB';
        
        foreach($query->result() as $row){
if($row->venta_ant_1 > 0 || $row->venta_ant_2 > 0 || $row->venta_ant_3 > 0 || $row->venta_ant_4 > 0 || $row->venta_ant_5
 > 0 || $row->venta_ant_6 > 0 || $row->venta_ant_7 > 0 || $row->venta_ant_8 > 0 || $row->venta_ant_9 > 0 || 
 $row->venta_ant_10 > 0 || $row->venta_ant_11 > 0 || $row->venta_ant_12){
$prome=round(($row->venta_ant_1+$row->venta_ant_2+$row->venta_ant_3+$row->venta_ant_4+$row->venta_ant_5+$row->venta_ant_6+$row->venta_ant_7+$row->venta_ant_8+$row->venta_ant_9+$row->venta_ant_10+$row->venta_ant_11+$row->venta_ant_12)/12,4);    
 }else{$prome=0;}
 if($row->venta_act_1 > 0 || $row->venta_act_2 > 0 || $row->venta_act_3 > 0 || $row->venta_act_4 > 0 || $row->venta_act_5
 > 0 || $row->venta_act_6 > 0 || $row->venta_act_7 > 0 || $row->venta_act_8 > 0 || $row->venta_act_9 > 0 || 
 $row->venta_act_10 > 0 || $row->venta_act_11 > 0 || $row->venta_act_12){
$p=1;    
 }else{$p=0;}
if($prome>0 || $row->inv>0 || $p==1){
    
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
$l0 = anchor('mercadotecnia/tabla_desplazamientos_lab_lab_fami/'.$row->nlab.'/'.$labor.'/'.$row->fami,$row->fami, array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
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
            <td width=\"70\" align=\"right\"><font color=\"green\">".number_format($prome,4)."</font></td>
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
}
$tabla.="
<tr  bgcolor=\"#88A7C7\">
        <th width=\"70\"><strong></strong></th>
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
        <th width=\"70\"><strong></strong></th>
        <th width=\"70\"><strong></strong></th>
        </tr>
        <tr>
        <th width=\"300\"></th>
        <th width=\"70\"><strong></strong></th>
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
        <th width=\"70\"><strong></strong></th>
        
        </tr>
        <tr>
        <th width=\"70\"><strong></strong></th>
        <th width=\"250\">TOTAL DE PRODUCTOS $num</th>
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
        <th width=\"70\"><strong>Promedio $aaax</strong></th>
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
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\">".number_format($inv,0)."</td>
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento_vidaz()
    {
$inv=0;
$aaa=date('Y');        
$aaax=date('Y')-1;
    $id_user= $this->session->userdata('id');
    $sql="SELECT  *from azf.cat ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\" CELLSPACING=\"1\">
        <thead>
        <tr>
        <th colspan=\"53\" align=\"left\"><strong>DESPLAZAMIENTO DE VIDAZ</strong></th>
        </tr>
        <tr>
        <th width=\"70\" colspan=\"1\"><strong>Codigo</strong></th>
        <th width=\"250\">Descripcion</th>
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

if($xnum==1){$colorcelda='#C2E8FB';}
if($xnum==0){$colorcelda='#EDF3F9';}
$l0 = anchor('mercadotecnia/tabla_desplazamientos_lab_lab_fami/'.$row->ean,$row->descripcion, array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
           $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font  width=\"70\">".$row->ean."</td>
            <td align=\"left\"><font  width=\"70\">".$row->descripcion."</td>
            </tr>
            
            ";
}
$tabla.="
<tr bgcolor=\"#F5FBFB\">
</tbody> 
</table>
";
        
        
        echo $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function tarjetas()
    {
    $id_user= $this->session->userdata('id');
    $sql="select ";
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
            <td align=\"left\">".$row->prv." ".$row->corto."</td>
            <td align=\"left\">".$row->codigo."<br /> ".$row->descri."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"left\">% ".($row->descu*100)."</td>
            <td align=\"right\"><font color=\"$color\">$ ".$row->vta."</font></td>
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
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventas_solof()
    {
    $aaa=date('Y');
    $aaa=2012;
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
    $aaa=2012;
$aaax=2011;   
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
$aaa=2012;
$aaax=2011;   
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
    $aaa=2012;
$aaax=2011;   

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
    $aaa=2012;
$aaax=2011;   
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
    $aaa=2012;
$aaax=2011;   
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
    $aaa=2012;
$aaax=2011;   
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
    $aaa=2012;
$aaax=2011;   
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
    $aaa=2012;
$aaax=2011;   
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;
$impoxxu1=0;$impoxxu2=0;$impoxxu3=0;$impoxxu4=0;$impoxxu5=0;$impoxxu6=0;$impoxxu7=0;$impoxxu8=0;$impoxxu9=0;$impoxxu10=0;$impoxxu11=0;$impoxxu12=0;
$anualxxu=0;
$impoxxg1=0;$impoxxg2=0;$impoxxg3=0;$impoxxg4=0;$impoxxg5=0;$impoxxg6=0;$impoxxg7=0;$impoxxg8=0;$impoxxg9=0;$impoxxg10=0;$impoxxg11=0;$impoxxg12=0;
$anualxxg=0;
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
        <div  align=\"center\">COMPA&Ntilde;IAS REPORTE DE VENTAS Y UTILIDAD</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
//total de ventas
$impox1=$impox1+$row->importe1;$impox2=$impox2+$row->importe2;$impox3=$impox3+$row->importe3;$impox4=$impox4+$row->importe4;
$impox5=$impox5+$row->importe5;$impox6=$impox6+$row->importe6;$impox7=$impox7+$row->importe7;$impox8=$impox8+$row->importe8;
$impox9=$impox9+$row->importe9;$impox10=$impox10+$row->importe10;$impox11=$impox11+$row->importe11;$impox12=$impox12+$row->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;

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
    a.aaa=$aaa and a.cia=$row->cia and a.importe1>0 and a.auxi>10 and auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe2>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe3>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe4>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe5>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe6>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe7>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe8>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe9>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe10>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe11>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.cia=$row->cia and a.importe12>0 and a.auxi>10 and a.auxi<20
    group by a.cia
    order by a.cia
        ";
        $q = $this->db->query($s);   
$ss="SELECT a.*,
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
    a.aaa=$aaa and a.cia=$row->cia and a.importe1>0 and a.auxi>1004 
    or a.aaa=$aaa and a.cia=$row->cia and a.importe2>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe3>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe4>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe5>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe6>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe7>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe8>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe9>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe10>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe11>0 and a.auxi>1004
    or a.aaa=$aaa and a.cia=$row->cia and a.importe12>0 and a.auxi>1004
    group by a.cia
    order by a.cia
        ";
        $qq = $this->db->query($ss); 
            

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
 
<tr bgcolor=\"white\">
<td colspan=\"2\"><strong>TOTAL VENTA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->anual,2)."</strong></font></td>
<td></td>
</tr>";  
 

foreach($q->result() as $r)
        {
//total utilidad
$impoxu1=$impoxu1+$r->importe1;$impoxu2=$impoxu2+$r->importe2;$impoxu3=$impoxu3+$r->importe3;$impoxu4=$impoxu4+$r->importe4;
$impoxu5=$impoxu5+$r->importe5;$impoxu6=$impoxu6+$r->importe6;$impoxu7=$impoxu7+$r->importe7;$impoxu8=$impoxu8+$r->importe8;
$impoxu9=$impoxu9+$r->importe9;$impoxu10=$impoxu10+$r->importe10;$impoxu11=$impoxu11+$r->importe11;$impoxu12=$impoxu12+$r->importe12;
$anualu=$impoxu1+$impoxu2+$impoxu3+$impoxu4+$impoxu5+$impoxu6+$impoxu7+$impoxu8+$impoxu9+$impoxu10+$impoxu11+$impoxu12;

$impoxxu1=$impoxxu1+$r->importe1;$impoxxu2=$impoxxu2+$r->importe2;$impoxxu3=$impoxxu3+$r->importe3;$impoxxu4=$impoxxu4+$r->importe4;
$impoxxu5=$impoxxu5+$r->importe5;$impoxxu6=$impoxxu6+$r->importe6;$impoxxu7=$impoxxu7+$r->importe7;$impoxxu8=$impoxxu8+$r->importe8;
$impoxxu9=$impoxxu9+$r->importe9;$impoxxu10=$impoxxu10+$r->importe10;$impoxxu11=$impoxxu11+$r->importe11;$impoxxu12=$impoxxu12+$r->importe12;
$anualxxu=$impoxxu1+$impoxxu2+$impoxxu3+$impoxxu4+$impoxxu5+$impoxxu6+$impoxxu7+$impoxxu8+$impoxxu9+$impoxxu10+$impoxxu11+$impoxxu12;

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
            <tr bgcolor=\"white\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL UTILIDAD</font></td>
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
            </tr>
            ";

foreach($qq->result() as $rr)
        {
//total gastos
$impoxg1=$impoxg1+$rr->importe1;$impoxg2=$impoxg2+$rr->importe2;$impoxg3=$impoxg3+$rr->importe3;$impoxg4=$impoxg4+$rr->importe4;
$impoxg5=$impoxg5+$rr->importe5;$impoxg6=$impoxg6+$rr->importe6;$impoxg7=$impoxg7+$rr->importe7;$impoxg8=$impoxg8+$rr->importe8;
$impoxg9=$impoxg9+$rr->importe9;$impoxg10=$impoxg10+$rr->importe10;$impoxg11=$impoxg11+$rr->importe11;$impoxg12=$impoxg12+$rr->importe12;
$anualg=$impoxg1+$impoxg2+$impoxg3+$impoxg4+$impoxg5+$impoxg6+$impoxg7+$impoxg8+$impoxg9+$impoxg10+$impoxg11+$impoxg12;

$impoxxg1=$impoxxg1+$rr->importe1;$impoxxg2=$impoxxg2+$rr->importe2;$impoxxg3=$impoxxg3+$rr->importe3;$impoxxg4=$impoxxg4+$rr->importe4;
$impoxxg5=$impoxxg5+$rr->importe5;$impoxxg6=$impoxxg6+$rr->importe6;$impoxxg7=$impoxxg7+$rr->importe7;$impoxxg8=$impoxxg8+$rr->importe8;
$impoxxg9=$impoxxg9+$rr->importe9;$impoxxg10=$impoxxg10+$rr->importe10;$impoxxg11=$impoxxg11+$rr->importe11;$impoxxg12=$impoxxg12+$rr->importe12;
$anualxxg=$impoxxg1+$impoxxg2+$impoxxg3+$impoxxg4+$impoxxg5+$impoxxg6+$impoxxg7+$impoxxg8+$impoxxg9+$impoxxg10+$impoxxg11+$impoxxg12;
if($row->importe1>0){$por1=(($rr->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($rr->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($rr->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($rr->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($rr->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($rr->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($rr->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($rr->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($rr->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($rr->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($rr->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($rr->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"white\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL GASTOS</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($rr->anual,2)."</strong></font></td>
            </tr>";

}

}
if($row->importe1>0){$por1=((($impoxu1-$impoxg1)*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=((($impoxu2-$impoxg2)*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=((($impoxu3-$impoxg3)*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=((($impoxu4-$impoxg4)*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=((($impoxu5-$impoxg5)*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=((($impoxu6-$impoxg6)*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=((($impoxu7-$impoxg7)*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=((($impoxu8-$impoxg8)*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=((($impoxu9-$impoxg9)*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=((($impoxu10-$impoxg10)*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=((($impoxu11-$impoxg11)*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=((($impoxu12-$impoxg12)*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"#D6F0FB\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL GANACIA</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu1-$impoxg1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu2-$impoxg2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu3-$impoxg3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu4-$impoxg4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu5-$impoxg5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu6-$impoxg6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu7-$impoxg7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu8-$impoxg8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu9-$impoxg9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu10-$impoxg10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu11-$impoxg11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu12-$impoxg12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($anualu-$anualg,2)."</font></td>
            </tr>";
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
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualxxu,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualxxg,2)."</strong></font></td>
<td></td>
</tr>

</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GANACIAS</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu1-$impoxxg1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu2-$impoxxg2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu3-$impoxxg3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu4-$impoxxg4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu5-$impoxxg5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu6-$impoxxg6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu7-$impoxxg7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu8-$impoxxg8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu9-$impoxxg9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu10-$impoxxg10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu11-$impoxxg11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu12-$impoxxg12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($anualxxu-$anualxxg,2)."</font></td>
<td></td> 
</tr>       
</table>";        
        echo $tabla;
    
       
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_ciaf_suc($cia)
    {
   $aaa=date('Y');
$aaa=2012;
$aaax=2011;   
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;
$impoxxu1=0;$impoxxu2=0;$impoxxu3=0;$impoxxu4=0;$impoxxu5=0;$impoxxu6=0;$impoxxu7=0;$impoxxu8=0;$impoxxu9=0;$impoxxu10=0;$impoxxu11=0;$impoxxu12=0;
$anualxxu=0;
$impoxxg1=0;$impoxxg2=0;$impoxxg3=0;$impoxxg4=0;$impoxxg5=0;$impoxxg6=0;$impoxxg7=0;$impoxxg8=0;$impoxxg9=0;$impoxxg10=0;$impoxxg11=0;$impoxxg12=0;
$anualxxg=0;
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
    where aaa=$aaa and importe1>0 and a.cia>0 and a.auxi<5 and a.cia=$cia  
    or aaa=$aaa and importe2>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe3>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe4>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe5>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe6>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe7>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe8>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe9>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe10>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe11>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    or aaa=$aaa and importe12>0 and a.cia>0 and a.auxi<5 and a.cia=$cia
    group by a.suc
    order by a.suc
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">COMPA&Ntilde;IAS REPORTE DE VENTAS Y UTILIDAD</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
//total de ventas
$impox1=$impox1+$row->importe1;$impox2=$impox2+$row->importe2;$impox3=$impox3+$row->importe3;$impox4=$impox4+$row->importe4;
$impox5=$impox5+$row->importe5;$impox6=$impox6+$row->importe6;$impox7=$impox7+$row->importe7;$impox8=$impox8+$row->importe8;
$impox9=$impox9+$row->importe9;$impox10=$impox10+$row->importe10;$impox11=$impox11+$row->importe11;$impox12=$impox12+$row->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;

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
    a.aaa=$aaa and a.suc=$row->suc and a.importe1>0 and a.auxi>10 and auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe2>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe3>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe4>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe5>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe6>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe7>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe8>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe9>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe10>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe11>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe12>0 and a.auxi>10 and a.auxi<20
    group by a.suc
    order by a.suc
        ";
        $q = $this->db->query($s);   
$ss="SELECT a.*,
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
    a.aaa=$aaa and a.suc=$row->suc and a.importe1>0 and a.auxi>1004 
    or a.aaa=$aaa and a.suc=$row->suc and a.importe2>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe3>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe4>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe5>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe6>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe7>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe8>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe9>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe10>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe11>0 and a.auxi>1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe12>0 and a.auxi>1004
    group by a.suc
    order by a.suc
        ";
        $qq = $this->db->query($ss); 
            

$l1 = anchor('mercadotecnia/tabla_utilidad_total_cia_suc_det/'.$row->suc.'/'.$row->nombre, '<img src="'.base_url().'img/pharmacy.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui para ver las sucursales!', 'class' => 'encabezado'));

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
 
<tr bgcolor=\"white\">
<td colspan=\"2\"><strong>TOTAL VENTA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->anual,2)."</strong></font></td>
<td></td>
</tr>";  
 

foreach($q->result() as $r)
        {
//total utilidad
$impoxu1=$impoxu1+$r->importe1;$impoxu2=$impoxu2+$r->importe2;$impoxu3=$impoxu3+$r->importe3;$impoxu4=$impoxu4+$r->importe4;
$impoxu5=$impoxu5+$r->importe5;$impoxu6=$impoxu6+$r->importe6;$impoxu7=$impoxu7+$r->importe7;$impoxu8=$impoxu8+$r->importe8;
$impoxu9=$impoxu9+$r->importe9;$impoxu10=$impoxu10+$r->importe10;$impoxu11=$impoxu11+$r->importe11;$impoxu12=$impoxu12+$r->importe12;
$anualu=$impoxu1+$impoxu2+$impoxu3+$impoxu4+$impoxu5+$impoxu6+$impoxu7+$impoxu8+$impoxu9+$impoxu10+$impoxu11+$impoxu12;

$impoxxu1=$impoxxu1+$r->importe1;$impoxxu2=$impoxxu2+$r->importe2;$impoxxu3=$impoxxu3+$r->importe3;$impoxxu4=$impoxxu4+$r->importe4;
$impoxxu5=$impoxxu5+$r->importe5;$impoxxu6=$impoxxu6+$r->importe6;$impoxxu7=$impoxxu7+$r->importe7;$impoxxu8=$impoxxu8+$r->importe8;
$impoxxu9=$impoxxu9+$r->importe9;$impoxxu10=$impoxxu10+$r->importe10;$impoxxu11=$impoxxu11+$r->importe11;$impoxxu12=$impoxxu12+$r->importe12;
$anualxxu=$impoxxu1+$impoxxu2+$impoxxu3+$impoxxu4+$impoxxu5+$impoxxu6+$impoxxu7+$impoxxu8+$impoxxu9+$impoxxu10+$impoxxu11+$impoxxu12;

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
            <tr bgcolor=\"white\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL UTILIDAD</font></td>
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
            </tr>
            ";

foreach($qq->result() as $rr)
        {
//total gastos
$impoxg1=$impoxg1+$rr->importe1;$impoxg2=$impoxg2+$rr->importe2;$impoxg3=$impoxg3+$rr->importe3;$impoxg4=$impoxg4+$rr->importe4;
$impoxg5=$impoxg5+$rr->importe5;$impoxg6=$impoxg6+$rr->importe6;$impoxg7=$impoxg7+$rr->importe7;$impoxg8=$impoxg8+$rr->importe8;
$impoxg9=$impoxg9+$rr->importe9;$impoxg10=$impoxg10+$rr->importe10;$impoxg11=$impoxg11+$rr->importe11;$impoxg12=$impoxg12+$rr->importe12;
$anualg=$impoxg1+$impoxg2+$impoxg3+$impoxg4+$impoxg5+$impoxg6+$impoxg7+$impoxg8+$impoxg9+$impoxg10+$impoxg11+$impoxg12;

$impoxxg1=$impoxxg1+$rr->importe1;$impoxxg2=$impoxxg2+$rr->importe2;$impoxxg3=$impoxxg3+$rr->importe3;$impoxxg4=$impoxxg4+$rr->importe4;
$impoxxg5=$impoxxg5+$rr->importe5;$impoxxg6=$impoxxg6+$rr->importe6;$impoxxg7=$impoxxg7+$rr->importe7;$impoxxg8=$impoxxg8+$rr->importe8;
$impoxxg9=$impoxxg9+$rr->importe9;$impoxxg10=$impoxxg10+$rr->importe10;$impoxxg11=$impoxxg11+$rr->importe11;$impoxxg12=$impoxxg12+$rr->importe12;
$anualxxg=$impoxxg1+$impoxxg2+$impoxxg3+$impoxxg4+$impoxxg5+$impoxxg6+$impoxxg7+$impoxxg8+$impoxxg9+$impoxxg10+$impoxxg11+$impoxxg12;
if($row->importe1>0){$por1=(($rr->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($rr->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($rr->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($rr->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($rr->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($rr->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($rr->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($rr->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($rr->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($rr->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($rr->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($rr->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"white\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL GASTOS</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($rr->anual,2)."</strong></font></td>
            </tr>";

}

}
if($row->importe1>0){$por1=((($impoxu1-$impoxg1)*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=((($impoxu2-$impoxg2)*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=((($impoxu3-$impoxg3)*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=((($impoxu4-$impoxg4)*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=((($impoxu5-$impoxg5)*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=((($impoxu6-$impoxg6)*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=((($impoxu7-$impoxg7)*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=((($impoxu8-$impoxg8)*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=((($impoxu9-$impoxg9)*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=((($impoxu10-$impoxg10)*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=((($impoxu11-$impoxg11)*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=((($impoxu12-$impoxg12)*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"#D6F0FB\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL GANACIA</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu1-$impoxg1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu2-$impoxg2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu3-$impoxg3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu4-$impoxg4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu5-$impoxg5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu6-$impoxg6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu7-$impoxg7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu8-$impoxg8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu9-$impoxg9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu10-$impoxg10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu11-$impoxg11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu12-$impoxg12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($anualu-$anualg,2)."</font></td>
            </tr>";
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
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualxxu,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualxxg,2)."</strong></font></td>
<td></td>
</tr>

</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GANACIAS</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu1-$impoxxg1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu2-$impoxxg2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu3-$impoxxg3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu4-$impoxxg4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu5-$impoxxg5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu6-$impoxxg6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu7-$impoxxg7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu8-$impoxxg8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu9-$impoxxg9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu10-$impoxxg10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu11-$impoxxg11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu12-$impoxxg12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($anualxxu-$anualxxg,2)."</font></td>
<td></td> 
</tr>       
</table>";        
        echo $tabla;
    
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utilidad_total_ciaf_suc_det($suc,$sucx)
    {
   $aaa=date('Y');
$aaa=2012;
$aaax=2011;   
$impox1=0;$impox2=0;$impox3=0;$impox4=0;$impox5=0;$impox6=0;$impox7=0;$impox8=0;$impox9=0;$impox10=0;$impox11=0;$impox12=0;
$impoz1=0;$impoz2=0;$impoz3=0;$impoz4=0;$impoz5=0;$impoz6=0;$impoz7=0;$impoz8=0;$impoz9=0;$impoz10=0;$impoz11=0;$impoz12=0;
$anual=0;
$impoxu1=0;$impoxu2=0;$impoxu3=0;$impoxu4=0;$impoxu5=0;$impoxu6=0;$impoxu7=0;$impoxu8=0;$impoxu9=0;$impoxu10=0;$impoxu11=0;$impoxu12=0;
$anualu=0;
$impoxg1=0;$impoxg2=0;$impoxg3=0;$impoxg4=0;$impoxg5=0;$impoxg6=0;$impoxg7=0;$impoxg8=0;$impoxg9=0;$impoxg10=0;$impoxg11=0;$impoxg12=0;
$anualg=0;
$impoxxu1=0;$impoxxu2=0;$impoxxu3=0;$impoxxu4=0;$impoxxu5=0;$impoxxu6=0;$impoxxu7=0;$impoxxu8=0;$impoxxu9=0;$impoxxu10=0;$impoxxu11=0;$impoxxu12=0;
$anualxxu=0;
$impoxxg1=0;$impoxxg2=0;$impoxxg3=0;$impoxxg4=0;$impoxxg5=0;$impoxxg6=0;$impoxxg7=0;$impoxxg8=0;$impoxxg9=0;$impoxxg10=0;$impoxxg11=0;$impoxxg12=0;
$anualxxg=0;
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
    where aaa=$aaa and importe1>0 and a.cia>0 and a.auxi<5 and a.suc=$suc  
    or aaa=$aaa and importe2>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe3>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe4>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe5>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe6>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe7>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe8>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe9>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe10>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe11>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    or aaa=$aaa and importe12>0 and a.cia>0 and a.auxi<5 and a.suc=$suc
    group by a.suc
    order by a.suc
    ";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"27\"><div  align=\"left\">$l1</div> 
        <div  align=\"center\">COMPA&Ntilde;IAS REPORTE DE VENTAS Y UTILIDAD</div></th>
        </tr>
        
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
//total de ventas
$impox1=$impox1+$row->importe1;$impox2=$impox2+$row->importe2;$impox3=$impox3+$row->importe3;$impox4=$impox4+$row->importe4;
$impox5=$impox5+$row->importe5;$impox6=$impox6+$row->importe6;$impox7=$impox7+$row->importe7;$impox8=$impox8+$row->importe8;
$impox9=$impox9+$row->importe9;$impox10=$impox10+$row->importe10;$impox11=$impox11+$row->importe11;$impox12=$impox12+$row->importe12;
$anual=$impox1+$impox2+$impox3+$impox4+$impox5+$impox6+$impox7+$impox8+$impox9+$impox10+$impox11+$impox12;

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
    a.aaa=$aaa and a.suc=$row->suc and a.importe1>0 and a.auxi>10 and auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe2>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe3>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe4>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe5>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe6>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe7>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe8>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe9>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe10>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe11>0 and a.auxi>10 and a.auxi<20
    or a.aaa=$aaa and a.suc=$row->suc and a.importe12>0 and a.auxi>10 and a.auxi<20
    group by a.suc
    order by a.suc
        ";
        $q = $this->db->query($s);   
$ss="SELECT a.*,
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
    a.aaa=$aaa and a.suc=$row->suc and a.importe1>0 and a.auxi>1004 
    or a.aaa=$aaa and a.suc=$row->suc and a.importe2>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe3>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe4>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe5>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe6>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe7>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe8>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe9>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe10>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe11>0 and a.auxi>=1004
    or a.aaa=$aaa and a.suc=$row->suc and a.importe12>0 and a.auxi>=1004
        ";
        $qq = $this->db->query($ss); 
            

$tabla.="<thead>
            <tr bgcolor=\"#D2F7FB\">
            <td align=\"left\" colspan=\"27\"><strong>".$suc."</strong></td>
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
 
<tr bgcolor=\"#C3EDFA\">
<td colspan=\"2\"><strong>TOTAL VENTA</strong></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe1,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe2,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe3,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe4,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe5,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe6,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe7,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe8,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe9,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe10,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe11,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->importe12,2)."</strong></font></td>
<td></td>
<td align=\"right\"><font color=\"black\"><strong> ".number_format($row->anual,2)."</strong></font></td>
<td></td>
</tr>";  
 

foreach($q->result() as $r)
        {
//total utilidad
$impoxu1=$impoxu1+$r->importe1;$impoxu2=$impoxu2+$r->importe2;$impoxu3=$impoxu3+$r->importe3;$impoxu4=$impoxu4+$r->importe4;
$impoxu5=$impoxu5+$r->importe5;$impoxu6=$impoxu6+$r->importe6;$impoxu7=$impoxu7+$r->importe7;$impoxu8=$impoxu8+$r->importe8;
$impoxu9=$impoxu9+$r->importe9;$impoxu10=$impoxu10+$r->importe10;$impoxu11=$impoxu11+$r->importe11;$impoxu12=$impoxu12+$r->importe12;
$anualu=$impoxu1+$impoxu2+$impoxu3+$impoxu4+$impoxu5+$impoxu6+$impoxu7+$impoxu8+$impoxu9+$impoxu10+$impoxu11+$impoxu12;

$impoxxu1=$impoxxu1+$r->importe1;$impoxxu2=$impoxxu2+$r->importe2;$impoxxu3=$impoxxu3+$r->importe3;$impoxxu4=$impoxxu4+$r->importe4;
$impoxxu5=$impoxxu5+$r->importe5;$impoxxu6=$impoxxu6+$r->importe6;$impoxxu7=$impoxxu7+$r->importe7;$impoxxu8=$impoxxu8+$r->importe8;
$impoxxu9=$impoxxu9+$r->importe9;$impoxxu10=$impoxxu10+$r->importe10;$impoxxu11=$impoxxu11+$r->importe11;$impoxxu12=$impoxxu12+$r->importe12;
$anualxxu=$impoxxu1+$impoxxu2+$impoxxu3+$impoxxu4+$impoxxu5+$impoxxu6+$impoxxu7+$impoxxu8+$impoxxu9+$impoxxu10+$impoxxu11+$impoxxu12;

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
            <tr bgcolor=\"#C3EDFA\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL UTILIDAD</font></td>
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
            </tr>
<tr bgcolor=\"#FDF0C7\">
<td colspan=\"27\">DETALLE DE GASTOS</td>
</tr>
<tr bgcolor=\"#FDF0C7\">
<td colspan=\"27\"></td>
</tr>
<tr bgcolor=\"#FDF0C7\">
<td colspan=\"27\"></td>
</tr>
            ";


foreach($qq->result() as $rr)
        {
//total gastos
$impoxg1=$impoxg1+$rr->importe1;$impoxg2=$impoxg2+$rr->importe2;$impoxg3=$impoxg3+$rr->importe3;$impoxg4=$impoxg4+$rr->importe4;
$impoxg5=$impoxg5+$rr->importe5;$impoxg6=$impoxg6+$rr->importe6;$impoxg7=$impoxg7+$rr->importe7;$impoxg8=$impoxg8+$rr->importe8;
$impoxg9=$impoxg9+$rr->importe9;$impoxg10=$impoxg10+$rr->importe10;$impoxg11=$impoxg11+$rr->importe11;$impoxg12=$impoxg12+$rr->importe12;
$anualg=$impoxg1+$impoxg2+$impoxg3+$impoxg4+$impoxg5+$impoxg6+$impoxg7+$impoxg8+$impoxg9+$impoxg10+$impoxg11+$impoxg12;

$impoxxg1=$impoxxg1+$rr->importe1;$impoxxg2=$impoxxg2+$rr->importe2;$impoxxg3=$impoxxg3+$rr->importe3;$impoxxg4=$impoxxg4+$rr->importe4;
$impoxxg5=$impoxxg5+$rr->importe5;$impoxxg6=$impoxxg6+$rr->importe6;$impoxxg7=$impoxxg7+$rr->importe7;$impoxxg8=$impoxxg8+$rr->importe8;
$impoxxg9=$impoxxg9+$rr->importe9;$impoxxg10=$impoxxg10+$rr->importe10;$impoxxg11=$impoxxg11+$rr->importe11;$impoxxg12=$impoxxg12+$rr->importe12;
$anualxxg=$impoxxg1+$impoxxg2+$impoxxg3+$impoxxg4+$impoxxg5+$impoxxg6+$impoxxg7+$impoxxg8+$impoxxg9+$impoxxg10+$impoxxg11+$impoxxg12;
if($row->importe1>0){$por1=(($rr->importe1*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=(($rr->importe2*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=(($rr->importe3*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=(($rr->importe4*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=(($rr->importe5*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=(($rr->importe6*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=(($rr->importe7*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=(($rr->importe8*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=(($rr->importe9*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=(($rr->importe10*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=(($rr->importe11*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=(($rr->importe12*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"white\">
            <td align=\"left\" colspan=\"2\"><font color=\"black\">".$rr->nom."</font></td>
            
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($rr->importe12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"red\"><strong>".number_format($rr->anual,2)."</strong></font></td>
            </tr>";

}

}
if($row->importe1>0){$por1=((($impoxu1-$impoxg1)*100)/$row->importe1);}else{$por1=0;}
if($row->importe2>0){$por2=((($impoxu2-$impoxg2)*100)/$row->importe2);}else{$por2=0;}
if($row->importe3>0){$por3=((($impoxu3-$impoxg3)*100)/$row->importe3);}else{$por3=0;}
if($row->importe4>0){$por4=((($impoxu4-$impoxg4)*100)/$row->importe4);}else{$por4=0;}
if($row->importe5>0){$por5=((($impoxu5-$impoxg5)*100)/$row->importe5);}else{$por5=0;}
if($row->importe6>0){$por6=((($impoxu6-$impoxg6)*100)/$row->importe6);}else{$por6=0;}
if($row->importe7>0){$por7=((($impoxu7-$impoxg7)*100)/$row->importe7);}else{$por7=0;}
if($row->importe8>0){$por8=((($impoxu8-$impoxg8)*100)/$row->importe8);}else{$por8=0;}
if($row->importe9>0){$por9=((($impoxu9-$impoxg9)*100)/$row->importe9);}else{$por9=0;}
if($row->importe10>0){$por10=((($impoxu10-$impoxg10)*100)/$row->importe10);}else{$por10=0;}
if($row->importe11>0){$por11=((($impoxu11-$impoxg11)*100)/$row->importe11);}else{$por11=0;}
if($row->importe12>0){$por12=((($impoxu12-$impoxg12)*100)/$row->importe12);}else{$por12=0;}
$tabla.="
            <tr bgcolor=\"#D6F0FB\">
            <td align=\"left\"><font color=\"black\"></font></td>
            <td align=\"left\"><font color=\"black\">TOTAL GANACIA</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu1-$impoxg1,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu2-$impoxg2,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por2,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu3-$impoxg3,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por3,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu4-$impoxg4,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por4,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu5-$impoxg5,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por5,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu6-$impoxg6,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por6,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu7-$impoxg7,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por7,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu8-$impoxg8,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por8,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu9-$impoxg9,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por9,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu10-$impoxg10,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu11-$impoxg11,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($impoxu12-$impoxg12,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">%".number_format($por12,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($anualu-$anualg,2)."</font></td>
            </tr>";
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
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL UTILIDAD</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualxxu,2)."</strong></font></td>
<td></td>
</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GASTOS</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxg12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"red\"> <strong>".number_format($anualxxg,2)."</strong></font></td>
<td></td>
</tr>

</tr>
<tr bgcolor=\"#CEE4FA\">
<td colspan=\"2\"><strong>TOTAL GANACIAS</strong></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu1-$impoxxg1,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu2-$impoxxg2,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu3-$impoxxg3,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu4-$impoxxg4,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu5-$impoxxg5,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu6-$impoxxg6,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu7-$impoxxg7,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu8-$impoxxg8,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu9-$impoxxg9,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu10-$impoxxg10,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu11-$impoxxg11,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($impoxxu12-$impoxxg12,2)."</font></td>
<td></td>
<td align=\"right\"><font color=\"black\"> ".number_format($anualxxu-$anualxxg,2)."</font></td>
<td></td> 
</tr>       
</table>";        
        echo $tabla;
    
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tipo, fecha, orden, prv, id_user, id, fechai, fac, cxp
     function agrega_member_ctl($tipo,$prv)
     {
         $id_user= $this->session->userdata('id');
         $nivel= $this->session->userdata('nivel');
        $ss="select *From catalogo.provedor where prov=$prv";
        $qq=$this->db->query($ss);
        $rr=$qq->row();
        
         $new_member_insert_data = array(
            'tipo'  =>$tipo,
            'prv'   =>$prv,
            'prvx'   =>$rr->corto,
            'tipo3' =>'A',
            'nivel' =>$nivel,
            'fecha' =>date('Y-m-d H:i:s'),
            'id_user'=>$id_user
		);
		$insert = $this->db->insert('almacen.compra_ctl', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
     }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function folio_orden_a()
    {
    $nivel= $this->session->userdata('nivel');
    $sql="select b.nombre, a.*from almacen.compra_ctl a 
    left join catalogo.cat_almacenes_local b on b.tipo=a.tipo
    where a.nivel=$nivel and tipo3='A'";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>PEDIDOS</strong></th>
        </tr>
        <tr>
        <th><strong>CERRAR</strong></th>
        <th><strong>ALMACEN</strong></th>
        <th><strong>PRV</strong></th>
        <th><strong>PROVEEDOR</strong></th>
        <th><strong>FECHA</strong></th>
        <th><strong>DETALLE</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
 $l1 = anchor('mercadotecnia/tabla_genera_detalle/'.$row->id.'/'.$row->prv, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));; 
 $l2 = anchor('mercadotecnia/cerrar_ctl/'.$row->id.'/'.$row->prv, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));;
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$l2."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->prv."</td>
            <td align=\"left\"> ".$row->prvx."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$l1."</td>
            
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE PEDIDOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function agrega_member_det($id_cc,$cod,$can,$costo)
     {
         $id_user= $this->session->userdata('id');
         $nivel= $this->session->userdata('nivel');
         $s="select *from catalogo.cat_saba where ean=$cod";
         $q=$this->db->query($s);
         $ss="select *from almacen.compra_det where cod=$cod and id_cc=$id_cc";
         $qq=$this->db->query($ss);
         if($q->num_rows()>0 and $qq->num_rows()==0){
         $r=$q->row();   
         
         $new_member_insert_data = array(
            'id_cc'  =>$id_cc,
            'cod'   =>$cod,
            'descri'=>$r->descripcion,
            'can'   =>$can,
            'costo' =>$costo,
            'id_user'=>$id_user,
            'cerrado'=>'A'
		);
		$insert = $this->db->insert('almacen.compra_det', $new_member_insert_data);
        }     
     }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function folio_orden_d($id_cc,$prv)
    {
    $nivel= $this->session->userdata('nivel');
    $sql="select a.*from almacen.compra_det a 
    where a.id_cc=$id_cc order by id desc";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>DETALLE DE PEDIDO</strong></th>
        </tr>
        <tr>
        <th><strong>Codigo</strong></th>
        <th><strong>Descripcion</strong></th>
        <th><strong>Piezas</strong></th>
        <th><strong>Costo</strong></th>
        <th><strong>Importe</strong></th>
        <th><strong>Borrar</strong></th>
        </tr>
        </thead>
        ";
        $num=0;$totcosto=0;
        foreach($query->result() as $row)
        {
$l1= $l1 = anchor('mercadotecnia/borrar_det/'.$id_cc.'/'.$prv.'/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));; 

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->cod."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\"> ".$row->can."</td>
            <td align=\"right\">".number_format($row->costo,2)."</td>
             <td align=\"right\">".number_format(($row->can*$row->costo),2)."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
$num=$num+1;
$totcosto=$totcosto+($row->can*$row->costo);
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\"><strong>$ ".number_format($totcosto,2)."</strong></td>
<td></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function busca_productoo($cod)
	{
		$sql = "SELECT ean, descripcion FROM CATALOGO.CAT_SABA where descripcion like '%$cod%'";
        $query = $this->db->query($sql);
        $tabla = "<option value=\"-\">Selecciona un Producto</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->ean."\">".$row->descripcion." - ".$row->ean."</option>
            ";
        }
        
        return $tabla;
	}

/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
function borrar_member_det($id)
     {
          $this->db->delete('almacen.compra_det', array('id' => $id));
     }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function valida_member_ctl($id_cc)
     {
         $id_user= $this->session->userdata('id');
         $nivel= $this->session->userdata('nivel');
         
         $ss="select *from almacen.compra_det where  id_cc=$id_cc";
         $qq=$this->db->query($ss);
         if($qq->num_rows() > 0){
         $s="select *from catalogo.foliador1 where clav='osi'";
         $q=$this->db->query($s);
         $r=$q->row();
         $fol=($r->num)+1;
        $datac = array(
        'tipo3'     => 'C',
        'folprv'     => $fol,
        'fecha'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_cc);
        $this->db->update('almacen.compra_ctl', $datac);
        $datad = array(
        'cerrado'     => 'C',
        'fecha'=> date('Y-m-d H:i')
        );
        $this->db->where('id_cc', $id_cc);
        $this->db->update('almacen.compra_det', $datad);
        $dataf = array(
        'num'     => $fol
        );
        $this->db->where('clav', 'osi');
        $this->db->update('catalogo.foliador1', $dataf);
        }     
     }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function folio_orden_c()
    {
    $nivel= $this->session->userdata('nivel');
    $sql="select b.nombre, a.*from almacen.compra_ctl a 
    left join catalogo.cat_almacenes_local b on b.tipo=a.tipo
    where a.nivel=$nivel and tipo3='C'";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>ALMACEN</strong></th>
        <th><strong>ORDEN</strong></th>
        <th><strong>PRV</strong></th>
        <th><strong>PROVEEDOR</strong></th>
        <th><strong>FECHA</strong></th>
        <th><strong>IMP</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
 $l1 = anchor('mercadotecnia/imprime_ped/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));; 
 
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->folprv."</td>
            <td align=\"left\">".$row->prv."</td>
            <td align=\"left\"> ".$row->prvx."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$l1."</td>
            
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"7\"><strong>TOTAL DE PEDIDOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_orden($id_cc)
    {
        $sql = "SELECT a.*,b.nombre as almacen FROM almacen.compra_ctl a 
        left join catalogo.cat_almacenes_local b on b.tipo=a.tipo
        where a.id= ?";
        $query = $this->db->query($sql,array($id_cc));
         return $query;  
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function folio_orden_i($id_cc,$prv)
    {
    $nivel= $this->session->userdata('nivel');
    $sql="select a.*from almacen.compra_det a 
    where a.id_cc=$id_cc order by id desc";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"7\" align=\"center\"><strong>DETALLE DE PEDIDO</strong></th>
        </tr>
        <tr>
        <th><strong>Codigo</strong></th>
        <th><strong>Descripcion</strong></th>
        <th><strong>Piezas</strong></th>
        <th><strong>Costo</strong></th>
        <th><strong>Importe</strong></th>
        <th><strong>Borrar</strong></th>
        </tr>
        </thead>
        ";
        $num=0;$totcosto=0;
        foreach($query->result() as $row)
        {
$l1= $l1 = anchor('mercadotecnia/borrar_det/'.$id_cc.'/'.$prv.'/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));; 

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->cod."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\"> ".$row->can."</td>
            <td align=\"right\">".number_format($row->costo,2)."</td>
             <td align=\"right\">".number_format(($row->can*$row->costo),2)."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
$num=$num+1;
$totcosto=$totcosto+($row->can*$row->costo);
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
<td colspan=\"1\"><strong>$ ".number_format($totcosto,2)."</strong></td>
<td></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////






















































































}

