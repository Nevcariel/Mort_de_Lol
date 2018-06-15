<?php

namespace App\Controller;

use App\Form\BlagueType;
use App\Entity\Blague;
use App\Entity\Etat;
use App\Entity\User;
use App\Entity\Note;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BlagueController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $blagues = $entityManager->getRepository(Blague::class)->findBy(array(), array('date' => 'desc'),5,0);
        $comments = $entityManager->getRepository(Commentaire::class)->findBy(array(), array('date' => 'desc'),3,0);
        return $this->render('homepage.html.twig', array(
            'blagues' => $blagues,
            'user' => $this->getUser(),
            'comments' => $comments,
        ));
    }

    /**
     * @Route("/blague/{id<\d+>}", name="blague_show")
     */
    public function show($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $blague = $entityManager->getRepository(Blague::class)->find($id);
        $notes = $entityManager->getRepository(Note::class)->findBy(['blague' => $blague]);
        $moy = $entityManager->getRepository(Note::class)->makeAvg($blague);
        $user = $this->getUser();
        $usernote = $entityManager->getRepository(Note::class)->findOneBy(['blague' => $blague, 'user' => $user]);
        
        if(!$blague)
        {
            throw $this->createNotFoundException('Blague inexistante');
        }
        $comment = new Commentaire();
        $commentform = $this->createFormBuilder($comment)
                    ->add('contenu')
                    ->getForm();

        $commentform->handleRequest($request);

        if ($commentform->isSubmitted() && $commentform->isValid()) 
        {
            $comment->setUSer($user);
            $comment->setBlague($blague);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('blague_show', array(
                'id' => $blague->getId()
            ));
        }

        $note = new Note();
        $noteform = $this->createFormBuilder($note)
                    ->add('note', ChoiceType::class, array(
                        'choices' => array(
                            '0' => 0,
                            '1' => 1,
                            '2' => 2,
                            '3' => 3,
                            '4' => 4,
                            '5' => 5,
                        ),
                    ))
                    ->getForm();
        $noteform->handleRequest($request);

        if ($noteform->isSubmitted() && $noteform->isValid()) 
        {
            $note->setUser($user);
            $note->setBlague($blague);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('blague_show', array(
                'id' => $blague->getId()
            ));
        }

        return $this->render('blague/show.html.twig', array(
            'commentform' => $commentform->createView(),
            'user' => $user,
            'blague' => $blague,
            'comments' => $blague->getCommentaires(),
            'notes' => $notes,
            'noteform' => $noteform->createView(),
            'moy' => $moy,
            'usernote' => $usernote,
        ));
    }

    /**
     * @Route("/blague/add", name="blague_add")
     */
    public function add(Request $request)
    {
        $blague = new Blague();
        $form = $this->createForm(BlagueType::class, $blague);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {

            $etat = $this->getDoctrine()
                ->getRepository(Etat::class)
                ->findOneBy(['libelle' => 'Validée']);
            $blague->setEtat($etat);

            $user = $this->getUser();
            $blague->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blague);
            $entityManager->flush();

            return $this->redirectToRoute('blague_show', array(
                'id' => $blague->getId()
            ));
        }

        return $this->render('blague/add.html.twig', array(
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ));
    }

    /**
     * @Route("/blague", name="blague_show_all")
     */
    public function show_all(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $blagues = $entityManager->getRepository(Blague::class)->findAll();
        
        return $this->render('blague/show_all.html.twig', array(
            'user' => $this->getUser(),
            'blagues' => $blagues,
        ));
    }

}
