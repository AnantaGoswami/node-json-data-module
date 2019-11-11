<?php 

namespace Drupal\node_json_data\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;

/**
 * Contains SiteApiKeyController controller.
 * 
 * Class for defining basic methods of Axelerant SiteAPIKey module.
 */
class NodeJsonDataController extends ControllerBase {

	public function checkAccess($apikey, $node_id) {
	  
  $storedapiKey = \Drupal::configFactory()->get('api_key.settings')->get('api_key');

  if ($storedapiKey == $apikey) {
  	$values = \Drupal::entityQuery('node')->condition('nid', $node_id)->execute();
  	if(in_array($node_id, $values))
  	{
  		$node= Node::load($node_id);
  		$nodeData = $node->toArray();
      return new JsonResponse($nodeData);
  	}
  }
  $response = "Failure";
   return ['#markup' => $response];
	 
	 
 }
}
