
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<div align="center">

<?php
	$atributos = array('id' => 'supervisor');
    echo form_open('recursos_humanos/tabla_incapacidad_supervisor', $atributos);

  ?>
  
  <table>
<th colspan="2"><font size="+1">Selecciona el supervisor</font></th>
<tr>
	<td align="left" ><font size="+1"><strong>SUPERVISOR: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre', $supervisorx, '', 'id="nombre"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>

  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nombre").focus();
    });
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#supervisor').submit(function(event){
        
        var nombre = $('#nombre').attr('value');
      
        
        if(nombre == 0){
            alert('Debes seleccionar un supervisor.');
            event.preventDefault();
        }else{
            
      
            /////////////inicio
           if(confirm("Seguro que deseas seleccionar ese supervisor?")){
            return true;
            
           } else{
            //evita que se ejecute el evento
            event.preventDefault();
            return false;
           }
           ////////////////fin

          }  
        }
        
        
    });          
          
        
     
});
  </script>
