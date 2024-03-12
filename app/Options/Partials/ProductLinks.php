<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProductLinks extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $product_links = new FieldsBuilder('product-links');

        $product_links

            //add repater with link
            ->addRepeater('product_links', ['label' => 'Linki na stronie produktu', 'button_label' => 'Dodaj link', 'instructions' => 'W tym miejscu możesz wybrać linki, które będą wyświetlane na stronie produktu (np. Dostawa)'])
                ->addLink('product_link', ['label' => 'Link', 'wrapper' => ['width' => '50%']])
            ->endRepeater();

        return $product_links;
    }
}
