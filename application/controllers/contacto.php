<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacto extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('download');
        
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
    $data['contenido'] = "contacto";
    $data['selector'] = "contacto";
    $data['sidebar'] = "sidebar_contacto";
    $data_c['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/AjaxUpload.2.0.min.js\"></script>
        ";
    
    $this->load->view('header', $data_c);
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    public function archivos()
    {
    $this->load->model('archivos_model');
    $data['contenido'] = "archivos_recibidos";
    $data['selector'] = "archivos";
    $data['sidebar'] = "sidebar_contacto";
    $data_c['tabla'] = $this->archivos_model->trae_sitios();
    $data_c['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/AjaxUpload.2.0.min.js\"></script>
        ";
    
    $this->load->view('header', $data_c);
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    function descarga_memo()
    {
       	//$data = file_get_contents("./documentos/11541210.td");
        //$name = '11541210.td';
        $data = file_get_contents("./programas/TAEINV.EXE");
        $name = 'TAEINV.EXE';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }

    function upload()
    {
        $this->load->helper('file');
        $movido_a = $this->_crear_directorios();
        
        
        $uploaddir = './archivos/';
        
        $file = basename($_FILES['userfile']['name']);
        
        $uploadfile = $uploaddir . $file;
        
        
        $a = explode(".", $file);
        if(strtolower($a[1]) == 'pge'){
            
            //Verifico si se encuentra un archivo con el mismo nombre en la base de datos solo .pge
            $suc = substr($file, 0, 4);
            $q = $this->db->select('count(*) as cuenta')->where('archivo', $file)->from('archivos')->get();
            $row = $q->row();
            $cuenta = $row->cuenta;

            //Verifico si se encuentra un archivo con diferente nombre pero cargado la misma fecha en la base de datos solo .pge
            $sql9 = "select count(*) as cuenta from desarrollo.pedidos where date(fecha) = date(now()) and suc= ? ;";
            $q9 = $this->db->query($sql9, array($suc));
            $row1 = $q9->row();
            $cuenta1 = $row1->cuenta;


            //Verifico si se encuentra un archivo con diferente nombre pero cargado la misma fecha en la base de datos solo .pge
            $sql2 = "SELECT count(*) as cuenta FROM pedidos p where date(fechas) = date(now()) and suc = ? and fol<110000000;";
            $q2 = $this->db->query($sql2, array($suc));
            $row2 = $q2->row();
            $cuenta2 = $row2->cuenta;
            
               
        }else{
            $cuenta = 0;
            $cuenta1 = 0;
            $cuenta2 = 0;
        }
        
        
        //Si se no se cumplen las dos condiciones de bajo me deja pasar
        if($cuenta == 0 && $cuenta1 == 0 && $cuenta2 == 0){
        
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            
                $var = get_file_info('./archivos/'.$file);
                $string = read_file('./archivos/'.$file);
                
                
                if($var['size'] <= 60){
                unlink('./archivos/'.$file);
            $a = "
            <p class=\"message-box error\">Error: $file - Tu archivo esta vacio, generalo de nuevo.</p>
            ";
            
            echo $a;  
                    
                
                }else{
            
        $this->load->model('contactos');
        $this->load->model('cortes_model');
        
        
        $verifica = substr($file, 0, 1);
        $verifica2 = substr($file, 0, 2);
        
            if($verifica == "I"){
                unlink('./archivos/'.$file);
                echo "
            <p class=\"message-box error\">$file - No Subido.<br />Este archivo no es necesario para nosotros. Gracias.</p>
            ";
            }else{
                if(strtolower($a[1]) == "crt")
                {
                    copy('./archivos/'.$file, './cortes/'.$file);
                    unlink('./archivos/'.$file);
                    echo $this->cortes_model->inserta_archivos($file, $var['size'], $string);
                }elseif(strtolower($a[1]) == "inv"){
                    $this->load->model('in_model');
                    $this->in_model->inv(null, null, './archivos/'.$file, TRUE);
                    echo $this->contactos->inserta_archivos($file, $var['size'], $string);
                }else{
                      echo $this->contactos->inserta_archivos($file, $var['size'], $string);
                }
                
                
            }
        //$this->cortes_model->inserta_archivos($file, $var['size'], $string);
        }
        
        
        //Movido de archivo
        if(file_exists('./archivos/'.$file)){
        
            if(strtolower($a[1]) == 'pge'){
                //copy('./archivos/'.$file, $movido_a.'pge/'.$file);
            }elseif(strtolower($a[1]) == 'inv'){
                copy('./archivos/'.$file, $movido_a.'inv/'.$file);
            }elseif(strtolower($verifica2) == 'rv'){
                copy('./archivos/'.$file, $movido_a.'rv/'.$file);
            }else{
                copy('./archivos/'.$file, $movido_a.'otros/'.$file);
            }
        }
        
        

        } else {
          echo "error";
        }
        }else{
            
            $a = "
            <p class=\"message-box error\">Error: $file - Este archivo ya existe.<br /> Si necesitas volver a subirlo comunicate al 91400700 ext. 112 &oacute; 170 &oacute; 677 con Laura Garcia &oacute; Fernando Hernandez.</p>
            ";
            
            echo $a;  

        }

    }
    
    function busca_archivo()
    {
        $this->db->select('archivo');
        $this->db->where('id', $this->input->post('valor'));
        $q = $this->db->get('archivos');
        //echo $this->db->last_query();
        $row = $q->row();
        $this->load->helper('file');
        
        $string = read_file('./archivos/'.$row->archivo);
        echo "<pre>".$string."</pre>";
    }
    
    function _crear_directorios()
    {
        $fecha = date('Y_m_d');
        $ruta = './resp/'.$fecha.'/';

        if(file_exists($ruta)){

        }else{
            mkdir($ruta);
            mkdir($ruta.'pge/');
            mkdir($ruta.'inv/');
            mkdir($ruta.'rv/');
            mkdir($ruta.'otros/');
            mkdir($ruta.'pdf/');
        }
        
        return $ruta;
    }
    
    function elige_folios()
    {
        $data['mensaje']= '';
        $data['titulo']= 'PEDIDOS RECIBIDOS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "elige_folios";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
    
    function imprime_pedidos()
    {
        set_time_limit(0);
        ini_set('memory_limit','2000M');
        $this->load->helper('file');
        $aaa=date('Y');
        $mes=date('m');
		$otra_fecha = date('Y-m-d');
        $sql0 = "SELECT a.fol, sum(sur)as sur FROM pedidos a
        where  a.fechas between '$otra_fecha' and '$otra_fecha 23:59:59' group by a.fol";
        $q0 = $this->db->query($sql0);
        foreach($q0->result() as $r0)
        {
                if($r0->sur==0){
                $sx1 = "update catalogo.folio_pedidos_cedis_especial set tid='S' where id=$r0->fol and tid='A'";
                $this->db->query($sx1);    
                }
                if($r0->sur==0){
                $sx2 = "update catalogo.folio_pedidos_cedis  set tid='S' where id=$r0->fol and tid='A'";
                $this->db->query($sx2);    
                }
        }
$ms="SELECT a.id,sum(b.sur)as sur FROM catalogo.folio_pedidos_cedis_especial a left join desarrollo.pedidos b on b.fol=a.id
where a.tid='A'  group by a.id";$mq = $this->db->query($ms);
foreach($mq->result() as $mr){
    if($mr->sur==null){
        $mrx="update catalogo.folio_pedidos_cedis_especial set tid='X' where id=$mr->id";$this->db->query($mrx);}}        
$ms1="SELECT a.id,sum(b.sur)as sur FROM catalogo.folio_pedidos_cedis_especial a left join desarrollo.pedidos b on b.fol=a.id
where a.tid='A'  group by a.id";$mq1 = $this->db->query($ms1);
foreach($mq1->result() as $mr1){if($mr1->sur==null){$mrx1="update catalogo.folio_pedidos_cedis_especial set tid='X' where id=$mr1->id";$this->db->query($msx1);}}        


        
        $sql = "SELECT a.fol, a.suc 
        FROM pedidos a 
        left join catalogo.folio_pedidos_cedis b on b.id=a.fol
        where a.mue <> 6 and a.fechas between '$otra_fecha' and '$otra_fecha 23:59:59' and b.id_user=0 
        group by a.fol, a.suc order by a.fol;";
        //$sql = "SELECT fol, suc FROM pedidos p where mue <> 6 and date(fechas) = date(now()) group by fol, suc order by fol;";
        $q = $this->db->query($sql);
        $sql2 = "SELECT a.fol, a.suc 
        FROM pedidos a 
        left join catalogo.folio_pedidos_cedis b on b.id=a.fol
        where a.mue = 6 and a.fechas between '$otra_fecha' and '$otra_fecha 23:59:59'
        group by a.fol, a.suc order by a.fol;";
        //$sql2 = "SELECT fol, suc FROM pedidos p where mue = 6 and date(fechas) = date(now()) group by fol, suc order by fol;";
        $q2 = $this->db->query($sql2);

	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
$bat = "@echo off
";
$bat1 = "@echo off
";

        foreach($q->result() as $r)
        {
            //echo $r->fol.'<br />';
            $fol = $r->fol;
            $suc = $r->suc;
            
        
          
          
          $data['fol']=$fol;
          $nomarchivo = 'resp/'.date('Y_m_d').'/pdf/'.$fol.'.pdf';
          $data['nomarchivo'] = $nomarchivo;
          
          if (file_exists($nomarchivo)){
            //echo "El fichero $nombre_fichero existe";
          }else{
          
              $this->load->model('catalogo_model');
              $mesx = $this->catalogo_model->busca_mes_unico($mes);
              $sucx = $this->catalogo_model->busca_suc_unica($suc);
              $rutax = $this->catalogo_model->busca_sucursal_ruta($suc,$fol);  
                
                $data['cabeza']= "
               <table>
               
               <tr>
               <td colspan=\"5\" align=\"center\"><strong>PREVIO DE PEDIDOS</strong></td>
               </tr>
               
               <tr>
               <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
               </tr>
               <tr>
               <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
               <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
               </tr>
               <tr>
               <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
                <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
               </tr>
                <tr>
               <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
               <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
               <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
               <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
               <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
               
              </tr>
               </table> 
                ";
                
                $this->load->view('impresiones/previo_de_pedidos_ivan', $data);
          }
            
            
$bat.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol.".pdf\" \"pedidos\"
";
            
        }


        foreach($q2->result() as $r)
        {
            //echo $r->fol.'<br />';
            $fol = $r->fol;
            $suc = $r->suc;
            
        
          
          
          $data['fol']=$fol;
          $nomarchivo = 'resp/'.date('Y_m_d').'/pdf/'.$fol.'_06.pdf';
          $nomarchivofal = 'resp/'.date('Y_m_d').'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;

          if (file_exists($nomarchivo)){
            //echo "El fichero $nombre_fichero existe";
          }else{

          
              $this->load->model('catalogo_model');
              $mesx = $this->catalogo_model->busca_mes_unico($mes);
              $sucx = $this->catalogo_model->busca_suc_unica($suc);
              $rutax = $this->catalogo_model->busca_sucursal_ruta($suc,$fol);  
                
                
                $data['cabeza']= "
               <table>
               
               <tr>
               <td colspan=\"5\" align=\"center\"><strong>PREVIO DE PEDIDOS MUEBLE 6 </strong></td>
               </tr>
               
               <tr>
               <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
               </tr>
               <tr>
               <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
               <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
               </tr>
               <tr>
               <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
                <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
               </tr>
               <tr>
               <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
               <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
               <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
               <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
               <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
               
              </tr>
               </table> 
                ";
    
                $this->load->view('impresiones/previo_de_pedidos_06_ivan', $data);
            
            }
            
$bat1.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol."_06.pdf\" \"pedidos\"
";
            
        }

        
$bat.="exit";
$bat1.="exit";
        
        write_file('./resp/'.date('Y_m_d').'/pdf/imprime1.bat', $bat);
        write_file('./resp/'.date('Y_m_d').'/pdf/imprime2.bat', $bat1);
        
        $this->imprime_pedidos_ctl('F');
        $this->imprime_pedidos_ctl_sec('F');
        $this->imprime_pedidos_ctl_fal('F');
        
        $a = get_file_info($nomarchivofal);
        echo $a['size'];
        if((int)$a['size'] < 3500){
            unlink($nomarchivofal);
        }
        
        $entrega = "@echo off
";
        //juego firmas
        
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."FIRMAS_ DE_ RECIBIDO.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        //juego control de calidad
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."CONTROL_ DE_ CALIDAD.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
        
        //juego reciba
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."AREA_ DE_ RECIBA.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";

        //captura
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."AREA_ DE_ CAPTURA.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
        //$entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
//";

        //inventarios
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."AREA_ DE_ INVENTARIOS.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";

        //embarques
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."AREA_ DE_ EMBARQUE.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        
        //surtido
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."AREA_ DE_ SURTIDO.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";
        
        //rechecado
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."AREA_ DE_ EMPAQUE.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";

        //controlados
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."MUEBLE_ 6.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";

        //gerencia alm              
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."GERENCIA_ ALMACEN.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_sec.pdf\" \"pedidos\"
";

        //gerencia comercial
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\"."GERENCIA_ COMERCIAL.pdf\" \"pedidos\"
";
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_folios.pdf\" \"pedidos\"
";
if (file_exists($nomarchivofal)){
        $entrega.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\"."rf_fal.pdf\" \"pedidos\"
";
    }
        $entrega.="exit";

        write_file('./resp/'.date('Y_m_d').'/pdf/entrega.bat', $entrega);
        
        
        redirect('pedido/tabla_control');
    }

    function imprime_pedidos_ctl($salida = 'I')
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $fecha=date('Y-m-d');

         $fol1 = $this->input->post('fol1'); 
         $fol2 = $this->input->post('fol2');
        
        if(isset($fol1) && $fol1 != null && isset($fol2) && $fol2 != null){
            
        }else{
            
            $sql_folios = "SELECT min(fol) as fol1, max(fol) as fol2 FROM pedidos p where fechas between '$fecha' and '$fecha 23:59:59';";
            $q_folios = $this->db->query($sql_folios);
            $r_folios = $q_folios->row();
            
            $fol1 = $r_folios->fol1;
            $fol2 = $r_folios->fol2;
            
        }
          
          $nomarchivo = 'resp/'.date('Y_m_d').'/pdf/rf_folios.pdf';
          
          $data['cabeza']='';
          $data['nomarchivo'] = $nomarchivo;
          $data['salida'] = $salida;
          
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"6\" align=\"center\"><strong>REPORTE DE SUCURSALES QUE TRANSMITIERON PEDIDOS</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: LAURA GARCIA PEREZ</strong> <br /></td>
           
           </tr>
           <tr>
           <th width=\"50\" align=\"center\"><strong>#</strong></th>
           <th width=\"160\" align=\"center\"><strong>RUTA</strong></th>
           <th width=\"70\" align=\"center\"><strong>FOLIO</strong></th>
           <th width=\"50\" align=\"center\"><strong>TIPO</strong></th>
           <th width=\"200\" align=\"left\"><strong>SUCURSAL</strong></th>
           <th width=\"50\" align=\"right\"><strong>MUE. 0-5 </strong></th>
           <th width=\"50\" align=\"right\"><strong>MUE. 6</strong></th>
           <th width=\"50\" align=\"right\"><strong>C.PED</strong></th>
          </tr>
           </table> 
            ";
            $data['fecha']=$fecha;
            $data['fol1']=$fol1;
            $data['fol2']=$fol2;
            $this->load->view('impresiones/previo_de_pedidos_ctl', $data);
            
		}


    function imprime_pedidos_ctl_sec($salida = 'I')
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $fecha=date('Y-m-d');
			$fecha_archivo = date('Y_m_d');
          
//	    $aaa=2012;
//        $mes=12;
//        $dia=26;
//        $fecha='2012-12-26';
//		$fecha_archivo = '2012_12_26';
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $nomarchivo = 'resp/'.$fecha_archivo.'/pdf/rf_sec.pdf';
          $data['salida'] = $salida;
          $data['nomarchivo'] = $nomarchivo;
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"4\" align=\"center\"><strong>REPORTE DE PRODUCTOS POR CLAVE</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha .:".$fecha." </td>
           </tr>
           <tr>
           <td colspan=\"4\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: LAURA GARCIA PEREZ</strong> <br /></td>
           
           </tr>
           <tr>
           <th width=\"50\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"70\" align=\"center\"><strong>SEC</strong></th>
           <th width=\"300\" align=\"center\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANT.PED</strong></th>
          </tr>
           </table> 
            ";
            $data['fecha']=$fecha;
            $this->load->view('impresiones/previo_de_pedidos_ctl_sec', $data);
            
		}


    function imprime_pedidos_ctl_fal($salida = 'I')
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $fecha=date('Y-m-d');
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $data['salida'] = $salida;
          $nomarchivo = 'resp/'.date('Y_m_d').'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"6\" align=\"center\"><strong>REPORTE DE SUCURSALES QUE NO TRANSMITIERON PEDIDOS<BR /><BR /></strong></td>
           </tr>
           
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: LAURA GARCIA PEREZ</strong> <br /></td>
           </tr>
           <tr>

           <td colspan=\"6\" align=\"left\">POR MEDIO DEL PRESENTE ENTREGO LISTADO DE SUCURSALES QUE NO TRANSMITIERON PEDIDOS<br />
           DEL $dia DE $mesx DEL $aaa<br /></td>
           </tr>
           
           <tr>
            <th width=\"30\" align=\"center\"><strong>#</strong></th>
           <th width=\"40\" align=\"center\"><strong>TIPO</strong></th>
           <th width=\"200\" align=\"left\"><strong>SUCURSAL</strong></th>
           </tr>
           
           </table> 
            ";
            $data['fecha']=$fecha;
            $this->load->view('impresiones/previo_de_pedidos_ctl_fal', $data);
            
		}      



/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////    
    
      }