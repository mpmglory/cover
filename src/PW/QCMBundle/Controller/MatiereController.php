<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Form\MatiereType;
use PW\QCMBundle\Entity\Matiere;

class MatiereController extends Controller
{
    public function indexAction(){

        $list = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:Matiere')
                    ->findAll();

        return $this->render('PWQCMBundle:Matiere:index.html.twig', array(
            'listMatiere' => $list
            ));
    }

    public function viewAction($id){

    	$matiere = $this->getDoctrine()->getManager()
    				->getRepository('PWQCMBundle:Matiere')
    				->find($id);

        return $this->render('PWQCMBundle:Matiere:view_matiere.html.twig', array(
        	'matiere' => $matiere
        	));
    }

    public function addAction(Request $request){

    	$em = $this->getDoctrine()->getManager();

    	$matiere = new Matiere();

    	$form = $this->get('form.factory')->create(new MatiereType(), $matiere);
			
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->persist($matiere);
			$em->flush();

			$request->getSession()->getFlashBag()
					->add('notice', 'Matiere bien enregistree.');
		
			return $this->redirectToRoute('pw_matiere_add');
		}

        return $this->render('PWQCMBundle:Matiere:add_matiere.html.twig', array(
        	'form' => $form->createView()
        	));
    }

   public function editAction($id, Request $request){

        $matiere = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:Matiere')
                    ->find($id);

        $form = $this->get('form.factory')->create(new MatiereType(), $matiere);
            
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('notice', 'Annonce bien enregistree.');
        
            return $this->redirectToRoute('pw_matiere_view', array(
                'id' => $id
                ));
        }

        return $this->render('PWQCMBundle:Matiere:add_matiere.html.twig', array(
            'form' => $form->createView()
            ));
    }

    public function deleteAction($id){

        $em = $this->getDoctrine()->getManager();
        $qcm  = $em->getRepository('PWQCMBundle:Matiere')->find($id);

        $em->remove($qcm);
        $em->flush();

        return $this->redirectToRoute('pw_qcm_homepage');
    }
}
