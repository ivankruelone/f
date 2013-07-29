<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class In extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
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
        $ruta = 'e:/pdvsube/infosucursales/';
        //Ruta donde se desempacan los archivos
        $in = 'e:/in/';
        $respaldo = 'e:/pdvsube/infosucursales/backup/';
        
        //Leo el directorio
        $map = directory_map($ruta);
        
        //Ciclo el arreglo de la lectura
        foreach($map as $archivo){
            
            if(is_file($ruta.$archivo)){
                
                echo $archivo;
                
                $valida_ex = explode('.', $archivo);
                
                //Validar que sea archivo empacado en .zip
                if(strtolower($valida_ex[1]) == 'zip'){
               
                //desempaco en directorio in
                $this->unzip->extract($ruta.$archivo, $in.$valida_ex[0].'/');
                
                //Lee la Carpeta recien creada
                $this->__leer_nueva_carpeta($in, $valida_ex[0]);
                
                }
                if(copy($ruta.$archivo, $respaldo.$archivo)){
                    echo " ok<br />";
                }else{
                    echo " mal<br />";
                }
                unlink($ruta.$archivo);
            
            }


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
                $this->__crt($in, $carpeta, $archivo);
            }elseif(strtolower($valida_ex[1]) == 'txt'){
                $this->in_model->rv_ad($in, $carpeta, $archivo);
                $this->in_model->rv($in, $carpeta, $archivo);
                $this->in_model->rv_can($in, $carpeta, $archivo);
                unlink($in.$carpeta.'/'.$archivo);
            }elseif(strtolower($valida_ex[1]) == 'inv'){
                $this->__inv($in, $carpeta, $archivo);
            }else{
                unlink($in.$carpeta.'/'.$archivo);
            }
        }
    
    //$this->in_model->actializa_cancelado();
    }
    
    function __crt($in, $carpeta, $archivo)
    {
        $this->load->model('cortes_model');
        copy($in.$carpeta.'/'.$archivo, './cortes/'.$archivo);
        $this->cortes_model->inserta_archivos($archivo, 1000, null);
        unlink($in.$carpeta.'/'.$archivo);
    }

    function __inv($in, $carpeta, $archivo)
    {
        copy($in.$carpeta.'/'.$archivo, './inv/'.$archivo);
        $this->in_model->inv($in, $carpeta, $archivo);
        unlink($in.$carpeta.'/'.$archivo);
    }
    
 ///////////////////////////////////////////////////////respaldos para el as400
 ///////////////////////////////////////////////////////respaldos para el as400
 ///////////////////////////////////////////////////////respaldos para el as400   
    function respaldo()
    {
    $this->load->model('respaldo_model');
    $this->respaldo_model->catalogo();    
    }
    
}