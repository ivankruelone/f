<h1><?php echo $titulo;?></h1>
<?php
	echo form_open('a_surtido/reporte_surtido_diario_submit');
    echo "<br />";

    $data1 = array(
              'name'        => 'fecha1',
              'id'          => 'fecha1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );
    echo form_label('Fecha Inicial: ', 'fecha1');
    echo form_input($data1);
    $data2 = array(
              'name'        => 'fecha2',
              'id'          => 'fecha2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );

    echo form_label(' Fecha Final: ', 'fecha2');
    echo form_input($data2);
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>

<div align="center">
<?php
	echo $tabla;
?>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
   
   $('#fecha1').datepicker();
   $('#fecha2').datepicker();
   
    
});

</script>