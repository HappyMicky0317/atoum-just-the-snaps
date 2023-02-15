<?php
declare(strict_types=1);

namespace tests\units\snapshot;

require_once(__DIR__ . '/../src/snapshot.php');

use atoum;

class snapshot extends atoum {
	public function __construct(
		adapter $adapter = null,
		annotations\extractor $annotationExtractor = null,
		asserter\generator $asserterGenerator = null,
		test\assertion\manager $assertionManager = null,
		\closure $reflectionClassFactory = null
	) {
		parent::__construct(
			$adapter,
			$annotationExtractor,
			$asserterGenerator,
			$assertionManager,
			$reflectionClassFactory
		);

		$this->getAsserterGenerator()->addNamespace('tests\units');
	}

	public function testThrowsExceptionWhenSnapshotIsMissing() {
		$this->exception(
			function () {
				$data = ['foo' => 'bar'];
				$this->snapshot($data)->hasNotChanged();
			}
		);
		$this->exception->isInstanceOf(\JustSnaps\CreatedSnapshotException::class);
	}
}
