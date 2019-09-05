<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use App\Service\UploaderHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

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

	private static $images = [
		'cheese-3373604_640.jpg',
		'cheese-2205913_640.jpg',
		'cheese-1972744_640.jpg',
		'cheese-1149471_640.jpg',
		'cheese-2785_640.jpg',
	];

	private $uploaderHelper;

	public function __construct(UploaderHelper $uploaderHelper)
	{

		$this->uploaderHelper = $uploaderHelper;
	}

	protected function loadData(ObjectManager $manager)
    {
		$this->createMany(Article::class, 15, function (Article $article, $count){

			$imageFilename = $this->fakeUploadImage();

			$article
				->setAuthor($this->getRandomReference(User::class))
				->setContent($this->faker->realText(500))
				->setTitle($this->faker->randomElement(self::$title))
				->setImageFilename($imageFilename)
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

	private function fakeUploadImage(): string
	{
		$randomImage = $this->faker->randomElement(self::$images);

		$fs = new Filesystem();
		$targetPath = sys_get_temp_dir().'/'.$randomImage;
		$fs->copy(__DIR__.'/Resources/images/'.$randomImage, $targetPath, true);

		return $imageFilename = $this->uploaderHelper
			->uploadArticleImage(new File($targetPath));

	}
}
