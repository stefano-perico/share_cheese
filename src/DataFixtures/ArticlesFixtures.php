<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticlesFixtures extends BaseFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
		$this->createMany(Article::class, 10, function (Article $article, $count){

			$article
				->setAuthor($this->getRandomReference(User::class))
				->setContent($this->faker->realText(500))
				->setTitle($this->faker->title)
				->setImageFilename($this->faker->imageUrl(640, 480))
				;
		});


        $manager->flush();
    }


	/**
	 * This method must return an array of fixtures classes
	 * on which the implementing class depends on
	 *
	 * @return array
	 */
	public function getDependencies()
	{
		return [
			UserFixtures::class,
		];
	}
}
