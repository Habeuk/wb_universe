/**
 *  Contient les fonctions de bases utiles aux themes.
 */
(function($, Drupal) {
	
	/**
	 * Active la bare de  navigation personnalisé sur les elements data-scrollbar.
	 */
	function ActiveAcrollbar(){
		Scrollbar.initAll();
	}	
	
	/**
	 *
	 */
	Drupal.behaviors.someArbitraryKey = {
		attach: function(context, settings) {
			ActiveAcrollbar(context);
		}
	};
}(jQuery, Drupal));