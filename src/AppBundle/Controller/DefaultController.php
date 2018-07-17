<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    public function loginAction(Request $request){
            $helpers = $this->get("app.helpers");
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
