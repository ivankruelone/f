<h2>Agregar nueva Factura:</h2>
<br/>

<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	echo form_open('facturas_juridico/submit_nueva', 'id="facturas_juridico"');

$data_recepcion = array(
              'name'        => 'recepcion',
              'id'          => 'recepcion',
              'size'        => '25',
              'type'        => 'date',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
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
              'autofocus'   => 'autofocus',
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
              'cols'       =>   '56',
              'type'        => 'textarea',
              'autofocus'   => 'autofocus',
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
              'autofocus'   => 'autofocus',
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
              'autofocus'   => 'autofocus',
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
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('<b>Ingreso a Caja: </b> 2000-01-01 ', 'ingreso_caja');
    echo "<br />";
    echo form_input($data_ingreso_caja, null, 'id="ingreso_caja"');

    
    echo "<br />";    
    echo "<br />";
    echo "<br />";
?>

	<input type="submit" value="Guardar" class="button-link blue" />

    

<?php
	echo form_close();
?>

<script language="javascript" type="text/javascript">

        $('#nueva').submit(function() {
            
            var data_recepcion = $('#recepcion').attr("value");
            var data_factura = $('#razon_social').attr("value");
            var data_razon_social = $('#concepto').attr("value");
            var data_concepto = $('#factura').attr("value");
            var data_ingreso_brenda = $('#importe').attr("value");
                        
            if(data_recepcion == 0){var texto1 = "Debes Capturar la Fecha de Recepci&oacute;n.";}else{ var texto1 = "";}
            if(data_razon_social == 0){var texto2 = "Debes capturar la Raz&oacute;n Social.";}else{ var texto2 = "";}
            if(data_concepto == 0){var texto3 = "Debes Escribir un Concepto.";}else{ var texto3 = "";}
            if(data_factura == 0){var texto4 = "Debes Capturar el Numero de Factura.";}else{ var texto4 = "";}
            if(data_importe == 0){var texto5 = "Debes Capturar el Importe.";}else{ var texto5 = "";}
            
            
            
                        
    	  if(data_recepcion != 0 && data_razon_social != 0 && data_concepto != 0 && data_factura != 0 && data_importe != 0){
                 
    	    
    	    if(confirm("¿ Seguro que deseas guardar ?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    //alert(texto1 + "\n" + texto2 + "\n" + texto3 + "\n" + texto4 + "\n" + texto5);
            $('#error').html(texto1 + "\n" + texto2 + "\n" + texto3 + "\n" + texto4 + "\n" + texto5);
    	    $('#recepcion').focus();
    	    return false    

    	  }
    	}); 


</script>