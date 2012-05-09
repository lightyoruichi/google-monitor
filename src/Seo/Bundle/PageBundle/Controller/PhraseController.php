<?php

namespace Seo\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Seo\Bundle\PageBundle\Entity\Phrase;
use Seo\Bundle\PageBundle\Form\PhraseType;

/**
 * Phrase controller.
 *
 * @Route("/phrase")
 */
class PhraseController extends Controller
{
    /**
     * Finds and displays a Phrase entity.
     *
     * @Route("/{id}/show", name="phrase_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SeoPageBundle:Phrase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phrase entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new Phrase entity.
     *
     * @Route("/new", name="phrase_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Phrase();
        $form = $this->createForm(new PhraseType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Phrase entity.
     *
     * @Route("/create", name="phrase_create")
     * @Method("post")
     * @Template("SeoPageBundle:Phrase:new.html.twig")
     */
    public function createAction()
    {
        $entity = new Phrase();
        $request = $this->getRequest();
        $form = $this->createForm(new PhraseType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('phrase_show', array('id' => $entity->getId())));

        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Deletes a Phrase entity.
     *
     * @Route("/{id}/delete", name="phrase_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SeoPageBundle:Phrase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phrase entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('phrase'));
    }
}
