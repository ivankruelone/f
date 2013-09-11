 <div align="center">
  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>

<?php
    $atributos = array('id' => 'reporte');
	echo form_open('reportes/reporte_submit2', $atributos);
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
 


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fecha1").focus();
    });
    
    $(document).ready(function(){
    
    $('#fecha1').datepicker();
    $('#fecha2').datepicker();
    
    });
          
  </script>