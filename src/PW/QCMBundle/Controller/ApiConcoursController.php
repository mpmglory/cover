<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\Concours;
use PW\QCMBundle\Entity\QCMGroup;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiConcoursController extends Controller{
    
    /**
    *@Rest\View()
    */
    public function getConcoursAction($id, Request $request){
        
        $concours = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:Concours')
                        ->find($id);

        if(empty($concours)){
           
            return new JsonResponse(['message' => 'Concours not found'], Response::HTTP_NOT_FOUND);
        }
        
        $view = View::create($concours);
        $view->setFormat('json');
  
        return $view;
        
    } 
    
    /**
    *@Rest\View()
    */
    public function getConcourssAction(Request $request){
        
        $concours = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:Concours')
                        ->findAll(); 
       
        $view = View::create($concours);
        $view->setFormat('json');
  
        return $view;
    }
        
}
