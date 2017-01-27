<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\QCM;
use PW\QCMBundle\Form\QCMType;

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

    public function editAction($id, Request $request){

        $qcm = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:QCM')
                    ->find($id);

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
}
