<?php
use Drupal\Core\Form\FormStateInterface;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Drupal\Component\Render\FormattableMarkup;

// use Drupal\Core\StringTranslation\TranslatableMarkup;
// use Drupal\debug_log\debugLog;

/**
 * Implements hook_form_FORM_ID_alter().
 * # search-block-form
 *
 * @param
 *        	$form
 * @param FormStateInterface $form_state
 * @param
 *        	$form_id
 */
function wb_universe_form_search_block_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
	// $form["actions"]["submit"]["#attributes"]=['class'=>['hello', 'kksa888'], 'fa_icon'=>'fas fa-search'];
	// dump($form);
}

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param
 *        	$form
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 * @param
 *        	$form_id
 */
function wb_universe_form_user_login_form_alter(&$form, FormStateInterface $form_state, $form_id) {}

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param
 *        	$form
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 * @param
 *        	$form_id
 */
function wb_universe_form_user_pass_alter(&$form, FormStateInterface $form_state, $form_id) {}

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param
 *        	$form
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 * @param
 *        	$form_id
 */
function wb_universe_form_user_register_form_alter(&$form, FormStateInterface $form_state, $form_id) {}

function wb_universe_preprocess_input__password(&$variables) {
	/*
	 * if (isset($variables['element']['#array_parents'][0]) && $variables['element']['#array_parents'][0] == 'account') {
	 * $variables['element']['#attributes']['placeholder'][] = $variables['element']['#title'] . ' *';
	 * $variables['attributes']['placeholder'][] = $variables['element']['#title'] . ' *';
	 * }
	 * /*
	 */
}

function wb_universe_preprocess_select(&$variables) {
	// dump($variables);
	/**
	 * Ajout de la class form-control
	 */
	$variables['attributes']['class'][] = 'form-control';
}

function wb_universe_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
	/*
	 * if ($form_id && strstr($form_id, 'webform_submission')) {
	 * // dump($form, $_GET);
	 * if ($form_id == 'webform_submission_candidater_a_cette_annonce_add_form') {
	 * if (! empty($_GET['annone'])) {
	 * $nids = explode("-", $_GET['annone']);
	 * $nid = intval($nids[1]);
	 * $form['elements']['identifiant_de_l_annonce']['#default_value'] = $nid;
	 * }
	 * }
	 * }
	 * /*
	 */
}

function wb_universe_form_webform_submission_form_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
	// $form["actions"]["submit"]["#attributes"]=['class'=>['hello', 'kksa888'], 'fa_icon'=>'fas fa-search'];
	// dump($form_id);
}

function wb_universe_form_webform_submission_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
	// $form["actions"]["submit"]["#attributes"]=['class'=>['hello', 'kksa888'], 'fa_icon'=>'fas fa-search'];
	// dump($form_id);
}

function wb_universe_webform_submission_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
	// $form["actions"]["submit"]["#attributes"]=['class'=>['hello', 'kksa888'], 'fa_icon'=>'fas fa-search'];
	// dump($form_id);
}

