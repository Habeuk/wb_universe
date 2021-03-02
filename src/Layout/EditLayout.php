<?php
namespace Drupal\wb_universe\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\SubformState;
use Drupal\Core\Plugin\PluginFormInterface;
use Stephane888\Debug\debugLog;

class EditLayout {

  protected $layout_id;

  protected $layout_settings;

  protected $layoutPluginManager;

  function __construct($layout_id, $layout_settings = [])
  {
    $this->layout_id = $layout_id;
    $this->layout_settings = $layout_settings;
    $this->layoutPluginManager = \Drupal::service('plugin.manager.core.layout');
  }

  protected function getLayout(FormStateInterface $form_state)
  {
    if (! $layout_plugin = $form_state->get('layout_plugin')) {
      $layout_plugin = $this->layoutPluginManager->createInstance($this->layout_id, $this->layout_settings);
      $form_state->set('layout_plugin', $layout_plugin);
    }
    return $layout_plugin;
  }

  public function buildForm(array &$form, FormStateInterface $form_state)
  {
    // $form = parent::buildForm($form, $form_state);

    // Retrieval of the layout ID and settings is dependent on how it is stored.
    $layout_plugin = $this->getLayout($form_state);
    $form['layout'] = [
      '#type' => 'select',
      '#title' => 'Select a layout',
      '#options' => $this->layoutPluginManager->getLayoutOptions(),
      '#default_value' => $layout_plugin->getPluginId()
    ];
    if ($layout_plugin instanceof PluginFormInterface) {
      $form['layout_settings'] = [];
      $subform_state = SubformState::createForSubform($form['layout_settings'], $form, $form_state);
      $form['layout_settings'] = $layout_plugin->buildConfigurationForm($form['layout_settings'], $subform_state);
    }
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    debugLog::kintDebugDrupal($form_state->getValues(), "EditLayout::validateForm");
    parent::validateForm($form, $form_state);

    $layout_plugin = $this->getLayout($form_state);
    if ($layout_plugin instanceof PluginFormInterface) {
      $subform_state = SubformState::createForSubform($form['layout_settings'], $form, $form_state);
      $layout_plugin->validateConfigurationForm($form['layout_settings'], $subform_state);
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    debugLog::kintDebugDrupal($form_state->getValues(), "EditLayout::validateForm");
    parent::submitForm($form, $form_state);

    $layout_plugin = $this->getLayout($form_state);
    if ($layout_plugin instanceof PluginFormInterface) {
      $subform_state = SubformState::createForSubform($form['layout_settings'], $form, $form_state);
      $layout_plugin->submitConfigurationForm($form['layout_settings'], $subform_state);
    }

    // @todo This is where you store the updated layout information
    $layout_id = $layout_plugin->getPluginId();
    $layout_settings = $layout_plugin->getConfiguration();
  }
}