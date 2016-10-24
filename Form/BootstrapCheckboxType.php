<?php

/*
 * This file is part of the BootstrapCheckboxBundle.
 *
 * (c) Janusz Paszyński <https://github.com/Eloar>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ITChaos\Bundle\BootstrapCheckboxBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Type for field using bootstrap-checkbox
 * @package ITChaos\Bundle\BootstrapCheckboxBundle\Form
 */
class BootstrapCheckboxType extends AbstractType
{
    /**
     * Mapping of type options to data attributes to set view->vars['attr'].
     * @var array
     */
    protected static $attrMapping = [
        'base-group-class'          => 'data-base-group-cls',
        'base-class'                => 'data-base-cls',
        'group-class'               => 'data-group-cls',
        'class'                     => 'data-cls',
        'off-class'                 => 'data-off-cls',
        'on-class'                  => 'data-on-cls',
        'off-active-class'          => 'data-off-active-cls',
        'on-active-class'           => 'data-on-active-cls',
        'off-label'                 => 'data-off-label',
        'on-label'                  => 'data-on-label',
        'disabled-cursor'           => 'data-disabled-cursor',
        'html'                      => 'data-html',
        'icon-class'                => 'data-icon-cls',
        'off-icon-class'            => 'data-off-icon-cls',
        'on-icon-class'             => 'data-on-icon-cls',
        'off-title'                 => 'data-off-title',
        'on-title'                  => 'data-on-title',
        'reverse'                   => 'data-reverse',
        'switch-always'             => 'data-switch-always',
        'toggle-key-codes'          => 'data-toggle-key-codes',
    ];

    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        // define parameters
        $resolver->setDefined([
            'base-group-class',
            'base-class',
            'group-class',
            'class',
            'off-class',
            'on-class',
            'off-active-class',
            'on-active-class',
            'off-label',
            'on-label',
            'disabled-cursor',
            'html',
            'icon-class',
            'off-icon-class',
            'on-icon-class',
            'off-title',
            'on-title',
            'reverse',
            'switch-always',
            'toggle-key-codes',
            'orientation'
        ]);
        // define types
        $resolver
            // string optional parameters
            ->setAllowedTypes('base-group-class', ['null', 'string'])
            ->setAllowedTypes('base-class', ['null', 'string'])
            ->setAllowedTypes('group-class', ['null', 'string'])
            ->setAllowedTypes('class', ['null', 'string'])
            ->setAllowedTypes('off-class', ['null', 'string'])
            ->setAllowedTypes('on-class', ['null', 'string'])
            ->setAllowedTypes('off-active-class', ['null', 'string'])
            ->setAllowedTypes('on-active-class', ['null', 'string'])
            ->setAllowedTypes('off-label', ['null', 'string'])
            ->setAllowedTypes('on-label', ['null', 'string'])
            ->setAllowedTypes('disabled-cursor', ['null', 'string'])
            ->setAllowedTypes('icon-class', ['null', 'string'])
            ->setAllowedTypes('off-icon-class', ['null', 'string'])
            ->setAllowedTypes('on-icon-class', ['null', 'string'])
            ->setAllowedTypes('off-title', ['null', 'string'])
            ->setAllowedTypes('on-title', ['null', 'string'])
            // boolean optional paremeters
            ->setAllowedTypes('html', ['null', 'boolean'])
            ->setAllowedTypes('reverse', ['null', 'boolean'])
            ->setAllowedTypes('switch-always', ['null', 'boolean'])
            // array optional parameters
            ->setAllowedTypes('toggle-key-codes', ['null', 'array'])
            ->setAllowedValues('orientation', ['left', 'right']);
        // set defaults
        $resolver->setDefault('orientation', 'left');
    }

    /** {@inheritdoc} */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $mappedOptions = array_filter($options, function($key) { return array_key_exists($key, static::$attrMapping); }, ARRAY_FILTER_USE_KEY);
        $attr = $view->vars['attr'];
        $attr = array_replace($attr, array_combine(array_map(function($v) { return static::$attrMapping[$v]; }, array_keys($mappedOptions)), array_values($mappedOptions)));
        $attr['data-provider'] = 'bootstrap-checkbox';
        $view->vars['attr'] = $attr;
        $view->vars['left'] = isset($options['orientation']) && $options['orientation'] == 'left';
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'bootstrap_checkbox';
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'checkbox';
    }
}
