<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location")
 */
class LocationController extends AbstractController
{
    /**
     * @Route("/", name="location")
     */
    public function index(): Response
    {
        // création de la requête de toutes les locations pour être affichées
    
        $repo = $this->getDoctrine()->getRepository(Location::class);
        $location = $repo->findAll();

        // envoi vers la page twig pour être affichée
        return $this->render('location/index.html.twig', [
            'locations' => $location,            
        ]);
    }

    /**
     * @Route("/locform", name="locform")
     */
    public function formlocation(Request $request): Response
    {
        $location = new Location;

        // création d'un formulaire
        $formlocation = $this->createForm(LocationType::class);
        $formlocation->handleRequest($request);

        // test pour la validité du formulaire et sa persistance
        if ($formlocation->isSubmitted() && $formlocation->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
           $manager->persist($location);
            $manager->flush();

            // redirection de la page après persistance
            return $this->redirectToRoute('location');
        }

        // envoi de la page vers twig pour son affichage
        return $this->render('location/locformulaire.html.twig',[
            'nouvelleloc' => $location,
            'locationform' => $formlocation->createView(),
        ]);

    }

    // affichage d'une location donnée
    /**
     * @Route("/{id}", name="location_id", methods={"GET"})
     */
    public function idlocation(Location $location)
    {
return $this->render('location/affichelocation.html.twig',[
    'loc' => $location,
]);
    }
}
