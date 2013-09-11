
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
//////////////////////////////////////////////////////////////////////////////////////
      $atributos1 = array('id' => 'nomina_form_cerrar');
    echo form_open('recursos_humanos/cerrar_nomina', $atributos1);
 ?>
  <tr>
<td></td>
	<td><?php echo form_submit('envio', 'Cerrar Entrega');?></td>
</tr>
<input type="hidden" value="<?php echo $suc?>" name="suc" id="suc" />
<input type="hidden" value="<?php echo $fec?>" name="fec" id="fec" />
  <?php
  	echo form_close();

//////////////////////////////////////////////////////////////////////////////////////



	$atributos = array('id' => 'rh_form_nomina_suc_emp');
    echo form_open('recursos_humanos/agrega_nomina', $atributos);
$data_nomina = array(
              'name'        => 'nomx',
              'id'          => 'nomx',
              'value'       => '',
              'maxlength'   => '6',
              'size'        => '6'
            );
$data_fec = array(
              'name'        => 'fec',
              'id'          => 'fec',
              'value'       => $fec,
              'maxlength'   => '10',
              'size'        => '10'
            );
            
  ?>

<table>
<tbody>
<tr>
<th colspan="2"><?php echo  $titulo ?></th>
</tr>
  <tr>    
    <td align="left" ><font size="+1">Nomina.: </font></td>
    <td><?php echo form_input($data_nomina, "", 'required');?></td><br />
 </tr>	
  <tr>
	<td align="left" ><font size="+1">Empleado: </font></td>
    <td align="left">
    <select name="id_emp" id="id_emp">
    </select>
    </td>
</tr>	

 <tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>
<input type="hidden" value="<?php echo $fec ?>" name="fec" id="fec" />
<input type="hidden" value="<?php echo $suc ?>" name="suc" id="suc" />
  <?php
	echo form_close();
  ?>

</div>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nomx").focus();
    });
    
    $(document).ready(function(){
    
    
   ///////////////////////////////////////////////////
 
    $('#nomx').change(function(){
     nomx = $('#nomx').attr("value");
     fec = $('#fec').attr("value"); 
        if(nomx > 0){
  $.post("<?php echo site_url();?>/catalogo/busca_emp_nomina/", { nomx: nomx, fec: fec}, function(data) {
  $("#id_emp").html(data);

  }
  );
   }
   
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#rh_form_nomina_suc_emp').submit(function() {
        var  cia = $('#cia').attr("value");
        var suc = $('#suc').attr("value");
        var fecha = $('#fecha').attr("value").length;
        var nomina = $('#nomina').attr("value");
        
          if( suc > 0 && nomina > 0 ){
    	  }else{
            alert('LLENE LOS DATOS');
    	    return false    
         }
   
   });
          
          
        
     
});

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#nomina_form_cerrar').submit(function() {
         if(confirm("Seguro que los datos son correctos?")){
    	   
         }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
          
    	  });
          

///////////////////////////////////////////////////////
  </script>