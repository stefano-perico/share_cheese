<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures
{
	private $userPasswordEncoder;

	public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
	{
		$this->userPasswordEncoder = $userPasswordEncoder;
	}

    public function loadData(ObjectManager $manager)
    {

	    $this->createMany(User::class, 10, function (User $user, $coubinnt)
	    {
		    $user
			    ->setEmail("user$coubinnt@mail.com")
			    ->setPassword($this->userPasswordEncoder->encodePassword($user, "User"))
			    ->setPhone($this->faker->phoneNumber)
			    ->setCity($this->faker->city)
			    ->setAddress($this->faker->address)
			    ->setFirstName($this->faker->firstName)
			    ->setLastName($this->faker->lastName)
		    ;

	    });

	    $userAdmin = new User();
	    $userAdmin
		    ->setEmail("admin@mail.com")
		    ->setPassword($this->userPasswordEncoder->encodePassword($userAdmin, "Admin"))
		    ->setRoles(['ROLE_ADMIN'])
		    ->setPhone($this->faker->phoneNumber)
		    ->setCity($this->faker->city)
		    ->setAddress($this->faker->address)
		    ->setFirstName($this->faker->firstName)
		    ->setLastName($this->faker->lastName)
	    ;

	    $manager->persist($userAdmin);

	    $manager->flush();
    }
}
