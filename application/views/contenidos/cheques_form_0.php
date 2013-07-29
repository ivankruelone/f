  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form_0');
    echo form_open('cheques/tabla_confirma', $atributos);
    
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>CONCEPTO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('con', $conx, '', 'id="con"') ;?> </td>
 </tr>


	<td colspan="2"align="center"><?php echo form_submit('envio', 'CONCEPTO');?></td>
</tr>
</table>
<input type="hidden" value="0" name="valida" id="valida" />
  <?php
	echo form_close();
  ?>
<table align="center">
<tr>
	<td><?php echo $tabla;?></td>
</tr>
</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#con").focus();
    });
    
    $(document).ready(function(){
    
    $('#con').blur(function(){
            suc = $('#suc').attr("value"); 
     });
     
     
    
   ///////////////////////////////////////////////////
 $('#con').blur(function()
        {
            var con=$('#con').attr("value");
        if(con != 0){
                    
                    $.post("<?php echo site_url();?>/cheques/busca_receptores/", { con: con }, function(data){
                    $("#rec").html(data);
                });
           }else{
            $("#rec").html('');
           }
        
        }
    
    );   

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#cheques_form_0').submit(function() {
        
        
        var con = $('#con').attr("value");
        
          if(con > 0 ){
    	    
    	    
    	  }else{

    	    alert('Seleccione un concepto');
    	    
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>