<?php

namespace PW\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PW\QCMBundle\Entity\Concours;
use PW\QCMBundle\Entity\Matiere;
use PW\QCMBundle\Entity\QCM;
use PW\QCMBundle\Entity\QCMGroup;
use PW\QCMBundle\Entity\User;
use PW\QCMBundle\Form\QCMType;

class QCMController extends Controller
{
    public function indexAction()
    {
        return $this->render('PWQCMBundle:QCM:index.html.twig');
    }

    public function viewAction()
    {

    	$listQcm = $this->getDoctrine()->getManager()
    				->getRepository('PWQCMBundle:QCM')
    				->findAll();

        return $this->render('PWQCMBundle:QCM:view.html.twig', array(
        	'listQcm' => $listQcm
        	));
    }

    public function addAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$qcm = new QCM();

    	/*$qcm->setEnonce("Qu'est ce que l'informatique?");
    	$qcm->setPropoA("Objet d'etude de la philosophie.");
    	$qcm->setPropoB("Science de l'etude de l'information.");
    	$qcm->setPropoC("Caratere technologique d'une entreprise.");
    	$qcm->setPropoD("Science du traitement automatique de l'information.");
    	$qcm->setPropoE("Aucune de ces reponces n'est correcte.");
    	$qcm->setReponse($qcm->getPropoD());
    	$qcm->setExplication("");
    	$qcm->setUrlPhoto("plata.jpg");*/

    	$form = $this->get('form.factory')->create(new QCMType(), $qcm);
			
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->persist($qcm);
			$em->flush();

			$request->getSession()->getFlashBag()
					->add('notice', 'Annonce bien enregistree.');
		
			return $this->redirectToRoute('pw_qcm_add');
		}

        return $this->render('PWQCMBundle:QCM:add.html.twig', array(
        	'form' => $form->createView()
        	));
    }

    public function editAction()
    {
        return $this->render('PWQCMBundle:QCM:edit.html.twig');
    }
}
