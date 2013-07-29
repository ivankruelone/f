<?php
class Prenomina_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        
    }
    
 
    function mostrar_periodo()
    {
        
       $aaa= date('Y');
       $mes= date('m')-1;
       $fec= $aaa.'-'.$mes;
         $id_user= $this->session->userdata('id');
         $sql = "SELECT cianom,a.nomina,cortes,a.id_user,sum(fal) as fal,b.completo  
         from faltante a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina and b.cia=a.cianom
         where a.id_user=? group by nomina";
       
        $query = $this->db->query($sql,array($id_user));
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>Cia</th>
        <th>Nomina</th>
        <th>Nombre</th>    
        <th>Editar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
        $l1 = anchor('cheques/imprimir_cheque/'.$row->nomina, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));    
        $tabla.= "
        <tr>
            <td align=\"left\">".$row->cia."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"left\">".$row->fal."</td>
            <td align=\"left\">".$l1."</td>
           
           </tr> ";
        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function muestra_clave($cla,$fec)
    {
       $id_user= $this->session->userdata('id');
       $id_plaza= $this->session->userdata('id_plaza');
       
         $sql = "SELECT a.fecha,a.observacion, a.succ, a.tipo,d.nombre as sucx,a.suc,cianom,c.ciax,a.id, a.cianom,a.nomina,a.id_user,fal,b.completo  
         from faltante a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina  and b.cia=a.cianom
         left join catalogo.cat_compa_nomina c on c.cia=a.cianom
         left join catalogo.sucursal d on d.suc=a.succ
         where 
         a.id_user=? and a.clave= ? and turno=0  and  fecha='$fec' 
         or  
         a.id_user=? and a.clave= ? and turno=0  and  fecpre='$fec' 
         or  
         a.id_plaza=? and a.clave= ? and turno=0  and  fecha='$fec'
         or  
         a.id_plaza=? and a.clave= ? and turno=0  and  fecpre='$fec' 
         order by nomina,fecha";
      
        $query = $this->db->query($sql,array($id_user,$cla,$id_user,$cla,$id_plaza,$cla,$id_plaza,$cla));
       
        $tabla ="<table>
        <thead>
        <tr>
        <th>Cia</th>
        <th>Sucursal</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>$ o Dias</th>     
        <th>Eliminar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
           $tipo=$row->tipo; 
         if($tipo==1){
       $l1 = anchor('prenomina/borrar_clave/'.$row->id.'/'.$cla, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));     
         }else{
            $l1='';
         }   
            
        $tabla.= "
        <tr>
            <td align=\"left\">".$row->cianom." -".$row->ciax."</td>
            <td align=\"left\">".$row->succ." -".$row->sucx."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"left\">".$row->fal."</td>
            <td align=\"left\">".$l1."</td>
         </tr>
         <tr>
            <td align=\"left\" colspan=\"5\"><font color=\"blue\">".$row->fecha." - ".$row->observacion."</font></td>
          </tr> ";
        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function agrega_member($importe,$id_emp,$cla,$fec,$folioi,$fechai)
{
$mee=substr($fec,5,2);
$quin=substr($fec,8,2);


if($quin==15){$dd=1;}else{$dd=16;}

$si=0;
$id_user= $this->session->userdata('id');
$id_plaza= $this->session->userdata('id_plaza');
if($id_user > 0){
if($folioi==null){$folioi='';}
if($fechai==null){$fechai='0000-00-00';}
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  id=$id_emp";
 
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 }else{$cianom=0;$plazanom=0;}
 $sqlz0 = "SELECT * FROM catalogo.cat_nom_claves  where  clave=$cla";
 $queryz0 = $this->db->query($sqlz0);
 if($queryz0->num_rows()> 0){
 $rowz0= $queryz0->row();
 $max=$rowz0->tope;
if($importe<= $max){

 $s = "SELECT a.* FROM desarrollo.faltante a where  nomina=$nomina and cianom=$cianom and fecha='$fec' and clave=$cla";
 
 $q = $this->db->query($s);
 if($cla==331){
 $s10 = "SELECT a.* FROM catalogo.cat_calendario_nom a where mes=$mee and inicio=$dd and festivo>=$importe";
 $q10 = $this->db->query($s10);
 if($q10->num_rows() > 0){
 $si=1;}}
 if($cla==333){
 $s10 = "SELECT a.* FROM catalogo.cat_calendario_nom a where mes=$mee and inicio=$dd and dominical>=$importe";
 $q10 = $this->db->query($s10);
 if($q10->num_rows() > 0){
 $si=1;}}

  if($cla<>333 and $cla<>331){
    $si=1;}
  if($q->num_rows() == 0 && $id_user > 0 && $si==1){
$dataz= array(
            'fecha'   =>$fec,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$importe,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$rowz2->succ,
            'suc'     =>$rowz2->suc,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plazanom,
            'clave'  =>$cla,
            'folioi'  =>$folioi,
            'fechai'  =>$fechai,
            'cianom' =>$cianom,
            'id_plaza' =>$id_plaza
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
}else{
$si=0;   
$r= $q->row();
$id_falta=$r->id;
$imp_fal=$r->fal+$importe;
if($cla==333 and $quin == 15){
 $s10 = "SELECT a.* FROM catalogo.mes a where num=$mee and prima1>=$imp_fal";
 $q10 = $this->db->query($s10);
 if($q10->num_rows() > 0){
 $si=1;}}
 if($cla==333 and $quin > 15){
 $s10 = "SELECT a.* FROM catalogo.mes a where num=$mee and prima2>=$imp_fal";
 $q10 = $this->db->query($s10);
 if($q10->num_rows() > 0){
 $si=1;}}
  if($cla<>333 and $cla<>645){
    $si=1;}
if($max >= $imp_fal && $si==1){
$data = array(
			'fal'=> $imp_fal,
            'tipo'=> 1,
  			'fecpre'=> '0000-00-00'
		);
		
		$this->db->where('id', $id_falta);
        $this->db->update('faltante', $data);    
}}


}
}

}//el userid > 0
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function delete_member($id)
{
        $this->db->delete('desarrollo.faltante', array('id' => $id));
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function fal_no()
    {
        
       $aaa= date('Y');
       $mes= date('m')-1;
       $fec= $aaa.'-'.$mes;
       $id_user= $this->session->userdata('id');
       
         $sql = "SELECT a.fecha,d.nombre as sucx,a.suc,cianom,c.ciax,a.id, a.cianom,a.nomina,a.id_user,fal,b.completo  
         from faltante a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina  and b.cia=a.cianom
         left join catalogo.cat_compa_nomina c on c.cia=a.cianom
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user=? and a.clave= 520  and a.tipo=1";
       
        $query = $this->db->query($sql,array($id_user));
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>Cia</th>
        <th>Fecha</th>
        <th>Sucursal</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>$ o Dias</th>     
        <th>Editar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
        $l1 = anchor('prenomina/valida_fal/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));    
        $tabla.= "
        <tr>
            <td align=\"left\">".$row->cianom." -".$row->ciax."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$row->suc." -".$row->sucx."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"left\">".$row->fal."</td>
            <td align=\"left\">".$l1."</td>
           
           </tr> ";
        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function valida_member_fal($id)
    {
$id_user= $this->session->userdata('id');
$data = array(
			'tipo' => 2,
            'id_user' => $id_user
		);
		
		$this->db->where('id', $id);
        $this->db->where('tipo', '1');
        $this->db->update('faltante', $data);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function faltante_sin_val_conta()
    {
$id_plaza= $this->session->userdata('id_plaza');
         $sx = "SELECT sum(fal)as importe from fal_c a where fecha>='2013-01-01' and  tipo=1 and id_plaza=$id_plaza  and clave=520   
          group by id_plaza";
        $qx = $this->db->query($sx);
        
        //echo $this->db->last_query();
        
        $tabla ="<table border=\"1\">
        <thead>
        </thead>";
        
        foreach($qx->result() as $rx)
        {
        $tabla.= "
        <tr>
            <td align=\"left\"  colspan=\"3\"><font color=\"red\" size=\"3\"><strong>IMPORTE QUE SE COBRAR&Aacute; AL CONTADOR POR NO VALIDAR FALTANTES DE CAJA</font></strong></td>
           <td align=\"left\"></td>
           </tr>
        <tr>
            <td align=\"left\" colspan=\"3\"><font color=\"red\"  size=\"3\"><strong>".$this->session->userdata('nombre')." $ ".number_format($rx->importe,2)."</font></strong></td>
            <td align=\"left\"></td>
           </tr>";
        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function fal_valida($quinc,$mesu,$aaau,$diau,$meu,$fechavalida)
    {
$id_user= $this->session->userdata('id');
$id_plaza= $this->session->userdata('id_plaza');
 $fec=str_pad($aaau,4,0,STR_PAD_LEFT).'-'.str_pad($meu,2,0,STR_PAD_LEFT).'-'.str_pad($quinc,2,0,STR_PAD_LEFT);
       
         $sx = "SELECT a.fecha,a.suc,a.id, a.cianom,a.nomina,a.id_user,fal,b.completo, a.clave
         from faltante a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina  and b.cia=a.cianom
         where 
         a.id_user= ? and b.tipo = 1 and a.tipo=2 and a.fecpre= ?  
         or 
         a.id_user= ? and b.tipo = 1 and a.tipo=1 and a.fecpre= '0000-00-00'
         or
         a.id_plaza= ? and b.tipo = 1 and a.tipo=2 and a.fecpre= ? 
         or 
         a.id_plaza= ? and b.tipo = 1 and a.tipo=1 and a.fecpre= '0000-00-00'
         
          group by nomina";
       
        $qx = $this->db->query($sx,array($id_user,$fec,$id_user,$id_plaza,$fec,$id_plaza));
        
        //echo $this->db->last_query();
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>Nomina</th>
        <th colspan=\"3\">Nombre</th>
        <th colspan=\"1\">Fecha de Captura </th>
        <th>Val.</th>
        </tr>
        </thead>";
        
        foreach($qx->result() as $rx)
        {
        $nom=$rx->nomina;    
$sql = "SELECT a.id_plaza,a.fecha,a.fecpre,a.tipo, d.nombre as sucx,a.suc,cianom,c.ciax,a.id, a.cianom,a.nomina,a.id_user,fal,b.completo, a.clave,e.nombre as clavex  
         from faltante a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina  and b.cia=a.cianom
         left join catalogo.cat_compa_nomina c on c.cia=a.cianom
         left join catalogo.sucursal d on d.suc=a.suc
         left join catalogo.cat_nom_claves e on e.clave=a.clave
          where 
          a.id_user=$id_user and  a.fecpre= '$fec' and a.nomina= $nom and a.tipo=2
          or 
          a.id_user=$id_user  and fecpre='0000-00-00' and a.nomina= $nom and a.tipo=1
          or
          a.id_plaza=$id_plaza and  a.fecpre= '$fec' and a.nomina= $nom and a.tipo=2
          or 
          a.id_plaza=$id_plaza  and fecpre='0000-00-00' and a.nomina= $nom and a.tipo=1
          ";
          
        $query = $this->db->query($sql);
        
        $tabla.= "
        <tr>
            <td align=\"left\"><strong>".$rx->nomina."</strong></td>
            <td align=\"left\" colspan=\"3\"><strong>".$rx->completo."</strong></td>
            <td align=\"left\"></td>
           </tr>";
foreach($query->result() as $row)
        {
         if($row->tipo==1){
                 $l1 = anchor('prenomina/valida_clave/'.$row->id.'/'.$aaau.'/'.$mesu.'/'.$quinc.'/'.$fechavalida, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
                 }else{
                 $l1 ='';   
                 }   
         $tabla.= "
           <tr>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"left\">".$row->clave." -".$row->clavex."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$l1."</td>
            
           </tr> ";
        }    
        

        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function valida_member_clave($id,$aaa,$mes,$dia,$fechavalida)
    {

$id_user= $this->session->userdata('id');
if($fechavalida>'0000-00-00' and $id_user>0){
$data = array(
			'tipo'   => 2,
            'fechacaptura' => date('Y-m-d H:i:s'),
            'fecpre' => $fechavalida
		);
		
		$this->db->where('id', $id);
        $this->db->where('tipo', '1');
        $this->db->update('faltante', $data);
    
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_poliza_bloque($fec)
    {
       
       
       $id_user= $this->session->userdata('id');
       $id_plaza= $this->session->userdata('id_plaza');
         $sx = "SELECT a.fecpre,a.id_user,a.cianom,b.ciax
         from faltante a 
         left join catalogo.cat_compa_nomina b on b.cia=a.cianom
         where  a.fecpre = ? and id_plaza= ? and a.tipo=2 
         group by a.cianom";
       
        $qx = $this->db->query($sx,array($fec,$id_plaza));
        
        $tabla ="<table>
        <thead>
        <tr>
        
        <th>CIA</th>
        <th>COMPA&Ntilde;IA</th>
        <th>REPORTE</th>
        </tr>
        </thead>";
        
        foreach($qx->result() as $rx)
        {
          $cia=$rx->cianom; 
          $user_con=$rx->id_user; 
          $l1 = anchor('prenomina/imprimir_poliza_bloque/'.$fec.'/'.$cia.'/'.$user_con, ' IMPRIME<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));    
    
        $tabla.= "
        <tr>
            <td align=\"left\"><strong>".$rx->cianom."</strong></td>
            <td align=\"left\"><strong>".$rx->ciax."</strong></td>
            <td align=\"left\">".$l1."</td>
           </tr>";
        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_poliza_bloque1($fec, $plaza1)
    {
       
       
       $id_user= $this->session->userdata('id');
         $sx = "SELECT a.fecpre,a.id_user,a.cianom,b.ciax,c.nombre as contador
         from faltante a 
         left join catalogo.cat_compa_nomina b on b.cia=a.cianom
         left join usuarios c on a.id_user=c.id
         where  a.fecpre = ? and a.id_plaza='$plaza1' and a.tipo=2 group by a.cianom";
       
        $qx = $this->db->query($sx,array($fec,$plaza1));
        
        $r = $qx->row();
        $conta=$r->contador;
        
        $tabla ="<table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$conta."</font></th>
        </tr>
        <tr>
        <th>CIA</th>
        <th>COMPA&Ntilde;IA</th>
        <th>REPORTE</th>
        </tr>
        </thead>";
        
        foreach($qx->result() as $rx)
        {
          $cia=$rx->cianom; 
          $user_con=$rx->id_user; 
          $l1 = anchor('prenomina/imprimir_poliza_bloque1/'.$fec.'/'.$cia.'/'.$user_con.'/'.$plaza1, ' IMPRIME<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));    
    
        $tabla.= "
        <tr>
            <td align=\"left\"><strong>".$rx->cianom."</strong></td>
            <td align=\"left\"><strong>".$rx->ciax."</strong></td>
            <td align=\"left\">".$l1."</td>
           </tr>";
        }

       $tabla.= "<table>"; 
        
        return $tabla;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_poliza_detalle_bloque($fec,$cia)
    {
  $id_user= $this->session->userdata('id');
$id_plaza= $this->session->userdata('id_plaza');
$glo=0;
         $sql="select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,b.pat,b.mat,b.nom
          from faltante a
          left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
         where 
         a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.tipo=2
         or
         a.fecpre = ? and a.id_plaza= ? and a.cianom= ? and a.tipo=2
         group by nomina";
         $query = $this->db->query($sql,array($fec,$id_user,$cia,$fec,$id_plaza,$cia));
         
         
          $detalle="<table>";
        
        
         foreach($query->result() as $row)
         {
         $nom=$row->nomina;
 
$s="select a.folioi,a.fechai,a.fecha,a.nomina,a.cianom,a.fal,a.clave,
b.completo,c.nombre as clavex
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
         where 
         a.fecpre ='$fec' and a.id_user= $id_user and a.cianom= $cia and a.nomina=$nom and a.tipo=2
         or
         a.fecpre ='$fec' and a.id_plaza= $id_plaza and a.cianom= $cia and a.nomina=$nom and a.tipo=2
         ";
         
        $q = $this->db->query($s);
         
         $detalle.="
            <tr bgcolor=\"#F8F1F1\">
            <td width=\"650\" align=\"left\"><strong>Empleado:</strong> ".$row->nomina." - ".$row->pat." ".$row->mat." ".$row->nom."</td>
            </tr>
            
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\"><strong>CLA</strong></td>
            <td width=\"200\" align=\"left\"><strong>CONCEPTO</strong></td>
            <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
            <td width=\"70\" align=\"right\"><strong></strong></td>
            <td width=\"70\" align=\"right\"><strong></strong></td>
            </tr>";
       $totfal=0;
       
       foreach($q->result() as $r)
         {
        $glo=$glo+$r->fal;
if($r->clave==644){ 
    
       $detalle.="
            <tr>
            <td width=\"150\" align=\"left\">".$r->fecha."</td>
            <td width=\"40\" align=\"left\">".$r->clave."</td>
            <td width=\"200\" align=\"left\">".$r->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"70\" align=\"right\">".$r->fechai."</td>
            <td width=\"70\" align=\"right\">".$r->folioi."</td>
            </tr>";   
            
 }else{
        $detalle.="
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\">".$r->clave."</td>
            <td width=\"200\" align=\"left\">".$r->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\"></td>
            </tr>";   
 }
       
        $totfal=$totfal+$r->fal;
        
         }
        $detalle.="
        <tr>
        <td width=\"390\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
        </tr>";
        
        $totfal=0; 
        }
        
       $detalle.="
       <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"390\" align=\"right\"><strong>TOTAL GENERAL DE LA COMPA&Ntilde;IA</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($glo,2)."</strong></td>
        <td width=\"160\" align=\"left\"></td>
        </tr>
        </table>
        "; 
  
        return $detalle;
  
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_poliza_detalle_bloque1($fec,$cia,$plaza1)
    {
  $id_user= $this->session->userdata('id');
$glo=0;
         $sql="select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,b.pat,b.mat,b.nom
          from faltante a
          left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
         where 
         a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.tipo=2
         or
         a.fecpre = ? and a.id_plaza= ? and a.cianom= ? and a.tipo=2
         group by nomina";
         $query = $this->db->query($sql,array($fec,$id_user,$cia,$fec,$plaza1,$cia));
         //echo $this->db->last_query();
         //echo die;
          $detalle="<table>";
        
        
         foreach($query->result() as $row)
         {
         $nom=$row->nomina;
 
$s="select a.folioi,a.fechai,a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
b.completo,c.nombre as clavex
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
         where 
         a.fecpre ='$fec' and a.id_user= $id_user and a.cianom= $cia and a.nomina=$nom and a.tipo=2
         or
         a.fecpre ='$fec' and a.id_plaza= '$plaza1' and a.cianom= $cia and a.nomina=$nom and a.tipo=2
         group by nomina,clave";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
         
         $detalle.="
            <tr bgcolor=\"#F8F1F1\">
            <td width=\"650\" align=\"left\"><strong>Empleado:</strong> ".$row->nomina." - ".$row->pat." ".$row->mat." ".$row->nom."</td>
            </tr>
            
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\"><strong>CLA</strong></td>
            <td width=\"200\" align=\"left\"><strong>CONCEPTO</strong></td>
            <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
            <td width=\"70\" align=\"right\"><strong></strong></td>
            <td width=\"70\" align=\"right\"><strong></strong></td>
            </tr>";
       $totfal=0;
       
       foreach($q->result() as $r)
         {
        $glo=$glo+$r->fal;
if($r->clave==644){ 
    
       $detalle.="
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\">".$r->clave."</td>
            <td width=\"200\" align=\"left\">".$r->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"70\" align=\"right\">".$r->fechai."</td>
            <td width=\"70\" align=\"right\">".$r->folioi."</td>
            </tr>";   
            
 }else{
        $detalle.="
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\">".$r->clave."</td>
            <td width=\"200\" align=\"left\">".$r->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\"></td>
            </tr>";   
 }
       
        $totfal=$totfal+$r->fal;
        
         }
        $detalle.="
        <tr>
        <td width=\"390\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
        </tr>";
        
        $totfal=0; 
        }
        
       $detalle.="
       <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"390\" align=\"right\"><strong>TOTAL GENERAL DE LA COMPA&Ntilde;IA</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($glo,2)."</strong></td>
        <td width=\"160\" align=\"left\"></td>
        </tr>
        </table>
        "; 
  
        return $detalle;
  
    }
      ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************
      ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************



  function imprime_poliza_detalle_bloque_ctl($fec,$cia)
    {
  $id_user = $this->session->userdata('id');
  $id_plaza= $this->session->userdata('id_plaza');
        
         $sql="select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
b.completo,c.nombre as clavex
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
         where 
         a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.tipo=2
         or
         a.fecpre = ? and a.id_plaza= ? and a.cianom= ? and a.tipo=2
         group by clave";
         $query = $this->db->query($sql,array($fec,$id_user,$cia,$fec,$id_plaza,$cia));
         
         
         
          $detalle="<table>
            <tr>
            <td width=\"40\" align=\"left\"><strong>CLA</strong></td>
            <td width=\"200\" align=\"left\"><strong>CONCEPTO</strong></td>
            <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
            </tr>";
          
        
        $totfal=0;
         foreach($query->result() as $row)
         {
         $detalle.="
         
         <tr>
            <td width=\"40\" align=\"left\">".$row->clave."</td>
            <td width=\"200\" align=\"left\">".$row->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($row->fal,2)."</td>
            </tr>"; 
        $totfal=$totfal+$row->fal;
        
         }
        $detalle.="
        <tr>
        <td width=\"240\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
        </tr>
        </table>
        "; 
       ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************

        return $detalle;
  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

function imprime_poliza_detalle_bloque_ctl1($fec,$cia,$plaza1)
    {
  $id_user= $this->session->userdata('id');
        
         $sql="select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
b.completo,c.nombre as clavex
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
         where 
         a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.tipo=2
         or
         a.fecpre = ? and a.id_plaza= '$plaza1' and a.cianom= ? and a.tipo=2
         group by clave";
         $query = $this->db->query($sql,array($fec,$id_user,$cia,$fec,$id_plaza,$cia));
         
         
         
          $detalle="<table>
            <tr>
            <td width=\"40\" align=\"left\"><strong>CLA</strong></td>
            <td width=\"200\" align=\"left\"><strong>CONCEPTO</strong></td>
            <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
            </tr>";
          
        
        $totfal=0;
         foreach($query->result() as $row)
         {
         $detalle.="
         
         <tr>
            <td width=\"40\" align=\"left\">".$row->clave."</td>
            <td width=\"200\" align=\"left\">".$row->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($row->fal,2)."</td>
            </tr>"; 
        $totfal=$totfal+$row->fal;
        
         }
        $detalle.="
        <tr>
        <td width=\"240\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
        </tr>
        </table>
        "; 
       ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************

        return $detalle;
  
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

    function busca_prenom($fec,$user_con)
    {
        $sql = "select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
c.ciax,d.nombre,d.puesto
from faltante a
left join catalogo.cat_compa_nomina c on c.cia=a.cianom
left join usuarios d on d.id=a.id_user
         where a.fecpre = ? and a.id_user= ? and a.tipo=1
         group by cianom";
        $query = $this->db->query($sql,array($fec,$user_con));
         return $query;  
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function imprime_poliza_concepto($fec,$clave)
{
// ---------------------------------------------------------
$e=''; 
       $s = "select a.observacion,a.fechacaptura,a.fecpre,a.fecha,a.cianom,c.ciax,a.fal,a.clave,
a.nomina,e.completo,d.nombre,d.puesto,b.nombre as clavex,a.folioi,a.fechai,
case when a.clave=644
then DATE_ADD(a.fechai,INTERVAL a.fal-1 day)
else
0
end
as termino
from faltante a
left join catalogo.cat_nom_claves b on b.clave=a.clave
left join catalogo.cat_compa_nomina c on c.cia=a.cianom
left join usuarios d on d.id=a.id_user
left join catalogo.cat_empleado e on e.cia=a.cianom and e.nomina=a.nomina
         where a.fecpre = '$fec' and a.tipo=2 and a.clave=$clave
order by a.cianom,a.clave,a.nomina";

        $q = $this->db->query($s,array($fec));
        
        $e.= "
           <table>
           
           <tr>
           <td colspan=\"10\" align=\"center\"><strong>CONTROL DE POLIZA DE PRENOMINA  $fec</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"10\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"10\" align=\"center\">FECHA DE POLIZA..:<strong>".$fec."</strong> <br /></td>
           </tr>
           
            <tr>
            <td width=\"60\" align=\"left\"><strong>FECHA CAPTURA</strong></td>
            <td width=\"60\" align=\"left\"><strong>FECHA PRENOMINA</strong></td>
            <td width=\"60\" align=\"right\"><strong>CIA</strong></td>
            <td width=\"100\" align=\"right\"><strong>COMPA&Ntilde;IA</strong></td>
            <td width=\"70\" align=\"right\"><strong>IMPORTE</strong></td>
            <td width=\"60\" align=\"left\"><strong>CLAVE</strong></td>
            <td width=\"100\" align=\"left\"><strong>CLAVE</strong></td>
            <td width=\"60\" align=\"left\"><strong>NOMINA</strong></td>
            
            <td width=\"200\" align=\"left\"><strong>NOMBRE</strong></td>
            <td width=\"100\" align=\"left\"><strong>OBSERVACION</strong></td>
            <td width=\"200\" align=\"left\"><strong>CAPTURADO POR</strong></td>
            <td width=\"100\" align=\"left\"><strong>PLAZA O PUESTO</strong></td>
            ";
            if($clave==644){
            $e.= "
            <td width=\"100\" align=\"left\"><strong>FOLIO de INCAPACIDAD</strong></td>
            <td width=\"100\" align=\"left\"><strong>FECHA de INCAPACIDAD</strong></td>
            <td width=\"100\" align=\"left\"><strong>FECHA DE TERMINO DE INCAPACIDAD</strong></td>
            ";
            }
            $e.= "
            </tr>";
       $totfal=0;
        
 foreach($q->result() as $r)
         {
       $e.="
            <tr>
            <td width=\"60\" align=\"left\">".$r->fecha."</td>
            <td width=\"60\" align=\"left\">".$r->fecpre."</td>
            <td width=\"60\" align=\"left\">".$r->cianom."</td>
            <td width=\"100\" align=\"left\">".$r->ciax."</td>
            
            <td width=\"70\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"60\" align=\"center\">".$r->clave."</td>
            <td width=\"100\" align=\"left\">".$r->clavex."</td>
            <td width=\"60\" align=\"right\">".$r->nomina."</td>
            <td width=\"100\" align=\"left\">".$r->completo."</td>
            <td width=\"200\" align=\"left\">".$r->observacion." ".$r->fecha."</td>
            <td width=\"100\" align=\"left\">".$r->nombre."</td>
            <td width=\"100\" align=\"left\">".$r->puesto."</td>
            
       ";
       if($clave==644){
        $e.="
            <td width=\"100\" align=\"left\">".$r->fechai."</td>
            <td width=\"100\" align=\"left\">FOL.:".$r->folioi."</td>
            <td width=\"100\" align=\"left\">FEC.TERMINO.:".$r->termino."</td>
        ";
       }
        $e.="
            </tr>";   
            
 $totfal=$totfal+$r->fal;
          
          }    
       $e.="
        <tr>
        <td width=\"1070\" align=\"center\">IMPORTE.:".number_format($totfal,2)."</td>
        </tr>
        </table>";
        
 
  echo $e;     
  
// ---------------------------------------------------------

}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////





















































    function datos_periodo($id)
    {
        $this->db->select('p.*, m.mes as mes_nombre');
        $this->db->join('mes m', 'm.id = p.mes', 'LEFT');
        $this->db->where('p.id', $id);
        return $this->db->get('prenomina_c p');
    }
    
    function tabla_datos_periodo($id)
    {
        $query = $this->datos_periodo($id);
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Id.</th>
        <th>Quincena</th>
        <th>Mes</th>
        <th>A&ntilde;o</th>
        <th>Creada</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $row = $query->row();
        
            $tabla.= "
            <tr>
            <td>$row->id</td>
            <td>$row->quincena</td>
            <td>$row->mes_nombre</td>
            <td>$row->ano</td>
            <td>$row->creado</td>
            </tr>
            ";
            
            $tabla.= "
            </tbody>
            </table>
            ";
            
            return $tabla;
        
    }
    
        
    function editar_periodo($id)
    {
        $data = array(
           'quincena' => $this->input->post('quincena'),
           'mes' => $this->input->post('mes'),
           'ano' => $this->input->post('ano'),
        );
        
        $this->db->where('id', $id);
        $this->db->update('prenomina_c', $data);
          
    }
    
    function nomina($q)
    {
        $sql = "SELECT id, apellido_pat, apellido_mat, nombre, clave_empleado FROM empleados a where clave_empleado like '%$q%' or nombre like '%$q%';";
        
        $a = null;
        
        
        $q = $this->db->query($sql);
        
        foreach($q->result() as $row)
        {
            $a.= "$row->clave_empleado|$row->clave_empleado - $row->nombre $row->apellido_pat $row->apellido_mat\n";
        }
        
        return $a;
    }
    
    function cuenta()
    {
       
        $this->db->select('no_cuenta, des_cuenta');
        $this->db->from('cuenta');
        $query = $this->db->get();
       
        $a = null;
        
        $a[0] = "Selecciona una opci&oacute;n";
        
        foreach($query->result() as $row)
        {
            $a[$row->no_cuenta] = $row->des_cuenta;
        }
        
        return $a;
    }
    
    function guardar_prenomina()
    {
        //id, c_id, empleado, cuenta, dato, total, fecha
        $data = array(
            'c_id' => $this->input->post('id'),
            'empleado' => $this->input->post('nomina'),
            'cuenta' => $this->input->post('cuenta'),
            'dato' => $this->input->post('dato'),
            'total' => $this->input->post('total')
        );
        
        $this->db->insert('prenomina_d', $data);
        
        return $this->input->post('id');
    }
    
    function mostrar_prenomina($id)
    {
        
        $this->db->select('d.*, e.nombre, e.apellido_pat, e.apellido_mat, c.des_cuenta');
        $this->db->from('prenomina_d d');
        $this->db->join('empleados e', 'd.empleado = e.clave_empleado', 'LEFT');
        $this->db->join('cuenta c', 'd.cuenta = c.no_cuenta', 'LEFT');
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get();
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>ID</th>
        <th># Emp.</th>
        <th>Empleado</th>
        <th># Cta.</th>
        <th>Cuenta</th>
        <th>Subtotal</th>
        <th>Total</th>
        <th>Editar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->id</td>
        <td>$row->empleado</td>
        <td>$row->nombre $row->apellido_pat $row->apellido_mat</td>
        <td>$row->cuenta</td>
        <td>$row->des_cuenta</td>
        <td>$row->dato</td>
        <td>$row->total</td>
        <td>".anchor('prenomina/prenomina_eliminar/'.$row->id, 'Eliminar')."</td>
        </tr>
            ";
        }

        
        $tabla.= "</table>
        ";
        
        return $tabla;
    }
    
    function prenomina_eliminar($id)
    {
        $this->db->delete('prenomina_d',  array('id' => $id));
    }

    
}

