<?php


namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Service\DateClass;
use AppBundle\Entity\DateAndTime;
use AppBundle\Form\FindForm;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Internal\Hydration\ArrayHydrator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Users;
use Doctrine\ORM\Configuration;




class FindDateController extends Controller
{
    /**
     * @Route("/findtime", name="findtime")
     */
    public function timeFinding(Request $request, DateClass $dateClass)
    {

        $form = $this->createForm(FindForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Pobranie danych z form
            $data = $form->get('date')->getData();

            $username = $form->get('name')->getData();
            // Wybiera wybranych w formularzu userów
        $userrrr = $username->toArray();
        $userCount = count($userrrr);
        echo $userCount;
        for ($i = 0; $i < $userCount; $i++)
        {
            $userrrr[$i] = $userrrr[$i]->getName();
        }
        //$userrrr= $userrrr[1]->getName();

        var_dump($userrrr);
            // Pobranie godzin zajętych w danej dacie
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('AppBundle:DateAndTime');

            $hours = $dateClass->CheckThisDate($repo, $data, $userrrr[0]);

            var_dump($hours);


            // Pobranie konca pracy zrób service z parametrem do username? where = userName~
            // przekazanie do service dayFind -> do arraya i tak array dla każdego usera
            $repo2 = $em->getRepository('AppBundle:Users');
            $maxhours = $dateClass->MaxHours($repo2);

            echo "<br> <br> <br>";


         $result = $dateClass->dayFind($hours,$maxhours);
               var_dump($result);

//           Sprawdzenie wartości których niema ani w A ani w B
//            function arrayDiff($A, $B) {
//                $intersect = array_intersect($A, $B);
//                return array_merge(array_diff($A, $intersect), array_diff($B, $intersect));
//            }
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}