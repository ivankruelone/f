
<p><strong><font size="+4"><?php 
$nivel = $this->session->userdata('nivel');

if($nivel==16){
echo $titulo;
}
?></font></strong></p>
<div align="center">
<?php

	echo $tabla;
?>
</div>