            <div class="row">
                <div class="span16">
                <h3>Diagn&oacute;stico por departamento</h3>
                 <?php $id_d=0;  if($query->num_rows()==0){ ?> 
                    <?php echo form_open('checador/graba_diagnostico');
                  $uno = array(
                  'name'        => 'uno',
                  'id'          => 'uno',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                $tres = array(
                  'name'        => 'tres',
                  'id'          => 'tres',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                $cinco = array(
                  'name'        => 'cinco',
                  'id'          => 'cinco',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                $diez = array(
                  'name'        => 'diez',
                  'id'          => 'diez',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                    ?>
                    
                    <fieldset>
                    <table>
                    <tr>
                    <tr>
                    <td><label for="uno">&iquest;Cual es su perspectiva a 1 a&ntilde;o?</label></td>
                    <td><label for="tres">&iquest;Cual es su perspectiva a 3 a&ntilde;o?</label></td>
                    <td><label for="cinco">&iquest;Cual es su perspectiva a 5 a&ntilde;o?</label></td>
                    <td><label for="diez">&iquest;Cual es su perspectiva a 10 a&ntilde;o?</label></td>
                    </tr>        
                    <tr>
                    <td><?php echo form_textarea($uno);?></td>
                    <td><?php echo form_textarea($tres);?></td>
                    <td><?php echo form_textarea($cinco);?></td>
                    <td><?php echo form_textarea($diez);?></td>
                    </tr>
                    
                    
                   
                    <td colspan="4"><input type="submit" name="submit" value="Guardar" class="btn" /></td>
                    </tr>
                    </table>
                    </fieldset>
                    <?php echo form_close(); 
                    }else{
                        $r=$query->row();$id_d=$r->id;$propuesta=$r->propuesta;$plazo=$r->plazo;$alinear=$r->alinear;
                        }?>
                
                </div>
                <?php if($id_d>1 and $propuesta==''){ ?>
                <div class="span12">
                   <?php echo form_open('checador/act_propuesta');
                  $propuesta = array(
                  'name'        => 'propuesta',
                  'id'          => 'propuesta',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span12'
                );
                  ?>
                    
                    <fieldset>
                   <td>&iquest;Su vision es vigente para la condicion de su empresa en la actualidad?</td>
                   <br />
                   <td>Pida a sus cabezas de area que mencionen 5 valores de la empresa y 5 valores de su parte del negocio aunque no sean los mismos.</td>
                   <br />
                   <td>Velide que los valores mencionados; sean los que usted tiene como establecidos en la organizaci&oacute;n.</td>
                    <br />
                   <td>Valide que los valores se encuentren integrados en su misi&oacute;n.</td>
                   <br />
                   <td>Pregunte a cada cabeza de area que significan los valores que mencion&oacute;.</td>
                   <br />
                   <br />
                   <td><label for="redacta">Redacte una propuesta de la actualizaci&oacute;n de MISI&Oacute;N, VISI&Oacute;N Y VALORES con la base de la informacion colectada y presente al consejo de administraci&oacute;n para validar que se encuentre alineada a lo que la empresa busca.</label></td>
                   <?php echo form_textarea($propuesta)?>
                   <br />
                   <td>Valide que la misi&oacute;n, visi&oacute;n y valores sean congruentes con lo que se determin&oacute; en la empresa y que esto dar&aacute; rumbos a los esfuerzos para alcanzar el estado ideal.</td>
                   <br />
                   <td colspan="4"><input type="submit" name="submit" value="Guardar" class="btn" /></td>
                   <input type="hidden" value="<?php echo $id_d?>" name="id_d" id="id_d" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>
                <?php }
                if($id_d>1 and $plazo=='' and $propuesta<>' '){ ?>
                 <div class="span12">
                   <?php echo form_open('checador/act_plazo');
                  
                $plazo = array(
                  'name'        => 'plazo',
                  'id'          => 'plazo',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span12'
                );
                   ?>
                    
                    <fieldset>
                    <td><label for="plazo">Redacte los primeros 5 pasos que usted cree se debe dar en el corto plazo para alcanzar dicho estado ideal</label></td>
                   <?php echo form_textarea($plazo)?>
                   <br />
                   <td colspan="4"><input type="submit" name="submit" value="Guardar" class="btn" /></td>
                    <input type="hidden" value="<?php echo $id_d?>" name="id_d" id="id_d" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>
                <?php } 
                if($id_d>0 and $alinear=='' and $plazo<>' '){ ?>
                 <div class="span12">
                   <?php echo form_open('checador/act_alinear');
                $alinear = array(
                  'name'        => 'alinear',
                  'id'          => 'alinear',
                  'value'       => '',
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span12'
                );
                
                    ?>
                    
                    <fieldset>
                   <td><label for="alinear">Pida a sus cabezas de area que redacten 5 pasos para alinear sus areas al estado ideal de la empresa.</label></td>
                   <?php echo form_textarea($alinear)?>
                   <br />
                   <td colspan="4"><input type="submit" name="submit" value="Guardar" class="btn" /></td>
                   <input type="hidden" value="<?php echo $id_d?>" name="id_d" id="id_d" /> 
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>
                <?php } if($id_d>0){ ?>
                <div class="span12">
              
               <h3>Diagnostico</h3>
                <table class="table table-bordered table-striped table-hover">
                <thead>
                <?php  
                $l1=anchor('checador/diagnostico_act/1/','Diagnostico </a>', array('title' => 'Haz Click aqui para cambiar perspectiva por a&ntilde;o', 'class' => 'encabezado'));
                $l2=anchor('checador/diagnostico_act/2/','Propuesta </a>', array('title' => 'Haz Click aqui para cambiar perspectiva por a&ntilde;o', 'class' => 'encabezado'));
                $l3=anchor('checador/diagnostico_act/3/','Plazo </a>', array('title' => 'Haz Click aqui para cambiar perspectiva por a&ntilde;o', 'class' => 'encabezado'));
                $l4=anchor('checador/diagnostico_act/4/','Solicitud </a>', array('title' => 'Haz Click aqui para cambiar perspectiva por a&ntilde;o', 'class' => 'encabezado'));
                ?>
               <tr>
               <th colspan="4"><?php echo $l1 ?></th>
               </tr>
                        <tr>
                            <th>1 a&ntilde;o</th>
                            <th>3 a&ntilde;o</th>
                            <th>5 a&ntilde;o</th>
                            <th>10 a&ntilde;o</th>
                        </tr>
                    </thead>
                    <tbody>
               <?php 
               foreach($query->result() as $row){
               
                ?>
               
              
               <tr>
               <td><?php echo $row->uno;?></td>
               <td><?php echo $row->tres;?></td>
               <td><?php echo $row->cinco;?></td>
               <td><?php echo $row->diez;?></td>
               </tr> 
               <tr>
               <td><strong><?php echo $l2 ?></strong></td>
               <td><strong><?php echo $l3 ?></strong></td>
               <td><strong><?php echo $l4 ?></strong></td>
               <td></td>
               </tr>
               <tr>
               <td><?php echo $row->propuesta;?></td>
               <td><?php echo $row->plazo;?></td>
               <td><?php echo $row->alinear;?></td>
               <td></td>
               </tr>
               
               <?php }?>
               </tbody>
               </table>
               </div> 
            <?php } ?>
            
            </div>
