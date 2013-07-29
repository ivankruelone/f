<h1>Programa de captura de informaci&oacute;n de clientes</h1>
<div id="ayuda" align="right" style="vertical-align: text-top;"><?php echo anchor('sms/help', 'Ver video de Ayuda <img width="20px" src="'.base_url().'imagenes/help_.png" alt="Ver Tutorial"/>', 'rel="prettyPopin"')?></div>
<?php
	echo form_open('sms/submit', 'id="sms_forma"');
    $data_celular = array(
              'name'        => 'celular',
              'id'          => 'celular',
              'size'        => '20',
              'maxlength'   => '10',
              'type'       => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required',
              'pattern'    => '[0-9]{10}'
            );
    echo form_label('# Celular: ', 'celular');
    echo "<br />";
    echo form_input($data_celular);
    echo "<br />";
    $data_persona = array(
              'name'        => 'persona',
              'id'          => 'persona',
              'maxlength'   => '100',
              'size'        => '50',
              'type'       => 'text',
              'required'    => 'required'
            );
    echo form_label('Nombre Completo: ', 'persona');
    echo "<br />";
    echo form_input($data_persona);
    echo "<br />";

    echo form_label('Medicamentos: ', 'clave');
    $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'size'        => '50',
              'maxlength'   => '20',
              'type'       => 'text'
            );
    echo "<br />";
    echo form_input($data_clave);
    echo form_label(' Cantidad: ', 'cantidad');
    $data_cantidad = array(
              'name'        => 'cantidad',
              'id'          => 'cantidad',
              'size'        => '3',
              'type'        => 'number'
            );
    echo form_input($data_cantidad);
    echo form_button('name','Agregar', 'class="button-link blue" id="agregar_clave"');
    echo "<br />";
    echo "<br />";
    echo form_hidden('registros', '0');
    echo form_submit('mysubmit', 'Guardar Registro de datos', 'class="button-link blue"');
    echo form_close();
?>
<div id="medicamentos" style="margin-top: 15px;"></div>
<script language="javascript" type="text/javascript">

	$("a[rel^='prettyPopin']:eq(0)").prettyPopin({});
    
    function formatItem(row) {
		return row[0] + " (<strong>" + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0];
	}
    
    
    $('#celular').blur(function(){
        
        var celular = $('#celular').attr("value");

    $.post("<?php echo site_url();?>/sms/checar_celular/", { celular: celular }, function(data){
                    $('#persona').val(data).focus();
                });
        
        });
    

    $('#persona').blur(function(){
        
        var persona = $('#persona').attr("value").toUpperCase();
        $('#persona').val(persona);
        
        });

	$("#clave").autocomplete("<?php echo site_url();?>/sms/clave", {
		width: 330,
		matchContains: false,
		mustMatch: false,
		minChars: 2,
		formatItem: formatItem,
		formatResult: formatResult,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    
    $('#agregar_clave').click(function(){
        
        var clave = $('#clave').attr("value");
        var cantidad = $('#cantidad').attr("value");
    $.post("<?php echo site_url();?>/sms/agregar_clave/", { clave: clave, cantidad: cantidad }, function(data){
                    $("#medicamentos").append(data);
                    $('#cantidad').val('');
                    $('#clave').val('').focus();
                    
                });
        
        });
        
        $('#sms_forma').submit(function() {
            
            var persona = $('#persona').attr("value").length;
            var celular_largo = $('#celular').attr("value").length;
            var celular = $('#celular').attr("value");
            var registros = $('input[name="registros"]').attr("value");

    	  if(persona > 0 && celular_largo == 10 && isNaN(celular) == false && registros > 0){
    	    
    	    if(confirm("¿ Seguro que deseas guardar ?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('No puedes guardar los datos...');
    	    $('#persona').focus();
    	    return false    

    	  }
    	}); 


</script>
<div id="historial"><?php if(isset($historial)) echo $historial; ?></div>
