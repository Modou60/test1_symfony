<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use DateTime;
use Doctrine\DBAL\Types\StringType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', StringType::class)
            ->add('prenom', StringType::class)
            ->add('dateNaissance', DateTime::class)
            ->add('login', StringType::class)
            ->add('passWord', PasswordType::class)
            ->add('adresse', TextType::class)
            ->add('email', EmailType::class)
            ->add('photo')
            ->add('role')
            ; 
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
   

}
