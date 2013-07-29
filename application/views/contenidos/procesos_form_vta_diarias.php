

<h1>Hola mundo</h1>
<?php
	echo form_open('procesos/tabla_vtas_diarias');
    echo "<br />";
    
    $a = array();
    
    for($i = 1; $i <= 12; $i++)
    {
        $a[str_pad($i, 2, '0', STR_PAD_LEFT)] = str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    
    $b = array();
    
    for($j = 2013; $i <= 2013; $i++)
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