  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_usuario_1');
    echo form_open('catalogo/cambio_c_usuario', $atributos);
    $data_usuario = array(
              'name'        => 'usuario',
              'id'          => 'usuario',
              'value'       => $usuario,
              'maxlength'   => '6',
              'size'        => '6'
              
              
            );
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => $nombre,
              'maxlength'   => '50',
              'size'        => '50'
            );
    $data_puesto = array(
              'name'        => 'puesto',
              'id'          => 'puesto',
              'value'       => $puesto,
              'maxlength'   => '50',
              'size'        => '50'
            );
    $data_correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'value'       => $correo,
              'maxlength'   => '50',
              'size'        => '50'
            );
  ?>
  
  <table>
  
<th colspan="2">CAMBIO DE USUARIOS </th>
<tr>
	<td  align="left" ><font size="+1">Usuario: </font></td>
	<td><?php echo form_input($data_usuario, "", 'required');?></td>
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
	<td align="left" ><font size="+1">Activo: </font></td>
    <td align="left"> 
    <select name="activo" id="activo">
    <option value="1" <?php if($activo=='1') echo "Selected"?> >Activo</option>
    <option value="0" <?php if($activo=='0') echo "Selected"?> >Inactivo</option>
    </select>
    </td>
</tr>

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
        $("#usuario").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var correo = $('#correo').attr("value");
    $('#catalogo_form_usuario_1').submit(function() {
       
        var usuario = $('#usuario').attr("value").length;
        var nombre = $('#nombre').attr("value").length;
        var puesto = $('#puesto').attr("value").length;
        var correo = $('#correo').attr("value").length;
       
      
      
          if(usuario >0  && nombre>0 && puesto>0 && correo > 0 ){
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