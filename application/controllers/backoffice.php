<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backoffice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        //$this->load->model('inv_model');
        
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
    $data['contenido'] = "back_index";
    $data['selector'] = "backindex";
    $data['sidebar'] = "sidebar_back";
    //$data['query'] = $this->inv_model->inv_todos();
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

  public function tabla_catalogo()
    {
    $data['mensaje']= '';
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_ofertas_back();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "backcat";
        $data['sidebar'] = "sidebar_back";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
    public function catalogo()
    {
        $data['contenido'] = "back_cat";
        $data['selector'] = "backcat";
        $data['sidebar'] = "sidebar_back";
    
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

    function actualiza_catalogo()
    {
        $this->load->library('ftp');

        $config['hostname'] = 'fenixCentral01.homeip.net';
        //$config['username'] = 'Catalogo';
        //$config['password'] = 'C4talogo1234';
        $config['debug']	= TRUE;

        $config['username'] = 'administrador';
        $config['password'] = 'PharmaF3n1x';

        
        $this->ftp->connect($config);
        $this->ftp->download('/Catalogo/CatalogoP2.txt', './backoffice/CatalogoP2.txt');
        
        $this->db->empty_table('catbackoffice');
        $sql = "LOAD DATA INFILE 'C:/wamp/www/f/backoffice/CatalogoP2.txt' REPLACE INTO TABLE desarrollo.catbackoffice
FIELDS TERMINATED BY ',\t'
LINES TERMINATED BY '\r\n'
(ean, descripcion, precio, con, linea, tasa)
SET fecha = now();";
        $this->db->query($sql);
        
        $sql_act_cat = "update 
        catbackoffice o, facturacion.concepto c
        set 
        c.descripcion = o.descripcion, 
        c.precio = o.precio, 
        iva = CASE WHEN tasa = 'TASA AL 0%' THEN 0 ELSE 1 END, 
        familia = linea,
        updated_at = now()
        where o.ean = c.ean and o.ean > 1000;";
        
        $this->db->query($sql_act_cat);
        
        $sql_insert_faltantes = "insert into facturacion.concepto (cia_id, suc_id, ean, descripcion, unidad, precio, iva, r1, familia, created_at, updated_at, tipo)(select 1, 80001, ean, descripcion, 'PIEZA', precio, CASE WHEN tasa = 'TASA AL 0%' THEN 0 ELSE 1 END, 0, linea, now(), now(), 'A' from desarrollo.catbackoffice where ean not in(select ean from facturacion.concepto) group by ean);";
        
        $this->db->query($sql_insert_faltantes);
        
        
        $this->catalogo();
        
    }
















    
    public function inventarios()
    {
    $data['contenido'] = "back_inv";
    $data['selector'] = "backinv";
    $data['sidebar'] = "sidebar_back";
    //$data['query'] = $this->inv_model->inv_todos();
    $data_c['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/AjaxUpload.2.0.min.js\"></script>
        ";

    
    $this->load->view('header', $data_c);
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }

    function upload()
    {
        $this->load->helper('file');
        $movido_a = $this->_crear_directorios();
        $uploaddir = './archivos/';
        $file = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $file;

        if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
            
            $var = get_file_info('./archivos/'.$file);
            $string = read_file('./archivos/'.$file);
                
                
            if($var['size'] <= 60){
                unlink('./archivos/'.$file);
                $a = "
                <p class=\"message-box error\">Error: $file - Tu archivo esta vacio, generalo de nuevo.</p>
                ";
                echo $a;  
                    
                
            }else{
                $this->load->model('in_model');
                $this->in_model->inv_backoffice('./archivos/'.$file);
            }
        
        
            //Movido de archivo
            if(file_exists('./archivos/'.$file)){
                copy('./archivos/'.$file, $movido_a.'otros/'.$file);
            }
        
        

        }else{
            echo "error";
        }

    }
    
    function tabla_pedidos()
    {
        $this->load->view('contenidos/back_tabla_pedidos');
    }

    function _crear_directorios()
    {
        $fecha = date('Y_m_d');
        $ruta = './resp/'.$fecha.'/';

        if(file_exists($ruta)){

        }else{
            mkdir($ruta);
            mkdir($ruta.'pge/');
            mkdir($ruta.'inv/');
            mkdir($ruta.'rv/');
            mkdir($ruta.'otros/');
            mkdir($ruta.'pdf/');
        }
        
        return $ruta;
    }
    
    function procesa()
    {
        set_time_limit(0);
        $this->load->helper('directory');
        $map = directory_map('./resp/2012_03_30/otros/');
        echo '<pre>';
        print_r($map);
        echo '</pre>';
        $this->load->model('in_model');
        
        foreach($map as $file){
            echo "$file<br />";
            $this->in_model->inv_backoffice('./archivos/'.$file);
        }
        
        redirect('backoffice/inventarios');

        
    }
    function inv_ftpback(){
        $this->load->library('ftp');
        $this->load->helper('directory');
        $this->db->empty_table('invbacktemp'); 

        $config['hostname'] = 'fenixCentral01.homeip.net';
        //$config['username'] = 'Catalogo';
        //$config['password'] = 'C4talogo1234';

        $config['username'] = 'administrador';
        $config['password'] = 'PharmaF3n1x';
        $config['debug']	= TRUE;
        //$config['username'] = 'Catalogo';
        //$config['password'] = 'Ca123456';
        
        $this->ftp->connect($config);
        
        $list = $this->ftp->list_files('/Catalogo/');
        
        //print_r($list);
        
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
            $sql_temp = "LOAD DATA INFILE 'C:/wamp/www/f/backoffice/$archivo' REPLACE INTO TABLE desarrollo.invbacktemp
FIELDS TERMINATED BY '||'
LINES TERMINATED BY '\r\n'
(ean, can, fecha)
set suc = $var[0]
";
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
        
        //redirect('backoffice/inventarios');
    }
    





}