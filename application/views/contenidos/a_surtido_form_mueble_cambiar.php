  <blockquote>
    
    <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
  </blockquote>
<div align="center">
    <?php
////////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'a_surtido_form_mueble_cambiar');
    echo form_open('a_surtido/cambia_mu', $atributos);
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
    $data_mue = array(
              'name'        => 'mue',
              'id'          => 'mue',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );

  ?>
  


<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1">sec: </font></td>
	<td><?php echo form_input($data_sec, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">MUEBLE: </font></td>
	<td><?php echo form_input($data_mue, "", 'required');?></td>
</tr>



	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $con ?>" name="con" id="con" />
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
        $("#sec").focus();
    });
    
    $(document).ready(function(){
    
    $('#sec').blur(function(){
            sec = $('#sec').attr("value");
            $("#can").focus();
     });
     ////////////////////////////
     $('#can').blur(function(){
            can = $('#can').attr("value");
     });
     ////////////////////////////
    /////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_surtido_form_mueble_cambiar').submit(function() {
       
        var sec = $('#sec').attr("value");
        var can = $('#can').attr("value").length;
       
          if(sec >0  && can>0){
    	    
    	    
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
    $('#a_surtido_form_cerrar').submit(function() {
         if(confirm("Seguro que los datos son correctos?")){
    	   
         }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
          
    	  });
          

///////////////////////////////////////////////////////

  </script>