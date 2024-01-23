<?php
/**
 * Plugin Name: Eassential Addons Pro Widgets Marker
 * Description: Identify pro widgets at your Essentials Addons Dashboard
 * Author: Jakaria Istauk
 * Version: 1.0.0
 * Author URI: https://profiles.wordpress.org/jakariaistauk/
 */

 if( is_admin() ){
    add_filter( 'add_eael_elementor_addons', function( $elements ){

        update_option( '_eael_widget_lists_for_dashboard_identify', $elements );

        return $elements;
    } );

    add_action( 'admin_footer', function(){
        if( isset( $_GET['page'] ) && $_GET['page'] === 'eael-settings' ){
            $elements_set = get_option( '_eael_widget_lists_for_dashboard_identify' );
            $class_name = "eael-pro-widget";
            if( is_array( $elements_set ) && !empty( $elements_set ) ){
                echo "<script>";
                foreach( $elements_set as $elements ){
                    foreach( $elements[ 'elements' ] as $element ){
                        if( isset( $element['is_pro'] ) && $element['is_pro'] ){
                            echo "jQuery('#{$element['key']}').closest('.eael-element__item').addClass('{$class_name}');";
                        }
                    }
                }
                echo "</script>";
            }

            $extensions_set = [
                'eael-pro-extensions' => [
                    'title'      => __( 'Premium Extensions', 'essential-addons-for-elementor-lite' ),
                    'extensions' => [
                        [
                            'key'       => 'section-parallax',
                            'is_pro'    => true
                        ],
                        [
                            'key'       => 'section-particles',
                            'is_pro'    => true
                        ],
                        [
                            'key'       => 'tooltip-section',
                            'is_pro'    => true
                        ],
                        [
                            'key'       => 'content-protection',
                            'is_pro'    => true,
                            'promotion' => 'popular'
                        ],
                        [
                            'key'       => 'reading-progress',
                        ],
                        [
                            'key'       => 'table-of-content',
                        ],
                        [
                            'key'       => 'post-duplicator',
                        ],
                        [
                            'key'       => 'custom-js',
                        ],
                        [
                            'key'       => 'xd-copy',
                            'is_pro'    => true,
                            'promotion' => 'new'
                        ],
                        [
                            'key'       => 'scroll-to-top',
                        ],
                        [
                            'key'       => 'conditional-display',
                            'is_pro'    => true,
                            'promotion' => 'new'
                        ],
                        [
                            'key'       => 'wrapper-link',
                            'promotion' => 'new'
                        ],
                    ]
                ]
            ];
            if( is_array( $extensions_set ) && !empty( $extensions_set ) ){
                echo "<script>";
                foreach( $extensions_set as $extensions ){
                    foreach( $extensions[ 'extensions' ] as $extension ){
                        if( isset( $extension['is_pro'] ) && $extension['is_pro'] ){
                            echo "jQuery('#{$extension['key']}').closest('.eael-element__item').addClass('{$class_name}');";
                        }
                    }
                }
                echo "</script>";
            }

            echo "<style>";
            echo ".{$class_name}{
                    position: relative;
                    border: 1px solid #c36 !important;
                }
                .{$class_name}:before{
                    content: 'PRO';
                    position: absolute;
                    top: 30%;
                    left: -9px;
                    transform: rotate(90deg);
                    color: #fff;
                    background: #c36;
                    line-height: 1;
                    padding: 2px;
                    border-radius: 3px;
                    font-weight: bold;
                }";
            echo "</style>";
        }
    } );
}