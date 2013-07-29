<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Captura_inventario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index($mensaje = null)
    {
        $this->load->model('captura_inventariomodel');
        $data['contenido'] = "captura_inventario";
        $data['sidebar'] = "sidebar_captura_pedido";
        $data['tabla'] = $this->captura_inventariomodel->inventario();
        
        if($mensaje == 0){
            $mensajex = 'La clave tecleada no existe o ya fue capturada.';
            $data['mensaje'] = $mensaje;
        }elseif($mensaje == 1){
            $mensajex = 'Correcto, clave capturada.';
            $data['mensaje'] = $mensaje;
        }else{
            $data['mensaje'] = $mensaje;
        }
        $data['mensaje'] = str_replace('%20', ' ', $data['mensaje']);

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit_inventario()
    {
        
        $this->load->model('captura_inventariomodel');
        $mensaje = $this->captura_inventariomodel->guardar_inventario();
        redirect('captura_inventario/index/'.$mensaje);
    
    }
    
    function borrar_clave($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('inventario_temp');
        redirect('captura_inventario');
    }

    function cerrar_inventario()
    {
        $this->load->helper('file');
        
        $string = null;
        $string.= '>'.str_pad($this->session->userdata('suc'), 4, '0', STR_PAD_LEFT).'.'.date('dmy')."\r\n";
        $string.= '    CARLOS+'."\r\n";
        $string.= '>07+'."\r\n";
        
        $this->db->where('suc', $this->session->userdata('suc'));
        $query = $this->db->get('inventario_temp');
        
        foreach($query->result() as $row)
        {
            $string.= str_pad($row->clave, 13, '0', STR_PAD_LEFT).' '.str_pad($row->cantidad, 4, '0', STR_PAD_LEFT).'+'."\r\n";
        }
        
        $string.= '>91+';
        $archivo = str_pad($this->session->userdata('suc'), 4, '0', STR_PAD_LEFT).date('dm').'_web.inv';
        $ruta = './archivos/';
        write_file($ruta.$archivo, $string);
        
        $this->load->model('contactos');
        $this->contactos->inserta_archivos($archivo, 1000, null);
        
        $this->load->model('in_model');
        $this->in_model->inv(null, null, './archivos/'.$archivo, TRUE);

        
        echo '<pre>';
        echo $string;
        echo '</pre>';
        
        $this->db->where('suc', $this->session->userdata('suc'));
        $this->db->delete('inventario_temp');
        
        redirect('contacto/index/');
    }
    
    
    function checar_registros()
    {
        $this->load->model('captura_inventariomodel');
        echo $this->captura_inventariomodel->checar_registros();
    }

    function checar_inv()
    {
        $this->load->model('captura_inventariomodel');
        echo $this->captura_inventariomodel->checar_inv();
    }

}