<?php
class User
{
    protected $bdd;

    public function __construct($pdo)
    {
        $this->bdd = $pdo;
    }

    public function listUsers()
    {
        return $this->bdd->fetchAll('SELECT * FROM users');
    }

    public function addUser($user)
    {
        $request = $this->bdd->prepare('INSERT INTO users (name, password) VALUES (:name, :password)');
        $result = $request->execute(array($user));
        return $result;
    }

    public function deleteUser($id){
        $request = $this->bdd->prepare('DELETE FROM users WHERE id = :id');
        $result = $request->execute(['id'=>$id]);
        return $result;
    }

    public function showUser($id){
        $request = $this->bdd->prepare('SELECT * FROM users WHERE id = :id');
        $request->execute(['id'=>$id]);
        return $request->fetchAll();
    }
}