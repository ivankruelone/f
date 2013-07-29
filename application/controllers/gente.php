<?php
class Gente extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->model('gente_model');
    }
    
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['vista'] = 'sitio2/gente/inicio';
        $data['menu'] = 'home';
        $this->load->view('site2', $data);
    }

    public function catalogo_productos()
    {
        $data['vista'] = 'sitio2/gente/productos';
        $data['menu'] = 'catalogo';
        $data['query'] = $this->gente_model->get_productos();
        $this->load->view('site2', $data);
    }

    public function alta_producto()
    {
        $data['vista'] = 'sitio2/gente/alta_producto';
        $data['menu'] = 'catalogo';
        $this->load->view('site2', $data);
    }

    public function alta_producto_submit()
    {
        $this->gente_model->alta_producto();
        redirect('gente/catalogo_productos');
    }

    public function cambia_producto($id)
    {
        $data['vista'] = 'sitio2/gente/cambia_producto';
        $data['menu'] = 'catalogo';
        $data['query'] = $this->gente_model->get_producto($id);
        $this->load->view('site2', $data);
    }

    public function cambia_producto_submit()
    {
        $this->gente_model->cambia_producto();
        redirect('gente/catalogo_productos');
    }

    public function catalogo_sucursales()
    {
        $data['vista'] = 'sitio2/gente/sucursales';
        $data['menu'] = 'catalogo';
        $data['query'] = $this->gente_model->get_sucursales();
        $this->load->view('site2', $data);
    }
    
    public function venta_elige_periodo()
    {
        $data['vista'] = 'sitio2/gente/venta_elige_periodo';
        $data['js'] = 'sitio2/gente/venta_elige_periodo_js';
        $data['menu'] = 'ventas';
        $data['query'] = $this->gente_model->get_sucursales();
        $this->load->view('site2', $data);
    }

    public function reporte_venta()
    {
        $inicio = $this->input->post('inicio');
        $fin = $this->input->post('fin');
        $data['vista'] = 'sitio2/gente/reporte_venta';
        $data['menu'] = 'ventas';
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $data['query'] = $this->gente_model->get_venta($inicio, $fin);
        $this->load->view('site2', $data);
    }

    public function reporte_venta_sucursal_folio($sucursal, $inicio, $fin)
    {
        $data['vista'] = 'sitio2/gente/reporte_venta_sucursal_folio';
        $data['menu'] = 'ventas';
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $data['nombre_sucursal'] = $this->gente_model->get_sucursal_nombre($sucursal);
        $data['query'] = $this->gente_model->get_venta_sucursal_folio($sucursal, $inicio, $fin);
        $this->load->view('site2', $data);
    }

    public function reporte_venta_sucursal_producto($sucursal, $inicio, $fin)
    {
        $data['vista'] = 'sitio2/gente/reporte_venta_sucursal_producto';
        $data['menu'] = 'ventas';
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $data['nombre_sucursal'] = $this->gente_model->get_sucursal_nombre($sucursal);
        $data['query'] = $this->gente_model->get_venta_sucursal_producto($sucursal, $inicio, $fin);
        $this->load->view('site2', $data);
    }

    public function reporte_venta_sucursal_ticket($sucursal, $inicio, $fin)
    {
        $data['vista'] = 'sitio2/gente/reporte_venta_sucursal_ticket';
        $data['menu'] = 'ventas';
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $data['nombre_sucursal'] = $this->gente_model->get_sucursal_nombre($sucursal);
        $data['query'] = $this->gente_model->get_venta_sucursal_ticket($sucursal, $inicio, $fin);
        $this->load->view('site2', $data);
    }

    public function reporte_inventario_producto()
    {
        $data['vista'] = 'sitio2/gente/reporte_inventario_producto';
        $data['menu'] = 'inv';
        $data['query'] = $this->gente_model->inventario_producto();
        $this->load->view('site2', $data);
    }

    public function reporte_inventario_clave()
    {
        $data['vista'] = 'sitio2/gente/reporte_inventario_clave';
        $data['menu'] = 'inv';
        $data['query'] = $this->gente_model->inventario_clave();
        $this->load->view('site2', $data);
    }

    public function reporte_inventario_sucursal_control()
    {
        $data['vista'] = 'sitio2/gente/inventario_sucursal_control';
        $data['menu'] = 'inv';
        $data['query'] = $this->gente_model->inventario_sucursal_control();
        $this->load->view('site2', $data);
    }

    public function reporte_inventario_sucursal_producto($sucursal)
    {
        $data['vista'] = 'sitio2/gente/reporte_inventario_sucursal_producto';
        $data['menu'] = 'inv';
        $data['query'] = $this->gente_model->inventario_sucursal_producto($sucursal);
        $data['nombre_sucursal'] = $this->gente_model->get_sucursal_nombre($sucursal);
        $this->load->view('site2', $data);
    }

    public function reporte_inventario_sucursal_clave($sucursal)
    {
        $data['vista'] = 'sitio2/gente/reporte_inventario_sucursal_clave';
        $data['menu'] = 'inv';
        $data['query'] = $this->gente_model->inventario_sucursal_clave($sucursal);
        $data['nombre_sucursal'] = $this->gente_model->get_sucursal_nombre($sucursal);
        $this->load->view('site2', $data);
    }

    public function cortes_elige_periodo()
    {
        $data['vista'] = 'sitio2/gente/cortes_elige_periodo';
        $data['js'] = 'sitio2/gente/venta_elige_periodo_js';
        $data['menu'] = 'cortes';
        $data['query'] = $this->gente_model->get_sucursales();
        $this->load->view('site2', $data);
    }

    public function reporte_cortes()
    {
        $inicio = $this->input->post('inicio');
        $fin = $this->input->post('fin');
        $data['vista'] = 'sitio2/gente/reporte_cortes';
        $data['menu'] = 'cortes';
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $data['query'] = $this->gente_model->get_cortes($inicio, $fin);
        $this->load->view('site2', $data);
    }

    public function reporte_cortes_sucursal_detalle($sucursal, $inicio, $fin)
    {
        $data['vista'] = 'sitio2/gente/reporte_cortes_sucursal_detalle';
        $data['menu'] = 'cortes';
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $data['query'] = $this->gente_model->get_cortes_sucursal_detalle($sucursal, $inicio, $fin);
        $this->load->view('site2', $data);
    }

}
