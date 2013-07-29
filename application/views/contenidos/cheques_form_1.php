  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form_1');
    echo form_open('cheques/insert_c', $atributos);
    $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
    $data_cheque = array(
              'name'        => 'cheque',
              'id'          => 'cheque',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );

  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td  align="left" ><font size="+1">CONCEPTO: </font></td>
	<td align="left" ><font size="+1"><strong><?php echo $conx ;?></font></strong></td>
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
	<td align="left" ><font size="+1">IMPORTE: </font></td>
	<td><?php echo form_input($data_importe, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">CHEQUE: </font></td>
	<td><?php echo form_input($data_cheque, "", 'required');?></td>
</tr>



	<td colspan="2"><?php echo form_submit('envio', 'GENERAR CHEQUE');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $con ?>" name="con" id="con" />
<input type="hidden" value="<?php echo $tiva ?>" name="tiva" id="tiva" />
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
        $("#rec").focus();
    });
    
    $(document).ready(function(){
    
    $('#rec').blur(function(){
            rec = $('#rec').attr("value");
            $("#suc").focus();
     });
     ////////////////////////////
     $('#suc').blur(function(){
            suc = $('#suc').attr("value");
     });
     ////////////////////////////
    $('#importe').blur(function(){
            importe = $('#importe').attr("value"); 
     });
     ////////////////////////////
     $('#cheque').blur(function(){
            cheque = $('#cheque').attr("value"); 
     });
 /////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
    $('#suc').change( function()
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
    $('#cheques_form_1').submit(function() {
       
        var suc = $('#suc').attr("value");
        var rec = $('#rec').attr("value").length;
        var importe = $('#importe').attr("value");
        var cheque = $('#cheque').attr("value");
      
          if(suc >0  && rec>0 && importe>0  && cheque>0){
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