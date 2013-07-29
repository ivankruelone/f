<?php
class Acceso extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->esta_logeado();
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }    

}