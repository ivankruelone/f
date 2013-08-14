      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
echo anchor('nacional/ventas', 'UTILIDAD', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>