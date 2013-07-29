<?php
class Sms_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
    }
    
    function celular($celular)
    {
        $this->db->select('nombre');
        $this->db->where('celular', $celular);
        $q = $this->db->get('celular');
        
        if($q->num_rows() === 0)
        {
            return FALSE;
        }else
        {
            $row = $q->row();
            
            return $row->nombre;
        }
        
        
    }

    function meds($q)
    {
        $sql = "SELECT sec, susa1, susa2, codigo, id FROM catalogo.almacen a where susa1 like '%$q%' or susa2 like '%$q%' or sec like '%$q%' or codigo like '%$q%';";
        
        $a = null;
        
        $q = $this->db->query($sql);
        
        foreach($q->result() as $row)
        {
            $a.= "$row->id|$row->sec - $row->codigo - $row->susa1 - $row->susa2\n";
        }
        
        return $a;
    }
    
    function agrega_med($clave, $cantidad)
    {
        $sql = "select * from catalogo.almacen where id = ?;";
        $q = $this->db->query($sql, $clave);
        $this->load->library('cart');
        
        $row = $q->row();
        
        
        $data = array(
               'id'      => $row->id,
               'qty'     => $cantidad,
               'price'   => 1,
               'name'    => 'foo'
            );

        $this->cart->insert($data);
        
        $total_items = $this->cart->total_items();
        
        return "<p class=\"message-box alert\">".$row->sec." ".$row->susa1." ".$cantidad." Pz(s).</p>
        <script language=\"javascript\" type=\"text/javascript\">
        
        $('input[name=\"registros\"]').val($total_items);

</script>
";
    }
    
    function inserta_control()
    {
        $data = array(
           'nombre' => $this->input->post('persona'),
           'celular' => $this->input->post('celular'),
           'suc'    => $this->session->userdata('suc')
        );
        
        $sql_inserta_celular = "insert into celular (celular, nombre) values(?, ?) on duplicate key update nombre = values(nombre);";
        $this->db->query($sql_inserta_celular, array($this->input->post('celular'), $this->input->post('persona')));
        
        $this->db->insert('celular_c', $data);
        return $this->db->insert_id();    
    }
    
    function inserta_detalle($control)
    {
        $this->load->library('cart');
        
        foreach($this->cart->contents() as $items){
        
        $data = array(
           'c_id' => $control ,
           'clave' => $items['id'],
           'cantidad' => $items['qty']
        );
        
        $this->db->insert('celular_d', $data);
        }
        
        $this->cart->destroy();
    }
    
    function historial()
    {
        $this->db->select('*');
        $this->db->from('celular_c c');
        $this->db->join('celular_d d', 'c.id = d.c_id');
        $this->db->join('catalogo.almacen a', 'd.clave = a.id');
        $this->db->where('c.suc', $this->session->userdata('suc'));
        $this->db->order_by('c.id', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Cliente</th>
        <th>Celular</th>
        <th>Sustancia</th>
        <th>Nombre Comercial</th>
        <th>Cantidad</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->nombre</td>
        <td>$row->celular</td>
        <td>$row->susa1</td>
        <td>$row->susa2</td>
        <td>$row->cantidad</td>
        </tr>
            ";
        }
        
        $tabla.= "</table>
        ";
        
        return $tabla;
        
    }
     
}
