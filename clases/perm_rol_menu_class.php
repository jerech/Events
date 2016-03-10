<?php
class Perm_rol_menu{
	private $rol_numero;
	private $idmenu;
    private $ver;
    private $agregar;
    private $modificar;
    private $eliminar;

	
    

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
     * Gets the value of idmenu.
     *
     * @return mixed
     */
    public function getIdmenu()
    {
        return $this->idmenu;
    }

    /**
     * Sets the value of idmenu.
     *
     * @param mixed $idmenu the idmenu
     *
     * @return self
     */
    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;

        return $this;
    }

    /**
     * Gets the value of ver.
     *
     * @return mixed
     */
    public function getVer()
    {
        return $this->ver;
    }

    /**
     * Sets the value of ver.
     *
     * @param mixed $ver the ver
     *
     * @return self
     */
    public function setVer($ver)
    {
        $this->ver = $ver;

        return $this;
    }

    /**
     * Gets the value of agregar.
     *
     * @return mixed
     */
    public function getAgregar()
    {
        return $this->agregar;
    }

    /**
     * Sets the value of agregar.
     *
     * @param mixed $agregar the agregar
     *
     * @return self
     */
    public function setAgregar($agregar)
    {
        $this->agregar = $agregar;

        return $this;
    }

    /**
     * Gets the value of modificar.
     *
     * @return mixed
     */
    public function getModificar()
    {
        return $this->modificar;
    }

    /**
     * Sets the value of modificar.
     *
     * @param mixed $modificar the modificar
     *
     * @return self
     */
    public function setModificar($modificar)
    {
        $this->modificar = $modificar;

        return $this;
    }

    /**
     * Gets the value of eliminar.
     *
     * @return mixed
     */
    public function getEliminar()
    {
        return $this->eliminar;
    }

    /**
     * Sets the value of eliminar.
     *
     * @param mixed $eliminar the eliminar
     *
     * @return self
     */
    public function setEliminar($eliminar)
    {
        $this->eliminar = $eliminar;

        return $this;
    }

    public function buscar($aWhere=array())
    {
        global $db;

        $resultado=array();

        $sql="SELECT * FROM perm_rol_menu ";

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
                
        }

        return $resultado;

    }

    function agregar($menus=array())
    {
        global $db;

        $resultado=false;
        if (count($menus)>0)
        {
            $sql="DELETE FROM perm_rol_menu WHERE rol_numero='".$this->getRol_numero()."'";

            foreach($menus as $value)
            {
                //var_dump($value);die();
                $sql.="&INSERT INTO perm_rol_menu (rol_numero,idmenu,ver,agregar,modificar,eliminar) 
                VALUES ('".$this->getRol_numero()."','".$value['idmenu']."','".$value['ver']."','".$value['agregar']."','".$value['modificar']."','".$value['eliminar']."')";
            }
            

        }
        else
        {
            $sql="DELETE FROM perm_rol_menu WHERE rol_numero='".$this->getRol_numero()."'";

        }

        //echo $sql;die();
        
        if ($db->executeUpdate($sql)=="OK")
        {
            $resultado=true;
        }

        return $resultado;
    }


    
}
?>