<?php

namespace Saxulum\SaxulumBootstrapProvider\Provider;

use Saxulum\SaxulumBootstrapProvider\Form\Extension\BootstrapExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\TypeSetterExtension;
use Saxulum\SaxulumBootstrapProvider\Session\FlashMessage;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapBadgeExtension;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapFormExtension;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapIconExtension;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapLabelExtension;
use Silex\Application;

class SaxulumBootstrapProvider
{
    public function register(\Pimple $container)
    {
        $container['bootstrap.template_dir'] = __DIR__ . '/../Resources/views';

        $container['bootstrap.flash'] = $container->share(function () use ($container) {
            return new FlashMessage($container['session']);
        });

        $container['form.type.extensions'] = $container->share($container->extend('form.type.extensions', function ($extensions) use ($container) {
            $extensions[] = new TypeSetterExtension();

            return $extensions;
        }));

        $container['form.extensions'] = $container->share($container->extend('form.extensions', function ($extensions) use ($container) {
            $extensions[] = new BootstrapExtension();

            return $extensions;
        }));

        $container['twig'] = $container->share($container->extend('twig', function (\Twig_Environment $twig) {
            $twig->addExtension(new BootstrapBadgeExtension());
            $twig->addExtension(new BootstrapFormExtension());
            $twig->addExtension(new BootstrapIconExtension());
            $twig->addExtension(new BootstrapLabelExtension());

            return $twig;
        }));

        $this->addTemplates($container);
    }

    /**
     * @param Application $container
     */
    protected function addTemplates(Application $container)
    {
        $container['twig.loader.filesystem'] = $container->share($container->extend('twig.loader.filesystem',
            function (\Twig_Loader_Filesystem $twigLoaderFilesystem) use ($container) {
                $twigLoaderFilesystem->addPath($container['bootstrap.template_dir'], 'SaxulumBootstrapProvider');

                return $twigLoaderFilesystem;
            }
        ));
    }
}
