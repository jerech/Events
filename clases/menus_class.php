<?php
class Menus{
	private $id;
	private $nombre;
	private $icono;
	private $idpadre;
	private $estado_registro;
	private $created_at;
	private $updated_at;
	private $destino;

	function __construct($id="")
        {
            global $db;

            if ($id!="")
            {
                $sql="SELECT * FROM menus WHERE id=".$id." AND estado_registro=1 LIMIT 1";
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
     * Gets the value of icono.
     *
     * @return mixed
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Sets the value of icono.
     *
     * @param mixed $icono the icono
     *
     * @return self
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;

        return $this;
    }

    /**
     * Gets the value of idpadre.
     *
     * @return mixed
     */
    public function getIdpadre()
    {
        return $this->idpadre;
    }

    /**
     * Sets the value of idpadre.
     *
     * @param mixed $idpadre the idpadre
     *
     * @return self
     */
    public function setIdpadre($idpadre)
    {
        $this->idpadre = $idpadre;

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
     * Gets the value of destino.
     *
     * @return mixed
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Sets the value of destino.
     *
     * @param mixed $destino the destino
     *
     * @return self
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    public function buscar($aWhere=array())
    {
    	global $db;

    	$resultado=array();

    	$sql="SELECT * FROM menus ";

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

        $sql="INSERT INTO menus (nombre,icono,destino,idpadre,estado_registro,updated_at,created_at) 
              VALUES ('".$this->getNombre()."','".$this->getIcono()."','".$this->getDestino()."',
                '".$this->getIdpadre()."','".$this->getEstado_registro()."',NOW(),NOW())";
        
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

        $sql="UPDATE menus SET nombre='".$this->getNombre()."',
                    icono='".$this->getIcono()."',
                    destino='".$this->getDestino()."',
                    idpadre='".$this->getIdpadre()."',
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

    function eliminar(){
        global $db;

        $resultado=false;

        $sql="UPDATE menus SET 
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