<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticlesFixtures extends BaseFixtures implements DependentFixtureInterface
{
	private static $title = [
		'Les Français et le fromage, une grande histoire d\'amour !',
		'Les Français, toujours amoureux du fromage',
		'Les fromages préférés des Français',
		'Retrait de produits à base de lait de brebis',
		'Les leaders laitiers français investissent en masse à l\'étranger',
		'Les exportations françaises ont progressé de 128 % en 30 ans',
		'Verrines apéritives au chèvre frais',
		'Rillettes de thon au fromage frais et citron vert',
		'Pommes de terre farcies au bleu',
		'Pomme de terre farcie au jambon de Parme',
		'Gratin de courgettes au fromage bleu',

		];

    protected function loadData(ObjectManager $manager)
    {
		$this->createMany(Article::class, 15, function (Article $article, $count){

			$article
				->setAuthor($this->getRandomReference(User::class))
				->setContent($this->faker->realText(500))
				->setTitle($this->faker->randomElement(self::$title))
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
