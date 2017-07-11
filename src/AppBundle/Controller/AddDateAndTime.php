<?php

namespace AppBundle\Controller;

use AppBundle\Form\AddTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\DateAndTime;



class AddDateAndTime extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/addtime", name="add_time_date")
     *
     */

    public function addTime(Request $request)
    {
        $date = new DateAndTime();
        $form = $this->createForm(AddTime::class, $date);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $this->addFlash(
                'notice',
                'Your changes were saved!');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}