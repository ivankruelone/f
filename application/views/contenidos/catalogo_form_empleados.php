  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados');
    echo form_open('catalogo/agrega_empleados', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
 $data_curp = array(
              'name'        => 'curp',
              'id'          => 'curp',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
$data_afilia = array(
              'name'        => 'afilia',
              'id'          => 'afilia',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
$data_pat = array(
              'name'        => 'pat',
              'id'          => 'pat',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
$data_mat = array(
              'name'        => 'mat',
              'id'          => 'mat',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
$data_nom = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );                                                      
$data_salario = array(
              'name'        => 'salario',
              'id'          => 'salario',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
              
            );
$data_integrado = array(
              'name'        => 'integrado',
              'id'          => 'integrado',
              'value'       => '',
              'maxlength'   => '11,2',
              'size'        => '11,2'
            );
$data_registro_pat = array(
              'name'        => 'registro_pat',
              'id'          => 'registro_pat',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
$data_fecha_i = array(
              'name'        => 'fecha_i',
              'id'          => 'fecha_i',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
$data_dire = array(
              'name'        => 'dire',
              'id'          => 'dire',
              'value'       => '',
              'maxlength'   => '70',
              'size'        => '70',
              
            );
$data_num = array(
              'name'        => 'num',
              'id'          => 'num',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
              
            );
$data_col = array(
              'name'        => 'col',
              'id'          => 'col',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15',
              
            );
$data_cp = array(
              'name'        => 'cp',
              'id'          => 'cp',
              'value'       => '',
              'maxlength'   => '5',
              'size'        => '5'
              
            );
$data_mun = array(
              'name'        => 'mun',
              'id'          => 'mun',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
              
            );
$data_enti = array(
              'name'        => 'enti',
              'id'          => 'enti',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
$data_autoriza = array(
              'name'        => 'autoriza',
              'id'          => 'autoriza',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );

    ?>
  
  <table>
<th colspan="3">CONTROL  DE ALTAS  DE NOMINAS</th>
<tr>
	<td colspan="3" align="center" ><font size="+1">NOMBRE DEL PATRON O RAZON SOCIAL</font></td>
</tr>
<tr>
	<td colspan="3" align="left"><?php echo form_dropdown('cia', $ciax, '', 'id="cia"') ;?> </td>
</tr>
<tr>
    <td>RFC:<?php echo form_input($data_rfc, "", 'required');?></td>
	<td>CURP: <?php echo form_input($data_curp, "", 'required');?></td>
	<td>No. DE AFILIACION:<?php echo form_input($data_afilia, "", 'required');?></td>
</tr> 

<tr>
	<td>APELLIDO PATERNO: <?php echo form_input($data_pat, "", 'required');?></td>
	<td>APELLIDO MATERNO: <?php echo form_input($data_mat, "", 'required');?></td>
	<td>NOMBRE: <?php echo form_input($data_nom, "", 'required');?></td>
</tr>
<tr>
	<td colspan="3">DIRECCION: <?php echo form_input($data_dire, "", 'required');?></td>
</tr>
<tr>
	<td>NUMERO: <?php echo form_input($data_num, "", 'required');?></td>
	<td>COLONIA: <?php echo form_input($data_col, "", 'required');?></td>
    <td>C.P: <?php echo form_input($data_cp, "", 'required');?></td>
</tr>
<tr>
	<td>MUNICIPIO: <?php echo form_input($data_mun, "", 'required');?></td>
	<td>ENTIDAD: <?php echo form_input($data_enti, "", 'required');?></td>
    <td></td>
</tr>

<tr>
	<td>SAL. DIARIO: <?php echo form_input($data_salario, "", 'required');?></td>
	<td>SAL. DIARIO INTEGRADO: <?php echo form_input($data_integrado, "", 'required');?></td>
	<td>FECHA DE INICIO DE LABORES: <?php echo form_input($data_fecha_i, "", 'required');?></td>
</tr>
<tr>
    <td colspan="1">REGISTRO PATRONAL: <?php echo form_input($data_registro_pat, "", 'required');?></td>
	<td colspan="2">AUTORIZA: <?php echo form_input($data_autoriza, "", 'required');?></td>
</tr>
<tr>
	<td align="left" colspan="3">PUESTO: <?php echo form_dropdown('puesto', $puex, '', 'id="puesto"') ;?> </td>

</tr>
<tr>
	<td align="left" colspan="3">SUCURSAL: <?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
<input type="hidden" value="<?php echo $nomina ?>" name="nomina" id="nomina" />
<input type="hidden" value="<?php echo $motivo ?>" name="motivo" id="motivo" />
<input type="hidden" value="<?php echo $causa ?>" name="causa" id="causa" />
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
        $("#cia").focus();
    });
    
    $(document).ready(function(){
  

    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#catalogo_form_empleados').submit(function() {
        var suc = $('#suc').attr("value");
        
        var puesto = $('#puesto').attr("value").length;
        var rfc = $('#rfc').attr("value").length;
        var nom = $('#nom').attr("value").length;
        var pat = $('#pat').attr("value").length;
        var mat = $('#mat').attr("value").length;
        var afilia = $('#afilia').attr("value").length;
        var registro_pat = $('#registro_pat').attr("value").length;
        var suc = $('#suc').attr("value").length;
        var cia = $('#cia').attr("value").length;
     
      
        if(  cia > 0 && afilia > 5  && registro_pat > 5  && suc > 2 && rcf > 0 && puesto > 5){
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