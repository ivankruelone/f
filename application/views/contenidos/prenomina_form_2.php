<h2 align="center">CAPTURA Y GENERACI&Oacute;N DE LA PRE NOMINA</h2>
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'prenomina_form_2');
    echo form_open('prenomina/tabla_captura_graba ', $atributos);
    $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
               $data_fechai = array(
              'name'        => 'fechai',
              'id'          => 'fechai',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
              
            );
               $data_folioi = array(
              'name'        => 'folioi',
              'id'          => 'folioi',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
  ?>

<table>
<tbody>
<tr>
<th colspan="2"><?php echo  $titulo ?></th>
</tr>
<tr>
<td colspan="2" align="center"><font size="+1"><strong><?php echo  $cla." - ".$claxx ?></strong></font></td>
</tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Empleado: </strong></font></td>
	<td align="left"><?php echo form_dropdown('id_emp', $id_empx, '', 'id="id_emp"') ;?> </td>
    
 </tr>

 <?php
if($cla==333 || $cla==613 || $cla==644){
 if($cla==644){
 ?>
  <tr>
	<td align="left" ><font size="+1">DIAS: </font></td>
    <td><?php echo form_input($data_importe, "", 'required');?></td>
 </tr>
 <tr>    
    <td align="left" ><font size="+1">FECHA INCAP.: </font></td>
    <td><?php echo form_input($data_fechai, "", 'required') .'<strong>AAA-MM-DD</strong>';?></td><br />
    
 </tr>
 <tr>    
    <td align="left" ><font size="+1">FOLIO INCAP.: </font></td>
    <td><?php echo form_input($data_folioi, "", 'required');?></td>
 </tr>	
 <?php
}else{
 ?>
 <tr>
	<td align="left" ><font size="+1">DIAS: </font></td>
    <td><?php echo form_input($data_importe, "", 'required');?></td>
</tr>
 <?php
 }
}else{
 ?>
 <tr>
	<td align="left" ><font size="+1">IMPORTE o DIAS: </font></td>
    <td><?php echo form_input($data_importe, "", 'required');?></td>
 </tr>
 <?php    
}
 ?>
	

 <tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>
<input type="hidden" value="<?php echo $cla ?>" name="cla" id="cla" />
<input type="hidden" value="<?php echo $fec ?>" name="fec" id="fec" />
  <?php
	echo form_close();
  ?>

</div>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#id_emp").focus();
    });
    
    $(document).ready(function(){
    
    $('#id_emp').blur(function(){
            nom = $('#id_emp').attr("value"); 
     });
     $('#importe').blur(function(){
            importe = $('#importe').attr("value"); 
     });
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#prenomina_form_2').submit(function() {
        var  id_emp = $('#id_emp').attr("value");
        var importe = $('#importe').attr("value");
        
          if(id_emp > 0 && importe > 0 ){
    	  }else{
            alert('LLENE LOS DATOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>