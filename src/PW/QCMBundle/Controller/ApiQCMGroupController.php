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

class ApiQCMGroupController extends Controller{
    
    /**
    *@Rest\View()
    */
    public function getQcmgroupAction($id, Request $request){
        
        $qcmgroup = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:QCMGroup')
                        ->find($id);

        if(empty($qcmgroup)){
           
            return new JsonResponse(['message' => 'Qcmgroup not found'], Response::HTTP_NOT_FOUND);
        }
  
        $view = View::create($qcmgroup);
        $view->setFormat('json');
  
        return $view;
        
    } 
    
    /**
    *@Rest\View()
    */
    public function getQcmgroupsAction(Request $request){
        
        $qcmgroup = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:QCMGroup')
                        ->findAll(); 
       
        $view = View::create($qcmgroup);
        $view->setFormat('json');
  
        return $view;
    }
        
}
