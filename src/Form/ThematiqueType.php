<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Thematique;
use App\Entity\Niveau;

class ThematiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('thematique', EntityType::class, [
				'placeholder' => 'Veuillez choisir une Thematique',
				'class'=> Thematique::class,
				'query_builder' => function(EntityRepository  $er) {
					return $er->createQueryBuilder('thematique')
						->orderBy('thematique.libelle', 'ASC');
				}
			])
			->add('niveau', EntityType::class,[
				'class'=> Niveau::class,
				'query_builder' => function(EntityRepository  $er) {
					return $er->createQueryBuilder('niveau')
						->orderBy('niveau.id', 'ASC');
				}
			])
			->add('commencer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
			
        ]);
    }
}
