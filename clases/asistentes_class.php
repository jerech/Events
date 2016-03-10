<?php
	class Asistentes{
		private $id;
		private $empresa_numero;
		private $nombre;
		private $apellido;
		private $telefono;
		private $email;
		private $estado;
		private $documento;
        private $id_identificacion;
        private $es_acompaniante;
        private $codigo;
        private $id_evento;

		function __construct($id="")
        {
            global $db;

            if ($id!="")
            {
                $sql="SELECT * FROM asistentes WHERE id=".$id." AND estado=1 LIMIT 1";
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
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId_evento()
    {
        return $this->id_evento;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId_evento($evento)
    {
        $this->id_evento = $evento;

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
     * Gets the value of nombre.
     *
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Sets the value of nombre.
     *
     * @param mixed $nombre the nombre
     *
     * @return self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Gets the value of codigo.
     *
     * @return mixed
     */
    public function getEs_acompaniante()
    {
        return $this->es_acompaniante;
    }

    /**
     * Sets the value of codigo.
     *
     * @param mixed $codigo the codigo
     *
     * @return self
     */
    public function setEs_acompaniante($es_acompaniante)
    {
        $this->es_acompaniante = $es_acompaniante;

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
     * Gets the value of telefono.
     *
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Sets the value of telefono.
     *
     * @param mixed $telefono the telefono
     *
     * @return self
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

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
     * Gets the value of estado_registro.
     *
     * @return mixed
     */
    public function getEstado_registro()
    {
        return $this->estado;
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
        $this->estado = $estado_registro;

        return $this;
    }

    /**
     * Gets the value of renember_token.
     *
     * @return mixed
     */
    public function getId_identificacion()
    {
        return $this->id_identificacion;
    }

    /**
     * Sets the value of renember_token.
     *
     * @param mixed $renember_token the renember_token
     *
     * @return self
     */
    public function setId_identificacion($id_identificacion)
    {
        $this->id_identificacion = $id_identificacion;

        return $this;
    }

    

   

   


    public function buscar($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20")
    {
        global $db;
        $aWhere['es_acompaniante']="false";
        $resultado=array();

        $sql="SELECT * FROM asistentes ";

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


    public function buscar2($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20")
    {
        global $db;
        $aWhere['es_acompaniante']="false";
        $resultado=array();


        $sql="SELECT a.id, a.empresa_numero, a.nombre, a.apellido, a.telefono,
                     a.email, ae.estado, a.documento, a.id_identificacion, a.es_acompaniante,
                     ae.codigo, ae.id_evento FROM asistente_evento as ae left join asistentes as a on ae.id_asistente=a.id";

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

        $sql="INSERT INTO asistentes (nombre,apellido,estado,es_acompaniante,documento,email,telefono,id_identificacion,empresa_numero) 
              VALUES ('".$this->getNombre()."','".$this->getApellido()."',
                '".$this->getEstado_registro()."','".$this->getEs_acompaniante()."','".$this->getDocumento()."',
                '".$this->getEmail()."','".$this->getTelefono()."','".$this->getId_identificacion()."','".$this->getEmpresa_numero()."')";
        
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;


    }

    function agregarAcompaniante($Acompaniante){
        global $db;

        $resultado=false;

        $sql="INSERT INTO asistentes (nombre,apellido,estado,es_acompaniante,documento) 
              VALUES ('".$Acompaniante->getNombre()."','".$Acompaniante->getApellido()."',
                '".$Acompaniante->getEstado_registro()."','".$Acompaniante->getEs_acompaniante()."','".$Acompaniante->getDocumento()."')";
        
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
            $query3="select max(id) as id from asistentes"; 

        $datos2=$db->executeQuery($query3);
        $db->commit();

        $id=(int) $datos2[0]['id'];
            $sqlUpdate="UPDATE asistentes SET id_acompaniante=".$id." where id=".$this->getId();
            $result=$db->executeQuery($sqlUpdate);
            $db->commit();

        {
            $resultado=true;
        }

        return $resultado;


    }

    function modificar(){
        global $db;

        $resultado=false;

        $sql="UPDATE asistentes SET empresa_numero='".$this->getEmpresa_numero()."',
                    nombre='".$this->getNombre()."',
                    apellido='".$this->getApellido()."',
                    telefono='".$this->getTelefono()."',
                    email='".$this->getEmail()."',
                    es_acompaniante='false',
                    documento='".$this->getDocumento()."',
                    estado='".$this->getEstado_registro()."',
                    id_identificacion='".$this->getId_identificacion()."'
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;

    }

    function importar($array_campo,$array_valor,$empresa_numero, $id_evento)
        {
            global $db;
            $nombre="";
            $apellido="";
            $count=0;
            //Verificamos si el asistente existe
            for($i=0;$i<count($array_campo);$i++)
            {   
                if($array_campo[$i]=='nombre'){
                    $nombre=$array_valor[$i];
                }
                if($array_campo[$i]=='apellido'){
                    $apellido=$array_valor[$i];
                }

            }
            $sqlS="select * from asistentes where nombre='$nombre' and apellido='$apellido'";
            $resS = $db->executeQuery($sqlS);
            $db->commit();



            if(count($resS)==0){
                $sql="INSERT INTO asistentes (estado,empresa_numero";
                    $codigo_barra="";
                    for($i=0;$i<count($array_campo);$i++)
                    {   
                        if($array_campo[$i]!="codigo_barra"){
                            $sql.=",".$array_campo[$i];
                        }
                        
                    }

                    $sql.=") VALUES (1,'".$empresa_numero."'";

                    for($i=0;$i<count($array_valor);$i++)
                    {   
                        if($array_campo[$i]!="codigo_barra"){
                            $sql.=",'".$array_valor[$i]."'";
                        }else{
                            $codigo_barra=$array_valor[$i];
                        }
                        
                    }

                    $sql.=")";
                    //echo $sql;
                    $resQuery = $db->executeQuery($sql);
                    $db->commit();
                    
                    $query3="select max(id) as id from asistentes"; 

                    $datos2=$db->executeQuery($query3);
                    $db->commit();
                    $id=$datos2[0]['id'];

                    $sqlR="INSERT INTO asistente_evento(estado, id_evento, id_asistente, codigo) values(1, $id_evento, $id, '$codigo_barra')";

                    $res = $db->executeQuery($sqlR);
                    $db->commit();

                    

                    
                    $count++;
            }else{
                    $id=$resS[0]['id'];
                    $sql="UPDATE asistentes SET empresa_numero='".$empresa_numero."',estado=1";


                    $codigo_barra="";
                    for($i=0;$i<count($array_campo);$i++)
                    {   
                        if($array_campo[$i]!="codigo_barra"){
                            $sql.=",".$array_campo[$i]."='".$array_valor[$i]."'";
                        }
                        
                    }

                    $sql.=" where id=".$id;

                  
                    //echo $sql;
                    $resQuery = $db->executeQuery($sql);
                    $db->commit();
               

                    $sqlDel="delete from asistente_evento where id_evento=".$id_evento." and id_asistente=".$id;
                    $resDel = $db->executeQuery($sqlDel);
                    $db->commit();

                    $sqlR="INSERT INTO asistente_evento(estado, id_evento, id_asistente, codigo) values(1, $id_evento, $id, '$codigo_barra')";

                    $res = $db->executeQuery($sqlR);
                    $db->commit();

                    

                    
                    $count++;

            }
                    
                    //return $sql." ".$ins." ".$inslst."<br>";
                

            return $count;

        }

    function setEstadoRegistrado($idEvento){
        global $db;

        $resultado=false;

        $sql="UPDATE asistente_evento SET estado=4
                WHERE id_asistente='".$this->getId()."' and id_evento='".$idEvento."'";

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

        $sql="UPDATE asistentes SET estado='".$this->getEstado_registro()."'
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;

    }
function asociar($array_eventos=array(),$quitarAsociacion)
        {
            global $db;

            $resultado=true;

            $aWhere=array();

            if ($quitarAsociacion=="1")
            {
                $del="DELETE FROM asistente_evento where id_asistente='".$this->getId()."'";
                $resQuery = $db->executeQuery($del);
                $db->commit();
            }
            
            if (count($array_eventos)>0)
            {
                foreach($array_eventos as $valEven)
                {
                    $ins="INSERT INTO asistente_evento (id_asistente,id_evento, estado, codigo) VALUES ('".$this->getId()."','".$valEven."', 1,'".$this->getCodigo()."') ";
                    $result = $db->executeQuery($ins);
                    $db->commit();

                    
                }
            }

            

            return $resultado;
        }
 }

 


    
?>