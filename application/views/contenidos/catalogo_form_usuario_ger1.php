  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_usuario_ger1');
    echo form_open('catalogo_ger/agrega_c_usuario_supervisor', $atributos);
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
	<td align="left" ><font size="+1">SUPERVISOR: </font></td>
	<td align="left"><?php echo form_dropdown('sup', $supx, '', 'id="sup"') ;?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar Supervisor');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $plaza ?>" name="plaza" id="plaza" />
<input type="hidden" value="<?php echo $nivel ?>" name="nivel" id="nivel" />
<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#sup").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#catalogo_form_usuario_ger1').submit(function() {
       
        
        var sup = $('#sup').attr("value");
      
      
          if( sup>0){
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