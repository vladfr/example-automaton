<?php

namespace State;

class SynchronizingState extends AbstractState {
	protected static $id	= 1;
	protected static $name	= 'synchronizing';
	protected static $transitions = array();

	public function execute()
	{
		static::$payload['flags']['synchronized']	= true;
	}

	public function entryCriteria($payload)
	{
		return	!$payload['flags']['synchronized'];
	}

	public function exitCriteria($payload)
	{
		return	 $payload['flags']['synchronized'];
	}
}
