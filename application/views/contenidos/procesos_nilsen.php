

<h1>Hola mundo</h1>
<?php
	echo form_open('procesos/submit_nilsen');
    echo "<br />";
    
    $c = array();
    
    for($k = 0; $k <= 53; $k++)
    {
        $c[str_pad($k, 2, '0', STR_PAD_LEFT)] = str_pad($k, 2, '0', STR_PAD_LEFT);
    }
    $d = array();
    
    for($kd = 0; $kd <= 31; $kd++)
    {
        $d[str_pad($kd, 2, '0', STR_PAD_LEFT)] = str_pad($kd, 2, '0', STR_PAD_LEFT);
    }
    
    $a = array();
    
    for($i = 1; $i <= 12; $i++)
    {
        $a[str_pad($i, 2, '0', STR_PAD_LEFT)] = str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    $ax = array();
    
    for($ix = 1; $ix <= 12; $ix++)
    {
        $ax[str_pad($ix, 2, '0', STR_PAD_LEFT)] = str_pad($ix, 2, '0', STR_PAD_LEFT);
    }
    $b = array();
    
    for($j = 2013; $i <= 2013; $i++)
    {
        $b[str_pad($j, 4, '0', STR_PAD_LEFT)] = str_pad($j, 4, '0', STR_PAD_LEFT);
    }
    $xx = array();
    
    for($jx = 2013; $ix <= 2012; $ix++)
    {
        $xx[str_pad($jx, 4, '0', STR_PAD_LEFT)] = str_pad($jx, 4, '0', STR_PAD_LEFT);
    }
    
    echo form_label('Semana: ', 'semana');
    echo form_dropdown('semana', $c, date('W'), 'id="semana"');
    echo '<br />';
    echo form_label('A&ntilde;o1: ', 'anio1');
    echo form_dropdown('anio1', $xx, date('Y'), 'id="anio1"');
    echo form_label('Mes1: ', 'mes1');
    echo form_dropdown('mes1', $ax, date('m'), 'id="mes1"');
    echo form_label('Dia1: ', 'dia1');
    echo form_dropdown('dia1', $d, date('d'), 'id="dia1"');
    echo '<br />';
    echo form_label('A&ntilde;o2: ', 'anio2');
    echo form_dropdown('anio2', $b, date('Y'), 'id="anio2"');
    echo form_label('Mes2: ', 'mes2');
    echo form_dropdown('mes2', $a, date('m'), 'id="mes2"');
    echo form_label('Dia2: ', 'dia2');
    echo form_dropdown('dia2', $d, date('d'), 'id="dia2"');  
  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
    
?>