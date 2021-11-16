<?php

namespace App\Form;

use App\Entity\Articles;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Entrez le titre',
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Entrez le résumé'
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Entrez le contenu'
            ])
            ->add('date', DateTimeType::class, [
                'required' => false,
            ])
            ->add('image')
            ->add('Envoyer', SubmitType::class,[
                'label' => 'Valider'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
    }
