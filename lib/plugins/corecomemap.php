<?php
/* Plugin Name: CoreCom Map
Plugin URI: N/A
Description: Displays an interactive map for the CoreCom Office location
Version: 1.0
Author: Lloyd Johnson
Author URI: github.com/ljohnso16
*/ 

class CoreComMap extends WP_Widget {
          function CoreComMap() {
                    $widget_ops = array(
                    'classname' => 'CoreComMap',
                    'description' => 'Displays an interactive map for the CoreCom Office location'
          );

          $this->WP_Widget(
                    'CoreComMap',
                    'CoreCom Map',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme
print <<<EOM

<div style="width:500px;overflow:hidden;height:500px;max-width:100%;"><div id="embed-map-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=8579+Criterion+Dr,+Colorado+Springs,+CO+80920&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="google-map-code-enabler" rel="nofollow" href="http://www.interserver-coupons.com" id="enable-map-info">http://www.interserver-coupons.com</a><style>#embed-map-canvas img{max-width:none!important;background:none!important;font-size: inherit;}</style></div>
<script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=b0357168-c94e-9a85-0328-2cda9fe12320&c=google-map-code-enabler&u=1478577408" defer="defer" async="async"></script>
EOM;
                    echo $after_widget; // post-widget code from theme
          }
}

add_action(
          'widgets_init',
          create_function('','return register_widget("CoreComMap");')
);
?>