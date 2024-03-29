<?php

namespace Seo\Bundle\PositionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Seo\Bundle\PositionBundle\Entity\Position
 *
 * @ORM\Table(name="positions")
 * @ORM\Entity
 */
class Position
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
     * @var datetime $checked_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="checked_at", type="datetime")
     */
    protected $checked_at;

    /**
     * @var \Seo\Bundle\PageBundle\Entity\Phrase $phrase;
     *
     * @ORM\ManyToOne(targetEntity="Seo\Bundle\PageBundle\Entity\Phrase", inversedBy="positions")
     */
    protected $phrase;

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
     * @return DateTime
     */
    public function getCheckedAt()
    {
        return $this->checked_at;
    }

    /**
     * Set phrase
     *
     * @param Seo\Bundle\PageBundle\Entity\Phrase $phrase
     */
    public function setPhrase(\Seo\Bundle\PageBundle\Entity\Phrase $phrase)
    {
        $this->phrase = $phrase;
    }

    /**
     * Get phrase
     *
     * @return Seo\Bundle\PageBundle\Entity\Phrase
     */
    public function getPhrase()
    {
        return $this->phrase;
    }
}