<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="utilisateur")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateur = $repo->findAll();
        return $this->render('utilisateur/index.html.twig', [
            'user' => $utilisateur,
        ]);
    }


    /**
     * @Route("/formutilisateur", name="formutilisateur")
     */
    public function foruser(Request $request, EntityManagerInterface $manager)
    {
    
        // Instanciation de la classe Utilisateurs
    $utilisateur = new Utilisateurs;

    // création d'un formulaire à partir de UtilisateursType
    $formutilisateur = $this->createForm(UtilisateursType::class);
$formutilisateur->handleRequest($request);

// Teste pour la soumission du formulaire
if ($formutilisateur->isSubmitted() && $formutilisateur->isValid())
{
    $manager->persist($utilisateur);
    $manager->flush();

    // Redirection vers la page de la liste de tous les utilisateurs
    return $this->redirectToRoute('utilisateur');
}

// envoie de du formulaire à la page twig pour son affichage
return $this->render('utilisateur/nouvelutilisateur.html.twig',[
    'nouveau' => $utilisateur,
    'userform' => $formutilisateur->createView(),
]);
}

    /**
     * @Route("/{id}", name="user_affichage",methods={"GET"})
     */
    public function iduser(Utilisateurs $utilisateurs, UtilisateursRepository $utilisateursRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('utilisateur/affichageuser.html.twig', [
            'id' => $utilisateurs->getId(),
            'abonner' => $utilisateurs,
        ]);
    }
}
