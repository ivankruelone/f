  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'supervisor_form_his');
    echo form_open('supervisor/movimiento_his_1', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id
 $data_aaa = array(
              'name'        => 'aaa',
              'id'          => 'aaa',
              'value'       => date('Y'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
$data_mes = array(
              'name'        => 'mes',
              'id'          => 'mes',
              'value'       => date('m'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
    ?>
  
  <table>
  
<tr>
	<th align="center"  colspan="2"><font size="+1">HISTORICO DE MOVIMIENTOS CAPTURADOS POR EL SUPERVISOR</font></th>
</tr>
<tr>
	<td align="center" colspan="2"><?php echo form_dropdown('motivo', $motivox, '', 'id="motivo"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1" color="blue">A&Ntilde;O: </font></td>
	<td colspan="1"><?php echo form_input($data_aaa);?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1" color="blue">MES: </font></td>
	<td colspan="1"><?php echo form_input($data_mes);?></td>
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


    $('#supervisor_form_his').submit(function() {
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