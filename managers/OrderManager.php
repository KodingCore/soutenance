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
    
    public function insertOrder(Order $order)
    {
        $query = $this->db->prepare("INSERT INTO orders(user_id, order_date, total_amount, status, payment_terms) VALUES(:user_id, :order_date, :total_amount, :status, :payment_terms");
        $parameters = [
            "user_id" => $order->getUserId(),
            "order_date" => $order->getOrderDate(),
            "total_amount" => $order->getTotalAmount(),
            "status" => $order->getStatus(),
            "payment_terms" => $order->getPaymentTerms()
        ];
        $query->execute($parameters);
    }
}
?>