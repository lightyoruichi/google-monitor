<?php

namespace Seo\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SeoUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
