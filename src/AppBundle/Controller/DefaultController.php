<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
class DefaultController extends Controller
{
    
    public function loginAction(Request $request){
            $helpers = $this->get("app.helpers");
           $json= $request->get("json", null);
           if ($json!=null){
                $params=json_decode($json);
                $email= (isset($params->email))? $params->email : null;
                $password=(isset($params->password))? $params->password : null;
                $emailCons= new Assert\Email();
                $emailCons->message="Formato de email no valido";
                $validate_email= $this->get("validator")->validate($email,$emailCons);
                if(count($validate_email)==0 && $password!=null){
                    echo "Data Success!!!";
                } else {
                    echo "Data Incorrect!!!!!";
                }
           } else {
               echo "Not received, Please send JSON data to login";
               die();
           }
    }
    
    public function pruebasAction(Request $request)
    {   
        $helpers = $this->get("app.helpers");
        $em = $this->getDoctrine()->getManager();
        $data=$em->getRepository('BackendBundle:User')->findAll();
        return  $helpers->json($data);
    }
    
    
    	public function indexAction(Request $request) {
		// replace this example code with whatever you need
		return $this->render('default/index.html.twig', [
					'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
		]);
	}
}
