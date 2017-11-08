<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\CommandLine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Commands;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
       
       $product = $em->getRepository('AppBundle:Product')->find($id);
       
       $user = $this->get('security.token_storage')->getToken()->getUser();//get user
       
       //$customer findByUser
       $customer = $em->getRepository('AppBundle:Customer')->findOneByUser($user);
       
       
       $commands = new Commands(); //objet Command
       $commands->setNumbercommand(md5(uniqid()));
       $commands->setDatecommand(new \DateTime('now'));
       $commands->setCart(true);
       //command set customer
       $commands->setCustomer($customer);
       
       $commandline = new CommandLine();
       $commands->addCommandLine($commandline);
       
       $commandline->setProduct($product); 
       //commandLine set commands
       $commandline->setCommands($commands);
       // commandLine set quantity
       // commandLine set price  = product get price
       $commandline->setQuantity(1);
       $commandline->setPrice($product->getPrice());
       
       $em->persist($commandline);
       $em->persist($commands);
       $em->flush();
       
       return $this->redirectToRoute('command');
       
       return $this->render('index.html.twig', array(
           'products' => $product,
         
       ));
       
    }
    
    /**
     * 
     * @Route("/rack/", name="command")
     * @Method("GET")
     */
    
    public function commandsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $customer = $em->getRepository('AppBundle:Customer')->findOneByUser($user);
        
        $command = $em->getRepository('AppBundle:Commands')->findOneByCustomer($customer);
        
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        
        return $this->render('rack.html.twig', array(
            'categories' => $categories,
            'command' => $command,
        ));
    }
    
    /**
     * 
     * @Route("/valid/", name="customs")
     */
    public function validcustomerAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();
       $user = $this->get('security.token_storage')->getToken()->getUser();
       $customer = $em->getRepository('AppBundle:Customer')->findOneByUser($user);
       
      $categories = $em->getRepository('AppBundle:Category')->findAll();
       
       $form = $this->createFormBuilder($customer)
              ->add('name', TextType::class)
              ->add('adress', TextType::class)
              ->add('town', TextType::class)
              ->add('zipcode', TextType::class)
              ->add('save', SubmitType::class, array('label' => 'Send'))
              ->getForm();
       
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) {
           // persist and flush custumer
           $em->persist($customer);
           $em->flush();
           return $this->redirectToRoute('command_success');
       }
      return $this->render('validcommand.html.twig', array(
           'form' => $form->createView(),
           'categories' => $categories,
       ));
    }
    
    /**
     * 
     * @Route("/command/", name="command_success")
     * 
     */
    public function validcommandcustomAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
      
      return $this->render('successcommand.html.twig', array(
          //'form' => $form->createView(),
          'categories' => $categories,
          
      ));
    }
    
    /**
     * 
     * @Route("/product/{id}", name="show_product")
     * 
     */
    public function displayproductAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       $categories = $em->getRepository('AppBundle:Category')->findAll();
       $product = $em->getRepository('AppBundle:Product')->find($id);
       
       return $this->render('displayproduct.html.twig', array(
           'product' => $product,
           'categories' => $categories,
       ));
       
    }
 
    
}
