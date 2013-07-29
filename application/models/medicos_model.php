<?php
class Medicos_model extends CI_Model
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
    function cat_medicos()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select TRIM(e.nombre) as succx,a.*,b.matutino,c.nombre as matutinox, b.vespertino,d.nombre as vespertinox from catalogo.cat_empleado a
left join catalogo.cat_medicos b on b.nomina=a.nomina
left join catalogo.sucursal c on c.suc=b.matutino and matutino>0
left join catalogo.sucursal d on d.suc=b.vespertino and vespertino>0
left join catalogo.sucursal e on e.suc=a.succ
where trim(a.puestox)='MEDICO' and a.tipo=1 ORDER BY SUCCX";
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        
        <thead>
        
        <tr>
        <th>#</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>Asignado</th>
        <th>Matutino</th>
        <th>Vespertino</th>
        <th>Observacion</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';
         foreach($q->result() as $r)
        {
            $ss="select *from catalogo.cat_alta_empleado where empleado=$r->nomina and motivo='RETENCION' and id_causa<>7";
            $qq = $this->db->query($ss);
            if($qq->num_rows()>0){$rr=$qq->row();$retencion=$rr->motivo;}else{$retencion='';}
        if($r->matutino==$r->vespertino){$color='#0447FE';}else{$color='black';}
        $l1 = anchor('medicos/edita_medicos/'.$r->nomina,$r->completo, array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));    
		$num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nomina."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->succx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->matutinox."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->vespertinox."</font></td>
            <td align=\"left\"><font color=\"$color\">".$retencion."</font></td>
            
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
    function medico($nomina)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select b.matutino,b.vespertino, TRIM(e.nombre) as succx,a.*,b.matutino,c.nombre as matutinox, b.vespertino,d.nombre as vespertinox from catalogo.cat_empleado a
left join catalogo.cat_medicos b on b.nomina=a.nomina
left join catalogo.sucursal c on c.suc=b.matutino and matutino>0
left join catalogo.sucursal d on d.suc=b.vespertino and vespertino>0
left join catalogo.sucursal e on e.suc=a.succ

where a.nomina=$nomina and  trim(a.puestox)='MEDICO' and a.tipo=1 ORDER BY SUCCX";
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        
        <thead>
        
        <tr>
        <th>#</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>Asignado</th>
        <th>Matutino</th>
        <th>Vespertino</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';
         foreach($q->result() as $r)
        {
            
		$num=$num+1;
            $tabla.="
            <tr bgcolor=\"$color\">
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nomina."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->completo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->succx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->matutinox."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->vespertinox."</font></td>
            
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
function update_member($nomina,$mat,$ves)
{
$s="insert into catalogo.cat_medicos(cia, nomina, nombre, matutino, vespertino)values
(13,$nomina,'',$mat,$ves) on duplicate key update vespertino=values(vespertino),matutino=values(matutino)";
$this->db->query($s);    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function medicos_naturistas($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select TRIM(e.nombre) as succx,a.*,b.matutino,c.nombre as matutinox, b.vespertino,d.nombre as vespertinox from catalogo.cat_empleado a
left join catalogo.cat_medicos b on b.nomina=a.nomina
left join catalogo.sucursal c on c.suc=b.matutino and matutino>0
left join catalogo.sucursal d on d.suc=b.vespertino and vespertino>0
left join catalogo.sucursal e on e.suc=a.succ
where trim(a.puestox)='MEDICO' and a.tipo=1 ORDER BY SUCCX";
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        
        <thead>
        
        <tr>
        <th>#</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>Asignado</th>
        <th>Matutino</th>
        <th>Vespertino</th>
        <th>Importe Nat</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';
         foreach($q->result() as $r)
        {
            $ss="select sum(importe)as importe from vtadc.venta_detalle_nat where date_format(fecha,'%Y-%m')='$fec' and nomina=$r->nomina";
            $qq = $this->db->query($ss);
            if($qq->num_rows()>0){$rr=$qq->row();$venta=$rr->importe;}else{$venta=0;}
        if($r->matutino==$r->vespertino){$color='#0447FE';}else{$color='black';}
        $l1 = anchor('medicos/edita_medicos/'.$r->nomina,$r->completo, array('title' => 'Haz Click aqui para ver por proveedor!', 'class' => 'encabezado'));    
		$num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nomina."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->succx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->matutinox."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->vespertinox."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($venta,2)."</font></td>
            
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





















































////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//**************************************************************
//**************************************************************
//**************************************************************
}