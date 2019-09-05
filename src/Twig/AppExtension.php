<?php


namespace App\Twig;


use App\service\UploaderHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public static function getSubscribedServices()
	{
		return [
			UploaderHelper::class,
		];
	}

	public function getFunctions()
	{
		return [
			new TwigFunction('uploaded_asset', [$this, 'getUploadedAssetPath'])
		];
	}

	public function getUploadedAssetPath(string $path)
	{
		return $this->container
			->get(UploaderHelper::class)
			->getPublicPath($path);
	}
}