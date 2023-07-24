<?php

class CotationManager extends AbstractManager
{
    
   public function index() : array
   {
       $query = $this->db->prepare("SELECT * FROM cotations");
       $query->execute();
       $results = $query->fetchAll(PDO::FETCH_ASSOC);
       $cotationsTab = [];
       foreach($results as $cotation)
       {
           $cotationInstance = new Cotation($cotation["user_id"], $cotation["description"], $cotation["amount"], $cotation["date_created"]);
           $cotationInstance->setCotationId($cotation["id"]);
       }
       return $cotationsTab;
   }
    
}
?>