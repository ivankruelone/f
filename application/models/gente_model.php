<?php
class Gente_model extends CI_Model {
    
    var $id = null;
    var $checador_id = null;
    var $depto = null;

    function __construct()
    {
        parent::__construct();
        $this->id = $this->session->userdata('id');
        $this->checador_id = $this->session->userdata('tipo');
        $this->depto = $this->session->userdata('suc');
    }
    
    function get_productos()
    {
        $query = $this->db->get('catalogo.cat_farmacias_gente');
        return $query;
    }
    
    function get_producto($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('catalogo.cat_farmacias_gente');
        return $query;
    }

    function alta_producto()
    {
        $clave = $this->input->post('clave');
        $ean = $this->input->post('ean');
        $descripcion = $this->input->post('descripcion');
        $descripcion = strtoupper($descripcion);
        
        $this->db->where('clave', $clave);
        $this->db->where('ean', $ean);
        $query = $ths->db->get('catalogo.cat_farmacias_gente');
        
        if($query->num_rows() == 0){

            $a = array(
                'clave' => $clave,
                'ean' => $ean,
                'descripcion' => $descripcion,
                'precio' => $this->input->post('precio')
                );
                
            $this->db->insert('catalogo.cat_farmacias_gente', $a);
            
            return $this->db->insert_id();
        }else{
            return 0;
        }

    }
    
    function cambia_producto()
    {
        $descripcion = $this->input->post('descripcion');
        $descripcion = strtoupper($descripcion);
        
            $a = array(
                'clave' => $this->input->post('clave'),
                'ean' => $this->input->post('ean'),
                'descripcion' => $descripcion,
                'precio' => $this->input->post('precio')
                );
        $this->db->set('cambio', 'now()', false);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.cat_farmacias_gente', $a);
    }

    function get_sucursales()
    {
        $this->db->where("suc between 18701 and 18720");
        $query = $this->db->get('catalogo.sucursal');
        return $query;
    }
    
    function get_sucursal_nombre($suc)
    {
        $this->db->select('trim(nombre) as nombre');
        $this->db->where('suc', $suc);
        $query = $this->db->get('catalogo.sucursal');
        $row = $query->row();
        return $row->nombre;
    }

    function get_venta($inicio, $fin)
    {
        $sql = "SELECT s.suc, s.nombre, ifnull(sum(cantidad *  precio), 0) as venta
FROM catalogo.sucursal s
left join gente_venta_c c on s.suc = c.sucursal and c.fecha between ? and ?
left join gente_venta_d d on c.id = d.c_id
where s.suc between 18701 and 18720
group by s.suc;";
        $query = $this->db->query($sql, array($inicio.' 00:00:00', $fin.' 23:59:59'));
        
        return $query;
    }

    function get_venta_sucursal_folio($sucursal, $inicio, $fin)
    {
        $sql = "SELECT sucursal, folio, ifnull(sum(cantidad *  precio), 0) as venta, fecha
FROM gente_venta_c c
left join gente_venta_d d on c.id = d.c_id
where sucursal = ? and c.fecha between ? and ?
group by folio
order by folio;";
        $query = $this->db->query($sql, array($sucursal, $inicio.' 00:00:00', $fin.' 23:59:59'));
        
        return $query;
    }

    function get_venta_sucursal_producto($sucursal, $inicio, $fin)
    {
        $sql = "SELECT sucursal, ean, clave, descripcion, ifnull(sum(cantidad), 0) as cantidad, ifnull(sum(cantidad *  d.precio), 0) as venta
FROM gente_venta_c c
left join gente_venta_d d on c.id = d.c_id
left join catalogo.cat_farmacias_gente p on d.producto_id = p.id
where sucursal = ? and c.fecha between ? and ?
group by p.id
order by p.id;";
        $query = $this->db->query($sql, array($sucursal, $inicio.' 00:00:00', $fin.' 23:59:59'));
        //echo $this->db->last_query();
        return $query;
    }
    
    function get_venta_sucursal_ticket($sucursal, $inicio, $fin)
    {
        $sql = "SELECT sucursal, c.id_venta, ean, clave, descripcion, ifnull(sum(cantidad), 0) as cantidad, ifnull(sum(cantidad *  d.precio), 0) as venta
FROM gente_venta_c c
left join gente_venta_d d on c.id = d.c_id
left join catalogo.cat_farmacias_gente p on d.producto_id = p.id
where sucursal = ? and c.fecha between ? and ?
group by c.id_venta, p.id
order by c.id_venta, p.id;";
        $query = $this->db->query($sql, array($sucursal, $inicio.' 00:00:00', $fin.' 23:59:59'));
        
        return $query;
    }

    function inventario_producto()
    {
        $sql = "SELECT c.id, c.ean, c.descripcion, c.clave, sum(inv) as inv FROM catalogo.cat_farmacias_gente c
left join gente_inventario i on c.id = i.producto_id
group by c.id;";
        $query = $this->db->query($sql);
        return $query;
    }

    function inventario_clave()
    {
        $sql = "SELECT c.id, c.ean, c.descripcion, c.clave, sum(inv) as inv FROM catalogo.cat_farmacias_gente c
left join gente_inventario i on c.id = i.producto_id
group by c.clave;";
        $query = $this->db->query($sql);
        return $query;
    }

    function inventario_sucursal_control()
    {
        $sql = "SELECT sucursal, nombre, sum(inv) as inv FROM catalogo.cat_farmacias_gente c
left join gente_inventario i on c.id = i.producto_id
left join catalogo.sucursal s on i.sucursal = s.suc
group by sucursal;";
        $query = $this->db->query($sql);
        return $query;
    }

    function inventario_sucursal_producto($sucursal)
    {
        $sql = "SELECT c.id, c.ean, c.descripcion, c.clave, sum(inv) as inv FROM catalogo.cat_farmacias_gente c
left join gente_inventario i on c.id = i.producto_id
where i.sucursal = ?
group by c.id;";
        $query = $this->db->query($sql, $sucursal);
        return $query;
    }

    function inventario_sucursal_clave($sucursal)
    {
        $sql = "SELECT c.id, c.ean, c.descripcion, c.clave, sum(inv) as inv FROM catalogo.cat_farmacias_gente c
left join gente_inventario i on c.id = i.producto_id
where i.sucursal = ?
group by c.clave;";
        $query = $this->db->query($sql, $sucursal);
        return $query;
    }

    function get_cortes($inicio, $fin)
    {
        $sql = "SELECT s.suc, s.nombre, ifnull(sum(fondo), 0) as fondo, ifnull(sum(retiro), 0) as retiro, ifnull(sum(ventas), 0) as ventas, ifnull(sum(total), 0) as total, ifnull(sum(dinero), 0) as dinero, ifnull(sum(faltante), 0) as faltante, ifnull(sum(sobrante), 0) as sobrante
FROM catalogo.sucursal s
left join gente_cortes c on s.suc = c.sucursal and c.fecha between ? and ?
where s.suc between 18701 and 18720
group by s.suc;";
        $query = $this->db->query($sql, array($inicio.' 00:00:00', $fin.' 23:59:59'));
        
        return $query;
    }

    function get_cortes_sucursal_detalle($sucursal, $inicio, $fin)
    {
        $sql = "SELECT c.fecha, s.suc, s.nombre, fondo, retiro, ventas, total, dinero, faltante, sobrante
FROM catalogo.sucursal s
left join gente_cortes c on s.suc = c.sucursal and c.fecha between ? and ?
where s.suc = ?;";
        $query = $this->db->query($sql, array($inicio.' 00:00:00', $fin.' 23:59:59', $sucursal));
        
        return $query;
    }

}