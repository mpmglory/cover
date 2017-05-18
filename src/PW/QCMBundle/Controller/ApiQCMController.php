<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\QCM;
use PW\QCMBundle\Entity\QCMGroup;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiQCMController extends Controller{
    
    /**
    *@Rest\View()
    */
    public function getQcmAction($id, Request $request){
        
        $qcm = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:QCM')
                        ->find($id);

        if(empty($qcm)){
           
            return new JsonResponse(['message' => 'QCM not found'], Response::HTTP_NOT_FOUND);
        }
  
        return $qcm;
        
    } 
    
    /**
    *@Rest\View()
    */
    public function getQcmsAction(Request $request){
        
        $allQcm = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:QCM')
                        ->findAll(); 
       
        return $allQcm;
    }
        
}
