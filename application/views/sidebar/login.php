<div id="login" style="margin-bottom: 15px;">
<?php
    $is_logged_in = $this->session->userdata('is_logged_in');
    
    
    if($is_logged_in == 0){

?>



<h2 style="font-size: 18px;">login</h2>
<?php
    echo form_open('login/validate_credentials');	
?>
<label>Usuario: </label>
<br />
<?php
$data = array(
              'name'        => 'username',
              'id'          => 'username',
              'maxlength'   => '20',
              'size'        => '20',
              'type'        => 'text',
              'required'    => 'required',
			  'autocomplete' => 'off'
            );

echo form_input($data);	
?>
<br />
<label>Password: </label>
<br />
<?php
$data1 = array(
              'name'        => 'password',
              'id'          => 'password',
              'maxlength'   => '20',
              'size'        => '20',
              'type'        => 'password',
              'required'    => 'required'
            );

echo form_input($data1);	
?>
<div align="left" style="margin-top: 10px; margin-bottom: 10px;">
<?php
    echo form_submit('envio', 'Entrar al Sistema', 'class="button-link blue"');
	echo form_close();
?>
</div>
<?php
	}else{
       echo "<br/>";
	   echo $this->session->userdata('nombre')."<br />";
	   echo $this->session->userdata('puesto')."<br />";
	   echo $this->session->userdata('email')."<br />";
	   echo $this->session->userdata('suc')."<br />";
	   echo $this->session->userdata('nom_suc')."<br />";
	   echo $this->session->userdata('plaza_nombre')."<br />";
       echo '<div align="left" style="margin-top: 10px; margin-bottom: 10px;">';
       echo anchor('login/logout', 'CERRAR SESSION', 'class="button-link blue"');
       echo '</div>';
       
	}
?>

</div>