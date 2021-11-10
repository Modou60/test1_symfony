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
        // je fais une requette dans la base pour avoir toutes les locations
        $repo = $this->getDoctrine()->getRepository(Location::class);
        $location = $repo->findAll();

        // J'envoie le résultat vers la page twig
        return $this->render('location/index.html.twig', [
            'locations' => $location,
        ]);
    }


/**
 * @Route("/locform", name="locform")
 */
public function formlocation(Request $request, EntityManagerInterface $entityManagerInterface, EntityManager $manager): Response
{
    // instanciation de la classe Location
    $location = new Location;
    // Cration d'un formulaire
    $formloc = $this->createForm(LocationType::class, $location);
    $formloc->handleRequest($request);

    // Test pour la validité du formulaire et sa persistance
    if ($formloc->isSubmitted() && $formloc->isValid())
    {
    // $manager = $this->getDoctrine()->getManager();
    $manager->persist($location);
    $manager->flush();

   // redirection de la page après  persistance
    return $this->redirectToRoute('location');
}

// envoi de la page vers twig pour son affichage
return $this->render('location/locformulaire.html.twig',[
    'location' => $location,
    'locationform' => $formloc->createView(),
]);
}


// Affichage d'une location donnée
/**
 * @Route("/{id}", name="location_id", methods={"GET"})
 */
public function idlocation(Location $location): Response
    {
return $this->render('location/affichelocation.html.twig',[
    'loc' => $location,
]);
    }

}
