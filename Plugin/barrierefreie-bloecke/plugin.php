<?php
/**
 * Plugin Name: Barrierefreie Blöcke
 * Plugin URI: 
 * Description: Dieses Plugin ersetzt die standardmößigen Blöcke "Überschrift", "Video", "Audio" und "Tabelle" und stellt stattdessen Blöcke mit erweiterten Funktionen zur Verfügung. Diese Blöcke ermöglichen eine Barrierefreie Ausgabe der erstellten Inhalte.
 * Author: benediktengel
 * Author URI: 
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package barrierefreie-bloecke
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
