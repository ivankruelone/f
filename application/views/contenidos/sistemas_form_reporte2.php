<div align="center">
  <?php
	$atributos = array('id' => 'sistemas_form_reporte2');
    echo form_open('sistemas/reporte_act', $atributos);
     $data_solucion = array(
              'name'        => 'solucion',
              'id'          => 'solucion',
              'value'       => $solucion,
              'maxlength'   => '5000',
              'size'        => '100'
            );
     $data_antes = array(
              'name'        => 'antes',
              'id'          => 'antes',
              'value'       => $antes,
              'maxlength'   => '5000',
              'size'        => '50'
            );
     $data_ahora = array(
              'name'        => 'ahora',
              'id'          => 'ahora',
              'value'       => $ahora,
              'maxlength'   => '5000',
              'size'        => '50'
            );
  ?>

<table align="center">
<tr>
	<td><?php echo $tabla0;?></td>
</tr>
</table>
 
<table>
<tr>

<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="center" colspan="2"><?php echo form_input($data_solucion, "", 'required');?></td>
</tr>
<tr>
	<td align="center">Antes</td>
	<td align="center">Ahora</td>
</tr>
<tr>
	<td><?php echo form_input($data_antes, "", 'required');?></td>
	<td><?php echo form_input($data_ahora, "", 'required');?></td>
</tr>
<tr>
	<td><?php echo form_dropdown('per', $per, '', 'id="per"') ;?> </td>
</tr>


	<td align="center" colspan="2"><?php echo form_submit('envio', 'acepta');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />

  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#solucion").focus();
    });
    
    $(document).ready(function(){
        
/////////////////////////////////////////////////
    $('#sistemas_form_reporte2').submit(function() {
       
        var solucion = $('#solucion').attr("value").length;
       
          if(solucion > 30){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#solucion').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>