<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SocialMedia extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $socialmedia = new FieldsBuilder('socialmedia');

        $socialmedia

        ->addSelect('social_icon', ['label' => 'Ikona', 'choices' => ['facebook' => 'Facebook', 'instagram' => 'Instagram'], 'wrapper' => ['width' => '50%']])
        ->addLink('social_link', ['label' => 'Link', 'wrapper' => ['width' => '50%']]);

        return $socialmedia;
    }
}
