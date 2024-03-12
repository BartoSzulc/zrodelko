<?php

namespace App\Options;

use App\Options\Partials\Newsletter;
use App\Options\Partials\Header;
use App\Options\Partials\Footer;
use App\Options\Partials\PromoProducts;
use App\Options\Partials\ProductLinks;



use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Settings extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Zarządzanie motywem';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Zarządzanie motywem | Ustawienia | Żródełko';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $settings = new FieldsBuilder('settings', ['title' => 'Ustawienia']);


        $settings
            
            ->addTab('promo_tab', ['label' => 'Promocje', 'placement' => 'left'])
                ->addFields($this->get(PromoProducts::class))
            //add tab to product links
            ->addTab('product_links_tab', ['label' => 'Linki', 'placement' => 'left'])
                ->addFields($this->get(ProductLinks::class))
            ->addTab('newsletter_tab', ['label' => 'Newsletter', 'placement' => 'left'])
                ->addFields($this->get(Newsletter::class))
            ->addTab('header_tab', ['label' => 'Nagłówek', 'placement' => 'left'])
                ->addGroup('header')
                    ->addFields($this->get(Header::class))
                ->endGroup()
                
            ->addTab('footer_tab', ['label' => 'Stopka', 'placement' => 'Left'])
                ->addGroup('footer')
                    ->addFields($this->get(Footer::class))
                ->endGroup()
            ->addTab('dodatkowe_skrypty_tab', ['label' => 'Dodatkowe skrypty'])
                ->addTextarea('head', ['label' => 'Kod w sekcji head'])
                ->addTextarea('body', ['label' => 'Kod w sekcji body (przed zamknięciem body)'])
            

            ;

        return $settings->build();
    }
}
