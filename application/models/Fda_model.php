<?php

class Fda_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Perform a search of the OpenFDA API
	 */
	public function search($term) {
		///implicitly remove error reporting can be changed to 1 to turn on
		error_reporting(0);

		$data = "";
		$dataObj = null;

		// check the cache to save a remote request
		$cachedResult = $this->getCache($term);
		// anything?
		if ($cachedResult === false) {
			// no cache. let's ask for help
			
			// we'll attempt to search on each of these fields
			$searchAttempts = array('openfda.brand_name', 'openfda.generic_name');
			foreach ($searchAttempts as $search) {
				// grab the search results
				$data = file_get_contents("https://api.fda.gov/drug/label.json?api_key=TwOhEwWWk1eGlkFl8n1HHCn93bmJity6AZbQGHpj&search={$search}:\"{$term}\"");
				// grab the object from the JSON response
				$dataObj = json_decode($data);

				// have we encountered an error?
				if (!isset($dataObj->error)) {
					// nope. use what we've got
					break;
				}
			}
			#if (!isset($dataObj->error)) {
				$this->setCache($term, $data);
			#}
		}
		else {
			// cache hit. use it
			$data = $cachedResult;
			$dataObj = json_decode($data);
		}

		return $data;
	}


	/**
	 * Look for a specific search term in our local database. This should help avoid too many requests to a remote server.
	 */
	private function getCache($term) {
		// find our search term
		$result = $this->db->get_where('Cache', array('Term' => $term, 'Expires >' => date("Y-m-d H:i:s")))->row_array();
		// did we get one that isn't expired?
		if ($result) { 
			// cache hit
			return $result['Data'];
		}
		// cache miss
		return false;
	}

	/**
	 * Store a response from a remote server into our local cache database.
	 */
	private function setCache($term, $response) {
		// prepare the cache entry
		$cacheEntry = array(
			'Term' => $term,
			'Data' => $response,
			// cache entries are retained for 24 hours
			'Expires' => date("Y-m-d H:i:s", strtotime("+1 day"))
		);

		// remove any stale cache entries for this term
		$this->db->delete('Cache', array('Term' => $term));
		// add this entry
		$this->db->insert('Cache', $cacheEntry);
	}

}
