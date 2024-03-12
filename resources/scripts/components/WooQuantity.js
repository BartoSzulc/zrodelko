export default class WooQuantity {
  constructor() {
    this.btnPlus = document.querySelector("#quantity-plus");
    this.btnMinus = document.querySelector("#quantity-minus");
  }

  init() {
    jQuery(function () {

      const update_cart = () => {
        if (jQuery('#update_cart').length) {
         // jQuery('#update_cart').removeAttr('disabled').trigger('click');
        }
      }

      if (jQuery(".quantity").length) {
        jQuery(".quantity_min").on("click", function (e) {
          e.preventDefault();
          const qty = jQuery(this)
            .closest(".quantity")
            .find("#quantity-number");
          if (qty.val() > 1) {
            qty.val(parseInt(qty.val()) - 1);
            //update_cart();
          }
        });
        jQuery(".quantity_max").on("click", function (e) {
          e.preventDefault();
          const qty = jQuery(this)
            .closest(".quantity")
            .find("#quantity-number");
          qty.val(parseInt(qty.val()) + 1);
          //update_cart();
        });
      }
    });
  }
}
