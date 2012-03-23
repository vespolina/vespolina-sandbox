<?php
namespace Application\Vespolina\CartBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationVespolinaCartBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'VespolinaCartBundle';
    }
}