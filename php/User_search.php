<?php
class User_search extends User{
    public function __construct($firstName,$lastName,$email,$password,$type,$active){
        parent::__contruct($firstName,$lastName,$email,$password,$type,$active);
    }
}
?>