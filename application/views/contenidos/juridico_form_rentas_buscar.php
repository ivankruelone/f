  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'juriduco_form_rentas_buscar');
    echo form_open('juridico/buscar_rentas', $atributos);

  ?>
  
  <table>
<th colspan="2">BUSCAR ARRENDATARIO </th>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">ARRENDADOR: </font></td>
	<td align="left"><?php echo form_dropdown('arr', $arrx, '', 'id="suc"') ;?> </td>
</tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'BUSCAR');?></td>
</tr>
</table>

<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#juridico_form_rentas_buscar').submit(function() {
        var suc = $('#suc').attr("value");
        var rfc = $('#rfc').attr("value").length;
        var nom = $('#nom').attr("value").length;
        var imp = $('#imp').attr("value").length;
        var pago = $('#pago').attr("value").length;
      
          if(rfc>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#usuario').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>