<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
	<div class="orders">
		<h6 class="title text-5xl font-bold mb-5"><?php _e('Twoje zamówienie', 'woocommerce') ?></h6>
	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
									<?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( $order->get_date_created()->date( 'd-m-Y' ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s', '%1$s', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M13.71 10.7682C13.801 10.6731 13.8724 10.561 13.92 10.4382C14.02 10.1948 14.02 9.92169 13.92 9.67823C13.8724 9.55548 13.801 9.44334 13.71 9.34823L10.71 6.34823C10.5217 6.15993 10.2663 6.05414 10 6.05414C9.7337 6.05414 9.47831 6.15993 9.29 6.34823C9.1017 6.53654 8.99591 6.79193 8.99591 7.05823C8.99591 7.32453 9.1017 7.57993 9.29 7.76823L10.59 9.05823H7C6.73479 9.05823 6.48043 9.16359 6.2929 9.35113C6.10536 9.53866 6 9.79302 6 10.0582C6 10.3234 6.10536 10.5778 6.2929 10.7653C6.48043 10.9529 6.73479 11.0582 7 11.0582H10.59L9.29 12.3482C9.19628 12.4412 9.12188 12.5518 9.07111 12.6737C9.02034 12.7955 8.99421 12.9262 8.99421 13.0582C8.99421 13.1902 9.02034 13.3209 9.07111 13.4428C9.12188 13.5647 9.19628 13.6753 9.29 13.7682C9.38297 13.862 9.49357 13.9364 9.61543 13.9871C9.73729 14.0379 9.86799 14.064 10 14.064C10.132 14.064 10.2627 14.0379 10.3846 13.9871C10.5064 13.9364 10.617 13.862 10.71 13.7682L13.71 10.7682ZM20 10.0582C20 8.08042 19.4135 6.14702 18.3147 4.50253C17.2159 2.85804 15.6541 1.57631 13.8268 0.819437C11.9996 0.0625604 9.98891 -0.135473 8.0491 0.250379C6.10929 0.636231 4.32746 1.58864 2.92894 2.98716C1.53041 4.38569 0.578004 6.16752 0.192152 8.10733C-0.193701 10.0471 0.00433284 12.0578 0.761209 13.8851C1.51809 15.7123 2.79981 17.2741 4.4443 18.3729C6.08879 19.4717 8.02219 20.0582 10 20.0582C12.6522 20.0582 15.1957 19.0047 17.0711 17.1293C18.9464 15.2539 20 12.7104 20 10.0582ZM2 10.0582C2 8.47598 2.4692 6.92926 3.34825 5.61367C4.2273 4.29808 5.47673 3.2727 6.93854 2.6672C8.40035 2.0617 10.0089 1.90327 11.5607 2.21195C13.1126 2.52063 14.538 3.28256 15.6569 4.40138C16.7757 5.5202 17.5376 6.94566 17.8463 8.49751C18.155 10.0494 17.9965 11.6579 17.391 13.1197C16.7855 14.5815 15.7602 15.8309 14.4446 16.71C13.129 17.589 11.5823 18.0582 10 18.0582C7.87827 18.0582 5.84344 17.2154 4.34315 15.7151C2.84286 14.2148 2 12.18 2 10.0582Z" fill="white"/>
</svg>
</a>';
									}
								}
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
