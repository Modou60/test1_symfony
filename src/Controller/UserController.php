<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="indexliste")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit_user", methods={"GET", "POST"})
     */

    public function edituser(Request $request, User $user, EntityManagerInterface $manager): Response
    {
        // création du formulaire
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

// test du formulaire
if ($form->isSubmitted() && $form->isValid())
{
    $manager->flush();

    //redirection de la page
    return $this->redirectToRoute('user_id', ["id" => $user->getId()]);
}

    // Envoi de la page vers twig
    return $this->render('user/modif_user.html.twig', [
        'user' => $user,
        'formuser' => $form->createView(),
    ]);
}


/**
 * @param $id
 * @param UtilisateursRepository, $utilisateursrepo
 * @Route("/search", name="search", methods={"GET"})
 */
public function searchutilisateur(User $user, UserRepository $userrepo)
{
    $utilisateurs = $userrepo->findBy(array
    (
        'nom' => 'dupon',
        'email' => 'fafa@free.fr'), array (
            'prenom' => "DESC"), 1,0);
        
            return $this->render('user/search.html.twig',[
                'results' => $utilisateurs,
                'user' => $user,
            ]);
}



    /**
     * @Route("/{id}", name="user_id", methods={"GET"})
     */
    public function useId(User $user): Response
    {
        return $this->render('user/affiche_user.html.twig', [
            'user' => $user,
        ]);
    }

}