  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form_1_varios_varios');
    echo form_open('cheques/insert_d', $atributos);
    $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
    $data_varios = array(
              'name'        => 'varios',
              'id'          => 'varios',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'
              
              
            );
  
  ?>
 <tr>
	<td><?php echo $tabla1;?></td>
</tr> 
<tr>
	<td><?php echo $tabla;?></td>
</tr>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
  
  <table>
<tr>
	<td align="left" ><font size="+1">NUMERO DE SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?><span id="mensaje"></span> </td>
</tr>

<tr>
	<td align="left" ><font size="+1">IMPORTE: </font></td>
	<td><?php echo form_input($data_importe, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">OTROS: </font></td>
	<td><?php echo form_input($data_varios, "", 'required');?></td>
</tr>

	<td colspan="2"><?php echo form_submit('envio', 'GENERAR CHEQUE');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc ?>" name="id_cc" id="id_cc" />
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
    
     ////////////////////////////
       ////////////////////////////
    $('#importe').blur(function(){
            importe = $('#importe').attr("value"); 
     });
     ////////////////////////////
      $('#rec').blur(function(){
            rec = $('#rec').attr("value");
            $("#importe").focus();
     });
   
     /////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
    $('#suc').change(
        function()
        {
       
        suc=$('#suc').attr("value");
        con=$('#con').attr("value");
    var suc = $('#suc').attr("value");
        id_cc = $('#id_cc').attr("value");
    var id_cc = $('#id_cc').attr("value");
        if(suc>0){
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////


     $.ajax({type: "POST",
        url: "<?php echo site_url();?>/cheques/busca_suc_detalle/", data: ({ suc: suc ,id_cc: id_cc  }),
            success: function(data){
               if(data == '0'){
                  alert("Ya agregaste un recibo de la sucursal " + suc + "");
                  $('#suc').focus();
                  $('#mensaje').html('');
                  $('#suc').val('');
                  
               }else{
                    $('#mensaje').html('<b><font color="#65B553">Sucursal correcta !!!</font></b>');
                    $('#valida').val(1);
               }
        },
        beforeSend: function(data){
                  $('#mensaje').html('<b><font color="#F24B13">Validando...</font></b>');
        }        });


/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////

                        // Llamamos al archivo combo1.php
            $.post("<?php echo site_url();?>/catalogo/busca_recep/", { suc: suc, con: con }, function(data){
			$("#rec").html(data);
            
                        // reseteamos el combo3
        });
   }
   
   
   
   
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#cheques_form_1_varios_varios').submit(function() {
       
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