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
  // Colors.
  $form['wb_universe_pages'] = [
    '#type' => 'details',
    '#title' => t('Pages'),
    '#group' => 'wb_universe',
    '#tree' => true
  ];
  $form['wb_universe_pages']["container"] = [
    '#type' => 'details',
    '#title' => t('Page container'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  ];
  $routes = ThemeSettings::getRoutesForSerach();
  foreach ($routes as $k => $route) {
    /**
     *
     * @var \Symfony\Component\Routing\Route $route
     */
    $vk = ThemeSettings::getValidKeyForConfig($k);
    $form['wb_universe_pages']['container'][$vk] = [
      '#type' => 'select',
      '#title' => 'Select container : ' . $route->getPath() . '(' . $k . ')',
      '#options' => ThemeSettings::getTypesContainer(),
      '#default_value' => theme_get_setting('wb_universe_pages.container.' . $vk)
    ];
  }
}