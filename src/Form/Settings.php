<?php

namespace Drupal\wb_universe\Form;

class Settings {
  private static $configs = [];
  
  /**
   * Contient les champs pour la configuration globale.
   */
  static function generalSettings(&$form, &$form_state) {
    $form['general_settings'] = [
      '#type' => 'details',
      '#title' => t('General Settings'),
      '#tree' => TRUE,
      '#open' => false,
      '#weight' => 0
    ];
    $form['general_settings']['load_bootstrap'] = [
      '#type' => 'checkbox',
      '#title' => 'Charger bootstrap',
      '#default_value' => theme_get_setting('general_settings.load_bootstrap')
    ];
    // Semble pas utile dans la pratique.
    // $form['general_settings']['grid'] = [
    // '#type' => 'details',
    // '#title' => t('Grid'),
    // '#tree' => TRUE,
    // '#open' => false,
    // '#weight' => 0
    // ];
    // $form['general_settings']['grid']['content_css'] = [
    // '#type' => 'textfield',
    // '#title' => 'Css de la region content ',
    // '#description' => "S'applique sur tous les rendus",
    // '#default_value' => $configs['general_settings']['grid']['content_css']
    // ];
    // $form['general_settings']['grid']['sidebar_first_css'] = [
    // '#type' => 'textfield',
    // '#title' => 'Css de la region sidebar_first ',
    // '#description' => "S'applique sur tous les rendus",
    // '#default_value' =>
    // $configs['general_settings']['grid']['sidebar_first_css']
    // ];
    // $form['general_settings']['grid']['sidebar_second_css'] = [
    // '#type' => 'textfield',
    // '#title' => 'Css de la region sidebar_second ',
    // '#description' => "S'applique sur tous les rendus",
    // '#default_value' =>
    // $configs['general_settings']['grid']['sidebar_second_css']
    // ];
    // N'est pas utile dans la pratique.
    // $form['general_settings']['grid']['content_css_home'] = [
    // '#type' => 'textfield',
    // '#title' => 'Css de la region content sur le front ',
    // '#description' => "S'applique uniquement sur la page front",
    // '#default_value' =>
    // $configs['general_settings']['grid']['content_css_home']
    // ];
    // $form['general_settings']['grid']['content_css_taxo'] = [
    // '#type' => 'textfield',
    // '#title' => 'Css de la region content sur taxo ',
    // '#description' => "S'applique uniquement sur la page taxonomie",
    // '#default_value' =>
    // $configs['general_settings']['grid']['content_css_taxo']
    // ];
    // $form['general_settings']['grid']['content_css_entity'] = [
    // '#type' => 'textfield',
    // '#title' => 'Css de la region content entity',
    // '#description' => "S'applique uniquement sur les rendus d'entitées.",
    // '#default_value' =>
    // $configs['general_settings']['grid']['content_css_entity']
    // ];
  }
  
  /**
   * Contient les champs pour la configuration globale.
   */
  static function StripeSettings(&$form, &$form_state) {
    $form['stripe_settings'] = [
      '#type' => 'details',
      '#title' => t('Stripe Settings'),
      '#tree' => TRUE,
      '#open' => false,
      '#weight' => 0
    ];
    $form['stripe_settings']['load_stripe'] = [
      '#type' => 'checkbox',
      '#title' => 'Charge la bibiotheque stripe',
      '#default_value' => theme_get_setting('stripe_settings.load_stripe')
    ];
  }
  
}
