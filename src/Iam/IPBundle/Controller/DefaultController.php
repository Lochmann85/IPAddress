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
//        $ipAddress = '131.130.58.211'; //wien
//        $ipAddress = '129.27.2.3'; //graz
//        $ipAddress = '141.84.147.198'; //garching, kein Gutschein für diese Stadt
        $ipAddress = '138.232.1.1'; //innsbruck
//        $ipAddress = '131.159.42.0'; //münchen
//        $ipAddress = '81.169.145.154'; //berlin
//        $ipAddress = '86.3.178.34'; //london
//        $ipAddress = '212.183.140.6'; //united kingdom keine stadt gefunden
        $geoip = $this->get('maxmind.geoip')->lookup($ipAddress);

        $em = $this->getDoctrine()->getManager();
        
        $countryRepository = $em->getRepository('IamIPBundle:Country');
        $country = $countryRepository->findOneBy(array('name' => $geoip->getCountryName()));

        $townRepository = $em->getRepository('IamIPBundle:Town');
        $townFromIP = $townRepository->findOneBy(array('name' => $geoip->getCity()));

        $voucherRepository = $em->getRepository('IamIPBundle:Voucher');
        $voucherCityContainer = $voucherRepository->findBy(array('town' => $townFromIP));

        if (isset($townFromIP) && isset($country)) {
            $townFromCountry = $townRepository->createQueryBuilder('p')
                    ->addSelect('c')
                    ->join('p.country','c')
                    ->where('p.id <> ' . $townFromIP->getId())
                    ->andWhere('c.id = :country_id')->setParameters(array('country_id' => $country->getId()))
                    ->getQuery()
                    ->getResult();
            $voucherCountryContainer = $voucherRepository->findBy(array('town' => $townFromCountry));
        }
        else if (isset($country)) {
            $townFromCountry = $townRepository->createQueryBuilder('p')
                    ->addSelect('c')
                    ->join('p.country','c')
                    ->where('c.id = :country_id')->setParameters(array('country_id' => $country->getId()))
                    ->getQuery()
                    ->getResult();
            $voucherCountryContainer = $voucherRepository->findBy(array('town' => $townFromCountry));
        }
        else {
            $voucherCountryContainer = array();
        }
        
        if (isset($country)) {
            $townRest = $townRepository->createQueryBuilder('p')
                    ->addSelect('c')
                    ->join('p.country','c')
                    ->where('c.id <> :country_id')->setParameters(array('country_id' => $country->getId()))
                    ->getQuery()
                    ->getResult();
            $voucherRestContainer = $voucherRepository->findBy(array('town' => $townRest));
        }
        else {
            $voucherRestContainer = $voucherRepository->findAll();
        }
        
        return $this->render('IamIPBundle:Default:index.html.twig', array(
            'ipAddress' => $ipAddress,
            'geoip' => $geoip,
            'voucherCityContainer' => $voucherCityContainer,
            'voucherCountryContainer' => $voucherCountryContainer,
            'voucherRestContainer' => $voucherRestContainer
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
