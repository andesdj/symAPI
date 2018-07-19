<?php
namespace AppBundle\Services;
use Firebase\JWT\JWT;

class JwtAuth {
   public $manager;
   public function __construct ($manager){
       $this->manager=$manager;
    }
    
   public function signup($email, $password, $getHash=NULL){
       $key="clave-secreta";
       
       $user =$this->manager->getRepository('BackendBundle:User')->findOneBy(
               array (
                   "email"=>$email,
                   "password"=>$password
               )
               );
       
       $signup=false;
       if(is_object($user)){
           $signup=true;
       }
       if($signup==true){
           // return array("status"=>"success", "data"=>"Correct Login!!!");
           //Datos para crear el token
           $token= array(
               "sub"=>$user->getId(),
               "email"=>$user->getEmail(),
               "name"=>$user->getName(),
               "surname"=>$user->getSurname(),
               "password"=>$user->getPassword(),
               "image"=>$user->getImage(),
               "iat"=>time(),
               "exp"=>time()+( 7 * 24 * 60 *60 )
               );
           $jwt= JWT::encode($token,$key, 'HS256');
           $decoded=JWT::decode($jwt,$key, array("HS256"));
           if($getHash!=null){
               return $jwt;
           }else {
               return $decoded;
           }
       }
       else{
           return array("status"=>"error", "data"=>"Login Failed, User and Password incorrect!!!");
           die();
       }
   }
}