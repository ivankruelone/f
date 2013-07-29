<div align="center">

<?php
	echo form_open('a_surtido/reporte_diario_submit_xclave');
    echo "<br />";

    $data1 = array(
              'name'        => 'fecha1',
              'id'          => 'fecha1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );
    
    $data2 = array(
              'name'        => 'fecha2',
              'id'          => 'fecha2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );

    
?>

  <table>
<th colspan="2"><font size="+1">Reporte de Surtido Diario x Clave</font></th>
<tr>
    <td align="left" ><b><font size="+1">FECHA INICIAL: </strong></font></td>
    <td align="left"><?php echo form_input($data1, "", 'required').'AAAA-MM-DD'; ?> </td>
</tr>
<tr>
    <td align="left" ><b><font size="+1">FECHA FINAL:</font></b></td>
    <td align="left"><?php echo form_input($data2, "", 'required').'AAAA-MM-DD';?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('mysubmit', 'Generar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>



<?php
	echo form_open('a_surtido/reporte_semanal_submit_xclave');
    echo "<br />";
    
    $a = array();
    
    for($i = 0; $i <= 53; $i++)
    {
        $a[str_pad($i, 2, '0', STR_PAD_LEFT)] = str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    
    $b = array();
    
    for($j = 2013; $i <= 2013; $i++)
    {
        $b[str_pad($j, 4, '0', STR_PAD_LEFT)] = str_pad($j, 4, '0', STR_PAD_LEFT);
    }
    
?>

<table>
<th colspan="2"><font size="+1">Reporte de Surtido Semanal</font></th>
<tr>
    <td align="left" ><b><font size="+1">Selecciona la semana: </strong></font></td>
    <td align="left"><?php echo form_dropdown('semana', $a, date('W'), 'id="semana"'); ?> </td>
</tr>
<tr>
    <td align="left" ><b><font size="+1">Selecciona el A&ntilde;o:</font></b></td>
    <td align="left"><?php echo form_dropdown('anio', $b, date('Y'), 'id="anio"');?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('mysubmit', 'Generar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>



<?php
	echo form_open('a_surtido/reporte_mensual_submit_xclave');
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
    
?>

<table>
<th colspan="2"><font size="+1">Reporte de Surtido Mensual</font></th>
<tr>
    <td align="left" ><b><font size="+1">Selecciona el mes: </strong></font></td>
    <td align="left"><?php echo form_dropdown('mes', $a, date('m'), 'id="mes"'); ?> </td>
</tr>
<tr>
    <td align="left" ><b><font size="+1">Selecciona el A&ntilde;o:</font></b></td>
    <td align="left"><?php echo form_dropdown('anio', $b, date('Y'), 'id="anio"');?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('mysubmit', 'Generar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>
  
  </div>

<script language="javascript" type="text/javascript">
    $(window).load(function () {
    });
    
    $(document).ready(function(){
        
    
    $('#fecha1').datepicker();
    $('#fecha2').datepicker();       
     
});
  </script>
