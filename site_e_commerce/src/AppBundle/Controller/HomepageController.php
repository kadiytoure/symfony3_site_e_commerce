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
    
    /**
     * A propos
     *
     * @Route("/a-propos/", name = "front_apropos")
     * @Method("GET")
     */
    public function aproposAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        
        return $this->render('front/apropos.html.twig', array( 
            'categories' => $categories,
        ));
    }
    
    /**
     * 
     * @Route("/cat/{name}", name = "list_by_category")
     */
    public function categAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Category');
        
        $categories = $repo->findAll();
        
        $cat = $repo->findOneByName($name);
        
        return $this->render('rubriques/categ.html.twig', array(
            'categories' => $categories,
            'cat' => $cat
        ));
    }
    
    /**
     * 
     * @Route("/prods/{id}", name="action_add_rack")
     * @Method("GET")
     */
    
    public function productAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       $repo = $em->getRepository('AppBundle:Product');
       
       $product = $repo->find($id);
       
       $user = $this->get('security.token_storage')->getToken()->getUser();//get user
       $command = new Command(); //objet Command
       $command->setProduct($product);
       $command->setUser($user);
       $manager->persist($command);
       $manager->flush();
      
       return $this->render('index.html.twig', array(
           'products' => $product,
           //'cat' => $cat   
       ));
    }
    
    
}
