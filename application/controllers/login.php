<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    
    function index($error = null)
    {
        $data['error'] = $error;
        $this->load->view('login/login', $data);
    }
    
    function navegador()
    {
        $this->load->library('user_agent');
        $agent = strtolower($this->agent->agent_string());
        $e = stristr($agent, 'firefox');
        $d = stristr($agent, 'safari');
        
        if(strlen($e) > 0 || strlen($d) > 0){

        }else{
      		$this->session->sess_destroy();
            redirect('no');
        }
    }
	
    function navegador2()
    {
        $this->load->library('user_agent');
        $agent = strtolower($this->agent->agent_string());
        $e = stristr($agent, 'firefox');
        $d = stristr($agent, 'safari');
        
        if(strlen($e) == 0){
      		//$this->session->sess_destroy();
            //redirect('no');
        }
    }

	function validate_credentials()
	{		
		$this->load->model('miembros_model');
		$query = $this->miembros_model->validate();
		
		if($query->num_rows == 1) // if the user's credentials validated...
		{
		  $row = $query->row();
		  
          if($row->nivel == 5000 || $row->nivel == 50 || $row->nivel == 51 || $row->nivel == 54 || $row->nivel == 40)
          {

          }else{
            $this->navegador();
          }
            
            $data = array(
				'username' => $row->username,
				'is_logged_in' => true,
                'nivel' => $row->nivel,
                'nombre' => $row->nombre,
                'id' => $row->id,
                'tipo' => $row->tipo,
                'puesto' => $row->puesto,
                'email' => $row->email,
                'suc' => $row->suc,
                'nom_suc' => $row->nom_suc,
                'razon' => $row->razon,
                'plaza' => $row->plaza,
                'cia'   => $row->cia,
                'plaza_nombre'  => $row->plaza_nombre,
                'id_plaza'  => $row->id_plaza,
                'nomina'    => $row->nomina
			);
			$this->session->set_userdata($data);
    
            if($row->nivel == 6){
                redirect('facturas_juridico');
            }elseif($row->nivel == 13){
                redirect('backoffice');
            }elseif($row->nivel == 50){
                redirect('checador/admin');
            }elseif($row->nivel == 51){
                redirect('checador/gerente');
            }elseif($row->nivel == 54){
                redirect('checador/gerente_ger');
            }elseif($row->nivel == 5000){
                redirect('checador');
            }elseif($row->nivel == 40){
                redirect('gente');
            }else{
        		redirect('contacto');
            }
		}
		else // incorrect username or password
		{
			redirect('contacto');
		}
	}

	
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('contacto', 'refresh');
	}

}