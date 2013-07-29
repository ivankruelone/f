<?php
class Archivos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }
    
    function archivos_enviados()
    {
        $this->db->select('id, suc, archivo');
        $this->db->from('archivos');
        $this->db->where('date(fecha) = CURRENT_DATE');
        $this->db->order_by('suc');
      
        
        $query = $this->db->get();
        $numrows = $query->num_rows();


        $tabla = "
        <table>
        <caption>Archivos Recibidos: $numrows</caption>
        <thead>
        <tr>
        <th>sucursal</th>
        <th>archivo</th>
        <th>previews</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $a = explode(".", $row->archivo);
            
            if(strtolower($a[1]) == "inv" || strtolower($a[1]) == "pge" || strtolower($a[1]) == "txt")
            {
                $l = '<a href="#" name="link" id="link_'.$row->id.'">Mostrar</a>';
            }else{
                $l = null;
            }
            
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->archivo</td>
        <td>$l</td>
        </tr>
            ";
        }

        
        $tabla.= "</table>
        ";
        
        return $tabla;
    }

}
