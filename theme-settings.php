<?php
use Drupal\Core\Form\FormStateInterface;
use Drupal\wb_universe\ThemeSettings;
use Drupal\wb_universe\Form\Settings;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function wb_universe_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {
  if (isset($form_id)) {
    return;
  }
  Settings::generalSettings($form, $form_state);
  Settings::StripeSettings($form, $form_state);
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
  $form['wb_universe_pages']["terms"] = [
    '#type' => 'details',
    '#title' => t('Pages terms taxomies'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  ];
  $key_term = ThemeSettings::getValidKeyForConfig("entity.taxonomy_term.canonical");
  $form['wb_universe_pages']['terms'][$key_term] = [
    '#type' => 'select',
    '#title' => 'Select container : entity.taxonomy_term.canonical ',
    '#options' => ThemeSettings::getTypesContainer(),
    '#default_value' => theme_get_setting('wb_universe_pages.terms.' . $key_term)
  ];
  /**
   * --.
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
  
  /**
   * Formatter forms and input.
   */
  $form['wb_universe_forms'] = [
    '#type' => 'details',
    '#title' => t('forms'),
    '#description' => t("Permet de gerer les classes dans les formulaires"),
    '#group' => 'wb_universe',
    '#tree' => true
  ];
  foreach (ThemeSettings::$control_inputs as $type) {
    $form['wb_universe_forms'][$type] = [
      '#type' => 'textfield',
      '#title' => t('Container input type : ' . $type),
      '#default_value' => theme_get_setting('wb_universe_forms.' . $type)
    ];
  }
  foreach (ThemeSettings::$check_inputs as $type) {
    $form['wb_universe_forms'][$type] = [
      '#type' => 'textfield',
      '#title' => t('Container input type : ' . $type),
      '#default_value' => theme_get_setting('wb_universe_forms.' . $type)
    ];
  }
  
  //
  $form['wb_universe_forms']["views_exposed_form"] = [
    '#type' => 'details',
    '#title' => t('views_exposed_form'),
    '#open' => false
  ];
  $form['wb_universe_forms']["views_exposed_form"] = [
    '#type' => 'details',
    '#title' => t('views_exposed_form'),
    '#open' => false
  ];
  $form['wb_universe_forms']['views_exposed_form']["class"] = [
    '#type' => 'textfield',
    '#title' => t('Class for each input'),
    '#default_value' => theme_get_setting('wb_universe_forms.views_exposed_form.class')
  ];
  
  /**
   * --.
   */
  $menus = \Drupal\system\Entity\Menu::loadMultiple();
  $tempaltes_menus = [
    '' => t('Default (vertical align)'),
    'menu_horizontal' => t('Horizontal menu')
  ];
  $form['wb_universe_menus'] = [
    '#type' => 'details',
    '#title' => t('Menus display'),
    '#description' => t("Allows you to manage the display of menus"),
    '#group' => 'wb_universe',
    '#tree' => true
  ];
  foreach ($menus as $menu) {
    $id = $menu->id();
    $form['wb_universe_menus'][$id] = [
      '#type' => 'details',
      '#title' => $menu->label(),
      '#options' => $tempaltes_menus,
      '#default_value' => theme_get_setting('wb_universe_menus.' . $id)
    ];
    $form['wb_universe_menus'][$id]['template'] = [
      '#type' => 'select',
      '#title' => 'Template',
      '#options' => $tempaltes_menus,
      '#default_value' => theme_get_setting('wb_universe_menus.' . $id . '.template')
    ];
    $form['wb_universe_menus'][$id]['class_menu'] = [
      '#type' => 'textfield',
      '#title' => "Class menu",
      '#default_value' => theme_get_setting('wb_universe_menus.' . $id . '.class_menu')
    ];
  }
}