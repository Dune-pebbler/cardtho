<?php
add_action('acf/init', 'my_acf_init');
add_filter('allowed_block_types', 'allow_custom_blocks_only');

function my_acf_init()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'hero',
      'title'             => __('Hero'),
      'description'       => __('Hero banner met afbeelding of video '),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'format-image',
      'mode'              => 'edit',
      'keywords'          => array('hero', 'banner', 'afbeelding'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'single-text',
      'title'             => __('Text'),
      'description'       => __('Simpel textblok met 1 of 2 kolommen '),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'editor-alignleft',
      'mode'              => 'edit',
      'keywords'          => array('tekst'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'image-text',
      'title'             => __('Tekst met afbeelding'),
      'description'       => __('Tekst met afbeelding 2 kolommen'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'align-pull-right',
      'mode'              => 'edit',
      'keywords'          => array('tekst', 'afbeelding'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'image',
      'title'             => __('Afbeelding'),
      'description'       => __('Een of meerdere afbeeldingen'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'format-image',
      'mode'              => 'edit',
      'keywords'          => array('afbeelding'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'map',
      'title'             => __('Interactieve kaart'),
      'description'       => __('Een google maps kaart met of zonder tekst'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'location',
      'mode'              => 'edit',
      'keywords'          => array('kaart'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'decoration',
      'title'             => __('Decoratieve lijn'),
      'description'       => __('Sierblok'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'art',
      'mode'              => 'edit',
      'keywords'          => array('decoratie'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'faq',
      'title'             => __('FAQ vraag en antwoord'),
      'description'       => __('FAQ'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'editor-help',
      'mode'              => 'edit',
      'keywords'          => array('faq'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'tiles',
      'title'             => __('Tegels'),
      'description'       => __('Tegels waar kaarten in kunnen word geplaats'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'columns',
      'mode'              => 'edit',
      'keywords'          => array('faq'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'masonry',
      'title'             => __('Masonry gallerij'),
      'description'       => __('Photos gallerij is een masonry patroon'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'layout',
      'mode'              => 'edit',
      'keywords'          => array('logos'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'logo-slider',
      'title'             => __('Logo slider'),
      'description'       => __('bewegende logo balk'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'editor-insertmore',
      'mode'              => 'edit',
      'keywords'          => array('logos'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'breadcrumbs',
      'title'             => __('Broodkruimels'),
      'description'       => __('Website broodkruimels zodat je goed kan zien waar je je bevindt op de website'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'ellipsis',
      'mode'              => 'edit',
      'keywords'          => array('breadcrumbs'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'post-archive',
      'title'             => __('Alle posts'),
      'description'       => __('Laat alle posts zien in een overzicht / galerij'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'grid-view',
      'mode'              => 'edit',
      'keywords'          => array('posts'),
    ));
  }
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'shop-archive',
      'title'             => __('Winkel product overzicht'),
      'description'       => __('Een overzicht van alle producten in de winkel'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => '',
      'icon'              => 'archive',
      'mode'              => 'edit',
      'keywords'          => array('posts'),
    ));
  }
}

function my_acf_block_render_callback($block)
{
  // Convert name ("acf/....") into path friendly slug ("...")
  $slug = str_replace('acf/', '', $block['name']);
  // Include a template part from within the "template-parts/block" folder starting with content
  if (file_exists(get_theme_file_path("/template-parts/blocks/block-{$slug}.php"))) {
    include(get_theme_file_path("/template-parts/blocks/block-{$slug}.php"));
  }
}

function allow_custom_blocks_only()
{
  $additional_blocks = array(
    'shortcode',
    'sbi/sbi-feed-block'
  );

  // Get all registered ACF blocks
  $acf_blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();
  $custom_blocks = array();
  foreach ($acf_blocks as $block) {
    if (strpos($block->name, 'acf/') !== false) {
      $custom_blocks[] = $block->name;
    }
  }
  $custom_blocks = array_merge($custom_blocks, $additional_blocks);
  return $custom_blocks;
}
