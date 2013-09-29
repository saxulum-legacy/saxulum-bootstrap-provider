<?php

namespace Saxulum\SaxulumBootstrapProvider\Form\Extension;

use Bc\Bundle\BootstrapBundle\Form\Type\BootstrapCollectionType;
use Symfony\Component\Form\AbstractExtension;

class BootstrapExtension extends AbstractExtension
{
    protected function loadTypes()
    {
        return array(
            new BootstrapCollectionType()
        );
    }
}
