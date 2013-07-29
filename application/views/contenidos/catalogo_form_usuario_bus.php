  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_usuario_ger_0');
    echo form_open('catalogo_ger/agrega_c_usuario', $atributos);
    $data_pat = array(
              'name'        => 'pat',
              'id'          => 'pat',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
              
              
            );
    $data_mat = array(
              'name'        => 'mat',
              'id'          => 'mat',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
    
    $data_nom = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
             $data_ss= array(
              'name'        => 'ss',
              'id'          => 'ss',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
 
  ?>
  
  <table>
<th colspan="2">AGREGAR USUARIO </th>
<tr>
	<td  align="left" ><font size="+1">Nombres: </font></td>
	<td><?php echo form_input($data_nom, "", 'required');?></td>
 </tr>
 <tr>
	<td  align="left" ><font size="+1">Apellido paterno: </font></td>
	<td><?php echo form_input($data_pat, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1">Apellido materno: </font></td>
	<td><?php echo form_input($data_mat, "", 'required');?></td>
    
</tr>
<tr>
	<td  align="left" ><font size="+1"> </font></td>
	<td><?php echo form_input($data_ss, "", 'required');?></td>
 </tr>

<tr>
	
</tr>
</table>
<tr>
	<td align="right"><font size="+2" color="maroon"><span id="completo"></span></font></td>
</tr>
<div id="tabla">

</div>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nom").focus();
    });
    
    $(document).ready(function(){
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    
     $('#mat').blur(function(){
            nom = $('#nom').attr("value");
            pat = $('#pat').attr("value");
            mat = $('#mat').attr("value");
         
      
      if(nom > ' ' ){
            $.post("<?php echo site_url();?>/catalogo/busca_empleado_nombre/", { nom: nom, pat: pat, mat: mat}, function(data){
            $("#tabla").html(data);
            
             });
             }
     });
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var correo = $('#correo').attr("value");
    $('#catalogo_form_usuario_ger_0').submit(function() {
       
        var usuario = $('#usuario').attr("value").length;
        var id_empleado = $('#id_empleado').attr("value").length;
        var correo = $('#correo').attr("value").length;
        var pas = $('#pas').attr("value").length;
        var suc = $('#suc').attr("value");
        var pla = $('#pla').attr("value");
      
      
          if(usuario >0  && id_empleado>0 && puesto>0 && correo > 0 && pas>0 && suc>0 && pla > 0){
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