<?php
namespace Jovis\HTMLTable;

/** tar resultatet från en databasfråga och placerar ut i en HTML tabell, 
* inklusive länkar och hantering av paginering och sortering 
*
*/

class CHTMLTable{ 
  
  private $data;
  
  public function __construct($data){
    $this->data = $data;
  }
 
 /**
 * Function to create links for sorting
 *
 * @param string $column the name of the database column to sort by
 * @return string with links to order by column.
 */
 
 /**
  * skapar en sträng innehållande html-kod för en tabell för att visa resultatet från utsökningen
  *
  */
   
  public function getTable(){
    
    $table = "";
    
    $table = "<div class='dbtable'>
      <table class>
        <tr class='rows'>";
        
   foreach($this->data as $d) {
     foreach ($d as $key=>$value) {
       $table.= "<th>" . $key ."</th>";
     }
     break;
   }
   $table .= "</tr>";
   foreach($this->data as $d){
     $table .= "<tr>";  
     foreach ($d as $v) {
       $table .= "<td>$v</td>";
     }
     $table .= "</tr>";
   }
   $table .="</table></div>";
    
   return $table;
  }
}
