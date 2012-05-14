<?php

namespace Seo\Bundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Seo\Bundle\PageBundle\Entity\Page
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity
 */
class Page
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
     * @var \Seo\Bundle\UserBundle\Entity\User $user;
     *
     * @ORM\ManyToOne(targetEntity="Seo\Bundle\UserBundle\Entity\User", inversedBy="pages")
     */
    protected $user;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection() $phrases;
     *
     * @ORM\OneToMany(targetEntity="Phrase", mappedBy="page")
     */
    protected $phrases;

    /**
     * @var boolean $is_active
     *
     * @ORM\Column(type="boolean")
     */
    protected $is_active;

    /**
     * @var string $url
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Url
     */
    protected $url;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string $description
     *
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    protected $description;

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

    public function __construct()
    {
        $this->is_active = true;
        $this->phrases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getUrl();
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
     * Add phrases
     *
     * @param Seo\Bundle\PageBundle\Entity\Phrase $phrases
     */
    public function addPhrase(\Seo\Bundle\PageBundle\Entity\Phrase $phrases)
    {
        $this->phrases[] = $phrases;
    }

    /**
     * Get phrases
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPhrases()
    {
        return $this->phrases;
    }

    /**
     * Set user
     *
     * @param Seo\Bundle\UserBundle\Entity\User $user
     */
    public function setUser(\Seo\Bundle\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Seo\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}