<?php

namespace Saxulum\Tests\SaxulumBootstrapProvider\Form\Extension;

use \Mockery as m;

use Saxulum\SaxulumBootstrapProvider\Form\Extension\TypeSetterExtension;

/**
 * TypeSetterExtensionTest
 *
 * @group unit
 */
class TypeSetterExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var TypeSetterExtension */
    private $extension;

    public function setUp()
    {
        $this->extension = new TypeSetterExtension();
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Extension\TypeSetterExtension::buildView()
     */
    public function testBuildView()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $type = m::mock('Symfony\Component\Form\ResolvedFormTypeInterface');
        $type->shouldReceive('getName')->andReturn('type');
        $config = m::mock('Symfony\Component\Form\FormConfigInterface');
        $config->shouldReceive('getType')->andReturn($type);
        $form = m::mock('Symfony\Component\Form\FormInterface');
        $form->shouldReceive('getConfig')->andReturn($config);

        $this->extension->buildView($view, $form, array());
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Extension\TypeSetterExtension::getExtendedType()
     */
    public function testGetExtendedType()
    {
        $this->assertEquals('form', $this->extension->getExtendedType());
    }
}
