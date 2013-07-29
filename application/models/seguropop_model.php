<?php
class Seguropop_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        
    }
    
 
    function compra_clave_prv()
    {
        
       $aaa= date('Y');
       $aaax= date('Y')-1;
         $id_user= $this->session->userdata('id');
         $sql = "SELECT a.claves,b.susa1,b.m2011,b.m2012,b.l2012,
sum(case
when a.fecent>=20110101 and a.fecent<=20111231 and costo>m2011 and m2011>0 then (piezas*costo)-(piezas*m2011)
when a.fecent>=20111231 or costo=m2011 then 0
end) as p2011,

sum(case
when a.fecent>=20120101 and a.fecent<=20121231 and costo>m2012 and m2012>0 then (piezas*costo)-(piezas*m2012)
when a.fecent<20121231 or costo=m2012 then 0
end) as p2012

from  almacen.factura_cxp a
left join catalogo.segpop_costoa b on b.claves=a.claves

where fecent>=20110101 and a.suc>0
group by claves 
order by p2012 desc  
         ";
       
        $query = $this->db->query($sql);
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>CLAVE</th>
        <th>DESCRIPCION</th>    
        <th>$ MINIMO 2012</th>
        <th>$ COSTO LICITADO 2012</th>
        <th>$ AHORRO SI COMPRAN CON MINIMO 2012</th>
        
        </tr>
        </thead>";
        $tot1=0;
        $tot2=0;
        foreach($query->result() as $row)
        {
         
        //$l1 = anchor('seguropop/imprimir_detalle_clave/'.$row->claves.'/'.$aaax,$row->p2011 , array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));    
        $l2 = anchor('seguropop/imprimir_detalle_clave/'.$row->claves.'/'.$aaa,$row->p2012 , array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
        $tabla.= "
        <tr>
            
            <td align=\"left\">".$row->claves."</td>
            <td align=\"left\">".$row->susa1."</td>
            
            <td align=\"right\">".number_format($row->m2012,2)."</td>
            <td align=\"right\">".number_format($row->l2012,2)."</td>
            
            <td align=\"right\">".$l2."</td>
            </tr> ";
      
        $tot1=$tot1+$row->p2011;
        $tot2=$tot2+$row->p2012;
        }

       $tabla.= "
	   <tr>
            <td align=\"left\" colspan=\"4\">TOTAL</td>
            <td align=\"right\">".number_format($tot1,2)."</td>
            <td align=\"right\">".number_format($tot2,2)."</td>
            </tr>
			<table>"; 
        
        return $tabla;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
 function clave_detalle_compra($claves,$aaa)
    {
    	  $id_user= $this->session->userdata('id');
  $sql = "SELECT a.*,b.susa1,b.m$aaa, b.m$aaa as mini,(piezas*costo) as impo,c.nombre as sucx,d.corto,b.l$aaa,
(case
when LEFT(fecent,4)=$aaa and costo>m$aaa and m$aaa>0 then (piezas*costo)-(piezas*m$aaa)
when LEFT(fecent,4)<>$aaa or costo=m$aaa then 0
end) as dif

from  almacen.factura_cxp a
left join catalogo.segpop_costoa b on b.claves=a.claves
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.provedor d on d.prov=a.prv
where LEFT(fecent,4)=$aaa and a.suc>0 and a.claves=$claves
order by a.suc,a.fecent,a.prv";  
        $query = $this->db->query($sql);
        
        $tabla ="<table border=\"1\">
        <thead>
        <tr bgcolor=\"#F0E9CF\">
        <th><strong>CXP</strong></th>
        <th  colspan=\"2\"><strong>ALMACEN</strong></th>
        <th><strong>FECHA</strong><br /><strong>VENCIMIENTO</strong></th>
        <th><strong>FECHA</strong><br /><strong>FACTURA</strong></th>
        <th><strong>FACTURA</strong></th>    
        <th><strong>PROVEEDOR</strong></th>
        <th align=\"right\"><strong>PIEZAS</strong></th>
        <th align=\"right\"><strong>COSTO</strong></th>
        <th align=\"right\"><strong>IMPORTE</strong></th>
        <th align=\"right\"><strong>POSIBLE AHORRO</strong></th>
        </tr>
        </thead>";
        $color='#E3E4E4';
        $col='black';
      $totp=0;
      $totimpo=0; 
      $tot1=0;
      $tot2=0; 
        foreach($query->result() as $row)
        {
            if($row->l2012>0){$lic=$row->l2012*1.10;}else{$lic=0;}
        if($row->suc==17000 || $row->suc==17900){$color='#F7F4E5';}
        if($row->suc==16000 || $row->suc==16900){$color='#E9F6DA';}
        if($row->suc==15000 || $row->suc==15900){$color='#E6F9F9';}
        if($row->suc==14000 || $row->suc==14900){$color='#E7E9F9';}
        if($row->suc==12000 || $row->suc==12900){$color='#FAEDF7';}
        if($row->suc==9100 || $row->suc==9900){$color='#E8E5E5';}
        
        if($row->l2012>0 and $lic<=$row->costo){$col='red';}else{$col='black';}
        if($row->mini==$row->costo){$col='blue';}else{$col='black';}
        $tabla.= "
        <tr bgcolor=\"$color\">
            <td align=\"left\"><font color=\"$col\">".$row->cxp."</font></td>
            <td align=\"left\" colspan=\"2\"><font color=\"$col\">".$row->sucx."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fecven."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fecent."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fac."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->prv."<br />".$row->corto."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->piezas,0)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->impo,2)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->dif,2)."</font></td>
       </tr>
        ";
      $totp=$totp+$row->piezas;
      $totimpo=$totimpo+$row->impo; 
      $tot2=$tot2+$row->dif;  
        }

       $tabla.= "
        <tr bgcolor=\"$color\">
            <td align=\"left\" colspan=\"7\"><strong>TOTAL</strong></td>
            <td align=\"right\">".number_format($totp,0)."</td>
            <td align=\"right\"></td>
            <td align=\"right\">".number_format($totimpo,2)."</td>
            <td align=\"right\">".number_format($tot2,2)."</td>
       </tr>
       </table>"; 
        
        return $tabla;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function compra_clave_prv_prv()
    {
        
       $aaa= date('Y');
       $aaax= date('Y')-1;
         $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.corto from  almacen.factura_cxp a 
         left join catalogo.provedor b on b.prov=a.prv 
         where fecent>=20120101 and piezas>0 and costo>costo10
         group by prv 
         ";
       
       $query = $this->db->query($sql);
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>Prv</th>
        <th>Proveedor</th>    
        </tr>
        </thead>";
        $tot1=0;
        $tot2=0;
        foreach($query->result() as $row)
        {
         
            
        $l1 = anchor('seguropop/tabla_seguropop_prv_det/'.$row->prv,$row->prv , array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
        $l2 = anchor('seguropop/tabla_seguropop_prv_det_mal/'.$row->prv,'___'.$row->prv , array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
        $tabla.= "
        <tr>
            <td align=\"right\">".$l1."</td>
            <td align=\"left\">".$row->corto."</td>
            <td align=\"right\">".$l2."</td>
            
            
            </tr> ";
      
       
        }

       $tabla.= "
			<table>"; 
        
        return $tabla;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function compra_clave_prv_prv_det($prv)
    {
        
       $aaa= date('Y');
      
         $id_user= $this->session->userdata('id');
         $sql = "SELECT a.cxp, a.*,b.susa1,b.m$aaa, b.m$aaa as mini,(piezas*costo) as impo,c.nombre as sucx,d.razo,b.l2012,
(case
when LEFT(fecent,4)=$aaa and costo>m$aaa and m$aaa>0 then (piezas*costo)-(piezas*m$aaa)
when LEFT(fecent,4)<>$aaa or costo=m$aaa then 0
end) as dif

from  almacen.factura_cxp a
left join catalogo.segpop_costoa b on b.claves=a.claves
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.provedor d on d.prov=a.prv
where LEFT(fecent,4)=$aaa  and a.prv=$prv
order by a.suc,a.fecent,a.prv 
         ";
       
        $query = $this->db->query($sql);
        
        $tabla ="<table border=\"1\">
        <thead>
        <tr bgcolor=\"#F0E9CF\">
        <th><strong>CXP</strong></th>
        <th  colspan=\"2\"><strong>ALMACEN</strong></th>
        <th><strong>FECHA</strong><br /><strong>VENCIMIENTO</strong></th>
        <th><strong>FECHA</strong><br /><strong>FACTURA</strong></th>
        <th><strong>FACTURA</strong></th>    
        <th><strong>PROVEEDOR</strong></th>
        <th align=\"right\"><strong>PIEZAS</strong></th>
        <th align=\"right\"><strong>COSTO FACTURA</strong></th>
        <th align=\"right\"><strong>COSTO LIC</strong></th>
        <th align=\"right\"><strong>COSTO LIC + 10</strong></th>
        </tr>
        </thead>";
        $color='#E3E4E4';
        $col='black';
      $totp=0;
      $totimpo=0; 
      $tot1=0;
      $tot2=0; 
        foreach($query->result() as $row)
        {
        
        if($row->costo10>0 and $row->costo10<=$row->costo){$col='red';}else{$col='black';}
        $tabla.= "
        <tr bgcolor=\"$color\">
            <td align=\"left\"><font color=\"$col\">".$row->cxp."</font></td>
            <td align=\"left\" colspan=\"2\"><font color=\"$col\">".$row->sucx."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fecven."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fecent."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fac."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->prv."<br />".$row->razo."</font></td>
            
            <td align=\"right\"><font color=\"$col\">".number_format($row->piezas,0)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costol,2)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costo10,2)."</font></td>
            
       </tr>
       <tr bgcolor=\"$color\">
       <td align=\"left\" colspan=\"10\"><font color=\"$col\">".$row->claves." ".$row->susa1."</font></td>
        </tr>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        ";
      $totp=$totp+$row->piezas;
      $totimpo=$totimpo+$row->impo; 
      $tot2=$tot2+$row->dif;  
        }

       $tabla.= "
        <tr bgcolor=\"$color\">
            <td align=\"left\" colspan=\"7\"><strong> TOTAL DE LO FACTURADO</strong></td>
            <td align=\"right\">".number_format($totp,0)."</td>
            <td align=\"right\">".number_format($totimpo,2)."</td>
            <td align=\"right\">DIF.".number_format($tot2,2)."</td>
       </tr>
       </table>"; 
        
        
        return $tabla;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function compra_clave_prv_prv_det_mal($prv)
    {
        
       $aaa= date('Y');
      
         $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.susa1,b.m$aaa, b.m$aaa as mini,(piezas*costo) as impo,c.nombre as sucx,d.razo,b.l2012,
(case
when LEFT(fecent,4)=$aaa and costo>m$aaa and m$aaa>0 then (piezas*costo)-(piezas*m$aaa)
when LEFT(fecent,4)<>$aaa or costo=m$aaa then 0
end) as dif

from  almacen.factura_cxp a
left join catalogo.segpop_costoa b on b.claves=a.claves
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.provedor d on d.prov=a.prv
where LEFT(fecent,4)=$aaa and a.suc>0  and a.prv=$prv and a.costo>a.costo10
order by a.suc,a.fecent,a.prv 
         ";
       
        $query = $this->db->query($sql);
        
        $tabla ="<table border=\"1\">
        <thead>
        <tr bgcolor=\"#F0E9CF\">
        <th><strong>CXP</strong></th>
        <th  colspan=\"2\"><strong>ALMACEN</strong></th>
        <th><strong>FECHA</strong><br /><strong>VENCIMIENTO</strong></th>
        <th><strong>FECHA</strong><br /><strong>FACTURA</strong></th>
        <th><strong>FACTURA</strong></th>    
        <th><strong>PROVEEDOR</strong></th>
        <th align=\"right\"><strong>PIEZAS</strong></th>
        <th align=\"right\"><strong>COSTO FACTURA</strong></th>
        <th align=\"right\"><strong>COSTO LIC</strong></th>
        <th align=\"right\"><strong>COSTO LIC + 10</strong></th>
        </tr>
        </thead>";
        $color='#E3E4E4';
        $col='black';
      $totp=0;
      $totimpo=0; 
      $tot1=0;
      $tot2=0; 
        foreach($query->result() as $row)
        {
        
        if($row->costo10>0 and $row->costo10<=$row->costo){$col='red';}else{$col='black';}
        $tabla.= "
        <tr bgcolor=\"$color\">
            <td align=\"left\"><font color=\"$col\">".$row->cxp."</font></td>
            <td align=\"left\" colspan=\"2\"><font color=\"$col\">".$row->sucx."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fecven."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fecent."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->fac."</font></td>
            <td align=\"left\"><font color=\"$col\">".$row->prv."<br />".$row->razo."</font></td>
            
            <td align=\"right\"><font color=\"$col\">".number_format($row->piezas,0)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costo,2)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costol,2)."</font></td>
            <td align=\"right\"><font color=\"$col\">".number_format($row->costo10,2)."</font></td>
            
       </tr>
       <tr bgcolor=\"$color\">
       <td align=\"left\" colspan=\"10\"><font color=\"$col\">".$row->claves." ".$row->susa1."</font></td>
        </tr>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        ";
      $totp=$totp+$row->piezas;
      $totimpo=$totimpo+$row->impo; 
      $tot2=$tot2+$row->dif;  
        }

       $tabla.= "
        <tr bgcolor=\"$color\">
            <td align=\"left\" colspan=\"7\"><strong>TOTAL</strong></td>
            <td align=\"right\">".number_format($totp,0)."</td>
            <td align=\"right\"></td>
            <td align=\"right\">".number_format($totimpo,2)."</td>
            <td align=\"right\">".number_format($tot2,2)."</td>
       </tr>
       </table>"; 
        
        
        return $tabla;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busco_descri($claves)
    {
        $sql = "SELECT *
      FROM catalogo.segpop_costoa
      where claves=$claves";
        $query = $this->db->query($sql);
        return $query; 
     }


    
}

