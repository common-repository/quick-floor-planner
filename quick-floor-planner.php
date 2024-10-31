<?php
/**
 * Plugin Name: Free Quick Floor Planner
 * Plugin URI: 
 * Description: Free Quick Floor Planner lets your visitors draw their own floor plan. To use it, just put the shortcode [quick-floor-planner] in one of your pages' content.
 * Version: 1.0
 * Author: Etienne Toriello
 * Author URI: https://www.linkedin.com/in/etienne-toriello-45395812/
 */


add_action('init', 'qfp_register_script');
function qfp_register_script(){
  wp_register_script( 'fabricjs', plugin_dir_url( __FILE__ ) .'/assets/fabric.min.js', true);
  wp_register_script( 'qfp_custom_js', plugin_dir_url( __FILE__ ) .'qfp-main.min.js', '2.0', true);
	wp_register_style( 'qfp_custom_js', plugin_dir_url( __FILE__ ) . 'qfp-styles.css', '3.0', true);
}

add_action('wp_enqueue_scripts', 'qfp_enqueue_style');
function qfp_enqueue_style(){
  wp_enqueue_script('fabricjs');
  wp_enqueue_script('jquery');
  wp_enqueue_script('qfp_custom_js');
	wp_enqueue_style( 'qfp_custom_js' );
}

function qfp_shortcode( $atts ){
    return '<div id="qfp">
    <div class="left">
      <div style="display: inline-block; margin-left: 10px; margin-right: 10px;">
        <h2>1. Add a floor plan.</h2>
        <p>Click on the canvas.</p>
        <p><small>(If items you\'ve put on top of your floor plan suddenly disappear, just click in a corner of the canvas.)</small></p>
        <h2>2. Add doors, walls and windows.</h2>
        <button id="qfp-addDoor" class="btn btn-info">Door</button><br>
        <button id="qfp-addWindow" class="btn btn-info">Window</button><br>
        <button id="qfp-addArc" class="btn btn-info">Arc</button><br>
        <button id="qfp-addLine" class="btn btn-info">Wall</button><br>

        <h2>3. Add shapes and furnitures.</h2>
        <button id="qfp-addRect" class="btn btn-info">Rectangle</button><br>
        <button id="qfp-addCircle" class="btn btn-info">Circle</button><br>
      </div>
    </div>
    <div class="right">
      <div class="section no-pad-bot no-pad-top">
        <input type="file" id="qfp-imageLoader" name="imageLoader" />
        <canvas id="qfp-canvas"></canvas>
      </div>
      <div style="display: flex; align-items: center; justify-content: center; margin-top:40px;">
        <span class="options-button"><button id="qfp-save" class="btn btn-info"><a id="qfp-lnkDownload" href="#">Download</a></button><br></span>

      </div>
    </div>
  </div>';
}
add_shortcode( 'quick-floor-planner', 'qfp_shortcode' );