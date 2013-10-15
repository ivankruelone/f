<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class In_r extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('directory');
        $this->load->library('unzip');
        $this->load->model('in_model');
        
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
        ini_set('memory_limit','2000M');
        //Ruta de archivos de lectura
        $ruta = 'e:/pdvsube/infosucursales/lid/';
        //Ruta donde se desempacan los archivos
        $in = 'e:/in/';
        
        //Leo el directorio
        $map = directory_map($ruta);
        
        //Ciclo el arreglo de la lectura
        foreach($map as $archivo){
            
            $valida_ex = explode('.', $archivo);
            
            //Validar que sea archivo empacado en .zip
            if(strtolower($valida_ex[1]) == 'zip'){
            
            //desempaco en directorio in
            $this->unzip->extract($ruta.$archivo, $in.$valida_ex[0].'/');
            
            //Lee la Carpeta recien creada
            $this->__leer_nueva_carpeta($in, $valida_ex[0]);
            
            }
            
            unlink($ruta.$archivo);

        }
        
    }
    
    
    function __leer_nueva_carpeta($in, $carpeta)
    {
     set_time_limit(0);
        $map = directory_map($in.$carpeta);
        //Ciclo el arreglo de la lectura
        foreach($map as $archivo){
            
            $valida_ex = explode('.', $archivo);
            
            //Validar que sea archivo empacado en .zip
            if(strtolower($valida_ex[1]) == 'crt'){
                //$this->__crt($in, $carpeta, $archivo);
            }elseif(strtolower($valida_ex[1]) == 'txt'){
                $this->in_model->rv_compra_sola($in, $carpeta, $archivo);
            }
        
        }
    
    }
 //////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////   
  

}