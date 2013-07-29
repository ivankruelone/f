  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form');
    echo form_open('cheques/insert_c', $atributos);
    $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
              
            );
    $data_ieps = array(
              'name'        => 'ieps',
              'id'          => 'ieps',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
              
            );
     $data_infinitum = array(
              'name'        => 'infinitum',
              'id'          => 'infinitum',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
              
            );
  
  ?>
  
  <table>
 <tr>
	<td>NUMERO DE SUCURSAL: </td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td>CONCEPTO: </td>
	<td align="left"><?php echo form_dropdown('con', $conx, '', 'id="con"') ;?> </td>
 </tr>
<tr>
	<td>NOMBRE DE: </td>
	<td align="left"> <select id="rec" name="rec">
    </select> </td>
</tr>

<tr>
	<td>IMPORTE: </td>
	<td><?php echo form_input($data_importe, "", 'required');?><span id="mensaje"></span></td>
</tr>

<tr>
	<td>IPES: </td>
	<td><?php echo form_input($data_importe, "", 'required');?><span id="mensaje"></span></td>
</tr>

<tr>
	<td>INFINITUM: </td>
	<td><?php echo form_input($data_infinitum, "", 'required');?><span id="mensaje"></span></td>
</tr>

	<td colspan="2"><?php echo form_submit('envio', 'GENERAR CHEQUE');?></td>
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
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    $('#suc').blur(function(){
            suc = $('#suc').attr("value"); 
     });
     
     
    
    $('#importe').blur(function(){
            var importe = $('#importe').attr("value"); 
     });
 ///////////////////////////////////////////////////
 $('#con').blur(
        function()
        {
            var con=$('#con').attr("value");
        if(con != 0){
                    
                    $.post("<?php echo site_url();?>/cheques/busca_receptores/", { con: con }, function(data){
                    $("#rec").html(data);
                });
           }else{
            $("#rec").html('');
           }
        
        }
    
    );   

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#cheques_form').submit(function() {
        
        var suc = $('#suc').attr("value");
        var con = $('#con').attr("value");
        var rec = $('#rec').attr("value").length;
        var importe = $('#importe').attr("value");
       
          if(suc >0 && con > 0 && rec>0 && importe>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion de producto por favor');
    	    $('#suc').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>