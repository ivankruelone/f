<h2>Agregar Deposito:</h2>
<br/>

<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	echo form_open('facturas_juridico/submit_depositos', 'id="facturas_juridico"');
    echo form_hidden('id',$id); 

$data_fec_cap = array(
              'name'        => 'fec_cap',
              'id'          => 'fec_cap',
              'size'        => '25',
              'type'       => 'date',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('<b>Fecha de Captura:</b> 2000-01-01', 'fec_cap');
    echo "<br />";
    echo form_input($data_fec_cap, null, 'id="fec_cap"');
    
    echo "<br />";


    
$data_ingreso_brenda = array(
              'name'        => 'ingreso_brenda',
              'id'          => 'ingreso_brenda',
              'size'        => '25',
              'type'       => 'date',
              'autofocus'   => 'autofocus',
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
              'type'       => 'number',
              'autofocus'   => 'autofocus',
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
              'type'       => 'number',
              'autofocus'   => 'autofocus',
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
              'autofocus'   => 'autofocus',
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
              'cols'       =>   '60',
              'type'       => 'textarea',
              'autofocus'   => 'autofocus',
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