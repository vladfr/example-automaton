<?php

namespace State;

interface StateInterface {
	function getPayload();

	function getId();
	function getName();
	function getDescription();
	function getTransitions();
	function getCriteria();

	function execute();
	function transition($transition);
}
