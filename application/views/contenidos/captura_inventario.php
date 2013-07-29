<h1>Formato de captura de Inventario</h1>
<p align="justify"><span style="color: red;">Solamente captura claves con existencia, claves en 0 no.</span> Al capturar tus claves te puedes cambiar de campo y agregar la clave con la tecla enter sin la necesidad de presionar el boton agregar clave y al terminar la captura de tu inventario presiona cerrar inventario que se encuentra al final de tu lista y tu inventario se borrara y se enviara</p>

<?php
    echo form_open('captura_inventario/submit_inventario');

    $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'size'        => '4',
              'type'        => 'number',
              'autofocus'   => 'autofocus',
              'required'    => 'required',
              'min'         => 0,
              'max'         => 2000
            );
    echo form_label('Clave: ', 'clave');
    echo form_input($data_clave);



    $data_cantidad = array(
              'name'        => 'cantidad',
              'id'          => 'cantidad',
              'size'        => '4',
              'type'        => 'number',
              'required'    => 'required',
              'min'         => 0
            );
    echo form_label('Cantidad: ', 'cantidad');
    echo form_input($data_cantidad);



?>

<input type="submit" value="Agregar clave" class="button-link blue" />

<?php
	echo form_close();
?>

<?php
	echo $tabla;
    echo '<br />';
    echo '<p align="center">';
    echo anchor('captura_inventario/cerrar_inventario', 'Cerrar Inventario', array('id' => 'cerrar'));
    echo '</p>';
?>
<script language="javascript" type="text/javascript">
$(window).load(function () {
  $("#clave").focus();
});


$('#cerrar').click(function(event){
    if(confirm("Seguro que deseas cerrar tu inventario")){
    
    if(checar_registros() > 0){
    
        if(checar_inv() == 0){
        
           if(confirm('Seguro que deseas cerrar tu inventario ??')){
            
           }else{
            event.preventDefault();
           }
       
       }else{
        alert('Ya hay un inventario cargado, si deseas cargar uno nuevo comunicata al area de sistemas.');
        event.preventDefault();
       }
    }else{
        alert('No hay ninguna clave capturada. Imposible cerrar Inventario.');
        $("#clave").focus();
        event.preventDefault();
    }
    
    }else{
        event.preventDefault();
        return false;
    }

});

    
    function checar_registros(){
        return $.ajax({
            type: "GET",
            url: "<?php echo site_url();?>/captura_inventario/checar_registros",
            cache: false,
            async: false
        }).responseText;
    }

    function checar_inv(){
        return $.ajax({
            type: "GET",
            url: "<?php echo site_url();?>/captura_inventario/checar_inv",
            cache: false,
            async: false
        }).responseText;
    }



</script>