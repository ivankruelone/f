  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_usuario_0');
    echo form_open('catalogo/agrega_c_usuario', $atributos);
    $data_usuario = array(
              'name'        => 'usuario',
              'id'          => 'usuario',
              'value'       => '',
              'maxlength'   => '6',
              'size'        => '6'
              
              
            );
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );
    $data_puesto = array(
              'name'        => 'puesto',
              'id'          => 'puesto',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );
    $data_correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );
   $data_pas = array(
              'name'        => 'pas',
              'id'          => 'pas',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50',
              'type'        => 'password'
            );
  ?>
  
  <table>
<th colspan="2">AGREGAR USUARIO </th>
<tr>
	<td  align="left" ><font size="+1">Usuario: </font></td>
	<td><?php echo form_input($data_usuario, "", 'required');?></td>
 </tr>
 <tr>
	<td  align="left" ><font size="+1">Contrase&ntilde;a: </font></td>
	<td><?php echo form_input($data_pas, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1">Nombre: </font></td>
	<td><?php echo form_input($data_nombre, "", 'required');?></td>
    </select> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">Puesto: </font></td>
    <td><?php echo form_input($data_puesto, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Email: </font></td>
	<td><?php echo form_input($data_correo, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar usuario');?></td>
</tr>
</table>

<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#usuario").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var correo = $('#correo').attr("value");
    $('#catalogo_form_usuario_0').submit(function() {
       
        var usuario = $('#usuario').attr("value").length;
        var nombre = $('#nombre').attr("value").length;
        var puesto = $('#puesto').attr("value").length;
        var correo = $('#correo').attr("value").length;
        var pas = $('#pas').attr("value").length;
        var suc = $('#suc').attr("value");
      
      
          if(usuario >0  && nombre>0 && puesto>0 && correo > 0 && pas>0 && suc>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#usuario').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>