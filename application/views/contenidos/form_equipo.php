<div align="center">

  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>

  <?php
	$atributos = array('id' => 'supervisor_form_envio_suc');
    echo form_open('equipos/validar_equipo', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id
$data_obser = array(
              'name'        => 'obser',
              'id'          => 'obser',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
              
              
              
            );
    ?>
 <?php echo $tabla  ?> 
  <table>
  
<tr>
	<th align="center" colspan="2" ><font size="+1">SELECCIONA OBSERVACION DE BAJA DE EQUIPO</font></th>
</tr>

 <tr>    
    <td align="left" ><font size="+1">Observacion.: </font></td>
   	<td align="center"><?php echo form_dropdown('obser', $obserx, '', 'id="obser"') ;?> </td>
 </tr>	
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Aceptar');?></td>
</tr>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
</table>



  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#motivo").focus();
    });
    
    $(document).ready(function(){
    
    $('#motivo').blur(function(){
            motivo = $('#motivo').attr("value");
     });
/////////////////////////////////////////////////


    $('#supervisor_form_envio_suc').submit(function() {
        var motivo = $('#motivo').attr("value").length;
          if( motivo>0){

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