<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $agent = strtolower($this->agent->agent_string());
        //$d = stristr($agent, 'android');
        
        $e = stristr($agent, 'firefox');
        
        //$g = stristr($agent, 'chrome');

        //if ($this->agent->is_mobile()){
        //    redirect('mobile');
        //}elseif(strlen($d) > 0){
        //    redirect('mobile');
        //if(strlen($e) == 0){
        //    redirect('no');
        //}
        
    }
    

    public function index()
    {
        $this->load->library('pagination');
        $this->load->model('paginas');
        
        $config['base_url'] = site_url()."/welcome/index";
        $config['total_rows'] = $this->paginas->cuenta();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '3'; 

        $this->pagination->initialize($config); 

        $data['contenido'] = "sitios";
        $data['sidebar'] = "sidebar_welcome";
        $data['selector'] = "welcome";
      
$data_header['extraheader'] = "<link type=\"text/css\" href=\"".base_url()."jeremyfry-PikaChoose-dd3d412/styles/css3.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"".base_url()."jeremyfry-PikaChoose-dd3d412/lib/jquery.pikachoose.js\"></script> 
<script language=\"javascript\">
    $(document).ready(function (){".
    $this->paginas->construye_pika($config['per_page'], $this->uri->segment(3))
    ."
    });
</script>
";
        
        
        $data['sitios'] = $this->paginas->construye_pika($config['per_page'], $this->uri->segment(3));
        $data['categorias'] = $this->paginas->categorias();


        $this->load->view('header', $data_header);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }



    public function categoria($categoria)
    {
        $this->load->model('paginas');
        
        $data['contenido'] = "sitios";
        $data['sidebar'] = "sidebar_welcome";
        $data['selector'] = "welcome";
        
        $data_header['extraheader'] = "<link type=\"text/css\" href=\"".base_url()."jeremyfry-PikaChoose-dd3d412/styles/css3.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"".base_url()."jeremyfry-PikaChoose-dd3d412/lib/jquery.pikachoose.js\"></script> 
<script language=\"javascript\">
    $(document).ready(function (){".
    $this->paginas->construye_categoria($categoria)
    ."
    });
</script>
";
        
        
        $data['sitios'] = $this->paginas->trae_sitios_categoria($categoria);
        $data['categorias'] = $this->paginas->categorias();


        $this->load->view('header', $data_header);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }


}

