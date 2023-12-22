<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Promotion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstName', TextType::class, ['label' => 'Prénom',])
            ->add('lastName', TextType::class, ['label' => 'Nom',])
            ->add('idDiscord', TextType::class, ['label' => 'Identifiant du compte Discord',])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Le fichier doit être une image de 5Mo maximum.',
                    ])
                ],
            ]);

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $builder
                ->add('roles', ChoiceType::class, [
                    'multiple' => true,
                    'expanded' => true,
                    'choices'  => [
                        'Utilisateur' => 'ROLE_USER',
                        'Administrateur' => 'ROLE_ADMIN',
                    ],
                ])
                ->add('promotion', EntityType::class, [
                    'label' => 'Promotion',
                    'class' => Promotion::class,
                    'choice_label' => 'promotion',
                    'multiple' => false,
                    'expanded' => true,
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
