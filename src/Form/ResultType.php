<?php

namespace App\Form;

use App\Entity\Result;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_results')
            ->add('result_state')
            ->add('adress_ip')
            ->add('id_questions')
            ->add('id_users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Result::class,
        ]);
    }
}
