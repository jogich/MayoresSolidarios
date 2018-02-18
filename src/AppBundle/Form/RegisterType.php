<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Doctrine\DBAL\Types\IntegerType;

class RegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class,
            ['label' => 'Nombre'])
            ->add('surname', TextType::class,
                ['label' => 'Apellidos'])
            ->add('email', EmailType::class,
                ['label' => 'Correo electrónico'])
            ->add('plainPassword', RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Contraseña'],
                    'second_options' => ['label' => 'Confirmar contraseña'],
                    'required' => false
                ])
            ->add('birthday', DateType::class,
                [
                    'label' => 'Fecha de nacimiento',
                    'placeholder' => array(
                        'day' => 'Día', 'month' => 'Mes', 'year' => 'Año'
                    ),
                    'years' => range(1918, 2018),
                    'format' => 'dd-MM-yyyy'
                ])
            ->add('phoneNumber', IntegerType::class,
                ['label' => 'Número de teléfono'])
            ->add('address', TextType::class,
                ['label' => 'Dirección']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
