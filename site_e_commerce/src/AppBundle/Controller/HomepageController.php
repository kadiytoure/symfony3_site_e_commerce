<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Homepage controller.
 *
 * @Route("homepage")
 */

class HomepageController extends Controller
{
     /**
     * Lists all category entities.
     *
     * @Route("/home", name = "home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:product')->findAll();
        
        return $this->render('product/layout.html.twig', array( 
            'products' => $product,
        ));
    }
}
