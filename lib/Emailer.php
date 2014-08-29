<?php
/**
 * Emailer
 * Implements ObserverInterface to send email to user once updated by Observable object.
 * PHP versions 5.x
 * @author Meet Singh
 */
include_once 'Observer.php';
class Emailer implements ObserverInterface{
    
    /**
    * Email recipent.
    *
    * @var    string
    * @access private
    */
    private $recipent;
    
    /**
    * Subject of Email.
    *
    * @var    string
    * @access private
    */
    private $subject;
    
    /**
    * Body of email
    *
    * @var    string
    * @access private
    */
    private $body;
    
    /**
    * header of email.
    *
    * @var    string
    * @access private
    */
    private $headers;

    /**
    * Constructs a LogReader Object
    *
    * @param string $recipent
    * @param string $subject
    * @param string $body
    * @param string $headers
    * @access public
    */
    public function __construct($recipent, $subject, $body, $headers = '')
    {
        $this->recipent = $recipent;
        $this->subject = $subject;
        $this->body = $body;
                
        if( empty($headers) ){
            $this->headers = 'From: snghmeet@gmail.com' . "\r\n" .
                'Reply-To: snghmeet@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        }
    }
    
    /**
    * Call send_mail once notified
    *
    * @access public
    * @return void
    */
    public function update(ObservableInterface $observable)
    {
        $message = $observable->get_message();
        $this->send_mail($message);
    }
    
    /**
    * Send Email to User
    *
    * @access public
    * @return void
    */
    public function send_mail($message)
    {	
        $message = $this->body.$message;
        if( mail($this->recipent, $this->subject, $message, $this->headers) ){
            trigger_error("Emailer::sendmail : Unable to send email.");
            return false;
        }
        return true;
    }
}