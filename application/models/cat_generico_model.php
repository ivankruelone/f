<?php
class cat_generico_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function busca_sec($id,$sec)
    {
   	$sql = "select b.nombre as personax, a.*
from catalogo.almacen a
left join catalogo.cat_comprador b on b.persona=a.persona
where a.id = ? and a.sec= ?
		";
        $query = $this->db->query($sql,array($id,$sec));
        //echo $this->db->last_query();
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
 function segpop($tit)
    {
     $sql = "select *from catalogo.segpop where tip<>'X'";
        $query = $this->db->query($sql);
         $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        <tr>
        <th>Clave</th>
        <th>Sustancia Activa</th>
        <th>Prv</th>
        <th>Proveedor</th>
        <th>Costo</th>
        <th>Max Agu</th>
        <th>Max Zac</th>
        <th>Max Che</th>
        
        </tr>
        </thead>
        <tbody>
        ";
        $color='blue';
        foreach($query->result() as $row)
        {
        
        
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->claves."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prvx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->costo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->maxagu."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->maxzac."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->maxche."</font></td>
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
 function sec_generico()
    {
     $sql = "select *from catalogo.compras_sec";
        $query = $this->db->query($sql);
         $tabla= "
        <table>
        <thead>
        
        
        <tr>
        <th>SECUENCIA INICIAL</th>
        <th>SECUENCIA FINAL</th>
        
        </tr>
        </thead>
        <tbody>
        ";
        foreach($query->result() as $row)
        {
        $l1 = anchor('cat_generico/tabla_catalogo_gen/'.$row->sec1.'/'.$row->sec2, $row->sec1.'</a>', array('title' => 'Haz Click aqui para copiar la clave!', 'class' => 'encabezado'));
        
        $color='blue';
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->sec2."</font></td>
            
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cedis_generico($sec1,$sec2)
    {
     $sql = "SELECT b.nombre as personax, a.* 
     from catalogo.almacen a 
     left join catalogo.cat_comprador b on b.persona=a.persona  
     where sec>=$sec1 and sec<=$sec2
     order by a.sec, persona";
        $query = $this->db->query($sql);
       $l1 = anchor('cat_generico/agrega_producto/'.$sec1.'/'.$sec2, 'AGREGAR PRODUCTO</a>', array('title' => 'Haz Click aqui para agregar producto!', 'class' => 'encabezado'));
       $l0 = anchor('cat_generico/tabla_catalogo_gen_expo', 'EXPORTAR ARCHIVO</a>', array('title' => 'Haz Click aqui para generar catalogo!', 'class' => 'encabezado','target' => 'blank'));     
        $tabla= "
        <table>
        <thead>
        <tr> 
        <th colspan=\"8\" align=\"center\">$l0</th>
        </tr>
        <tr> 
        <td colspan=\"8\">$l1</td>
        </tr>
        
        <tr>
        <th>Codigo</th>
        <th>Sustancia Activa<br />Descripcion</th>
        <th>Proveedor</th>
        <th>Costo</th>
        <th>$ Gen</th>
        <th>$ Ddr</th>
        <th>$ Pub</th>
        <th>Comprador</th>
        </tr>
        </thead>
        <tbody>
        ";
        foreach($query->result() as $row)
        {
        $l2 = anchor('cat_generico/copiar_producto/'.$row->id.'/'.$row->sec.'/'.$sec1.'/'.$sec2, $row->sec.'</a>', array('title' => 'Haz Click aqui para copiar la clave!', 'class' => 'encabezado'));
        if($row->sec>=5000){$l3 = anchor('cat_generico/editar_producto/'.$row->id.'/'.$row->sec.'/'.$sec1.'/'.$sec2, 'EDITAR </a>', array('title' => 'Haz Click aqui para editar clave!', 'class' => 'encabezado'));
        }else{$l3=$row->susa1;}
        if($row->tsec=='G'){$color='blue';}else{$color='black';}    
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$l2."<br /> ".$row->tsec."<br /> ".$row->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">$l3 <BR />".$row->susa1."<br /> ".$row->susa2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prv." - ".$row->prvx."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->costo,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->vtagen,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->vtaddr,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->publico,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->personax."</font></td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function agrega_member_copia($id,$sec,$cod,$per,$descri,$costo,$prov,$tsec)
{
$s="insert into catalogo.almacen 
(sec, tsec, susa1, susa2, prv, prvx, lin, sublin, costo, publico, farmacia, vtagen, vtaddr, codigo,  persona, claves, clavep, clabo, maxbo, vtabo, mue, antibio, sim, metro)
(select sec, '$tsec', susa1, '$descri', $prov, b.corto, lin, sublin, $costo, publico, farmacia, vtagen, vtaddr, $cod,  '$per', claves, clavep, clabo, maxbo, vtabo, mue, antibio, sim, metro from catalogo.almacen a left join catalogo.provedor b on b.prov=$prov where a.id=$id and sec=$sec and b.prov=$prov)";
$this->db->query($s);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function agrega_member($sec,$cod,$per,$descri,$costo,$prov,$claves,$slin,$lin,$susa,$pub)
{
$s="insert into catalogo.almacen 
(sec, tsec, susa1, susa2, prv, prvx, lin, sublin, costo, publico, farmacia, vtagen, vtaddr, codigo,  persona, claves, clavep, clabo, maxbo, vtabo, mue, antibio, sim, metro)
(select ($sec+1), 'G', '$susa', '$descri', $prov, b.corto, $lin, $slin, $costo, $pub, 0, 0, 0, $cod,  '$per', '$claves', '$claves', 0, 0, 0, 0, 'N', 0, 'S' from catalogo.almacen a left join catalogo.provedor b on b.prov=$prov where sec=$sec and b.prov=$prov)";
$this->db->query($s);

         $new_member_insert_data = array(
            'id'  =>$sec+1,
            'user_id' =>$this->session->userdata('id'),
            'fecha' =>date('Y-m-d H:s:i'),
            );
		$insert = $this->db->insert('catalogo.sec_metro_6000', $new_member_insert_data);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function cambia_member($id,$sec,$cod,$per,$descri,$costo,$prov,$claves,$susa,$pub,$tsec)
{

$s="select *from catalogo.provedor b where b.prov=$prov";
$q=$this->db->query($s);

if($q->num_rows() == 1){
$r= $q->row();
$prvx=$r->corto;

$data = array(
            'codigo'  =>$cod,
            'persona' =>$per,
            'susa2' =>$descri,
            'costo' =>$costo,
            'publico' =>$pub,
            'prv' =>$prov,
            'prvx'=>$prvx,
            'claves'=>$claves,
            'tsec'=>$tsec,
            'susa1'=>$susa
            );
		$this->db->where('id', $id);
        $this->db->update('catalogo.almacen', $data);
}}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function catalogo_cat_compras(){
$s1="load data infile 'c:/wamp/www/subir10/gen.gen' replace into table catalogo.almacen FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(tsec,sec, susa1, susa2, prv, prvx, lin, sublin, costo, publico, farmacia, vtagen, vtaddr, codigo, clabo, maxbo, vtabo, mue,sim,metro)";
$this->db->query($s1);
$s2="update catalogo.almacen a, catalogo.antibiotico b set a.antibio='S' where  a.sec=b.sec";
$this->db->query($s2);
$s3="load data infile 'c:/wamp/www/subir10/gea.gen' replace into table catalogo.almacen_bitacora FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($s3);
$s4="update catalogo.almacen a, catalogo.almacen_mue b set a.mue=b.mueble where a.sec=b.sec";
$this->db->query($s4);
$s5="LOAD DATA INFILE 'c:/wamp/www/subir10/seg.seg' INTO TABLE subir10.p_cat_segpop LINES TERMINATED BY '\r\n';";
$this->db->query($s5);
$s7="update almacen.compraped a, desarrollo.compra_d_orden_sec b
set a.aplica=b.can
where a.folprv=b.orden and a.sec=b.sec and a.sec>0 and a.tipo='alm'";
$this->db->query($s7);

$sqlx="select *from catalogo.almacen where 
sec>=1 and sec<=2000  and codigo<>0 and vtagen>0 and tsec<>'M'
or
sec>=3000 and sec<=3999  and codigo<>0 and vtagen>0 and tsec<>'M'";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
  
    $File = "./txt/catgen.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
if($rowx->lin==1 and $rowx->sublin==5){$sublin=4;}else{$sublin=$rowx->sublin;}
$inv='S';
if($rowx->sec>=3032 and $rowx->sec<=3043){$inv='N';}
$susa1=substr($rowx->susa1,0,50);
$susa2=substr($rowx->susa2,0,50);
$s1="select *from catalogo.cat_naturistas where sec=$rowx->sec";
$q1 = $this->db->query($s1);
if($q1->num_rows() > 0){$natur=1;}else{$natur=0;}
$s2="select *from catalogo.antibiotico where sec=$rowx->sec or cod=$rowx->codigo";
$q2 = $this->db->query($s2);
if($q2->num_rows() > 0){$antibio='S';}else{$antibio='N';} 
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa1),50," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($sublin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->vtagen,12,"0",STR_PAD_LEFT)
        .str_pad($rowx->sec,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa2),50," ",STR_PAD_RIGHT)
        .str_pad($antibio,1," ",STR_PAD_LEFT)
        .str_pad($natur,1," ",STR_PAD_LEFT)
        .str_pad($inv,1," ",STR_PAD_LEFT)
        .str_pad($rowx->vtagen,12,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 
}
$sqlx="select *from catalogo.almacen where 
sec>=1 and sec<=2000 and codigo<>0 and vtaddr>0 and tsec<>'M'
or
sec>=3000 and sec<=3999 and codigo<>0 and vtaddr>0 and tsec<>'M'
";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/catddr.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
if($rowx->lin==1 and $rowx->sublin==5){$sublin=4;}else{$sublin=$rowx->sublin;}
$susa1=substr($rowx->susa1,0,50);
$susa2=substr($rowx->susa2,0,50);

  $inv ='S';
if($rowx->sec>=3032 and $rowx->sec<=3043){$inv='N';}
$s1="select *from catalogo.cat_naturistas where sec=$rowx->sec";
$q1 = $this->db->query($s1);
if($q1->num_rows() > 0){$natur=1;}else{$natur=0;}
$s2="select *from catalogo.antibiotico where sec=$rowx->sec or cod=$rowx->codigo";
$q2 = $this->db->query($s2);
if($q2->num_rows() > 0){$antibio='S';}else{$antibio='N';} 
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa1),50," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($sublin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->vtaddr,12,"0",STR_PAD_LEFT)
        .str_pad($rowx->sec,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa2),50," ",STR_PAD_RIGHT)
        .str_pad($antibio,1," ",STR_PAD_LEFT)
        .str_pad($natur,1," ",STR_PAD_LEFT)
        .str_pad($inv,1," ",STR_PAD_LEFT)
        .str_pad($rowx->vtaddr,12,"0",STR_PAD_LEFT)

        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle);
}
///////////////////FARMABODEGA

$sqlx="select *from catalogo.almacen where sec>0 and sec<=2000 and codigo>0 and vtabo>0 and tsec<>'M'";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
     $File = "./txt/catbod.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
if($rowx->lin==1 and $rowx->sublin==5){$sublin=4;}else{$sublin=$rowx->sublin;}
$susa1=substr($rowx->susa1,0,50);
$susa2=substr($rowx->susa2,0,50);

$inv ='S';
if($rowx->sec>=3032 and $rowx->sec<=3043){$inv='N';}
$natur=0;
$s2="select *from catalogo.antibiotico where sec=$rowx->sec or cod=$rowx->codigo";
$q2 = $this->db->query($s2);
if($q2->num_rows() > 0){$antibio='S';}else{$antibio='N';} 
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa1),50," ",STR_PAD_RIGHT)
        .str_pad($rowx->lin,2,"0",STR_PAD_LEFT)
        .str_pad($sublin,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->vtabo,12,"0",STR_PAD_LEFT)
        .str_pad($rowx->clabo,13,"0",STR_PAD_LEFT)
        .str_pad(utf8_decode($susa2),50," ",STR_PAD_RIGHT)
        .str_pad($antibio,1," ",STR_PAD_LEFT)
        .str_pad($natur,1," ",STR_PAD_LEFT)
        .str_pad($inv,1," ",STR_PAD_LEFT)
        .str_pad($rowx->vtabo,12,"0",STR_PAD_LEFT)

        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle);
}
 
//////////////////////////////////////////////////////////////////////////catalogo de farmabodega
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\arcenv.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\SUC1601.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\SUC1602.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\SUC1603.zip') === TRUE) {
$zip->addFile('./txt/catbod.txt', 'catbod.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}



$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\arcenv.zip') === TRUE) {
$zip->addFile('./txt/catddr.txt', 'catddr.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
}
$zip = new ZipArchive;
if ($zip->open('E:\pdvsube\pasucursales\arcenv.zip') === TRUE) {
$zip->addFile('./txt/catgen.txt', 'catgen.txt');
$zip->close();
echo 'ok';
} else {
echo 'failed';
} 
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cedis_generico_expor()
    {
     $sql = "SELECT b.nombre as personax, a.* from catalogo.almacen a left join catalogo.cat_comprador b on b.persona=a.persona  order by a.sec, persona";
        $query = $this->db->query($sql);
         $tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"13\">CATALOGO DE GENERICOS</th>
        </tr>
        <tr>
        <th>Sec</th>
        <th>T.sec</th>
        <th>Codigo</th>
        <th>Sustancia Activa</th>
        <th>Descripcion</th>
        <th>Prv</th>
        <th>Proveedor</th>
        <th>$ Sim</th>
        <th>$ Costo</th>
        <th>$ Pub</th>
        <th>$ Gen</th>
        <th>$ Ddr</th>
        <th>Comprador</th>
        </tr>
        </thead>
        <tbody>
        ";
        foreach($query->result() as $row)
        {
        if($row->tsec=='G'){$color='blue';}else{$color='black';}    
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->tsec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prvx."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->sim,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->costo,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->publico,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->vtagen,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".number_format($row->vtaddr,2)."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->personax."</font></td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        echo $tabla;
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
 
}
