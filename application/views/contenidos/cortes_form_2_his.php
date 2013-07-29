  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cortes_form_2_his');
    echo form_open('cortes/actualiza_d_corte', $atributos);
     $data_1 = array(
              'name'        => 'l1',
              'id'          => 'l1',
              'value'       => $venta1,
              'type'        =>'number',
              
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_2 = array(
              'name'        => 'l2',
              'id'          => 'l2',
              'value'       => $venta2,
              'type'        =>'number',
              'maxlength'   => '20',
             
              'size'        => '10'
  );            
     $data_4 = array(
              'name'        => 'l4',
              'id'          => 'l4',
              'value'       => $venta4,
              'type'        =>'number',
              'maxlength'   => '20',
             
              'size'        => '10'
  );            
     $data_5 = array(
              'name'        => 'l5',
              'id'          => 'l5',
              'value'       => $venta5,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );            
           
     $data_8 = array(
              'name'        => 'l8',
              'id'          => 'l8',
              'value'       => $venta8,
              'type'        =>'number',
             
              'maxlength'   => '20',
              'size'        => '10'
  );            
      $data_9 = array(
              'name'        => 'l9',
              'id'          => 'l9',
              'value'       => $venta9,
              'type'        =>'number',
             
              'maxlength'   => '20',
              'size'        => '10'
  );            
     $data_10 = array(
              'name'        => 'l10',
              'id'          => 'l10',
              'value'       => $venta10,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );
    $data_11 = array(
              'name'        => 'l11',
              'id'          => 'l11',
              'value'       => $venta11,
              'type'        =>'number',
              
              'maxlength'   => '20',
              'size'        => '10'
  );             
     $data_12 = array(
              'name'        => 'l12',
              'id'          => 'l12',
              'value'       => $venta12,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );            
     $data_13 = array(
              'name'        => 'l13',
              'id'          => 'l13',
              'value'       => $venta13,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );            
     $data_16 = array(
              'name'        => 'l16',
              'id'          => 'l16',
              'value'       => $venta16,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );
     $data_19 = array(
              'name'        => 'l19',
              'id'          => 'l19',
              'value'       => $venta19,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );            
            
     $data_20 = array(
              'name'        => 'l20',
              'id'          => 'l20',
              'value'       => $venta20,
              'type'        =>'number',
              'maxlength'   => '20',
             
              'size'        => '10'
  );            
     $data_21 = array(
              'name'        => 'l21',
              'id'          => 'l21',
              'value'       => $venta21,
              'type'        =>'number',
              'maxlength'   => '20',
            
              'size'        => '10'
  );            
     $data_22 = array(
              'name'        => 'l22',
              'id'          => 'l22',
              'value'       => $venta22,
              'type'        =>'number',
              'maxlength'   => '20',
             
              'size'        => '10'
  );            
     $data_23 = array(
              'name'        => 'l23',
              'id'          => 'l23',
              'value'       => $venta23,
              'type'        =>'number',
              'maxlength'   => '20',
            
              'size'        => '10'
  );            
     $data_24 = array(
              'name'        => 'l24',
              'id'          => 'l24',
              'value'       => $venta24,
              'type'        =>'number',
              'maxlength'   => '20',
              
              'size'        => '10'
  );            

     $data_30 = array(
              'name'        => 'l30',
              'id'          => 'l30',
              'value'       => $venta30,
              'type'        =>'number',
              'maxlength'   => '20',
             
              'size'        => '10'
  );
  
     $data_40 = array(
              'name'        => 'l40',
              'id'          => 'l40',
              'value'       => $venta40,
              'type'        =>'number',
              'maxlength'   => '20',
             
              'size'        => '10'
  );            
 ////////////////////////////////////////////////////////////////////////////////////////
    $data_c1 = array(
              'name'        => 'lc1',
              'id'          => 'lc1',
              'value'       => $cancel1,
              'type'        =>'number',
             
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_c2 = array(
              'name'        => 'lc2',
              'id'          => 'lc2',
              'value'       => $cancel2,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c4 = array(
              'name'        => 'lc4',
              'id'          => 'lc4',
              'value'       => $cancel4,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c5 = array(
              'name'        => 'lc5',
              'id'          => 'lc5',
              'value'       => $cancel5,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
           
     $data_c8 = array(
              'name'        => 'lc8',
              'id'          => 'lc8',
              'value'       => $cancel8,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
      $data_c9 = array(
              'name'        => 'lc9',
              'id'          => 'lc9',
              'value'       => $cancel9,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            
     $data_c10 = array(
              'name'        => 'lc10',
              'id'          => 'lc10',
              'value'       => $cancel10,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );
     $data_c11 = array(
              'name'        => 'lc11',
              'id'          => 'lc11',
              'value'       => $cancel11,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c12 = array(
              'name'        => 'lc12',
              'id'          => 'lc12',
              'value'       => $cancel12,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            
     $data_c13 = array(
              'name'        => 'lc13',
              'id'          => 'lc13',
              'value'       => $cancel13,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c16 = array(
              'name'        => 'lc16',
              'id'          => 'lc16',
              'value'       => $cancel16,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );
     $data_c19 = array(
              'name'        => 'lc19',
              'id'          => 'lc19',
              'value'       => $cancel19,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c20 = array(
              'name'        => 'lc20',
              'id'          => 'lc20',
              'value'       => $cancel20,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c21 = array(
              'name'        => 'lc21',
              'id'          => 'lc21',
              'value'       => $cancel21,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            
     $data_c22 = array(
              'name'        => 'lc22',
              'id'          => 'lc22',
              'value'       => $cancel22,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            
     $data_c23 = array(
              'name'        => 'lc23',
              'id'          => 'lc23',
              'value'       =>$cancel23,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );            
     $data_c24 = array(
              'name'        => 'lc24',
              'id'          => 'lc24',
              'value'       =>$cancel24,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            

     $data_c30 = array(
              'name'        => 'lc30',
              'id'          => 'lc30',
              'value'       => $cancel30,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );
      $data_c40 = array(
              'name'        => 'lc40',
              'id'          => 'lc40',
              'value'       => $cancel40,
              'type'        =>'number',
              'maxlength'   => '10',
              
              'size'        => '10'
  );
  ///////////////////////////////////////////////////////////////////////////////////
      $data_a1 = array(
              'name'        => 'la1',
              'id'          => 'la1',
              'value'       => $aumento1,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            
     $data_a2 = array(
              'name'        => 'la2',
              'id'          => 'la2',
              'value'       => $aumento2,
              'type'        =>'number',
              'maxlength'   => '10',
             
              'size'        => '10'
  );            
   $data_a4 = array(
              'name'        => 'la4',
              'id'          => 'la4',
              'value'       => $aumento4,
              'type'        =>'number',
              'maxlength'   => '10',
  
              'size'        => '10'
  );            
     $data_a5 = array(
              'name'        => 'la5',
              'id'          => 'la5',
              'value'       => $aumento5,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
           
     $data_a8 = array(
              'name'        => 'la8',
              'id'          => 'la8',
              'value'       => $aumento8,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
      $data_a9 = array(
              'name'        => 'la9',
              'id'          => 'la9',
              'value'       => $aumento9,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a10 = array(
              'name'        => 'la10',
              'id'          => 'la10',
              'value'       => $aumento10,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );
     $data_a11 = array(
              'name'        => 'la11',
              'id'          => 'la11',
              'value'       => $aumento11,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a12 = array(
              'name'        => 'la12',
              'id'          => 'la12',
              'value'       => $aumento12,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a13 = array(
              'name'        => 'la13',
              'id'          => 'la13',
              'value'       => $aumento13,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a16 = array(
              'name'        => 'la16',
              'id'          => 'la16',
              'value'       => $aumento16,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );
     $data_a19 = array(
              'name'        => 'la19',
              'id'          => 'la19',
              'value'       => $aumento19,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a20 = array(
              'name'        => 'la20',
              'id'          => 'la20',
              'value'       => $aumento20,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a21 = array(
              'name'        => 'la21',
              'id'          => 'la21',
              'value'       => $aumento21,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a22 = array(
              'name'        => 'la22',
              'id'          => 'la22',
              'value'       => $aumento22,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a23 = array(
              'name'        => 'la23',
              'id'          => 'la23',
              'value'       =>$aumento23,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            
     $data_a24 = array(
              'name'        => 'la24',
              'id'          => 'la24',
              'value'       =>$aumento24,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );            

     $data_a30 = array(
              'name'        => 'la30',
              'id'          => 'la30',
              'value'       => $aumento30,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );

     $data_a40 = array(
              'name'        => 'la40',
              'id'          => 'la40',
              'value'       => $aumento40,
              'type'        =>'number',
              'maxlength'   => '10',
              'size'        => '10'
  );             
 ////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
$data_turno1_cajera = array(
              'name'        => 'turno1_cajera',
              'id'          => 'turno1_cajera',
              'value'       => $turno1_cajera,
              'maxlength'   => '13',
              'size'        => '10'
              
            );
$data_turno1_pesos = array(
              'name'        => 'turno1_pesos',
              'id'          => 'turno1_pesos',
              'value'       => $turno1_pesos,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno1_dolar = array(
              'name'        => 'turno1_dolar',
              'id'          => 'turno1_dolar',
              'value'       => $turno1_dolar,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno1_cambio = array(
              'name'        => 'turno1_cambio',
              'id'          => 'turno1_cambio',
              'value'       => $turno1_cambio,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_bbv = array(
              'name'        => 'turno1_bbv',
              'id'          => 'turno1_bbv',
              'value'       => $turno1_bbv,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_san = array(
              'name'        => 'turno1_san',
              'id'          => 'turno1_san',
              'value'       => $turno1_san,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_exp = array(
              'name'        => 'turno1_exp',
              'id'          => 'turno1_exp',
              'value'       => $turno1_exp,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_asalto = array(
              'name'        => 'turno1_asalto',
              'id'          => 'turno1_asalto',
              'value'       => $turno1_asalto,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_vale = array(
              'name'        => 'turno1_vale',
              'id'          => 'turno1_vale',
              'value'       => $turno1_vale,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno1_corte = array(
              'name'        => 'turno1_corte',
              'id'          => 'turno1_corte',
              'value'       => $turno1_corte,
              'maxlength'   => '13',
              'size'        => '10'
            );
$data_turno2_cajera = array(
              'name'        => 'turno2_cajera',
              'id'          => 'turno2_cajera',
              'value'       => $turno2_cajera,
              'maxlength'   => '13',
              'size'        => '10'
              
            );
$data_turno2_pesos = array(
              'name'        => 'turno2_pesos',
              'id'          => 'turno2_pesos',
              'value'       => $turno2_pesos,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno2_dolar = array(
              'name'        => 'turno2_dolar',
              'id'          => 'turno2_dolar',
              'value'       => $turno2_dolar,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno2_cambio = array(
              'name'        => 'turno2_cambio',
              'id'          => 'turno2_cambio',
              'value'       => $turno2_cambio,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_bbv = array(
              'name'        => 'turno2_bbv',
              'id'          => 'turno2_bbv',
              'value'       => $turno2_bbv,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_san = array(
              'name'        => 'turno2_san',
              'id'          => 'turno2_san',
              'value'       => $turno2_san,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_exp = array(
              'name'        => 'turno2_exp',
              'id'          => 'turno2_exp',
              'value'       => $turno2_exp,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_asalto = array(
              'name'        => 'turno2_asalto',
              'id'          => 'turno2_asalto',
              'value'       => $turno2_asalto,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_vale = array(
              'name'        => 'turno2_vale',
              'id'          => 'turno2_vale',
              'value'       => $turno2_vale,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno2_corte = array(
              'name'        => 'turno2_corte',
              'id'          => 'turno2_corte',
              'value'       => $turno2_corte,
              'maxlength'   => '13',
              'size'        => '10'
            );
$data_turno3_cajera = array(
              'name'        => 'turno3_cajera',
              'id'          => 'turno3_cajera',
              'value'       => $turno3_cajera,
              'maxlength'   => '13',
              'size'        => '10'
              
            );

$data_turno3_pesos = array(
              'name'        => 'turno3_pesos',
              'id'          => 'turno3_pesos',
              'value'       => $turno3_pesos,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno3_dolar = array(
              'name'        => 'turno3_dolar',
              'id'          => 'turno3_dolar',
              'value'       => $turno3_dolar,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno3_cambio = array(
              'name'        => 'turno3_cambio',
              'id'          => 'turno3_cambio',
              'value'       => $turno3_cambio,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_bbv = array(
              'name'        => 'turno3_bbv',
              'id'          => 'turno3_bbv',
              'value'       => $turno3_bbv,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_san = array(
              'name'        => 'turno3_san',
              'id'          => 'turno3_san',
              'value'       => $turno3_san,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_exp = array(
              'name'        => 'turno3_exp',
              'id'          => 'turno3_exp',
              'value'       => $turno3_exp,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_asalto = array(
              'name'        => 'turno3_asalto',
              'id'          => 'turno3_asalto',
              'value'       => $turno3_asalto,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_vale = array(
              'name'        => 'turno3_vale',
              'id'          => 'turno3_vale',
              'value'       => $turno3_vale,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno3_corte = array(
              'name'        => 'turno3_corte',
              'id'          => 'turno3_corte',
              'value'       => $turno3_corte,
              'maxlength'   => '13',
              'size'        => '10'
            );
$data_turno4_cajera = array(
              'name'        => 'turno4_cajera',
              'id'          => 'turno4_cajera',
              'value'       => $turno4_cajera,
              'maxlength'   => '13',
              'size'        => '10'
              
            );

$data_turno4_pesos = array(
              'name'        => 'turno4_pesos',
              'id'          => 'turno4_pesos',
              'value'       => $turno4_pesos,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno4_dolar = array(
              'name'        => 'turno4_dolar',
              'id'          => 'turno4_dolar',
              'value'       => $turno4_dolar,
              'maxlength'   => '10',
              'size'        => '10'
              
            );
$data_turno4_cambio = array(
              'name'        => 'turno4_cambio',
              'id'          => 'turno4_cambio',
              'value'       => $turno4_cambio,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_bbv = array(
              'name'        => 'turno4_bbv',
              'id'          => 'turno4_bbv',
              'value'       => $turno4_bbv,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_san = array(
              'name'        => 'turno4_san',
              'id'          => 'turno4_san',
              'value'       => $turno4_san,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_exp = array(
              'name'        => 'turno4_exp',
              'id'          => 'turno4_exp',
              'value'       => $turno4_exp,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_asalto = array(
              'name'        => 'turno4_asalto',
              'id'          => 'turno4_asalto',
              'value'       => $turno4_asalto,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_vale = array(
              'name'        => 'turno4_vale',
              'id'          => 'turno4_vale',
              'value'       => $turno4_vale,
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_turno4_corte = array(
              'name'        => 'turno4_corte',
              'id'          => 'turno4_corte',
              'value'       => $turno4_corte,
              'maxlength'   => '15',
              'size'        => '10'
            );

//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

  ?>
<input type="hidden" value="<?php echo $recarga?>" name="recarga"  id="recarga" />
<div id="cortes" style="width: 600px; float: left;"> 
<table>
<tr>
<th colspan="4"><font size="+1"><?php echo $sucursal ."___";?> FECHA.: <?php echo $fechac;?></font></th>
</tr>
<tr>
    <th>LINEA</th>
	<th>VENTA</th>
    <th>CANCELA</th>
    <th>AUMENTA</th>
</tr>    
<tr>
    <td>001-PATENTE: </td>
	<td><?php echo form_input($data_1, "", 'required');?></td>
    <td><?php echo form_input($data_c1, "", 'required');?></td>
    <td><?php echo form_input($data_a1, "", 'required');?></td>
</tr>
<tr>
    <td>002-PERFUMERIA: </td>
	<td><?php echo form_input($data_2, "", 'required');?></td>
    <td><?php echo form_input($data_c2, "", 'required');?></td>
    <td><?php echo form_input($data_a2, "", 'required');?></td>
</tr>

<tr>
    <td>004-LECHES: </td>
	<td><?php echo form_input($data_4, "", 'required');?></td>
    <td><?php echo form_input($data_c4, "", 'required');?></td>
    <td><?php echo form_input($data_a4, "", 'required');?></td>
</tr>
<tr>
    <td>005-ACCESORIOS: </td>
	<td><?php echo form_input($data_5, "", 'required');?></td>
    <td><?php echo form_input($data_c5, "", 'required');?></td>
    <td><?php echo form_input($data_a5, "", 'required');?></td>
</tr>

<tr>
    <td>008-ABARROTES TASA 0: </td>
	<td><?php echo form_input($data_8, "", 'required');?></td>
    <td><?php echo form_input($data_c8, "", 'required');?></td>
    <td><?php echo form_input($data_a8, "", 'required');?></td>
</tr>
<tr>
    <td>009-ABARROTES GRABADOS: </td>
	<td><?php echo form_input($data_9, "", 'required');?></td>
    <td><?php echo form_input($data_c9, "", 'required');?></td>
    <td><?php echo form_input($data_a9, "", 'required');?></td>
</tr>
<tr>
    <td>010-PATENTE GONTOR: </td>
	<td><?php echo form_input($data_10, "", 'required');?></td>
    <td><?php echo form_input($data_c10, "", 'required');?></td>
    <td><?php echo form_input($data_a10, "", 'required');?></td>
</tr>
<tr>
    <td>011-PERFUMERIA GONTOR: </td>
	<td><?php echo form_input($data_11, "", 'required');?></td>
    <td><?php echo form_input($data_c11, "", 'required');?></td>
    <td><?php echo form_input($data_a11, "", 'required');?></td>
</tr>
<tr>
    <td>012-O.T.C: </td>
	<td><?php echo form_input($data_12, "", 'required');?></td>
    <td><?php echo form_input($data_c12, "", 'required');?></td>
    <td><?php echo form_input($data_a12, "", 'required');?></td>
</tr>
<tr>
    <td>013-PROM. PATENTE: </td>
	<td><?php echo form_input($data_13, "", 'required');?></td>
    <td><?php echo form_input($data_c13, "", 'required');?></td>
    <td><?php echo form_input($data_a13, "", 'required');?></td>
</tr>
<tr>
    <td>016-PATENTE IMPERIAL: </td>
	<td><?php echo form_input($data_16, "", 'required');?></td>
    <td><?php echo form_input($data_c16, "", 'required');?></td>
    <td><?php echo form_input($data_a16, "", 'required');?></td>
</tr>
<tr>
    <td>019-FOTOGRAFIA: </td>
	<td><?php echo form_input($data_19, "", 'required');?></td>
    <td><?php echo form_input($data_c19, "", 'required');?></td>
    <td><?php echo form_input($data_a19, "", 'required');?></td>
    <th align="center" colspan="3"><font size="+1" color="white">TOTALES</font></th>
</tr>
<tr>
    <td>020-RECARGA TIEMPO AIRE: </td>
	<td><?php echo form_input($data_20, "", 'required');?></td>
    <td><?php echo form_input($data_c20, "", 'required');?></td>
    <td><?php echo form_input($data_a20, "", 'required');?></td>
    <td align="left" colspan="2"><font size="+1" color="blue">TIEMPO AIRE</font></td>
    <td align="right" colspan="2"><font size="+1" color="blue"><?php echo $recarga?></font></td>
</tr>
<tr>
    <td>021-JUGOS Y REFRESCOS: </td>
	<td><?php echo form_input($data_21, "", 'required');?></td>
    <td><?php echo form_input($data_c21, "", 'required');?></td>
    <td><?php echo form_input($data_a21, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">Suma lineas</font></td>
    <td align="right"><font size="+2" color="maroon"><span id="suma1"></span></font></td>
</tr>
<tr>
    <td>022-HELADOS HOLANDA: </td>
	<td><?php echo form_input($data_22, "", 'required');?></td>
    <td><?php echo form_input($data_c22, "", 'required');?></td>
    <td><?php echo form_input($data_a22, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">Corte de Caja</font></td>
    <td align="right"><font size="+2" color="maroon"><span id="corte"></span></font></td>
</tr>
<tr>
    <td>023-DULCES Y BOTANAS: </td>
	<td><?php echo form_input($data_23, "", 'required');?></td>
    <td><?php echo form_input($data_c23, "", 'required');?></td>
    <td><?php echo form_input($data_a23, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">Entrega Cajera</font></td>
    <td align="right"><font size="+2" color="maroon"><span id="arqueo"></span></font></td>
</tr>
<tr>
    <td>024-PATENTE COMERCIAL: </td>
	<td><?php echo form_input($data_24, "", 'required');?></td>
    <td><?php echo form_input($data_c24, "", 'required');?></td>
    <td><?php echo form_input($data_a24, "", 'required');?></td>
    <td align="left"  colspan="2"></td>
    <td align="left"  colspan="2"></td>
</tr>
<tr>
    <td>030-VENTA CREDITO: </td>
	<td><?php echo form_input($data_30, "", 'required');?></td>
    <td><?php echo form_input($data_c30, "", 'required');?></td>
    <td><?php echo form_input($data_a30, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="maroon">CORTE vs LINEAS</font></td>
    <td align="right"><font size="+2" color="maroon" ><span id="dif"></span></font></td>
</tr>
<tr>
    <td>040-CREDITO PERSONAL: </td>
	<td><?php echo form_input($data_40, "", 'required');?></td>
    <td><?php echo form_input($data_c40, "", 'required');?></td>
    <td><?php echo form_input($data_a40, "", 'required');?></td>
    <td align="left"  colspan="2"><font size="+1" color="green">Iva Desglosado</font></td>
    <td align="right"><font size="+2" color="green"><span id="totiva"></span></font></td>
</tr>
</div>


<div id="control" style="width: 500px; float: left;">
<tr>
    <th></th>
    <th>TURNO 1</th>
    <th>TURNO 2</th>
    <th>TURNO 3</th>
    <th>TURNO 4</th>
</tr>
<tr>
    <td>000-CAJERA: </td>
    <td><?php echo form_input($data_turno1_cajera, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_cajera, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_cajera, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_cajera, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>050-MONEDA NACIONAL: </td>
    <td><?php echo form_input($data_turno1_pesos, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_pesos, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_pesos, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_pesos, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>064-TARJETA BBV: </td>
    <td><?php echo form_input($data_turno1_bbv, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_bbv, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_bbv, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_bbv, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>066-TARJETA SANTANDER: </td>
    <td><?php echo form_input($data_turno1_san, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_san, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_san, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_san, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>062-TARJETA AMERICAN EXPRESS: </td>
    <td><?php echo form_input($data_turno1_exp, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_exp, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_exp, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_exp, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>000-VALES DE DESPENSA: </td>
    <td><?php echo form_input($data_turno1_vale, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_vale, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_vale, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_vale, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>080-DOLAR: </td>
    <td><?php echo form_input($data_turno1_dolar, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_dolar, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_dolar, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_dolar, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>081-TIPO DE CAMBIO: </td>
    <td><?php echo form_input($data_turno1_cambio, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_cambio, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_cambio, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_cambio, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
    <td>000-ASALTO: </td>
    <td><?php echo form_input($data_turno1_asalto, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_asalto, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_asalto, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_asalto, "", 'required');?><span id="mensaje"></span></td>
<tr>
<tr>
    <td>091-TOTAL VENTAS (CORTE): </td>
    <td><?php echo form_input($data_turno1_corte, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno2_corte, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno3_corte, "", 'required');?><span id="mensaje"></span></td>
    <td><?php echo form_input($data_turno4_corte, "", 'required');?><span id="mensaje"></span></td>
<tr>
<tr>
    <td>092-FALTANTE: </td>
    <td align="right"><font size="+2" color="red"><span id="fal1"></span></font></td>
    <td align="right"><font size="+2" color="red"><span id="fal2"></span></font></td>
    <td align="right"><font size="+2" color="red"><span id="fal3"></span></font></td>
    <td align="right"><font size="+2" color="red"><span id="fal4"></span></font></td>
    
<tr>
<tr>
    <td>093-SOBRANTE: </td>
    <td align="right"><font size="+2" color="green"><span id="sob1"></span></font></td>
    <td align="right"><font size="+2" color="green"><span id="sob2"></span></font></td>
    <td align="right"><font size="+2" color="green"><span id="sob3"></span></font></td>
    <td align="right"><font size="+2" color="green"><span id="sob4"></span></font></td>
<tr>
	<td colspan="5"align="center"><?php echo form_submit('envio', 'CORTE');?></td>
</tr>
</tr>
</table>
</div>





<input type="hidden" value="<?php echo $id_cc?>" name="id_cc"  id="id_cc" />
<input type="hidden" value="<?php echo $fec?>" name="fec"  id="fec" />
<input type="hidden" value="<?php echo $suc?>" name="suc"  id="suc" />
<input type="hidden" value="<?php echo $iva?>" name="iva"  id="iva" />

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#l1").focus();
    });
    $(document).ready(function(){
    suma1();
//////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
 $('input[name*="l"]').change(function(){
     var valor = $(this).attr('value');
     
     suma1();
     
   });
   ///**************************************************
   function suma1()
     {
	
        
        var l1=parseFloat($("#l1").attr('value'));
        var l2=parseFloat($("#l2").attr('value'));
        var l4=parseFloat($("#l4").attr('value'));
        var l5=parseFloat($("#l5").attr('value'));
        var l8=parseFloat($("#l8").attr('value'));
        var l9=parseFloat($("#l9").attr('value'));
        var l10=parseFloat($("#l10").attr('value'));
        var l11=parseFloat($("#l11").attr('value'));
        var l12=parseFloat($("#l12").attr('value'));
        var l13=parseFloat($("#l13").attr('value'));
        var l16=parseFloat($("#l16").attr('value'));
        var l19=parseFloat($("#l19").attr('value'));
        var l20=parseFloat($("#l20").attr('value'));
        var l21=parseFloat($("#l21").attr('value'));
        var l22=parseFloat($("#l22").attr('value'));
        var l23=parseFloat($("#l23").attr('value'));
        var l24=parseFloat($("#l24").attr('value'));
        
        var lc1=parseFloat($("#lc1").attr('value'));
        var lc2=parseFloat($("#lc2").attr('value'));
        var lc4=parseFloat($("#lc4").attr('value'));
        var lc5=parseFloat($("#lc5").attr('value'));
        var lc8=parseFloat($("#lc8").attr('value'));
        var lc9=parseFloat($("#lc9").attr('value'));
        var lc10=parseFloat($("#lc10").attr('value'));
        var lc11=parseFloat($("#lc11").attr('value'));
        var lc12=parseFloat($("#lc12").attr('value'));
        var lc13=parseFloat($("#lc13").attr('value'));
        var lc16=parseFloat($("#lc16").attr('value'));
        var lc19=parseFloat($("#lc19").attr('value'));
        var lc20=parseFloat($("#lc20").attr('value'));
        var lc21=parseFloat($("#lc21").attr('value'));
        var lc22=parseFloat($("#lc22").attr('value'));
        var lc23=parseFloat($("#lc23").attr('value'));
        var lc24=parseFloat($("#lc24").attr('value'));

        var la1=parseFloat($("#la1").attr('value'));
        var la2=parseFloat($("#la2").attr('value'));
        var la4=parseFloat($("#la4").attr('value'));
        var la5=parseFloat($("#la5").attr('value'));
        var la8=parseFloat($("#la8").attr('value'));
        var la9=parseFloat($("#la9").attr('value'));
        var la10=parseFloat($("#la10").attr('value'));
        var la11=parseFloat($("#la11").attr('value'));
        var la12=parseFloat($("#la12").attr('value'));
        var la13=parseFloat($("#la13").attr('value'));
        var la16=parseFloat($("#la16").attr('value'));
        var la19=parseFloat($("#la19").attr('value'));
        var la20=parseFloat($("#la20").attr('value'));
        var la21=parseFloat($("#la21").attr('value'));
        var la22=parseFloat($("#la22").attr('value'));
        var la23=parseFloat($("#la23").attr('value'));
        var la24=parseFloat($("#la24").attr('value'));
        
        var turno1_pesos= parseFloat($("#turno1_pesos").attr('value'));
        var turno1_dolar= parseFloat($("#turno1_dolar").attr('value'));
        var turno1_cambio=parseFloat($("#turno1_cambio").attr('value'));
        var turno1_bbv=   parseFloat($("#turno1_bbv").attr('value'));
        var turno1_exp=   parseFloat($("#turno1_exp").attr('value'));
        var turno1_san=   parseFloat($("#turno1_san").attr('value'));
        var turno1_vale=  parseFloat($("#turno1_vale").attr('value'));
        var turno1_asalto=parseFloat($("#turno1_asalto").attr('value'));
        var turno1_corte =parseFloat($("#turno1_corte").attr('value'));
        
        var turno2_pesos= parseFloat($("#turno2_pesos").attr('value'));
        var turno2_dolar= parseFloat($("#turno2_dolar").attr('value'));
        var turno2_cambio=parseFloat($("#turno2_cambio").attr('value'));
        var turno2_bbv=   parseFloat($("#turno2_bbv").attr('value'));
        var turno2_san=   parseFloat($("#turno2_san").attr('value'));
        var turno2_exp=   parseFloat($("#turno2_exp").attr('value'));
        var turno2_vale=  parseFloat($("#turno2_vale").attr('value'));
        var turno2_asalto=parseFloat($("#turno2_asalto").attr('value'));
        var turno2_corte=parseFloat($("#turno2_corte").attr('value'));
        
        var turno3_pesos= parseFloat($("#turno3_pesos").attr('value'));
        var turno3_dolar= parseFloat($("#turno3_dolar").attr('value'));
        var turno3_cambio=parseFloat($("#turno3_cambio").attr('value'));
        var turno3_bbv=   parseFloat($("#turno3_bbv").attr('value'));
        var turno3_san=   parseFloat($("#turno3_san").attr('value'));
        var turno3_exp=   parseFloat($("#turno3_exp").attr('value'));
        var turno3_vale=  parseFloat($("#turno3_vale").attr('value'));
        var turno3_asalto=parseFloat($("#turno3_asalto").attr('value'));
        var turno3_corte=parseFloat($("#turno3_corte").attr('value'));
        
        var turno4_pesos= parseFloat($("#turno4_pesos").attr('value'));
        var turno4_dolar= parseFloat($("#turno4_dolar").attr('value'));
        var turno4_cambio=parseFloat($("#turno4_cambio").attr('value'));
        var turno4_bbv=   parseFloat($("#turno4_bbv").attr('value'));
        var turno4_san=   parseFloat($("#turno4_san").attr('value'));
        var turno4_exp=   parseFloat($("#turno4_exp").attr('value'));
        var turno4_vale=  parseFloat($("#turno4_vale").attr('value'));
        var turno4_asalto=parseFloat($("#turno4_asalto").attr('value'));
        var turno4_corte=parseFloat($("#turno4_corte").attr('value'));

        if(isNaN(l1)){l1=0;}
        if(isNaN(l2)){l2=0;}
        if(isNaN(l4)){l4=0;}
        if(isNaN(l5)){l5=0;}
        if(isNaN(l8)){l8=0;}
        if(isNaN(l9)){l9=0;}
        if(isNaN(l10)){l10=0;}
        if(isNaN(l11)){l11=0;}
        if(isNaN(l12)){l12=0;}
        if(isNaN(l13)){l13=0;}
        if(isNaN(l16)){l16=0;}
        if(isNaN(l19)){l19=0;}
        if(isNaN(l20)){l20=0;}
        if(isNaN(l21)){l21=0;}
        if(isNaN(l22)){l22=0;}
        if(isNaN(l23)){l23=0;}
        if(isNaN(l24)){l24=0;}
        
        if(isNaN(lc1)){lc1=0;}
        if(isNaN(lc2)){lc2=0;}
        if(isNaN(lc4)){lc4=0;}
        if(isNaN(lc5)){lc5=0;}
        if(isNaN(lc8)){lc8=0;}
        if(isNaN(lc9)){lc9=0;}
        if(isNaN(lc10)){lc10=0;}
        if(isNaN(lc11)){lc11=0;}
        if(isNaN(lc12)){lc12=0;}
        if(isNaN(lc13)){lc13=0;}
        if(isNaN(lc16)){lc16=0;}
        if(isNaN(lc19)){lc19=0;}
        if(isNaN(lc20)){lc20=0;}
        if(isNaN(lc21)){lc21=0;}
        if(isNaN(lc22)){lc22=0;}
        if(isNaN(lc23)){lc23=0;}
        if(isNaN(lc24)){lc24=0;}
        
        if(isNaN(la1)){la1=0;}
        if(isNaN(la2)){la2=0;}
        if(isNaN(la4)){la4=0;}
        if(isNaN(la5)){la5=0;}
        if(isNaN(la8)){la8=0;}
        if(isNaN(la9)){la9=0;}
        if(isNaN(la10)){la10=0;}
        if(isNaN(la11)){la11=0;}
        if(isNaN(la12)){la12=0;}
        if(isNaN(la13)){la13=0;}
        if(isNaN(la16)){la16=0;}
        if(isNaN(la19)){la19=0;}
        if(isNaN(la20)){la20=0;}
        if(isNaN(la21)){la21=0;}
        if(isNaN(la22)){la22=0;}
        if(isNaN(la23)){la23=0;}
        if(isNaN(la24)){la24=0;}
        
        if(isNaN(turno1_pesos)){turno1_pesos=0;}
        if(isNaN(turno1_dolar)){turno1_dolar=0;}
        if(isNaN(turno1_cambio)){turno1_cambio=0;}
        if(isNaN(turno1_bbv)){turno1_bbv=0;}
        if(isNaN(turno1_san)){turno1_san=0;}
        if(isNaN(turno1_exp)){turno1_exp=0;}
        if(isNaN(turno1_vale)){turno1_vale=0;}
        if(isNaN(turno1_asalto)){turno1_asalto=0;}
        if(isNaN(turno1_corte)){turno1_corte=0;}
        
        if(isNaN(turno2_pesos)){turno2_pesos=0;}
        if(isNaN(turno2_dolar)){turno2_dolar=0;}
        if(isNaN(turno2_cambio)){turno2_cambio=0;}
        if(isNaN(turno2_bbv)){turno2_bbv=0;}
        if(isNaN(turno2_san)){turno2_san=0;}
        if(isNaN(turno2_exp)){turno2_exp=0;}
        if(isNaN(turno2_vale)){turno2_vale=0;}
        if(isNaN(turno2_asalto)){turno2_asalto=0;}
        if(isNaN(turno2_corte)){turno2_corte=0;}
        
        if(isNaN(turno3_pesos)){turno3_pesos=0;}
        if(isNaN(turno3_dolar)){turno3_dolar=0;}
        if(isNaN(turno3_cambio)){turno3_cambio=0;}
        if(isNaN(turno3_bbv)){turno3_bbv=0;}
        if(isNaN(turno3_san)){turno3_san=0;}
        if(isNaN(turno3_exp)){turno3_exp=0;}
        if(isNaN(turno3_vale)){turno3_vale=0;}
        if(isNaN(turno3_asalto)){turno3_asalto=0;}
        if(isNaN(turno3_corte)){turno3_corte=0;}
        
        if(isNaN(turno4_pesos)){turno4_pesos=0;}
        if(isNaN(turno4_dolar)){turno4_dolar=0;}
        if(isNaN(turno4_cambio)){turno4_cambio=0;}
        if(isNaN(turno4_bbv)){turno4_bbv=0;}
        if(isNaN(turno4_san)){turno4_san=0;}
        if(isNaN(turno4_exp)){turno4_exp=0;}
        if(isNaN(turno4_vale)){turno4_vale=0;}
        if(isNaN(turno4_asalto)){turno4_asalto=0;}
        if(isNaN(turno4_corte)){turno4_corte=0;}  
        
        var suma1 = l1+l2+l4+l5+l8+l9+l10+l11+l12+l13+l16+l19+l20+l21+l22+l23+l24+
                    la1+la2+la4+la5+la8+la9+la10+la11+la12+la13+la16+la19+la20+la21+la22+la23+la24-
                    lc1-lc2-lc4-lc5-lc8-lc9-lc10-lc11-lc12-lc13-lc16-lc19-lc20-lc21-lc22-lc23-lc24 ;
        var mn1 = turno1_dolar*turno1_cambio;
        var mn2 = turno2_dolar*turno2_cambio;
        var mn3 = turno3_dolar*turno3_cambio;
        var mn4 = turno4_dolar*turno4_cambio;
		var arqueo = turno1_pesos+turno1_bbv+turno1_san+turno1_exp+turno1_vale+turno1_asalto+mn1+
                     turno2_pesos+turno2_bbv+turno2_san+turno2_exp+turno2_vale+turno2_asalto+mn2+
                     turno3_pesos+turno3_bbv+turno3_san+turno3_exp+turno3_vale+turno3_asalto+mn3+
                     turno4_pesos+turno4_bbv+turno4_san+turno4_exp+turno4_vale+turno4_asalto+mn4;
       var arqueo1 = turno1_pesos+turno1_bbv+turno1_san+turno1_exp+turno1_vale+turno1_asalto+mn1;
       var arqueo2 = turno2_pesos+turno2_bbv+turno2_san+turno2_exp+turno2_vale+turno2_asalto+mn2;
       var arqueo3 = turno3_pesos+turno3_bbv+turno3_san+turno3_exp+turno3_vale+turno3_asalto+mn3;
       var arqueo4 = turno4_pesos+turno4_bbv+turno4_san+turno4_exp+turno4_vale+turno4_asalto+mn4;
       var corte  = parseFloat(turno1_corte) + parseFloat(turno2_corte) +  parseFloat(turno3_corte) + parseFloat(turno4_corte);
       
      
       
        if (arqueo1>turno1_corte){var sob1 = arqueo1 - turno1_corte; var fal1=0;}else{var fal1= turno1_corte - arqueo1;var sob1=0;}
        if (arqueo2>turno2_corte){var sob2 = arqueo2 - turno2_corte; var fal2=0;}else{var fal2= turno2_corte - arqueo2;var sob2=0;}
        if (arqueo3>turno3_corte){var sob3 = arqueo3 - turno3_corte; var fal3=0;}else{var fal3= turno3_corte - arqueo3;var sob3=0;}
        if (arqueo4>turno4_corte){var sob4 = arqueo4 - turno4_corte; var fal4=0;}else{var fal4= turno4_corte - arqueo4;var sob4=0;}
      
       
        var iva = $('#iva').attr("value");
         
        var subtotal = l2+l5+l9+l11+l19+l20+l21+la2+la5+la9+la11+la19+la20+la21-lc2-lc5-lc9-lc11-lc19-lc20-lc21;
        var totiva = subtotal-(subtotal/iva);
       
        
        //corte=Math.round(corte*100)/100  //returns 28.45 redondea
        corte=Math.round(corte*100)/100  //returns 28.45 redondea
        suma1=Math.round(suma1*100)/100  //returns 28.45
        totiva=totiva
        fal1=Math.round(fal1*100)/100 
        fal2=Math.round(fal2*100)/100 
        fal3=Math.round(fal3*100)/100
        fal4=Math.round(fal4*100)/100 
        
        sob1=Math.round(sob1*100)/100
        sob2=Math.round(sob2*100)/100
        sob3=Math.round(sob3*100)/100
        sob4=Math.round(sob4*100)/100
       
        var dif=corte-suma1;
       $("#turno1_corte").val(turno1_corte);
       $("#turno2_corte").val(turno2_corte);
       $("#turno3_corte").val(turno3_corte);
       $("#turno4_corte").val(turno4_corte);
       
        $("#subtotal").html(subtotal);
        $("#totiva").html(totiva);
		$("#suma1").html(suma1);
        $("#corte").html(corte);
        $("#arqueo").html(arqueo);
        $("#dif").html(dif);
	    
        $("#fal1").html(fal1);
        $("#sob1").html(sob1); 
        $("#fal2").html(fal2);
        $("#sob2").html(sob2);
        $("#fal3").html(fal3);
        $("#sob3").html(sob3);
        $("#fal4").html(fal4);
        $("#sob4").html(sob4);
        $("#corte").html(corte);
        $("#dif").html(dif);
        
       
        var recarga = $('#recarga').attr("value");
         
        $("#recarga").html(recarga);   
     }
   ///**************************************************  
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#cortes_form_2_his').submit(function() {
        suma1=parseFloat($("#suma1").html());
        corte=parseFloat($("#corte").html());
        recarga= parseFloat($("#recarga").html());
       
        var l30= $("#l30").attr('value');
        
        
        l20 = $('#l20').attr("value");
        la20 = $('#la20').attr("value");
        lc20 = $('#lc20').attr("value");
        if(isNaN(l20)){l20=0;}
        if(isNaN(la20)){la20=0;}
        if(isNaN(lc20)){lc20=0;}
       
        dif = $('#dif').attr("value");
        var dif=parseFloat(l20)+parseFloat(la20)-parseFloat(lc20)-parseFloat(recarga);
        if(isNaN(dif)){dif=0;}
        
        
       if(suma1 == corte && dif ==0 || suma1 == corte && dif ==null){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
             
    	    
    	  }else{
 
    	    alert('VERIFIQUE LA CAPTURA, NO CUADRA EL CORTE');
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>