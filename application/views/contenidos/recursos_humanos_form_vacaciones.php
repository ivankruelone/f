
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<div align="center">

<?php
	$atributos = array('id' => 'vacaciones');
    echo form_open('vacaciones/vacaciones_submit', $atributos);


    $fecha1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
    $fecha2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
            
    $dias = array(
              'name'        => 'dias',
              'id'          => 'dias',
              'value'       => '',
              'maxlength'   => '2',
              'size'        => '2',
              'type'        => 'int'
              
            );        

  ?>
  
  <table>
<th colspan="2"><font size="+1">Selecciona el empleado, periodo vacacional y fechas</font></th>
<tr>
	<td align="left"><font size="+1"><strong>EMPLEADO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre', $empleadox, '', 'id="nombre"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>PERIODO VACACIONAL </strong></font></td>
	<td align="left"><select size="1" name="ciclo" id="ciclo"></select></td>
 </tr>
<tr>
    <td align="left" ><b><font size="+1">FECHA INICIAL: </strong></font></td>
    <td align="left"><?php echo form_input($fecha1, "", 'required').'AAAA-MM-DD'; ?> </td>
</tr>
<tr>
    <td align="left" ><b><font size="+1">FECHA FINAL:</font></b></td>
    <td align="left"><?php echo form_input($fecha2, "", 'required').'AAAA-MM-DD';?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>Dia(s): </strong></font></td>
    <td align="left"><?php echo form_input($dias, '', 'required') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Guardar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>

  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nombre").focus();
    });
    
    $(document).ready(function(){
        
    
    $('#fec1').datepicker();
    $('#fec2').datepicker();
    
    $('#nombre').change(function(){
        var nomina = $(this).attr('value');
        
        $.post("<?php echo site_url();?>/vacaciones/busca_ciclos/", { nomina: nomina }, function(data){
            $("#ciclo").html(data);
        });
        
    });
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#vacaciones').submit(function(event){
        
        var nombre = $('#nombre').attr('value');
        var ciclo = $('#ciclo').attr('value');
        var dias = $('#dias').attr('value');
        
        if(nombre == 0){
            alert('Debes seleccionar un empleado.');
            event.preventDefault();
        }else{
            
        if(ciclo == 0) {
            alert('Debes seleccionar un periodo.');
            event.preventDefault();
        }else{ 
            
        
       
            /////////////inicio
           if(confirm("Seguro que deseas cerrar el pedido?")){
            return true;
            
           } else{
            //evita que se ejecute el evento
            event.preventDefault();
            return false;
           }
           ////////////////fin

          }  
        }
        
        
    });          
          
        
     
});
  </script>
