<?php
use Drupal\Core\Form\FormStateInterface;
use Stephane888\HtmlBootstrap\DefineSetting;

/**
 * Action Ajax for slide
 */
function _wb_universe_slide_displays(&$form, FormStateInterface $form_state)
{
  $group = 'slide';
  $sous_group = 'displays';
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_slide_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'slide';
  _wb_universe_displays_ajax_submit($form_state, $group);
}

function _wb_universe_slide_provider(&$form, FormStateInterface $form_state)
{
  $group = 'slide';
  $sous_group = 'displays';
  // debugLog::logs($form_state->getTriggeringElement(), '_wb_universe_getTriggeringElement', 'dump', true);
  $parents = $form_state->getTriggeringElement()['#parents'];
  $bre_parents = count($parents);
  $id_provider = '';
  for ($i = 1; $i < $bre_parents; $i ++) {
    $id_provider = $parents[$i - 1];
  }
  // debugLog::logs($form_state->getValue('wb_universe_imagetextrightleft')[$sous_group][$id_provider], '_wb_universe_getValues', 'dump', true);
  return $form['wb_universe_' . $group][$sous_group][$id_provider]['options'];
}

function _wb_universe_slide_displays_remove(&$form, FormStateInterface $form_state)
{
  $group = 'slide';
  $sous_group = 'displays';
  // debugLog::logs($form['wb_universe_pricelists'], '_wb_universe__' . $group, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_slide_displays_ajax_submit_remove(&$form, FormStateInterface $form_state)
{
  $group = 'slide';
  // debugLog::logs($form_state->getTriggeringElement(), "_wb_universe_" . $group . "_displays_ajax_submit_remove", 'dump', true);
  $target = $form_state->getTriggeringElement();
  if (! empty($target['#custom_key'])) {
    _wb_universe_displays_ajax_submit_remove($form_state, $group, $target['#custom_key']);
  }
}