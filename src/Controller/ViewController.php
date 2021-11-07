<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/view")
 */

class ViewController extends AbstractController
{
    /**
     * @Route("/index")
     */
    public function voir(): Response
    {
        return $this->render(
            'view/view.html.twig',
            [
                'controller_name' => 'index',
            ]
        );
    }

    /**
     * @Route("tableau", name="index_tab")
     */

    public function tables(): Response
    {
        // J'initialise mon tableau
        $tab = [10, 15, 18];

        // J'appelle la vue TABLEAUX/TWIG

        return $this->render(
            'ma_view_tab.html.twig',
            [
                // J'affiche Mon tableau
                'cours_name' => 'COMPOSANTE VUE',
                'tableau' => $tab,
            ]
        );
    }


    /**
     * @Route("/affiche", name="view_affiche")
     */

    public function affichage(): Response
    {

        //j'appelle la vue de l'affichage
        return $this->render('view/affichage.html.twig', [
            // j'affiche les données
            'nom' => 'Ndao',
            'prenom' => 'Modou',
        ]);
    }

    // liste des stagiaires DWWM2 dans vue twig
    /**
     * @Route("/liste", name="index_liste")
     */
    public function listeStagiaire(): Response
    {
        // Initialisation des 2 tableaux nom et prénom
        $prenom = ["Ange Planitey", "Bandiougou Traoré", "Fabrice Folrot", "Matthieu Thuet", "Moaaz Khassawneh", "Modou Ndao", "Nabi Abib", "Rudy Lopez", "Valery Nwehla"];
        // $nom = ["Planitey", "Traoré", "Folrot", "Thuet", "Khassawneh", "Ndao", "Abib", "Lopez", "Nwehla"];

        // appel de la vue listestagiaire
        return $this->render('view/Listestagiaire.html.twig', [
            // l'affichage des données
            'cour_name' => 'COMPOSANTE VUE',
            'liste_prenom' => $prenom,
        ]);
    }


    /**
     * @Route("/calcul", name="index_calcul")
     */
    public function calcul(): Response
    {
        // j'appelle la vue
        return $this->render('view/calcul.html.twig', [
            // J'affiche le résultat dans la vue
            'cours_name' => 'COMPOSANTE VUE',
        ]);
    }

    /**
     * @Route("/note", name="index_note")
     */
    public function calculNote(): Response
    {
        // appel de la vue calcul
        return $this->render('view/calcul.html.twig',[
            'cours_name' => 'COMPOSANTE VUE',
        ]);
    }



    /**
     * @Route("/operation", name="index_operation")
     */
    public function operation(): Response
    {
        return $this->render('view/calcul.html.twig',[
            'controller_name' => 'index_operation',
                    ]);
    }

    /**
     * @Route("/capitalize", name="index_capitalize")
     */
    public function majuscule(): Response
    {
        return $this->render('view/calcul.html.twig',[
'controller_name' => 'index_capitalize',
        ]);
    }

    /**
     * @Route("/moyenne", name="index_moyenne")
     */
public function moyenne(): Response
{
    return $this->render(
        'view/moyenne.html.twig',[
            'controller_name' => 'index_moyenne',
        ]);
}
}
