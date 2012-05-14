<?php

namespace Seo\Bundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Seo\Bundle\PhraseBundle\Entity\Phrase
 *
 * @ORM\Table(name="phrases")
 * @ORM\Entity
 */
class Phrase
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
     * @var Page $page;
     *
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="phrases")
     */
    protected $page;

    /**
     * @var boolean $is_active
     *
     * @ORM\Column(type="boolean")
     */
    protected $is_active;

    /**
     * @var string $phrase
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     */
    protected $phrase;

    /**
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection() $positions;
     *
     * @ORM\OneToMany(targetEntity="Seo\Bundle\PositionBundle\Entity\Position", mappedBy="phrase")
     */
    protected $positions;

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
     * Set is_active
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    }

    /**
     * Get is_active
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set page
     *
     * @param Seo\Bundle\PageBundle\Entity\Page $page
     */
    public function setPage(\Seo\Bundle\PageBundle\Entity\Page $page)
    {
        $this->page = $page;
    }

    /**
     * Get page
     *
     * @return Seo\Bundle\PageBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    public function __construct()
    {
        $this->is_active = true;
        $this->positions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add positions
     *
     * @param Seo\Bundle\PositionBundle\Entity\Position $positions
     */
    public function addPosition(\Seo\Bundle\PositionBundle\Entity\Position $positions)
    {
        $this->positions[] = $positions;
    }

    /**
     * Get positions
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }
}