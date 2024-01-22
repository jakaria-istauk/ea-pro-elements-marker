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
            if( is_array( $elements_set ) && !empty( $elements_set ) ){
                echo "<script>";
                foreach( $elements_set as $elements ){
                    foreach( $elements[ 'elements' ] as $element ){
                        if( isset( $element['is_pro'] ) && $element['is_pro'] ){
                            echo "jQuery('#{$element['key']}').closest('.eael-element__item').addClass('eael-pro-widget');";
                        }
                    }
                }
                echo "</script>";
            }
        }
    } );
}