
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<div align="center">

<?php
	$atributos = array('id' => 'pedidos');
    echo form_open('pedido/muestra_pedidos', $atributos);
  ?>
  
  <table>
<th colspan="2"><font size="+1">Selecciona el d&iacute;a de transmision</font></th>
<tr>
	<td align="left" ><font size="+1"><strong>Dia: </strong></font></td>
	<td align="left"><?php echo form_dropdown('dia', $diax, '', 'id="dia"') ;?> </td>
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
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#pedidos').submit(function(event){
        
        var nombre = $('#dia').attr('value');
       
        if(dia == 0){
            alert('Debes seleccionar un dia.');
            event.preventDefault();
       
        }else{ 
            
        
       
            /////////////inicio
           if(confirm("Seguro que deseas enviar la informacion?")){
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
