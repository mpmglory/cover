<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\Matiere;
use PW\QCMBundle\Entity\QCMGroup;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiMatiereController extends Controller{
    
    /**
    *@Rest\View()
    */
    public function getMatiereAction($id, Request $request){
        
        $mat = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:Matiere')
                        ->find($id);

        if(empty($mat)){
           
            return new JsonResponse(['message' => 'Matiere not found'], Response::HTTP_NOT_FOUND);
        }
  
        return $mat;
        
    } 
    
    /**
    *@Rest\View()
    */
    public function getMatieresAction(Request $request){
        
        $mats = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:Matiere')
                        ->findAll(); 
       
        return $mats;
    }
        
}
