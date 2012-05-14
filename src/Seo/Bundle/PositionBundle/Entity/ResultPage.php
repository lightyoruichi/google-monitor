<?php

namespace Seo\Bundle\PositionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Seo\Bundle\PositionBundle\Entity\ResultPage
 *
 * @ORM\Table(name="cache")
 * @ORM\Entity
 */
class ResultPage
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
     * @var string $phrase
     *
     * @ORM\Column(type="string")
     */
    protected $phrase;

    /**
     * @var datetime $checked_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="checked_at", type="datetime")
     */
    protected $checked_at;

    /**
     * @var datetime $expires_at
     *
     * @ORM\Column(name="expires_at", type="datetime")
     */
    protected $expires_at;

    /**
     * @var ArrayCollection $items;
     *
     * @ORM\OneToMany(targetEntity="ResultItem", mappedBy="resultPage")
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

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
     * Set phrase
     *
     * @param string $phrase
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;
    }

    /**
     * Get phrase
     *
     * @return string
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * Set checked_at
     *
     * @param datetime $checkedAt
     */
    public function setCheckedAt($checkedAt)
    {
        $this->checked_at = $checkedAt;
    }

    /**
     * Get checked_at
     *
     * @return datetime
     */
    public function getCheckedAt()
    {
        return $this->checked_at;
    }

    /**
     * Set expires_at
     *
     * @param datetime $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;
    }

    /**
     * Get expires_at
     *
     * @return datetime
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Add items
     *
     * @param Seo\Bundle\PositionBundle\Entity\ResultItem $items
     */
    public function addResultItem(\Seo\Bundle\PositionBundle\Entity\ResultItem $items)
    {
        $this->items[] = $items;
    }

    /**
     * Get items
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}