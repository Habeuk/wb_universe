<?php
use Drupal\Core\Form\FormStateInterface;
use Stephane888\HtmlBootstrap\DefineSetting;
use Stephane888\Debug\debugLog;
require_once 'ajax/TopHeader.inc';
require_once 'ajax/LayoutManager.inc';

// \\ to update in defaultTheme.
$pathResolver = \Drupal::service('extension.path.resolver');
/**
 * Action Ajax for slide
 */

 
$slider_file = DRUPAL_ROOT . '/' . $pathResolver->getPath('theme', 'wb_universe') . '/inc/ajax/slide.inc';
require_once $slider_file;

$carouselcards_file = DRUPAL_ROOT . '/' . $pathResolver->getPath('theme', 'wb_universe') . '/inc/ajax/carouselcards.inc';
require_once $carouselcards_file;

// \\ to update in defaultTheme.
/**
 * Action Ajax for Headers
 */
function _wb_universe_header_displays(&$form, FormStateInterface $form_state)
{
  $group = 'header';
  $sous_group = 'displays';
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_header_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'header';
  _wb_universe_displays_ajax_submit($form_state, $group);
}

/**
 * Action Ajax for style CSS & JS
 */
function _wb_universe_stylepage_displays(&$form, FormStateInterface $form_state)
{
  $group = 'stylepage';
  $sous_group = 'displays';
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_stylepage_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'stylepage';
  _wb_universe_displays_ajax_submit($form_state, $group);
}

function _wb_universe_stylepage_provider(&$form, FormStateInterface $form_state)
{
  $group = 'stylepage';
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

/**
 * Action Ajax for pricelists
 */
function _wb_universe_comments_displays(&$form, FormStateInterface $form_state)
{
  $group = 'comments';
  $sous_group = 'displays';
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_comments_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'comments';
  _wb_universe_displays_ajax_submit($form_state, $group);
}

function _wb_universe_comments_provider(&$form, FormStateInterface $form_state)
{
  $group = 'comments';
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

function _wb_universe_comments_displays_remove(&$form, FormStateInterface $form_state)
{
  $group = 'comments';
  $sous_group = 'displays';
  // debugLog::logs($form['wb_universe_pricelists'], '_wb_universe__' . $group, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_comments_displays_ajax_submit_remove(&$form, FormStateInterface $form_state)
{
  $group = 'comments';
  // debugLog::logs($form_state->getTriggeringElement(), "_wb_universe_" . $group . "_displays_ajax_submit_remove", 'dump', true);
  $target = $form_state->getTriggeringElement();
  if (! empty($target['#custom_key'])) {
    _wb_universe_displays_ajax_submit_remove($form_state, $group, $target['#custom_key']);
  }
}

/**
 * Action Ajax for pricelists
 */
function _wb_universe_pricelists_displays(&$form, FormStateInterface $form_state)
{
  $group = 'pricelists';
  $sous_group = 'displays';
  // debugLog::logs($form['wb_universe_pricelists'], '_wb_universe__' . $group, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_pricelists_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'pricelists';
  // debugLog::logs([], '_wb_universe__ajax_submit__' . $group, 'dump', true);
  _wb_universe_displays_ajax_submit($form_state, $group);
}

function _wb_universe_pricelists_provider(&$form, FormStateInterface $form_state)
{
  $group = 'pricelists';
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

function _wb_universe_pricelists_displays_remove(&$form, FormStateInterface $form_state)
{
  $group = 'pricelists';
  $sous_group = 'displays';
  // debugLog::logs($form['wb_universe_pricelists'], '_wb_universe__' . $group, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_pricelists_displays_ajax_submit_remove(&$form, FormStateInterface $form_state)
{
  $group = 'pricelists';
  // debugLog::logs($form_state->getTriggeringElement(), "_wb_universe_" . $group . "_displays_ajax_submit_remove", 'dump', true);
  $target = $form_state->getTriggeringElement();
  if (! empty($target['#custom_key'])) {
    _wb_universe_displays_ajax_submit_remove($form_state, $group, $target['#custom_key']);
  }
}

/**
 * Action Ajax for imagetextrightleft
 */
function _wb_universe_imagetextrightleft_displays(&$form, FormStateInterface $form_state)
{
  $group = 'imagetextrightleft';
  $sous_group = 'displays';
  // debugLog::logs([], '_wb_universe__' . $group, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_imagetextrightleft_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'imagetextrightleft';
  // debugLog::logs([], '_wb_universe__ajax_submit__' . $group, 'dump', true);
  _wb_universe_displays_ajax_submit($form_state, $group);
}

function _wb_universe_imagetextrightleft_provider(&$form, FormStateInterface $form_state)
{
  $group = 'imagetextrightleft';
  $sous_group = 'displays';
  // debugLog::logs($form_state->getTriggeringElement(), '_wb_universe_getTriggeringElement', 'dump', true);

  $parents = $form_state->getTriggeringElement()['#parents'];
  $bre_parents = count($parents);
  $id_provider = '';
  for ($i = 1; $i < $bre_parents; $i ++) {
    $id_provider = $parents[$i - 1];
  }
  // debugLog::logs($form_state->getValue('wb_universe_imagetextrightleft')[$sous_group][$id_provider], '_wb_universe_getValues__' . $id_provider, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group][$id_provider]['options'];
}

/**
 * Action Ajax for cards
 */
function _wb_universe_cards_displays(&$form, FormStateInterface $form_state)
{
  $group = 'cards';
  $sous_group = 'displays';
  // debugLog::logs([], '_wb_universe__' . $group, 'dump', true);
  return $form['wb_universe_' . $group][$sous_group];
}

function _wb_universe_cards_displays_ajax_submit(&$form, FormStateInterface $form_state)
{
  $group = 'cards';
  // debugLog::logs([], '_wb_universe__ajax_submit__' . $group, 'dump', true);
  _wb_universe_displays_ajax_submit($form_state, $group);
}

function _wb_universe_cards_provider(&$form, FormStateInterface $form_state)
{
  $group = 'cards';
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

/**
 * Ajax action for display
 *
 * @param object $form_state
 * @param string $group
 */
function _wb_universe_displays_ajax_submit_remove($form_state, $group, $index)
{
  $nbre_displays = $form_state->get('nbre_' . $group . '_displays');
  if (! empty($nbre_displays[$index])) {
    unset($nbre_displays[$index]);
    if (! empty($nbre_displays)) {
      $form_state->set('nbre_' . $group . '_displays', $nbre_displays);
    } else {
      $form_state->set('nbre_' . $group . '_displays', 0);
    }
    $form_state->setRebuild();
  }
  // Drupal::messenger()->addMessage(print_r($nbre_imagetextrightleft_displays, true));
}

/**
 * Ajax action for display
 *
 * @param object $form_state
 * @param string $group
 */
function _wb_universe_displays_ajax_submit($form_state, $group)
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