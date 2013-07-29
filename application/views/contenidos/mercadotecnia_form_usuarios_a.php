  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'mercadotecnia_form_usuarios_a');
    echo form_open('mercadotecnia/adiciona_usuario', $atributos);
$data_user = array(
              'name'        => 'user',
              'id'          => 'user',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '70'
              
            );
$data_pass = array(
              'name'        => 'pass',
              'id'          => 'pass',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
              
            );
$data_email = array(
              'name'        => 'email',
              'id'          => 'email',
              'value'       => '',
              'maxlength'   => '150',
              'size'        => '70'
              
            );

  ?>
  
  <table>
<th colspan="2"><?php echo 'AGREGA USUARIO'?></th>
<tr>
	<td align="left" ><font size="+1">LABORATORIO: </font></td>
	<td><?php echo form_dropdown('labor', $labor, '', 'id="labor"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">NOMBRE: </font></td>
    <td><?php echo form_input($data_email, "", 'required');?></td>
</tr> 
<tr>
	<td align="left" ><font size="+1">USUARIO: </font></td>
	<td><?php echo form_input($data_user, "", 'required');?></td>
    </select> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">CONTRASE&Ntilde;A: </font></td>
	<td><?php echo form_input($data_pass, "", 'required');?></td>
    </select> </td>
</tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fec1").focus();
    });
    
    $(document).ready(function(){
   
   
   
  
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#mercadotecnia_form_usuarios').submit(function() {
        var fec1 = $('#fec1').attr("value").length;
        var fec2 = $('#fec2').attr("value").length;
          if(fec1 == 10 && fec2 == 10){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#fec1').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>