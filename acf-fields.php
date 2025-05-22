<?php
if (!defined('ABSPATH')) exit;

add_action('acf/init', 'register_flexible_content_fields');
function remove_default_post_content_editor()
{
    remove_post_type_support('page', 'editor');

}
add_action('init', 'remove_default_post_content_editor');


function get_global_settings_fields($layout_name)
{
    return [
        [
            'key' => 'field_' . $layout_name . '_accordion',
            'label' => 'Opties',
            'name' => 'opties',
            'type' => 'accordion',
            'instructions' => '',
            'required' => 0,
            'wrapper' => ['width' => '100'],
            'open' => 0,
            'multi_expand' => 1,
            'endpoint' => 0
        ],
        [
            'key' => 'field_' . $layout_name . '_spacing_settings',
            'label' => 'Spacing',
            'name' => 'spacing_settings',
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => [
                [
                    'key' => 'field_' . $layout_name . '_padding_top',
                    'label' => 'Padding top',
                    'name' => 'padding_top',
                    'type' => 'range',
                    'wrapper' => ['width' => '25'],
                    'min' => 0,
                    'max' => 200,
                    'default_value' => 80,
                    'step' => 1
                ],
                [
                    'key' => 'field_' . $layout_name . '_padding_bottom',
                    'label' => 'Padding bottom',
                    'name' => 'padding_bottom',
                    'type' => 'range',
                    'wrapper' => ['width' => '25'],
                    'min' => 0,
                    'max' => 200,
                    'default_value' => 80,
                    'step' => 1
                ],
                [
                    'key' => 'field_' . $layout_name . '_content_width',
                    'label' => 'Content breedte',
                    'name' => 'content_width',
                    'type' => 'true_false',
                    'wrapper' => ['width' => '50'],
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Container',
                    'ui_off_text' => 'Full'
                ]
            ]
        ],
        [
            'key' => 'field_' . $layout_name . '_colors_settings',
            'label' => 'Kleuren',
            'name' => 'colors_settings',
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => [
                [
                    'key' => 'field_' . $layout_name . '_background_color',
                    'label' => 'Achtergrond kleur',
                    'name' => 'background_color',
                    'type' => 'color_picker',
                    'wrapper' => ['width' => '50']
                ]
            ]
        ],
        [
            'key' => 'field_' . $layout_name . '_image_settings',
            'label' => 'Afbeelding instellingen',
            'name' => 'image_settings',
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => [
                [
                    'key' => 'field_' . $layout_name . '_image_fit',
                    'label' => 'Afbeelding fit',
                    'name' => 'image_fit',
                    'type' => 'radio',
                    'choices' => [
                        'cover' => 'Cover',
                        'contain' => 'Contain',
                        'cover-height' => 'Cover - Hoogte',
                        'contain-height' => 'Contain - Hoogte'
                    ],
                    'wrapper' => ['width' => '33']
                ],
                [
                    'key' => 'field_' . $layout_name . '_lazy_loading',
                    'label' => 'Lazy loading',
                    'name' => 'lazy_loading',
                    'type' => 'true_false',
                    'default_value' => 1,
                    'ui' => 1,
                    'wrapper' => ['width' => '33']
                ],
                [
                    'key' => 'field_' . $layout_name . '_max_image_height',
                    'label' => 'Maximale afbeelding hoogte',
                    'name' => 'max_image_height',
                    'type' => 'range',
                    'wrapper' => ['width' => '33']
                ]
            ]
        ]
    ];
}
function register_flexible_content_fields()
{
    if (function_exists('acf_add_local_field_group')):

        acf_add_local_field_group([
            'key' => 'group_page_builder',
            'title' => 'Page Builder',
            'fields' => [
                [
                    'key' => 'field_page_builder',
                    'label' => 'Content Blocks',
                    'name' => 'content_blocks',
                    'type' => 'flexible_content',
                    'button_label' => 'Add Block',
                    'layouts' => [
                        // Hero Block
                        'layout_hero' => [
                            'key' => 'layout_hero',
                            'name' => 'hero',
                            'label' => 'Hero',
                            'display' => 'block',
                            'sub_fields' => array_merge(
                                [
                                    [
                                        'key' => 'field_hero_column_1',
                                        'label' => '',
                                        'name' => 'column_left',
                                        'type' => 'group',
                                        'wrapper' => ['width' => 50],
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_hero_image',
                                                'label' => 'Background Image',
                                                'name' => 'image',
                                                'type' => 'image',
                                                'return_format' => 'array',
                                                'preview_size' => 'medium',
                                                'wrapper' => ['width' => 100]
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_hero_column_2',
                                        'label' => '',
                                        'name' => 'column_right',
                                        'type' => 'group',
                                        'wrapper' => ['width' => 50],
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_hero_title',
                                                'label' => 'Title',
                                                'name' => 'title',
                                                'type' => 'text',
                                                'wrapper' => ['width' => 100]
                                            ],
                                            [
                                                'key' => 'field_hero_text',
                                                'label' => 'Text',
                                                'name' => 'text',
                                                'type' => 'textarea',
                                                'wrapper' => ['width' => 100]
                                            ],
                                            [
                                                'key' => 'field_hero_button',
                                                'label' => 'Button',
                                                'name' => 'button',
                                                'type' => 'link',
                                                'return_format' => 'array',
                                                'wrapper' => ['width' => 100]
                                            ]
                                        ]
                                    ]
                                ],
                                get_global_settings_fields('hero')
                            )
                        ],
                        // Text Block

                        'layout_text' => [
                            'key' => 'layout_text',
                            'name' => 'text',
                            'label' => 'Text Block',
                            'display' => 'block',
                            'sub_fields' => array_merge(
                                [
                                    [
                                        'key' => 'field_text_column_layout',
                                        'label' => 'Column Layout',
                                        'name' => 'column_layout',
                                        'type' => 'select',
                                        'choices' => [
                                            '1' => '1 Column',
                                            '2' => '2 Columns',
                                            '3' => '3 Columns'
                                        ],
                                        'default_value' => '1',
                                        'wrapper' => ['width' => 100]
                                    ],
                                    [
                                        'key' => 'field_text_content_1',
                                        'label' => 'Column 1',
                                        'name' => 'content_1',
                                        'type' => 'wysiwyg',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'wrapper' => [
                                            'width' => 100,
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_text_column_layout',
                                                    'operator' => '==',
                                                    'value' => '1'
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_text_content_1_half',
                                        'label' => 'Column 1',
                                        'name' => 'content_1',
                                        'type' => 'wysiwyg',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'wrapper' => [
                                            'width' => 50,
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_text_column_layout',
                                                    'operator' => '==',
                                                    'value' => '2'
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_text_content_1_third',
                                        'label' => 'Column 1',
                                        'name' => 'content_1',
                                        'type' => 'wysiwyg',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'wrapper' => [
                                            'width' => 33,
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_text_column_layout',
                                                    'operator' => '==',
                                                    'value' => '3'
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_text_content_2_half',
                                        'label' => 'Column 2',
                                        'name' => 'content_2',
                                        'type' => 'wysiwyg',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'wrapper' => [
                                            'width' => 50,
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_text_column_layout',
                                                    'operator' => '==',
                                                    'value' => '2'
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_text_content_2_third',
                                        'label' => 'Column 2',
                                        'name' => 'content_2',
                                        'type' => 'wysiwyg',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'wrapper' => [
                                            'width' => 33,
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_text_column_layout',
                                                    'operator' => '==',
                                                    'value' => '3'
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_text_content_3',
                                        'label' => 'Column 3',
                                        'name' => 'content_3',
                                        'type' => 'wysiwyg',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'wrapper' => [
                                            'width' => 33,
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_text_column_layout',
                                                    'operator' => '==',
                                                    'value' => '3'
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                get_global_settings_fields('text')
                            )
                        ],


                        //post archive
                        'layout_post_archive' => [
                            'key' => 'layout_post_archive',
                            'name' => 'post_archive',
                            'label' => 'Post Archive',
                            'display' => 'block',
                            'sub_fields' => array_merge(
                                [
                                    [
                                        'key' => 'field_post_archive_settings',
                                        'label' => 'Post Settings',
                                        'name' => 'post_settings',
                                        'type' => 'group',
                                        'wrapper' => ['width' => 100],
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_post_archive_posts_per_page',
                                                'label' => 'Posts per page',
                                                'name' => 'posts_per_page',
                                                'type' => 'number',
                                                'default_value' => 12,
                                                'min' => 1,
                                                'max' => 24,
                                                'wrapper' => ['width' => 50]
                                            ],
                                            [
                                                'key' => 'field_post_archive_columns',
                                                'label' => 'Columns',
                                                'name' => 'columns',
                                                'type' => 'select',
                                                'choices' => [
                                                    '2' => '2 Columns',
                                                    '3' => '3 Columns',
                                                    '4' => '4 Columns'
                                                ],
                                                'default_value' => '3',
                                                'wrapper' => ['width' => 50]
                                            ]
                                        ]
                                    ]
                                ],
                                get_global_settings_fields('post_archive')
                            )
                        ],
                    ]
                ]
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page'
                    ]
                ]
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'show_in_rest' => 0,
        ]);
    endif;
}
