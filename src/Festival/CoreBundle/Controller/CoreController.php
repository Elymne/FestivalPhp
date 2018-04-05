<?php

namespace Festival\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    
    public function indexAction()
    {
        $navbar = "home";

        return $this->render('@FestivalCore/Core/index.html.twig', array(
        	"navbar" => $navbar
        ));
    }
    
}