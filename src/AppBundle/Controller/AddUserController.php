<?php
/**
 * Created by PhpStorm.
 * User: Wonsacz
 * Date: 2017-07-04
 * Time: 17:49
 */

namespace AppBundle\Controller;

use AppBundle\Form\AddUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Users;

class AddUserController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/adduser", name="add_user")
     */
    public function newUser(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(AddUser::class, $user);

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