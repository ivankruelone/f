  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'bene_form_0');
    echo form_open('catalogo/bene_d', $atributos);
   ?>
  
  <table>
<tr>
	<th align="left" ><font size="+1">PLAZA: </font></th>
	<th align="left"><?php echo form_dropdown('pla', $plazax, '', 'id="pla"') ;?> </th>
</tr>
<tr>
	<th colspan="2"><?php echo form_submit('envio', 'PLAZA');?></th>
</tr>
</table>
  <?php
	echo form_close();
  ?>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#pla").focus();
    });
    

 /////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#bene_form_0').submit(function() {
       
        var pla = $('#pla').attr("value").length;
        
        alert(pla);
      
          if(pla >10 ){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#pla').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>