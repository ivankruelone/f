<div class="row">
    <div class="span12">
        <h2>Reporte de Asistencias</h2>
        <?php echo $tabla; ?>
        
        <p>
        
        <?php echo anchor('checador/reporte1_pdf', 'Impresion PDF', array('target' => '_blank'));?>
        
        </p>
    </div>
</div>