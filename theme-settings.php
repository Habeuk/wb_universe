<?php
use Drupal\wb_universe\Form\Settings;

/**
 *
 * @file
 * Theme settings form for HBK cforge theme.
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function wb_universe_form_system_theme_settings_alter(&$form, &$form_state) {
  Settings::generalSettings($form, $form_state);
  // close favicon
  if (!empty($form['favicon'])) {
    $form['favicon']['#open'] = false;
  }
  // close logo
  if (!empty($form['logo'])) {
    $form['logo']['#open'] = false;
  }
  // close theme_settings
  if (!empty($form['theme_settings'])) {
    $form['theme_settings']['#open'] = false;
  }
}

function _just_test(&$form, &$form_state) {
  $configs = $form_state->getValue("hbk_cforge");
  if ($configs["old_theme"] != $configs["current_theme"]) {
    drupal_flush_all_caches();
  }
}
