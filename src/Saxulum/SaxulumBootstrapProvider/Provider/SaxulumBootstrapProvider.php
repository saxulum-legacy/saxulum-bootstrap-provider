<?php

namespace Saxulum\SaxulumBootstrapProvider\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\BootstrapExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\ButtonTypeExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\InputGroupButtonExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\StaticControlExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\TypeSetterExtension;
use Saxulum\SaxulumBootstrapProvider\Session\FlashMessage;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapBadgeExtension;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapFormExtension;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapIconExtension;
use Saxulum\SaxulumBootstrapProvider\Twig\BootstrapLabelExtension;

class SaxulumBootstrapProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['bootstrap.template_dir'] = __DIR__ . '/../Resources/views';
        $container['bootstrap.icon_prefix'] = 'glyphicon';
        $container['bootstrap.icon_tag'] = 'span';

        $container['bootstrap.flash'] = function () use ($container) {
            return new FlashMessage($container['session']);
        };

        $container['form.type.extensions'] = $container->extend('form.type.extensions', function ($extensions) use ($container) {
            $extensions[] = new ButtonTypeExtension();
            $extensions[] = new InputGroupButtonExtension();
            $extensions[] = new StaticControlExtension();
            $extensions[] = new TypeSetterExtension();

            return $extensions;
        });

        $container['form.extensions'] = $container->extend('form.extensions', function ($extensions) use ($container) {
            $extensions[] = new BootstrapExtension();

            return $extensions;
        });

        $container['twig'] = $container->extend('twig', function (\Twig_Environment $twig) use ($container) {
            $twig->addExtension(new BootstrapIconExtension(
                $container['bootstrap.icon_prefix'],
                $container['bootstrap.icon_tag'])
            );
            $twig->addExtension(new BootstrapLabelExtension());
            $twig->addExtension(new BootstrapBadgeExtension());
            $twig->addExtension(new BootstrapFormExtension());

            return $twig;
        });

        $container['twig.loader.filesystem'] = $container->extend('twig.loader.filesystem',
            function (\Twig_Loader_Filesystem $twigLoaderFilesystem) use ($container) {
                $twigLoaderFilesystem->addPath($container['bootstrap.template_dir'], 'SaxulumBootstrapProvider');

                return $twigLoaderFilesystem;
            }
        );
    }
}
