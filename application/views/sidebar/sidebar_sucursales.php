      <div class="sidebar">
<?php
	$this->load->view('sidebar/login');
?>


      <div id="sidebar_busqueda">
        <!-- insert your sidebar items here -->
        <h4>Busqueda</h4>
          <p>
            <input class="search" type="text" name="search_field" id="search_field" placeholder="Teclea Nombre o No. de la sucursal"/>
          </p>

        <h4>Por Codigo Postal:</h4>
        <?php
        
        $data_cp = array(
              'name'        => 'cp',
              'id'          => 'cp',
              'type'        => 'number'
            );

        echo form_input($data_cp);
        ?>
        <button id="cp_boton" onclick="tabla_cp();">Buscar</button>
        
        <h4>Por Estado y Municipio:</h4>
        <?php
        
        echo form_dropdown('edo', $estados, '', 'id="edo"');
        ?>
        <select name="municipio" id="municipio"></select>
        <br /><br />
        <!--
        <button id="undo" onclick="undo()">Buscar</button>
        -->
        
                  <?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
        
        
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            
            }else{

?>
        

        <?php
	}
?>
        
        <div id="imagen" style="width: 100%; margin-top: 15px; margin-bottom: 15px;"></div>
        <div id="datos" style="width: 100%; margin-top: 15px; margin-bottom: 15px;"></div>
    </div>
    <div id="instrucciones">
    <button id="reset" onclick="reset();">Resetear</button>
    <div id="origen_destino"></div>
    </div>
      </div>