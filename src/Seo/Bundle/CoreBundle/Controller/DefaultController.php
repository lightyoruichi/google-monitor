<?php

namespace Seo\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @Route("/", name="main")
     * @Template
     */
    public function dashboardAction()
    {
        return array();
    }
}
