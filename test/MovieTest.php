<?php
namespace Jovis\DatabaseModel;
/**
 * A testclass
 *
 */
class MovieTest extends \PHPUnit_Framework_TestCase
{
	
	static private $movie;	
	static private $db;	

   /**
     * Test
     *
     * @return void
     *
     */
     
     
    public static function setUpBeforeClass()
    {
       
        
        $di = new \Anax\DI\CDIFactoryDefault();
            
		$di->setShared('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(['dsn' => "sqlite:memory::", 'debug_connect' => true]);
            $db->connect();
            return $db;
        });    

        
        self::$movie = new \Jovis\DatabaseModel\Movie();        
        self::$movie->setDI($di);
        self::$movie->init();
   	} 
     
    public function testgetSource()
    {
		$res = self::$movie->getSource();
		$exp = "movie";
        
		$this->assertEquals($res, $exp, "Not the Class name we expected");
    }
    
    public function testfindAll()
    {
		$resA = self::$movie->findAll();
		$resB = array();
		
		foreach($resA as $keyr=>$valr){
			foreach($valr as $key=>$val) {
				$resB[$keyr][$key] = $val;
			}
		}
			
		
		$exp = Array(
			0 => Array
			(
				'id' => '1',
				'title' => 'Kalles drömmar',
				'director' => 'Gustav Andersson',
				'length' => '120',
				'year' => '1977'
			),
			1 => Array
			(
				'id' => '2',
				'title' => 'Gustavs drömmar',
				'director' => 'Kalle Andersson',
				'length' => '101',
				'year' => '2007'
			),
			
			2 => Array
			(
				'id' => '3',
				'title' => 'Mammas drömmar',
				'director' => 'Johanna Andersson',
				'length' => '25',
				'year' => '2010'
			),

			3 => Array
			(
				'id' => '4',
				'title' =>'Goda kakor',
				'director' => 'Hannes Andersson',
				'length' => '110',
				'year' => '1954'
			),
		);
        
		$this->assertEquals($resB, $exp, "Array with resultset not as expected");
    }
    
    public function testgetProperties()
    {
		self::$movie->setProperties(array('id' => '7', 'title' => 'Hopp', 'director'=>'Jag', 'length' => '5', 'year' => '1977'));
		$res = self::$movie->getProperties();
				
		$exp = Array('id'=> '7', 'title' => 'Hopp', 'director'=>'Jag', 'length' => '5', 'year' => '1977');

        
		$this->assertEquals($res, $exp, "Array with properties not as expected");
    }
    
    public function testFind() 
    {
		$resA = self::$movie->find(1);	
		
		
		foreach($resA as $keyr=>$valr){
			$resB[$keyr] = $valr;
		}
		
		$res = $resB['title'];
		$exp =  'Kalles drömmar';
		
		$this->assertEquals($res, $exp, "Array result not as expected");
	}
	
	public function testSaveandDelete()
	{
		self::$movie->init();
		
		$arr = array('id' => '3',
            'title' => 'Change title',
            'director' => 'Change Director',
            'length' => '214',
            'year' => '2015',
		);
		
		$res = self::$movie->save($arr);
		
		$exp = TRUE;
		
		$this->assertEquals($res, $exp, "Save with id not as expected");
		
		$res = self::$movie->save(array(
            'title' => 'New title',
            'director' => 'New Director',
            'length' => '204',
            'year' => '2016',
		));
		
		$exp = TRUE;
		
		$this->assertEquals($res, $exp, "Save without id not as expected");
		
		$res = self::$movie->delete('5');
		$exp = TRUE;
		
		$this->assertEquals($res, $exp, "Delete not as expected");
		
	}
        
    public function testQuery()
    {
		self::$movie->init();
		$resA = self::$movie->query('id')->where("title = 'Mammas drömmar'")->andwhere("length = 25")->execute();
		//	->where("title = Mammas drömmar")->andwhere("length = 25");
		$res;

		foreach($resA as $key=>$val){
			foreach($val as $v=>$r){
				$res =$r;
			}
		}
	
		$exp = 3;
		$this->assertEquals($res, $exp, "Array result not as expected");
	}
}
 
