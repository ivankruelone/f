<h1><?php echo $titulo;?></h1>
<?php
    $atributos = array('id' => '#devolucion');
	echo form_open('a_devolucion/reporte_diario_submit');
    echo "<br />";

    $data1 = array(
              'name'        => 'fecha1',
              'id'          => 'fecha1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );
    echo form_label('Fecha Inicial: ', 'fecha1');
    echo form_input($data1);
    $data2 = array(
              'name'        => 'fecha2',
              'id'          => 'fecha2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );

    echo form_label(' Fecha Final: ', 'fecha2');
    echo form_input($data2);
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>



  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fec1").focus();
    });
    
    $(document).ready(function(){
    
    $('#fecha1').datepicker();
    $('#fecha2').datepicker();
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#devolucion').submit(function() {
        var fecha1 = $('#fecha1').attr("value").length;
        var fecha2 = $('#fecha2').attr("value").length;
        
          if(fecha1 == 10 && fec2 == 10){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#usuario').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>

