<?php
class Checador extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->model('checador_model');
        $this->asigna_password();
        $this->load->helper('funciones');
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if ($logeado == null) {
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['vista'] = 'sitio2/checador/indice';
        $data['menu'] = 'home';
        $this->load->view('site2', $data);
    }
    
    public function busca_nomina()
    {
        $nomina = $this->input->post('nomina');
        $id = $this->checador_model->get_id_from_nomina($nomina);
        $data['vista'] = 'sitio2/checador/perfil_usuario2';
        $data['js'] = 'sitio2/checador/perfil_usuario2_js';
        $data['query'] = $this->checador_model->get_atributos_empleado_nomina($nomina);
        $data['vacaciones'] = $this->checador_model->get_vacaciones_nomina($nomina);
        $data['incapacidades'] = $this->checador_model->get_incapacidades($nomina);
        $data['incidencias'] = $this->checador_model->get_incidencias_empleado_id($id);
        $data['empiricos'] = $this->checador_model->get_totales_empiricos_julio_2013();
        $data['reales'] = $this->checador_model->get_totales_reales_julio_2013($id);
        $data['menu'] = 'perfil';
        $this->load->view('site2', $data);
    }
    
    public function ayuda()
    {
        $data['vista'] = 'sitio2/checador/ayuda';
        $data['js'] = 'sitio2/checador/ayuda_js';
        $data['menu'] = 'ayuda';
        $data['query'] = $this->checador_model->get_ayuda();
        $this->load->view('site2', $data);
    }
    
    public function rh()
    {
        $data['vista'] = 'sitio2/checador/rh';
        $data['js'] = 'sitio2/checador/rh_js';
        $data['menu'] = 'ayuda';
        $this->load->view('site2', $data);
    }
    
    public function bajar_reglamento_comedor()
    {
        $this->load->helper('download');
        $name = 'COMEDOR.pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function bajar_reglamento_incidencias()
    {
        $this->load->helper('download');
        $name = 'REGLAMENTO DE INCIDENCIAS.pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function bajar_reglamento_vacaciones()
    {
        $this->load->helper('download');
        $name = 'REGLAMENTO DE VACACIONES DE LEY.pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function bajar_reglamento_vacaciones_adicionales()
    {
        $this->load->helper('download');
        $name = 'REGLAMENTO DE VACACIONES (PREST.ADIC.).pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function bajar_codigo_conducta()
    {
        $this->load->helper('download');
        $name = 'CODIGO DE CONDUCTA.pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function bajar_codigo_vestimenta()
    {
        $this->load->helper('download');
        $name = 'CODIGO DE VESTIR.pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function bajar_tutorial()
    {
        $this->load->helper('download');
        $name = 'tuchecador.pdf';
        $data = file_get_contents("./documentos/".$name); // Read the file's contents

        force_download($name, $data); 
    }

    public function admin()
    {
        $data['vista'] = 'sitio2/checador/indice';
        $data['menu'] = 'home';
        $this->load->view('site2', $data);
    }

    public function perfil_usuario()
    {
        $data['vista'] = 'sitio2/checador/perfil_usuario';
        $data['js'] = 'sitio2/checador/perfil_usuario_js';
        $data['query'] = $this->checador_model->get_atributos_empleado();
        $data['menu'] = 'perfil';
        $this->load->view('site2', $data);
    }

    public function cambio_password()
    {
        $data['vista'] = 'sitio2/checador/cambio_password';
        $data['menu'] = 'perfil';
        $this->load->view('site2', $data);
    }

    public function do_cambio_password()
    {
        $resultado = $this->checador_model->valida_cambio_password();
        if ($resultado === true) {
            redirect('checador/perfil_usuario');
        } else {
            redirect('checador/cambio_password');
        }
    }

    function upload_avatar()
    {
        $uploaddir = './img/avatar/';
        $file = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $file;

        $config['image_library'] = 'gd2';
        $config['source_image'] = $uploadfile;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 400;
        $config['height'] = 400;
        $config['master_dim'] = 'auto';

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $this->load->model('miembros_model');

            echo $this->miembros_model->update_avatar_cat_empleado($file);
        } else {
            echo "error";
        }

    }

    function nombre_comprobante($id)
    {
        $this->load->helper('string');
        $sql = "SELECT max(SUBSTRING_INDEX(imagen, '.', 1)) as imagen_alt FROM checador_comprobantes c where c_id = ?;";
        $query = $this->db->query($sql, $id);
        
        echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            if($row->imagen_alt == null){
                echo $id;
            }else{
                echo increment_string($row->imagen_alt);
            }
            
        }else{
            echo $id;
        }
        
    }

    function upload_comprobante($id)
    {
        $nombre = $this->checador_model->nombre_comprobante($id);

        $uploaddir = './img/comprobantes/';
        $file = basename($_FILES['userfile']['name']);
        $ext = explode('.', $file);
        $cuenta = count($ext);
        if($cuenta > 0){
            $extension = $ext[$cuenta - 1];
        }else{
            $extension = null;
        }
        $file = $nombre.'.'.$extension;
        $uploadfile = $uploaddir . $file;

        $config['image_library'] = 'gd2';
        $config['source_image'] = $uploadfile;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 600;
        $config['height'] = 600;
        $config['master_dim'] = 'auto';

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            
            echo $this->checador_model->insert_comprobante($file, $id);
        } else {
            echo "error";
        }

    }

    public function asistencias()
    {
        $data['vista'] = 'sitio2/checador/asistencias';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->get_registros();
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function asistencias_elige_quincena()
    {
        $data['vista'] = 'sitio2/checador/asistencias_elige';
        $data['js'] = 'sitio2/checador/asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }

    public function asistencias_tabla()
    {
        $data['vista'] = 'sitio2/checador/asistencias_tabla';
        $data['js'] = 'sitio2/checador/asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $periodo = $this->checador_model->get_quincena($this->input->post('quincena'));
        $row_periodo = $periodo->row();
        $data['query'] = $this->checador_model->get_asistencias_periodo($row_periodo->
            inicio, $row_periodo->fin);
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $row_periodo->inicio . " al " . $row_periodo->fin;
        $data['dias_laborados'] = $row_periodo->dias_laborados;
        $data['horas_laboradas'] = $row_periodo->horas_laboradas;
        $data['grafica1'] = $this->checador_model->grafica1($row_periodo->inicio, $row_periodo->fin, $row_periodo->horas_laboradas);
        $data['grafica2'] = $this->checador_model->grafica2($row_periodo->inicio, $row_periodo->fin, $row_periodo->dias_laborados);
        $data['grafica3'] = $this->checador_model->grafica3($row_periodo->inicio, $row_periodo->fin, $row_periodo->dias_laborados);
        
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function asistencias_tabla_periodo()
    {
        $data['vista'] = 'sitio2/checador/asistencias_tabla';
        $data['js'] = 'sitio2/checador/asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->get_asistencias_periodo($this->input->
            post('inicio'), $this->input->post('fin'));
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $this->input->post('inicio') . " al " . $this->input->post('fin');
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function calendario()
    {
        $data['vista'] = 'sitio2/checador/calendario';
        $data['js'] = 'sitio2/checador/calendario_js';
        $data['menu'] = 'asistencias';
        $this->load->view('site2', $data);
    }

    function eventos()
    {
        $query = $this->checador_model->get_asistencias_empleado();
        $a = array();
        foreach ($query->result() as $row) {
            $start = $row->entrada;
            $end = $row->salida;
            $color = "green";
            $title = $row->fecha;

            if ($row->falta == 1) {
                $allday = true;
                $start = $row->fecha;
                $end = null;
                $title = "FALTA";
            } else {
                $allday = false;
            }

            if ($row->retardo == 1) {
                $title = "RETARDO";
            }

            array_push($a, array(
                'id' => $row->id,
                'title' => $title,
                'start' => $start,
                'eventTextColor' => $color,
                'end' => $end,
                'allDay' => $allday));

        }

        echo json_encode($a);
    }

    function evento_dialogo($id)
    {
        $data['query'] = $this->checador_model->get_asistencias_id($id);
        $this->load->view('sitio2/checador/ver_evento', $data);
    }

    public function cargar_datos()
    {
        $data['vista'] = 'sitio2/checador/cargar_datos';
        $data['js'] = 'sitio2/checador/cargar_datos_js';
        $data['quincenas'] = $this->checador_model->get_quincenas_sanciones();
        $data['menu'] = 'cargar';
        $this->load->view('site2', $data);
    }

    function do_upload_subida()
    {
        ini_set("memory_limit","200M");
        $this->load->helper('path');
        $directory = './uploads';
        $submenu = $this->input->post('submenu');

        if ($_FILES["file"]["error"] > 0) {
            redirect('inv/subida/');
        } else {

            $archivo = $_FILES["file"]["name"];
            $extension = explode('.', $archivo);
            $extension = $extension[count($extension) - 1];
            $extension = strtolower($extension);

            if ($extension == 'txt') {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], set_realpath($directory) . $_FILES["file"]["name"])) {

                    $filePath = './uploads/' . $_FILES["file"]["name"];

                    $row = 1;
                    $a = array();
                    
                    $i= 1;

                    if (($handle = fopen($filePath, "r")) !== false) {
                        while (($data = fgetcsv($handle, 40, ",")) !== false) {
                            $num = count($data);
                            //echo "<p> $num fields in line $row: <br /></p>\n";
                            $row++;
                            for ($c = 0; $c < $num; $c++) {
                                //echo $data[$c] . "<br />\n";
                            }
                            //echo $i." - ".$data[0]."<br />";
                            if(isset($data[0]) && $num == 4){

                                $b = array(
                                    'equipo' => (int)$data[0],
                                    'checador_id' => (int)$data[1],
                                    'checado' => (string )$data[2] . ' ' . (string )$data[3]);
    
                                array_push($a, $b);
                            }
                            
                            $i++;

                        }
                        
                        //echo "<pre>";
                        
                        //echo "</pre>";
                        
                        $this->checador_model->inserta_datos($a);
                        fclose($handle);
                        redirect('checador/cargar_datos/');
                    }
                }
            } else {
                redirect('checador/cargar_datos/');
            }


        }
    }

    function do_procesar_datos()
    {
        $this->checador_model->procesar_datos();
        redirect('checador/cargar_datos/');
    }

    function generar()
    {
        $this->checador_model->calcular('2013-01-14');
        $this->checador_model->calcular('2013-01-15');
        $this->checador_model->calcular('2013-01-16');
        $this->checador_model->calcular('2013-01-17');
    }

    public function reporte1()
    {
        $data['vista'] = 'sitio2/checador/reporte1';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->get_registros();
        $data['tabla'] = $this->checador_model->get_asistencias_periodo_empleado($this->
            session->userdata('id'), '2013-02-01', '2013-02-15');
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function reporte1_pdf()
    {
        $data['tabla'] = $this->checador_model->get_asistencias_periodo_empleado($this->
            session->userdata('id'), '2013-02-01', '2013-02-15');
        $this->load->view('impresiones/asistencias_personal_columnas', $data);
    }

    //JEFE

    public function gerente()
    {
        $data['vista'] = 'sitio2/checador/indice';
        $data['menu'] = 'home';
        $this->load->view('site2', $data);
    }

    public function gerente_asistencias_elige_quincena()
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_elige';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }

    public function gerente_asistencias_tabla()
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $periodo = $this->checador_model->get_quincena($this->input->post('quincena'));
        $row_periodo = $periodo->row();
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_concentrado($row_periodo->inicio, $row_periodo->
            fin);
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $row_periodo->inicio . " al " . $row_periodo->fin;
        $data['inicio'] = $row_periodo->inicio;
        $data['fin'] = $row_periodo->fin;
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function gerente_asistencias_tabla_periodo()
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_concentrado($this->input->post('inicio'), $this->
            input->post('fin'));
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $this->input->post('inicio') . " al " . $this->input->post('fin');
        $data['inicio'] = $this->input->post('inicio');
        $data['fin'] = $this->input->post('fin');
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function gerente_detalle_empleado_periodo($empleado_id, $inicio, $fin)
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla_empleado';
        $data['js'] = 'sitio2/checador/gerente_asistencias_tabla_empleado_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_empleado($empleado_id, $inicio, $fin);
        $data['etiqueta'] = $inicio . " al " . $fin;
        $data['empleado'] = $this->checador_model->get_atributos_empleado_id($empleado_id);
        $data['empleado_id'] = $empleado_id;
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function gerente_incidencia_personal($empleado_id, $inicio, $fin, $id, $reedirecciona)
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencia_incidencia_personal';
        $data['js'] = 'sitio2/checador/gerente_asistencia_incidencia_personal_js';
        $data['menu'] = 'asistencias';
        $data['etiqueta'] = $inicio . " al " . $fin;
        $data['empleado'] = $this->checador_model->get_atributos_empleado_id($empleado_id);
        $data['justificaciones'] = $this->checador_model->get_justificaciones_incidencias();
        $data['registro'] = $this->checador_model->get_registro($id);
        $data['id'] = $id;
        $data['redirecciona'] = $reedirecciona;
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }
    
    function genera_incidencia()
    {
        $asistencia = $this->input->post('asistencia');
        $justificacion = $this->input->post('justificacion');
        $observaciones = $this->input->post('observaciones');
        
        echo $this->checador_model->inserta_incidencia($asistencia, $justificacion, $observaciones);
        
    }
    
    function formato_incidencias($incidencia)
    {
        $data['incidencia'] = $this->checador_model->get_incidencia_detalle($incidencia);
        $this->load->view('impresiones/asistencias_incidencias', $data);
    }

    function gerente_justificar($id)
    {
        $data['row'] = $this->checador_model->get_asistencias_id($id);
        $this->load->view('sitio2/checador/gerente_justificar', $data);
    }

    function gerente_comprobantes($id)
    {
        $data['row'] = $this->checador_model->get_asistencias_id($id);
        $this->load->view('sitio2/checador/gerente_comprobantes', $data);
    }

    function gerente_justificar_guardar()
    {
        echo $this->checador_model->gerente_justificar_guarda();
    }

    function gerente_justificar_quita($id)
    {
        echo $this->checador_model->gerente_justificar_quita($id);
    }
    ////////////////////////////////////////////////////////////////////////////////////////GERENTE
    public function gerente_ger()
    {
        $data['vista'] = 'sitio2/checador/indice';
        $data['menu'] = 'home';
        $this->load->view('site2', $data);
    }
    public function gerente_asistencias_elige_quincena_ger()
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_elige_ger';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }

    public function gerente_asistencias_tabla_ger()
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla_ger';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $periodo = $this->checador_model->get_quincena($this->input->post('quincena'));
        $row_periodo = $periodo->row();
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_concentrado_ger($row_periodo->inicio, $row_periodo->
            fin);
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $row_periodo->inicio . " al " . $row_periodo->fin;
        $data['inicio'] = $row_periodo->inicio;
        $data['fin'] = $row_periodo->fin;
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function gerente_asistencias_tabla_periodo_ger()
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla_ger';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_concentrado($this->input->post('inicio'), $this->
            input->post('fin'));
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $this->input->post('inicio') . " al " . $this->input->post('fin');
        $data['inicio'] = $this->input->post('inicio');
        $data['fin'] = $this->input->post('fin');
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function gerente_detalle_empleado_periodo_ger($empleado_id, $inicio, $fin)
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla_empleado_ger';
        $data['js'] = 'sitio2/checador/gerente_asistencias_tabla_empleado_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_empleado($empleado_id, $inicio, $fin);
        $data['etiqueta'] = $inicio . " al " . $fin;
        $data['empleado'] = $this->checador_model->get_atributos_empleado_id($empleado_id);
        $data['empleado_id'] = $empleado_id;
        $data['inicio'] = $inicio;
        $data['fin'] = $fin;
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    function gerente_justificar_ger($id)
    {
        $data['row'] = $this->checador_model->get_asistencias_id($id);
        $this->load->view('sitio2/checador/gerente_justificar', $data);
    }

    function gerente_justificar_guardar_ger()
    {
        echo $this->checador_model->gerente_justificar_guarda();
    }

    function gerente_justificar_quita_ger($id)
    {
        echo $this->checador_model->gerente_justificar_quita($id);
    }
    
    public function admin_justificaciones_elige_quincena2()
    {
        $data['vista'] = 'sitio2/checador/admin_justificaciones_elige_gerente';
        //$data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'reportes';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }
    
    public function admin_incidencias_elige_quincena()
    {
        $data['vista'] = 'sitio2/checador/admin_incidencias_elige_gerente';
        $data['menu'] = 'reportes';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }

    public function reporte_incidencias_gerente()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $data['vista'] = 'sitio2/checador/admin_incidencias_reporte';
        $data['menu'] = 'reportes';

        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->reporte_incidencias_faltas($row_periodo->inicio, $row_periodo->fin);
        $data['query2'] = $this->checador_model->reporte_incidencias_retardos($row_periodo->inicio, $row_periodo->fin);
        $data['etiqueta'] = "Reporte de incidencias del periodo del $row_periodo->inicio al $row_periodo->fin.";
        $this->load->view('site2', $data);
    }

    public function reporte_justificaciones_gerente()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi();
        $this->load->view('impresiones/asistencias_justificaciones_gerente', $data);
    }
    
    public function admin_justificaciones_elige_quincena3()
    {
        $data['vista'] = 'sitio2/checador/admin_horas_elige_gerente';
        //$data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'reportes';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }
    
    public function reporte_horas_gerente()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi();
        $this->load->view('impresiones/asistencias_horas_gerente', $data);
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////
    //Admin

    public function admin_asistencias_elige_quincena()
    {
        $data['vista'] = 'sitio2/checador/admin_asistencias_elige';
        $data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }

    public function admin_asistencias_tabla()
    {
        $data['vista'] = 'sitio2/checador/admin_asistencias_tabla';
        $data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $periodo = $this->checador_model->get_quincena($this->input->post('quincena'));
        $row_periodo = $periodo->row();
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_admin_concentrado($row_periodo->inicio, $row_periodo->
            fin);
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $row_periodo->inicio . " al " . $row_periodo->fin;
        $data['inicio'] = $row_periodo->inicio;
        $data['fin'] = $row_periodo->fin;
        $data['dias_laborados'] = $row_periodo->dias_laborados;
        $data['horas_laboradas'] = $row_periodo->horas_laboradas;
        $data['grafica4'] = $this->checador_model->grafica4($row_periodo->inicio, $row_periodo->fin, $row_periodo->horas_laboradas);
        $data['grafica5'] = $this->checador_model->grafica5($row_periodo->inicio, $row_periodo->fin, $row_periodo->dias_laborados);
        $data['grafica6'] = $this->checador_model->grafica6($row_periodo->inicio, $row_periodo->fin, $row_periodo->dias_laborados);
        
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function admin_asistencias_tabla_periodo()
    {
        $data['vista'] = 'sitio2/checador/admin_asistencias_tabla';
        $data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_admin_concentrado($this->input->post('inicio'), $this->
            input->post('fin'));
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $this->input->post('inicio') . " al " . $this->input->post('fin');
        $data['inicio'] = $this->input->post('inicio');
        $data['fin'] = $this->input->post('fin');
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function admin_gerente_asistencias_tabla_periodo($succ, $perini, $perfin)
    {
        $data['vista'] = 'sitio2/checador/gerente_asistencias_tabla';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->
            get_asistencias_periodo_gerente_concentrado($perini, $perfin, $succ);
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $perini . " al " . $perfin;
        $data['inicio'] = $perini;
        $data['fin'] = $perfin;
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }
    public function admin_gerente_asistencias_sin_huella()
    {
        $data['vista'] = 'sitio2/checador/admin_asistencias_tabla_sin_huella';
        $data['js'] = 'sitio2/checador/gerente_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['query'] = $this->checador_model->get_asistencias_sin_huella();
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = '';
        $data['inicio'] = '';
        $data['fin'] = '';
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }

    public function admin_reporte_asistencias_elige_quincena()
    {
        $data['vista'] = 'sitio2/checador/admin_reporte_asistencias_elige';
        $data['menu'] = 'reportes';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['sucursales'] = $this->checador_model->get_sucursales();
        $this->load->view('site2', $data);
    }

    public function admin_reporte_asistencias()
    {
        $quincena = $this->input->post('quincena');
        
        $datos = $this->checador_model->get_quincena($quincena);
        $row = $datos->row();
        $this->checador_model->procesar_datos_fecha($row->incio, $row->fin);

        $depto = $this->input->post('depto');
        $data['datos'] = $this->checador_model->get_arreglo($quincena, $depto);
        //$data['retardos'] = $this->checador_model->get_arreglo_retardos($quincena, $depto);
        //$data['faltas'] = $this->checador_model->get_arreglo_faltas($quincena, $depto);
        $data['justificaciones'] = $this->checador_model->get_reporte_juntificacion($quincena, $depto);
        $data['faltasyretardos'] = $this->checador_model->get_reporte_faltasyretardos($quincena, $depto);
        $this->load->view('impresiones/asistencias_personal_depto', $data);
    }

    public function formato_vacaciones()
    {
        $data['vista'] = 'sitio2/checador/formato_vacaciones';
        $data['js'] = 'sitio2/checador/formato_vacaciones_js';
        $data['menu'] = 'formatos';
        $data['query'] = $this->checador_model->get_vacaciones();
        $data['query2'] = $this->checador_model->get_periodos();
        $datos = $this->checador_model->get_atributos_empleado_id($this->session->userdata('id'));
        $data['datos'] = $datos->row();
        $this->load->view('site2', $data);
    }

    public function vacaciones_submit()
    {
        $this->load->model('vacaciones_model');
        $this->checador_model->guardar_vacaciones();
        redirect('checador/formato_vacaciones/');
    }

    function imprime($id)
    {
        $succ = $this->session->userdata('suc');

        $data['detalle'] = $this->checador_model->reporte_vacas($id, $succ);
        $data['id'] = $id;
        $data['succ'] = $succ;
        $this->load->view('impresiones/vacaciones', $data);
    }

    public function formato_vacaciones_historico()
    {
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['base_url'] = site_url() . "/checador/formato_vacaciones_historico";
        $config['total_rows'] = $this->checador_model->cuenta_historico_vacaciones();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '25';

        $this->pagination->initialize($config);

        $data['vista'] = 'sitio2/checador/his_vacaciones';
        $data['menu'] = 'vacaciones';
        $data['query'] = $this->checador_model->get_vacaciones1($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);


    }

    public function formato_vacaciones_validar()
    {
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['base_url'] = site_url() . "/checador/formato_vacaciones_validar";
        $config['total_rows'] = $this->checador_model->cuenta_vacaciones_novalidadas();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '25';

        $this->pagination->initialize($config);

        $data['vista'] = 'sitio2/checador/vacas_pendientesxvalidar';
        $data['menu'] = 'vacaciones';
        $data['query'] = $this->checador_model->get_vacaciones2($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);
    }

    public function formato_incidencias_validar()
    {
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['base_url'] = site_url() . "/checador/formato_incidencias_validar";
        $config['total_rows'] = $this->checador_model->cuenta_incidencias_novalidadas();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '25';

        $this->pagination->initialize($config);

        $data['vista'] = 'sitio2/checador/incidencias_pendientes_por_validar';
        $data['js'] = 'sitio2/checador/incidencias_pendientes_por_validar_js';
        $data['menu'] = 'incidencias';
        $data['query'] = $this->checador_model->get_incidencias_no_validadas($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);
    }
    
    function validar_incidencia($incidencia, $asistencia)
    {
        echo $this->checador_model->actualiza_incidencia($incidencia, 1, $asistencia);
    }

    function rechazar_incidencia($incidencia)
    {
        echo $this->checador_model->actualiza_incidencia($incidencia, 2);
    }

    public function formato_incidencias_historico()
    {
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['base_url'] = site_url() . "/checador/formato_incidencias_historico";
        $config['total_rows'] = $this->checador_model->cuenta_incidencias_validadas();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '25';

        $this->pagination->initialize($config);

        $data['vista'] = 'sitio2/checador/incidencias_pendientes_por_validar';
        $data['js'] = 'sitio2/checador/incidencias_pendientes_por_validar_js';
        $data['menu'] = 'incidencias';
        $data['query'] = $this->checador_model->get_incidencias_validadas($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);
    }

    function validar_vacaciones($id, $nomina)
    {
        $dias = $this->checador_model->get_dias_vacaciones($id);
        $query = $this->checador_model->get_periodos_pendientes($nomina);


        $dias_que_quedan = $dias;

        $this->db->trans_start();

        foreach ($query->result() as $row) {
            if ($dias_que_quedan <= $row->dias && $dias_que_quedan > 0) {

                $this->db->where('id', $row->id);
                $a = array('dias' => ($row->dias - $dias_que_quedan));
                $this->db->update('periodo_vacas_detaller', $a);


                $c = array(
                    'id_reg_vacaciones' => $id,
                    'id_periodo_pendiente' => $row->id,
                    'dias' => $dias_que_quedan,
                    'id_user' => $this->session->userdata('id'));
                $this->db->set('fecha_e', 'now()', false);
                $this->db->insert('reg_vacaciones_tomadas', $c);
                //id, id_reg_vacaciones, id_periodo_pendiente, dias, fecha_e, id_user

                $dias_que_quedan = 0;


            } elseif ($dias_que_quedan > $row->dias && $dias_que_quedan > 0) {

                $this->db->where('id', $row->id);
                $a = array('dias' => 0);
                $this->db->update('periodo_vacas_detaller', $a);

                $c = array(
                    'id_reg_vacaciones' => $id,
                    'id_periodo_pendiente' => $row->id,
                    'dias' => ($row->dias),
                    'id_user' => $this->session->userdata('id'));
                $this->db->set('fecha_e', 'now()', false);
                $this->db->insert('reg_vacaciones_tomadas', $c);


                $dias_que_quedan = $dias_que_quedan - $row->dias;

            }

        }

        $this->db->where('id', $id);
        $b = array('validado' => '1', 'id_validacion' => $this->session->userdata('id'));
        $this->db->set('fecha_validacion', 'now()', false);
        $this->db->update('reg_vacaciones', $b);

        $this->db->trans_complete();
        redirect('checador/formato_vacaciones_validar');
    }

    public function eliminar($id)
    {
        $this->load->model('checador_model');
        $this->checador_model->personal_eliminar($id);
        redirect('checador/formato_vacaciones_validar');
    }

    function formato_credencial()
    {
        $nomina = $this->session->userdata('nomina');

        $data['detalle'] = $this->checador_model->formato_credencial($nomina);
        //echo $data['detalle'];

        $this->load->view('impresiones/credencial', $data);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function formato_periodos()
    {

        $data['vista'] = 'sitio2/checador/formato_periodos';
        //$data['js'] = 'sitio2/checador/formato_vacaciones_js';
        $data['menu'] = 'formatos';
        $data['empleadox'] = $this->checador_model->busca_empleado();

        $this->load->view('site2', $data);
    }

    public function submit_periodo()
    {
        $empleadox = $this->input->post('nombre');

        $this->load->model('checador_model');

        $data['vista'] = 'sitio2/checador/tabla_periodo';
        $data['menu'] = 'vacaciones';
        $data['query2'] = $this->checador_model->get_periodos1($empleadox);
        $this->load->view('site2', $data);
    }
      public function submit_periodo_nomina($nomina)
    {
        $this->load->model('checador_model');
        $data['vista'] = 'sitio2/checador/tabla_periodo';
        $data['menu'] = 'vacaciones';
        $data['query2'] = $this->checador_model->get_periodos1($nomina);
        $this->load->view('site2', $data);
    }

    function editar_per($id)
    {
        $this->load->model('checador_model');

        $data['vista'] = 'sitio2/checador/editar_periodo';
        $data['menu'] = 'vacaciones';
        $data['query'] = $this->checador_model->editar_periodo_vac($id);
        $data['id'] = $id;
        $this->load->view('site2', $data);
    }

    function submit_p()
    {
        $id = $this->input->post('id');
        $dias = $this->input->post('dias');
        $nomina=$this->input->post('nomina');
        $id = $this->checador_model->editar_periodo_vacaciones($dias, $id);
        redirect('checador/submit_periodo_nomina/'.$nomina);

        //redirect('checador/formato_periodos/' . $id);
    }


    function __arreglo_anios_trabajados()
    {
        $sql = "SELECT c.cia, otorgados, nomina, floor(DATEDIFF(date(now() + interval 6 MONTH), fechahis)/365) as anios, fechahis, fechaalta
FROM catalogo.cat_empleado c
left join catalogo.cat_compa_nomina n on c.cia = n.cia
where tipo = 1 and fechahis <> '0000-00-00';";

        $sql2 = "SELECT * FROM periodo_vacas p;";

        $query = $this->db->query($sql);
        $a = array();

        $query2 = $this->db->query($sql2);

        $c = array();
        $d = array();
        foreach ($query2->result() as $row2) {
            $c[$row2->aaa] = $row2->dias;
            $d[$row2->aaa] = $row2->regalo;
        }


        $b = 0;
        foreach ($query->result() as $row) {
            $anio_inicial = (int)substr($row->fechahis, 0, 4) - 1;

            for ($i = 1; $i <= $row->anios; $i++) {

                $a[$b][$i]['anio'] = $i;
                $a[$b][$i]['cia'] = $row->cia;
                $a[$b][$i]['nomina'] = $row->nomina;
                $a[$b][$i]['anios'] = $row->anios;
                $a[$b][$i]['his'] = $row->fechahis;
                $a[$b][$i]['alta'] = $row->fechaalta;
                $a[$b][$i]['aaa1'] = $anio_inicial + $i;
                $a[$b][$i]['aaa2'] = $anio_inicial + $i + 1;
                if( $row->otorgados == 1 )
                {
                    $a[$b][$i]['dias'] = $c[$i] + $d[$i];
                }else
                {
                    $a[$b][$i]['dias'] = $c[$i];
                }
                

            }


            $b++;
        }

        return $a;
    }


    function inserta_periodos()
    {
        $a = $this->__arreglo_anios_trabajados();

        $b = "insert into periodo_vacas_detaller (cia, nomina, aaa1, aaa2, dias, aaa, dias_ley) values ";

        foreach ($a as $anio) {
            //id, cia, nomina, aaa1, aaa2, dias, aaa, dias_ley

            foreach ($anio as $dias) {
                $b .= "(" . $dias['cia'] . "," . $dias['nomina'] . "," . $dias['aaa1'] . "," . $dias['aaa2'] .
                    "," . $dias['dias'] . "," . $dias['anio'] . "," . $dias['dias'] . "),";
            }

        }

        $b = substr($b, 0, -1) . " on duplicate key update dias_ley = values(dias_ley);";

        $this->db->query($b);

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function formato_salidas()
    {
        $data['vista'] = 'sitio2/checador/formato_salidas';
        $data['js'] = 'sitio2/checador/formato_salidas_js';
        $data['menu'] = 'formatos';
        $data['titulo'] = "FORMATO DE SALIDAS DEL PERSONAL";
        $data['empleadox'] = $this->checador_model->busca_empleado1();
        $data['asuntox'] = $this->checador_model->selec_asunto();
        $data['regresox'] = $this->checador_model->regreso();
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['total_rows'] = $this->checador_model->cuenta_salidas();
        $config['base_url'] = site_url() . "/checador/formato_salidas";
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '10';

        $this->pagination->initialize($config);
        $data['query'] = $this->checador_model->historico_salidas($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);
    }

    public function salidas_submit()
    {

        $empleadox = $this->input->post('nombre');
        $empleadox1 = $this->input->post('nombre1');
        $empleadox2 = $this->input->post('nombre2');
        $empleadox3 = $this->input->post('nombre3');
        $empleadox4 = $this->input->post('nombre4');
        $asuntox = $this->input->post('asunto');
        $regresox = $this->input->post('regreso');

        $this->load->model('checador_model');

        $this->checador_model->guardar_salidas();

        redirect('checador/formato_salidas');

    }


    function imprime1($id_reg)
    {


        $this->load->model('checador_model');


        $data['cabeza'] = $this->checador_model->reporte_salida_encabezado();
        $data['detalle'] = $this->checador_model->reporte_salida1($id_reg);


        $data['id_reg'] = $id_reg;
        $this->load->view('impresiones/reporte_salida_de_personal', $data);

    }

    function imprime_entrega_usuarios()
    {
        $this->load->model('checador_model');
        $data['query'] = $this->checador_model->entrega_de_password();
        $this->load->view('impresiones/asistencias_entrega_usuario', $data);
    }


    public function formato_memo()
    {
        $data['vista'] = 'sitio2/checador/formato_memo';
        $data['js'] = 'sitio2/checador/formato_memo_js';
        $data['menu'] = 'formatos';
        $data['titulo'] = "FORMATO MEMORANDUM";
        $data['asuntox'] = $this->checador_model->selec_asunto1();
        $data['obser'] = ' ';
        $this->load->model('checador_model');

        $data['query'] = $this->checador_model->historico_memo();
        $this->load->view('site2', $data);
    }

    public function memo_submit()
    {


        $this->load->model('checador_model');
        $this->checador_model->guardar_memo();
        redirect('checador/formato_memo');

    }

    function imprime2($id)
    {


        $this->load->model('checador_model');


        $data['cabeza'] = $this->checador_model->reporte_memo_encabezado1();
        $data['detalle'] = $this->checador_model->reporte_memo1($id);


        $data['id'] = $id;
        $this->load->view('impresiones/reporte_memorandum', $data);

    }

    public function formato_memo_validar()
    {
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['base_url'] = site_url() . "/checador/formato_memo_validar";
        $config['total_rows'] = $this->checador_model->cuenta_memos_novalidados();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '10';

        $this->pagination->initialize($config);

        $data['vista'] = 'sitio2/checador/memos_pendientesxvalidar';
        $data['menu'] = 'memorandum';
        $data['query'] = $this->checador_model->get_memo2($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);


    }

    function validar_memo($id, $nomina)
    {

        $this->db->where('id', $id);
        $b = array('validado' => '1', 'id_validacion' => $this->session->userdata('id'));
        $this->db->set('fecha_validacion', 'now()', false);
        $this->db->update('reg_memo', $b);
        redirect('checador/formato_memo_validar');
    }

    public function eliminar1($id)
    {
        $this->load->model('checador_model');
        $this->checador_model->memos_eliminar($id);
        redirect('checador/formato_memo_validar');
    }

    public function formato_memo_historico()
    {
        $this->load->library('pagination');
        $this->load->model('checador_model');
        $config['base_url'] = site_url() . "/checador/formato_memo_historico";
        $config['total_rows'] = $this->checador_model->cuenta_historico_memo();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '25';

        $this->pagination->initialize($config);

        $data['vista'] = 'sitio2/checador/his_memo';
        $data['menu'] = 'memorandum';
        $data['query'] = $this->checador_model->get_memo1($config['per_page'], $this->
            uri->segment(3));
        $this->load->view('site2', $data);


    }
    
    function asigna_password()
    {
        $sql = "SELECT id FROM catalogo.cat_empleado where tipo = 1 and pass = 11111 and id_checador > 0 and checa = 1;";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $this->load->helper('string');
            foreach($query->result() as $row)
            {
                $pass = random_string('numeric', 5);
                $data = array('pass' => $pass);
                $this->db->where('id', $row->id);
                $this->db->update('catalogo.cat_empleado', $data);
            }
        }
        
    }
    
    public function admin_justificaciones_elige_quincena()
    {
        $data['vista'] = 'sitio2/checador/admin_justificaciones_elige';
        //$data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }
    
    public function reporte_justificaciones()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi();
        $this->load->view('impresiones/asistencias_justificaciones', $data);
    }
    
    
    
    public function reporte_justificaciones_marysol()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi();
        $this->load->view('impresiones/asistencias_justificaciones_marysol', $data);
    }
    
    public function reporte_horas_marysol()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi();
        $this->load->view('impresiones/asistencias_horas_marysol', $data);
    }

    public function admin_justificaciones_elige_quincena_concentrado()
    {
        $data['vista'] = 'sitio2/checador/admin_justificaciones_elige_concentrado';
        //$data['js'] = 'sitio2/checador/admin_asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $this->load->view('site2', $data);
    }
    
    public function reporte_justificaciones_concentrado()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi();
        $this->load->view('impresiones/asistencias_justificaciones_concentrado', $data);
    }
    
     public function reporte_puntualidad_moronatti()
    {
        $quincena = $this->input->post('quincena');
        $periodo = $this->checador_model->get_quincena($quincena);
        $row_periodo = $periodo->row();
        $data['perini'] = $row_periodo->inicio;
        $data['perfin'] = $row_periodo->fin;
        $data['quincena'] = $quincena;
        $data['query'] = $this->checador_model->get_deptos_justi1();
        $this->load->view('impresiones/reporte_puntualidad', $data);
    }
    
    
    function calcula_tiempo_dias()
    {
        //$this->db->limit(1);
        $query = $this->db->get('checador_quincenas');
        
        foreach($query->result() as $row)
        {
            
            $a = 0;
            for ($i = 0; ; $i++) {
                
                $sql = "select ? + interval $i day as fecha, weekday(? + interval $i day) as dia,
                 DATEDIFF(?, ? + interval $i day) as resta;";
                
                $q1 = $this->db->query($sql, array($row->inicio, $row->inicio, $row->fin, $row->inicio));
                
                
                $r1 = $q1->row();
                
                
                $this->db->where('edificio', $r1->fecha);
                $q2 = $this->db->get('catalogo.cat_festivo');
                
                
                //echo $r1->resta."<br />";
                if($r1->dia == 5 || $r1->dia == 6 || $q2->num_rows() > 0)
                {
                    //echo $r1->dia."<br />";
                    $a = $a;
                }else{
                    //echo $r1->dia."<br />";
                    $a = $a + 1;
                }
                
                if ($r1->resta == 0) {
                    echo $a."<br />";
                    
                
                    $this->db->where('id', $row->id);
                    $this->db->update('checador_quincenas', array('dias_laborados' => $a, 'horas_laboradas' => $a * 9));
                    
                    break;
                    
                }
                
            }
        }
    }
    
    function aplicar_sanciones()
    {
        $quincena = $this->input->post('quincena');
        $clave = $this->input->post('clave');
        
        $periodo = $this->checador_model->get_quincena($quincena);
        $row = $periodo->row();
        
        $sql1 = "insert ignore into desarrollo.faltante (fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom, tipo, clave, observacion, succ, fecpre, fechai, folioi, tipo2, fechacaptura, id_plaza, documento, varios)
(
SELECT c.fecha, 0, e.nomina, 0, 1, 0, 939, succ, e.plaza, e.cia, e.cia, e.plaza, 1 as tipo, 613, 'FALTA', succ, '0000-00-00', '0000-00-00', '', '', now(), 0, '', 0
FROM checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal s on e.succ = s.suc
where c.fecha between '$row->inicio' and '$row->fin' and e.tipo = 1 and e.checa = 1 and justificada = 0 and falta = 1
order by succ, completo
);";
        $sql2 = "insert ignore into desarrollo.faltante (fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom, tipo, clave, observacion, succ, fecpre, fechai, folioi, tipo2, fechacaptura, id_plaza, documento, varios)
(
SELECT '$row->fin', 0, e.nomina, 0, floor(sum(retardo)/3) as retardos, 0, 939, succ, e.plaza, e.cia, e.cia, e.plaza, 1 as tipo, 613, 'FALTA - RETARDOS ACUMULADOS', succ, '0000-00-00', '0000-00-00', '', '', now(), 0, '', 0
FROM checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal s on e.succ = s.suc
where c.fecha between '$row->inicio' and '$row->fin' and e.tipo = 1 and e.checa = 1 and justificada = 0 and retardo = 1
group by empleado_id
having retardos >= 1
order by succ, completo
);";

        $sql3 = "insert into checador_sanciones (quincena) values ($quincena);";

        if($clave === "aplicar"){

            $this->db->trans_start();
            $this->db->query($sql1);
            $this->db->query($sql2);
            $this->db->query($sql3);
            $this->db->trans_complete(); 

        }else{
            
        }
        
        redirect('checador/cargar_datos');
    }
    
   public function asistencias_tablasasdasd()
    {
        $data['vista'] = 'sitio2/checador/asistencias_tabla';
        $data['js'] = 'sitio2/checador/asistencias_elige_js';
        $data['menu'] = 'asistencias';
        $periodo = $this->checador_model->get_quincena($this->input->post('quincena'));
        $row_periodo = $periodo->row();
        $data['query'] = $this->checador_model->get_asistencias_periodo($row_periodo->
            inicio, $row_periodo->fin);
        $data['quincenas'] = $this->checador_model->get_quincenas();
        $data['etiqueta'] = $row_periodo->inicio . " al " . $row_periodo->fin;
        $data['dias_laborados'] = $row_periodo->dias_laborados;
        $data['horas_laboradas'] = $row_periodo->horas_laboradas;
        $data['grafica1'] = $this->checador_model->grafica1($row_periodo->inicio, $row_periodo->fin, $row_periodo->horas_laboradas);
        $data['grafica2'] = $this->checador_model->grafica2($row_periodo->inicio, $row_periodo->fin, $row_periodo->dias_laborados);
        $data['grafica3'] = $this->checador_model->grafica3($row_periodo->inicio, $row_periodo->fin, $row_periodo->dias_laborados);
        
        $this->load->helper('funciones');
        $this->load->view('site2', $data);
    }
 
    

        function actividad()
        {
        $data['vista'] = 'sitio2/diagnostico/actividad';
        //$data['js'] = 'sitio2/diagnostico/asistencias_elige_js';
        $data['menu'] = 'diagnostico';
        $data['empleado'] = $this->checador_model->get_plantilla();
        $data['puesto'] = $this->checador_model->get_puesto();
        $data['query'] = $this->checador_model->get_tabla_depto();
        $this->load->view('site2', $data);    
        }
        
        function graba_actividad()
        {
        $this->checador_model->graba_actividad(
        $this->input->post('empleado'),$this->input->post('puesto'),$this->input->post('actividad'));     
        redirect('checador/actividad');
        }
        
        function borrar_act($id)
        {
        $a=array('tipo'=>'X');
        $this->db->where('id',$id);
        $this->db->update('oficinas.actividad',$a);    
        redirect('checador/actividad');
        }
        
        function actividad_actualiza($id)
        {
        $data['vista'] = 'sitio2/diagnostico/actividad_actualiza';
        $data['menu'] = 'diagnostico';
        $data['query'] = $this->checador_model->get_tabla_depto_uno($id);
        $this->load->view('site2', $data);    
        }
        function act_actividad()
        {
        $a=array('actividad'=>$this->input->post('actividad'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('oficinas.actividad',$a);    
        redirect('checador/actividad');
        }
        
        function diagnostico()
        {
        $data['vista'] = 'sitio2/diagnostico/diagnostico';
        //$data['js'] = 'sitio2/diagnostico/asistencias_elige_js';
        $data['menu'] = 'diagnostico';
        $data['empleado'] = $this->checador_model->get_plantilla();
        $data['puesto'] = $this->checador_model->get_puesto();
        $data['query'] = $this->checador_model->get_tabla_diagnostico('0');
        $this->load->view('site2', $data);    
        }
        function graba_diagnostico()
        {
        $this->checador_model->graba_diagnostico(
        $this->input->post('uno'),$this->input->post('tres'),$this->input->post('cinco'),$this->input->post('diez'));     
        redirect('checador/diagnostico');
        }
        function diagnostico_act($mov)
        {
        $data['vista'] = 'sitio2/diagnostico/diagnostico_act';
        //$data['js'] = 'sitio2/diagnostico/asistencias_elige_js';
        $data['menu'] = 'diagnostico';
        $data['empleado'] = $this->checador_model->get_plantilla();
        $data['puesto'] = $this->checador_model->get_puesto();
        $data['query'] = $this->checador_model->get_tabla_diagnostico($mov);
        $this->load->view('site2', $data);
        }
        function act_propuesta()
        {
        $a=array('propuesta'=>$this->input->post('propuesta'));
        $this->db->where('id',$this->input->post('id_d'));
        $this->db->update('oficinas.diagnostico',$a);    
        redirect('checador/diagnostico');
        }
        function act_plazo()
        {
        $a=array('plazo'=>$this->input->post('plazo'));
        $this->db->where('id',$this->input->post('id_d'));
        $this->db->update('oficinas.diagnostico',$a);    
        redirect('checador/diagnostico');
        }
        function act_alinear()
        {
        $a=array('alinear'=>$this->input->post('alinear'));
        $this->db->where('id',$this->input->post('id_d'));
        $this->db->update('oficinas.diagnostico',$a);    
        redirect('checador/diagnostico');
        }
        function act_diag()
        {
        $a=array('uno'=>$this->input->post('uno'),
                  'tres'=>$this->input->post('tres'),
                  'cinco'=>$this->input->post('cinco'),
                  'diez'=>$this->input->post('diez'));
        $this->db->where('id',$this->input->post('id_d'));
        $this->db->update('oficinas.diagnostico',$a);    
        redirect('checador/diagnostico');
        }

}
