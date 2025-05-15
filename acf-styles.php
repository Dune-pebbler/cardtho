
<?php
if (have_rows('site_settings_global_colors', 'option')) :
    while (have_rows('site_settings_global_colors', 'option')) : the_row();
        $primary_color = get_sub_field('site_settings_primary_kleur');
        $secondary_color = get_sub_field('site_settings_secondary_kleur');
        $tertiary_color = get_sub_field('site_settings_tertiar_kleur');
        $black =  get_sub_field('site_settings_black');
        $white =  get_sub_field('site_settings_wit');
    endwhile;
endif;

if (have_rows('site_settings_text_colors', 'option')) :
    while (have_rows('site_settings_text_colors', 'option')) : the_row();
        $paragraph_color = get_sub_field('site_settings_text_colors_paragraph');
        $title_color = get_sub_field('site_settings_text_colors_title');
        $link_color = get_sub_field('site_settings_text_colors_link');
    endwhile;
endif;

if (have_rows('site_settings_button_colors', 'option')) :
    while (have_rows('site_settings_button_colors', 'option')) : the_row();
        $button_primary_color = get_sub_field('site_settings_button_primary_color');
        $button_secondary_color = get_sub_field('site_settings_button_secondary_color');
        $button_outline_color = get_sub_field('site_settings_button_outline_color');
    endwhile;
endif;

if (have_rows('site_settings_button_colors', 'option')) :
    while (have_rows('site_settings_button_colors', 'option')) : the_row();
        $button_primary_color = get_sub_field('site_settings_button_primary_color');
        $button_secondary_color = get_sub_field('site_settings_button_secondary_color');
        $button_outline_color = get_sub_field('site_settings_button_outline_color');
    endwhile;
endif;

if (have_rows('site_settings_button_style', 'option')) :
    while (have_rows('site_settings_button_style', 'option')) : the_row();
        $button_border_radius = get_sub_field('site_settings_button_border_radius');
    endwhile;
endif;

function get_contrast_color($color)
{
    list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
    $luminance = 0.2126 * pow($r / 255, 2.2) + 0.7152 * pow($g / 255, 2.2) + 0.0722 * pow($b / 255, 2.2);
    return ($luminance > 0.5) ? '#292929' : '#ffffff';
}

function darken_color($color)
{
    $percentage = 10;

    list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
    $percentage = 1 - ($percentage / 100);
    $r *= $percentage;
    $g *= $percentage;
    $b *= $percentage;
    // Ensure values are within range
    $r = max(0, min(255, $r));
    $g = max(0, min(255, $g));
    $b = max(0, min(255, $b));
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}
?>

<style>
    :root {
        --primary-color: <?php echo esc_attr($primary_color); ?>;
        --secondary-color: <?php echo esc_attr($secondary_color); ?>;
        --tertiary-color: <?php echo esc_attr($tertiary_color); ?>;
        --black: <?php echo esc_attr($black); ?>;
        --white: <?php echo esc_attr($white); ?>;

        --paragraph-color: <?php echo esc_attr($paragraph_color); ?>;
        --title-color: <?php echo esc_attr($title_color); ?>;
        --link-color: <?php echo esc_attr($link_color); ?>;

        --button-primary-color: <?php echo esc_attr($button_primary_color); ?>;
        --button-secondary-color: <?php echo esc_attr($button_secondary_color); ?>;
        --button-outline-color: <?php echo esc_attr($button_outline_color); ?>;

        --button-primary-text-color: <?php echo get_contrast_color(esc_attr($button_primary_color)); ?>;
        --button-secondary-text-color: <?php echo get_contrast_color(esc_attr($button_secondary_color)); ?>;
        --button-outline-text-color: <?php echo get_contrast_color(esc_attr($button_outline_color)); ?>;

        --button-primary-hover-color: <?php echo darken_color(esc_attr($button_primary_color)); ?>;
        --button-secondary-hover-color: <?php echo darken_color(esc_attr($button_secondary_color)); ?>;
        --button-outline-hover-color: <?php echo darken_color(esc_attr($button_outline_color)); ?>;

        --button-border-radius: <?php echo esc_attr($button_border_radius) . 'px'; ?>;
    }
</style>

