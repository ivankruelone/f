<?php
class Catalogo_externo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function catalogo_saba()
    {
        $data['titulo'] = 'Catalogo Externo Saba';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_blanco";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    public function subida_saba()
    {
        $data['titulo'] = 'Subida Catalogo Externo Saba';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "catalogo_externo_subida_saba";
        $data['selector'] = "subida";
        $data['sidebar'] = "sidebar_blanco";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    function do_upload_saba()
    {
        error_reporting(E_ALL);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->load->helper('path');
        $directory = './archivos';

        if ($_FILES["file"]["error"] > 0) {
            redirect('catalogo_externo/subida_saba');
        } else {

            $archivo = $_FILES["file"]["name"];
            $extension = explode('.', $archivo);
            $extension = $extension[count($extension) - 1];
            $extension = strtolower($extension);

            if ($extension == 'xls') {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], set_realpath($directory) . $_FILES["file"]["name"])) {

                    $filePath = $directory . '/' . $_FILES["file"]["name"];

                    $data['filePath'] = $filePath;

                    $this->load->view('contenidos/saba', $data);
                    redirect('catalogo_externo/subida_saba');


                }
            } else {
                redirect('catalogo_externo/subida_saba');
            }


        }
    }

}
?>