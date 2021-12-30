<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\component\Form\Extension\Core\Type\TextType;
use Symfony\component\Form\Extension\Core\Type\SubmitType;
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation', TextType::class, ['label'=>'Designation:' , 'required'=>True])
            ->add('Description', TextType::class, ['label'=> 'Description:' , 'required'=>True])
            ->add('prix', TextType::class, ['label'=>'prix:' , 'required'=>True])
            ->add('Valider', SubmitType::class, ['label' => 'valider'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
