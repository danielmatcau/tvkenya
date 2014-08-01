<?php

/**
 * Top Banner
 */
function _top_banner() {
  $html = '';

  $html = '<img src="/sites/all/themes/tvkenya/css/images/header/top-banner.png" />';

  return $html;
}

/**
 * Right sidebar banners.
 */
function _right_side_bar_banner() {
  $html = '';

  $html .= '<img src="/sites/all/themes/tvkenya/css/images/banners/banner-1.png" />';
  $html .= '<img src="/sites/all/themes/tvkenya/css/images/banners/banner-2.png" />';

  return $html;
}