<?php

use Drupal\date_popup\DatePopup;

/**
 * Implements hook_views_plugins_filter_alter().
 */
function date_popup_views_plugins_filter_alter(&$info) {
  $info['date']['class'] = DatePopup::class;
}
