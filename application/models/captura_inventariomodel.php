<?php
class Captura_inventariomodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    

    function guardar_inventario()
    {
        $suc = $this->session->userdata('suc');
        if($suc == null){
            return '0';
        }else{
            
        $mensaje = null;
        $this->db->select('susa1, susa2');
        $this->db->where('sec', $this->input->post('clave'));
        $this->db->where('tsec', 'G');
        $query = $this->db->get('catalogo.almacen');
        
        $this->db->where('suc', $this->session->userdata('suc'));
        $this->db->where('clave', $this->input->post('clave'));
        $query2 = $this->db->get('inventario_temp');
        
        if($query->num_rows() > 0 && $query2->num_rows() == 0){
        
            $row = $query->row();
            
            $data = array(
                'suc' => $this->session->userdata('suc'),
                'clave' => $this->input->post('clave'),
                'descripcion' => $row->susa1,
                'descripcion2' => $row->susa2,
                'cantidad' => $this->input->post('cantidad'),
            );
          
            $this->db->insert('inventario_temp', $data);
            return '1';
        }else{
            return '0';
        }
        }
    }
    

    function inventario()
    {
        $sql = "select * from inventario_temp where suc= ?";
        
        $query = $this->db->query($sql, array($this->session->userdata('suc')));
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Num. Sucursal</th>
        <th>Clave</th>
        <th>Descripcion</th>
        <th>Descripcion2</th>
        <th>Piezas</th>
        <th>Borrar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        
        {
            $borrar=anchor('captura_inventario/borrar_clave/'.$row->id,'borrar');
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->clave</td>
        <td>$row->descripcion</td>
        <td>$row->descripcion2</td>
        <td>$row->cantidad</td>
        <td>$borrar</td>
        </tr>
            ";
        }
        $tabla.='</table>';
        return $tabla;
    }

    function checar_registros()
    {
        $this->db->where('suc', $this->session->userdata('suc'));
        $query = $this->db->get('inventario_temp');
        
        return $query->num_rows();
    }
        
    function checar_inv()
    {
        $this->db->where('suc', $this->session->userdata('suc'));
        $this->db->where('date(fechag) = date(now())', null, false);
        $query = $this->db->get('inv');
        
        return $query->num_rows();
    }


}