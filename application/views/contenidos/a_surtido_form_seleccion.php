  <blockquote>
    
    <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
  </blockquote>
<div align="center">
    <?php
//////////////////////////////////////////////////////////////////////////////////////
      $atributos1 = array('id' => 'a_surtido_form_seleccion');
    echo form_open('a_surtido/cerrar', $atributos1);

////////////////////////////////////////////////////////////////////////////////////// 

  ?>
  


<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1">Surtidor: </font></td>
	<td><?php echo form_dropdown('sur', $surx, '', 'id="sur"') ;?> </td>
</tr>

<tr>
	<td align="left" ><font size="+1">Empacador: </font></td>
	<td><?php echo form_dropdown('emp', $empx, '', 'id="emp"') ;?> </td>
</tr>
  <tr>
<td></td>
	<td><?php echo form_submit('envio', 'Cerrar folio');?></td>
</tr>
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
  <?php
  	echo form_close();
  ?>
<table align="center">
<tr>
	<td><?php echo $tabla;?></td>
</tr>
</table>

  <?php

    
	echo form_close();
  

  ?>
</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#sur").focus();
    });
    
    $(document).ready(function(){
    
    $('#sur').blur(function(){
            sur = $('#sur').attr("value");
            $("#emp").focus();
     });
     ////////////////////////////
     $('#emp').blur(function(){
            emp = $('#emp').attr("value");
     });
     ////////////////////////////
    /////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_surtido_form_seleccion').submit(function() {
       
        var sur = $('#sur').attr("value");
        var emp = $('#emp').attr("value").length;
       
          if(sur >0  && emp>0){
    	    
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
    	  });
          
      ////////////////////////////
    /////////////////////////////////////////////
         
        
     
});
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////

  </script>