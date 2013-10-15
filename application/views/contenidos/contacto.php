<h1 style="color: red;" align="justify">IMPORTANTE: A TODAS LAS SUCURSALES SE LES INFORMA QUE EL NUEVO GERENTE NACIONAL ES EL ING. AGUSTIN ARZATE VILLEGAS SU CORREO ES: agustin.arzate@farfenix.com.mx   </h1>

<!--


<h1 style="color: red;" align="justify">TAMBIEN PUEDEN CAPTURAR SU INVENTARIO EL LINK SE LLAMA CAPTURA DE INVENTARIO Y ES UN RECTANGULO VERDE ESTA OPCION ES POR SI NO FUNCIONA SU PUNTO DE VENTA O NO TIENEN CPU (PARA QUE NO LO HAGAN EN EXEL)</h1>

<h1 style="color: red;" align="justify">IMPORTANTE: A LAS SUCURSALES QUE TRANSMITEN PEDIDO EL DIA DE HOY JUEVES 03 RECUERDEN QUE SU PEDIDO TIENE QUE SER DOBLE YA QUE NO SE LABORARA EL DIA 10 DE MAYO.</h1>

<h1 style="color: red;" align="justify">EL BOTON PARA CAPTURAR SU PEDIDO EN LA PAGINA SE ENCUENTRA EN EL MENU PEDIDOS</h1>

<h1 style="color: red;" align="justify">IMPORTANTE: A TODAS LAS SUCURSALES SE LES INFORMA QUE EL NUEVO GERENTE NACIONAL ES EL ING. AGUSTIN ARZATE VILLEGAS SU CORREO ES agustin.arzate@farfenix.com.mx   </h1>
<h1 style="color: red;" align="justify">IMPORTANTE: A TODAS LAS SUCURSALES, YA PUEDEN CONFIRMAR SU INVENTARIO Y SU PEDIDO EN EL MENU CORRESPONDIENTE A CADA UNO</h1>

<h1 style="color: red;" align="justify">IMPORTANTE: LA NUEVA DIRECCION PARA LA PAGINA DE TIEMPO AIRE ES: 201.151.238.60/comanche</h1>


<h1 align="center">DESCARGA DE ARCHIVO</h1>
<h2>1.-Cerrar el punto de venta<br />
    2.-Pegar el archivo que descargaste en la carpeta de PDV<br />
    3.-EJECUTARLO &quot;dandole doble click&quot;
</h2>
<div align="center">
<table>

    <thead>
        <tr>
        <th>ARCHIVO</th>
        <th>punto de venta</th>
        <th></th>
        </tr>
    </thead>

    <tbody>
        <tr>
        <td>
        CORREGIR INVENTARIO
        </td>
        <td>
        Yucif
        </td>
        <td>
        <?php echo anchor('contacto/descarga_memo', 'ARCHIVO PARA CORREGIR INVENTARIO')?>
        </td>
        </tr>
    </tbody>

</table>
-->

<!--

<h4>DESCARGA EL ARCHIVO PARA LA CORRECCION DEL INVENTARIO: </h4>

<p>
<?php
echo anchor('contacto/descarga_memo', 'ARCHIVO PARA CORREGIR INVENTARIO')?>.</p><br />
-->

<br /><br />
<h1 style="color: blue;" align="justify">YA NO ES NECESARIO ENVIAR REPORTE DE VENTAS, INVENTARIO Y CORTES. EN CASO DE NECESITAR ALGUN ARCHIVO SE LES LLAMARA A SU SUCURSAL.</h1> 
<!-- <h4 style="color: blank;" align="justify">IMPORTANTE: LAS CLAVES DE INVENTARIO DE GENERICOS  Y DR. DESCUENTO DEBEN DE SER  DE LA 1  A LA 885 MAS LA CLAVE 2000 , LAS SUCURSALES DE FARMABODEGA DE LA 1  A LA  8391 ....&iexcl;&iexcl;TRANSMITIR ANTES DE LAS 2:00!!</h4> -->
<?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
        
        
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            
            }else{

?>

<!--<p>Recuerda subir tu archivo correcto y directamente de tu CPU Y <span style="color: red;"> NO DE TU DISCO DE 3&frac12;</span> por que puede que no lo suba, y tambi&eacute;n es importante utilizar el navegador Mozilla Firefox</p>-->

<!-- <h2>Enviar su Archivo</h2> -->

<div style="margin-bottom: 40px;">
        <span id="upload_button">Da click aqui para seleccionar un archivo para envio.</span>
        
</div>          
        <span id="archivo">
        </span>
        


<br /><br />

        <?php
	}
?>

<script language="javascript" type="text/javascript"> 


	var button = $('#upload_button'), interval;

	new AjaxUpload('#upload_button', {

        action: '<?php echo site_url();?>/contacto/upload',

		onSubmit : function(file , ext){

		if (! (ext && /^(zip|pge|inv|xls|xlsx|doc|docx|txt|pdf|rar|crt|en|dbf|td)$/.test(ext))){

			// extensiones permitidas

			alert('Error: Solo se permiten .pge, .inv, .dbf, .zip, .xls, .xlsx, .doc, .docx, .txt, .crt, .en');

			// cancela upload

			return false;

		} else {

			button.text('Subiendo el  archivo. Espere un momento por favor.....');

			this.disable();

		}

		},

		onComplete: function(file, response){

			button.text('Da click aqui para seleccionar un arhivo para envio.');

			// enable upload button

			this.enable();

			// Agrega archivo a la lista

			$('#archivo').append(response);

			//$('#imagen_alt').val(file);

		}

	});


</script>
   
        
<div align="center">
<iframe src="https://www.google.com/calendar/embed?mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=desarrollo.fenix%40gmail.com&amp;color=%23182C57&amp;src=es.mexican%23holiday%40group.v.calendar.google.com&amp;color=%23691426&amp;ctz=America%2FMexico_City" style=" border-width:0 " width="600" height="600" frameborder="0" scrolling="no"></iframe>
</div>