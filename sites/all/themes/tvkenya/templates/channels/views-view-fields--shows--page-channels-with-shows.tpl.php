<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
  $time = strip_tags($fields['field_show_date']->content);
  $title = strip_tags($fields['title']->content);
  $description = strip_tags($fields['body']->content);
  if (!empty($description)) {
    $title = l($title, 'node/' . $row->nid, array('attributes' => array('class' => 'overlay-link title')));
    $details = l('Overlay', 'node/' . $row->nid, array('attributes' => array('class' => 'overlay-link')));
  }
  $now = date('Y-m-d H:i', time());
  $show_time = strip_tags($fields['field_show_date_2']->content);
  $show_time = explode('to', $show_time);
  $time_class = 'future-time';
  if ((strtotime($show_time[0]) < strtotime($now)) && (strtotime($show_time[1]) < strtotime($now))) {
    $time_class = 'past-time';
  }
  if ((strtotime($now) >= strtotime($show_time[0])) && (strtotime($now) <= strtotime($show_time[1]))) {
    $time_class = 'current-time';
  }
?>
<div class="tv-show clearfix <?php print $time_class; ?>">
  <div class="show-time"><?php print $time; ?></div>
  <div class="show-title"><?php print $title; ?></div>
  <?php if (!empty($description)): ?>
    <div class="show-details"><?php print $details; ?></div>
  <?php endif; ?>
</div>