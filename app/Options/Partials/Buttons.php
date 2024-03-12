<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Buttons extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $buttons = new FieldsBuilder('buttons');

        $buttons

            ->addSelect('button_header_version', ['label' => 'Wersja przycisku', 'choices' => ['v1' => 'Wersja z tłem', 'v2' => 'Wersja bez tła', 'v3' => 'Wersja drugi kolor'], 'wrapper' => ['width' => '50%'], 'default_value' => 'v1'])
            ->addLink('button_header_link', ['label' => 'Link oraz tekst przycisku', 'wrapper' => ['width' => '50%']]);

        return $buttons;
    }
}
