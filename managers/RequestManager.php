<?php

class RequestManager extends AbstractManager
{
    
    public function getRequests() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM requests");
        $query->execute();
        $requests = $query->fetchAll(PDO::FETCH_ASSOC);
        if($requests)
        {
            $requestsTab = [];
            foreach($requests as $request)
            {
                $requestInstance = new Request($request["user_id"], $request["category_id"], $request["checkboxes_binaries"], $request["content_share"], $request["description"]);
                $requestInstance->setRequestId($request["request_id"]);
                array_push($requestsTab, $requestInstance);
            }
            return $requestsTab;
        }
        else
        {
            return null;
        }
    }

    public function insertRequest(Request $request)
    {
        $query = $this->db->prepare("INSERT INTO requests (user_id, category_id, checkboxes_binaries, content_share, description) VALUES(:user_id, :category_id, :checkboxes_binaries, :content_share, :description)");
        $parameters = [
            "user_id" => $request->getUserId(),
            "category_id" => $request->getCategoryId(),
            "checkboxes_binaries" => $request->getCheckboxesBinaries(),
            "content_share" => $request->getContentShare(),
            "description" => $request->getDescription(),
        ];
        $query->execute($parameters);
    }

    public function deleteRequestByRequestId(int $request_id)
    {
        $query = $this->db->prepare("DELETE FROM requests WHERE request_id = :request_id");
        $parameters = [
            "request_id" => $request_id
        ];
        $query->execute($parameters);
    }

    public function deleteRequestByUserId(int $user_id)
    {
        $query = $this->db->prepare("DELETE FROM requests WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
    }

    public function deleteRequestByCategoryId(int $category_id)
    {
        $query = $this->db->prepare("DELETE FROM requests WHERE category_id = :category_id");
        $parameters = [
            "category_id" => $category_id
        ];
        $query->execute($parameters);
    }

    public function editRequest(Request $request)
    {
        $query = $this->db->prepare("UPDATE requests SET user_id = :user_id, category_id = :category_id, checkboxes_binaries = :checkboxes_binaries, content_share = :content_share, description = :description WHERE request_id = :request_id");
        $parameters = [
            "user_id" => $request->getUserId(),
            "category_id" => $request->getCategoryId(),
            "checkboxes_binaries" => $request->getCheckboxesBinaries(),
            "content_share" => $request->getContentShare(),
            "description" => $request->getDescription(),
            "request_id" => $request->getRequestId(),
        ];
        $query->execute($parameters);
    }

    public function getRequestByRequestId(int $request_id) : ? Request
    {
        $query = $this->db->prepare("SELECT * FROM requests WHERE request_id = :request_id");
        $parameters = [
            "request_id" => $request_id
        ];
        $query->execute($parameters);
        $request = $query->fetch(PDO::FETCH_ASSOC);
        if($request)
        {
            $requestInstance = new Request($request["user_id"], $request["category_id"], $request["checkboxes_binaries"], $request["content_share"], $request["description"]);
            $requestInstance->setRequestId($request["request_id"]);
            return $requestInstance;
        }
        else
        {
            return null;
        }
    }
}