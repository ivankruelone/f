<p style="font-size: large;">
    <strong><?php echo $titulo;?> </strong>
</p>
<div>
<?php

    $arreglo = json_decode($datos);
    $comisionesarr = json_decode($comisiones);
    $arreglo2 = json_decode($datos2);
    $arreglo3 = json_decode($datos3);
    
?>

<table style="margin-left: auto; margin-right: auto; font-size: large;">
<caption>Comisiones por compa&ntilde;ia telefonica</caption>
<thead>
    <tr>
        <th>Compa&ntilde;ia</th>
        <th>Comisi&oacute;n</th>
    </tr>
</thead>
<tbody>
    <?php foreach($comisionesarr as $comision){?>
    <tr>
        <td><?php echo $comision->nombre?></td>
        <td style="text-align: right;"><?php echo $comision->comision?></td>
    </tr>
    <?php }?>
</tbody>
</table>

<table style="margin-left: auto; margin-right: auto; font-size: large;">
<caption>Registros: <?php echo count($arreglo); ?></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Nid</th>
            <th>Sucursal</th>
            <th>Recargas</th>
            <th>Venta</th>
            <th>Comisi&oacute;n</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
    
    $recargas = 0;
    $monto = 0;
    $comision = 0;
    $comision_total = 0;
    
    $i = 1;
    
    foreach($arreglo as $item){
        
    ?>
    
    <tr>
        <td style="text-align: right;"><?php echo $i; ?></td>
        <td style="text-align: right;"><?php echo $item->suc_id; ?></td>
        <td><?php echo $item->nombre; ?></td>
        <td style="text-align: right;"><?php echo number_format($item->recargas, 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item->monto, 2); ?></td>
        <td style="text-align: right;"><?php echo number_format($item->comision, 2); ?></td>
    </tr>
    
    <?php
    
    $recargas  = $recargas + $item->recargas;
    $monto = $monto + $item->monto;
    $comision = $comision + ($item->monto * 0.065);
    $comision_total = $comision_total + $item->comision;
    
    $i++;
    
    }
    
    $sin_iva = $comision_total / 1.16;
    $iva = $comision_total - $sin_iva;
    
    ?>
    
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align: right;">Totales</td>
            <td style="text-align: right;"><?php echo number_format($recargas, 0); ?></td>
            <td style="text-align: right;"><?php echo number_format($monto, 2); ?></td>
            <td style="text-align: right;"><?php echo number_format($comision_total, 2); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">Sin IVA</td>
            <td style="text-align: right;"><?php echo number_format($sin_iva, 2); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">IVA</td>
            <td style="text-align: right;"><?php echo number_format($iva, 2); ?></td>
        </tr>
    </tfoot>
</table>


<table style="margin-left: auto; margin-right: auto; font-size: large;">
<caption>Registros: <?php echo count($arreglo2); ?></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Id. Producto</th>
            <th>Producto</th>
            <th>Recargas</th>
            <th>Venta</th>
            <th>Comisi&oacute;n</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
    
    $recargas = 0;
    $monto = 0;
    $comision = 0;
    $comision_total = 0;
    
    $i = 1;
    
    foreach($arreglo2 as $item){
        
    ?>
    
    <tr>
        <td style="text-align: right;"><?php echo $i; ?></td>
        <td style="text-align: right;"><?php echo $item->idproduct; ?></td>
        <td><?php echo $item->description; ?></td>
        <td style="text-align: right;"><?php echo number_format($item->recargas, 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item->monto, 2); ?></td>
        <td style="text-align: right;"><?php echo number_format($item->comision, 2); ?></td>
    </tr>
    
    <?php
    
    $recargas  = $recargas + $item->recargas;
    $monto = $monto + $item->monto;
    $comision = $comision + ($item->monto * 0.065);
    $comision_total = $comision_total + $item->comision;
    
    $i++;
    
    }
    
    $sin_iva = $comision_total / 1.16;
    $iva = $comision_total - $sin_iva;
    
    $monto_final = $monto;
    
    ?>
    
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align: right;">Totales</td>
            <td style="text-align: right;"><?php echo number_format($recargas, 0); ?></td>
            <td style="text-align: right;"><?php echo number_format($monto, 2); ?></td>
            <td style="text-align: right;"><?php echo number_format($comision_total, 2); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">Sin IVA</td>
            <td style="text-align: right;"><?php echo number_format($sin_iva, 2); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">IVA</td>
            <td style="text-align: right;"><?php echo number_format($iva, 2); ?></td>
        </tr>
    </tfoot>
</table>

<table style="margin-left: auto; margin-right: auto; font-size: large;">
<caption>Registros: <?php echo count($arreglo3); ?></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Id. Compa&ntilde;ia</th>
            <th>Compa&ntilde;ia</th>
            <th>Recargas</th>
            <th>Venta</th>
            <th>Comisi&oacute;n</th>
            <th>Venta (%)</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
    
    $recargas = 0;
    $monto = 0;
    $comision = 0;
    $comision_total = 0;
    
    $i = 1;
    
    foreach($arreglo3 as $item){
        
        $porce = ($item->monto / $monto_final) * 100;
        
    ?>
    
    <tr>
        <td style="text-align: right;"><?php echo $i; ?></td>
        <td style="text-align: right;"><?php echo $item->id; ?></td>
        <td><?php echo $item->nombre; ?></td>
        <td style="text-align: right;"><?php echo number_format($item->recargas, 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item->monto, 2); ?></td>
        <td style="text-align: right;"><?php echo number_format($item->comision, 2); ?></td>
        <td style="text-align: right;"><?php echo number_format($porce, 2); ?> %</td>
    </tr>
    
    <?php
    
    $recargas  = $recargas + $item->recargas;
    $monto = $monto + $item->monto;
    $comision = $comision + ($item->monto * 0.065);
    $comision_total = $comision_total + $item->comision;
    
    $i++;
    
    }
    
    $sin_iva = $comision_total / 1.16;
    $iva = $comision_total - $sin_iva;
    
    ?>
    
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align: right;">Totales</td>
            <td style="text-align: right;"><?php echo number_format($recargas, 0); ?></td>
            <td style="text-align: right;"><?php echo number_format($monto, 2); ?></td>
            <td style="text-align: right;"><?php echo number_format($comision_total, 2); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">Sin IVA</td>
            <td style="text-align: right;"><?php echo number_format($sin_iva, 2); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">IVA</td>
            <td style="text-align: right;"><?php echo number_format($iva, 2); ?></td>
        </tr>
    </tfoot>
</table>

</div>