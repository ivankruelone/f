  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_devolucion_form_suc_mod');
    echo form_open('a_devolucion/cambia_ctl', $atributos);
     $data_rrm = array(
              'name'        => 'rrm',
              'id'          => 'rrm',
              'value'       => $rrm,
              'maxlength'   => '20',
              'size'        => '20'
            );
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="center" colspan="2"><font size="+1" color="#FC0303">ALMACEN CENTRAL CEDIS</font></td>

</tr>

<tr>
	<td align="left" ><font size="+1">RRM: </font></td>
	<td><?php echo form_input($data_rrm, "", 'required');?></td>
</tr>

	<td align="center" colspan="2"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
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
        $("#rrm").focus();
    });
    
    $(document).ready(function(){
    
    $('#rrm').blur(function(){
            tipo = $('#rrm').attr("value");
            $("#rrm").focus();
     });
     ////////////////////////////
 ////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_devolucion_form_suc_mod').submit(function() {
       
        var rrm = $('#rrm').attr("value").length;
       
          if(rrm >0){
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