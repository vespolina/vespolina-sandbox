<?php
/**
* (c) 2011 Vespolina Project http://www.vespolina-project.org
*
* This source file is subject to the MIT license that is bundled
* with this source code in the file LICENSE.
*/

/**
* ProductBundle
*
* @author Joris de Wit <joris.w.dewit@gmail.com>
*/

namespace Vespolina\ProductBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Vespolina\ProductBundle\Model\Product;

class ProductController extends ContainerAware
{
    /**
     * Show all products
     */
    public function listAction()
    {
        $products = $this->container->get('vespolina_product.product_manager')->findProducts();

        return $this->container->get('templating')->renderResponse('VespolinaProductBundle:Product:list.html.'.$this->getEngine(), array('products' => $products));
    }

    /**
     * Show one product by sku
     */
    public function showAction($sku)
    {
        $product = $this->findProductBy('sku', $sku);
        return $this->container->get('templating')->renderResponse('VespolinaProductBundle:Product:show.html.'.$this->getEngine(), array('product' => $product));
    }

    /**
     * Edit one product, show the edit form
     */
    public function editAction($sku)
    {
        $product = $this->findProductBy('sku', $sku);
        $form = $this->container->get('vespolina_product.form.product');
        $form->setData($product);

        return $this->container->get('templating')->renderResponse('VespolinaProductBundle:Product:edit.html.'.$this->getEngine(), array(
            'form'      => $form,
            'sku'       => $product->getSKU()
        ));
    }

    /**
     * Update a product
     */
    public function updateAction($sku)
    {
        $product = $this->findProductBy('sku', $sku);
        $form = $this->container->get('vespolina_product.form.product');
        $form->bind($this->container->get('request'), $product);

        if ($form->isValid()) {
            $this->container->get('vespolina_product.product_manager')->updateProduct($product);
            $this->setFlash('vespolina_product_product_update', 'success');
            $productUrl = $this->generateUrl('vespolina_product_product_show', array('sku' => $product->getSKU()));
            return new RedirectResponse($productUrl);
        }

        return $this->container->get('templating')->renderResponse('VespolinaProductBundle:Product:edit.html.'.$this->getEngine(), array(
            'form'      => $form,
            'sku'       => $product->getSKU()
        ));
    }

    /**
     * Show the new form
     */
    public function newAction()
    {
        $product = $this->container->get('vespolina_product.product_manager')->createProduct();
        $form = $this->container->get('vespolina_product.form.product');
        $form->setData($product);

        return $this->container->get('templating')->renderResponse('VespolinaProductBundle:Product:new.html.'.$this->getEngine(), array(
            'form' => $form
        ));
    }

    /**
     * Create a product
     */
    public function createAction()
    {
        $manager = $this->container->get('vespolina_product.product_manager');
        $product = $manager->createProduct();
        $form = $this->container->get('vespolina_product.form.product');
        $form->setData($product);

        $request = $this->container->get('request');

        if ('POST' == $request->getMethod()) {
            $values = $request->request->get($form->getName(), array());
            $files = $request->files->get($form->getName(), array());

            $form->submit(array_replace_recursive($values, $files));

            $form->validate();
        }

        if ($form->isValid()) {
            $manager->updateProduct($product);
            $url = $this->generateUrl('vespolina_product_product_created');

            $this->setFlash('vespolina_product_product_create', 'success');
            return new RedirectResponse($url);
        }

        return $this->container->get('templating')->renderResponse('VespolinaProductBundle:Product:new.html.'.$this->getEngine(), array(
            'form' => $form
        ));
    }

}
