<?php
/*
Plugin Name: WC Hide Other Shipping Options
Version: 1.0.1
Plugin URI: https://github.com/GaganTiwari/
Description: Hide Other Shipping Options when Free Shipping is available in woocommerce.
Author: Gagan Tiwari
Author URI: http://www.gagantiwari.info/
License: GPL v3

WC Hide Other Shipping Options when Free Shipping is available
Copyright (C) 2013, https://github.com/GaganTiwari/

*/

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */

function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );