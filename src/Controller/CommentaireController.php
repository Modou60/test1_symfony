<?php

namespace App\Controller;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
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
     * @Route("/", name="index_commentaire")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Commentaire::class);
        $commentaire = $repo->findAll();

        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaire,
        ]);
    }

    /**
     * @Route("/nouveaucom", name="nouveaucom", methods={"GET", "POST"})
     */
    public function nouveaucom(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // j'instancie la classe Commentaire
        $commentaire = new Commentaires();
        // création de formulaire
        $formcom = $this->createForm(CommentairesType::class, $commentaire);
        $formcom->handleRequest($request);

        //test formulaire
        if ($formcom->isSubmitted() && $formcom->isValid())
        {
            $entityManagerInterface->persist($commentaire);
            $entityManagerInterface->flush();

            // redirection
            return $this->redirectToRoute('index_commentaire');
        }

        // affichage de la page vers twig
        return $this->render('commentaire/nouveaucom.html.twig', [
            'commentaires' => $commentaire,
            'commentaireform' => $formcom->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="afficher_com", methods={"GET"})
     */
    public function affichercom(Commentaires $commentaires): Response
    {
        return $this->render('commentaire/affichecom.html.twig', [
            'id' => $commentaires->getId(),
            'commentaires' => $commentaires,
        ]);
    }
}
