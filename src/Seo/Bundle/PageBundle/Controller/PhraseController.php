<?php

namespace Seo\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Seo\Bundle\PageBundle\Entity\Phrase;
use Seo\Bundle\PageBundle\Form\PhraseType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Phrase controller.
 *
 * @Route("")
 */
class PhraseController extends Controller
{
    /**
     * Finds and displays a Phrase entity.
     *
     * @Route("/phrase/{id}/show", name="phrase_show")
     * @Template()
     * @Secure(roles="ROLE_USER")
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
     * @Route("/page/{page_id}/phrase/add", name="phrase_new")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function newAction($page_id)
    {
        $phrase = new Phrase();

        $form = $this->createForm(new PhraseType(), $phrase);

        return array(
            'entity' => $phrase,
            'page_id' => $page_id,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Phrase entity.
     *
     * @Route("/page/{page_id}/phrase/create", name="phrase_create")
     * @Method("post")
     * @Template("SeoPageBundle:Phrase:new.html.twig")
     * @Secure(roles="ROLE_USER")
     */
    public function createAction($page_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $page = $em->getRepository('SeoPageBundle:Page')->find($page_id);

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $phrase = new Phrase();
        $phrase->setPage($page);

        $request = $this->getRequest();
        $form = $this->createForm(new PhraseType(), $phrase);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em->persist($phrase);
            $em->flush();

            return $this->redirect($this->generateUrl('page_show', array('id' => $page->getId())));
        }

        return array(
            'entity' => $phrase,
            'form' => $form->createView()
        );
    }

    /**
     * Deletes a Phrase entity.
     *
     * @Route("/phrase/{id}/delete", name="phrase_delete")
     * @Secure(roles="ROLE_USER")
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
