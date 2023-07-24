<?php

class QuoteRequestManager extends AbstractManager
{
    
    public function index() : array
    {
        $query = $this->db->prepare("SELECT * FROM quote_requests");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $quote_requestsTab = [];
        foreach($results as $quote_request)
        {
            $quote_requestInstance = new QuoteRequest($quote_request["project_id"], $quote_request["user_id"], $quote_request["request_date"], $quote_request["message"]);
            $quote_requestInstance->setRequestId($quote_request["request_id"]);
            array_push($quote_requestsTab, $quote_requestInstance);
        }
        return $quote_requestsTab;
    }
    
}
?>