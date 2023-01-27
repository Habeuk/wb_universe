<?php
use Drupal\Core\Form\FormStateInterface;

/**
 * implement hook_form_alter
 */
function wb_universe_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // $uid = \Drupal::currentUser();
  // $id = $uid->id();
  if (str_contains($form_id, 'commerce_checkout_flow')) {
    // dump($form);
    /**
     * On differencie les titres de blocks.
     */
    foreach ($form as &$value) {
      if (is_array($value) && !empty($value['#type']) && $value['#type'] == 'fieldset') {
        $value['#legend']['attributes']['class'][] = 'h2';
        // dump($value);
        // On force la paiement la modification du titre, mais il est logique
        // qu'on doit chnager cela.
        if (!empty($value['#pane_id']) && $value['#pane_id'] == 'payment_information') {
          $value['#title'] = "Information de livraison";
        }
      }
    }
    //
    if (!empty($form['review'])) {
      // dump($form['review']);
      foreach ($form['review'] as $k => &$value) {
        if (is_array($value) && !empty($value['#type']) && $value['#type'] == 'fieldset') {
          $value['#legend']['attributes']['class'][] = 'h2';
          // on differencie l'affichage des payments;
          if (!empty($value['summary']['payment_gateway'])) {
            //
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
          //
          // dump($value);
          // On force la paiement la modification du titre, mais il est
          // logique
          // qu'on doit chnager cela.
          if ($k == 'payment_information') {
            $value['#title'] = "Information de livraison";
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
