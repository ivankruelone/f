<h2>Agrega un nuevo empleado:</h2>
<br/>

<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	echo form_open('a_surtido/submit1_nuevo_empleado', 'id="nuevo_empleado2"');
     
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Apellidos y Nombre(s) del Empleado: ', 'nombre');
    echo "<br />";
    echo form_input($data_nombre, null, 'id="nombre"');
    
    echo "<br />";

    
    $data_nomina = array(
              'name'        => 'nomina',
              'id'          => 'nomina',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Nomina: ', 'nomina');
    echo "<br />";
    echo form_input($data_nomina, null, 'id="nomina"');
    
    echo "<br />";
    
    $data_turno = array(
              'name'        => 'turno',
              'id'          => 'turno',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Turno: 1=Matutino 2=Vespertino ', 'turno');
    echo "<br />";
    echo form_input($data_turno, null, 'id="turno"');
    
    echo "<br />";
    echo "<br />";

?>

	<input type="submit" value="Guardar" class="button-link blue" />

    

<?php
	echo form_close();
?>

<script language="javascript" type="text/javascript">

        $('#nuevo_empleado2').submit(function() {
            
            var data_nomina = $('#nomina').attr("value");
            var data_nombre = $('#nombre').attr("value");
            var data_nombre = $('#turno').attr("value");
            
            
            if(data_nomina == 0){var texto1 = "Debes elegir un numero de Nomina.";}else{ var texto1 = "";}
            if(data_nombre == 0){var texto2 = "Debes elegir un Nombre.";}else{ var texto2 = "";}
            if(data_turno == 0){var texto3 = "Debes elegir un Turno.";}else{ var texto3 = "";}
            
    	  if(data_nomina != 0 && data_nombre != 0 && data_turno != 0){
    	    
    	    if(confirm("¿ Seguro que deseas guardar ?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    //alert(texto1 + "\n" + texto2 + "\n" + texto3);
            $('#error').html(texto1 + "\n" + texto2 + "\n" + texto3);
    	    $('#nombre').focus();
    	    return false    

    	  }
    	}); 


</script>