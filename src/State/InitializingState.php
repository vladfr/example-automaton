<?php

namespace State;

class InitializingState extends AbstractState {
	protected static $id			= 0;
	protected static $name			= 'initializing';
	protected static $transitions	= array(
		'State\\CalculatingState'
	);

	public function execute()
	{
		static::$payload['flags']['calculated']	= false;
		static::$payload['flags']['synchronized']	= false;

		$this->transition('State\\CalculatingState');
	}

	public function entryCriteria($payload)
	{
		return	$payload['flags']['calculated']		== null
			and	$payload['flags']['synchronized']	== null;
	}

	public function exitCriteria($payload)
	{
		return	$payload['flags']['calculated']		== false
			and	$payload['flags']['synchronized']	== false;
	}
}
