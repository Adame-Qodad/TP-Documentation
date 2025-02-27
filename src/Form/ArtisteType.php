<?php

namespace App\Form;

use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Formulaire pour l'entité Artiste.
 *
 * Cette classe génère un formulaire permettant de saisir les informations relatives à un artiste.
 * Les champs suivants sont inclus :
 * - Nom (Champ texte)
 * - Description (Zone de texte)
 * - Site (URL)
 * - Image (Champ texte pour l'URL de l'image)
 * - Type (Choix entre 'solo' ou 'groupe')
 * 
 * @package App\Form
 */
class ArtisteType extends AbstractType
{
    /**
     * Configure les champs du formulaire.
     *
     * Ajoute des champs pour saisir les informations sur l'artiste.
     *
     * @param FormBuilderInterface $builder Le constructeur du formulaire.
     * @param array $options Les options du formulaire.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => "Nom de L'artiste",
                'attr' => [
                    "placeholder" => "Saisir le nom de L'artiste"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'artiste',
                'attr' => [
                    'placeholder' => 'Saisir une brève description de l\'artiste',
                    'rows' => 5
                ]
            ])
            ->add('site', UrlType::class, [
                'label' => 'Site Web',
                'attr' => [
                    'placeholder' => 'Saisir l\'URL du site web de l\'artiste'
                ]
            ])
            ->add('image', TextType::class, [
                'label' => 'URL de l\'image',
                'attr' => [
                    'placeholder' => 'Saisir l\'URL de l\'image de l\'artiste'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de l\'artiste',
                'choices' => [
                    'Solo' => 0,
                    'Groupe' => 1
                ],
                'expanded' => true,  // Affichage sous forme de boutons radio
                'multiple' => false
            ]);
    }

    /**
     * Configure les options du formulaire.
     *
     * Définit la classe de données à utiliser pour ce formulaire (ici, l'entité Artiste).
     *
     * @param OptionsResolver $resolver Le résolveur d'options.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
