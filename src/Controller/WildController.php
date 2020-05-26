<?php

namespace App\Controller;


use App\Entity\Program;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WildController extends AbstractController
{

    /**
    * @Route("/wild", name="wild_index")
    */

    public function index()
    {
        $programs = $this->getDoctrine()->getRepository(Program::class)->findAll();
        return $this->render('wild/index.html.twig', [
            'programs' => $programs,
        ]);

    }

    /**
     * @Route("wild/show/{slug}", requirements={"slug"="[a-z0-9-]+$"}, defaults={"slug"=null}, name="wild_show")
     * @param $slug
     * @return Response
     */
    public function show($slug) : Response
    {
        if (!$slug){
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ',ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with '.$slug.' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig',[
            'program'=> $program,
            'slug' => $slug,
        ]);

        /***************** quête_5 ********************************************/
       // if ($slug != null) {
         //   $slug = ucwords(str_replace('-', ' ', $slug));
        //} else {
          //  $slug = "Aucune série sélectionnée, veuillez choisir une série";
        //}
        //return $this->render('wild/show.html.twig', [
            //'slug' => $slug
        //]);
        /********************************************************************/
    }

    /**
     * @Route("wild/category/{categoryName}", name="wild_category")
     * @param $categoryName
     * @return Response
     */

    public function showByCategory(string $categoryName) : Response
    {

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name'=> mb_strtolower($categoryName)]);
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $category], ['id'=> 'DESC'], 3);
        if (!$category) {
            throw $this->createNotFoundException(
                'No program with ' . $categoryName . ' title, found in program\'s table.');
        }
        return $this->render('wild/category.html.twig', [
            'programs' => $programs,
            'categoryName'  => $category
        ]);

    }


}