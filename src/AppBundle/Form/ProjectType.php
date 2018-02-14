<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
                ['label' => 'Título'])
            ->add('categories', ChoiceType::class,
                ['label' => 'Categorías',
                    'choices'  => [
                        'Seleccione una' => null,
                        'Educacional' => 'Educacional',
                        'Social' => 'Social',
                        'Sanitario' => 'Sanitario',
                        'Ninguna' => null
                    ]
                ])
            ->add('date_expiration', DateTimeType::class,
                ['label' => 'Fecha límite',
                'date_format' => 'dd-MM-yyyy'
                ])
            ->add('description', TextType::class,
                ['label' => 'Descripción'])
            ->add('address', TextType::class,
                ['label' => 'Direccion']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }


}
