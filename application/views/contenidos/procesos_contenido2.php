

<h1>Hola mundo</h1>
<?php
	echo form_open('procesos/submit_una');
    echo "<br />";
    
    $c = array();
    
    for($k = 0; $k <= 53; $k++)
    {
        $c[str_pad($k, 2, '0', STR_PAD_LEFT)] = str_pad($k, 2, '0', STR_PAD_LEFT);
    }
   
    
    $b = array();
    
    for($j = 2013; $j <= 2013; $j++)
    {
        $b[str_pad($j, 4, '0', STR_PAD_LEFT)] = str_pad($j, 4, '0', STR_PAD_LEFT);
    }
   
    
    echo form_label('Semana: ', 'semana');
    echo form_dropdown('semana', $c, date('W'), 'id="semana"');
    echo form_label('A&ntilde;o: ', 'anio');
    echo form_dropdown('anio', $b, date('Y'), 'id="anio"');
  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
    
?>