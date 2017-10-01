<?php

function gtid_get_option( $key ) {
	if (!defined('FW')) return $key;
	return fw_get_db_settings_option( $key );
}

function gtid_option($key) {
	genesis_option($key, RT_SETTINGS_FIELD);
}

?>