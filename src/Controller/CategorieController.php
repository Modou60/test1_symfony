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
            'categorie' => $cat,
        ]);
    }

    /**
     * @Route("/{id}", name="cat_affichage",methods={"GET"})
     */
    public function idcategorie(Categorie $categorie, CategorieRepository $categorieRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('categorie/cataffichage.html.twig',[
            'id' => $categorie->getId(),
            'refcat' => $categorie,
        ]);
    }



}
