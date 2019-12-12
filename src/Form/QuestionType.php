<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use App\Entity\Reponse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		// Récupère les paramètres passés au formaulaire
		$idThematique = $options['idThematique'];
		$idNiveau = $options['idNiveau'];

		//dump($idNiveau);
		//die();

        $builder
            ->add('question', EntityType::class, [
				'class'=> Reponse::class,
				'group_by' => function(Reponse $reponse){
					return $reponse->getIdQuestion()->getLibelle();
				},
				'query_builder' => function(EntityRepository  $er) use ($idThematique, $idNiveau) {
					return $er->createQueryBuilder('rep')
						->select('rep', 'question')
						->join('rep.idQuestion', 'question')
						->where('question.idThematique = :idThematique')
						->andWhere('question.idNiveau = :idNiveau')
						->setParameter('idThematique', $idThematique)
						->setParameter('idNiveau', $idNiveau)
						->orderBy('rep.libelle', 'ASC');
				}
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
			// initialise les paramètre passés au formaulaire
			'idThematique'=>Null,
			'idNiveau'=>Null,
        ]);
    }
}
