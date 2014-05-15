<?php

namespace Saxulum\SaxulumBootstrapProvider\Form\Extension;

use Saxulum\SaxulumBootstrapProvider\Form\Type\BootstrapCollectionType;
use Saxulum\SaxulumBootstrapProvider\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractExtension;

class BootstrapExtension extends AbstractExtension
{
    protected function loadTypes()
    {
        return array(
            new BootstrapCollectionType(),
            new MoneyType()
        );
    }
}
