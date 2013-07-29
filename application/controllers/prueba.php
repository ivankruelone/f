<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prueba extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //$this->esta_logeado();
        
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
    $this->load->library('user_agent');
    
    if ($this->agent->is_browser()) 
    { 
    $agent = $this->agent->browser().' '.$this->agent->version(); 
    } 
    elseif ($this->agent->is_robot()) 
    { 
    $agent = $this->agent->robot(); 
    } 
    elseif ($this->agent->is_mobile()) 
    { 
    $agent = $this->agent->mobile(); 
    } 
    else 
    { 
    $agent = 'Unidentified User Agent'; 
    }    

    echo $agent; 

    echo $this->agent->platform();// Platform info (Windows, Linux, Mac, etc.)
    
    
    
    }
    
    
    public function ta($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
$client = new nusoap_client("http://201.151.238.52/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false);
$client->soap_defencoding = 'UTF-8';

$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
// This is an archaic parameter list
$params = array(
                    'user'		    => 'ivankruel',
                    'password'		=> 'garigol',
                    'sucursal'      => $sucursal,
                    'fecha'         => $fecha
                    );


$result = $client->call('MontoSucursalDia', $params, 'http://ResultadoWSDL', 'ResultadoWSDL#MontoSucursalDia');

if ($client->fault) {
	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
        return $result['monto'];
        
	}
}

        
        
        
        
        
        
        

        
    }
    
    
    
    function vacas()
    {
        $this->load->view('impresiones/vacas');
    }
    
    function masvacas()
    {
        echo anchor('prueba/vacas', 'click aki', array('target' => '_blank'));
    }
    
}