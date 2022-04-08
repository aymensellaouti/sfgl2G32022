<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController
{
    /**
     * @Route("/first")
     */
    public function first(): Response {
        return new Response(
            "<h1> Hello GL2 G3 :) </h1>"
        );
    }
}