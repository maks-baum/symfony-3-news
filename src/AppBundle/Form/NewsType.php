<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;


class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author', EntityType::class, [
            'class' => 'AppBundle:Author',
            ])
            ->add('category', EntityType::class, [
                'class' => 'AppBundle:Category',
            ])
            ->add('tags', EntityType::class, [
                'class' => 'AppBundle:Tag',
                'multiple' => true
            ])
            ->add('title', TextType::class)
            ->add('slug', TextType::class)
            ->add('summary', TextareaType::class, [
                'attr' => ['cols' => 60, 'rows' => 3]
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['cols' => 60, 'rows' => 10]
            ])
            ->add('save', SubmitType::class)
        ;
    }
}
