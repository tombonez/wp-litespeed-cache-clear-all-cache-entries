<?php

/**
 * Plugin Name:  WP LiteSpeed Cache - Clear All Cache Entries (WP CLI)
 * Plugin URI:   https://github.com/tombonez/wp-litespeed-cache-clear-all-cache-entries
 * Description:  A WordPress CLI plugin for clearing all LiteSpeed cache entries.
 * Version:      1.0.0
 * Author:       Tom Taylor
 * Author URI:   https://github.com/tombonez
 */

namespace WPLiteSpeedCacheClearAllCacheEntries;

function clear_cache_entries() {
	\WP_CLI::add_command(
		'litespeed-clear-cache',
		function() {
			if (
				method_exists( 'Litespeed\Purge', 'purge_all' ) &&
				is_callable( array( 'Litespeed\Purge', 'purge_all' ) )
			) {
				define( 'LSWCP_EMPTYCACHE', true );
				\Litespeed\Purge::purge_all();
			} else {
				\WP_CLI::error( 'An error has occured.' );
			}
		}
	);
}
add_action( 'cli_init', __NAMESPACE__ . '\\clear_cache_entries' );
