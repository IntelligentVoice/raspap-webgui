<?php

define('RASPI_CONFIG', '/etc/raspap');
define('RASPI_CONFIG_NETWORKING',RASPI_CONFIG.'/networking');
define('RASPI_ADMIN_DETAILS', RASPI_CONFIG.'/raspap.auth');
define('RASPI_RECORDING_DETAILS', RASPI_CONFIG.'/recorder/recording.conf');
define('RASPI_RECORDING_GATEWAY', RASPI_CONFIG.'/recorder/gateway.conf');
define('RASPI_RECORDING_IV_SERVER', RASPI_CONFIG.'/recorder/iv.conf');
define('RASPI_RECORDING_AUTH', RASPI_CONFIG.'/recorder/auth.conf');
define('RASPI_WIFI_CLIENT_INTERFACE', 'wlan0');

// Constants for configuration file paths.
// These are typical for default RPi installs. Modify if needed.
define('RASPI_DNSMASQ_CONFIG', '/etc/dnsmasq.conf');
define('RASPI_DNSMASQ_LEASES', '/var/lib/misc/dnsmasq.leases');
define('RASPI_HOSTAPD_CONFIG', '/etc/hostapd/hostapd.conf');
define('RASPI_WPA_SUPPLICANT_CONFIG', '/etc/wpa_supplicant/wpa_supplicant.conf');
define('RASPI_HOSTAPD_CTRL_INTERFACE', '/var/run/hostapd');
define('RASPI_WPA_CTRL_INTERFACE', '/var/run/wpa_supplicant');
define('RASPI_OPENVPN_CLIENT_CONFIG', '/etc/openvpn/client.conf');
define('RASPI_OPENVPN_SERVER_CONFIG', '/etc/openvpn/server.conf');
define('RASPI_TORPROXY_CONFIG', '/etc/tor/torrc');

// Optional services, set to true to enable.
define('RASPI_HOTSPOT_ENABLED', true );
define('RASPI_NETWORK_ENABLED', true );
define('RASPI_DHCP_ENABLED', true );
define('RASPI_OPENVPN_ENABLED', false );
define('RASPI_TORPROXY_ENABLED', false );
define('RASPI_CONFAUTH_ENABLED', true );
define('RASPI_CHANGETHEME_ENABLED', true );
define('RASPI_RECCONF_ENABLED', true );

?>
