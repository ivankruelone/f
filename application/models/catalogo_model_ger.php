<?php
class Catalogo_model_ger extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_empleado_todo($id)
    {
     $sql = "SELECT a.fecha_as400, a.cia, a.nomina,a.tipo, a.id,a.nom,a.pat,a.mat,a.puestox,a.succ,a.id_user,
     aa.regional,aa.nombre as sucx,b.nombre as supx ,c.nombre as regionalx,d.nombre as contador
     from catalogo.cat_empleado a 
     left join catalogo.sucursal aa on aa.suc=a.succ and a.suc>100
     left join desarrollo.usuarios b on b.plaza=aa.superv and b.nivel=14
     left join desarrollo.usuarios c on c.plaza=aa.regional and c.nivel=21
     left join desarrollo.usuarios d on d.id=a.id_user
     where a.id= ?";
        $query = $this->db->query($sql,array($id));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Nombre</th>
        <th>Puesto</th>
        <th>Sucursal</th>
        <th>Supervisor</th>
        <th>Gerente</th>
        <th>Contador</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            if($row->tipo==1){$color='black';}else{$color='red';}
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->nomina." ".trim($row->nom)." ".trim($row->pat)." ".trim($row->mat)."<br />".$row->fecha_as400."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puestox."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->succ." ".$row->sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->supx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->regionalx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->contador."</font></td>
            </tr>
            ";
 $s = "SELECT  a.*,aa.nombre as sucx,c.nombre as id_rhx,d.nombre as contax
 from catalogo.cat_alta_empleado a
 left join catalogo.sucursal aa on aa.suc=a.suc and a.suc>100
     left join desarrollo.usuarios c on c.id=a.id_rh
     left join desarrollo.usuarios d on d.id=a.id_user
     
 where empleado=$row->nomina and a.cia=$row->cia";
 $q = $this->db->query($s);
 $tabla.="
        <tr>
        <th>Motivo</th>
        <th>Sucursal</th>
        <th>Autoriza</th>
        <th>Contador</th>
        <th>R.H</th>
        <th>Causa</th>
        </tr>
        ";
         
  foreach($q->result() as $r)
        {
        	
        $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$r->motivo." <br />".$r->fecha_i."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->suc." ".$r->sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->autoriza."</font></td>
			<td align=\"left\"><font color=\"$color\">".$r->contax."<br />".$r->fecha."</font></td>
			<td align=\"left\"><font color=\"$color\">".$r->id_rhx."<br />".$r->fecha_rh."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->causa."</font></td>
            
            </tr>";	
       	}
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_empleado_todo_rh($id)
    {
     $sql = "SELECT a.rfc,a.afiliacion,a.fecha_as400, a.cia, a.nomina,a.tipo, a.id,a.nom,a.pat,a.mat,a.puestox,a.succ,a.id_user as id_cat,
     aa.regional,aa.nombre as sucx,b.nombre as supx ,c.nombre as regionalx,d.nombre as contador
     from catalogo.cat_empleado a 
     left join catalogo.sucursal aa on aa.suc=a.succ and a.suc>100
     left join desarrollo.usuarios b on b.plaza=aa.superv and b.nivel=14 and b.activo=1
     left join desarrollo.usuarios c on c.plaza=aa.regional and c.nivel=21  and b.activo=1
     left join desarrollo.usuarios d on d.id=a.id_user  and b.activo=1
     where a.id= ?";
        $query = $this->db->query($sql,array($id));
      
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Nombre</th>
        <th>Puesto</th>
        <th>Sucursal</th>
        <th>Supervisor</th>
        <th>Gerente</th>
        <th>Contador</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            if($row->tipo==1){$color='black';}else{$color='red';}
       
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->nomina." ".trim($row->nom)." ".trim($row->pat)." ".trim($row->mat)."<br />".$row->fecha_as400."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puestox."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->succ." ".$row->sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->supx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->regionalx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->contador."</font></td>
            </tr>
            <tr>
            <th>No. AFILIACION</th>
            </tr>
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->afiliacion."</font></td>
            </tr>
            ";
 $s = "SELECT  a.*,aa.nombre as sucx,c.nombre as id_rhx,d.nombre as contax
 from catalogo.cat_alta_empleado a
 left join catalogo.sucursal aa on aa.suc=a.suc and a.suc>100
     left join desarrollo.usuarios c on c.id=a.id_rh
     left join desarrollo.usuarios d on d.id=a.id_user
 where empleado=$row->nomina and a.cia=$row->cia";
 $q = $this->db->query($s);
 
 
 
 $tabla.="
        <tr>
        <th colspan=\"6\" align=\"center\">MOVIMIENTOS DE ALTAS, BAJAS, RETENCIONES</th>
        </tr>
        <tr>
        <th>Motivo</th>
        <th>Sucursal</th>
        <th>Autoriza</th>
        <th>Contador</th>
        <th>R.H</th>
        <th>Causa</th>
        </tr>
        ";
         
  foreach($q->result() as $r)
        {
        	
        $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$r->motivo." <br />".$r->fecha_i."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->suc." ".$r->sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->autoriza."</font></td>
			<td align=\"left\"><font color=\"$color\">".$r->contax."<br />".$r->fecha."</font></td>
			<td align=\"left\"><font color=\"$color\">".$r->id_rhx."<br />".$r->fecha_rh."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->causa."</font></td>
            
            </tr>";	
       	}
 $sx = "SELECT b.nombre as clavex,a.fecpre, aa.nombre as id_userx ,aa.puesto as puex,a.*
 from faltante a
 left join usuarios aa on aa.id=a.id_user
 left join catalogo.cat_nom_claves b on b.clave=a.clave
 where a.nomina=$row->nomina and a.cianom=$row->cia";
 
 $qx = $this->db->query($sx);
 $tabla.="
 <tr></tr>
 <tr></tr>
 <tr></tr>
 <tr></tr>
 
        <tr>
        <th colspan=\"5\" align=\"center\">MOVIMIENTOS DE PRENOMINA</th>
        </tr>
        <tr>
        <th>CLAVE</th>
        <th></th>
        <th>Fec.PRENOMINA</th>
        <th>CAPTURA</th>
        
        <th>MOTIVO</th>
        
        </tr>
        ";
         
  foreach($qx->result() as $rx)
        {
        	
        $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$rx->clavex." <br /></font></td>
            <td align=\"right\"><font color=\"$color\">".$rx->fal."</font></td>
            <td align=\"left\"><font color=\"$color\">".$rx->fecpre." </font></td>
            <td align=\"left\"><font color=\"$color\">".$rx->id_userx." <br />".$rx->puex."</font></td>
			
            
            <td align=\"left\"><font color=\"$color\">".$rx->observacion."</font></td>
            
            </tr>";	
       	}
  $sx1 = "SELECT b.tipo as equipox, a.* from desarrollo.equipos_comunicaciones a left join desarrollo.equipos_tipo b on b.id=a.tipo
 where id_user=$id";
 $qx1 = $this->db->query($sx1);
      
 $tabla.="
 <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        <tr>
        <th colspan=\"3\" align=\"center\">EQUIPOS DE COMUNICACIONES</th>
        </tr>
        <tr>
        <th>EQUIPO</th>
        <th>MODELO</th>
        <th>TELEFONO</th>
        </tr>
        ";
         
  foreach($qx1->result() as $rx1)
        {
        	
        $tabla.="
            <tr>
            <tr>
            <td align=\"left\"><font color=\"$color\">".$rx1->equipox." </font></td>
            <td align=\"left\"><font color=\"$color\">".$rx1->equipo." </font></td>
            <td align=\"left\"><font color=\"$color\">".$rx1->cel."</font></td>
           
            
            </tr>";	
       	}        
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function plantilla_sup_1()
    {
    $sql = "SELECT a.superv,a.regional,count(a.suc)as num,sum(a.plantilla)as plantilla,b.nombre,b.email,b.puesto,b.id as id_sup,sum(c.emp)as emp
	 from catalogo.sucursal a
	 left join usuarios b on b.plaza=a.superv and nivel=14 and responsable='R'
	 left join catalogo.cat_empleado_succ c on a.suc=c.succ
	 where  b.activo=1 and nivel=14 and superv>0
	 group by superv";
	 $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>PLAZA</th>
        <th>NOMBRE</th>
        <th>CORREO</th>
        <th>PUESTO</th>
        <th>SUCURSALES</th>
        <th>PERSONAL<br />ACTIVO</th>
        <th>PLANTILLA<br />AUTORIZADA</th>
        <th>DIF.</th>
        </tr>
        </thead>
        <tbody>
        ";
        $tot1=0;
        $tot2=0;
        
        foreach($query->result() as $row)
        {
            $color='black';
            $l1 = anchor('catalogo_ger/imprime_sup/'.$row->id_sup.'/'.'14', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->superv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->num."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->emp."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plantilla."</font></td>
            <td align=\"center\"><font color=\"$color\">".($row->plantilla-$row->emp)."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
            $tot1=$tot1+($row->emp);
            $tot2=$tot2+($row->plantilla);
        }
        
        $tabla.="
        </tbody>
        <tr>
            <td align=\"center\" colspan=\"5\"><font color=\"$color\">TOTAL </font></td>
            <td align=\"center\"><font color=\"$color\">".$tot1."</font></td>
            <td align=\"center\"><font color=\"$color\">".$tot2."</font></td>
            <td align=\"center\"><font color=\"$color\">".($tot1-$tot2)."</font></td>
            
            </tr>
            
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function plantilla_sup_rh()
    {
    $sql = "SELECT a.superv,a.regional,count(a.suc)as num,sum(a.plantilla)as plantilla,b.nombre,b.email,b.puesto,b.id as id_sup,sum(c.emp)as emp
	 from catalogo.sucursal a
	 left join usuarios b on b.plaza=a.superv and nivel=14 and responsable='R'
	 left join catalogo.cat_empleado_succ c on a.suc=c.succ 
	 where  b.activo=1 and a.suc>100 and a.suc<=1999 and a.superv>0 and tlid=1
	 group by a.superv";
	 $query = $this->db->query($sql);
     $s = "SELECT sum(c.emp)as emp
	 from catalogo.sucursal a
	 left join catalogo.cat_empleado_succ c on a.suc=c.succ
	 where  a.suc>100 and a.suc<=1999 and tlid=4";
	 $q = $this->db->query($s);
     if($q->num_rows()>0){
     $r=$q->row();
     $cerrado=$r->emp;   
     }
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>PLAZA</th>
        <th>NOMBRE</th>
        <th>CORREO</th>
        <th>PUESTO</th>
        <th>SUCURSALES</th>
        <th>PERSONAL<br />ACTIVO</th>
        <th>PLANTILLA<br />AUTORIZADA</th>
        <th>DIF.</th>
        </tr>
        </thead>
        <tbody>
        ";
        $tot1=0;
        $tot2=0;
        
        foreach($query->result() as $row)
        {
            $color='black';
            $l1 = anchor('catalogo_ger/imprime_sup_rh/'.$row->superv.'/'.'14', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->superv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->num."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->emp."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plantilla."</font></td>
            <td align=\"center\"><font color=\"$color\">".($row->plantilla-$row->emp)."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
            $tot1=$tot1+($row->emp);
            $tot2=$tot2+($row->plantilla);
        }
        
        $tabla.="
        </tbody>
        <tr>
            <td align=\"center\" colspan=\"5\"><font color=\"$color\">TOTAL </font></td>
            <td align=\"center\"><font color=\"$color\">".$tot1."</font></td>
            <td align=\"center\"><font color=\"$color\">".$tot2."</font></td>
            <td align=\"center\"><font color=\"$color\">".($tot1-$tot2)."</font></td>
            </tr>
        <tr><td  colspan=\"8\">EMPLEADOS DE SUCURSALES CERRADAS $cerrado</td></tr>    
        </table>";
        
       
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function pro_nat()
    {
     $sql = "SELECT a.*,b.codigo,b.susa1,b.tsec,b.susa2,b.vtagen,b.vtaddr 
FROM catalogo.cat_naturistas a
left join catalogo.almacen b on b.sec=a.sec 
order by sec";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Sec</th>
        <th>Codigo</th>
        <th>Sus. Activa</th>
        <th>Descripcion</th>
        <th>$ Generico</th>
        <th>$ Dr.Descuento</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa2."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->vtagen,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->vtaddr,2)."</font></td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function pro_generico()
    {
     $sql = "SELECT a.*,
     case when b.sec is not null
     then 'Activo'
     else
     'Descontinuado'
     end as obser
     FROM catalogo.almacen a 
     left join catalogo.cat_almacen_clasifica b on b.sec=a.sec where a.sec<=2000  
     group by sec  order by obser,sec ";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Status</th>
        <th>Sec</th>
        <th>Sus. Activa</th>
        <th>Descripcion</th>
        <th>$ Generico</th>
        <th>$ Dr.Descuento</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$row->obser."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa2."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->vtagen,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($row->vtaddr,2)."</font></td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
  ///////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function naturistas()
    {
     $sql = "SELECT * FROM catalogo.cat_naturistas c; ";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Secuencia</th>
        <th>Descripcion</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->descri."</font></td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function pro_generico_desco()
    {
     $sql = "SELECT a.*,b.susa1
     FROM catalogo.almacen_borrar a 
     left join catalogo.almacen b on b.sec=a.sec
     group by a.sec ";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Sec</th>
        <th>Sus. Activa</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $num=1;
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$num."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            </tr>
            ";
        $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function pro_generico_cambio()
    {
$fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
     $sql = "SELECT * FROM catalogo.almacen_bitacora
where 
vtagen<>vtagena and sec>=1 and sec<=1999 and vtagena>0 and fecha>='2012-12-16' and '$nuevafecha'<fecha 
or
vtaddr<>vtaddra  and vtaddra>0 and sec>=1 and sec<=1999 and fecha>='2012-12-16' and '$nuevafecha'<fecha 
order by fecha desc, sec";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <tr>
        <th></th>
        <th></th>
        <th></th>
        <th colspan=\"2\">GENERICOS</th>
        <th colspan=\"2\">DOCTOR DESCUENTO</th>
        <th></th>
        </tr>
        <th>#</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>PRECIO ANTERIOR</th>
        <th>PRECIO ACTUAL</th>
        <th>PRECIO ANTERIOR</th>
        <th>PRECIO ACTUAL</th>
        <th>FECHA</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $num=1;
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$num."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"red\">".$row->vtagena."</font></td>
            <td align=\"left\"><font color=\"blue\">".$row->vtagen."</font></td>
            <td align=\"left\"><font color=\"red\">".$row->vtaddra."</font></td>
            <td align=\"left\"><font color=\"blue\">".$row->vtaddr."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->fecha."</font></td>
            </tr>
            ";
        $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function pro_generico_paquete()
    {
     $sql = "SELECT a.*,b.susa1
     FROM catalogo.almacen_paquetes a 
     left join catalogo.almacen b on b.sec=a.sec
     group by a.sec ";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Sec</th>
        <th>Sus. Activa</th>
        <th>Piezas</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $num=1;
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$num."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->can."</font></td>
            </tr>
            ";
        $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function cata_gene()
    {
     $sql = "SELECT sec, susa1, susa2, prv, prvx, codigo FROM catalogo.almacen where sec<=2000 order by sec";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Sec</th>
        <th>Sus. Activa</th>
        <th>Descripcion</th>
        <th>Num, Lab</th>
        <th>Laboratorio</th>
        <th>Codigo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            $color='black';
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$row->sec."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->prvx."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->codigo."</font></td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////    
    function gere()
    {
     $s = "SELECT *from catalogo.gerente";
        $q = $this->db->query($s);   
        
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Cambiar</th>
        <th>Password</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($q->result() as $r)
        {
         $l0 = anchor('catalogo_ger/imprime_ger/'.$r->ger, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
         $l3 = anchor('catalogo_ger/usuario_supervisor/'.$r->ger, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar sucursales!', 'class' => 'encabezado'));      
          $sql = "SELECT a.*,b.plaza as plazax,c.razon,d.nombre as sucx
FROM usuarios a
left join catalogo.conta_plazas b on b.cia=a.cia and b.nplaza=a.plaza
left join catalogo.compa c on c.cia=a.cia 
left join catalogo.sucursal d on d.suc=a.suc 
where a.nivel=21 and a.plaza=$r->ger order by username";
$query = $this->db->query($sql);
        foreach($query->result() as $row)
        {
     $tabla.="
     <tr bgcolor=\"#B0E9F8\">
        <td colspan=\"4\" align=\"right\">$r->nombre</td>
        <td colspan=\"1\" align=\"center\">$l0</td>
        <td align=\"center\">".$l3."</td>
     </tr>
     ";
            if($row->activo==1){$color='black';}else{$color='red';}
            $l1 = anchor('catalogo_ger/cambiar_usuario/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));
            $l2 = anchor('catalogo_ger/cambiar_usuario_pas/'.$row->id, '<img src="'.base_url().'img/key.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar password!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->username."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
              <td align=\"left\"><font color=\"$color\">".$row->email."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            
            </tr>
            ";
        }
        }
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    
    function usuarios_super($plaza)
    {
     $sql = "SELECT a.*,b.nombre as supervisor,puesto
     from catalogo.sucursal a
     left join usuarios b on a.superv=b.plaza 
     where a.regional=? and b.nivel=14 and b.activo=1 and responsable='R'
     group by b.id";
        $query = $this->db->query($sql,array($plaza));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Id</th>
        <th>Supervisor</th>
        <th>Zona</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
         $l1 = anchor('catalogo_ger/quitar_superv/'.$plaza.'/'.$row->superv, '<img src="'.base_url().'img/icon_error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Quitar supervisor!', 'class' => 'encabezado'));    $tabla.="
            <tr>
            <td align=\"left\">".$row->id."</td>
            <td align=\"left\">".$row->superv." ".$row->supervisor."</td>
            <td align=\"left\">".$row->puesto."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function quitar_member_usuario_superv($plaza,$superv)
    {
     $data = array(
			'regional' => 0
 		);
		$this->db->where('regional', $plaza);
        $this->db->where('superv', $superv);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function agrega_member_usuario_superv($plaza,$superv)
    {
        
     $data = array(
			'regional' => $plaza
 		);
		$this->db->where('superv', $superv);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function agrega_member_usuario_suc($plaza,$suc)
    {
        
     $data = array(
			'superv' => $plaza
 		);
		$this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function quitar_member_usuario_suc($suc)
    {
     $data = array(
			'superv' => 0
 		);
		$this->db->where('suc',$suc );
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function update_member_usuario($usuario,$nombre,$puesto,$email,$activo,$id)
    {
        if($activo==1){$r='R';}else{$r=' ';}
     $data = array(
			'username' =>str_replace(' ', '',strtolower(trim($usuario))),
            'nombre'   =>strtoupper(trim($nombre)),
            'puesto'   =>strtoupper(trim($puesto)),
            'email'    =>strtolower(trim($email)),
            'activo' =>$activo,
            'responsable' =>$r
		);
		
		$this->db->where('id', $id);
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function update_member_usuario_pas($pas,$id)
    {
     $data = array(
			'password' =>$pas
		);
		$this->db->where('id', $id);
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function agrega_member_usuario($usuario,$id_empleado,$pla,$email,$activo,$pas,$suc,$id,$nivel,$tipo)
    {
       
        $sql = "SELECT * FROM usuarios where username = ? ";
        $query = $this->db->query($sql,array($usuario));
        $sql2 = "SELECT * FROM catalogo.cat_empleado where id=?";
        $query2 = $this->db->query($sql2,array($id_empleado));
        if($query->num_rows() == 0 && $query2->num_rows() > 0){
         $row2= $query2->row();   
     $new_member_insert_data = array(
			'username' =>str_replace(' ', '',strtolower(trim($usuario))),
            'password' =>str_replace(' ', '',strtolower(trim($pas))),
            'nombre'   =>trim($row2->nom).''.trim($row2->pat).' '.trim($row2->mat),
            'puesto'   =>strtoupper(trim($row2->puestox)),
            'email'    =>strtolower(trim($email)),
            'activo'   =>$activo,
            'nomina'    =>$row2->nomina,
            'cia'    =>$row2->cia,
            'plaza'    =>$pla,
            'suc'   =>$suc,
            'tipo'   =>$tipo,
            'nivel'   =>$nivel
		);
		
		
		$insert = $this->db->insert('usuarios', $new_member_insert_data);
        }
    }
/////////////////////////////////////////////////////////////////////////////
    
    function imprime_ger1($id)
    {
     $num1=0;
     $num2=0;
     
     $sql = "SELECT a.suc,a.regional,a.superv,b.nombre as supervisor,puesto,b.nivel,b.email
     from catalogo.sucursal a
     left join usuarios b on a.superv=b.plaza and responsable='R'
     where a.regional=? and nivel=14 and a.superv group by superv";
        $query = $this->db->query($sql,array($id));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th><strong>ZONA</strong></th>
        <th><strong>SUPERVISOR</strong></th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $num=1;
        
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"blue\">".$row->superv."</font></td>
            <td align=\"left\" colspan=\"2\"><font color=\"blue\">".$row->supervisor."</font></td>
            <td align=\"left\"><font color=\"blue\">".$row->email."</font></td>
            </tr>
            ";
            $num1=$num1+1;
    $s = "SELECT * from catalogo.sucursal a where a.superv= ? and tlid=1 order by suc";
    $q = $this->db->query($s,array($row->superv));
    foreach($q->result() as $r)
        {
         $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\">$num</td>
            <td align=\"left\">".$r->tipo2." ". str_pad($r->suc,4,"0",STR_PAD_LEFT)."</td>
            <td align=\"left\">".$r->nombre."</td>
            
            </tr>
            "; 
            $num=$num+1;
            $num2=$num2+1;
        } 
        }
        
        $tabla.="
        </tbody>
        <tr>
        <td></td>
        </tr>
 
        <tr bgcolor=\"#F0D9D9\">
            <td align=\"left\"></td>
            <td align=\"left\"><strong>TOTAL DE ZONAS ".$num1."</strong></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            </tr>
        <tr bgcolor=\"#F0D9D9\">
            <td align=\"left\"></td>
            <td align=\"left\"><strong>TOTAL DE SUCURSALES ".$num2."</strong></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            </tr>
        </table>";
       
        return $tabla;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////__________________________________supervisores_______________________________
//////////////////////////////////////////////
//////////////////////////////////////////////
    function sup()
    {
     $sql = "SELECT a.*,d.nombre as sucx
FROM usuarios a
left join catalogo.sucursal d on d.suc=a.suc 
where a.nivel=14 order by plaza";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Puesto</th>
        <th>Sucursal</th>
        <th>Zona</th>
        <th>Email</th>
        <th>Cam</th>
        <th>Pas</th>
        <th>Suc</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            if($row->activo==1){$color='black';}else{$color='red';}
            $l0 = anchor('catalogo_ger/imprime_sup/'.$row->id.'/'.$row->nivel, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
            $l1 = anchor('catalogo_ger/cambiar_usuario/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));
            $l2 = anchor('catalogo_ger/cambiar_usuario_pas/'.$row->id, '<img src="'.base_url().'img/key.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar password!', 'class' => 'encabezado'));
            $l3 = anchor('catalogo_ger/usuario_sucur/'.$row->id, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar sucursales!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->username."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->sucx."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plaza."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            <td align=\"center\">".$l3."</td>
            <td align=\"center\">".$l0."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////__________________________________supervisores_______________________________
//////////////////////////////////////////////
//////////////////////////////////////////////
    function sup_nacional()
    {
     $sql = "SELECT a.*,d.nombre as sucx
FROM usuarios a
left join catalogo.sucursal d on d.suc=a.suc 
where a.nivel=14 and a.plaza>0 and a.plaza<96  order by plaza ";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Puesto</th>
        <th>Sucursal</th>
        <th>Zona</th>
        <th>Email</th>
        <th>Cam</th>
        <th>Pas</th>
        <th>Suc</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            if($row->responsable=='R'){$color='black';}else{$color='red';}
            $l0 = anchor('catalogo_ger/imprime_sup/'.$row->plaza.'/'.$row->nivel, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
            $l1 = anchor('catalogo_ger/cambiar_usuario/'.$row->id, '<img src="'.base_url().'img/user.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar usuarios!', 'class' => 'encabezado'));
            $l2 = anchor('catalogo_ger/cambiar_usuario_pas/'.$row->id, '<img src="'.base_url().'img/key.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar password!', 'class' => 'encabezado'));
            $l3 = anchor('catalogo_ger/usuario_sucur/'.$row->plaza, '<img src="'.base_url().'img/pharmacy.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para agregar sucursales!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->username."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->sucx."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plaza."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            <td align=\"center\">".$l3."</td>
            <td align=\"center\">".$l0."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    
    function usuarios_sucur($id,$nivel)
    {
     $sql = "SELECT a.*,b.nombre as supervisor,puesto,b.nivel
     from catalogo.sucursal a
     left join usuarios b on a.superv=b.plaza and responsable='R'
     where a.superv=$id and nivel=$nivel order by suc";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Plaza</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
         $l1 = anchor('catalogo_ger/quitar_suc/'.$row->suc.'/'.$row->nivel.'/'.$id, '<img src="'.base_url().'img/icon_error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Quitar supervisor!', 'class' => 'encabezado'));    $tabla.="
            <tr>
             <td align=\"left\">".$row->superv."</td>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$l1."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    
    function imprime_sup1($superv)
    {
     $num1=0;
     $num2=0;
     $sql = "SELECT * from catalogo.sucursal a 
     where a.superv= ?  and tlid=1 and suc>100 and suc<=1999 order by suc";
    
        $query = $this->db->query($sql,array($superv));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>EMPLEADOS</strong></th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        
  $totpla=0;      
        foreach($query->result() as $row)
        {
          
            $num3=1;
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"><font color=\"blue\">".$row->tipo2." ".$row->suc." - ".$row->nombre."  ____________Plantilla autorizada: ".$row->plantilla."</font></td>
            <td align=\"left\"><font color=\"blue\"></font></td>
            </tr>
            ";
            $num1=$num1+1;
$totpla=$totpla+($row->plantilla);
    $s = "SELECT a.*, b.farmacia 
	from catalogo.cat_empleado a
	left join catalogo.cat_puesto b on b.puesto=a.puestox 
	where a.succ= ? and a.tipo=1 and b.farmacia='S' 
	order by puestox,nomina";
    $q = $this->db->query($s,array($row->suc));
   
    foreach($q->result() as $r)
        {
        $ss="select *from catalogo.cat_alta_empleado where empleado=$r->nomina and motivo='RETENCION' and id_causa<>7 ";
        $qq = $this->db->query($ss);
        if( $qq->num_rows()>0){$color='red';$ret='RETENCION';}else{$color='black';$ret='';}      
         
         if($r->puestox<>'MEDICO                                  ')
         {
           if($ret==''){$fin=$num3;$num3=$num3+1;$num2=$num2+1;}else{$fin=$ret;} 
         
         
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$fin."</font></td>
            <td align=\"left\" colspan=\"2\"><font color=\"$color\">".$r->nomina." ". str_pad($r->pat." ".$r->mat." ".$r->nom,4,"0",STR_PAD_LEFT)."</font></td>
            <td align=\"left\">".$r->puestox."</td>
            
            </tr>
            ";
            }else{
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$ret."</font></td>
            <td align=\"left\" colspan=\"2\"><font color=\"$color\">".$r->nomina." ". str_pad($r->pat." ".$r->mat." ".$r->nom,4,"0",STR_PAD_LEFT)."</font></td>
            <td align=\"left\">".$r->puestox."</td>
            
            </tr>
            "; 
         }    
        }
 
 $num3=0;
       }
        
        $tabla.="
        </tbody>
        <tr>
        <td></td>
        </tr>
 
        <tr bgcolor=\"#F0D9D9\">
            <td align=\"left\"></td>
            <td align=\"left\"><strong>TOTAL DE SUCURSALES</strong></td>
            <td align=\"right\"><strong>".$num1."</strong></td>
            <td align=\"left\"></td>
            </tr>
        <tr bgcolor=\"#F0D9D9\">
            <td align=\"left\"></td>
            <td align=\"left\"><strong>TOTAL DE EMPLEADOS</strong></td>
            <td align=\"right\"><strong>".$num2."</strong></td>
            <td align=\"left\"></td>
            </tr>
            <tr bgcolor=\"#F0D9D9\">
            <td align=\"left\"></td>
            <td align=\"left\"><strong>PLANTILLA AUTORIZADA</strong></td>
            <td align=\"right\"><strong>".$totpla."</strong></td>
            <td align=\"left\"></td>
            </tr>
        </table>";
       
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function sup_suc($superv)
    {
     $nivel= $this->session->userdata('nivel');
     $id= $this->session->userdata('id');
     $tot1=0;
     $tot2=0;
     $sql = "SELECT a.*,count(b.nomina)as personal from catalogo.sucursal a 
     left join catalogo.cat_empleado b on b.succ=a.suc and tipo=1
     where 
        a.superv=$superv and b.puestox='MULTIFUNCIONAL'
     or a.superv=$superv and b.puestox like 'ENCARGADO %'
     or a.superv=$superv and b.puestox like 'JEFE MOSTRADOR %'
     group by a.suc order by a.suc";
    

        $query = $this->db->query($sql);
       $l0 = anchor('catalogo_ger/imprime_sup/'.$superv.'/'.$nivel, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
        $tabla= "
        <table>
        <thead>
        <tr>
        <th colspan=\"9\">IMPRIME REPORTE DE SUCURSALES $l0</th>
        </tr>
        <tr>
        <th>TIPO</th>
        <th>ID</th>
        <th>SUCURSAL</th>
        <th>DIRECCION</th>
        <th>POBLACION</th>
        <th>PERSONAL <br />ACTIVO</th>
        <th>PLANTILLA <br />AUTORIZADA</th>
        <th>DIF.</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        
        foreach($query->result() as $row)
        {
            
            $color='black';
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->tipo2."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->suc."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->dire."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->pobla."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->personal."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->plantilla."</font></td>
            <td align=\"right\"><font color=\"$color\">".($row->plantilla-$row->personal)."</font></td>
            </tr>
            ";
$tot1=$tot1+($row->personal);
$tot2=$tot2+($row->plantilla);


        }
        
        $tabla.="
        </tbody>
        <tr>
        <td align=\"right\" colspan=\"5\"><font color=\"$color\"><strong>TOTAL</strong> </font></td>
        <td align=\"right\"><font color=\"$color\"><strong>".$tot1."</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".$tot2."</strong></font></td>
            <td align=\"right\"><font color=\"$color\"><strong>".($tot2-$tot1)."</strong></font></td>
            </tr>
        </table>";
        
        return $tabla;
    }

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

    function ger_suc($gerente)
    {
     $nivel= $this->session->userdata('nivel');
     $id= $this->session->userdata('id');
     $sql = "SELECT a.*,nombre,b.email,b.puesto
from catalogo.sucursal_ger_sup1 a
left join usuarios b on b.plaza=a.superv and nivel=14
	 where 
        regional=$gerente and b.activo=1 and nivel=14 
    	 group by  superv";
	 $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>PLAZA</th>
        <th>NOMBRE</th>
        <th>CORREO</th>
        <th>PUESTO</th>
        <th>SUCURSALES</th>
        <th>PERSONAL<br />ACTIVO</th>
        <th>PLANTILLA<br />AUTORIZADA</th>
        <th>DIF.</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $tot1=0;$tot2=0;
        foreach($query->result() as $row)
        {
            $s = "SELECT a.superv, a.regional,sum(c.emp)as emp 
            from catalogo.sucursal a
	 left join catalogo.cat_empleado_succ c on a.suc=c.succ
	 where 
        regional=$gerente and superv=$row->superv and tlid=1 and a.suc>100 and a.suc<=1999
    	 group by superv";
	 $q = $this->db->query($s);
     if($q->num_rows()> 0){
 		   $r= $q->row();
           $numemp=$r->emp;}else{$numemp=0;}    
            $color='black';
            $l1 = anchor('catalogo_ger/imprime_sup/'.$row->superv.'/'.'14', '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$row->superv."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->numsuc."</font></td>
            <td align=\"center\"><font color=\"$color\">".$numemp."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plantilla."</font></td>
            <td align=\"center\"><font color=\"$color\">".($row->plantilla-$numemp)."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
        $tot1=$tot1+($numemp);
        $tot2=$tot2+($row->plantilla);
        }
        
        $tabla.="
        </tbody>.
        <tr>
            <td align=\"center\" colspan=\"5\"><font color=\"$color\">TOTAL </font></td>
            <td align=\"center\"><font color=\"$color\">".$tot1."</font></td>
            <td align=\"center\"><font color=\"$color\">".$tot2."</font></td>
            <td align=\"center\"><font color=\"$color\">".($tot2-$tot1)."</font></td>
            <td align=\"center\"><font color=\"$color\"></td>
            </tr>
        </table>";
        
        return $tabla;
    }

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

    function ger_suc_ger()
    {
     $nivel= $this->session->userdata('nivel');
     $id= $this->session->userdata('id');
     $sql = "SELECT a.superv,a.regional,sum(a.plantilla)as plantilla,sum(numsuc)as numsuc,
     b.nombre,b.email,b.puesto,b.id as id_sup
	 from catalogo.sucursal_ger_sup1 a
	 left join usuarios b on b.plaza=a.regional
	 where  b.activo=1 and nivel=21 
    	 group by regional";
	 $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        
        <th>NOMBRE</th>
        <th>CORREO</th>
        <th>PUESTO</th>
        <th>SUCURSALES</th>
        <th>PERSONAL<br />ACTIVO</th>
        <th>PLANTILLA<br />AUTORIZADA</th>
        <th>DIF.</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $tot1=0;$tot2=0;
        foreach($query->result() as $row)
        {
            $s = "SELECT a.regional,sum(c.emp)as emp 
            from catalogo.sucursal a
	 left join catalogo.cat_empleado_succ c on a.suc=c.succ
	 where 
        regional=$row->regional and tlid=1 and a.suc>100 and a.suc<=1999
    	 group by regional";
	 $q = $this->db->query($s);
     if($q->num_rows()> 0){
 		   $r= $q->row();
           $numemp=$r->emp;}else{$numemp=0;}
	   
            $color='black';
            $l1 = anchor('catalogo_ger/tabla_sup_asignadas_ger_sup/'.$row->regional, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->numsuc."</font></td>
            <td align=\"center\"><font color=\"$color\">".$numemp."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plantilla."</font></td>
            <td align=\"center\"><font color=\"$color\">".($row->plantilla-$numemp)."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
        $tot1=$tot1+($numemp);
        $tot2=$tot2+($row->plantilla);
        }
        
        $tabla.="
        </tbody>.
        <tr>
            <td align=\"center\" colspan=\"4\"><font color=\"$color\">TOTAL </font></td>
            <td align=\"center\"><font color=\"$color\">".$tot1."</font></td>
            <td align=\"center\"><font color=\"$color\">".$tot2."</font></td>
            <td align=\"center\"><font color=\"$color\">".($tot2-$tot1)."</font></td>
            <td align=\"center\"><font color=\"$color\"></td>
            </tr>
        </table>";
        
        return $tabla;
    }
    
    ///////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

    function ger_suc_par($plaza)
    {
     
     $nivel= $this->session->userdata('nivel');
     $id= $this->session->userdata('id');
     $sql = "SELECT a.superv,a.regional,sum(a.plantilla)as plantilla,sum(numsuc)as numsuc,
     b.nombre,b.email,b.puesto,b.id as id_sup
	 from catalogo.sucursal_ger_sup1 a
	 left join usuarios b on b.plaza=a.regional
	 where  b.activo=1 and nivel=21 and a.regional=$plaza
    	 group by regional";
  
     
	 $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        
        <th>NOMBRE</th>
        <th>CORREO</th>
        <th>PUESTO</th>
        <th>SUCURSALES</th>
        <th>PERSONAL<br />ACTIVO</th>
        <th>PLANTILLA<br />AUTORIZADA</th>
        <th>DIF.</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $tot1=0;$tot2=0;
        foreach($query->result() as $row)
        {
            $s = "SELECT a.regional,sum(c.emp)as emp 
            from catalogo.sucursal a
	 left join catalogo.cat_empleado_succ c on a.suc=c.succ
	 where 
        regional=$row->regional and tlid=1 and a.suc>100 and a.suc<=1999
    	 group by regional";
	 $q = $this->db->query($s);
     if($q->num_rows()> 0){
 		   $r= $q->row();
           $numemp=$r->emp;}else{$numemp=0;}
	   
            $color='black';
            $l1 = anchor('catalogo_ger/tabla_sup_asignadas_ger_sup/'.$row->regional, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            <td align=\"left\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->email."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->puesto."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->numsuc."</font></td>
            <td align=\"center\"><font color=\"$color\">".$numemp."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->plantilla."</font></td>
            <td align=\"center\"><font color=\"$color\">".($row->plantilla-$numemp)."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
        $tot1=$tot1+($numemp);
        $tot2=$tot2+($row->plantilla);
        }
        
        $tabla.="
        </tbody>.
        <tr>
            <td align=\"center\" colspan=\"4\"><font color=\"$color\">TOTAL </font></td>
            <td align=\"center\"><font color=\"$color\">".$tot1."</font></td>
            <td align=\"center\"><font color=\"$color\">".$tot2."</font></td>
            <td align=\"center\"><font color=\"$color\">".($tot2-$tot1)."</font></td>
            <td align=\"center\"><font color=\"$color\"></td>
            </tr>
        </table>";
        
        return $tabla;
    }
    
    ///////////////////////////////////////////////////////////////////////////////////

    function cat_farmabodega()
    {
     $sql = "select tsec,clabo,codigo,susa1,susa2,vtabo from catalogo.almacen  where clabo>0
             order by clabo ";
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Tipo</th>
        <th>Sec</th>
        <th>Codigo</th>
        <th>Sus. Activa</th>
        <th>Sus. Activa</th>
        <th>Precio Vta</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $num=1;
        foreach($query->result() as $row)
        {
            if($row->tsec=='X')
            {$color='red'; $tipox='Descontinuado';
            }else{
            $color='black'; $tipox='Activo';
            }
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$num."</font></td>
            <td align=\"center\"><font color=\"$color\">".$tipox."</font></td>
            <td align=\"center\"><font color=\"$color\">".$row->clabo."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa1."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->susa2."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->vtabo."</font></td>
            </tr>
            ";
        $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function calculo_vacacion()
{
$s="select cia,nomina,fechahis,fechaalta,0,tipo, (year(now())-date_format(fechahis,'%Y'))as aaa_trab, date_format(fechahis,'%Y')as aaa
from catalogo.cat_empleado where  fechahis>'0000-00-00' and date_format(fechahis,'%Y')<year(now()) and tipo=1";
$q=$this->db->query($s);
foreach($q->result() as $r)
{
    $a = array();
    for($i = 1; $i <= $r->aaa_trab; $i++)
    {
    $s1="select *from desarrollo.periodo_vacas where aaa=$i";
    $q1=$this->db->query($s1);
    $r1= $q1->row();
    $dias=$r1->dias;    
    echo $r->nomina."-".($r->aaa-1+$i)."-".($r->aaa+$i)."-".$i."-".$dias."<br />";
    $m="insert into desarrollo.periodo_vacas_detaller(cia, nomina, aaa1, aaa2, dias, aaa, dias_ley)
    values($r->cia,$r->nomina,($r->aaa-1+$i),($r->aaa+$i),$dias,$i,$dias)on duplicate key update dias_ley=values(dias_ley);";
    $this->db->query($m);
    }
}    
die();
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////











































































































}
