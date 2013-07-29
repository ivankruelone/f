<h1 align="center">REPORTES DE VENTAS</h1>

<h2>Reporte diario</h2>
<?php
	echo form_open('r_ventas/reporte_diario_submit');
    echo "<br />";
    
    echo form_dropdown('suc', $sucursal, '', 'id="suc"');
    //echo "<br />";
    $data1 = array(
              'name'        => 'fecha1',
              'id'          => 'fecha1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'required'    => 'required'
            );
    echo form_label('Fecha Inicial: ', 'fecha1');
    echo form_input($data1);
    $data2 = array(
              'name'        => 'fecha2',
              'id'          => 'fecha2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'required'    => 'required'
            );

    echo form_label(' Fecha Final: ', 'fecha2');
    echo form_input($data2);
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>


<h2>Reporte Semanal</h2>
<?php
	echo form_open('r_ventas/reporte_semanal_submit');
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
    
    echo form_dropdown('suc', $sucursal, '', 'id="suc"');
    echo form_label('Selecciona la semana: ', 'semana');
    echo form_dropdown('semana', $a, date('W'), 'id="semana"');
    echo form_label(' Selecciona A&ntilde;o: ', 'anio');
    echo form_dropdown('anio', $b, date('Y'), 'id="anio"');
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>

<h2>Reporte Mensual</h2>
<?php
	echo form_open('r_ventas/reporte_mensual_submit');
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
    
    echo form_dropdown('suc', $sucursal, '', 'id="suc"');
    echo form_label('Selecciona el mes: ', 'mes');
    echo form_dropdown('mes', $a, date('m'), 'id="mes"');
    echo form_label(' Selecciona A&ntilde;o: ', 'anio');
    echo form_dropdown('anio', $b, date('Y'), 'id="anio"');
    echo "<br />";
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>