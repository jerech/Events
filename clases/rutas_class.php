<?php
class Rutas
{
	private $id;
	private $nombre;
	private $descripcion;
	private $estado_registro;
    private $empresa_numero;
	private $created_at;
	private $updated_at;
    private $tiempo;
	
	

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nombre.
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the value of nombre.
     *
     * @param mixed $nombre the nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Gets the value of descripcion.
     *
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Sets the value of descripcion.
     *
     * @param mixed $descripcion the descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    
    /**
     * Gets the value of estado_registro.
     *
     * @return mixed
     */
    public function getEstado_registro()
    {
        return $this->estado_registro;
    }

    /**
     * Sets the value of estado_registro.
     *
     * @param mixed $estado_registro the estado_registro
     *
     * @return self
     */
    public function setEstado_registro($estado_registro)
    {
        $this->estado_registro = $estado_registro;

        return $this;
    }

     /**
     * Gets the value of created_at.
     *
     * @return mixed
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Sets the value of created_at.
     *
     * @param mixed $created_at the created_at
     *
     * @return self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Gets the value of updated_at.
     *
     * @return mixed
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Sets the value of updated_at.
     *
     * @param mixed $updated_at the updated_at
     *
     * @return self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

     /**
     * Gets the value of empresa_numero.
     *
     * @return mixed
     */
    public function getEmpresa_numero()
    {
        return $this->empresa_numero;
    }

    /**
     * Sets the value of empresa_numero.
     *
     * @param mixed $empresa_numero the empresa_numero
     *
     * @return self
     */
    public function setEmpresa_numero($empresa_numero)
    {
        $this->empresa_numero = $empresa_numero;

        return $this;
    }

    /**
     * Gets the value of tiempo.
     *
     * @return mixed
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Sets the value of tiempo.
     *
     * @param mixed $tiempo the tiempo
     *
     * @return self
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    function __construct($id="")
    {
        global $db;

        if ($id!="")
        {
            $sql="SELECT * FROM rutas WHERE id=".$id." ";
            //echo $sql;
            $result=$db->executeQuery($sql);
            $db->commit();

            if (isset($result))
            {
                if (count($result)>0)
                {
                    foreach($result[0] as $key=>$value)
                    {
                        $this->$key=$value;
                    }
                }
            }
            return $this;
        }
        
    }

    public function buscar($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20")
    {
        global $db;

        $resultado=array();

     		$sql="SELECT * FROM rutas 
          ";

        $condicion="";
        if (count($aWhere)>0)
        {
            if ($condicion=="")
                $condicion.=" WHERE ";
            $i=0;
            foreach($aWhere as $key=>$value)
            {
                $pos = strpos($key, "<") || strpos($key, ">");

                if ($pos===false)
                {
                    $comparar="=";
                }
                else
                {
                    $comparar=substr($key,$pos);
                    $key=substr($key, 0,$pos);
                }
                if ($i==0)
                    $condicion.=" ".$key.$comparar.$value;
                else
                    $condicion.=" AND ".$key.$comparar.$value;
                
                $i++;
            }
        }

        if (count($aOrWhere)>0)
        {
            if ($condicion=="")
                $condicion.=" WHERE ";
            else
                $condicion.=" AND ";
            $i=0;
            foreach($aOrWhere as $key=>$value)
            {
                $type="<";
                $pos = strpos($key, "<") ;
                if ($pos===false)
                {
                    $type=">";
                    $pos = strpos($key, ">");
                    if ($pos===false)
                    {
                        $type="like";
                        $pos =strpos($key, "like");
                        if ($pos===false)
                        {
                            $type="IN";
                            $pos =strpos($key, "IN");
                        }
                    }
                }

                if ($pos===false)
                {
                    $comparar="=";
                }
                else
                {
                    $pos=strpos($key, $type);
                   
                    $comparar=substr($key,$pos);
                    $key=substr($key, 0,$pos);
                }
                if ($i==0)
                {
                    if ($comparar=="like")
                        $condicion.=" (".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" (".$key.$comparar."".$value."";
                    else   
                        $condicion.=" (".$key.$comparar."'".$value."'";
                }
                else
                {
                    if ($comparar=="like")
                        $condicion.=" OR ".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" OR ".$key.$comparar."".$value."";
                    else
                        $condicion.=" OR ".$key.$comparar."'".$value."'";
                }

                $i++;
            }
            $condicion.=") ";
        }
        $sql.=$condicion;
            if ($page!="")
            {
                $sql.=" LIMIT ".$per_page." OFFSET ".$page;
            }
                //echo $sql;
                $result=$db->executeQuery($sql);
                $db->commit();

                if (isset($result))
                {
                    if (count($result)>0)
                    {
                        $index=0;
                        foreach($result as $objeto)
                        {   
                            $resultado[$index]=new self();
                            foreach($objeto as $key=>$value)
                            {
                                $resultado[$index]->$key=$value;
                            }
                            $index++;
                        }
                    }
                }
                
        

        return $resultado;

    }

    # Obtener el Id del Ultimo Registro
        function getUltimoId() 
        {
            global $db;

            $sql = "SELECT max(id) FROM rutas";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                        foreach($obj as $value) {
                            return $value;
                        }
                    }
                }
            }
        }

        function getCountPuntosChequeo() 
        {
            global $db;

            $sql = "SELECT count(*) as total FROM rutas_chequeo WHERE idruta=".$this->getId();
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                        foreach($obj as $value) {
                            return $value;
                        }
                    }
                }
            }
        }

        function getPuntosChequeo() 
        {
            global $db;
            $result=array();
            $sql = "SELECT * FROM rutas_chequeo WHERE idruta=".$this->getId()." ORDER BY orden ASC";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       $result[]=$obj; 
                    }
                }
            }

            return $result;
        }
    function agregar($array_puntos=array()){
        global $db;

        $resultado=false;

        $sql="INSERT INTO rutas (nombre,descripcion,estado_registro,empresa_numero,updated_at,created_at,tiempo) 
              VALUES ('".$this->getNombre()."','".$this->getDescripcion()."','".$this->getEstado_registro()."','".$this->getEmpresa_numero()."',NOW(),NOW(),'".$this->getTiempo()."')";
        
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        $ruta=$this->getUltimoId();

        if (count($array_puntos)>0)
        {
            $orden=1;
            foreach($array_puntos as $val)
            {
                $ins="INSERT INTO rutas_chequeo (idruta,idpunto,orden) VALUES ('".$ruta."','".$val."','".$orden."') ";
                $resQuery = $db->executeQuery($ins);
                $db->commit();
                $orden++;
            }
        }

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;


    }

    function modificar($array_puntos=array()){
        global $db;

        $resultado=false;

        $sql="UPDATE rutas SET nombre='".$this->getNombre()."',
                    descripcion='".$this->getDescripcion()."',
                    estado_registro='".$this->getEstado_registro()."',
                    empresa_numero='".$this->getEmpresa_numero()."',
                    tiempo='".$this->getTiempo()."',
                    updated_at=NOW()
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        $aWhere=array();
        $aWhere['id']=$this->getId();
        $aRutas=$this->buscar($aWhere);

        $del="DELETE FROM rutas_chequeo where idruta='".$aRutas[0]->getId()."'";
        $resQuery = $db->executeQuery($del);
        $db->commit();

        if (count($array_puntos)>0)
        {
            $orden=1;
            foreach($array_puntos as $val)
            {
                $ins="INSERT INTO rutas_chequeo (idruta,idpunto,orden) VALUES ('".$aRutas[0]->getId()."','".$val."','".$orden."') ";
                $resQuery = $db->executeQuery($ins);
                $db->commit();
                $orden++;
            }
        }

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;

    }

    function eliminar(){
        global $db;

        $resultado=false;

        $sql="UPDATE rutas SET 
                    estado_registro='".$this->getEstado_registro()."',
                    updated_at=NOW()
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;

    }
}
?>