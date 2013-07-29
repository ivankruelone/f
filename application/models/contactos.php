<?php
class Contactos extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

/////////////////////////////////////////////////////////////////////////////////////////
    function inserta_archivos($archivo, $size, $string)
    {
        $nivel = $this->session->userdata('nivel');
        $mensaje = null;
        
        
        $validacion = explode('.', $archivo);
        

        $data = array(
                'suc' => $this->session->userdata('suc'),
                'archivo' => $archivo,
                'size' => $size
                );
                
        $this->db->set('fecha', 'now()', FALSE);
                
        $this->db->insert('archivos', $data);
        $id = $this->db->insert_id();
        
        
        
        $query = $this->db->get_where('archivos', array('id' => $id));
        
        $row = $query->row();
        
        
            $a = "
            <p class=\"message-box alert\">$row->archivo - Subido ".$row->fecha.", Tama&ntilde;o ".number_format($row->size, 0)." Bytes.<br />Recibido Satisfactoriamente.</p>
            ";
            
            if(strtolower($validacion[1]) == 'pgea' || strtolower($validacion[1]) == 'inv' || strtolower($validacion[1]) == 'txt'){
                
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
if (strtolower($validacion[1]) == 'pgea'){
$aa=date('Y');
$me=date('m');
$di=date('d');

if($di>1){
$aaa=date('Y');
$mes=date('m');
$dia=date('d');
}else{
$aaa=date('Y');
$mes=date('m')-1;
$s="select *from catalogo.mes where num=$mes";
$q=$this->db->query($s);
if($q->num_rows() > 0){$r=$q->row();$dia=$r->dos;}
}
$fecha1=$aa."-".str_pad($me,2,"0",STR_PAD_LEFT)."-".str_pad($di,2,"0",STR_PAD_LEFT);
$fecha2=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-".str_pad($dia,2,"0",STR_PAD_LEFT);
$suc=0;
$fechap=0;
$val1='SI';
$val2='SI';
$val3='SI';
$mensaje='EL PEDIDO FUE ENVIADO CORRECTAMENTE';
$pedido='';

                     $string = file('./archivos/'.$archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                     $linea  = array_map('rtrim', $string); 
                     $extrae =$string[0];
                     $sucfuera=substr($extrae,1,4);
                      foreach($linea as $lin)
                    {
                      $b= $lin."<br />";
                         
                        $x=substr($lin,0,1);
                        $x2=substr($lin,5,1);
                        $x3=substr($lin,0,4);
                        $x4=substr($lin,0,8);
                        
                        if($x=='>' && $x2=='.'){
                        $suc=substr($lin,1,4);
                        $diap=substr($lin,6,2);
                        $mesp=substr($lin,8,2);
                        $aaap=substr($lin,10,2);
                        $fechap='20'.$aaap.'-'.str_pad($mesp,2,"0",STR_PAD_LEFT)."-".str_pad($diap,2,"0",STR_PAD_LEFT);
                        //////////////////////////////////////////////////////////////////valida si ya fue enviado
                        $dianombre=date('D');
                        $sql = "SELECT  * FROM  desarrollo.pedidos where suc=? and date_format(fechas,'%Y-%m-%d')= ? and fol<110000000";
                        $query = $this->db->query($sql,array($suc,$fechap));
                        if($query->num_rows() > 0){
                        $mensaje='YA FUE TRANSMITIDO EL PEDIDO';
                        $val1='NO';
                         }elseif($query->num_rows() == 0 and $nivel<> 15 and $nivel<>16){
                         $val1='SI';
                        $sqlw = "select *
                        from catalogo.sucursal a
                        left join catalogo.dias b on a.dia=b.dia
                        where a.suc=$suc and b.par='$dianombre'";
                        $queryw = $this->db->query($sqlw); 
                        if($queryw->num_rows() > 0 && $val1=='SI'  and $suc==$sucfuera){
                        $n = array(
                        'suc' => $suc,
                        'fechas' => date('Y-m-d')
                        );
		                $insert = $this->db->insert('catalogo.folio_pedidos_cedis', $n);
                        $id_cc= $this->db->insert_id();
                        }
                        
                        }
                        ////////////////////////////////////////////////////////pedido especial capturado nivel 15
                        //if(($nivel==15 || $nivel==16) || ($suc==102 ||$suc==103 ||$suc==105 ||$suc==141 ||$suc==108
                         //||$suc==109 ||$suc==124 ||$suc==115 ||$suc==107 ||$suc==129 ||$suc==202 ||$suc==112) ){
                         if($nivel==15 || $nivel==16){
                        $n = array(
                        'suc' => $suc,
                        'id_user' =>$this->session->userdata('id'),
                        'fechas' => date('Y-m-d')
                        );
		                $insert = $this->db->insert('catalogo.folio_pedidos_cedis_especial', $n);
                        $id_cc= $this->db->insert_id();
                        }
     
                        //////////////////////////////////////////////////////////////////valida si le toca transmitir hoy
                        
                        $sx="select *
                        from catalogo.sucursal a
                        left join catalogo.dias b on a.dia=b.dia
                        where a.suc=$suc and b.par='$dianombre'";
                        $qx=$this->db->query($sx);
                        if($qx->num_rows() == 0 and  $val1='SI' ){
                        $val2='NO';
                        $mensaje='EL DIA DE HOY NO TRASMITE PEDIDO';     
                        }
                        $sxz="select a.*,b.ruta
                        from catalogo.sucursal a
                        left join catalogo.almacen_rutas b on a.suc=b.suc
                        where a.suc=$suc";
                        $qxz=$this->db->query($sxz);
                        if($qxz->num_rows() > 0){
                        $rxz=$qxz->row();    
                        $tsuc=$rxz->tipo2;
                        $blo=$rxz->ruta;
                        $iva=$rxz->iva;     
                        }else{$tsuc='';}
                        
                         /////////////////////////////////////////////////////////valida si la fecha de pedido es correcta
                        
                        //if($fecha1==$fechap and $va2='SI' and $val2='SI'){
                        //$val3='SI';
                        //}
                        //if($fecha2==$fechap and $va2='SI' and $val2='SI'){
                        //$var3='SI';
                        //}
                        //if($val3=='NO' and $va2='SI' and $val2='SI'){
                        //$mensaje='LA FECHA NO CORRESPONDE AL DE LA SEMANA';
                        //}
                        
                        //////////////////////////////////////////////////////////////////
                        }
                        if($x3=='>08+'){
                         $pedido='SI';   
                        }
                         
                        
                        //if(($nivel==15 || $nivel==16) || ($suc==102 ||$suc==103 ||$suc==105 ||$suc==141 ||$suc==108
                         //||$suc==109 ||$suc==124 ||$suc==115 ||$suc==107 ||$suc==129 ||$suc==202 ||$suc==112) )
                        if($nivel==15 || $nivel==16){
                        
                            $val2 = 'SI';
                            $data11->id_user = $this->session->userdata('id');
                            $this->db->where('id', $id_cc);
                            $this->db->update('catalogo.folio_pedidos_cedis', $data11);
                        }
                        
                 
                        if($val1=='SI' and $x4=='00000000' and $pedido=='SI'  and $val2=='SI'){
                        $sec=substr($lin,0,13);$secfin=substr($lin,9,5);   
                        $can=substr($lin,14,4);
                        $ped=$can;
                        $tipo=1;
                            
                         //////////////////////////////////////////////////////////// verifica el mueble
                        $sxx="select a.sec, a.tsec, a.susa1, a.susa2, a.prv, a.prvx, a.lin, a.sublin, a.costo, a.publico, a.farmacia,
                        a.vtagen, a.vtaddr, a.codigo, a.id, a.persona, a.claves, a.clavep, a.clabo, a.maxbo, a.vtabo, a.antibio,
                        a.sim, a.metro from catalogo.almacen a
                        where a.sec=$secfin and tsec='G'";
                        $qxx=$this->db->query($sxx);
                        if($qxx->num_rows() > 0 ){
                        $rxx=$qxx->row();
                        //$mue=$rxx->mueble;
                        $susa=$rxx->susa1;
                        $cos=$rxx->costo;
                        $lin=$rxx->lin;
                        if($tsuc=='G'){$vta=$rxx->vtagen;}elseif($tsuc=='D'){$vta=$rxx->vtaddr;}elseif($tsuc=='F'){$vta=$rxx->vtaddr;}
                        
                        }else{
                        $sxx1="select *from catalogo.sec_generica where sec=$secfin";
                        $qxx1=$this->db->query($sxx1);
                        if($qxx1->num_rows() > 0 ){
                        $rxx1=$qxx1->row();
                        //$mue=$rxx1->mue;
                        $susa=$rxx1->susa1;
                        $cos=$rxx->costo;
                        $lin=$rxx->lin;
                        if($tsuc=='G'){$vta=$rxx->vtagen;}elseif($tsuc=='D'){$vta=$rxx->vtaddr;}elseif($tsuc=='F'){$vta=$rxx->publico;}
                        }else{$susa=' ';$tipo=4;$vta=0;$lin=0;}
                        }
                        //////////////////////////////////////////////////////////////,,,,,,,,,,,,descontinuada
                        //////////////////////////////////////////////////////////////,,,,,,,,,,,,pinches chamaquitos mulas
                        $pinchejorge="select *from catalogo.almacen_mue where sec=$secfin";
                        $pinchebaras=$this->db->query($pinchejorge);
                        if($pinchebaras->num_rows()>0){
                        $pincheivan=$pinchebaras->row();
                        $mue=$pincheivan->mueble;
                        }else{$mue=0;}
                        //////////////////////////////////////////////////////////////,,,,,,,,,,,,pinches chamaquitos mulas
                        //////////////////////////////////////////////////////////////,,,,,,,,,,,,descontinuada
                        $sxxx="select *from catalogo.almacen_borrar where sec=$secfin";
                        $qxxx=$this->db->query($sxxx);
                        if($qxxx->num_rows() > 0 ){
                        $tipo=4;
                        }
                        //////////////////////////////////////////////////////////////,,,,,,,,,,,,  
                       $sxxx1="select *from catalogo.almacen_paquetes where sec=$secfin";
                       $qxxx1=$this->db->query($sxxx1);
                       if($qxxx1->num_rows() > 0 ){
                       $rxxx1=$qxxx1->row();     
                       $paq=$rxxx1->can;
                        }else{
                        $paq=0;
                        }
                       
         $x=0;
         $fin=$ped;
         if($ped>=$paq and $paq>0){
         $x=$ped/$paq;
         $x=(round($x*1)/100)*100;
         $fin=$x*$paq;
         }
         
        if($paq==0){
        $fin=$ped;    
        }
        
        if($ped<$paq and $paq>0){
        $x=$paq/2;    
        if($ped<$x){
        $fin=$paq;      
        }else{
        $fin=$paq;    
        }
            
        }

 $sced="select *from inv_cedis_sec1 where sec=$secfin and inv1>0";

                       $qced=$this->db->query($sced);
                       if($qced->num_rows() > 0 ){
                       $rced=$qced->row();     
                       $incedis=$rced->inv1;
                       $surtido=$fin;
                        }else{
                        $surtido=0;
                        $incedis=0;
                        }
                         //////////////////////////////////////////////////////////////,,,,,,,,,,,,  
                                         if($id_cc<>null){          
                                             $new_member_insert_data = array(
        	                                 'suc' => $suc,
                                             'fecha' => $fechap,
                                             'iva'=>$iva,
                                             'costo'=>$cos,
                                             'vta'=>$vta,
                                             'sec' => $sec,
                                             'susa' => $susa,
                                             'mue' => $mue,
                                             'tipo' => $tipo,
                                             'ped' => $fin,
                                             'sur' => $surtido,
                                             'invcedis' => $incedis,
                                             'fol' => $id_cc,
                                             'tsuc' => $tsuc,
                                             'bloque' => $blo,
                                             'can' => $can
                                             
                                            );
                                            $this->db->set('fechas', 'now()', FALSE); 
		              $insert = $this->db->insert('desarrollo.pedidos', $new_member_insert_data);
                      echo $secfin;
                                            }
                      //////////////////////////////////////////////////////////////,,,,,,,,,,,,  
  
                        
                        }
                        }
   
                       // *******termina de gravar 08 y iniciamos con la el mueble 06 refoliar
                       $lid="select *from desarrollo.pedidos where suc=$suc and fecha='$fechap' and mue=6 and fol=$id_cc";
                       $lid1=$this->db->query($lid);
                        if($lid1->num_rows() > 0 ){
                            //if(($nivel==15 || $nivel==16) || ($suc==102 ||$suc==103 ||$suc==105 ||$suc==141 ||$suc==108
                         //||$suc==109 ||$suc==124 ||$suc==115 ||$suc==107 ||$suc==129 ||$suc==202 ||$suc==112) ){
                           if($nivel==15 || $nivel==16){
                                $nx = array(
                                    'suc' => $suc,
                                    'fechas' => date('Y-m-d'),
                                    'id_user' => $this->session->userdata('id')
                                );
                            
                        $insert06x = $this->db->insert('catalogo.folio_pedidos_cedis_especial', $nx);
                        $id_cc_06x= $this->db->insert_id();
                        
                        $datalidx = array(
                        'fol' => $id_cc_06x);
		                $this->db->where('mue', 6);
                        $this->db->where('fol', $id_cc);
                        $this->db->where('suc', $suc);
                        $this->db->update('pedidos', $datalidx);
                            
                            }else{
                                $nx = array(
                                    'suc' => $suc,
                                    'fechas' => date('Y-m-d')
                                );
                            
		                $insert = $this->db->insert('catalogo.folio_pedidos_cedis', $nx);
                        $id_cc_06= $this->db->insert_id();
                        
                        $datalid = array(
                        'fol' => $id_cc_06);
		                $this->db->where('mue', 6);
                        $this->db->where('fol', $id_cc);
                        $this->db->where('suc', $suc);
                        $this->db->update('pedidos', $datalid);
                        }
                        }
                       
                      // *******       

}
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////lidia
if(strtolower($validacion[1]) == 'pgea'){
    $mensaje='YA NO SE VAN A RECIBIR PEDIDOS.<BR /> AHORA LOS PEDIDOS SON FORMULADOS PARA ESO DEBES DE ENVIAR TU INVETNARIOS. GRACIAS';
    $a.="<pre>$string<pre><font size=\"+3\" color=\"#031A5C\"><strong>$mensaje</strong></font>";
    
    }             
			$a.="
            <pre>$string<pre><font size=\"+3\" color=\"#031A5C\"><strong>$mensaje</strong></font>
            ";
            }
            
            
        
        return $a;


    }
///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////

}
