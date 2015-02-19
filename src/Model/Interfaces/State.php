<?php

namespace MS\Automaton\Model\Interfaces;

interface State
{
    function getPayload();

    function getId();

    function getName();

    function getDescription();

    function getTransitions();

    function getCriteria();

    function execute();

    function transition($transition);
}
