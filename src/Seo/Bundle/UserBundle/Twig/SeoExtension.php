<?php

namespace Seo\Bundle\UserBundle\Twig;

use Twig_Extension;

class SeoExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'alertkey' => new \Twig_Function_Method($this,'alertKey'),
        );
    }

    public function alertKey($key)
    {
        return str_replace('fos_user_','',$key);
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

    public function getName()
    {
        return 'seo_extension';
    }
}