<?php
/* SVN FILE: $Id$ */
/**
 * Observer Interface
 *
 * PHP versions 5.x
 * @author Meet Singh
 */

interface ObserverInterface
{
	function update(ObservableInterface $observable);
}