<?php
class A_surtido_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"5\">PEDIDOS PENDIENTES DE CAPTURAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>TRANSMITIO</th>
        <th>FOLIO</th>
        <th>DIA</th>
        <th>IMPRESION</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $s = "SELECT a.*,d.nombre as sucx,d.dia  FROM catalogo.folio_pedidos_cedis a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.tid='A' 
          order by a.id DESC";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       
       $l2 = anchor('a_surtido/imprime_pedidos_pre/'.$r->id.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$r->suc." - ".$r->sucx."</td>
            <td align=\"right\">".$r->fechas."</td>
            <td align=\"right\">".$r->id."</td>
            <td align=\"right\">".$r->dia."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
         
        }
         
  
        $s1 = "SELECT a.*,d.nombre as sucx,d.dia  FROM catalogo.folio_pedidos_cedis_especial a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.tid='A' and fechas>'2012-05-01' order by a.id DESC";
        $q1 = $this->db->query($s1);
        foreach($q1->result() as $r1)
        {
       
       $l21 = anchor('a_surtido/imprime_pedidos_pre1/'.$r1->id.'/'.$r1->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$r1->suc." - ".$r1->sucx."</td>
            <td align=\"right\">".$r1->fechas."</td>
            <td align=\"right\">".$r1->id."</td>
            <td align=\"right\">".$r1->dia."</td>
            <td align=\"right\">".$l21."</td>
            </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }


/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function detalle_cap($fol)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        <th>UBIC</th>
        <th>SEC.</th>
        <th>SUSANCIA ACTIVA</th>
        <th>PEDIDO</th>
        <th>SURTIDO</th>
        <th>EXISTENCIA</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
  $totped=0;
  $totsur=0;
  $porcen=0;
        $s = "SELECT a.*,ifnull(b.inv1,0)as inv1 FROM desarrollo.pedidos a
left join inv_cedis_sec1 b on b.sec=a.sec where fol=$fol and tipo=1  order by mue,sec";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       if($r->ped<>$r->sur){
        $color='#FA0404';
       }else{
       $color='#0F0101'; 
       }
       if($r->inv1<=0){$color='#8106FB';}
           
            
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".$r->mue."</font></td>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"+1\" color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($r->ped,0)."</font></td>
          	<td align='right'><font size='-1'><input name='cansur_$r->id' type='text' id='cansur_$r->id' size='5' maxlength='5' value='$r->sur' /></font></td>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".$r->inv1."</font></td>
            </tr>
            ";
        $totped=$totped+$r->ped;
        $totsur=$totsur+$r->sur; 
        }
        $porcen= ($totsur*100)/$totped;
         $tabla.="
        </tbody>
        </tr>
        <td align=\"right\"  colspan=\"3\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totped,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totsur,0)."</font></td>
        <tr>  	
        </tr>
        <td align=\"center\" colspan=\"5\"><font size=\"+1\" color=\"#B207C4\"><strong>PORCENTAJE DE ABASTO % ".number_format($porcen,2)."</strong></font></td>
        <tr>  	
        
        </table>";
        
        
        $tabla.= "
        
        <script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"cansur_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    //var pedido = $('#pedido').html();
    

    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_surtido(id, valor);

});

function actualiza_surtido(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_cansur/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}

</script>
        ";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function update_member_surtido($fol,$sec,$can)
    {
        $data = array(
        'sur' => $can,
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('fol', $fol);
        $this->db->where('sec', $sec);
        $this->db->where('tipo', '1');
        $this->db->update('pedidos', $data);
        
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cerrar_member_surtido($fol,$surti,$emp)
    {
        $id_user= $this->session->userdata('id');
        $s = "SELECT *from catalogo.folio_pedidos_cedis where id=$fol and tid='A' ";
        
        $q = $this->db->query($s);
if($q->num_rows() > 0){
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $sql = "SELECT *from desarrollo.pedidos where fol=$fol and inv='N' and sur>0";
        $query = $this->db->query($sql);
        $var=0;
if($query->num_rows() >0){  
        foreach($query->result() as $row)
        {
         $sur=$row->sur;
         $sec=$row->sec;
         $id_ped=$row->id;
         if($sur>0){
         $var=$this->__inv1($sec,$sur,$fol);
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}     
        
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $data = array(
        'inv'     => 'S',
        'id_usercap'=> $id_user,
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_ped);
        $this->db->update('desarrollo.pedidos', $data);
        }
        
}
        $dataf = array(
        'tid'     => 'C',
        'id_captura' => $id_user,
        'id_surtido'   => $surti,
        'id_empaque'    => $emp,
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $fol);
        $this->db->update('catalogo.folio_pedidos_cedis', $dataf);
		echo $this->db->last_query();

}else{
$dataf = array(
        'tid'     => 'C',
        'id_captura' => $id_user,
        'id_surtido'   => $surti,
        'id_empaque'    => $emp,
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $fol);
        $this->db->update('catalogo.folio_pedidos_cedis', $dataf);
		echo $this->db->last_query();    
}
}
        /////////////////////////////////////////////////////////**************************pedido especial
        /////////////////////////////////////////////////////////**************************pedido especial
$s = "SELECT *from catalogo.folio_pedidos_cedis_especial where id=$fol and tid='A' ";
        $q = $this->db->query($s);
if($q->num_rows() >0){
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $sql = "SELECT *from desarrollo.pedidos where fol=$fol and inv='N' and sur>0";
        $query = $this->db->query($sql);
        $var=0;
if($query->num_rows() >0){  
        foreach($query->result() as $row)
        {
         $sur=$row->sur;
         $sec=$row->sec;
         $id_ped=$row->id;
         if($sur>0){
         $var=$this->__inv1($sec,$sur,$fol);
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}
         $sur=$var;
         if($var>0){$var=$this->__inv1($sec,$sur,$fol);}     
        
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $data = array(
        'inv'     => 'S',
        'id_usercap'=> $id_user,
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_ped);
        $this->db->update('desarrollo.pedidos', $data);
        }
        
}
        $dataf = array(
        'tid'     => 'C',
        'id_captura' => $id_user,
        'id_surtido'   => $surti,
        'id_empaque'    => $emp,
        
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $fol);
        $this->db->update('catalogo.folio_pedidos_cedis_especial', $dataf);

}else{
 $dataf = array(
        'tid'     => 'C',
        'id_captura' => $id_user,
        'id_surtido'   => $surti,
        'id_empaque'    => $emp,
        
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $fol);
        $this->db->update('catalogo.folio_pedidos_cedis_especial', $dataf);    
}
}
        /////////////////////////////////////////////////////////**************************pedido especial
        /////////////////////////////////////////////////////////**************************pedido especial
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv1($sec,$sur,$fol)
{
   $id_user= $this->session->userdata('id');
   $sx = "SELECT * FROM inv_cedis where sec=$sec and inv1>0 order by sec,cadu , lote ";
            $qx = $this->db->query($sx);
            if($qx->num_rows() >0){ 
            $rx= $qx->row();
            $exi=$rx->inv1;
            $id_inv=$rx->id;
            if($exi>=$sur){
                    $var=0;
                    $des=$exi-$sur;
                    
                    $datax1 = array(
                    'inv1'     => $des
                    );
                    $this->db->where('id', $id_inv);
                    $this->db->update('desarrollo.inv_cedis', $datax1);
                    
       $new_member_insert_data1 = array(
            'fol'   =>$fol,
            'sec'   =>$sec,
            'cadu'  =>$rx->cadu,
            'lote'  =>$rx->lote,
            'can'   =>$sur
		);
		$insert = $this->db->insert('desarrollo.surtido', $new_member_insert_data1);
                    
                       
}else{
  
                    $var=$sur-$exi;
                    $datax2 = array(
                    'inv1'     => 0
                    );
                    $this->db->where('id', $id_inv);
                    $this->db->update('desarrollo.inv_cedis', $datax2);  
         $new_member_insert_data2 = array(
            'fol'   =>$fol,
            'sec'   =>$sec,
            'cadu'  =>$rx->cadu,
            'lote'  =>$rx->lote,
            'can'   =>$exi
		);
		$insert = $this->db->insert('desarrollo.surtido', $new_member_insert_data2);

            }
            //////////////////////////////////////////---------------------inv_cedis_dia
            $fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$rx->lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() == 0){ 
                       $datad = array(
                    'invi'=>$exi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$rx->cadu,
            		'lote'  =>$rx->lote,
            		'ssur'  =>$sur,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
           $rd= $qd->row();
            $exi=$rd->ssur;
            $id_inv_dia=$rd->id;

                    $datad1 = array(
                    'ssur'     => $exi+$sur
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
    
}
            //////////////////////////////////////////---------------------inv_cedis_dia
            }else{

$sx3 = "SELECT * FROM inv_cedis where sec=$sec and lote='SIN INV' ";
            $qx3 = $this->db->query($sx3);
            if($qx3->num_rows() >0){ 
            $rx3= $qx3->row();
            $exi=$rx3->inv1;
            $id_inv=$rx3->id;
                    $var=0;
                    $datax3 = array(
                    'inv1'     => $exi-$sur
                    );
                    $this->db->where('id', $id_inv);
                    $this->db->update('desarrollo.inv_cedis', $datax3);
                    
       $new_member_insert_data3 = array(
            'fol'   =>$fol,
            'sec'   =>$sec,
            'cadu'  =>0,
            'lote'  =>'SIN INV',
            'can'   =>$sur
		);
		$insert = $this->db->insert('desarrollo.surtido', $new_member_insert_data3);
                       
}else{
	$var=0;
                    $datax4 = array(
            		'sec'   =>$sec,
           			'cadu'  =>'0000-00-00',
            		'lote'  =>'SIN INV',
            		'inv1'  =>0-$sur,
            		'inv2'	=>0,
            		'fechai'=>date('Ymd')
                    );
                    $this->db->insert('desarrollo.inv_cedis', $datax4);  
         $new_member_insert_data4 = array(
            'fol'   =>$fol,
            'sec'   =>$sec,
            'cadu'  =>'0000-00-00',
            'lote'  =>'SIN INV',
            'can'   =>$sur
		);
		 $this->db->insert('desarrollo.surtido', $new_member_insert_data4);            	
            }
   
               //////////////////////////////////////////---------------------inv_cedis_dia
            $fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='SIN INV'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() == 0){ 
          $datad = array(
                    'invi'  =>0,    
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>'0000-00-00',
            		'lote'  =>'SIN INV',
            		'ssur'  =>$sur,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
            $rd= $qd->row();
            $exis=$rd->ssur;
            $id_inv_dia=$rd->id;
           $datad1 = array(
                    'ssur'     => $exis+$sur
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
    
}
            //////////////////////////////////////////---------------------inv_cedis_dia

   }
           return $var;
            
            
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_folio($fol)
    {
        $sql = "SELECT a.*,b.nombre,c.nombre as empx,d.nombre as capx, e.nombre as surx
                FROM catalogo.folio_pedidos_cedis a
                left join catalogo.sucursal b on b.suc=a.suc
				left join catalogo.cat_empacadores c on c.id=a.id_empaque
				left join catalogo.cat_surtidores e on e.id=a.id_surtido
				left join usuarios d on d.id=a.id_captura
				where a.id= ?";
				
        $query = $this->db->query($sql,array($fol));
         return $query;  
    }
     function busca_folio_1($fol)
    {
        $sql = "SELECT a.*,b.nombre,c.nombre as empx,d.nombre as capx, e.nombre as surx
                FROM catalogo.folio_pedidos_cedis_especial a
                left join catalogo.sucursal b on b.suc=a.suc 
				left join catalogo.cat_empacadores c on c.id=a.id_empaque
				left join catalogo.cat_surtidores e on e.id=a.id_surtido
				left join usuarios d on d.id=a.id_captura
				where a.id= ?";
				
        $query = $this->db->query($sql,array($fol));
         return $query;  
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////
    function cuenta_historico_pedidos()
    {
        $sql="SELECT count(*) as cuenta 
		FROM catalogo.folio_pedidos_cedis a
          left join catalogo.sucursal x on x.suc=a.suc
          left join catalogo.cat_empacadores c on c.id=a.id_empaque
		  left join catalogo.cat_surtidores e on e.id=a.id_surtido
				left join usuarios d on d.id=a.id_captura
          where a.tid='C'";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function reporte_diario_encabezado1()
    {
        $tabla = "<table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE SURTIDO DEL DIA ".date('d/m/Y')."</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_folios_abiertos()
    {
        $dianombre=date('D');  
       // $dianombre='VIE';
        $num=0;
        $numx=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
        
        $this->db->select('b.id,b.fechas,b.tid,a.suc,a.nombre,a.dia');
        $this->db->from('catalogo.sucursal a');
        $this->db->join('catalogo.folio_pedidos_cedis b', 'b.suc=a.suc', 'LEFT');
        $this->db->where('a.dia', $diax);
        $this->db->where('b.tid', 'A');
        $this->db->where("date(now())>date(fechas)", '', false);
        
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>PEDIDOS NORMALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th width=\"80px\">FOLIO</th>
        <th width=\"80px\">FECHA</th>
        <th width=\"70px\"># SUC</th>
        <th width=\"170px\">NOMBRE</th>
        <th width=\"50px\">DIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\" width=\"80px\">".$row->id."</td>
            <td align=\"left\" width=\"80px\">".$row->fechas."</td>
            <td align=\"left\" width=\"70px\">".$row->suc."</td>
            <td align=\"left\" width=\"170px\">".$row->nombre."</td>
            <td align=\"left\"  width=\"50px\">".$row->dia."</td>
            </tr>
";
            
            $n++; 
        
    }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
        
    }
    
    function reporte_folios_abiertos_esp()
    {
        $dianombre=date('D');  
       // $dianombre='VIE';
        $num=0;
        $numx=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
        
        $this->db->select('b.id,b.fechas,b.tid,a.suc,a.nombre,a.dia');
        $this->db->from('catalogo.sucursal a');
        $this->db->join('catalogo.folio_pedidos_cedis_especial b', 'b.suc=a.suc', 'LEFT');
        $this->db->where('a.dia', $diax);
        $this->db->where('b.tid', 'A');
        $this->db->where("date(now())>date(fechas)", '', false);
        
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>PEDIDOS ESPECIALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th width=\"80px\">FOLIO</th>
        <th width=\"80px\">FECHA</th>
        <th width=\"70px\"># SUC</th>
        <th width=\"170px\">NOMBRE</th>
        <th width=\"50px\">DIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\" width=\"80px\">".$row->id."</td>
            <td align=\"left\" width=\"80px\">".$row->fechas."</td>
            <td align=\"left\" width=\"70px\">".$row->suc."</td>
            <td align=\"left\" width=\"170px\">".$row->nombre."</td>
            <td align=\"left\"  width=\"50px\">".$row->dia."</td>
            </tr>
";
            
            $n++; 
        
    }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
        
    }
    
    function reporte_diario_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE SURTIDO DEL DIA $fecha1 AL $fecha2</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario($fecha1, $fecha2)
    {
        $this->db->select('a.*,x.nombre as sucx,x.dia ,c.nombre as empx,e.nombre as surx, d.nombre as capx, sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.cat_empacadores c', 'c.id=a.id_empaque', 'LEFT');
        $this->db->join('catalogo.cat_surtidores e', 'e.id=a.id_surtido', 'LEFT');
        $this->db->join('usuarios d', 'd.id=a.id_captura', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->where("date(a.fechas) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('a.id');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>PEDIDOS NORMALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th width=\"50px\">FOLIO</th>
        <th>RUTA</th>
        <th width=\"30px\">NID</th>
        <th width=\"100px\">SUCURSAL</th>
        <th width=\"50px\">FECHA</th>
        <th width=\"30px\">DIA</th>
        <th width=\"150px\">CAPTURA</th>
        <th width=\"150px\">SURTE</th>
        <th width=\"150px\">EMPACA</th>
        <th align=\"right\" width=\"40px\">C.PED</th>
        <th align=\"right\" width=\"40px\">C.SUR</th>
        <th align=\"right\" width=\"50px\">ABASTO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\" width=\"50px\">".$row->id."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\" width=\"30px\">".$row->suc."</td>
            <td align=\"left\" width=\"100px\">".$row->sucx."</td>
            <td align=\"left\" width=\"50px\">".$row->fechas."</td>
            <td align=\"left\" width=\"30px\">".$row->dia."</td>
            <td align=\"left\" width=\"150px\">".$row->capx."</td>
            <td align=\"left\" width=\"150px\">".$row->surx."</td>
            <td align=\"left\" width=\"150px\">".$row->empx."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"50px\">".number_format($abasto,2)." %</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"10\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    function reporte_diario_rutas($fecha1, $fecha2)
    {
        $this->db->select('nom, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta p');
        $this->db->where("date(fechas) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('nom');
        
        $query = $this->db->get();

        $tabla = "
        <h1>RUTAS PEDIDOS NORMALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th>RUTA</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        <th width=\"100px\">TOTAL SUC</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        $cuenta = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row->cuenta."</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
            $cuenta = $cuenta + $row->cuenta;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"2\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        <td align=\"right\" width=\"100px\">".$cuenta."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    function reporte_diario_esp($fecha1, $fecha2)
    {
        $this->db->select('a.*,x.nombre as sucx,x.dia ,c.nombre as empx,e.nombre as surx, d.nombre as capx, sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.cat_empacadores c', 'c.id=a.id_empaque', 'LEFT');
        $this->db->join('catalogo.cat_surtidores e', 'e.id=a.id_surtido', 'LEFT');
        $this->db->join('usuarios d', 'd.id=a.id_captura', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->where("date(a.fechas) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('a.id');
        
        $query = $this->db->get();

        $tabla = "
        <h1>PEDIDOS ESPECIALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th width=\"50px\">FOLIO</th>
        <th>RUTA</th>
        <th width=\"30px\">NID</th>
        <th width=\"100px\">SUCURSAL</th>
        <th width=\"50px\">FECHA</th>
        <th width=\"30px\">DIA</th>
        <th width=\"150px\">CAPTURA</th>
        <th width=\"150px\">SURTE</th>
        <th width=\"150px\">EMPACA</th>
        <th align=\"right\" width=\"40px\">C.PED</th>
        <th align=\"right\" width=\"40px\">C.SUR</th>
        <th align=\"right\" width=\"50px\">ABASTO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\" width=\"50px\">".$row->id."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\" width=\"30px\">".$row->suc."</td>
            <td align=\"left\" width=\"100px\">".$row->sucx."</td>
            <td align=\"left\" width=\"50px\">".$row->fechas."</td>
            <td align=\"left\" width=\"30px\">".$row->dia."</td>
            <td align=\"left\" width=\"150px\">".$row->capx."</td>
            <td align=\"left\" width=\"150px\">".$row->surx."</td>
            <td align=\"left\" width=\"150px\">".$row->empx."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"50px\">".number_format($abasto,2)." %</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"10\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    function reporte_diario_rutas_esp($fecha1, $fecha2)
    {
        $this->db->select('nom, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta_especial p');
        $this->db->where("date(fechas) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('nom');
        
        $query = $this->db->get();

        $tabla = "
        <h1>RUTAS PEDIDOS ESPECIALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th>RUTA</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        <th width=\"100px\">TOTAL SUC</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        $cuenta = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row->cuenta."</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
            $cuenta = $cuenta + $row->cuenta;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"2\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        <td align=\"right\" width=\"100px\">".$cuenta."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    function reporte_diario_total($fecha1, $fecha2)
    {
        $this->db->select('date(fechas) as fechas, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta');
        $this->db->where("date(fechas) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('date(fechas)');
        
        $query = $this->db->get();
        
        $this->db->select('date(fechas) as fechas, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta_especial');
        $this->db->where("date(fechas) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('date(fechas)');
        
        $query1 = $this->db->get();

        $tabla = "
        <h1>REPORTE TOTAL</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th>TIPO</th>
        <th>FECHA</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        <th width=\"100px\">TOTAL SUC</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $ped = 0;
        $sur = 0;
        $cuenta = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">PEDIDOS NORMALES</td>
            <td align=\"left\">".$row->fechas."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row->cuenta."</td>
            </tr>
            ";
            
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
            $cuenta = $cuenta + $row->cuenta;
        }
        
        foreach($query1->result() as $row1)
       
       {
        if($row1->ped > 0 && $row1->sur > 0){
            $abasto1 = ($row1->sur / $row1->ped) * 100;
        }else{
            $abasto1 = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">PEDIDOS ESPECIALES</td>
            <td align=\"left\">".$row1->fechas."</td>
            <td align=\"right\" width=\"70px\">".number_format($row1->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row1->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto1,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row1->cuenta."</td>
            </tr>
            ";
            
            $ped = $ped + $row1->ped;
            $sur = $sur + $row1->sur;
            $cuenta = $cuenta + $row1->cuenta;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        
        <td align=\"right\" colspan=\"2\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        <td align=\"right\" width=\"100px\">".$cuenta."</td>
        </tr>
        </tfoot>
        </table>";
        
        return $tabla;
        
    }
    
    
    function reporte_semanal_encabezado($semana, $anio)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE SURTIDO DE LA SEMANA $semana Y A&Ntilde;O $anio</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_semanal_total($semana, $anio)
    {
        $this->db->select('date(fechas) as fechas, dayofweek(date(fechas)) as dia, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta');
        $this->db->where("yearweek(fechas)=$anio$semana", '', false);
        $this->db->group_by('date(fechas)');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        $this->db->select('date(fechas) as fechas, dayofweek(date(fechas)) as dia, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta_especial');
        $this->db->where("yearweek(fechas)=$anio$semana", '', false);
        $this->db->group_by('date(fechas)');
      
        $query1 = $this->db->get();
        //echo $this->db->last_query();
        

        $tabla = "
        <h1>REPORTE TOTAL SEMANAL</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th>TIPO</th>
        <th>FECHA</th>
        <th>DIA</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        <th width=\"100px\">TOTAL SUC</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $ped = 0;
        $sur = 0;
        $cuenta = 0;
        
        
        
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">PEDIDOS NORMALES</td>
            <td align=\"left\">".$row->fechas."</td>
            <td align=\"left\">".$this->__dia_de_la_semana($row->dia)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row->cuenta."</td>
            </tr>
            ";
            
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
            $cuenta = $cuenta + $row->cuenta;
        }
        
        foreach($query1->result() as $row1)
       
       {
        if($row1->ped > 0 && $row1->sur > 0){
            $abasto1 = ($row1->sur / $row1->ped) * 100;
        }else{
            $abasto1 = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">PEDIDOS ESPECIALES</td>
            <td align=\"left\">".$row1->fechas."</td>
            <td align=\"left\">".$this->__dia_de_la_semana($row1->dia)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row1->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row1->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto1,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row1->cuenta."</td>
            </tr>
            ";
            
            $ped = $ped + $row1->ped;
            $sur = $sur + $row1->sur;
            $cuenta = $cuenta + $row1->cuenta;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        <td align=\"right\" width=\"100px\">".$cuenta."</td>
        </tr>
        </tfoot>
        </table>";
        
        return $tabla;
        
    }
    
    function __dia_de_la_semana($diaint)
    {
        $dias = array(
            '1' => 'DOMINGO',
            '2' => 'LUNES',
            '3' => 'MARTES',
            '4' => 'MIERCOLES',
            '5' => 'JUEVES',
            '6' => 'VIERNES',
            '7' => 'SABADO'
        );
        
        return $dias[$diaint];
    }
    
    function reporte_mensual_encabezado($mes, $anio)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE SURTIDO DEL MES $mes Y A&Ntilde;O $anio</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_mensual_total($mes, $anio)
    {
        $this->db->select('date(fechas) as fechas, dayofweek(date(fechas)) as dia, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta');
        $this->db->where("month(fechas)=$mes", '', false);
        $this->db->where("year(fechas)=$anio", '', false);
        $this->db->group_by('date(fechas)');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        $this->db->select('date(fechas) as fechas, dayofweek(date(fechas)) as dia, sum(sur) as sur, sum(ped) as ped, count(*) as cuenta');
        $this->db->from('pedidos_surtidos_conruta_especial');
        $this->db->where("month(fechas)=$mes", '', false);
        $this->db->where("year(fechas)=$anio", '', false);
        $this->db->group_by('date(fechas)');
      
        $query1 = $this->db->get();
        //echo $this->db->last_query();
        

        $tabla = "
        <h1>REPORTE TOTAL MENSUAL</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th>TIPO</th>
        <th>FECHA</th>
        <th>DIA</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        <th width=\"100px\">TOTAL SUC</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $ped = 0;
        $sur = 0;
        $cuenta = 0;
        
        
        
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">PEDIDOS NORMALES</td>
            <td align=\"left\">".$row->fechas."</td>
            <td align=\"left\">".$this->__dia_de_la_semana($row->dia)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row->cuenta."</td>
            </tr>
            ";
            
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
            $cuenta = $cuenta + $row->cuenta;
        }
        
        foreach($query1->result() as $row1)
       
       {
        if($row1->ped > 0 && $row1->sur > 0){
            $abasto1 = ($row1->sur / $row1->ped) * 100;
        }else{
            $abasto1 = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">PEDIDOS ESPECIALES</td>
            <td align=\"left\">".$row1->fechas."</td>
            <td align=\"left\">".$this->__dia_de_la_semana($row1->dia)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row1->ped,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row1->sur,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto1,2)." %</td>
            <td align=\"right\" width=\"100px\">".$row1->cuenta."</td>
            </tr>
            ";
            
            $ped = $ped + $row1->ped;
            $sur = $sur + $row1->sur;
            $cuenta = $cuenta + $row1->cuenta;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        <td align=\"right\" width=\"100px\">".$cuenta."</td>
        </tr>
        </tfoot>
        </table>";
        
        return $tabla;
        
    }
    
    
    function control_his($limit, $offset = 0)
    {
        
        if($offset == null){
            $offset = 0;
        }
        
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $this->db->select('a.*,x.nombre as sucx,x.dia ,c.nombre as empx,e.nombre as surx, d.nombre as capx, sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.cat_empacadores c', 'c.id=a.id_empaque', 'LEFT');
        $this->db->join('catalogo.cat_surtidores e', 'e.id=a.id_surtido', 'LEFT');
        $this->db->join('usuarios d', 'd.id=a.id_captura', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->group_by('a.id');
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo die;
        
        $tabla = $this->pagination->create_links()."
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"9\">PEDIDOS PENDIENTES DE CAPTURAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>FOLIO</th>
        <th>CAPTURA</th>
        <th>SURTE</th>
        <th>EMPACA</th>
        <th>C.PED</th>
        <th>C.SUR</th>
        <th>RUTA</th>
        <th>IMP</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
       
       {
       $impresion = anchor('a_surtido/imprime_pedidos_rem/'.$row->id.'/'.$row->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$row->suc." - ".$row->sucx." <br />".$row->fechas." - ".$row->dia."</td>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->capx."</td>
            <td align=\"left\">".$row->surx."</td>
            <td align=\"left\">".$row->empx."</td>
            <td align=\"right\">".number_format($row->ped,0)."</td>
            <td align=\"right\">".number_format($row->sur,0)."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"right\">".$impresion."</td>
            </tr>
            ";
        }
        
        

       
        $tabla.='</tbody></table>'.$this->pagination->create_links();
        return $tabla;
    
    }
    
    function cuenta_historico_pedidos1()
    {
        $sql="SELECT count(*) as cuenta 
		FROM catalogo.folio_pedidos_cedis_especial a
          left join catalogo.sucursal x on x.suc=a.suc
          left join catalogo.cat_empacadores c on c.id=a.id_empaque
		  left join catalogo.cat_surtidores e on e.id=a.id_surtido
				left join usuarios d on d.id=a.id_captura
          where a.tid='C'";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function control_his1($limit, $offset = 0)
    {
        
        if($offset == null){
            $offset = 0;
        }
        
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $this->db->select('a.*,x.nombre as sucx,x.dia ,c.nombre as empx,e.nombre as surx, d.nombre as capx, sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.cat_empacadores c', 'c.id=a.id_empaque', 'LEFT');
        $this->db->join('catalogo.cat_surtidores e', 'e.id=a.id_surtido', 'LEFT');
        $this->db->join('usuarios d', 'd.id=a.id_captura', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->group_by('a.id');
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query1 = $this->db->get();
        
        $tabla = $this->pagination->create_links()."
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"9\">PEDIDOS PEMDIENTES DE CAPTURAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>FOLIO</th>
        <th>CAPTURA</th>
        <th>SURTE</th>
        <th>EMPACA</th>
        <th>C.PED</th>
        <th>C.SUR</th>
        <th>RUTA</th>
        <th>IMP</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        
        
        foreach($query1->result() as $row)

        {
       $impresion = anchor('a_surtido/imprime_pedidos_rem/'.$row->id.'/'.$row->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$row->suc." - ".$row->sucx." <br />".$row->fechas." - ".$row->dia."</td>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->capx."</td>
            <td align=\"left\">".$row->surx."</td>
            <td align=\"left\">".$row->empx."</td>
            <td align=\"right\">".number_format($row->ped,0)."</td>
            <td align=\"right\">".number_format($row->sur,0)."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"right\">".$impresion."</td>
            </tr>
            ";
       
        }
       
        $tabla.='</tbody></table>'.$this->pagination->create_links();
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function busca_pedidos($fec)
    {
     $sql = "SELECT  * FROM  pedidos where date_format(fechas,'%Y-%m-%d')= ?";
    $query = $this->db->query($sql,array($fec));
    return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_rem($fol)
    {
     $e='';
$numero=0;
       $s = "select *from pedidos where fol=$fol and tipo=1 and sur>0 order by mue, sec";
       $q = $this->db->query($s);
       $e.="<table  border=\"1\" cellpadding=\"4\">
       <thead>
        <tr>
           <th width=\"20\" align=\"center\"><strong>U</strong></th>
           <th width=\"40\" align=\"left\"><strong>SEC</strong></th>
           <th width=\"200\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"190\" align=\"left\"><strong>DESCRIPCION</strong></th>
           <th width=\"50\" align=\"center\"><strong>SUR</strong></th>
           <th width=\"50\" align=\"center\"><strong>PRECIO</strong></th>
           <th width=\"70\" align=\"center\"><strong>IVA</strong></th>
           <th width=\"70\" align=\"center\"><strong>IMPORTE</strong></th>
          </tr>
          </thead>
		  ";
        $totped=0;
        $totsur=0;
        $totiva=0;
        $totimp=0;
        
        $imp=0;
        $iva=0;
         foreach($q->result() as $r)
         {
         $lin=$r->lin;   
         $imp=$r->vta*$r->sur;    
          $sx = "select *from catalogo.almacen where sec=$r->sec and tsec='G'";
          $qx = $this->db->query($sx);   
          if($qx->num_rows() > 0){
            $rx=$qx->row();
            $lin=$rx->lin;
            $des=$rx->susa2;
            }else{
            $des='';    
            }
            $numero=$numero+1;
            if($lin==5 and $imp>0 or $lin==2 and $imp>0){$iva=$imp-($imp/($r->iva+1));}else{$iva=0;}
            
            $e.="
             <tr>
             <td width=\"20\" align=\"center\">".$r->mue."</td>
             <td width=\"40\" align=\"left\">".$r->sec."</td>
             <td width=\"200\" align=\"left\">".$r->susa."</td>
             <td width=\"190\" align=\"left\">".$des."</td>
             <td width=\"50\" align=\"right\">".number_format($r->sur,0)."</td>
             <td width=\"50\" align=\"right\">".number_format($r->vta,2)."</td>
             <td width=\"70\" align=\"right\">".number_format($iva,2)."</td>
             <td width=\"70\" align=\"right\">".number_format($imp,2)."</td>
             </tr>
            "; 
           ///////////////////////////////////////////////////////////////////////lote
            $s1 = "select *from surtido where fol=$fol and sec=$r->sec ";
            $q1 = $this->db->query($s1);
            $lote = '';   
           foreach($q1->result() as $r1)
         {
       $e.="
            <tr>
            <td width=\"20\" align=\"center\"></td>
            <td width=\"40\" align=\"left\"></td>
            <td width=\"200\" align=\"left\"><strong>Lote:</strong>".$r1->lote."</td>
            <td width=\"190\" align=\"left\"><strong>Cad: </strong>".$r1->cadu." <strong>__Pza: </strong>".$r1->can."</td>
            <td width=\"50\" align=\"right\"></td>
            <td width=\"50\" align=\"right\"></td>
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\"></td>
            </tr>
            ";   
        }       
        $totped=$totped+$r->ped;
        $totsur=$totsur+$r->sur;
        $totiva=$totiva+$iva;
        $totimp=$totimp+$imp; 
        
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"430\" align=\"right\"><strong>PRODUCTOS....: $numero ______ TOTAL</strong></td>
        <td width=\"50\" align=\"right\"><strong>".number_format($totsur,0)."</strong></td>
        <td width=\"140\" align=\"right\"><strong>".number_format($totiva,2)."</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totimp,2)."</strong></td>
        </tr>
        </table>";
    return $e; 
    }
//?? ??? !"#$% &'?)'"
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function imprime_rem_negados($fol)
    {
$f=0;
       $s1 = "select * from pedidos where fol=$fol and tipo=1 and sur=0 and tipo=1 and ped>0 order by mue, sec";
       $q1 = $this->db->query($s1);
       $f=$q1->num_rows();
    return $f; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function imprime_rem_descontinuados($fol)
    {
$f='';
       $s1 = "select *from pedidos where fol=$fol and tipo=4 order by mue, sec";
       $q1 = $this->db->query($s1);
       $f.="<table  border=\"1\" cellpadding=\"4\">
       <thead>
                 <tr>
                 <td  width=\"640\" align=\"center\"><strong><font size=\"+4\">DESCONTINUADOS</font></strong></td>
                 </tr>
            <tr>
            <th width=\"40\" align=\"center\"><strong>MUE</strong></th>
            <th width=\"40\" align=\"left\"><strong>SEC</strong></th>
            <th width=\"250\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
            <th width=\"250\" align=\"left\"><strong>DESCRIPCION</strong></th>
            <th width=\"60\" align=\"right\"><strong>PIEZAS</strong></th>
            </tr>
</thead>
          ";
        $totped=0;
         foreach($q1->result() as $r1)
         {
        
          $sx = "select *from catalogo.almacen where sec=$r1->sec and tsec='G'";
          $qx = $this->db->query($sx);   
          if($qx->num_rows() > 0){
            $rx=$qx->row();
            $des=$rx->susa2;
            }else{
            $des='';    
            }
       $f.="
            <tr>
            <td width=\"40\" align=\"center\">".$r1->mue."</td>
            <td width=\"40\" align=\"left\">".$r1->sec."</td>
            <td width=\"250\" align=\"left\">".$r1->susa."</td>
            <td width=\"250\" align=\"left\">".$des."</td>
            <td width=\"60\" align=\"right\">".number_format($r1->ped,0)."</td>
            </tr>
            ";   
        $totped=$totped+$r1->ped;
        
        }
        
       $f.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"580\" align=\"right\"><strong>TOTAL DE PIEZAS DESCONTINUADAS</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totped,0)."</strong></td>
        </tr>
        </table>";
    return $f; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_his_mod()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"5\">PEDIDOS PENDIENTES DE CAPTURAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>TRANSMITIO</th>
        <th>FOLIO</th>
        <th>DIA</th>
        <th>Editar</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $fec=date('Y-m-d')-1;
        $s = "SELECT a.*,d.nombre as sucx,d.dia  FROM catalogo.folio_pedidos_cedis a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.tid='C' order by a.id desc limit 500";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       
       $l2 = anchor('a_surtido/tabla_control_his_detalle/'.$r->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$r->suc." - ".$r->sucx."</td>
            <td align=\"right\">".$r->fechas."</td>
            <td align=\"right\">".$r->id."</td>
            <td align=\"right\">".$r->dia."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function detalle_cap_cerrado($fol)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        <th>UBIC</th>
        <th>SEC.</th>
        <th>SUSANCIA ACTIVA</th>
        <th>PEDIDO</th>
        <th>SURTIDO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
  $totped=0;
  $totsur=0;
  $porcen=0;
        $s = "SELECT * FROM desarrollo.pedidos where fol=$fol  order by mue,sec";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       if($r->ped<>$r->sur){
        $color='#FA0404';
       }else{
       $color='#0F0101'; 
       }
           
            
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".$r->mue."</font></td>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"+1\" color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($r->ped,0)."</font></td>
          	<td align='right'><font size='-1'><input name='cansur_$r->id' type='text' id='cansur_$r->id' size='5' maxlength='5' value='$r->sur' /></font></td>
            </tr>
            ";
        $totped=$totped+$r->ped;
        $totsur=$totsur+$r->sur; 
        }
        $porcen= ($totsur*100)/$totped;
         $tabla.="
        </tbody>
        </tr>
        <td align=\"right\"  colspan=\"3\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totped,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totsur,0)."</font></td>
        <tr>  	
        </tr>
        <td align=\"center\" colspan=\"5\"><font size=\"+1\" color=\"#B207C4\"><strong>PORCENTAJE DE ABASTO % ".number_format($porcen,2)."</strong></font></td>
        <tr>  	
        
        </table>";
        
        
        $tabla.= "
        
        <script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"cansur_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    //var pedido = $('#pedido').html();
    

    var id = nombre.split('_');
    id = id[1];
    alert(id + \" \" + valor);
    actualiza_cerrada(id, valor);

});

function actualiza_cerrada(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_cansur_cerrada/\", data: ({ id: id, valor: valor }),
            success: function(data){
          },
        beforeSend: function(data){

        }
        });
}

</script>
        ";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
function busca_folio_cerrado()
    {
        $folio=$this->input->post('folio');
        $fecha=$this->input->post('fecha');
        $suc=$this->input->post('suc');
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('a.*,x.nombre as sucx,x.dia ,c.nombre as empx,e.nombre as surx, d.nombre as capx, sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.cat_empacadores c', 'c.id=a.id_empaque', 'LEFT');
        $this->db->join('catalogo.cat_surtidores e', 'e.id=a.id_surtido', 'LEFT');
        $this->db->join('usuarios d', 'd.id=a.id_captura', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->order_by('a.id', 'DESC');
        
        if(strlen($folio)>0){
        $this->db->where('a.id =', $folio);
        }
        if(strlen($fecha)>0){
        $this->db->where('a.fechas =', $fecha);
        }
        if(strlen($suc)>0){
        $this->db->where('a.suc =', $suc);
        }
        $this->db->group_by('a.id');
        
        $query = $this->db->get();
        
        
        $folio=$this->input->post('folio');
        $fecha=$this->input->post('fecha');
        $suc=$this->input->post('suc');
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('a.*,x.nombre as sucx,x.dia ,c.nombre as empx,e.nombre as surx, d.nombre as capx, sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->join('catalogo.cat_empacadores c', 'c.id=a.id_empaque', 'LEFT');
        $this->db->join('catalogo.cat_surtidores e', 'e.id=a.id_surtido', 'LEFT');
        $this->db->join('usuarios d', 'd.id=a.id_captura', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->order_by('a.id', 'DESC');
        
        if(strlen($folio)>0){
        $this->db->where('a.id =', $folio);
        }
        if(strlen($fecha)>0){
        $this->db->where('a.fechas =', $fecha);
        }
        if(strlen($suc)>0){
        $this->db->where('a.suc =', $suc);
        }
        $this->db->group_by('a.id');
        
        $query1 = $this->db->get();
        
        //echo $this->db->last_query();

        $tabla1 = "
        <table>
        <thead>
        <tr>
        <th>SUCURSAL</th>
        <th>FOLIO</th>
        <th>CAPTURA</th>
        <th>SURTE</th>
        <th>EMPACA</th>
        <th>C.PED</th>
        <th>C.SUR</th>
        <th>RUTA</th>
        <th>IMP</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $impresion=anchor('a_surtido/imprime_pedidos_rem/'.$row->id.'/'.$row->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
            $tabla1.= "
        
        
<tr>
            
            <td align=\"left\">".$row->suc." - ".$row->sucx." <br />".$row->fechas." - ".$row->dia."</td>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->capx."</td>
            <td align=\"left\">".$row->surx."</td>
            <td align=\"left\">".$row->empx."</td>
            <td align=\"right\">".number_format($row->ped,0)."</td>
            <td align=\"right\">".number_format($row->sur,0)."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"right\">".$impresion."</td>
            </tr>
            ";
        }
        
        foreach($query1->result() as $row)
        {
            $impresion=anchor('a_surtido/imprime_pedidos_rem/'.$row->id.'/'.$row->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
            $tabla1.= "
        
        
<tr>
            
            <td align=\"left\">".$row->suc." - ".$row->sucx." <br />".$row->fechas." - ".$row->dia."</td>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->capx."</td>
            <td align=\"left\">".$row->surx."</td>
            <td align=\"left\">".$row->empx."</td>
            <td align=\"right\">".number_format($row->ped,0)."</td>
            <td align=\"right\">".number_format($row->sur,0)."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"right\">".$impresion."</td>
            </tr>
            ";
        }
        
        
        $tabla1.= "</table>
        ";
        
        return $tabla1;
    }
    
    function cuenta_historico_pedidos_sucursal()
    {
        
        
        $this->db->select('count(*) as cuenta');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->where('a.tid', 'C');
        $this->db->where('a.suc', $this->session->userdata('suc'));
        
        $query = $this->db->get();
        
        $row = $query->row();
        
        return $row->cuenta;
    }

    function control_his_sucursal($limit, $offset=0)
    {
        $this->db->select('a.*,x.nombre as sucx,x.dia , sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->where('a.suc', $this->session->userdata('suc'));
        $this->db->group_by('a.id');
        $this->db->order_by('p.fol', 'desc');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        
        $tabla = $this->pagination->create_links()."
        <h1>PEDIDOS NORMALES SURTIDOS</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th width=\"50px\">FOLIO</th>
        <th>RUTA</th>
        <th width=\"30px\">NID</th>
        <th width=\"100px\">SUCURSAL</th>
        <th width=\"50px\">FECHA</th>
        <th width=\"30px\">DIA</th>
        <th align=\"right\" width=\"40px\">C.PED</th>
        <th align=\"right\" width=\"40px\">C.SUR</th>
        <th align=\"right\" width=\"50px\">ABASTO</th>
        <th>IMP</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        $impresion=anchor('a_surtido/imprime_pedidos_rem/'.$row->id.'/'.$row->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\" width=\"50px\">".$row->id."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\" width=\"30px\">".$row->suc."</td>
            <td align=\"left\" width=\"100px\">".$row->sucx."</td>
            <td align=\"left\" width=\"50px\">".$row->fechas."</td>
            <td align=\"left\" width=\"30px\">".$row->dia."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"50px\">".number_format($abasto,2)." %</td>
            <td align=\"right\">".$impresion."</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"7\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        ";
        
        $tabla.='</tfoot></table>'.$this->pagination->create_links();
        return $tabla;
        
    }
    
    function cuenta_historico_pedidos_sucursal_esp()
    {
        
        
        $this->db->select('count(*) as cuenta');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->where('a.tid', 'C');
        $this->db->where('a.suc', $this->session->userdata('suc'));
        
        $query = $this->db->get();
        
        $row = $query->row();
        
        return $row->cuenta;
    }
    
    function control_his_sucursal_especial($limit, $offset=0)
    {
        $this->db->select('a.*,x.nombre as sucx,x.dia , sum(sur) as sur, sum(ped) as ped, r.nom');
        $this->db->from('catalogo.folio_pedidos_cedis_especial a');
        $this->db->join('pedidos p', 'a.id = p.fol', 'LEFT');
        $this->db->join('catalogo.almacen_rutas r', 'p.bloque = r.ruta and a.suc = r.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=a.suc', 'LEFT');
        $this->db->where('a.tid', 'C');
        $this->db->where('p.tipo', '1');
        $this->db->where('a.suc', $this->session->userdata('suc'));
        $this->db->group_by('a.id');
        $this->db->order_by('p.fol', 'desc');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();

        $tabla = $this->pagination->create_links()."
        <h1>PEDIDOS ESPECIALES SURTIDOS</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"30px\">#</th>
        <th width=\"50px\">FOLIO</th>
        <th>TIKET</th>
        <th>RUTA</th>
        <th width=\"30px\">NID</th>
        <th width=\"100px\">SUCURSAL</th>
        <th width=\"50px\">FECHA</th>
        <th width=\"30px\">DIA</th>
        <th align=\"right\" width=\"40px\">C.PED</th>
        <th align=\"right\" width=\"40px\">C.SUR</th>
        <th align=\"right\" width=\"50px\">ABASTO</th>
        <th>IMP</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        $abastox=0; 
        foreach($query->result() as $row)
       
       {
        $impresion=anchor('a_surtido/imprime_pedidos_rem/'.$row->id.'/'.$row->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank'));
        $l1=anchor('a_surtido/tiket_captura/'.$row->id, $row->tiket, array('title' => 'Haz Click aqui para capturar !', 'class' => 'encabezado'));
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30px\">".$n."</td>
            <td align=\"left\" width=\"50px\">".$row->id."</td>
            <td align=\"left\" width=\"50px\">".$l1."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\" width=\"30px\">".$row->suc."</td>
            <td align=\"left\" width=\"100px\">".$row->sucx."</td>
            <td align=\"left\" width=\"50px\">".$row->fechas."</td>
            <td align=\"left\" width=\"30px\">".$row->dia."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"40px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"50px\">".number_format($abasto,2)." %</td>
            <td align=\"right\">".$impresion."</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        if($ped>0){
         $abastox = ($sur / $ped) * 100;   
        }
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"8\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        ";
        
        $tabla.='</tfoot></table>'.$this->pagination->create_links();
        return $tabla;
        
    }

function pedido_sucur()
    {
        $dianombre=date('D');  
       // $dianombre='VIE';
        $num=0;
        $numx=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
        
        $this->db->select('a.*,d.nombre as sucx,d.dia,b.mue,sum(b.ped) as ped,b.fechas as trasmitio');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->join('desarrollo.pedidos b', 'b.fol=a.id', 'LEFT');
        $this->db->join('catalogo.sucursal d', 'd.suc=a.suc', 'LEFT');
        $this->db->where('d.dia', $diax);
        $this->db->where('a.tid', 'A');
        $this->db->where('a.suc', $this->session->userdata('suc'));
        $this->db->where("a.fechas=date(now())", '', false);
        $this->db->group_by('a.id');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <table>
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>FECHA</th>
        <th>FOLIO</th>
        <th>CANTIDAD</th>
        <th>IMPRESION</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
       $n = 1;
        foreach($query->result() as $r)
       
       {
        
           if($r->mue==6){
       
       $l1 = anchor('pedido/imprime_pedidos_06/'.$r->id.'/'.$r->suc, '<font size="-1" color= "#FA0606">Mueble 6</font><img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir 6!', 'class' => 'encabezado', 'target' => '_blank')); 
       }else{
       $num=$num+1;
       $numx=$numx+1;
       $l1 = anchor('pedido/imprime_pedidos/'.$r->id.'/'.$r->suc, 'Mueble 5<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir 0-5!', 'class' => 'encabezado', 'target' => '_blank'));  
       }
       
           
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$n."</td>
            <td align=\"left\">".$r->suc." - ".$r->sucx."</td>
            <td align=\"right\">".$r->trasmitio."</td>
            <td align=\"right\">".$r->id."</td>
            <td align=\"right\">".$r->ped."</td>
            <td align=\"right\">".$l1."</td>
            </tr>
            ";
         $n++;
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
        
    }
    
    function surtidores()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
        $this->db->select('*');
        $this->db->from('catalogo.cat_surtidores');
        $this->db->where('tipo', 1);
        $this->db->where('turno', 1);
        $this->db->order_by('nombre');
        
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
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"right\">".$row->nomina."</td>
            
            </tr>
            ";
         $n++;
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
        
    }
    
    function guardar_empleado()
    {
        $data = array(
           'nombre' => $this->input->post('nombre'),
           'nomina' => $this->input->post('nomina'),
           'turno' => $this->input->post('turno')
      
        );
      
     $this->db->insert('catalogo.cat_surtidores', $data);
     return $this->db->insert_id();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function reporte_diario_encabezado_xclave($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE SURTIDO x CLAVE DEL DIA $fecha1 AL $fecha2</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario_xclave($fecha1, $fecha2)
    {
        $this->db->select('sec, susa, sum(ped) as ped, sum(sur) as sur');
        $this->db->from('desarrollo.pedidos a');
        $this->db->join('catalogo.folio_pedidos_cedis b', 'b.id=a.fol', 'LEFT');
        $this->db->where('b.tid', 'C');
        $this->db->where("a.fechas between '$fecha1' and '$fecha2 23:59:59'", '', false);
        $this->db->group_by('a.sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>SURTIDO DE CLAVES DE PEDIDOS NORMALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"40px\">#</th>
        <th width=\"40px\">SEC</th>
        <th width=\"600px\">DESCRIPCION</th>
        <th align=\"right\" width=\"80px\">C.PED</th>
        <th align=\"right\" width=\"80px\">C.SUR</th>
        <th align=\"right\" width=\"80px\">ABASTO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"40px\">".$n."</td>
            <td align=\"left\" width=\"40px\">".$row->sec."</td>
            <td align=\"left\" width=\"600px\">".$row->susa."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($abasto,2)." %</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    function reporte_diario_espacial_xclave($fecha1, $fecha2)
    {
        $this->db->select('sec, susa, sum(ped) as ped, sum(sur) as sur');
        $this->db->from('desarrollo.pedidos a');
        $this->db->join('catalogo.folio_pedidos_cedis_especial b', 'b.id=a.fol', 'LEFT');
        $this->db->where('b.tid', 'C');
        $this->db->where("a.fechas between '$fecha1' and '$fecha2 23:59:59'", '', false);
        $this->db->group_by('a.sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>SURTIDO DE CLAVES DE PEDIDOS ESPECIALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"40px\">#</th>
        <th width=\"40px\">SEC</th>
        <th width=\"600px\">DESCRIPCION</th>
        <th align=\"right\" width=\"80px\">C.PED</th>
        <th align=\"right\" width=\"80px\">C.SUR</th>
        <th align=\"right\" width=\"80px\">ABASTO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"40px\">".$n."</td>
            <td align=\"left\" width=\"40px\">".$row->sec."</td>
            <td align=\"left\" width=\"600px\">".$row->susa."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($abasto,2)." %</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    function reporte_diario_total_xclave($fecha1, $fecha2)
    {
        $s=" SElECT sec, susa, sum(ped) as ped, sum(sur) as sur from(
        SELECT all sec, susa, sum(ped) as ped, sum(sur) as sur
        FROM desarrollo.pedidos a
        LEFT JOIN catalogo.folio_pedidos_cedis b ON b.id = a.fol
        WHERE b.tid = 'C' AND a.fechas between '$fecha1' and '$fecha2 23:59:59'
        group by a.sec
        UNION all
        SELECT all sec, susa, sum(ped) as ped, sum(sur) as sur
        FROM desarrollo.pedidos a
        LEFT JOIN catalogo.folio_pedidos_cedis_especial b ON b.id = a.fol
        WHERE b.tid = 'C' AND a.fechas between '$fecha1' and '$fecha2 23:59:59'
        group by a.sec)
        as temptable group by sec";
        $query = $this->db->query($s);
        
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>SURTIDO DE CLAVES TOTALES</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"40px\">#</th>
        <th width=\"40px\">SEC</th>
        <th width=\"600px\">DESCRIPCION</th>
        <th align=\"right\" width=\"80px\">C.PED</th>
        <th align=\"right\" width=\"80px\">C.SUR</th>
        <th align=\"right\" width=\"80px\">ABASTO</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($query->result() as $row)
       
       {
        if($row->ped > 0 && $row->sur > 0){
            $abasto = ($row->sur / $row->ped) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\" width=\"40px\">".$n."</td>
            <td align=\"left\" width=\"40px\">".$row->sec."</td>
            <td align=\"left\" width=\"600px\">".$row->susa."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->ped,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->sur,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($abasto,2)." %</td>
            </tr>
            ";
            
            $n++;
            $ped = $ped + $row->ped;
            $sur = $sur + $row->sur;
        }
        
        $abastox = ($sur / $ped) * 100;
        

       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////reporte erika

function reporte_surtidores($fecha1, $fecha2)
    {
        

        $tabla = "
        <h1>REPORTE X FOLIO SURTIDORES</h1>
        <br/>
        <h2 align=\"center\">REPORTE SURTIDO DE $fecha1 a $fecha2</h2>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th>FOLIO</th>
        <th>SUCURSAL</th>
        <th>FECHA SURTIDO</th>
        <th>NOMBRE</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $s="SELECT a.id, a.suc, d.nombre as sucursal, a.fechasur, a.id_surtido, c.nombre as nomsur, sum(e.sur) as surtido, sum(e.ped) as pedido
            FROM catalogo.folio_pedidos_cedis a
            left join catalogo.cat_surtidores c on c.id=a.id_surtido
            left join catalogo.sucursal d on a.suc=d.suc
            left join desarrollo.pedidos e on e.fol=a.id
            where a.tid='C'
            AND date(a.fechasur) between '$fecha1' and '$fecha2'
            and a.id_surtido <> 14
            and c.turno=1
            group by a.id
            union all
            SELECT a.id, a.suc, d.nombre as sucursal, a.fechasur, a.id_surtido, c.nombre as nomsur, sum(e.sur) as surtido, sum(e.ped) as pedido
            FROM catalogo.folio_pedidos_cedis_especial a
            left join catalogo.cat_surtidores c on c.id=a.id_surtido
            left join catalogo.sucursal d on a.suc=d.suc
            left join desarrollo.pedidos e on e.fol=a.id
            where a.tid='C'
            AND date(a.fechasur) between '$fecha1' and '$fecha2'
            and a.id_surtido <> 14
            and c.turno=1
            group by a.id
            order by nomsur, id";
            
        $q = $this->db->query($s);
        
        $ped = 0;
        $sur = 0;
        
        foreach($q->result() as $row)
       
       {
        if($row->pedido > 0 && $row->surtido > 0){
            $abasto = ($row->surtido / $row->pedido) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">".$row->id."</td>
            <td align=\"left\">".$row->suc.' '.$row->sucursal."</td>
            <td align=\"left\">".$row->fechasur."</td>
            <td align=\"left\">".$row->nomsur."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->pedido,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->surtido,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            
            </tr>
            ";
            
            $ped = $ped + $row->pedido;
            $sur = $sur + $row->surtido;
            
        }
        
        $abastox = ($sur / $ped) * 100;
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        
        </tr>
        </tfoot>
        </table>";
        
        return $tabla;
        
    }
    
function reporte_surtidores1($fecha1, $fecha2)
    {
        

        $tabla = "
        <h1>CONCENTRADO TOTAL</h1>
        <br/>
        <h2 align=\"center\">REPORTE SURTIDO DE $fecha1 a $fecha2</h2>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        
        <tr>
        <th>NOMINA</th>
        <th>NOMBRE</th>
        <th align=\"right\" width=\"110px\">Ultimo Surtido<br/> $fecha2</th>
        <th align=\"right\" width=\"80px\">C.PED</th>
        <th align=\"right\" width=\"80px\">C.SUR</th>
        <th align=\"right\" width=\"80px\">ABASTO</th>
        <th align=\"right\" width=\"110px\">PROM. SURTIDO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $s1="SELECT fechasur, nomina, nomsur, sum(surtido) as surtido, sum(pedido) as pedido
            FROM catalogo.fecha_surtidor f where fechasur between '$fecha1' and '$fecha2'
            group by nomina
            order by surtido";
        
        $q1 = $this->db->query($s1);
        $ped = 0;
        $sur = 0;
        $hoy1 = 0;
        
        foreach($q1->result() as $row)
        {
            
            $sql = "SELECT sum(surtido) 
            FROM catalogo.fecha_surtidor 
            where nomina =$row->nomina and fechasur between '$fecha1' and '$fecha2' 
            group by fechasur";
            $dias = $this->db->query($sql);
            
            $num_dias = $dias->num_rows();
            
            $sql1="SELECT nomina, nomsur, sum(surtido) as surtido
            FROM catalogo.fecha_surtidor f 
            where nomina =$row->nomina 
            and fechasur ='$fecha2'
            group by nomina
            order by surtido";
            $hoy = $this->db->query($sql1);
            
            if($hoy->num_rows()>0){
                
                 $hoy2 = $hoy->row();
                 $surti = $hoy2->surtido;
            }else{
                $surti=0;
            }
           
            
            
            if($row->pedido > 0 && $row->surtido > 0){
            $abasto = ($row->surtido / $row->pedido) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            
            
            <tr>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->nomsur."</td>
            <td align=\"right\" width=\"110px\">".number_format($surti,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->pedido,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($row->surtido,0)."</td>
            <td align=\"right\" width=\"80px\">".number_format($abasto,2)." %</td>
            <td align=\"right\" width=\"110px\">".number_format(($row->surtido / $num_dias),0)."</td>
            </tr>
            ";
            
            $ped = $ped + $row->pedido;
            $sur = $sur + $row->surtido;
            $hoy1 = $hoy1 + $surti;
        }
        
        $abastox = ($sur / $ped) * 100;
       
        $tabla.="</tbody>
        <tfoot>
        
        <tr>
        
        <td align=\"right\" colspan=\"2\">TOTALES</td>
        <td align=\"right\">".number_format($hoy1,0)."</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        
        </tr>
        </tfoot>
        </table>";
        
        return $tabla;
        
    }
    
    function reporte_surtidores2($fecha1, $fecha2)
    {
        

        $tabla = "
        <h1>CONCENTRADO DE PIEZAS SURTIDAS DIARIAS</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th>FECHA</th>
        <th>NOMINA</th>
        <th>NOMBRE</th>
        <th align=\"right\" width=\"70px\">C.PED</th>
        <th align=\"right\" width=\"70px\">C.SUR</th>
        <th align=\"right\" width=\"70px\">ABASTO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $s1="SELECT fechasur, nomina, nomsur, sum(surtido) as surtido, sum(pedido) as pedido
            FROM catalogo.fecha_surtidor f where fechasur between '$fecha1' and '$fecha2'
            group by fechasur, nomina;";
        
        $q1 = $this->db->query($s1);
        $ped = 0;
        $sur = 0;
        
        foreach($q1->result() as $row)
        {
            if($row->pedido > 0 && $row->surtido > 0){
            $abasto = ($row->surtido / $row->pedido) * 100;
        }else{
            $abasto = 0;
        }
            $tabla.="
            <tr>
            <td align=\"left\">".$row->fechasur."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->nomsur."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->pedido,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($row->surtido,0)."</td>
            <td align=\"right\" width=\"70px\">".number_format($abasto,2)." %</td>
            
            </tr>
            ";
            
            $ped = $ped + $row->pedido;
            $sur = $sur + $row->surtido;
        }
        
        $abastox = ($sur / $ped) * 100;
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">".number_format($sur,0)."</td>
        <td align=\"right\">".number_format($abastox,2)." %</td>
        
        </tr>
        </tfoot>
        </table>";
        
        return $tabla;
        
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function mueble()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        <th>SEC</th>
        <th>SISTANCIA ACTIVA</th>
        <th>MUEBLE ACT</th>
        <th>MUEBLE</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
  $totped=0;
  $totsur=0;
  $porcen=0;
        $s = "SELECT b.susa1,a.* FROM catalogo.almacen_mue a left join catalogo.almacen b on b.sec=a.sec where a.sec>0 and a.sec<=2999
        group by a.sec order by mueble";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
       
        $color='#FA0404';
           
            
            
            $tabla.="
            <tr>
            
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"+1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($r->mueble,0)."</font></td>
          	<td align='right'><font size='-1'><input name='mue_$r->sec' type='text' id='mue_$r->sec' size='5' maxlength='5' value='$r->mueble' /></font></td>
            </tr>
            ";
        
        }
        $tabla.="
        </tbody>
         </table>";
        
        
        $tabla.= "
        
        <script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"mue_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    //var pedido = $('#pedido').html();
    

    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_mue(id, valor);

});

function actualiza_mue(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_mue/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}

</script>
        ";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function update_member_mueble($sec,$mue)
    {
        $data = array(
        'mueble' => $mue
        );
        $this->db->where('sec', $sec);
        $this->db->update('catalogo.almacen_mue', $data);
        
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        function folios_sob_fal()
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='2013-07-01' and validar=0 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table style=\"font-size: medium; \">
        <thead>
        <tr>
        <th>Folio</th>
        <th>Sucursal</th>
        <th>Fecha</th>
        <th colspan=\"2\" align=\"center\">Faltate</th>
        <th colspan=\"2\" align=\"center\">Sobrante</th>
        <th>Val</th>
        </tr>
        </thead>
        <tbody>
        ";
     
        foreach($query->result() as $row)
        {
             $tabla.="
            <tr>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"left\">".$row->fechas."</td>
            <td align=\"right\">".number_format($row->faltante,2)."</td>
            <td align='right'><font size='-1'><input name='fal_$row->id' type='text' id='fal_$row->id' size='11' maxlength='11' value='$row->faltante' /></font></td>
            <td align=\"right\">".number_format($row->sobrante,2)."</td>
            <td align='right'><font size='-1'><input name='sob_$row->id' type='text' id='sob_$row->id' size='11' maxlength='11' value='$row->sobrante' /></font></td>
            
            <td align=\"left\">".anchor('a_surtido/validar_falsob/'.$row->id.'/'.$row->validar, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'))."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>
 <script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"fal_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
     var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_fal(id, valor);

});

function actualiza_fal(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_faltante/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}


$('input:text[name^=\"sob_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
     var id = nombre.split('_');
    id = id[1];
    alert(id + \" \" + valor);
    actualiza_sob(id, valor);

});

function actualiza_sob(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_sobrante/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}
</script>       
        
     ";
        
        return $tabla;
    }
    
    

    function validar_falsob_model($id)
    {
        $sql="update catalogo.folio_pedidos_cedis set validar=1 where id=$id";
        $query = $this->db->query($sql);
    }



    function folios_sob_fal_esp()
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='2013-07-01' and validar=0;";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table style=\"font-size: medium; \">
        <thead>
        <tr>
        <th>Folio</th>
        <th>Sucursal</th>
        <th>Fecha</th>
        <th colspan=\"2\" align=\"center\">Faltate</th>
        <th colspan=\"2\" align=\"center\">Sobrante</th>
        <th>Val</th>
        </tr>
        </thead>
        <tbody>
        ";
     
        foreach($query->result() as $row)
        {
                    
            $tabla.="
            <tr>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"left\">".$row->fechas."</td>
            <td align=\"right\">".number_format($row->faltante,2)."</td>
            <td align='right'><font size='-1'><input name='fal_$row->id' type='text' id='fal_$row->id' size='11' maxlength='11' value='$row->faltante' /></font></td>
            <td align=\"right\">".number_format($row->sobrante,2)."</td>
            <td align='right'><font size='-1'><input name='sob_$row->id' type='text' id='sob_$row->id' size='11' maxlength='11' value='$row->sobrante' /></font></td>
            
            <td align=\"left\">".anchor('a_surtido/validar_falsob_esp/'.$row->id.'/'.$row->validar, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'))."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>
        <script language=\"javascript\" type=\"text/javascript\">

        $('input:text[name^=\"fal_\"]').change(function() {
    
        var nombre = $(this).attr('name');
        var valor = $(this).attr('value');
        var id = nombre.split('_');
        id = id[1];
        //alert(id + \" \" + valor);
        actualiza_fal(id, valor);

        });

        function actualiza_fal(id, valor){
        $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_faltante_esp/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
        }


        $('input:text[name^=\"sob_\"]').change(function() {
    
        var nombre = $(this).attr('name');
        var valor = $(this).attr('value');
        var id = nombre.split('_');
        id = id[1];
        alert(id + \" \" + valor);
        actualiza_sob(id, valor);

        });

        function actualiza_sob(id, valor){
        $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_sobrante_esp/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
        }
        </script>       
        
        ";
        
        return $tabla;
    }
    


    function validar_falsob_model_esp($id)
    {
        $sql="update catalogo.folio_pedidos_cedis_especial  set validar=1 where id=$id";
        $query = $this->db->query($sql);
    }
    
    
   
    
    function reporte_folio_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>FALTANTES Y/O SOBRANTES FORMULADOS</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    
    function reporte_folio($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and faltante>0 and sobrante>0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>FALTANTE Y SOBRANTE</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"right\" width=\"15%\">Faltate</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $sobrante = $sobrante + $row->sobrante;
            $faltante = $faltante + $row->faltante;
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
                }
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }
    
    function reporte_porcentajes($faltante, $falysob, $sobrante, $sinincidencias, $fecha1, $fecha2)
    {
        $sql = "SELECT count(*) as cuenta FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>= ? and fechas<=? and tid='C'";
        
        $query=$this->db->query($sql,array($fecha1, $fecha2));
        $row=$query->row();
        
        $devueltas = $faltante + $falysob  + $sobrante + $sinincidencias;	
        
        $tabla = "<table width=\"80%\" cellpadding=\"3\" border=\"1\">
            <tr>
                <td width=\"60%\">PEDIDOS FORMULADOS  </td>
                <td width=\"10%\">".number_format($row->cuenta, 0)."</td>
                
                <td width=\"10%\">".number_format((100))."%</td>
            </tr>          
            <tr>
                <td>REQUISICIONES DEVUELTAS </td>
                <td>".number_format($devueltas, 0)."</td>
                <td>".number_format(($row->cuenta > 0) ? ($devueltas/$row->cuenta)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>CON FALTANTE</td>
                <td>".number_format($faltante, 0)."</td>
                <td>".number_format(($devueltas > 0) ? ($faltante/$devueltas)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>CON FALTANTE Y SOBRANTE</td>
                <td>".number_format($falysob, 0)."</td>
                <td>".number_format(($devueltas > 0) ? ($falysob/$devueltas)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>CON SOBRANTE</td>
                <td>".number_format($sobrante, 0)."</td>
                <td>".number_format(($devueltas > 0) ? ($sobrante/$devueltas)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>SIN FALTANTE NI SOBRANTE</td>
                <td>".number_format($sinincidencias, 0)."</td>
                <td>".number_format(($devueltas > 0 ) ? ($sinincidencias/$devueltas)*100 : 0, 2)."%</td>
            </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_folio_faltante($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and faltante>0 and sobrante=0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"5\"><strong>FALTANTE</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"15%\">Folio</th>
        <th width=\"45%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"right\" width=\"20%\">Faltate</th>
        
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
      
        $faltante = 0;
        
        if ($query->num_rows() > 0){
            foreach($query->result() as $row)
            {
                $tabla.="
                <tr>
                <td align=\"left\" width=\"5%\">".$n."</td>
                <td align=\"center\" width=\"15%\">".$row->id."</td>
                <td width=\"45%\">".$row->suc." - ".$row->nombre."</td>
                <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
                <td align=\"right\" width=\"20%\">".$row->faltante."</td>
              
                </tr>
                ";
                $n++;
       
                $faltante = $faltante + $row->faltante;
            }
        }else{
                $tabla.="
                <tr>
                <td COLSPAN=\"5\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
      
        <td align=\"right\">".number_format($faltante,2)."</td>
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }
    
        function reporte_folio_sobrante($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and sobrante>0 and faltante=0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"5\"><strong>SOBRANTE</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"15%\">Folio</th>
        <th width=\"45%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        
        <th align=\"right\" width=\"20%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"15%\">".$row->id."</td>
            <td width=\"45%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
         
            <td align=\"right\" width=\"20%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $sobrante = $sobrante + $row->sobrante;  
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"5\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }
    
    function reporte_folio_sin_incidencias($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and faltante=0 and sobrante=0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>SIN INCIDENCIAS</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"lefht\"width=\"15%\">Faltante</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $faltante = $faltante + $row->faltante;
            $sobrante = $sobrante + $row->sobrante;
           
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }
    
    function reporte_folio_esp_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>FALTANTES Y/O SOBRANTES ESPECIALES</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    
    function reporte_folio_faltante_esp($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and faltante>0 and sobrante=0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"5\"><strong>FALTANTE</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"15%\">Folio</th>
        <th width=\"45%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"right\" width=\"20%\">Faltate</th>
        
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
      
        $faltante = 0;
        
        if ($query->num_rows() > 0){
            foreach($query->result() as $row)
            {
                $tabla.="
                <tr>
                <td align=\"left\" width=\"5%\">".$n."</td>
                <td align=\"center\" width=\"15%\">".$row->id."</td>
                <td width=\"45%\">".$row->suc." - ".$row->nombre."</td>
                <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
                <td align=\"right\" width=\"20%\">".$row->faltante."</td>
              
                </tr>
                ";
                $n++;
       
                $faltante = $faltante + $row->faltante;
            }
        }else{
                $tabla.="
                <tr>
                <td COLSPAN=\"5\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
      
        <td align=\"right\">".number_format($faltante,2)."</td>
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }
    
    
    
    function reporte_folio_esp($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>FALTANTE Y SOBRANTE</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"right\" width=\"15%\">Faltate</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $sobrante = $sobrante + $row->sobrante;
            $faltante = $faltante + $row->faltante;
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
                }
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }


    function reporte_folio_sobrante_esp($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and sobrante>0 and faltante=0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"5\"><strong>SOBRANTE</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"15%\">Folio</th>
        <th width=\"45%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        
        <th align=\"right\" width=\"20%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"15%\">".$row->id."</td>
            <td width=\"45%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
         
            <td align=\"right\" width=\"20%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $sobrante = $sobrante + $row->sobrante;  
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"5\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }


    function reporte_folio_sin_incidencias_esp($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and faltante=0 and sobrante=0 and validar=1 and tid='C';";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>SIN INCIDENCIAS</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"lefht\"width=\"15%\">Faltante</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $faltante = $faltante + $row->faltante;
            $sobrante = $sobrante + $row->sobrante;
           
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return array('tabla' => $tabla, 'folios' => $query->num_rows());
    }


        function reporte_porcentajes_esp($faltante, $falysob, $sobrante, $sinincidencias, $fecha1, $fecha2)
    {
        $sql = "SELECT count(*) as cuenta FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>= ? and fechas<=? and tid='C'";
        
        $query=$this->db->query($sql,array($fecha1, $fecha2));
        $row=$query->row();
        
        $devueltas = $faltante + $falysob  + $sobrante + $sinincidencias;	
        
        $tabla = "<table width=\"80%\" cellpadding=\"3\" border=\"1\">
            <tr>
                <td width=\"60%\">PEDIDOS ESPECIALES  </td>
                <td width=\"10%\">".number_format($row->cuenta, 0)."</td>
                
                <td width=\"10%\">".number_format((100))."%</td>
            </tr>          
            <tr>
                <td>REQUISICIONES DEVUELTAS </td>
                <td>".number_format($devueltas, 0)."</td>
                <td>".number_format(($row->cuenta > 0) ? ($devueltas/$row->cuenta)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>CON FALTANTE</td>
                <td>".number_format($faltante, 0)."</td>
                <td>".number_format(($devueltas > 0) ? ($faltante/$devueltas)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>CON FALTANTE Y SOBRANTE</td>
                <td>".number_format($falysob, 0)."</td>
                <td>".number_format(($devueltas > 0) ? ($falysob/$devueltas)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>CON SOBRANTE</td>
                <td>".number_format($sobrante, 0)."</td>
                <td>".number_format(($devueltas > 0) ? ($sobrante/$devueltas)*100 : 0, 2)."%</td>
            </tr>
            <tr>
                <td>SIN FALTANTE NI SOBRANTE</td>
                <td>".number_format($sinincidencias, 0)."</td>
                <td>".number_format(($devueltas > 0 ) ? ($sinincidencias/$devueltas)*100 : 0, 2)."%</td>
            </tr>
        </table>";
        
        return $tabla;
    }
    
    
    function reporte_folio_tot_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>FORMULADOS ENVIADOS</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }

    
    function reporte_folio_tot_detalle($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and tid='C' order by suc;";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>FOLIOS FORMULADOS ENVIADOS</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"lefht\"width=\"15%\">Faltante</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $faltante = $faltante + $row->faltante;
            $sobrante = $sobrante + $row->sobrante;
           
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return  $tabla;
    }
    
    
    function reporte_folio_tot_esp_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>ESPECIALES ENVIADOS</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }

    
    function reporte_folio_tot_esp_detalle($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and tid='C' order by suc, id;";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>FOLIOS ESPECIALES ENVIADOS</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"lefht\"width=\"15%\">Faltante</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $faltante = $faltante + $row->faltante;
            $sobrante = $sobrante + $row->sobrante;
           
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return  $tabla;
    }
    
    function reporte_folio_pendientes_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>FORMULADOS POR DEVOLVER</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_folio_pendientes_detalle($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and tid='C' and validar=0 order by suc, id;";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>FOLIOS FORMULADOS POR DEVOLVER</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"lefht\"width=\"15%\">Faltante</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $faltante = $faltante + $row->faltante;
            $sobrante = $sobrante + $row->sobrante;
           
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return  $tabla;
    }
    
    function reporte_folio_pendientes_esp_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>ESPECIALES POR DEVOLVER</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_folio_pendientes_esp_detalle($fecha1, $fecha2)
    
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis_especial f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and tid='C' and validar=0 order by suc, id;";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <td align=\"center\" colspan=\"6\"><strong>FOLIOS ESPECIALES POR DEVOLVER</strong></td>
        </tr>
        <tr>
        <th width=\"5%\"><strong>#</strong></th>
        <th align=\"center\" width=\"10%\">Folio</th>
        <th width=\"40%\">Sucursal</th>
        <th align=\"lefht\"width=\"15%\">Fecha</th>
        <th align=\"lefht\"width=\"15%\">Faltante</th>
        <th align=\"right\" width=\"15%\">Sobrante</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $n = 1;
        $sobrante = 0;
        $faltante = 0;
     
     
        if ($query->num_rows() > 0){
        foreach($query->result() as $row)
        {
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"center\" width=\"10%\">".$row->id."</td>
            <td width=\"40%\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"lefht\" width=\"15%\">".$row->fechas."</td>
            <td align=\"right\" width=\"15%\">".$row->faltante."</td>
            <td align=\"right\" width=\"15%\">".$row->sobrante."</td>
            </tr>
            ";
            $n++;
            $faltante = $faltante + $row->faltante;
            $sobrante = $sobrante + $row->sobrante;
           
        }
        
        }else{
                $tabla.="
                <tr>
                <td colspan=\"6\">NO HAY RESULTADOS</td>
                </tr>
                ";
            }	
        
        
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($faltante,2)."</td>
        <td align=\"right\">".number_format($sobrante,2)."</td>
      
        </tr>
        </tfoot>
        </table>";
        return  $tabla;
    }
    
    function regresa_folio($fecha1, $fecha2)
        {
        
        $sql = "SELECT s.nombre, f.* FROM catalogo.folio_pedidos_cedis f
        left join catalogo.sucursal s on f.suc=s.suc
        where fechas>='$fecha1'and fechas<='$fecha2' and tid='C' and validar=1;";
        $query = $this->db->query($sql);
        
        $tabla= "
        <table style=\"font-size: medium; \">
        <thead>
        <tr>
        <th>Folio</th>
        <th>Sucursal</th>
        <th>Fecha</th>
        <th>Faltante</th>
        <th>Sobrante</th>
        <th>Regresar</th>
        </tr>
        </thead>
        <tbody>
        ";
     
        foreach($query->result() as $row)
        {
             $tabla.="
            <tr>
            <td align=\"right\">".$row->id."</td>
            <td align=\"left\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"left\">".$row->fechas."</td>
            <td aling=\"left\">".$row->faltante."</td> 
            <td align=\"left\">".$row->sobrante."</td>
            <td align=\"left\">".anchor('a_surtido/regresa_falsob/'.$row->id.'/'.$row->validar, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para regresar a captura', 'class' => 'encabezado'))."</td>
            </tr>
            ";
        }
        
       $tabla.="
       </tbody>
       </table>";
        
        return $tabla;
    }
    
    

    function regresa_falsob_model($id)
    {
        $sql="update catalogo.folio_pedidos_cedis set validar=0 where id=$id";
        $query = $this->db->query($sql);
    }











}