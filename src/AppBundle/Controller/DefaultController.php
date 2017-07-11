<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return  $this->render('default/base.html.twig');

//       $hour = date('H', time());
//
//        if( $hour > 6 && $hour <= 11) {
//            echo "Good Morning";
//        }
//        else if($hour > 11 && $hour <= 16) {
//            echo "Good Afternoon";
//        }
//        else if($hour > 16 && $hour <= 23) {
//            echo "Good Evening<br>";
//            $date = date('m.d.y H', time());
//            $date1 = date_create_from_format('m.d.y H', "07.02.17 23");
//            $date2 = date_create_from_format('m.d.y H', "07.02.17 13");
//            $date3 = $date2->format('m.d.y H');
//            $dateDiff = $date1->diff($date2);
//
//            echo $date."<br>";
//            echo $date3."<br>";
//            echo $dateDiff->format('%H%a days');
//        }
//        else {
//            echo "Why aren't you asleep?  Are you programming?";
//        }




    }
}
