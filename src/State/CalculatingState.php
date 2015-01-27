<?php

namespace State;

class CalculatingState extends AbstractState {
	protected static $id			= 1;
	protected static $name			= 'calculating';
	protected static $transitions	= array(
		'State\\SynchronizingState'
	);

	public function execute()
	{
		static::$payload['flags']['calculated']	= true;

		$this->transition('State\\SynchronizingState');
	}

	public function entryCriteria($payload)
	{
		return	$payload['flags']['calculated'];
	}

	public function exitCriteria($payload)
	{
		return	 $payload['flags']['calculated'];
	}
}
