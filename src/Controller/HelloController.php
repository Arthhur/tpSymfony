<?php

// src/Controller/HelloController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController {
    /**
     * Hello world, avec Twig cette fois :)
     *
     * @Route("/")
     */
    public function hello() {
        return $this->render('base.html.twig');
    }

}