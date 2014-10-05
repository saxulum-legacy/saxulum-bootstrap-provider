<?php

namespace Saxulum\SaxulumBootstrapProvider\Form\Extension;

use Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType;
use Saxulum\SaxulumBootstrapProvider\Form\Type\FormActionsType;
use Saxulum\SaxulumBootstrapProvider\Form\Type\FormStaticControlType;
use Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractExtension;

class BootstrapExtension extends AbstractExtension
{
    protected function loadTypes()
    {
        return array(
            new BootstrapCollectionType(),
            new FormActionsType(),
            new FormStaticControlType(),
            new MoneyType()
        );
    }
}
