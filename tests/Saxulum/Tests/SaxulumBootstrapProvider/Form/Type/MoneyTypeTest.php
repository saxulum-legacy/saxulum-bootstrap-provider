<?php

namespace Saxulum\Tests\SaxulumBootstrapProvider\Form\Type;

use \Mockery as m;
use Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType;

/**
 * MoneyTypeTest
 *
 * @group unit
 */
class MoneyTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var MoneyType */
    private $type;

    public function setUp()
    {
        $this->type = new MoneyType();
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::buildView()
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::getPattern()
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::parsePatternMatches()
     */
    public function testBuildViewLeftSide()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $form = m::mock('Symfony\Component\Form\FormInterface');

        $this->type->buildView($view, $form, array('currency' => 'EUR'));
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::buildView()
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::getPattern()
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::parsePatternMatches()
     */
    public function testBuildViewRightSide()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $form = m::mock('Symfony\Component\Form\FormInterface');

        $default = \Locale::getDefault();
        \Locale::setDefault('fr-CA');
        $this->type->buildView($view, $form, array('currency' => 'EUR'));
        \Locale::setDefault($default);
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::buildView()
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::getPattern()
     */
    public function testGetPatternEmpty()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $form = m::mock('Symfony\Component\Form\FormInterface');

        $this->type->buildView($view, $form, array('currency' => null));
    }

    /**
     * @covers Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('money', $this->type->getName());
    }
}
