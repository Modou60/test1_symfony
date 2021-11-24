<?php

namespace App\Form;

use App\Entity\Auteurs;
use App\Entity\Articles;
use DateTime;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\FormTypeInterface;


class AuteursType extends AbstractType
{
    public function builderFormulaire(FormBuilderInterface $builder, array $options): void
    {
$builder
->add('nom', TextType::class,[
    'label' => 'Entrez le nom de l\'auteur :'
])
->add('prenom', TextType::class,[
    'label' => 'Entrez le prénom de l\'auteur :'
])
->add('email', EmailType::class,[
    'label' => 'Entrez le mail de l\'auteur :'
])
->add('article', EntityType::class, [
    'label' => 'Article',
    'placeholder' => 'Article',
    // le choi de la proprièté venant de l'entity
    'class' => Articles::class,
    // je fais le choix sur quelle proprété
    'choice_label' => 'titre',
    // used to render a select box, check boxes or radios
    // 'multiple' => true,
    // expanded => true,
])
->add('Envoyer', SubmitType::class, [
    'label' => 'Valider'
]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteurs::class,
        ]);
    }
}