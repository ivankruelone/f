  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'supervisor_form_corte_det');
    echo form_open('supervisor/corte_dia/'.$suc.'/'.$fec, $atributos);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

  ?>
<input type="hidden" value="<?php echo $recarga?>" name="recarga"  id="recarga" />
<input type="hidden" value="<?php echo $fec?>" name="fec"  id="fec" />
<input type="hidden" value="<?php echo $suc?>" name="suc"  id="suc" />

<div id="cortes" style="width: 600px; float: left;"> 
<table>
<tr>
<th colspan="4"><font size="+1"><?php echo $sucursal ."___";?> FECHA.: <?php echo $fechac;?></font></th>
</tr>
<tr>
    <th>LINEA</th>
	<th>VENTA</th>
    <th>CANCELA</th>
    <th>AUMENTA</th>
</tr>    
<tr>
    <td>001-PATENTE: </td>
	<td align="right"><?php echo $venta1?></td>
    <td align="right"><?php echo $cancel1?></td>
    <td align="right"><?php echo $aumento1?></td>
</tr>
<tr>
    <td>002-PERFUMERIA: </td>
	<td align="right"><?php echo $venta2?></td>
    <td align="right"><?php echo $cancel2?></td>
    <td align="right"><?php echo $aumento2?></td>
</tr>

<tr>
    <td>004-LECHES: </td>
	<td align="right"><?php echo $venta4?></td>
    <td align="right"><?php echo $cancel4?></td>
    <td align="right"><?php echo $aumento4?></td>
</tr>
<tr>
    <td>005-ACCESORIOS: </td>
	<td align="right"><?php echo $venta5?></td>
    <td align="right"><?php echo $cancel5?></td>
    <td align="right"><?php echo $aumento5?></td>
</tr>

<tr>
    <td>008-ABARROTES TASA 0: </td>
	<td align="right"><?php echo $venta8?></td>
    <td align="right"><?php echo $cancel8?></td>
    <td align="right"><?php echo $aumento8?></td>
</tr>
<tr>
    <td>009-ABARROTES GRABADOS: </td>
	<td align="right"><?php echo $venta9?></td>
    <td align="right"><?php echo $cancel9?></td>
    <td align="right"><?php echo $aumento9?></td>
</tr>
<tr>
    <td>010-PATENTE GONTOR: </td>
	<td align="right"><?php echo $venta10?></td>
    <td align="right"><?php echo $cancel10?></td>
    <td align="right"><?php echo $aumento10?></td>
</tr>
<tr>
    <td>011-PERFUMERIA GONTOR: </td>
	<td align="right"><?php echo $venta11?></td>
    <td align="right"><?php echo $cancel11?></td>
    <td align="right"><?php echo $aumento11?></td>
</tr>
<tr>
    <td>012-O.T.C: </td>
	<td align="right"><?php echo $venta12?></td>
    <td align="right"><?php echo $cancel12?></td>
    <td align="right"><?php echo $aumento12?></td>
</tr>
<tr>
    <td>013-PROM. PATENTE: </td>
	<td align="right"><?php echo $venta13?></td>
    <td align="right"><?php echo $cancel13?></td>
    <td align="right"><?php echo $aumento13?></td>
</tr>
<tr>
    <td>016-PATENTE IMPERIAL: </td>
	<td align="right"><?php echo $venta16?></td>
    <td align="right"><?php echo $cancel16?></td>
    <td align="right"><?php echo $aumento16?></td>
</tr>
<tr>
    <td>019-FOTOGRAFIA: </td>
	<td align="right"><?php echo $venta19?></td>
    <td align="right"><?php echo $cancel19?></td>
    <td align="right"><?php echo $aumento19?></td>
    
</tr>
<tr>
    <td>020-RECARGA TIEMPO AIRE: </td>
	<td align="right"><?php echo $venta20?></td>
    <td align="right"><?php echo $cancel20?></td>
    <td align="right"><?php echo $aumento20?></td>
    <th align="left" colspan="2"><font size="+1" color="white">TIEMPO AIRE</font></th>
    <th align="right" colspan="2"><font size="+1" color="white"><?php echo $recarga?></font></th>
</tr>
<tr>
    <td>021-JUGOS Y REFRESCOS: </td>
	<td align="right"><?php echo $venta21?></td>
    <td align="right"><?php echo $cancel21?></td>
    <td align="right"><?php echo $aumento21?></td>
</tr>
<tr>
    <td>022-HELADOS HOLANDA: </td>
	<td align="right"><?php echo $venta22?></td>
    <td align="right"><?php echo $cancel22?></td>
    <td align="right"><?php echo $aumento22?></td>
</tr>
<tr>
    <td>023-DULCES Y BOTANAS: </td>
	<td align="right"><?php echo $venta23?></td>
    <td align="right"><?php echo $cancel23?></td>
    <td align="right"><?php echo $aumento23?></td>
</tr>
<tr>
    <td>024-PATENTE COMERCIAL: </td>
	<td align="right"><?php echo $venta24?></td>
    <td align="right"><?php echo $cancel24?></td>
    <td align="right"><?php echo $aumento24?></td>
</tr>
<tr>
    <td>030-VENTA CREDITO: </td>
	<td align="right"><?php echo $venta30?></td>
    <td align="right"><?php echo $cancel30?></td>
    <td align="right"><?php echo $aumento30?></td>
</tr>
<tr>
    <td>040-CREDITO PERSONAL: </td>
	<td align="right"><?php echo $venta40?></td>
    <td align="right"><?php echo $cancel40?></td>
    <td align="right"><?php echo $aumento40?></td>
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
    <td>000-CAJERA: </td>
    <td align="right"><?php echo $turno1_cajera?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_cajera?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_cajera?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_cajera?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>050-MONEDA NACIONAL: </td>
    <td align="right"><?php echo $turno1_pesos?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_pesos?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_pesos?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_pesos?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>064-TARJETA BBV: </td>
    <td align="right"><?php echo $turno1_bbv?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_bbv?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_bbv?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_bbv?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>066-TARJETA SANTANDER: </td>
    <td align="right"><?php echo $turno1_san?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_san?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_san?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_san?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>062-TARJETA AMERICAN EXPRESS: </td>
    <td align="right"><?php echo $turno1_exp?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_exp?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_exp?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_exp?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>000-VALES DE DESPENSA: </td>
    <td align="right"><?php echo $turno1_vale?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_vale?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_vale?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_vale?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>080-DOLAR: </td>
    <td align="right"><?php echo $turno1_dolar?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_dolar?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_dolar?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_dolar?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>081-TIPO DE CAMBIO: </td>
    <td align="right"><?php echo $turno1_cambio?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_cambio?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_cambio?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_cambio?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>000-ASALTO: </td>
    <td align="right"><?php echo $turno1_asalto?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_asalto?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_asalto?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_asalto?><span id="mensaje"></span></td>
<tr>
<tr>
    <td>091-TOTAL VENTAS (CORTE): </td>
    <td align="right"><?php echo $turno1_corte?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno2_corte?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno3_corte?><span id="mensaje"></span></td>
    <td align="right"><?php echo $turno4_corte?><span id="mensaje"></span></td>
<tr>
<tr>
    <td>092-FALTANTE: </td>
    <td align="right"><font size="+2" color="red"><?php echo $fal1?></font></td>
    <td align="right"><font size="+2" color="red"><?php echo $fal2?></font></td>
    <td align="right"><font size="+2" color="red"><?php echo $fal3?></span></font></td>
    <td align="right"><font size="+2" color="red"><?php echo $fal4?></span></font></td>
    
<tr>
<tr>
    <td>093-SOBRANTE: </td>
    <td align="right"><font size="+2" color="green"><?php echo $sob1?></font></td>
    <td align="right"><font size="+2" color="green"><?php echo $sob2?></font></td>
    <td align="right"><font size="+2" color="green"><?php echo $sob3?></font></td>
    <td align="right"><font size="+2" color="green"><?php echo $sob4?></font></td>
<tr>
	<td colspan="5"align="center"><?php echo form_submit('envio', 'salir');?></td>
</tr>
</tr>
</table>
</div>






<input type="hidden" value="<?php echo $fec?>" name="fec"  id="fec" />
<input type="hidden" value="<?php echo $suc?>" name="suc"  id="suc" />
<input type="hidden" value="<?php echo $iva?>" name="iva"  id="iva" />

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
   function suma1()
     {
	
         
        var l1=parseFloat($("#l1").attr('value'));
        var l2=parseFloat($("#l2").attr('value'));
        var l4=parseFloat($("#l4").attr('value'));
        var l5=parseFloat($("#l5").attr('value'));
        var l8=parseFloat($("#l8").attr('value'));
        var l9=parseFloat($("#l9").attr('value'));
        var l10=parseFloat($("#l10").attr('value'));
        var l11=parseFloat($("#l11").attr('value'));
        var l12=parseFloat($("#l12").attr('value'));
        var l13=parseFloat($("#l13").attr('value'));
        var l16=parseFloat($("#l16").attr('value'));
        var l19=parseFloat($("#l19").attr('value'));
        var l20=parseFloat($("#l20").attr('value'));
        var l21=parseFloat($("#l21").attr('value'));
        var l22=parseFloat($("#l22").attr('value'));
        var l23=parseFloat($("#l23").attr('value'));
        var l24=parseFloat($("#l24").attr('value'));
        
        var lc1=parseFloat($("#lc1").attr('value'));
        var lc2=parseFloat($("#lc2").attr('value'));
        var lc4=parseFloat($("#lc4").attr('value'));
        var lc5=parseFloat($("#lc5").attr('value'));
        var lc8=parseFloat($("#lc8").attr('value'));
        var lc9=parseFloat($("#lc9").attr('value'));
        var lc10=parseFloat($("#lc10").attr('value'));
        var lc11=parseFloat($("#lc11").attr('value'));
        var lc12=parseFloat($("#lc12").attr('value'));
        var lc13=parseFloat($("#lc13").attr('value'));
        var lc16=parseFloat($("#lc16").attr('value'));
        var lc19=parseFloat($("#lc19").attr('value'));
        var lc20=parseFloat($("#lc20").attr('value'));
        var lc21=parseFloat($("#lc21").attr('value'));
        var lc22=parseFloat($("#lc22").attr('value'));
        var lc23=parseFloat($("#lc23").attr('value'));
        var lc24=parseFloat($("#lc24").attr('value'));

        var la1=parseFloat($("#la1").attr('value'));
        var la2=parseFloat($("#la2").attr('value'));
        var la4=parseFloat($("#la4").attr('value'));
        var la5=parseFloat($("#la5").attr('value'));
        var la8=parseFloat($("#la8").attr('value'));
        var la9=parseFloat($("#la9").attr('value'));
        var la10=parseFloat($("#la10").attr('value'));
        var la11=parseFloat($("#la11").attr('value'));
        var la12=parseFloat($("#la12").attr('value'));
        var la13=parseFloat($("#la13").attr('value'));
        var la16=parseFloat($("#la16").attr('value'));
        var la19=parseFloat($("#la19").attr('value'));
        var la20=parseFloat($("#la20").attr('value'));
        var la21=parseFloat($("#la21").attr('value'));
        var la22=parseFloat($("#la22").attr('value'));
        var la23=parseFloat($("#la23").attr('value'));
        var la24=parseFloat($("#la24").attr('value'));
        
        var turno1_pesos= parseFloat($("#turno1_pesos").attr('value'));
        var turno1_dolar= parseFloat($("#turno1_dolar").attr('value'));
        var turno1_cambio=parseFloat($("#turno1_cambio").attr('value'));
        var turno1_bbv=   parseFloat($("#turno1_bbv").attr('value'));
        var turno1_exp=   parseFloat($("#turno1_exp").attr('value'));
        var turno1_san=   parseFloat($("#turno1_san").attr('value'));
        var turno1_vale=  parseFloat($("#turno1_vale").attr('value'));
        var turno1_asalto=parseFloat($("#turno1_asalto").attr('value'));
        var turno1_corte =parseFloat($("#turno1_corte").attr('value'));
        
        var turno2_pesos= parseFloat($("#turno2_pesos").attr('value'));
        var turno2_dolar= parseFloat($("#turno2_dolar").attr('value'));
        var turno2_cambio=parseFloat($("#turno2_cambio").attr('value'));
        var turno2_bbv=   parseFloat($("#turno2_bbv").attr('value'));
        var turno2_san=   parseFloat($("#turno2_san").attr('value'));
        var turno2_exp=   parseFloat($("#turno2_exp").attr('value'));
        var turno2_vale=  parseFloat($("#turno2_vale").attr('value'));
        var turno2_asalto=parseFloat($("#turno2_asalto").attr('value'));
        var turno2_corte=parseFloat($("#turno2_corte").attr('value'));
        
        var turno3_pesos= parseFloat($("#turno3_pesos").attr('value'));
        var turno3_dolar= parseFloat($("#turno3_dolar").attr('value'));
        var turno3_cambio=parseFloat($("#turno3_cambio").attr('value'));
        var turno3_bbv=   parseFloat($("#turno3_bbv").attr('value'));
        var turno3_san=   parseFloat($("#turno3_san").attr('value'));
        var turno3_exp=   parseFloat($("#turno3_exp").attr('value'));
        var turno3_vale=  parseFloat($("#turno3_vale").attr('value'));
        var turno3_asalto=parseFloat($("#turno3_asalto").attr('value'));
        var turno3_corte=parseFloat($("#turno3_corte").attr('value'));
        
        var turno4_pesos= parseFloat($("#turno4_pesos").attr('value'));
        var turno4_dolar= parseFloat($("#turno4_dolar").attr('value'));
        var turno4_cambio=parseFloat($("#turno4_cambio").attr('value'));
        var turno4_bbv=   parseFloat($("#turno4_bbv").attr('value'));
        var turno4_san=   parseFloat($("#turno4_san").attr('value'));
        var turno4_exp=   parseFloat($("#turno4_exp").attr('value'));
        var turno4_vale=  parseFloat($("#turno4_vale").attr('value'));
        var turno4_asalto=parseFloat($("#turno4_asalto").attr('value'));
        var turno4_corte=parseFloat($("#turno4_corte").attr('value'));

        if(isNaN(l1)){l1=0;}
        if(isNaN(l2)){l2=0;}
        if(isNaN(l4)){l4=0;}
        if(isNaN(l5)){l5=0;}
        if(isNaN(l8)){l8=0;}
        if(isNaN(l9)){l9=0;}
        if(isNaN(l10)){l10=0;}
        if(isNaN(l11)){l11=0;}
        if(isNaN(l12)){l12=0;}
        if(isNaN(l13)){l13=0;}
        if(isNaN(l16)){l16=0;}
        if(isNaN(l19)){l19=0;}
        if(isNaN(l20)){l20=0;}
        if(isNaN(l21)){l21=0;}
        if(isNaN(l22)){l22=0;}
        if(isNaN(l23)){l23=0;}
        if(isNaN(l24)){l24=0;}
        
        if(isNaN(lc1)){lc1=0;}
        if(isNaN(lc2)){lc2=0;}
        if(isNaN(lc4)){lc4=0;}
        if(isNaN(lc5)){lc5=0;}
        if(isNaN(lc8)){lc8=0;}
        if(isNaN(lc9)){lc9=0;}
        if(isNaN(lc10)){lc10=0;}
        if(isNaN(lc11)){lc11=0;}
        if(isNaN(lc12)){lc12=0;}
        if(isNaN(lc13)){lc13=0;}
        if(isNaN(lc16)){lc16=0;}
        if(isNaN(lc19)){lc19=0;}
        if(isNaN(lc20)){lc20=0;}
        if(isNaN(lc21)){lc21=0;}
        if(isNaN(lc22)){lc22=0;}
        if(isNaN(lc23)){lc23=0;}
        if(isNaN(lc24)){lc24=0;}
        
        if(isNaN(la1)){la1=0;}
        if(isNaN(la2)){la2=0;}
        if(isNaN(la4)){la4=0;}
        if(isNaN(la5)){la5=0;}
        if(isNaN(la8)){la8=0;}
        if(isNaN(la9)){la9=0;}
        if(isNaN(la10)){la10=0;}
        if(isNaN(la11)){la11=0;}
        if(isNaN(la12)){la12=0;}
        if(isNaN(la13)){la13=0;}
        if(isNaN(la16)){la16=0;}
        if(isNaN(la19)){la19=0;}
        if(isNaN(la20)){la20=0;}
        if(isNaN(la21)){la21=0;}
        if(isNaN(la22)){la22=0;}
        if(isNaN(la23)){la23=0;}
        if(isNaN(la24)){la24=0;}
        
        if(isNaN(turno1_pesos)){turno1_pesos=0;}
        if(isNaN(turno1_dolar)){turno1_dolar=0;}
        if(isNaN(turno1_cambio)){turno1_cambio=0;}
        if(isNaN(turno1_bbv)){turno1_bbv=0;}
        if(isNaN(turno1_san)){turno1_san=0;}
        if(isNaN(turno1_exp)){turno1_exp=0;}
        if(isNaN(turno1_vale)){turno1_vale=0;}
        if(isNaN(turno1_asalto)){turno1_asalto=0;}
        if(isNaN(turno1_corte)){turno1_corte=0;}
        
        if(isNaN(turno2_pesos)){turno2_pesos=0;}
        if(isNaN(turno2_dolar)){turno2_dolar=0;}
        if(isNaN(turno2_cambio)){turno2_cambio=0;}
        if(isNaN(turno2_bbv)){turno2_bbv=0;}
        if(isNaN(turno2_san)){turno2_san=0;}
        if(isNaN(turno2_exp)){turno2_exp=0;}
        if(isNaN(turno2_vale)){turno2_vale=0;}
        if(isNaN(turno2_asalto)){turno2_asalto=0;}
        if(isNaN(turno2_corte)){turno2_corte=0;}
        
        if(isNaN(turno3_pesos)){turno3_pesos=0;}
        if(isNaN(turno3_dolar)){turno3_dolar=0;}
        if(isNaN(turno3_cambio)){turno3_cambio=0;}
        if(isNaN(turno3_bbv)){turno3_bbv=0;}
        if(isNaN(turno3_san)){turno3_san=0;}
        if(isNaN(turno3_exp)){turno3_exp=0;}
        if(isNaN(turno3_vale)){turno3_vale=0;}
        if(isNaN(turno3_asalto)){turno3_asalto=0;}
        if(isNaN(turno3_corte)){turno3_corte=0;}
        
        if(isNaN(turno4_pesos)){turno4_pesos=0;}
        if(isNaN(turno4_dolar)){turno4_dolar=0;}
        if(isNaN(turno4_cambio)){turno4_cambio=0;}
        if(isNaN(turno4_bbv)){turno4_bbv=0;}
        if(isNaN(turno4_san)){turno4_san=0;}
        if(isNaN(turno4_exp)){turno4_exp=0;}
        if(isNaN(turno4_vale)){turno4_vale=0;}
        if(isNaN(turno4_asalto)){turno4_asalto=0;}
        if(isNaN(turno4_corte)){turno4_corte=0;}  
        
        var suma1 = l1+l2+l4+l5+l8+l9+l10+l11+l12+l13+l16+l19+l20+l21+l22+l23+l24+
                    la1+la2+la4+la5+la8+la9+la10+la11+la12+la13+la16+la19+la20+la21+la22+la23+la24-
                    lc1-lc2-lc4-lc5-lc8-lc9-lc10-lc11-lc12-lc13-lc16-lc19-lc20-lc21-lc22-lc23-lc24 ;
        var mn1 = turno1_dolar*turno1_cambio;
        var mn2 = turno2_dolar*turno2_cambio;
        var mn3 = turno3_dolar*turno3_cambio;
        var mn4 = turno4_dolar*turno4_cambio;
		var arqueo = turno1_pesos+turno1_bbv+turno1_san+turno1_exp+turno1_vale+turno1_asalto+mn1+
                     turno2_pesos+turno2_bbv+turno2_san+turno2_exp+turno2_vale+turno2_asalto+mn2+
                     turno3_pesos+turno3_bbv+turno3_san+turno3_exp+turno3_vale+turno3_asalto+mn3+
                     turno4_pesos+turno4_bbv+turno4_san+turno4_exp+turno4_vale+turno4_asalto+mn4;
       var arqueo1 = turno1_pesos+turno1_bbv+turno1_san+turno1_exp+turno1_vale+turno1_asalto+mn1;
       var arqueo2 = turno2_pesos+turno2_bbv+turno2_san+turno2_exp+turno2_vale+turno2_asalto+mn2;
       var arqueo3 = turno3_pesos+turno3_bbv+turno3_san+turno3_exp+turno3_vale+turno3_asalto+mn3;
       var arqueo4 = turno4_pesos+turno4_bbv+turno4_san+turno4_exp+turno4_vale+turno4_asalto+mn4;
       var corte  = parseFloat(turno1_corte) + parseFloat(turno2_corte) +  parseFloat(turno3_corte) + parseFloat(turno4_corte);
       
      
       
        if (arqueo1>turno1_corte){var sob1 = arqueo1 - turno1_corte; var fal1=0;}else{var fal1= turno1_corte - arqueo1;var sob1=0;}
        if (arqueo2>turno2_corte){var sob2 = arqueo2 - turno2_corte; var fal2=0;}else{var fal2= turno2_corte - arqueo2;var sob2=0;}
        if (arqueo3>turno3_corte){var sob3 = arqueo3 - turno3_corte; var fal3=0;}else{var fal3= turno3_corte - arqueo3;var sob3=0;}
        if (arqueo4>turno4_corte){var sob4 = arqueo4 - turno4_corte; var fal4=0;}else{var fal4= turno4_corte - arqueo4;var sob4=0;}
      
       
        var iva = $('#iva').attr("value");
         
        var subtotal = l2+l5+l9+l11+l19+l20+l21+la2+la5+la9+la11+la19+la20+la21-lc2-lc5-lc9-lc11-lc19-lc20-lc21;
        var totiva = subtotal-(subtotal/iva);
       
        
        //corte=Math.round(corte*100)/100  //returns 28.45 redondea
        corte=Math.round(corte*100)/100  //returns 28.45 redondea
        suma1=Math.round(suma1*100)/100  //returns 28.45
        totiva=totiva
        fal1=Math.round(fal1*100)/100 
        fal2=Math.round(fal2*100)/100 
        fal3=Math.round(fal3*100)/100
        fal4=Math.round(fal4*100)/100 
        
        sob1=Math.round(sob1*100)/100
        sob2=Math.round(sob2*100)/100
        sob3=Math.round(sob3*100)/100
        sob4=Math.round(sob4*100)/100
       
        var dif=corte-suma1;
       $("#turno1_corte").val(turno1_corte);
       $("#turno2_corte").val(turno2_corte);
       $("#turno3_corte").val(turno3_corte);
       $("#turno4_corte").val(turno4_corte);
       
        $("#subtotal").html(subtotal);
        $("#totiva").html(totiva);
		$("#suma1").html(suma1);
        $("#corte").html(corte);
        $("#arqueo").html(arqueo);
        $("#dif").html(dif);
	    
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
        
       alert(l1);
        var recarga = $('#recarga').attr("value");
         
        $("#recarga").html(recarga);   
     }
   ///**************************************************  
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#supervisor_form_corte_det').submit(function() {
        suma1=parseFloat($("#suma1").html());
        corte=parseFloat($("#corte").html());
        recarga= parseFloat($("#recarga").html());
       
        var l30= $("#l30").attr('value');
        
        
        l20 = $('#l20').attr("value");
        la20 = $('#la20').attr("value");
        lc20 = $('#lc20').attr("value");
        if(isNaN(l20)){l20=0;}
        if(isNaN(la20)){la20=0;}
        if(isNaN(lc20)){lc20=0;}
       
        dif = $('#dif').attr("value");
        var dif=parseFloat(l20)+parseFloat(la20)-parseFloat(lc20)-parseFloat(recarga);
        if(isNaN(dif)){dif=0;}
        
        
      
             
    	    
    	  }else{
 
    	    alert('VERIFIQUE LA CAPTURA, NO CUADRA EL CORTE');
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>