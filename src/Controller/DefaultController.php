<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @route("/demarage", name="index_demarage")
     */


    public function demarrage(): Response
    {
        return $this->render(
            'DefaultController/index.html.twig',
            [
                'controller_name' => 'index_demarrage',
            ]
        );
    }
    
    // retourne une réponse
    /**
     * @Route("/salutation", name="index_bonjour")
     */
    public function bonjour()
    {
        return new Response("Bonjour tout le monde!");
    }

    // Manipuler l'objet Request

    // 1- Les paramètres de la requête
    // A - Les paramètres contenus dans les routes 

    /**
     * @Route("/article/{id}", name="index_bonjour2")
     */

    public function voirAction($id)
    {
        return new Response("Afficher l'article d'id : " . $id . ".");
    }

    // RESPONSE & VUE
    /**
     * @Route("/articl/{id}", name="index_affichage")
     */
    public function affichage($id)
    {
        // on utilise le raccourci il crée une Response
        // Et lui donne comme contenu le contenu du template
        return $this->render('defaultcontroller/affichage.html.twig', array('id' => $id,));
    }


    // REDIRECTION
    // return $this->redirectToRoute('homepage');

    /**
     * @Route("/redirect/{id}", name="index_redir")
     */
    public function redirecto($id)
    {
        return $this->redirectToRoute('index_affichage');
    }

    /**
     * @Route("/articles/{id}", name="index_bonjour3")
     */
    /** public function voirAction2($id)
    {
        // on récupère la requette
        $request = $this->getRequest();
        // On récupère notre paramètre tag
        $tag = $request->query->get('$tag');
        return new Response("Affichage de l'article d'id : " . $id . ", avec le tag : " . $tag);
    }
     */
}
