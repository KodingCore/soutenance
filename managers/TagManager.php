<?php

class TagManager extends AbstractManager
{
    
    public function getTags() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM tags");
        $query->execute();
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);
        if($tags)
        {
            $tagsTab = [];
            foreach($tags as $tag)
            {
                $tagInstance = new Tag($tag["user_id"], $tag["template_id"], $tag["tag_name"]);
                $tagInstance->setTagId($tag["tag_id"]);
                array_push($tagsTab, $tagInstance);
            }
            return $tagsTab;
        }
        else
        {
            return null;
        }
    }

    public function insertTag(Tag $tag)
    {
        $query = $this->db->prepare("INSERT INTO tags (user_id, template_id, tag_name) VALUES(:user_id, :template_id, :tag_name)");
        $parameters = [
            "user_id" => $tag->getUserId(),
            "template_id" => $tag->getTemplateId(),
            "tag_name" => $tag->getTagName()
        ];
        $query->execute($parameters);
    }

    public function deleteTagByTagId(int $tag_id)
    {
        $query = $this->db->prepare("DELETE FROM tags WHERE tag_id = :tag_id");
        $parameters = [
            "tag_id" => $tag_id
        ];
        $query->execute($parameters);
    }

    public function editTag(Tag $tag)
    {
        $query = $this->db->prepare("UPDATE tags SET user_id = :user_id, template_id = :template_id, tag_name = :tag_name WHERE tag_id = :tag_id");
        $parameters = [
            "user_id" => $tag->getUserId(),
            "template_id" => $tag->getTemplateId(),
            "tag_name" => $tag->getTagName(),
            "tag_id" => $tag->getTagId()
        ];
        $query->execute($parameters);
    }

    public function getTagByTagId(int $tag_id) : ? Tag
    {
        $query = $this->db->prepare("SELECT * FROM tags WHERE tag_id = :tag_id");
        $parameters = [
            "tag_id" => $tag_id
        ];
        $query->execute($parameters);
        $tag = $query->fetch(PDO::FETCH_ASSOC);
        if($tag)
        {
            $tagInstance = new Tag($tag["user_id"], $tag["template_id"], $tag["tag_name"]);
            $tagInstance->setTagId($tag["tag_id"]);
            return $tagInstance;
        }
        else
        {
            return null;
        }
    }
}