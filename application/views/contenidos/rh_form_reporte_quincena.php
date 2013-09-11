  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'rh_form_reporte_quincena');
    echo form_open('recursos_humanos/reportes_checador', $atributos);


  ?>
  
  <table>
<th colspan="2">SELECCIONAR FECHA DE MOVIMIENTOS</th>
<tr>
	<td align="left" ><font size="+1">Depto o Sucursal: </font></td>
	<td><?php echo form_dropdown('quin', $quin, '', 'id="quin"') ;?> </td>
</tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
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
        $("#quin").focus();
    });
    
    $(document).ready(function(){
   
   
   
   $(function() {
		$( "#fec1" ).datepicker();
	});
     $(function() {
		$( "#fec2" ).datepicker();
	});  
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#rh_form_reporte_quincena').submit(function() {
         var quin = $('#quin').attr("value").length;
        
          if(quin == 20){
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