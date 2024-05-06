<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Product extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $product = new FieldsBuilder('Produkt');

        $product
            ->setLocation('post_type', '==', 'product');
        $product
        ->addTab('promo_label', ['label' => 'Dodaj etykiete'])
            ->addTrueFalse('truefalse_checkbox_select', ['label' => 'Wyswietl etykiete',])
            ->addSelect('checkbox_select', ['label' => 'Wybierz opcje', 'choices' => ['good_price' => 'Okazja cenowa', 'limit' => 'Limitowana edycja', 'our' => 'Nasza propozycja'], 'return_format' => 'label',])
        ->addTab('promo_fake', ['label' => 'Ustaw "sztuczną" promocje'])
            ->addText('fake_price', ['label' => 'Cena przed promocją', 'instructions' => 'np. 40,00', 'wrapper' => ['width' => '50%']])
            ->addText('fake_price_after', ['label' => '% promocji', 'instructions' => 'np. 4', 'wrapper' => ['width' => '50%']])
        ->addTab('is_promo_tab', ['label' => 'Promocja tygodnia'])
            ->addMessage('Ustaw promocje', 'Ustaw promocje dla tego produktu przechodząc <a href="admin.php?page=zarzadzanie-motywem"><b>tutaj</b></a>.')
        ->addTab('product_gallery_tab', ['label' => 'Galeria'])
            ->addGallery('product_gallery', ['label' => 'Galeria'])
        ->addTab('additional_information_tab', ['label' => 'Dodatkowe informacje'])
            ->addGroup('additional_information', ['label' => 'Dodatkowe informacje'])
                ->addWysiwyg('title', ['label' => 'Tytuł', 'wrapper' => ['width' => '50%']])
                ->addWysiwyg('content', ['label' => 'Treść', 'wrapper' => ['width' => '50%']])
            ->endGroup()
        ->addTab('product_details_tab', ['label' => 'Szczegóły'])
            ->addRepeater('product_details', ['label' => 'Szczegóły', 'layout' => 'block', 'button_label' => 'Dodaj szczegół'])
                ->addText('title', ['label' => 'Tytuł', 'wrapper' => ['width' => '50%']])
                ->addText('content', ['label' => 'Treść', 'wrapper' => ['width' => '50%']])
            ->endRepeater()
        ->addTab('two_columns_tab', ['label' => 'Dwie kolumny'])
            ->addGroup('two_columns', ['label' => 'Dwie kolumny'])
                ->addWysiwyg('content', ['label' => 'Tytuł', 'wrapper' => ['width' => '50%']])
                ->addWysiwyg('content_1', ['label' => 'Treść', 'wrapper' => ['width' => '50%']])
        ->endGroup()

        
        // ->addTrueFalse('show_promo', [
        //     'label' => 'Wyświetlenie promocji',
        //     'instructions' => 'Jeśli przełącznik na "Tak", zostanie wyświetlona sekcja z aktualnymi promocjami w sklepie pod produktem.',
        //     'ui' => 3,
        //     'default_value' => 0,
        // ])
        // ->addTrueFalse('show_free_shipping', [
        //     'label' => 'Wyświetlenie brakującej kwoty do wysyłki',
        //     'instructions' => 'Jeśli przełącznik na "Tak", zostanie wyświetlona informacja o kwocie brakującej do darmowej wysyłki.',
        //     'ui' => 3,
        //     'default_value' => 1,
        // ])
        // ->addTrueFalse('show_producer_logo', [
        //     'label' => 'Wyświetlenie logo producenta',
        //     'instructions' => 'Jeśli przełącznik na "Tak", zostanie wyświetlone logo producenta na stronie produktu.',
        //     'ui' => 3,
        //     'default_value' => 1,
        // ])
            ;
            
        return $product->build();
    }
}
