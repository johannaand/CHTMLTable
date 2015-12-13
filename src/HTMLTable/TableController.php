<?php

namespace Jovis\HTMLTable;
 
/**
 * A controller for creating a html table from a movie model.
 *
 */
class TableController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
      
   /**
   * List all movies.
   *
   * @return void
   */
  public function listAction($noListing = NULL, $classpath='Anax\Users\User')
  {

      $this->class = new $classpath();
      $this->class->setDI($this->di);
   
      $all = $this->class->findAll();
      
      $aContent;
      
      //gör om arrayen av objekt till en array av arrayer
      foreach ($all as $key1=>$value) {
        foreach ($value as $key2=>$v){
          if (!in_array($key2, $noListing)) {
              $aContent[$key1][$key2] = $v;
          }
        }
      }
     
      
      $aHeading = [];
      //hittar objektens parametrar/tabellens kolumnnamn och skapar
      //en ny array av rubriker
      foreach ($all as $key1=>$value) {
        foreach ($value as $key2=>$v){
          if (!in_array($key2, $noListing)) {
              $aHeading[] = $key2;
          }
        }
        break;  
      }
      
      $this->chtml = new \Anax\HTMLTable\CHTMLTable($aContent);
      
      $htmltable = $this->chtml->getTable();
      $source = $this->class->getSource();
      
   
      $this->theme->setTitle("Visa alla användare");
      $this->views->add('table/list-all', [
          'title' => $source,
          'htmltable' => $htmltable,
      ]);
  }
}

?>
