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
        $user = $username->toArray();
        $userCount = count($user);

        if ($userCount == 0)
        {
            echo "You have to select users!";
            die();
        }

        // Stworzenie tablicy z nazwa uzytkownika
        for ($i = 0; $i < $userCount; $i++)
        {
            $user[$i] = $user[$i]->getName();
        }

        // sprawdzenie godzin zajętych dla każdego wybranego usera
            for ($i = 0; $i < $userCount; $i++)
            {
                $hours[$i] = $dateClass->checkThisDate($data, $user[$i]);
            }
        // sprawdzenie godzin pracy wybranych userów
            $maxhours = $dateClass->maxHours();


        // Wybranie godzin wolnych dla kazdego usera
            $array = $dateClass->freeHours($userCount,$hours,$maxhours);

        // Tworzy array z wolnymi godzinami dla wszystkich uzytkownikow
            $result = $dateClass->resultFreeHours($array, $userCount);


            return $this->render('default/results.html.twig', array( 'results' => $result, 'day' => $data));
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}