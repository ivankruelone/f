<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Envio_externo extends CI_Controller {

///////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////
 public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('directory');
        $this->load->library('unzip');
        $this->load->model('envio_model_for');
        
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
///////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////
    
   

    public function nilsen_e()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $fec1='2012-07-16';
    $fec2='2012-07-22';
    $sem=29;
    $this->envio_model_for->nilsen($fec1,$fec2,$sem);
    }
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
    
    public function noblock_e()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $this->envio_model_for->noblock();
    }

//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
    
    public function ims_e()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $this->envio_model_for->ims();
    }

//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
   
    public function inv_contabilidad()
    { 
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $this->load->model('envio_model_as400');
    $this->envio_model_as400->inv_conta();
    }


//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
   public function poliza_almacen_e()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $this->load->model('envio_model_as400');
    $this->envio_model_as400->poliza_almacen();
    }

//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
   public function poliza_almacenexel_e()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $this->load->model('envio_model_as400');
    $this->envio_model_as400->poliza_almacen_exel();
    }


//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
   
}