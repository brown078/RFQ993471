<?php

class Fda_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Perform a search of the OpenFDA API
	 */
	public function search($term, $returnObject = false) {
		///implicitly remove error reporting can be changed to 1 to turn on
		error_reporting(0);

		$data = "";
		$dataObj = null;

		// check the cache to save a remote request
		$cachedResult = $this->_getCache($term);
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
			$this->_setCache($term, $data);
		}
		else {
			// cache hit. use it
			$data = $cachedResult;
			$dataObj = json_decode($data);
		}

		return $returnObject ? $dataObj : $data;
	}


	/**
	 * Look for a specific search term in our local database. This should help avoid too many requests to a remote server.
	 */
	private function _getCache($term) {
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
	private function _setCache($term, $response) {
		// prepare the cache entry
		$cacheEntry = array(
			'Term' => $term,
			'Data' => $response,
			// cache entries are retained for 24 hours
			'Expires' => date("Y-m-d H:i:s", strtotime("+1 day"))
		);

		// remove any stale cache entries for this term
		$this->_invalidateCache($term);
		// add this entry
		$this->db->insert('Cache', $cacheEntry);
	}

	/**
	 * Remove a cache entry from the database.
	 */
	private function _invalidateCache($term) {
		// We could set its expiration to sometime in the past, but we'll just remove it outright.
		$this->db->delete('Cache', array('Term' => $term));
	}



	/**
	 * Unit Tests for private functionality
	 */
	public function unitTests($unit) {
		echo "<p>Search Results Tests:</p><ul>";
		
		echo "<li>Known Valid Search";
		$searchStr = $this->search("motrin");
		$searchObj = $this->search("motrin", true);

		echo $unit->run($searchStr,'is_string', 'String Requested, String Returned');
		echo $unit->run($searchObj,'is_object', 'Object Requested, Object Returned');
		echo $unit->run($searchObj->error,'is_null', 'Error object is null');
		echo $unit->run(count($searchObj->results) > 0, true, "Result object results array has contents.");

		echo "</li>";

		echo "<li>Known Invalid Search";
		$searchStr = $this->search("wallbutrin");
		$searchObj = $this->search("wallbutrin", true);

		echo $unit->run($searchStr,'is_string', "String Requested, String Returned");
		echo $unit->run($searchObj,'is_object', "Object Requested, Object Returned");
		echo $unit->run($searchObj->error, 'is_object', "Error object is valid");
		echo $unit->run($searchObj->error->code, 'NOT_FOUND', "Error object contains code NOT_FOUND");

		echo "</li>";

		echo "<li>Empty Search";
		$searchStr = $this->search("");
		$searchObj = $this->search("", true);

		echo $unit->run($searchStr, 'is_string', "String Requested, String Returned");
		echo $unit->run($searchObj, 'is_object', "Object Requested, Object Returned");
		echo $unit->run($searchObj->error, 'is_object', "Error object is valid");
		echo $unit->run($searchObj->error->code, 'NOT_FOUND', "Error object contains code NOT_FOUND");

		echo "</li>";

		echo "</ul>";

		echo "<p>Cache Results Tests</p><ul>";
		$cacheTerm = "testingTerm";
		$cacheDataIn = json_encode(array('test' => true, 'error' => false));

		echo "<li>Cache sanity";
		$this->_setCache($cacheTerm, $cacheDataIn);
		$cacheDataOut = $this->_getCache($cacheTerm);

		echo $unit->run($cacheDataOut, $cacheDataIn, "Cache returns the same values it was given");

		$this->_invalidateCache($cacheTerm);
		$fetchResult = $this->_getCache($cacheTerm);

		echo $unit->run($fetchResult, 'is_false', "Invalidated cache entry does not return a result");

		echo "</li>";

		echo "<li>Cache actually used and updated by search";
		$cacheTerm = 'motrin';
		$this->_invalidateCache($cacheTerm);
		$fetchResult = $this->_getCache($cacheTerm);

		echo $unit->run($fetchResult, 'is_false', "Known Search cache invalidated");
		$searchResult = $this->search($cacheTerm);

		echo $unit->run($searchResult, 'is_string', "Known Search returns string");

		$fetchResult = $this->_getCache($cacheTerm);
		echo $unit->run($searchResult, $fetchResult, "Known search and cache entry match");

		$searchResult2 = $this->search($cacheTerm);
		echo $unit->run($searchResult2, $searchResult, "Search returns same on cache miss and hit");

		echo "</li>";
		echo "</ul>";
	}
}
