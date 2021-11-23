<?php

namespace App\Controller;
use App\Entity\Commentaire;
use App\Form\CommentairesTypes;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/index_commentaire", name="index_commentaire")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Commentaire::class);
        $commentaire = $repo->findAll();

        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaire,
            
        ]);
    }
}
