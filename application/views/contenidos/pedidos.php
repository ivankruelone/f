<p><font size="+1"><?php 
$nivel = $this->session->userdata('nivel');

if($nivel==2){
echo '<p>Recuerda que al subir tu pedido este se filtra y desaparece las claves sin existencia en el almacen por eso no te aparecen todas las que capturaste, SI APARECE INFORMACION EN LA TABLA DE ABAJO eso indica que ya recibimos tu pedido y te lo confirma: Laura Garcia Perez EXT. 166</p>';
}
?></font></p>






<div align="center">
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<?php
   echo '<font size="+1" color="red">'.$titulo1.'</font>';
	echo $tabla;
?>

</div>
<script language="javascript" type="text/javascript">

$('a[id^="borra_pedido_"]').click(function(event){
   
   if(confirm('Estas seguro que deseas borrar este pedido??')){
    
   }else{
   event.preventDefault();
   }
    
});

</script>