<?php
class In_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function inv($in, $carpeta, $archivo, $metodo = FALSE)
    {
        $mov=0;
        if($metodo == FALSE){
            $string = file($in.$carpeta.'/'.$archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }else{
            $string = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
                    
        $extrae=$string[0];
        $suc=substr($extrae,1,4);
        $diap=substr($extrae,6,2);
        $mesp=substr($extrae,8,2);
        $aaap=substr($extrae,10,2);
        $fechap='20'.$aaap.'-'.str_pad($mesp,2,"0",STR_PAD_LEFT)."-".str_pad($diap,2,"0",STR_PAD_LEFT);
        $sxz="select SUBDATE(date(now()),INTERVAL 2 DAY)as di, a.*from catalogo.sucursal a where a.suc=$suc";
        $qxz=$this->db->query($sxz);
        if($qxz->num_rows() > 0){
            $rxz=$qxz->row();
            $tsuc=$rxz->tipo2;
            $cia=$rxz->cia;
            $fecha_limite=$rxz->di;
        }else{
            $tsuc=' ';
			$fecha_limite=date('Y-m-d');   
        }
        //echo "<pre>";
           
        //echo "$archivo - $fechap</pre>";
        //die(); 
           
        
        $this->db->delete('desarrollo.inv', array('suc' => $suc));
                   
        $linea = array_map('rtrim', $string);
        
        //$a = array();
        
        foreach($linea as $lin){
   
            $x5='';
            $b= $lin."<br />";
                        
            $x=substr($lin,0,1);
            $x2=substr($lin,5,1);
            $x3=substr($lin,0,4);
            $x4=substr($lin,0,9);
            $x5=substr($lin,0,1);
            //tsuc, id, suc, mov, codigo, cantidad, fechai, fechag, sec
            $cod=substr($lin,0,13);   
            $can=substr($lin,14,4);
            
            if($x3=='>07+'){
                $mov=7;
            }
            
            if($x3=='>03+'){
                $mov=3;
            }
            if($x3=='>91+'){
                $mov=0;
            }
            if($x3=='>41+'){
                $mov=41;
            }  
            
            $x5=substr($lin,18,1);
                         
            if($x5=='+' and $mov>0){//$x5=='+' and $can>0 para que no pase inventario en cero
                if($mov==7){
   	$sec=$cod;
                }
                
                if($mov==3){
                    $sec=0;
                }
                           
                $sww="select a.*from desarrollo.inv a where a.suc=$suc and a.codigo=$cod and mov=$mov";
                $qww=$this->db->query($sww);
                        
                if($qww->num_rows() == 0){
                    $new_member_insert_data = array(
        	                                 'tsuc' => $tsuc,
                                             'mov' => $mov,
                                             'suc' => $suc,
                                             'codigo' => $cod,
                                             'cantidad' => $can,
                                             'fechai' => $fechap,
                                             'sec' => $sec,
                                             'cia' => $cia
                                            );
$insert = $this->db->insert('desarrollo.inv', $new_member_insert_data);
$cos=0;$vta=0;

                    //array_push($a, $new_member_insert_data);
                }  
            }
                   
        }
        
        //$this->db->update_batch('desarrollo.inv', $a);
             
    }
//////////////////////////////////////////////////////////////////////////////////   
    function inv_backoffice($archivo)
    {
        $datos = explode('.', str_replace('./archivos/', '', $archivo));
        $this->db->select('tipo2, cia, back');
        $this->db->where('suc', $datos[0]);
        $query = $this->db->get('catalogo.sucursal');
        
        $row = $query->row();
        
        if($row->back == 1){
            $this->db->delete('desarrollo.inv', array('suc' => $datos[0]));
            
            
            $string = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $linea = array_map('rtrim', $string); 
            foreach($linea as $lin){
                
                $data = explode(',', $lin);
                
                $this->db->select('cantidad');
                $this->db->where('suc', $datos[0]);
                $this->db->where('codigo', $data[0]);
                $query2 = $this->db->get('inv');
                
                if($query2->num_rows() == 0)
                {
                
                    $new_member_insert_data = array(
                	                                 'tsuc' => $row->tipo2,
                                                     'mov' => 3,
                                                     'suc' => $datos[0],
                                                     'codigo' => $data[0],
                                                     'cantidad' => (int)$data[1],
                                                     'fechai' => date('Y-m-d'),
                                                     'sec' => 0,
                                                     'cia' => $row->cia
                                                    );
                    $insert = $this->db->insert('inv', $new_member_insert_data);
                
                }else{
                    
                    $row2 = $query2->row();
                    
                    $member_update_data = array(
                                            'cantidad'   => (int)$data[1] + $row2->cantidad
                                                );
                    $this->db->where('suc', $datos[0]);
                    $this->db->where('codigo', $data[0]);
                    $this->db->update('inv', $member_update_data); 
                }
                
            }
        
        }
    }
    
   function rv_compra_sola($in, $carpeta, $archivo)
    {

//die();
}   
    function rv_ad($in, $carpeta, $archivo)
    {
        $sql = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.venta_detalle
LINES STARTING BY 'VE0' TERMINATED BY '\r\n'
(@var1)
SET
suc = SUBSTR(@var1, 1, 7),
fecha = SUBSTR(@var1, 8, 8),
tiket = SUBSTR(@var1,16, 10),
codigo = SUBSTR(@var1, 26, 13),
descri = UCASE(TRIM(SUBSTR(@var1, 39, 35))),
can = TRIM(SUBSTR(@var1, 74, 7)),
vta = ROUND(TRIM(SUBSTR(@var1, 81, 11))/100, 2),
des = ROUND(TRIM(SUBSTR(@var1, 92, 11))/100, 3),
importe = ROUND((TRIM(SUBSTR(@var1, 81, 11))/100 - TRIM(SUBSTR(@var1, 92, 11))/100) * TRIM(SUBSTR(@var1, 74, 7)), 2),
iva = ROUND(TRIM(SUBSTR(@var1, 103, 11))/100, 2),
nombre = UCASE(TRIM(SUBSTR(@var1, 125, 30))),
dire = UCASE(TRIM(SUBSTR(@var1, 175, 100))),
cedula = TRIM(SUBSTR(@var1, 275, 10)),

tventa = TRIM(SUBSTR(@var1, 286, 1)),
tarjeta = TRIM(SUBSTR(@var1, 297, 13)),
tipo = SUBSTR(@var1, 310, 2),
consecu = TRIM(SUBSTR(@var1, 312, 10)),
nomina = TRIM(SUBSTR(@var1, 322, 7))
;";
//cancela = TRIM(SUBSTR(@var1, 285, 1)),

        $sql2 = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.compra_detalle
LINES STARTING BY 'CO0' TERMINATED BY '\r\n'
(@var1)
SET
suc = SUBSTR(@var1, 1, 7),
fecha = SUBSTR(@var1, 8, 8),
folio = TRIM(SUBSTR(@var1,16, 17)),
codigo = SUBSTR(@var1, 33, 13),
can = TRIM(SUBSTR(@var1, 46, 7)),
costo = ROUND(TRIM(SUBSTR(@var1, 90, 11))/100, 2),
iva = ROUND(TRIM(SUBSTR(@var1, 79, 11))/100, 2),
totfac = ROUND(TRIM(SUBSTR(@var1, 109, 11))/100, 2)
;";
$this->db->query($sql, $in.$carpeta.'/'.$archivo);

$sa = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.gc_compra_det
LINES STARTING BY 'CO0000'
(@var2)
SET
suc = SUBSTR(@var2, 1, 4),
aaa = SUBSTR(@var2, 5, 4),
mes = SUBSTR(@var2, 9, 2),
fecha = SUBSTR(@var2, 5, 8),
factura =UCASE(TRIM(SUBSTR(@var2,13, 17))),
codigo = SUBSTR(@var2, 30, 13),
can = TRIM(SUBSTR(@var2, 43, 7)),
costo = ROUND((TRIM(SUBSTR(@var2, 50, 11))/100), 2),
iva = ROUND((TRIM(SUBSTR(@var2, 76, 11))/100), 2),
impo = ROUND((TRIM(SUBSTR(@var2, 87, 11))/100), 2),
imp_fac = ROUND((TRIM(SUBSTR(@var2, 106, 11))/100), 2)
;"; 
 
$this->db->query($sa, $in.$carpeta.'/'.$archivo);
//echo $this->db->last_query();
//die();
        //$this->db->query($sql2, $in.$carpeta.'/'.$archivo);
        
    }


   function rv_can($in, $carpeta, $archivo)
    {



$s = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.cancelados
LINES STARTING BY '||CA0000'
(@var2)
SET
suc = SUBSTR(@var2, 1, 4),
aaa = SUBSTR(@var2, 5, 4),
mes = SUBSTR(@var2, 9, 2),
dia = SUBSTR(@var2, 11, 2),
fecha = SUBSTR(@var2, 5, 8),
tiket = SUBSTR(@var2,13, 10),
codigo = SUBSTR(@var2, 23, 13),
pieza = TRIM(SUBSTR(@var2, 71, 7)),
impor = ROUND((TRIM(SUBSTR(@var2, 78, 11))/100 - TRIM(SUBSTR(@var2, 89, 11))/100) * TRIM(SUBSTR(@var2, 71, 7)), 2)
;"; 

$this->db->query($s, $in.$carpeta.'/'.$archivo);
//echo $this->db->last_query();

}
///////////////////////////////////////////////////////////////
   function rv($in, $carpeta, $archivo)
    {
        $x1 = substr($archivo, 2, 4);

                    $string = file($in.$carpeta.'/'.$archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                   //////////////////////////////////////////////////////////////////////////////////////////
                   ////////////////////////////////////////////////////////////////////////////////////////// 
                   $linea = array_map('rtrim', $string); 
                      foreach($linea as $lin)
                    {

                        $x = substr($lin,0,3);
                        $y = substr($lin,0,5);
                        
                        if($x == 'TCP'){

                        $tarjeta=substr($lin,3,13);
                        $tipo=substr($lin,17,1);
                        $nombre=utf8_encode(substr($lin,18,35));
                        $dire=utf8_encode(substr($lin,118,200));
                        $dire2=utf8_encode(substr($lin,318,200));
                        $vigencia=substr($lin,628,8);
                        $venta=substr($lin,636,8);
                        $nomina=substr($lin,644,10);
                        $sx="select *from vtadc.tarjetas where suc = $x1 and codigo = $tarjeta and tipo = $tipo;";
                        $qx=$this->db->query($sx);
                        if($qx->num_rows() == 0){
                        $new_member_insert_data_tar = array(
//codigo, tipo, nombre, dire, dire2, vigencia, venta, nomina, suc, id
        	                                 'tipo' => $tipo,
                                             'nombre' => $nombre,
                                             'dire' => $dire,
                                             
                                             'dire2' => $dire2,
                                             'codigo' => $tarjeta,
                                             'vigencia' => $vigencia,
                                             'venta'=>$venta,
                                             'nomina'=>$nomina,
                                             'suc'=>$x1
                                            );
		                      $insert = $this->db->insert('vtadc.tarjetas', $new_member_insert_data_tar);   
                            }
                        
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        }elseif($y == '||TCP'){



                        $tarjeta=substr($lin,5,13);
                        $tipo=substr($lin,19,1);
                        $nombre=utf8_encode(substr($lin,20,35));
                        $dire=utf8_encode(substr($lin,120,200));
                        $dire2=utf8_encode(substr($lin,320,200));
                        $vigencia=substr($lin,630,8);
                        $venta=substr($lin,638,8);
                        $nomina=substr($lin,646,10);
                        $sx="select *from vtadc.tarjetas where suc = $x1 and codigo = $tarjeta and tipo = $tipo;";
                        $qx=$this->db->query($sx);
                        if($qx->num_rows() == 0){
                        $new_member_insert_data_tar = array(
//codigo, tipo, nombre, dire, dire2, vigencia, venta, nomina, suc, id
        	                                 'tipo' => $tipo,
                                             'nombre' => $nombre,
                                             'dire' => $dire,
                                             
                                             'dire2' => $dire2,
                                             'codigo' => $tarjeta,
                                             'vigencia' => $vigencia,
                                             'venta'=>$venta,
                                             'nomina'=>$nomina,
                                             'suc'=>$x1
                                            );
		                      $insert = $this->db->insert('vtadc.tarjetas', $new_member_insert_data_tar);   
                            }

                            
                        }
                    }   
        
    
            
    }

/////////////////////////////////
  function actializa($aaa,$mes)
    {
        
    
    }
/////////////////////////////////
}






