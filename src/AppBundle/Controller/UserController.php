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
            "message" => "User not created, JSON data is Null"
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
                $user->setPassword($password);
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
}

/* $data = array (
                "status"=>"error",
                "code"=>400,
                "message"=>"JSON data is invalid"
                );
                */