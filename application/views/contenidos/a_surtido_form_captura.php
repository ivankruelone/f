  <blockquote>
    
    <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
  </blockquote>
<div align="center">
    <?php
//////////////////////////////////////////////////////////////////////////////////////
      $atributos1 = array('id' => 'a_surtido_form_cerrar');
    echo form_open('a_surtido/seleccion', $atributos1);
 ?>
  <tr>
<td></td>
	<td><?php echo form_submit('envio', 'Cerrar folio');?></td>
</tr>
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
  <?php
  	echo form_close();

////////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'a_surtido_form_captura');
    echo form_open('a_surtido/cambia_sur', $atributos);
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
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
	<td align="left" ><font size="+1">CANTIDAD: </font></td>
	<td><?php echo form_input($data_can, "", 'required');?></td>
</tr>



	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $fol ?>" name="fol" id="fol" />
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
    $('#a_surtido_form_captura').submit(function() {
       
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