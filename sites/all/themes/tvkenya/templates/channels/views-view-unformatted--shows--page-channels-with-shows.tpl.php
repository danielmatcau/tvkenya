<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
  $now = date('Y-m-d H:i', time());
  $class = 'all-shows';
  if ($id > 2) {
    $class = 'four-shows';
  }
?>
<div class="group-channels">
  <?php if (!empty($title)): ?>
    <?php print '<h2 class="channel-title ' . $class .'">' . $title . '</h2>'; ?>
  <?php endif; ?>

  <?php if ($id <= 2): ?>
    <?php foreach ($rows as $id => $row): ?>
      <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
        <?php print $row; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="full-schedule">
      <?php foreach ($rows as $id => $row): ?>
        <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
          <?php print $row; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="custom-schedule">
      <?php $i = 1;?>
      <?php foreach ($rows as $id => $row): ?>
        <?php if($view->result[$id]->field_field_show_date_2[0]['raw']['value2'] > strtotime($now)): ?>
          <?php if($i < 3): ?>
            <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
              <?php print $row; ?>
            </div>
          <?php endif; ?>
          <?php $i++; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>