  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_cuentas_0');
    echo form_open('catalogo/agrega_c_cuentas', $atributos);
    $data_cuenta = array(
              'name'        => 'cuenta',
              'id'          => 'cuenta',
              'value'       => '',
              'maxlength'   => '8',
              'type'        => 'text',
              'size'        => '8'
            );
    
  ?>
  
  <table>
<th colspan="4">AGREGAR CUENTA</th>
<tr>
	<td  align="left" ><font size="+1">Cuenta: </font></td>
	<td colspan="3"><?php echo form_input($data_cuenta, "", 'required');?></td>
 </tr>

<tr>
	<td align="left" ><font size="+1">Compa&ntilde;ia: </font></td>
	<td align="left"><?php echo form_dropdown('cia', $ciax, '', 'id="cia"') ;?> </td>
	
</tr>
<tr>
	<td align="left" ><font size="+1">Plaza: </font></td>
	<td align="left">
    <select name="plazax" id="plazax">
    </select>

    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">Banco: </font></td>
	<td align="left"><?php echo form_dropdown('banco', $bancox, '', 'id="banco"') ;?> </td>
</tr>
<tr>
	<td colspan="4" align="center"><?php echo form_submit('envio', 'Agregar Cuenta de cheques');?></td>
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
        $("#cuenta").focus();
    });
    
    $(document).ready(function(){
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
    $('#cia').change(
        function()
        {
        cia=$('#cia').attr("value");
        
   
        if(cia>0){
                        // Llamamos al archivo combo1.php
            $.post("<?php echo site_url();?>/catalogo/busca_pla/", { cia: cia }, function(data){
                        // Asignamos las nuevas opciones para el combo2
            $("#plazax").html(data);
            
                        // reseteamos el combo3
        });
   }
   
   
   
   
   });    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#catalogo_form_cuentas_0').submit(function() {
       
        var cuenta = $('#cuenta').attr("value").length;
        var cia = $('#cia').attr("value");
        var plazax = $('#plazax').attr("value");
        var banco = $('#banco').attr("value");
      
      
          if(cuenta >0  && cia>0 && plaza>0 && banco>0){
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