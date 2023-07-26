<?php

class Order
{

    private ?int $order_id;
    private int $user_id;
    private DateTime $order_date;
    private int $total_amount;
    private string $status;
    private DateTime $payment_terms;
   
    public function __construct(int $user_id, int $total_amount, string $status, DateTime $payment_terms)
    {
       $this->order_id = null;
       $this->user_id = $user_id;
       $this->order_date = //time Now
       $this->total_amount = $total_amount;
       $this->status = $status;
       $this->payment_terms = $payment_terms;
    }
    
    public function getOrderId() : ?int{  return $this->order_id;  }
    public function setOrderId(int $order_id){   $this->order_id = $order_id;  }

    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getOrderDate() : DateTime{  return $this->order_date;  }
    public function setOrderDate(DateTime $order_date){   $this->order_date = $order_date;  }

    public function getTotalAmount() : int{  return $this->total_amount;  }
    public function setTotalAmount(int $total_amount){   $this->total_amount = $total_amount;  }

    public function getStatus() : string{  return $this->status;  }
    public function setStatus(string $status){   $this->status = $status;  }

    public function getPaymentTerms() : DateTime{ return $this->payment_terms; }
    public function setPaymentTerms($payment_terms){ $this->payment_terms = $payment_terms; }
}
?>