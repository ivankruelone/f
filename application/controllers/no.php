<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class No extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $this->load->library('user_agent');
        $agent = strtolower($this->agent->agent_string());

        echo "<h1>No estas usando Mozilla Firefox</h1>";
        echo "<h2>$agent</h2>";
        
        echo "Mozilla Firefox es necesario para el optimo funcionamiento de las aplicaciones contenidas en este portal.<br />";
        echo "Eres un Contador de Fenix y tienes un equipo nuevo. Descargalo aqui <a href=\"http://www.mozilla.org/products/download.html?product=firefox-11.0&os=win&lang=es-MX\" target=\"_blank\">Mozilla Firefox</a><br />";
        
        echo "<br />";
        echo "<br />";
        
        echo "Eres de una sucursal y tienes un equipo con windows 98. ".anchor('no/baja_firefox2', 'Descargalo aqui.');

    }
    
    
    function baja_firefox2()
    {
        $this->load->helper('download');
        $data = file_get_contents("./programas/mozilla-firefox-2.0.0.20.exe"); // Read the file's contents
        $name = 'firefox2.exe';
        force_download($name, $data);
    }


}