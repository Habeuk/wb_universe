<?php

namespace Drupal\wb_universe\Handler;

/**
 * Permet d'effectuer les traitements principalement sur les styles.
 * Le traitement du contenu doit se faire au niveau des modules.
 *
 * @author stephane
 *        
 */
class MailStyles {
  /**
   *
   * @var \Drupal\Core\Extension\ExtensionPathResolver
   */
  protected static $pathResolver;
  
  static public function formatter(array &$variables) {
    self::generateCss($variables);
    self::buildHeader($variables);
    self::buildFooter($variables);
  }
  
  /**
   * Un module peut ajouter des information dans l'entete, mais elles seront
   * en dessous de celui du theme.
   */
  protected static function buildHeader(array &$variables) {
    $subject = $variables['subject'];
    $variables['header'][] = [
      '#type' => 'html_tag',
      '#tag' => 'h3',
      '#value' => $subject,
      '#attributes' => [
        'class' => [
          'mb-0'
        ]
      ]
    ];
    if (!empty($variables['header'])) {
      $externeHeader = $variables['header'];
      $variables['header'] = [
        self::buildHeaderFromTheme(),
        $externeHeader
      ];
    }
    else
      $variables['header'] = self::buildHeaderFromTheme();
  }
  
  /**
   *
   * @param array $variables
   */
  protected static function buildFooter(array &$variables) {
    if (!empty($variables['footer'])) {
      $externeFooter = $variables['footer'];
      $variables['footer'] = [
        self::buildFooterFromTheme(),
        $externeFooter
      ];
    }
    else
      $variables['footer'] = self::buildFooterFromTheme();
  }
  
  /**
   * Contruit les données d'entes provenant du theme.
   *
   * @return array
   */
  protected static function buildHeaderFromTheme() {
    return [];
  }
  
  /**
   * Contruit les données d'entes provenant du theme.
   *
   * @return array
   */
  protected static function buildFooterFromTheme() {
    return [];
  }
  
  /**
   * Permet de generer les styles css.
   *
   * @param array $variables
   */
  protected static function generateCss(array &$variables) {
    $defaultThemeName = \Drupal::config('system.theme')->get('default');
    $file_mail_style = DRUPAL_ROOT . '/' . self::getPath('theme', $defaultThemeName) . '/css/mail-style.css';
    if (file_exists($file_mail_style)) {
      $variables['css'] = file_get_contents($file_mail_style);
    }
  }
  
  protected static function getPath($type, $name) {
    if (!self::$pathResolver) {
      self::$pathResolver = \Drupal::service('extension.path.resolver');
    }
    return self::$pathResolver->getPath($type, $name);
  }
  
}