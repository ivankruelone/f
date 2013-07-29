  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cortes_form_1');
    echo form_open('cortes/insert_d', $atributos);
     $data_1 = array(
              'name'        => 'l1',
              'id'          => 'l1',
              'value'       => 0,
              'type'        =>'number',
              
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_2 = array(
              'name'        => 'l2',
              'id'          => 'l2',
              'value'       => 0,
              'type'        =>'number',
              
              'maxlength'   => '20',
              'size'        => '10'
  );            
             
     $data_4 = array(
              'name'        => 'l4',
              'id'          => 'l4',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_5 = array(
              'name'        => 'l5',
              'id'          => 'l5',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
              
     $data_8 = array(
              'name'        => 'l8',
              'id'          => 'l8',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
           
     $data_9 = array(
              'name'        => 'l9',
              'id'          => 'l9',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_10 = array(
              'name'        => 'l10',
              'id'          => 'l10',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );
     $data_11 = array(
              'name'        => 'l11',
              'id'          => 'l11',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );             
     $data_12 = array(
              'name'        => 'l12',
              'id'          => 'l12',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_13 = array(
              'name'        => 'l13',
              'id'          => 'l13',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_16 = array(
              'name'        => 'l16',
              'id'          => 'l16',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );
     $data_19 = array(
              'name'        => 'l19',
              'id'          => 'l19',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_20 = array(
              'name'        => 'l20',
              'id'          => 'l20',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_21 = array(
              'name'        => 'l21',
              'id'          => 'l21',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_22 = array(
              'name'        => 'l22',
              'id'          => 'l22',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_23 = array(
              'name'        => 'l23',
              'id'          => 'l23',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );
     $data_24 = array(
              'name'        => 'l24',
              'id'          => 'l24',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_30 = array(
              'name'        => 'l30',
              'id'          => 'l30',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );
   $data_40 = array(
              'name'        => 'l40',
              'id'          => 'l40',
              'value'       => 0,
              'type'        =>'number',
              'maxlength'   => '20',
              'size'        => '10'
  );            

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
$data_turno1_cajera = array(
              'name'        => 'turno1_cajera',
              'id'          => 'turno1_cajera',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
              
            );
$data_turno1_pesos = array(
              'name'        => 'turno1_pesos',
              'id'          => 'turno1_pesos',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno1_dolar = array(
              'name'        => 'turno1_dolar',
              'id'          => 'turno1_dolar',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno1_cambio = array(
              'name'        => 'turno1_cambio',
              'id'          => 'turno1_cambio',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_bbv = array(
              'name'        => 'turno1_bbv',
              'id'          => 'turno1_bbv',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_san = array(
              'name'        => 'turno1_san',
              'id'          => 'turno1_san',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_exp = array(
              'name'        => 'turno1_exp',
              'id'          => 'turno1_exp',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_asalto = array(
              'name'        => 'turno1_asalto',
              'id'          => 'turno1_asalto',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_vale = array(
              'name'        => 'turno1_vale',
              'id'          => 'turno1_vale',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_corte = array(
              'name'        => 'turno1_corte',
              'id'          => 'turno1_corte',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
            );
$data_turno2_cajera = array(
              'name'        => 'turno2_cajera',
              'id'          => 'turno2_cajera',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
              
            );
$data_turno2_pesos = array(
              'name'        => 'turno2_pesos',
              'id'          => 'turno2_pesos',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno2_dolar = array(
              'name'        => 'turno2_dolar',
              'id'          => 'turno2_dolar',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno2_cambio = array(
              'name'        => 'turno2_cambio',
              'id'          => 'turno2_cambio',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_bbv = array(
              'name'        => 'turno2_bbv',
              'id'          => 'turno2_bbv',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_san = array(
              'name'        => 'turno2_san',
              'id'          => 'turno2_san',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_exp = array(
              'name'        => 'turno2_exp',
              'id'          => 'turno2_exp',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_asalto = array(
              'name'        => 'turno2_asalto',
              'id'          => 'turno2_asalto',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_vale = array(
              'name'        => 'turno2_vale',
              'id'          => 'turno2_vale',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_corte = array(
              'name'        => 'turno2_corte',
              'id'          => 'turno2_corte',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
            );
$data_turno3_cajera = array(
              'name'        => 'turno3_cajera',
              'id'          => 'turno3_cajera',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
              
            );

$data_turno3_pesos = array(
              'name'        => 'turno3_pesos',
              'id'          => 'turno3_pesos',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno3_dolar = array(
              'name'        => 'turno3_dolar',
              'id'          => 'turno3_dolar',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno3_cambio = array(
              'name'        => 'turno3_cambio',
              'id'          => 'turno3_cambio',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_bbv = array(
              'name'        => 'turno3_bbv',
              'id'          => 'turno3_bbv',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_san = array(
              'name'        => 'turno3_san',
              'id'          => 'turno3_san',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_exp = array(
              'name'        => 'turno3_exp',
              'id'          => 'turno3_exp',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_asalto = array(
              'name'        => 'turno3_asalto',
              'id'          => 'turno3_asalto',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_vale = array(
              'name'        => 'turno3_vale',
              'id'          => 'turno3_vale',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_corte = array(
              'name'        => 'turno3_corte',
              'id'          => 'turno3_corte',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
            );
$data_turno4_cajera = array(
              'name'        => 'turno4_cajera',
              'id'          => 'turno4_cajera',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
              
            );

$data_turno4_pesos = array(
              'name'        => 'turno4_pesos',
              'id'          => 'turno4_pesos',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno4_dolar = array(
              'name'        => 'turno4_dolar',
              'id'          => 'turno4_dolar',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno4_cambio = array(
              'name'        => 'turno4_cambio',
              'id'          => 'turno4_cambio',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_bbv = array(
              'name'        => 'turno4_bbv',
              'id'          => 'turno4_bbv',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_san = array(
              'name'        => 'turno4_san',
              'id'          => 'turno4_san',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_exp = array(
              'name'        => 'turno4_exp',
              'id'          => 'turno4_exp',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_asalto = array(
              'name'        => 'turno4_asalto',
              'id'          => 'turno4_asalto',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_vale = array(
              'name'        => 'turno4_vale',
              'id'          => 'turno4_vale',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_corte = array(
              'name'        => 'turno4_corte',
              'id'          => 'turno4_corte',
              'value'       => 0,
              'maxlength'   => '13',
              'size'        => '10'
            );

//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
  ?>
<input type="hidden" value="<?php echo $recarga?>" name="recarga"  id="recarga" />

<div id="cortes" style="width: 600px; float: left;"> 
<table>
<tr>
<th colspan="4"><font size="+2" color="green"><strong><?php echo "F5 ACTUALIZA DATOS"?></strong></font></th>
</tr>
<tr>
<th colspan="4"><font size="+1"><?php echo $sucursal ."___";?> FECHA.: <?php echo $fechac;?></font></th>
</tr>
<tr>
    <th>LINEA</th>
	<th>TOTAL</th>
</tr>    
<tr>
    <td>001-PATENTE: </td>
	<td><?php echo form_input($data_1, "", 'required');?></td>
</tr>
<tr>
    <td>002-PERFUMERIA: </td>
	<td><?php echo form_input($data_2, "", 'required');?></td>
</tr>
<tr>
    <td>004-LECHES: </td>
	<td><?php echo form_input($data_4, "", 'required');?></td>
</tr>
<tr>
    <td>005-ACCESORIOS: </td>
	<td><?php echo form_input($data_5, "", 'required');?></td>
</tr>
<tr>
    <td>008-ABARROTES TASA 0: </td>
	<td><?php echo form_input($data_8, "", 'required');?></td>
</tr>
<tr>
    <td>009-ABARROTES GRABADOS: </td>
	<td><?php echo form_input($data_9, "", 'required');?></td>
</tr>
<tr>
    <td>010-PATENTE GONTOR: </td>
	<td><?php echo form_input($data_10, "", 'required');?></td>
</tr>
<tr>
    <td>011-PERFUMERIA GONTOR: </td>
	<td><?php echo form_input($data_11, "", 'required');?></td>
</tr>
<tr>
    <td>012-O.T.C: </td>
	<td><?php echo form_input($data_12, "", 'required');?></td>
</tr>
<tr>
    <td>013-PROM. PATENTE: </td>
	<td><?php echo form_input($data_13, "", 'required');?></td>
</tr>
<tr>
    <td>016-PATENTE IMPERIAL: </td>
	<td><?php echo form_input($data_16, "", 'required');?></td>
</tr>
<tr>
    <td>019-FOTPGRAFIA: </td>
	<td><?php echo form_input($data_19, "", 'required');?></td>
    <th align="center" colspan="2"><font size="1" color="white">TOT.CORTE <?php echo $vta?></font></th>
    <th align="center" colspan="3"><font size="1" color="white">TOT.LINEA <span id="suma0"></span></font></th>
</tr>
<tr>
    <td>020-RECARGA TIEMPO AIRE: </td>
	<td><?php echo form_input($data_20, "", 'required');?></td>
    <td align="left" colspan="2"><font size="+1" color="blue">TIEMPO AIRE</font></td>
    <td align="right" colspan="2"><font size="+1" color="blue"><?php echo $recarga?></font></td>
</tr>
<tr>
    <td>021-JUGOS Y REFRESCOS: </td>
	<td><?php echo form_input($data_21, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">Suma lineas</font></td>
    <td align="right"><font size="+2" color="maroon"><span id="suma1"></span></font></td>
</tr>
<tr>
    <td>022-HELADOS HOLANDA: </td>
	<td><?php echo form_input($data_22, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">Corte de Caja</font></td>
    <td align="right"><font size="+2" color="maroon"><span id="corte"></span></font></td>
</tr>
<tr>
    <td>023-DULCES Y BOTANAS: </td>
	<td><?php echo form_input($data_23, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">Entrega Cajera</font></td>
    <td align="right"><font size="+2" color="maroon"><span id="arqueo"></span></font></td>
</tr>
<tr>
    <td>024-PATENTE COMERCIAL: </td>
	<td><?php echo form_input($data_24, "", 'required');?></td>
</tr>
<tr>
    <td>030-VENTA CREDITO: </td>
	<td><?php echo form_input($data_30, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">CORTE vs LINEAS</font></td>
    <td align="right"><font size="+2" color="maroon" ><span id="dif"></span></font></td>
</tr>
<tr>
    <td>040-CREDITO PERSONAL: </td>
	<td><?php echo form_input($data_40, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="green">Iva Desglosado</font></td>
    <td align="right"><font size="+2" color="green"><span id="totiva"></span></font></td>
</tr>
</div>


<div id="control" style="width: 500px; float: left;">
<tr>
    <th></th>
    <th>TURNO 1</th>
    <th>TURNO 2</th>
    <th>TURNO 3</th>
    <th>TURNO 4</th>
</tr>
<tr>
    <td>000-NOMINA DE LA CAJERA: </td>
    <td><?php echo form_input($data_turno1_cajera, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_cajera, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_cajera, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_cajera, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>050-MONEDA NACIONAL: </td>
    <td><?php echo form_input($data_turno1_pesos, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_pesos, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_pesos, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_pesos, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>064-TARJETA BBV: </td>
    <td><?php echo form_input($data_turno1_bbv, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_bbv, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_bbv, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_bbv, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>066-TARJETA SANTANDER: </td>
    <td><?php echo form_input($data_turno1_san, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_san, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_san, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_san, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>062-TARJETA AMERICAN EXPRESS: </td>
    <td><?php echo form_input($data_turno1_exp, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_exp, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_exp, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_exp, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>000-VALES DE DESPENSA: </td>
    <td><?php echo form_input($data_turno1_vale, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_vale, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_vale, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_vale, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>080-DOLAR: </td>
    <td><?php echo form_input($data_turno1_dolar, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_dolar, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_dolar, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_dolar, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>081-TIPO DE CAMBIO: </td>
    <td><?php echo form_input($data_turno1_cambio, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_cambio, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_cambio, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_cambio, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>000-ASALTO: </td>
    <td><?php echo form_input($data_turno1_asalto, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_asalto, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_asalto, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_asalto, "", 'required');?><span id="mensaje"></span></td>
<tr>
<tr>
    <td><font color="red"><strong>091-TOTAL VENTAS (CORTE): </strong></font></td>
    <td><?php echo form_input($data_turno1_corte, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_corte, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_corte, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_corte, "", 'required');?><span id="mensaje"></span></td>
<tr>
<tr>
    <td>092-FALTANTE: </td>
    <td align="right"><font size="+2" color="red"><span id="fal1"></span></font></td>
    <td align="right"><font size="+2" color="red"><span id="fal2"></span></font></td>
    <td align="right"><font size="+2" color="red"><span id="fal3"></span></font></td>
    <td align="right"><font size="+2" color="red"><span id="fal4"></span></font></td>
    
<tr>
<tr>
    <td>093-SOBRANTE: </td>
    <td align="right"><font size="+2" color="green"><span id="sob1"></span></font></td>
    <td align="right"><font size="+2" color="green"><span id="sob2"></span></font></td>
    <td align="right"><font size="+2" color="green"><span id="sob3"></span></font></td>
    <td align="right"><font size="+2" color="green"><span id="sob4"></span></font></td>
<tr>
	<td colspan="5"align="center"><?php echo form_submit('envio', 'CORTE');?></td>
</tr>
</tr>
</table>
</div>





<input type="hidden" value="<?php echo $id_cc?>" name="id_cc"  id="id_cc" />
<input type="hidden" value="<?php echo $iva?>" name="iva"  id="iva" />

<input type="hidden" value="<?php echo $vta?>" name="vta"  id="vta" />
<input type="hidden" value="" name="suma0"  id="suma0" />

<input type="hidden" value="" name="turno1_corte_fin"  id="turno1_corte_fin" />
<input type="hidden" value="" name="turno2_corte_fin"  id="turno2_corte_fin" />
<input type="hidden" value="" name="turno3_corte_fin"  id="turno3_corte_fin" />
<input type="hidden" value="" name="turno4_corte_fin"  id="turno4_corte_fin" />
<input type="hidden" value="" name="l1_fin"  id="l1_fin" />
<input type="hidden" value="" name="l2_fin"  id="l2_fin" />
<input type="hidden" value="" name="l4_fin"  id="l4_fin" />
<input type="hidden" value="" name="l5_fin"  id="l5_fin" />
<input type="hidden" value="" name="l8_fin"  id="l8_fin" />
<input type="hidden" value="" name="l9_fin"  id="l9_fin" />
<input type="hidden" value="" name="l10_fin"  id="l10_fin" />
<input type="hidden" value="" name="l11_fin"  id="l11_fin" />
<input type="hidden" value="" name="l12_fin"  id="l12_fin" />
<input type="hidden" value="" name="l13_fin"  id="l13_fin" />
<input type="hidden" value="" name="l16_fin"  id="l16_fin" />
<input type="hidden" value="" name="l19_fin"  id="l19_fin" />
<input type="hidden" value="" name="l20_fin"  id="l20_fin" />
<input type="hidden" value="" name="l21_fin"  id="l21_fin" />
<input type="hidden" value="" name="l22_fin"  id="l22_fin" />
<input type="hidden" value="" name="l23_fin"  id="l23_fin" />
<input type="hidden" value="" name="l24_fin"  id="l24_fin" />
<input type="hidden" value="" name="l30_fin"  id="l30_fin" />
<input type="hidden" value="" name="l40_fin"  id="l40_fin" />

<input type="hidden" value="" name="l1_a"  id="l1_a" />
<input type="hidden" value="" name="l2_a"  id="l2_a" />
<input type="hidden" value="" name="l4_a"  id="l4_a" />
<input type="hidden" value="" name="l5_a"  id="l5_a" />
<input type="hidden" value="" name="l8_a"  id="l8_a" />
<input type="hidden" value="" name="l9_a"  id="l9_a" />
<input type="hidden" value="" name="l10_a"  id="l10_a" />
<input type="hidden" value="" name="l11_a"  id="l11_a" />
<input type="hidden" value="" name="l12_a"  id="l12_a" />
<input type="hidden" value="" name="l13_a"  id="l13_a" />
<input type="hidden" value="" name="l16_a"  id="l16_a" />
<input type="hidden" value="" name="l19_a"  id="l19_a" />
<input type="hidden" value="" name="l20_a"  id="l20_a" />
<input type="hidden" value="" name="l21_a"  id="l21_a" />
<input type="hidden" value="" name="l22_a"  id="l22_a" />
<input type="hidden" value="" name="l23_a"  id="l23_a" />
<input type="hidden" value="" name="l24_a"  id="l24_a" />
<input type="hidden" value="" name="l30_a"  id="l30_a" />
<input type="hidden" value="" name="l40_a"  id="l40_a" />

<input type="hidden" value="" name="l1_c"  id="l1_c" />
<input type="hidden" value="" name="l2_c"  id="l2_c" />
<input type="hidden" value="" name="l4_c"  id="l4_c" />
<input type="hidden" value="" name="l5_c"  id="l5_c" />
<input type="hidden" value="" name="l8_c"  id="l8_c" />
<input type="hidden" value="" name="l9_c"  id="l9_c" />
<input type="hidden" value="" name="l10_c"  id="l10_c" />
<input type="hidden" value="" name="l11_c"  id="l11_c" />
<input type="hidden" value="" name="l12_c"  id="l12_c" />
<input type="hidden" value="" name="l13_c"  id="l13_c" />
<input type="hidden" value="" name="l16_c"  id="l16_c" />
<input type="hidden" value="" name="l19_c"  id="l19_c" />
<input type="hidden" value="" name="l20_c"  id="l20_c" />
<input type="hidden" value="" name="l21_c"  id="l21_c" />
<input type="hidden" value="" name="l22_c"  id="l22_c" />
<input type="hidden" value="" name="l23_c"  id="l23_c" />
<input type="hidden" value="" name="l24_c"  id="l24_c" />
<input type="hidden" value="" name="l30_c"  id="l30_c" />
<input type="hidden" value="" name="l40_c"  id="l40_c" />

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#l1").focus();
    });
    $(document).ready(function(){
    suma1();
//////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
 $('input[name*="l"]').change(function(){
     var valor = $(this).attr('value');
     
     suma1();
     
     
   });
   ///**************************************************
    ///**************************************************
   function suma1()
     {
      var l1= $("#l1").attr('value');
       if(l1.indexOf("+")>0){var l1_x=l1.split("+"); var l1_fin = parseFloat(l1_x[0])+ parseFloat(l1_x[1]);var l1_a = parseFloat(l1_x[1]);}
       if(l1.indexOf("-")>0){var l1_x=l1.split("-"); var l1_fin = parseFloat(l1_x[0])- parseFloat(l1_x[1]);var l1_c = parseFloat(l1_x[1]);}
       if(l1.indexOf("+") <0 && l1.indexOf("-") < 0){var l1_fin=parseFloat(l1);} 
     
    
      var l2= $("#l2").attr('value');
       if(l2.indexOf("+")>0){var l2_x=l2.split("+"); var l2_fin = parseFloat(l2_x[0])+ parseFloat(l2_x[1]);var l2_a = parseFloat(l2_x[1]);}
       if(l2.indexOf("-")>0){var l2_x=l2.split("-"); var l2_fin = parseFloat(l2_x[0])- parseFloat(l2_x[1]);var l2_c = parseFloat(l2_x[1]);}
       if(l2.indexOf("+") <0 && l2.indexOf("-") < 0){var l2_fin = parseFloat(l2);} 
     
      var l4= $("#l4").attr('value');
       if(l4.indexOf("+")>0){var l4_x=l4.split("+"); var l4_fin = parseFloat(l4_x[0])+ parseFloat(l4_x[1]);var l4_a = parseFloat(l4_x[1]);}
       if(l4.indexOf("-")>0){var l4_x=l4.split("-"); var l4_fin = parseFloat(l4_x[0])- parseFloat(l4_x[1]);var l4_c = parseFloat(l4_x[1]);}
       if(l4.indexOf("+") <0 && l4.indexOf("-") < 0){var l4_fin = parseFloat(l4);} 
     
     
      var l5= $("#l5").attr('value');
       if(l5.indexOf("+")>0){var l5_x=l5.split("+"); var l5_fin = parseFloat(l5_x[0])+ parseFloat(l5_x[1]);var l5_a = parseFloat(l5_x[1]);}
       if(l5.indexOf("-")>0){var l5_x=l5.split("-"); var l5_fin = parseFloat(l5_x[0])- parseFloat(l5_x[1]);var l5_c = parseFloat(l5_x[1]);}
       if(l5.indexOf("+") <0 && l5.indexOf("-") < 0){var l5_fin=parseFloat(l5);}
     
      var l8= $("#l8").attr('value');
       if(l8.indexOf("+")>0){var l8_x=l8.split("+"); var l8_fin = parseFloat(l8_x[0])+ parseFloat(l8_x[1]);var l8_a = parseFloat(l8_x[1]);}
       if(l8.indexOf("-")>0){var l8_x=l8.split("-"); var l8_fin = parseFloat(l8_x[0])- parseFloat(l8_x[1]);var l8_c = parseFloat(l8_x[1]);}
       if(l8.indexOf("+") <0 && l8.indexOf("-") < 0){var l8_fin=parseFloat(l8);} 
     
       var l9= $("#l9").attr('value');
       if(l9.indexOf("+")>0){var l9_x=l9.split("+"); var l9_fin = parseFloat(l9_x[0])+ parseFloat(l9_x[1]);var l9_a = parseFloat(l9_x[1]);}
       if(l9.indexOf("-")>0){var l9_x=l9.split("-"); var l9_fin = parseFloat(l9_x[0])- parseFloat(l9_x[1]);var l9_c = parseFloat(l9_x[1]);}
       if(l9.indexOf("+") <0 && l9.indexOf("-") < 0){var l9_fin=parseFloat(l9);} 
     
      var l10= $("#l10").attr('value');
       if(l10.indexOf("+")>0){var l10_x=l10.split("+"); var l10_fin = parseFloat(l10_x[0])+ parseFloat(l10_x[1]);var l10_a = parseFloat(l10_x[1]);}
       if(l10.indexOf("-")>0){var l10_x=l10.split("-"); var l10_fin = parseFloat(l10_x[0])- parseFloat(l10_x[1]);var l10_c = parseFloat(l10_x[1]);}
       if(l10.indexOf("+") <0 && l10.indexOf("-") < 0){var l10_fin=parseFloat(l10);} 
      
      
      var l11= $("#l11").attr('value');
       if(l11.indexOf("+")>0){var l11_x=l11.split("+"); var l11_fin = parseFloat(l11_x[0])+ parseFloat(l11_x[1]);var l11_a = parseFloat(l11_x[1]);}
       if(l11.indexOf("-")>0){var l11_x=l11.split("-"); var l11_fin = parseFloat(l11_x[0])- parseFloat(l11_x[1]);var l11_c = parseFloat(l11_x[1]);}
       if(l11.indexOf("+") <0 && l11.indexOf("-") < 0){var l11_fin=parseFloat(l11);} 
      
      var l12= $("#l12").attr('value');
       if(l12.indexOf("+")>0){var l12_x=l12.split("+"); var l12_fin = parseFloat(l12_x[0])+ parseFloat(l12_x[1]);var l12_a = parseFloat(l12_x[1]);}
       if(l12.indexOf("-")>0){var l12_x=l12.split("-"); var l12_fin = parseFloat(l12_x[0])- parseFloat(l12_x[1]);var l12_c = parseFloat(l12_x[1]);}
       if(l12.indexOf("+") <0 && l12.indexOf("-") < 0){var l12_fin=parseFloat(l12);} 
      
      var l13= $("#l13").attr('value');
       if(l13.indexOf("+")>0){var l13_x=l13.split("+"); var l13_fin = parseFloat(l13_x[0])+ parseFloat(l13_x[1]);var l13_a = parseFloat(l13_x[1]);}
       if(l13.indexOf("-")>0){var l13_x=l13.split("-"); var l13_fin = parseFloat(l13_x[0])- parseFloat(l13_x[1]);var l13_c = parseFloat(l13_x[1]);}
       if(l13.indexOf("+") <0 && l13.indexOf("-") < 0){var l13_fin=parseFloat(l13);} 
      
      var l16= $("#l16").attr('value');
       if(l16.indexOf("+")>0){var l16_x=l16.split("+"); var l16_fin = parseFloat(l16_x[0])+ parseFloat(l16_x[1]);var l16_a = parseFloat(l16_x[1]);}
       if(l16.indexOf("-")>0){var l16_x=l16.split("-"); var l16_fin = parseFloat(l16_x[0])- parseFloat(l16_x[1]);var l16_c = parseFloat(l16_x[1]);}
       if(l16.indexOf("+") <0 && l16.indexOf("-") < 0){var l16_fin=parseFloat(l16);} 
      
      var l19= $("#l19").attr('value');
       if(l19.indexOf("+")>0){var l19_x=l19.split("+"); var l19_fin = parseFloat(l19_x[0])+ parseFloat(l19_x[1]);var l19_a = parseFloat(l19_x[1]);}
       if(l19.indexOf("-")>0){var l19_x=l19.split("-"); var l19_fin = parseFloat(l19_x[0])- parseFloat(l19_x[1]);var l19_c = parseFloat(l19_x[1]);}
       if(l19.indexOf("+") <0 && l19.indexOf("-") < 0){var l19_fin=parseFloat(l19);} 
        
      var l20= $("#l20").attr('value');
       if(l20.indexOf("+")>0){var l20_x=l20.split("+");var l20_fin = parseFloat(l20_x[0]) + parseFloat(l20_x[1]);var l20_a = parseFloat(l20_x[1]);}
       if(l20.indexOf("-")>0){var l20_x=l20.split("-");var l20_fin = parseFloat(l20_x[0]) - parseFloat(l20_x[1]);var l20_c = parseFloat(l20_x[1]);}
       if(l20.indexOf("+") <0 && l20.indexOf("-") < 0){var l20_fin=parseFloat(l20);}
     
      var l21= $("#l21").attr('value');
       if(l21.indexOf("+")>0){var l21_x=l21.split("+");var l21_fin = parseFloat(l21_x[0]) + parseFloat(l21_x[1]);var l21_a = parseFloat(l21_x[1]);}
       if(l21.indexOf("-")>0){var l21_x=l21.split("-");var l21_fin = parseFloat(l21_x[0]) - parseFloat(l21_x[1]);var l21_c = parseFloat(l21_x[1]);}
       if(l21.indexOf("+") <0 && l21.indexOf("-") < 0){var l21_fin=parseFloat(l21);}
    
      var l22= $("#l22").attr('value');
       if(l22.indexOf("+")>0){var l22_x=l22.split("+");var l22_fin = parseFloat(l22_x[0]) + parseFloat(l22_x[1]);var l22_a = parseFloat(l22_x[1]);}
       if(l22.indexOf("-")>0){var l22_x=l22.split("-");var l22_fin = parseFloat(l22_x[0]) - parseFloat(l22_x[1]);var l22_c = parseFloat(l22_x[1]);}
       if(l22.indexOf("+") <0 && l22.indexOf("-") < 0){var l22_fin=parseFloat(l22);}
    
      var l23= $("#l23").attr('value');
       if(l23.indexOf("+")>0){var l23_x=l23.split("+");var l23_fin = parseFloat(l23_x[0]) + parseFloat(l23_x[1]);var l23_a = parseFloat(l23_x[1]);}
       if(l23.indexOf("-")>0){var l23_x=l23.split("-");var l23_fin = parseFloat(l23_x[0]) - parseFloat(l23_x[1]);var l23_c = parseFloat(l23_x[1]);}
       if(l23.indexOf("+") <0 && l23.indexOf("-") < 0){var l23_fin=parseFloat(l23);}
 
       var l24= $("#l24").attr('value');
       if(l24.indexOf("+")>0){var l24_x=l24.split("+");var l24_fin = parseFloat(l24_x[0]) + parseFloat(l24_x[1]);var l24_a = parseFloat(l24_x[1]);}
       if(l24.indexOf("-")>0){var l24_x=l24.split("-");var l24_fin = parseFloat(l24_x[0]) - parseFloat(l24_x[1]);var l24_c = parseFloat(l24_x[1]);}
       if(l24.indexOf("+") <0 && l24.indexOf("-") < 0){var l24_fin=parseFloat(l24);}
      
        var l30= $("#l30").attr('value');
       if(l30.indexOf("+")>0){var l30_x=l30.split("+");var l30_fin = parseFloat(l30_x[0]) + parseFloat(l30_x[1]);var l30_a = parseFloat(l30_x[1]);}
       if(l30.indexOf("-")>0){var l30_x=l30.split("-");var l30_fin = parseFloat(l30_x[0]) - parseFloat(l30_x[1]);var l30_c = parseFloat(l30_x[1]);}
       if(l30.indexOf("+") <0 && l30.indexOf("-") < 0){var l30_fin=parseFloat(l30);}  
      
     var l40= $("#l40").attr('value');
       if(l40.indexOf("+")>0){var l40_x=l40.split("+");var l40_fin = parseFloat(l40_x[0]) + parseFloat(l40_x[1]);var l40_a = parseFloat(l40_x[1]);}
       if(l40.indexOf("-")>0){var l40_x=l40.split("-");var l40_fin = parseFloat(l40_x[0]) - parseFloat(l40_x[1]);var l40_c= parseFloat(l40_x[1]);}
       if(l40.indexOf("+") <0 && l40.indexOf("-") < 0){var l40_fin=parseFloat(l40);}  
      
        
       
	  var turno1_corte= $("#turno1_corte").attr('value');
       if(turno1_corte.indexOf("+")>0){var corte1=turno1_corte.split("+");var turno1_corte_fin = parseFloat(corte1[0])+ parseFloat(corte1[1]);}
       if(turno1_corte.indexOf("-")>0){var corte1=turno1_corte.split("-");var turno1_corte_fin = parseFloat(corte1[0])- parseFloat(corte1[1]);}
       
       
      var turno2_corte= $("#turno2_corte").attr('value');
       if(turno2_corte.indexOf("+")>0){var corte2=turno2_corte.split("+");var turno2_corte_fin = parseFloat(corte2[0])+ parseFloat(corte2[1]);}
       if(turno2_corte.indexOf("-")>0){var corte2=turno2_corte.split("-");var turno2_corte_fin = parseFloat(corte2[0])- parseFloat(corte2[1]);}
       
        
      var turno3_corte= $("#turno3_corte").attr('value');
       if(turno3_corte.indexOf("+")>0){var corte3=turno3_corte.split("+");var turno3_corte_fin = parseFloat(corte3[0])+ parseFloat(corte3[1]);}
       if(turno3_corte.indexOf("-")>0){var corte3=turno3_corte.split("-");var turno3_corte_fin = parseFloat(corte3[0])- parseFloat(corte3[1]);}
       
       
      var turno4_corte= $("#turno4_corte").attr('value');
       if(turno4_corte.indexOf("+")>0){var corte4=turno4_corte.split("+");var turno4_corte_fin = parseFloat(corte4[0])+ parseFloat(corte4[1]);}
       if(turno4_corte.indexOf("-")>0){var corte4=turno4_corte.split("-");var turno4_corte_fin = parseFloat(corte4[0])- parseFloat(corte4[1]);}
      
       if(isNaN(turno1_corte_fin)){turno1_corte_fin=turno1_corte;}
       if(isNaN(turno2_corte_fin)){turno2_corte_fin=turno2_corte;}
       if(isNaN(turno3_corte_fin)){turno3_corte_fin=turno3_corte;}
       if(isNaN(turno4_corte_fin)){turno4_corte_fin=turno4_corte;}
       if(isNaN(l20_fin)){l20_fin=l20;}
 
        

     	var turno1_pesos= parseFloat($("#turno1_pesos").attr('value'));
        var turno1_dolar= parseFloat($("#turno1_dolar").attr('value'));
        var turno1_cambio=parseFloat($("#turno1_cambio").attr('value'));
        var turno1_bbv=   parseFloat($("#turno1_bbv").attr('value'));
        var turno1_exp=   parseFloat($("#turno1_exp").attr('value'));
        var turno1_san=   parseFloat($("#turno1_san").attr('value'));
        var turno1_vale=  parseFloat($("#turno1_vale").attr('value'));
        var turno1_asalto=parseFloat($("#turno1_asalto").attr('value'));
        
        
        
        var turno2_pesos= parseFloat($("#turno2_pesos").attr('value'));
        var turno2_dolar= parseFloat($("#turno2_dolar").attr('value'));
        var turno2_cambio=parseFloat($("#turno2_cambio").attr('value'));
        var turno2_bbv=   parseFloat($("#turno2_bbv").attr('value'));
        var turno2_san=   parseFloat($("#turno2_san").attr('value'));
        var turno2_exp=   parseFloat($("#turno2_exp").attr('value'));
        var turno2_vale=  parseFloat($("#turno2_vale").attr('value'));
        var turno2_asalto=parseFloat($("#turno2_asalto").attr('value'));
        
        
        var turno3_pesos= parseFloat($("#turno3_pesos").attr('value'));
        var turno3_dolar= parseFloat($("#turno3_dolar").attr('value'));
        var turno3_cambio=parseFloat($("#turno3_cambio").attr('value'));
        var turno3_bbv=   parseFloat($("#turno3_bbv").attr('value'));
        var turno3_san=   parseFloat($("#turno3_san").attr('value'));
        var turno3_exp=   parseFloat($("#turno3_exp").attr('value'));
        var turno3_vale=  parseFloat($("#turno3_vale").attr('value'));
        var turno3_asalto=parseFloat($("#turno3_asalto").attr('value'));
        
        
        var turno4_pesos= parseFloat($("#turno4_pesos").attr('value'));
        var turno4_dolar= parseFloat($("#turno4_dolar").attr('value'));
        var turno4_cambio=parseFloat($("#turno4_cambio").attr('value'));
        var turno4_bbv=   parseFloat($("#turno4_bbv").attr('value'));
        var turno4_san=   parseFloat($("#turno4_san").attr('value'));
        var turno4_exp=   parseFloat($("#turno4_exp").attr('value'));
        var turno4_vale=  parseFloat($("#turno4_vale").attr('value'));
        var turno4_asalto=parseFloat($("#turno4_asalto").attr('value'));
        
        
        
        if(isNaN(l1_fin)){l1_fin=0;}
        if(isNaN(l2_fin)){l2_fin=0;}
        if(isNaN(l4_fin)){l4_fin=0;}
        if(isNaN(l5_fin)){l5_fin=0;}
        if(isNaN(l8_fin)){l8_fin=0;}
        if(isNaN(l9_fin)){l9_fin=0;}
        if(isNaN(l10_fin)){l10_fin=0;}
        if(isNaN(l11_fin)){l11_fin=0;}
        if(isNaN(l12_fin)){l12_fin=0;}
        if(isNaN(l13_fin)){l13_fin=0;}
        if(isNaN(l16_fin)){l16_fin=0;}
        if(isNaN(l19_fin)){l19_fin=0;}
        if(isNaN(l20_fin)){l20_fin=0;}
        if(isNaN(l21_fin)){l21_fin=0;}
        if(isNaN(l22_fin)){l22_fin=0;}
        if(isNaN(l23_fin)){l23_fin=0;}
        if(isNaN(l24_fin)){l24_fin=0;}
        if(isNaN(l30_fin)){l30_fin=0;}
        if(isNaN(l40_fin)){l40_fin=0;}
        
         if(isNaN(l1_c)){l1_c=0;}
         if(isNaN(l2_c)){l2_c=0;}
         if(isNaN(l4_c)){l4_c=0;}
         if(isNaN(l5_c)){l5_c=0;}
         if(isNaN(l8_c)){l8_c=0;}
         if(isNaN(l9_c)){l9_c=0;}
         if(isNaN(l10_c)){l10_c=0;}
         if(isNaN(l11_c)){l11_c=0;}
         if(isNaN(l12_c)){l12_c=0;}
         if(isNaN(l13_c)){l13_c=0;}
         if(isNaN(l16_c)){l16_c=0;}
         if(isNaN(l19_c)){l19_c=0;}
         if(isNaN(l20_c)){l20_c=0;}
         if(isNaN(l21_c)){l21_c=0;}
         if(isNaN(l22_c)){l22_c=0;}
         if(isNaN(l23_c)){l23_c=0;}
         if(isNaN(l24_c)){l24_c=0;}
         if(isNaN(l30_c)){l30_c=0;}
         if(isNaN(l40_c)){l40_c=0;}
         
         if(isNaN(l1_a)){l1_a=0;}
         if(isNaN(l2_a)){l2_a=0;}
         if(isNaN(l4_a)){l4_a=0;}
         if(isNaN(l5_a)){l5_a=0;}
         if(isNaN(l8_a)){l8_a=0;}
         if(isNaN(l9_a)){l9_a=0;}
         if(isNaN(l10_a)){l10_a=0;}
         if(isNaN(l11_a)){l11_a=0;}
         if(isNaN(l12_a)){l12_a=0;}
         if(isNaN(l13_a)){l13_a=0;}
         if(isNaN(l16_a)){l16_a=0;}
         if(isNaN(l19_a)){l19_a=0;}
         if(isNaN(l20_a)){l20_a=0;}
         if(isNaN(l21_a)){l21_a=0;}
         if(isNaN(l22_a)){l22_a=0;}
         if(isNaN(l23_a)){l23_a=0;}
         if(isNaN(l24_a)){l24_a=0;}
         if(isNaN(l30_a)){l30_a=0;}
         if(isNaN(l40_a)){l40_a=0;}
         
 
        if(isNaN(turno1_pesos)){turno1_pesos=0;}
        if(isNaN(turno1_dolar)){turno1_dolar=0;}
        if(isNaN(turno1_cambio)){turno1_cambio=0;}
        if(isNaN(turno1_bbv)){turno1_bbv=0;}
        if(isNaN(turno1_san)){turno1_san=0;}
        if(isNaN(turno1_exp)){turno1_exp=0;}
        if(isNaN(turno1_vale)){turno1_vale=0;}
        if(isNaN(turno1_asalto)){turno1_asalto=0;}
        if(isNaN(turno1_corte_fin)){turno1_corte_fin=0;}
        
        if(isNaN(turno2_pesos)){turno2_pesos=0;}
        if(isNaN(turno2_dolar)){turno2_dolar=0;}
        if(isNaN(turno2_cambio)){turno2_cambio=0;}
        if(isNaN(turno2_bbv)){turno2_bbv=0;}
        if(isNaN(turno2_san)){turno2_san=0;}
        if(isNaN(turno2_exp)){turno2_exp=0;}
        if(isNaN(turno2_vale)){turno2_vale=0;}
        if(isNaN(turno2_asalto)){turno2_asalto=0;}
        if(isNaN(turno2_corte_fin)){turno2_corte_fin=0;}
        
        if(isNaN(turno3_pesos)){turno3_pesos=0;}
        if(isNaN(turno3_dolar)){turno3_dolar=0;}
        if(isNaN(turno3_cambio)){turno3_cambio=0;}
        if(isNaN(turno3_bbv)){turno3_bbv=0;}
        if(isNaN(turno3_san)){turno3_san=0;}
        if(isNaN(turno3_exp)){turno3_exp=0;}
        if(isNaN(turno3_vale)){turno3_vale=0;}
        if(isNaN(turno3_asalto)){turno3_asalto=0;}
        if(isNaN(turno3_corte_fin)){turno3_corte_fin=0;}
        
        if(isNaN(turno4_pesos)){turno4_pesos=0;}
        if(isNaN(turno4_dolar)){turno4_dolar=0;}
        if(isNaN(turno4_cambio)){turno4_cambio=0;}
        if(isNaN(turno4_bbv)){turno4_bbv=0;}
        if(isNaN(turno4_san)){turno4_san=0;}
        if(isNaN(turno4_exp)){turno4_exp=0;}
        if(isNaN(turno4_vale)){turno4_vale=0;}
        if(isNaN(turno4_asalto)){turno4_asalto=0;}
        if(isNaN(turno4_corte_fin)){turno4_corte_fin=0;}  
      
      
       

 
        var suma1 = l1_fin+l2_fin+l4_fin+l5_fin+l8_fin+l9_fin+l10_fin+l11_fin+l12_fin+l13_fin+l16_fin+l19_fin+l20_fin+l21_fin+l22_fin+l23_fin+l24_fin;

        var suma0 = l1_fin+l2_fin+l4_fin+l5_fin+l8_fin+l9_fin+l10_fin+l11_fin+l12_fin+l13_fin+l16_fin+l19_fin+l20_fin+l21_fin+l22_fin+l23_fin+l24_fin+l30_fin+l40_fin;
     
        var mn1 = turno1_dolar*turno1_cambio;
        var mn2 = turno2_dolar*turno2_cambio;
        var mn3 = turno3_dolar*turno3_cambio;
        var mn4 = turno4_dolar*turno4_cambio;
        mn1=Math.round(mn1*100)/100; 
        mn2=Math.round(mn2*100)/100;
        mn3=Math.round(mn3*100)/100;
        mn4=Math.round(mn4*100)/100;
		var arqueo = turno1_pesos+turno1_bbv+turno1_san+turno1_exp+turno1_vale+turno1_asalto+mn1+
                     turno2_pesos+turno2_bbv+turno2_san+turno2_exp+turno2_vale+turno2_asalto+mn2+
                     turno3_pesos+turno3_bbv+turno3_san+turno3_exp+turno3_vale+turno3_asalto+mn3+
                     turno4_pesos+turno4_bbv+turno4_san+turno4_exp+turno4_vale+turno4_asalto+mn4;
       var arqueo1 = turno1_pesos+turno1_bbv+turno1_san+turno1_exp+turno1_vale+turno1_asalto+mn1;
       var arqueo2 = turno2_pesos+turno2_bbv+turno2_san+turno2_exp+turno2_vale+turno2_asalto+mn2;
       var arqueo3 = turno3_pesos+turno3_bbv+turno3_san+turno3_exp+turno3_vale+turno3_asalto+mn3;
       var arqueo4 = turno4_pesos+turno4_bbv+turno4_san+turno4_exp+turno4_vale+turno4_asalto+mn4;
       var corte  = parseFloat(turno1_corte_fin) + parseFloat(turno2_corte_fin) +  parseFloat(turno3_corte_fin) + parseFloat(turno4_corte_fin);
       
      
       
        if (arqueo1>turno1_corte_fin){var sob1 = arqueo1 - turno1_corte_fin; var fal1=0;}else{var fal1= turno1_corte_fin - arqueo1;var sob1=0;}
        if (arqueo2>turno2_corte_fin){var sob2 = arqueo2 - turno2_corte_fin; var fal2=0;}else{var fal2= turno2_corte_fin - arqueo2;var sob2=0;}
        if (arqueo3>turno3_corte_fin){var sob3 = arqueo3 - turno3_corte_fin; var fal3=0;}else{var fal3= turno3_corte_fin - arqueo3;var sob3=0;}
        if (arqueo4>turno4_corte_fin){var sob4 = arqueo4 - turno4_corte_fin; var fal4=0;}else{var fal4= turno4_corte_fin - arqueo4;var sob4=0;}
        
        var iva = $('#iva').attr("value");
        var subtotal = l2_fin+l5_fin+l9_fin+l19_fin+l11_fin+l20_fin+l21_fin;
        var totiva = subtotal-(subtotal/iva);
        
        
        corte=Math.round(corte*100)/100  //returns 28.45
        suma1=Math.round(suma1*100)/100  //returns 28.45
        suma0=Math.round(suma0*100)/100  //returns 28.45
        
        totiva=totiva
        fal1=Math.round(fal1*100)/100 
        fal2=Math.round(fal2*100)/100 
        fal3=Math.round(fal3*100)/100
        fal4=Math.round(fal4*100)/100 
        
        sob1=Math.round(sob1*100)/100
        sob2=Math.round(sob2*100)/100
        sob3=Math.round(sob3*100)/100
        sob4=Math.round(sob4*100)/100
        l20_fin=Math.round(l20_fin*100)/100 
       
        var dif=corte-suma1;
        
       $("#turno1_corte_fin").val(turno1_corte_fin);
       $("#turno2_corte_fin").val(turno2_corte_fin);
       $("#turno3_corte_fin").val(turno3_corte_fin);
       $("#turno4_corte_fin").val(turno4_corte_fin);
       $("#l1_fin").val(l1_fin);
       $("#l2_fin").val(l2_fin);
       $("#l4_fin").val(l4_fin);
       $("#l5_fin").val(l5_fin);
       $("#l8_fin").val(l8_fin);
       $("#l9_fin").val(l9_fin);
       $("#l10_fin").val(l10_fin);
       $("#l11_fin").val(l11_fin);
       $("#l12_fin").val(l12_fin);
       $("#l13_fin").val(l13_fin);
       $("#l16_fin").val(l16_fin);
       $("#l19_fin").val(l19_fin);
       $("#l20_fin").val(l20_fin);
       $("#l21_fin").val(l21_fin);
       $("#l22_fin").val(l22_fin);
       $("#l23_fin").val(l23_fin);
       $("#l24_fin").val(l24_fin);
       $("#l30_fin").val(l30_fin);
       $("#l40_fin").val(l40_fin);
       
       $("#l1_c").val(l1_c);
       $("#l2_c").val(l2_c);
       $("#l4_c").val(l4_c);
       $("#l5_c").val(l5_c);
       $("#l8_c").val(l8_c);
       $("#l9_c").val(l9_c);
       $("#l10_c").val(l10_c);
       $("#l11_c").val(l11_c);
       $("#l12_c").val(l12_c);
       $("#l13_c").val(l13_c);
       $("#l16_c").val(l16_c);
       $("#l19_c").val(l19_c);
       $("#l20_c").val(l20_c);
       $("#l21_c").val(l21_c);
       $("#l22_c").val(l22_c);
       $("#l23_c").val(l23_c);
       $("#l24_c").val(l24_c);
       $("#l30_c").val(l30_c);
       $("#l40_c").val(l40_c);
       
       $("#l1_a").val(l1_a);
       $("#l2_a").val(l2_a);
       $("#l4_a").val(l4_a);
       $("#l5_a").val(l5_a);
       $("#l8_a").val(l8_a);
       $("#l9_a").val(l9_a);
       $("#l10_a").val(l10_a);
       $("#l11_a").val(l11_a);
       $("#l12_a").val(l12_a);
       $("#l13_a").val(l13_a);
       $("#l16_a").val(l16_a);
       $("#l19_a").val(l19_a);
       $("#l20_a").val(l20_a);
       $("#l21_a").val(l21_a);
       $("#l22_a").val(l22_a);
       $("#l23_a").val(l23_a);
       $("#l24_a").val(l24_a);
       $("#l30_a").val(l30_a);
       $("#l40_a").val(l40_a);
       
      
             
        $("#subtotal").html(subtotal);
        $("#suma1").html(suma1);
        $("#suma0").html(suma0);
        
        $("#totiva").html(totiva);
        $("#arqueo").html(arqueo);
 
        $("#fal1").html(fal1);
        $("#sob1").html(sob1); 
        $("#fal2").html(fal2);
        $("#sob2").html(sob2);
        $("#fal3").html(fal3);
        $("#sob3").html(sob3);
        $("#fal4").html(fal4);
        $("#sob4").html(sob4);
        $("#corte").html(corte);
        $("#dif").html(dif);
        
        var recarga = $('#recarga').attr("value");
         var vta = $('#vta').attr("value");
        
        if(isNaN(recarga)){recarga=0;}
        if(isNaN(vta)){vta=0;}   

        $("#recarga").html(recarga);
        $("#vta").html(vta);

        $("#l20_fin").html(l20_fin);
        
     }
   ///**************************************************  
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
function envio_l(){

      var l20= $("#l20").attr('value');
       if(l20.indexOf("+")>0){var l20_x=l20.split("+");var l20_fin = parseFloat(l20_x[0]) + parseFloat(l20_x[1]);}
       if(l20.indexOf("-")>0){var l20_x=l20.split("-");var l20_fin = parseFloat(l20_x[0]) - parseFloat(l20_x[1]);}
       if(l20.indexOf("+") <0  && l20.indexOf("-" < 0)){var l20_fin=parseFloat(l20);}
       return l20_fin;
}
///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#cortes_form_1').submit(function() {
         var l30= $("#l30").attr('value');
    
        suma1=parseFloat($("#suma1").html());
        corte=parseFloat($("#corte").html());
        recarga= parseFloat($("#recarga").html());
        suma0=parseFloat($("#suma0").html());
        vta=parseFloat($("#vta").html());
         if(isNaN(recarga)){recarga=0;}  
  
       if(suma1 == corte && envio_l() >= recarga ){
       if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }	    
    	    
    	  }else{

    	    alert('VERIFIQUE LA CAPTURA, NO CUADRA EL CORTE');
    	    
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>