<?php
use Drupal\Core\Form\FormStateInterface;

/**
 * implement hook_form_alter
 */
function wb_universe_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  $uid = \Drupal::currentUser();
  $id = $uid->id();
  if ($id == 26 || $id == 0) {
    if (str_contains($form_id, 'commerce_checkout_flow')) {
      // dump($form);
      /**
       * On differencie les titres de blocks.
       */
      foreach ($form as &$value) {
        if (is_array($value) && !empty($value['#type']) && $value['#type'] == 'fieldset') {
          $value['#legend']['attributes']['class'][] = 'h2';
          $value['#legendcommerce'] = "kksa888";
        }
      }
      //
      if (!empty($form['review'])) {
        foreach ($form['review'] as &$value) {
          if (is_array($value) && !empty($value['#type']) && $value['#type'] == 'fieldset') {
            $value['#legend']['attributes']['class'][] = 'h2';
            // dump($value);
            // on differencie l'affichage des payment;
            if (!empty($value['summary']['payment_gateway'])) {
              $value['summary']['payment_gateway'] = [
                '#type' => 'html_tag',
                '#tag' => 'div',
                '#attributes' => [
                  'class' => [
                    "h4"
                  ]
                ],
                '#value' => $value['summary']['payment_gateway']['#markup']
              ];
            }
          }
        }
      }
      /**
       * Etape : order_information.
       */
      if (!empty($form['#step_id']) && $form['#step_id'] == "order_information") {
        // dump($form);
      }
    }
  }
}
