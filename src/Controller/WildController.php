<?php

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * @Route("/", name="base")
    */

    public function index() :Response
    {
        //return new Response(
        //'<html><body>Wild Series Index</body></html>'
        //);
        return $this->render('base.html.twig', [
            'website' => 'Fu#k is the new home ',
        ]);
    }
}