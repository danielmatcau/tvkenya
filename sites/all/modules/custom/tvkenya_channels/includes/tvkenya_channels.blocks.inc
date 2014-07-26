<?php

/**
 * Generate channels pager (yesterday - today - tommorow)
 */
function tvkenya_channels_pager_channels() {
  $html = '';
  $today = date('Y-m-d', time());

  $html .= '<ul>';
  $html .= '<li class="yesterday">' . l(t('Yesterday'), 'schedule/yesterday', array('attributes' => array('class' => array('yesterday-link')))) . '</li>';
  $html .= '<li class="today">' . l(date('l, F d', time()) . ' (' . t('Today') . ')', 'schedule/today', array('attributes' => array('class' => array('today-link')))). '</li>';
  $html .= '<li class="tomorrow">' . l(t('Tomorrow'), 'schedule/tomorrow', array('attributes' => array('class' => array('tomorrow-link')))) . '</li>';
  $html .= '</ul>';

  return $html;
}