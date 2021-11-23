<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Form\AuteursType;
use App\Repository\AuteursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

/**
 * @Route("/auteur")
 */
class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="index_auteur")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Auteurs::class);
        $art = $repo->findAll();

        return $this->render('auteur/index.html.twig', [
            'auteurs' => $art,
        ]);
    }

    // fonction pour ajouter un nouvel auteur
    /**
     * @Route("/nouvelauteur", name="nouvel_auteur")
     */
    public function nouvelAuteur(Request $request): Response
    {
        $auteurs = new Auteurs;
        // je crée mon formulaire à partir d'un type existant
        $formauteur = $this->createForm(AuteursType::class, $auteurs);
        $formauteur->handleRequest($request);

        // test de la validité du formulaire et sa persistance
        if ($formauteur->isSubmitted() && $formauteur->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($auteurs);
            $manager->flush();

            // redirection
            return $this->redirectToRoute('auteur_id',[
                'id' => $auteurs->getId(),
            ]);
        } 

        // Envoi de la page vers twig
        return $this->render('auteur/nouvel_auteur.html.twig', [
            'ecrivain' => $auteurs,
            'formauteur' => $formauteur->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="auteur_id", methods={"GET"})
     */
    public function afficherAuteur(Auteurs $auteurs): Response
    {
        return $this->render('auteur/affiche_auteur.html.twig', [
            'article' => $auteurs->getArticle(),
            'auteur' => $auteurs,
        ]);
    }
}
