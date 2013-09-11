<div class="row-fluid">

    <div class="span12">
    
    <h3>Preguntas y respuestas</h3>
    
              <div id="accordion" class="accordion">
              
                <?php foreach($query->result() as $row){ ?>
              
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a href="#collapse_<?php echo $row->id; ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                      <?php echo $row->pregunta; ?>
                    </a>
                  </div>
                  <div class="accordion-body collapse" id="collapse_<?php echo $row->id; ?>" style="height: auto;">
                    <div class="accordion-inner">
                    <?php echo $row->respuesta; ?>
                    </div>
                  </div>
                </div>
                
                <?php }?>
                
              </div>
    </div>
    
    <div class="span8">
    
        <h3>Pregunta directa</h3>
        
        <?php echo form_open('checador/ayuda_pregunta', array('class' => 'form-horizontal')); ?>
        <div class="control-group">
            <label class="control-label" for="pregunta">Pregunta</label>
            <div class="controls">
                <textarea name="pregunta" placeholder="Formula aqui tu pregunta por favor" rows="8" class="span8" required="required"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary">Enviar pregunta</button>
            </div>
        </div>
        
        </div>

        <?php echo form_close();?>
    
    </div>
    
    

</div>