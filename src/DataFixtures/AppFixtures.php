<?php

namespace App\DataFixtures;

use App\Entity\Persona;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Users;

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


        $manager->flush();
    }
}
