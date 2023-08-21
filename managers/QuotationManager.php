<?php

class QuotationManager extends AbstractManager
{
    
    public function getQuotations() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM quotations");
        $query->execute();
        $quotations = $query->fetchAll(PDO::FETCH_ASSOC);
        if($quotations)
        {
            $quotationsTab = [];
            foreach($quotations as $quotation)
            {
                $quotationInstance = new Quotation($quotation["user_id"], $quotation["template_id"], $quotation["quotation_date"], $quotation["content"], $quotation["expiration_date"]);
                $quotationInstance->setQuotationId($quotation["quotation_id"]);
                array_push($quotationsTab, $quotationInstance);
            }
            return $quotationsTab;
        }
        else
        {
            return null;
        }
    }

    public function insertQuotation(Quotation $quotation)
    {
        $query = $this->db->prepare("INSERT INTO quotations (user_id, template_id, quotation_date, content, expiration_date) VALUES(:user_id, :template_id, :quotation_date, :content, :expiration_date)");
        $parameters = [
            "user_id" => $quotation->getUserId(),
            "template_id" => $quotation->getTemplateId(),
            "quotation_date" => $quotation->getQuotationDate(),
            "content" => $quotation->getContent(),
            "expiration_date" => $quotation->getExpirationDate()
        ];
        $query->execute($parameters);
    }

    public function deleteQuotationByQuotationId(int $quotation_id)
    {
        $query = $this->db->prepare("DELETE FROM quotations WHERE quotation_id = :quotation_id");
        $parameters = [
            "quotation_id" => $quotation_id
        ];
        $query->execute($parameters);
    }

    public function editQuotation(Quotation $quotation)
    {
        $query = $this->db->prepare("UPDATE quotations SET user_id = :user_id, template_id = :template_id, quotation_date = :quotation_date, content = :content, expiration_date = :expiration_date WHERE quotation_id = :quotation_id");
        $parameters = [
            "user_id" => $quotation->getUserId(),
            "template_id" => $quotation->getTemplateId(),
            "quotation_date" => $quotation->getQuotationDate(),
            "content" => $quotation->getContent(),
            "expiration_date" => $quotation->getExpirationDate(),
            "quotation_id" => $quotation->getQuotationId()
        ];
        $query->execute($parameters);
    }

    public function getQuotationByQuotationId(int $quotation_id) : ? Quotation
    {
        $query = $this->db->prepare("SELECT * FROM quotations WHERE quotation_id = :quotation_id");
        $parameters = [
            "quotation_id" => $quotation_id
        ];
        $query->execute($parameters);
        $quotation = $query->fetch(PDO::FETCH_ASSOC);
        if($quotation)
        {
            $quotationInstance = new Quotation($quotation["user_id"], $quotation["template_id"], $quotation["quotation_date"], $quotation["content"], $quotation["expiration_date"]);
            $quotationInstance->setQuotationId($quotation["quotation_id"]);
            return $quotationInstance;
        }
        else
        {
            return null;
        }
    }
}