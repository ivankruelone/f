  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'bene_form_1');
    echo form_open('catalogo/agrega_c_bene', $atributos);
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
              
              
            );
    $data_nombre = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
              
            );
   
   ?>
  
  <table>
<tr>
	<th align="left" ><font size="1">CIA: </font></th>
	<th align="left"><?php echo  $ciax;?> </th>
</tr>
<tr>
	<th align="left" ><font size="1">PLAZA: </font></th>
	<th align="left"><?php echo  $plax;?> </th>
</tr>

<tr>
	<td align="left" ><font size="+1">Sucursal: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
	
</tr>
<tr>
	<td align="left" ><font size="+1">Poliza: </font></td>
	<td align="left"><?php echo form_dropdown('cla', $clavex, '', 'id="cla"') ;?> </td>
	
</tr>
<tr>
	<td  align="left" ><font size="+1">RFC: </font></td>
	<td><?php echo form_input($data_rfc, "", 'required');?></td>
</tr>

<tr>
	<td  align="left" ><font size="+1">NOMBRE: </font></td>
	<td><?php echo form_input($data_nombre, "", 'required');?></td>
 </tr>

<tr>
	<th colspan="2"><?php echo form_submit('envio', 'AGREGAR BENEFICIARIO');?></th>
</tr>
</table>
<input type="hidden" value="<?php echo $pla ?>" name="pla" id="pla" />
<input type="hidden" value="<?php echo $cia ?>" name="cia" id="cia" />
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
        $("#suc").focus();
    });
    

 /////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#bene_form_1').submit(function() {
       
        var rfc = $('#rfc').attr("value").length;
        var nom = $('#nom').attr("value").length;
        var suc = $('#suc').attr("value").length;
        var cla = $('#cla').attr("value").length;
       
       
      
          if(rfc >0 && nombre>0 && suc>0 && cla>0){
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