<?php

namespace Saxulum\SaxulumBootstrapProvider;

use Bc\Bundle\BootstrapBundle\Form\Extension\TypeSetterExtension;
use Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension;
use Bc\Bundle\BootstrapBundle\Twig\BootstrapIconExtension;
use Bc\Bundle\BootstrapBundle\Twig\BootstrapLabelExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\BootstrapExtension;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SaxulumBootstrapProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['bootstrap.template_dir'] = __DIR__ . '/../../../../../braincrafted/bootstrap-bundle/Bc/Bundle/BootstrapBundle/Resources/views';

        $app['form.type.extensions'] = $app->share($app->extend('form.type.extensions', function ($extensions) use ($app) {
            $extensions[] = new TypeSetterExtension();

            return $extensions;
        }));

        $app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
            $extensions[] = new BootstrapExtension();

            return $extensions;
        }));

        $app['twig'] = $app->share($app->extend('twig', function (\Twig_Environment $twig) {
            $twig->addExtension(new BootstrapBadgeExtension());
            $twig->addExtension(new BootstrapIconExtension());
            $twig->addExtension(new BootstrapLabelExtension());

            return $twig;
        }));

        $this->addTemplates($app);
    }

    /**
     * @param Application $app
     */
    protected function addTemplates(Application $app)
    {
        $app['twig.loader.filesystem'] = $app->share($app->extend('twig.loader.filesystem',
            function (\Twig_Loader_Filesystem $twigLoaderFilesystem) use ($app) {
                $twigLoaderFilesystem->addPath($app['bootstrap.template_dir'], 'BraincraftedBootstrapBundle');

                return $twigLoaderFilesystem;
            }
        ));
    }

    public function boot(Application $app) {}
}
