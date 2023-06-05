<?php

require_once 'DbConnection.php';

class Task
{
    public function __construct()
    {
    }

    /**
     * Get all user tasks, completed & non-completed are separated
     * 
     * @param int $user_id The id of the user
     * 
     * @return array|false Retrieved tasks if request is successfull, else false
     */
    public static function getAllByUser(int $user_id): array|false
    {
        $sql = 'SELECT * FROM tasks WHERE user_id = :user_id';
        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Create one task for one user
     * 
     * @param string $content The task description
     * @param int $user_id The user id
     * 
     * @return bool Depending if insertion request is successfully executed
     */
    public function add(string $content, int $user_id): bool
    {
        $date = new DateTime();

        $creation_date = $date->format('Y-m-d H:i:s');

        $sql = 'INSERT INTO tasks (content, creation_date, user_id) VALUES (:content, :creation_date, :user_id)';

        $insert = DbConnection::getDb()->prepare($sql);

        $insert->bindParam(':content', $content);
        $insert->bindParam(':creation_date', $creation_date);
        $insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        return $insert->execute();
    }

    /**
     * Set one task as complete by addind a datetime to completion date
     * 
     * @param int $id The task id
     * 
     * @return bool Depending if update request is successfully executed
     */
    function complete(int $id): bool
    {
        $sql = 'UPDATE tasks SET completion_date = NOW() WHERE id = :id';
    
        $update = DbConnection::getDb()->prepare($sql);
    
        $update->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $update->execute();
    }

    /**
     * Delete a task
     * 
     * @param int $id The task id
     * 
     * @return bool Depending if delete request is successfully executed
     */
    function delete(int $id): bool
    {
        $sql = 'DELETE FROM tasks WHERE id = :id';
    
        $delete = DbConnection::getDb()->prepare($sql);
    
        $delete->bindParam(':id', $id);

        return $delete->execute();
    }
}