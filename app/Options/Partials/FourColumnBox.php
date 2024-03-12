<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FourColumnBox extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $fourcolumnbox = new FieldsBuilder('fourcolumnbox');

        $fourcolumnbox

            ->addRepeater('tiles-repeater', ['label' => 'Zalety - kafelki', 'max' => 4, 'button_label' => 'Dodaj kafelek'])
                ->addImage('tiles-image', ['label' => 'Obrazek'])
                ->addWysiwyg('tiles-desc', ['label' => 'Tekst'])
            ->endRepeater()
            ;
            

        return $fourcolumnbox;
    }
}
