<div class="sidebar">

<?php
	$this->load->view('sidebar/login');
?>


<div>
        <!-- insert your sidebar items here -->
        <h4>Busqueda Sucursal</h4>
          <p>
            <input class="search" type="text" name="search_field" id="search_field" placeholder="Teclea palabra de busqueda"/>
          </p>
          <?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
            $nivel = $this->session->userdata('nivel');
        
        
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6' && $nivel == 16){
            
            }else{

?>
          
          <h4>Busqueda del Personal<br /> de Oficina y Supervisores</h4>
          <p>
            <input class="search" type="text" name="search_field1" id="search_field1" placeholder="Teclea palabra de busqueda"/>
          </p>
<?php
	}
?>
</div>    
  <div id="map_canvas" style="float:left;width:100%; height:200px; margin-top: 15px;"></div>
  
  
      </div>