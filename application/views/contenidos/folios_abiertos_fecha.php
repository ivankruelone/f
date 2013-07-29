<h1><?php echo $titulo;?></h1>
<?php
	echo form_open('a_surtido/reporte_folios_abiertos_submit');
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


<h1>Reporte Semanal</h1>
<?php
	echo form_open('a_surtido/reporte_semanal_submit');
    echo "<br />";
    
    $a = array();
    
    for($i = 0; $i <= 53; $i++)
    {
        $a[str_pad($i, 2, '0', STR_PAD_LEFT)] = str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    
    $b = array();
    
    for($j = 2012; $i <= 2012; $i++)
    {
        $b[str_pad($j, 4, '0', STR_PAD_LEFT)] = str_pad($j, 4, '0', STR_PAD_LEFT);
    }
    
    
    echo form_label('Selecciona la semana: ', 'semana');
    echo form_dropdown('semana', $a, date('W'), 'id="semana"');
    echo form_label(' Selecciona A&ntilde;o: ', 'anio');
    echo form_dropdown('anio', $b, date('Y'), 'id="anio"');
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>

<h1>Reporte Mensual</h1>
<?php
	echo form_open('a_surtido/reporte_mensual_submit');
    echo "<br />";
    
    $a = array();
    
    for($i = 1; $i <= 12; $i++)
    {
        $a[str_pad($i, 2, '0', STR_PAD_LEFT)] = str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    
    $b = array();
    
    for($j = 2012; $i <= 2012; $i++)
    {
        $b[str_pad($j, 4, '0', STR_PAD_LEFT)] = str_pad($j, 4, '0', STR_PAD_LEFT);
    }
    
    
    echo form_label('Selecciona el mes: ', 'mes');
    echo form_dropdown('mes', $a, date('m'), 'id="mes"');
    echo form_label(' Selecciona A&ntilde;o: ', 'anio');
    echo form_dropdown('anio', $b, date('Y'), 'id="anio"');
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>