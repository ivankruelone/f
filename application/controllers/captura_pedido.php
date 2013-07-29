<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Captura_pedido extends CI_Controller
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
        $this->load->model('captura_pedidomodel');
        $data['contenido'] = "captura_pedido";
        $data['sidebar'] = "sidebar_captura_pedido";
        $data['tabla'] = $this->captura_pedidomodel->pedido();
        
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
    
    function submit_pedido()
    {
        
        $this->load->model('captura_pedidomodel');
        $mensaje = $this->captura_pedidomodel->guardar_pedido();
        redirect('captura_pedido/index/'.$mensaje);
    
    }
    
    function borrar_clave($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pedido_temp');
        redirect('captura_pedido');
    }
    
    function cerrar_pedido()
    {
        $mensaje=null;
        ///Dia de pedido
        $sql_dia = "select dayofweek(date(now())) as dia";
        $dia = $this->db->query($sql_dia);
        $diaw = $dia->row();

        $a = array(
            1 => 'DOM',
            2 => 'LUN',
            3 => 'MAR',
            4 => 'MIE',
            5 => 'JUE',
            6 => 'VIE',
            7 => 'SAB'
        );
        
        $sqlres = "SELECT suc FROM catalogo.sucursal s where dia = ? and suc = ?;";
        $qres = $this->db->query($sqlres, array($a[$diaw->dia], $this->session->userdata('suc')));
        $numrowsr = $qres->num_rows();
        
        //Termina fecha de pedido
        
        //Hora de pedido
        
        $sql_hora = "select DATE_FORMAT(now(), '%H') as hora;";
        $qhora = $this->db->query($sql_hora);
        $hora = $qhora->row();
        //termina hora de pedido
        
        $sql_pedido = "SELECT suc FROM pedidos p where suc = ? and date(fechas) = date(now());";
        $ped = $this->db->query($sql_pedido, array($this->session->userdata('suc')));
        
        if($numrowsr == 0){
            $mensaje = "Hoy no te toca transmitir tu pedido";
        }elseif($hora->hora > 7 && $hora->hora < 14 ){
            if($ped->num_rows() > 0){
                $mensaje = "Ya enviaste pedido Hoy";
            }else{
                //$mensaje = "Puedes enviar tu pedido";
                $this->__cerrar_pedido_ok();
            }
        }else{
            $mensaje = "No Puedes enviar tu pedido porque ya pasan de las 2 P.M. Hora de la Ciudad de Mexico";
        }
        
        redirect('captura_pedido/index/'.$mensaje);

    }
    
    function __cerrar_pedido_ok()
    {
        $this->load->helper('file');
        
        $string = null;
        $string.= '>'.str_pad($this->session->userdata('suc'), 4, '0', STR_PAD_LEFT).'.'.date('dmy')."\r\n";
        $string.= '    PEDIDO+'."\r\n";
        $string.= '>08+'."\r\n";
        
        $this->db->where('suc', $this->session->userdata('suc'));
        $query = $this->db->get('pedido_temp');
        
        foreach($query->result() as $row)
        {
            $string.= str_pad($row->clave, 13, '0', STR_PAD_LEFT).' '.str_pad($row->cantidad, 4, '0', STR_PAD_LEFT).'+'."\r\n";
        }
        
        $string.= '>92+';
        $archivo = str_pad($this->session->userdata('suc'), 4, '0', STR_PAD_LEFT).date('dm').'_web.pge';
        $ruta = './archivos/';
        write_file($ruta.$archivo, $string);
        
        $this->load->model('contactos');
        $this->contactos->inserta_archivos($archivo, 1000, null);
        
        echo '<pre>';
        echo $string;
        echo '</pre>';
        
        $this->db->where('suc', $this->session->userdata('suc'));
        $this->db->delete('pedido_temp');
        
        
    }

}
    
    