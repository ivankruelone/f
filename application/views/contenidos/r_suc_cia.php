 <div align="center">
  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>

  <?php
	$atributos = array('id' => 'reporte');
    echo form_open('reportes/reporte_submit ', $atributos);
  ?>
 
  <table>
<tr>
<th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>SUCURSAL: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucursal, '', 'id="suc"') ;?> </td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#reporte').submit(function() {
        
        var plaza1 = $('#suc').attr("value");
       
        
        if(suc == 0){
            alert('Elige una Sucursal antes de continuar.');
            return false;
        }else{
            return true;
                } 
        
   
   });
          
  </script>