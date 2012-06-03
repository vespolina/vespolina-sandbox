<?php
namespace Application\Vespolina\OrderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationVespolinaOrderBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'VespolinaOrderBundle';
    }
}