<?php

/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 *
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "adaptivetheme_subtheme" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "adaptivetheme_subtheme".
 * 2. Uncomment the required function to use.
 */


/**
 * Preprocess variables for the html template.
 */
/* -- Delete this line to enable.
function adaptivetheme_subtheme_preprocess_html(&$vars) {
  global $theme_key;

  // Two examples of adding custom classes to the body.

  // Add a body class for the active theme name.
  // $vars['classes_array'][] = drupal_html_class($theme_key);

  // Browser/platform sniff - adds body classes such as ipad, webkit, chrome etc.
  // $vars['classes_array'][] = css_browser_selector();

}
// */


/**
 * Process variables for the html template.
 */
/* -- Delete this line if you want to use this function
function adaptivetheme_subtheme_process_html(&$vars) {
}
// */


/**
 * Override or insert variables for the page templates.
 */
function tvkenya_preprocess_page(&$vars) {
}

/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_process_page(&$vars) {
}
// */


/**
 * Override or insert variables into the node templates.
 */
function tvkenya_preprocess_node(&$vars) {
  $function_name = 'tvkenya_preprocess_node_' . $vars['type'];
  if (function_exists($function_name)) {
    $function_name($vars);
  }
  $vars['classes_array'][] = 'node-' . $vars['type'] . '-' . $vars['view_mode'];
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
}

function tvkenya_preprocess_node_show(&$vars) {
  switch ($vars['view_mode']) {
    case 'full':
      if (isset($vars['field_channel'])) {
        $channel = $vars['field_channel'][0]['entity'];
        if (isset($channel->field_channel_image)) {
          $vars['channel'] = '<img src="' . image_style_url('popup_channel', $channel->field_channel_image[LANGUAGE_NONE][0]['uri']) . '" title="' . $channel->title . '" />';
        }
        else {
          $vars['channel'] = $channel->title;
        }
      }
      if (isset($vars['field_show_date'])) {
        $show_start = $vars['field_show_date'][0]['value'];
        $show_end = $vars['field_show_date'][0]['value2'];
        if (date('Y', $show_start) == date('Y', $show_end)) {
          $start_end_datetime = date('Y', $show_start);
          if (date('F', $show_start) == date('F', $show_end)) {
            $start_end_datetime = date('F', $show_start) . ' ' . $start_end_datetime;
            if (date('j', $show_start) == date('j', $show_end)) {
              $start_end_datetime = date('j', $show_start) . ' ' . $start_end_datetime;
              if (date('j', $show_start) == date('j')) {
                $start_end_datetime = t('Today') . ', ' . $start_end_datetime;
              }
              elseif (date('j', $show_start) == date('j') + 1) {
                $start_end_datetime = t('Tomorrow') . ', ' . $start_end_datetime;
              }
              elseif (date('j', $show_start) == date('j') - 1) {
                $start_end_datetime = t('Yesterday') . ', ' . $start_end_datetime;
              }
              $start_end_datetime = date('H:i', $show_start) . ' - ' . date('H:i', $show_end) . ' ' . $start_end_datetime;
            }
            else { // different days
              $start_end_datetime = $start_end_datetime = date('H:i j', $show_start) . ' - ' . date('H:i j', $show_end) . $start_end_datetime;
            }
          }
          else { // different months
            $start_end_datetime = $start_end_datetime = date('H:i j F', $show_start) . ' - ' . date('H:i j F', $show_end) . $start_end_datetime;
          }
        }
        $vars['start_end_datetime'] = $start_end_datetime;
      }
      if (isset($vars['body'][0]['safe_value'])) {
        $vars['description'] = $vars['body'][0]['safe_value'];
      }
      if (isset($vars['field_show_image'])) {
        $vars['image'] = '<img src="' . image_style_url('popup_show', $vars['field_show_image'][0]['uri']) . '" title="' . $vars['title'] . '" />';
      }
      if (isset($vars['content']['navigation'])) {
        $vars['navigation'] = $vars['content']['navigation']['#markup'];
      }
      if (isset($vars['content']['facebook_comments'])) {
        $vars['comments'] = $vars['content']['facebook_comments']['#markup'];
      }
      if (isset($vars['content']['social_share'])) {
        $vars['social_links'] = $vars['content']['social_share']['#markup'];
      }
      if (isset($vars['content']['ad'])) {
        $vars['ad'] = $vars['content']['ad']['#markup'];
      }
      break;

    default:
      break;
  }
}

/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_comment(&$vars) {
}
function adaptivetheme_subtheme_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_block(&$vars) {
}
function adaptivetheme_subtheme_process_block(&$vars) {
}
// */
