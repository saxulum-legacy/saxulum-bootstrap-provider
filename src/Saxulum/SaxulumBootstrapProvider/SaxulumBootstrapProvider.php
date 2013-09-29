<?php

namespace Saxulum\SaxulumBootstrapProvider;

use Bc\Bundle\BootstrapBundle\Form\Extension\TypeSetterExtension;
use Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension;
use Bc\Bundle\BootstrapBundle\Twig\BootstrapIconExtension;
use Bc\Bundle\BootstrapBundle\Twig\BootstrapLabelExtension;
use Saxulum\SaxulumBootstrapProvider\Form\Extension\BootstrapExtension;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Finder\Finder;

class SaxulumBootstrapProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['form.type.extensions'] = $app->share($app->extend('form.type.extensions', function ($extensions) use ($app) {
            $extensions[] = new TypeSetterExtension();

            return $extensions;
        }));

        $app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
            $extensions[] = new BootstrapExtension();

            return $extensions;
        }));

        $app['twig'] = $app->share($app->extend('twig', function(\Twig_Environment $twig) {
            $twig->addExtension(new BootstrapBadgeExtension());
            $twig->addExtension(new BootstrapIconExtension());
            $twig->addExtension(new BootstrapLabelExtension());

            return $twig;
        }));

        $this->addBraincraftedBootstrapBundleTwigTemplates($app);
    }

    protected function addBraincraftedBootstrapBundleTwigTemplates(Application $app)
    {
        $vendorPath = '/vendor/braincrafted/bootstrap-bundle/Bc/Bundle/BootstrapBundle';
        $twigNamespace = 'BraincraftedBootstrapBundle';

        $app['saxulum.twig.templates'] = $app->share($app->extend('saxulum.twig.templates', function (array $templates) use ($app, $vendorPath) {

            $path = $app['root_dir']. $vendorPath;
            $twigNamespace = 'BraincraftedBootstrapBundle';
            $cacheDir = $app['cache_dir'] . '/saxulum.bootstrap';
            if (!is_dir($cacheDir)) {
                mkdir($cacheDir, 0777, true);
            }
            $twigMapDump= $cacheDir . '/braincrafted-bootstrap.twig.map.php';
            if ($app['debug'] || !is_file($twigMapDump)) {
                $twigMap = array();
                if (is_dir($path . '/Resources/views')) {
                    foreach (Finder::create()->files()->name('*.twig')->in($path . '/Resources/views') as $file) {
                        /** @var \SplFileInfo $file */
                        $twigMap[] = '@' . $twigNamespace . str_replace($path . '/Resources/views', '', $file->getPathname());
                    }
                }
                file_put_contents($twigMapDump, '<?php return ' . var_export($twigMap, true) . ';');
            }
            $twigMap = require($twigMapDump);

            foreach ($twigMap as $template) {
                $templates[] = $template;
            }

            return $templates;
        }));

        $app['twig.loader.filesystem'] = $app->share($app->extend('twig.loader.filesystem',
            function(\Twig_Loader_Filesystem $twigLoaderFilesystem) use ($app, $vendorPath, $twigNamespace) {
                $twigLoaderFilesystem->addPath($app['root_dir'] . $vendorPath. '/Resources/views', $twigNamespace);

                return $twigLoaderFilesystem;
            }
        ));
    }

    public function boot(Application $app) {}
}
