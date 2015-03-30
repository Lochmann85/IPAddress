<?php

namespace Iam\IPBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_ip")
     */
    public function indexAction() {
        $ip = "000";
        return $this->render('IamIPBundle:Default:index.html.twig', array('ip_address' => $ip));
    }
}
