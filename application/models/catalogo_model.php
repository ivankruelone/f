<?php
class Catalogo_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    
    function usuarios()
    {
     $sql = "SELECT a.*,b.plaza as plazax,c.razon,d.nombre as sucx
FROM usuarios a
left join catalogo.conta_plazas b on b.cia=a.cia and b.nplaza=a.plaza
left join catalogo.compa c on c.cia=a.cia 
left join catalogo.sucursal d on d.suc=a.suc 
where a.nivel=3 order by plazax";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Puesto</th>
        <th>Sucursal</th>
        <th>Email</th>
        <th>Cambiar</th>
        <th>Password</th>
        <th>Sucursales</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            $l1 = anchor('catalogo/cambiar_usuario/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));
            $l2 = anchor('catalogo/cambiar_usuario_pas/'.$row->id, '<img src="'.base_url().'img/key.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar password!', 'class' => 'encabezado'));
            $l3 = anchor('catalogo/usuario_sucursal/'.$row->id, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar sucursales!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$row->username."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->puesto."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->email."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            <td align=\"center\">".$l3."</td>
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
    
    function usuarios_sucursal($id)
    {
     $sql = "SELECT *from catalogo.sucursal where user_id= ? order by nombre";
        $query = $this->db->query($sql,array($id));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Cia</th>
        <th>Plaza</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
         $l1 = anchor('catalogo/quitar_usuario_suc/'.$id.'/'.$row->suc, '<img src="'.base_url().'img/icon_error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));    $tabla.="
            <tr>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->cia."</td>
            <td align=\"left\">".$row->plaza."</td>
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
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function agrega_member_usuario($usuario,$nombre,$puesto,$email,$activo,$pas,$suc,$id)
    {
         $sql = "SELECT * FROM usuarios where username = ? ";
        $query = $this->db->query($sql,array($usuario));
        if($query->num_rows() == 0){
     $new_member_insert_data = array(
			'username' =>str_replace(' ', '',strtolower(trim($usuario))),
            'password' =>str_replace(' ', '',strtolower(trim($pas))),
            'nombre'   =>strtoupper(trim($nombre)),
            'puesto'   =>strtoupper(trim($puesto)),
            'email'    =>strtolower(trim($email)),
            'activo'   =>$activo,
            'suc'   =>$suc,
            'tipo'   =>0,
            'nivel'   =>3
		);
		
		
		$insert = $this->db->insert('usuarios', $new_member_insert_data);
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function update_member_usuario($usuario,$nombre,$puesto,$email,$activo,$id)
    {
     if($activo==1){$r='R';}else{$r=' ';}
     $data = array(
			'username' =>str_replace(' ', '',strtolower(trim($usuario))),
            'nombre'   =>strtoupper(trim($nombre)),
            'puesto'   =>strtoupper(trim($puesto)),
            'email'    =>strtolower(trim($email)),
            'responsable'=>$r,
            'activo' =>$activo
		);
		
		$this->db->where('id', $id);
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function update_member_usuario_pas($pas,$id)
    {
     $data = array(
			'password' =>$pas
		);
		$this->db->where('id', $id);
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function agrega_member_usuario_sucursal($suc,$id)
    {
     $data = array(
			'user_id' =>$id
 		);
		$this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function quitar_member_usuario_sucursal($suc)
    {
     $data = array(
			'user_id' => 0
 		);
		$this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////ernesto jimenez
    
    function usuarios_cortes()
    {
     $sql = "SELECT a.*,b.plaza as plazax,c.razon,d.nombre as sucx
FROM usuarios a
left join catalogo.conta_plazas b on b.cia=a.cia and b.nplaza=a.plaza
left join catalogo.compa c on c.cia=a.cia 
left join catalogo.sucursal d on d.suc=a.suc 
where a.nivel=5 order by plazax";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Puesto</th>
        <th>Sucursal</th>
        <th>Email</th>
        <th>Sucursales</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            $l3 = anchor('catalogo/usuario_sucursal_cortes/'.$row->id, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar sucursales!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$row->username."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->puesto."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->email."</td>
            <td align=\"center\">".$l3."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_member_usuario_sucursal_cortes($suc,$id)
    {
     $sql = "SELECT * FROM catalogo.sucursal where gere<500 ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){   
     $data1 = array(
			'id_cor' =>$id
 		);
		$this->db->where('suc', $suc);
        $this->db->update('desarrollo.cortes_c', $data1);
        $data = array(
			'gere' =>$id
 		);
        $this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
   }
       $sqlx = "SELECT * FROM catalogo.sucursal where gere>500 ";
        $queryx = $this->db->query($sqlx);
        if($queryx->num_rows() > 0){   
     $data1x = array(
            'id_cor' =>$id
 		);
		$this->db->where('suc', $suc);
        $this->db->update('desarrollo.cortes_c', $data1x);
        $datax = array(
		    'gere' =>$id
 		);
        $this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $datax);
        return $this->db->affected_rows();
   }
   
   
   
   
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function quitar_member_usuario_sucursal_cortes($suc)
    {
     $data = array(
			'user_id' => 0,
            'gere' =>0
 		);
		$this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
  function usuarios_sucursal_cortes($id)
    {
     $sql = "SELECT a.*,b.nombre as cortes,c.nombre as contador,c.puesto
     from catalogo.sucursal a 
     left join usuarios b on b.id=a.gere
     left join usuarios c on c.id=a.user_id 
     where a.gere= ? order by suc";
        $query = $this->db->query($sql,array($id));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Contador</th>
        <th>Plaza</th>
        <th>Cortes</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
         $l1 = anchor('catalogo/quitar_usuario_suc_cortes/'.$id.'/'.$row->suc, '<img src="'.base_url().'img/icon_error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));    $tabla.="
            <tr>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->user_id." - ".$row->contador."</td>
            <td align=\"left\">".$row->puesto."</td>
            <td align=\"left\">".$row->gere." - ".$row->cortes."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cedis()
    {
     $sql = "SELECT *from catalogo.almacen order by sec";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Sec</th>
        <th>Codigo</th>
        <th>Sustancia Activa</th>
        <th>Descripcion</th>
        <th>Proveedor</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
         $tabla.="
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"left\">".$row->codigo."</td>
            <td align=\"left\">".$row->susa1."</td>
            <td align=\"left\">".$row->susa2."</td>
            <td align=\"left\">".$row->prv." - ".$row->prvx."</td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
    function polizas()
    {
     $sql = "SELECT * FROM catalogo.conta_cvepol order by descri";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th># Poliza</th>
        <th>Auxiliar</th>
        <th>Descripcion</th>
        <th colspan=\"3\">I v a</th>
        <th colspan=\"2\">Iva retenido</th>
        <th colspan=\"2\">I S R</th>
        <th colspan=\"2\">VARIOS</th>
        <th>Editar</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            $l1 = anchor('catalogo/cambiar_poliza/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar!', 'class' => 'encabezado'));
            
            
            if($row->activo==1){
            $tabla.="
            <tr>
            <td align=\"right\"><strong>".$row->cuenta."</strong></td>
            <td align=\"right\">".$row->auxiliar."</td>
            <td align=\"left\">".$row->descri."</td>
            <td align=\"right\">".$row->iva."</td>
            <td align=\"right\"><strong>".$row->cuenta_iva."</strong></td>
            <td align=\"right\">".$row->auxi_iva."</td>
            <td align=\"right\"><strong>".$row->cuenta_ivar."</strong></td>
            <td align=\"right\">".$row->auxi_ivar."</td>
            <td align=\"right\"><strong>".$row->cuenta_isr."</strong></td>
            <td align=\"right\">".$row->auxi_isr."</td>
            <td align=\"right\"><strong>".$row->cuenta_varios."</strong></td>
            <td align=\"right\">".$row->auxi_varios."</td>
            <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
            }else{
            $tabla.="
            <tr>
            <td align=\"right\"><strong><font size=\"1\" color=\"#F80707\">".$row->cuenta."</font></strong></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$row->auxiliar."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#F80707\">".$row->descri."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$row->iva."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\"><strong>".$row->cuenta_iva."</strong></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$row->auxi_iva."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\"><strong>".$row->cuenta_ivar."</strong></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$row->auxi_ivar."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\"><strong>".$row->cuenta_isr."</strong></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$row->auxi_isr."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\"><strong>".$row->cuenta_varios."</strong></font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$row->auxi_varios."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"#F80707\">".$l1."</td>
            
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
    function agrega_member_poliza($cuenta,$auxi,$descri,$iva,$cuenta_iva,$auxi_iva,$cuenta_ivar,$auxi_ivar,$cuenta_isr,$auxi_isr,$cuenta_varios,$auxi_varios)
    {
        
            
        $sql = "SELECT * FROM catalogo.conta_cvepol where cuenta = ? and auxiliar= ? ";
        $query = $this->db->query($sql,array($cuenta,$auxi));
        if($query->num_rows() == 0){
     $new_member_insert_data = array(
			
            'descri'   =>strtoupper(trim($descri)),
            'cuenta'   =>$cuenta,
            'auxiliar' =>$auxi,
            'iva'      =>$iva,
            'cuenta_iva'=>$cuenta_iva,
            'auxi_iva'=>$auxi_iva,
            'cuenta_ivar'=>$cuenta_ivar,
            'auxi_ivar'=>$auxi_ivar,
            'cuenta_isr'=>$cuenta_isr,
            'auxi_isr'=>$auxi_isr,
            'cuenta_varios'=>$cuenta_varios,
            'auxi_varios'=>$auxi_varios,
            'activo'=>1,
            'fecha'=> date('Y-m-d')
          
            
		);
		
		
		$insert = $this->db->insert('catalogo.conta_cvepol', $new_member_insert_data);
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function update_member_poliza($cuenta,$auxi,$descri,$iva,$cuenta_iva,$auxi_iva,$cuenta_ivar,$auxi_ivar,$cuenta_isr,$auxi_isr,$cuenta_varios,$auxi_varios,$id,$activo)
    {
        $sql = "SELECT * FROM catalogo.conta_cvepol where cuenta = ? and auxiliar= ? ";
        $query = $this->db->query($sql,array($cuenta,$auxi));
        if($query->num_rows() == 1){ 
    
     $data = array(
			'descri'   =>strtoupper(trim($descri)),
            'cuenta'   =>$cuenta,
            'auxiliar' =>$auxi,
            'iva'      =>$iva,
            'cuenta_iva'=>$cuenta_iva,
            'auxi_iva'=>$auxi_iva,
            'cuenta_ivar'=>$cuenta_ivar,
            'auxi_ivar'=>$auxi_ivar,
            'cuenta_isr'=>$cuenta_isr,
            'auxi_isr'=>$auxi_isr,
            'cuenta_varios'=>$cuenta_varios,
            'auxi_varios'=>$auxi_varios,
            'activo'=>$activo
		);
        
		$this->db->where('id', $id);
        $this->db->update('catalogo.conta_cvepol', $data);
        return $this->db->affected_rows();
       }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function cuentas()
    {
     $sql = "SELECT a.*,
(select razon from catalogo.compa b where b.cia=a.cia)as ciax,
(select nombre from catalogo.conta_bancos c where c.id=a.banco)as bancox,
(select plaza from catalogo.conta_plazas d where d.cia=a.cia and d.nplaza=a.plaza)as plazax
FROM catalogo.conta_ctasfor a order by cia, plaza";
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>CUENTA</th>
        <th>CIA</th>
        <th>PLAZA</th>
        <th>BANCO</th>
        <th>EDITAR</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            $l1 = anchor('catalogo/cambiar_cuenta/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar productos!', 'class' => 'encabezado'));
            if($row->activo==1){
            $tabla.="
            <tr>
            <td align=\"left\">".$row->cuenta."</td>
            <td align=\"left\">".$row->cia."-".$row->ciax."</td>
            <td align=\"left\">".$row->plaza."-".$row->plazax."</td>
            <td align=\"left\">".$row->banco."-".$row->bancox."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
        }else{
         $tabla.="
            <tr>
            <td align=\"left\"><font size=\"1\" color=\"#F80707\">".$row->cuenta."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#F80707\">".$row->cia."-".$row->ciax."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#F80707\">".$row->plaza."-".$row->plazax."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#F80707\">".$row->banco."-".$row->bancox."</font></td>
            <td align=\"left\"><font size=\"1\" color=\"#F80707\">".$l1."</font></td>
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
    function agrega_member_cuenta($cuenta,$cia,$plaza,$banco)
    {
        
            
        $sql = "SELECT * FROM catalogo.conta_ctasfor where cia = ? and plaza= ? and cuenta=? ";
        $query = $this->db->query($sql,array($cia,$plaza,$cuenta));
        if($query->num_rows() == 0){
     $new_member_insert_data = array(
			
            'cuenta'=>trim($cuenta),
            'cia'   =>$cia,
            'plaza' =>$plaza,
            'banco' =>$banco            
		);
		$insert = $this->db->insert('catalogo.conta_ctasfor', $new_member_insert_data);
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function update_member_cuentas($cuenta,$cia,$plaza,$banco,$activo,$id)
    {
        $ciaf=$cia;
        $plazaf=$plaza;
        $bancof=$banco;
        
        $sql = "SELECT * FROM catalogo.conta_ctasfor where cuenta = ? and cia= ? and plaza= ? ";
        $query = $this->db->query($sql,array($cuenta,$cia,$plaza));
        if($query->num_rows() == 0){ 
        $sql1 = "SELECT * FROM catalogo.conta_ctasfor where id= ? ";
        $query1 = $this->db->query($sql1,array($id));
        if($query1->num_rows() == 1){ 
        $row= $query1->row();
                        if($cia==0){$ciaf=$row->cia;}
                        if($plaza==0){$plazaf=$row->plaza;}
                        if($bnco==0){$bancof=$row->banco;}
     $data = array(
			'cuenta'=>trim($cuenta),
            'cia'   =>$ciaf,
            'plaza' =>$plazaf,
            'banco' =>$bancof,
            'activo'=>$activo
		);
        
		$this->db->where('id', $id);
        $this->db->update('catalogo.conta_ctasfor', $data);
        return $this->db->affected_rows();
       }
       }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function plazas()
    {
     $sql = "SELECT a.*,
(select razon from catalogo.compa b where b.cia=a.cia)as ciax
FROM catalogo.conta_plazas a order by cia, plaza";
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>CIA</th>
        <th>COMPA&Ntilde;IA</th>
        <th># PLAZA</th>
        <th>PLAZA</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
            $tabla.="
            <tr>
            <td align=\"left\">".$row->cia."</td>
            <td align=\"left\">".$row->ciax."</td>
            <td align=\"left\">".$row->nplaza."</td>
            <td align=\"left\">".$row->plaza."</td>
           
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
                $l1 = anchor('catalogo/borrar_bene/'.$row->id.'/'.$pla.'/'.$cia, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borra Beneficiario!', 'class' => 'encabezado'));
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
        redirect('catalogo/bene_d_mas/'.$pla.'/'.$cia);
        }
        }
redirect('catalogo/bene_d_mas/'.$pla.'/'.$cia);
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
    
    function bancos()
    {
     $sql = "SELECT * FROM catalogo.conta_bancos";
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Id</th>
        <th>Bancos</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            //$l1 = anchor('catalogo/cambiar_banco/'.$row->id, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar productos!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"center\">".$row->id."</td>
            <td align=\"center\">".$row->nombre."</td>
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
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////
     function rentas_busca($suc,$arr)
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,b.nombre
      FROM catalogo.cat_beneficiario a
      left join catalogo.sucursal b on b.suc=a.suc
      where a.suc=$suc or a.id=$arr";
      
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
            $l1 = anchor('catalogo/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            }else{
            $l1='';
            }
            $l2 = anchor('catalogo/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado'));
           
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
     $s = "SELECT *FROM catalogo.sucursal where  suc>100 and suc<=1999";
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
   $l0='';     
        foreach($q->result() as $r)
        {
            
      $sql = "SELECT * FROM catalogo.cat_beneficiario  where suc=$r->suc and activo=1
      ";
      $tabla.="
            <tr>
            <td align=\"center\"><font color=\"blue\">".$r->tipo2." - ".$r->suc."<font></td>
            <td align=\"left\"><font color=\"blue\">".$r->nombre." <BR />".$r->dire."<font></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
            
            </tr>
            ";
        $query = $this->db->query($sql);
        foreach($query->result() as $row)
        {
         $l0 = anchor('catalogo/tabla_rentas_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
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
            $l1 = anchor('catalogo/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            }else{
            $l1='';
            }
            $l2 = anchor('catalogo/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            <td>$l0</td>
            <td></td>
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
      $id_plaza= $this->session->userdata('id_plaza');
     $nivel= $this->session->userdata('nivel');   
     $s = "SELECT * FROM  catalogo.sucursal where id_plaza=$id_plaza";
      
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
            $l1 = anchor('catalogo/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            }else{
            $l1='';
            }
            $l2 = anchor('catalogo/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado','target'=>'blank'));
            
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


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function empleados_busca($suc,$arr)
    {
    $nivel= $this->session->userdata('nivel');   
     $sql = "SELECT a.*,b.nombre
      FROM catalogo.cat_beneficiario a
      left join catalogo.sucursal b on b.suc=a.suc
      where a.suc=$suc or a.id=$arr";
      
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
            $l1 = anchor('catalogo/tabla_rentas_cambia/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar arrendatarios!', 'class' => 'encabezado'));
            }else{
            $l1='';
            }
            $l2 = anchor('catalogo/tabla_rentas_vista/'.$row->id, '<img src="'.base_url().'img/factura.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver recibo!', 'class' => 'encabezado'));
           
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
 function agrega_member_empleado($cia,$rfc,$cur,$afilia,$pat,$mat,$nom,$puesto,$suc,$fecha_i,$salario,
        $integrado,$registro_pat,$motivo,$causa,$dire,$num,$col,$cp,$mun,$entidad,$autoriza,$nomina,$succ)
    {
        $hora=date('H:i');
        
        
        if($motivo=='CAMBIOS'){$cau='DE LA SUCUSAL '.$succ.' A LA '.$suc.strtoupper(trim($causa));}else{$cau=$causa;}
        $id_user= $this->session->userdata('id');    
        $sql = "SELECT * FROM catalogo.cat_alta_empleado where motivo='$motivo' and rfc='$rfc' and empleado=$nomina";
        $query = $this->db->query($sql);
        
       
        if($query->num_rows() == 0 ){
        if(($motivo=='RETENCION' and $hora>'07:00' and $hora<'17:00') || ($motivo<>'RETENCION')){ 
        
            $new_member_insert_data = array(
            'cia'=>$cia,
            'puesto'=>$puesto,
            'suc'=>$succ,
            'fecha_i'=>$fecha_i,
            'salario'=>$salario,
            'integrado'=>$integrado,
            'id_user'=>$id_user,
            'rfc'=>strtoupper(trim($rfc)),
            'cur'=>strtoupper(trim($cur)),
            'afilia'=>strtoupper(trim($afilia)),
            'pat'=>strtoupper(trim($pat)),
            'mat'=>strtoupper(trim($mat)),
            'nom'=>strtoupper(trim($nom)),
            'registro_pat'=>strtoupper(trim($registro_pat)),
            'motivo'=>strtoupper(trim($motivo)),
            'causa'=>$cau,
            'dire'=>strtoupper(trim($dire)),
            'num'=>strtoupper(trim($num)),
            'col'=>strtoupper(trim($col)),
            'cp'=>strtoupper(trim($cp)),
            'mun'=>strtoupper(trim($mun)),
            'entidad'=>strtoupper(trim($entidad)),
            'autoriza'=>strtoupper(trim($autoriza)),
            'empleado'=>$nomina,
            'fecha'=> date('Y-m-d H:i:s')
		);
		$insert = $this->db->insert('catalogo.cat_alta_empleado', $new_member_insert_data);
        }
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function cambia_member_empleados($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$suc_a,$id,$redon,$contrato,$incremento)
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
            'fecha'=> date('Y-m-d H:i:s')
          
            
		);
		
		$this->db->where('id', $id);
		$this->db->update('catalogo.cat_beneficiario', $data);
        }
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function empleados_pendientes()
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel'); 
     $tipo= $this->session->userdata('tipo');
	 $id_plaza= $this->session->userdata('id_plaza'); 
     if($tipo==1){
     $sql = "SELECT a.*,b.nombre,b.dire,c.nivel as nivelx,c.nombre as captura, c.puesto
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios c on c.id=a.id_user
      where a.tipo=1 and b.id_plaza=$id_plaza
      or a.motivo='CAMBIOS' and a.tipo=1
      ";
        
     }else{  
     $sql = "SELECT a.*,b.nombre,b.dire,c.nivel as nivelx,b.id_plaza,c.nombre as captura, c.puesto
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios c on c.id=a.id_user
      where a.id_user=$id_user and a.tipo=1
	  or a.motivo='RETENCION' and b.id_plaza=$id_plaza and a.tipo=1
      ";
      
      }
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Motivo  </th>
        <th>Nomina<br />Nombre</th>
        <th>Sucursal</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion <br />Registro patronal</th>
        <th>Salario Diario <br />Integrado</th>
        <th>Fecha de captura</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
            
           
            $l2 = anchor('catalogo/tabla_empleados_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado','target'=>'blank'));
            $l3 = anchor('catalogo/tabla_empleados_borrar_c/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('catalogo/tabla_empleados_validar/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
if($row->nivelx==14){$l3='';}            
            $tabla.="
            <tr>
            <td align=\"center\">".$row->motivo." ".$l4."</td>
            <td align=\"center\">".$row->empleado."<br />  ".$row->nom." ".$row->pat." ".$row->mat."</td>
            <td align=\"center\">".$row->suc." ".$row->nombre."</td>
            <td align=\"left\">".$row->rfc." <BR />".$row->cur."</td>
            <td align=\"left\">".$row->afilia."<br /> ".$row->registro_pat."</td>
            <td align=\"right\">".number_format($row->salario,2)."<br /> ".number_format($row->integrado,2)."</td>
            <td align=\"right\">".$row->fecha."</td>
             <td align=\"right\">".$l3." ".$l2."</td>
            </tr>
            <td align=\"left\" colspan=\"8\"><font color=\"blue\">CAPTURA.:".$row->captura." <b>".$row->puesto."</b><br />".$row->causa."</font></td>
            <tr>
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
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function empleados_pendientes_ret()
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel'); 
     $tipo= $this->session->userdata('tipo');
	 $id_plaza= $this->session->userdata('id_plaza'); 
      
     $sql = "SELECT a.*,b.nombre,b.dire,c.nivel as nivelx,b.id_plaza,c.nombre as captura, c.puesto
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios c on c.id=a.id_user
      where a.id_user=$id_user and a.tipo=1
	  or a.motivo='RETENCION' and b.id_plaza=$id_plaza and a.tipo=1
      ";
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Motivo  </th>
        <th>Nomina<br />Nombre</th>
        <th>Sucursal</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion <br />Registro patronal</th>
        <th>Salario Diario <br />Integrado</th>
        <th>Fecha de captura</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
            
           
            $l2 = anchor('catalogo/tabla_empleados_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado','target'=>'blank'));
            $l3 = anchor('catalogo/tabla_empleados_borrar_c/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('catalogo/tabla_empleados_validar/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
if($row->nivelx==14){$l3='';}            
            $tabla.="
            <tr>
            <td align=\"center\">".$row->motivo." ".$l4."</td>
            <td align=\"center\">".$row->empleado."<br />  ".$row->nom." ".$row->pat." ".$row->mat."</td>
            <td align=\"center\">".$row->suc." ".$row->nombre."</td>
            <td align=\"left\">".$row->rfc." <BR />".$row->cur."</td>
            <td align=\"left\">".$row->afilia."<br /> ".$row->registro_pat."</td>
            <td align=\"right\">".number_format($row->salario,2)."<br /> ".number_format($row->integrado,2)."</td>
            <td align=\"right\">".$row->fecha."</td>
             <td align=\"right\">".$l3." ".$l2."</td>
            </tr>
            <td align=\"left\" colspan=\"8\"><font color=\"blue\">CAPTURA.:".$row->captura." <b>".$row->puesto."</b><br />".$row->causa."</font></td>
            <tr>
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

  /////////////////////////////////////////////////////

    function empleados_pendientes_his_val()
    {
     $id_user= $this->session->userdata('id');
     $id_plaza= $this->session->userdata('id_plaza');
     $nivel= $this->session->userdata('nivel');   
     $tipo= $this->session->userdata('tipo');   
     if($nivel==3){
     $sql = "SELECT a.*,b.nombre,b.dire
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      where 
      b.id_plaza=$id_plaza and tipo=3
      order by fecha_rh desc
      ";
      }
      if($nivel==33 and $tipo > 1){
     $sql = "SELECT a.*,b.nombre,b.dire
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      where tipo=3 and a.id_rh=$id_user
      order by motivo,fecha_rh desc
      ";
      }
      if($nivel==33 and $tipo == 1){
     $sql = "SELECT a.*,b.nombre,b.dire
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      where tipo=3 
      order by motivo,fecha_rh desc
      ";
      }
      if($nivel==7 ){
     $sql = "SELECT a.*,b.nombre,b.dire
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      where tipo=3 and a.id_rh=$id_user or motivo='RETENCION'
      order by fecha_rh desc
      ";
      }
      $l1 = anchor('catalogo/tabla_empleados_vista_todos/'.'1', 'ACTIVAS'.'<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
      $l0 = anchor('catalogo/tabla_empleados_vista_todos/'.'2', 'BAJAS'.'<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
      $l3 = anchor('catalogo/tabla_empleados_vista_todos/'.'7', 'LIBERACION'.'<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"3\">$l1</th>
        <th colspan=\"3\">$l0</th>
        <th colspan=\"4\">$l3</th>
        </tr>
        <tr>
        <th>Movimiento</th>
        <th>Nom.</th>
        <th>Nombre</th>
        <th>Sucursal</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion</th>
        <th>Registro patronal</th>
        <th>Fecha de captura</th>
        <th>Fecha RH</th>
        </tr>
        </thead>
        <tbody>
        ";
       
        foreach($query->result() as $row)
        {
        if($row->activo==2){$color='red';}else{$color='black';}
            $l2 = anchor('catalogo/tabla_empleados_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado', 'target' => 'blank'));
            $tabla.="
            <tr>
            <td align=\"center\"><font color=\"$color\">".$row->motivo."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->empleado."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->nom." ".$row->pat." ".$row->mat."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->suc."<br /> ".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->rfc." <BR />".$row->cur."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->afilia."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->registro_pat."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->fecha."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->fecha_rh." ".$l2."</font></td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

/////////////////////////////////////////////////////

    function empleados_vista($id)
    {
     $sql = "SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      where a.id=$id";
      
        $query = $this->db->query($sql);
        $detalle= "
        <table border=\"1\">
        
        ";
        
        foreach($query->result() as $row)
        {
            if($row->tipo==1){
                $ti='MOVIMIENTO SOLO PARA VISUALIZAR HASTA QUE EL CONTADOR VALIDE A RH';
            }else{
                $ti='';
            }
            $detalle.="
             <tr>
            <th colspan=\"3\" align=\"center\"><strong><font size=\"+6\">".$ti."</font></strong></th>
            </tr>
            <tr>
            <th colspan=\"3\" align=\"center\"><strong><font size=\"+6\">".$row->motivo."</font></strong></th>
            </tr>
            <tr>
            <th colspan=\"3\" align=\"center\"><strong>CONTROL DE ".$row->motivo."  DE NOMIAS</strong></th>
            </tr>
            <tr>
            <td colspan=\"3\" align=\"center\">NOMBRE DEL PATRON O RAZON SOCIAL</td>
            </tr>
            <tr>
            <td colspan=\"3\" align=\"center\"><strong>".$row->ciax."</strong></td>
            </tr>
            
            <tr>
            <td align=\"center\"><strong>RFC <br /></strong> ".$row->rfc."</td>
            <td align=\"center\"><strong>CURP <br /></strong> ".$row->cur."</td>
            <td align=\"center\"><strong>No. DE AFILIACION <br /></strong> ".$row->afilia." </td>
            </tr>
           <tr>
            <td align=\"center\"><strong>APELLIDO PATERNO  <br /></strong>".$row->pat."</td>
            <td align=\"center\"><strong>APELLIDO MATERNO  <br /></strong>".$row->mat."</td>
            <td align=\"center\"><strong>NOMBRE  <br /></strong>".$row->nom."</td>
            </tr>
            ";
           if($row->motivo=='ALTA' or $row->motivo=='CAMBIO'){
            $detalle.="
            <tr>
            <td align=\"center\"><strong>DIRECCION  <br /></strong>".$row->dire."</td>
            <td align=\"center\"><strong>NUMERO  <br /></strong>".$row->num."</td>
            <td align=\"center\"><strong>COL  <br /></strong>".$row->col."</td>
            </tr>
            <tr>
            <td align=\"center\"><strong>CP  <br /></strong>".$row->cp."</td>
            <td align=\"center\"><strong>MUNICIPIO  <br /></strong>".$row->mun."</td>
            <td align=\"center\"><strong>ENTIDAD  <br /></strong>".$row->entidad."</td>
             </tr>
            ";
            }
            $detalle.="
            <tr>
            <td align=\"center\"><strong>PUESTO  <br /></strong>".$row->puestox."</td>
            <td align=\"center\"><strong>SUCURSAL  <br /></strong>".$row->suc." ".$row->nombre."</td>
            <td align=\"center\"><strong>No.NOMINA  <br /></strong>".$row->empleado."</td>
            </tr>
           <tr>
            <td align=\"center\"><strong>SAL.DIARIO  <br /></strong>".number_format($row->salario,2)."</td>
            <td align=\"center\"><strong>SAL.INTEGRADO DIARIO  <br /></strong>".number_format($row->integrado,2)."</td>
            <td align=\"center\"></td>
             </tr>
             <tr>
            <td align=\"center\"><strong>FECHA DE ".$row->motivo."  <br /></strong>".$row->fecha_i."</td>
            <td align=\"center\"><strong>FECHA DE CAPTURA  <br /></strong>".$row->fecha."</td>
            <td align=\"center\"><strong>CAUSA  <br /></strong>".$row->causa."</td>
             </tr>
            <tr>
            <td align=\"center\"><strong>REGISTRO PATRONAL <br /></strong>".$row->registro_pat."</td>
            <td align=\"center\"><strong>HECHO POR  <br /></strong>".$row->id_userx."<br /> ".$row->contador."</td>
            <td align=\"center\"><strong>AUTORIZA  <br /></strong>".$row->autoriza."</td>
             </tr>
             <tr bgcolor=\"#D2C9C9\">
            <td align=\"center\"><strong>RECURSOS HUMANOS o NOMINAS <br /></strong>".$row->id_rhx." ".$row->puesto_val."</td>
            <td align=\"center\"><strong>EN LA FECHA  <br /></strong>".$row->fecha_rh."</td>
            <td align=\"center\"><strong>CLAVE  <br /></strong>".$row->clave_rh."</td>
             </tr> 
            ";
            
            
        }
        
        $detalle.="
        </table>";
        
        
        return $detalle;
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function empleados_vista_todos($activo)
    {
     if($activo==1){   
     $sql = "SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val,clave as clavex
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      left join catalogo.cat_claves_rh g on g.id=id_causa
      where a.motivo='RETENCION'  and a.activo<>2 and id_causa<>7 
      order by date_format(fecha_rh,'%Y-%m-%d')";
        $query = $this->db->query($sql);
}elseif($activo==7){
 $sql = "SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val,clave as clavex
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      left join catalogo.cat_claves_rh g on g.id=id_causa
      where a.motivo='LIBERACION' or id_causa=7 
      order by date_format(fecha_rh,'%Y-%m-%d'), cia,id_causa ";
        $query = $this->db->query($sql);   
}
elseif($activo==2){
 $sql = "SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val,clave as clavex
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      left join catalogo.cat_claves_rh g on g.id=id_causa
      where a.motivo='RETENCION' and a.activo=2 and id_causa<>7 order by date_format(fecha_rh,'%Y-%m-%d'), cia,id_causa ";
        $query = $this->db->query($sql);   
}
        $detalle= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS RETENIDOS</strong></th>
        </tr>
        <tr>
        <th colspan=\"4\" align=\"right\"><strong>Fecha de Impresion ".date('d-m-Y H:m:i')."</strong></th>
        </tr>
        
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        </tr>
        </thead>
        ";
        $num=$num+0;
        foreach($query->result() as $row)
        {
            
            $detalle.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->empleado." ".$row->pat." ".$row->mat." ".$row->nom."</td>
            <td colspan=\"1\"><strong>".$row->clavex."</strong></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_i."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha."</td>
            <td align=\"left\">".$row->id_rhx."<br /> ".$row->fecha_rh."</td>
            </tr>
            ";
$num=$num+1;
        }
$detalle.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $detalle;
    }


/////////////////////////////////////////////////////

/////////////////////////////////////////////////////
    function valida_member_empleados($id)
    {
     $nivel= $this->session->userdata('nivel');
     $tipo= $this->session->userdata('tipo');
	 if($nivel==14){
     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
   	 }elseif($nivel==33 and $tipo==1){
   	 $id_user= $this->session->userdata('id');   
	 $data = array('tipo'=>3, 'fecha_rh'=>date('Y-m-d H:i:s'),'id_rh'=>$id_user);
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();
	 }
     elseif($nivel==33 and $tipo<>1){
   	 $id_user= $this->session->userdata('id');   
	 $data = array('tipo'=>2, 'fecha_rh'=>date('Y-m-d H:i:s'),'id_rh'=>$id_user);
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();
	 }elseif($nivel==3){
	 $data = array('tipo'=>2, 'fecha'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();
	 } 
     }
//////////////////////////////////////////////////
/////////////////////////////////////////////////////
       function cambia_member_empleados_rh($id,$clave_rh,$empleado)
    {
     $id_user= $this->session->userdata('id'); 
     $data = array(
     'tipo'=>3,
     'id_rh'=>$id_user,
     'clave_rh'=>$clave_rh,
     'empleado'=>$empleado, 
     'fecha_rh'=>date('Y-m-d H:i:s')
     );
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();
    }

//////////////////////////////////////////////////
/////////////////////////////////////////////////////
       function cambia_member_empleados_rh2($id,$clave_rh,$motivo)
    {
     $id_user= $this->session->userdata('id'); 
     $data = array(
     'tipo'=>3,
     'id_rh'=>$id_user,
     'obser'=>$clave_rh,
     'fecha_rh'=>date('Y-m-d H:i:s')
     );
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
       function delete_member_empleados($id)
    {
     $id_user= $this->session->userdata('id'); 
     $this->db->delete('catalogo.cat_alta_empleado', array('id' => $id));
     return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function empleados_mov($fec1,$fec2,$mot)
    {
     $id_user=$this->session->userdata('id');
     $nivel=$this->session->userdata('nivel');
     $id_plaza=$this->session->userdata('id_plaza');
     $tipo=$this->session->userdata('tipo'); 
     if($nivel==3){
     $sql = "SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join desarrollo.usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join desarrollo.usuarios f on f.id=a.id_rh
      where 
      a.id_user=$id_user and date_format(fecha,'%Y-%m-%d')>='$fec1' and date_format(fecha,'%Y-%m-%d')<='$fec2' and motivo='$mot' and a.tipo>=2";
      $query = $this->db->query($sql);
      
      
      }
      if($nivel==33 && $tipo==1 || $nivel==33 && $tipo==0){
     $sql = "SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      where 
      date_format(fecha_rh,'%Y-%m-%d')>='$fec1' and date_format(fecha_rh,'%Y-%m-%d')<='$fec2' and motivo='$mot'
      order by motivo,activo,fecha_rh";
      $query = $this->db->query($sql);
      }
      if($nivel==33 && $tipo>1 ){
     $sql = "SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      where 
      a.id_user=$id_user and date_format(fecha_rh,'%Y-%m-%d')>='$fec1' and date_format(fecha_rh,'%Y-%m-%d')<='$fec2' and motivo='$mot'";
      $query = $this->db->query($sql);
      }
      if($nivel==7){
      $sql ="SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      where 
      date_format(fecha_rh,'%Y-%m-%d')>='$fec1' and date_format(fecha_rh,'%Y-%m-%d')<='$fec2' and motivo='$mot'
      order by a.cia;
      ";  
      $query = $this->db->query($sql); 
      }
            
        $detalle= "
        <table border=\"1\">
        ";
        
        foreach($query->result() as $row)
        {
        if($row->activo==0 and $row->motivo=='ALTA'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='ALTA'){$color='blue';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='ALTA'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        if($row->activo==0 and $row->motivo=='BAJA'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='BAJA'){$color='red';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='BAJA'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        
        if($row->activo==0 and $row->motivo=='RETENCION'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='RETENCION'){$color='red';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='RETENCION'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='RETENCION' and $row->id_causa==7){$color='BLUE';$var='ESTA ACTIVO EN EL AS400 YA SE LIBERO';}
            
            $detalle.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->motivo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->autoriza."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->empleado."<br />".$row->nom." ".$row->pat." ".$row->mat."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->suc." ".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->id_userx." ".$row->contador."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->rfc." <BR />".$row->cur."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->afilia."<BR />".$row->registro_pat."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->fecha."<BR />".$row->fecha_rh."</font></td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"8\"><font color=\"$color\"><strong>CAUSA..:</strong>".$row->causa."<BR />CIA..:".$row->ciax."<BR />AS400..:".$var."</font></td>
            </tr>
            <tr bgcolor=\"#D8D1D1\">
            <td align=\"left\" colspan=\"8\"></td>
            </tr>
            ";
            
        }
        
        $detalle.="
        </table>";
        
       
        return $detalle;
    }
    
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function empleados_mov1($fec1,$fec2,$mot,$conta)
    {
     $id_user=$this->session->userdata('id');
     $nivel=$this->session->userdata('nivel');
     $tipo=$this->session->userdata('tipo'); 
     if($nivel==3){
     $sql = "SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      where 
      a.id_user='$conta' and date_format(fecha_rh,'%Y-%m-%d')>='$fec1' and date_format(fecha_rh,'%Y-%m-%d')<='$fec2' and motivo='$mot'";
      $query = $this->db->query($sql);
      
      }
      
            
        $detalle= "
        <table border=\"1\">
        ";
        
        foreach($query->result() as $row)
        {
        if($row->activo==0 and $row->motivo=='ALTA'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='ALTA'){$color='blue';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='ALTA'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        if($row->activo==0 and $row->motivo=='BAJA'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='BAJA'){$color='red';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='BAJA'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        if($row->activo==0 and $row->motivo=='RETENCION'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='RETENCION'){$color='red';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='RETENCION'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
            
            $detalle.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->motivo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->autoriza."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->empleado."<br />".$row->nom." ".$row->pat." ".$row->mat."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->suc." ".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->id_userx." ".$row->contador."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->rfc." <BR />".$row->cur."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->afilia."<BR />".$row->registro_pat."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->fecha."<BR />".$row->fecha_rh."</font></td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"8\"><font color=\"$color\"><strong>CAUSA..:</strong>".$row->causa."<BR />CIA..:".$row->ciax."<BR />AS400..:".$var."</font></td>
            </tr>
            <tr bgcolor=\"#D8D1D1\">
            <td align=\"left\" colspan=\"8\"></td>
            </tr>
            ";
            
        }
        
        $detalle.="
        </table>";
        
       
        return $detalle;
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function solo_retencion()
    {
        $tipo=$this->session->userdata('tipo'); 
     $sql = "SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val,clave as clavex
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      left join catalogo.cat_claves_rh g on g.id=id_causa
      where a.motivo='RETENCION'  and a.activo<>2 and id_causa<>7 
      order by fecha desc";
      
        $query = $this->db->query($sql);
      $l2 = anchor('catalogo/tabla_empleados_vista_todos/'.'1', 'ACTIVAS'.'<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
      $l0 = anchor('catalogo/tabla_empleados_vista_todos/'.'2', 'BAJAS'.'<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
      $l3 = anchor('catalogo/tabla_empleados_vista_todos/'.'7', 'LIBERACION'.'<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));

        $detalle= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS RETENIDOS</strong></th>
        </tr>
        <tr>
        <th colspan=\"2\">$l2</th>
        <th colspan=\"1\">$l0</th>
        <th colspan=\"2\">$l3</th>
        </tr>

        
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>PROCESO</strong></th>
        <th><strong>CAPTURO<br/>VALIDO</strong></th>
        <th><strong>EDIT</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
         if($tipo > 0){
         $l1 = anchor('catalogo/tabla_empleados_cambia_ret/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado'));   
         }else{
         $l1='';   
         }
             
            $detalle.="
            <tr>
            <td colspan=\"2\">Empleado :".$row->empleado." ".$row->pat." ".$row->mat." ".$row->nom."</td>
            <td colspan=\"1\"><strong>".$row->clavex."</strong></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_i."</td>
            <td></td>
            </tr>
            <tr>
            <td colspan=\"8\"><strong>CAUSA DE JURIDICO</strong>".$row->causaj."</td>
            </tr>
            
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->fecha_ret."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha." <br />".$row->id_rhx."<br /> ".$row->fecha_rh."</td>
            <td align=\"left\">$l1</td>
            </tr>
            <tr>
            <td colspan=\"8\"><strong></td>
            </tr>
            <tr>
            <td colspan=\"8\"><strong></td>
            </tr>
            ";
$num=$num+1;
        }
$detalle.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $detalle;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////
       function cambia_member_empleados_ret($id,$ret)
    {
     $id_user= $this->session->userdata('id'); 
     $data = array(
     'id_causa'=>$ret,
     'fecha_ret'=>date('Y-m-d H:i:s')
     );
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
       function cambia_member_empleados_ret_luis($id)
    {
     $id_user= $this->session->userdata('id'); 
     $data = array(
     'tipo'=>3,
     'id_rh'=>$id_user,
     'fecha_rh'=>date('Y-m-d H:i:s')
     );
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////




















/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_gerente_reg($ger)
    {
        
       $sql = "SELECT  *from catalogo.gerente where ger = $ger";
      
    $query = $this->db->query($sql);
    $row= $query->row();
    $gerx=$row->nombre_e;
   
    
     return $gerx; 
        
  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_sucursal_una($suc)
    {
    $sql = "SELECT  * FROM  catalogo.sucursal where suc=$suc ";
   
    $query = $this->db->query($sql);
    $row= $query->row();
    $sucx=$row->nombre;
    return $sucx;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_sucursal_unica($suc)
    {
    $sql = "SELECT  * FROM  catalogo.sucursal where suc=? ";
    $query = $this->db->query($sql,array($suc));
    return $query;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuarios($id)
    {
        $sql = "SELECT a.*,b.plaza as plazax,b.Id as id_plaza,c.razon
                FROM usuarios a
                left join catalogo.conta_plazas b on b.cia=a.cia and b.nplaza=a.plaza
                left join catalogo.compa c on c.cia=a.cia      
                where a.nivel=3 and a.id= ? order by plazax";
        $query = $this->db->query($sql,array($id));
         return $query;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuarios_gral($id)
    {
        $sql = "SELECT a.*,b.plaza as plazax,b.Id as id_plaza,c.razon
                FROM usuarios a
                left join catalogo.conta_plazas b on b.cia=a.cia and b.nplaza=a.plaza
                left join catalogo.compa c on c.cia=a.cia      
                where a.id= ?";
        $query = $this->db->query($sql,array($id));
         return $query;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuarios_ger($id,$nivel)
    {
        $sql = "SELECT a.* FROM usuarios a where a.nivel= ? and plaza= ? and responsable='R' ";
        $query = $this->db->query($sql,array($nivel,$id));
         return $query;  
    }
    /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuarios_ger_ger($plaza)
    {
        $sql = "SELECT a.* FROM usuarios a where a.plaza= ? and activo=1 and nivel=21 ";
        $query = $this->db->query($sql,array($plaza));
         return $query;  
    }
////////////////////////////////////////////////////
    function busca_usuarios_gerx($id,$nivel)
    {
        $sql = "SELECT a.* FROM usuarios a where a.nivel= ? and a.plaza= ? and activo=1 ";
        $query = $this->db->query($sql,array($nivel,$id));
         return $query;  
    }
////////////////////////////////////////////////////

    function busca_usuarios_cortes($id)
    {
        $sql = "SELECT a.*,b.plaza as plazax,b.Id as id_plaza,c.razon
                FROM usuarios a
                left join catalogo.conta_plazas b on b.cia=a.cia and b.nplaza=a.plaza
                left join catalogo.compa c on c.cia=a.cia      
                where a.nivel=5 and a.id= ? order by plazax";
        $query = $this->db->query($sql,array($id));
         return $query;  
    }
/////////////////////////////////////////////////////
    function busca_usuarios_conta()
    {
        $sql = "SELECT a.*FROM usuarios a where a.nivel=3 order by nombre ";
        $query = $this->db->query($sql);
       $usu = array();
        $usu[0] = "Selecciona una Usuario";
        
        foreach($query->result() as $row){
            $usu[$row->id] = $row->nombre." - ".$row->puesto;
        }
        
        
        return $usu;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function busca_suc_con_cor_2012()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal 
        where user_id= ? and tlid=1 and suc<1999 
        or id_plaza= ? and tlid=1 and suc<1999
        or user_id= ? and tlid=1 and suc=7485
        or id_plaza= ? and tlid=1 and suc=7485
        order by nombre";
     
        $query = $this->db->query($sql,array($this->session->userdata('id'),$this->session->userdata('id_plaza'),$this->session->userdata('id'),$this->session->userdata('id_plaza')));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_todass($suc)
    {
        
       $sql = "SELECT  nombre, dire, cp, col, pobla, rfc FROM  catalogo.sucursal where suc = ?";
    $query = $this->db->query($sql,array($suc));
    $row= $query->row();
    $sucx=$row->nombre;
     return $sucx; 
        
  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal 
        where user_id= ? and tlid=1 and suc<1999 
        or gere= ? and tlid=1 and suc<1999 
        or id_plaza= ? and tlid=1 and suc<1999
        order by nombre";
        $query = $this->db->query($sql,array($this->session->userdata('id'),$this->session->userdata('id'),$this->session->userdata('id_plaza')));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_almacen()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal where  suc=90001  or suc=90002 or suc=90003 or suc=90004 or suc=99999 or suc=99990 or tlid=1 order by suc";
        $query = $this->db->query($sql,array($this->session->userdata('id'),$this->session->userdata('id')));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->suc." - ".$row->nombre;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_dia($fec,$id_mov)
    {
        $s = "select DAYOFWEEK('$fec') as numero,date_format('$fec','%d')as dia, mes,date_format('$fec','%Y')as aaa,
        b.nombre as motivox 
        from catalogo.mes a, catalogo.cat_mov_super b   
        where b.id=$id_mov and a.num=date_format('$fec','%m')";
       
        $q = $this->db->query($s);
         return $q;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
     function busca_sucursal_juridico()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal 
        where   
        suc>100 and suc<1999 and tipo1<>'I'
        or suc=5100
        or suc=5900
        or suc=15100
        or suc=15100
        or suc=14000
        or suc=17000
        or suc=18000
        or suc=9100
        or suc=9900
        or suc=1601
        or suc=1602
        or suc=1603
        or suc=9150
        or suc=9151
        order by  nombre";
        $query = $this->db->query($sql,array($this->session->userdata('id')));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = trim($row->nombre)." - ".$row->suc;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_general()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal where   suc>100 and suc<1999 and tlid=1 or suc=999 or suc=90009 order by  suc";
        $query = $this->db->query($sql,array($this->session->userdata('id')));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->suc." - ".$row->nombre;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_general_nom()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal where   suc>100 and suc<1999 and tlid=1 order by nombre"; 
        $query = $this->db->query($sql,array($this->session->userdata('id')));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_toda()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal where  tlid=1 or suc>=90002 order by nombre"; 
        $query = $this->db->query($sql,array($this->session->userdata('id')));
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////  
    function busca_sucursal_supervisor($plaza)
    {
        
        $sql = "SELECT a.* 
        FROM  desarrollo.usuarios  a 
        left join catalogo.sucursal b on a.plaza=b.superv and b.regional<>$plaza
        where nivel=14 and regional<>$plaza order by plaza";
        $query = $this->db->query($sql);
        
        $sup = array();
        $sup[0] = "Selecciona una Supervisor";
        
        foreach($query->result() as $row){
            $sup[$row->plaza] = $row->plaza." - ".$row->nombre;
        }
        
        
        return $sup;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////  
    function busca_sucursal_sucur($plaza)
    {
        
        $sql = "SELECT a.* 
        FROM  desarrollo.usuarios  a 
        left join catalogo.sucursal b on a.plaza=b.superv and b.regional<>$plaza
        where nivel=14 and a.plaza<>$plaza order by plaza";
        $query = $this->db->query($sql);
        
        $sup = array();
        $sup[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $sup[$row->plaza] = $row->plaza." - ".$row->nombre;
        }
        
        
        return $sup;  
    }
    
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_bloque($cia,$pla)
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal where  cia=? and plaza=? and tlid=1 and suc<1999 order by  nombre";
        $query = $this->db->query($sql,array($cia,$pla));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_supervisor_suc($plaza)
    {
        
        $sql = "SELECT * FROM  catalogo.sucursal where  superv=? and tlid=1 and suc<1999 order by  nombre";
        $query = $this->db->query($sql,array($plaza));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_gerente_suc($plaza)
    {
        
        $sql = "SELECT * FROM  catalogo.sucursal where  regional=? and tlid=1 and suc<1999 order by  nombre";
        $query = $this->db->query($sql,array($plaza));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
    function busca_sucursal_gerente_s($plaza)
    {
        
        $sql = "SELECT a.*,b.nombre as supervx 
		FROM  catalogo.sucursal a
		left join usuarios b on b.plaza=a.superv and b.activo=1 
		where  a.regional=? and a.tlid=1 and a.suc<1999 and b.nivel=14 group by a.superv";
        $query = $this->db->query($sql,array($plaza));
        
        $suc = array();
        $suc[0] = "Selecciona una Supervisor";
        
        foreach($query->result() as $row){
            $suc[$row->superv] = $row->superv." - ".$row->supervx;
        }
        
        
        return $suc;  
    }

/////////////////////////////////////////////////////
    function busca_sucursal_bloque_id_2012()
    {
        $id_plaza= $this->session->userdata('id_plaza');  
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal 
        where 
        id_plaza= ? 
        order by  nombre";
        $query = $this->db->query($sql,array($id_plaza));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
    function busca_sucursal_bloque_id($id)
    {
        $id_plaza= $this->session->userdata('id_plaza');  
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal 
        where 
        user_id= ? and tlid=1 and suc<1999 
        or
        id_plaza= ? and tlid=1 and suc<1999 
        order by  nombre";
        $query = $this->db->query($sql,array($id,$id_plaza));
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_suc_unica($suc)
    {
      $sql = "SELECT  nombre, dire, cp, col, pobla, rfc FROM  catalogo.sucursal where suc = ?";
    $query = $this->db->query($sql,array($suc));
    $row= $query->row();
    $sucx=$row->nombre.", ".$row->dire.", ".$row->col.", ".$row->pobla." ".$row->cp;
     return $sucx; 
    }
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_ruta($suc,$fol)
    {
        
        $sql = "select a.*, sum(a.ped)as ped, b.nombre as sucx,c.nom as ruta,c.suc as succ
       from pedidos a
       left join catalogo.sucursal b on b.suc=a.suc
       left join catalogo.almacen_rutas c on c.suc=a.suc and c.ruta=a.bloque
       where date(a.fechas)=date(now()) and tipo=1 and ped>0  and fol<=$fol and a.suc=$suc group by suc ";
        $query = $this->db->query($sql);
       $row= $query->row();
       $rutax=$row->ruta;
     return $rutax; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sucursal_ruta_gral($suc)
    {
        
        $sql = "select nom as ruta from  catalogo.almacen_rutas where suc=$suc";
        $query = $this->db->query($sql);
       $row= $query->row();
       $rutax=$row->ruta;
     return $rutax; 
    }
    
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_cia_pedido($suc)
    {
        
        $sql = "SELECT a.suc, a.nombre, a.cia, a.estado, a.dire, a.cp, a.col, a.pobla, a.rfc, b.*
                FROM catalogo.sucursal a
                left join catalogo.compa b on a.cia=b.cia
                where suc=$suc";
        $query = $this->db->query($sql);
       $row= $query->row();
       $ciax=$row->razon.", ".$row->dire.", ".$row->col." ".$row->pobla." ".$row->cp.", ".$row->rfc;
     return $ciax; 
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function busca_concepto()
    {
        
        $sql = "SELECT a.id,a.descri,b.rfc,b.nombre
        FROM  catalogo.conta_cvepol a 
        left join catalogo.conta_receptores b on b.clave=a.id and b.activo=1 order by descri ";
        $query = $this->db->query($sql);
        
        $con = array();
        $con[0] = "Selecciona un Conc&eacute;pto";
        
        foreach($query->result() as $row){
            $con[$row->id] = $row->descri." - ".$row->id;
        }
        
        
        return $con;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function busca_prv()
    {
        
        $sql = "SELECT corto,prov FROM  catalogo.provedor where tipo='A' order by corto ";
        $query = $this->db->query($sql);
        
        $prvv = array();
        $prvv[0] = "Selecciona un provedor";
        
        foreach($query->result() as $row){
            $prvv[$row->prov] = $row->corto." - ".$row->prov;
        }
        
        
        return $prvv;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function busca_prv_uno($prv)
    {
        
        $sql = "SELECT corto,prov FROM  catalogo.provedor where prov=$prv";
        $query = $this->db->query($sql);
        $row= $query->row();
       $prvv=$row->corto;
        return $prvv; 
       
       
        
        
        return $prvv;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_sec_metro()
    {
    	$sql = "SELECT id FROM  catalogo.sec_metro_6000 order by id desc limit 1";
        $query = $this->db->query($sql);
       $row= $query->row();
       $secc=$row->id;
        return $secc;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_persona()
    {
        
        $sql = "SELECT persona,nombre FROM  catalogo.cat_comprador ";
        $query = $this->db->query($sql);
        
        $perr = array();
        $perr[0] = "Selecciona un comprador";
        
        foreach($query->result() as $row){
            $perr[$row->persona] = $row->nombre;
        }
        
        
        return $perr;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_quin()
    {
        
        $sql = "SELECT inicio,fin FROM  desarrollo.checador_quincenas ";
        $query = $this->db->query($sql);
        
        $perr = array();
        $perr[0] = "Selecciona un comprador";
        
        foreach($query->result() as $row){
            $perr[$row->inicio.$row->fin] = $row->inicio.' - '.$row->fin;
        }
        
        
        return $perr;  
    }
/////////////////////////////////////////////////////

    function busca_concepto_cia($cia,$pla)
    {
        
        $sql = "SELECT *
       from catalogo.conta_receptores 
        where cia=$cia and pla=$pla";
 
        $query = $this->db->query($sql);
        
        $con = array();
        $con[0] = "Selecciona un Conc&eacute;pto";
        
        foreach($query->result() as $row){
            $con[$row->id] = $row->nombre." - ".$row->id;
        }
        
        
        return $con;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_receptor_suc($suc,$con)
    {
        
		$id_user= $this->session->userdata('id');
        $sql = "SELECT rfc,nombre FROM catalogo.conta_receptores where suc=? and clave=?  and activo=1";
        $query = $this->db->query($sql,array($suc,$con));
        $tabla="";
        foreach($query->result() as $row)
        {
            $tabla.="
            <option value =\"".$row->rfc."\">".$row->nombre." - ".$row->nombre."</option>
            ";
        }
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_plazax($plaza,$plazax,$cia,$razon)
    {
        
        $sql = "SELECT a.*,c.razon  from catalogo.conta_plazas a
        left join catalogo.compa c on c.cia=a.cia where status <> 'B'
        order by a.plaza ";
        $query = $this->db->query($sql);
        
        $nplaza = array();
        $nplaza[0] ='Seleccione una opcion';
        
        foreach($query->result() as $row){
            $nplaza[$row->Id] = $row->plaza." - ".$row->razon;
        }
        
        return $nplaza;  
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_banco()
    {
        
        $sql = "SELECT *from catalogo.conta_bancos ";
        $query = $this->db->query($sql);
        
        $banco = array();
        $banco[0] = "Selecciona el Banco";
        
        foreach($query->result() as $row){
            $banco[$row->id] = $row->nombre;
        }
        
        return $banco;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_cia()
    {
        
        $sql = "SELECT *from catalogo.compa where activo=1";
        $query = $this->db->query($sql);
        
        $cia = array();
        $cia[0] = "Selecciona el Compa&ntilde;ia";
        
        foreach($query->result() as $row){
            $cia[$row->cia] = $row->razon;
        }
        
        return $cia;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_cia_nomina()
    {
        
        $sql = "SELECT *from catalogo.cat_compa_nomina";
        $query = $this->db->query($sql);
        
        $cia = array();
        $cia[0] = "Selecciona el Compa&ntilde;ia";
        
        foreach($query->result() as $row){
            $cia[$row->cia] = $row->ciax;
        }
        
        return $cia;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_cia_unico($cia)
    {
     $sql = "SELECT *from catalogo.compa where cia= ?";
    $query = $this->db->query($sql,array($cia));
    $row= $query->row();
    $razon=$row->razon;
     return $razon; 
    }
    
    /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_plaza1()
    {
        
        $sql = "SELECT *from catalogo.cat_plaza order by plazax";
        $query = $this->db->query($sql);
        
        $plaza1 = array();
        $plaza1[0] = "Selecciona una plaza";
        
        foreach($query->result() as $row){
            $plaza1[$row->id_plaza] = $row->plazax;
        }
        
        return $plaza1;  
    }
    
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_motivo()
    {
        
        $sql = "SELECT * FROM catalogo.devolucion d";
        $query = $this->db->query($sql);
        
        $motivox = array();
        $motivox[0] = "Selecciona un motivo";
        
        foreach($query->result() as $row){
            $motivox[$row->num] = $row->nom;
        }
        
        return $motivox;  
    }
    
////////////////////////////////////////////////////////
///////////////////////////////////////////////////////
    
    function busca_sucursal3()
    {
        
        $sql = "SELECT * FROM catalogo.sucursal where suc>100 and suc<1700 and tipo1='A'";
        $query = $this->db->query($sql);
       
        
        $suc = array();
        $suc[0] = "Selecciona una sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->suc.' '.$row->nombre;
        }
        
        return $suc;  
    }
////////////////////////////////////////////////////////
///////////////////////////////////////////////////////
    
    function busca_sucursal1($plaza1)
    {
        
        $sql = "SELECT * FROM catalogo.sucursal
                where id_plaza = '$plaza1'
                and (suc >=100 and suc <=1999
                or suc >=8000 and suc <=8999
                or suc >=14000 and suc <=14999
                or suc >=16000 and suc <=17999)";
        $query = $this->db->query($sql);
       
        
        $suc = array();
        $suc[0] = "Selecciona una sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->suc.' '.$row->nombre;
        }
        
        return $suc;  
    }

    function busca_sucursal2($plaza)
    {
        
        $sql = "SELECT * FROM catalogo.sucursal
                where id_plaza = '$plaza'
                and (suc >=100 and suc <=1999
                or suc >=8000 and suc <=8999
                or suc >=14000 and suc <=14999
                or suc >=16000 and suc <=17999)";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        
        $suc = "<option value=\"0\">Selecciona una Sucursal</option>";
        
        foreach($query->result() as $row){
            $suc.= "<option value=\"$row->suc\">$row->suc - $row->nombre</option>";
        }
        
        return $suc;  
    }
    
    /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_contador1()
    {
        
        $sql = "SELECT a.*, b.plazax as plaza FROM desarrollo.usuarios a
left join catalogo.cat_plaza b on a.id_plaza=b.id_plaza
where a.nivel=3 and a.tipo=0 and a.activo=1 order by b.plazax";
        $query = $this->db->query($sql);
        
        $conta = array();
        $conta[0] = "Selecciona una plaza";
        
        foreach($query->result() as $row){
            $conta[$row->id] = $row->plaza;
        }
        
        return $conta;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_mes()
    {
        
        $sql = "SELECT *from catalogo.mes order by num";
        $query = $this->db->query($sql);
        
        $mes = array();
        $mes[0] = "Selecciona el mes";
        
        foreach($query->result() as $row){
            $mes[$row->num] = $row->mes;
        }
        
        return $mes;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_mes_unico($mes)
    {
     $sql = "SELECT  mes FROM  catalogo.mes where num = ?";
    $query = $this->db->query($sql,array($mes));
    $row= $query->row();
    $mesx=$row->mes;
     return $mesx; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_mes_quincena($mes)
    {
     $sql = "SELECT  dos FROM  catalogo.mes where num = ?";
    $query = $this->db->query($sql,array($mes));
    $row= $query->row();
    $dia=$row->dos;
     return $dia; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_mes_t($mes)
    {
     $sql = "SELECT  * FROM  catalogo.mes where num = $mes";
     
    $query = $this->db->query($sql);
     return $query;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_mes_calendario($mes,$num)
    {
     $sql = "SELECT  * FROM  catalogo.cat_calendario_nom where mes = $mes and inicio=$num";
    $query = $this->db->query($sql);
     return $query;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_empleado_clave($clave)
    {
    
    $sql = "SELECT  * FROM  catalogo.cat_empleado where
tipo=1 and puestox like 'ENCARGADO%' and rfc like '$clave%'
or
tipo=1 and puestox like 'JEFE MOSTRADOR%' and rfc like '$clave%'";
    $query = $this->db->query($sql);
   
    if($query->num_rows() == 1){
    $row= $query->row();
    $nomx=$row->nomina;
     }else{
    $nomx=0;    
     } 
    return $nomx;
    }
/////////////////////////////////////////////////////
    function busca_anio()
    {
        
        $sql = "SELECT *from catalogo.anio where tipo=1 order by aaa";
        $query = $this->db->query($sql);
        
        $aaa = array();
        $aaa[0] = "Selecciona el a&ntilde;o";
        
        foreach($query->result() as $row){
            $aaa[$row->aaa] = $row->aaa;
        }
        
        return $aaa;  
    }
/////////////////////////////////////////////////////
    function busca_farmacia()
    {
        
        $sql = "SELECT *from catalogo.cat_farmacia ";
        $query = $this->db->query($sql);
        
        $var = array();
        $var[0] = "Seleccion de farmacia";
        
        foreach($query->result() as $row){
            $var[$row->tipo] = $row->nombre;
        }
        
        return $var;  
    }
/////////////////////////////////////////////////////
    function busca_ord_dias()
    {
        
        $sql = "SELECT *from catalogo.compras_ord_dias";
        $query = $this->db->query($sql);
        
        $por = array();
        $por[0] = "Selecciona los dias";
        
        foreach($query->result() as $row){
            $por[$row->porcen] = $row->dia.' DIAS';
        }
        
        return $por;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

   function busca_receptor($con)
    {
        
        $sql = "SELECT rfc,nombre FROM  catalogo.conta_receptores where clave= ? and activo=1";
        $query = $this->db->query($sql,array($con));
        
        $rec = array();
        $rec[0] = "Selecciona un Destinatario";
        
        foreach($query->result() as $row){
            $rec[$row->rfc] = $row->rfc." - ".$row->nombre;
        }
        
        
        return $rec;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_poliza()
    {
     $sql = "SELECT * FROM  catalogo.conta_cvepol order by descri";
    $query = $this->db->query($sql);
     $clave = array();
     $clave[0] = "Selecciona una Poliza";
        
        foreach($query->result() as $row){
            $clave[$row->id] = $row->id." - ".$row->descri;
        }
        
        
        return $clave;
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_poliza_unica($id)
    {
     $sql = "SELECT * FROM  catalogo.conta_cvepol where id = ?";
    $query = $this->db->query($sql,array($id));
     return $query; 
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_concepto_unico($clave)
    {
     $sql = "SELECT * FROM  catalogo.conta_cvepol where id = ?";
    $query = $this->db->query($sql,array($clave));
     return $query; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_cuenta_unica($id)
    {
     $sql = "SELECT a.*,b.razon as ciax, c.plaza as plazax, d.nombre as bancox
FROM  catalogo.conta_ctasfor a
left join catalogo.compa b on b.cia=a.cia
left join catalogo.conta_plazas c on c.cia=a.cia and c.nplaza=a.plaza
left join catalogo.conta_bancos d on d.id=a.banco 
where a.id = ?";
    $query = $this->db->query($sql,array($id));
     return $query; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_ctafor($plaza,$cia)
    {
     $sql = "SELECT  cuenta FROM  catalogo.conta_ctasfor where plaza = ? and cia=?";
    $query = $this->db->query($sql,array($plaza,$cia));
    return $query; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_plaza_general()
    {
        
        $sql = "SELECT * FROM catalogo.conta_plazas order by cia,nplaza";
        $query = $this->db->query($sql);
        
        $nplaza = array();
        $nplaza[0] = "Selecciona una Plaza";
        
        foreach($query->result() as $row){
            $nplaza[$row->nplaza."_".$row->cia] = str_pad($row->cia, 2, "0",STR_PAD_LEFT)." - ".str_pad($row->nplaza, 2, "0",STR_PAD_LEFT)." - ".$row->plaza;
        }
        
        
        return $nplaza;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_plaza_unica($cia,$pla)
    {
     $sql = "SELECT *from catalogo.conta_plazas where cia=? and nplaza= ?";
    $query = $this->db->query($sql,array($cia,$pla));
    $row= $query->row();
    $plaza=$row->plaza;
     return $plaza; 
    }
    function busca_plaza($cia)
    {
        
        $sql = "SELECT a.nplaza,a.plaza FROM catalogo.conta_plazas a where cia= ? ";
        $query = $this->db->query($sql, array($cia));
        $tabla = "<option value=\"0\">Selecciona una Plaza</option>";
        foreach($query->result() as $row)
        {
            $tabla.="
            <option value =\"".$row->nplaza."\">".$row->plaza."</option>
            ";
        }
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_nomina_tod($nomina)
    {
        $id_user= $this->session->userdata('id');
        $id_plaza=$this->session->userdata('id_plaza');
        $sql = "SELECT concat(trim(pat),' ',trim(mat),' ',trim(nom))as completo FROM catalogo.cat_empleado a
                where a.nomina= ? and tipo=1";
        $query = $this->db->query($sql,array($nomina));
        $completo = "NO ESTA EN EL CATALOGO DE EMPLEADOS";
        
        foreach($query->result() as $row){
            $completo = $row->completo;
        }
        
        
        return $completo; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_id_val($id)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $sql = "SELECT a.*,b.nombre as sucursal ,c.puesto as puestox,d.ciax
        FROM catalogo.cat_alta_empleado a
        left join catalogo.sucursal b on  a.suc=b.suc
        left join catalogo.cat_puesto c on  c.id=a.puesto
        left join catalogo.cat_compa_nomina d on  d.cia=a.cia
        where a.id= $id";
        
        
        $query = $this->db->query($sql);
        
        return $query; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_id($id)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $id_plaza= $this->session->userdata('id_plaza');
        if($nivel==3){
        $sql = "SELECT a.succ as suc, a.*,b.nombre as sucursal ,c.puesto as puestox,d.ciax
        FROM catalogo.cat_empleado a
        left join catalogo.sucursal b on  a.succ=b.suc
        left join catalogo.cat_puesto c on  c.id=a.puesto
        left join catalogo.cat_compa_nomina d on  d.cia=a.cia
        where a.id= $id and a.id_plaza=$id_plaza and tipo=1";
        }
        if($nivel==7){
        $sql = "SELECT a.*,b.nombre as sucursal ,c.puesto as puestox,d.ciax
        FROM catalogo.cat_alta_empleado a
        left join catalogo.sucursal b on  a.suc=b.suc
        left join catalogo.cat_puesto c on  c.id=a.puesto
        left join catalogo.cat_compa_nomina d on  d.cia=a.cia
        where a.id= $id";
        }
        
        
        if($nivel==33){
        $sql = "SELECT a.succ as suc,a.*,b.nombre as sucursal ,c.puesto as puestox,d.ciax
        FROM catalogo.cat_empleado a
        left join catalogo.sucursal b on  a.succ=b.suc
        left join catalogo.cat_puesto c on  c.id=a.puesto
        left join catalogo.cat_compa_nomina d on  d.cia=a.cia
        where a.id= $id and tipo=1";
        }
        
        $query = $this->db->query($sql);
        
        return $query; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_nomina($nomina)
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
      if($nivel==3){
      $sql = "SELECT concat(trim(pat),' ',trim(mat),' ',trim(nom))as completo FROM catalogo.cat_empleado a
                where 
                a.nomina= ? and id_plaza= ? and tipo=1
               ";
        $query = $this->db->query($sql,array($nomina,$id_user,$nomina,$id_plaza));
        $completo = "NO ESTA EN EL CATALOGO DE EMPLEADOS";
          
      }else{
      $sql = "SELECT concat(trim(pat),' ',trim(mat),' ',trim(nom))as completo FROM catalogo.cat_empleado a
                where 
                a.nomina= ? and tipo=1
               ";
        $query = $this->db->query($sql,array($nomina));
        $completo = "NO ESTA EN EL CATALOGO DE EMPLEADOS";  
      }  
        
        foreach($query->result() as $row){
            $completo = $row->completo;
        }
        
        
        return $completo; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_nomina_bloque_sin($clave,$mes,$quincena)
    {
        
        
        $id_plaza= $this->session->userdata('id_plaza');
        $id_user= $this->session->userdata('id');
       
        $sql = "SELECT b.*, a.*, c.mes,c.dominical,c.festivo,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completoo
        FROM catalogo.cat_empleado a
        left join catalogo.cat_puesto b on b.puesto=a.puestox
        left join catalogo.cat_calendario_nom c on c.mes=$mes and c.quincena=$quincena
        where 
        a.id_user=$id_user and a.contador='NO' and a.tipo=1 and b.bon_pri='S'
        or 
        a.id_plaza=$id_plaza and a.contador='NO' and a.tipo=1 and b.bon_pri='S'
        
        order by completo";
        
        $query = $this->db->query($sql);
       $usu = array();
        $usu[0] = "Seleccion de empleado";
        
        foreach($query->result() as $row){
         if($clave==331 and $row->festivo>0){   
            $usu[$row->id] = $row->completoo;
         }elseif($clave==333 and $row->dominical>0){
            $usu[$row->id] = $row->completoo;
         }   
        
        
        }
        
        
        return $usu;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
   function busca_usuario_nomina_bloque_corte()
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $sql = "SELECT *,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completoo FROM catalogo.cat_empleado
                where tipo=1  order by completo";
        $query = $this->db->query($sql);
       $usu = array();
        $usu[0] = "Seleccion de empleado";
        
        foreach($query->result() as $row){
            $usu[$row->id] = $row->completoo.' - '.$row->nomina;
        }
        
        
        return $usu;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_nomina_bloque_2012()
    {
        $id_plaza= $this->session->userdata('id_plaza');
       
        $sql = "SELECT *,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completoo FROM catalogo.cat_empleado
                where 
                id_plaza= ? and tipo=1  
                order by completo";
        $query = $this->db->query($sql,array($id_plaza));
       $usu = array();
        $usu[0] = "Seleccion de empleado";
        
        foreach($query->result() as $row){
            $usu[$row->id] = $row->nomina." - ".$row->completoo;
        }
        
        
        return $usu;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_usuario_nomina_bloque()
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
       
        $sql = "SELECT id,tipo,nomina,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completo FROM catalogo.cat_empleado
                where 
                id_user= ? and tipo=1  
                or
                id_plaza= ? and tipo=1
                or
                nomina>=99999990
                order by completo";
        $query = $this->db->query($sql,array($id_user,$id_plaza));
       $usu = array();
        $usu[0] = "Seleccion de empleado";
        
        foreach($query->result() as $row){
            $usu[$row->id] = $row->nomina." - ".$row->completo;
        }
        
        
        return $usu;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function fecpre()
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
       
        $sql = "select concat(year(now()),'-',mes,'-',quincena)as fecpre FROM catalogo.cat_calendario_nom  where mes>=month(now('m'))";
        $query = $this->db->query($sql);
       $fec = array();
        $fec[0] = "Seleccion fecha";
        
        foreach($query->result() as $row){
            $fec[$row->fecpre] = $row->fecpre;
        }
        
        
        return $fec;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_almacenes()
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
       
        $sql = "select *from catalogo.cat_almacenes ";
        $query = $this->db->query($sql);
       $alm = array();
        $alm[0] = "Seleccion de un Almacen";
        
        foreach($query->result() as $row){
            $alm[$row->tipo] = $row->nombre;
        }
        
        
        return $alm;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_almacenes_locales()
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
       
        $sql = "select *from catalogo.cat_almacenes_local ";
        $query = $this->db->query($sql);
       $alm = array();
        $alm[0] = "Seleccion de un Almacen";
        
        foreach($query->result() as $row){
            $alm[$row->tipo] = $row->nombre;
        }
        
        
        return $alm;  
    }
/////////////////////////////////////////////////////

    function busca_usuario_nomina_gral()
    {
        $nivel= $this->session->userdata('nivel');
        $id_user= $this->session->userdata('id');
        if($nivel==5){
        $sql = "SELECT *,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completoo FROM catalogo.cat_empleado
                where succ<90000 and tipo=1 order by completo";
        $query = $this->db->query($sql,array($id_user));
       $usu = array();
        $usu[0] = "Seleccion de empleado";
            
        }else{
        $sql = "SELECT *,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completoo FROM catalogo.cat_empleado
                where id_user= ? and tipo=1 order by completo";
        $query = $this->db->query($sql,array($id_user));
       $usu = array();
        $usu[0] = "Seleccion de empleado";
            
        }
        
        foreach($query->result() as $row){
            $usu[$row->id] = $row->completoo;
        }
        
        
        return $usu;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_cia_nom($cia)
    {
      $sql = "SELECT  ciax FROM  catalogo.cat_compa_nomina where cia = ?";
    $query = $this->db->query($sql,array($cia));
    $row= $query->row();
    $ciax=$row->ciax;
     return $ciax; 
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_emple($nomina)
    {
        
        $id_user= $this->session->userdata('id');
        $sql = "SELECT id,nomina,concat(trim(pat),' ',trim(mat),' ',trim(nom))as completo FROM catalogo.cat_empleado where nomina=? ";
        $query = $this->db->query($sql,array($nomina));
        $tabla="";
        foreach($query->result() as $row)
        {
            $tabla.="
            <option value =\"".$row->id."\">".$row->completo."</option>
            ";
        }
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_emple_nomina($nomina,$fec)
    {
        
        $id_user= $this->session->userdata('id');
        $sql = "SELECT id,nomina,completo FROM entrega_nomina_d where aplicado='' and quincena='$fec' and nomina=? ";
        $query = $this->db->query($sql,array($nomina));
        $tabla="";
        foreach($query->result() as $row)
        {
            $tabla.="
            <option value =\"".$row->id."\">".$row->completo."</option>
            ";
        }
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_clave()
    {
        $id_user= $this->session->userdata('id');
        $sql = "SELECT * FROM catalogo.cat_nom_claves
                where tipo=1";
        $query = $this->db->query($sql);
       $cla = array();
        $cla[0] = "Seleccion de concepto";
        
        foreach($query->result() as $row){
            $cla[$row->clave] = $row->nombre;
        }
        
        
        return $cla;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_clave_sin_bon()
    {
        $id_user= $this->session->userdata('id');
        $sql = "SELECT * FROM catalogo.cat_nom_claves
                where tipo=1 and clave<>143";
        $query = $this->db->query($sql);
       $cla = array();
        $cla[0] = "Seleccion de concepto";
        
        foreach($query->result() as $row){
            $cla[$row->clave] = $row->nombre;
        }
        
        
        return $cla;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_clave_una($cla)
    {
        $id_user= $this->session->userdata('id');
        $sql = "SELECT nombre FROM catalogo.cat_nom_claves
                where clave= ? and  tipo=1 ";
       $query = $this->db->query($sql,array($cla));
       $row= $query->row();
       $cla=$row->nombre;
       
     return $cla; 
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_mov_devolucion()
    {
        $sql = "SELECT a.*FROM catalogo.devolucion a  ";
        $query = $this->db->query($sql);
       $mov = array();
        $mov[0] = "Selecciona un movimiento";
        
        foreach($query->result() as $row){
            $mov[$row->num] = $row->nom;
        }
        
        
        return $mov;  
    }
/////////////////////////////////////////////////////
    function busca_mov_devolucion_una($cla)
    {
        $id_user= $this->session->userdata('id');
        $sql = "SELECT nom FROM catalogo.devolucion
                where num= ?";
       $query = $this->db->query($sql,array($cla));
       $row= $query->row();
       $cla=$row->nom;
       
     return $cla; 
     /////////////////////////////////////////////////////

     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_surtidor()
    {
        $sql = "SELECT a.*FROM catalogo.cat_surtidores a  ";
        $query = $this->db->query($sql);
       $sur = array();
        $sur[0] = "Selecciona un surtidor";
        
        foreach($query->result() as $row){
            $sur[$row->id] = $row->nombre;
        }
        
        
        return $sur;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_empacador()
    {
        $sql = "SELECT a.*FROM catalogo.cat_empacadores a  ";
        $query = $this->db->query($sql);
       $emp = array();
        $emp[0] = "Selecciona un empacador";
        
        foreach($query->result() as $row){
            $emp[$row->id] = $row->nombre;
        }
        
        
        return $emp;  
    }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_rentas_unica($id)
    {
        $sql = "SELECT a.*,b.nombre
      FROM catalogo.cat_beneficiario a
      left join catalogo.sucursal b on b.suc=a.suc
      where a.id=$id";
        $query = $this->db->query($sql);
        return $query; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_rentas_arrendador()
    {
        $sql = "SELECT a.*
      FROM catalogo.cat_beneficiario a
      where a.auxi=7003 or a.auxi=7004 or auxi=0 order by nom";
        $query = $this->db->query($sql);
        $arr = array();
        $arr[0] = "Selecciona un Arrendador";
        
        foreach($query->result() as $row){
            $arr[$row->id] = $row->nom;
        }
        
        
        return $arr; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_empleado_id()
    {
     $id_user= $this->session->userdata('id');
      $sql = "SELECT a.*
      FROM catalogo.cat_empleados a
      where a.id_user=$id_user order by pat";
        $query = $this->db->query($sql);
        $emp = array();
        $emp[0] = "Selecciona un Arrendador";
        
        foreach($query->result() as $row){
            $emp[$row->id] = $row->pat." ".$row->mat." ".$nom;
        }
        
        
        return $emp; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_puesto()
    {
        
        $sql = "SELECT *from catalogo.cat_puesto";
        $query = $this->db->query($sql);
        
        $pue = array();
        $pue[0] = "Selecciona el Puesto";
        
        foreach($query->result() as $row){
            $pue[$row->id] = $row->puesto;
        }
        
        return $pue;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_id_causa()
    {
        
        $sql = "SELECT *from catalogo.cat_claves_rh where id>2 ";
        $query = $this->db->query($sql);
        
        $pue = array();
        $pue[0] = "Selecciona el Proceso";
        
        foreach($query->result() as $row){
            $pue[$row->id] = $row->clave;
        }
        
        return $pue;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_motivo_rh()
    {
        $dia=date('d');
        $mes=date('m');
        $time=date('H');
   
        $mot[0] = "Selecciona un Motivo";
        $nivel= $this->session->userdata('nivel');
        $tipo= $this->session->userdata('tipo');
        $s = "SELECT * FROM catalogo.cat_calendario_nom where mes=$mes and $dia between inicio and retencion";
        $q = $this->db->query($s);
        if($q->num_rows()> 0){
        $r= $q->row();
        if($dia==$r->retencion and $time<=5){$final='SI';}else{$final='NO';}
        ////////////////////////////////////////////////////recursos humanos
        if($nivel==33){
        if($dia<=$r->retencion && $tipo <> 4 && $final='SI'){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=3";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }}
        
        if($tipo==4 && $dia>=1 && $dia<=5 || $tipo==4 && $dia>=16 && $dia<=20){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=1";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }}    
        }else{
        if($dia> 0 && $dia <= $r->alta){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where  id < 5";
        $query = $this->db->query($sql);
        }elseif($dia > $r->alta && $dia<=$r->cambaj){
        	
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where  id =2 or id=3 or id=4";     
        $query = $this->db->query($sql);
        
        }elseif($dia > $r->cambaj && $dia>0 && $dia<=$r->retencion && $time>=8 && $time<=17){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where  id =3 ";     
        $query = $this->db->query($sql);
        }
        elseif($dia > $r->cambaj && $dia>0 && $dia<=$r->retencion && $time>17){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where  id=0 ";     
        $query = $this->db->query($sql);
        }
          
        
        $mot[0] = "Selecciona un Motivo";
        
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        
        }
        }
        return $mot; 
 }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_motivo_rha()
    {
        
        $dia=date('d');
        $mes=date('m');
        $dia=3;
        $nivel= $this->session->userdata('nivel');
        
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=1 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        if($dia>=1 and $dia<=5 || $dia>=16 and $dia<=20)
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        
        return $mot; 
     }

    
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_motivo_rh_dias()
    {
        
        $dia=date('d');
        $mes=date('m');
       
        $dia=3;
        $nivel= $this->session->userdata('nivel');
        $tipo= $this->session->userdata('tipo');
        if($tipo==2){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=4 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        }
        if($tipo==4){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=1 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        }
        if($tipo==3){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=1 or id=4 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        }
        if($tipo==5){
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where id=1 or id=4";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        }

        return $mot; 
}    
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_motivo_rh2012()
    {
        
        $dia=date('d');
        $mes=date('m');
        $nivel= $this->session->userdata('nivel');
        
        $sql = "SELECT * FROM catalogo.cat_motivo_rh ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        
        return $mot; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_falta_inca()
    {
        
        $dia=date('d');
        $mes=date('m');
        $nivel= $this->session->userdata('nivel');
        
        $sql = "SELECT * from catalogo.cat_nom_claves where clave=613 or clave=644";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Movimiento";
        foreach($query->result() as $row){
            $mot[$row->clave] = $row->nombre;
        }
        
        return $mot; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function empleado_sup()
    {
$num=1;        
        $nivel= $this->session->userdata('nivel');
        $plaza= $this->session->userdata('plaza');
        $sql = "SELECT a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where a.tipo=1 and b.superv=$plaza
order by a.pat";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo;
        }
        
        return $nom; 
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function empleado_sup_rh()
    {
$num=1;        
        $nivel= $this->session->userdata('nivel');
        $plaza= $this->session->userdata('plaza');
        $sql = "SELECT a.*
FROM catalogo.cat_empleado a
where a.tipo=1 and a.id_plaza=999
order by a.completo";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo;
        }
        
        return $nom; 
     }

////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function empleado_sup_dia_festivo($id_mov,$quincena,$mes)
    {
$num=1;        
        $nivel= $this->session->userdata('nivel');
        $plaza= $this->session->userdata('plaza');
        $suc= $this->session->userdata('suc');
        
if($quincena==15){$dia=01;}else{$dia=16;}
if($id_mov<>7 and $nivel<>3){
        $sql = "SELECT a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where a.tipo=1 and b.superv=$plaza or a.suc=$suc
order by a.pat";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo;
}}
if($id_mov=3){
        $sql = "SELECT a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where a.tipo=1 and b.superv=$plaza 
order by a.succ";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo." - ".$row->succ;
}}
if($id_mov==7){
        $sql = "SELECT c.festivo,a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
LEFT JOIN catalogo.cat_calendario_nom c on c.mes=$mes
where a.tipo=1 and b.superv=$plaza and c.inicio=$dia and c.festivo>0
order by a.pat
";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo;
}}        
        return $nom; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function empleado_encargado($id_mov,$quincena,$mes)
    {
$num=1;        
        $nivel= $this->session->userdata('nivel');
        $plaza= $this->session->userdata('plaza');
        $suc= $this->session->userdata('username');
        
if($quincena==15){$dia=01;}else{$dia=16;}
if($id_mov<>7){
        $sql = "SELECT a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
left join catalogo.cat_puesto c on c.puesto=a.puestox
where a.tipo=1 and a.succ=$suc and c.bon_pri='S'
order by a.pat";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo;
}}
if($id_mov==7){
        $sql = "SELECT c.festivo,a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
LEFT JOIN catalogo.cat_calendario_nom c on c.mes=$mes
where a.tipo=1 and a.succ=$suc and c.inicio=$dia and c.festivo>0
order by a.pat
";

        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->completo;
}}        
        return $nom; 
     }


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function empleado_ger()
    {
$num=1;        
        $nivel= $this->session->userdata('nivel');
        $plaza= $this->session->userdata('plaza');
        $sql = "SELECT a.*
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where a.tipo=1 and b.regional=$plaza
order by a.pat";
        $query = $this->db->query($sql);
        $nom = array();
        $nom[0] = "Seleccione Empleado";
        foreach($query->result() as $row){
            $nom[$row->id] = $row->succ.' '.$row->completo;
        }
        
        return $nom; 
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_mov_super()
    {
$d=date('d');
$mes=date('m');

if($d>15){$x=16;}else{$x=1;}
$suc= $this->session->userdata('suc');
$s="SELECT * FROM catalogo.cat_calendario_nom where inicio=$x and mes=$mes";
$q = $this->db->query($s);
$r= $q->row();
$inicio=$r->inicio;
$cambaj=$r->cambaj;
$retencion=$r->retencion;
$alta=$r->alta;

if($d>=$cambaj and $d<=$retencion){$var="'1','2','8' ";}
if($d>=$inicio and $d<=$cambaj){$var="'1','2','3','8'";}
if($d>$retencion){$var="'1','2'";}
if($suc==90009){

$sql = "SELECT * FROM catalogo.cat_mov_super where id in($var)";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
        }    

}
/////////////////////////////////////////////////////////////////
if($suc==999){
$sql = "SELECT * FROM catalogo.cat_mov_super where id=5 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;    
}}

if($suc<>999 and $suc<>90009){
            $sql = "SELECT * FROM catalogo.cat_mov_super where id<4 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
}}
        
        return $mot; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_mov_falta()
    {
$suc= $this->session->userdata('suc');
        $sql = "SELECT * FROM catalogo.cat_mov_super where id=1";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
      }  
        
        return $mot; 
     }

/////////////////////////////////////////////////////

/////////////////////////////////////////////////////    
    function busca_mov_super_ger_cambio()
    {
$suc= $this->session->userdata('suc');       
        $sql = "SELECT * FROM catalogo.cat_mov_super where id=3";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
        
        return $mot; 
     }
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_causa($cau)
    {
        
        $sql = "SELECT * FROM catalogo.cat_observa where motivo='$cau' ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->obserx] = $row->obserx;
        }
        
        return $mot; 
     }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_mov_super_rh()
    {
        
        $sql = "SELECT * FROM catalogo.cat_mov_super where id>1 and id<4 or id=8 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
        }
        
        return $mot; 
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_mov_super_ger()
    {
        
        $sql = "SELECT * FROM catalogo.cat_mov_super where id>0 and id<>4 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
        }
        
        return $mot; 
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function busca_alta_baja_ger()
    {
        
        $sql = "SELECT * FROM catalogo.cat_motivo_rh where motivo='ALTA' or motivo='BAJA' or motivo='RETENCION' ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->motivo] = $row->motivo;
        }
        
        return $mot; 
     }

/////////////////////////////////////////////////////
    function busca_mov_super_cap()
    {
        
        $sql = "SELECT * FROM catalogo.cat_mov_super where id<>4 ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona un Motivo";
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
        }
        
        return $mot; 
     }
/////////////////////////////////////////////////////
    function busca_mov_encargado_cap()
    {
$d=date('D');
$fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

$fecha1 = date('Y-m-d');
$nuevafecha1 = strtotime ( '-1 day' , strtotime ( $fecha1 ) ) ;
$nuevafecha1 = date ( 'Y-m-d' , $nuevafecha1 );

$fecha2 = date('Y-m-d');
$nuevafecha2 = strtotime ( '-2 day' , strtotime ( $fecha2 ) ) ;
$nuevafecha2 = date ( 'Y-m-d' , $nuevafecha2 ); 

$fecha3 = date('Y-m-d');
$nuevafecha3 = strtotime ( '-3 day' , strtotime ( $fecha3 ) ) ;
$nuevafecha3 = date ( 'Y-m-d' , $nuevafecha3 ); 

$fecha4 = date('Y-m-d');
$nuevafecha4 = strtotime ( '-4 day' , strtotime ( $fecha4 ) ) ;
$nuevafecha4 = date ( 'Y-m-d' , $nuevafecha4 ); 

$fecha5 = date('Y-m-d');
$nuevafecha5 = strtotime ( '-5 day' , strtotime ( $fecha5 ) ) ;
$nuevafecha5 = date ( 'Y-m-d' , $nuevafecha5 ); 

$fecha5 = date('Y-m-d');
$nuevafecha5 = strtotime ( '-5 day' , strtotime ( $fecha5 ) ) ;
$nuevafecha5 = date ( 'Y-m-d' , $nuevafecha5 ); 

$fechax = date('Y-m-d');
$nuevafechaxx = strtotime ( '-7 day' , strtotime ( $fechax ) ) ;
$nuevafechaxx = date ( 'Y-m-d' , $nuevafechaxx ); 

             
$sql = "SELECT a.*,b.farmacia
FROM catalogo.cat_mov_super a,  catalogo.cat_festivo b
where  a.id=7 and farmacia>='$nuevafechaxx' and farmacia<='$fecha' ";

        $query = $this->db->query($sql);
        $mot = array();
if($d=='Mon'){
$mot['6'.$nuevafecha1] = "PRIMA DOMINICAL ".$nuevafecha1;    
}elseif($d=='Tue'){
$mot['6'.$nuevafecha2] = "PRIMA DOMINICAL ".$nuevafecha2;
}elseif($d=='Wed'){
$mot['6'.$nuevafecha3] = "PRIMA DOMINICAL ".$nuevafecha3;
}elseif($d=='Thu'){
$mot['6'.$nuevafecha4] = "PRIMA DOMINICAL ".$nuevafecha4;
}elseif($d=='Fri'){
$mot['6'.$nuevafecha5] = "PRIMA DOMINICAL ".$nuevafecha5;
}else{
$mot[0] = "Seleccione Movimiento";    
}
        
        foreach($query->result() as $row){
            $mot[$row->id.$row->farmacia] = $row->nombre." ".$row->farmacia;
        }
     return $mot;   
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_mov_encargado_cap_his()
    {

             
$sql = "SELECT a.*
FROM catalogo.cat_mov_super a
where  a.id=6 or a.id=7";

        $query = $this->db->query($sql);
        $mot = array();

$mot[0] = "Seleccione Movimiento";    
        foreach($query->result() as $row){
            $mot[$row->id] = $row->nombre;
        }
     return $mot;   
     }
/////////////////////////////////////////////////////

    function busca_observa()
    {
        
        $sql = "SELECT * FROM catalogo.cat_observa ";
        $query = $this->db->query($sql);
        $mot = array();
        $mot[0] = "Selecciona una Observacion";
        foreach($query->result() as $row){
            $mot[$row->obserx] = $row->obserx;
        }
        
        return $mot; 
     }


/////////////////////////////////////////////////////

function busca_empleados($nomina)
	{
		$sql = "SELECT id,nomina,completo, puestox FROM catalogo.cat_empleado where nomina= $nomina and tipo=1";
  
        $query = $this->db->query($sql);
        
         if($query->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<option value=\"-\">Selecciona un Nombre</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->id."\">".$row->completo." - $row->puestox </option>
            ";
        }
        }
        
        return $tabla;
	}

function busca_empleados_nom($nom,$pat,$mat)
	{
		$sql = "SELECT a.*,
        (select nombre from catalogo.sucursal b where b.suc=a.succ and suc>100)as sucx
         FROM catalogo.cat_empleado a 
		 left join catalogo.cat_puesto b on b.puesto=a.puestox
		 where nom like '%$nom%' and pat like '%$pat%' and mat like '%$mat%' and b.bon_pri='S'
         order by tipo";
        $query = $this->db->query($sql);
         if($query->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<table>
        <tr>
        <th>NOMBRE</th>
        <th>PUESTO</th>
        <th>SUCURSAL</th>
        <th>DETALLE</th>
        </tr>
        ";
         foreach($query->result() as $row)
        {
          
        if($row->tipo==1){$color='black';
            }else{
            $l1 = ' ';    
            $color='red';}    
       $l1 = anchor('catalogo_ger/busqueda_emp_una/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
            $tabla.="
        <tr>
        <td><font color=\"$color\">".$row->nomina." ".trim($row->nom)." ".trim($row->pat)." ".trim($row->mat)."</font></td>
        <td><font color=\"$color\">".$row->puestox."</font></td>
        <td><font color=\"$color\">".$row->succ." ".$row->sucx."</font></td>
        <td><font color=\"$color\">".$l1."</font></td>
        </tr>
            ";
        }
        }
        
        return $tabla;
	}

////////////////////////////////////////////////////
    function busca_nomina_emp($nomina)
    {
        $sql = "SELECT a.* FROM catalogo.cat_empleado a where tipo=1 and nomina= ? and cia=13";
        $query = $this->db->query($sql,array($nomina));
         return $query;  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function busca_empleados_nom_rh($nom,$pat,$mat)
	{
		$sql = "SELECT a.*,
        (select nombre from catalogo.sucursal b where b.suc=a.succ and suc>100)as sucx
         FROM catalogo.cat_empleado a 
		 left join catalogo.cat_puesto b on b.puesto=a.puestox
		 where nom like '%$nom%' and pat like '%$pat%' and mat like '%$mat%' 
         order by tipo";
        $query = $this->db->query($sql);
         if($query->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<table>
        <tr>
        <th>NOMBRE</th>
        <th>PUESTO</th>
        <th>SUCURSAL</th>
        <th>DETALLE</th>
        </tr>
        ";
         foreach($query->result() as $row)
        {
          
        if($row->tipo==1){$color='black';
            }else{
            $l1 = ' ';    
            $color='red';}    
       $l1 = anchor('recursos_humanos/busqueda_emp_una_rh/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
            $tabla.="
        <tr>
        <td><font color=\"$color\">".$row->nomina." ".trim($row->nom)." ".trim($row->pat)." ".trim($row->mat)."</font></td>
        <td><font color=\"$color\">".$row->puestox."</font></td>
        <td><font color=\"$color\">".$row->succ." ".$row->sucx."</font></td>
        <td><font color=\"$color\">".$l1."</font></td>
        </tr>
            ";
        }
        }
        
        return $tabla;
	}

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////


    function busca_plaza_ger()
    {
        $sql = "SELECT * FROM catalogo.gerente";
        $query = $this->db->query($sql);
        $pla = array();
        $pla[0] = "Selecciona Region";
        
        foreach($query->result() as $row){
            $pla[$row->ger] = $row->nombre;
        }
        
        
        return $pla; 
     }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_plaza_sup()
    {
        $sql = "SELECT * FROM catalogo.supervisor ";
        $query = $this->db->query($sql);
        $pla = array();
        $pla[0] = "Selecciona Zona";
        
        foreach($query->result() as $row){
            $pla[$row->zona] = $row->zona;
        }
        
        
        return $pla; 
     }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function plantilla()
    {
        
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
        
        $this->db->select('a.nomina, a.pat,a.mat,a.nom, a.succ, a.puestox, b.nombre');
        $this->db->from('catalogo.cat_empleado a');
        $this->db->join('catalogo.sucursal b', 'b.suc=a.succ', 'LEFT');
        $this->db->where('a.tipo', 1);
        $this->db->where('a.id_plaza', $id_plaza);
        $this->db->order_by('a.succ');
        $this->db->order_by('a.puestox');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <table>
        <thead>
        
        <tr>
        <th>#</th>
        <th>NOMBRE</th>
        <th>NOMINA</th>
        <th>SUCURSAL</th>
        <th>PUESTO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
       $n = 1;
        foreach($query->result() as $row)
       
       {
           
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$n."</td>
            <td align=\"left\">".$row->pat." ".$row->mat." ".$row->nom."</td>
            <td align=\"right\">".$row->nomina."</td>
            <td align=\"left\">".$row->succ." ".$row->nombre."</td>
            <td align=\"left\">".$row->puestox."</td>
            </tr>
            ";
         $n++;
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
        
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function plantilla1($plaza1, $suc)
    {
        
        
        $nivel= $this->session->userdata('nivel');
        if($suc==0){
        $this->db->select('a.nomina, a.pat,a.mat,a.nom, a.succ, a.puestox, b.nombre');
        $this->db->from('catalogo.cat_empleado a');
        $this->db->join('catalogo.sucursal b', 'b.suc=a.succ', 'LEFT');
        $this->db->where('a.tipo', 1);
        $this->db->where('a.id_plaza', $plaza1);
        $this->db->order_by('a.succ');
        $this->db->order_by('a.puestox');
        $query = $this->db->get();    
        }else{
        $this->db->select('a.nomina, a.pat,a.mat,a.nom, a.succ, a.puestox, b.nombre');
        $this->db->from('catalogo.cat_empleado a');
        $this->db->join('catalogo.sucursal b', 'b.suc=a.succ', 'LEFT');
        $this->db->where('a.tipo', 1);
        $this->db->where('a.id_plaza', $plaza1);
        $this->db->where('a.succ', $suc);
        $this->db->order_by('a.succ');
        $this->db->order_by('a.puestox');
        $query = $this->db->get();
        //echo $this->db->last_query();
        }

        $tabla = "
        <table>
        <thead>
        
        <tr>
        <th>#</th>
        <th>NOMBRE</th>
        <th>NOMINA</th>
        <th>SUCURSAL</th>
        <th>PUESTO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
       $n = 1;
        foreach($query->result() as $row)
       
       {
           
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$n."</td>
            <td align=\"left\">".trim($row->pat)." ".trim($row->mat)." ".trim($row->nom)."</td>
            <td align=\"right\">".$row->nomina."</td>
            <td align=\"left\">".$row->succ." ".$row->nombre."</td>
            <td align=\"left\">".$row->puestox."</td>
            </tr>
            ";
         $n++;
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
        
    }

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////  
    function busca_empleado()
    {
        
        $sql = "SELECT * from catalogo.cat_empleado where tipo=1 and nomina > 0 order by pat, mat";
        $query = $this->db->query($sql);
        
        $empleado = array();
        $empleado['0'] = "Selecciona un empleado";
        
        foreach($query->result() as $row){
            $empleado[$row->id] = $row->completo;
        }
        
        return $empleado;  
    }



    function datos_empleado($id)
    {
        
        $s = "SELECT a.*, b.nombre as sucursal, c.plazax, d.nombre as contador, e.nombre as supervisor FROM catalogo.cat_empleado a
                left join catalogo.sucursal b on a.succ=b.suc
                left join catalogo.cat_plaza c on a.id_plaza=c.id_plaza
                left join desarrollo.usuarios d on a.id_plaza=d.id_plaza
                left join desarrollo.usuarios e on a.id_plaza=e.plaza
                where a.id=$id and d.responsable='r';";
        $query = $this->db->query($s);
        
       $tabla = "<table>
        <tr>
        <th>NOMBRE</th>
        <th>PUESTO</th>
        <th>SUCURSAL</th>
        <th>PLAZA</th>
        <th>CONTADOR</th>
        <th>SUPERVISOR</th>
        
        </tr>
        ";
         foreach($query->result() as $row)
        {
          
        
            $tabla.="
        <tr>
        <td>".$row->nomina." ".trim($row->nom)." ".trim($row->pat)." ".trim($row->mat)."</td>
        <td>".$row->puestox."</td>
        <td>".$row->succ." ".$row->sucursal."</td>
        <td>".$row->plazax."</td>
        <td>".$row->contador."</td>
        <td>".$row->supervisor."</td>
        </tr>
            ";
             }
            $tabla.= "
    </tbody>
    </table>";
      
        return $tabla;
	
        
        
    }

    
    function datos_empleado1($id)
    {
        
        $s = "SELECT a.*, f.fal, c.nombre, f.fecha, d.nombre as aplico, f.fecpre FROM catalogo.cat_empleado a
                left join desarrollo.faltante f on a.nomina=f.nomina and a.cia=f.cianom
                left join catalogo.cat_nom_claves c on f.clave=c.clave
                left join desarrollo.usuarios d on f.id_user=d.id
                where a.id=$id";
        $query = $this->db->query($s);
        
       $tabla = "<table>
        <tr>
        <th>FALTANTE</th>
        <th>FECHA</th>
        <th>RESPONSABLE</th>
        <th>FECHA PRENOMINA</th>
        </tr>
        ";
         foreach($query->result() as $row)
        {
          
       
            $tabla.="
        <tr>
        <td>".$row->fal." ".$row->nombre."</td>
        <td>".$row->fecha."</td>
        <td>".$row->aplico."</td>
        <td>".$row->fecpre."</td>
        </tr>
            ";
             }
            $tabla.= "
    </tbody>
    </table>";
      
        return $tabla;
	
        
        
    }

    function busca_dia_surtido()
    {
        
        $sql = "select dia from catalogo.sucursal c left join catalogo.almacen_rutas a on c.suc=a.suc where c.suc>100 and c.suc<1605 and tlid=1  and cia=13 and tipo2 <> 'f' group by ruta order by ruta";
        $query = $this->db->query($sql);
        
        $diax = array();
        $diax[0] = "Selecciona un dia";
        
        foreach($query->result() as $row){
            $diax[$row->dia] = $row->dia;
        }
        
        return $diax;  
    }
    
     function datos_pedidos_dia($id)
    {
        
        $s = "SELECT * FROM sucursal s where dia=$dia and tlid=1;";
        $query = $this->db->query($s);
        
       $tabla = "<table>
        <tr>
        <th>Nº Suc</th>
        <th>Direccion</th>
        <th>Colonia</th>
        <th>Poblacion</th>
        <th>C.P.</th>
        </tr>
        ";
         foreach($query->result() as $row)
        {
          
       
            $tabla.="
        <tr>
        <td>".$row->suc." ".$row->nombre."</td>
        <td>".$row->dire."</td>
        <td>".$row->col."</td>
        <td>".$row->pobla."</td>
        <td>".$row->cp."</td>
        </tr>
            ";
             }
            $tabla.= "
    </tbody>
    </table>";
      
        return $tabla;
	
        
        
    }
    
    
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_almacen_clasi($cla)
    {
       $sql = "SELECT count(*)as clasi FROM catalogo.cat_almacen_clasifica where tipo in ($cla)";
    $query = $this->db->query($sql);
    $row= $query->row();
    $clasi=$row->clasi;
     return $clasi; 
    }
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_almacen_clasi_sec($sec)
    {
       $sql = "SELECT susa FROM catalogo.cat_almacen_clasifica where sec=$sec";
        $query = $this->db->query($sql);
    $row= $query->row();
    $susa=$row->susa;
     return $susa; 
    }
 /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_suc_generica()
    {
        
       $sql = "SELECT count(*)as num FROM catalogo.sucursal
where
   tlid=1 and suc>100 and suc<=1600 and tipo2<>'F' and suc<>176 and suc<>177 and suc<>178 and suc<>179 and suc<>180 and suc<>1286 and dia='LUN'
or tlid=1 and suc>100 and suc<=1600 and tipo2<>'F' and suc<>176 and suc<>177 and suc<>178 and suc<>179 and suc<>180 and suc<>1286 and dia='MAR'
or tlid=1 and suc>100 and suc<=1600 and tipo2<>'F' and suc<>176 and suc<>177 and suc<>178 and suc<>179 and suc<>180 and suc<>1286 and dia='MIE'
or tlid=1 and suc>100 and suc<=1600 and tipo2<>'F' and suc<>176 and suc<>177 and suc<>178 and suc<>179 and suc<>180 and suc<>1286 and dia='JUE'
or tlid=1 and suc>100 and suc<=1600 and tipo2<>'F' and suc<>176 and suc<>177 and suc<>178 and suc<>179 and suc<>180 and suc<>1286 and dia='VIE'
or tlid=1 and suc>100 and suc<=1600 and tipo2<>'F' and suc<>176 and suc<>177 and suc<>178 and suc<>179 and suc<>180 and suc<>1286 and dia='PEN'
order by dia";
    $query = $this->db->query($sql);
    $row= $query->row();
    $num=$row->num;
     return $num; 
 
    }
 /////////////////////////////////////////////////////
///////////////////////////////////////////////////// agragar tarjeta
function busca_sucursal_tar()
    {
        
        $sql = "SELECT suc,nombre FROM  catalogo.sucursal 
        where tlid=1 and suc>100 and suc<1600 
        ";
        $query = $this->db->query($sql);
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->suc." - ".$row->nombre;
        }
        
        
        return $suc;  
    }

function guardar_tarjeta()
    {
            
        $data = array(
           'suc' => $this->input->post('sucursal'),
           'fol1' => $this->input->post('inicial'),
           'fol2' => $this->input->post('final')
      
        );
     $this->db->insert('vtadc.tarjetas_suc', $data);
     return $this->db->insert_id();

}

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_depto($id_captura)
    {
        
        $sql = "select b.nombre from  oficinas.actividad a left join catalogo.sucursal b on b.suc=a.depto where  a.id_captura=$id_captura group by id_captura";
        $query = $this->db->query($sql);
       $row= $query->row();
       $deptox=$row->nombre;
     return $deptox; 
    }
//////////////////////////////////////////////////////////////////////////////////////////

    function targetas_validar()
    {
        $nivel = $this->session->userdata('nivel');
        
        
        $s = "SELECT a.*, b.nombre FROM vtadc.tarjetas_suc a
            left join catalogo.sucursal b on a.suc=b.suc
            where tipo=0 order by suc;";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>FOLIO INICIAL</th>
        <th>FOLIO FINAL</th>
        ";

        if($nivel == 10){
            
        $tabla.= "
        <th>Validar</th>
        <th>Eliminar</th>
        ";
            }
        
        $tabla.= "
        
        </tr>
        </thead>";
        
        $num=0;
        foreach($q->result() as $r)
        {
	   if($r->tipo==0){$color='red';}else{$color='black';}
	   $num=$num+1;
       $l= anchor('ventas/validar/'.$r->id, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'));
       $l1 = anchor('ventas/eliminar/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para eliminar', 'class' => 'encabezado'));
       //$l1 = anchor('supervisor/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           //id, tipo, cel, equipo, nomina, cia, act
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->suc." ".$r->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->fol1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->fol2."</font></td> 
            ";
    
    if($nivel == 10){
            
        $tabla.= "
        <td align=\"center\">".$l."</td> 
        <td align=\"center\">".$l1."</td>
        ";
            }
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
return $tabla;

}

function validar_targeta($id)
    {
        $sql="update vtadc.tarjetas_suc set tipo=1 where tipo=0";
        $query = $this->db->query($sql);
        
    }
    
    function eliminar_targeta($id)
    {
        $this->db->delete('vtadc.tarjetas_suc',  array('id' => $id));
    }


}
