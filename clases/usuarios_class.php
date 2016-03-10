<?php
	class Usuarios{
		private $id;
		private $empresa_numero;
		private $usuario_numero;
		private $nombre;
		private $codigo;
		private $telefono;
		private $email;
		private $imagen;
		private $login;
		private $password;
		private $password_movil;
		private $director_usuario;
		private $rol_numero;
		private $estado_registro;
		private $renember_token;
		private $created_at;
		private $updated_at;
		private $imei;
        private $idturno;
        private $idarea;

		function __construct($id="")
        {
            global $db;

            if ($id!="")
            {
                $sql="SELECT * FROM usuarios WHERE id=".$id." AND estado_registro=1 LIMIT 1";
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
     * Gets the value of codigo.
     *
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Sets the value of codigo.
     *
     * @param mixed $codigo the codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Gets the value of telefono.
     *
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Sets the value of telefono.
     *
     * @param mixed $telefono the telefono
     *
     * @return self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of imagen.
     *
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Sets the value of imagen.
     *
     * @param mixed $imagen the imagen
     *
     * @return self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param mixed $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the value of password_movil.
     *
     * @return mixed
     */
    public function getPassword_movil()
    {
        return $this->password_movil;
    }

    /**
     * Sets the value of password_movil.
     *
     * @param mixed $password_movil the password_movil
     *
     * @return self
     */
    public function setPassword_movil($password_movil)
    {
        $this->password_movil = $password_movil;

        return $this;
    }

    /**
     * Gets the value of director_usuario.
     *
     * @return mixed
     */
    public function getDirector_usuario()
    {
        return $this->director_usuario;
    }

    /**
     * Sets the value of director_usuario.
     *
     * @param mixed $director_usuario the director_usuario
     *
     * @return self
     */
    public function setDirector_usuario($director_usuario)
    {
        $this->director_usuario = $director_usuario;

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
     * Gets the value of renember_token.
     *
     * @return mixed
     */
    public function getRenember_token()
    {
        return $this->renember_token;
    }

    /**
     * Sets the value of renember_token.
     *
     * @param mixed $renember_token the renember_token
     *
     * @return self
     */
    public function setRenember_token($renember_token)
    {
        $this->renember_token = $renember_token;

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
     * Gets the value of imei.
     *
     * @return mixed
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Sets the value of imei.
     *
     * @param mixed $imei the imei
     *
     * @return self
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Gets the value of idturno.
     *
     * @return mixed
     */
    public function getIdturno()
    {
        return $this->idturno;
    }

    /**
     * Sets the value of idturno.
     *
     * @param mixed $idturno the idturno
     *
     * @return self
     */
    public function setIdturno($idturno)
    {
        $this->idturno = $idturno;

        return $this;
    }

     /**
     * Gets the value of idarea.
     *
     * @return mixed
     */
    public function getIdarea()
    {
        return $this->idarea;
    }

    /**
     * Sets the value of idarea.
     *
     * @param mixed $idarea the idarea
     *
     * @return self
     */
    public function setIdarea($idarea)
    {
        $this->idarea = $idarea;

        return $this;
    }

    public function login(){
        global $db;

        $resultado=false;

        $sql="SELECT * FROM usuarios WHERE login='".$this->login."' AND password_movil=md5('".$this->password_movil."') AND estado_registro<>3 LIMIT 1";
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            if (count($result)>0)
            {
                foreach($result as $arResult)
                {
                    $this->setId($arResult['id']);
                    $this->setUsuario_numero($arResult['usuario_numero']);
                    $resultado=true;

                }
            }
        }

        return $resultado;
    }

    public function buscar($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20")
    {
        global $db;

        $resultado=array();

        $sql="SELECT * FROM usuarios ";

        $condicion="";
            if (count($aWhere)>0)
            {
                if ($condicion=="")
                    $condicion.=" WHERE ";
                $i=0;
                foreach($aWhere as $key=>$value)
                {
                    $type="<";
                    $pos = strpos($key, "<") ;
                    if ($pos===false)
                    {
                        $type=">";
                        $pos = strpos($key, ">");
                        if ($pos===false)
                        {
                            $type="ilike";
                            $pos =strpos($key, "ilike");
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
                        if ($comparar=="ilike")
                            $condicion.=" ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" ".$key.$comparar."".$value."";
                        else   
                            $condicion.=" ".$key.$comparar."'".$value."'";
                    }
                    else
                    {
                        if ($comparar=="ilike")
                            $condicion.=" AND ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" AND ".$key.$comparar."".$value."";
                        else
                            $condicion.=" AND ".$key.$comparar."'".$value."'";
                    }
                    
                    
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
                            $type="ilike";
                            $pos =strpos($key, "ilike");
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
                        if ($comparar=="ilike")
                            $condicion.=" (".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" (".$key.$comparar."".$value."";
                        else   
                            $condicion.=" (".$key.$comparar."'".$value."'";
                    }
                    else
                    {
                        if ($comparar=="ilike")
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

    function agregar(){
        global $db;

        $resultado=false;

        $sql="INSERT INTO usuarios (empresa_numero,nombre,codigo,telefono,email,login,password,password_movil,rol_numero,estado_registro,director_usuario,imei,imagen,updated_at,created_at) 
              VALUES ('".$this->getEmpresa_numero()."','".$this->getNombre()."','".$this->getCodigo()."',
                '".$this->getTelefono()."','".$this->getEmail()."','".$this->getLogin()."',md5('".$this->getPassword()."'),
                md5('".$this->getPassword_movil()."'),'".$this->getRol_numero()."','".$this->getEstado_registro()."','".$this->getDirector_usuario()."','".$this->getImei()."','".$this->getImagen()."',NOW(),NOW())";
        
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

        $sql="UPDATE usuarios SET empresa_numero='".$this->getEmpresa_numero()."',
                    nombre='".$this->getNombre()."',
                    codigo='".$this->getCodigo()."',
                    telefono='".$this->getTelefono()."',
                    email='".$this->getEmail()."',
                    login='".$this->getLogin()."',
                    rol_numero='".$this->getRol_numero()."',
                    estado_registro='".$this->getEstado_registro()."',
                    director_usuario='".$this->getDirector_usuario()."',
                    imei='".$this->getImei()."',
                    imagen='".$this->getImagen()."',
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

        $sql="UPDATE usuarios SET estado_registro='".$this->getEstado_registro()."',
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

    function modificarPass(){

         global $db;

        $resultado=false;
        // password=md5('".$this->getPassword()."'),

        $sql="UPDATE usuarios SET 
                    password_movil=md5('".$this->getPassword_movil()."'),
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


    function importar($array_campo,$array_valor,$codigo,$empresa_numero)
    {
        global $db;
        
        $sql = "SELECT * FROM usuarios where codigo='".$codigo."'";
        $res = $db->executeQuery($sql);
        $db->commit();
        $count=0;
        if (isset($res)) {
            if (count($res) > 0) {
                $sql="UPDATE usuarios SET ";
                for($i=0;$i<count($array_campo);$i++)
                {   
                    if ($i==0)
                        $sql.=$array_campo[$i]."='".$array_valor[$i]."' ";
                    else
                        $sql.=",".$array_campo[$i]."='".$array_valor[$i]."' ";
                            
                }
                $sql.=" WHERE codigo='".$codigo."' ";

                //echo $sql;
                $resQuery = $db->Query($sql);
                if ($resQuery)
                {
                   $count++;
                }
                    
            }
            else
            {
                $sql="INSERT INTO usuarios (codigo,empresa_numero,password_movil";

                for($i=0;$i<count($array_campo);$i++)
                {
                    $sql.=",".$array_campo[$i];
                }

                $sql.=") VALUES ('".$codigo."','".$empresa_numero."',md5('123')";

                for($i=0;$i<count($array_valor);$i++)
                {
                    $sql.=",'".$array_valor[$i]."'";
                }

                $sql.=")";
                $resQuery = $db->Query($sql);
                if ($resQuery)
                {
                     $count++;
                    
                }
            }
        }
        return $count;
    }

    

   
}
?>