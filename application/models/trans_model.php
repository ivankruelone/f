<?php
class Trans_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }
    
    
    function tipo_tabla()
    {
        $num =null;
       
        $this->db->select('*');
        $this->db->from('tran_gastos_viaje');
        $query = $this->db->get();
        
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Id</th>
        <th>Observaciones</th>
        <th>Fecha</th>
        <th>Tipo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $num++;
        foreach($query->result() as $row)
        {
            $l1 = anchor('catalogo/cambiar_usuario/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));
            $l2 = anchor('catalogo/cambiar_usuario_pas/'.$row->id, '<img src="'.base_url().'img/key.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar password!', 'class' => 'encabezado'));
            $l3 = anchor('catalogo/usuario_sucursal/'.$row->id, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar sucursales!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$row->id."</td>
            <td align=\"left\">".$row->descripcion."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$row->tipo."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
        
      
        
    function tipo()
    {
       
        $this->db->select('*');
        $this->db->from('tran_tipo');
        $query = $this->db->get();
        
        
        $a = array();
       
        $a[0] = "Selecciona un tipo de gasto";
        
        foreach($query->result() as $row)
   
        {
            $a[$row->tipo] = $row->tipo;
        }
        
        return $a;
        
        
    }
    
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function agrega_tipo_gasto($obser,$fec1,$tipo)
    {
     $new_viaje_insert_data = array(
            'descripcion'   => strtoupper(trim($obser)),
            'fecha'         => $fec1,
            'tipo'          => $tipo,
		);
		
		
		$insert = $this->db->insert('tran_gastos_viaje', $new_viaje_insert_data);
    }
/////////////////////////////////////////////////////
///////////////////////////////////////////////////// 
    
    
}

