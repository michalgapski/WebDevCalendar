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

        if ($userCount == 0)
        {
            echo "You have to select users!";
            die();
        }
        for ($i = 0; $i < $userCount; $i++)
        {
            $userrrr[$i] = $userrrr[$i]->getName();
        }

            // Pobranie godzin zajętych w danej dacie
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('AppBundle:DateAndTime');

        // sprawdzenie godzin zajętych dla każdego wybranego usera
            for ($i = 0; $i < $userCount; $i++)
            {
                $hours[$i] = $dateClass->CheckThisDate($repo, $data, $userrrr[$i]);
            }

            // sprawdzenie godzin pracy wybranych userów
            $repo = $em->getRepository('AppBundle:Users');
            $maxhours = $dateClass->MaxHours($repo);


        // Wybranie godzin wolnych dla kazdego usera
            for ($i = 0; $i < $userCount; $i++)
            {
                $array[$i] = $dateClass->dayFind($hours[$i],$maxhours);
            }

        // Połączenie tablic zmiennych + przefiltrowanie pod względem ilości zgadzających się wyników
        $arraymerge = array_merge(...$array);
            $counts = array_count_values($arraymerge);
            $duplicates = array_filter($counts, function($element) { return ($element > 1); });

        // Usuwa godziny które zgadzają się ale nie dla wszystkich wybranych userow
     foreach ($duplicates as $key => $value)
     {
         if ($value < $userCount)
         {
             unset($duplicates[$key]);
         }
     }

            return $this->render('default/results.html.twig', array( 'results' => $duplicates, 'day' => $data));
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}