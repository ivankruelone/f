
<blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'prenomina_form_3');
    echo form_open('catalogo/tabla_empleados2 ', $atributos);
  ?>
 
  <table>
<tr>
<th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>PLAZA: </strong></font></td>
	<td align="left"><?php echo form_dropdown('plaza1', $plaza1, '', 'id="plaza1"') ;?> </td>
 </tr>

<tr>
	<td align="left" ><font size="+1"><strong>SUCURSAL: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
 </tr>
 
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>

<?php
	echo $tabla;
?>
</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#plaza1").focus();
    });
    
    $(document).ready(function(){

     $('#plaza1').change(function(){

        var plaza1 = $('#plaza1').attr("value");
        
        $.post("<?php echo site_url();?>/catalogo/busca_sucursales/", { plaza: plaza1 }, function(data){
            $("#suc").html(data);
        });
        
     });
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#prenomina_form_3').submit(function() {
        
        var plaza1 = $('#plaza1').attr("value");
        var aaa = $('#suc').attr("value");
        
        if(plaza1 == 0){
            alert('Elige una plaza antes de continuar.');
            return false;
        }else{
            
            if(suc == 0){
                alert('Elige una sucursal antes de continuar.');
                return false;
            }else{
                    return true;
                }
            }
 
        
        
        
   
   });
            
     
});
  </script>