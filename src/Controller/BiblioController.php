<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BiblioController extends AbstractController
{
    /**
     * @Route("/biblio", name="biblio")
     */
    public function index(): Response
    {
        return $this->render('biblio/index.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }



    /**
     * @Route("/livre", name="index_livre")
     */
    public function livre(): Response
    {
        return $this->render('biblio/livres.html.twig', [
            'controller_name' => 'index_livre',
        ]);
    }

    /**
     * @Route("/quoi", name="index_quoi")
     */
    public function quoi(): Response
    {
        return $this->render('biblio/quoi.html.twig', [
            'controller_name' => 'index_quoi',
        ]);
    }

    /**
     * @Route("/quoi2", name="index_quoi2")
     */
    public function quoi2(): Response
    {
        return $this->render('biblio/quoi2.html.twig', [
            'controller_name' => 'index_quoi2',
        ]);
    }


    /**
     * @Route("/location", name="index_location")
     */
    public function location(): Response
    {
        return $this->render('biblio/location.html.twig', [
            'controller_name' => 'index_location',
        ]);
    }

    /**
     * @Route("/documentation", name="index_documentation")
     */
    public function documentation(): Response
    {
        return $this->render('biblio/documentation.html.twig', [
            'controller_name' => 'index_documentation',
        ]);
    }

    /**
     * @Route("/contact", name="index_contact")
     */
    public function contacter(): Response
    {
        return $this->render('biblio/contact.html.twig', [
            'controller_name' => 'index_contact',
        ]);
    }

    /**
     * @Route("/admin", name="index_admin")
     */
    public function administrer(): Response
    {
        return $this->render('biblio/admin.html.twig', [
            'controller_name' => 'index_admin',
        ]);
    }


    /**
     * @Route("/connexion", name="index_connexion")
     */
    public function connexion(): Response
    {
        return $this->render('biblio/connexion.html.twig', [
            'controller_name' => 'index_connexion',
        ]);
    }

    /**
     * @Route("/systeme", name="index_systeme")
     */
    public function systeme(): Response
    {
        return $this->render('biblio/systeme.html.twig', [
            'controller_name' => 'index_systeme',
        ]);
    }

    /**
     * @Route("/utilisateur", name="index_utilisateur")
     */
    public function utilisateur(): Response
    {
        return $this->render('biblio/utilisateurs.html.twig', [
            'controller_name' => 'index_utilisateur',
        ]);
    }

    /**
     * @Route("/articleindex", name="index_article")
     */
    public function article(): Response
    {
        return $this->render('biblio/article.html.twig', [
            'controller_name' => 'index_article',
        ]);
    }

    /**
     * @Route("/contenu", name="index_contenu")
     */
    public function gestionContenu(): Response
    {
        return $this->render('biblio/contenu.html.twig', [
            'controller_name' => 'index_contenu',
        ]);
    }

    /**
     * @Route("/image", name="index_image")
     */
    public function gestionImage(): Response
    {
        return $this->render('biblio/image.html.twig', [
            'controller_name' => 'index_image',
        ]);
    }

    /**
     * @Route("/extension", name="index_extension")
     */
    public function gestionExtension(): Response
    {
        return $this->render('biblio/extension.html.twig', [
            'controller_name' => 'index_extension',
        ]);
    }

    /**
     * @Route("/logout", name="index_logout")
     */
    public function logout(): Response
    {
        return $this->render('biblio/index.html.twig', [
            'controller_name' => 'index_logout',
        ]);
    }
}
