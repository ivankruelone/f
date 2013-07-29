<h2>Agrega un nuevo empleado:</h2>
<br/>


<?php
	echo form_open('prenomina/submit_nuevo_empleado');

    $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'size'        => '25',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Clave de Empleado: ', 'clave');
    echo "<br />";
    echo form_input($data_clave);
    
    echo "<br />";

    
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'size'        => '25',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Nombre(s) del Empleado: ', 'nombre');
    echo "<br />";
    echo form_input($data_nombre);
    
    echo "<br />";

    
    $data_a_paterno = array(
              'name'        => 'a_paterno',
              'id'          => 'a_paterno',
              'size'        => '25',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Apellido Paterno: ', 'a_paterno');
    echo "<br />";
    echo form_input($data_a_paterno);
    
     echo "<br />";

    
    $data_a_materno = array(
              'name'        => 'a_materno',
              'id'          => 'a_materno',
              'size'        => '25',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Apellido Materno: ', 'a_materno');
    echo "<br />";
    echo form_input($data_a_materno);
    
    echo "<br />";

    
    $data_nss = array(
              'name'        => 'nss',
              'id'          => 'nss',
              'size'        => '25',
              'type'       => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('NSS: ', 'nss');
    echo "<br />";
    echo form_input($data_nss);
    
    echo "<br />";

    
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'size'        => '25',
              'maxlength'   => '13',
              'type'       => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('RFC: ', 'rfc');
    echo "<br />";
    echo form_input($data_rfc);
    
    echo "<br />";

    
    $data_salario = array(
              'name'        => 'salario',
              'id'          => 'salario',
              'size'        => '25',
              'type'       => 'number',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Salario: ', 'salario');
    echo "<br />";
    echo form_input($data_salario);
    
    echo "<br />";

    
    $data_fecha = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'size'        => '25',
              'maxlength'   => '10',
              'type'       => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
            );
    echo form_label('Fecha de ingreso: AAAA-MM-DD', 'fecha');
    echo "<br />";
    echo form_input($data_fecha);
    
    echo "<br />";
    echo "<br />";

?>

	<input type="submit" value="Guardar" class="button-link blue" />

    

<?php
	echo form_close();
?>