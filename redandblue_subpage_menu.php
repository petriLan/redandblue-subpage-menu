<?php
/**
 * Plugin Name: redandblue subpage menu
 * Plugin URI: https://github.com/redandbluefi/redandblue-subpage-menu
 * Description: Building a simple hierarchical (sidebar) menu for pages with parents / child.
 * Version: 0.1.0
 * Author: Red & Blue Oy, Eemeli Makkonen
 * Author URI: https://www.redandblue.fi
 * Requires at least: 4.4.2
 * Tested up to: 4.9
 *
 * Text Domain: redandblue-subpage-menu
 * Domain Path: /languages
*/

function get_subpage_menu($post_type, $nav_title = NULL) {
  if (is_page() || get_post_type() == $post_type) {
    global $post;

      if ($post->post_parent) {
        $ancestors = get_ancestors($post->ID, get_post_type());
        $parent = $ancestors[count($ancestors) - 1];
      }
      else {
        $parent = $post->ID;
      }


      $nav_title_visible = false;

      if($nav_title == TRUE) {
        $nav_title_visible = get_the_title($parent);
      }

      $opts = [
        'echo' => false,
        'child_of' => $parent,
        'title_li' => '<span>' . $nav_title_visible .'</span>',
        'post_type' => get_post_type()
      ];
      return wp_list_pages($opts);
  }
}
?>
