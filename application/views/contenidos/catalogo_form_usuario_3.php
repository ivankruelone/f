  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_usuario_3');
    echo form_open('catalogo/agrega_c_usuario_sucursal', $atributos);
  ?>
  
  <table>
<th colspan="2">AGREGAR SUCURSAL A USUARIO </th>
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
    	<td><?php echo $puesto ?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Email: </font></td>
	<td><?php echo $email ?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar Sucursal');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#catalogo_form_usuario_3').submit(function() {
       
        
        var suc = $('#suc').attr("value");
      
      
          if( suc>0){
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