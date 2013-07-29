<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Cheques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['titulo']= 'CHEQUES';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "cheques_1";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
  
//////////////////////////////////////////////
//////////////////////////////////////////////

//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************
   public function tabla_control_varios()
    {
        
        $this->load->model('catalogo_model');
		$data['conx'] = $this->catalogo_model->busca_concepto();
        $data['sucx'] = $this->catalogo_model->busca_sucursal();
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control_varios();
        $data['titulo'] = "CAPTURA DE CHEQUES CON RECIBOS DE VARIAS SUCURSALES";
        $data['contenido'] = "cheques_form_0_varios";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************+
 function insert_c_varios()
	{
    $this->load->model('catalogo_model');
    $suc= $this->input->post('suc');
    $clave= $this->input->post('con');
    $rec= $this->input->post('rec');
    $importe= 0;
    $cheque= $this->input->post('cheque');
    $tiva= 0;
    $varios= 0;
    $tipo=0;
    $infinitum=0;
    
    $query = $this->catalogo_model->busca_sucursal_unica($suc);
    $row=$query->row();
    $plaza=$row->plaza;
    $cia=$row->cia;
    $succ=$row->suc_contable;
    $query1 = $this->catalogo_model->busca_ctafor($plaza,$cia);
    $row1=$query1->row();
    $cuenta=$row1->cuenta;
      
	$this->load->model('cheques_model');
    $id_cc=$this->cheques_model->create_member_c($suc,$clave,$rec,$importe,$cheque,$tiva,$varios,$cuenta,$plaza,$cia,$succ,$tipo,$infinitum);
   
    redirect('cheques/tabla_confirma_varios/'.$id_cc);
    
    }
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************

   public function tabla_confirma_varios($id_cc)
    {
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal();
        
        $this->load->model('cheques_model');
        $data['id_cc'] =$id_cc;
        $data['tabla1'] = $this->cheques_model->control_unico($id_cc);
        $data['tabla'] = $this->cheques_model->control_cheque_d($id_cc);
        $data['titulo'] = "CAPTURA DE CHEQUES FACTURAS DE VARIAS SUCURSALES";
        $data['contenido'] = "cheques_form_1_varios_varios";	
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////////////////////////////////////////************************************************************
function busca_suc_detalle()
	{
    	$suc = $this->input->post('suc');
        $id_cc = $this->input->post('id_cc');  
        $this->db->where('suc', $suc);
        $this->db->andwhere('id_cc', $id_cc);
        $q = $this->db->get('cheque_d');
         if($q->num_rows() > 0){
          echo '0';
          }else{
          echo '1';
          }   
    }
//////////////////////////////////////////////************************************************************
 function insert_d()
	{
	$id_cc= $this->input->post('id_cc');
    $this->load->model('cheques_model');
    $query = $this->cheques_model->busca_cheque($id_cc);
    $row=$query->row();
    $cheque= $row->cheque;
    $clave= $row->clave;
    $rec=  $row->receptor;
    $tiva= $row->ivax;
    $plaza=$row->plaza;
    $cia=$row->cia;
    $succ=$row->suc_contable;
    $cuenta=$row->cuenta;
     
    $importe= $this->input->post('importe');
    $varios= $this->input->post('varios');
    $suc= $this->input->post('suc');
    
    $this->load->model('cheques_model');
    $this->cheques_model->create_member_d($suc,$clave,$rec,$importe,$cheque,$tiva,$varios,$cuenta,$plaza,$cia,$succ,$id_cc);
    redirect('cheques/tabla_confirma_varios/'.$id_cc);
    
    }
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************
 function borrar_insert_d($id,$id_cc)
	{
	$this->load->model('cheques_model');
    $this->cheques_model->delete_member_d($id);
    redirect('cheques/tabla_confirma_varios/'.$id_cc);
    
    }
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************
 function validar($id)
	{
	$this->load->model('cheques_model');
    $this->cheques_model->validar_member_c($id);
    redirect('cheques/tabla_control_varios');
    
    }
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************
//////////////////////////////////////////////************************************************************


//////////////////////////////////////////////
   public function tabla_control()
    {
        $user=  $this->session->userdata('id');
        if($user>0){
        $this->load->model('catalogo_model');
		$data['conx'] = $this->catalogo_model->busca_concepto();
        
        $this->load->model('cheques_model');
        $data['tabla'] = '';
        $data['titulo'] = "CAPTURA DE CHEQUES";
        $data['contenido'] = "cheques_form_0";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }else{
    redirect('index');    
    }
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
   public function tabla_confirma()
    {
        $user=  $this->session->userdata('id');
        if($user>0){
        $con=$this->input->post('con');
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal();
        $query = $this->catalogo_model->busca_concepto_unico($con);
        $row=$query->row();
        
        
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control();
        $data['titulo'] = "CAPTURA DE CHEQUES";
        $data['conx'] = $row->descri;
        $data['con'] = $con;
        $data['tiva'] = $row->iva;
        if($con==7 || $con==38){
        $data['contenido'] = "cheques_form_1_varios";	
        }else{
        $data['contenido'] = "cheques_form_1";	
        }
         
        
		$data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }else{
    redirect('index'); 
    }
    }

//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//id, suc, id_user, receptor, clave, cheque, tipo, fecha, fechaval, fechacan, subtotal, ieps, iva, total
  function insert_c()
	{

    $this->load->model('catalogo_model');
    $suc= $this->input->post('suc');
    $clave= $this->input->post('con');
    $rec= $this->input->post('rec');
    $importe= $this->input->post('importe');
    $cheque= $this->input->post('cheque');
    $tiva= $this->input->post('tiva');
    $varios= $this->input->post('varios');
    $infinitum= $this->input->post('infinitum');
    $tipo=1;
    
    
    $query = $this->catalogo_model->busca_sucursal_unica($suc);
    $row=$query->row();
    $plaza=$row->plaza;
    $cia=$row->cia;
    $succ=$row->suc_contable;
    $query1 = $this->catalogo_model->busca_ctafor($plaza,$cia);
    $row1=$query1->row();
    $cuenta=$row1->cuenta;
	$this->load->model('cheques_model');
    $this->cheques_model->create_member_c($suc,$clave,$rec,$importe,$cheque,$tiva,$varios,$cuenta,$plaza,$cia,$succ,$tipo,$infinitum);
    redirect('cheques/tabla_control');
    
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
  public function cancela_cheque($id)
    {
        $data['mensaje']='';
        $this->load->model('catalogo_model');
		$data['conx'] = $this->catalogo_model->busca_concepto();
        
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control_unico_his($id);
        $data['id']=$id;
        $data['titulo'] = "CANCELAR CHEQUE";
        $data['contenido'] = "cheques_form_2";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
  function cancelar_c()
	{
    $id= $this->input->post('id');
    $contra= $this->input->post('contra');
   
    $contrase=strtoupper(substr($contra,0,6));
    $fec=substr($contra,6);
    $fecha= date('Y-m-d');
   
    $this->load->model('cheques_model');
    $query = $this->cheques_model->busca_cheque_para_cancelar($id,$contrase);
    $row=$query->row();
    $num=$row->num;
    
        if($num==1 && $fec==$fecha){
           $this->cheques_model->cancela_member_c($id);
           redirect('cheques/tabla_control_historico');
          }else{
          redirect('cheques/cancela_cheque/'.$id);
         }
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////    

   public function tabla_control_historico()
    {
        
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control_historico();
        $data['titulo'] = "HISTORICO DE  CHEQUES";
        $data['contenido'] = "cheques_1";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
   public function tabla_control_poliza()
    {
        
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        $data['titulo'] = "POLIZA DE CHEQUES";
        $data['contenido'] = "cheques_form_3";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
   public function tabla_control_poliza_filtro()
    {
        
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control_poliza($fec);
        $data['titulo'] = "POLIZA DE CHEQUES";
        
        $data['titulo'] = "POLIZA DE CHEQUES DE ".$mesx." DEL ".date('Y');
        $data['contenido'] = "cheques_1";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }    
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////    
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////    
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////    
   function imprimir_cheque($id_cc)
	{
          $this->load->model('cheques_model');
            $data['cabeza'] = $this->cheques_model->imprime_1($id_cc);
            $data['detalle'] = $this->cheques_model->imprime_2($id_cc);
            $this->load->view('impresiones/cheque', $data);
		}
//////////////////////////////////////////////
//////////////////////////////////////////////
   function imprimir_poliza($fec)
	{
	 $aaa=substr($fec,0,4);
          
          
          $this->load->model('cheques_model');
          $query = $this->cheques_model->busca_cheque_pol($fec);
          $row=$query->row();
            $data['cabeza'] = "
           <table>
           <tr>
           <td colspan=\"9\"></td>
           </tr>
           
           <tr>
           <td colspan=\"9\" align=\"center\">CONTROL DE POLIZAS FORANEAS</td>
           </tr>
           
           <tr>
           <td colspan=\"9\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           
           <tr>
           <td colspan=\"9\" align=\"right\">FECHA DE POLIZA..:".$row->mesx." DEL ".$aaa." <br /></td>
           </tr>
           
           <tr>
           
           <td colspan=\"9\" align=\"right\">USUARIO..:".$row->username." - ".$row->nomx." </td>
           </tr>
           
           
           </table> 
            ";
            
            $data['detalle'] =$this->cheques_model->imprime_poliza_detalle($fec);
            $this->load->view('impresiones/poliza', $data);
		}
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza_mod()
    {
        
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['contax'] = $this->catalogo_model->busca_usuarios_conta();
        
        $data['titulo'] = "POLIZA DE CHEQUES";
        $data['contenido'] = "cheques_form_leo_1";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza_filtro_leo()
    {
        
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $conta= $this->input->post('conta');
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control_poliza_leo($fec,$conta);
        $data['titulo'] = "POLIZA DE CHEQUES";
        
        $data['titulo'] = "POLIZA DE CHEQUES DE ".$mesx." DEL ".date('Y');
        $data['contenido'] = "cheques_1";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }    
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza_filtro_leo_editar($id,$fec,$conta)
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_bloque_id($conta);
        $this->load->model('cheques_model');
        
        $data['titulo'] = "POLIZA DE CHEQUES";
        $query = $this->cheques_model->busca_cheque_oficina($id);
        $row=$query->row();
        $cia=$row->cia;
        $pla=$row->plaza;
        $data['polizax'] = $this->catalogo_model->busca_poliza();  
        $data['recx'] = $this->catalogo_model->busca_concepto_cia($cia,$pla);  
        $data['conta'] =$conta;
        $data['fec'] =$fec;
        $data['id'] =$id;
        $data['sucursal'] = $row->suc.'-'.$row->sucx;
        $data['receptor'] = $row->receptorx;
        $data['clave'] = $row->clave.'-'.$row->clavex;
        $data['cheque'] = $row->cheque;
        $data['fecha'] = $row->fecha;
        $data['subtotal'] = $row->subtotal;
        $data['ieps'] = $row->ieps;
        $data['iva'] = $row->iva;
        $data['iva_retenido'] = $row->iva_retenido;
        $data['iva_cedular'] = $row->iva_cedular;
        $data['iva_transp'] = $row->iva_transp;
        $data['isr_retenido'] = $row->isr_retenido;
        $data['imp_cheque'] = $row->imp_cheque;
        $data['varios_sin_iva'] = $row->varios_sin_iva;
        
        $data['titulo'] = "POLIZA DE CHEQUES "  ;
        $data['contenido'] = "cheques_form_leo_2";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
 function cambio_c()
	{

    $this->load->model('catalogo_model');
    $suc= $this->input->post('suc');
    $cheque= $this->input->post('cheque');
    $clave= $this->input->post('con');
    $rec= $this->input->post('rec');
    $subtotal= $this->input->post('subtotal');
    $ieps= $this->input->post('ieps');
    $iva= $this->input->post('iva');
    $iva_retenido= $this->input->post('iva_retenido');
    $iva_cedular= $this->input->post('iva_cedular');
    $iva_transp= $this->input->post('iva_transp');
    $isr_retenido= $this->input->post('isr_retenido');
    $imp_cheque= $this->input->post('imp_cheque');
    $varios_sin_iva= $this->input->post('varios_sin_iva');
    $id=$this->input->post('id');
    $fec=$this->input->post('fec');
    $conta=$this->input->post('conta');
    $query = $this->catalogo_model->busca_sucursal_unica($suc);
    $row=$query->row();
    $plaza=$row->plaza;
    $cia=$row->cia;
    $succ=$row->suc_contable;
    $query1 = $this->catalogo_model->busca_ctafor($plaza,$cia);
    $row1=$query1->row();
    $cuenta=$row1->cuenta;
	$this->load->model('cheques_model');
    $this->cheques_model->update_member_c_oficina($id,$suc,$clave,$rec,$cheque,$cuenta,$plaza,$cia,$succ,
    $subtotal,$ieps,$iva,$iva_retenido,$iva_cedular,$iva_transp,$isr_retenido,$imp_cheque,$varios_sin_iva);
    redirect('cheques/tabla_control_poliza_filtro_leo_dentro/'.$fec.'/'.$conta);
    
    }
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza_filtro_leo_dentro($fec,$conta)
    {
        
        
        $this->load->model('catalogo_model');
        
        $this->load->model('cheques_model');
        $data['tabla'] = $this->cheques_model->control_poliza_leo($fec,$conta);
        $data['titulo'] = "POLIZA DE CHEQUES";
        
        $data['titulo'] = "POLIZA DE CHEQUES ";
        $data['contenido'] = "cheques_1";
        $data['selector'] = "cheques";
        $data['sidebar'] = "sidebar_cheques";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
   function imprimir_cheque_mod($id_cc)
	{
          $this->load->model('cheques_model');
            $data['cabeza'] = $this->cheques_model->imprime_1_mod($id_cc);
            $data['detalle'] = $this->cheques_model->imprime_2_mod($id_cc);
            $this->load->view('impresiones/cheque', $data);
		}

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
   function imprimir_poliza_mod($fec,$conta)
	{
	 $aaa=substr($fec,0,4);
          
          
          $this->load->model('cheques_model');
          $query = $this->cheques_model->busca_cheque_pol_todo($fec,$conta);
          $row=$query->row();
            $data['cabeza'] = "
           <table>
           <tr>
           <td colspan=\"9\"></td>
           </tr>
           
           <tr>
           <td colspan=\"9\" align=\"center\">CONTROL DE POLIZAS FORANEAS</td>
           </tr>
           
           <tr>
           <td colspan=\"9\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           
           <tr>
           <td colspan=\"9\" align=\"right\">FECHA DE POLIZA..:".$row->mesx." DEL ".$aaa." <br /></td>
           </tr>
           
           <tr>
           
           <td colspan=\"9\" align=\"right\">USUARIO..:".$row->username." - ".$row->nomx." </td>
           </tr>
           
           
           </table> 
            ";
            
            $data['detalle'] =$this->cheques_model->imprime_poliza_detalle_mod($fec,$conta);
            $this->load->view('impresiones/poliza', $data);
		}

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */