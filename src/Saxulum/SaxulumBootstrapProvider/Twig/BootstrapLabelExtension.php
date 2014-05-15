<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Saxulum\SaxulumBootstrapProvider\Twig;

use Twig_Extension;
use Twig_SimpleFilter;

/**
 * BootstrapLabelExtension
 *
 * @category TwigExtension
 * @package BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2012-2013 Florian Eckerstorfer
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BootstrapLabelExtension extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));

        return array(
            new Twig_SimpleFilter('label', array($this, 'labelFunction'), $options),
            new Twig_SimpleFilter('label_primary', array($this, 'labelPrimaryFunction'), $options),
            new Twig_SimpleFilter('label_success', array($this, 'labelSuccessFunction'), $options),
            new Twig_SimpleFilter('label_info', array($this, 'labelInfoFunction'), $options),
            new Twig_SimpleFilter('label_warning', array($this, 'labelWarningFunction'), $options),
            new Twig_SimpleFilter('label_danger', array($this, 'labelDangerFunction'), $options),
        );
    }

    /**
     * Returns the HTML code for a label.
     *
     * @param string $text The text of the label
     * @param string $type The type of label
     *
     * @return string The HTML code of the label
     */
    public function labelFunction($text, $type = 'default')
    {
        return sprintf('<span class="label%s">%s</span>', ($type ? ' label-' . $type : ''), $text);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function labelPrimaryFunction($text)
    {
        return $this->labelFunction($text, 'primary');
    }

    /**
     * Returns the HTML code for a success label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelSuccessFunction($text)
    {
        return $this->labelFunction($text, 'success');
    }

    /**
     * Returns the HTML code for a warning label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelWarningFunction($text)
    {
        return $this->labelFunction($text, 'warning');
    }

    /**
     * Returns the HTML code for a important label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelDangerFunction($text)
    {
        return $this->labelFunction($text, 'danger');
    }

    /**
     * Returns the HTML code for a info label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelInfoFunction($text)
    {
        return $this->labelFunction($text, 'info');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'braincrafted_bootstrap_label';
    }
}
