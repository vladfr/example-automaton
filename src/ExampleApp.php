<?php

use State\CalculatingState;
use State\InitializingState;
use State\SynchronizingState;
use State\InvalidState;

class ExampleApp {
	public function boot()
	{
		$payload = new ArrayObject(array(
			'data'				=> array(),
			'flags'				=> array(
				'calculated'	=> null,
				'synchronized'	=> null,
			),
		));

		$state = new InitializingState();
		$state->setPayload($payload);
		
		return $state;
	}
	
	public function run($state)
	{
		try {
			try {
				try {
					echo $state->getName() . ': ' . $state->getDescription() . "<br/>\n";

					$state->execute();
				} catch(CalculatingState $state) {
					echo $state->getName() . ': ' . $state->getDescription() . "<br/>\n";

					$state->execute();
				}
			} catch (SynchronizingState $state) {
				echo $state->getName() . ': ' . $state->getDescription() . "<br/>\n";

				$state->execute();
			}
		} catch (InvalidState $state) {
			echo $state->getName() . ': ' . $state->getDescription() . "<br/>\n";
		}
	}
}
