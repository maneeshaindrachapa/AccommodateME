<?php
class User_owner extends User{
    public function __construct($firstName,$lastName,$email,$password,$type,$active){
        parent::__contruct($firstName,$lastName,$email,$password,$type,$active);
    }
}
?>