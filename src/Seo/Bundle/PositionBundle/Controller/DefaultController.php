<?php

namespace Seo\Bundle\PositionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/phrase/{id}/fixtures")
     */
    public function loadDefaultsAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $phrase = $em->getRepository('SeoPageBundle:Phrase')->find($id);

        if (!$phrase) {
            throw new $this->createNotFoundException('Phrase entity not found');
        }

        $d = new \DateTime('2010-01-01');
        $end = new \DateTime('2011-12-31');

        do {
            $h = rand(0, 23);
            $m = rand(0, 59);

            $d->setTime($h, $m);

            $checked_at = clone $d;

            $pos = new \Seo\Bundle\PositionBundle\Entity\Position();
            $pos->setPhrase($phrase);
            $pos->setPosition(rand(1, 100));
            $pos->setCheckedAt($checked_at);

            $em->persist($pos);

            $d->modify('+1 day');

        } while ($d < $end);

        $em->flush();

        return new \Symfony\Component\HttpFoundation\Response('Imported OK');
    }

    /**
     * @Route("/phrase/{id}/positions")
     */
    public function getPhrasePositions($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $positions = $em->getRepository('SeoPositionBundle:Position')->findBy(
            array(
                'phrase' => $id
            ),
            array(
                'checked_at' => 'asc' // ORDER BY CLAUSE
            )
        );

        $rowData = array();

        /* @var \Seo\Bundle\PositionBundle\Entity\Position $position */
        foreach ($positions as $position) {
            $rowData[] = array(
                $position->getCheckedAt()->getTimestamp() * 1000,
                $position->getPosition(),
            );
        }

        $jsonData = json_encode($rowData);

        return new \Symfony\Component\HttpFoundation\Response($jsonData);
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        $browser = new \Seo\Component\Browser\Browser();
        $browser->request('GET','http://www.supremumseo.pl');

        $response = $browser->getResponse();
        return new \Symfony\Component\HttpFoundation\Response($response->getContent());
    }
}
