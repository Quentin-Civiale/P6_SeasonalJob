<?php

namespace P6\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertSearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userRole', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Annonce saisonnier' => 'saisonnier',
                    'Annonce employeur' => 'employeur',
                ],
                'choices_as_values' => true,'multiple'=>false,'expanded'=>true
            ])
            ->add('category', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Catégorie de l\'annonce'
                ],
                'data' => '-- Choisissez une catégorie --',
                'choices' => [
                    'Choisissez une catégorie' => [
                        '-- Choisissez une catégorie --' => '',
                        'Agriculture' => 'agriculture',
                        'Animation' => 'animation',
                        'Banque' => 'banque',
                        'Camping' => 'camping',
                        'Club nautique' => 'club nautique',
                        'Crêche' => 'crêche',
                        'Entretien' => 'entretien',
                        'Grande distribution' => 'grande distribution',
                        'Hôtellerie' => 'hôtellerie',
                        'Industrie' => 'industrie',
                        'Magasin' => 'magasin',
                        'Manutention' => 'manutention',
                        'Parc de loisirs' => 'parc de loisirs',
                        'Restauration' => 'restauration',
                        'Tourisme' => 'tourisme',
                    ]
                ]
            ])
            ->add('place', TextareaType::class, [
//                'required' => false,
//                'label' => false,
//                'attr' => [
//                    'placeholder' => 'Lieu du poste'
//                ]
                'attr' => [ 'readonly' => true,
                    'class' => 'form-control form-control-plaintext selected-city-search-field',
                    'placeholder' => 'Aucune'
                ],
                'label' => 'Lieu du poste :',
                'data' => '',
            ])
//            ->add('save', ResetType::class, [
//                'label' => 'Supprimer les filtres',
//                'attr' => [
//                    'class' => 'save'
//                ]
//            ])
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'P6\GeneralBundle\Entity\AdvertSearch',
            'method' => 'get',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }


}
