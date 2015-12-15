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
   * Lists all instances of the model, (databasetable) except for noListing.
   *
   * @param $noListing params not to be listed
   * @param $model model object to list (create an html table from) 
   *
   * @return void
   */
  public function listAction($noListing = NULL, $model)
  {

      $this->model = $model;
      $this->model->setDI($this->di);
   
      $all = $this->model->findAll();
      
      $aContent;
      
      //gör om arrayen av objekt till en array av arrayer
      foreach ($all as $key1=>$value) {
        foreach ($value as $key2=>$v){
          if (!in_array($key2, $noListing)) { //$noListing, parametrar som inte ska vara med
              $aContent[$key1][$key2] = $v;
          }
        }
      }
     
      
      $aHeading = [];
      //hittar objektens parametrar/tabellens kolumnnamn och skapar
      //en ny array av rubriker
      foreach ($all as $key1=>$value) {
        foreach ($value as $key2=>$v){
          if (!in_array($key2, $noListing)) { //$noListing, parametrar som inte ska vara med
              $aHeading[] = $key2;
          }
        }
        break;  
      }
      
      $this->chtml = new \Jovis\HTMLTable\CHTMLTable($aHeading, $aContent);
      
      $htmltable = $this->chtml->getTable();
      $source = $this->model->getSource();
      
   
      $this->theme->setTitle("Visa alla användare");
      $this->views->add('table/list-all', [
          'title' => $source,
          'htmltable' => $htmltable,
      ]);
  }
  
   public function initAction($model){ //används för att befolka databasen, bara för att testa
    $model->setDI($this->di);
    $model->init();
  }
}

?>
