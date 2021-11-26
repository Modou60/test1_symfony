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
            'utilisateurs' => $utilisateur,
        ]);
    }


    /**
     * @Route("/formutilisateur", name="formutilisateur")
     */
    public function foruser(Request $request)
    {
    
        // Instanciation de la classe Utilisateurs
    $utilisateurs = new Utilisateurs;

    // création d'un formulaire à partir de UtilisateursType
    $formutilisateur = $this->createForm(UtilisateursType::class, $utilisateurs);
$formutilisateur->handleRequest($request);

// Teste pour la soumission du formulaire et sa persistance
if ($formutilisateur->isSubmitted() && $formutilisateur->isValid())
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($utilisateurs);
    $entityManager->flush();

    // Redirection vers la page de la liste de tous les utilisateurs
    return $this->redirectToRoute('utilisateur');
}

// envoie de du formulaire à la page twig pour son affichage
return $this->render('utilisateur/nouvelutilisateur.html.twig',[
    'nouveau' => $utilisateurs,
    'userform' => $formutilisateur->createView(),
]);
}

    /**
     * @Route("/{id}", name="utilisateur_id",methods={"GET"})
     */
    public function iduser(Utilisateurs $utilisateurs): Response
    {
        return $this->render('utilisateur/affichageuser.html.twig', [
            
            'abonne' => $utilisateurs,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="modif_utilisateur", methods={"GET", "POST"})
     */
    public function modifUser(Request $request, Utilisateurs $utilisateurs, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateurs);
        $form->handleRequest($request);

        // test de la validité
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->flush();
            // Redirection de la page
            return $this->redirectToRoute('utilisateur_id ["id" => $utilisateurs->getId]');
        }

        // Envoi vers la page twig
        return $this->render('utilisateur/modif_utilisateur.html.twig',[
            'formuser' => $utilisateurs,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/supprime", name="supprime_utilisateur", methods={"GET", "POST"})
     */
    public function supprimUser(Request $request, Utilisateurs $utilisateur, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        // test de la validité
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->remove($utilisateur);
            $manager->flush();
            // Redirection de la page
            return $this->redirectToRoute('utilisateur_id, ["id" => $utilisateurs->getId]');
        }

        // Envoi vers la page twig
        return $this->render('utilisateur/supprime_utilisateur.html.twig',[
            'formuser' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

}
