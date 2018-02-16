<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EditProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
                ['label' => 'Título'])
            ->add('date_expiration', DateTimeType::class,
                ['label' => 'Fecha límite',
                'date_format' => 'dd-MM-yyyy'
                ])
            ->add('description', TextType::class,
                ['label' => 'Descripción'])
            ->add('maxMembers', IntegerType::class,
                [
                    'label' => 'Socios máximos',
                ])
            ->add('actualMembers', IntegerType::class,
                [
                    'label' => 'Socios actuales',
                    'required' => false
                ])
            ->add('interestedPeople', IntegerType::class,
                ['label' => 'Personas interesadas'])
            ->add('location', TextType::class,
                ['label' => 'Ubicación']);
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
