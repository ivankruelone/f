<div class="row-fluid">

    <div class="span12">
    
    <h3>Recursos Humanos</h3>
    
    <h4>Reglamentos</h4>
    
    <?php $cia = $this->session->userdata('cia'); ?>
    
    <ul>
        <li>Reglamento del comedor. - <?php echo anchor('checador/bajar_reglamento_comedor', '<i class="icon-download-alt"></i>Descargar'); ?></li>
        <li>Reglamento de incidencias. - <?php echo anchor('checador/bajar_reglamento_incidencias', '<i class="icon-download-alt"></i>Descargar'); ?></li>
        
        <?php if ($cia == 1 || $cia == 2 || $cia == 4 || $cia == 5){?>

        <li>Reglamento de vacaciones. - <?php echo anchor('checador/bajar_reglamento_vacaciones_adicionales', '<i class="icon-download-alt"></i>Descargar'); ?></li>
        
        <?php }else{?>
        
        <li>Reglamento de vacaciones. - <?php echo anchor('checador/bajar_reglamento_vacaciones', '<i class="icon-download-alt"></i>Descargar'); ?></li>
        
        <?php }?>
        <li>Codigo de conducta. - <?php echo anchor('checador/bajar_codigo_conducta', '<i class="icon-download-alt"></i>Descargar'); ?></li>
        <li>Codigo de vestir. - <?php echo anchor('checador/bajar_codigo_vestimenta', '<i class="icon-download-alt"></i>Descargar'); ?></li>
        
    </ul>
    
    </div>
</div>