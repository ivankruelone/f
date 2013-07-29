<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inv extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->model('inv_model');
        
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
    $data['contenido'] = "inv_todos";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->inv_todos();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    public function inventario_sucursal()
    {
    $data['contenido'] = "inv_xsucursal";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->inv_xsucursal();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    
    public function inv_pendientes()
    {
    $data['contenido'] = "inv_todos";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->inv_pendientes();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }

    public function detalle($suc)
    {
    $data['contenido'] = "inv_detalle";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->detalle_suc_07($suc);
    $data['query2'] = $this->inv_model->detalle_suc_03($suc);
    $data['suc'] = $this->inv_model->titulo_sucursal($suc);
    $data['sucursal'] = $suc;
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }

    public function con_clave_generica()
    {
    $data['contenido'] = "inv_por_clave_generica";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->con_clave_generica();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    public function sin_clave_generica()
    {
    $data['contenido'] = "inv_por_clave_generica";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->sin_clave_generica();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }

    public function inv_findemes()
    {
    $data['contenido'] = "inv_todos";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->inv_findemes();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }

    public function inv_pendientes_findemes()
    {
    $data['contenido'] = "inv_todos";
    $data['selector'] = "inv";
    $data['sidebar'] = "sidebar_inv";
    $data['query'] = $this->inv_model->inv_pendientes_findemes();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    function inv_ftpback(){
        $this->load->library('ftp');
        $this->load->helper('directory');
        $this->db->empty_table('invbacktemp'); 

        $config['hostname'] = 'fenixCentral01.homeip.net';
        $config['username'] = 'Catalogo';
        $config['password'] = 'Ca123456';
        $config['debug']	= TRUE;
        
        $this->ftp->connect($config);
        
        $list = $this->ftp->list_files('/Catalogo/');
        foreach($list as $file){
            $this->ftp->download('/Catalogo/'.$file, './backoffice/'.$file);
        }
        
        $map = directory_map('./backoffice/');
        
        foreach($map as $archivo){
            
            $var = explode('.', $archivo);
            
            if(strtolower($var[1]) == 'txt' && $var[0] != 'CatalogoP2'){
            
            $sql = "LOAD DATA INFILE 'C:/wamp/www/f/backoffice/$archivo' REPLACE INTO TABLE desarrollo.invbacktemp
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\r\n'
(ean, can)
set suc = $var[0],
fecha = date(now())";
                if($this->db->query($sql)){
                    
                }
            }
        }
        
        $sql_delete = "SELECT suc FROM invbacktemp group by suc;";
        $query = $this->db->query($sql_delete);
        foreach($query->result() as $row)
        {
            $this->db->delete('inv', array('suc' => $row->suc)); 
        }
        
        $sql_inserta = "insert into desarrollo.inv (SELECT tipo2, i.suc, 3, ean, sum(can) as can, fecha, now(), 0, cia, 0 FROM invbacktemp i
left join catalogo.sucursal s on i.suc = s.suc group by i.suc, ean);";
        $this->db->query($sql_inserta);
        

        
        $data['list'] = $map;
        
        $this->ftp->close();
        
        $data['contenido'] = "inv_back_ftp";
        $data['selector'] = "inv";
        $data['sidebar'] = "sidebar_inv";
        //$data['query'] = $this->inv_model->inv_findemes();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
public function inv_x_clave()
    {
        $this->load->model('inv_model');
        $data['tabla'] = '';
        $data['contenido'] = "clave";
        $data['selector'] = "inv";
        $data['sidebar'] = "sidebar_blanco";
        $data['clave'] = $this->inv_model->busca_clave();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
function submit_inv_x_clave()
    {
        $id= $this->input->post('clave');
        
        $this->load->model('inv_model');
        $data['clave'] = $this->inv_model->busca_clave();
        $data['tabla'] = $this->inv_model->datos_clave($id);
        $data['titulo'] = "INVENTARIO POR CLAVE";
        $data['contenido'] = "clave";
        $data['selector'] = "inv";
        $data['sidebar'] = "sidebar_blanco";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }


/////////////////////////////////////////////
//////////////////////////////////////////////





}