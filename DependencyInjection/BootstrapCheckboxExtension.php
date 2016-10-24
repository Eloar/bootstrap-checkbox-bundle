<?php

/*
 * This file is part of the BootstrapCheckboxBundle.
 *
 * (c) Janusz Paszyński <https://github.com/Eloar>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ITChaos\Bundle\BootstrapCheckboxBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class BootstrapCheckboxExtension extends Extension implements PrependExtensionInterface
{
    /** @var string */
    private $formTemplate = 'BootstrapCheckboxBundle:Form:bootstrap_checkbox.html.twig';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('form.xml');
    }


    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (true === isset($bundles['TwigBundle'])) {
            foreach (array_keys($container->getExtensions()) as $name) {
                switch ($name) {
                    case 'twig':
                        $container->prependExtensionConfig(
                            $name,
                            array('form_themes'  => array($this->formTemplate))
                        );
                        break;
                }
            }
        }
    }
}
