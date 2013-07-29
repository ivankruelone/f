  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'encargado_form_ventas_ticket_p');
    echo form_open('encargado/actualiza_ticket_pedido', $atributos);
    
    $data_ticket = array(
              'name'        => 'ticket',
              'id'          => 'ticket',
              'size'        => '15',
              'type'        => 'text',
              
                );
    
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
    <td align="left" ><font size="+1"><strong>Ticket Num </strong></font></td>
    <td align="left"> <?php echo form_input($data_ticket, ""); ?></td>
</tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('id', $id);
	echo form_close();
  ?>
  
  <div>
  
  
  
  </div>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#ticket").focus();
    });
    
    $(document).ready(function(){
    
    $('#ticket').blur(function(){
            ticket = $('#ticket').attr("value"); 
     });
    
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#encargado_form_ventas_ticket_p').submit(function() {
        
        
        var ticket = $('#ticket').attr("value");
        
          if(ticket > 0 ){
    	  }else{
            alert('ESCRIBA NUMERO DE TICKET');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>