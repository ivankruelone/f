<div class="item-image">
                <div class="gallery clearfix" >
                    <div class="hidden">

<h1 align="center">TUTORIAL PARA REIMPRIMIR TICKETS EN EL PUNTO DE VENTA</h1>

    
    <p style="color: red;">Nota: ESTA CONFIGURACI&Oacute;N ES EXCLUSIVAMENTE PARA EL PUNTO DE VENTA DE YUCIF.</p>

    <p align="justify">Hola en este tutorial le explicaremos paso a paso LA SOLUCION PARA REIMPRIMIR TICKETS EN EL PUNTO DE VENTA.
    Descarga el archivo aqui:
    <?php
echo anchor('pdv1/descarga_archivo', 'ARCHIVO ADBFTCP.EXE')?>.</p> 

<p align="justify">
<li>1.- CERRAR COMPLETAMENTE EL PUNTO DE VENTA</li><br />
<li>2.- DALE DOBLE CLIK AL ARCHIVO QUE DESCARGASTE (BUSCALO EN TU ESCRITORIO) EL ARCHIVO SE LLAMA: ADBFTCP.EXE</li><br />

<div align="center"><a href="<?php echo base_url();?>imagenes/pdv/archivor.jpg" rel="gallery[gallery1]"><img height="100" width="150" src="<?php echo base_url();?>imagenes/pdv/archivor.jpg"/></a></div><br />

<li>3.- Abrimos el MS-DOS, para abrirlo nos vamos al menu de INICIO, PROGRAMAS, MS-DOS</li><br /></p>

<div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv2.jpg" rel="gallery[gallery1]"><img height="300" width="320" src="<?php echo base_url();?>imagenes/pdv/pdv2.jpg"/></a></div><br />
    <p>Otra forma de abrirlo es ir al menu de INICIO, EJECUTAR y ahi escribimos la palabra command</p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv3.jpg" rel="gallery[gallery1]"><img height="200" width="320" src="<?php echo base_url();?>imagenes/pdv/pdv3.jpg"/></a></div>
    <p>Ya que nos abra el MS-DOS escribimos lo siguiente:
    <li>cd..</li>
    <li>OPRIME TECLA ENTER</li></p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv4.jpg" rel="gallery[gallery1]"><img height="300" width="420" src="<?php echo base_url();?>imagenes/pdv/pdv4.jpg"/></a></div><br />
    <p>Escribimos lo siguiente:
    <li>cd pdv</li>
    <li>OPRIME TECLA ENTER</li></p>
        <div align="center"><a href="<?php echo base_url();?>imagenes/pdv/pdv5.jpg" rel="gallery[gallery1]"><img height="300" width="420" src="<?php echo base_url();?>imagenes/pdv/pdv5.jpg"/></a></div><br />
    <p>Escribimos lo siguiente: 
    <li> ACTDBF </li> 
    <li> OPRIME TECLA ENTER </li></p>
    
    <p>Empezara a correr un cronometro y al finalizar cerramos el MS-DOS de la siguiente manera, escribimos la palabra:</p>
    <li>exit</li>
    <li>OPRIME TECLA ENTER</li>
    
    <p>Listo ahora intenta reimprimir tus tickets</p>
    