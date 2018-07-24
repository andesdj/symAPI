<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use BackendBundle\Entity\User as User;
use BackendBundle\Entity\Video as Video;

class VideoController extends Controller {

    public function pruebasAction() {
        echo "videoController";
        die();
    }

    public function newAction(Request $request) {
        $helpers = $this->get("app.helpers");
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);
        //Validar token inicio sesion OK
        if ($authCheck == true) {
            $identity = $helpers->authCheck($hash, true);
            $json = $request->get("json", null);
            if ($json != null) {
                $params = json_decode($json);

                $createdAt = new \Datetime('now');
                $updatedAt = new \Datetime('now');
                $imagen = null;
                $videoPath = null;
                $userId = ($identity->sub = !null) ? $identity->sub : null;
                $title = (isset($params->title)) ? $params->title : null;
                $description = (isset($params->description)) ? $params->description : null;
                $status = (isset($params->status)) ? $params->status : null;

                if ($userId != null && $title != null) {
                    $em = $this->getDoctrine()->getManager();
                    $user = $em->getRepository("BackendBundle:User")->findOneBy(array(
                        "id" => $userId
                    ));
                    $video = new Video();
                    $video->setUser($user);
                    $video->setTitle($title);
                    $video->setDescription($description);
                    $video->setStatus($status);
                    // $video->setImage($imagen);
                    // $video->setVideoPath($videoPath);
                    $video->setCreatedAt($createdAt);
                    $video->setUpdatedAt($updatedAt);
                    $em->persist($video);
                    $em->flush();
                    $video = $em->getRepository("BackendBundle:Video")->findOneBy(array(
                        "user" => $user,
                        "title" => $title,
                        "status" => $status,
                        "createdAt" => $createdAt
                    ));

                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "data" => $video,
                        "msg" => "Video was loaded OK by API "
                    );
                } else {

                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "Video not created or Title is Null!"
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "JSON Video is Null"
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

    public function editAction(Request $request, $id=null) {
        $video_id=$id;
        $helpers = $this->get("app.helpers");
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);
        //Validar token inicio sesion OK
        if ($authCheck == true) {
            $identity = $helpers->authCheck($hash, true);
            $json = $request->get("json", null);
            if ($json != null) {
                $params = json_decode($json);

              //  $createdAt = new \Datetime('now');
                $updatedAt = new \Datetime('now');
                $imagen = null;
                $videoPath = null;
                $userId = ($identity->sub = !null) ? $identity->sub : null;
                $title = (isset($params->title)) ? $params->title : null;
                $description = (isset($params->description)) ? $params->description : null;
                $status = (isset($params->status)) ? $params->status : null;

                if ($userId != null && $title != null) {
                    $em = $this->getDoctrine()->getManager();

                    $video = $em->getRepository("BackendBundle:Video")->findOneBy(
                            array(
                                "id" => $video_id
                    ));
                    if (isset($identity->sub) && $identity->sub == $video->getUser()->getId()) {
                        $video->setTitle($title);
                        $video->setDescription($description);
                        $video->setStatus($status);
                        // $video->setImage($imagen);
                        // $video->setVideoPath($videoPath);
                        //$video->setCreatedAt($createdAt);
                        $video->setUpdatedAt($updatedAt);
                        $em->persist($video);
                        $em->flush();
                        $data = array(
                            "status" => "success",
                            "code" => 200,
                            "msg" => "Video updated OK!!!"
                        );
                    } else {
                        $data = array(
                            "status" => "error",
                            "code" => 400,
                            "msg" => "Error: Must be de Owner to edit this video"
                        );
                    }
                } else {

                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "Video not Updated or Title is Null!"
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "JSON Video is Null"
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
