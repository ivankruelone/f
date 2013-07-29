<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Captura_pedido1 extends CI_Controller
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

    public function index()
    {
        $this->load->model('captura_pedidomodel1');
        $data['contenido'] = "selec_sucursal";
        $data['sidebar'] = "sidebar";
        $data['sucursal'] = $this->captura_pedidomodel1->sucursal();
   

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function captura_esp($id, $mensaje = null)
    {
        $this->load->model('captura_pedidomodel1');
        $data['contenido'] = "captura_pedido_esp";
        $data['sidebar'] = "sidebar";
        $data['tabla'] = $this->captura_pedidomodel1->pedido_esp($id);
        $data['id'] = $id;
        
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
    
    function submit()
    {
      
       $data->suc=$this->input->post('suc');
       $data->status='A';
       $this->db->set('fecha', 'now()', false);
       $this->db->insert('pedido_esp_c', $data);
       $id=$this->db->insert_id();
       redirect('captura_pedido1/captura_esp/'.$id);
        
    }
    
    function submit_pedido_esp()
    {
        
        $this->load->model('captura_pedidomodel1');
        $mensaje = $this->captura_pedidomodel1->guardar_pedido_esp();
        redirect('captura_pedido1/captura_esp/'.$this->input->post('id'));
    
    }
    
    function borrar_clave($p_id, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pedido_esp_d');
        redirect('captura_pedido1/captura_esp/'.$p_id);
    }
    
    function borrar_pedido( $id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pedido_esp_c');
        redirect('captura_pedido1/pedidos_en_captura/');
    }
    
    
    
    function cerrar_pedido($id)
    {
        $this->load->helper('file');
        
        $this->db->where('id', $id);
        $query2 = $this->db->get('pedido_esp_c');
        
        $row2 = $query2->row();
        
        $string = null;
        $string.= '>'.str_pad($row2->suc, 4, '0', STR_PAD_LEFT).'.'.date('dmy')."\r\n";
        $string.= '    PEDIDO+'."\r\n";
        $string.= '>08+'."\r\n";
        
        $this->db->where('p_id', $id);
        $query = $this->db->get('pedido_esp_d');
        
        foreach($query->result() as $row)
        {
            $string.= str_pad($row->clave, 13, '0', STR_PAD_LEFT).' '.str_pad($row->cantidad, 4, '0', STR_PAD_LEFT).'+'."\r\n";
        }
        
        $string.= '>92+';
        $archivo = str_pad($row2->suc, 4, '0', STR_PAD_LEFT).date('dm').'_especial.pgea';
        $ruta = './archivos/';
        write_file($ruta.$archivo, $string);
        
        
        $this->load->model('contactos');
        $this->contactos->inserta_archivos($archivo, 1000, null);
 
        
        echo '<pre>';
        echo $string;
        echo '</pre>';
        
        
        $this->db->where('id', $id);
        $this->db->delete('pedido_esp_c');
        $this->db->where('p_id', $id);
        $this->db->delete('pedido_esp_d');
        redirect('captura_pedido1/historico_de_pedidos_esp');
        
        
    }
    
    public function pedidos_en_captura()
    {
        $this->load->model('captura_pedidomodel1');
        $data['contenido'] = "pedidos_en_captura";
        $data['sidebar'] = "sidebar";
      
        $data['tabla'] = $this->captura_pedidomodel1->pedidos_pendientes();
   

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function historico_de_pedidos_esp()
    {
        
        $this->load->library('pagination');
        $this->load->model('captura_pedidomodel1');
        $config['base_url'] = site_url()."/captura_pedido1/historico_de_pedidos_esp";
        $config['total_rows'] = $this->captura_pedidomodel1->cuenta_historico_pedidos_esp();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '50'; 

        $this->pagination->initialize($config); 

        $data['contenido'] = "historico_de_pedidos_esp";
        $data['sidebar'] = "sidebar";
        $data['tabla'] = $this->captura_pedidomodel1->historico_pedidos_esp($config['per_page'], $this->uri->segment(3));
       
   

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    public function imprime($fol,$suc)
    {
     $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta($suc,$fol);  
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"5\" align=\"center\"><strong>PREVIO DE PEDIDOS</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
           <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
            <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
           </tr>
            <tr>
           <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
          </tr>
           </table> 
            ";
            $data['fol']=$fol;
            $this->load->view('impresiones/previo_de_pedidos_especial', $data);
            
		}      
        


    function borrar($fol)
    {
    $this->load->model('pedidos_model');
    $this->pedidos_model->delete_member($fol);
    redirect('captura_pedido1/historico_de_pedidos_esp');
    }
    
    function busca_folio()
    {
        $this->load->model('captura_pedidomodel1');
        echo $this->captura_pedidomodel1->busca_folio();
    }
    
    
    
}
    
    