<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Categorie;
use App\Entity\User;
use App\Entity\Blague;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends Controller
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function search(Request $request)
    {
        $formbuilder = $this->createFormBuilder();
        $formbuilder->add('recherche', TextType::class);
        $formbuilder->add('submit', SubmitType::class, array(
            'label' => 'Chercher',
        ));
        $searchform = $formbuilder->getForm();

        $searchform->handleRequest($request);

        if ($searchform->isSubmitted() && $searchform->isValid()) 
        {
            $text = $searchform['recherche']->getData();
            $blagues = $this->getDoctrine()
                ->getRepository(Blague::class)
                ->findByText($text);
            return $this->render('blague/show_all.html.twig', array(
                'user' => $this->getUser(),
                'blagues' => $blagues,
            ));
        }

        return $this->render('recherche/recherche.html.twig', array(
            'searchform' => $searchform->createView(),
            'user' => $this->getUser(),
        ));
    }
}