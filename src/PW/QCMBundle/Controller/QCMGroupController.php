<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\QCMGroup;
use PW\QCMBundle\Form\QCMGroupType;
use PW\QCMBundle\Entity\Concours;
use PW\QCMBundle\Form\ConcoursType;

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

        $concours = new Concours();
        $form2 = $this->get('form.factory')->create(new ConcoursType(), $concours);
			
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->persist($qcmGroup);
			$em->flush();

			$request->getSession()->getFlashBag()
					->add('notice', 'Groupe de QCM bien enregistree.');
		
			return $this->redirectToRoute('pw_qcmgroup_add');
		}

        return $this->render('PWQCMBundle:QCMGroup:add_qcmgroup.html.twig', array(
        	'form' => $form->createView(),
            'form2' => $form2->createView()
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
        
            return $this->redirectToRoute('pw_qcmgroup_view', array(
                'id' => $id
                ));
        }

        return $this->render('PWQCMBundle:QCMGroup:add_qcmgroup.html.twig', array(
            'form' => $form->createView()
            ));
    }

    public function deleteAction($id){

        $em = $this->getDoctrine()->getManager();
        $qcm  = $em->getRepository('PWQCMBundle:QCMGroup')->find($id);

        $em->remove($qcm);
        $em->flush();

        return $this->redirectToRoute('pw_qcm_homepage');
    }

    public function menuAction($id){

        $em = $this->getDoctrine()->getManager();

        $matiere  = $em->getRepository('PWQCMBundle:Matiere')->find($id);

        $list  = $em->getRepository('PWQCMBundle:QCMGroup')->findBy(
                array('matiere' => $matiere),
                array('titre' => 'asc')
            );

        return $this->render('PWQCMBundle:QCMGroup:menu.html.twig', array(
            'list' => $list
            ));

    }
}
