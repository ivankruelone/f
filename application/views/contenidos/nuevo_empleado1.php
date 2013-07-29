<h2>Agrega un nuevo empleado:</h2>
<br/>

<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	echo form_open('directorio/submit1_nuevo_empleado', 'id="nuevo_empleado1"');

    $data_depto = array(
              'name'        => 'depto',
              'id'          => 'depto',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Departamento: ', 'depto');
    echo "<br />";
    echo form_input($data_depto, null, 'id="depto"');
    
    echo "<br />";

    
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Nombre(s) y Apellidos del Empleado: ', 'nombre');
    echo "<br />";
    echo form_input($data_nombre, null, 'id="nombre"');
    
    echo "<br />";

    
    $data_ext = array(
              'name'        => 'ext',
              'id'          => 'ext',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Extenci&oacute;n: ', 'ext');
    echo "<br />";
    echo form_input($data_ext, null, 'id="ext"');
    
     echo "<br />";

    
    $data_movil = array(
              'name'        => 'movil',
              'id'          => 'movil',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Telefono celular: ', 'movil');
    echo "<br />";
    echo form_input($data_movil, null, 'id="movil"');
    
    echo "<br />";

    
    $data_correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'size'        => '30',
              'type'       => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('E-MAIL: ', 'correo');
    echo "<br />";
    echo form_input($data_correo, null, 'id="correo"');
    
    echo "<br />";
    echo "<br />";

?>

	<input type="submit" value="Guardar" class="button-link blue" />

    

<?php
	echo form_close();
?>

<script language="javascript" type="text/javascript">

        $('#nuevo_empleado1').submit(function() {
            
            var data_depto = $('#depto').attr("value");
            var data_nombre = $('#nombre').attr("value");
            
            
            if(data_depto == 0){var texto1 = "Debes elegir un Departamento.";}else{ var texto1 = "";}
            if(data_nombre == 0){var texto2 = "Debes elegir un Nombre.";}else{ var texto2 = "";}
            
    	  if(data_depto != 0 && data_nombre != 0){
    	    
    	    if(confirm("¿ Seguro que deseas guardar ?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    //alert(texto1 + "\n" + texto2 + "\n" + texto3);
            $('#error').html(texto1 + "\n" + texto2);
    	    $('#depto').focus();
    	    return false    

    	  }
    	}); 


</script>