<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>
<div class="edit__account">
<form action="" method="post" class="woocommerce-EditAccountForm edit-account" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
<div class="grid grid-cols-12 gap-5">
	<div class="col-span-12 text-5xl font-bold ">
		<h5 class="edit__account--title">Dane osobowe</h5>
	</div>
	<div class=" col-span-12 md:col-span-4">
		<p class="woocommerce-FormRow form-row">
			<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text line-height-xl input-text" name="account_first_name" id="account_first_name"  placeholder="Wypełnij pole" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
	</div>
	<div class=" col-span-12 md:col-span-4">
	<p class="woocommerce-FormRow form-row">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text line-height-xl input-text" name="account_last_name" id="account_last_name"  placeholder="Wypełnij pole" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	<div class="clear"></div>
	</div>
	<div class=" col-span-12 md:col-span-4">
	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email line-height-xl input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>
	</div>
</div>
<div class="grid grid-cols-12 mb-5">
	<div class="col-span-12 text-5xl font-bold">
		<h5 class="edit__account--title password">Zmiana hasła</h5>
	</div>
</div>
<div class="grid grid-cols-12 gap-5 password_form">
	<div class=" col-span-12 md:col-span-4">
		<p class="woocommerce-FormRow form-row">
			<label for="password_current"><?php esc_html_e( 'Aktualne hasło', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password line-height-xl input-text" name="password_current" id="password_current" placeholder="****************" autocomplete="off" />
		</p>
	</div>
	<div class=" col-span-12 md:col-span-4">
		<p class="woocommerce-FormRow form-row">
			<label for="password_1"><?php esc_html_e( 'Nowe hasło', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password line-height-xl input-text" name="password_1" id="password_1" autocomplete="off" placeholder="Wypełnij pole" />
		</p>
	</div>
	<div class=" col-span-12 md:col-span-4">
		<p class="woocommerce-FormRow form-row">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password line-height-xl input-text" name="password_2" id="password_2" autocomplete="off" placeholder="Wypełnij pole" />
		</p>
	</div>
	<div class="clear"></div>
</div>
	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p class="clearfix text-center">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button button-primary btn-go-shop mt-4" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?>@svg('button-arrow', 'inline-block ml-3')</button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>
</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
