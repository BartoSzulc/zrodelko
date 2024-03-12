<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CategoryColumns extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $categoryColumns = new FieldsBuilder('category_columns', ['title' => 'Dwie kolumny w kategorii (pod paginacją)']);

        $categoryColumns

            ->setLocation('taxonomy', '==', 'product_cat');
            
        $categoryColumns
            ->addTrueFalse('hide_category_from_filter', ['label' => 'Nie pokazuj w filtracji'])
            ->addText('category_title', ['label' => 'Tytuł kategorii'])
            ->addGroup('category_column', ['label' => 'Kolumna', 'wrapper' => ['width' => '50%']])
                ->addText('title', ['label' => 'Tytuł kolumny'])
                ->addWysiwyg('content', ['label' => 'Treść kolumny'])
            ->endGroup()
            ->addGroup('category_column_1', ['label' => 'Kolumna druga', 'wrapper' => ['width' => '50%']])
                ->addText('title', ['label' => 'Tytuł kolumny'])
                ->addWysiwyg('content', ['label' => 'Treść kolumny'])
            ->endGroup();

        return $categoryColumns->build();
    }
}
