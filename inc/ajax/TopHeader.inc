<?php
use Drupal\Core\Form\FormStateInterface;
use Stephane888\Debug\debugLog;

// use Drupal\wb_universe\Layout\EditLayout;

/**
 * Gere les chagement au niveau du champs : Fournisseur de contenu
 *
 * @return []
 */
function _wb_universe_topheader_provider(&$form, FormStateInterface $form_state)
{
  $group = 'topheader';
  // $EditLayout = new EditLayout('top_header');
  // $form['wb_universe_' . $group]['display']['layout'] = [];
  // $EditLayout->buildForm($form['wb_universe_' . $group]['display']['layout'], $form_state);
  // debugLog::kintDebugDrupal($data, '_wb_universe_topheader_layout');
  // $form['wb_universe_' . $group]['display']['layout'] = $data;
  // $parents = $form_state->getTriggeringElement()['#parents'];
  // $bre_parents = count($parents);
  // $id_provider = '';
  // for ($i = 1; $i < $bre_parents; $i ++) {
  // $id_provider = $parents[$i - 1];
  // }

  // debugLog::SaveLogsDrupal($form_state->getValues(), '_wb_universe_topheader_provider' . time());
  // debugLog::kintDebugDrupal($form_state->getValue('wb_universe_topheader'), '_wb_universe_topheader_provider');
  // debugLog::kintDebugDrupal($form['wb_universe_' . $group]['display'], '_wb_universe_topheader_$form');
  // debugLog::logs($form_state->getValue('wb_universe_imagetextrightleft')[$sous_group][$id_provider], '_wb_universe_getValues__' . $id_provider, 'dump', true);
  return $form['wb_universe_' . $group]['display'];
}