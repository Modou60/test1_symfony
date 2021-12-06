<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="categorie")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $cat = $repo->findAll();
        return $this->render('categorie/index.html.twig', [
            'totalcategorie' => count($cat),
            'categories' => $cat,
        ]);
    }


    /**
     * @Route("/fcategorie", name="fcategorie")
     */
    public function formulairecategorie(Request $request): Response
    {
        // instanciation de la classe Categorie
        $categorie = new Categorie;

        // créer mon formulaire à partir de CategorieType
        $formcategorie = $this->createForm(CategorieType::class, $categorie);
        $formcategorie->handleRequest($request);

// test pour la validité du formulaire
        if ($formcategorie->isSubmitted() && $formcategorie->isValid()) {
            // je persiste mes données
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($categorie);
            $manager->flush();
            
// redirection
            return $this->redirectToRoute('categorie');
        }

       // envoie du formulaire à la page twig pour son affichage
       return $this->render('categorie/catformulaire.html.twig',[
           'nouvellecat' => $categorie,
           'Catform' => $formcategorie->createView(),
       ]);   
    }


        /**
     * @Route("/creercat", name="creer")
     */
    // Ici on Fait un Enregistrement avec un Formulaire

    public function pageForm(Request $request, EntityManagerInterface $manager)
    {
        $categorie = new Categorie(); // Instanciation


        // Création de mon Formulaire
        $form = $this->createFormBuilder($categorie)
            ->add('titre')
             ->add('resume')

            // Demande le résultat
            ->getForm();

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $manager->persist($categorie); 
             $manager->flush();

             return $this->redirectToRoute('categorie', 
             [
                 'id'=>$categorie->getId()]); // Redirection vers la page
         }

        $manager->persist($categorie);
        $manager->flush();

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('categorie/newcategorie.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }



    // /**
    //  * @Route("/nouvelle", name="nouvellecategorie", methods={"GET", "POST"})
    //  */
    // public function nouvellecat(Request $request, EntityManagerInterface $em): Response
    // {

    //    $categorie = new Categorie();

    // // je fais un enregistrement manuel
    //    $categorie->setTitre(" Titre de ma catégorie");
    //    $categorie->setResume(" Résumé de ma catégorie");

    //    // Je persiste Mon Enregistrement
    //    $em->persist($categorie);
    //    $em->flush();

    //    // J'envoie au niveau du temple pour l'enregistrement
    //    return $this->render('categorie/nouvellecategorie.html.twig', [
    //        'produitcat' => $categorie,
    //    ]);
    // }

    /**
     * @Route("/{id}", name="cat_id", methods={"GET"})
     */

    public function idcategorie(Categorie $categorie)
    {
        return $this->render('categorie/cataffichage.html.twig',[ 
            'categor' => $categorie,
        ]);
    }

/**
 * @Route("/{id}/edit", name="edit_categorie", methods={"GET", "POST"})
 */
public function edit(Request $request, Categorie $categorie, EntityManagerInterface $manager)
{
    $formedit = $this->createForm(CategorieType::class, $categorie);
    $formedit->handleRequest($request);

    // test de la validité
    if ($formedit->isSubmitted() && $formedit->isValid())
    {
        $manager->flush();
        // redirection de la page
        return $this->redirectToRoute('categorie');
    }
    
    
    // envoi de la page vers twig
    return $this->render('categorie/catform.html.twig', [
         'form' => $categorie,
        'formedit' => $formedit->createView(),
    ]);
    
}

/**
 * @Route("/{id}/del", name="del_categorie", methods={"GET", "POST"})
 */
public function supprimer(Request $request, Categorie $categorie, EntityManagerInterface $manager)
{
    $formedit = $this->createForm(CategorieType::class, $categorie);
    $formedit->handleRequest($request);

    // test de la validité
    if ($formedit->isSubmitted() && $formedit->isValid())
    {
        $manager->remove($categorie);
        $manager->flush();
        // redirection de la page
        return $this->redirectToRoute('categorie');
    }
    
    
    // envoi de la page vers twig
    return $this->render('categorie/supprimer_categorie.html.twig', [
         'form' => $categorie,
        'formedit' => $formedit->createView(),
    ]);
    
}



}
