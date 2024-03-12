<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
$lp = 0;
?>
<div class="before__cart">
<?php do_action( 'woocommerce_before_cart' ); ?>
</div>
<div class="cart_wrapper">
	<h4 class="text-6xl font-bold mb-10">@php wp_trim_words(_e('<span class="font-bold">Produkty</span> w twoim koszyku', 'atcolor') , 10, '...' ); @endphp </h4>
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
			<thead>
				<tr>
					<th class="product-lp">&nbsp;</th>
					<th class="product-thumbnail"><?php esc_html_e( 'Produkt', 'woocommerce' ); ?></th>
					<th class="product-name">&nbsp;</th>
					<th class="product-price"><?php _e( 'Cena', 'woocommerce' ); ?></th>
					<th class="product-quantity"><?php esc_html_e( 'Ilość', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'Wartość', 'woocommerce' ); ?></th>
					<th class="product-remove"><?php esc_html_e( 'Usuń', 'woocommerce' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-lp"><?php $lp++; echo $lp;?></td>
							<td class="product-thumbnail">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							?>
							</td>

							<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}

							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
							?>
							</td>

							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						
									$product_price_excl_tax = wc_get_price_excluding_tax( $_product ); // price without VAT
									// $product_price_netto =  number_format( $product_price_excl_tax, 2, ',', ' ' );
									// echo "<div class='price-netto'>" .$product_price_netto . " zł netto</div></div>";
							
								?>
							</td>

							<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									),
									$_product,
									false
								);
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

									$price_excl_tax = wc_get_price_excluding_tax( $_product ); // price without VAT
									// $subtotal_netto =  number_format( $price_excl_tax * $cart_item['quantity'], 2, ',', ' ' );
									// echo "<div class='price-netto'>" .$subtotal_netto . " zł netto</div></div>";
								?>
							</td>
							<td class="product-remove">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<g clip-path="url(#clip0_1251_570)">
												<path d="M1.10526 14.2083V3.54167H14.5789V14.2083C14.5789 14.7083 14.3596 15.1319 13.9211 15.4792C13.4825 15.8264 12.9649 16 12.3684 16H3.36842C2.73684 16 2.20175 15.8264 1.76316 15.4792C1.32456 15.1319 1.10526 14.7083 1.10526 14.2083ZM15.7368 0.875V2.66667H0V0.875H3.94737L5.05263 0H10.6842L11.7895 0.875H15.7368Z" fill="#605F5F"/>
												</g>
												<defs>
												<clipPath id="clip0_1251_570">
												<rect width="16" height="16" fill="white"/>
												</clipPath>
												</defs>
												</svg>
											</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr class="row_actions">
					<td colspan="7" class="actions">

						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon">
								<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Podaj kod kuponu', 'woocommerce' ); ?>" /> <button type="submit" class="btn-primary btn-coupon" name="apply_coupon" value="<?php esc_attr_e( 'Zastosuj kupon rabatowy', 'woocommerce' ); ?>"><?php esc_attr_e( 'Zastosuj kupon rabatowy', 'woocommerce' ); ?>@svg('button-arrow', 'inline-block ml-3')</button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>

						<button type="submit" class="btn-primary" id="update_cart" name="update_cart" value="<?php esc_attr_e( 'Aktualizuj koszyk', 'woocommerce' ); ?>"><?php esc_html_e( 'Aktualizuj koszyk', 'woocommerce' ); ?>@svg('button-arrow', 'inline-block ml-3')</button>

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>
</div>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
