  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados_cambios_rh2');
    echo form_open('recursos_humanos/cambia_empleados_rh2', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id


$data_clave = array(
              'name'        => 'clave_rh',
              'id'          => 'clave_rh',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '100'
            );
    ?>
  
  <table>
  <?php echo $tabla  ?>
<tr>
    <td colspan="3">OBSERVACION: <?php echo form_input($data_clave, "", 'required');?></td>

</tr>
  
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'ENTERADO');?></td>
</tr>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $motivo?>" name="motivo" id="motivo" />
</table>



  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#clave_rh").focus();
    });
    
    $(document).ready(function(){
    
    $('#clave_rh').blur(function(){
            clave_rh = $('#clave_rh').attr("value");
     });
/////////////////////////////////////////////////


    $('#catalogo_form_empleados_cambios_rh2').submit(function() {
        var clave_rh = $('#clave_rh').attr("value").length;
          if( clave_rh>2){

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