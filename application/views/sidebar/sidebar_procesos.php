<div class="sidebar">
      
      <?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

        if($nivel==33){
        echo anchor('procesos/tabla_catalogo_rh', 'CATALOGO', 'class="button-link green"');
        echo ('<br /><br />');
            
        }
        if($nivel>0 and $nivel<>33){
            
        
        echo ('<h2>DIF. PROCESOS</h2>');
        echo ('<br />');
        echo anchor('procesos/formulario_nilsen', 'NILSEN', 'class="button-link green"');
        echo ('<br />');
        echo anchor('compara/tabla_control', 'compara', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_noblock', 'NOBLOCK', 'class="button-link blue"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_almacen', 'POL.ALMACEN', 'class="button-link green"');
        echo ('<br /><br />');
        
        echo anchor('procesos/tabla_catalogo', 'CATALOGO', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/tabla_catalogo_pdv', 'CATALOGO_PDV', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_vtas_diarias', 'VENTAS DIARIAS', 'class="button-link red"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_vtas_direccion', 'VENTAS DIRECCION', 'class="button-link green"');
        echo ('<br /><br />');
        
        echo anchor('procesos/tabla_pedidos_formulados', 'PEDIDOS FORMULADOS', 'class="button-link blue"');
        echo ('<br /><br />');
        echo anchor('procesos/tabla_pedidos_formulados_una', 'PEDIDOS FORMULADOS UNA', 'class="button-link blue"');
        echo ('<br /><br />');
        
        echo anchor('procesos/concentrado_ped_sur', 'CONCENTRADO DE PEDIDOS', 'class="button-link blue"');
         echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo ('<br /><br />');
        echo anchor('procesos/tabla_orden_cedis', 'PREVIO ORDEN DE COMPRAS', 'class="button-link red"');
        echo ('<br /><br />');
        echo anchor('procesos/factura_nadro_e', 'procesos nadro', 'class="button-link red"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo', 'Facturas', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo', 'Poliza Inventario', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo2', 'Envio de Poliza', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo1', 'Ventas', 'class="button-link green"');
        echo ('<br /><br />');
        
       
        echo anchor('procesos/formulario_completo1', 'NOBLOCK', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo', 'ISM', 'class="button-link green"');
        echo ('<br /><br />');
        }

      ?>
<br /><br />

<?php
	$this->load->view('sidebar/login');
?>


      </div>