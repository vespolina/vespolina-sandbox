<?php

namespace Application\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DefaultBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        $products = $this->get('vespolina.product_manager')->findBy(array());

        return $this->render('DefaultBundle:Default:list.html.twig', array('products' => $products));
    }
}
