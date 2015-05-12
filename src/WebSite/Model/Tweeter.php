<?php
class Message
{
    private $bdd;

    public function __construct($pdo)
    {
        $this->bdd = $pdo;
    }

    /**
     * fonction d'ajout de message dans la base
     */
    public function addMessage($user_id, $message)
    {
        $request = $this->bdd->prepare('INSERT INTO messages (user_id, message) VALUES (:user_id, :message)');
        $request->execute([
            'user_id' => $user_id,
            'message' => $message
        ]);
    }

    /**
     * fonction qui recupere tout les messages
     */
    public function getAllMessages()
    {
        $req = $this->bdd->prepare('SELECT * FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY messages.id DESC');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * fonction qui recupere les message d'un user en particulier
     */
    public function getMessagesByUser($user_id)
    {
        $req = $this->bdd->prepare('SELECT * FROM messages INNER JOIN users ON messages.user_id = users.id WHERE users.id = :user_id ORDER BY messages.id DESC');
        $req->execute([
            'user_id' => $user_id
        ]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}