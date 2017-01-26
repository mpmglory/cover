<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\QCMGroup;
use PW\QCMBundle\Form\QCMGroupType;

class QCMGroupController extends Controller
{
    public function indexAction(){

        $listQcmgroup = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCMGroup')
                    ->findAll();

        return $this->render('PWQCMBundle:QCMGroup:index.html.twig', array(
            'listQcmgroup' => $listQcmgroup
            ));
    }

    public function viewAction($id){

    	$qcmgroup = $this->getDoctrine()->getManager()
    				->getRepository('PWQCMBundle:QCMGroup')
    				->find($id);

        return $this->render('PWQCMBundle:QCMGroup:view_qcmgroup.html.twig', array(
        	'qcmgroup' => $qcmgroup
        	));
    }


    public function addAction(Request $request){

    	$em = $this->getDoctrine()->getManager();

    	$qcmGroup = new QCMGroup();

    	$form = $this->get('form.factory')->create(new QCMGroupType(), $qcmGroup);
			
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->persist($qcmGroup);
			$em->flush();

			$request->getSession()->getFlashBag()
					->add('notice', 'Groupe de QCM bien enregistree.');
		
			return $this->redirectToRoute('pw_qcm_add_qcmgroup');
		}

        return $this->render('PWQCMBundle:QCMGroup:add_qcmgroup.html.twig', array(
        	'form' => $form->createView()
        	));
    }

    public function editAction($id, Request $request){

        $qcmGroup = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCMGroup')
                    ->find($id);

        $form = $this->get('form.factory')->create(new QCMGroupType(), $qcmGroup);
            
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($qcmGroup);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('notice', 'Annonce bien enregistree.');
        
            return $this->redirectToRoute('pw_qcm_view_qcmgroup', array(
                'id' => $id
                ));
        }

        return $this->render('PWQCMBundle:QCMGroup:add_qcmgroup.html.twig', array(
            'form' => $form->createView()
            ));
    }
}
