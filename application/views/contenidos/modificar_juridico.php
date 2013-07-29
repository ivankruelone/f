<?php
	$this->db->where('id', $id);
    $query = $this->db->get('cfd');
    $row = $query->row();
?>
<h2>Modificar Factura:</h2>
<br/>

<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	echo form_open('facturas_juridico/submit_modificar', 'id="facturas_juridico"');
    echo form_hidden('id',$id); 
        
    
    
    
$data_recepcion = array(
              'name'        => 'recepcion',
              'id'          => 'recepcion',
              'size'        => '25',
              'type'        => 'date',
              'value'       => $row->recepcion,
              'autofocus'   => 'autofocus',
              'required'    => 'required',
              
              
            );
    echo form_label('<b>Recepci&oacute;n:</b> 2000-01-01 ', 'recepcion');
    echo "<br />";
    echo form_input($data_recepcion, null, 'id="recepcion"');
    
    echo "<br />";
    
    
$data_razon_social = array(
              'name'        => 'razon_social',
              'id'          => 'razon_social',
              'size'        => '75',
              'type'        => 'text',
              'value'       => $row->razon_social,
              'required'    => 'required'
            );
    echo form_label('<b>Raz&oacute;n social:</b> ', 'razon_social');
    echo "<br />";
    echo form_input($data_razon_social, null, 'id="razon_social"');
    
     echo "<br />";
     
     
$data_concepto = array(
              'name'        => 'concepto',
              'id'          => 'concepto',
              'rows'        =>  '5',
              'cols'       =>   '57',
              'type'        => 'textarea',
              'value'       => $row->concepto,
              'required'    => 'required'
            );
    echo form_label('<b>Concepto:</b> ', 'concepto');
    echo "<br />";
    echo form_textarea($data_concepto, null, 'id="concepto"');
    
    echo "<br />";

    
$data_factura = array(
              'name'        => 'factura',
              'id'          => 'factura',
              'size'        => '25',
              'type'        => 'text',
              'value'       => $row->factura,
              'required'    => 'required'
            );
    echo form_label('<b>N&uacute;mero de Factura:</b> ', 'factura');
    echo "<br />";
    echo form_input($data_factura, null, 'id="factura"');
    
    echo "<br />";
    
    
$data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'size'        => '25',
              'type'       => 'number',
              'value'       => $row->importe,
              'required'    => 'required'
            );
    echo form_label('<b>Importe</b>: ', 'importe');
    echo "<br />";
    echo form_input($data_importe, null, 'id="importe"');
    echo "<br />";
    
$data_ingreso_caja = array(
              'name'        => 'ingreso_caja',
              'id'          => 'ingreso_caja',
              'size'        => '25',
              'type'       => 'date',
              'value'       => $row->ingreso_caja,
              'required'    => 'required'
            );
    echo form_label('<b>Ingreso a Caja: </b> 2000-01-01 ', 'ingreso_caja');
    echo "<br />";
    echo form_input($data_ingreso_caja, null, 'id="ingreso_caja"');
    echo "<br />";
    
    
$data_fec_cap = array(
              'name'        => 'fec_cap',
              'id'          => 'fec_cap',
              'size'        => '25',
              'value'       => $row->fec_cap,
              'type'       => 'text',
              'disabled'    => 'disabled'
            );
    echo form_label('<b>Fecha de Captura:</b> 2000-01-01', 'fec_cap');
    echo "<br />";
    echo form_input($data_fec_cap, null, 'id="fec_cap"');
    
    echo "<br />";


    
$data_ingreso_brenda = array(
              'name'        => 'ingreso_brenda',
              'id'          => 'ingreso_brenda',
              'size'        => '25',
              'value'       => $row->ingreso_brenda,
              'type'       => 'date',
              'required'    => 'required'
            );
    echo form_label('<b>Ingreso a Brenda:</b> 2000-01-01', 'ingreso_brenda');
    echo "<br />";
    echo form_input($data_ingreso_brenda, null, 'id="ingreso_brenda"');
    
    echo "<br />";
    

$data_num_recibo = array(
              'name'        => 'num_recibo',
              'id'          => 'num_recibo',
              'size'        => '25',
              'value'       => $row->num_recibo,
              'type'       => 'number',
              'required'    => 'required'
            );
    echo form_label('<b>N&uacute;mero de Recibo:</b> ', 'num_recibo');
    echo "<br />";
    echo form_input($data_num_recibo, null, 'id="num_recibo"');
    
    echo "<br />";
        
    
$data_depositos = array(
              'name'        => 'depositos',
              'id'          => 'depositos',
              'size'        => '25',
              'value'       => $row->depositos,
              'type'       => 'number',
              'required'    => 'required' 
            );
    echo form_label('<b>Importe Depositado:</b>', 'depositos');
    echo "<br />";
    echo form_input($data_depositos, null, 'id="depositos"');
    
    echo "<br />";
    
    
$data_destino = array(
              'name'        => 'destino',
              'id'          => 'destino',
              'size'        => '25',
              'type'       => 'text',
              'value'       => $row->destino,
              'required'    => 'required'
            );
    echo form_label('<b>Destino:</b> ', 'destino');
    echo "<br />";
    echo form_input($data_destino, null, 'id="destino"');
    
    echo "<br />";
    
    
$data_observaciones = array(
              'name'        => 'observaciones',
              'id'          => 'observaciones',
              'rows'        =>  '5',
              'cols'       =>   '57',
              'type'       => 'textarea',
              'value'       => $row->observaciones,
              'required'    => 'required'
            );
    echo form_label('<b>Observaciones:</b> ', 'observaciones');
    echo "<br />";
    echo form_textarea($data_observaciones, null, 'id="observaciones"');
    
    echo "<br />";    
    echo "<br />";
    echo "<br />";
?>

	<input type="submit" value="Guardar" class="button-link blue" />

    

<?php
	echo form_close();
?>