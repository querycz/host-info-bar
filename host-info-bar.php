<?php

/**
 * Plugin Name: Host Info Bar
 * Description: Adds basic host info bar
 * Version: 1.0.1
 * Author: Query
 * Author uri: https://www.query.cz
 */

function host_info_bar() {
	if ( substr( $_SERVER['REMOTE_ADDR'], 0, 4 ) == '127.' || $_SERVER['REMOTE_ADDR'] == '::1' ) { ?>
		<style>
			.host-info-bar {
				font: 12px monospace;
				color: #fff;
				position: fixed;
				left: 0;
				bottom: 0;
				background: rgba(255,0,0,0.7);
				padding: 2px 10px;
				border-radius: 0 5px 0 0;
				line-height: 2;
				letter-spacing: 1px;
				z-index: 100000;
				text-align: left;
			}
			.host-info-bar-close {
				cursor: pointer;
				position: relative;
				top: 2px;
				margin-left: 20px;
			}
		</style>
		<script>
			$(document).ready(function() {
				$('.host-info-bar-close').click(function() {
					$('.host-info-bar').slideUp();
				});
			});
		</script>
	<?php
		echo '<span class="host-info-bar">';
		echo '🛠 ' . $_SERVER['HTTP_HOST'];
		echo ' &nbsp; ';
		echo '🗄 ' . DB_NAME;
		echo '@';
		echo DB_HOST;
		echo ' &nbsp; ❔ ';
		echo get_num_queries().' queries' ;
		echo ' &nbsp; ⏱ ';
		timer_stop(1);
		echo '<span class="host-info-bar-close">✖️</span>';
		echo '</span>';
	}
}
add_action( 'wp_footer', 'host_info_bar', 100 );
// add_action( 'admin_footer', 'host_info_bar' );
