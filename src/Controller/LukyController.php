<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
class LukyController extends AbstractController
{
    /**
     * @Route("/luky", name="luky")
     */
    public function index(): Response
    {
        return $this->render('luky/index.html.twig', [
            'controller_name' => 'LukyController',
        ]);
   }
   public function number(): Response
   {
   $number = random_int(0, 100);
   return new Response("<h1>Lucky number: {$number} </h1>");
   }
       /**
     * @Route("/luky3/{max}", name="luky3")
     */
    public function number3(int $max): Response
    {
    $number = random_int(0, $max);
    return new Response("<h1>Lucky number: {$number} </h1>");
    }
    /**
     * @Route("/luky2/{max<\d+>}", name="luky1")
     */
   public function number2(int $max): Response
   {
   $number = random_int(0, $max);
   return new Response("<h1>Lucky number: {$number} </h1>");
   }
   
 /**
     * @Route("/luky4/{max?}", name="luky5")
     */
    public function number4($max): Response
    {
        if (!is_numeric($max)){
            throw new HttpException(404,"erreur!!!!");
        }
    $number = random_int(0, $max);
    return new Response("<h1>Lucky number: {$number} </h1>");
    }
}




