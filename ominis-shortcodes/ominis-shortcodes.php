<?php 
/**
* Plugin Name: Ominis Shortcodes
* Plugin URI: http://onaweb.cat
* Description: Plugin to interpret shortcodes and create Bootstrap structures.
* Version: 2.0.0
* Author: Onaweb
* Author URI: http://onaweb.cat
* Domain Path: /languages
**/

// Add menu item
add_action('admin_menu', 'ominis_shortcodes_menu');

// Config menu item 
function ominis_shortcodes_menu(){
        add_menu_page( __('Ominis Shortcodes Instructions','ominis-shortcodes'), __('O Shortcodes','ominis-shortcodes'), 'manage_options', 'ominis-shortcodes', 'ominis_shortcodes_instrucciones', 'dashicons-hammer', 75 );
		//add_submenu_page ( 'tools.php', 'Ominis Shortcodes Instrucciones', 'Ominis Shortcodes', 'manage_options', 'ominis-shortcodes', 'ominis_shortcodes_instrucciones', 'dashicons-hammer' );
}

// Content of welcome page with instructions
function ominis_shortcodes_instrucciones() {
?>
	<div class="wrap">
		<h2><?php _e('Ominis Shortcodes: Instructions <small>2.0.0</small>','ominis-shortcodes');?></h2>
		

		<p><?php _e('You have three [shortcodes] available to generate the Bootstrap 5 <em>card</em> component:','ominis-shortcodes');?></p>
		<dl>
			<dt style="font-weight:bold;">[panel]...[/panel]</dt>
			<dd><?php _e('This shortcode opens and closes the <em>card</em> component.','ominis-shortcodes');?></dd>
			
			<dt style="font-weight:bold;">[panel_texto]...[/panel_texto]</dt>
			<dd><?php _e('Inside [panel], This shortcode opens and closes the text area.','ominis-shortcodes');?></dd>
			
			<dt style="font-weight:bold;">[panel_img]...[/panel_img]</dt>
			<dd><?php _e('Inside [panel], this shortcode opens and closes the area for images.','ominis-shortcodes');?></dd>
			
		</dl>
	</div>
<?php	
}

 /**
 * SHORTCODE OPTIONS.
 */
//[panel]
function panel_func( $atts, $content = null){
	$texto = "<dl class=\"card\">" . str_replace("<br />","",do_shortcode($content)) ."</dl>";
	return $texto;
}
add_shortcode( 'panel', 'panel_func' );

//[panel_texto]
function panel_texto_func( $atts, $content = null){
	$texto = "<dd class=\"card-body text-justify\">" . do_shortcode($content) ."</dd>";
	return $texto;
}
add_shortcode( 'panel_texto', 'panel_texto_func' );

//[panel_img]
function panel_img_func( $atts, $content = null){	
	$texto = "<dt class=\"card-footer\">" . do_shortcode($content) ."</dt>";
	return $texto;
}
add_shortcode( 'panel_img', 'panel_img_func' );
