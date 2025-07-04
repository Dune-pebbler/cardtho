<?php
//Data
$form_shortcode = get_field('site_settings_footer_form', 'option');
$contact_content = get_field('site_settings_footer_contact', 'option');
$footer_bool = get_field('site_settings_footer_menu_bool', 'option');
$socials_bool = get_field('site_settings_footer_socials_bool', 'option');

$logo_primary = get_field('site_settings_logo_primary', 'option');
$logo_long = get_field('site_settings_logo_long', 'option');
?>
</main>

<footer>
  <div class="footer-main container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-start">
    <?php if ($socials_bool &&  have_rows('socials_repeater', 'option')) : ?>
      <div class="grouper-logo">
        <div class="footer-logo mb-4">
          <?php if ($logo_long): ?>
            <img src="<?php echo esc_url($logo_long['url']); ?>" alt="<?php echo esc_attr($logo_long['alt']); ?>" />
          <?php elseif ($logo_primary): ?>
            <img src="<?php echo esc_url($logo_primary['url']); ?>"
              alt="<?php echo esc_attr($logo_primary['alt']); ?>" />
          <?php endif; ?>
        </div>
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
      </div>
    <?php endif; ?>

    <?php if ($contact_content) : ?>
      <div class="contact-info">
        <?= $contact_content ?>
      </div>
    <?php endif; ?>
    <?php if ($footer_bool) : ?>
      <div class="footer-nav">
        <h3>Menu</h3>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer',
          'menu_class' => 'footer-nav',
        ]);
        ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="bottom-footer   px-4 grid grid-cols-1 items-start">
    <?php
    $year = date('Y'); // Get the current year
    $copyright_symbol = '&copy;'; // Copyright symbol
    $company_name = get_bloginfo('name');
    $privacy_url = '/privacyverklaring';
    $website_name = 'Dune Pebbler';
    $website_url = 'https://dunepebbler.nl';

    echo '<p class="text-center">' . $year . ' ' . $copyright_symbol . ' ' . $company_name . ' | <a href="' . $privacy_url . '">Privacy statement</a> | Website door <a href="' . $website_url . '">' . $website_name . '</a></p>'
    ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>