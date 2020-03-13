<?php

namespace P6\GeneralBundle\Form;

use P6\GeneralBundle\Entity\Advert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
            ])
            ->add('publishedDate', DateType::class)
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie de l\'annonce',
                'required' => true,
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
            ->add('description', TextareaType::class, [
                'required' => true,
                'attr' => [ 'onkeyup' => 'textCounter(this,\'counter\',500);'],
            ])
            ->add('place', TextareaType::class, [
                'required' => true,
                'attr' => [ 'readonly' => true,
                    'class' => 'form-control form-control-plaintext selected-city-field' ],
                'label' => 'Lieu du poste :',
                'data' => 'aucune',
//                'choices' => [
//                    'Toute la France' => 'France',
//                    'Région' => 'région',
//                    'Département' => 'département',
//                    'DOM-TOM' => 'dom-tom',
//                ]
            ])
            ->add('mobility', TextareaType::class, [
                'attr' => [ 'placeholder' => 'Région Auvergne, disponible sur tout le Puy-de-Dôme, rayon de 30km autour de Clermont-Ferrand',
                    'class' => 'mobility-option-field'],
                'label' => 'Si oui, veuillez préciser votre zone de mobilité.',
                'required' => false,
            ])
            ->add('dateStart', DateType::class, [
                'attr' => array('class' => 'calendar', 'min' => date('Y-m-d')),
//                'attr' => array('class' => 'calendar', 'data-provide' => 'datepicker'),
                'widget' => 'single_text',
//                'label' => 'Date de contrat',
//                'format' => 'dd/mm/yyyy',
                'required' => true,
            ])
            ->add('dateEnd', DateType::class, [
                'attr' => array('class' => 'calendar', 'min' => date('Y-m-d')),
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('userRole', TextType::class, [
                'required' => false,
            ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'P6\GeneralBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'p6_generalbundle_advert';
    }


}
