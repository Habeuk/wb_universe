<?php
use Drupal\Core\Form\FormStateInterface;
use Stephane888\HtmlBootstrap\DefineSetting;
use Stephane888\Debug\debugLog;

// use Drupal\wb_universe\Layout\EditLayout;

/**
 * Gere les chagement au niveau du champs : Fournisseur de contenu
 *
 * @return []
 */
function _wb_universe_layout_manager_displays(&$form, FormStateInterface $form_state)
{
  $group = 'layout_manager';
  $sous_group = 'displays';
  debugLog::kintDebugDrupal([], '_wb_universe_layout_manager_displays' . time());
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_layout_manager_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'layout_manager';
  debugLog::kintDebugDrupal([], '_wb_universe_layout_manager_displays_ajax_submit' . time());
  _wb_universe_displays_layout_manager_ajax_submit($form_state, $group);
}

function _wb_universe_layout_manager_provider(&$form, FormStateInterface $form_state)
{
  $group = 'layout_manager';
  $sous_group = 'displays';
  debugLog::kintDebugDrupal([], '_wb_universe_layout_manager_provider' . time());

  $parents = $form_state->getTriggeringElement()['#parents'];
  $bre_parents = count($parents);
  $id_provider = '';
  for ($i = 1; $i < $bre_parents; $i ++) {
    $id_provider = $parents[$i - 1];
  }
  // debugLog::logs($form_state->getValue('wb_universe_imagetextrightleft')[$sous_group][$id_provider], '_wb_universe_getValues', 'dump', true);
  return $form['wb_universe_' . $group][$sous_group][$id_provider]['options'];
}

/**
 * Ajax action for display
 *
 * @param object $form_state
 * @param string $group
 */
function _wb_universe_displays_layout_manager_ajax_submit($form_state, $group)
{
  $DefineSetting = new DefineSetting('wb_universe', $group);
  // $sous_group = 'displays';
  // $form['wb_universe_' . $group]["#tree"] = true;
  $nbre_imagetextrightleft_displays = $form_state->get('nbre_' . $group . '_displays');
  // debugLog::logs($nbre_imagetextrightleft_displays, 'before_displays_' . $group, 'dump', true);
  // $DefineSetting->AjoutBlocAffichage($form, $group, 'wb_universe', $sous_group);
  $DefineSetting->AjoutBloc($nbre_imagetextrightleft_displays);
  $form_state->set('nbre_' . $group . '_displays', $nbre_imagetextrightleft_displays);
  // debugLog::logs($nbre_imagetextrightleft_displays, 'ajax_submit-nbre_imagetextrightleft_displays', 'dump', true);
  // return $form['wb_universe_' . $group][$sous_group];
  $form_state->setRebuild();
}