<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Historia extends CI_Controller
{

    public function index()
    {
        $data['contenido'] = "historia";
        $data['selector'] = "historia";
        

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
