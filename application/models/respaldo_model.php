 <?php
	class respaldo_model extends CI_Model {

function controlados(){
$l='control_comprac'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.control_comprac INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);    
$l='control_comprad'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.control_comprad INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);    
$l='control_dev'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.control_dev INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);    
$l='control_devd'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.control_devd INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='control_invc'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.control_invc INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='salidas_c'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.salidas_c INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);    

$l='salidas_cc'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from almacen.salidas_cc INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a); 
$l='cat_con'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.cat_con INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a); 
$l='suc_con'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from  catalogo.suc_con INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);   
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////almacen
/////////////////////////////////////////////////////////////////////////////////////////////////////////almacen
function catalogo(){

$l='catalogo.almacen'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_borrar'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_borrar INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a); 
$l='catalogo.almacen_mue'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_mue INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_paquetes'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_paquetes INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);



$l='catalogo.anio'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.anio INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.antibiotico'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.antibiotico INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.calendario_sem'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.calendario_sem INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.cat_almacen_clasifica'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.cat_almacen_clasifica INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);











$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);
$l='catalogo.almacen_rutas'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from catalogo.almacen_rutas INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a);














}
/////////////////////////////////////////////////////////////////////////////////////////////////////////almacen
/////////////////////////////////////////////////////////////////////////////////////////////////////////almacen

function vtadc(){
$l='venta_detalle'.date('YmdHis');
$nombre='"c:/wamp/www/subir10/envia/'.$l.'.txt"';    
$a="select *from vtadc.venta_detalle INTO OUTFILE $nombre FIELDS TERMINATED BY '||' LINES TERMINATED BY '\n\r';";
$this->db->query($a); 
   
$a="";
$this->db->query($a);    

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////



}


