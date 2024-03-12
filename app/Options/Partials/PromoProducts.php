<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PromoProducts extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $promoproducts = new FieldsBuilder('promoproducts');

        $promoproducts
        ->addMessage('Promocja tygodnia i Produkty w dobrej cenie', 'Wybierz produkty, które będą wyświetlane w sekcji "Promocje".',  ['wrapper' => ['width' => '100%'], 'instruction' => 'Wybierz produkty, które będą wyświetlane na stronie głównej w sekcji "Promocje".'])

        ->addRelationship('promo_product-week', ['label' => 'Wybierz jeden produkt na promocji tygodnia', 'instructions' => 'Wybieramy tu maksymalnie 1 produkt.<br/> <b>Pamiętaj!</b> Jeśli wybrany produkt ma wyświetlać się z odliczaniem do końca promocji to powininen zawierać harmonogram promocji (daty od-do). <a href="https://www.wpdesk.pl/docs/promocje-woocommerce/#promocje-w-woocommerce-wedlug-harmonogramu" target="_blank">Jak ustawić harmonogram?</a>','post_type' => ['product'], 'return_format' => 'id', 'wrapper' => ['width' => '100%'], 'max' => 1])

        ->addRelationship('promo_products', ['label' => 'Wybierz produkty na promocji', 'instructions' => '<em></em>(opcjonalnie)</em> Możemy tu operować produktami, które mają się wyświetlić w sekcji "<b>Produkty w dobrej cenie</b>".<br/> Jeśli zostawimy to pole puste, produkty w promocji wyświetlą się automatycznie.',  'post_type' => ['product'], 'return_format' => 'id', 'wrapper' => ['width' => '100%']])
        // add acf builder instruction to relationship
        
        // add acf relationship with only product taxonomies

    
        ;
        return $promoproducts;
    }
}
