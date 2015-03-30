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
        $ipAddress = '131.130.58.211'; //wien
//        $ipAddress = '129.27.2.3'; //graz
//        $ipAddress = '141.84.147.198'; //garching
//        $ipAddress = '138.232.1.1'; //innsbruck
//        $ipAddress = '131.159.42.0'; //münchen
//        $ipAddress = '81.169.145.154'; //berlin
        $geoip = $this->get('maxmind.geoip')->lookup($ipAddress);

        return $this->render('IamIPBundle:Default:index.html.twig', array(
            'ipAddress' => $ipAddress,
            'geoip' => $geoip
        ));
    }
    
    private function getUserIP() {
        if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            }
            else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}
