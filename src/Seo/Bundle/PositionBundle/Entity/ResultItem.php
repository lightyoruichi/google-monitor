<?php

namespace Seo\Bundle\PositionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Seo\Bundle\PositionBundle\Entity\ResultItem
 *
 * @ORM\Table(name="cache_item")
 * @ORM\Entity
 */
class ResultItem
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $position
     *
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var string $url
     *
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string $description
     *
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @var ResultPage $resultPage;
     *
     * @ORM\ManyToOne(targetEntity="ResultPage", inversedBy="items")
     */
    protected $resultPage;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set resultPage
     *
     * @param Seo\Bundle\PositionBundle\Entity\ResultPage $resultPage
     */
    public function setResultPage(\Seo\Bundle\PositionBundle\Entity\ResultPage $resultPage)
    {
        $this->resultPage = $resultPage;
    }

    /**
     * Get resultPage
     *
     * @return Seo\Bundle\PositionBundle\Entity\ResultPage
     */
    public function getResultPage()
    {
        return $this->resultPage;
    }
}