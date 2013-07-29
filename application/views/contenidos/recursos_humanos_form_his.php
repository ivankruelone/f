  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'recursos_humanos_form_his');
    echo form_open('recursos_humanos/tabla_mov_supervisor_motivo_his', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id

    ?>
  
  <table>
  
<tr>
	<th align="center" ><font size="+1">HISTORICO DE MOVIMIENTOS CAPTURADOS POR EL SUPERVISOR</font></th>
</tr>
<tr>
	<td align="center"><?php echo form_dropdown('motivo', $motivox, '', 'id="motivo"') ;?> </td>
</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Ver');?></td>
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
        $("#motivo").focus();
    });
    
    $(document).ready(function(){
    
    $('#motivo').blur(function(){
            motivo = $('#motivo').attr("value");
     });
/////////////////////////////////////////////////


    $('#recursos_humanos_form_his').submit(function() {
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