<?php
class Cor_cortes_model extends CI_Model
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

    function inserta_archivos($archivo, $size, $string)
    {
        
        
                $validacion = explode('.', $archivo);
        $this->load->library('unzip');
        $this->load->helper('directory');
        $this->load->helper('file');

        $data = array(
                'suc' => $this->session->userdata('suc'),
                'archivo' => $archivo,
                'fecha' => date('Y-m-d H:s:i'),
                'size' => $size
                );
                
        $this->db->insert('cortes_archivo', $data);
        $id = $this->db->insert_id();
        
        if($id > 0)
        {

            if(!is_dir('./cortes/'.$validacion[0].'/'))
            {
                mkdir('./cortes/'.$validacion[0].'/');
            }
            
            $this->unzip->extract('./cortes/'.$archivo, './cortes/'.$validacion[0].'/');
            $map = directory_map('./cortes/'.$validacion[0].'/');
            $string = null;
            foreach($map as $row){
                
                
                    $string = file('./cortes/'.$validacion[0].'/'.$row, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $linea = array_map('rtrim', $string);
                    $id_cc=0;
                    $t1_62=0;
                    $t2_62=0;
                    $t3_62=0;
                    $t1_64=0;
                    $t2_64=0;
                    $t3_64=0;
                    $t1_66=0;
                    $t2_66=0;
                    $t3_66=0;
                    $turno1_pesos=0;  
                    $turno1_dolar=0;  
                    $turno1_cambio=0;
                    $turno1_ta60=0;
                    $turno1_ta61=0;
                    $turno1_ta62=0;
                    $turno1_ta63=0;
                    $turno1_ta64=0;
                    $turno1_ta65=0;
                    $turno1_ta66=0;
                    $turno1_v70=0;
                    $turno1_v71=0;
                    $turno1_v72=0;
                    $turno1_v73=0;
                    $turno1_v74=0;
                    $turno1_v75=0;
                    $turno1_v76=0;
                    $turno1_mn=0;
                    $turno1_asalto=0;
                    $turno1_cajera=0;
                    $turno1_folio1=0;
                    $turno1_folio2=0;
                    $turno1_corte=0;
                    $turno1_sobrante=0;
                    $turno1_faltante=0;
                    
                    $turno2_pesos=0;  
                    $turno2_dolar=0;  
                    $turno2_cambio=0;
                    $turno2_ta60=0;
                    $turno2_ta61=0;
                    $turno2_ta62=0;
                    $turno2_ta63=0;
                    $turno2_ta64=0;
                    $turno2_ta65=0;
                    $turno2_ta66=0;
                    $turno2_v70=0;
                    $turno2_v71=0;
                    $turno2_v72=0;
                    $turno2_v73=0;
                    $turno2_v74=0;
                    $turno2_v75=0;
                    $turno2_v76=0;
                    $turno2_mn=0;
                    $turno2_asalto=0;
                    $turno2_cajera=0;
                    $turno2_folio1=0;
                    $turno2_folio2=0;
                    $turno2_corte=0;
                    $turno2_sobrante=0;
                    $turno2_faltante=0;
                    
                    $turno3_pesos=0;  
                    $turno3_dolar=0;  
                    $turno3_cambio=0;
                    $turno3_ta60=0;
                    $turno3_ta61=0;
                    $turno3_ta62=0;
                    $turno3_ta63=0;
                    $turno3_ta64=0;
                    $turno3_ta65=0;
                    $turno3_ta66=0;
                    $turno3_v70=0;
                    $turno3_v71=0;
                    $turno3_v72=0;
                    $turno3_v73=0;
                    $turno3_v74=0;
                    $turno3_v75=0;
                    $turno3_v76=0;
                    $turno3_mn=0;
                    $turno3_asalto=0;
                    $turno3_cajera=0;
                    $turno3_folio1=0;
                    $turno3_folio2=0;
                    $turno3_corte=0;
                    $turno3_sobrante=0;
                    $turno3_faltante=0;
                    $venta1=0;
                    $venta2=0;
                    $venta3=0;
                    $venta4=0;
                    $venta5=0;
                    $venta6=0;
                    $venta7=0;
                    $venta8=0;
                    $venta9=0;
                    $venta10=0;
                    $venta11=0;
                    $venta12=0;
                    $venta13=0;
                    $venta14=0;
                    $venta15=0;
                    $venta16=0;
                    $venta17=0;
                    $venta18=0;
                    $venta19=0;
                    $venta20=0;
                    $venta21=0;
                    $venta22=0;
                    $venta23=0;
                    $venta24=0;
                    $venta25=0;
                    $venta26=0;
                    $venta28=0;
                    $venta29=0;
                    $venta30=0;
                    $venta40=0;
                    $venta49=0;
                    $cance1=0;
                    $clave1=0;
                    $cance2=0;
                    $clave2=0;
                    $cance3=0;
                    $clave3=0;
                    $cance4=0;
                    $clave4=0;
                    $cance5=0;
                    $clave5=0;
                    $cance6=0;
                    $clave6=0;
                    $cance7=0;
                    $clave7=0;
                    $cance8=0;
                    $clave8=0;
                    $cance9=0;
                    $clave9=0;
                    $cance10=0;
                    $clave10=0;
                    $cance11=0;
                    $clave11=0;
                    $cance12=0;
                    $clave12=0;
                    $cance13=0;
                    $clave13=0;
                    $cance14=0;
                    $clave14=0;
                    $cance15=0;
                    $clave15=0;
                    $cance16=0;
                    $clave16=0;
                    $cance17=0;
                    $clave17=0;
                    $cance18=0;
                    $clave18=0;
                    $cance19=0;
                    $clave19=0;
                    $cance20=0;
                    $clave20=0;
                    $cance21=0;
                    $clave21=0;
                    $cance22=0;
                    $clave22=0;
                    $cance23=0;
                    $clave23=0;
                    $cance24=0;
                    $clave24=0;
                    $cance25=0;
                    $clave25=0;
                    $cance26=0;
                    $clave26=0;
                    $cance28=0;
                    $clave28=0;
                    $cance29=0;
                    $clave29=0;
                    $cance30=0;
                    $clave30=0;
                    $cance40=0;
                    $clave40=0;
                    $cance48=0;
                    $clave48=0;
                    $cance49=0;
                    $clave49=0;
                    $si='NO';
                    //$linea = explode('\r\n', $string);
                    $cl= null;
                    $turnox= null;
                    $ver= null;
                    $tsuc= null;
                    $b = null;
                    $x = null;
                    $xx = null;
                    $suc = null;
                    $dia = null;
                    $mes = null;
                    $aaa = null;
                    $turno = null;
                    $turno1_folio1 = null;
                    $turno1_folio2 = null;
                    $turno1_cajera = null;
                    $cia = null;
                    $plaza = null;
                    $succ = null;
                    $id_user = null;
                    $fechac = null;
                    foreach($linea as $lin)
                    {
                        $b= $lin."<br />";
                         
                        $x=substr($lin,0,2);
                        $xx=substr($lin,3,1);
                        $clave=substr($lin,4,2);
                        
                         
                        if($x=='SU'){$suc=substr($lin,3,4);
                        $sql = "SELECT  * FROM  catalogo.sucursal where suc=?";
                        $query = $this->db->query($sql,array($suc));
                        $row= $query->row();
                        $cia=$row->cia;
                        $plaza=$row->plaza;
                        $succ=$row->suc_contable;
                        $id_user_cor=$row->gere;
                        $id_user=$row->user_id;
                        $tsuc=$row->tipo2;
                        $iva=$row->iva+1;
                        $id_plaza=$row->id_plaza;
                        
                        }
                        
                       $caja=1;
                        
                        if($x=='FE'){$dia=substr($lin,3,2);$mes=substr($lin,5,2);$aaa=substr($lin,7,2)+2000; 
                        $fechac=$aaa."-".$mes."-".$dia;
                        
                        $aa = "SELECT  * FROM  corte_a where suc=$suc and fecha='$fechac'";
                        $bb = $this->db->query($aa);                        
 if($bb->num_rows()== 0){$si='SI';}
                        }
                        if($x=='CA'){$turno=substr($lin,4,1);}
                        if($x=='CA'){$turnox=substr($lin,3,2);}
                        

                        
                        if($x=='RI' && $turno==0 || $x=='RI' && $turnox==01 || $x=='RI' && $turnox==92){$turno1_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==0 || $x=='RF' && $turnox==01 || $x=='RF' && $turnox==92){$turno1_folio2=substr($lin,3,12);}
                        if($x=='CL' && $turno==0 || $x=='CL' && $turnox==01 || $x=='CL' && $turnox==92){$cl=substr($lin,3,1);}
                        if($x=='EM' && $turno==0 || $x=='EM' && $turnox==01 || $x=='EM' && $turnox==92){$turno1_cajera=substr($lin,3,7);}
                        
                        if($x=='CL' && $turno==0 && $clave==1 || $x=='CL' && $turnox==01 && $clave==1 || $x=='CL' && $turnox==92 && $clave==1){
                            if($cl==1){$venta1=substr($lin,9,8);$clave1=$clave;}
                            if($cl==2){$cance1=substr($lin,9,8);$clave1=$clave;}
                         }
                        if($x=='CL' && $turno==0 && $clave==2 || $x=='CL' && $turnox==01 && $clave==2 || $x=='CL' && $turnox==92 && $clave==2){
                            if($cl==1){$venta2=substr($lin,9,8);$clave2=$clave;}
                            if($cl==2){$cance2=substr($lin,9,8);$clave2=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==3 || $x=='CL' && $turnox==01 && $clave==3 || $x=='CL' && $turnox==92 && $clave==3){
                            if($cl==1){$venta3=substr($lin,9,8);$clave3=$clave;}
                            if($cl==2){$cance3=substr($lin,9,8);$clave3=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==4 || $x=='CL' && $turnox==01 && $clave==4 || $x=='CL' && $turnox==92 && $clave==4){
                            if($cl==1){$venta4=substr($lin,9,8);$clave4=$clave;}
                            if($cl==2){$cance4=substr($lin,9,8);$clave4=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==5 || $x=='CL' && $turnox==01 && $clave==5 || $x=='CL' && $turnox==92 && $clave==5){
                            if($cl==1){$venta5=substr($lin,9,8);$clave5=$clave;}
                            if($cl==2){$cance5=substr($lin,9,8);$clave5=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==6 || $x=='CL' && $turnox==01 && $clave==6 || $x=='CL' && $turnox==92 && $clave==6){
                            if($cl==1){$venta6=substr($lin,9,8);$clave6=$clave;}
                            if($cl==2){$cance6=substr($lin,9,8);$clave6=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==7 || $x=='CL' && $turnox==01 && $clave==7 || $x=='CL' && $turnox==92 && $clave==7){
                            if($cl==1){$venta7=substr($lin,9,8);$clave7=$clave;}
                            if($cl==2){$cance7=substr($lin,9,8);$clave7=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==8 || $x=='CL' && $turnox==01 && $clave==8 || $x=='CL' && $turnox==92 && $clave==8){
                            if($cl==1){$venta8=substr($lin,9,8);$clave8=$clave;}
                            if($cl==2){$cance8=substr($lin,9,8);$clave8=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==9 || $x=='CL' && $turnox==01 && $clave==9 || $x=='CL' && $turnox==92 && $clave==9){
                            if($cl==1){$venta9=substr($lin,9,8);$clave9=$clave;}
                            if($cl==2){$cance9=substr($lin,9,8);$clave9=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==10 || $x=='CL' && $turnox==01 && $clave==10 || $x=='CL' && $turnox==92 && $clave==10){
                            if($cl==1){$venta10=substr($lin,9,8);$clave10=$clave;}
                            if($cl==2){$cance10=substr($lin,9,8);$clave10=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==11 || $x=='CL' && $turnox==01 && $clave==11 || $x=='CL' && $turnox==92 && $clave==11){
                            if($cl==1){$venta11=substr($lin,9,8);$clave11=$clave;}
                            if($cl==2){$cance11=substr($lin,9,8);$clave11=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==12 || $x=='CL' && $turnox==01 && $clave==12 || $x=='CL' && $turnox==92 && $clave==12){
                            if($cl==1){$venta12=substr($lin,9,8);$clave12=$clave;}
                            if($cl==2){$cance12=substr($lin,9,8);$clave12=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==13 || $x=='CL' && $turnox==01 && $clave==13 || $x=='CL' && $turnox==92 && $clave==13){
                            if($cl==1){$venta13=substr($lin,9,8);$clave13=$clave;}
                            if($cl==2){$cance13=substr($lin,9,8);$clave13=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==14 || $x=='CL' && $turnox==01 && $clave==14 || $x=='CL' && $turnox==92 && $clave==14){
                            if($cl==1){$venta14=substr($lin,9,8);$clave14=$clave;}
                            if($cl==2){$cance14=substr($lin,9,8);$clave14=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==15 || $x=='CL' && $turnox==01 && $clave==15 || $x=='CL' && $turnox==92 && $clave==15){
                            if($cl==1){$venta15=substr($lin,9,8);$clave15=$clave;}
                            if($cl==2){$cance15=substr($lin,9,8);$clave15=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==16 || $x=='CL' && $turnox==01 && $clave==16 || $x=='CL' && $turnox==92 && $clave==16){
                            if($cl==1){$venta16=substr($lin,9,8);$clave16=$clave;}
                            if($cl==2){$cance16=substr($lin,9,8);$clave16=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==17 || $x=='CL' && $turnox==01 && $clave==17 || $x=='CL' && $turnox==92 && $clave==17){
                            if($cl==1){$venta17=substr($lin,9,8);$clave17=$clave;}
                            if($cl==2){$cance17=substr($lin,9,8);$clave17=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==18 || $x=='CL' && $turnox==01 && $clave==18 || $x=='CL' && $turnox==92 && $clave==18){
                            if($cl==1){$venta18=substr($lin,9,8);$clave18=$clave;}
                            if($cl==2){$cance18=substr($lin,9,8);$clave18=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==19 || $x=='CL' && $turnox==01 && $clave==19 || $x=='CL' && $turnox==92 && $clave==19){
                            if($cl==1){$venta19=substr($lin,9,8);$clave19=$clave;}
                            if($cl==2){$cance19=substr($lin,9,8);$clave19=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==20 || $x=='CL' && $turnox==01 && $clave==20 || $x=='CL' && $turnox==92 && $clave==20){
                            if($cl==1){$venta20=substr($lin,9,8);$clave20=$clave;}
                            if($cl==2){$cance20=substr($lin,9,8);$clave20=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==21 || $x=='CL' && $turnox==01 && $clave==21 || $x=='CL' && $turnox==92 && $clave==21){
                            if($cl==1){$venta21=substr($lin,9,8);$clave21=$clave;}
                            if($cl==2){$cance21=substr($lin,9,8);$clave21=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==22 || $x=='CL' && $turnox==01 && $clave==22 || $x=='CL' && $turnox==92 && $clave==22){
                            if($cl==1){$venta22=substr($lin,9,8);$clave22=$clave;}
                            if($cl==2){$cance22=substr($lin,9,8);$clave22=$clave;}
                             }
                        
                        if($x=='CL' && $turno==0 && $clave==23 || $x=='CL' && $turnox==01 && $clave==23 || $x=='CL' && $turnox==92 && $clave==23){
                            if($cl==1){$venta23=substr($lin,9,8);$clave23=$clave;}
                            if($cl==2){$cance23=substr($lin,9,8);$clave23=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==24 || $x=='CL' && $turnox==01 && $clave==24 || $x=='CL' && $turnox==92 && $clave==24){
                            if($cl==1){$venta24=substr($lin,9,8);$clave24=$clave;}
                            if($cl==2){$cance24=substr($lin,9,8);$clave24=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==25 || $x=='CL' && $turnox==01 && $clave==25 || $x=='CL' && $turnox==92 && $clave==25){
                            if($cl==1){$venta25=substr($lin,9,8);$clave25=$clave;}
                            if($cl==2){$cance25=substr($lin,9,8);$clave25=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==26 || $x=='CL' && $turnox==01 && $clave==26 || $x=='CL' && $turnox==92 && $clave==26){
                            if($cl==1){$venta26=substr($lin,9,8);$clave26=$clave;}
                            if($cl==2){$cance26=substr($lin,9,8);$clave26=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==28 || $x=='CL' && $turnox==01 && $clave==28 || $x=='CL' && $turnox==92 && $clave==28){
                            if($cl==1){$venta28=substr($lin,9,8);$clave28=$clave;}
                            if($cl==2){$cance28=substr($lin,9,8);$clave28=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==29 || $x=='CL' && $turnox==01 && $clave==29 || $x=='CL' && $turnox==92 && $clave==29){
                            if($cl==1){$venta29=substr($lin,9,8);$clave29=$clave;}
                            if($cl==2){$cance29=substr($lin,9,8);$clave29=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==30 || $x=='CL' && $turnox==01 && $clave==30 || $x=='CL' && $turnox==92 && $clave==30){
                            if($cl==1){$venta30=substr($lin,9,8);$clave30=$clave;}
                            if($cl==2){$cance30=substr($lin,9,8);$clave30=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==40 || $x=='CL' && $turnox==01 && $clave==40 || $x=='CL' && $turnox==92 && $clave==40){
                            if($cl==1){$venta40=substr($lin,9,8);$clave40=$clave;}
                            if($cl==2){$cance40=substr($lin,9,8);$clave40=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==48 || $x=='CL' && $turnox==01 && $clave==48 || $x=='CL' && $turnox==92 && $clave==48){
                            if($cl==1){$venta48=substr($lin,9,8);$clave48=$clave;}
                            if($cl==2){$cance48=substr($lin,9,8);$clave48=$clave;}
                             }
                         
                       if($x=='CL' && $turno==0 && $clave==49 || $x=='CL' && $turnox==01 && $clave==49 || $x=='CL' && $turnox==92 && $clave==49){
                            if($cl==1){$venta49=substr($lin,9,8);$clave49=$clave;}
                            if($cl==2){$cance49=substr($lin,9,8);$clave49=$clave;}
                             }      
                      
 if($si== 'SI'){

if($x=='CL' && $turno==1 && $clave==50 || $x=='CL' && $turnox==11 && $clave==50 || $x=='CL' && $turnox==21 && $clave==50){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==1 && $clave==80 || $x=='CL' && $turnox==11 && $clave==80 || $x=='CL' && $turnox==21 && $clave==80){
    $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==1 && $clave==81 || $x=='CL' && $turnox==11 && $clave==81 || $x=='CL' && $turnox==21 && $clave==81){
 $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==1 && $clave==82 || $x=='CL' && $turnox==11 && $clave==82 || $x=='CL' && $turnox==21 && $clave==82){
$new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);    
}
if($x=='CL' && $turno==1 && $clave==91 || $x=='CL' && $turnox==11 && $clave==91 || $x=='CL' && $turnox==21 && $clave==91){
$new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==1 && $clave==92 || $x=='CL' && $turnox==11 && $clave==92 || $x=='CL' && $turnox==21 && $clave==92){
$new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==1 && $clave==93 || $x=='CL' && $turnox==11 && $clave==93 || $x=='CL' && $turnox==21 && $clave==93){
$new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==1 && $clave==94 || $x=='CL' && $turnox==11 && $clave==94 || $x=='CL' && $turnox==21 && $clave==94){
$new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==50){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
                        
if($x=='CL' && $turno==2 && $clave==80){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==81){
                             $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==82){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==91){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==92){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==93){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==2 && $clave==94){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==50){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
                        

if($x=='CL' && $turno==3 && $clave==80){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==81){
                             $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==82){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==91){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==92){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==93){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
if($x=='CL' && $turno==3 && $clave==94){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>$clave,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,9,8),
                                'cancel'=>0,    
                                'corregido'=>substr($lin,9,8),
                                'siniva'=>substr($lin,9,8),
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
                        if($x=='CL' && $turno==1 && $clave==70 || $x=='CL' && $turnox==11 && $clave==70 || $x=='CL' && $turnox==21 && $clave==70){$turno1_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==71 || $x=='CL' && $turnox==11 && $clave==71 || $x=='CL' && $turnox==21 && $clave==71){$turno1_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==72 || $x=='CL' && $turnox==11 && $clave==72 || $x=='CL' && $turnox==21 && $clave==72){$turno1_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==73 || $x=='CL' && $turnox==11 && $clave==73 || $x=='CL' && $turnox==21 && $clave==73){$turno1_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==74 || $x=='CL' && $turnox==11 && $clave==74 || $x=='CL' && $turnox==21 && $clave==74){$turno1_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==75 || $x=='CL' && $turnox==11 && $clave==75 || $x=='CL' && $turnox==21 && $clave==75){$turno1_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==76 || $x=='CL' && $turnox==11 && $clave==76 || $x=='CL' && $turnox==21 && $clave==76){$turno1_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==70){$turno2_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==71){$turno2_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==72){$turno2_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==73){$turno2_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==74){$turno2_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==75){$turno2_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==76){$turno2_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==70){$turno3_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==71){$turno3_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==72){$turno3_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==73){$turno3_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==74){$turno3_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==75){$turno3_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==76){$turno3_v76=substr($lin,9,8);}
                        
                        if($x=='CL' && $turno==1 && $clave==60 || $x=='CL' && $turnox==11 && $clave==60 || $x=='CL' && $turnox==21 && $clave==60){$turno1_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==61 || $x=='CL' && $turnox==11 && $clave==61 || $x=='CL' && $turnox==21 && $clave==61){$turno1_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==63 || $x=='CL' && $turnox==11 && $clave==63 || $x=='CL' && $turnox==21 && $clave==63){$turno1_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==65 || $x=='CL' && $turnox==11 && $clave==65 || $x=='CL' && $turnox==21 && $clave==65){$turno1_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==62 || $x=='CL' && $turnox==11 && $clave==62 || $x=='CL' && $turnox==21 && $clave==62){$turno1_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==64 || $x=='CL' && $turnox==11 && $clave==64 || $x=='CL' && $turnox==21 && $clave==64){$turno1_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==66 || $x=='CL' && $turnox==11 && $clave==66 || $x=='CL' && $turnox==21 && $clave==66){$turno1_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==65){$turno2_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==63){$turno2_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==60){$turno2_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==61){$turno2_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==62){$turno2_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==64){$turno2_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==66){$turno2_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==62){$turno3_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==64){$turno3_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==66){$turno3_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==60){$turno3_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==61){$turno3_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==63){$turno3_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==65){$turno3_ta65=substr($lin,9,8);}

                        if($x=='RI' && $turno==2){$turno2_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==2){$turno2_folio2=substr($lin,3,12);}
                        if($x=='RI' && $turno==3){$turno3_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==3){$turno3_folio2=substr($lin,3,12);}
                        
                        if($x=='EM' && $turno==2){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>99,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,3,7),
                                'cancel'=>0,    
                                'corregido'=>0,
                                'siniva'=>0,
                                'tipo'=>2
                                );
                                $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);                        
                           }
                        if($x=='EM' && $turno==3){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>99,
                                'turno'=>$turno,    
                                'venta'=>substr($lin,3,7),
                                'cancel'=>0,    
                                'corregido'=>0,
                                'siniva'=>0,
                                'tipo'=>2
                                ); 
                                $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
                            }



                     
////////////////////graba concentrado////////////////////////////////////////////////////////
$caja=1;
// echo $fechac;
/////////////////////////////////////////**********+++++++++++++++++++++++++++++++++++++++++++++++++
/////////////////////////////////////////**********+++++++++++++++++++++++++++++++++++++++++++++++++
$recarga=0;
if($x=='TM'){
///////////////////////////////////////////////////////////////////////////////////                    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////fenix
if($tsuc=='F'){
    

                  if($venta1>0 || $venta25>0 || $venta28>0 || $venta29>0 ){//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            'clave1'=>$clave1,
                            'venta'=>$venta1+$venta25+$venta28+$venta29,
                            'cancel'=>$cance1+$cance25+$cance28+$cance29,
                            'corregido' =>$venta1+$venta25+$venta28+$venta29-$cance1-$cance25-$cance28-$cance29,
                            'siniva' =>$venta1+$venta25+$venta28+$venta29-$cance1-$cance25-$cance28-$cance29,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                            
                    if($venta2>0  || $venta3>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            'clave1'=>$clave2,
                            'venta'=>$venta2+$venta3,
                            'cancel'=>$cance2+$cance3,
                            'corregido' =>$venta2+$venta3-$cance2-$cance3,
                            'siniva' =>($venta2+$venta3-$cance2-$cance3)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    
                    if($venta4>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave4,
                            'venta'=>$venta4,
                            'cancel'=>$cance4,
                            'corregido'=>$venta4-$cance4,
                            'siniva'=>$venta4-$cance4,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta5>0 || $venta6>0 || $venta17>0 || $venta18>0 || $venta26>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave5,
                            'venta'=>$venta5+$venta6+$venta17+$venta18+$venta26,
                            'cancel'=>$cance5+$cance6+$cance17+$cance18+$cance26,
                            'corregido'=>$venta5+$venta6+$venta17+$venta18+$venta26-$cance5-$cance6-$cance17-$cance18-$cance26,
                            'siniva'=>($venta5+$venta6+$venta17+$venta18+$venta26-$cance5-$cance6-$cance17-$cance18-$cance26)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                      if($venta7>0 || $venta8>0){
                            
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>8,
                            'venta'=>$venta8+$venta7,
                            'cancel'=>$cance8+$cance7,
                            'corregido'=>$venta8+$venta7-$cance8-$cance7,
                            'siniva'=>$venta8+$venta7-$cance8-$cance7,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta9>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave9,
                            'venta'=>$venta9,
                            'cancel'=>$cance9,
                            'corregido'=>$venta9-$cance9,
                            'siniva'=>($venta9-$cance9)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta10>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave10,
                            'venta'=>$venta10,
                            'cancel'=>$cance10,
                            'corregido'=>$venta10-$cance10,
                            'siniva'=>$venta10-$cance10,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta11>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave11,
                            'venta'=>$venta11,
                            'cancel'=>$cance11,
                            'corregido'=>$venta11-$cance11,
                            'siniva'=>($venta11-$cance11)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta12>0 || $venta14>0 || $venta15>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave12,
                            'venta'=>$venta12+$venta14+$venta15,
                            'cancel'=>$cance12+$cance14+$cance15,
                            'corregido'=>$venta12+$venta14+$venta15-$cance12-$cance14-$cance15,
                            'siniva'=>$venta12+$venta14+$venta15-$cance12-$cance14-$cance15,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta13>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave13,
                            'venta'=>$venta13,
                            'cancel'=>$cance13,
                            'corregido'=>$venta13-$cance13,
                            'siniva'=>$venta13-$cance13,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta16>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave16,
                            'venta'=>$venta16,
                            'cancel'=>$cance16,
                            'corregido'=>$venta16-$cance16,
                            'siniva'=>$venta16-$cance16,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta19>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave19,
                            'venta'=>$venta19,
                            'cancel'=>$cance19,
                            'corregido'=>$venta19-$cance19,
                            'siniva'=>($venta19-$cance19)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }

                    if($venta20>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave20,
                            'venta'=>$venta20,
                            'cancel'=>$cance20,
                            'corregido'=>$venta20-$cance20,
                            'siniva'=>($venta20-$cance20)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    
                    if($venta21>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave21,
                            'venta'=>$venta21,
                            'cancel'=>$cance21,
                            'corregido'=>$venta21-$cance21,
                            'siniva'=>($venta21-$cance21)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta22>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave22,
                            'venta'=>$venta22,
                            'cancel'=>$cance22,
                            'corregido'=>$venta22-$cance22,
                            'siniva'=>$venta22-$cance22,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta23>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave23,
                            'venta'=>$venta23,
                            'cancel'=>$cance23,
                            'corregido'=>$venta23-$cance23,
                            'siniva'=>$venta23-$cance23,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                 if($venta24>0 ){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave1,
                            'venta'=>$venta24,
                            'cancel'=>$cance24,
                            'corregido' =>$venta24-$cance24,
                            'siniva' =>$venta24-$cance24,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }

                    if($venta30>0){
                    $new_member_insert_datax = array(
                           'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave30,
                            'venta'=>$venta30,
                            'cancel'=>$cance30,
                            'corregido'=>$venta30-$cance30,
                            'siniva'=>$venta30-$cance30,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta40>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave40,
                            'venta'=>$venta40,
                            'cancel'=>$cance40,
                            'corregido'=>$venta40-$cance40,
                            'siniva'=>$venta40-$cance40,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta49>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave49,
                            'venta'=>$venta49-$cance49,
                            'cancel'=>0,
                            'corregido'=>$venta49-$cance49,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
///////////////////////////////////////////////////////////////////////////////////                    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////genericas
}else{
                     if($venta2>0 || $venta3>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave2,
                            'venta'=>$venta2+$venta3,
                            'cancel'=>$cance2+$cance3,
                            'corregido' =>$venta2+$venta3-$cance2-$cance3,
                            'siniva' =>($venta2+$venta3-$cance2-$cance3)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    
                    if($venta4>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave4,
                            'venta'=>$venta4,
                            'cancel'=>$cance4,
                            'corregido'=>$venta4-$cance4,
                            'siniva'=>$venta4-$cance4,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta5>0 || $venta6>0 || $venta26>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave5,
                            'venta'=>$venta5+$venta6+$venta26,
                            'cancel'=>$cance5+$cance6+$cance26,
                            'corregido'=>$venta5+$venta6+$venta26-$cance5-$cance6-$cance26,
                            'siniva'=>($venta5+$venta6+$venta26-$cance5-$cance6-$cance26)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta9>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave9,
                            'venta'=>$venta9,
                            'cancel'=>$cance9,
                            'corregido'=>$venta9-$cance9,
                            'siniva'=>($venta9-$cance9)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta10>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave10,
                            'venta'=>$venta10,
                            'cancel'=>$cance10,
                            'corregido'=>$venta10-$cance10,
                            'siniva'=>$venta10-$cance10,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta11>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave11,
                            'venta'=>$venta11,
                            'cancel'=>$cance11,
                            'corregido'=>$venta11-$cance11,
                            'siniva'=>($venta11-$cance11)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta16>0 || $venta1>0 || $venta7>0 || $venta8>0 || $venta12>0 || $venta13>0 || $venta14>0 || $venta15>0 || $venta19>0 || $venta25>0 || $venta28>0 || $venta29>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave16,
                            'venta'=>$venta16+$venta1+$venta7+$venta8+$venta12+$venta13+$venta14+$venta15+$venta18+$venta19+$venta25+$venta28+$venta29,
                            'cancel'=>$cance16+$cance1+$cance7+$cance8+$cance12+$cance13+$cance14+$cance15+$cance18+$cance19+$cance25+$cance28+$cance29,
                            'corregido'=>$venta16+$venta1+$venta7+$venta8+$venta12+$venta13+$venta14+$venta15+$venta18+$venta19+$venta25+$venta28+$venta29-$cance16-$cance1-$cance7-$cance8-$cance12-$cance13-$cance14-$cance15-$cance18-$cance19-$cance25-$cance28-$cance29,
                            'siniva'=>$venta16+$venta1+$venta7+$venta8+$venta12+$venta13+$venta14+$venta15+$venta18+$venta19+$venta25+$venta28+$venta29-$cance16-$cance1-$cance7-$cance8-$cance12-$cance13-$cance14-$cance15-$cance18-$cance19-$cance25-$cance28-$cance29,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                     if($venta20>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave20,
                            'venta'=>$venta20,
                            'cancel'=>$cance20,
                            'corregido'=>$venta20-$cance20,
                            'siniva'=>($venta20-$cance20)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                     if($venta21>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave21,
                            'venta'=>$venta21,
                            'cancel'=>$cance21,
                            'corregido'=>$venta21-$cance21,
                            'siniva'=>($venta21-$cance21)/$iva,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                     if($venta22>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave22,
                            'venta'=>$venta22,
                            'cancel'=>$cance22,
                            'corregido'=>$venta22-$cance22,
                            'siniva'=>$venta22-$cance22,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }

                    if($venta23>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave23,
                            'venta'=>$venta23,
                            'cancel'=>$cance23,
                            'corregido'=>$venta23-$cance23,
                            'siniva'=>$venta23-$cance23,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta24>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave24,
                            'venta'=>$venta24,
                            'cancel'=>$cance24,
                            'corregido'=>$venta24-$cance24,
                            'siniva'=>$venta24-$cance24,
                           );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
  
                    if($venta30>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave30,
                            'venta'=>$venta30,
                            'cancel'=>$cance30,
                            'corregido'=>$venta30-$cance30,
                            'siniva'=>$venta30-$cance30,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta40>0){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave40,
                            'venta'=>$venta40,
                            'cancel'=>$cance40,
                            'corregido'=>$venta40-$cance40,
                            'siniva'=>$venta40-$cance40,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }
                    if($venta49>49){
                    $new_member_insert_datax = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'turno'=>0,
                            
                            'clave1'=>$clave49,
                            'venta'=>$venta49-$cance49,
                            'cancel'=>0,
                            'corregido'=>$venta49-$cance49,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_c', $new_member_insert_datax);                    
                            }    
///////////////////////////////////////////////////////////////////////////////////                    
}
/////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////                    
$vale1=$turno1_v70+$turno1_v71+$turno1_v72+$turno1_v73+$turno1_v74+$turno1_v75+$turno1_v76;

if($vale1>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>70,
                                'turno'=>1,    
                                'venta'=>$vale1,
                                'cancel'=>0,    
                                'corregido'=>$vale1,
                                'siniva'=>$vale1,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$vale2=$turno2_v70+$turno2_v71+$turno2_v72+$turno2_v73+$turno2_v74+$turno2_v75+$turno2_v76;                        
if($vale2>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>70,
                                'turno'=>2,    
                                'venta'=>$vale2,
                                'cancel'=>0,    
                                'corregido'=>$vale2,
                                'siniva'=>$vale2,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$vale3=$turno3_v70+$turno3_v71+$turno3_v72+$turno3_v73+$turno3_v74+$turno3_v75+$turno3_v76;                        
if($turno3_v70>0 || $turno3_v71>0 || $turno3_v72>0 || $turno3_v73>0 || $turno3_v74>0 || $turno3_v75>0 || $turno3_v76>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>70,
                                'turno'=>3,    
                                'venta'=>$vale3,
                                'cancel'=>0,    
                                'corregido'=>$vale3,
                                'siniva'=>$vale3,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t1_64=$turno1_ta64+$turno1_ta65;
if($t1_64>0 ){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>64,
                                'turno'=>1,    
                                'venta'=>$t1_64,
                                'cancel'=>0,    
                                'corregido'=>$t1_64,
                                'siniva'=>$t1_64,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t2_64=$turno2_ta64+$turno2_ta65;
if($t2_64>0 ){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>64,
                                'turno'=>2,    
                                'venta'=>$t2_64,
                                'cancel'=>0,    
                                'corregido'=>$t2_64,
                                'siniva'=>$t2_64,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t3_64=$turno3_ta64+$turno3_ta65;
if($t3_64>0 ){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>64,
                                'turno'=>3,    
                                'venta'=>$t3_64,
                                'cancel'=>0,    
                                'corregido'=>$t3_64,
                                'siniva'=>$t3_64,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t1_62= $turno1_ta62+$turno1_ta63;
if($t1_62>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>62,
                                'turno'=>1,    
                                'venta'=>$t1_62,
                                'cancel'=>0,    
                                'corregido'=>$t1_62,
                                'siniva'=>$t1_62,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}

$t2_62=$turno2_ta62+$turno2_ta63;
if($t2_62>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>62,
                                'turno'=>2,    
                                'venta'=>$t2_62,
                                'cancel'=>0,    
                                'corregido'=>$t2_62,
                                'siniva'=>$t2_62,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t3_62=$turno3_ta62+$turno3_ta63;
if($t3_62>0 ){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>64,
                                'turno'=>3,    
                                'venta'=>$t3_62,
                                'cancel'=>0,    
                                'corregido'=>$t3_62,
                                'siniva'=>$t3_62,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t1_66=$turno1_ta66+$turno1_ta60+$turno1_ta61;
if($t1_66>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>66,
                                'turno'=>1,    
                                'venta'=>$t1_66,
                                'cancel'=>0,    
                                'corregido'=>$t1_66,
                                'siniva'=>$t1_66,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t2_66=$turno2_ta66+$turno2_ta60+$turno2_ta61;
if($t2_66>0 ){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>66,
                                'turno'=>2,    
                                'venta'=>$t2_66,
                                'cancel'=>0,    
                                'corregido'=>$t2_66,
                                'siniva'=>$t2_66,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}
$t3_66=$turno3_ta66+$turno3_ta60+$turno3_ta61;
if($t3_66>0){
                            $new_member_insert_datab = array(//id, suc, turno, fecha, clave1, venta, cancel, corregido, siniva, tipo, caja
                                'caja'=>$caja,
        	                    'fecha' => $fechac,
                                'suc' => $suc,
                                'clave1'=>66,
                                'turno'=>3,    
                                'venta'=>$t3_66,
                                'cancel'=>0,    
                                'corregido'=>$t3_66,
                                'siniva'=>$t3_66,
                                'tipo'=>2
                                );
		             $insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_datab);
}

$new = array(
                            'suc'=>$suc,
                            'fecha'=>$fechac,
                            'tipo'=>2,
                            'id_cor'=>$id_user_cor,
                            'id_user'=>$id_user,
                            'id_plaza'=>$id_plaza,
                            'cia'=>$cia,
                            );
                            $insertx = $this->db->insert('desarrollo.corte_a', $new);

                    }}}
                
                
            }
            
            
            
            
            
        // solo cuando inserta datos en archivos.    
        }
        
        
        
        $query = $this->db->get_where('cortes_archivo', array('id' => $id));
        
        $row = $query->row();
        
            $a = "
            <p class=\"message-box alert\">$row->archivo - Subido ".$row->fecha.", Tama&ntilde;o ".number_format($row->size, 0)." Bytes.<br />Recibido Satisfactoriamente.</p>
            ";
            
            if($validacion[1] == 'pge' || $validacion[1] == 'inv' || $validacion[1] == 'txt'){
                
            $a.="
            <pre>$lin<pre>
            
            
            ";

            }else{
                foreach($map as $row){
                $a.= "Archivo: $row<br />";
                }
                
               
                
            }
            
            
        
        return $a;


    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function control()
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*, b.fecha
FROM catalogo.sucursal a
left join desarrollo.corte_a b on b.suc=a.suc
where a.user_id= 528 and a.suc=b.suc";
        $query = $this->db->query($sql,array($id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>Editar</th>
        <th>Edita</th>
        <th>Borrar</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $l1 = anchor('cor_cortes/tabla_detalle_proceso1/'.$row->fecha.'/'.$row->suc, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l2 = anchor('cor_cortes/delete_c//'.$row->fecha.'/'.$row->suc, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l3 = anchor('cor_cortes/tabla_detalle_prceso2/'.$row->fecha.'/'.$row->suc, '<img src="'.base_url().'img/icon_nav_settings.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$row->fecha."</td>
            <td align=\"left\">".$row->suc." - ".$row->nombre."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l3."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
         $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function busca_detalle($fecha,$suc)
    {
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*
          FROM desarrollo.corte_b a
          where a.fecha= ? and a.suc= ?";
        $query = $this->db->query($sql,array($fecha,$suc));
        
        return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function busca_ctl($fecha,$suc)
    {
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.iva
          FROM desarrollo.corte_a a
           left join catalogo.sucursal b on b.suc=a.suc
          where a.fecha= ? and a.suc= ?";
        $query = $this->db->query($sql,array($fecha,$suc));
        
        return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   function edita_detalle($fecha,$suc)
    {
        $num=1;
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*, b.linx,b.iva
FROM  desarrollo.corte_c a
left join catalogo.lineas_cortes b on b.lin=a.clave
where  fecha= ? and a.suc=?";

        $query = $this->db->query($sql,array($fecha,$suc));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"6\">FECHA $fecha  SUCURSAL $suc</th>
        </tr>
        <tr>
        <th>Lin</th>
        <th>Linea</th>
        <th>Importe</th>
        <th>Modifica</th>
        <th>Cancelado</th>
        <th>Total</th>
        </tr>

        </thead>
        <tbody>
        ";
$sin_iva=0;
$impo=0;
$impot=0;
$tot_vta=0;        
        foreach($query->result() as $row)
        {
            
        if($row->iva=='S'){$sin_iva=$sin_iva+($row->impo-($row->impo/1.16));}    
                 $tabla.="
            <tr>
            <td align=\"right\">".$row->clave1."</td>
            <td align=\"left\">".$row->linx."</td>
            <td align=\"right\">".$row->impo."</td>
            <td align='right' ><font size='-1'><input name='impor_$row->id' type='text' id='impor_$row->id' size='11' maxlength='11' value='$row->impo'/></font></td>
            <td align=\"right\">".$row->cancel."</td>
            <td align=\"right\">".number_format($row->impo - $row->cancel,2)."</td>
            </tr>
            ";
if($row->clave<30){$impo=$impo+$row->impo - $row->cancel;}else{$impot=$impot+($row->impo - $row->cancel);}

         
        }
        $impot=$impot+$impo;
        $color='blue';
        $tabla.="
            <tr>
            <td align=\"right\"></td>
            <td align=\"left\"><font color=\"$color\">TOTAL CONTADO</font></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"><strong><font color=\"$color\">".number_format(round($impo,2),2)."</font></strong></td>
            
            </tr>
            <tr>
            <td align=\"right\"></td>
            <td align=\"left\">TOTAL CONTADO Y CREDITO</td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"><strong><font color=\"orange\">".number_format(round($impot,2),2)."</font></strong></td>
            </tr>
            <tr>
            <td align=\"right\">49</td>
            <td align=\"left\">IVA DESGLOSADO</td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"><strong>".round($sin_iva,2)."</strong></td>
            </tr>";
           
  $tabla.="
        
        </tbody>
        </table>";
        $tot=$impo;
         $tabla.=$this->__turno($fecha,$suc,$tot);
$tabla.= "
        
        <script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"impor_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    

    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_impo(id, valor);

});

function actualiza_impo(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/cor_cortes/actualiza_impo/\", data: ({ id: id, valor: valor }),
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
  function __turno($fecha,$suc,$tot)
    {
        $num=1;
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*, b.linx,b.iva
FROM  desarrollo.corte_a a
left join catalogo.lineas_cortes b on b.lin=a.clave
where  fecha= ? and a.suc= ?";

        $query = $this->db->query($sql,array($fecha,$suc));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"2\"></th>
        <th>TURNO1</th>
        <th>TURNO2</th>
        <th>TURNO3</th>
        <th>TURNO4</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
$sin_iva=0;
$impo=0;
$tot_vta=0;
$color='black';        
        foreach($query->result() as $row)
        {
            if($row->clave==91){$color='blue'; $totx=$row->turno1+$row->turno2+$row->turno3+$row->turno4;}
            if($row->clave==92){$color='black';}
            if($row->clave==93){$color='red';}
                 $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$row->clave."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->linx."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->turno1,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->turno2,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->turno3,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->turno4,2)."</font></td>
            
            <td align=\"right\"><font color=\"$color\">".number_format($row->turno1+$row->turno2+$row->turno3+$row->turno4,2)."</font></td></tr>
            </tr>";
            
        }
        
       $tabla.="
        <tr>
         <td align=\"center\" colspan=\"7\"><font size=\"+1\"color=\"red\"> DIFERENCIA ".number_format($tot-$totx,2)."</font></td>
        </tr>
        </tbody>
        </table>";      
        
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function ta($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false);
        $client->soap_defencoding = 'UTF-8';
        
        $err = $client->getError();
        if ($err) {
        	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
        	exit();
        }
        // This is an archaic parameter list
        $params = array(
                            'user'		    => 'ivankruel',
                            'password'		=> 'garigol',
                            'sucursal'      => $sucursal,
                            'fecha'         => $fecha
                            );
        
        
        $result = $client->call('MontoSucursalDia', $params, 'http://ResultadoWSDL', 'ResultadoWSDL#MontoSucursalDia');
        
        if ($client->fault) {
        	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
        } else {
        	$err = $client->getError();
        	if ($err) {
        		echo '<h2>Error</h2><pre>' . $err . '</pre>';
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['monto'];
                
        	}
        }

    }


    public function tam($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/MontoSucursalMes_/wsdl", false);
        $client->soap_defencoding = 'UTF-8';
        
        $err = $client->getError();
        if ($err) {
        	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
        	exit();
        }
        // This is an archaic parameter list
        $params = array(
                            'user'		    => 'ivankruel',
                            'password'		=> 'garigol',
                            'sucursal'      => $sucursal,
                            'fecha'         => $fecha
                            );
        
        
        $result = $client->call('MontoSucursalMes', $params, 'http://ResultadoWSDL', 'ResultadoWSDL#MontoSucursalMes');
        
        if ($client->fault) {
        	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
        } else {
        	$err = $client->getError();
        	if ($err) {
        		echo '<h2>Error</h2><pre>' . $err . '</pre>';
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['monto'];
                
        	}
        }

    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function create_member($iva,$suc,$fecha,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
        $l1c,$l2c,$l4c,$l5c,$l8c,$l9c,$l10c,$l11c,$l12c,$l13c,$l16c,$l19c,$l20c,$l21c,$l22c,$l23c,$l24c,$l30c,$l40c,
        $efectivo1,$dolar1,$cambio1,$bbv1,$san1,$exp1,$asalto1,$vale1,$cajera1,$corte1,
        $efectivo2,$dolar2,$cambio2,$bbv2,$san2,$exp2,$asalto2,$vale2,$cajera2,$corte2,  
        $efectivo3,$dolar3,$cambio3,$bbv3,$san3,$exp3,$asalto3,$vale3,$cajera3,$corte3,
        $efectivo4,$dolar4,$cambio4,$bbv4,$san4,$exp4,$asalto4,$vale4,$cajera4,$corte4)
{
if($l1>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'=> $suc,'clave'=>1,'impo' =>$l1,'cancel'=>$l1c,'sin_iva'=>$l1+$l1c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l2>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>2,'impo' =>$l2,'cancel'=>$l2c,'sin_iva'=>($l2+$l2c)/$iva);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l>4){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>4,'impo' =>$l4,'cancel'=>$l4c,'sin_iva'=>$l4+$l4c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l5>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>5,'impo' =>$l5,'cancel'=>$l5c,'sin_iva'=>($l5+$l5c)/$iva);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l8>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>8,'impo' =>$l8,'cancel'=>$l8c,'sin_iva'=>$l8+$l8c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l9>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>9,'impo' =>$l9,'cancel'=>$l9c,'sin_iva'=>($l9+$l9c)/$iva);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l10>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>10,'impo' =>$l10,'cancel'=>$l10c,'sin_iva'=>$l10+$l10c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l11>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>11,'impo' =>$l11,'cancel'=>$l11c,'sin_iva'=>($l11+$l11c)/$iva);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l12>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>12,'impo' =>$l12,'cancel'=>$l12c,'sin_iva'=>$l12+$l12c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l13>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>13,'impo' =>$l13,'cancel'=>$l13c,'sin_iva'=>$l13+$l13c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l16>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>16,'impo' =>$l16,'cancel'=>$l16c,'sin_iva'=>$l16+$l16c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l19>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>19,'impo' =>$l19,'cancel'=>$l19c,'sin_iva'=>($l19+$l19c)/$iva);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l20>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>20,'impo' =>$l20,'cancel'=>$l20c,'sin_iva'=>($l20+$l20c)/$iva);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l21>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>21,'impo' =>$l21,'cancel'=>$l21c,'sin_iva'=>$l21+$l21c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l22>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>22,'impo' =>$l22,'cancel'=>$l22c,'sin_iva'=>$l22+$l22c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l23>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>23,'impo' =>$l23,'cancel'=>$l23c,'sin_iva'=>$l23+$l23c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l24>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>24,'impo' =>$l24,'cancel'=>$l24c,'sin_iva'=>$l24+$l24c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l30>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>30,'impo' =>$l30,'cancel'=>$l30c,'sin_iva'=>$l30+$l30c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}
if($l40>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>40,'impo' =>$l40,'cancel'=>$l40c,'sin_iva'=>$l40+$l40c);
$insert = $this->db->insert('desarrollo.corte_b', $new_member_insert_data);    
}

if($efectivo1>0 || $efectivo2>0 || $efectivo3>0 || $efectivo4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>50,
'turno1' =>$efectivo1,'turno2'=>$efectivo2,'turno3'=>$efectivo3,'turno4'=>$efectivo4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($dolar1>0 || $dolar2>0 || $dolar3>0 || $dolar4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>80,
'turno1' =>$dolar1,'turno2'=>$dolar2,'turno3'=>$dolar3,'turno4'=>$dolar4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($cambio1>0 || $cambio2>0 || $cambio3>0 || $cambio4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>81,
'turno1' =>$cambio1,'turno2'=>$cambio2,'turno3'=>$cambio3,'turno4'=>$cambio4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($bbv1>0 || $bbv2>0 || $bbv3>0 || $bbv4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>64,
'turno1' =>$bbv1,'turno2'=>$bbv2,'turno3'=>$bbv3,'turno4'=>$bbv4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($san1>0 || $san2>0 || $san3>0 || $san4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>66,
'turno1' =>$san1,'turno2'=>$san2,'turno3'=>$san3,'turno4'=>$san4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($exp1>0 || $exp2>0 || $exp3>0 || $exp4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>62,
'turno1' =>$exp1,'turno2'=>$exp2,'turno3'=>$exp3,'turno4'=>$exp4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($asalto1>0 || $asalto2>0 || $asalto3>0 || $asalto4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>94,
'turno1' =>$asalto1,'turno2'=>$asalto2,'turno3'=>$asalto3,'turno4'=>$asalto4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($vale1>0 || $vale2>0 || $vale3>0 || $vale4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>70,
'turno1' =>$vale1,'turno2'=>$vale2,'turno3'=>$vale3,'turno4'=>$vale4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}
if($cajera1>0 || $cajera2>0 || $cajera3>0 || $cajera4>0){$new_member_insert_data = array(
'fecha'=> $fecha,'suc'  => $suc,'clave'=>66,
'turno1' =>$cajera1,'turno2'=>$cajera2,'turno3'=>$cajera3,'turno4'=>$cajera4);
$insert = $this->db->insert('desarrollo.corte_c', $new_member_insert_data);    
}

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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}