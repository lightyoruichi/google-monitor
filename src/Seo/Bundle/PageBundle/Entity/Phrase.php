<?php

namespace Seo\Bundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
}