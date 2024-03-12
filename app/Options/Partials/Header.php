<?php

namespace App\Options\Partials;

use App\Options\Partials\SocialMedia;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Header extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $header = new FieldsBuilder('header');

        $header

            ->addAccordion('topbar_accordion', ['label' => 'Pasek górny', 'open' => 0, 'multi_expand' => 1, 'wrapper' => ['class' => 'acf-custom-group-section']])
                ->addTrueFalse('topbar', ['label' => 'Pokaż pasek górny', 'ui' => 1])
                ->addWysiwyg('topbar_content', ['label' => 'Treść topbara', 'instructions' => 'Aby dodać czerwony tekst możemy użyć &lt;span class="text-primary"&gt;Jakiś tekst&lt;/span&gt; (przełączamy na widok <strong>Tekstowy</strong>). Możemy również użyć &lt;strong&gt;&lt;/strong&gt; jak i innych znaczników tekstowych.'])
            ->addAccordion('topbar_accordion_end')->endPoint()
            ->addAccordion('logo_accordion', ['label' => 'Logo strony', 'open' => 0, 'multi_expand' => 1, 'wrapper' => ['class' => 'acf-custom-group-section']])
                ->addImage('header_logo', ['label' => 'Logo', 'return_format' => 'id'])
            ->addAccordion('logo_accordion_end')->endPoint()
            ->addAccordion('content_accordion', ['label' => 'Zawartość', 'open' => 0, 'multi_expand' => 1, 'wrapper' => ['class' => 'acf-custom-group-section']])
                ->addRepeater('links_header', ['label' => 'Linki social media', 'button_label' => 'Dodaj link'])
                    ->addFields($this->get(SocialMedia::class))
                ->endRepeater()
            ->addAccordion('content_accordion_end')->endPoint();

        return $header;
    }
}





