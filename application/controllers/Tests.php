<?php

class Tests extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Perform all the tests in this suite
	 */
	public function all() {
		// systems online
		$this->_init();

		$allTests = array('fdaModelTests');

		// run through each test
		foreach ($allTests as $test) {
			$this->$test($this->unit);
		}

		// cleanup
		$this->_destroy();
	}

	/**
	 * Perform tests related to the fda_model
	 */
	public function fdaModelTests($unit = false) {
		$this->_init($unit);
		
		$this->load->model('fda_model');
		$this->fda_model->unitTests($this->unit);

		$this->_destroy($unit);
	}

	/**
	 * Perform unitTest entry duties
	 */
	private function _init($unit = false) {
		// only do anything if we haven't been passed a unit_test object
		if (!$unit) {
			// set it up for (nicer) html output
			echo '<!DOCTYPE html><html><head><title>Unit Tests</title></head><body><div style="font-family: sans-serif">';
			// load unit_test itself
			$this->load->library('unit_test');
			$this->unit->use_strict(true);
		}
	}

	/**
	 * Perform unitTest exit duties
	 */
	private function _destroy($unit = false) {
		// only do anything if we haven't been passed a unit_test object
		if (!$unit) {
			// Run through the list and count our successes
			$results = $this->unit->result();
			$total  = count($results);
			$passed = 0;
			$failed = 0;
			foreach ($this->unit->result() as $result) {
				if ($result['Result'] === 'Passed') {
					$passed++;
				}
			}
			$failed = $total - $passed;

			echo "<p>Passed: <span style=\"color:green\">{$passed}</span><br/>Failed: <span style=\"color:red\">{$failed}</span><br>Total: {$total}</p>";
			echo "</div></body></html>";
		}
	}
}

?>
