<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Newsletter extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $newsletter = new FieldsBuilder('newsletter');

        $newsletter
            ->addGroup('newsletter', ['label' => 'Newsletter'])
                ->addText('newsletter_title', ['label' => 'Tytuł'])
                ->addText('newsletter_price', ['label' => 'Cena'])
                ->addWysiwyg('newsletter_subtitle', ['label' => 'Podtytuł'])
                ->addText('newsletter_shortcode', ['label' => 'Shortcode do formularza'])
            ->endGroup()
          ;

        return $newsletter;
    }
}
