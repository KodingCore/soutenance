<?php

class QuoteRequest
{

    private ?int $request_id;
    private int $project_id;
    private int $user_id;
    private DateTime $request_date;
    private string $message;
   
    public function __construct(string $project_id, string $user_id, DateTime $request_date, string $message)
    {
        $this->request_id = null;
        $this->project_id = $project_id;
        $this->user_id = $user_id;
        $this->request_date = $request_date;
        $this->message = $message;
    }

    public function getRequestId() : ?int{  return $this->request_id;  }
    public function setRequestId(int $request_id){   $this->request_id = $request_id;  }
    
    public function getProjectId() : int{  return $this->project_id;  }
    public function setProjectId(int $project_id){   $this->project_id = $project_id;  }

    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getRequestDate() : DateTime{  return $this->request_date;  }
    public function setRequestDate(DateTime $request_date){   $this->request_date = $request_date;  }

    public function getMessage() : string{  return $this->message;  }
    public function setMessage(string $message){   $this->message = $message;  }

}
?>