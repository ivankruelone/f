  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_surtido_form_mue');
    echo form_open('a_surtido/tabla_control_mue_det', $atributos);
 
    $data_con = array(
              'name'        => 'con',
              'id'          => 'con',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2',
              'type'        =>'password'
              
              
            );

  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>



<tr>
	<td align="left" ><font size="+1">CONTRASE&Ntilde;A: </font></td>
	<td><?php echo form_input($data_con, "", 'required');?></td>
</tr>



	<td colspan="2"><?php echo form_submit('envio', 'acepta');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>

<?php echo $tabla;?>



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
///////////////////////////////////////////////////////valida equipo para traer accesorio   
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_surtido_form_mue').submit(function() {
       
        var sec = $('#sec').attr("value");
        var can = $('#can').attr("value").length;
       
          if(sec >0  && can>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>