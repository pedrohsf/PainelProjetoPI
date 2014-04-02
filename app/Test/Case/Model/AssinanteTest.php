<?php
App::uses('Assinante', 'Model');

/**
 * Assinante Test Case
 *
 */
class AssinanteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.assinante'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Assinante = ClassRegistry::init('Assinante');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Assinante);

		parent::tearDown();
	}

}
