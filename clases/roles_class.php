<?php
class Roles{

	private $id;
	private $rol_numero;
	private $rol;
	private $estado_registro;
	private $descripcion;
	private $usuario_numero;
	private $created_at;
	private $updated_at;
    private $roles;


	function __construct($id="",$rol_numero="")
        {
            global $db;

            if ($id!="")
            {
                $sql="SELECT * FROM roles WHERE id=".$id." AND estado_registro=1 LIMIT 1";
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
            else if ($rol_numero!="")
            {
                 $sql="SELECT * FROM roles WHERE rol_numero=".$rol_numero." AND estado_registro=1 LIMIT 1";
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
     * Gets the value of rol_numero.
     *
     * @return mixed
     */
    public function getRol_numero()
    {
        return $this->rol_numero;
    }

    /**
     * Sets the value of rol_numero.
     *
     * @param mixed $rol_numero the rol_numero
     *
     * @return self
     */
    public function setRol_numero($rol_numero)
    {
        $this->rol_numero = $rol_numero;

        return $this;
    }

    /**
     * Gets the value of rol.
     *
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Sets the value of rol.
     *
     * @param mixed $rol the rol
     *
     * @return self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

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
     * Gets the value of usuario_numero.
     *
     * @return mixed
     */
    public function getUsuario_numero()
    {
        return $this->usuario_numero;
    }

    /**
     * Sets the value of usuario_numero.
     *
     * @param mixed $usuario_numero the usuario_numero
     *
     * @return self
     */
    public function setUsuario_numero($usuario_numero)
    {
        $this->usuario_numero = $usuario_numero;

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
     * Gets the value of nivel.
     *
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Sets the value of nivel.
     *
     * @param mixed $nivel the nivel
     *
     * @return self
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function buscar($aWhere=array())
    {
        global $db;

        $resultado=array();

        $sql="SELECT * FROM roles ";

        if (count($aWhere)>0)
        {
            $sql.=" WHERE ";
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
                    $sql.=" ".$key.$comparar.$value;
                else
                    $sql.=" AND ".$key.$comparar.$value;
                
                $i++;
            }
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
                
        }

        return $resultado;

    }

    function agregar(){
        global $db;

        $resultado=false;

        $sql="INSERT INTO roles (rol,descripcion,usuario_numero,estado_registro,updated_at,created_at,nivel) 
              VALUES ('".$this->getRol()."','".$this->getDescripcion()."','".$this->getUsuario_numero()."',
                '".$this->getEstado_registro()."',NOW(),NOW(),'".$this->getNivel()."')";
        
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;


    }

    function modificar(){
        global $db;

        $resultado=false;

        $sql="UPDATE roles SET rol='".$this->getRol()."',
                    descripcion='".$this->getDescripcion()."',
                    usuario_numero='".$this->getUsuario_numero()."',
                    estado_registro='".$this->getEstado_registro()."',
                    updated_at=NOW(),
                    nivel='".$this->getNivel()."'
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;

    }

    function eliminar(){
        global $db;

        $resultado=false;

        $sql="UPDATE roles SET estado_registro='".$this->getEstado_registro()."',
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

     # Obtener el Id del Ultimo Registro
        function getMaxNivel() 
        {
            global $db;

            $sql = "SELECT max(nivel) FROM roles";
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
}
?>