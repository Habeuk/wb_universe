<?php

namespace Drupal\wb_universe;

use Symfony\Component\Routing\RouteCollection;

class ThemeSettings {
  
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
   *
   * @return array|\Symfony\Component\Routing\array<string,
   */
  public static function getRoutesForSerach() {
    /**
     *
     * @var \Drupal\Core\Routing\RouteProvider $router
     */
    $router = \Drupal::service('router.route_provider');
    $routeCollection = self::getRouteByName("search.view");
    return $routeCollection->all();
  }
  
  /**
   * Permet de retourner la bonne valeur de la clée.
   * Les données de configuration ne supporte pas "%% key contains a dot which
   * is not supported".
   * On remplace . par - afin de differencie avec les _ definis au niveau du nom
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
    $query = "select name, route from {router} where name LIKE '%$name%'";
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