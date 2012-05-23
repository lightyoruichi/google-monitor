<?php

namespace Seo\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Seo\Bundle\PageBundle\Entity\Page;
use Seo\Bundle\PageBundle\Form\PageType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Page controller.
 *
 * @Route("/page")
 * @Secure(roles="ROLE_USER")
 */
class PageController extends Controller
{
    /**
     * Lists user pages
     *
     * @Route("/", name="pages")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.context')->getToken()->getUser();

        $entities = $em->getRepository('SeoPageBundle:Page')->findByUser($user->getId());

        return array('entities' => new \Doctrine\Common\Collections\ArrayCollection($entities));
    }

    /**
     * Finds and displays a Page entity.
     *
     * @Route("/{id}/show", name="page_show")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SeoPageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new Page entity.
     *
     * @Route("/new", name="page_new")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function newAction()
    {
        $entity = new Page();
        $phrase = new \Seo\Bundle\PageBundle\Entity\Phrase();
        $entity->addPhrase($phrase);
        $form = $this->createForm(new PageType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Page entity.
     *
     * @Route("/create", name="page_create")
     * @Method("post")
     * @Template("SeoPageBundle:Page:new.html.twig")
     * @Secure(roles="ROLE_USER")
     */
    public function createAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $entity = new Page();
        $entity->setUser($user);

        $request = $this->getRequest();
        $form = $this->createForm(new PageType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('page_show', array('id' => $entity->getId())));

        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     * @Route("/{id}/edit", name="page_edit")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SeoPageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createForm(new PageType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Page entity.
     *
     * @Route("/{id}/update", name="page_update")
     * @Method("post")
     * @Template("SeoPageBundle:Page:edit.html.twig")
     * @Secure(roles="ROLE_USER")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SeoPageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createForm(new PageType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('page_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Page entity.
     *
     * @Route("/{id}/delete", name="page_delete")
     * @Secure(roles="ROLE_USER")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SeoPageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('pages'));
    }
}
