<?php
namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/profil/{id<\d+>}", name="user_profil")
     */
    public function profil($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['id' => $id]);
        $blagues = $user->getBlagues();
        $commentaires = $user->getCommentaires();
        return $this->render(
            'user/profil.html.twig', array(
                'user' => $user,
                'blagues' => $blagues,
                'commentaires' => $commentaires,
        ));
    }
}