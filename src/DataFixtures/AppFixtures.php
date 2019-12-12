<?php

namespace App\DataFixtures;

use App\Entity\Persona;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Users;
use App\Entity\Thematique;
use App\Entity\Questions;
use App\Entity\Niveau;
use App\Entity\Reponse;

class AppFixtures extends Fixture
{   
	public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
		$user=new Users();
		$user->setUsername('nour');
		$password = $this->encoder->encodePassword($user, '1234');
		$user->setPassword($password);
        $manager->persist($user);

        //secondary user without persona
        $user2 = new Users();
        $user2->setUsername('user');
        $pass = $this->encoder->encodePassword($user2, '1234');
        $user2->setPassword($pass);
        $manager->persist($user2);


		//new persona
        $persona = new Persona();
        $persona->setName("Goku");
        $persona->setLevel(1);
        $persona->setSex(1); //man
        $persona->setAvatar("https://cdn2.iconfinder.com/data/icons/dragonball-z-flat/48/Cartoons__Anime_Dragonball_Artboard_1-512.png");
        $persona->setOwner($user);
        $manager->persist($persona);

		//thematique
		$thematique=new Thematique();
		$thematique->setLibelle("PHP");
		$manager->persist($thematique);
		
		//Niveau
		$niveau1=new Niveau();
		$niveau1->setLibelle("facile");
		$manager->persist($niveau1);

		$niveau2=new Niveau();
		$niveau2->setLibelle("moyen");
		$manager->persist($niveau2);

		//Question
		$question1=new Questions();
		$question1->setLibelle("Que signifie PHP");
		$question1->setIdThematique($thematique);
		$question1->setIdNiveau($niveau1);
		$manager->persist($question1);

		$question2=new Questions();
		$question2->setLibelle("Les fichiers PHP ont l extension ...");
		$question2->setIdThematique($thematique);
		$question2->setIdNiveau($niveau1);
		$manager->persist($question2);

		// Reponse
		$reponse1=new Reponse();
		$reponse1->setLibelle("Personal Home");
		$reponse1->setIdQuestion($question1);
		$reponse1->setEstCorrect(false);
		$manager->persist($reponse1);

		$reponse2=new Reponse();
		$reponse2->setLibelle("Personal Home Page");
		$reponse2->setIdQuestion($question1);
		$reponse2->setEstCorrect(true);
		$manager->persist($reponse2);

		$reponse3=new Reponse();
		$reponse3->setLibelle(".xml");
		$reponse3->setIdQuestion($question2);
		$reponse3->setEstCorrect(false);
		$manager->persist($reponse3);

		$reponse4=new Reponse();
		$reponse4->setLibelle(".php");
		$reponse4->setIdQuestion($question2);
		$reponse4->setEstCorrect(true);
		$manager->persist($reponse4);



        $manager->flush();
    }
}
