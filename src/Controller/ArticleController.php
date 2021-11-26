<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\ORM\EntityManager;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
// use Symfony\Component\Validator\Constraints\DateTime;
// use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
// use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @Route("/article")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="demarrage")
     */
    public function demarrage(): Response
    {
        return $this->render('article/index.html.twig', []);
    }


    /**
     * @Route("/livre", name="livre")
     */
    // Affichage de tous les articles
    public function livre(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $produit = $repo->findAll();
        return $this->render('article/livre.html.twig', [
            'articles' => $produit,
        ]);
    }


    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function formulairePage(Request $request): Response
    {
        $livre = new Articles;
        // créer mon formulaire à partir du type existant
        $formarticle = $this->createForm(ArticlesType::class, $livre);
        $formarticle->handleRequest($request);

        // test pour la validité du formulaire et sa persistance
        if ($formarticle->isSubmitted() && $formarticle->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($livre);
            $manager->flush();
            $this->addFlash("Article", "L'article abien été ajouté.");
            // redirection
            return $this->redirectToRoute('livre');
        }

        // envoie du formulaire à la page twig
        return $this->render('article/livreformulaire.html.twig', [
            'nouvlivre' => $livre,
            'Articleform' => $formarticle->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_id", methods={"GET", "POST"})
     */
    public function montrer(Request $request, Articles $articles, EntityManagerInterface $entityManagerInterface): Response
    {
        $commentaires = new Commentaires();
        $form = $this->createForm(CommentairesType::class, $commentaires);
        $form->handleRequest($request);
        // test du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaires->setDate(new \DateTime());
            $entityManagerInterface->persist($commentaires);
            $articles->addCommentaire($commentaires);
            $entityManagerInterface->flush();

            // redirection
            return $this->redirectToRoute('article_id', ["id" => $articles->getId()]);
        }

        return $this->render('article/affichage.html.twig', [
            'articles' => $articles,
            'auteur' => $articles->getAuteur(),
            'formcommentaire' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit_modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Articles $articles, EntityManagerInterface $manager)
    {
        $formedit = $this->createForm(ArticlesType::class, $articles);
        $formedit->handleRequest($request);

        // test de la validité
        if ($formedit->isSubmitted() && $formedit->isValid()) {
            $articles->setDate(new \DateTime());
            $manager->flush();
            // redirection de la page
            return $this->redirectToRoute('livre');
        }


        // envoi de la page vers twig
        return $this->render('article/modif_article.html.twig', [
            'form' => $articles,
            'formedit' => $formedit->createView(),
        ]);
    }

    /**
     * @route("/{id}/del", name="del_article", methods={"GET", "POST"})
     */
    public function supprimerArticle(Request $request, Articles $articles, EntityManagerInterface $manager)
    {
        $formedit = $this->createForm(ArticlesType::class, $articles);
        $formedit->handleRequest($request);

        // test de la validité
        if ($formedit->isSubmitted() && $formedit->isValid()) {
            $manager->remove($articles);
            $manager->flush();
            // redirection de la page
            return $this->redirectToRoute('livre');
        }


        // envoi de la page vers twig
        return $this->render('article/supprimer.html.twig', [
            'form' => $articles,
            'formedit' => $formedit->createView(),
        ]);
    }
}
