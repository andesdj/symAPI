<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use BackendBundle\Entity\User as User;

class UserController extends Controller {

    public function newAction(Request $request) {
        $helpers = $this->get("app.helpers");
        $json = $request->get("json", null);
        $params = json_decode($json);
        $data = array(
            "status" => "error",
            "code" => 400,
            "msg" => "User not created, JSON data is Null"
        );
        if ($json != null) {
            $createdAt = new \Datetime("now");
            $image = "image.jpg";
            $role = "user";
            $email = (isset($params->email)) ? $params->email : null;
            $name = (isset($params->name)) ? $params->name : null;
            $surname = (isset($params->surname)) ? $params->surname : null;
            $password = (isset($params->password)) ? $params->password : null;
            $emailCons = new Assert\Email();
            $emailCons->message = "Formato de email no valido";
            $validate_email = $this->get("validator")->validate($email, $emailCons);
            if ($email != null && count($validate_email) == 0 && $password != null && $name != null && $surname != null) {
                $user = new User();
                $user->setCreatedAt($createdAt);
                $user->setEmail($email);
                $user->setRoles($role);
                $user->setName($name);
                $user->setSurname($surname);
                //Cifrar passwoord
                $pass = hash('sha256', $password);
                $user->setPassword($pass);
                $user->setImage($image);
                $em = $this->getDoctrine()->getManager();
                $isset_user = $em->getRepository("BackendBundle:User")->findBy(
                        array(
                            "email" => $email
                ));
                if (count($isset_user) == 0) {
                    $em->persist($user);
                    $em->flush();
                    $data ["status"] = 'success';
                    $data["msg"] = "New User was created";
                    $data["code"] = 200;
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "User was not created, user already exist!"
                    );
                }
            }
        }
        return $helpers->json($data);
        die();
    }

    public function editAction(Request $request) {
        $helpers = $this->get("app.helpers");
        $hash = $request->get("authorization", null);
        //Recibir token de validacion 
        $authCheck = $helpers->authCheck($hash);
        if ($authCheck == true) {
            //Decofificar los datos
            $identity = $helpers->authCheck($hash, true);
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository("BackendBundle:User")->findOneBy(
                    array(
                        "id" => $identity->sub
            ));
            $json = $request->get("json", null);
            $params = json_decode($json);
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "Updated Failed created, JSON data is Null"
            );
            if ($json != null) {
                $createdAt = new \Datetime("now");
                $image = "image.jpg";
                $role = "user";
                $email = (isset($params->email)) ? $params->email : null;
                $name = (isset($params->name)) ? $params->name : null;
                $surname = (isset($params->surname)) ? $params->surname : null;
                $password = (isset($params->password)) ? $params->password : null;
                $emailCons = new Assert\Email();
                $emailCons->message = "Formato de email no valido";
                $validate_email = $this->get("validator")->validate($email, $emailCons);

                if ($email != null && count($validate_email) == 0 && $name != null && $surname != null) {
                    $user->setCreatedAt($createdAt);
                    $user->setEmail($email);
                    $user->setRoles($role);
                    $user->setName($name);
                    $user->setSurname($surname);
                    if ($password != null) {
                        //Cifrar password
                        $pass = hash('sha256', $password);
                        $user->setPassword($pass);
                    }
                    $user->setImage($image);
                    $em = $this->getDoctrine()->getManager();
                    $isset_user = $em->getRepository("BackendBundle:User")->findBy(
                            array(
                                "email" => $email
                    ));
                    if (count($isset_user) == 0 || $identity->email == $email) {
                        $em->persist($user);
                        $em->flush();
                        $data ["status"] = 'success';
                        $data["msg"] = " User was Updated";
                        $data["code"] = 200;
                    } else {
                        $data = array(
                            "status" => "error",
                            "code" => 400,
                            "msg" => "Updated user Failed, user already exist!"
                        );
                    }
                }
            }
            return $helpers->json($data);
            die();
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "Authorization failed"
            );
        }
    }

    public function uploadImageAction(Request $request) {
        $helpers = $this->get("app.helpers");
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);
        //Validar token inicio sesion OK
        if ($authCheck) {
            $identity = $helpers->authCheck($hash, true);
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository("BackendBundle:User")->findOneBy(array(
                "id" => $identity->sub
            ));
            //Recoger Fichero Imagen por POST y cargarlo (upload.
            $file = $request->files->get("image");
            if (!empty($file) && $file != null) {
                $ext = $file->guessExtension();
                if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" || $ext == "bmp") {
                    $filename = time() . "." . $ext;
                    $file->move("uploads/users", $filename);
                    $user->setImage($filename);
                    $em->persist($user);
                    $em->flush();
                    $data = array(
                        "status" => "sucess",
                        "code" => 200,
                        "msg" => " File loaded OK"
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "File Extension not valid!"
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Image not loaded!"
                );
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "Authorization Failed!"
            );
        }
        return $helpers->json($data);
    }
}
