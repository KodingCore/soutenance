<?php

class OrderManager extends AbstractManager
{
    
    public function index() : array
    {
        $query = $this->db->prepare("SELECT * FROM orders");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $ordersTab = [];
        foreach($results as $order)
        {
            $orderInstance = new Order($order["user_id"], $order["order_date"], $order["total_amount"], $order["status"]);
            $orderInstance->setOrderId($order["id"]);
        }
        return $ordersTab;
    }
    
}
?>