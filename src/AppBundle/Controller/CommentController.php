<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use BackendBundle\Entity\User as User;
use BackendBundle\Entity\Video as Video;
use BackendBundle\Entity\Comment as Comment;

class CommentController extends Controller {

    public function newAction(Request $request) {
        $helpers = $this->get("app.helpers");
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);
        //Validar token inicio sesion OK
        if ($authCheck) {
            $identity = $helpers->authCheck($hash, true);
            $json = $request->get("json", null);

            if ($json != null) {
                $params = json_decode($json);
                $createdAt = new \Datetime('now');
                $user_id = (isset($identity->sub)) ? $identity->sub : null;
                $video_id = (isset($params->video_id)) ? $params->video_id : null;
                $body = (isset($params->body)) ? $params->body : null;

                if ($user_id != null && $video_id != null) {
                    $em = $this->getDoctrine()->getManager();
                    $user = $em->getRepository("BackendBundle:User")->findOneBy(array(
                        "id" => $user_id
                    ));

                    $video = $em->getRepository("BackendBundle:Video")->findOneBy(array(
                        "id" => $video_id
                    ));

                    $comment = new Comment();
                    $comment->setBody($body);
                    $comment->setUser($user);
                    $comment->setVideo($video);
                    $comment->setCreatedAt($createdAt);
                    $em->persist($comment);
                    $em->flush();
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => " Comment : Succes Created"
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "Comment NOt Created, User or Video not exists"
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "JSON Comment is Null"
                );
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "Authentication Failed Failed!"
            );
        }
        return $helpers->json($data);
    }

    public function deleteAction(Request $request, $id) {

        $helpers = $this->get("app.helpers");
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);
        //Validar token inicio sesion OK
        if ($authCheck) {
            $identity = $helpers->authCheck($hash, true);

            $user_id = ($identity->sub != null) ? $identity->sub : null;
          
            $em = $this->getDoctrine()->getManager();
            $comment = $em->getRepository("BackendBundle:Comment")->findOneBy(array(
                "id" => $id
            ));
            $co=$comment;
              var_dump($co);die();
              // var_dump($comment);die();
            if (is_object($comment && $user_id = !null)) {
                if (
                        isset($identity->sub) &&
                        ($identity->sub == $commment->getUser()->getId() ||
                        ($identity->sub == $coment->getVideo()->getUser()->getId())
                        )
                ) {

                    $em->remove($comment);
                    $em > flush();
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => " *****Comment: Succes DELETED*****"
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "Comment Not  deleted  User Permision"
                    );
                }
            } else {
              
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Comment Not Found -Element not deleted!"
                );
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "Authentication Failed Failed!"
            );
        }
             return $helpers->json($data);
    }


}
