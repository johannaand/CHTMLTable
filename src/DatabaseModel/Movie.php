<?php

namespace Jovis\DatabaseModel;



class Movie extends \Jovis\DatabaseModel\CDatabaseModel
{
         
  public function init()
  {
    $this->db->dropTableIfExists('movie')
                 ->execute();
        
        $this->db->createTable(
                        'movie',
                        [
                            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                            'title' => ['varchar(100)', 'not null'],
                            'director' => ['varchar(100)'],
                            'length' => ['integer'],  
                            'year' => ['integer', 'not null'],
                        ]);
        
        $this->db->execute();
        
        
        $this->db->insert(
            'movie',
            ['title', 'director', 'length', 'year']
         );
            
         $this->db->execute(['Kalles drömmar', 'Gustav Andersson', '120', '1977']);
         
         $this->db->insert(
            'movie',
            ['title', 'director', 'length', 'year']
         );
            
         $this->db->execute(['Gustavs drömmar', 'Kalle Andersson', '101', '2007']);
         
         $this->db->insert(
            'movie',
            ['title', 'director', 'length', 'year']
         );
            
         $this->db->execute(['Mammas drömmar', 'Johanna Andersson', '25', '2010']);
         
         $this->db->insert(
            'movie',
            ['title', 'director', 'length', 'year']
         );
            
         $this->db->execute(['Goda kakor', 'Hannes Andersson', '110', '1954']);
            
  }
}
