<?php

namespace Drupal\wb_universe;

use Symfony\Component\Routing\RouteCollection;

class ThemeSettings {
  
  /**
   * Les types de champs qui ont besoin "form-control".
   *
   * @var array
   */
  public static $control_inputs = [
    'email',
    'textfield',
    'number',
    'select',
    'search_api_autocomplete',
    'phone_international',
    'password',
    'entity_autocomplete',
    'managed_file',
    'file',
    'date'
    // 'submit' ne doit pas etre ici, car il na pas besoin de form-control.
  ];
  
  /**
   * Les types de champs qui ont besoins de "form-check-input".
   *
   * @var array
   */
  public static $check_inputs = [
    'checkbox',
    'checkboxes',
    'radio',
    'radios'
  ];
  
  /**
   * Valeur definie dans le hook_preprocess_page et permet par la suite dans les
   * hook en dessous de savoir s'il ya une sidebar ou pas.
   *
   * @var boolean
   */
  public static $hasSideBar = false;
  
  /**
   * Permet de retounrer les types de container definie dans les styles du
   * theme.
   */
  public static function getTypesContainer() {
    return [
      'container' => 'Container',
      'container-fluid' => 'Container fluid',
      'width-tablet mx-auto' => "Width tablet",
      'width-phone mx-auto' => "Width phone",
      '' => "Aucun"
    ];
  }
  
  /**
   * Retourne les routes liées à la recherche.
   *
   * @return array|\Symfony\Component\Routing\array<string,
   */
  public static function getRoutesForViews() {
    /**
     *
     * @var \Drupal\Core\Routing\RouteProvider $router
     */
    $router = \Drupal::service('router.route_provider');
    $routeCollection = self::getRouteByName("view.%");
    $routes = $routeCollection->all();
    $r = [];
    // remove content admin.
    foreach ($routes as $routeName => $route) {
      /** @var \Symfony\Component\Routing\Route $route */
      if (!str_contains($route->getPath(), "/admin/")) {
        $r[$routeName] = $route;
      }
    }
    return $r;
  }
  
  /**
   * Retourne les routes liées à la recherche.
   *
   * @return array|\Symfony\Component\Routing\array<string,
   */
  public static function getRoutesForSearch() {
    /**
     *
     * @var \Drupal\Core\Routing\RouteProvider $router
     */
    $router = \Drupal::service('router.route_provider');
    $routeCollection = self::getRouteByName("search.view%");
    return $routeCollection->all();
  }
  
  /**
   * Retourne les routes liées à la recherche.
   *
   * @return array|\Symfony\Component\Routing\array<string,
   */
  public static function getRoutesForUser() {
    /**
     *
     * @var \Drupal\Core\Routing\RouteProvider $router
     */
    $router = \Drupal::service('router.route_provider');
    $routeCollection = self::getRouteByName("user.%");
    return $routeCollection->all();
  }
  
  /**
   * Permet de retourner la bonne valeur de la clée.
   * Les données de configuration ne supporte pas "%% key contains a dot which
   * is not supported".
   * On remplace . par - afin de différencie avec les _ définis au niveau du nom
   * de la reoute.
   */
  public static function getValidKeyForConfig($key) {
    return str_replace(".", '-', $key);
  }
  
  /**
   * Drupal n'offre pas pour l'instant, la possibité de filtrer les routes en
   * fonction du nom, on a recherché dans le service 'router.route_provider'.
   */
  private static function getRouteByName($name) {
    $query = "select name, route from {router} where name LIKE '$name'";
    try {
      $routes = \Drupal::database()->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }
    catch (\Exception $e) {
      $routes = [];
    }
    
    $collection = new RouteCollection();
    foreach ($routes as $row) {
      $collection->add($row['name'], unserialize($row['route']));
    }
    return $collection;
  }
}