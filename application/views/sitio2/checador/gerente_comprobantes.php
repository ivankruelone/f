<?php
	$row = $row->row();
    
    $sql = "SELECT imagen FROM checador_comprobantes c where c_id = ?;";
    $query2 = $this->db->query($sql, $row->id);
    
    
    
?>
            <!-- Example row of columns -->
            <div class="row">
                <div class="span4">
                    <h5><?php echo $row->completo; ?></h5>
                    <p>Fecha: <?php echo $row->fecha; ?></p>
                    
                    <p>
                    
                    <?php
                    
                    
                    if($query2->num_rows() > 0)
                    {
                        foreach($query2->result() as $row2)
                        {
                            echo "<div style=\"padding: 5px;\">";
                            echo "<img src=\"".base_url()."img/comprobantes/".$row2->imagen."\" />";
                            echo "</div>";
                        }
                    }
                    
                    
                    
                    ?>
                    
                    </p>
                    
                    
                </div>
            </div>