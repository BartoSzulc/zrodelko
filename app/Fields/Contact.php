<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Contact extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $contact = new FieldsBuilder('contact');

        $contact
            ->setLocation('page_template', '==', 'template-contact.blade.php');

        $contact
            ->addGroup('contact-page' , ['label' => 'Kontakt'])
                ->addText('contact-title', ['label' => 'Tytuł H1'])
                ->addRepeater('contact', ['label' => 'Dodaj informacje kontaktowe', 'button_label' => 'Dodaj informacje kontaktowe'])
                    ->addText('contact-title', ['label' => 'Tytuł'])
                    ->addText('contact-text', ['label' => 'Tekst'])
                    ->addWysiwyg('contact-desc', ['label' => 'Opis'])
                    ->addUrl('contact-url', ['label' => 'Link do google maps'])
                ->endRepeater()
            ->endGroup();

        return $contact->build();
    }
}
