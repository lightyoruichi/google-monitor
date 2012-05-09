<?php

namespace Seo\Bundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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

    /**user_group
     * @var \Seo\Bundle\UserBundle\Entity\User $user;
     *
     * @ORM\ManyToOne(targetEntity="Seo\Bundle\UserBundle\Entity\User", inversedBy="pages")
     */
    protected $user;

    /**
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
     * @ORM\Column(type="string", length=510)
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
}