<?php

namespace Drupal\wb_universe;

use Drupal\Component\Render\FormattableMarkup;
use Stephane888\Debug\debugLog;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\views\Views;
use Drupal\Core\Template\Attribute;
use Stephane888\HtmlBootstrap\LoaderDrupal;
use Stephane888\HtmlBootstrap\PreprocessPage;
use Drupal\Component\Utility\SortArray;
use Stephane888\HtmlBootstrap\ThemeUtility;
use Stephane888\HtmlBootstrap\PreprocessNode;
use Stephane888\HtmlBootstrap\PreprocessTemplate;
use Stephane888\HtmlBootstrap\PreprocessMenu;
use Drupal\node\Entity\Node;

class MdbootstrapWbu {
  
  public static function wbupreprocess_page(&$variables) {
    $theme_name = 'wb_universe';
    $PreprocessPage = new PreprocessPage();
    $PreprocessPage->ApplyActions($variables, $theme_name);
    /**
     * Load section.Cette function doit etre decouper, pour separer le
     * chargement des layouts et les styles.
     * Les layouts du theme, tels que definit ne seront plus utilisés.
     */
    $PreprocessPage->loadSection($theme_name, $variables);
    
    /**
     * Ajout les librairies pour l'administration.
     */
    // self::addStyleAdmin($variables);
    
    /**
     * Build scss (utiliser par le theme wb_universe pour generer les fichiers
     * css.
     * Cette methode peut etre utiliser par les themes enfants pour generer les
     * styles.
     */
    $PreprocessPage->_load_scss($theme_name);
  }
  
  /**
   * on attache la librairie pour l'admin si l'utilisateur est administrateur.
   *
   * @param array $variables
   */
  public static function addStyleAdmin(&$variables) {
    if (\Drupal::routeMatch()->getRouteName() === 'layout_builder.overrides.node.view' || str_contains(\Drupal::routeMatch()->getRouteName(), 'layout_builder.defaults')) {
      $variables['page']['content']['#attached']['library'][] = 'wb_universe/styleadmin';
    }
  }
  
  /**
   * on attache la librairie pour l'admin si l'utilisateur est administrateur.
   *
   * @param array $variables
   */
  public static function wbupreprocess_ds_entity_view(&$variables) {
    // dump($variables);
    $show_render_user = true;
    if ($show_render_user && !empty($variables['content']['#node'])) {
      $variables['content']['render_user'] = self::addUserRenderOnNode($variables['content']['#node']);
      $variables['content']['#custom_url'] = self::getUrlNode($variables['content']['#node']->id());
      // $variables['render_user'] = $variables['content']['render_user'];
    }
  }
  
  public static function wbupreprocess_node(&$variables) {
    $show_render_user = false;
    $theme_name = 'wb_universe';
    $PreprocessPage = new PreprocessNode();
    $PreprocessPage->ApplySettingPlugins($variables, $theme_name);
    if ($show_render_user) {
      $variables['render_user'] = self::addUserRenderOnNode($variables['node']);
      $variables['#custom_url'] = self::getUrlNode($variables['node']);
    }
  }
  
  public static function getUrlNode($nid) {
    return Url::fromRoute('entity.node.canonical', [
      'node' => $nid
    ])->toString();
  }
  
  /**
   * permet de creer le rendu du compte utilisateur à partir d'un node.
   *
   * @param Node $node
   */
  public static function addUserRenderOnNode(Node $node) {
    $user = $node->getOwner();
    
    // $node->getFields();
    // $entity_type = 'user';
    // $view_mode = 'full';
    // $view_builder =
    // \Drupal::entityTypeManager()->getViewBuilder($entity_type);
    // $build = $view_builder->view($user, $view_mode);
    $fields = $user->getFields();
    foreach ($fields as $key => $field) {
      $fields[$key] = $user->{$key}->view('carousel');
    }
    return $fields;
  }
  
  /**
   * permet de creer le rendu du compte utilisateur à partir d'un node.
   *
   * @param Node $node
   */
  public static function addRenderNodeOnVariable(Node $node) {
    $fields = $node->getFields();
    foreach ($fields as $key => $field) {
      $fields[$key] = $node->{$key}->view('carousel');
    }
    $fields['created_time'] = \Drupal::service('date.formatter')->format($node->getCreatedTime(), 'long');
    return $fields;
  }
  
  public static function getValueFiledOfNode(Node $node, $field_name) {
    if ($node->hasField($field_name)) {
      return $node->get($field_name)->getValue();
    }
    return false;
  }
  
  /**
   */
  public static function wbupreprocess_page_getJourJ(&$variables) {
    $themes = self::getThemeInfos();
    // ***** retrive date setting
    $variables['JourJ'] = $themes->JourJ('2019-05-28 08:00:00');
  }
  
  /**
   * Retrieves a theme instance of \Drupal\bootstrap.
   */
  public static function getThemeInfos() {
    return new ThemeUtility();
  }
  
  public static function LoadTemplates($theme_name) {
    return PreprocessPage::LoadTemplates($theme_name);
  }
  
  public static function wbupreprocess_template(&$variables, $hook, $theme_name) {
    $PreprocessTemplate = new PreprocessTemplate();
    $PreprocessTemplate->Preprocess($variables, $hook, $theme_name);
  }
  
  public static function PerformsActions($form, $form_state) {
    /**
     * create default style for image.
     */
    // ce tableau est specifique à ce theme.
    $styles = [];
    return PreprocessTemplate::CreateStyles($styles);
  }
  
  /**
   *
   * @param array $variables
   * @param string $theme_name
   */
  public static function wbupreprocess_field__image(&$variables, $theme_name) {
    $PreprocessPage = new PreprocessPage();
    $PreprocessPage->Preprocess_field__image($variables, $theme_name);
  }
  
  public static function ManageMenus(&$variables, $theme_name) {
    // dump($variables);
  }
  
  public static function ManageLinks(&$variables, $theme_name) {
    $PreprocessManu = new PreprocessMenu();
    $PreprocessManu->links($variables, $theme_name);
  }
  
  /**
   * theme setting
   */
  public static function defineSetting(&$form, $form_state) {
    $theme_name = 'wb_universe';
    $DefineSetting = new \Stephane888\HtmlBootstrap\DefineSetting($theme_name);
    if (isset($_GET['build']) && $_GET['build'] == 'scss') {
      _load_scss();
    }
    $host = \Drupal::request()->getHost();
    // dump( \Drupal::request()->get );
    $themes = self::getThemeInfos();
    
    /**
     * Active tree to get name like array.
     * cette activation est fait sur les elzments enfants.
     */
    // $form['#tree'] = TRUE;
    
    /**
     * On active le cache, pour permettre la modification des données via AJAX.
     */
    $form_state->setCached(FALSE);
    
    /**
     * Ajout d'une function submit qui s'execute avant la function principal.
     */
    $form['#submit'][] = $theme_name . '_settings_form_submit';
    $form['#submit'][] = $theme_name . '_settings_form_submit_end';
    
    /**
     * Ajout d'une function submit qui remplace la fonction de submit par
     * defaut.
     */
    // $form['actions']['submit']['#submit'][] = $theme_name .
    // '_settings_form_submit_end';
    // $form['actions']['submit']['#submit'][] =
    // 'wb_universe_form_system_theme_settings_submit';
    // dump($form);
    //
    $form['#attached']['library'][] = 'wb_universe/vue_js';
    $form['#attached']['library'][] = 'wb_universe/styleadmin';
    $form['#attached']['drupalSettings']['wb_universe']['layouts'] = $themes->config_layout_theme();
    /**
     * Ajout du template VueJS
     */
    // $form['#suffix'] = new FormattableMarkup(
    // file_get_contents(
    // DRUPAL_ROOT . '/' . drupal_get_path('theme', $theme_name) .
    // '/js/components_vuejs/templates/forms.html.twig'), []);
    
    // $form['wb_universe_markup_vvvbejs'] = array('#type' => 'markup',
    // '#allowed_tags' => ['iframe', 'div'
    // ],
    // '#markup' => '<div id="drupal-builder-iframe" >
    // <iframe src="//' . $host .
    // '/themes/wb_universe/plugins/VvvebJs-master/editor.html" width="100%"
    // height="100%" frameborder="0" allowfullscreen></iframe>
    // <div id="putcontent-iframe"></div>
    // </div>'
    // );
    // $form['wb_universe_markup_images'] = array('#type' => 'markup',
    // '#allowed_tags' => ['ul', 'li', 'div'
    // ],
    // '#markup' => '<div id="drupal-library-images-json" >' .
    // $themes->load_images() . '</div>'
    // );
    
    // ############################### [ Tous les elements juste apres form
    // doivent avoir le nom du theme ]
    /**
     * Conteneur du tabs vertical.
     *
     * @var string $vertical_tabs_group
     */
    $vertical_tabs_group = 'wb_universe_vertical_tabs';
    $form[$vertical_tabs_group] = array(
      '#type' => 'vertical_tabs',
      // '#default_tab' => 'edit-publication',
      '#weight' => -255,
      '#attributes' => [
        'id' => 'wb_universe-contents'
      ]
    );
    
    // ############################### BEGIN SECTIONS.
    
    // \\ to update in defaultTheme.
    
    /**
     * Group Top headers
     */
    if (theme_get_setting($theme_name . '_topheader_status', $theme_name)) {
      $DefineSetting->group = 'topheader';
      $DefineSetting->form_topheader($form, $vertical_tabs_group, $form_state);
    }
    
    /**
     * Group headers
     */
    if (theme_get_setting($theme_name . '_header_status', $theme_name)) {
      $DefineSetting->group = 'header';
      $DefineSetting->form_header($form, $vertical_tabs_group, $form_state);
    }
    /**
     * Group Top headers
     */
    if (theme_get_setting($theme_name . '_layout_manager_status', $theme_name)) {
      $DefineSetting->group = 'layout_manager';
      $DefineSetting->formLayoutManager($form, $vertical_tabs_group, $form_state);
    }
    
    /**
     * Group imagetextrightleft
     */
    if (theme_get_setting($theme_name . '_imagetextrightleft_status', $theme_name)) {
      $DefineSetting->group = 'imagetextrightleft';
      $DefineSetting->form_imagetextrightleft($form, $vertical_tabs_group, $form_state);
    }
    
    /**
     * Group cards
     */
    if (theme_get_setting($theme_name . '_cards_status', $theme_name)) {
      $DefineSetting->group = 'cards';
      $DefineSetting->form_cards($form, $vertical_tabs_group, $form_state);
    }
    
    /**
     * Group cards
     */
    if (theme_get_setting($theme_name . '_pricelists_status', $theme_name)) {
      $DefineSetting->group = 'pricelists';
      $DefineSetting->form_pricelists($form, $vertical_tabs_group, $form_state);
    }
    /**
     * Group Comments
     */
    if (theme_get_setting($theme_name . '_comments_status', $theme_name)) {
      $DefineSetting->group = 'comments';
      $DefineSetting->form_comments($form, $vertical_tabs_group, $form_state);
    }
    /**
     * Group stylepage
     */
    if (theme_get_setting($theme_name . '_stylepage_status', $theme_name)) {
      $DefineSetting->group = 'stylepage';
      $DefineSetting->form_stylepage($form, $vertical_tabs_group, $form_state);
    }
    // \\ to update in defaultTheme.
    /**
     * Group carouselcards
     */
    if (theme_get_setting($theme_name . '_carouselcards_status', $theme_name)) {
      $DefineSetting->group = 'carouselcards';
      $DefineSetting->form_carouselcards($form, $vertical_tabs_group, $form_state);
    }
    
    // \\ to update in defaultTheme.
    /**
     * Group carouselcards
     */
    if (theme_get_setting($theme_name . '_footers_status', $theme_name)) {
      $DefineSetting->group = 'footers';
      $DefineSetting->form_footers($form, $vertical_tabs_group, $form_state);
    }
    
    // \\ to update in defaultTheme.
    /**
     * Group carouselcards
     */
    if (theme_get_setting($theme_name . '_slide_status', $theme_name)) {
      $DefineSetting->group = 'slide';
      $DefineSetting->form_slide($form, $vertical_tabs_group, $form_state);
    }
    // \\ to update in defaultTheme.
    /**
     * Group carouselcards
     */
    if (theme_get_setting($theme_name . '_pagenodesdisplay_status', $theme_name)) {
      $DefineSetting->group = 'pagenodesdisplay';
      $DefineSetting->form_pagenodesdisplay($form, $vertical_tabs_group, $form_state);
    }
  }
  
  // \\ to update in defaultTheme.
  /**
   *
   * @param array $displays
   * @param string $theme_name
   */
  public static function createFilesTheme($theme_name, $displays = null, $force = true) {
    $PreprocessPage = new PreprocessPage();
    $PreprocessPage->createTemplates($theme_name, $displays, $force);
  }
  
  /**
   *
   * @param array $variables
   */
  public static function displayPreviouwNext(&$variables) {
    $route_name = \Drupal::routeMatch()->getParameter('node');
    // debugLog::logs($route_name, 'page__node', 'kint0');
    // dump($route_name->getType());
    $filters = [
      'nid' => $route_name->id(),
      'type' => $route_name->getType()
    ];
    // next node
    $view = Views::getView('wbu_block_next');
    if ($view) {
      $view->setExposedInput($filters);
      $variables['wbu_block_next']['content'] = $view->render();
      $variables['wbu_block_next']['title'] = $view->getTitle();
    }
    // next previous
    $view_2 = Views::getView('wbu_block_previous');
    if ($view_2) {
      $view_2->setExposedInput($filters);
      $variables['wbu_block_previous']['content'] = $view_2->render();
      $variables['wbu_block_previous']['title'] = $view_2->getTitle();
    }
  }
  
}
