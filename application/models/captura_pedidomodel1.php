<?php
class Captura_pedidomodel1 extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }
    
    
     function guardar_pedido_esp()
    {
      $sec=$this->input->post('clave');
      $p_id=$this->input->post('id');
      
      $s="select *from desarrollo.pedido_esp_d where clave=$sec and p_id=$p_id";
      $q = $this->db->query($s);
      if($q->num_rows() == 0){      
        $mensaje = null;
        $this->db->select('susa1, susa2');
        $this->db->where('sec', $this->input->post('clave'));
        $this->db->where('tsec', 'G');
        $query = $this->db->get('catalogo.almacen');
        //echo $this->db->last_query();
        //die();
        
        $this->db->where('p_id', $this->input->post('id'));
        $this->db->where('clave', $this->input->post('clave'));
        $query2 = $this->db->get('pedido_esp_d');
        //echo $this->db->last_query();
        //die();
        
        if($query->num_rows() > 0 && $query2->num_rows() == 0){
        
            $row = $query->row();
            
            $data = array(
                'p_id' => $this->input->post('id'),
                'clave' => $this->input->post('clave'),
                'descripcion' => $row->susa1,
                'descripcion2' => $row->susa2,
                'cantidad' => $this->input->post('cantidad'),
            );
          
            $this->db->insert('pedido_esp_d', $data);
            return '1';
        }else{
            return '0';
        }
        return '1';
    }else{
        return '0';
    }
    
    }
    
    function pedido_esp($id)
    {
    
            $sql = "select * from pedido_esp_d where p_id= ?";
        
        $query = $this->db->query($sql, array($id));
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>id_pedido</th>
        <th>Clave</th>
        <th>Descripcion</th>
        <th>Descripcion2</th>
        <th>Piezas</th>
        <th>Borrar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        
        {
          
            $borrar=anchor('captura_pedido1/borrar_clave/'.$id.'/'.$row->id,'borrar');
            

            $tabla.= "
        <tr>
        <td>$row->p_id</td>
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
        
    function sucursal()
    {
        $dianombre=date('D');
        $suc = $this->session->userdata('username');  
        $nivel = $this->session->userdata('nivel');  
       // $dianombre='VIE';
        if($nivel==15 || $nivel==16){
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
        
        $this->db->select('suc, nombre');
        $this->db->from('catalogo.sucursal');
        $this->db->where('especial','S');
        $this->db->where('tlid', 1);
        $this->db->where("dia<> '$diax'", '', false);
        $this->db->group_by('suc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $a = array();
       
        $a[0] = "Selecciona una Sucursal";
        }else{
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
        
        $this->db->select('suc, nombre');
        $this->db->from('catalogo.sucursal');
        $this->db->where('suc',$suc);
        $this->db->where("dia<> '$diax'", '', false);        
        $this->db->group_by('suc');
        $query = $this->db->get();
        
        
        $a = array();
       
        $a[0] = "Selecciona una Sucursal";    
        }
        foreach($query->result() as $row)
   
        {
            $a[$row->suc] = $row->suc. " - " . $row->nombre;
        }
        
        return $a;
        
        
    }
    
    function pedidos_pendientes()
    
    {
        $sql="SELECT * FROM pedido_esp_c where status='A' order by fecha desc";
        
        $query = $this->db->query($sql);
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Sucursal</th>
        <th>Fecha de Captura</th>
        <th>Continuar</th>
        <th>Eliminar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        
        {
        
            $borrar=anchor('captura_pedido1/borrar_pedido/'.$row->id,'borrar');             
            $continuar=anchor('captura_pedido1/captura_esp/'.$row->id,'continuar');
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->fecha</td>
        <td>$continuar</td>
        <td>$borrar</td>
        </tr>
            ";
        }
        $tabla.='</table>';
        return $tabla;
    }
    
    function cuenta_historico_pedidos_esp()
    {
        $sql="SELECT count(*) as cuenta 
        FROM catalogo.folio_pedidos_cedis_especial a 
        left join catalogo.sucursal b on b.suc=a.suc 
        where  a.id_user > 0 and a.tid='A'";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function historico_pedidos_esp($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $nivel= $this->session->userdata('nivel');
        
        $this->db->select('a.*,b.nombre, c.nombre as nom');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->join('catalogo.sucursal b', 'b.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.folio_pedido_cedis_estatus c', 'c.tipo=a.tid', 'LEFT');
        $this->db->where('a.id_user > 0');
        $this->db->where_in('a.tid', array('A','C'));
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        
        $tabla = $this->pagination->create_links()."
        <table>
        <thead>
        <tr>
        <th>Sucursal</th>
        <th>Fecha de Captura</th>
        <th>Folio</th>
        <th>Estatus</th>
        <th>Detalle</th>
        <th>Borrar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        
        {
            $impresion=anchor('captura_pedido1/imprime/'.$row->id.'/'.$row->suc,'IMPRESION');
          
            if($nivel==10){
            $borrar=anchor('captura_pedido1/borrar/'.$row->id.'/'.$row->suc,'borrar'); 
            }else{
            $borrar='';
            
            }
            $tabla.= "
        <tr>
        <td>$row->suc - $row->nombre </td>
        <td>$row->fechas</td>
        <td>$row->id</td>
        <td>$row->nom</td>
        <td>$impresion</td>
        <td>$borrar</td>
        </tr>
            ";
        }
        $tabla.='</table>'.$this->pagination->create_links();
        return $tabla;
    }
    
    function busca_folio()
    {
        $folio=$this->input->post('folio');
        $fecha=$this->input->post('fecha');
        $suc=$this->input->post('suc');
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('a.*,b.nombre, c.nombre as nom');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->join('catalogo.sucursal b', 'b.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.folio_pedido_cedis_estatus c', 'c.tipo=a.tid', 'LEFT');
        $this->db->where('a.id_user > 0');
        $this->db->where_in('a.tid', array('A','C'));
        if(strlen($folio)>0){
        $this->db->where('a.id =', $folio);
        }
        if(strlen($fecha)>0){
        $this->db->where('a.fechas =', $fecha);
        }
        if(strlen($suc)>0){
        $this->db->where('a.suc =', $suc);
        }
        
        
        $query = $this->db->get();

        //echo $this->db->last_query();
        $tabla1 = "
        <table>
        <thead>
        <tr>
        <th>Sucursal</th>
        <th>Fecha de Captura</th>
        <th>Folio</th>
        <th>Estatus</th>
        <th>Detalle</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $impresion=anchor('captura_pedido1/imprime/'.$row->id.'/'.$row->suc,'IMPRESION');
            $tabla1.= "
        <tr>
        <td>$row->suc - $row->nombre </td>
        <td>$row->fechas</td>
        <td>$row->id</td>
        <td>$row->nom</td>
        <td>$impresion</td>
        </tr>
            ";
        }
        
        
        $tabla1.= "</table>
        ";
        
        return $tabla1;
    }
    
    
    }

