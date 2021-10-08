<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController2Controller extends AbstractController
{
    /**
     * @Route("/default/controller2", name="default_controller2")
     */
    public function index(): Response
    {
        return $this->render('default_controller2/index.html.twig', [
            'controller_name' => 'DefaultController2Controller',
        ]);
    }
}
