<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 /**
 * @Route("/article")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="ger_article")
     */
    // première méthode
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();
        return $this->render('article/index.html.twig', [
            'produit' => $articles,

        ]);
    }

    // deuxième méthode
    /**
     * @Route("/{id}", name="art_affichage",methods={"GET"})
     */
    public function montrer(Articles $articles, ArticlesRepository $articlesRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('article/affichage.html.twig',[
            'id' => $articles->getId(),
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/nouveau", name="articles_nouveau", methods={"GET", "POST"})
     */
    public function nouveau(Request $request, EntityManagerInterface $em): Response
    {

       $articles = new Articles();

       // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
       $articles->setTitre(" Titre de mon Article");
       $articles->setImage(" photo de mon Article");
       $articles->setResume(" Titre de mon Article");
       $articles->setDate(new  \DateTime());
       $articles->setContenu(" Contenu de mon Article Contenu de mon ArticleContenu de mon ArticleContenu de mon ArticleContenu de mon Article");

       // Je persiste Mon Enregistrement
       $em->persist($articles);
       $em->flush();

       // J'envoie au niveau du temple pour l'enregistrement
       return $this->render('article/artnouveau.html.twig', [
           'articles' => $articles,
       ]);
    }
}
