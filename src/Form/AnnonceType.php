<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends AbstractType
{
/**
 * Permet d'avoir la configuration 
 * @param string $label
 * @param string $placeholder
 * @param array $options
 */

private function getConfiguration($label,$placeholder,$options= []){
 
    return array_merge([
        'label'=>$label,
        'attr' => [
            'placeholder'=>$placeholder
        ]
        
        ],$options);
}

    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add('title', TextType::class , $this->getConfiguration("Titre", "Tapez un titre" ))
            ->add('slug',
             TextType::class,
              $this->getConfiguration("URL", "URL auto",[
                'required' => false
              ])
            
                )
            ->add('introduction',TextType::class,$this->getConfiguration("Introduction", "Donnez une description" ) )
            ->add('content',TextareaType::class,$this->getConfiguration("Description", "Tapez une description" ))
            ->add('coverImage', UrlType::class,$this->getConfiguration("URL de l'image", "Donnez l'@ d'une image" ))
            ->add('price', MoneyType::class ,$this->getConfiguration("Prix Par nuit", "Indiquez le prix " )) 
            ->add('rooms',IntegerType::class,$this->getConfiguration("Nbr de chambre", "Nbr de chambres disponibles" ))
            ->add('images',CollectionType::class,[
                'entry_type'=> ImageType::class,
                'allow_add'=>true,
                'allow_delete'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
