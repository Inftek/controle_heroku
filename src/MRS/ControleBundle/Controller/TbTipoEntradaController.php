<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MRS\ControleBundle\Entity\TbTipoEntrada;
use MRS\ControleBundle\Form\TbTipoEntradaType;

/**
 * TbTipoEntrada controller.
 *
 * @Route("/tipoentrada")
 */
class TbTipoEntradaController extends Controller
{

    /**
     * Lists all TbTipoEntrada entities.
     *
     * @Route("/", name="tipoentrada")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MRSControleBundle:TbTipoEntrada')
                       ->findBy(array('user'=>$this->getUser()->getId()));

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TbTipoEntrada entity.
     *
     * @Route("/", name="tipoentrada_create")
     * @Method("POST")
     * @Template("MRSControleBundle:TbTipoEntrada:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TbTipoEntrada();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoentrada_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TbTipoEntrada entity.
     *
     * @param TbTipoEntrada $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbTipoEntrada $entity)
    {
        $form = $this->createForm(new TbTipoEntradaType(), $entity, array(
            'action' => $this->generateUrl('tipoentrada_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbTipoEntrada entity.
     *
     * @Route("/new", name="tipoentrada_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TbTipoEntrada();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TbTipoEntrada entity.
     *
     * @Route("/{id}", name="tipoentrada_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbTipoEntrada')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbTipoEntrada entity.');
        }

        $this->get('security.user')->securityUser($entity);

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TbTipoEntrada entity.
     *
     * @Route("/{id}/edit", name="tipoentrada_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbTipoEntrada')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbTipoEntrada entity.');
        }

        $this->get('security.user')->securityUser($entity);

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TbTipoEntrada entity.
    *
    * @param TbTipoEntrada $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbTipoEntrada $entity)
    {
        $form = $this->createForm(new TbTipoEntradaType(), $entity, array(
            'action' => $this->generateUrl('tipoentrada_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbTipoEntrada entity.
     *
     * @Route("/{id}", name="tipoentrada_update")
     * @Method("PUT")
     * @Template("MRSControleBundle:TbTipoEntrada:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbTipoEntrada')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbTipoEntrada entity.');
        }

        $this->get('security.user')->securityUser($entity);

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipoentrada_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TbTipoEntrada entity.
     *
     * @Route("/{id}", name="tipoentrada_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MRSControleBundle:TbTipoEntrada')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbTipoEntrada entity.');
            }

            $this->get('security.user')->securityUser($entity);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipoentrada'));
    }

    /**
     * Creates a form to delete a TbTipoEntrada entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoentrada_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
