<?php

namespace App\Form;

use App\Entity\Biens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('surface')
            ->add('prix')
            ->add('nbPieces')
            ->add('nbChambre')
            ->add('etage')
            ->add('ville')
            ->add('adresse')
            ->add('cp')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Appartement' => 'Appartement',
                    'Maison' => 'Maison',
                    'Villa' => 'Villa',
                    'PentHouse' => 'PentHouse',
                ],
            ])
            
            ->add('imageFile', FileType::class, ['required' => false]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Biens::class,
        ]);
    }
}
