<!DOCTYPE html>
<html lang="nl">

<head>
  <title><?php the_title() ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.typekit.net/dfb3xvw.css">
  <?php wp_head(); ?>
</head>

<?php
//Data
$search = get_field('site_settings_search_boolean', 'option');
$button_enabled = get_field('site_settings_button_boolean', 'option');
$button = get_field('site_settings_button_link', 'option');
$buttonVariant = get_field('site_settings_button_var', 'option');

$logo_primary = get_field('site_settings_logo_primary', 'option');
$logo_long = get_field('site_settings_logo_long', 'option');

$socials_bool = get_field('site_settings_socials_boolean');
?>

<body <?php body_class() ?>>

  <header class="main-header">
    <nav class="nav-main container mx-auto px-1 grid grid-cols-auto-1fr items-start">
      <div class="nav-logo">
        <a class="nav-logo__link" href="/" title="Home">
          <?php if ($logo_long): ?>
            <img class="nav-logo__img long" src="<?php echo esc_url($logo_long['url']); ?>" alt="<?php echo esc_attr($logo_long['alt']); ?>" />
          <?php elseif ($logo_primary): ?>
            <img class="nav-logo__img" src="<?php echo esc_url($logo_primary['url']); ?>"
              alt="<?php echo esc_attr($logo_primary['alt']); ?>" />
          <?php endif; ?>
        </a>
      </div>
      <div id="nav-menu" class="nav-menu flex gap-3 justify-end items-center h-full">
        <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'menu_class' => 'wp-nav-menu flex gap-1 h-full m-0',
          'container' => false,
        ]);
        ?>
        <?php if ($search): ?>
          <?php get_template_part('template-parts/searchbar'); ?>
        <?php endif; ?>
        <?php if ($button_enabled && $button): ?>
          <a href="<?php echo esc_url($button['url']); ?>"
            class="btn btn-<?= $buttonVariant ?>"><?= $button['title']; ?></a>
        <?php endif; ?>
        <?php if ($socials_bool): ?>
          <div class="socials">
            <?php while (have_rows('socials_repeater', 'option')) : the_row(); ?>

              <?php
              $socials_sub_icon = get_sub_field('socials_repeater_icon');
              $socials_sub_link = get_sub_field('socials_repeater_link');

              if ($socials_sub_icon && $socials_sub_link) : ?>
                <a class="socials__link" href="<?php echo esc_url($socials_sub_link['url']); ?>" target="_blank" rel="noopener noreferrer">
                  <img class="socials__img" src="<?php echo esc_url($socials_sub_icon['url']); ?>" alt="Social Icon">
                </a>
              <?php endif; ?>

            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="hamburger-cross">
        <div class="hamburger is-active">
          <div class="hamburger__line"></div>
          <div class="hamburger__line"></div>
          <div class="hamburger__line"></div>
        </div>
        <div class="cross">
          <div class="cross__line cross__line--1"></div>
          <div class="cross__line cross__line--2"></div>
        </div>
      </div>
  </header>

  <main>