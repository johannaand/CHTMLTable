<?php
namespace Jovis\HTMLTable;
/**
 * A testclass
 *
 */
class CHTMLTableTest extends \PHPUnit_Framework_TestCase
{
   /**
     * Test
     *
     * @return void
     *
     */
    public function testgetTable()
    {
	$headline = array("Title", "Description", "Date");

	$data =   array([ 
    	'Title' => 'Me', 
    	'Description' => 'The story about me',
	'Date' => '2015-01-16'	
    	], 
    	[
    	'Title' => 'You', 
    	'Description' => 'The Wonderful You',
	'Date' => '2015-12-15'
    	]
	);


        $table = new \Jovis\HTMLTable\CHTMLTable($headline, $data);

        
	$res = $table->getTable();
	$res = preg_replace('/\s+/', '', $res);

	$exp = "<div class='dbtable'>
     	  <table class>
            <tr class='rows'>
		<th>Title</th><th>Description</th><th>Date</th>
	  </tr>
	<tr>
	<td>Me</td><td>The story about me</td><td>2015-01-16</td>
	</tr>
	<tr>
	<td>You</td><td>The Wonderful You</td><td>2015-12-15</td>
	</tr></table></div>";

	$exp = preg_replace('/\s+/', '', $exp);

        $this->assertEquals($res, $exp, "Something went wrong in creating the table");
    }
}
