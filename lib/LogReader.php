<?php
/* SVN FILE: $Id$ */
/**
 * LogReader
 * API to read Log file and notify the observer to take action.
 * PHP versions 5.x
 * @author Meet Singh
 */
include_once 'Observable.php';

class LogReader implements ObservableInterface
{
    /**
    * Array of observers.
    *
    * @var    array
    * @access private
    */
    private $observers = array();
    
    /**
    * Name of file to read to read the pattern notify observer.
    *
    * @var    string
    * @access private
    */
    private $filename;
    /**
    * Pattern to be searched in file.
    *
    * @var    string
    * @access private
    */
    private $pattern;
    
    /**
     * Pattern to be searched in file.
     *
     * @var    string
     * @access private
    */
    private $message;
    
    /**
    * Constructs a LogReader Object
    *
    * @param string $filename
    * @param string $pattern
    * @access public
    */
    public function __construct($filename, $pattern)
    {
        $this->filename = $filename;
        $this->pattern = $pattern;
    }
    
    /**
    * attach the observer
    * @param ObserverInterface $observer
    * @access public
    * @return void
    */
    public function attach(ObserverInterface $observer) 
    {
        $this->observers[] = $observer;
    }

    /**
     * detach the observer
     * @param ObserverInterface $observer
     * @access public
     * @return void
     */
    public function detach(ObserverInterface $observer)
    {
        foreach($this->observers as $key => $val) {
            if ($val === $observer) {
                unset($this->observers[$key]);
            }
        }
    }
    
    /**
    * Notify the Observers attached.
    * @access public
    * @return void
    */
    public function notify()
    {
        foreach($this->observers as $observer) {
            $observer->update($this);
        }
    }
    /**
    * Read the Log and notify if pattern found
    * @access public
    * @return boolean
    */
    public function read_pattern()
    {
        $handle = @fopen("$this->filename", "r");
        if ($handle) {
        	$line_count = 0;
            while (($buffer = fgets($handle, 4096)) !== false) {
                $line_count++;
                if (preg_match("/$this->pattern/i", $buffer)) {
                    $this->set_message("PATTERN $this->pattern FOUND ON LINE NUMBER $line_count : \n $buffer \n");
                    $this->notify();
                }
            }
            if (!feof($handle)) {
                trigger_error("LogReader::read_pattern : unexpected fgets() fail.");
                return false;
            }
            fclose($handle);
            return true;
        }else{
            trigger_error("LogReader::read_pattern : unable to open file $this->filename");
            return false;
        }
    }
    
    /**
     * Set the message
     * @access private
     * @return void
     */
    private function set_message($message)
    {
        $this->message = $message;
    }
    
    /**
     * Get method for message
     * @access private
     * @return void
     */
    public function get_message()
    {
        return $this->message;
    }
    
}