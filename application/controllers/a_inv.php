<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class A_inv extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('download');
        
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['mensaje']= '';
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "a_inv";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control()
    {
        $this->load->model('a_inv_model');
       
        $data['tabla'] = $this->a_inv_model->control();
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_his()
    {
        $this->load->model('catalogo_model');
       $data['mesx1'] = $this->catalogo_model->busca_mes();
       $data['aaax1'] = $this->catalogo_model->busca_anio();
       $data['mesx2'] = $this->catalogo_model->busca_mes();
       $data['aaax2'] = $this->catalogo_model->busca_anio();
  
          
        $this->load->model('a_inv_model');
        $data['tabla'] ='';
        
        $data['titulo'] = "MOVIMIENTOS DE INVENTARIO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv_form_fec";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_his_det()
    {
        $aaa1= $this->input->post('aaa1');
        $mes1= $this->input->post('mes1');
        $dia1= $this->input->post('d1');
        $aaa2= $this->input->post('aaa2');
        $mes2= $this->input->post('mes2');
        $dia2= $this->input->post('d2');
        $fec1=$aaa1.'-'.str_pad($mes1,2,0,STR_PAD_LEFT).'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$aaa2.'-'.str_pad($mes2,2,0,STR_PAD_LEFT).'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->control_his($fec1,$fec2);
        
        $data['titulo'] = "MOVIMIENTOS DE INVENTARIO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_mod()
    {
        $this->load->model('a_inv_model');
       
        $data['tabla'] = $this->a_inv_model->control_mod();
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function borrar_inv($id)
    {
        $this->load->model('a_inv_model');
        $this->a_inv_model->delete_member_inv($id);
        redirect('a_inv/tabla_control_mod');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_lote($id)
    {
        $this->load->model('a_inv_model');
        $query =$this->a_inv_model->busca_folio($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $sec=$row->sec;
        $susa=$row->susa1;
        $lote=$row->lote;
        $cadu=$row->cadu;
        $inv1=$row->inv1;
        }
        $data['id'] =$id;
        $data['sec'] =$sec;
        $data['susa'] =$susa;
        $data['lote1'] =$lote;
        $data['cadu'] =$cadu;
        $data['inv1'] =$inv1;
        
        $data['tabla'] = "";
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv_form_modi_lote";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_folios_fecha($sec, $fec1, $fec2, $lote)
    {
        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->busca_folio_fechas($sec, $fec1, $fec2, $lote);
        
        $data['titulo'] = "MOVIMIENTOS DE INVENTARIO DEL $fec1 AL $fec2";
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////////////////    
    function modifica_lote()
    {
        $id= $this->input->post('id');
        $sec= $this->input->post('sec');
        $lote1= $this->input->post('lote1');
        $lote= $this->input->post('lote');
        $inv1= $this->input->post('inv1');
        $cadu= $this->input->post('cadu');
        
        $this->load->model('a_inv_model');
        $this->a_inv_model->update_lote($id,$sec,$lote1,$lote,$inv1,$cadu);
        redirect('a_inv/tabla_control_mod');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_cadu($id)
    {
        $this->load->model('a_inv_model');
        $query =$this->a_inv_model->busca_folio($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $sec=$row->sec;
        $susa=$row->susa1;
        $lote=$row->lote;
        $cadu=$row->cadu;
        $inv1=$row->inv1;
        }
        $data['id'] =$id;
        $data['sec'] =$sec;
        $data['susa'] =$susa;
        $data['lote'] =$lote;
        $data['cadu'] =$cadu;
        $data['inv1'] =$inv1;
        
        $data['tabla'] = "";
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv_form_modi_cadu";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function modifica_cadu()
    {
        $id= $this->input->post('id');
        $sec= $this->input->post('sec');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
        $cadua= $this->input->post('cadua');
        $this->load->model('a_inv_model');
        $this->a_inv_model->update_cadu($id,$cadu,$cadua,$sec,$lote);
        redirect('a_inv/tabla_control_mod');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_lote()
	{
	$this->load->model('a_inv_model');
    //echo $this->a_inv_model->busca_lotess($sec);
    echo $this->a_inv_model->busca_lotess($this->input->post('sec'));
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_lote_cod()
	{
	$this->load->model('a_inv_model');
    //echo $this->a_inv_model->busca_lotess($sec);
    echo $this->a_inv_model->busca_lotess_cod($this->input->post('cod'));
    }































   public function tabla_control_editar($id)
    {
        $this->load->model('a_inv_model');
        $query =$this->a_inv_model->busca_folio($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $sec=$row->sec;
        $susa=$row->susa1;
        $lote=$row->lote;
        $cadu=$row->cadu;
        $inv1=$row->inv1;
        }
        $data['id'] =$id;
        $data['sec'] =$sec;
        $data['susa'] =$susa;
        $data['lote'] =$lote;
        $data['cadu'] =$cadu;
        $data['inv1'] =$inv1;
        
        $data['tabla'] = "";
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv_form_modi";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function ajustes_inv()
    {
        $id= $this->input->post('id');
        $sec= $this->input->post('sec');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
        $inv1= $this->input->post('inv1');
        $can= $this->input->post('can');
        $this->load->model('a_inv_model');
        $this->a_inv_model->update_member_inv_solo_can($id,$sec,$lote,$cadu,$inv1,$can);
        redirect('a_inv/tabla_control_mod');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function tabla_control_editar_cantidad($id)
    {
        $this->load->model('a_inv_model');
        $query =$this->a_inv_model->busca_folio($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $sec=$row->sec;
        $susa=$row->susa1;
        $lote=$row->lote;
        $cadu=$row->cadu;
        $inv1=$row->inv1;
        }
        $data['id'] =$id;
        $data['sec'] =$sec;
        $data['susa'] =$susa;
        $data['lote'] =$lote;
        $data['cadu'] =$cadu;
        $data['inv1'] =$inv1;
        
        $data['tabla'] = "";
        $data['titulo']= 'INVENTARIO DE ALMACEN';
        $data['titulo1'] = "";
        $data['contenido'] = "a_inv_form_modi";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function ajustes_inv_cantidad()
    {
        $id= $this->input->post('id');
        $sec= $this->input->post('sec');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
        $inv1= $this->input->post('inv1');
        $can = $this->input->post('can');
        $this->load->model('a_inv_model');
        $this->a_inv_model->update_member_inv_cantidad($id,$sec,$lote,$cadu,$inv1);
        redirect('a_inv/tabla_control_mod');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






































function busca_orden()
	{
	$this->load->model('a_inv_model');
    $validacion1 = $this->a_inv_model->busca_orden_inv($this->input->post('orden'));
    
    $query = $this->a_inv_model->busca_orden_claves($this->input->post('orden'));
    
    if($validacion1 > 0)
    {
        if($query->num_rows() > 0){
            
            $data['query'] = $query->result();
            $data['orden'] = $this->input->post('orden');
            $data['fac'] = $this->input->post('fac');
            $this->load->view('contenidos/a_inv_res_busca_orden', $data);
            
        }else{
            echo '<h2>Esta orden de compra ya fue cerrada en su totalidad.</h2>';
        }
        
    }else{
        
        echo '<h2>Esta orden de compra no existe.</h2>';
    }
    
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_ctl($orden,$fac)
    {
   
        $this->load->model('a_inv_model');
        $id_cc = $this->a_inv_model->agrega_member_ctl($orden,$fac);
        redirect('a_inv/tabla_detalle/'.$id_cc);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_detalle($id_cc)
    {
      
        $this->load->model('catalogo_model');
        $this->load->model('a_inv_model');
        $query =$this->a_inv_model->busca_folio($id_cc);
        if($query->num_rows() >0){
		$row=$query->row();
       
        }
        $data['titulo1'] = "RECwwwIBA DE MERCANCIA  <br /> ORDEN $row->orden";    
       
        $data['id_cc'] =$id_cc;
        $data['orden'] =$row->orden;
        $data['tabla'] = $this->a_inv_model->detalle_cap($id_cc);
        $data['titulo'] = "MERCANCIA DE LA FACTUA $row->fac";
        
        $data['contenido'] = "a_inv_form_captura";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_detalle()
    {
        $orden= $this->input->post('orden');
        $id_cc= $this->input->post('id_cc');
        $sec= $this->input->post('sec');
        $can= $this->input->post('can');
        $canr= $this->input->post('canr');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
       $this->load->model('a_inv_model');
       $this->a_inv_model->insert_member_detalle($orden,$sec,$can,$canr,$lote,$cadu,$id_cc);
        
        redirect('a_inv/tabla_detalle/'.$id_cc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function borra_detalle($id,$id_cc)
    {
       $this->load->model('a_inv_model');
       $this->a_inv_model->delete_member_detalle($id);
       redirect('a_inv/tabla_detalle/'.$id_cc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function borrar_inv_ctl($id_cc)
    {
    $this->load->model('a_inv_model');
    $this->a_inv_model->delete_member_ctl($id_cc);
    redirect('a_inv/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cerrar()
    {
     $id_cc= $this->input->post('id_cc');
      $this->load->model('a_inv_model');
     $this->a_inv_model->cerrar_member_inv($id_cc);
     redirect('a_inv/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_inv($id_cc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('a_inv_model');
          $query =$this->a_inv_model->busca_folio($id_cc);
          if($query->num_rows() >0){
	      $row=$query->row();
          }
            
         
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>RECIBA DE MERCANCIA<BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>ORDEN $row->orden    FACTURA $row->fac   FOLIO DE CXP $row->cxp<BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    
            <tr>
           <th width=\"40\" align=\"center\"><strong>SEC</strong></th>
           <th width=\"430\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>LOTE</strong></th>
           <th width=\"70\" align=\"center\"><strong>CADUCIDAD</strong></th>
           <th width=\"70\" align=\"center\"><strong>PIEZAS</strong></th>
          </tr>
   </table> 
            ";
            $data['id_cc']=$id_cc;
            $this->load->view('impresiones/a_inv_det', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function rutas()
    {
        $data['mensaje']= '';
        $data['titulo']= 'RUTAS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "rutas";
        $data['selector'] = "a_rutas";
        $data['sidebar'] = "sidebar_rutas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
     public function formulario_busqueda()
    {
  
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "busqueda_x_clave";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function busca_clave()
    {
        $this->load->model('a_inv_model');
        echo $this->a_inv_model->busca_clave();
    }
    
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////pretty popin   
    
    function devo($lote, $sec, $fecha1, $fecha2)
    {
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "devolucion";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";                
                        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->devolucion($lote, $sec, $fecha1, $fecha2);
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');                

    }
    
    function tras($lote, $sec, $fecha1, $fecha2)
    {
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "devolucion";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->tabla_tras($lote, $sec, $fecha1, $fecha2);
        //echo $this->db->last_query();
        //die();
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function ajuste($lote, $sec, $fecha1, $fecha2)
    {
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "devolucion";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->tabla_ajuste($lote, $sec, $fecha1, $fecha2);
        //echo $this->db->last_query();
        //die();
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function compra($lote, $sec, $fecha1, $fecha2)
    {
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "devolucion";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->tabla_compra($lote, $sec, $fecha1, $fecha2);
        //echo $this->db->last_query();
        //die();
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function surtido($lote, $sec, $fecha1, $fecha2)
    {
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "devolucion";
        $data['selector'] = "a_inv";
        $data['sidebar'] = "sidebar_a_inv";
        
        $this->load->model('a_inv_model');
        $data['tabla'] = $this->a_inv_model->tabla_surtido($lote, $sec, $fecha1, $fecha2);
        //echo $this->db->last_query();
        //die();
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

}