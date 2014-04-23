<?php
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle;
use Jobeet\JobeetBundle\JobeetJobeetBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle;

class AppKernel extends Kernel
{
	public function registerBundles()
	{
		$bundles = [
            new FrameworkBundle(),
            new DoctrineBundle(),
            new DoctrineFixturesBundle(),
            new StofDoctrineExtensionsBundle(),
            new TwigBundle(),
            new JobeetJobeetBundle(),
		];

		if (in_array($this->getEnvironment(), array('dev', 'test'))) {
		    $bundles[] = new SensioGeneratorBundle();
		}

		return $bundles;
	}

	public function registerContainerconfiguration(LoaderInterface $loader)
	{
	    $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
	}
}