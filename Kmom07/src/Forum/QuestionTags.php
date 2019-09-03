<?php
namespace Anax\Forum;



/**
 * Model for questions and tags link table.
 *
 * Contains interactions with the database.
 */
class QuestionTags extends \Anax\MVC\CDatabaseModel
{
    public function questionHasTag($questionId, $tagId)
    {
        return !empty($this->query()->where('questionId = ?')
            ->andWhere('tagId = ?')
            ->execute([$questionId, $tagId]));
    }


    public function selectByTag($tagId)
    {
        $source = $this->getSource();

        $this->db->select()->from("{$source}, Question")
            ->where("{$source}.tagId = ?")
            ->andWhere("{$source}.questionId = Question.id")
            ->execute([$tagId]);

        return $this->db->fetchAll();
    }
}
