<?php
class Compras_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cat_generico()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.almacen where sec>=1 and sec<=2000";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
        <th>SEC</th>
        <th>CODIGO</th>
        <th>PRODUCTO</th>
        <th>PROVEEDOR</th>
        <th>COSTO</th>
        <th>GEN</th>
        <th>DDR</th>
        </tr>

        </thead>
        <tbody>
        ";
        
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->tsec=='G'){$color='blue';}else{$color='black';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->tsec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa1."<br /> ".$r->susa2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prv."<br /> ".$r->prvx."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vtagen,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vtaddr,2)."</font></td>
            
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
     function cat_fenix()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from desarrollo.catbackoffice order by linea,descripcion";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>LINEA</th>
        <th>CODIGO</th>
        <th>PRODUCTO</th>
        <th>PRECIO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $color='black';
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
             $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$r->linea."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->ean."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descripcion."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->precio,2)."</font></td>
            
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function cat_suc()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.sucursal where suc>100 and suc<=2000 and tlid=1 order by tipo2,suc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>DIRECCION</th>
        <th>POBLACION</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $color='black';
        foreach($q->result() as $r)
        {
if($r->tipo2=='F'){$tipo='FENIX';$color='blue';}
if($r->tipo2=='G'){$tipo='GENERICAS';$color='black';}
if($r->tipo2=='D'){$tipo='DOCTOR DESCUENTO';$color='green';}            
		$num=$num+1;
             $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$tipo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->suc."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->dire."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->pobla."</font></td>
            
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
   function cat_nat()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.sec,b.* from catalogo.cat_naturistas a
        left join catalogo.almacen b on a.sec=b.sec";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
        <th>SEC</th>
        <th>CODIGO</th>
        <th>PRODUCTO</th>
        <th>PROVEEDOR</th>
        <th>COSTO</th>
        <th>GEN</th>
        <th>DDR</th>
        </tr>

        </thead>
        <tbody>
        ";
        
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->tsec=='G'){$color='blue';}else{$color='black';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->tsec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa1."<br /> ".$r->susa2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prv."<br /> ".$r->prvx."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vtagen,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vtaddr,2)."</font></td>
            
            </tr>
            ";
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_ped_formulado()
    {
        
        $sql = "SELECT  fecg FROM pedido_formulado_resp group by fecg";
        $query = $this->db->query($sql);
        
        $fec = array();
        $fec[0] = "Selecciona una fecha";
        
        foreach($query->result() as $row){
            $fec[$row->fecg] =$row->fecg;
        }
        
        
        return $fecg;  
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ped_formulado_ceros($fec1,$fec2)
    {
        $aaa=date('Y')-1;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  a.sec,descri,sum(vta)as vta,sum(inv)as inv,sum(exc)as exc, count(suc)as suc,sum(ped)as ped,b.inv1
FROM pedido_formulado_resp a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec
where
suc<>1600 and suc<>175 and suc<>1601 and suc<>1602 and suc<>1603 and suc<>176 and suc<>177
and suc<>178 and suc<>179 and suc<>180 and suc<>181 and suc<>187 and inv=0 and fecg>='$fec1' and fecg<='$fec2'and vta>0
group by sec
order by vta desc";   
        $q = $this->db->query($s);
$l1 = anchor('compras/tabla_ped_formulados_ceros_exporta/'.$fec1.'/'.$fec2, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));   $l2 = anchor('compras/tabla_ped_formulados_ceros_suc/'.$fec1.'/'.$fec2, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"9\">$l1 PEDIDOS GENERADOS DE SUCURSALES QUE TRASMITEN $fec1 AL $fec2  CON INVENTARIO EN CEROS $l2</th>
        </tr>
        <tr>
        <th>#</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>DESPLAZAMIENTO <br />$aaa</th>
        <th>PEDIDO</th>
        <th>INV EN SUCURSAL</th>
        <th>EXCEDENTE</th>
        <th>NUMERO DE SUCURSALES</th>
        <th>INV CEDIS</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->inv1>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descri."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vta,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->exc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->suc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv1,0)."</font></td>
            
            </tr>
            ";
          $pedtot=$pedtot+$r->inv1;  
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ped_formulado_ceros_suc($fec1,$fec2)
    {
        $aaa=date('Y')-1;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  a.suc,c.nombre as sucx,descri,sum(vta)as vta,sum(inv)as inv,sum(exc)as exc, count(a.sec)as num,sum(ped)as ped,b.inv1
FROM pedido_formulado_resp a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec
left join catalogo.sucursal c on c.suc=a.suc
where
a.suc<>1600 and a.suc<>175 and a.suc<>1601 and a.suc<>1602 and a.suc<>1603 and a.suc<>176 and a.suc<>177
and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181 and a.suc<>187 and inv=0 and fecg>='$fec1' and fecg<='$fec2' and vta>0
group by a.suc
order by vta desc";   
        $q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"9\"> PEDIDOS GENERADOS DE SUCURSALES QUE TRASMITEN  AL $fec2 CON INVENTARIO EN CEROS </th>
        </tr>
        <tr>
        <th>#</th>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>DESPLAZAMIENTO <br />$aaa</th>
        <th>PEDIDO</th>
        <th>INV EN SUCURSAL</th>
        <th>EXCEDENTE</th>
        <th>NUMERO DE PRODUCTOS EN CEROS</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
$l1 = anchor('compras/tabla_ped_formulados_ceros_suc_una/'.$fec1.'/'.$fec2.'/'.$r->suc, $r->sucx.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));       
            
		$num=$num+1;
         $color='black';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->suc."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vta,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->exc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->num,0)."</font></td>
            
            </tr>
            ";
          $pedtot=$pedtot+$r->inv1;  
        }
         $tabla.="
        </tbody>
        </table>";
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ped_formulado_ceros_suc_una($fec1,$fec2,$suc)
    {
        $aaa=date('Y')-1;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  a.fecg,descri,vta,inv,exc, a.sec,ped,inv_cedis
FROM pedido_formulado_resp a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec
where
a.suc<>1600 and a.suc<>175 and a.suc<>1601 and a.suc<>1602 and a.suc<>1603 and a.suc<>176 and a.suc<>177
and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181 and a.suc<>187 and inv=0 and fecg>='$fec1' and fecg<='$fec2' and vta>0 and suc=$suc

order by vta desc";   
        $q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"9\"> PEDIDO GENERADO DE LA SUCURSAL DEL $fec1 AL $fec2 CON INVENTARIO EN CEROS </th>
        </tr>
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>SEC</th>
        <th>DESCRIPCION</th>
        <th>DESPLAZAMIENTO <br />$aaa</th>
        <th>PEDIDO</th>
        <th>INV EN SUCURSAL</th>
        <th>EXCEDENTE</th>
        <th>INV_CEDIS<br />DE LA TRANSM.</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
		$num=$num+1;
         $color='black';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"orange\">".$r->fecg."</font></td>
            <td align=\"left\"><font color=\"orange\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descri."</font></td>
            
            <td align=\"right\"><font color=\"$color\">".number_format($r->vta,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->exc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv_cedis,0)."</font></td>
            
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ped_formulado_ceros_exporta($fec1,$fec2)
    {
        $aaa=date('Y')-1;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  a.suc,c.nombre as sucx,a.sec,descri,vta,inv,exc, ped ,b.inv1
FROM pedido_formulado_resp a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec
left join catalogo.sucursal c on c.suc=a.suc
where
a.suc<>1600 and a.suc<>175 and a.suc<>1601 and a.suc<>1602 and a.suc<>1603 and a.suc<>176 and a.suc<>177
and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181 and a.suc<>187 and inv=0 and fecg>='$fec1' and fecg<='$fec2' and vta>0
order by a.suc,vta desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"9\">PEDIDOS GENERADOS DE SUCURSALES QUE TRASMITEN $fec1 and $fec2 CON INVENTARIO EN CEROS</th>
        </tr>
        <tr>
        <th>#</th>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>DESPLAZAMIENTO <br />$aaa</th>
        <th>PEDIDO</th>
        <th>INV EN SUCURSAL</th>
        <th>EXCEDENTE</th>
        <th>INV CEDIS</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->inv1>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->suc."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descri."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vta,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->exc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv1,0)."</font></td>
            
            </tr>
            ";
  
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ped_formulado_exc($fec)
    {
        $aaa=date('Y')-1;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  a.sec,descri,sum(vta)as vta,sum(inv)as inv,sum(exc)as exc, count(suc)as suc,sum(ped)as ped,b.inv1
FROM pedido_formulado_resp a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec
where
suc<>1600 and suc<>175 and suc<>1601 and suc<>1602 and suc<>1603 and suc<>176 and suc<>177
and suc<>178 and suc<>179 and suc<>180 and suc<>181 and suc<>187 and exc>0 and fecg='$fec'
group by sec
order by vta desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"9\">PEDIDOS GENERADOS DE SUCURSALES QUE TRASMITEN $fec CON INVENTARIO EN EXCEDENTES</th>
        </tr>
        <tr>
        <th>#</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>DESPLAZAMIENTO <br />$aaa</th>
        <th>PEDIDO</th>
        <th>INV EN SUCURSAL</th>
        <th>EXCEDENTE</th>
        <th>NUMERO DE SUCURSALES</th>
        <th>INV CEDIS</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->inv1>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descri."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->vta,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->exc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->suc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv1,0)."</font></td>
            
            </tr>
            ";
          $pedtot=$pedtot+$r->inv1;  
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ped_formulado_todo($fec)
    {
        $aaa=date('Y')-1;
        $aaax=date('Y');
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT c.tipo as clasifica, a.sec,descri,sum(promact)as promact,sum(promant)as promant,sum(inv)as inv,sum(exc)as exc, count(suc)as suc,sum(ped)as ped,b.inv1
FROM pedido_formulado_resp a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where
suc<>1600 and suc<>175 and suc<>1601 and suc<>1602 and suc<>1603 and suc<>176 and suc<>177
and suc<>178 and suc<>179 and suc<>180 and suc<>181 and suc<>187 and fecg='$fec'
group by sec
order by promact desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"10\">PEDIDOS GENERADOS DE SUCURSALES QUE TRARMITEN $fec TODO</th>
        </tr>
        <tr>
        <th>#</th>
        <th>SEC</th>
        <th>CLASIF</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>PROMEDIO<br />$aaa</th>
        <th>PROMEDIO<br />$aaax</th>
        <th>PEDIDO</th>
        <th>INV EN SUCURSAL</th>
        <th>EXCEDENTE</th>
        <th>INV CEDIS</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
            //<td align=\"right\"><font color=\"$color\">".number_format($r->suc,0)."</font></td>
		$num=$num+1;
         if($r->inv1>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->clasifica."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descri."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->promant,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->promact,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->exc,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv1,0)."</font></td>
            
            </tr>
            ";
          $pedtot=$pedtot+$r->inv1;  
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function previo_orden_cedis($aaa1,$mes1,$dia1,$aaa,$mes,$di1,$di2,$di3,$di4)
    {
$venta='ventaa'.$mes;
$fectran=$aaa1.str_pad($mes1,2,"0",STR_PAD_LEFT).str_pad($dia1,2,"0",STR_PAD_LEFT);
$s1="insert into almacen.compra_for_cedis (fecha, sec, desplaza, transito, inv_cedis, pedido, prv, prvx, costo,fectran,por,mesdes)
(select date(now()),sec,0,0,0,0,0,'',0,$fectran,0,$mes from catalogo.sec_generica WHERE SEC>0 and sec<=2000)";
$this->db->query($s1);

$s1x="update almacen.compra_for_cedis a, catalogo.cat_almacen_clasifica b
set por=
case
when tipo='a' then '$di1'
when tipo='b' then '$di2'
when tipo='c' then '$di3'
when tipo='d' then '$di4'
else
0
end
where a.sec=b.sec
";
$this->db->query($s1x);    

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
set a.desplaza=$venta
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
set maxi=cast(desplaza*(por) as signed) ";
$this->db->query($s9);    
$s10="update almacen.compra_for_cedis
set maxi=cast(desplaza*(por) as signed) where maxi=0";
$this->db->query($s10);    
$s11="update almacen.compra_for_cedis
set pedido=cast(maxi-(inv_cedis+transito) as signed)
";
$this->db->query($s11);    
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function pre_orden_cedis_pediente()
{
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT fecha,sum(pedido*costo)as impor FROM almacen.compra_for_cedis where pedido>0 group by fecha";   
        $q = $this->db->query($s);
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"12\">PRE ORDEN DE COMPRA PARA EL ALMACEN CENTRAL</th>
        </tr>
        <tr>
        <th>#</th>
        <th>FECHA QUE SE GENERO</th>
        <th>IMPORTE</th>
        <th></th>
        </tr>

        </thead>
        <tbody>
        ";
        $num=0;
         foreach($q->result() as $r)
        {
            $l1 = anchor('compras/tabla_ord_bor/'.$r->fecha,'BORRAR</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
 	        $l2 = anchor('compras/tabla_orden_cedis_previo/'.$r->fecha,'VER DETALLE</a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
            $l3 = anchor('compras/tabla_orden_cedis_previo_g/'.$r->fecha,'GENERA LAS ORDENES</a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
     	$num=$num+1;
         $color='blue';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->fecha."<br />".$l2."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($r->impor,2)."<br />$l1</font></td>
            <td align=\"right\"><font color=\"$color\">$l3</font></td>
            
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        return $tabla;
    }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function delete_orr_cedis_pre($fecha)
    {
      $this->db->delete('almacen.compra_for_cedis', array('fecha' => $fecha));
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function pre_orden_cedis()
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT b.susa1, a.* FROM almacen.compra_for_cedis a
left join catalogo.almacen b on b.sec=a.sec
where tsec='G' group by sec order by pedido desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"12\">PRE ORDEN DE COMPRA PARA EL ALMACEN CENTRAL</th>
        </tr>
        <tr>
        <th>#</th>
        <th>FECHA DE PROCESO</th>
        <th>FECHA DE TRANSITO</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>DESPLAZAMIENTO</th>
        <th>MAXIMO</th>
        <th>TRANSITO</th>
        <th>PEDIDO</th>
        <th>INV_CEDIS</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>COSTO</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
         $ss="select *from catalogo.cat_almacen_clasifica where sec=$r->sec;";
         $qq=$this->db->query($ss);
         if($qq->num_rows()>0){
         $rr=$qq->row();
         $tipo=$rr->tipo;
         }else{$tipo='';}
		$num=$num+1;
         if($r->pedido>0){$color='red';}else{$color='blue';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->fecha."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->fectran."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."<br />".$tipo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->desplaza,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->maxi,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->transito,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->pedido,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv_cedis,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->prv,0)."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prvx."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->costo,2)."</font></td>
            
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        echo $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function genera_pre_orden($fecha)
{
$aaa=date('Y');
$mes=date('m');
$dia=date('d');
$s12="insert into almacen.pedido1(tipo, sec, can, metro)
(select 'alm',sec,pedido,0 from almacen.compra_for_cedis where pedido>0 and descon='N' and fecha='$fecha')
on duplicate key update can=values(can)";
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
values($num,'A','alm',$aaa,$mes,$dia,1,'LE',0)on duplicate key update persona=values(persona)";
$this->db->query($sx10);
$sx11="delete from almacen.pedido1";
$this->db->query($sx11);
$sx11="insert into almacen.compra_for_cedis_res(fecha, sec, desplaza, transito, inv_cedis, pedido, prv, prvx, costo, descon, maxi, nped,fectran,por,mesdes)
(select fecha, sec, desplaza, transito, inv_cedis, pedido, prv, prvx, costo, descon, maxi, $num,fectran,por,mesdes from almacen.compra_for_cedis)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);
$sx11="delete from almacen.compra_for_cedis where fecha='$fecha'";
$this->db->query($sx11);
$s14="update catalogo.foliador set num=$num+1 where clav='alm'";
$this->db->query($s14); 
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function compraped_cedis()
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT aaap,mesp,diap,nped, 
        sum((cans+cansbo+metrom)*costo)as importe 
        from almacen.compraped where tipo='alm' and nped>1000000 and nped<=19999999 and tipo3='B'
        group by nped order by aaap desc, mesp desc, diap desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"12\">ORDEN DE COMPRA PARA EL ALMACEN CENTRAL</th>
        </tr>
        <tr>
        <th>#</th>
        <th>FECHA DE PROCESO</th>
        <th>FOLIO DE PRE-ORDEN</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
        $l1 = anchor('compras/tabla_compraped_det/'.$r->nped,$r->nped.'</a>', array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));
        $fec=$r->aaap.'-'.str_pad($r->mesp,2,"0",STR_PAD_LEFT).'-'.str_pad($r->diap,2,"0",STR_PAD_LEFT);
		$num=$num+1;
         $color='blue';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$fec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        <tr>
            
             </tr>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function compraped_cedis_det($nped)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT aaap,mesp,diap,nped,prv,prvx, sum(cans)as cans, sum(metrom)as metrom,sum(cansbo)as cansbo,
        sum((cans+cansbo+metrom)*costo)as importe 
        from almacen.compraped 
        where tipo='alm' and nped>1000000 and nped<=19999999 and tipo3='B' and nped=$nped
        group by prv order by prvx";   
        $q = $this->db->query($s);
$l2 = anchor('compras/tabla_compraped_imprime/'.$nped,'IMPRIME FOLIO</a>', array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));        
$num=0;
        $tabla= "
        <table cellpadding=\"1\" border=\"1\">
        <thead>
        
        <tr>
        <th COLSPAN=\"12\" align=\"center\">ORDEN DE COMPRA PARA EL ALMACEN CENTRAL FOLIO $nped</th>
        </tr>
        <tr>
        <th>#</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>CEDIS</th>
        <th>FARMABODEGA</th>
        <th>METRO</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        $totimp=0;
         foreach($q->result() as $r)
        {
        $l1 = anchor('compras/tabla_compraped_det_prv/'.$nped.'/'.$r->prv,$r->prv.'</a>', array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));
        $fec=$r->aaap.'-'.str_pad($r->mesp,2,"0",STR_PAD_LEFT).'-'.str_pad($r->diap,2,"0",STR_PAD_LEFT);
		$num=$num+1;
         $color='blue';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prvx."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cans,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cansbo,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->metrom,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            </tr>            ";
            $totimp=$totimp+($r->importe);
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"7\"><font color=\"red\">TOTAL ".number_format($totimp,2)."</font></td>
          </tr>    
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function compraped_cedis_det_prv($nped,$prv)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT ((cans+cansbo+metrom)*costo) as importe, a.* from almacen.compraped a where tipo3='B' and nped=$nped and prv=$prv
        order by sec";   
        $q = $this->db->query($s);
$l2 = anchor('compras/tabla_compraped_imprime/'.$nped,'IMPRIME FOLIO</a>', array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));        
$num=0;
        $tabla= "
        <table cellpadding=\"1\" border=\"1\">
        <thead>
        
        <tr>
        <th COLSPAN=\"12\" align=\"center\">ORDEN DE COMPRA PARA EL ALMACEN CENTRAL FOLIO $nped</th>
        </tr>
        <tr>
        <th>#</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>COSTO</th>
        <th>CEDIS</th>
        <th>FARMABODEGA</th>
        <th>METRO</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        $totimp=0;
         foreach($q->result() as $r)
        {
        $num=$num+1;
         $color='blue';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prvx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($r->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cans,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cansbo,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->metrom,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            
            </tr>
            ";
         $totimp=$totimp+($r->importe);
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"10\"><font color=\"red\">TOTAL ".number_format($totimp,2)."</font></td>
          </tr>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function compraped_entrega($tipo,$fec1,$fec2,$tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $aaa1=substr($fec1,0,4);
        $mes1=substr($fec1,5,2);
        $dia1=substr($fec1,8,2);
        $aaa2=substr($fec2,0,4);
        $mes2=substr($fec2,5,2);
        $dia2=substr($fec2,8,2);
        $sx="update almacen.compraped a, desarrollo.compra_d_orden_sec b
set a.aplica=b.can
where a.folprv=b.orden and a.sec=b.sec and a.sec>0 and a.tipo='alm'";
 $this->db->query($sx);
        $s="SELECT prv,prvx, sum(cans)as cans,sum(costo*cans)as importe,
        sum(aplica)as aplica,sum(costo*aplica)as aplica_importe,
        sum(cansbo)as cansbo,sum(cansbo*costo)as importe_bo,
        sum(aplica_bo)as aplica_bo,sum(aplica_bo*costo)as aplica_bo_importe 
        FROM almacen.compraped 
        where  cans>0 and tipo='$tipo' and tipo3='C' and aaae>=$aaa1 and mese>=$mes1 and diae>=$dia1
        and    cans>0 and tipo='$tipo' and tipo3='C' and aaae<=$aaa2 and mese<=$mes2 and diae<=$dia2
          group by prv";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th COLSPAN=\"13\">LLEGADO DE MERCANCIA DEL ".$fec1."<font color=\"RED\"> al </font>".$fec2."</th>
        </tr>
        <tr>
        <th>#</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>PIEZAS<br />CEDIS</th>
        <th>IMPORTE<br />CEDIS</th>
        <th>LLEGO<br />CEDIS</th>
        <th>IMP.LLEGO<br />CEDIS</th>
        <th>% SURTIDO<br />CEDIS</th>
        <th>PIEZAS<br />FARMABODEGA</th>
        <th>IMPORTE<br />FARMABODEGA</th>
        <th>LLEGO<br />FARMABODEGA</th>
        <th>IMP.LLEGO<br />FARMABODEGA</th>
        <th>% SURTIDO<br />FARMABODEGA</th>
        </tr>

        </thead>
        <tbody>
        ";
        $tot1=0;
        $tot2=0;
        $tot3=0;
        $tot4=0;
        $tot5=0;
        $tot6=0;
        $tot7=0;
        $tot8=0;
        
         foreach($q->result() as $r)
        {
        if($r->cans==$r->aplica){$por1=100;}
        if($r->cans>$r->aplica){$por1=(($r->aplica*100)/$r->cans);}
        if($r->cans>0 and $r->aplica==0){$por1=0;}
        if($r->cansbo==$r->aplica_bo){$por2=100;}
        if($r->cansbo>$r->aplica_bo){$por2=(($r->aplica_bo*100)/$r->cansbo);}
        if($r->cansbo>0 and $r->aplica_bo==0){$por2=0;}
        $l1 = anchor('compras/tabla_compraped_detprv/'.$r->prv.'/'.$fec1.'/'.$fec2.'/'.$tipo,$r->prvx.'</a>', array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));
        
		$num=$num+1;
         $color='blue';
         $color2='green';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cans,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->aplica,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->aplica_importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">% ".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->cansbo,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->importe_bo,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->aplica_bo,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->aplica_bo_importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">% ".number_format($por2,2)."</font></td>
            
            </tr>
            ";
        $tot1=$tot1+($r->cans);
        $tot2=$tot2+($r->importe);
        $tot3=$tot3+($r->aplica);
        $tot4=$tot4+($r->aplica_importe);
        $tot5=$tot5+($r->cansbo);
        $tot6=$tot6+($r->importe_bo);
        $tot7=$tot7+($r->aplica_bo);
        $tot8=$tot8+($r->aplica_bo_importe);
        }
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
            <td align=\"left\" colspan=\"3\"><font color=\"$color\">TOTAL</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\"></font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot5,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot6,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot7,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot8,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\"></font></td>
            </tr>
            </tfoot>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function compraped_entrega_prv_detalle($prv,$tipo,$fec1,$fec2,$tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $aaa1=substr($fec1,0,4);
        $mes1=substr($fec1,5,2);
        $dia1=substr($fec1,8,2);
        $aaa2=substr($fec2,0,4);
        $mes2=substr($fec2,5,2);
        $dia2=substr($fec2,8,2);
        
        $s="SELECT aaae,mese,folprv,diae,sec,susa,prv,prvx, (cans)as cans,(costo*cans)as importe,
        (aplica)as aplica,(costo*aplica)as aplica_importe,
        (cansbo)as cansbo,(cansbo*costo)as importe_bo,
        (aplica_bo)as aplica_bo,(aplica_bo*costo)as aplica_bo_importe 
        FROM almacen.compraped 
        where  cans>0 and tipo='$tipo' and tipo3='C' and aaae>=$aaa1 and mese>=$mes1 and diae>=$dia1 and prv=$prv
        and    cans>0 and tipo='$tipo' and tipo3='C' and aaae<=$aaa2 and mese<=$mes2 and diae<=$dia2 and prv=$prv
         ";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
         <tr>
        <th COLSPAN=\"15\">LLEGADO DE MERCANCIA DEL ".$fec1."<font color=\"RED\"> al </font>".$fec2."</th>
        </tr>
        <tr>
        <th>#</th>
        <th>FEC DE ORDEN</th>
        <th># DE ORDEN</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
         <th>PIEZAS<br />CEDIS</th>
        <th>IMPORTE<br />CEDIS</th>
        <th>LLEGO<br />CEDIS</th>
        <th>IMP.LLEGO<br />CEDIS</th>
        <th>% SURTIDO<br />CEDIS</th>
        <th>PIEZAS<br />FARMABODEGA</th>
        <th>IMPORTE<br />FARMABODEGA</th>
        <th>LLEGO<br />FARMABODEGA</th>
        <th>IMP.LLEGO<br />FARMABODEGA</th>
        <th>% SURTIDO<br />FARMABODEGA</th>
        </tr>

        </thead>
        <tbody>
        ";
        $tot1=0;
        $tot2=0;
        $tot3=0;
        $tot4=0;
        $tot5=0;
        $tot6=0;
        $tot7=0;
        $tot8=0;
        $por1=0;
        $por2=0;
         foreach($q->result() as $r)
        {
        $fec=$r->aaae.'-'.str_pad($r->mese,2,"0",STR_PAD_LEFT).'-'.str_pad($r->diae,2,"0",STR_PAD_LEFT);
        if($r->cans==$r->aplica){$por1=100;}
        if($r->cans>$r->aplica){$por1=(($r->aplica*100)/$r->cans);}
        if($r->cans>0 and $r->aplica==0){$por1=0;}
        if($r->cansbo==$r->aplica_bo){$por2=100;}
        if($r->cansbo>$r->aplica_bo){$por2=(($r->aplica_bo*100)/$r->cansbo);}
        if($r->cansbo>0 and $r->aplica_bo==0){$por2=0;}
        
        
		$num=$num+1;
         $color='blue';
         $color2='green';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$fec."</font></td>
            <td align=\"left\"><font color=\"orange\">".$r->folprv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cans,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->aplica,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->aplica_importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">% ".number_format($por1,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->cansbo,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->importe_bo,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->aplica_bo,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($r->aplica_bo_importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">% ".number_format($por2,2)."</font></td>
            
            </tr>
            ";
        $tot1=$tot1+($r->cans);
        $tot2=$tot2+($r->importe);
        $tot3=$tot3+($r->aplica);
        $tot4=$tot4+($r->aplica_importe);
        $tot5=$tot5+($r->cansbo);
        $tot6=$tot6+($r->importe_bo);
        $tot7=$tot7+($r->aplica_bo);
        $tot8=$tot8+($r->aplica_bo_importe);
        }
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
            <td align=\"left\" colspan=\"5\"><font color=\"$color\">TOTAL</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\"></font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot5,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot6,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot7,0)."</font></td>
            <td align=\"right\"><font color=\"$color2\">".number_format($tot8,2)."</font></td>
            <td align=\"right\"><font color=\"$color2\"></font></td>
            </tr>
            </tfoot>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function compraped_entrega_segpop($tipo,$fec1,$fec2,$tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $aaa1=substr($fec1,0,4);
        $mes1=substr($fec1,5,2);
        $dia1=substr($fec1,8,2);
        $aaa2=substr($fec2,0,4);
        $mes2=substr($fec2,5,2);
        $dia2=substr($fec2,8,2);
        
        $s="SELECT a.prv,a.prvx, sum(a.cans)as cans,sum(a.costo*a.cans)as importe,
sum(b.aplica) as llego,sum(a.costo*b.aplica) as llego_importe
         FROM almacen.compraped a
         left join almacen.compraped_l_folprv_claves b on b.folprv=a.folprv and a.claves=b.claves  and a.tipo=b.tipo
        where  a.cans>0 and a.tipo='$tipo' and a.tipo3='C' and a.aaae>=$aaa1 and a.mese>=$mes1 and a.diae>=$dia1
        and    a.cans>0 and a.tipo='$tipo' and a.tipo3='C' and a.aaae<=$aaa2 and a.mese<=$mes2 and a.diae<=$dia2
          group by a.prv";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th COLSPAN=\"13\">LLEGADO DE MERCANCIA DEL ".$fec1."<font color=\"RED\"> al </font>".$fec2."</th>
        </tr>
        <tr>
        <th>#</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>PIEZAS</th>
        <th>IMPORTE</th>
        <th>LLEGO</th>
        <th>IMP.LLEGO</th>
        <th>% SURTIDO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $por1=0;
        $tot1=0;
        $tot2=0;
        $tot3=0;
        $tot4=0;
         foreach($q->result() as $r)
        {
        
        if($r->cans==$r->llego){$por1=100;}
        if($r->cans > $r->llego){$por1=(($r->llego*100)/$r->cans);}
        if($r->cans > 0 and $r->llego==0){$por1=0;}
       $l1 = anchor('compras/tabla_compraped_detprv/'.$r->prv.'/'.$fec1.'/'.$fec2.'/'.$tipo,$r->prvx.'</a>', array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));
        
		$num=$num+1;
         $color='blue';
         $color2='green';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cans,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->llego,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->llego_importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">% ".number_format($por1,2)."</font></td>
             
            </tr>
            ";
        $tot1=$tot1+($r->cans);
        $tot2=$tot2+($r->importe);
        $tot3=$tot3+($r->llego);
        $tot4=$tot4+($r->llego_importe);
        
        }
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
            <td align=\"left\" colspan=\"3\"><font color=\"$color\">TOTAL</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\"></font></td>
            </tr>
        </tfoot>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function compraped_entrega_segpop_prv($prv,$tipo,$fec1,$fec2,$tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $aaa1=substr($fec1,0,4);
        $mes1=substr($fec1,5,2);
        $dia1=substr($fec1,8,2);
        $aaa2=substr($fec2,0,4);
        $mes2=substr($fec2,5,2);
        $dia2=substr($fec2,8,2);
        
        $s="SELECT a.aaae,a.mese,a.diae,a.folprv,a.susa,a.claves,a.prv,a.prvx, sum(a.cans)as cans,sum(a.costo*a.cans)as importe,
(b.aplica) as llego,(a.costo*b.aplica) as llego_importe
         FROM almacen.compraped a
         left join almacen.compraped_l_folprv_claves b on b.folprv=a.folprv and a.claves=b.claves and a.tipo=b.tipo
        where  a.cans>0 and a.tipo='$tipo' and a.tipo3='C' and a.aaae>=$aaa1 and a.mese>=$mes1 and a.diae>=$dia1 and a.prv=$prv
        and    a.cans>0 and a.tipo='$tipo' and a.tipo3='C' and a.aaae<=$aaa2 and a.mese<=$mes2 and a.diae<=$dia2 and a.prv=$prv
        group by a.folprv,a.claves
        order by a.folprv,a.claves";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th COLSPAN=\"13\">LLEGADO DE MERCANCIA DEL ".$fec1."<font color=\"RED\"> al </font>".$fec2."</th>
        </tr>
        <tr>
        <th>#</th>
        <th># DE ORDEN</th>
        <th>FEC DE ORDEN</th>
        <th>CLAVE</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>PIEZAS</th>
        <th>IMPORTE</th>
        <th>LLEGO</th>
        <th>IMP.LLEGO</th>
        <th>% SURTIDO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $por1=0;
        $tot1=0;
        $tot2=0;
        $tot3=0;
        $tot4=0;
         foreach($q->result() as $r)
        {
        $fec=$r->aaae.'-'.str_pad($r->mese,2,"0",STR_PAD_LEFT).'-'.str_pad($r->diae,2,"0",STR_PAD_LEFT);
        if($r->cans==$r->llego){$por1=100;}
        if($r->cans > $r->llego){$por1=(($r->llego*100)/$r->cans);}
        if($r->cans > 0 and $r->llego==0){$por1=0;}
        
		$num=$num+1;
         $color='blue';
         $color2='green';   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$fec."</font></td>
            <td align=\"left\"><font color=\"orange\">".$r->folprv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->claves."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cans,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->llego,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->llego_importe,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">% ".number_format($por1,2)."</font></td>
             
            </tr>
            ";
        $tot1=$tot1+($r->cans);
        $tot2=$tot2+($r->importe);
        $tot3=$tot3+($r->llego);
        $tot4=$tot4+($r->llego_importe);
        
        }
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
            <td align=\"left\" colspan=\"5\"><font color=\"$color\">TOTAL</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($tot4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\"></font></td>
            </tr>
        </tfoot>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function inv_cedis()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.inv1 from catalogo.almacen a 
        left join inv_cedis_sec1 b on a.sec=b.sec
        where a.sec>=1 and a.sec<=2000 and a.tsec='G' group by a.sec";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
        <th>SEC</th>
        <th>PRODUCTO</th>
        <th>EXISTENCIA</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->inv1>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->tsec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa1."<br /> ".$r->susa2."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv1,0)."</font></td>
            
            </tr>
            ";
          $pedtot=$pedtot+$r->inv1;  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"5\"><font color=\"blue\">".number_format($pedtot,0)."</font></td>
             </tr>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function inv_genddr()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.inv from catalogo.almacen a 
        left join inv_genddr b on a.sec=b.sec
        where a.sec>=1 and a.sec<=2000 group by a.sec";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TIPO</th>
        <th>SEC</th>
        <th>PRODUCTO</th>
        <th>EXISTENCIA</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->inv>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->tsec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa1."<br /> ".$r->susa2."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            
            </tr>
            ";
          $pedtot=$pedtot+$r->inv;  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"5\"><font color=\"blue\">".number_format($pedtot,0)."</font></td>
             </tr>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function inv_farmabodega()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.cantidad from catalogo.almacen a 
        left join  farmabodega.inventario_d_clave b on a.clabo=b.clave
        where a.maxbo>0 group by a.clabo";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        
        <th>CLAVE</th>
        <th>PRODUCTO</th>
        <th>PROVEEDOR</th>
        <th>MAXIMO</th>
        <th>EXISTENCIA</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0; 
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->cantidad>0){$color='blue';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->clabo."</font></td>
            
            <td align=\"left\"><font color=\"$color\">".$r->susa1."<br /> ".$r->susa2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prv."<br /> ".$r->prvx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->maxbo."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cantidad,0)."</font></td>
            
            </tr>
            ";
         $pedtot=$pedtot+$r->cantidad;  
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"6\"><font color=\"blue\">".number_format($pedtot,0)."</font></td>
             </tr>
        </table>";
        
        return $tabla;
    
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function inv_segpop()
    {
        $aaa=date('Y');$mes=date('m');
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.maxi,b.pedido,b.inv 
        from almacen.inventario_c a
        left join almacen.inventario_d_tipofol b on b.tipo=a.tipo and b.folio=a.folio 
        where a.aaa=$aaa and a.mes=$mes and b.inv>0 order by a.tipo desc,a.aaa desc,a.mes desc,a.dia desc
        ";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        
        <th>SEGURO POPULAR</th>
        <th>A&Ntilde;O-MES</th>
        <th>FOLIO</th>
        <th>MAXIMO</th>
        <th>INVENTARIO</th>
        <th>PEDIDO</th>
        <th></th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0; 
        $color='black';
         foreach($q->result() as $r)
        {
          $l1 = anchor('compras/tabla_inv_segpop_d/'.$r->tipo.'/'.$r->folio,'DETALLE'.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));   
		$num=$num+1;
         if($r->tipo=='zac'){$tipo='ZACATECAS';}
         if($r->tipo=='ver'){$tipo='VERACRUZ';}
         if($r->tipo=='cht'){$tipo='CHETUMAL';}
         if($r->tipo=='con'){$tipo='CONTROLADOS';}
         if($r->tipo=='agu'){$tipo='AGUASCALIENTES';}
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$tipo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->aaa."-".$r->mes."-".$r->dia."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->folio."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->maxi,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->pedido,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">$l1</font></td>
             </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function inv_segpop_d($tipo,$folio)
    {
        $aaa=date('Y');$mes=date('m');
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select * from almacen.inventario_d
        where tipo='$tipo' and folio=$folio order by persona, costo desc
        ";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        
        <th>CLAVE</th>
        <th>PRODUCTO</th>
        <th>COSTO</th>
        <th>MAXIMO</th>
        <th>INVENTARIO</th>
        <th>PEDIDO</th>
        <th></th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot=0; 
        $color='black';
         foreach($q->result() as $r)
        {
           
		$num=$num+1;
         
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->claves."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->maxi,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->pedido,0)."</font></td>
           <td align=\"right\"><font color=\"$color\">".number_format($r->pedido*$r->costo,2)."</font></td>
             </tr>
            ";
        $pedtot=$pedtot+($r->pedido*$r->costo);
        }
         $tabla.="
        </tbody>
        <tr>
           <td align=\"right\" colspan=\"8\"><font color=\"$color\">".number_format($pedtot,2)."</font></td>
             </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function des_genddr()
    {
 $var='producto_mes_sec'.(date('y')-1);
 $aaax=(date('Y')-1);
 $mes=date('m');
 if($mes==01){$m=1;}elseif($mes==02){$m=2;}elseif($mes==03){$m=3;}elseif($mes==04){$m=4;}elseif($mes==05){$m=5;}
 elseif($mes==06){$m=6;}elseif($mes==07){$m=7;}elseif($mes==08){$m=8;}elseif($mes==09){$m=9;}elseif($mes>=10){$m=$mes;}
 $valu='venta'.$m;
 $valux='ventaa'.$m;
 
 
 
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  b.susa1,c.inv1,a.*,aa.*,(((aa.$valux-a.$valu)*1)-(inv1+can))as valuo,
(can)as inv,
total
FROM vtadc.producto_mes_sec a 
 left join vtadc.$var aa on aa.sec=a.sec
left join catalogo.sec_generica b on b.sec=a.sec
 left join inv_cedis_sec1 c on a.sec=c.sec
left join desarrollo.inv_codigo_sec d on d.sec=a.sec
 where  a.sec>0 group by a.sec order by total desc"; 


        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        <th>TOTAL</th>
        <th>INV.CEDIS</th>
        <th>INV.FARM</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot1=0;
        $pedtot2=0;
        $pedtot3=0;
        $pedtot4=0;
        $pedtot5=0;
        $pedtot6=0;
        $pedtot7=0;
        $pedtot8=0;
        $pedtot9=0;
        $pedtot10=0;
        $pedtot11=0;
        $pedtot12=0;
         foreach($q->result() as $r)
        {
 $sx="SELECT  *from catalogo.almacen_borrar where sec=$r->sec"; 
        $qx = $this->db->query($sx);
if($qx->num_rows()== 1){$color='red';}else{$color='black';}                   
		$num=$num+1;
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"13\"><font color=\"$color\">".$r->sec." ".$r->susa1."</font></td>
            <td align=\"left\" colspan=\"13\"><font color=\"$color\">SUGERIDO A COMPRA</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->valuo,0)."</font></td>
            </tr>
            <tr>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,0)."</font></td>
            <td align=\"right\"><font color=\"'blue'\">".number_format($r->total,0)."</font></td>
            <td align=\"right\"><font color=\"'blue'\">".number_format($r->inv1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            </tr>
            <tr>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa1,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa2,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa3,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa4,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa5,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa6,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa7,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa8,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa9,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa10,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa11,0)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($r->ventaa12,0)."</font></td>
            <td align=\"right\"><font color=\"'green'\">".number_format($r->totala,0)."</font></td>
            <td align=\"right\" colspan=\"2\"><font color=\"'green'\">DESPLAZAMIENTO $aaax</font></td>
            
            
            
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr>
            ";
          $pedtot1=$pedtot1+$r->venta1;
          $pedtot2=$pedtot2+$r->venta2;
          $pedtot3=$pedtot3+$r->venta3;
          $pedtot4=$pedtot4+$r->venta4;
          $pedtot5=$pedtot5+$r->venta5;
          $pedtot6=$pedtot6+$r->venta6;
          $pedtot7=$pedtot7+$r->venta7;
          $pedtot8=$pedtot8+$r->venta8;
          $pedtot9=$pedtot9+$r->venta9;
          $pedtot10=$pedtot10+$r->venta10;
          $pedtot11=$pedtot11+$r->venta11;
          $pedtot12=$pedtot12+$r->venta12;
        }
         $tabla.="
        </tbody>
         <tr>
        
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        <th></th>
        <th></th>
        <th></th>
        </tr>
        <tr>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot1,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot2,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot3,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot4,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot5,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot6,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot7,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot8,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot9,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot10,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot11,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot12,0)."</font></td>
            
            
             </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function des_genddr_compra_cedis()
    {
 $var='producto_mes_sec'.(date('y')-1);
 $aaax=(date('Y')-1);
 $mes=date('m');
 if($mes==01){$m=1;}elseif($mes==02){$m=2;}elseif($mes==03){$m=3;}elseif($mes==04){$m=4;}elseif($mes==05){$m=5;}
 elseif($mes==06){$m=6;}elseif($mes==07){$m=7;}elseif($mes==08){$m=8;}elseif($mes==09){$m=9;}elseif($mes>=10){$m=$mes;}
 $valu='venta'.$m;
 $valux='ventaa'.$m;
 
 
 
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT cc.prv,.cc.prvx,cc.costo,aa.$valux as ventaa, a.$valu as venta, b.susa1,c.inv1,a.*,aa.*,(((aa.$valux-a.$valu)*1.5)-(inv1+can))as valuo,
(can)as inv,
total
FROM vtadc.producto_mes_sec a 
 left join vtadc.$var aa on aa.sec=a.sec
left join catalogo.sec_generica b on b.sec=a.sec
left join inv_cedis_sec1 c on a.sec=c.sec
left join catalogo.almacen cc on a.sec=cc.sec and cc.tsec='G'
left join desarrollo.inv_codigo_sec d on d.sec=a.sec
 where  a.sec>0 and (((aa.$valux-a.$valu)*1)-(inv1+can))>0 order by cc.prv"; 


        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        
        <th>PRODUCTO</th>
        <th>VTA ANT $mes</th>
        <th>VTA ACT $mes</th>
        <th>INV.CEDIS</th>
        <th>INV.FARM</th>
        <th>SUG.COMPRA</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>COSTO</th>
        <th>COMPRA</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot1=0;
        $pedtot2=0;
        $pedtot3=0;
        $pedtot4=0;
        $pedtot5=0;
        $pedtot6=0;
        $pedtot7=0;
        $pedtot8=0;
        $pedtot9=0;
        $pedtot10=0;
        $pedtot11=0;
        $pedtot12=0;
        $color='black';
         foreach($q->result() as $r)
        {
		$num=$num+1;
        $sx="SELECT  *from catalogo.almacen_borrar where sec=$r->sec"; 
        $qx = $this->db->query($sx);
if($qx->num_rows()== 0){     
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"1\"><font color=\"$color\">".$r->sec." ".$r->susa1."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->ventaa,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta,0)."</font></td>
            <td align=\"right\"><font color=\"'blue'\">".number_format($r->inv1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->inv,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->valuo,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->prv,0)."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->prvx."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format(($r->costo*$r->valuo),2)."</font></td>
           </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr>
            ";
          $pedtot1=$pedtot1+$r->valuo;
          $pedtot2=$pedtot2+($r->costo*$r->valuo);
          
        }}
         $tabla.="
        </tbody>
         
        <tr>
            <td align=\"right\" colspan=\"5\"><font color=\"blue\">TOTAL</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot1,0)."</font></td>
            <td align=\"right\" colspan=\"3\"><font color=\"blue\"></font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot2,0)."</font></td>
             </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function des_genddr_pesos()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT  a.sec,b.susa1,
sum(importe1)as venta1,
sum(importe2)as venta2,
sum(importe3)as venta3,
sum(importe4)as venta4,
sum(importe5)as venta5,
sum(importe6)as venta6,
sum(importe7)as venta7,
sum(importe8)as venta8,
sum(importe9)as venta9,
sum(importe10)as venta10,
sum(importe11)as venta11,
sum(importe12)as venta12,
totalimp
FROM vtadc.producto_mes_sec a 
left join catalogo.sec_generica b on b.sec=a.sec
where  a.sec>0 group by a.sec order by total desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" stlyle=\" font-size: xx-small;\">
        <thead>
        
        <tr>
        
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot1=0;
        $pedtot2=0;
        $pedtot3=0;
        $pedtot4=0;
        $pedtot5=0;
        $pedtot6=0;
        $pedtot7=0;
        $pedtot8=0;
        $pedtot9=0;
        $pedtot10=0;
        $pedtot11=0;
        $pedtot12=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->totalimp>0){$color='black';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"13\"><font color=\"$color\">".$r->sec." ".$r->susa1."</font></td>
            </tr>
            <tr>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,2)."</font></td>
            <td align=\"right\"><font color=\"'blue'\">".number_format($r->totalimp,2)."</font></td>
            
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr>
            ";
          $pedtot1=$pedtot1+$r->venta1;
          $pedtot2=$pedtot2+$r->venta2;
          $pedtot3=$pedtot3+$r->venta3;
          $pedtot4=$pedtot4+$r->venta4;
          $pedtot5=$pedtot5+$r->venta5;
          $pedtot6=$pedtot6+$r->venta6;
          $pedtot7=$pedtot7+$r->venta7;
          $pedtot8=$pedtot8+$r->venta8;
          $pedtot9=$pedtot9+$r->venta9;
          $pedtot10=$pedtot10+$r->venta10;
          $pedtot11=$pedtot11+$r->venta11;
          $pedtot12=$pedtot12+$r->venta12;
        }
         $tabla.="
        </tbody>
         <tr>
        
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        <th>TOTAL</th>
        </tr>
        <tr>
           
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot1,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot2,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot3,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot4,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot5,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot6,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot7,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot8,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot9,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot10,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot11,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot12,2)."</font></td>
            
            
             </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function des_fenix()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT a.sec, a.codigo,b.descripcion,
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
sum(venta12)as venta12,
sum(can)as inv,
sum(venta1+venta2+venta3+venta4+venta5+venta6+venta7+venta8+venta9+venta10+venta11+venta12)as total
FROM vtadc.producto_mes a 
left join catbackoffice b on b.ean=a.codigo
left join desarrollo.inv_codigo_sec d on d.codigo=a.codigo
where a.sec=0 and a.codigo<>9144221209277 group by a.sec , a.codigo order by inv desc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        <th>TOTAL</th>
        <th>INV.FARM</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot1=0;
        $pedtot2=0;
        $pedtot3=0;
        $pedtot4=0;
        $pedtot5=0;
        $pedtot6=0;
        $pedtot7=0;
        $pedtot8=0;
        $pedtot9=0;
        $pedtot10=0;
        $pedtot11=0;
        $pedtot12=0;
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
         if($r->total>0){$color='black';}else{$color='red';}   
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"13\"><font color=\"$color\">".$r->codigo." ".$r->descripcion."</font></td>
            </tr>
            <tr>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,0)."</font></td>
            <td align=\"right\"><font color=\"'blue'\">".number_format($r->total,0)."</font></td>
            <td align=\"right\"><font color=\"'blue'\">".number_format($r->inv,0)."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr>
            ";
          $pedtot1=$pedtot1+$r->venta1;
          $pedtot2=$pedtot2+$r->venta2;
          $pedtot3=$pedtot3+$r->venta3;
          $pedtot4=$pedtot4+$r->venta4;
          $pedtot5=$pedtot5+$r->venta5;
          $pedtot6=$pedtot6+$r->venta6;
          $pedtot7=$pedtot7+$r->venta7;
          $pedtot8=$pedtot8+$r->venta8;
          $pedtot9=$pedtot9+$r->venta9;
          $pedtot10=$pedtot10+$r->venta10;
          $pedtot11=$pedtot11+$r->venta11;
          $pedtot12=$pedtot12+$r->venta12;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot1,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot2,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot3,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot4,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot5,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot6,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot7,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot8,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot9,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot10,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot11,0)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot12,0)."</font></td>
            
            
             </tr>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function fal_sec()
    {
 $var='producto_mes_suc_sec'.(date('y')-1);
 $aaax=(date('Y')-1);
 $mes=date('m');
 if($mes==01){$m=1;}elseif($mes==02){$m=2;}elseif($mes==03){$m=3;}elseif($mes==04){$m=4;}elseif($mes==05){$m=5;}
 elseif($mes==06){$m=6;}elseif($mes==07){$m=7;}elseif($mes==08){$m=8;}elseif($mes==09){$m=9;}elseif($mes>=10){$m=$mes;}
 $valu='venta'.$m;
 $valux='venta'.$m;
 
 
 
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="SELECT a.fechai,a.tipo ,a.sec,a.descripcion,count(a.suc)as num,sum(perdida)as piezas, sum(perdida*venta)as perdida,
         sum(perdida*costo)as gasto
FROM vtadc.producto_semana_ceros a
left join catalogo.sucursal b on b.suc=a.suc
where perdida>0
group by a.sec order by perdida desc
"; 


        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th  colspan=\"8\" align=\"center\">EVALUACION DE FALTANTES EN FARMACIAS CON HISTORICO DE DESPLAZAMIENTO</th>
        </tr>
        <tr>
        <th>FECHA</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>SUCURSALES CON FALTANTE</th>
        <th>PIEZAS</th>
        <th>$ PERDIDA EN VENTA</th>
        <th>$ GASTO EN COSTO</th>
        <th>$ UTILIDAD PERDIDA</th>
        </tr>

        </thead>
        <tbody>
        ";
        $pedtot1=0;
        $pedtot2=0;
        $pedtot3=0;
        $pedtot4=0;
        $pedtot5=0;
        $pedtot6=0;
        $pedtot7=0;
        $pedtot8=0;
        $pedtot9=0;
        $pedtot10=0;
        $pedtot11=0;
        $pedtot12=0;
         foreach($q->result() as $r)
        {
 $sx="SELECT  *from catalogo.almacen_borrar where sec=$r->sec"; 
        $qx = $this->db->query($sx);
if($qx->num_rows()== 1){$color='red';}else{$color='black';}                   
		$num=$num+1;
            
            $tabla.="
            <tr>
            <td align=\"center\" colspan=\"1\"><font color=\"$color\">".$r->fechai."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\" colspan=\"1\"><font color=\"$color\"> ".$r->descripcion."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->num,0)."</font></td>
            
            <td align=\"right\"><font color=\"$color\">".number_format($r->piezas,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->perdida,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->gasto,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format(($r->perdida-$r->gasto),2)."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr>
            ";
          $pedtot1=$pedtot1+$r->piezas;
          $pedtot2=$pedtot2+$r->perdida;
          $pedtot3=$pedtot3+$r->gasto;
          $pedtot4=$pedtot4+($r->perdida-$r->gasto);
          
        }
         $tabla.="
        </tbody>
         
        <tr>
            <td align=\"right\" colspan=\"3\"><font color=\"$color\">TOTAL</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot1,0)."</font></td>
            <td align=\"right\" colspan=\"2\"><font color=\"blue\">".number_format($pedtot2,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot3,2)."</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"blue\">".number_format($pedtot4,2)."</font></td>
             </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function control_suc_cam()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.sec,
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
sum(venta12)as venta12,
can
from catalogo.suc_campana a
left join vtadc.producto_mes_suc b on a.nid=b.suc
left join desarrollo.inv_campana_suc c on c.nid=a.nid
left join catalogo.cat_almacen_clasifica d on d.sec=b.sec
where b.sec>0 and b.sec<=2000  and d.sec is not null 
group by suc";   
        $q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"17\"> DETALLE DE VENTA E INVENTARIO</th>
        </tr>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
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
        </tr>

        </thead>
        <tbody>
        ";
        
  $color='black';
        foreach($q->result() as $r)
        {
         $l1 = anchor('compras/tabla_cat_campa_una/'.$r->nid, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));   
		$num=$num+1;
             $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">$l1 ".$r->nid."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nombre."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->can,0)."</font></td>
            
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function control_suc_cam_tod()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        
        $s="SELECT a.*,b.sec,b.descripcion,c.cantidad,
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
from catalogo.suc_campana a
left join vtadc.producto_mes_suc b on a.nid=b.suc
left join desarrollo.suc_compa_sec c on c.nid=a.nid and b.sec=c.sec
left join catalogo.cat_almacen_clasifica d on d.sec=b.sec
where b.sec>0 and b.sec<=2000 and d.sec is not null 
group by suc,sec";   
$q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th colspan=\"17\"> DETALLE DE VENTA E INVENTARIO</th>
        </tr>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
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
        </tr>

        </thead>
        <tbody>
        ";
        
  $color='black';
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
             $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$r->nid."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descripcion."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cantidad,0)."</font></td>
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
     function control_suc_cam_una($suc)
    {
        
               $numinv=0;$renglon=0;$renglon2=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
       
        $s="select *from catalogo.cat_almacen_clasifica where tipo<'d' order by tipo";   
$q = $this->db->query($s);

 $tabla = "<table border=\"1\">
        <tr>
        <th colspan=\"17\"> DETALLE DE VENTA E INVENTARIO</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Clasificacion</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
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
        </tr>
";
$t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;$ti=0;
$num=1;
foreach($q->result() as $r)
{
$s1x="select  sec,sum(venta1)as venta1,sum(venta2)as venta2,sum(venta3)as venta3,sum(venta4)as venta4,sum(venta5)as venta5,
sum(venta6)as venta6,sum(venta7)as venta7,sum(venta8)as venta8,sum(venta9)as venta9,sum(venta10)as venta10,sum(venta11)as venta11,
sum(venta12)as venta12 from vtadc.producto_mes_suc12 where suc=$suc  and sec=$r->sec group by sec";   
$q1x = $this->db->query($s1x);

if($q1x->num_rows()==1){
$r1x = $q1x->row();
$ventaa01=$r1x->venta1;$ventaa02=$r1x->venta2;$ventaa03=$r1x->venta3;$ventaa04=$r1x->venta4;$ventaa05=$r1x->venta5;$ventaa06=$r1x->venta6;
$ventaa07=$r1x->venta7;$ventaa08=$r1x->venta8;$ventaa09=$r1x->venta9;$ventaa10=$r1x->venta10;$ventaa11=$r1x->venta11;$ventaa12=$r1x->venta12;
}else{
$ventaa01=0;$ventaa02=0;$ventaa03=0;$ventaa04=0;$ventaa05=0;$ventaa06=0;$ventaa07=0;$ventaa08=0;$ventaa09=0;$ventaa10=0;$ventaa11=0;$ventaa12=0;
}
$s1="select  sec,sum(venta1)as venta1,sum(venta2)as venta2,sum(venta3)as venta3,sum(venta4)as venta4,sum(venta5)as venta5,
sum(venta6)as venta6,sum(venta7)as venta7,sum(venta8)as venta8,sum(venta9)as venta9,sum(venta10)as venta10,sum(venta11)as venta11,
sum(venta12)as venta12 from vtadc.producto_mes_suc where suc=$suc  and sec=$r->sec group by sec";   
$q1 = $this->db->query($s1);

if($q1->num_rows()==1){
$r1 = $q1->row();
$venta01=$r1->venta1;$venta02=$r1->venta2;$venta03=$r1->venta3;$venta04=$r1->venta4;$venta05=$r1->venta5;$venta06=$r1->venta6;
$venta07=$r1->venta7;$venta08=$r1->venta8;$venta09=$r1->venta9;$venta10=$r1->venta10;$venta11=$r1->venta11;$venta12=$r1->venta12;
}else{
$venta01=0;$venta02=0;$venta03=0;$venta04=0;$venta05=0;$venta06=0;$venta07=0;$venta08=0;$venta09=0;$venta10=0;$venta11=0;$venta12=0;
}
$s2="select suc,sec,sum(cantidad)as cantidad  from desarrollo.inv where suc=$suc and sec=$r->sec group by sec;";   
$q2 = $this->db->query($s2);
if($q2->num_rows()==1){
$r2 = $q2->row();
$inv=$r2->cantidad;    
}else{
$inv=0;
}
if($r->tipo=='a'){$color='blue';}elseif($r->tipo=='b'){$color='green';}
 $tabla.="
           <tr>
             <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"center\"><font color=\"$color\">".$r->tipo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta01,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta02,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta03,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta04,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta05,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta06,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta07,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta08,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta09,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta12,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($inv,0)."</font></td>
            </tr>
            <tr>
             <td align=\"left\"><font color=\"orange\"</font></td>
            <td align=\"center\"><font color=\"orange\"></font></td>
            <td align=\"left\"><font color=\"orange\"></font></td>
            <td align=\"right\"><font color=\"orange\">A&ntilde;o anterior de la clave $r->sec</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa01,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa02,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa03,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa04,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa05,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa06,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa07,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa08,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa09,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa10,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa11,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa12,0)."</font></td>
            <td align=\"right\"><font color=\"orange\"></font></td>
            </tr>
            </tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr>
            ";
 $t01=$t01+$venta01;
 $t02=$t02+$venta02;
 $t03=$t03+$venta03;
 $t04=$t04+$venta04;
 $t05=$t05+$venta05;
 $t06=$t06+$venta06;
 $t07=$t07+$venta07;
 $t08=$t08+$venta08;
 $t09=$t09+$venta09;
 $t10=$t10+$venta10;
 $t11=$t11+$venta11;
 $t12=$t12+$venta12;
 $ti=$ti+$inv;
 $num=$num+1;
 if($inv==0){$numinv=$numinv+1;}if($numinv>0){$porce=round((($numinv*100)/$num),2);}else{$porce=0;}

if(date('m')==1){$varv=$ventaa01;$varv2=($ventaa01/2);}
if(date('m')==2){$varv=$ventaa02;$varv2=($ventaa02/2);}
if(date('m')==3){$varv=$ventaa03;$varv2=($ventaa03/2);}
if(date('m')==4){$varv=$ventaa04;$varv2=($ventaa04/2);}
if(date('m')==5){$varv=$ventaa05;$varv2=($ventaa05/2);}
if(date('m')==6){$varv=$ventaa06;$varv2=($ventaa06/2);}
if(date('m')==7){$varv=$ventaa07;$varv2=($ventaa07/2);}
if(date('m')==8){$varv=$ventaa08;$varv2=($ventaa08/2);}
if(date('m')==9){$varv=$ventaa09;$varv2=($ventaa09/2);}
if(date('m')==10){$varv=$ventaa10;$varv2=($ventaa10/2);}
if(date('m')==11){$varv=$ventaa11;$varv2=($ventaa11/2);}
if(date('m')==12){$varv=$ventaa12;$varv2=($ventaa12/2);}
 if($varv > $inv){$renglon=$renglon+1;}if($renglon>0){$porcer=round((($renglon*100)/$num),2);}else{$porcer=0;}
 if($varv2 > $inv){$renglon2=$renglon2+1;}if($renglon2>0){$porcer2=round((($renglon2*100)/$num),2);}else{$porcer2=0;}

        }
         $tabla.="
        <tr>
         <td align=\"right\" colspan=\"4\"><font color=\"black\">TOTAL</font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t01,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t02,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t03,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t04,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t05,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t06,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t07,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t08,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t09,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t10,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t11,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t12,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($ti,0)."</strong></font></td>
        </tr>
        <tr>
        <td colspan=\"17\">Productos inv_ceros.......................: $numinv ______ % $porce</td>
        </tr>
        
        <tr>
        <td colspan=\"17\">Productos en desabasto a 15 dias..: $renglon2 ______ % $porcer2</td>
        </tr>
        <tr>
        <td colspan=\"17\">Productos en desabasto a 1 mes....: $renglon ______ % $porcer</td>
        </tr>
        </table>";
        
        echo $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function control_suc_cam_ab()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.sec,
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
from catalogo.suc_campana a
left join vtadc.producto_mes_suc b on a.nid=b.suc

left join catalogo.cat_almacen_clasifica d on d.sec=b.sec
where b.sec>0 and b.sec<=2000  and d.sec is not null  and d.tipo<'c'
group by suc";   
        $q = $this->db->query($s);
        $l0 = anchor('compras/tabla_cat_campa_todo', '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));  
        $l00 = anchor('compras/tabla_cat_campa_todo0', '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"17\">$l0 DETALLE DE VENTA E INVENTARIO $l00</th>
        </tr>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
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
        
  $color='black';
        foreach($q->result() as $r)
        {
         $l1 = anchor('compras/tabla_cat_campa_una_ab/'.$r->nid, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado','target' => 'blank'));   
		$num=$num+1;
             $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">$l1 ".$r->nid."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nombre."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,0)."</font></td>
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function control_suc_cam_tod_ad()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        
        $s="SELECT a.*,b.sec,b.descripcion,c.cantidad,
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
from catalogo.suc_campana a
left join vtadc.producto_mes_suc b on a.nid=b.suc
left join desarrollo.suc_compa_sec c on c.nid=a.nid and b.sec=c.sec
left join catalogo.cat_almacen_clasifica d on d.sec=b.sec
where b.sec>0 and b.sec<=2000 and d.sec is not null and d.tipo<'c'
group by suc,sec";   
$q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th colspan=\"17\"> DETALLE DE VENTA E INVENTARIO</th>
        </tr>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
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
        </tr>

        </thead>
        <tbody>
        ";
        
  $color='black';
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
             $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$r->nid."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->descripcion."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta1,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta2,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta3,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta4,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta5,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta6,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta7,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta8,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta9,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->venta12,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r->cantidad,0)."</font></td>
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
     function control_suc_cam_una_ab($suc)
    {
        
        $numinv=0;$renglon=0;$renglon2=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
       
        $s="select *from catalogo.cat_almacen_clasifica where tipo<'c' order by tipo";   
$q = $this->db->query($s);

 $tabla = "<table border=\"1\">
        <tr>
        <th colspan=\"17\"> DETALLE DE VENTA E INVENTARIO</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Clasificacion</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
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
        </tr>
";
$t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;$ti=0;
$num=1;
foreach($q->result() as $r)
{
$s1x="select  sec,sum(venta1)as venta1,sum(venta2)as venta2,sum(venta3)as venta3,sum(venta4)as venta4,sum(venta5)as venta5,
sum(venta6)as venta6,sum(venta7)as venta7,sum(venta8)as venta8,sum(venta9)as venta9,sum(venta10)as venta10,sum(venta11)as venta11,
sum(venta12)as venta12 from vtadc.producto_mes_suc12 where suc=$suc  and sec=$r->sec group by sec";   
$q1x = $this->db->query($s1x);

if($q1x->num_rows()==1){
$r1x = $q1x->row();
$ventaa01=$r1x->venta1;$ventaa02=$r1x->venta2;$ventaa03=$r1x->venta3;$ventaa04=$r1x->venta4;$ventaa05=$r1x->venta5;$ventaa06=$r1x->venta6;
$ventaa07=$r1x->venta7;$ventaa08=$r1x->venta8;$ventaa09=$r1x->venta9;$ventaa10=$r1x->venta10;$ventaa11=$r1x->venta11;$ventaa12=$r1x->venta12;
}else{
$ventaa01=0;$ventaa02=0;$ventaa03=0;$ventaa04=0;$ventaa05=0;$ventaa06=0;$ventaa07=0;$ventaa08=0;$ventaa09=0;$ventaa10=0;$ventaa11=0;$ventaa12=0;
}
$s1="select  sec,sum(venta1)as venta1,sum(venta2)as venta2,sum(venta3)as venta3,sum(venta4)as venta4,sum(venta5)as venta5,
sum(venta6)as venta6,sum(venta7)as venta7,sum(venta8)as venta8,sum(venta9)as venta9,sum(venta10)as venta10,sum(venta11)as venta11,
sum(venta12)as venta12 from vtadc.producto_mes_suc where suc=$suc  and sec=$r->sec group by sec";   
$q1 = $this->db->query($s1);

if($q1->num_rows()==1){
$r1 = $q1->row();
$venta01=$r1->venta1;$venta02=$r1->venta2;$venta03=$r1->venta3;$venta04=$r1->venta4;$venta05=$r1->venta5;$venta06=$r1->venta6;
$venta07=$r1->venta7;$venta08=$r1->venta8;$venta09=$r1->venta9;$venta10=$r1->venta10;$venta11=$r1->venta11;$venta12=$r1->venta12;
}else{
$venta01=0;$venta02=0;$venta03=0;$venta04=0;$venta05=0;$venta06=0;$venta07=0;$venta08=0;$venta09=0;$venta10=0;$venta11=0;$venta12=0;
}
$s2="select suc,sec,sum(cantidad)as cantidad  from desarrollo.inv where suc=$suc and sec=$r->sec group by sec;";   
$q2 = $this->db->query($s2);
if($q2->num_rows()==1){
$r2 = $q2->row();
$inv=$r2->cantidad;    
}else{
$inv=0;
}
if($r->tipo=='a'){$color='blue';}elseif($r->tipo=='b'){$color='green';}
 $tabla.="
           <tr>
             <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"center\"><font color=\"$color\">".$r->tipo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta01,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta02,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta03,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta04,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta05,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta06,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta07,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta08,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta09,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta10,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta11,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta12,0)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($inv,0)."</font></td>
            </tr>
            <tr>
             <td align=\"left\"><font color=\"orange\"</font></td>
            <td align=\"center\"><font color=\"orange\"></font></td>
            <td align=\"left\"><font color=\"orange\"></font></td>
            <td align=\"right\"><font color=\"orange\">A&ntilde;o anterior de la clave $r->sec</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa01,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa02,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa03,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa04,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa05,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa06,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa07,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa08,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa09,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa10,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa11,0)."</font></td>
            <td align=\"right\"><font color=\"orange\">".number_format($ventaa12,0)."</font></td>
            <td align=\"right\"><font color=\"orange\"></font></td>
            </tr>
            </tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr>
            ";
 $t01=$t01+$venta01;
 $t02=$t02+$venta02;
 $t03=$t03+$venta03;
 $t04=$t04+$venta04;
 $t05=$t05+$venta05;
 $t06=$t06+$venta06;
 $t07=$t07+$venta07;
 $t08=$t08+$venta08;
 $t09=$t09+$venta09;
 $t10=$t10+$venta10;
 $t11=$t11+$venta11;
 $t12=$t12+$venta12;
 $ti=$ti+$inv;
 $num=$num+1;
 if($inv==0){$numinv=$numinv+1;}if($numinv>0){$porce=round((($numinv*100)/117),2);}else{$porce=0;}

if(date('m')==1){$varv=$ventaa01;$varv2=($ventaa01/2);}
if(date('m')==2){$varv=$ventaa02;$varv2=($ventaa02/2);}
if(date('m')==3){$varv=$ventaa03;$varv2=($ventaa03/2);}
if(date('m')==4){$varv=$ventaa04;$varv2=($ventaa04/2);}
if(date('m')==5){$varv=$ventaa05;$varv2=($ventaa05/2);}
if(date('m')==6){$varv=$ventaa06;$varv2=($ventaa06/2);}
if(date('m')==7){$varv=$ventaa07;$varv2=($ventaa07/2);}
if(date('m')==8){$varv=$ventaa08;$varv2=($ventaa08/2);}
if(date('m')==9){$varv=$ventaa09;$varv2=($ventaa09/2);}
if(date('m')==10){$varv=$ventaa10;$varv2=($ventaa10/2);}
if(date('m')==11){$varv=$ventaa11;$varv2=($ventaa11/2);}
if(date('m')==12){$varv=$ventaa12;$varv2=($ventaa12/2);}
 if($varv > $inv){$renglon=$renglon+1;}if($renglon>0){$porcer=round((($renglon*100)/117),2);}else{$porcer=0;}
 if($varv2 > $inv){$renglon2=$renglon2+1;}if($renglon2>0){$porcer2=round((($renglon2*100)/117),2);}else{$porcer2=0;}

        }
         $tabla.="
        <tr>
         <td align=\"right\" colspan=\"4\"><font color=\"black\">TOTAL</font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t01,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t02,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t03,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t04,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t05,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t06,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t07,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t08,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t09,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t10,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t11,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($t12,0)."</strong></font></td>
         <td align=\"right\"><font color=\"black\"><strong>".number_format($ti,0)."</strong></font></td>
        </tr>
        <tr>
        <td colspan=\"17\">Productos inv_ceros.......................: $numinv ______ % $porce</td>
        </tr>
        
        <tr>
        <td colspan=\"17\">Productos en desabasto a 15 dias..: $renglon2 ______ % $porcer2</td>
        </tr>
        <tr>
        <td colspan=\"17\">Productos en desabasto a 1 mes....: $renglon ______ % $porcer</td>
        </tr>
        </table>";
        
        echo $tabla;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function pagos_pendientes()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s0="SELECT a.archivo,a.prv,b.corto,sum(imp_cheque)as imp_total,
        sum(case when fecha_pago<>'0000-00-00'
        then (imp_cheque)
        else
        0
        end)  as pagado,
        
        sum(case when fecha_pago='0000-00-00' and a.tipo='A' and cheque_real>0
        then (imp_cheque)
        else
        0
        end)  as deuda,
        sum(case when archivo='AU' OR archivo='FN' OR archivo='PM' OR archivo='MZ' OR archivo='PN'
         then imp_cheque else 0 end) as mayorista,
         sum(case when archivo='SE' 
         then imp_cheque else 0 end) as segpop,
         sum(case when archivo='MA' 
         then imp_cheque else 0 end) as directos 
        
        FROM pagos_cheque a 
        left join catalogo.provedor b on b.prov=a.prv
        where a.archivo<>'VR' and fecha_pago='0000-00-00' and a.tipo='A' and cheque_real>0
        group by a.prv order by imp_total desc";   
        $q0 = $this->db->query($s0);

        $s01="SELECT a.prv,b.corto as prvx,sum(imp_cheque)as varios,a.archivo
        FROM pagos_cheque a 
        left join catalogo.provedorv b on b.prov=a.prv
        where a.archivo='VR' and fecha_pago='0000-00-00' and a.tipo='A' and cheque_real>0
        group by a.prv order by varios desc";   
        $q01 = $this->db->query($s01);       
$num=0;$tot=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>PRV</th>
        <th>PROVEDOR</th>
        <th width=\"100\" align=\"left\">MAYORISTA</th>
          <th width=\"100\" align=\"left\">DIRECTOS</th>
          <th width=\"100\" align=\"left\">SEGPOP</th>
          <th width=\"100\" align=\"left\">VARIOS</th>
        <th>IMP. DEUDA<br />ACUMULADA</th>
        <th>PREPAGO</th>
        <th>RESTA</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';$totdeuda=0;$totpagado=0;$totprox=0;$totalprepago=0;
        $totmay=0;
        $totdir=0;
        $totseg=0;
        $totvar=0;
        $ttotmay=0;
        $ttotdir=0;
        $ttotseg=0;
        $ttotvar=0;
        $ttotot=0;$varios=0;
         foreach($q0->result() as $r0)
        {
        $s="select sum(imp_cheque)as imp_cheque from pagos_cheque where prv=$r0->prv  and aplica='s' and archivo<>'vr' ";
        $q=$this->db->query($s);
        if($q->num_rows()>0){$r=$q->row();$prepago=$r->imp_cheque;}else{$prepago=0;}
        $l1 = anchor('compras/tabla_pagos_pendiente_prv/'.$r0->prv.'/'.$r0->archivo, $r0->prv, array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
		$num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r0->corto."</font></td>
            <td width=\"100\" align=\"right\">".number_format($r0->mayorista,2)."</td>
            <td width=\"100\" align=\"right\">".number_format($r0->directos,2)."</td>
            <td width=\"100\" align=\"right\">".number_format($r0->segpop,2)."</td>
            <td width=\"100\" align=\"right\"></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r0->deuda,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($prepago,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r0->deuda-$prepago,2)."</font></td>
            
            </tr>
            ";
         
        $totmay=$totmay+$r0->mayorista;
        $totdir=$totdir+$r0->directos;
        $totseg=$totseg+$r0->segpop;
        $totvar=0;
        
        $ttotmay=$ttotmay+$r0->mayorista;
        $ttotdir=$ttotdir+$r0->directos;
        $ttotseg=$ttotseg+$r0->segpop;
        $ttotvar=0;
         
         $totpagado=$totpagado+$r0->pagado;
         $ttotot=$ttotot+$r0->deuda;
         $totalprepago=$totalprepago+$prepago;
        }
        foreach($q01->result() as $r01)
        {
            $s="select sum(imp_cheque)as imp_cheque from pagos_cheque where prv=$r01->prv  and aplica='s' and archivo='vr' ";
        $q=$this->db->query($s);
        if($q->num_rows()>0){$r=$q->row();$prepagov=$r->imp_cheque;}else{$prepagov=0;}
            $num=$num+1;
            $l1 = anchor('compras/tabla_pagos_pendiente_prv/'.$r01->prv.'/'.$r01->archivo, $r01->prv, array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r01->prvx."</font></td>
            <td width=\"100\" align=\"right\"></td>
            <td width=\"100\" align=\"right\"></td>
            <td width=\"100\" align=\"right\"></td>
            <td width=\"100\" align=\"right\">".number_format($r01->varios,2)."</td>
            <td align=\"right\"><font color=\"$color\">".number_format($r01->varios,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($prepagov,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r01->varios-$prepago,2)."</font></td>
            
            </tr>
            ";
             $totvar=$totvar+$r01->varios;
             $ttotot=$ttotot+$r01->varios;
             $totalprepago=$totalprepago+$prepagov;    
        }
         $tabla.="
          </tbody>
             <tfoot>
        <tr bgcolor=\"#E6E6E6\">
        <td width=\"360\" align=\"right\" colspan=\"3\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totmay,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totdir,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totseg,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totvar,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($ttotot,2)."</strong></td>
         
            <td align=\"right\"><font color=\"$color\">".number_format($totalprepago,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format(($ttotot-$totalprepago),2)."</font></td>
            </tr>
         </tfoot>    
       
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function pagos_pendientes_prv($prv)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s0="SELECT a.*,b.nombre,imp_cheque,
        case when archivo='AU' and fecha_pago='0000-00-00' or archivo='FN' and fecha_pago='0000-00-00' or 
        archivo='MZ' and fecha_pago='0000-00-00'or archivo='PN' and fecha_pago='0000-00-00'
        then imp_cheque
        end as mayorista,
        case when archivo='SE' and fecha_pago='0000-00-00'
        then imp_cheque
        end as segpop,
        case when archivo='MA' and fecha_pago='0000-00-00'
        then imp_cheque
        end as directo,
        case when fecha_pago<>'0000-00-00'
        then imp_cheque
        end pagado,
        case when fecha_pago='0000-00-00'
        then imp_cheque
        end deuda
    
        FROM pagos_cheque a 
        left join catalogo.sucursal b on b.suc=a.suc
        where a.archivo<>'VR' and a.prv=$prv and a.tipo='A' and a.prv=$prv and cheque_real>0
        order by fecha_venci asc";   
        $q0 = $this->db->query($s0);
        
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        
        <thead>
        
        <tr>
        <th>#</th>
        <th colspan=\"1\">STAT</th>
        <th colspan=\"1\">CHEQUE</th>
        <th>SUCURSAL</th>
        <th>FEC.VENCIM.<br />FEC.PAGO</th>
        <th>MAYORISTAS</th>
        <th>DIRECTOS</th>
        <th>SEGPOP</th>
        <th>PRE PAGO</th>
        <th>DEUDA</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$pago=0;
         foreach($q0->result() as $r0)
        {
         
        
        $fin=$l0 = anchor('compras/pre_pagos_pendiente_factura/'.$prv.'/'.$r0->id,$r0->cheque_real, array('title' => 'Haz Click aqui para ver facturas !', 'class' => 'encabezado'));
        
       if($r0->fecha_pago>'0000-00-00'){$color='blue';}else{$color='black';}    
       if($r0->aplica=='S' || $r0->aplica=='s'){$prepago=$r0->imp_cheque;$pago=$pago+$r0->imp_cheque;$color='blue';}
       else{$prepago=0;$color='black';}            
       $s="select *from pagos_cheque_orden where ncheque=$r0->ncheque and cheque_real=$r0->cheque_real and 
       prv=$r0->prv and archivo='$r0->archivo'";
       
       $q=$this->db->query($s);
       if($q->num_rows()>0){$r=$q->row(); 
       $prepagado=$r->imp_cheque;$color='red';}else{$prepagado=0;$color='black';}
        $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l0."<br />".$r0->aplica."</font></td>
            ";
            if($prepagado==0){
            $tabla.="
            <td align='right'><font size='-1'><input name='aplica_$r0->id' type='text' id='aplica_$r0->id' size='5' maxlength='5' value='  ' /></font></td>
            ";}else{
            $tabla.="
            <td align=\"left\"><font color=\"$color\">NO APLICADO EN CXP</font></td>
            ";}
            $tabla.="
            <td align=\"left\"><font color=\"$color\">".$r0->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r0->fecha_venci."<br />".$r0->fecha_pago."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r0->mayorista,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r0->directo,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r0->segpop,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($prepago,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format(($r0->deuda-$prepago),2)."</font></td>
            </tr>
            ";
/////////////////////////////////////////////////////////////////////////////////////factura de cheque
$ss="select * from
pagos_cheque a
left join pago_contrarecibo_cxp c on c.cheque=a.ncheque and a.cia=c.cia and a.prv=c.prv
left join pago_factura_cxp b on b.contra=c.contra  and a.cia=b.cia and a.prv=b.prv
where a.id=$r0->id";
$qq=$this->db->query($ss);
foreach($qq->result() as $rr)
        {
        $tabla.="
            <td align=\"left\"><font color=\"dark orange\"></font></td>
            <td align=\"left\"><font color=\"dark orange\">".$rr->fac."</font></td>
            <td align=\"right\"><font color=\"dark orange\">".number_format(($rr->importe),2)."</font></td>
            </tr>
            ";
        }
////////////////////////////////////////////////////////////////////////////////////            
            
         $tot1=$tot1+$r0->mayorista;
         $tot2=$tot2+$r0->directo;  
         $tot3=$tot3+$r0->segpop; 
         $tot4=$tot4+$prepago;
         $tot5=$tot5+$r0->deuda-($prepago);     
        }
        $fin=$l1 = anchor('compras/pre_pagos_pendiente/'.$prv,'<img src="'.base_url().'img/emoticon_bomb.png" border="0" width="50px" /></a>', array('title' => 'Haz Click aqui Generar pre pago !', 'class' => 'encabezado'));
		
         $tabla.="
         </tbody>
         <tfoot>
         <tr>
            <td align=\"left\" colspan=\"5\"><font color=\"$color\"><strong>TOTAL</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".number_format($tot1,2)."</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".number_format($tot2,2)."</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".number_format($tot3,2)."</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".number_format($tot4,2)."</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".number_format($tot5,2)."</strong></font></td>
            </tr>
            <tr>
            <td align=\"center\" colspan=\"9\"><font color=\"$color\" size=\"+2\"><strong>APLICAR PAGO ".number_format($pago,2)."</strong></font></td>
            <td align=\"left\" colspan=\"1\"><font color=\"$color\"><strong>$fin</strong></font></td>
            </tr>
        </tfoot>
        </table>
        
        <script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"aplica_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_aplica(id, valor);

});

function actualiza_aplica(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/compras/actualiza_status/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}

</script>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function pagos_pendientes_prv_factura($prv,$id,$tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s0="select * from
pagos_cheque a
left join pago_contrarecibo_cxp c on c.cheque=a.ncheque and a.cia=c.cia and a.prv=c.prv
left join pago_factura_cxp b on b.contra=c.contra  and a.cia=b.cia and a.prv=b.prv
where a.id=$id";   
        $q0 = $this->db->query($s0);
        
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th>#</th>
        <th colspan=\"1\">Cia</th>
        <th>Contra-recibo</th>
        <th>Fec.entrega</th>
        <th>Factura</th>
        <th>Importe</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';$timporte=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$pago=0;
         foreach($q0->result() as $r0)
        {
        $cheque=$r0->cheque_real;
        $pago=$r0->imp_cheque;    
        $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r0->cia."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r0->contra."</font></td>
            <td align=\"right\"><font color=\"$color\">".$r0->fecha."</font></td>
            <td align=\"right\"><font color=\"$color\">".$r0->fac."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($r0->importe,2)."</font></td>
            </tr>
            ";
        $timporte=$timporte+$r0->importe;    
             
        }
         $tabla.="
          </tbody>
          <tfoot>  
            <tr>
            <td align=\"center\" colspan=\"6\"><font color=\"$color\" size=\"+2\"><strong>Total  ".number_format($timporte,2)."</strong></font></td>
            </tr>
            <tr>
            <td align=\"center\" colspan=\"6\"><font color=\"$color\" size=\"+2\"><strong>Cheque.....: $cheque ... ".number_format($pago,2)."</strong></font></td>
            </tr>
        </tfoot>
        </table>";
        
      
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function agrega_pago($prv,$fec)
{
  $s="insert ignore into desarrollo.pagos_cheque_orden(cia, suc, prv, ncheque, ciache, fecha_venci, imp_cheque, cheque_real, imp_iva, cheque_pago, fecha_pago, tipo, archivo, id, aplica, pre_pago, audita)
  (select cia, suc, prv, ncheque, ciache, fecha_venci, imp_cheque, cheque_real, imp_iva, cheque_pago, fecha_pago, tipo, archivo, id, aplica, '$fec', audita from desarrollo.pagos_cheque where prv=$prv and aplica='S' and fecha_pago='0000-00-00')";
  $this->db->query($s);
  $ss="update desarrollo.pagos_cheque set aplica='N' where prv=$prv and aplica='S' and fecha_pago='0000-00-00'";
  $this->db->query($ss);  
}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function compraped_entregaxx($tipo,$fec1,$fec2,$tit)
    {
       $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        

        </thead>
        <tbody>
        ";
      
         foreach($q->result() as $r)
        {
          
            $tabla.="
            <tr>
              </tr>
            ";
          }
         $tabla.="
        </tbody>
        <tfoot>
       
            </tfoot>
        </table>";
        
        return $tabla;
    }














































////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//**************************************************************
//**************************************************************
//**************************************************************
}