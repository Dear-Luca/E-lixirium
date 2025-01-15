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

    // INSERT SECTION
    public function insertUser($name, $surname, $username, $email, $password, $birthday)
    {
        $query = "INSERT INTO user (name, surname, username, email, password, birthday) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $name, $surname, $username, $email, $password, $birthday);
        $stmt->execute();
    }
    public function insertProduct($productName, $productDescription, $productPrice, $productAmount, $duration, $productImages, $stars)
    {
        $query = "INSERT INTO product (name, description, image_name, price, amount_left, duration, stars) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssdisd', $productName, $productDescription, $productImages, $productPrice, $productAmount, $duration, $stars);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function insertCategory($name)
    {
        $query = "INSERT INTO category (name) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
    }

    public function insertProductIsCategory($category, $id_product)
    {
        $query = "INSERT INTO `is` (name, id_product) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $category, $id_product);
        $stmt->execute();
    }

    public function insertOrder($username)
    {
        $query = "INSERT INTO `order` (username) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username, );
        $stmt->execute();
    }

    public function insertIncludeOrder($id_product, $id_order, $quantity)
    {
        $query = "INSERT INTO includes (id_product, id_order, quantity) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $id_product, $id_order, $quantity);
        $stmt->execute();
    }

    public function insertIntoCart($id_product, $username, $quantity)
    {
        $query = "INSERT INTO wishes (id_product, username, quantity) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isi', $id_product, $username, $quantity);
        $stmt->execute();
    }

    public function insertReview($id_product, $username, $stars, $comment)
    {
        $query = "INSERT INTO review (id_product, username, stars, comment) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isis', $id_product, $username, $stars, $comment);
        return $stmt->execute();
    }

    public function insertNotification($title, $description, $username = null, $admin = null)
    {
        $query = "INSERT INTO notification (title, description, username, SEN_username) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $title, $description, $username, $admin);
        $stmt->execute();
    }

    public function insertAdmin($username, $password)
    {
        $query = "INSERT INTO admin (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
    }

    // GET SECTION
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

    public function getTopProducts($n = -1)
    {
        $query = "SELECT * FROM product ORDER BY stars DESC";
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

    public function getProductsOfName($name)
    {
        $query = "SELECT * FROM product WHERE name = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductsOfCategory($category, $n = -1)
    {
        $query = "SELECT product.* FROM product, `is` WHERE product.id_product = is.id_product AND is.name = ? ORDER BY RAND()";
        if ($n > 0) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($n > 0) {
            $stmt->bind_param('si', $category, $n);
        } else {
            $stmt->bind_param('s', $category);
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

    public function searchProducts($value)
    {
        $searchTerm = trim($value);
        $searchTerm = "%{$searchTerm}%";

        $query = "SELECT * FROM product WHERE name LIKE ? OR description LIKE ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoriesOfProduct($id_product)
    {
        $query = "SELECT is.name FROM product, `is` WHERE product.id_product = is.id_product AND product.id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_product);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkAdminLogin($username, $password)
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

    public function checkUsername($username)
    {
        $query = "SELECT username FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkAdmin($username)
    {
        $query = "SELECT username FROM admin WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getHashedPasswordAdmin($username)
    {
        $query = "SELECT password FROM admin WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getHashedPasswordUser($username)
    {
        $query = "SELECT password FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCartProducts($username)
    {
        $query = "SELECT W.id_product, P.name, P.price, P.image_name, W.quantity FROM wishes as W, product as P WHERE W.username=? and W.id_product=P.id_product";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkCartProduct($username, $id_product)
    {
        $query = "SELECT * FROM wishes WHERE username=? and id_product=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $id_product);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsers()
    {
        $query = "SELECT * FROM user";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserInfo($username)
    {
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories($n = -1)
    {
        $query = "SELECT * FROM category ORDER BY RAND()";
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

    public function getLastInsertId()
    {
        $query = "SELECT LAST_INSERT_ID()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['LAST_INSERT_ID()'];
    }

    public function getOrders($username)
    {
        $query = "SELECT * FROM `order` WHERE username = ? Order by `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderDetail($id_order)
    {
        $query = "SELECT P.name, P.price, P.id_product, P.image_name, I.quantity FROM includes as I, product as P WHERE I.id_order = ? and I.id_product = P.id_product";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_order);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderTotal($id_order)
    {
        $query = "SELECT ROUND(SUM(P.price * I.quantity), 2) as total FROM includes as I, product as P WHERE I.id_order = ? and I.id_product = P.id_product";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_order);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkReview($id_product, $username)
    {
        $query = "SELECT * FROM review WHERE id_product = ? AND username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id_product, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkNotifications()
    {
        $query = "SELECT * FROM notification WHERE seen = 0 AND username = ? OR SEN_username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $_SESSION["username"], $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviews($id_product)
    {
        $query = "SELECT * FROM review WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_product);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOthersReviews($id_product, $username)
    {
        $query = "SELECT * FROM review WHERE id_product = ? AND username != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id_product, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdmins()
    {
        $query = "SELECT * FROM admin";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotifications($username)
    {
        $query = "SELECT * FROM notification WHERE username = ? OR SEN_username = ? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificationDetail($id_notification)
    {
        $query = "SELECT * FROM notification WHERE id_notification = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_notification);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCreditCard($username)
    {
        $query = "SELECT card_number FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // DELETE SECTION

    public function deleteCartProduct($username, $id_product)
    {
        $query = "DELETE FROM wishes WHERE username = ? AND id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $username, $id_product);
        $stmt->execute();
    }

    public function deleteCart($username)
    {
        $query = "DELETE FROM wishes WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    }

    public function deleteCategoriesOfProduct($id_product)
    {
        $query = "DELETE FROM `is` WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_product);
        return $stmt->execute();
    }

    public function deleteReviewsOfProduct($id_product)
    {
        $query = "DELETE FROM review WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_product);
        return $stmt->execute();
    }

    public function deleteProduct($id_product)
    {
        $query = "DELETE FROM product WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_product);
        $stmt->execute();
    }

    public function deleteProductFromCarts($id_product)
    {
        $query = "DELETE FROM wishes WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_product);
        return $stmt->execute();
    }

    public function deleteProductFromOrders($id_product)
    {
        $query = "DELETE FROM includes WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_product);
        return $stmt->execute();
    }

    // UPDATE SECTION

    public function updateUser($name, $surname, $username, $email, $birthday, $cardNumber, $password, $currentUsername)
    {
        $query = "UPDATE user SET name = ?, surname = ?, username = ?, email = ?, birthday = ?, card_number = ?, password = ? WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiss', $name, $surname, $username, $email, $birthday, $cardNumber, $password, $currentUsername);
        $stmt->execute();
    }

    public function updateCartQuantity($username, $id_product, $quantity)
    {
        $query = "UPDATE wishes SET quantity = ? WHERE username = ? AND id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isi", $quantity, $username, $id_product);
        $stmt->execute();
    }

    public function updateProductStars($id_product, $newRating)
    {
        $othersReviews = $this->getOthersReviews($id_product, $_SESSION["username"]);
        $sumRating = 0.0;
        foreach ($othersReviews as $review) {
            $sumRating += $review["stars"];
        }
        $sumRating += $newRating;
        $numReviews = count($othersReviews) + 1;
        $finalRating = $sumRating / $numReviews;

        $query = "UPDATE product SET stars = ? WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("di", $finalRating, $id_product);
        $stmt->execute();
    }

    public function deleteProductFromCart($id_product, $username)
    {
        $query = "DELETE FROM wishes WHERE id_product = ? and username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $id_product, $username);
        $stmt->execute();
    }

    public function updateAmountLeft($id_product, $quantity)
    {
        $query = "UPDATE product SET amount_left = amount_left - ? WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $quantity, $id_product);
        $stmt->execute();
    }

    public function updateReview($id_product, $username, $stars, $comment)
    {
        $query = "UPDATE review SET stars = ?, comment = ? WHERE id_product = ? AND username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isis", $stars, $comment, $id_product, $username);
        return $stmt->execute();
    }

    public function updateProduct($id_product, $description, $price, $amount_left)
    {
        $query = "UPDATE product SET description = ?, price = ?, amount_left = ? WHERE id_product = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sdii', $description, $price, $amount_left, $id_product);
        $stmt->execute();
    }

    public function updateNotificationStatus($value, $id_notification)
    {
        $query = "UPDATE notification SET seen = ? WHERE id_notification = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $value, $id_notification);
        $stmt->execute();
    }
}
?>