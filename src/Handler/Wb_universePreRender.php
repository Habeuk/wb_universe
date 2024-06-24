<?php

namespace Drupal\wb_universe\Handler;

use Drupal\Core\Security\TrustedCallbackInterface;

/**
 *
 * @author stephane
 *        
 */
class Wb_universePreRender implements TrustedCallbackInterface {
  
  /**
   * Prerender callback for status_messages placeholder.
   *
   * @param array $element
   *        A renderable array.
   * @deprecated car à partir de D10.3.0 le traitement se fait via le JS
   * @return array The updated renderable array containing the placeholder.
   *        
   */
  public static function messagePlaceholder(array $element) {
    if (isset($element['fallback']['#markup'])) {
      $element['fallback']['#markup'] = '<div data-drupal-messages-fallback class="hidden messages-list+++"></div>';
    }
    // dd($element);
    return $element;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public static function trustedCallbacks() {
    return [
      'messagePlaceholder'
    ];
  }
}
