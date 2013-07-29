

<h1>Hola mundo</h1>
<?php
	echo form_open('procesos/submit_noblock');
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
    
    
    echo '<br />';
    echo form_label('A&ntilde;o: ', 'aaa');
    echo form_dropdown('aaa', $b, date('Y'), 'id="aaa"');
    echo form_label('Mes: ', 'mes');
    echo form_dropdown('mes', $a, date('m'), 'id="mes"');
    echo form_label('Dia: ', 'dia');
    echo form_dropdown('dia', $d, date('d'), 'id="dia"');  
  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
    
?>