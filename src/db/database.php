<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    # Get example
    // public function getPosts($n = -1)
    // {
    //     $query = "SELECT idarticolo, titoloarticolo, imgarticolo, anteprimaarticolo, dataarticolo, nome FROM articolo, autore WHERE autore=idautore ORDER BY dataarticolo DESC";
    //     if ($n > 0) {
    //         $query .= " LIMIT ?";
    //     }
    //     $stmt = $this->db->prepare($query);
    //     if ($n > 0) {
    //         $stmt->bind_param('i', $n);
    //     }
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

    # Insert example
    // public function insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore)
    // {
    //     $query = "INSERT INTO articolo (titoloarticolo, testoarticolo, anteprimaarticolo, dataarticolo, imgarticolo, autore) VALUES (?, ?, ?, ?, ?, ?)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('sssssi', $titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
    //     $stmt->execute();

    //     return $stmt->insert_id;
    // }

    # Update example
    // public function updateArticleOfAuthor($idarticolo, $titoloarticolo, $testoarticolo, $anteprimaarticolo, $imgarticolo, $autore)
    // {
    //     $query = "UPDATE articolo SET titoloarticolo = ?, testoarticolo = ?, anteprimaarticolo = ?, imgarticolo = ? WHERE idarticolo = ? AND autore = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('ssssii', $titoloarticolo, $testoarticolo, $anteprimaarticolo, $imgarticolo, $idarticolo, $autore);

    //     return $stmt->execute();
    // }

    # Delete example
    // public function deleteArticleOfAuthor($idarticolo, $autore)
    // {
    //     $query = "DELETE FROM articolo WHERE idarticolo = ? AND autore = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('ii', $idarticolo, $autore);
    //     $stmt->execute();
    //     var_dump($stmt->error);
    //     return true;
    // }

    public function checkLogin($username, $password)
    {
        $query = "SELECT idautore, username, nome FROM autore WHERE attivo=1 AND username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>