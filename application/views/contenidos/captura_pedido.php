<h1>Formato de captura de pedido</h1>
<p align="justify">Al capturar tus claves te puedes cambiar de campo y agregar la clave con la tecla enter sin la necesidad de presionar el boton agregar clave y al terminar la captura de tu pedido presiona cerrar pedido que se encuentra al final de tu lista y tu pedido se enviara</p>

<?php
    $atributos = array('id' => 'pedido');
    echo form_open('captura_pedido/submit_pedido', $atributos);

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
    echo anchor('captura_pedido/cerrar_pedido', 'Cerrar Pedido', array('id'=>'link_cerrar'));
    echo '</p>';
?>
<script language="javascript" type="text/javascript">
$(window).load(function () {
  $("#clave").focus();
});

$(document).ready(function(){
  

    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    
          
    $('#link_cerrar').click(function(event){
        
       if(confirm("Seguro que deseas cerrar el pedido?")){
        return true;
        
       } else{
        //evita que se ejecute el evento
        event.preventDefault();
        return false;
       }
        
        
    });
        
     
});





</script>