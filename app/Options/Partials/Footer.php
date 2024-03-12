<?php

namespace App\Options\Partials;

use App\Options\Partials\FourColumnBox;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Footer extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $footer = new FieldsBuilder('footer');

        $footer
            
            ->addAccordion('fourcolumnbox_accordion', ['label' => 'Zalety - kafelki', 'open' => 0, 'multi_expand' => 1, 'wrapper' => ['class' => 'acf-custom-group-section']])
                ->addFields($this->get(FourColumnBox::class))
            ->addAccordion('fourcolumnbox_accordion_end')->endPoint()
            
            ->addAccordion('content_accordion', ['label' => 'Zawartość stopki', 'open' => 0, 'multi_expand' => 1, 'wrapper' => ['class' => 'acf-custom-group-section']])
            
            ->addRepeater('contact', ['label' => 'Dodaj informacje kontaktowe', 'max' => 2, 'button_label' => 'Dodaj informacje kontaktowe'])
                ->addText('contact-title', ['label' => 'Tytuł'])
                ->addText('contact-text', ['label' => 'Tekst'])
                ->addWysiwyg('contact-desc', ['label' => 'Opis'])
                ->addUrl('contact-url', ['label' => 'Link do google maps'])
            ->endRepeater()

            ->addAccordion('content_accordion_end')->endPoint();

        return $footer;
    }
}





