<?php
class Cheques_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
///////////////////////////////////////////////    
///////////////////////////////////////////////
    function control()
    {
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.descri,c.nombre,d.nombre as sucx
          FROM desarrollo.cheque_d a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha, '%Y-%m-%d')= ? and id_user= ?";
       
        $query = $this->db->query($sql,array($fecha,$id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>CHEQUE</th>
        <th>CONCEPTO</th>
        <th>SUCURSAL</th>
        <th>DESTINATARIO</th>
        <th>SUBTOTAL</th>
        <th>VARIOS</th>
        <th>IVA</th>
        <th>TOTAL</th>
        <th></th>
        
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $l1 = anchor('cheques/imprimir_cheque/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$row->id."</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".number_format($row->subtotal,2)."</td>
            <td align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td align=\"right\">".number_format($row->iva,2)."</td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


///////////////////////////////////////////////******************************************************
///////////////////////////////////////////////******************************************************
    function control_varios()
    {
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.descri,c.nombre,d.nombre as sucx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ? and tipo=0";
       
        $query = $this->db->query($sql,array($id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>CHEQUE</th>
        <th>CONCEPTO</th>
        <th>SUCURSAL</th>
        <th>DESTINATARIO</th>
        <th>SUBTOTAL</th>
        <th>VARIOS</th>
        <th>IVA</th>
        <th>TOTAL</th>
        <th></th>
        
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $l1 = anchor('cheques/tabla_confirma_varios/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$row->id."</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".number_format($row->subtotal,2)."</td>
            <td align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td align=\"right\">".number_format($row->iva,2)."</td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


///////////////////////////////////////////////******************************************************
///////////////////////////////////////////////******************************************************    
    
///////////////////////////////////////////////
    function control_cheque_d($id_cc)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.descri,c.nombre,d.nombre as sucx
          FROM desarrollo.cheque_d a
          left join catalogo.conta_cvepol b on b.id=a.clave 
          left join catalogo.conta_receptores c on c.rfc=a.receptor and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where id_cc= ? and id_user= ?";
       
        $query = $this->db->query($sql,array($id_cc,$id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>SUBTOTAL</th>
        <th>VARIOS</th>
        <th>IVA</th>
        <th>TOTAL</th>
        <th>BORRAR</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
           $l1 = anchor('cheques/borrar_insert_d/'.$row->id.'/'.$row->id_cc, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"right\">".number_format($row->subtotal,2)."</td>
            <td align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td align=\"right\">".number_format($row->iva,2)."</td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
            $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////******************************************************
///////////////////////////////////////////////******************************************************
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
///////////////////////////////////////////////******************************************************
///////////////////////////////////////////////******************************************************
///////////////////////////////////////////////
///////////////////////////////////////////////
   function control_unico($id)
    {
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.descri,c.nombre,d.nombre as sucx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave 
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where a.id= ? and id_user= ?";
        $query = $this->db->query($sql,array($id,$id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>CHEQUE</th>
        <th>SUCURSAL</th>
        <th>CONCEPTO</th>
        <th>DESTINATARIO</th>
        <th>SUBTOTAL</th>
        <th>IVA</th>
        <th>TOTAL</th>
        <th>VALIDAR</th>
        
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
         $l1 = anchor('cheques/validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));   
            $tabla.="
            <tr>
            
            <td align=\"left\">".$row->id."</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".$row->subtotal."</td>
            <td align=\"right\">".$row->iva."</td>
            <td align=\"right\">".$row->imp_cheque."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function control_unico_his($id)
    {
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.descri,c.nombre,d.nombre as sucx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave 
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where a.id= ? and id_user= ?";
        $query = $this->db->query($sql,array($id,$id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>CHEQUE</th>
        <th>SUCURSAL</th>
        <th>CONCEPTO</th>
        <th>DESTINATARIO</th>
        <th>SUBTOTAL</th>
        <th>IVA</th>
        <th>TOTAL</th>
        
        
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
           $tabla.="
            <tr>
            
            <td align=\"left\">".$row->id."</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".$row->subtotal."</td>
            <td align=\"right\">".$row->iva."</td>
            <td align=\"right\">".$row->imp_cheque."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
 function busca_cheque($id_cc)
    {
     $id_user= $this->session->userdata('id');   
         $sql = "select a.id, a.suc, a.id_user, a.receptor, a.clave, a.cheque, a.tipo, a.fecha,
     extract(year from a.fecha)as aaag, extract(day from a.fecha)as diag,
     a.subtotal, a.ieps, a.iva,
     b.descri,b.cuenta,b.cuenta_iva,b.iva,b.auxiliar,
     c.nombre,
     d.cia,d.plaza,d.nombre as sucx,d.iva as ivax,d.suc_contable,
     e.mes as mesx,
     f.cuenta
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          left join catalogo.conta_ctasfor f on f.plaza =a.plaza  and f.cia=a.cia
          where a.id = ? and id_user= ? 
          order by cheque";
    $query = $this->db->query($sql,array($id_cc,$id_user));
     return $query; 
    }
 ///////////////////////////////////////////////
///////////////////////////////////////////////
 function busca_cheque_pol($fec)
    {
     $id_user= $this->session->userdata('id');  
     $sql = "SELECT a.*,date_format(a.fecha, '%Y-%m-%d')as fec,
    b.descri,b.cuenta,b.cuenta_iva,b.iva,b.auxiliar,
     c.nombre,
     d.cia,d.plaza,d.nombre as sucx,d.iva as ivax,
     e.mes as mesx,
     f.plaza as plazax,
     g.cuenta,
     h.username,h.nombre as nomx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc
          left join catalogo.sucursal d on d.suc=a.suc
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          left join catalogo.conta_plazas f on f.cia=d.cia and f.nplaza=d.plaza
          left join catalogo.conta_ctasfor g on g.cia=d.cia and g.plaza=d.plaza
          left join usuarios h on h.id=a.id_user
          where date_format(a.fecha, '%Y-%m')= ? and id_user= ? 
          group by date_format(a.fecha, '%Y-%m'), a.cia 
          order by cheque";
     $query = $this->db->query($sql,array($fec,$id_user));
     return $query; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function busca_cheque_para_cancelar($id,$contrase)
    {
     $sql = "select count(*)as num from cheque_c a
    left join usuarios b on b.id= a.id_user
    where a.id= ? and b.pass= ?";
    $query = $this->db->query($sql,array($id,$contrase));
     return $query; 
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////

function create_member_c($suc,$clave,$rec,$importe,$cheque,$tiva,$varios,$cuenta,$plaza,$cia,$succ,$tipo,$infinitum)
	{
	   $iva_cedular=0;
       $iva_transp=0;
       
       $s = "SELECT * FROM catalogo.conta_impuesto where nid = ? ";
        $q = $this->db->query($s,array($suc));
        $r= $q->row();
        $cedular=$r->cedular;
        $transporte=$r->transporte;
        $alumbrado=$r->alumbrado;
        $constante=$r->constante;
        $iva_r=$r->iva_r;
        $isr_r=$r->isr_r;
        $constante_tra=$r->constante_tran;
        
    $sql21 = "SELECT * FROM catalogo.sucursal where suc = ? ";
        $query21 = $this->db->query($sql21,array($suc));
        $row21= $query21->row();
        $cia=$row21->cia;
        
	$sql0 = "SELECT * FROM catalogo.conta_cvepol where id = ? ";
    $query0 = $this->db->query($sql0,array($clave));
    $row0= $query0->row();
	 
    $piva=0;
    $iva=0;
    $subtotal=0;
    $iva_retenido=0;
    $isr_retenido=0;
    $imp_cheque=0;
    $total=0;      
    ///*****para los que generan iva
    
    if($row0->cuenta_iva >0){
    $sql = "SELECT * FROM catalogo.sucursal where suc = ? ";
        $query = $this->db->query($sql,array($suc));
        $row= $query->row();
                                           ///los que generan ieps  
                if($clave==38){
                   
                   $piva=$row->iva+1;
                   $iva=round(($importe-($importe/$piva))*100)/100;
                   $subtotal=($importe-$iva-$infinitum)/1.03;
                   $ieps=($importe-$iva-$infinitum)-$subtotal;
                   $imp_cheque=$importe+$varios; 
                }else{
                   $piva=$row->iva+1;
                   $iva=round(($importe-($importe/$piva))*100)/100;
                   $subtotal=$importe-$iva;
                   $imp_cheque=$importe; 	       
                   if($varios==null){$varios=0;}
                   $ieps=0;
                  
                  /////////////////////////////////////////////////////////////////*****************
                       
				  if($row0->cuenta_varios >0){
                          	$ieps=0;
                   			$iva=round(($importe-($importe/$piva))*100)/100;
                            $subtotal=$importe-$iva;
                   			$imp_cheque=$importe+$varios; 	
                          	}
                                   /////////////////////////////////////////////////////////////////***************** 
                   if($clave==7){
                   $piva=$row->iva+1;
                   $iva=round(($importe-($importe/$piva))*100)/100;
                   $subtotal=$importe-$iva;
                   if($alumbrado>0){$ap=round(($subtotal*$alumbrado)*100)/100;}else{$ap=0;}
                   if($varios==null){$varios=0;}
                   $imp_cheque=$importe+$ap; 	  
                  
                   }
                 
				}
                 
                
/////////////////////////////////////////////////impuesto del isr e iva retenido
                if($row0->cuenta_isr > 0){
                   
                   $imp_cheque=$importe;
                   $subtotal=round(($importe*$constante)*100)/100;
                   $iva=round(($subtotal*$row->iva)*100)/100;
                   $total=$subtotal;
                    $iva_retenido=round(($subtotal*$iva_r)*100)/100;
                    $isr_retenido=($subtotal*$isr_r);
                    $iva_cedular =round(($subtotal*$cedular)*100)/100;
                }          
          
///////////////////////////////////////////////////////////////////////////iva de transportacion
///////////////////////////////////////////////////////////////////////////iva de transportacion

                if($constante_tra> 0){
                    $subtotal=round(($importe*$constante_tra)*100)/100;
                    $iva=round(($subtotal*$row->iva)*100)/100;
                    $iva_transp=$subtotal*$transporte;
                    $imp_cheque=$importe;
              
                }            
///////////////////////////////////////////////////////////////////////////iva de transportacion
///////////////////////////////////////////////////////////////////////////iva de transportacion
           
    }
    ///////////////////////////////////////////////////////cuando no genera iva
    if($tiva=='N'){
        $subtotal=$importe;
        $iva=0;
        $ieps=0; 
        $total=$importe;
        $imp_cheque=$importe;        
    }
    ///*****para los que generan iva
        ///////////////////////////////////////////graba concentrado________________________contadores____________
        $new_member_insert_data = array(
			'suc' => $suc,
            'id_user' => $this->session->userdata('id'),
            'clave' => $clave,
            'Cheque' =>$cheque,
            'receptor' => str_replace(' ', '',strtoupper(trim($rec))),
			'tipo' => $tipo,
            'subtotal' => $subtotal,
            'ieps' => $ieps,
            'iva' => $iva,
            'iva_retenido'=>$iva_retenido,
            'isr_retenido'=>$isr_retenido,
            'imp_cheque'=>$imp_cheque,
            'varios_sin_iva'=>$varios+$ap,
            'iva_cedular'=>$iva_cedular,
            'iva_transp'=>$iva_transp,
            'cia'=>$cia,
            'plaza'=>$plaza,
            'succ'=>$succ,
            'cuenta'=>$cuenta
		);
		
		$insert = $this->db->insert('desarrollo.cheque_c', $new_member_insert_data);
        $id_ccn= $this->db->insert_id();
        ///////////////////////////////////////////graba concentrado________________________contadores____________
        ///////////////////////////////////////////graba concentrado________________________oficnas_________________
        $new_member_insert_datax = array(
			'id' => $id_ccn,
            'suc' => $suc,
            'id_user' => $this->session->userdata('id'),
            'clave' => $clave,
            'Cheque' =>$cheque,
            'receptor' => str_replace(' ', '',strtoupper(trim($rec))),
			'tipo' => $tipo,
            'subtotal' => $subtotal,
            'ieps' => $ieps,
            'iva' => $iva,
            'iva_retenido'=>$iva_retenido,
            'isr_retenido'=>$isr_retenido,
            'imp_cheque'=>$imp_cheque,
            'varios_sin_iva'=>$varios+$ap,
            'iva_cedular'=>$iva_cedular,
            'iva_transp'=>$iva_transp,

            'cia'=>$cia,
            'plaza'=>$plaza,
            'succ'=>$succ,
            'cuenta'=>$cuenta
		);
		
		$insert = $this->db->insert('desarrollo.cheque_c_oficina', $new_member_insert_datax);
    
        ///////////////////////////////////////////graba concentrado________________________oficnas_________________
       return $id_ccn;
  
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
function create_member_d($suc,$clave,$rec,$importe,$cheque,$tiva,$varios,$cuenta,$plaza,$cia,$succ,$id_cc)
	{
    $piva=0;
    $iva=0;
    $subtotal=0;
    $iva_retenido=0;
    $isr_retenido=0;
    $imp_cheque=0;
    $total=0;
        $cedular=0;
        $transporte=0;
        $alumbrado=0;
        $constante=0;      
    ///*****para los que generan iva
    
    $sql = "SELECT * FROM catalogo.sucursal where suc = ? ";
        $query = $this->db->query($sql,array($suc));
        $row= $query->row();
$s = "SELECT * FROM catalogo.conta_impuesto where nid = ? ";
        $q = $this->db->query($s,array($suc));
        $r= $q->row();
        $cedular=$r->celular;
        $transporte=$r->transporte;
        $alumbrado=$r->alumbrado;
        $constante=$r->constante;
        
                if($clave==7 || $clave==37 || $clave==3 || $clave==43){ 
                
                if($clave==7){
                   $piva=$row->iva+1;
                   $iva=round(($importe-($importe/$piva))*100)/100;
                   $subtotal=$importe-$iva;
                   if($alumbrado>0){$ap=round(($subtotal*$alumbrado)*100)/100;}else{$ap=0;}
                   if($varios==null){$varios=0;}
                   $imp_cheque=$importe+$ap; 	       
                   
                   $ieps=0;
        }                    
    ///////////////////////////////////////////graba concentrado
   if($clave==3 || $clave==43 ){
                 $piva=0; 
                   $iva=0;
                   $subtotal=$importe;
                   $imp_cheque=$importe+$iva; 	       
                   $ieps=0;
                   $variosx=0;       
						  
                          	$ieps=0;
                   			$iva=0;
                            $subtotal=$importe;
                            $imp_cheque=$importe;
        } 
   ///////////////////////////////////////////graba concentrado
///////////////////////////////////////////////////////////////////////contador
        $new_member_insert_data = array(
			'suc' => $suc,
            'id_cc' => $id_cc,
            'id_user' => $this->session->userdata('id'),
            'clave' => $clave,
            'Cheque' =>$cheque,
            'receptor' => str_replace(' ', '',strtoupper(trim($rec))),
			'tipo' => 1,
            'subtotal' => $subtotal,
            'ieps' => $ieps,
            'iva' => $iva,
            'iva_retenido'=>$iva_retenido,
            'isr_retenido'=>$isr_retenido,
            'imp_cheque'=>$imp_cheque+$varios,
            'varios_sin_iva'=>$ap+$varios,
            'cia'=>$cia,
            'plaza'=>$plaza,
            'succ'=>$succ,
            'cuenta'=>$cuenta
		);
		
		$insert = $this->db->insert('desarrollo.cheque_d', $new_member_insert_data);
        $id_ccn= $this->db->insert_id();
        ///////////////////////////////////////////////////////////////////////oficina
                $new_member_insert_datax = array(
            'id' => $id_ccn,
			'suc' => $suc,
            'id_cc' => $id_cc,
            'id_user' => $this->session->userdata('id'),
            'clave' => $clave,
            'Cheque' =>$cheque,
            'receptor' => str_replace(' ', '',strtoupper(trim($rec))),
			'tipo' => 1,
            'subtotal' => $subtotal,
            'ieps' => $ieps,
            'iva' => $iva,
            'iva_retenido'=>$iva_retenido,
            'isr_retenido'=>$isr_retenido,
            'imp_cheque'=>$imp_cheque+$varios,
            'varios_sin_iva'=>$ap+$varios,
            'cia'=>$cia,
            'plaza'=>$plaza,
            'succ'=>$succ,
            'cuenta'=>$cuenta
		);
		
		$insertx = $this->db->insert('desarrollo.cheque_d_oficina', $new_member_insert_datax);
        ///////////////////////////////////////////////////////////////////////oficina
         ///////////////////////////////////////////////////////////////////////oficina
          ///////////////////////////////////////////////////////////////////////oficina
        
        $sqlX = "SELECT 
        sum(subtotal) as subtotal, sum(ieps)as ieps, sum(iva)as iva, sum(iva_retenido)as iva_retenido, 
        sum(isr_retenido)as isr_retenido, sum(imp_cheque)as imp_cheque, sum(varios_sin_iva) as varios_sin_iva, 
        id_cc FROM cheque_d  where id_cc = ? group by id_cc";
        $queryX = $this->db->query($sqlX,array($id_cc));
        $rowX= $queryX->row();
        ///////////////////////////////////////////////////////////////////////contador
        $data = array(
			'subtotal' => $rowX->subtotal,
            'ieps' => $rowX->ieps,
            'iva' => $rowX->iva,
            'iva_retenido' => $rowX->iva_retenido,
            'isr_retenido' => $rowX->isr_retenido,
            'imp_cheque' => $rowX->imp_cheque,
            'varios_sin_iva' => $rowX->varios_sin_iva
		
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cheque_c', $data);
 ///////////////////////////////////////////////////////////////////////oficina       
        $datax = array(
			'subtotal' => $rowX->subtotal,
            'ieps' => $rowX->ieps,
            'iva' => $rowX->iva,
            'iva_retenido' => $rowX->iva_retenido,
            'isr_retenido' => $rowX->isr_retenido,
            'imp_cheque' => $rowX->imp_cheque,
            'varios_sin_iva' => $rowX->varios_sin_iva
		
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cheque_c_oficina', $datax);
 }  
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
function cancela_member_c($id)
	{
      ///////////////////////////////////////////////////////////////////////contador
	  $data = array(
			'tipo' => 4,
			'fechacan'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id);
        $this->db->update('cheque_c', $data);
         ///////////////////////////////////////////////////////////////////////oficina
      $datax = array(
			'tipo' => 4,
			'fechacan'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id);
        $this->db->update('cheque_c_oficina', $datax);
        
        return $this->db->affected_rows();
	}
///////////////////////////////////////////////
///////////////////////////////////////////////
function delete_member_d($id)
	{
	  $this->db->delete('cheque_d', array('id' => $id));
      $this->db->delete('cheque_d_oficina', array('id' => $id));
	}

///////////////////////////////////////////////    
///////////////////////////////////////////////
function validar_member_c($id)
	{
  ///////////////////////////////////////////////////////////////////////contador
	  $data = array(
			'tipo' => 1,
			'fechacan'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id);
        $this->db->update('cheque_c', $data);
  ///////////////////////////////////////////////////////////////////////oficina
      $datax = array(
			'tipo' => 1,
			'fechacan'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id);
        $this->db->update('cheque_c_oficina', $datax);  
        return $this->db->affected_rows();
	}
///////////////////////////////////////////////
    function control_historico()
    {
        $fecha= date('Y-m-d');
        $id_user=  $this->session->userdata('id');
         $sql = "SELECT a.*,b.descri,c.nombre,d.nombre as sucx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ?
          order by cheque desc";
        $query = $this->db->query($sql,array($id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>CHEQUE</th>
        <th>CONCEPTO</th>
        <th>SUCURSAL</th>
        <th>DESTINATARIO</th>
        <th>SUBTOTAL</th>
        <th>IVA</th>
        <th>TOTAL</th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
           $tipo= $row->tipo;
           
            $l1 = anchor('cheques/imprimir_cheque/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            $l2 = anchor('cheques/cancela_cheque/'.$row->id, '<img src="'.base_url().'img/icon_error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
        if($tipo==1){
            $tabla.="
            <tr>
            <td align=\"left\">".$row->id."</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".$row->subtotal."</td>
            <td align=\"right\">".$row->iva."</td>
            <td align=\"right\">".$row->imp_cheque."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
          }
          if($tipo==4){
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->id."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->cheque."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->descri."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->sucx."(".$row->suc.")</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->nombre."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->subtotal."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->iva."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->imp_cheque."</font></td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\"></td>
            </tr>
            ";
          } 
           
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
   function control_poliza($fec)
    {
        
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         $imp_che=0;
         $imp_che_can=0;
         $id_user=  $this->session->userdata('id');
         $sql = "SELECT a.*,date_format(a.fecha, '%Y-%m-%d')as fec,
         b.descri,
         c.nombre,
         d.nombre as sucx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha, '%Y-%m')= ? and id_user= ?
          order by cheque";
        $query = $this->db->query($sql,array($fec,$id_user));
        $l0 = anchor('cheques/imprimir_poliza/'.$fec, ' IMPRIME POLIZA <img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
        $tabla= "
        <table>
        <thead>
        <tr>
        <td colspan=\"9\">".$l0."</td>
        </tr>
        
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>CHEQUE</th>
        <th>BENEFICIARIO</th>
        <th>IMPORTE</th>
        <th>CONCEPTO</th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $tipo= $row->tipo;    
            $l1 = anchor('cheques/imprimir_cheque/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            if($tipo==1){
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->fec."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\"></td>
            </tr>
            ";
            $che=$che+1;
          $imp_che=$imp_che+$row->imp_cheque;
            }
            if($tipo==4){
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$num."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->fec."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->sucx."(".$row->suc.")</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->cheque."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->nombre."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".number_format($row->imp_cheque,2)."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->descri."</font></td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">CANCELAD0</font></td>
            </tr>
            ";
          $checan=$checan+1;
          $imp_che_can=$imp_che_can+$row->imp_cheque;
          } 
        
        $num=$num+1;
        
        }
        
        $tabla.="
        <tr>
        <td align=\"left\" colspan=\"3\"><font size=\"1\" color=\"#FC0606\">CHEQUES ...:</font></td>
        <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$che."</font></td>
        <td align=\"right\" colspan=\"2\"><font size=\"1\" color=\"#FC0606\">".number_format($imp_che,2)."</font></td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"3\"><font size=\"1\" color=\"#FC0606\">CHEQUES CANCELADOS...:</font></td>
        <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$checan."</font></td>
        <td align=\"right\" colspan=\"2\"><font size=\"1\" color=\"#FC0606\">".number_format($imp_che_can,2)."</font></td>
        </tr>
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////imprime dos partes del cheque
function imprime_1($id_cc)
	{
	   
    $sql = "SELECT a.*, extract(year from a.fecha)as aaag, extract(day from a.fecha)as diag, 
     b.descri,b.cuenta as cuentar,b.auxiliar,b.cuenta_iva,b.auxi_iva,b.cuenta_ivar, b.auxi_ivar,
     b.cuenta_isr,b.auxi_isr,b.cuenta_cedular,b.auxi_cedular,b.cuenta_transp,b.auxi_transp, b.iva as tiva,
     c.nombre,
     d.cia,d.plaza,d.nombre as sucx,d.iva as ivax,d.suc_contable,
     e.mes as mesx,
     f.ctapol,f.banco,g.nombre as bancox
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          left join catalogo.conta_ctasfor f on f.cia=d.cia and f.plaza=d.plaza
          left join catalogo.conta_bancos g on g.id=f.banco
          where a.id = ? ";
    $query = $this->db->query($sql,array($id_cc)); 
    $var=0;
    $tiva='';
    $tipo=0;
    foreach($query->result() as $row)
        {
            $var=$row->clave;
            $tiva=$row->tiva;
            $tipo=$row->tipo;
            $iva_cedular=$row->iva_cedular;
            $iva_transp=$row->iva_transp;
            $iva_retenido=$row->iva_retenido;
            $varios=$row->varios_sin_iva;
            
	$cabeza = "
            <table>
            <tr>
            <td colspan=\"4\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
            </tr>
            
            <tr>
            <td colspan=\"4\" align=\"left\">Cuenta.: ".$row->cuenta."  Cheque.:".$row->cheque."<br /></td>
            </tr>
            
            <tr>
            <td colspan=\"4\">".$row->diag." DE ".$row->mesx." DEL ".$row->aaag."<br /></td>   
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"3\">".$row->nombre."<br /><br /></td>   
            </tr>

            <tr>
            <td>Cta-Cia-Plz-Suc-Aux</td>
            <td>Descripcion</td>
            <td align=\"right\">Cargo</td>
            <td align=\"right\">Bono</td>
            </tr>
            <tr>
            <td colspan=\"4\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
            </tr>
            
            <tr>
            <td colspan=\"2\">".$row->cuentar."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxiliar,5,0,STR_PAD_LEFT)." <font size=\"-3\">".trim($row->descri)."</font></td>
            <td align=\"right\">".number_format($row->subtotal,2)."</td>
            <td></td>
            </tr>
            ";
           if($varios>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuentar."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxiliar,5,0,STR_PAD_LEFT)." <font size=\"-3\"> VARIOS GASTOS SIN IVA</font></td>
            <td align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td></td>
            </tr>
             ";    
            
            }
            if($tiva=='S'){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_iva."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_iva,5,0,STR_PAD_LEFT)."<font size=\"-3\"> GRABADOS ".number_format($row->ivax*100,0)."% </font></td>
            <td align=\"right\">".number_format($row->iva,2)."</td>
            <td></td>
            </tr>
            ";
            }
           
           if($row->ieps>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">0000-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_iva,5,0,STR_PAD_LEFT)."<font size=\"-3\"> IEPS</font></td>
            <td></td>
            <td align=\"right\">".number_format($row->ieps,2)."</td>
            </tr>
             ";    
            
            }
            if($iva_retenido>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_ivar."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_ivar,5,0,STR_PAD_LEFT)."<font size=\"-3\"> IVA RETENIDO</font></td>
            <td></td>
            <td align=\"right\">".number_format($row->iva_retenido,2)."</td>
            </tr>
            
            <tr>
            <td colspan=\"2\">".$row->cuenta_isr."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_isr,5,0,STR_PAD_LEFT)."<font size=\"-3\"> ISR RETENIDO</font></td>
            <td></td>
            <td align=\"right\">".number_format($row->isr_retenido,2)."</td>
            </tr>
            ";
            }
            if($iva_cedular>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_cedular."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_cedular,5,0,STR_PAD_LEFT)."<font size=\"-3\"> IVA CEDULAR</font></td>
            <td></td>
            <td align=\"right\">".number_format($row->iva_cedular,2)."</td>
            </tr>
             ";    
            
            }

             if($iva_transp>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_transp."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_transp,5,0,STR_PAD_LEFT)."<font size=\"-3\"> IVA TRANSPORTACION</font></td>
            <td></td>
            <td align=\"right\">".number_format($row->iva_transp,2)."</td>
            </tr>
             ";    
            
            }
    $cabeza.="         
            <tr>
            <td colspan=\"2\">".$row->ctapol."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->banco,5,0,STR_PAD_LEFT)."<font size=\"-3\"> ".$row->bancox."</font></td>
            <td></td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            <tr>
            <td colspan=\"4\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
            </tr>
            <tr>
            <td></td>
            <td></td>
            <td align=\"right\">".number_format(($row->iva + $row->subtotal+ $row->varios_sin_iva),2)."</td>
            <td align=\"right\">".number_format(($row->iva_retenido + $row->isr_retenido + $row->iva_cedular + $row->iva_transp + $row->imp_cheque),2)."</td>
            
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"3\">CONCEPTO.: ".$row->descri."</td>
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"3\">SUCURSAL.: ".trim($row->sucx)."(".$row->suc.")</td>   
            </tr>
            
            ";
    $cabeza.=$this->imprime_detalle_d_1($id_cc);
            if($tipo==4){
    $cabeza.="
            <tr>
            <td colspan=\"4\" align=\"center\"><font size=\"+6\">C A N C E L A D O</font></td>
            </tr>
            ";
            }
    $cabeza.="
            </table>";
    
    
    } 
            
            return $cabeza;
            
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
function imprime_2($id_cc)
	{
	   
    $sql = "SELECT a.*, extract(year from a.fecha)as aaag, extract(day from a.fecha)as diag, 
     b.descri,b.cuenta,b.auxiliar,b.cuenta_iva,b.auxi_iva,b.cuenta_ivar, b.auxi_ivar,b.cuenta_isr,b.auxi_isr, b.iva as tiva,
     c.nombre,
     e.mes as mesx
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          where a.id = ? ";
    $query = $this->db->query($sql,array($id_cc)); 
    $var=0;
    $tiva=0;
    $tipo=0;
    foreach($query->result() as $row)
        {
            include_once("CNumeroaLetra.php");
			$numalet= new CNumeroaletra;
			$numalet->setNumero($row->imp_cheque);
			$numalet->setMoneda('PESOS');
			$numalet->setPrefijo("");
			$numalet->setSufijo("M.N.");
            $letra= $numalet->letra();
            $tipo=$row->tipo;
            $var=$row->clave;
	$detalle = "<table>
            <tr>
            <td></td>
            <td></td>
            <td colspan=\"2\">".$row->diag." DE ".$row->mesx." DEL ".$row->aaag."<br /></td>
            <td></td>
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"2\">".$row->nombre."<br /><br /></td>
            <td></td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            
            <tr>
            <td colspan=\"4\" align=\"left\">".$letra."</td>
            </tr>
            ";
            if($tipo==4){
    $detalle.="
            <tr>
            <td colspan=\"4\" align=\"center\"><font size=\"+4\">C A N C E L A D O</font></td>
            </tr>
            ";
            }
    $detalle.="
            </table>";
    
    } 
            
            return $detalle;
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
   function imprime_poliza_detalle($fec)
    {
         
         $gencan=0;
         $genval=0;
         $gencanche=0;
         $genche=0;
         
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         
         $subtotal_che=0;
         $varios_che=0;
         $iva_che=0;
         $isr_che=0;
         $ivar_che=0;
         $imp_che=0;
         
         $subtotal_che_can=0;
         $varios_che_can=0;
         $iva_che_can=0;
         $isr_che_can=0;
         $ivar_che_can=0;
         $imp_che_can=0;
         
         $id_user= $this->session->userdata('id');
         $sql0="select a.plaza,c.plaza as plazax, a.cuenta,a.cia, b.razon as ciax 
         from desarrollo.cheque_c a
         left join catalogo.compa b on  b.cia=a.cia
         left join catalogo.conta_plazas c on  c.cia=a.cia and c.nplaza=a.plaza 
         where date_format(a.fecha, '%Y-%m')='$fec' and a.id_user=$id_user group by a.cia order by a.cia";
         $query0 = $this->db->query($sql0);
        $detalle=" ";
         foreach($query0->result() as $row0)
         {
         $cia=$row0->cia;
         $detalle.="
        <table>
        <tr>
        <td colspan=\"4\">.<br /><strong>".$row0->cia."_".$row0->ciax."</strong></td>
        <td colspan=\"2\" align=\"left\">.<br /><strong>PLAZA..: </strong>".$row0->plaza." ".$row0->plazax." </td>
        <td colspan=\"2\" align=\"left\">.<br /><strong>CUENTA..:</strong>".$row0->cuenta." </td>
        </tr>
        </table>";
         $sql = "SELECT a.*,date_format(a.fecha, '%Y-%m-%d')as fec,
         b.descri,
         c.nombre,
         d.nombre as sucx,d.suc_contable
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha, '%Y-%m')= ? and id_user= ? and a.cia=?
          order by cheque";
        $query = $this->db->query($sql,array($fec,$id_user,$cia));
        
        $detalle.= "
        <table>
        <tr>
        <td colspan=\"9\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
        </tr>
           
           <tr>
           
           <td width=\"97\" align=\"center\">CHEQUE</td>
           <td width=\"97\" align=\"right\">SUBTOTAL</td>
           <td width=\"97\" align=\"right\">VARIOS</td>
           <td width=\"97\" align=\"right\">IVA</td>
           <td width=\"97\" align=\"right\">ISR</td>
           <td width=\"97\" align=\"right\">IVA RET.</td>
           <td width=\"97\" align=\"right\">IVA CED</td>
           <td width=\"97\" align=\"right\">IVA TRANSP</td>
           <td width=\"97\" align=\"right\">IMPORTE</td>
           
           
           </tr>
           
         <tr>
         <td colspan=\"9\"> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
         </tr>
        
        ";
        
        foreach($query->result() as $row)
        {
        $tipo= $row->tipo;    
        if($tipo==1){
        $detalle.="
           
            
            <tr>
            
            <td width=\"97\" align=\"center\">".$row->cheque."</td>
            <td width=\"97\" align=\"right\">".number_format($row->subtotal,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->isr_retenido,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva_retenido,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva_cedular,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva_transp,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            <tr>
            <td>______</td>
            </tr>
            <tr>
            <td width=\"300\" align=\"left\"><strong>".$row->fec."</strong>-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->suc,5,0,STR_PAD_LEFT)." - ".trim($row->sucx)." ".$row->nombre."</td>
            <td width=\"250\" align=\"left\">".$row->descri."</td>
            </tr>
            ";
            $che=$che+1;
            $genval=$genval+1;
            $genche=$genche+$row->imp_cheque;
            
            $subtotal_che=$subtotal_che+$row->subtotal;
            $varios_che=$varios_che+$row->varios_sin_iva;
            $iva_che=$iva_che+$row->iva;
            $isr_che=$isr_che+$row->isr_retenido;
            $ivar_che=$ivar_che+$row->iva_retenido;
            $imp_che=$imp_che+$row->imp_cheque;
            $id_cc=$row->id;
            $detalle.=$this->imprime_detalle_d($id_cc);
            }
            if($tipo==4){
        $detalle.="
            <tr>
            
            <td width=\"97\" align=\"center\">".$row->cheque."</td>
            <td width=\"97\" align=\"right\">".number_format($row->subtotal,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->isr_retenido,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva_retenido,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva_cedular,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->iva_transp,2)."</td>
            <td width=\"97\" align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            <tr>
            <td>______</td>
            </tr>
            <tr>
            <td width=\"300\" align=\"left\"><strong>".$row->fec."</strong>-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->suc,5,0,STR_PAD_LEFT)." - ".trim($row->sucx)." ".$row->nombre."</td>
            <td width=\"250\" align=\"left\">".$row->descri." CANCELADO</td>
            </tr>
            ";
          $checan=$checan+1;
          $gencan=$gencan+1;
          $gencanche=$gencanche+$row->imp_cheque;
            $subtotal_che_can=$subtotal_che_can+$row->subtotal;
            $varios_che_can=$varios_che_can+$row->varios_sin_iva;
            $iva_che_can=$iva_che_can+$row->iva;
            $isr_che_can=$isr_che_can+$row->isr_retenido;
            $ivar_che_can=$ivar_che_can+$row->iva_retenido;
            $imp_che_can=$imp_che_can+$row->imp_cheque;
          } 
        
        $num=$num+1;
        
        }
        
        
        $detalle.="
        <tr>
        <td colspan=\"9\"> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
        </tr>
        
        <tr>
        <td align=\"left\" colspan=\"3\">CHEQUES ...:".$che."</td>
        <td align=\"right\">".number_format($subtotal_che,2)."</td>
        <td align=\"right\">".number_format($varios_che,2)."</td>
        <td align=\"right\">".number_format($iva_che,2)."</td>
        <td align=\"right\">".number_format($isr_che,2)."</td>
        <td align=\"right\">".number_format($ivar_che,2)."</td>
        <td align=\"right\">".number_format($imp_che,2)."<br /></td>
        </tr>
        
        <tr>
        <td align=\"left\" colspan=\"3\">CHEQUES CANCELADOS...:".$checan."</td>
        <td align=\"right\">".number_format($subtotal_che_can,2)."</td>
        <td align=\"right\">".number_format($varios_che_can,2)."</td>
        <td align=\"right\">".number_format($iva_che_can,2)."</td>
        <td align=\"right\">".number_format($isr_che_can,2)."</td>
        <td align=\"right\">".number_format($ivar_che_can,2)."</td>
        <td align=\"right\">".number_format($imp_che_can,2)."<br /></td>
        </tr>";
       $che=0;
       $imp_che=0;
       $checan=0;
       $imp_che_can=0;
        }
        $detalle.="
        <tr>
        <td width=\"350\"  align=\"left\"><strong>TOTAL DE CHEQUES ...:</strong></td>
        <td align=\"right\"><strong>".$genval."</strong></td>
        <td align=\"right\"><strong>".number_format($genche,2)."</strong></td>
        <td colspan=\"3\"></td>
        </tr>
        
        <tr>
        <td align=\"left\" colspan=\"1\"><strong>TOTOAL DE CHEQUES CANCELADOS...:</strong></td>
        <td align=\"right\"><strong>".$gencan."</strong></td>
        <td align=\"right\" colspan=\"1\"><strong>".number_format($gencanche,2)."</strong><></td>
        <td colspan=\"3\"></td>
        </tr>
        </table>"; 
      
        return $detalle;
  
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
   function imprime_detalle_d($id_cc)
    {
        
        $id_user= $this->session->userdata('id');
        $sql = "SELECT a.*,
         d.nombre as sucx,d.suc_contable
          FROM desarrollo.cheque_d a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_cc= ? and id_user= ?
          order by cheque";
         $query = $this->db->query($sql,array($id_cc,$id_user));
         $a="
         <table>
         <tr>
         <td width=\"97\"></td>
         <td colspan=\"8\">|** - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*|</td>
         </tr>
         ";
          foreach($query->result() as $row)
        {
         $a.= " 
       
             <tr>
            
            <td width=\"97\" align=\"left\"><strong>".$row->suc." - ".trim($row->sucx)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->subtotal,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->varios_sin_iva,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->iva,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->isr_retenido,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->iva_retenido,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->iva_cedular,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->iva_transp,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->imp_cheque,2)."</strong></td>
            </tr>
         
        ";
    
    }
     $a.="
     <tr>
    <td width=\"97\"></td>
    <td colspan=\"8\">|** - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*|</td>
         </tr>
     </table>";
     return $a;    
    }
///////////////////////////////////////////////
///////////////////////////////////////////////

///////////////////////////////////////////////
///////////////////////////////////////////////
   function imprime_detalle_d_1($id_cc)
    {
        
        $id_user= $this->session->userdata('id');
        $sql = "SELECT a.*,
         d.nombre as sucx,d.suc_contable
          FROM desarrollo.cheque_d a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_cc= ? and id_user= ?
          order by cheque";
         $query = $this->db->query($sql,array($id_cc,$id_user));
         if($query->num_rows() > 0){
         $a="
         <table>
         <tr>
         <td colspan=\"9\">|* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*|</td>
         </tr>
         <tr>
           <td width=\"125\"align=\"left\">SUCURSAL</td>
           <td width=\"75\" align=\"right\">SUBTOTAL</td>
           <td width=\"75\" align=\"right\">VARIOS</td>
           <td width=\"75\" align=\"right\">IVA</td>
           <td width=\"75\" align=\"right\">ISR</td>
           <td width=\"75\" align=\"right\">IVA RET.</td>
           <td width=\"75\" align=\"right\">IMPORTE</td>
           
           
           </tr>

         ";
          foreach($query->result() as $row)
        {
         $a.= " 
       
             <tr>
            <td width=\"97\" align=\"left\"><strong>".$row->suc." - ".trim($row->sucx)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->subtotal,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->varios_sin_iva,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->iva,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->isr_retenido,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->iva_retenido,2)."</strong></td>
            <td width=\"97\" align=\"right\"><strong>".number_format($row->imp_cheque,2)."</strong></td>
            </tr>
         
        ";
    
    }
     $a.="
     <tr>
     <td colspan=\"9\">|* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*|</td>
     </tr>
     </table>";
     return $a;    
    }
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////


   function control_poliza_leo($fec,$conta)
    {
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         $imp_che=0;
         $imp_che_can=0;
          $sql = "SELECT a.*,date_format(a.fecha, '%Y-%m-%d')as fec,
         b.descri,
         c.nombre,
         d.nombre as sucx
          FROM desarrollo.cheque_c_oficina a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha, '%Y-%m')= ? and id_user= ?
          order by cheque";
        $query = $this->db->query($sql,array($fec,$conta));
        $l0 = anchor('cheques/imprimir_poliza_mod/'.$fec.'/'.$conta, ' IMPRIME POLIZA <img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
        $tabla= "
        <table>
        <thead>
        <tr>
        <td colspan=\"9\">".$l0."</td>
        </tr>
        
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>CHEQUE</th>
        <th>BENEFICIARIO</th>
        <th>IMPORTE</th>
        <th>CONCEPTO</th>
        <th>IMPRIMIR</th>
        <th>EDITAR</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $tipo= $row->tipo;    
            $l1 = anchor('cheques/imprimir_cheque_mod/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            $l2 = anchor('cheques/tabla_control_poliza_filtro_leo_editar/'.$row->id.'/'.$fec.'/'.$conta, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            if($tipo==1){
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->fec."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"right\">".$row->cheque."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
            $che=$che+1;
          $imp_che=$imp_che+$row->imp_cheque;
            }
            if($tipo==4){
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$num."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->fec."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->sucx."(".$row->suc.")</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->cheque."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#FC0606\">".$row->nombre."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".number_format($row->imp_cheque,2)."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$row->descri."</font></td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\"><font size=\"1\" color=\"#FC0606\">CANCELAD0</font></td>
            </tr>
            ";
          $checan=$checan+1;
          $imp_che_can=$imp_che_can+$row->imp_cheque;
          } 
        
        $num=$num+1;
        
        }
        
        $tabla.="
        <tr>
        <td align=\"left\" colspan=\"3\"><font size=\"1\" color=\"#FC0606\">CHEQUES ...:</font></td>
        <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$che."</font></td>
        <td align=\"right\" colspan=\"2\"><font size=\"1\" color=\"#FC0606\">".number_format($imp_che,2)."</font></td>
        </tr>
        <tr>
        <td align=\"left\" colspan=\"3\"><font size=\"1\" color=\"#FC0606\">CHEQUES CANCELADOS...:</font></td>
        <td align=\"right\"><font size=\"1\" color=\"#FC0606\">".$checan."</font></td>
        <td align=\"right\" colspan=\"2\"><font size=\"1\" color=\"#FC0606\">".number_format($imp_che_can,2)."</font></td>
        </tr>
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_cheque_oficina($id)
    {
     echo $id;
     $sql = "SELECT a.*,b.nombre as sucx,c.nombre as receptorx, d.descri as clavex
FROM  cheque_c_oficina a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.conta_receptores c on c.rfc=a.receptor
left join catalogo.conta_cvepol d on d.id=a.clave where a.id = $id";

$query = $this->db->query($sql);
return $query; 
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function busca_cheque_pol_todo($fec,$conta)
    {
     $id_user= $this->session->userdata('id');  
     $sql = "SELECT a.*,date_format(a.fecha, '%Y-%m-%d')as fec,
    b.descri,b.cuenta,b.cuenta_iva,b.iva,b.auxiliar,
     c.nombre,
     d.cia,d.plaza,d.nombre as sucx,d.iva as ivax,
     e.mes as mesx,
     f.plaza as plazax,
     g.cuenta,
     h.username,h.nombre as nomx
          FROM desarrollo.cheque_c_oficina a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc
          left join catalogo.sucursal d on d.suc=a.suc
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          left join catalogo.conta_plazas f on f.cia=d.cia and f.nplaza=d.plaza
          left join catalogo.conta_ctasfor g on g.cia=d.cia and g.plaza=d.plaza
          left join usuarios h on h.id=a.id_user
          where date_format(a.fecha, '%Y-%m')= ? and id_user= ? 
          group by date_format(a.fecha, '%Y-%m'), a.cia 
          order by cheque";
     $query = $this->db->query($sql,array($fec,$conta));
     return $query; 
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_c_oficina($id,$suc,$clave,$rec,$cheque,$cuenta,$plaza,$cia,$succ,
    $subtotal,$ieps,$iva,$iva_retenido,$iva_cedular,$iva_transp,$isr_retenido,$imp_cheque,$varios_sin_iva)
    {

 $data = array(
			'suc' => $suc,
            'clave' => $clave,
            'Cheque' =>$cheque,
            'receptor' => str_replace(' ', '',strtoupper(trim($rec))),
			
            'subtotal' => $subtotal,
            'ieps' => $ieps,
            'iva' => $iva,
            'iva_retenido'=>$iva_retenido,
            'isr_retenido'=>$isr_retenido,
            'imp_cheque'=>$imp_cheque,
            'varios_sin_iva'=>$varios_sin_iva,
            'iva_cedular'=>$iva_cedular,
            'iva_transp'=>$iva_transp,

            'cia'=>$cia,
            'plaza'=>$plaza,
            'succ'=>$succ,
            'cuenta'=>$cuenta
		);
		
		$this->db->where('id', $id);
        $this->db->update('cheque_c_oficina', $data);
        return $this->db->affected_rows();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function imprime_1_mod($id_cc)
	{
	   
    $sql = "SELECT a.*, extract(year from a.fecha)as aaag, extract(day from a.fecha)as diag, 
     b.descri,b.cuenta as cuentar,b.auxiliar,b.cuenta_iva,b.auxi_iva,b.cuenta_ivar, b.auxi_ivar,
     b.cuenta_isr,b.auxi_isr,b.cuenta_cedular,b.auxi_cedular,b.cuenta_transp,b.auxi_transp, b.iva as tiva,
     c.nombre,
     d.cia,d.plaza,d.nombre as sucx,d.iva as ivax,d.suc_contable,
     e.mes as mesx,
     f.ctapol ,f.banco,g.nombre as bancox
          FROM desarrollo.cheque_c_oficina a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          left join catalogo.conta_ctasfor f on f.cia=d.cia and f.plaza=d.plaza
          left join catalogo.conta_bancos g on g.id=f.banco
          where a.id = ? ";
    $query = $this->db->query($sql,array($id_cc)); 
    $var=0;
    $tiva='';
    $tipo=0;
    foreach($query->result() as $row)
        {
            $var=$row->clave;
            $tiva=$row->tiva;
            $tipo=$row->tipo;
            $iva_cedular=$row->iva_cedular;
            $iva_transp=$row->iva_transp;
            $iva_retenido=$row->iva_retenido;
	$cabeza = "
            <table>
            <tr>
            <td colspan=\"4\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
            </tr>
            
            <tr>
            <td colspan=\"4\" align=\"left\">Cuenta.: ".$row->cuenta."  Cheque.:".$row->cheque."<br /></td>
            </tr>
            
            <tr>
            <td colspan=\"4\">".$row->diag." DE ".$row->mesx." DEL ".$row->aaag."<br /></td>   
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"3\">".$row->nombre."<br /><br /></td>   
            </tr>

            <tr>
            <td>Cta-Cia-Plz-Suc-Aux</td>
            <td>Descripcion</td>
            <td align=\"right\">Cargo</td>
            <td align=\"right\">Abono</td>
            </tr>
            <tr>
            <td colspan=\"4\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
            </tr>
            
            <tr>
            <td colspan=\"2\">".$row->cuentar."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxiliar,5,0,STR_PAD_LEFT)." <font size=\"-1\">".trim($row->descri)."</font></td>
            <td align=\"right\">".number_format($row->subtotal,2)."</td>
            <td></td>
            </tr>
            ";
            if($tiva=='S'){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_iva."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_iva,5,0,STR_PAD_LEFT)." GRABADOS ".number_format($row->ivax*100,0)."% </td>
            <td align=\"right\">".number_format($row->iva,2)."</td>
            <td></td>
            </tr>
            ";
            }
            if($iva_retenido>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_ivar."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_ivar,5,0,STR_PAD_LEFT)." IVA RETENIDO</td>
            <td></td>
            <td align=\"right\">".number_format($row->iva_retenido,2)."</td>
            </tr>
            
            <tr>
            <td colspan=\"2\">".$row->cuenta_isr."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_isr,5,0,STR_PAD_LEFT)." ISR RETENIDO</td>
            <td></td>
            <td align=\"right\">".number_format($row->isr_retenido,2)."</td>
            </tr>
            ";
            }
            if($iva_cedular>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_cedular."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_cedular,5,0,STR_PAD_LEFT)." IVA CEDULAR</td>
            <td></td>
            <td align=\"right\">".number_format($row->iva_cedular,2)."</td>
            </tr>
             ";    
            }
            if($iva_transp>0){
    $cabeza.="
            <tr>
            <td colspan=\"2\">".$row->cuenta_transp."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->auxi_transp,5,0,STR_PAD_LEFT)." IVA TRANSPORTACION</td>
            <td></td>
            <td align=\"right\">".number_format($row->iva_transp,2)."</td>
            </tr>
             ";    
            }

    $cabeza.="         
            <tr>
            <td colspan=\"2\">".$row->ctapol."-".str_pad($row->cia,2,0,STR_PAD_LEFT)."-".str_pad($row->plaza,2,0,STR_PAD_LEFT)."-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->banco,5,0,STR_PAD_LEFT)." ".$row->bancox."</td>
            <td></td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            <tr>
            <td colspan=\"4\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
            </tr>
            <tr>
            <td></td>
            <td></td>
            <td align=\"right\">".number_format(($row->iva + $row->subtotal),2)."</td>
            <td align=\"right\">".number_format(($row->iva_retenido + $row->isr_retenido + $row->iva_cedular+ $row->iva_transp + $row->imp_cheque),2)."</td>
            
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"3\">CONCEPTO.: ".$row->descri."</td>
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"3\">SUCURSAL.: ".trim($row->sucx)."(".$row->suc.")</td>   
            </tr>
            
            ";
    $cabeza.=$this->imprime_detalle_d_1($id_cc);
            if($tipo==4){
    $cabeza.="
            <tr>
            <td colspan=\"4\" align=\"center\"><font size=\"+6\">C A N C E L A D O</font></td>
            </tr>
            ";
            }
    $cabeza.="
            </table>";
    
    
    } 
            
            return $cabeza;
            
    }
///////////////////////////////////////////////
///////////////////////////////////////////////
function imprime_2_mod($id_cc)
	{
	   
    $sql = "SELECT a.*, extract(year from a.fecha)as aaag, extract(day from a.fecha)as diag, 
     b.descri,b.cuenta,b.auxiliar,b.cuenta_iva,b.auxi_iva,b.cuenta_ivar, b.auxi_ivar,b.cuenta_isr,b.auxi_isr, b.iva as tiva,
     c.nombre,
     e.mes as mesx
          FROM desarrollo.cheque_c_oficina a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          where a.id = ? ";
    $query = $this->db->query($sql,array($id_cc)); 
    $var=0;
    $tiva=0;
    $tipo=0;
    foreach($query->result() as $row)
        {
            include_once("CNumeroaLetra.php");
			$numalet= new CNumeroaletra;
			$numalet->setNumero($row->imp_cheque);
			$numalet->setMoneda('PESOS');
			$numalet->setPrefijo("");
			$numalet->setSufijo("M.N.");
            $letra= $numalet->letra();
            $tipo=$row->tipo;
            $var=$row->clave;
	$detalle = "<table>
            <tr>
            <td></td>
            <td></td>
            <td colspan=\"2\">".$row->diag." DE ".$row->mesx." DEL ".$row->aaag."<br /></td>
            <td></td>
            </tr>
            
            <tr>
            <td></td>
            <td colspan=\"2\">".$row->nombre."<br /><br /></td>
            <td></td>
            <td align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            
            <tr>
            <td colspan=\"4\" align=\"left\">".$letra."</td>
            </tr>
            ";
            if($tipo==4){
    $detalle.="
            <tr>
            <td colspan=\"4\" align=\"center\"><font size=\"+4\">C A N C E L A D O</font></td>
            </tr>
            ";
            }
    $detalle.="
            </table>";
    
    } 
            
            return $detalle;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_poliza_detalle_mod($fec,$conta)
    {
         
         $gencan=0;
         $genval=0;
         $gencanche=0;
         $genche=0;
         
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         
         $subtotal_che=0;
         $varios_che=0;
         $iva_che=0;
         $isr_che=0;
         $ivar_che=0;
         $imp_che=0;
         
         $subtotal_che_can=0;
         $varios_che_can=0;
         $iva_che_can=0;
         $isr_che_can=0;
         $ivar_che_can=0;
         $imp_che_can=0;
         
         $id_user= $this->session->userdata('id');
         $sql0="select a.plaza,c.plaza as plazax, a.cuenta,a.cia, b.razon as ciax 
         from desarrollo.cheque_c_oficina a
         left join catalogo.compa b on  b.cia=a.cia
         left join catalogo.conta_plazas c on  c.cia=a.cia and c.nplaza=a.plaza 
         where date_format(a.fecha, '%Y-%m')='$fec' and a.id_user=$conta group by a.cia order by a.cia";
         
         $query0 = $this->db->query($sql0);
        $detalle=" ";
         foreach($query0->result() as $row0)
         {
         $cia=$row0->cia;
         $detalle.="
        <table>
        <tr>
        <td colspan=\"4\">.<br /><strong>".$row0->cia."_".$row0->ciax."</strong></td>
        <td colspan=\"2\" align=\"left\">.<br /><strong>PLAZA..: </strong>".$row0->plaza." ".$row0->plazax." </td>
        <td colspan=\"2\" align=\"left\">.<br /><strong>CUENTA..:</strong>".$row0->cuenta." </td>
        </tr>
        </table>";
         $sql = "SELECT a.*,date_format(a.fecha, '%Y-%m-%d')as fec,
         b.descri,
         c.nombre,
         d.nombre as sucx,d.suc_contable
          FROM desarrollo.cheque_c a
          left join catalogo.conta_cvepol b on b.id=a.clave
          left join catalogo.conta_receptores c on c.rfc=a.receptor  and c.suc=a.suc  and c.suc=a.suc and c.clave=a.clave
          left join catalogo.sucursal d on d.suc=a.suc
          where date_format(a.fecha, '%Y-%m')= ? and id_user= ? and a.cia=?
          order by cheque";
        $query = $this->db->query($sql,array($fec,$conta,$cia));
        
        $detalle.= "
        <table>
        <tr>
        <td colspan=\"9\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
        </tr>
           
           <tr>
           <td width=\"250\" align=\"right\"></td>
           <td width=\"100\" align=\"center\">FECHA-SUCURSAL</td>
           <td width=\"75\" align=\"center\">CHEQUE</td>
           <td width=\"75\" align=\"right\">SUBTOTAL</td>
           <td width=\"75\" align=\"right\">VARIOS</td>
           <td width=\"75\" align=\"right\">IVA</td>
           <td width=\"75\" align=\"right\">ISR</td>
           <td width=\"75\" align=\"right\">IVA RET.</td>
           <td width=\"75\" align=\"right\">IMPORTE</td>
           
           
           </tr>
           
         <tr>
         <td colspan=\"9\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
         </tr>
        
        ";
        
        foreach($query->result() as $row)
        {
        $tipo= $row->tipo;    
        if($tipo==1){
        $detalle.="
           
            <tr>
            <td width=\"250\" align=\"left\">".$row->descri."</td>
            <td width=\"100\" align=\"left\"><strong>".$row->fec."</strong>-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->suc,5,0,STR_PAD_LEFT)."</td>
            </tr>
            <tr>
            <td width=\"250\" align=\"left\">".$row->nombre."</td>
            <td width=\"100\" align=\"left\">".trim($row->sucx)."</td>
            <td width=\"75\" align=\"center\">".$row->cheque."</td>
            <td width=\"75\" align=\"right\">".number_format($row->subtotal,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->isr_retenido,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva_retenido,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            <tr>
            <td>______</td>
            </tr>
            ";
            $che=$che+1;
            $genval=$genval+1;
            $genche=$genche+$row->imp_cheque;
            
            $subtotal_che=$subtotal_che+$row->subtotal;
            $varios_che=$varios_che+$row->varios_sin_iva;
            $iva_che=$iva_che+$row->iva;
            $isr_che=$isr_che+$row->isr_retenido;
            $ivar_che=$ivar_che+$row->iva_retenido;
            $imp_che=$imp_che+$row->imp_cheque;
            $id_cc=$row->id;
            }
            if($tipo==4){
        $detalle.="
            <tr>
            <td width=\"250\" align=\"left\">".$row->descri."</td>
            <td width=\"100\" align=\"left\"><strong>".$row->fec."</strong>-".str_pad($row->suc_contable,2,0,STR_PAD_LEFT)."-".str_pad($row->suc,5,0,STR_PAD_LEFT)."</td>
            </tr>
            <tr>
            <td width=\"250\" align=\"left\">".$row->nombre."</td>
            <td width=\"100\" align=\"left\">".trim($row->sucx)."<strong>CANCELADO</strong></td>
            <td width=\"75\" align=\"center\">".$row->cheque."</td>
            <td width=\"75\" align=\"right\">".number_format($row->subtotal,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->varios_sin_iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->isr_retenido,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva_retenido,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->imp_cheque,2)."</td>
            </tr>
            <tr>
            <td></td>
            </tr>
            ";
          $checan=$checan+1;
          $gencan=$gencan+1;
          $gencanche=$gencanche+$row->imp_cheque;
            $subtotal_che_can=$subtotal_che_can+$row->subtotal;
            $varios_che_can=$varios_che_can+$row->varios_sin_iva;
            $iva_che_can=$iva_che_can+$row->iva;
            $isr_che_can=$isr_che_can+$row->isr_retenido;
            $ivar_che_can=$ivar_che_can+$row->iva_retenido;
            $imp_che_can=$imp_che_can+$row->imp_cheque;
          } 
        
        $num=$num+1;
        
        }
        
        
        $detalle.="
        <tr>
        <td colspan=\"9\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
        </tr>
        
        <tr>
        <td align=\"left\" colspan=\"3\">CHEQUES ...:".$che."</td>
        <td align=\"right\">".number_format($subtotal_che,2)."</td>
        <td align=\"right\">".number_format($varios_che,2)."</td>
        <td align=\"right\">".number_format($iva_che,2)."</td>
        <td align=\"right\">".number_format($isr_che,2)."</td>
        <td align=\"right\">".number_format($ivar_che,2)."</td>
        <td align=\"right\">".number_format($imp_che,2)."<br /></td>
        </tr>
        
        <tr>
        <td align=\"left\" colspan=\"3\">CHEQUES CANCELADOS...:".$checan."</td>
        <td align=\"right\">".number_format($subtotal_che_can,2)."</td>
        <td align=\"right\">".number_format($varios_che_can,2)."</td>
        <td align=\"right\">".number_format($iva_che_can,2)."</td>
        <td align=\"right\">".number_format($isr_che_can,2)."</td>
        <td align=\"right\">".number_format($ivar_che_can,2)."</td>
        <td align=\"right\">".number_format($imp_che_can,2)."<br /></td>
        </tr>";
       $che=0;
       $imp_che=0;
       $checan=0;
       $imp_che_can=0;
        }
        $detalle.="
        <tr>
        <td width=\"350\"  align=\"left\"><strong>TOTAL DE CHEQUES ...:</strong></td>
        <td align=\"right\"><strong>".$genval."</strong></td>
        <td align=\"right\"><strong>".number_format($genche,2)."</strong></td>
        <td colspan=\"3\"></td>
        </tr>
        
        <tr>
        <td align=\"left\" colspan=\"1\"><strong>TOTOAL DE CHEQUES CANCELADOS...:</strong></td>
        <td align=\"right\"><strong>".$gencan."</strong></td>
        <td align=\"right\" colspan=\"1\"><strong>".number_format($gencanche,2)."</strong><></td>
        <td colspan=\"3\"></td>
        </tr>
        </table>"; 
      
        return $detalle;
  
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
