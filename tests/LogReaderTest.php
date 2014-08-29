<?php
include_once '../lib/LogReader.php';
include_once '../lib/Emailer.php';
class LogReaderTest extends PHPUnit_Framework_TestCase
{
    /*
     * @test
     */
    function test_read_pattern()
    {
        $builder = $this->getMockBuilder('Emailer');
        $builder->setMethods(array('update'));
        $builder->disableOriginalConstructor();
        $builder->disableOriginalClone();
        $emailer = $builder->getMock();
        
        $log_reader = new LogReader('../testlog.log', 'MEET');
        
        $emailer->expects($this->exactly(2))     /*testlog.log has 2 occurences of MEET*/
                ->method('update')
                ->with($this->equalTo($log_reader));
        
        /*Positive case with existing file*/
        
        $log_reader->attach($emailer);
        $result = $log_reader->read_pattern();
        $this->assertTrue($result);
    }
    
    /**
     * @expectedException PHPUnit_Framework_Error
     * @test
     */
    function test_negative_file_not_found()
    {
        $builder = $this->getMockBuilder('Emailer');
        $builder->setMethods(array('update'));
        $builder->disableOriginalConstructor();
        $builder->disableOriginalClone();
        $emailer = $builder->getMock();
        
        /*Negative case with Nonexisting file*/
        $log_reader = new LogReader('wrongfile.log', 'MEET');
        $log_reader->attach($emailer);
        $result = $log_reader->read_pattern();
        $this->assertFalse($result);
    } 
    
}