<?php

declare(strict_types=1);

namespace Micro\Service;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

/**
 * Class Kernel.
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function getCacheDir()
    {
        return CACHE_PATH . $this->environment;
    }

    public function getLogDir()
    {
        return LOG_PATH;
    }

    public function registerBundles()
    {
        $contents = require CONFIG_PATH . 'bundles.php';

        foreach ($contents as $class => $envs) {
            if (isset($envs['all']) || isset($envs[$this->environment])) {
                yield new $class();
            }
        }
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);

        $loader->load(CONFIG_PATH . 'parameters' . self::CONFIG_EXTS, 'glob');
        $loader->load(CONFIG_PATH . 'packages/*' . self::CONFIG_EXTS, 'glob');

        if (\is_dir(CONFIG_PATH . 'packages/' . $this->environment)) {
            $loader->load(CONFIG_PATH . 'packages/' . $this->environment . '/**/*' . self::CONFIG_EXTS, 'glob');
        }

        $loader->load(CONFIG_PATH . 'services' . self::CONFIG_EXTS, 'glob');
        $loader->load(CONFIG_PATH . 'services_' . $this->environment . self::CONFIG_EXTS, 'glob');

        $loader->load(CONFIG_PATH . 'services/*' . self::CONFIG_EXTS, 'glob');
    }

    /**
     * @throws \Symfony\Component\Config\Exception\FileLoaderLoadException
     */
    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        if (\is_dir(CONFIG_PATH . '/routes/')) {
            $routes->import(CONFIG_PATH . '/routes/*' . self::CONFIG_EXTS, '/', 'glob');
        }

        if (\is_dir(CONFIG_PATH . '/routes/' . $this->environment)) {
            $routes->import(CONFIG_PATH . '/routes/' . $this->environment . '/**/*' . self::CONFIG_EXTS, '/', 'glob');
        }

        $routes->import(CONFIG_PATH . '/routes' . self::CONFIG_EXTS, '/', 'glob');
    }
}
