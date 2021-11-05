<?php
namespace Drupal\wb_universe\Render\Element;

use Drupal\Core\Render\Element\VerticalTabs as CoreVerticalTabs;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a render element for vertical tabs in a form.
 *
 * Formats all child and non-child details elements whose #group is assigned
 * this element's name as vertical tabs.
 *
 * Properties:
 * - #default_tab: The HTML ID of the rendered details element to be used as
 * the default tab. View the source of the rendered page to determine the ID.
 *
 * Usage example:
 *
 * @code
 * $form['information'] = array(
 *   '#type' => 'vertical_tabs',
 *   '#default_tab' => 'edit-publication',
 * );
 *
 * $form['author'] = array(
 *   '#type' => 'details',
 *   '#title' => $this->t('Author'),
 *   '#group' => 'information',
 * );
 *
 * $form['author']['name'] = array(
 *   '#type' => 'textfield',
 *   '#title' => $this->t('Name'),
 * );
 *
 * $form['publication'] = array(
 *   '#type' => 'details',
 *   '#title' => $this->t('Publication'),
 *   '#group' => 'information',
 * );
 *
 * $form['publication']['publisher'] = array(
 *   '#type' => 'textfield',
 *   '#title' => $this->t('Publisher'),
 * );
 * @endcode
 *
 * @FormElement("vertical_tabs")
 */
class VerticalTabs extends CoreVerticalTabs
{

    public static function processVerticalTabs(&$element, FormStateInterface $form_state, &$complete_form)
    {
        $element = parent::processVerticalTabs($element, $form_state, $complete_form);
        return $element;
    }
}