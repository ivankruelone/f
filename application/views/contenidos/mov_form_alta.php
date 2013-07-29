<h2 align="center">ALTA DE EMPLEADOS A SUCURSALES</h2>
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'mov_form_alta');
    echo form_open('supervisor/movimiento_reporta_alta', $atributos);
    $data_nom = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => '',
              'maxlength'   => '80',
              'size'        => '80'
             );
   $data_nomina = array(
              'name'        => 'nomina',
              'id'          => 'nomina',
              'value'       => '',
              'maxlength'   => '9',
              'size'        => '9'
             );
  $data_fecha = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
              
            );
            
  ?>

<table>
<tbody>
<tr>
<th colspan="2"><?php echo  $titulo ?></th>
</tr>

 <tr>
	<td align="left" ><font size="+1"><strong>Compa&ntilde;ia: </strong></font></td>
	<td align="left"><?php echo form_dropdown('cia', $ciax, '', 'id="cia"') ;?> </td>
    
 </tr>
  <tr>
	<td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
    
 </tr>
 <tr>    
    <td align="left" ><font size="+1">Fecha.: </font></td>
    <td><?php echo form_input($data_fecha, "", 'required') .'<strong>AAA-MM-DD</strong>';?></td><br />
    
 </tr>
  <tr>    
    <td align="left" ><font size="+1">Nombre.: </font></td>
    <td><?php echo form_input($data_nom, "", 'required');?></td><br />
 </tr>	
  <tr>    
    <td align="left" ><font size="+1">Nomina.: </font></td>
    <td><?php echo form_input($data_nomina, "", 'required');?></td><br />
 </tr>	

 <tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>
  <?php
	echo form_close();
  ?>

</div>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    $('#suc').blur(function(){
            suc = $('#suc').attr("value"); 
     });
     $('#nom').blur(function(){
            nom = $('#nom').attr("value"); 
     });
     $('#nomina').blur(function(){
            nomina = $('#nomina').attr("value"); 
     });
     $(function() {
		$( "#fecha" ).datepicker();
	});
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#mov_form_alta').submit(function() {
        var  cia = $('#cia').attr("value");
        var suc = $('#suc').attr("value");
        var fecha = $('#fecha').attr("value").length;
        var nomina = $('#nomina').attr("value");
        
          if(cia > 0 && suc > 0 && nomina > 0 ){
    	  }else{
            alert('LLENE LOS DATOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>