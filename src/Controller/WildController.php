<?php

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

    /**
     * @Route("wild/show/{slug}", requirements={"slug"="[a-z0-9-]+$"}, defaults={"slug"=null}, name="wild_show")
     * @param $slug
     * @return Response
     */
    public function show($slug) : Response
    {
        if ($slug != null) {
            $slug = ucwords(str_replace('-', ' ', $slug));
        } else {
            $slug = "Aucune série sélectionnée, veuillez choisir une série";
        }
        return $this->render('wild/show.html.twig', [
            'slug' => $slug
        ]);
    }





}