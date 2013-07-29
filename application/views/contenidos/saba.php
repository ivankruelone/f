<?php
set_include_path(get_include_path() . PATH_SEPARATOR .
    './application/libraries/phpexcel/Classes');
include 'PHPExcel/IOFactory.php';
$inputFileType = 'Excel5';
$inputFileName = $filePath;

$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

$a = array();

$this->db->query("delete from catalogo.cat_saba_temp");

foreach ($sheetData as $row) {
    
    $b = array(
        'cod_saba' => (string )$row['A'],
        'ean' => (string )$row['B'],
        'descripcion' => (string )$row['C'],
        'proveedor' => (string )$row['D'],
        'status_pro' => (string )$row['E'],
        'registro' => (string )$row['F'],
        'clave_iva' => (string )$row['G'],
        'iva' => (string )$row['H'],
        'precio_publico' => (string )$row['I'],
        'precio_farmacia' => (string )$row['J'],
        'desc_maximo' => (float )$row['K'],
        'tipo_desc' => (string )$row['L'],
        'mult_vta' => (string )$row['M'],
        'seccion' => (string )$row['N'],
        'seccion_salubridad' => (string )$row['O'],
        'castigo_dev' => (string )$row['P'],
        'modifica' => date('Y-m-d H:i:s'));
        
    if((string )$row['A'] == 'Codigo Saba'){
        
    }else{
        array_push($a, $b);
    }
    
}

$this->db->insert_batch('catalogo.cat_saba_temp', $a);

$sql = "insert into
catalogo.cat_saba
(cod_saba, ean, descripcion, proveedor, status_pro, registro, clave_iva, iva, precio_publico, precio_farmacia, desc_maximo, tipo_desc, mult_vta, seccion, seccion_salubridad, castigo_dev, agregado, modificado)
(SELECT cod_saba, ean, descripcion, proveedor, status_pro, registro, clave_iva, iva, precio_publico, precio_farmacia, desc_maximo, tipo_desc, mult_vta, seccion, seccion_salubridad, castigo_dev, now(), modifica FROM catalogo.cat_saba_temp)
on duplicate key update descripcion = values(descripcion), proveedor = values(proveedor), status_pro = values(status_pro), registro = values(registro), clave_iva = values(clave_iva), iva = values(iva), precio_publico = values(precio_publico), precio_farmacia = values(precio_farmacia), desc_maximo = values(desc_maximo), tipo_desc = values(tipo_desc), mult_vta = values(mult_vta), seccion = values(seccion), seccion_salubridad = values(seccion_salubridad), castigo_dev = values(castigo_dev), modificado = values(modificado);";

$this->db->query($sql);

?>