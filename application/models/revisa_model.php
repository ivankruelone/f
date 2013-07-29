	<?php
class Revisa_model extends CI_Model
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
function prenomina_revisa($fecha,$clave)
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT * from catalogo.sucursal where suc>100 and suc<=1999 and tlid=1 and id_plaza=999 ";
      	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>PRENOMINA APLICADA POR ENCARGADO</strong></th>
        </tr>
        <tr>
        <th><strong>Sucursal</strong></th>
        <th><strong>personas</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
$s="SELECT COUNT(*)num FROM FALTANTE WHERE suc=$row->suc and fecha='$fecha' and clave=$clave GROUP BY succ";

$q = $this->db->query($s); 
$r= $q->row();
if($q->num_rows()> 0){$numero=$r->num;$color='black';}else{$numero=0;$color='red';}
$tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\"><font color=\"$color\">".$row->suc." ".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$numero."</font></td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            "; 



    
        }
$tabla.="

</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function plantilla_revisa()
    {
    $id_user= $this->session->userdata('id');
    $sql="select a.succ,b.nombre,count(*)as num
from catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where a.tipo=1 group by a.succ";
      	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong></strong></th>
        </tr>
        <tr>
        <th><strong>Sucursal</strong></th>
        <th><strong>personas</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        $color='black';
        foreach($query->result() as $row)
        {
            $l1 = anchor('procesos/sumit_tabla_plantilla_revisa/'.$row->succ.'/'.$row->nombre,'DETALLE'.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));   
 $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\"><font color=\"$color\">".$row->succ." ".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            "; 
        }
$tabla.="

</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function plantilla_revisa_detalle($suc)
    {
    $id_user= $this->session->userdata('id');
    $sql="select a.*,b.ciax from catalogo.cat_empleado a 
    left join catalogo.cat_compa_nomina b on b.cia=a.cia
    where a.tipo=1 and a.succ=$suc";
      	$query = $this->db->query($sql);
    	
	    
$tabla= "

        <table border=\"1\" cepalling=\"2\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>PLANTILLA DE PERSONAL</strong></th>
        </tr>
        
        
        <tr>
        <th><strong>Cia</strong></th>
        <th><strong>Empleado</strong></th>
        <th><strong>Firma de empleado</strong></th>
        <th><strong>Observacion</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        $color='black';
        foreach($query->result() as $row)
        {
        if($row->id_checador==0){$huella='Pase a sistemas a registrar su huella';}else{$huella='';}
        if($row->nomina==50604 || $row->nomina==90017 || $row->nomina==90022){$huella='';}
 $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->ciax."</font></td>
            <td align=\"left\"><font color=\"$color\">".str_pad($row->nomina,6,"0",STR_PAD_LEFT)." ".$row->completo."</font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\">".$huella."</font></td>
            </tr>
            
            "; 
        }
$tabla.="

            <tr>
            <td align=\"left\"><font color=\"$color\"><br /></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            </tr>
                        <tr>
            <td align=\"left\"><font color=\"$color\"><br /></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            </tr>
                        <tr>
            <td align=\"left\"><font color=\"$color\"><br /></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            </tr>
                        <tr>
            <td align=\"left\"><font color=\"$color\"><br /></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            <td align=\"left\"><font color=\"$color\"></font></td>
            </tr>
</table>
";
        
        
        return $tabla;
    
    }






























}

