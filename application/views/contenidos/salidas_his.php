<blockquote>
    
    <p align="center"><strong>HISTORICO DE SALIDAS</strong></p>
  </blockquote>
  
  <div align="center">
    <h2>Formato de Busqueda</h2>
    
    <h4>Empleado</h4>
    <?php
        
        $data_salidas = array(
              'name'        => 'empleado',
              'id'          => 'empleado',
              'type'        => 'text'
            );

        echo form_input($data_salidas);
        ?>
        
    <h4>Fecha</h4>
    <?php
        
        $data_salidas = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'type'        => 'date'
            );

        echo form_input($data_salidas);
        ?>
        
<br /><br />
            <button id="salidas_boton"  class="button-link blue">Buscar</button><br /><br /><br />

<div id="tabla1">
<?php
	echo $tabla1;
?>

<?php
	echo $tabla;
?>
</div>
</div>

<script language="javascript" type="text/javascript">
$('#salidas_boton').click(function(){
    tabla_salidas();
})

$(document).ready(function(){
        
    
    $('#fec1').datepicker();
   

});

function tabla_salidas(){
    
    
    
    var empleado = document.getElementById("empleado").value;
    var fec1 = document.getElementById("fec1").value;
    
    $.post("<?php echo site_url();?>/vacaciones/busca_salidas/", { empleado: empleado, fec1: fec1 }, function(data){
                    $("#tabla1").html(data);
                });
    $('#empleado').val('');
    $('#fec1').val('');
                
                
}

</script>