<?php

namespace State;

use Exception;

class AbstractState extends Exception {
	public function __construct() {
		if (!empty(static::$transitions)) {
			foreach (static::$transitions as $class) {
				$transitions = array();
				if (!is_string($class) and is_object($class)) {
					$class = get_class($class);
				}
				if (!isset(AbstractState::$transitions[$class])) {
					AbstractState::$transitions[$class] = new $class();
				}
				$transitions[$class] = AbstractState::$transitions[$class];
				static::$transitions = $transitions;
			}
		}
	}

	protected static $payload;
	public function getPayload()
	{
		return static::$payload;
	}
	public function setPayload($payload)
	{
		static::$payload = $payload;
	}


	protected static $id;
	public function getId()
	{
		return static::$id;
	}

	protected static $name;
	public function getName()
	{
		return static::$name;
	}

	protected static $description;
	public function getDescription()
	{
		return static::$description;
	}

	protected static $transitions = array();
	public function getTransitions()
	{
		return static::$transitions;
	}

	protected static $criteria = array(
		'entry'	=> array(array(null, 'entryCriteria')),
		'exit'	=> array(array(null, 'exitCriteria')),
	);
	public function getCriteria()
	{
		return static::$criteria;
	}

	public function execute()
	{
	}

	public function transition($transition)
	{
		$transitions = $this->getTransitions();
		if (!isset($transitions[$transition])) {
			$invalidState = new InvalidState();
			$invalidState::$description = 'The requested transition is not allowed';
			throw $invalidState;
		}
		$transition = $transitions[$transition];

		$criteria = $this->getCriteria();
		if (isset($criteria['exit'])) {
			foreach ($criteria['exit'] as $exitCriteria) {
				$exitCriteria[0] = $this;
				if ($exitCriteria($this->getPayload()) !== true) {
					$invalidState = new InvalidState();
					$invalidState::$description = 'The exit criteria were not met.';
					throw $invalidState;
				}
			}
		}

		$criteria = $transition->getCriteria();
		if (isset($criteria['entry'])) {
			foreach ($criteria['entry'] as $entryCriteria) {
				$entryCriteria[0] = $this;
				if ($entryCriteria($this->getPayload()) !== true) {
					$invalidState = new InvalidState();
					$invalidState::$description = 'The exit criteria were not met.';
					throw $invalidState;
				}
			}
		}

		$transition->setPayload($this->getPayload());

		throw $transition;
	}
}
