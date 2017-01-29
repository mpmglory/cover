<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Form\ConcoursType;
use PW\QCMBundle\Entity\Concours;

class ConcoursController extends Controller
{
    public function indexAction(){

        $listConcours = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:Concours')
                    ->findAll();

        return $this->render('PWQCMBundle:Concours:index.html.twig', array(
            'listConcours' => $listConcours
            ));
    }

    public function viewAction($id){

    	$concours = $this->getDoctrine()->getManager()
    				->getRepository('PWQCMBundle:Concours')
    				->find($id);

        return $this->render('PWQCMBundle:Concours:view_concours.html.twig', array(
        	'concours' => $concours
        	));
    }

    public function addAction(Request $request){

    	$em = $this->getDoctrine()->getManager();

    	$concours = new Concours();

    	$form = $this->get('form.factory')->create(new ConcoursType(), $concours);
			
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->persist($concours);
			$em->flush();

			$request->getSession()->getFlashBag()
					->add('notice', 'Concours bien enregistree.');
		
			return $this->redirectToRoute('pw_concours_add');
		}

        return $this->render('PWQCMBundle:Concours:add_concours.html.twig', array(
        	'form' => $form->createView()
        	));
    }

   public function editAction($id, Request $request){

        $concours = $this->getDoctrine()->getManager()
                    ->getRepository('PWQCMBundle:Concours')
                    ->find($id);

        $form = $this->get('form.factory')->create(new ConcoursType(), $concours);
            
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($concours);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('notice', 'Annonce bien enregistree.');
        
            return $this->redirectToRoute('pw_concours_view', array(
                'id' => $id
                ));
        }

        return $this->render('PWQCMBundle:Concours:add_concours.html.twig', array(
            'form' => $form->createView()
            ));
    }

    public function deleteAction($id){

        $em = $this->getDoctrine()->getManager();
        $concours  = $em->getRepository('PWQCMBundle:Concours')->find($id);

        $em->remove($concours);
        $em->flush();

        return $this->redirectToRoute('pw_concours_home');
    }
}
