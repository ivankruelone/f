<blockquote>
    
    <p align="center"><strong>HISTORICO DE VACACIONES</strong></p>
  </blockquote>
  
  <div align="center">
    <h2>Formato de Busqueda</h2>
    
    <h4>Nomina</h4>
    <?php
        
        $data_vacaciones = array(
              'name'        => 'empleado',
              'id'          => 'empleado',
              'type'        => 'text'
            );

        echo form_input($data_vacaciones);
        ?>
        
    <h4>Fecha</h4>
    <?php
        
        $data_vacaciones = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'type'        => 'date'
            );

        echo form_input($data_vacaciones);
        ?>
        
    <h4>Periodo: ej. 2010-2011</h4>
    <?php
        
        $data_vacaciones = array(
              'name'        => 'ciclo',
              'id'          => 'ciclo',
              'type'        => 'num'
            );

        echo form_input($data_vacaciones);
        ?>
<br /><br />
            <button id="vacaciones_boton"  class="button-link blue">Buscar</button><br /><br /><br />

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
$('#vacaciones_boton').click(function(){
    tabla_vacaciones();
})

$(document).ready(function(){
        
    
    $('#fec1').datepicker();
   

});



function tabla_vacaciones(){
    
    
    
    var empleado = document.getElementById("empleado").value;
    var fec1 = document.getElementById("fec1").value;
    var ciclo = document.getElementById("ciclo").value;
    
    $.post("<?php echo site_url();?>/vacaciones/busca_vacaciones/", { empleado: empleado, fec1: fec1, ciclo: ciclo }, function(data){
                    $("#tabla1").html(data);
                });
    $('#empleado').val('');
    $('#fec1').val('');
    $('#ciclo').val('');
                
                
}

</script>