<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'medicos_form_suc');
    echo form_open('medicos/edita_turno ', $atributos);
  ?>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>
<table>
<tbody>
<tr>
<th colspan="2"><?php echo  $titulo ?></th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>Matutino: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mat', $mat, '', 'id="mat"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Vespertino: </strong></font></td>
	<td align="left"><?php echo form_dropdown('ves', $ves, '', 'id="ves"') ;?> </td>
 </tr>
 </tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
<input type="hidden" value="<?php echo $nomina ?>" name="nomina" id="nomina" />
</tbody>
</table>


  <?php
	echo form_close();
  ?>

</div>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#mat").focus();
    });
    
    $(document).ready(function(){
    
    $('#mat').blur(function(){
            mat = $('#mat').attr("value"); 
     });
     $('#ves').blur(function(){
            ves = $('#ves').attr("value"); 
     });
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#medicos_form_suc').submit(function() {
        
   });
          
          
        
     
});
  </script>