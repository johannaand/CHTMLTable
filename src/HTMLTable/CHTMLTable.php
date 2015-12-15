<?php
namespace Jovis\HTMLTable;

/** tar resultatet från en databasfråga och placerar ut i en HTML tabell, 
* inklusive länkar och hantering av paginering och sortering 
*
*/

class CHTMLTable{ 
  
  private $data;
  
  //tar emot en headline som enkel array och data som tvådimensionell array
  public function __construct($headline, $data){
    $this->data = $data;
    $this->headline = $headline;
  }
 
 /**
  * skapar en tabell (sträng) med rubriker från den endimensionella 
  * arrayen $headline och innehåll från
  * den tvådimensionella arrayen $data array
  *
  * @return string $html, sträng innehållande en tabell
  */
   
  public function getTable(){
    
    $table = "";
    
    $table = "<div class='dbtable'>
      <table class>
        <tr class='rows'>";
        
   foreach($this->headline as $h) {
      $table.= "<th>" . $h ."</th>";
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
