<?php

use PHPUnit\Framework\TestCase; 
class Verify extends TestCase {
	public function __construct () {
		$this->awnser = 5;
	}
	public function exec($t) {
		return $this->egalite($t,$this->awnser);
	}
	public function egalite ($req,$rep) {
		try {
			$this->assertSame($req, $rep);	
			return "bonne reponse";
		} catch (Exception $e) {
			return "fake";
		}
	}

}

?>
