<?php
/**
 * Created by PhpStorm.
 * User: Wonsacz
 * Date: 2017-07-05
 * Time: 22:37
 */

namespace AppBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Entity\Users;

class FindForm extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('name', EntityType::class, array('class' => 'AppBundle\Entity\Users'
        , 'choice_label' => 'name', 'expanded' => true, 'multiple' => true))
        ->add('date', TextType::class, array('label' => 'Date: (days.month.year) ex. 31.04.17 '))
        ->add('save', SubmitType::class)
    ;
}
}