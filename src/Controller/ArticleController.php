<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="index_gerarticle")
     */
    //1e Methode
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles' => $articles,
        ]);
    }
}
