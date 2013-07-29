<div class="item-image">
                <div class="gallery clearfix" >
                    <div class="hidden">

<h1 align="center">TUTORIAL PARA ACTUALIZAR EL PUNTO DE VENTA</h1>

    <p style="color: red;">LA ACTUALIZACION DEL PUNTO DE VENTA SE TIENE QUE REALIZAR EN LA MA&Ntilde;ANA, ANTES DE REALIZAR CUALQUIER ACTIVIDAD EN EL PUNTO DE VENTA</p>
    <p style="color: red;">Nota: ESTA CONFIGURACI&Oacute;N ES EXCLUSIVAMENTE PARA EL PUNTO DE VENTA DE YUCIF. Antes de descargar el archivo eliminar EN EL ESCRITORIO cualquier archivo llamado &quot;pdv.zip&quot;. No vayan a eliminar el acceso directo con el que abren su pdv</p>

    <p align="justify">Hola en este tutorial le explicaremos paso a paso como ACTUALIZAR tu punto de venta.
    Descarga el archivo aqui:
    <?php
echo anchor('pdv/descarga_pdv', 'ARCHIVO PDV 18 DE FEBRERO 2013')?>.</p> 

<!--
<p>Tutorial para aprender a aplicar los descuentos cliente preferente:

<?php
echo anchor('pdv/descarga_tuto', 'Tutorial tarjeta preferente')?>.</p>
-->
<h2>Con el Mozilla Firefox</h2>
<p> Al darle click en la descarga del archivo te abre un recuadro como este y le das click en GUARDAR ARCHIVO: y lo guardamos en el escritorio</p>
<div align="center"><a href="<?php echo base_url();?>imagenes/pdv/fire.jpg" rel="gallery[gallery1]"><img height="200" width="320" src="<?php echo base_url();?>imagenes/pdv/fire.jpg"/></a></div>

<div align="center"><a href="<?php echo base_url();?>imagenes/pdv/fire1.jpg" rel="gallery[gallery1]"><img height="200" width="320" src="<?php echo base_url();?>imagenes/pdv/fire1.jpg"/></a></div><br />


<h2>&iquest;Como actualizar mi punto de venta?</h2><br />

    <p style="color: red;">Nota: RECUERDA CERRAR POR COMPLETO EL PUNTO DE VENTA DE YUCIF</p>

    <p align="justify">Localiza la ubicaci&oacute;n de tu archivo que descargaste.<br />
    Ya que lo localizaste este archivo lo vas a copiar en la siguiente ruta:
    </p><br />
    
    <p>Te vas a MI PC, luego a tu Disco local C, Carpeta PDV</p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv.jpg" rel="gallery[gallery1]"><img height="200" width="320" src="<?php echo base_url();?>imagenes/pdv/pdv.jpg"/></a></div>
    <p align="justify">Dentro de la carpeta PDV vas a pegar el alchivo que descargaste (pdv.zip). Al momento de pegarlo te va a salir una alerta de que el archivo ya existe que si deseas remplazarlo y le aprietas en el boton de aceptar, ya que pegamos y remplazamos el archivo cerramos la carpeta y abrimos el MS-DOS, para abrirlo nos vamos al menu de INICIO, PROGRAMAS, MS-DOS</p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv2.jpg" rel="gallery[gallery1]"><img height="300" width="320" src="<?php echo base_url();?>imagenes/pdv/pdv2.jpg"/></a></div>
    <p>Otra forma de abrirlo es ir al menu de INICIO, EJECUTAR y ahi escribimos la palabra command</p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv3.jpg" rel="gallery[gallery1]"><img height="200" width="320" src="<?php echo base_url();?>imagenes/pdv/pdv3.jpg"/></a></div>
    <p>Ya que nos abra el ms_dos escribimos lo siguiente
    <li>cd..</li>
    <li>ENTER</li></p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv4.jpg" rel="gallery[gallery1]"><img height="300" width="420" src="<?php echo base_url();?>imagenes/pdv/pdv4.jpg"/></a></div>
    <p>Escribimos lo siguiente
    <li>cd pdv</li>
    <li>ENTER</li></p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv5.jpg" rel="gallery[gallery1]"><img height="300" width="420" src="<?php echo base_url();?>imagenes/pdv/pdv5.jpg"/></a></div>
    <p>Escribimos lo siguiente
    <li>pkunzip pdv.zip</li>
    <li>ENTER</li></p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv6.jpg" rel="gallery[gallery1]"><img height="300" width="420" src="<?php echo base_url();?>imagenes/pdv/pdv6.jpg"/></a></div>
    <p>digitar la letra
    <li>a</li></p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv7.jpg" rel="gallery[gallery1]"><img height="300" width="420" src="<?php echo base_url();?>imagenes/pdv/pdv7.jpg"/></a></div>
    <p>Escribimos lo siguiente
    <li>actdbf</li>
    <li>ENTER</li><br />
    Y nos empieza a actualizar, al terminar la actualizaci&oacute;n ecribimos lo siguiente<br /><br />
    <li>exit</li><br />
    y se cierra el ms-dos. Ahora abrimos el punto de venta y tambien se empezara a actualizar y terminando de hacerlo checamos que la fecha de actualizaci&oacute;n nos indique 18 de FEBRERO y listo
    </p>
        

</div></div></div>
<script type="text/javascript">
        $(".gallery a[rel^='gallery']").prettyPhoto({
            animation_speed:'normal',
            theme:'pp_default',
            deeplinking:false,
            slideshow:3000
            });

		</script>