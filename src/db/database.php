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

    public function insertUser($name, $surname, $username, $email, $password, $birthday)
    {
        $query = "INSERT INTO user (name, surname, username, email, password, birthday) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $name, $surname, $username, $email, $password, $birthday);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getProducts($n = -1)
    {
        $query = "SELECT * FROM product ORDER BY RAND()";
        if ($n > 0) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($n > 0) {
            $stmt->bind_param('i', $n);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProduct($id_product)
    {
        $query = "SELECT * FROM product WHERE id_product= ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id_product);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkAdmin($username, $password)
    {
        $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($username, $password)
    {
        $query = "SELECT * FROM user WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkRegister($username)
    {
        $query = "SELECT username FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCartProducts($username)
    {
        $query = "SELECT W.id_product, P.name, P.price FROM wishes as W, product as P WHERE W.username=? and W.id_product=P.id_product";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserInfo($username){
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($name, $surname, $username, $email, $currentUsername){
        $query = "UPDATE user SET name = ?, surname = ?, username = ?, email = ? WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $name, $surname, $username, $email, $currentUsername);
        $stmt->execute();
    }

}
?>