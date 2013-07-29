<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mercadotecnia extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('download');
        
        
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexc()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_catalogo()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_ofertas();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_catalogo_act()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CATALOGO DE OFERTAS ACTUALES';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_ofertas_act();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_cat_as400()
    {
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->act_as400();
        redirect('mercadotecnia/indexc');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_catalogo_lab()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CATALOGO DE LABORATORIOS';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_labor();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_catalogo_lab_det($lab)
    {
        
        $data['titulo']= 'CATALOGO DE LABORATORIOS';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_labor_det($lab);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
     
    public function tabla_usuarios_lab()
    {
        $data['mensaje']= '';
        $data['titulo']= 'USUARIOS DE LABORATORIOS';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->usuarios_lab();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
public function borrar_usuario($id)
    {
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->delete_member($id);
        redirect('mercadotecnia/tabla_usuarios_lab');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
public function activar_usuario($id)
    {
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->activar_member($id);
        redirect('mercadotecnia/tabla_usuarios_lab');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
public function cambiar_usuario($id)
    {
        $data['mensaje']= '';
        $data['titulo']= 'USUARIOS DE LABORATORIOS';
        $this->load->model('mercadotecnia_model');
        $query =$this->mercadotecnia_model->busca_dato($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $data['user']=$row->username;
        $data['pass']=$row->password;
        $data['labor']=$row->labor;
        $data['email']=$row->email;
        $data['id']=$id;
        }
        //$data['labx'] = $this->mercadotecnia_model->busca_labor();
        $data['tabla']= '';
        $data['contenido'] = "mercadotecnia_form_usuarios";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
public function update_usuario()
    {
       $pass=$this->input->post('pass');
       $email=$this->input->post('email');
       $user=$this->input->post('user');
       $id=$this->input->post('id');
       
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->update_member($id,$user,$pass,$email);
        redirect('mercadotecnia/tabla_usuarios_lab');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
public function agrega_usuario()
    {
        $data['mensaje']= '';
        $data['titulo']= 'USUARIOS DE LABORATORIOS';
        $this->load->model('mercadotecnia_model');
        $data['labor'] = $this->mercadotecnia_model->busca_labor();
        $data['tabla']= '';
        $data['contenido'] = "mercadotecnia_form_usuarios_a";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
public function adiciona_usuario()
    {
       $pass=$this->input->post('pass');
       $email=$this->input->post('email');
       $user=$this->input->post('user');
       $labor=$this->input->post('labor');
       
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->add_member($labor,$user,$pass,$email);
        redirect('mercadotecnia/tabla_usuarios_lab');
    }
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
      
    public function indexn()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacon";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas()
    {
        $data['titulo']= 'NOTAS DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecnian";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas_det($id)
    {
       
        $this->load->model('mercadotecnia_model');
        $query= $this->mercadotecnia_model->busco_nota($id);
        $row= $query->row();
        $data['titulo']= 'AAA.: '.$row->aaa.' MES.:'.$row->mes.' LABORATORIO.:'.$row->labor;
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas_det($id,$row->aaa,$row->mes,$row->prv,$row->labor,$row->tipo_nota);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas_det_cod($id,$cod)
    {
        
        $this->load->model('mercadotecnia_model');
        $query= $this->mercadotecnia_model->busco_nota($id);
        $row= $query->row();
        $data['titulo']= 'AAA.: '.$row->aaa.' MES.:'.$row->mes.' LABORATORIO.:'.$row->labor;
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas_det_cod($row->aaa,$row->mes,$row->prv,$row->labor,$row->tipo_nota,$cod);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_nota_oferta_cod()
    {
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        $data['tabla'] = '';
          
        $data['contenido'] = "mercadotecnia_form_nota_c";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_nota_oferta_cod_d()
    {
        $aaa=$this->input->post('aaa');
        $mes=$this->input->post('mes');
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_oferta_cod($aaa,$mes);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_nota_oferta_cod_d_par($aaa,$mes)
    {
        $aaa=$this->input->post('aaa');
        $mes=$this->input->post('mes');
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_oferta_cod($aaa,$mes);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_oferta_cod_mes($cod,$aaa,$mes)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_oferta_cod_mes($cod,$aaa,$mes);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_nota_suc()
    {
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        $data['tabla'] = '';
          
        $data['contenido'] = "mercadotecnia_form_nota_s";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_nota_suc_d()
    {
        $aaa=$this->input->post('aaa');
        $mes=$this->input->post('mes');
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_suc($aaa,$mes);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_suc_mes($aaa,$mes,$suc)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_suc_mes($aaa,$mes,$suc);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
///***********************************************************************************************************************************
    public function indexd()
    {
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
  public function tabla_desplazamientos_lab()
    {
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    public function tabla_desplazamientos_lab_det($lab,$labx)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab_det($lab,$labx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    public function tabla_desplazamientos_lab_ctl($lab,$labx)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab_ctl($lab,$labx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    public function tabla_desplazamientos_lab_lab($lab,$labx)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab_ctl_fam($lab,$labx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    public function tabla_desplazamientos_lab_lab_fami($lab,$labx,$fami)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab_ctl_fam_det($lab,$labx,$fami);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
 public function tabla_desplazamientos_vidaz()
    {
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_vidaz();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
///***********************************************************************************************************************************
///***********************************************************************************************************************************
      
    public function indexp()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacon";
        $data['sidebar'] = "sidebar_mercadotecnia_ped";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///***********************************************************************************************************************************
///***********************************************************************************************************************************
      
    public function tabla_genera_ped()
    {
        $this->load->model('catalogo_model');
        $this->load->model('mercadotecnia_model');
        $data['tipo']=$this->catalogo_model->busca_almacenes_locales();
        $data['prv']=$this->catalogo_model->busca_prv();
        $data['titulo']= 'GENERA ORDEN DE COMPRA';
        $data['tabla']=$this->mercadotecnia_model->folio_orden_a();
        $data['contenido'] = "pat_genera_form_ped";
        $data['selector'] = "mercadotecniacon";
        $data['sidebar'] = "sidebar_mercadotecnia_ped";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_ctl()
    {
        $prv= $this->input->post('prv');
        $tipo= $this->input->post('tipo');
        
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->agrega_member_ctl($tipo,$prv);
        
        redirect('mercadotecnia/tabla_genera_ped');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    public function tabla_genera_detalle($id_cc,$prv)
    {
        $this->load->model('catalogo_model');
        $this->load->model('mercadotecnia_model');
        $data['tipo']=$this->catalogo_model->busca_almacenes_locales();
        $data['id_cc']=$id_cc;
        $data['prv']=$prv;
        $data['titulo']= 'GENERA ORDEN DE COMPRA';
        $data['tabla']=$this->mercadotecnia_model->folio_orden_d($id_cc,$prv);
        $data['contenido'] = "pat_genera_form_ped_det";
        $data['selector'] = "mercadotecniacon";
        $data['sidebar'] = "sidebar_mercadotecnia_ped";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia

function busca_producto()
	{
	$this->load->model('mercadotecnia_model');
    echo $this->mercadotecnia_model->busca_productoo($this->input->post('cod'));
    }
//////////////////////////////////////////////////////
////////////////////////////////////////////////////// 
    function agrega_det()
    {
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->agrega_member_det(
       $this->input->post('id_cc'),
       $this->input->post('codx'),
       $this->input->post('can'),
       $this->input->post('costo'));
        redirect('mercadotecnia/tabla_genera_detalle/'.$this->input->post('id_cc').'/'.$this->input->post('prv'));
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    function cerrar_ctl($id_cc,$prv)
    {
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->valida_member_ctl($id_cc);
       redirect('mercadotecnia/tabla_genera_detalle/'.$id_cc.'/'.$prv);
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    function borrar_det($id_cc,$prv,$id)
    {
       $this->load->model('mercadotecnia_model');
       $this->mercadotecnia_model->borrar_member_det($id);
       redirect('mercadotecnia/tabla_genera_detalle/'.$id_cc.'/'.$prv);
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
     
    public function tabla_genera_ped_his()
    {
        $this->load->model('catalogo_model');
        $this->load->model('mercadotecnia_model');
        $data['tipo']=$this->catalogo_model->busca_almacenes_locales();
        $data['prv']=0;
        $data['titulo']= 'GENERA ORDEN DE COMPRA';
        $data['tabla']=$this->mercadotecnia_model->folio_orden_c();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacon";
        $data['sidebar'] = "sidebar_mercadotecnia_ped";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  function imprime_ped($id_cc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('mercadotecnia_model');
          $query =$this->mercadotecnia_model->busca_orden($id_cc);
          if($query->num_rows() >0){
	      $row=$query->row();
          }
            
         
      $data['cabeza'].= "
      <table>
           
    
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"-1\"><strong>ORDEN $row->folprv<BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"-1\"><strong>PRV $row->prvx <BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"-1\"><strong>$row->almacen <BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    
            <tr>
           <th width=\"100\" align=\"center\"><strong>CODIGO</strong></th>
           <th width=\"300\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"center\"><strong>PIEZAS</strong></th>
           <th width=\"70\" align=\"center\"><strong>COSTO</strong></th>
           <th width=\"70\" align=\"center\"><strong>IMPORTE</strong></th>
          </tr>
   </table> 
            ";
            $data['id_cc']=$id_cc;
            $this->load->view('impresiones/pat_orden_det', $data);
            
		}      
        


/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
        
    public function indexv()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniav";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas()
    {
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_solof();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
        
        
        
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////DIRECCION
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_ventas_cia()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_ciaf();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cia()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_ciaf();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cia_suc($cia,$razon)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.$razon;
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_ciaf_suc($cia);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_ventas_cadena()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_cadena();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cadena()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_cadena();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cadena_suc($tipo,$tipox)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.$tipox;
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_cadena_suc($tipo);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_lin()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_lin();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_lin_suc($lin,$linx)
    {
        
        $data['titulo']= 'REPORTE DE VENTAS'.utf8_decode($linx);
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_lin_suc($lin);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////UTILIDAD POR FARMACIA

///////////////////////////////////////////////////////////////////////////////////////////////////////////////DIRECCION
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_utilidad_total_cia()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->utilidad_total_ciaf();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
        //$this->load->view('header');
        //$this->load->view('main', $data);
        //$this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_utilidad_total_cia_suc($cia,$razon)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.$razon;
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->utilidad_total_ciaf_suc($cia);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_utilidad_total_cia_suc_det($suc,$sucx)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.utf8_decode($sucx);
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->utilidad_total_ciaf_suc_det($suc,$sucx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////


















    
      }