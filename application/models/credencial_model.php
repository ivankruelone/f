<?php
class Credencial_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    
    
     function busca_empleado()
    {
        $id_plaza= $this->session->userdata('id_plaza');
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 and id_plaza=$id_plaza order by completo";
        $query = $this->db->query($sql);
        
        $empleadox = array();
        $empleadox[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox[$row->nomina] = $row->completo;
        }
        
        return $empleadox;  
    }
    
   
    function formato_credencial($empleadox)
    {
        
        
        $this->db->select('e.*, s.nombre as sucursal, ciax');
        $this->db->from('catalogo.cat_empleado e');
        $this->db->join('catalogo.sucursal s', 'e.succ = s.suc', 'LEFT');
        $this->db->join('catalogo.cat_compa_nomina c', 'e.cia = c.cia', 'LEFT');
        $this->db->where('e.nomina', $empleadox);
        $this->db->where('tipo', 1);
        $query = $this->db->get();
        
        $row = $query->row();
        
        if($row->id_checador > 0){
            $eti = 'DEPTO.:';
        }else{
            $eti = 'SUCURSAL:';
        }
        
        $mes = array(
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SEPTIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE'
            );
        
        
        $a = '<table cellpadding="2" width="300px">
            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%" style="text-align: center; vertical-align: top; padding-top: 50px;">
                <b>'.$row->nomina.'</b>
                </td>
                <td width="70%">
                <img style="position:relative; width:200px; text-align: center;" src="'.base_url().'/imagenes/logo1.png" />
                <br />
                <b>'.$row->ciax.'</b><br />
                <b>'.$row->pat.'</b><br />
                <b>'.$row->mat.'</b><br />
                <b>'.$row->nom.'</b><br />
                PUESTO: <b>'.$row->puestox.'</b><br />
                '.$eti.' <b>'.$row->sucursal.'</b><br /><br />
                FECHA: <b>'.date('d').' DE '.$mes[date('m')].' DEL '.date('Y').'</b>
                </td>
            </tr>
            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
        </table>';
        
        $b = '<table cellpadding="5" width="90%">
            <tr>
                <td style="font-size: small;">
                <br /><br /><br /><br />
                <ol type="1" start="1">
                	<li>Esta credencial es una constancia de que el titular de la misma presta sus servicios en esta empresa y en cualquier momento requerido debera mostrarla.</li>
                	<li>Esta credencial es intransferible, el usuario que la preste o permita el mal uso de la misma, se hara acreedor a la sancion correspondiente.</li>
                	<li>Al termino de la relacion laboral, esta credencial debera ser devuelta al departamento de Recursos Humanos.</li>
                	<li>Para cualquier aclaracion llame al 91-400-700.</li>
                </ol>
                <br /><br /><br />
                <p style="text-align: center;">________________________________</p>
                <p style="text-align: center;">FIRMA</p>
                </td>
            </tr>
        </table>';
        
        
        $tabla = '<table width="650" cellpaddind="0" cellspacing="0">
            <tr>
                <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 0.5px;border-top: black; border-top-style: dashed; border-top-width: 0.5px;border-left: black; border-left-style: dashed; border-left-width: 0.5px;border-right: black; border-right-style: dashed; border-right-width: 0.5px;">
                '.$a.'
                </td>
                <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 0.5px;border-top: black; border-top-style: dashed; border-top-width: 0.5px;border-right: black; border-right-style: dashed; border-right-width: 0.5px;">
                '.$b.'
                </td>
            </tr>
        </table>';
        
        return $tabla;
    }
    
    function busca_empleado1()
    {
        $id_plaza= $this->session->userdata('id_plaza');
        
        $sql = "SELECT * FROM catalogo.cat_alta_empleado where motivo='alta' and activo=1 and nomina=0 order by pat asc";
        $query = $this->db->query($sql);
        
        $empleadox = array();
        $empleadox[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox[$row->id] = $row->pat." ".$row->mat." ".$row->nom;
        }
        
        return $empleadox;  
    }
    
        function formato_credencial1($empleadox)
    {
        
        
        $this->db->select('e.*, s.nombre as sucursal, ciax, d.puesto as puest');
        $this->db->from('catalogo.cat_alta_empleado e');
        $this->db->join('catalogo.sucursal s', 'e.suc = s.suc', 'LEFT');
        $this->db->join('catalogo.cat_compa_nomina c', 'e.cia = c.cia', 'LEFT');
        $this->db->join('catalogo.cat_puesto d', 'd.id = e.puesto', 'LEFT');
        $this->db->where('e.id', $empleadox);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $row = $query->row();
        
        if($row->id_checador > 0){
            $eti = 'DEPTO.:';
        }else{
            $eti = 'SUCURSAL:';
        }
        
        $mes = array(
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SEPTIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE'
            );
        
        
        $a = '<table cellpadding="2" width="300px">
            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%" style="text-align: center; vertical-align: top; padding-top: 50px;">
                <b>'.$row->empleado.'</b>
                </td>
                <td width="70%">
                <img style="position:relative; width:200px; text-align: center;" src="'.base_url().'/imagenes/logo1.png" />
                <br />
                <b>'.$row->ciax.'</b><br />
                <b>'.$row->pat.'</b><br />
                <b>'.$row->mat.'</b><br />
                <b>'.$row->nom.'</b><br />
                PUESTO: <b>'.$row->puest.'</b><br />
                '.$eti.' <b>'.$row->sucursal.'</b><br /><br />
                FECHA: <b>'.date('d').' DE '.$mes[date('m')].' DEL '.date('Y').'</b>
                </td>
            </tr>
            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
        </table>';
        
        $b = '<table cellpadding="5" width="90%">
            <tr>
                <td style="font-size: x-small;">
                <br /><br /><br /><br />
                <ol type="1" start="1">
                	<li>Esta credencial es una constancia de que el titular de la misma presta sus servicios en esta empresa y en cualquier momento requerido debera mostrarla.</li>
                	<li>Esta credencial es intransferible, el usuario que la preste o permita el mal uso de la misma, se hara acreedor a la sancion correspondiente.</li>
                	<li>Al termino de la relacion laboral, esta credencial debera ser devuelta al departamento de Recursos Humanos.</li>
                	<li>Para cualquier aclaracion llame al 91-400-700.</li>
                </ol>
                <br /><br /><br />
                <p style="text-align: center;">________________________________</p>
                <p style="text-align: center;">FIRMA</p>
                </td>
            </tr>
        </table>';
        
        
        $tabla = '<table width="650" cellpaddind="0" cellspacing="0">
            <tr>
                <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 0.5px;border-top: black; border-top-style: dashed; border-top-width: 0.5px;border-left: black; border-left-style: dashed; border-left-width: 0.5px;border-right: black; border-right-style: dashed; border-right-width: 0.5px;">
                '.$a.'
                </td>
                <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 0.5px;border-top: black; border-top-style: dashed; border-top-width: 0.5px;border-right: black; border-right-style: dashed; border-right-width: 0.5px;">
                '.$b.'
                </td>
            </tr>
        </table>';
        
        return $tabla;
    }
}