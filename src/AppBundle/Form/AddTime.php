<?php


namespace AppBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class AddTime extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName', EntityType::class, array('class' => 'AppBundle\Entity\Users'
            , 'choice_label' => 'name'))
            ->add('hour')
            ->add('date', TextType::class, array('label' => 'Date: (days.month.year) ex. 30.04.17 '))
            ->add('save', SubmitType::class)
        ;
    }

}