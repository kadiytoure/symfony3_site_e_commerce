<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commands;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Command controller.
 *
 * @Route("commands")
 */
class CommandsController extends Controller
{
    /**
     * Lists all command entities.
     *
     * @Route("/command", name="commands_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commands = $em->getRepository('AppBundle:Commands')->findAll();

        return $this->render('commands/index.html.twig', array(
            'commands' => $commands,
        ));
    }

    /**
     * Creates a new command entity.
     *
     * @Route("/new", name="commands_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $command = new Command();
        $form = $this->createForm('AppBundle\Form\CommandsType', $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($command);
            $em->flush();

            return $this->redirectToRoute('commands_show', array('id' => $command->getId()));
        }

        return $this->render('commands/new.html.twig', array(
            'command' => $command,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a command entity.
     *
     * @Route("/showcommand/{id}", name="commands_show")
     * @Method("GET")
     */
    public function showAction(Commands $command)
    {
        $deleteForm = $this->createDeleteForm($command);

        return $this->render('commands/show.html.twig', array(
            'command' => $command,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing command entity.
     *
     * @Route("/editcommand/{id}/edit", name="commands_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commands $command)
    {
        $deleteForm = $this->createDeleteForm($command);
        $editForm = $this->createForm('AppBundle\Form\CommandsType', $command);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commands_edit', array('id' => $command->getId()));
        }

        return $this->render('commands/edit.html.twig', array(
            'command' => $command,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a command entity.
     *
     * @Route("/deletecommand/{id}", name="commands_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commands $command)
    {
        $form = $this->createDeleteForm($command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($command);
            $em->flush();
        }

        return $this->redirectToRoute('commands_index');
    }

    /**
     * Creates a form to delete a command entity.
     *
     * @param Commands $command The command entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commands $command)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commands_delete', array('id' => $command->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
