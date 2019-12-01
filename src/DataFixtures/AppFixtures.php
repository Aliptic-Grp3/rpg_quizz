<?php

namespace App\DataFixtures;

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
        $manager->flush();
    }
}
