            <div class="row">
                <div class="span16">
                <h3>Diagn&oacute;stico por departamento</h3>
                 <?php  if($query->num_rows()>0){
                 $r=$query->row();
                 $id_d=$r->id;$propuesta=$r->propuesta;$plazo=$r->plazo;$alinear=$r->alinear;$mov=$r->mov;
                 $uno=$r->uno;$tres=$r->tres;$cinco=$r->cinco;$diez=$r->diez;}
                 if($mov==1){?> 
                    <?php echo form_open('checador/act_diag');
                  $uno = array(
                  'name'        => 'uno',
                  'id'          => 'uno',
                  'value'       => $uno,
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                $tres = array(
                  'name'        => 'tres',
                  'id'          => 'tres',
                  'value'       => $tres,
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                $cinco = array(
                  'name'        => 'cinco',
                  'id'          => 'cinco',
                  'value'       => $cinco,
                  'type'        => 'text',
                  'required'    => 'required',
                  'class'       => 'span3'
                );
                $diez = array(
                  'name'        => 'diez',
                  'id'          => 'diez',
                  'value'       => $diez,
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
                    <input type="hidden" value="<?php echo $id_d?>" name="id_d" id="id_d" />
                    </fieldset>
                    <?php echo form_close(); 
                    }?>
                
                </div>
                <?php if($mov==2){ ?>
                <div class="span12">
                   <?php echo form_open('checador/act_propuesta');
                  $propuesta = array(
                  'name'        => 'propuesta',
                  'id'          => 'propuesta',
                  'value'       => $propuesta,
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
                if($mov==3){ ?>
                 <div class="span12">
                   <?php echo form_open('checador/act_plazo');
                  
                $plazo = array(
                  'name'        => 'plazo',
                  'id'          => 'plazo',
                  'value'       => $plazo,
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
                if($mov==4){ ?>
                 <div class="span12">
                   <?php echo form_open('checador/act_alinear');
                $alinear = array(
                  'name'        => 'alinear',
                  'id'          => 'alinear',
                  'value'       => $alinear,
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
                <?php } ?>
                
            
            </div>
