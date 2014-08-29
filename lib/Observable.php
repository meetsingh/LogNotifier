<?php
/* SVN FILE: $Id$ */
/**
 * Observable Interface
 * 
 * PHP versions 5.x
 * @author Meet Singh
 */
interface ObservableInterface
{
    function attach(ObserverInterface $observer);
    function detach(ObserverInterface $observer);
    function notify();
}