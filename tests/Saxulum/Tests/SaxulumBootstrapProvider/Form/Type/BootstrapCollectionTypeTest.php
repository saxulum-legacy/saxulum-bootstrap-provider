<?php

namespace Saxulum\Tests\SaxulumBootstrapProvider\Form\Type;

use \Mockery as m;

use Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType;

/**
 * BootstrapCollectionTypeTest
 *
 * @group unit
 */
class BootstrapCollectionTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var BootstrapCollectionType */
    private $type;

    public function setUp()
    {
        $this->type = new BootstrapCollectionType();
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType::buildView()
     */
    public function testBuildView()
    {
        $view = m::mock('Symfony\Component\Form\FormView');

        $prototype = m::mock('Symfony\Component\Form\FormInterface');
        $prototype->shouldReceive('createView')->with($view);

        $config = m::mock('Symfony\Component\Form\FormConfigInterface');
        $config->shouldReceive('hasAttribute')->andReturn(true);
        $config->shouldReceive('getAttribute')->andReturn($prototype);

        $form = m::mock('Symfony\Component\Form\FormInterface');
        $form->shouldReceive('getConfig')->andReturn($config);

        $this->type->buildView($view, $form, array(
            'allow_add'             => true,
            'allow_delete'          => false,
            'add_button_text'       => 'Add',
            'delete_button_text'    => 'Delete',
            'sub_widget_col'        => 2,
            'button_col'            => 2,
            'prototype_name'        => '___name___'
        ));
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType::configureOptions()
     */
    public function testconfigureOptions()
    {
        $resolver = m::mock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->shouldReceive('setDefaults');
        $resolver->shouldReceive('setNormalizer');

        $this->type->configureOptions($resolver);
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType::getParent()
     */
    public function testGetParent()
    {
        $this->assertEquals('collection', $this->type->getParent());
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('bootstrap_collection', $this->type->getName());
    }
}
