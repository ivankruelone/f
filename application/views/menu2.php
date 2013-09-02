<?php
$nivel = $this->session->userdata('nivel');
$id = $this->session->userdata('id');
?>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <?php echo anchor('mensajes', 'Mensajes(0)', array('class' => 'brand'));?>
                    <div class="nav-collapse collapse">
                        <?php
                        if($nivel == 5000){
                        ?>
                        <ul class="nav">
                            <li <?php if($menu == 'home'){?>class="active" <?php }?>><?php echo anchor('checador/index', 'Home');?></li>
                            <li <?php if($menu == 'perfil'){?>class="active" <?php }?>><?php echo anchor('checador/perfil_usuario', 'Perfil');?></li>
                            <li <?php if($menu == 'asistencias'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Asistencias <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/asistencias', 'Eventos Registrados');?></li>
                                    <li><?php echo anchor('checador/asistencias_elige_quincena', 'Asistencias');?></li>
                                    <li><?php echo anchor('checador/calendario', 'Calendario');?></li>
                                    <li><?php echo anchor('checador/reporte1', 'Reporte de Asistencias');?></li>
                                </ul>
                            </li>
                            <?php
                                if($id == 939 || $id == 3613){
                            ?>
                            <li <?php if($menu == 'cargar'){?>class="active" <?php }?>><?php echo anchor('checador/cargar_datos', 'Cargar Datos');?></li>
                            <?php
                                }
                            ?>
                            <li <?php if($menu == 'formatos'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Formatos <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/formato_vacaciones', 'Vacaciones');?></li>
                                    <li><?php echo anchor('checador/formato_credencial', 'Credencial');?></li>
                                    <li><?php echo anchor('checador/formato_salidas', 'Salidas Personal');?></li>
                                    <li><?php echo anchor('checador/formato_memo', 'MEMORANDUM');?></li>
                                </ul>
                            </li>
                            <li><?php echo anchor('login/logout', 'Cerrar Sesi&oacute;n');?></li>
                        </ul>
                        <?php
                        }elseif($nivel == 50){
                        ?>
                        <ul class="nav">
                            <li <?php if($menu == 'home'){?>class="active" <?php }?>><?php echo anchor('checador/index', 'Home');?></li>
                            <li <?php if($menu == 'asistencias'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Asistencias <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/admin_asistencias_elige_quincena', 'Asistencias');?></li>
                                    <li><?php echo anchor('checador/admin_gerente_asistencias_sin_huella', 'Sin huella');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'reportes'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/admin_reporte_asistencias_elige_quincena', 'Asistencias');?></li>
                                    <li><?php echo anchor('checador/imprime_entrega_usuarios', 'Entrega usuarios', array('target' => '_blank'));?></li>
                                    <li><?php echo anchor('checador/admin_justificaciones_elige_quincena_concentrado', 'Justificaciones concentrado');?></li>
                                    <li><?php echo anchor('checador/admin_justificaciones_elige_quincena', 'Justificaciones detalle');?></li>
                                    <li><?php echo anchor('checador/admin_incidencias_elige_quincena', 'Incidencias por quincena');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Vacaciones'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vacaciones <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/formato_vacaciones_validar', 'Pendientes por validar');?></li>
                                    <li><?php echo anchor('checador/formato_vacaciones_historico', 'Historico vacaciones');?></li>
                                    <li><?php echo anchor('checador/formato_periodos', 'Periodos');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'incidencias'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Incidencias <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/formato_incidencias_validar', 'Pendientes por validar');?></li>
                                    <li><?php echo anchor('checador/formato_incidencias_historico', 'Historico incidencias');?></li>
                                </ul>
                            </li>
                            
                          <!--
                            </a><li <?php if($menu == 'memorandum'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Memorandum <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/formato_memo_validar', 'Pendientes por validar');?></li>
                                    <li><?php echo anchor('checador/formato_memo_historico', 'Historico Memorandum');?></li>
                                </ul>
                            </li>
                            -->
                            <li><?php echo anchor('login/logout', 'Cerrar Sesi&oacute;n');?></li>
                        </ul>
                        <form class="navbar-form pull-right">
                            <input type="text" class="input-small search-query" />
                            <button type="submit" class="btn">Buscar</button>
                        </form>
                        <?php
                        }elseif($nivel == 51){
                        ?>
                        <ul class="nav">
                            <li <?php if($menu == 'home'){?>class="active" <?php }?>><?php echo anchor('checador/index', 'Home');?></li>
                            <li <?php if($menu == 'asistencias'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Asistencias <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/gerente_asistencias_elige_quincena', 'Asistencias');?></li>
                                </ul>
                            </li>
                            <?php
                                if($id == 939 || $id == 3613){
                            ?>
                            <li <?php if($menu == 'cargar'){?>class="active" <?php }?>><?php echo anchor('checador/cargar_datos', 'Cargar Datos');?></li>
                            <?php
                                }
                            ?>
                            <li><?php echo anchor('login/logout', 'Cerrar Sesi&oacute;n');?></li>
                        </ul>
                        <?php
                        }elseif($nivel == 54){
                        ?>
                        <ul class="nav">
                            <li <?php if($menu == 'home'){?>class="active" <?php }?>><?php echo anchor('checador/index', 'Home');?></li>
                            <li <?php if($menu == 'asistencias'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Asistencias <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/gerente_asistencias_elige_quincena_ger', 'Asistencias');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'reportes'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('checador/admin_justificaciones_elige_quincena2', 'JUSTIFICACIONES A DETALLE');?></li>
                                    <li><?php echo anchor('checador/admin_justificaciones_elige_quincena3', 'Hrs. LABORADAS X EMPLEADO');?></li>
                                </ul>
                            </li>
                            <?php
                                if($id == 939 || $id == 3613){
                            ?>
                            <li <?php if($menu == 'cargar'){?>class="active" <?php }?>><?php echo anchor('checador/cargar_datos', 'Cargar Datos');?></li>
                            <?php
                                }
                            ?>
                            <li><?php echo anchor('login/logout', 'Cerrar Sesi&oacute;n');?></li>
                        </ul>
                        <?php
                        }elseif($nivel == 40){
                        ?>
                        <ul class="nav">
                            <li <?php if($menu == 'home'){?>class="active" <?php }?>><?php echo anchor('gente/index', 'Home');?></li>
                            <li <?php if($menu == 'catalogo'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogos <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('gente/catalogo_productos', 'Productos');?></li>
                                    <li><?php echo anchor('gente/catalogo_sucursales', 'Sucursales');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'ventas'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('gente/venta_elige_periodo', 'Ventas');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'inv'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventarios <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('gente/reporte_inventario_producto', 'Por producto');?></li>
                                    <li><?php echo anchor('gente/reporte_inventario_clave', 'Por clave');?></li>
                                    <li><?php echo anchor('gente/reporte_inventario_sucursal_control', 'Por sucursal');?></li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'cortes'){?>class="dropdown active" <?php }else{?> class="dropdown"<?php }?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cortes <b class="caret"></b></a>                                
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor('gente/cortes_elige_periodo', 'Cortes');?></li>
                                </ul>
                            <li><?php echo anchor('login/logout', 'Cerrar Sesi&oacute;n');?></li>
                        </ul>
                        <?php
                        }
                        ?>
                        <!--
                        <form class="navbar-form pull-right">
                            <input class="span2" type="text" placeholder="# Nomina" />
                            <input class="span2" type="password" placeholder="Password" />
                            <button type="submit" class="btn">Entrar</button>
                        </form>
                        -->
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
