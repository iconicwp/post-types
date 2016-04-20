<?php

if( class_exists( 'Iconic_Helper_Post_Types' ) )
    return;

/**
 * Helper Class for dealing with Post Types
 *
 * @version 1.0.1
 * @author  James Kemp
 */

class Iconic_Helper_Post_Types {

    /**
     * Array of all post types registered by this plugin
     *
     * @since 1.0.0
     * @var array $registered
     */
    public $registered = array();

    /**
     * Method: Add
     *
     * @since 1.0.0
     * @param array $options
     */
    public function add( $options ) {

        $defaults = array(
            "plural" => "",                         // !required
            "singular" => "",                       // !required
            "key" => false,                         // !required
            "rewrite_slug" => false,                // !recommended if has frontend visibility
            "rewrite_with_front" => false,
            "rewrite_feeds" => true,
            "rewrite_pages" => true,
            "menu_icon" => "dashicons-admin-post",
            'hierarchical' => false,
            'supports' => array( 'title' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'capability_type' => 'post'
        );

        $options = wp_parse_args( $options, $defaults );

        if( $options['key'] ) {

            $labels = array(
                'name' => $options['plural'],
                'singular_name' => $options['singular'],
                'add_new' => _x( 'Add New', 'iconic-advanced-layered-nav' ),
                'add_new_item' => _x( sprintf('Add New %s', $options['singular']), 'iconic-advanced-layered-nav' ),
                'edit_item' => _x( sprintf('Edit %s', $options['singular']), 'iconic-advanced-layered-nav' ),
                'new_item' => _x( sprintf('New %s', $options['singular']), 'iconic-advanced-layered-nav' ),
                'view_item' => _x( sprintf('View %s', $options['singular']), 'iconic-advanced-layered-nav' ),
                'search_items' => _x( sprintf('Search %s', $options['plural']), 'iconic-advanced-layered-nav' ),
                'not_found' => _x( sprintf('No %s found', strtolower($options['plural'])), 'iconic-advanced-layered-nav' ),
                'not_found_in_trash' => _x( sprintf('No %s found in Trash', strtolower($options['plural'])), 'iconic-advanced-layered-nav' ),
                'parent_item_colon' => _x( sprintf('Parent %s:', $options['singular']), 'iconic-advanced-layered-nav' ),
                'menu_name' => $options['plural']
            );

            $args = array(
                'labels'                => $labels,
                'hierarchical'          => $options['hierarchical'],
                'supports'              => $options['supports'],
                'public'                => $options['public'],
                'show_ui'               => $options['show_ui'],
                'show_in_menu'          => $options['show_in_menu'],
                'menu_icon'             => $options['menu_icon'],
                'show_in_nav_menus'     => $options['show_in_nav_menus'],
                'publicly_queryable'    => $options['publicly_queryable'],
                'exclude_from_search'   => $options['exclude_from_search'],
                'has_archive'           => $options['has_archive'],
                'query_var'             => $options['query_var'],
                'can_export'            => $options['can_export'],
                'capability_type'       => $options['capability_type'],
                'rewrite'               => false
            );

            if( $options['rewrite_slug'] ) {

                $args['rewrite'] = array(
                    "slug" => $options['rewrite_slug'],
                    "with_front" => $options['rewrite_with_front'],
                    "feeds" => $options['rewrite_feeds'],
                    "pages" => $options['rewrite_pages']
                );

            }

            $post_type = register_post_type( $options['key'], $args );

            $this->registered[] = $post_type;

        }

    }

}
