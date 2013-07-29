  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form_0_varios');
    echo form_open('cheques/insert_c_varios', $atributos);
    $data_cheque = array(
              'name'        => 'cheque',
              'id'          => 'cheque',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
              
              
            );
    
    
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>CONCEPTO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('con', $conx, '', 'id="con"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1">NUMERO DE SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>

 <tr>
	<td align="left" ><font size="+1">BENEFICIARIO: </font></td>
    <td align="left">
    <select name="rec" id="rec">
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">CHEQUE: </font></td>
	<td><?php echo form_input($data_cheque, "", 'required');?></td>
</tr>


	<td colspan="2"align="center"><?php echo form_submit('envio', 'CONCEPTO CON VARIAS SUCURSALES');?></td>
</tr>
</table>
<input type="hidden" value="0" name="valida" id="valida" />
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
        $("#con").focus();
    });
    
    $(document).ready(function(){
    
    $('#con').blur(function(){
            suc = $('#suc').attr("value"); 
     });
     
     
    
   ///////////////////////////////////////////////////
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
    $('#suc').change(
        function()
        {
        suc=$('#suc').attr("value");
        con=$('#con').attr("value");
  
        if(suc>0){
            
                        // Llamamos al archivo combo1.php
            $.post("<?php echo site_url();?>/catalogo/busca_recep/", { suc: suc, con: con }, function(data){
			$("#rec").html(data);
            
                        // reseteamos el combo3
        });
   }
   
   
   
   
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////


    $('#cheques_form_0_varios').submit(function() {
        
        
        var con = $('#con').attr("value");
        
          if(con > 0 ){
    	    
    	    
    	  }else{

    	    alert('Seleccione un concepto');
    	    
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>