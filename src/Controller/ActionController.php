<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ThematiqueType;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionController extends AbstractController
{
    /**
     * @Route("/combattre", name="combattre", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
		$form = $this->createForm(ThematiqueType::class);
		$form->handleRequest($request);
		  
		if ($form->isSubmitted() && $form->isValid()) {
			// On recupère tous les données du formaulaire 
			$data = $form->getData();

			$thematique = $data['thematique'];
			$niveau = $data['niveau'];

            return $this->redirectToRoute('questions', array('thematique'=>$thematique->getId(), 'niveau' => $niveau->getId() ));
        }

        return $this->render('action/index.html.twig', [
            'controller_name' => 'ActionController',
			'form' => $form->createView()
        ]);
    }

	/**
     * @Route("/questions", name="questions", methods={"GET", "POST"})
     */
    public function question(Request $request): Response
    {
		//on récupère les paramètres passés dans l'URL
		$idThematique = $request->get("thematique");
		$idNiveau = $request->get("niveau");

		// "création / initialisation" du formaulaire QuestionType + envoie de 2 paramètres a ce formaulaire
		$form = $this->createForm(QuestionType::class,Null, array('idThematique'=>$idThematique, 'idNiveau'=>$idNiveau));



		return $this->render('action/questions.html.twig', [
            'controller_name' => 'Hello World',
			'formQuestion'=>$form->createView()
        ]);

	}
	
}
