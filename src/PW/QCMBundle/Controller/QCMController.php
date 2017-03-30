<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\QCM;
use PW\QCMBundle\Form\QCMType;
use PW\QCMBundle\Entity\QCMGroup;
use PW\QCMBundle\Form\QCMGroupType;
use PW\QCMBundle\Form\ImageType;

class QCMController extends Controller
{
    public function indexAction(){

        $listQcm = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCM')
                    ->findAll();

        return $this->render('PWQCMBundle:QCM:index.html.twig', array(
            'listQcm' => $listQcm
            ));
    }

    public function viewAction($id){

    	$qcm = $this->getDoctrine()->getManager()
    				->getRepository('PWQCMBundle:QCM')
    				->find($id);

        return $this->render('PWQCMBundle:QCM:view_qcm.html.twig', array(
        	'qcm' => $qcm
        	));
    }

    public function validerAction($id){

        $em = $this->getDoctrine()->getManager();
        $qcm  = $em->getRepository('PWQCMBundle:QCM')->find($id);

        $qcm->setValidated(true);
        $em->persist($qcm);
        $em->flush();

        return $this->render('PWQCMBundle:QCM:view_qcm.html.twig', array(
            'qcm' => $qcm
            ));
    }

    public function addAction(Request $request){

    	$em = $this->getDoctrine()->getManager();

    	$qcm = new QCM();

    	$form = $this->get('form.factory')->create(new QCMType(), $qcm);
			
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->persist($qcm);
			$em->flush();

			$request->getSession()->getFlashBag()
					->add('notice', 'Annonce bien enregistree.');
		
			return $this->redirectToRoute('pw_qcm_add');
		}

        return $this->render('PWQCMBundle:QCM:add_qcm.html.twig', array(
        	'form' => $form->createView()
        	));
    }

    public function add2Action($id, Request $request){

        $qcmgroup = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCMGroup')
                    ->find($id);

        $qcm = new QCM();

        $qcm->setQcmgroup($qcmgroup);

        $formBuilder = $this->get('form.factory')->createBuilder('form', $qcm);
            
        $formBuilder->add('enonce',     'textarea')
                    ->add('propoA',     'textarea')
                    ->add('propoB',     'textarea')
                    ->add('propoC',     'textarea')
                    ->add('propoD',     'textarea')
                    ->add('propoE',     'textarea')
                    ->add('reponse',    'choice', array(
                        'choices' => array(
                            'A' => 'Proposition A',
                            'B' => 'Proposition B',
                            'C' => 'Proposition C',
                            'D' => 'Proposition D',
                            'E' => 'Proposition E',
                            ),
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        ))
                    ->add('explication', 'textarea')
                    ->add('image',   new ImageType())
                    ->add('submit',     'submit')
                    ;

        $form = $formBuilder->getForm();

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($qcm);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('info', 'Annonce bien enregistree.');
        
            return $this->redirectToRoute('pw_qcm_add2', array(
                'id' => $id
                ));
        }

        return $this->render('PWQCMBundle:QCM:add2_qcm.html.twig', array(
            'form' => $form->createView(),
            'qcmgroup' => $qcm->getQcmgroup(),
            ));
    }

    public function editAction($id, Request $request){

        $qcm = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCM')
                    ->find($id);

        $id2 = 7;

        $qcmgroup = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCMGroup')
                    ->find($id2);

        $qcm->setQcmgroup($qcmgroup);

        $form = $this->get('form.factory')->create(new QCMType(), $qcm);
            
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($qcm);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('notice', 'Annonce bien enregistree.');
        
            return $this->redirectToRoute('pw_qcm_view', array(
                'id' => $id
                ));
        }

        return $this->render('PWQCMBundle:QCM:add_qcm.html.twig', array(
            'form' => $form->createView()
            ));
    }

    public function deleteAction($id){

        $em = $this->getDoctrine()->getManager();
        $qcm  = $em->getRepository('PWQCMBundle:QCM')->find($id);

        $em->remove($qcm);
        $em->flush();

        return $this->redirectToRoute('pw_qcm_homepage');
    }
    

    public function getAllAction(Request $request){
        
        $allQcm = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:QCM')
                        ->findAll(); 
        
        $formatted = [];
        
        foreach($allQcm as $qcm){
            
            $formatted[] = [
                'id' => $qcm->getId(),
                'date' => $qcm->getDate(),
                'validated' => $qcm->getValidated(),
                'enonce' => $qcm->getEnonce(),
                'propoA' => $qcm->getPropoA(),
                'propoB' => $qcm->getPropoB(),
                'propoC' => $qcm->getPropoC(),
                'propoD' => $qcm->getPropoD(),
                'propoE' => $qcm->getPropoE(),
                'reponse' => $qcm->getReponse(),
                'explication' => $qcm->getExplication()
            ];
        }
        
        return new JsonResponse($formatted);
    }
    
   public function getOneAction($id, Request $request){
        
        $qcm = $this->get('doctrine.orm.entity_manager')
                        ->getRepository('PWQCMBundle:QCM')
                        ->find($id); 
        
        $formatted = [
            'id' => $qcm->getId(),
            'date' => $qcm->getDate(),
            'validated' => $qcm->getValidated(),
            'enonce' => $qcm->getEnonce(),
            'propoA' => $qcm->getPropoA(),
            'propoB' => $qcm->getPropoB(),
            'propoC' => $qcm->getPropoC(),
            'propoD' => $qcm->getPropoD(),
            'propoE' => $qcm->getPropoE(),
            'reponse' => $qcm->getReponse(),
            'explication' => $qcm->getExplication()
        ];
       
       if(empty($qcm)){
           
            return new JsonResponse(['message' => 'QCM not found'], Response::HTTP_NOT_FOUND);
        }    
        
        return new JsonResponse($formatted);
    }
    
    
    
}
