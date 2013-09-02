<?php
class juridico_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }

////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_busca($suc,$arr)
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,b.nombre
      FROM catalogo.cat_beneficiario a
      left join catalogo.sucursal b on b.suc=a.suc
      where a.suc=$suc and activo=1 or a.id=$arr and activo=1";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Arrendatario</th>
        <th>Persona</th>
        <th>Renta</th>
        <th>Renta neta</th>
        <th>Forma de pago</th>
        <th>Editar</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
        $auxix='';$neta=0;$iva=0;$ivar=0;$isr=0;$icedular=0;
        if($row->auxi==7003){
               $auxix='FISICA'; 
               if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
               if($row->isr>0) {$isr= $row->imp*($row->isr/100);}else{$isr=0;}
               if($row->iva_isr>0){$ivar=$row->imp*($row->iva_isr/100);}else{$ivar=0;}
               if($row->imp_cedular>0){$icedular= $row->imp*($row->imp_cedular/100);}else{$icedular=0;}
               $neta=$row->imp+$iva-$isr-$ivar-$icedular+$row->redondeo;
               }
            if($row->auxi==7004){$auxix='MORAL';
            if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
            $isr=0;
            $ivar=0;
            $icedular=0;
            $neta=$row->imp+$iva-$isr-$ivar-$icedular;
            }
            if($nivel==31){
            $l1 = anchor('juridico/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            }else{
            $l1='';
            }
            $l2 = anchor('juridico/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            <td align=\"center\">".$row->tipo." - ".$row->suc."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\">".$row->auxi." - ".$auxix."</td>
            <td align=\"right\">".number_format($row->imp,2)."</td>
            <td align=\"right\">".number_format($neta,2)."</td>
            <td align=\"right\">".$row->pago."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
 function agrega_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,$contrato,$incremento)
    {
        
        $id_user= $this->session->userdata('id');    
        $sql = "SELECT * FROM catalogo.cat_beneficiario where suc = $suc and auxi= $auxi and rfc='$rfc'";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0){
     
   			//suc, auxi, rfc, nom, imp, iva, isr, iva_isr, imp_cedular, tipo, id_con, id_user, id, activo
            $new_member_insert_data = array(
            'suc'=>$suc,
            'auxi'=>$auxi,
            'rfc'=>strtoupper(trim($rfc)),
            'nom'=>strtoupper(trim($nom)),
            'imp'=>$imp,
            'iva'=>$iva,
            'isr'=>$isr,
            'iva_isr'=>$ivar,
            'imp_cedular'=>$icedular,
            'tipo'=>$tsuc,
            'id_con'=>0,
            'id_user'=>$id_user,
            'pago'  =>$pago,
            'activo'=>1,
            'redondeo'=>$redon,
            'contrato'=> $contrato,
            'incremento'=> $incremento,
            'fecha'=> date('Y-m-d H:i:s')
            
            
            
		);
		
		
		$insert = $this->db->insert('catalogo.cat_beneficiario', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function cambia_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$suc_a,$id,$redon,$contrato,$incremento
        ,$fecha_termino,$tipo_pago,$diferencia,$cierre,$entrega_local,$expediente,$motivo_cierre,$observacion)
    {
        
        $id_user= $this->session->userdata('id');    
        $sql = "SELECT * FROM catalogo.cat_beneficiario where id=$id";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
       
   			//suc, auxi, rfc, nom, imp, iva, isr, iva_isr, imp_cedular, tipo, id_con, id_user, id, activo
            $data = array(
            'suc'=>$suc,
            'auxi'=>$auxi,
            'rfc'=>strtoupper(trim($rfc)),
            'nom'=>strtoupper(trim($nom)),
            'imp'=>$imp,
            'iva'=>$iva,
            'isr'=>$isr,
            'iva_isr'=>$ivar,
            'imp_cedular'=>$icedular,
            'tipo'=>$tsuc,
            'id_con'=>0,
            'id_user'=>$id_user,
            'pago'  =>$pago,
            'activo'=>1,
            'redondeo'=>$redon,
            'contrato'=> $contrato,
            'incremento'=> $incremento,
            'fecha_termino'=> $fecha_termino,
            'tipo_pago'=>$tipo_pago,
            'diferencia'=>$diferencia,
            'cierre'=>$cierre,
            'entrega_local'=>$entrega_local,
            'expediente'=>$expediente,
            'motivo_cierre'=>$motivo_cierre,
            'observacion'=>$observacion,
            'fecha'=> date('Y-m-d H:i:s')
		);
		
		$this->db->where('id', $id);
		$this->db->update('catalogo.cat_beneficiario', $data);
        }
    }

/////////////////////////////////////////////////////
function delete_member_renta($id)
    {
        
      $id_user= $this->session->userdata('id');    
      $dat = 
      array(
      'activo' =>4,
      'observacion'=>$id_user.$this->session->userdata('nombre')
      );
      $this->db->where('id', $id);
      $this->db->update('catalogo.cat_beneficiario', $dat);  
    }
/////////////////////////////////////////////////////
    function rentas_his()
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,b.nombre as sucx,b.dire,b.pobla,b.tipo2 FROM catalogo.cat_beneficiario a 
     left join catalogo.sucursal b on b.suc=a.suc 
     where activo=1";
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th></th>
        <th>Sucursal</th>
        <th>Arrendatario</th>
        <th>Persona</th>
        <th>Renta</th>
        <th>Renta neta</th>
         <th>Forma de pago</th>
         <th>Editar</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
   $l0='';     
        
        $query = $this->db->query($sql);
        foreach($query->result() as $row)
        {
         $l0 = anchor('juridico/tabla_rentas_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
        $auxix='';$neta=0;$iva=0;$ivar=0;$isr=0;$icedular=0;
        if($row->auxi==7003){
               $auxix='FISICA'; 
               if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
               if($row->isr>0) {$isr= $row->imp*($row->isr/100);}else{$isr=0;}
               if($row->iva_isr>0){$ivar=$row->imp*($row->iva_isr/100);}else{$ivar=0;}
               if($row->imp_cedular>0){$icedular= $row->imp*($row->imp_cedular/100);}else{$icedular=0;}
               $neta=$row->imp+$iva-$isr-$ivar-$icedular+$row->redondeo;
               }
            if($row->auxi==7004){$auxix='MORAL';
            if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
            $isr=0;
            $ivar=0;
            $icedular=0;
            $neta=$row->imp+$iva-$isr-$ivar-$icedular;
            }
            
            if($nivel==31){
            $l1 = anchor('juridico/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            
            }else{
            $l1='';
            }
            $l2 = anchor('juridico/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            <td>$l0</td>
            <td align=\"left\"><font color=\"blue\">".$row->tipo2." - ".$row->suc."<br /> ".$row->sucx." <BR />".$row->dire."<font></td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\">".$row->auxi." - ".$auxix."</td>
            <td align=\"right\">".number_format($row->imp,2)."</td>
            <td align=\"right\">".number_format($neta,2)."</td>
            <td align=\"right\">".$row->pago."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            
            </tr>
            ";
        
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function rentas_vista($id)
    {
     $sql = "SELECT a.*,b.nombre,b.dire,b.col,b.pobla   
      FROM catalogo.cat_beneficiario a
      left join catalogo.sucursal b on b.suc=a.suc
      where a.id=$id";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table border=\"1\">
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
        $auxix='';$neta=0;$iva=0;$ivar=0;$isr=0;$icedular=0;
        if($row->auxi==7003){
               $auxix='FISICA'; 
               if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
               if($row->isr>0) {$isr= $row->imp*($row->isr/100);}else{$isr=0;}
               if($row->iva_isr>0){$ivar=$row->imp*($row->iva_isr/100);}else{$ivar=0;}
               if($row->imp_cedular>0){$icedular= $row->imp*($row->imp_cedular/100);}else{$icedular=0;}
               $neta=$row->imp+$iva-$isr-$ivar-$icedular+$row->redondeo;
               }
            if($row->auxi==7004){$auxix='MORAL';
            if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
            $isr=0;
            $ivar=0;
            $icedular=0;
            $neta=$row->imp+$iva-$isr-$ivar-$icedular;
            }
            $tabla.="
            
            <tr>
            <th align=\"center\"><strong>Sucursal.: </strong>".$row->tipo." - ".$row->suc." - ".$row->nombre."</th>
            <th align=\"center\"><strong>Direccion.: </strong>".$row->dire."</th>
            <th align=\"left\"><strong>Col.: </strong>".trim($row->col)."<br /><strong> Pob.:</strong>".trim($row->pobla)."</th>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"><strong>RFC.:</strong>".$row->rfc."</td>
            <td align=\"left\"><strong>Nombre.:</strong>".$row->nom."</td>
            <td align=\"left\"><strong>PERSONA </strong>".$auxix."</td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"><strong>FECHA DE CONTRATO <br /></strong>".$row->contrato."</td>
            <td align=\"left\"><strong>% DE INCREMENTO...: %</strong>".$row->incremento."</td>
            <td align=\"left\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">IMPORTE  $</td>
            <td align=\"right\">".number_format($row->imp,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">MAS I.V.A  $</td>
            <td align=\"right\">".number_format($iva,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">SUB-TOTAL  $</td>
            <td align=\"right\">".number_format($iva+$row->imp,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">MENOS I.S.R  $</td>
            <td align=\"right\">".number_format($isr,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">MENOS I.V.A  $</td>
            <td align=\"right\">".number_format($ivar,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">IMP. CED  $</td>
            <td align=\"right\">".number_format($icedular,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <th align=\"left\"></th>
            <th align=\"right\"><strong>TOTAL $</strong></th>
            <th align=\"right\">".number_format($neta,2)."</th>
                </tr>
            ";
            $tabla.="
            <tr>
            <th align=\"center\"></th>
            <th align=\"right\"><strong>FORMA DE PAGO</strong></th>
            <th align=\"right\">".$row->pago."</th>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }



/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function catalogo_rentas()
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $s = "SELECT * FROM  catalogo.sucursal where user_id=$id_user";
      
        $q = $this->db->query($s);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Arrendatario</th>
        <th>Persona</th>
        <th>Renta</th>
        <th>Renta neta</th>
         <th>Forma de pago</th>
         <th>Editar</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($q->result() as $r)
        {
        
               
       $sql = "SELECT a.*FROM catalogo.cat_beneficiario a
               where suc=$r->suc";
        $query = $this->db->query($sql);
        if($query->num_rows()> 0){
        foreach($query->result() as $row)
        {
 
        $auxix='';$neta=0;$iva=0;$ivar=0;$isr=0;$icedular=0;
        if($row->auxi==7003){
               $auxix='FISICA'; 
               if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
               if($row->isr>0) {$isr= $row->imp*($row->isr/100);}else{$isr=0;}
               if($row->iva_isr>0){$ivar=$row->imp*($row->iva_isr/100);}else{$ivar=0;}
               if($row->imp_cedular>0){$icedular= $row->imp*($row->imp_cedular/100);}else{$icedular=0;}
               $neta=$row->imp+$iva-$isr-$ivar-$icedular+$row->redondeo;
               }
            if($row->auxi==7004){$auxix='MORAL';
            if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
            $isr=0;
            $ivar=0;
            $icedular=0;
            $neta=$row->imp+$iva-$isr-$ivar-$icedular;
            }
            
            if($nivel==31){
            $l1 = anchor('juridico/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            }else{
            $l1='';
            }
            $l2 = anchor('juridico/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado','target'=>'blank'));
            
            $tabla.="
            <tr>
            <td align=\"center\">".$r->tipo2." - ".$r->suc."</td>
            <td align=\"left\">".$r->nombre." <BR />".$r->dire."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\">".$row->auxi." - ".$auxix."</td>
            <td align=\"right\">".number_format($row->imp,2)."</td>
            <td align=\"right\">".number_format($neta,2)."</td>
            <td align=\"right\">".$row->pago."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
        }}else{
          $tabla.="
            <tr>
            <td align=\"center\">".$r->tipo2." - ".$r->suc."</td>
            <td align=\"left\">".$r->nombre." <BR />".$r->dire."</td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
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


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function beneficiario($cia,$pla)
    {
     $sql = "SELECT a.*,b.nombre as sucx,c.descri
FROM catalogo.conta_receptores a 
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.conta_cvepol c on c.id=a.clave
where a.cia= ? and a.pla= ? and a.activo=1
order by a.suc, a.clave";
        $query = $this->db->query($sql,array($cia,$pla));
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>RFC</th>
        <th>BENEFICIARIO</th>
        <th>CLAVE</th>
        <th>DESCRIPCION</th>
        <th>NID</th>
        <th>SUCURSAl</th>
        <th>BORRAR</th>
        </tr>
        </thead>
        <tbody>
        ";
        //id, rfc, nombre, id_contador, clave, suc, cia, pla, fecha, activo
        foreach($query->result() as $row)
        {
                $l1 = anchor('juridico/borrar_bene/'.$row->id.'/'.$pla.'/'.$cia, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borra Beneficiario!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$row->rfc."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->clave."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
      }
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function agrega_member_bene($cia,$pla,$suc,$rfc,$nom,$cla)
    {    
$sql = "SELECT * FROM catalogo.conta_receptores where suc= ? and rfc= ? and clave= ? and activo=1";
        $query = $this->db->query($sql,array($suc,$rfc,$cla));
        if($query->num_rows() == 0){
$sqlx = "SELECT * FROM catalogo.sucursal where suc= ? ";
        $queryx = $this->db->query($sqlx,array($suc));
        if($queryx->num_rows() == 1){
           $rowx= $queryx->row();
     //id, rfc, nombre, id_contador, clave, suc, cia, pla
     $new_member_insert_data = array(
			
            'rfc'   =>strtoupper(trim($rfc)),
            'nombre'=>strtoupper(trim($nom)),
            'id_contador' =>$rowx->user_id,
            'clave'      =>$cla,
            'suc'=>$suc,
            'cia'=>$cia,
            'pla'=>$pla,
            'activo'=>1
		);
		
		
		$insert = $this->db->insert('catalogo.conta_receptores', $new_member_insert_data);
        redirect('juridico/bene_d_mas/'.$pla.'/'.$cia);
        }
        }
redirect('juridico/bene_d_mas/'.$pla.'/'.$cia);
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function delete_member_bene($id)
    {
      
     $data = array('activo'=>4);
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.conta_receptores', $data);
     return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function agrega_member_renta_mes($aaa,$mes,$cam)
    { 
$id_user= $this->session->userdata('id');
$sql = "SELECT a.*,b.cia FROM catalogo.cat_beneficiario a
left join catalogo.sucursal b on b.suc=a.suc
where activo=1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
$s = "SELECT * FROM rentas where aaa=$aaa and mes=$mes";
$q = $this->db->query($s);
        if($q->num_rows() == 0){
         foreach($query->result() as $row){
            $data = array(
            'aaa'=>$aaa,
            'mes'=>$mes,
            'suc'=>$row->suc,
            'auxi'=>$row->auxi,
            'rfc'=>strtoupper(trim($row->rfc)),
            'nom'=>strtoupper(trim($row->nom)),
            'imp'=>$row->imp,
            'iva'=>$row->iva,
            'isr'=>$row->isr,
            'iva_isr'=>$row->iva_isr,
            'imp_cedular'=>$row->imp_cedular,
            'tipo'=>$row->tipo,
            'id_user'=>$id_user,
            'pago'  =>$row->pago,
            'activo'=>1,
            'redondeo'=>$row->redondeo,
            'incremento'=>$row->incremento,
            'tipo_pago'=>$row->tipo_pago,
            'diferencia'=>$row->diferencia,
            'observacion'=>$row->observacion,
            'fecha'=> date('Y-m-d H:i:s'),
            'contrato'=> $row->fecha_incre,
            'cia'=> $row->cia,
            'num'=>$row->num,
            'tipo_cambio'=> $cam    
            );
		$insert = $this->db->insert('rentas', $data);
        }}
        }
        }
/////////////////////////////////////////////////////
///////////////////////////////////////////////////// function agrega_member_renta_mes($aaa,$mes,$cam)
  function delete_member_renta_mes($aaa,$mes)
    { 
$id_user= $this->session->userdata('id');
$sql = "delete FROM desarrollo.rentas where aaa=$aaa and mes=$mes and paso=1";
        $query = $this->db->query($sql);

        }
/////////////////////////////////////////////////////
///////////////////////////////////////////////////// function agrega_member_renta_mes($aaa,$mes,$cam)
  function act_member_renta_mes($aaa,$mes)
    { 
$id_user= $this->session->userdata('id');
$data = array('paso'=>2);
 	 $this->db->where('aaa', $aaa);
     $this->db->where('mes', $mes);
     $this->db->update('desarrollo.rentas', $data);
     return $this->db->affected_rows();
        }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_generadas()
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,c.mes as mesx,
sum(
case
when a.auxi=7004  and pago='MN' then (imp*iva)+imp
when a.auxi=7003  and pago='MN' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)
as total,
sum(
case
when a.auxi=7004  and pago='USD' then (imp*iva)+imp
when a.auxi=7003  and pago='USD' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)
as totaldl
FROM rentas a
left join catalogo.mes c on c.num=a.mes
where activo=1 and paso=1
group by aaa,mes
order by aaa desc, mes desc";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>A&Ntilde;O Y MES</th>
        <th>IMPORTE EN MN</th>
        <th>IMPORTE EN DOLAR</th>
        <th>TIPO DE CAMBIO</th>
        <th>IMPORTE T.C</th>
        <th>TOTAL</th>
        <th>Ver</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
        
            $l1 = anchor('juridico/tabla_rentas_mensual_mes/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Imprime concentrado de rentas!', 'class' => 'encabezado', 'target' => 'blanck' ));
            $l2 = anchor('juridico/tabla_rentas_bor/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l3 = anchor('juridico/tabla_rentas_act/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$row->aaa." - ".$row->mesx."<br />".$l2."</td>
            <td align=\"right\"> MN $ ".number_format($row->total,2)."</td>
            <td align=\"right\"> USD ".number_format($row->totaldl,2)."</td>
            <td align=\"right\">$  ".number_format($row->tipo_cambio,2)."</td>
            <td align=\"right\">$  ".number_format($row->tipo_cambio*$row->totaldl,2)."</td>
            <td align=\"right\">$  ".number_format($row->total+$row->totaldl,2)."<br />".$l3."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_generadas_mes($aaa,$mes)
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,c.mes as mesx,b.nombre as sucx,a.imp,
     (imp*a.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,

case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
 as total

FROM rentas a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.mes c on c.num=a.mes
where activo=1 and a.aaa=$aaa and a.mes=$mes and  paso=2
order by a.num,a.suc
";
 
        $query = $this->db->query($sql);
        $tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th>ARRENDATARIO</th>
        <th>AUXI</th>
        <th>RENTA</th>
        <th>IVA</th>
        <th>RETENCION</th>
        <th>IVA_RET</th>
        <th>TOTAL</th>
        <th>OBSERVACIONES</th>
        <th>Ver</th>
        </tr>
        </thead>
        <tbody>
        ";
         $xnum=0;
        foreach($query->result() as $row)
        {
if($xnum==1){$colorcelda='white';}
if($xnum==0){$colorcelda='#EDF3F9';} 
        if($row->pago=='MN'){$color='black';}else{$color='blue';}
        
            $l1 = anchor('juridico/tabla_rentas_imp/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado'));
            $l2 = anchor('juridico/tabla_rentas_imp_isr/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver isr!', 'class' => 'encabezado'));
            
           
            $tabla.="
            <tr bgcolor=\"$colorcelda\">
            <td align=\"left\"><font color=\"$color\">$l2 ".trim($row->nom)."<br /> ".$row->suc." - ".trim($row->sucx)."</font><br /><font color=\"$color\">".$row->tipo_pago."</font> - <font color=\"green\">".$row->pago."</td>
            <td align=\"left\" colspan=\"1\"><font color=\"$color\">".number_format($row->auxi)."</font></td>
           
            <td align=\"right\"><font color=\"$color\">".number_format($row->imp,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->ivaf,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->isrf,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->iva_isrf,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->total,2)."</font></td>
            <td align=\"left\">".$row->observacion."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
           <tr></tr> 
             ";
       
if($xnum==1){$xnum=0;}else{$xnum=1;}
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        echo $tabla;
    }
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_una($id)
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,c.mes as mesx,b.nombre as sucx,a.imp,
     (imp*a.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,

case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
 as total

FROM rentas a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.mes c on c.num=a.mes
where a.id=$id
";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        if($row->pago=='MN'){$color='black';}else{$color='blue';}
        
            
            $tabla.="
            <tr>
            <td align=\"left\"><strong>RFC.:</strong>".$row->rfc."</td>
            <td align=\"left\"><strong>Nombre.:</strong>".$row->nom."</td>
            <td align=\"left\"><strong>PERSONA </strong>".$auxix."</td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"><strong>FECHA DE CONTRATO <br /></strong>".$row->contrato."</td>
            <td align=\"left\"><strong>% DE INCREMENTO...: %</strong>".$row->incremento."</td>
            <td align=\"left\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">IMPORTE  $</td>
            <td align=\"right\">".number_format($row->imp,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">MAS I.V.A  $</td>
            <td align=\"right\">".number_format($row->ivaf,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">SUB-TOTAL  $</td>
            <td align=\"right\">".number_format($row->ivaf+$row->imp,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">MENOS I.S.R  $</td>
            <td align=\"right\">".number_format($row->isrf,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">MENOS I.V.A  $</td>
            <td align=\"right\">".number_format($row->iva_isrf,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">IMP. CED  $</td>
            <td align=\"right\">".number_format($row->imp_ced,2)."</td>
             </tr>
            ";
            $tabla.="
            <tr>
            <th align=\"left\"></th>
            <th align=\"right\"><strong>TOTAL $</strong></th>
            <th align=\"right\">".number_format($row->total,2)."</th>
                </tr>
            ";
            $tabla.="
            <tr>
            <th align=\"center\"></th>
            <th align=\"right\"><strong>FORMA DE PAGO</strong></th>
            <th align=\"right\">".$row->pago."</th>
            </tr>
             ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_una_isr($id)
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT d.contra,d.rfc_contra,d.curp_contra,d.razon,d.rfc as rfc_cia,a.*,c.mes as mesx,b.nombre as sucx,a.imp,
     (imp*a.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,

case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
 as total

FROM rentas a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.compa d on d.cia=a.cia
left join catalogo.mes c on c.num=a.mes
where a.id=$id and a.auxi=7003
";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table cellpading=\"2\">
        <thead>
        
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $me=$row->mes;
        $mee=$row->mes-1;
        $espacio=' ';
        if($row->pago=='MN'){$color='black';}else{$color='blue';}
        
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$mee."</td>
            <td align=\"left\"></td>
            <td align=\"left\">".$me."</td>
            <td align=\"left\">".$row->aaa."</td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ><BR/ ></td>
            </tr>
            ";
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"5\">".$row->rfc."</td>
            <td align=\"left\" colspan=\"9\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"5\">".$row->curp."</td>
            <td align=\"left\" colspan=\"9\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->nom."</td>
            <td align=\"left\" colspan=\"4\"></td>
            </tr>
            ";
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"right\">B1</td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ></td>
            </tr>
            ";
             $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">ARRENDAMIENTO</td>
            <td align=\"left\" colspan=\"4\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"right\" colspan=\"4\">".number_format($row->imp,2)."</td>
            <td align=\"right\" colspan=\"5\">".number_format($row->imp,2)."</td>
            <td align=\"left\" colspan=\"5\"></td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ></td>
            </tr>
            ";
             $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"right\" colspan=\"4\">".number_format($row->isrf,2)."</td>
            <td align=\"right\" colspan=\"5\">".number_format($row->iva_isrf,2)."</td>
            <td align=\"left\" colspan=\"5\"></td>
             </tr>
            ";
           $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->rfc_cia."</td>
            <td align=\"left\" colspan=\"4\"></td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->razon."</td>
            <td align=\"left\" colspan=\"4\"></td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->contra."</td>
            <td align=\"left\" colspan=\"4\"></td>
             </tr>
            ";
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"8\">".$row->rfc_contra."</td>
            <td align=\"left\" colspan=\"6\"> ".$row->curp_contra."</td>
             </tr>";
           
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_generadas_historico()
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,c.mes as mesx,
sum(
case
when a.auxi=7004  and pago='MN' then imp*iva
when a.auxi=7003  and pago='MN' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)
as total,
sum(
case
when a.auxi=7004  and pago='USD' then imp*iva
when a.auxi=7003  and pago='USD' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)
as totaldl
FROM rentas a
left join catalogo.mes c on c.num=a.mes
where activo=1 and paso=2
group by aaa,mes
order by aaa desc, mes desc";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>A&Ntilde;O Y MES</th>
        <th>IMPORTE EN MN</th>
        <th>IMPORTE EN DOLAR</th>
        <th>TIPO DE CAMBIO</th>
        <th>IMPORTE T.C</th>
        <th>TOTAL</th>
        <th>Ver</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
        
            $l1 = anchor('juridico/tabla_rentas_mensual_mes/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Imprime concentrado de rentas!', 'class' => 'encabezado', 'target' => 'blanck' ));
            $l2 = anchor('juridico/tabla_rentas_imp_isr_todo/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            <td align=\"left\">".$row->aaa." - ".$row->mesx."<br /></td>
            <td align=\"right\"> MN $ ".number_format($row->total,2)."</td>
            <td align=\"right\"> USD ".number_format($row->totaldl,2)."</td>
            <td align=\"right\">$  ".number_format($row->tipo_cambio,2)."</td>
            <td align=\"right\">$  ".number_format($row->tipo_cambio*$row->totaldl,2)."</td>
            <td align=\"right\">$  ".number_format($row->total+$row->totaldl,2)."<br />".$l2."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function rentas_generadas_mes_ger()
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,c.mes as mesx,
sum(
case
when a.auxi=7004  and pago='MN' then (imp*iva)+imp
when a.auxi=7003  and pago='MN' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)
as total,
sum(
case
when a.auxi=7004  and pago='USD' then (imp*iva)+imp
when a.auxi=7003  and pago='USD' then imp+(imp*iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)
as totaldl
FROM rentas a
left join catalogo.mes c on c.num=a.mes
where activo=1 and paso=2
group by aaa,mes
order by aaa desc, mes desc";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>A&Ntilde;O Y MES</th>
        <th>IMPORTE EN MN</th>
        <th>IMPORTE EN DOLAR</th>
        <th>TIPO DE CAMBIO</th>
        <th>IMPORTE T.C</th>
        <th>TOTAL</th>
        <th>Ver</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
        
            $l1 = anchor('juridico/tabla_rentas_mensual_mes_ger/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Imprime concentrado de rentas!', 'class' => 'encabezado', 'target' => 'blanck' ));
             $tabla.="
            <tr>
            <td align=\"left\">".$row->aaa." - ".$row->mesx."</td>
            <td align=\"right\"> MN $ ".number_format($row->total,2)."</td>
            <td align=\"right\"> USD ".number_format($row->totaldl,2)."</td>
            <td align=\"right\">$  ".number_format($row->tipo_cambio,2)."</td>
            <td align=\"right\">$  ".number_format($row->tipo_cambio*$row->totaldl,2)."</td>
            <td align=\"right\">$  ".number_format($row->total+$row->totaldl,2)."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function rh_retencion_actual($tit)
{
$s="select a.id, a.causaj,a.fecha_i,a.suc,b.nombre as sucx,empleado,concat(a.nom,' ',a.pat,' ',a.mat)as completo,a.causa,c.clave as causax
from catalogo.cat_alta_empleado a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_claves_rh c on c.id=a.id_causa
where a.motivo='RETENCION' AND a.id_causa<>7 and a.activo=1
order by a.fecha_i ";

$q=$this->db->query($s);
$l0 = anchor('juridico/reportes_deptos_ret', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar !', 'class' => 'encabezado'));;
$tabla="<table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th width=\"70\"><strong>FECHA</strong></th>
        <th width=\"150\"><strong>SUCURSAL</strong></th>
        <th width=\"260\"><strong>EMPLEADO</strong></th>
        <th width=\"180\"><strong>CAUSA</strong></th>
        <th width=\"120\"><strong>ESTATUS</strong></th>
        <th width=\"100\"><strong>JURIDICO</strong></th>
        <th width=\"100\"><strong>CAPTURA</strong></th>
        </tr>
        <tr><td colspan=\"7\">$l0</td></tr>
        </thead>
        <tbody>
        ";
$num=0;
 foreach($q->result() as $r)
        {
 $l1 = anchor('juridico/digita_causa/'.$r->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar !', 'class' => 'encabezado'));;
   $num=$num+1;
$tabla.="
            <tr>
            
            <td align=\"left\" width=\"70\">".$r->fecha_i."</td>
            <td align=\"left\" width=\"150\">".$r->sucx."</td>
            <td align=\"left\" width=\"260\">".$r->empleado." ".$r->completo."</td>
            <td align=\"left\" width=\"180\">".$r->causa."</td>
            <td align=\"left\" width=\"120\">".$r->causax."</td>
            <td align=\"left\" width=\"100\">".$r->causaj."</td>
            <td align=\"left\" width=\"100\">".$l1."</td>
            
            </tr>
            ";
               

            
        }
$tabla.="
</tbody>
<tfoot>
<tr>
<td  colspan=\"7\">Total de retenciones $num</td>
</tr>
</tfoot>
</table>";

 

return $tabla;    
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function rh_retencion_actual_id($tit,$id)
{
$s="select a.id, a.causaj,a.fecha_i,a.suc,b.nombre as sucx,empleado,concat(a.nom,' ',a.pat,' ',a.mat)as completo,a.causa,c.clave as causax
from catalogo.cat_alta_empleado a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_claves_rh c on c.id=a.id_causa
where a.motivo='RETENCION' AND a.id_causa<>7 and a.activo=1 and a.id=$id
order by a.fecha_i ";

$q=$this->db->query($s);

$tabla="<table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th width=\"70\"><strong>FECHA</strong></th>
        <th width=\"150\"><strong>SUCURSAL</strong></th>
        <th width=\"260\"><strong>EMPLEADO</strong></th>
        <th width=\"180\"><strong>CAUSA</strong></th>
        <th width=\"120\"><strong>ESTATUS</strong></th>
        </tr>
        <tr><td colspan=\"7\"></td></tr>
        </thead>
        <tbody>
        ";
$num=0;
 foreach($q->result() as $r)
        {
   $num=$num+1;
$tabla.="
            <tr>
            
            <td align=\"left\" width=\"70\">".$r->fecha_i."</td>
            <td align=\"left\" width=\"150\">".$r->sucx."</td>
            <td align=\"left\" width=\"260\">".$r->empleado." ".$r->completo."</td>
            <td align=\"left\" width=\"180\">".$r->causa."</td>
            <td align=\"left\" width=\"180\">".$r->causax."</td>
            
            </tr>
            ";
               

            
        }
$tabla.="
</tbody>
<tfoot>
<tr>
<td  colspan=\"7\">Total de retenciones $num</td>
</tr>
</tfoot>
</table>";

 

return $tabla;    
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_retencion_causa($id)
{
$s="select  a.causaj
from catalogo.cat_alta_empleado a
where a.motivo='RETENCION' AND  a.id=$id";
$q=$this->db->query($s);
$r=$q->row();
return $r->causaj;
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////























}
