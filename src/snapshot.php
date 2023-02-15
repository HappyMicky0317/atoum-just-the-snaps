<?php
declare(strict_types=1);

namespace tests\units;

use mageekguy\atoum;

class snapshot extends atoum\asserters\variable {
	private $justSnapsDirectory = './tests/__snapshots__';

	public function hasNotChanged($failMessage = null) {
		$asserter = \JustSnaps\buildSnapshotAsserter($this->justSnapsDirectory);
		$actualFailMessage = $failMessage ?? $this->_('The snapshot does not match');
		$testName = $this->getTest()->getClass();
		$isMatch = $asserter->forTest($testName)->assertMatchesSnapshot($this->getValue());
		$isMatch ? $this->pass() : $this->fail($actualFailMessage);
		return $this;
	}
}
