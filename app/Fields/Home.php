<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Home extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $home = new FieldsBuilder('home');

        $home
       
        ->setLocation('page_type', '==', 'front_page');
        
        $home
  
            ->addGroup('hero-tiles', ['label' => 'Hero - kafelki'])
            ->addSelect('hero-title_1--version', ['label' => 'Wersja zdjęcia', 'choices' => ['full' => 'Duże zdjęcie', '4x4' => '4 małe zdjęcia']])
                    ->addGroup('hero-tile_1', ['label' => 'Pierwsza kolumna', 'conditional_logic' => ['field' => 'hero-title_1--version', 'operator' => '==', 'value' => 'full']])
                        ->addLink('hero-tiles-link', ['label' => 'Link'])
                        ->addImage('hero-tiles-image', ['label' => 'Obrazek'])
                        ->addText('hero-tiles-title', ['label' => 'Tekst linku', 'instructions' => 'Domyślnie "Sprawdź"'])
                    ->endGroup()
        
                    ->addRepeater('hero-tiles-repeater_1', ['label' => '4 kolumny', 'max' => 4, 'button_label' => 'Dodaj kolumne', 'conditional_logic' => ['field' => 'hero-title_1--version', 'operator' => '==', 'value' => '4x4']])
                        ->addLink('hero-tiles-link', ['label' => 'Link'])
                        ->addImage('hero-tiles-image', ['label' => 'Obrazek'])
                        ->addText('hero-tiles-title', ['label' => 'Tekst linku', 'instructions' => 'Domyślnie "Sprawdź"'])
                    ->endRepeater() 
                ->addRepeater('hero-tiles-repeater', ['label' => 'Pozostałe kolumny', 'max' => 4, 'button_label' => 'Dodaj kolumne'])
                    ->addLink('hero-tiles-link', ['label' => 'Link'])
                    ->addImage('hero-tiles-image', ['label' => 'Obrazek'])
                    ->addText('hero-tiles-title', ['label' => 'Tekst linku', 'instructions' => 'Domyślnie "Sprawdź"'])
                ->endRepeater() 
                ->addRepeater('additional-hero-tiles-repeater', ['label' => 'Pozostałe kolumny', 'max' => 4, 'button_label' => 'Dodaj kolumne'])
                    ->addLink('hero-tiles-link', ['label' => 'Link'])
                    ->addImage('hero-tiles-image', ['label' => 'Obrazek'])
                    ->addText('hero-tiles-title', ['label' => 'Tekst linku', 'instructions' => 'Domyślnie "Sprawdź"'])
                ->endRepeater()
            ->endGroup()
            
            ->addRepeater('tiles-repeater', ['label' => 'Zalety - kafelki', 'max' => 4, 'button_label' => 'Dodaj kafelek'])
                ->addImage('tiles-image', ['label' => 'Obrazek'])
                ->addWysiwyg('tiles-desc', ['label' => 'Tekst'])
            ->endRepeater()

          

            ->addGroup('seobox', ['label' => 'SeoBox'])
                ->addWysiwyg('seobox-title', ['label' => 'Tytuł'])
                ->addGroup('seobox-group_1', ['label' => 'Pierwsza kolumna'])
                    ->addWysiwyg('seobox-group_1-title', ['label' => 'Tytuł'])
                    ->addWysiwyg('seobox-group_1-content', ['label' => 'Treść'])
                ->endGroup()
                ->addGroup('seobox-group_2', ['label' => 'Druga kolumna'])
                    ->addWysiwyg('seobox-group_2-title', ['label' => 'Tytuł'])
                    ->addWysiwyg('seobox-group_2-content', ['label' => 'Treść'])
                ->endGroup()
            ->endGroup()
            ;



        return $home->build();
    }
}
