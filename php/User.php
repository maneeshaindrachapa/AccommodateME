<?php
abstract class User{
    private $firstName;
    private $lastName;
    private $email;
    private $telephone;
    private $password;
    private $active;
    private $type;
    
    public function __contruct($firstName,$lastName,$email,$password,$telephone,$type,$active){
        $this->$firstName=$firstName;
        $this->$lastName=$lastName;
        $this->$email=$email;
        $this->$password=$password;
        $this->$telephone=$telephone;
        $this->$type=$type;
        $this->$active=$active;
    }
    
    //Getter
    public function __get($property){
        if(property_exsits($this,$property)){
            return $this->$property;
        }
    }
    
    //setter
    public function __set($property,$value){
        if(property_exsits($this,$property)){
            $this->$property=$value;
        }
    }
}

?>