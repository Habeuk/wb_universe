<?php

namespace Drupal\wb_universe\Form;

class Settings {
  private static $configs = [];
  
  /**
   * Contient les champs pour la configuration globale.
   */
  static function generalSettings(&$form, &$form_state) {
    $configs = self::defaultconfigs();
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
      '#default_value' => $configs['general_settings']["load_bootstrap"]
    ];
  }
  
  /**
   * Contient les champs pour la configuration globale.
   */
  static function StripeSettings(&$form, &$form_state) {
    $configs = self::defaultconfigs();
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
      '#default_value' => $configs['stripe_settings']["load_stripe"]
    ];
  }
  
  static function defaultconfigs() {
    if (!self::$configs) {
      self::$configs = \Drupal::Config('wb_universe.settings')->get();
    }
    return self::$configs;
  }
  
}
