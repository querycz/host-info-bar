<?php

/**
 * Plugin Name: Host Info Bar
 * Description: Adds basic host info bar
 * Version: 1.2.0
 * Author: Query
 * Author uri: https://www.query.cz
 */

function host_info_bar()
{
	if (substr($_SERVER['REMOTE_ADDR'], 0, 4) == '127.' || substr($_SERVER['REMOTE_ADDR'], 0, 4) == '172.' || substr($_SERVER['REMOTE_ADDR'], 0, 4) == '192.' || $_SERVER['REMOTE_ADDR'] == '::1') { ?>
		<style>
			.host-info-bar {
				font: 12px monospace;
				color: #fff;
				position: fixed;
				left: 0;
				bottom: 0;
				background: rgba(255, 0, 0, 0.7);
				padding: 2px 32px 2px 8px;
				border-radius: 0 8px 0 0;
				line-height: 2;
				letter-spacing: 1px;
				z-index: 100000;
				text-align: left;
			}

			.host-info-bar-close {
				cursor: pointer;
				position: absolute;
				top: 2px;
				right: 4px;
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
		echo ' &nbsp; ';
		echo '🐘 ' . PHP_VERSION;
		echo ' &nbsp; ❔';
		echo get_num_queries() . ' queries';
		echo ' &nbsp; ⏱ ';
		timer_stop(1);
		echo '<br>';
		echo body_class();
		echo '<span class="host-info-bar-close">✖️</span>';
		echo '</span>';
	}
}
add_action('wp_footer', 'host_info_bar', 100);
// add_action('admin_footer', 'host_info_bar');
