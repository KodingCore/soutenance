<?php

class Project
{

    private ?int $project_id;
    private int $user_id;
    private string $project_name;
    private string $description;
    private DateTime $completion_date;
    private string $technologies_used;
    private bool $request_quote;
   
    public function __construct(int $user_id, string $project_name, string $description, DateTime $completion_date, string $technologies_used, bool $request_quote)
    {
       $this->project_id = null;
       $this->user_id = $user_id;
       $this->project_name = $project_name;
       $this->description = $description;
       $this->completion_date = $completion_date;
       $this->technologies_used = $technologies_used;
       $this->request_quote = $request_quote;
    }
    
    public function getProjectId() : ?int{  return $this->project_id;  }
    public function setProjectId(int $project_id){   $this->project_id = $project_id;  }

    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getProjectName() : string{  return $this->project_name;  }
    public function setProjectName(string $project_name){   $this->project_name = $project_name;  }

    public function getDescription() : string{  return $this->description;  }
    public function setDescription(string $description){   $this->description = $description;  }

    public function getCompletionDate() : DateTime{  return $this->completion_date;  }
    public function setCompletionDate(DateTime $completion_date){   $this->completion_date = $completion_date;  }

    public function getTechnologiesUsed() : string{  return $this->technologies_used;  }
    public function setTechnologiesUsed(string $technologies_used){   $this->technologies_used = $technologies_used;  }

    public function getRequestQuote() : bool{  return $this->request_quote;  }
    public function setRequestQuote(bool $request_quote){   $this->request_quote = $request_quote;  }
}
?>