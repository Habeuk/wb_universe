<?php
use Drupal\Core\Form\FormStateInterface;
use Drupal\wb_universe\ThemeSettings;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function wb_universe_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {
  if (isset($form_id)) {
    return;
  }
  // MdbootstrapWbu::defineSetting($form, $form_state);
  $form['google-analytics-gtag'] = [
    '#type' => 'textfield',
    '#title' => 'Google Analytics (id de mesure)',
    '#default_value' => theme_get_setting('google-analytics-gtag'),
    '#weight' => -40
  ];
  // Vertical tabs.
  $form['wb_universe'] = [
    '#type' => 'vertical_tabs',
    '#prefix' => '<h2><small>' . t('Wb Universe settings') . '</small></h2>',
    '#weight' => -20
  ];
  /**
   * Select templates for pages.
   */
  $form['wb_universe_pages'] = [
    '#type' => 'details',
    '#title' => t('Pages templates'),
    '#description' => t('Select page templates'),
    '#group' => 'wb_universe',
    '#tree' => true
  ];
  $form['wb_universe_pages']["search"] = [
    '#type' => 'details',
    '#title' => t('Pages search'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  ];
  $routes = ThemeSettings::getRoutesForSearch();
  foreach ($routes as $k => $route) {
    /** @var \Symfony\Component\Routing\Route $route */
    $vk = ThemeSettings::getValidKeyForConfig($k);
    $form['wb_universe_pages']['search'][$vk] = [
      '#type' => 'select',
      '#title' => 'Select container : ' . $route->getPath() . '(' . $k . ')',
      '#options' => ThemeSettings::getTypesContainer(),
      '#default_value' => theme_get_setting('wb_universe_pages.search.' . $vk)
    ];
  }
  $form['wb_universe_pages']["views"] = [
    '#type' => 'details',
    '#title' => t('Pages views'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  ];
  $routes = ThemeSettings::getRoutesForViews();
  foreach ($routes as $k => $route) {
    /** @var \Symfony\Component\Routing\Route $route */
    $vk = ThemeSettings::getValidKeyForConfig($k);
    $form['wb_universe_pages']['views'][$vk] = [
      '#type' => 'select',
      '#title' => 'Select container : ' . $route->getPath() . '(' . $k . ')',
      '#options' => ThemeSettings::getTypesContainer(),
      '#default_value' => theme_get_setting('wb_universe_pages.views.' . $vk)
    ];
  }
  /**
   * Select templates for pages.
   */
  $form['wb_universe_layout'] = [
    '#type' => 'details',
    '#title' => t('Layouts'),
    '#description' => t("Permet de definir structure du conteneur principal"),
    '#group' => 'wb_universe',
    '#tree' => true
  ];
  $form['wb_universe_layout']["sidebar_left"] = [
    '#type' => 'details',
    '#title' => t('Sidebar left'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  ];
  $form['wb_universe_layout']["sidebar_left"]["show"] = [
    '#type' => 'checkbox',
    '#title' => t('Show sidebar left'),
    '#default_value' => theme_get_setting('wb_universe_layout.sidebar_left.show')
  ];
  $form['wb_universe_layout']["sidebar_left"]["class"] = [
    '#type' => 'textfield',
    '#title' => t('Class sidebar left'),
    '#default_value' => theme_get_setting('wb_universe_layout.sidebar_left.class')
  ];
  $form['wb_universe_layout']["sidebar_right"] = [
    '#type' => 'details',
    '#title' => t('Sidebar right'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  ];
  $form['wb_universe_layout']["sidebar_right"]["show"] = [
    '#type' => 'checkbox',
    '#title' => t('Show sidebar right'),
    '#default_value' => theme_get_setting('wb_universe_layout.sidebar_right.show')
  ];
  $form['wb_universe_layout']["sidebar_right"]["class"] = [
    '#type' => 'textfield',
    '#title' => t('Class sidebar right'),
    '#default_value' => theme_get_setting('wb_universe_layout.sidebar_right.class')
  ];
  $form['wb_universe_layout']["content"] = [
    '#type' => 'details',
    '#title' => t('Content center'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description' => t("S'applique uniquement si au moins une sidebar est active")
  ];
  $form['wb_universe_layout']["content"]["class"] = [
    '#type' => 'textfield',
    '#title' => t('Class'),
    '#default_value' => theme_get_setting('wb_universe_layout.content.class')
  ];
}