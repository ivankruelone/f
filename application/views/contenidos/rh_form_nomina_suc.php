
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'rh_form_nomina_suc');
    echo form_open('recursos_humanos/inserta_control_nomina', $atributos);
$data_nomina = array(
              'name'        => 'nomx',
              'id'          => 'nomx',
              'value'       => '',
              'maxlength'   => '6',
              'size'        => '6'
            );
            
  ?>

<table>
<tbody>
<tr>
<th colspan="2"><?php echo  $titulo ?></th>
</tr>

   <tr>
	<td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
    
 </tr>
  <tr>    
    <td align="left" ><font size="+1">Nomina.: </font></td>
    <td><?php echo form_input($data_nomina, "", 'required');?></td><br />
 </tr>	
  <tr>
	<td align="left" ><font size="+1">Empleado: </font></td>
    <td align="left">
    <select name="id_emp" id="id_emp">
    </select>
    </td>
</tr>	

 <tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>
<input type="hidden" value="<?php echo $fec ?>" name="fec" id="fec" />
  <?php
	echo form_close();
  ?>

</div>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    
   ///////////////////////////////////////////////////
 
    $('#nomx').change(function(){
     nomx = $('#nomx').attr("value"); 
        if(nomx > 0){
  $.post("<?php echo site_url();?>/catalogo/busca_emp/", { nomx: nomx}, function(data) {
  $("#id_emp").html(data);

  }
  );
   }
   
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#rh_form_nomina_suc').submit(function() {
        var  cia = $('#cia').attr("value");
        var suc = $('#suc').attr("value");
        var fecha = $('#fecha').attr("value").length;
        var nomina = $('#nomina').attr("value");
        
          if( suc > 0 && nomina > 0 ){
    	  }else{
            alert('LLENE LOS DATOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>