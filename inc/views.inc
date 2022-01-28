<?php
use Drupal\Core\Template\Attribute;
use Drupal\views\ViewExecutable;

/**
 * Implements hook_theme_suggestions_HOOK_alter()
 */
function wb_universe_theme_suggestions_views_view_unformatted_alter(&$suggestions, &$variables, $hook) {
  if ($variables['view']->id()) {
    // dpm($variables['view']->id());
    $suggestions[] = 'views_view_unformatted__' . $variables['view']->id();
  }
}

/**
 *
 * @param int $variables
 */
function wb_universe_preprocess_views_view_unformatted(&$variables) {
  // dump($variables);
  if (!empty($variables['view']->id())) {
    if (isset($variables['view']->current_display)) {
      // dump($variables['rows'][0]['content']["#view"]->query->displayHandler->output);
      // debugLog::logs( $variables, 'front-view-variables', 'kint');
      $group = 'wb_universe_row_view';
      $name = $variables['view']->id() . $variables['view']->current_display;
      $file = format_template_views_view_unformatted($group . $name);
      if ($file) {
        // dump($file);
        $variables['template_format'] = $file;
        /*
         * #* node_teaser_wb_universe
         * if( !empty($file['formatter']['value']) &&
         * $file['formatter']['value'] == "node_teaser_wb_universe" ){
         * foreach ($variables['rows'] as $key=>$value){
         * $items = ['content'=>['#theme'=> 'node_teaser_wb_universe'],
         * 'attributes'=> new Attribute(),];
         * $fields =
         * $value['content']["#view"]->query->displayHandler->handlers['field'];
         * //dump($fields);
         * foreach ( $fields as $field_name=>$field ) {
         * if(isset($file['fields'][$field_name])){
         * if(!empty($file['fields'][$field_name]['data']['value']) ){
         * $items['content'][$file['fields'][$field_name]['data']['value']][]=['#type'
         * => 'inline_template', '#template' => $field->last_render];
         * }
         * }
         * }
         * $variables['new_template_format'][] = $items;
         * }
         * }
         * /*
         */
      }
    }
  }
}

/**
 *
 * @param array $variables
 */
function wb_universe_preprocess_views_view_fields(&$variables) {
  // dump('wb_universe_preprocess_views_view_fields');
  $wbuniverse_row = true;
  $wbuniverse_user_render = false;
  if ($wbuniverse_row) {
    $group = 'wb_universe_row_view';
    $name = $variables['view']->id() . $variables['view']->current_display;
    $file = format_template_views_view_unformatted($group . $name);
    if ($file) {
      // dump($file);
      $variables['template_format'] = $file;
      // * node_teaser_wb_universe
      if (!empty($file['formatter']['value'])) {
        $template = $file['formatter']['value'];
        $items = [
          '#theme' => $template
        ];
        foreach ($variables['fields'] as $k => $value) {
          if (!empty($file['fields'][$k]['data']['value'])) {
            $items[$file['fields'][$k]['data']['value']][] = [
              '#theme' => 'views_view_field_cutom',
              '#field' => $value
            ];
          }
        }
        $variables['new_template_format'] = $items;
      }
    }
  }
  if ($wbuniverse_user_render) {
    getuserInfosRender($variables['view']);
  }
}

/**
 * Verifie si le contenu est un entité de node,
 * si c'est le cas, ajouter le rendu de l'utilisateur.
 * Lorsque l'on utilise les layouts, on ne peut pas le faire en UI.
 *
 * @param ViewExecutable $view
 */
function getuserInfosRender(ViewExecutable $view) {
  // dump($view);
  $Entity = $view->getBaseEntityType();
  if ($Entity) {
    if ($Entity->id() == 'node') {
    }
  }
}

/**
 * Implements hook_theme_suggestions_HOOK_alter()
 */
function wb_universe_theme_suggestions_views_view_fields_alter(&$suggestions, &$variables, $hook) {
  if ($variables['view']->id()) {
    $suggestions[] = 'views_view_fields__' . $variables['view']->id();
  }
}

/**
 * Implements hook_theme_suggestions_HOOK_alter()
 */
function wb_universe_theme_suggestions_views_view_alter(&$suggestions, &$variables, $hook) {
  if ($variables['view']->id()) {
    // dpm($variables['view']->id());
    $suggestions[] = 'views_view__' . $variables['view']->id();
    if (isset($variables['view']->current_display)) {
      $suggestions[] = 'views_view__' . $variables['view']->id() . '__' . $variables['view']->current_display;
      // $group = 'wb_universe_row_view';
      // $name = $variables['view']->id() . $variables['view']->current_display;
      // $file = format_template_views_view($group . $name);
      // // dpm($file);
      // if ($file) {
      // $suggestions[] = 'views_view__' . $file;
      // }
    }
  }
  // debugLog::logs( $variables['view'], 'front-view' );
}

/**
 *
 * @param array $field_name
 * @return string|boolean
 */
function format_template_views_view($field_name) {
  $name = $field_name;
  $value = theme_get_setting($name, 'wb_universe');
  if ($value) {
    $name = $field_name . 'cfg';
    $value = theme_get_setting($name, 'wb_universe');
    $values = json_decode($value, true);
    // dpm($values);
    if ($values['template']['value'] == 'bootstrap-grid') {
      return 'row';
    }
    elseif ($values['template']['value'] != '') {
      return 'default';
    }
  }
  return false;
}

function format_template_views_view_unformatted($field_name) {
  $name = $field_name;
  $value = theme_get_setting($name, 'wb_universe');
  if ($value) {
    $name = $field_name . 'cfg';
    $value = theme_get_setting($name, 'wb_universe');
    $values = json_decode($value, true);
    // dump($values);
    if ($values['template']['value'] != '') {
      return $values;
    }
  }
  return false;
}

/**
 *
 * @param int $variables
 */
function wb_universe_preprocess_views_view(&$variables) {
  
  // dump($variables);
}




