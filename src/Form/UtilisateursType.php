<?php

namespace App\Form;

use App\Entity\Utilisateurs;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\StringType;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Entrez votre nom :',
                'required' => 'true'
            ])
            ->add('prenom', TextType::class,[
                'label' => 'Entrez prénom :',
                'required' => 'true'
            ])
            ->add('dateNaissance')
            ->add('login', TextType::class, [
                'label' => 'Entrez votre login',
                'required' => 'true'
            ])
            ->add('passWord', PasswordType::class, [
                'label' => 'Entrez votre mot de passe :',
                'required' => 'true'
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Entrez votre adresse :'
            ])
            ->add('email', EmailType::class)
            ->add('photo')
            ->add('role', ChoiceType::class,[
                'choices' => ["Validée" => "Validée", "en attente" => "En attente", "Annulée" => "Annulée"]
            ])
            ->add('Envoyer', SubmitType::class,[
                'label' => 'Valider'
            ])
            ; 
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
   

}
