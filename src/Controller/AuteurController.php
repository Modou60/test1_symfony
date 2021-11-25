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
     * @Route("/", name="index_auteur")
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
                // 'id' => $auteurs->getId(),
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

    /**
     * @Route("/{id}/edit", name="indexedit", methods={"GET", "POST"})
     */
    public function editauteur(Request $request, Auteurs $auteurs, EntityManagerInterface $entityManagerInterface): Response
    {

    $form = $this->createForm(AuteursType::class, $auteurs);
    $form->handleRequest($request);

    // test de la soumission du formulaire
    if ($form->isSubmitted() && $form->isValid())
    {
        $entityManagerInterface->flush();

        // redirection de la page
        return $this->redirectToRoute('index_auteur');
    }

    // envoi de la page vers twig
    return $this->render('auteur/auteur_edit.html.twig', [
        'auteur' => $auteurs,
        
        'formauteur' => $form->createView(),
    ]);
    }

    /**
     * @Route("/{id}/sup", name="sup_auteur", methods={"GET", "POST"})
     */
    public function supauteur(Request $request, Auteurs $auteurs, EntityManagerInterface $entityManagerInterface)
{
    $autform =$this->createForm(AuteursType::class, $auteurs);
    $autform->handleRequest($request);
    //test de la validité
    if ($autform->isSubmitted() && $autform->isValid())
    {
        $entityManagerInterface->remove($auteurs);
        $entityManagerInterface->flush();

        // redirection de la page
        return $this->redirectToRoute('index_auteur');
    }

    // envoi de la page vers twig
    return $this->render('auteur/auteur_sup.html.twig', [
        'auteurs' => $auteurs,
        'autformulaire' => $autform->createView(),
    ]);
}
}
