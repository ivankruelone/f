<?php
class Reportes_model extends CI_Model
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

    
    function reporte_diario_encabezado($sucursal)
    {
        $tabla = "
        <table>
        <tr>
        <td align=\"center\">FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        <tr>
        <td align=\"center\">REPORTE DE LA SUCURSAL $sucursal PARA DAR DE ALTA</td>
        </tr>
        <tr>
        <td colspan=\"1\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario($sucursal)
    {
        $this->db->select('a.tipo2, a.suc, a.nombre, a.rfc, a.cia, b.razon, a.dire, a.cp, a.col, a.pobla, a.plaza, c.plazax, a.suc_contable');
        $this->db->from('catalogo.sucursal a');
        $this->db->join('catalogo.compa b', 'a.cia=b.cia', 'LEFT');
        $this->db->join('catalogo.cat_plaza c', 'a.plaza=c.id_plaza', 'LEFT');
        $this->db->where('a.suc', $sucursal);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        
        <table cellpadding=\"6\" border=\"1\">
        <tbody>

        ";
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"left\">STATUS:</td><td>".$row->tipo2."</td>
            </tr>
            <tr>
            <td align=\"left\">SUCURSAL:</td><td>".$row->suc." - ".$row->nombre."</td>
            </tr>
            <tr>
            <td align=\"left\">DIRECCION:</td><td>".$row->dire." - ".$row->col." - ".$row->cp." - ".$row->pobla."</td>
            </tr>
            <tr>
            <td align=\"left\">RFC:</td><td>".$row->rfc."</td>
            </tr>
            <tr>
            <td align=\"left\">COMPA&Ntilde;IA:</td><td>".$row->cia." - ".$row->razon."</td>
            </tr>
            <tr>
            <td align=\"left\">PLAZA CONTABLE:</td><td>".$row->plaza."</td>
            </tr>
            <tr>
            <td align=\"left\">SUCURSAL CONTABLE:</td><td>".$row->suc_contable."</td>
            </tr>
            ";
        
       
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
    }
    
    
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}