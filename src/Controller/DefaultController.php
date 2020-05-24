<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/wild", name="app_index")
     */

    public function index() :Response
    {
        //return new Response(
        //'<html><body>Wild Series Index</body></html>'
        //);
        return $this->render('/index.html.twig', [
            'website' => ' GO To Navbar !',
        ]);
    }
}