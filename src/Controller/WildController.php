<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        return $this->render(
            'wild/index.html.twig', [
                'programs' => $programs
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