<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Likes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Like controller.
 *
 * @Route("likes")
 */
class LikesController extends Controller
{
    /**
     * Lists all like entities.
     *
     * @Route("/", name="likes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $likes = $em->getRepository('AppBundle:Likes')->findAll();

        return $this->render('likes/index.html.twig', array(
            'likes' => $likes,
        ));
    }

    /**
     * Creates a new like entity.
     *
     * @Route("/new", name="likes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $like = new Like();
        $form = $this->createForm('AppBundle\Form\LikesType', $like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush();

            return $this->redirectToRoute('likes_show', array('id' => $like->getId()));
        }

        return $this->render('likes/new.html.twig', array(
            'like' => $like,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a like entity.
     *
     * @Route("/{id}", name="likes_show")
     * @Method("GET")
     */
    public function showAction(Likes $like)
    {
        $deleteForm = $this->createDeleteForm($like);

        return $this->render('likes/show.html.twig', array(
            'like' => $like,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing like entity.
     *
     * @Route("/{id}/edit", name="likes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Likes $like)
    {
        $deleteForm = $this->createDeleteForm($like);
        $editForm = $this->createForm('AppBundle\Form\LikesType', $like);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('likes_edit', array('id' => $like->getId()));
        }

        return $this->render('likes/edit.html.twig', array(
            'like' => $like,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a like entity.
     *
     * @Route("/{id}", name="likes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Likes $like)
    {
        $form = $this->createDeleteForm($like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($like);
            $em->flush();
        }

        return $this->redirectToRoute('likes_index');
    }

    /**
     * Creates a form to delete a like entity.
     *
     * @param Likes $like The like entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Likes $like)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('likes_delete', array('id' => $like->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
