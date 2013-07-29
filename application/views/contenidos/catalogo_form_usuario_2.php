  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_usuario_2');
    echo form_open('catalogo/cambio_c_usuario_pas', $atributos);
     $data_pas = array(
              'name'        => 'pas',
              'id'          => 'pas',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15',
              'type'        => 'password'
            );
  ?>
  
  <table>
<th colspan="2">CAMBIO DE USUARIOS </th>
<tr>
	<td  align="left" ><font size="+1">Usuario: </font></td>
	<td><?php echo $usuario?></td>
 </tr>
 
<tr>
	<td align="left" ><font size="+1">Nombre: </font></td>
	<td><?php echo $nombre?></td>
    </select> </td>
</tr>

<tr>
	<td align="left" ><font size="+1">Puesto: </font></td>
    <td><?php echo $puesto?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Email: </font></td>
	<td><?php echo $correo?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Password: </font></td>
	<td><?php echo form_input($data_pas, "", 'required');?></td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Cambiar datos');?></td>
</tr>

</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#pas").focus();
    });
    
    $(document).ready(function(){
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#catalogo_form_usuario_2').submit(function() {
       
        var pas = $('#pas').attr("value").length;
        
          if(pas > 6 ){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#pas').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>