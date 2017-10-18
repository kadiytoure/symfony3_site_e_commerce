<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Homepage controller.
 *
 */
class HomepageController extends Controller
{
     /**
     * Lists all category entities.
     *
     * @Route("/", name = "home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAll();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        
        return $this->render('index.html.twig', array( 
            'products' => $products,
            'categories' => $categories,
        ));
    }
}
