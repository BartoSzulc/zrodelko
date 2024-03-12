
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php if ( get_field('head', 'option') ) : ?>
    <?php echo get_field('head', 'option'); ?>
    <?php endif; ?>
  </head>
 
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php do_action('get_header'); ?>

    <div id="app">
      <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
    </div>

    <?php do_action('get_footer'); ?>
    <?php wp_footer(); ?>
    <?php if ( get_field('body', 'option') ) : ?>
    <?php echo get_field('body', 'option'); ?>
    <?php endif; ?>
  </body>
</html>