<?php
class Bookmark {
    private $id;
    private $title;
    private $link;
    private $dateAdded;
    private $dbConnection;
    private $tableName = 'bookmarks';

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getLink() {
        return $this->link;
    }

    public function getDateAdded() {
        return $this->dateAdded;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setDateAdded($dateAdded) {
        $this->dateAdded = $dateAdded;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tableName . " (title, link, date_added) VALUES (:title, :link, NOW())";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':link', $this->link);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':id', $this->id);
        
        if ($stmt->execute() && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->title = $row['title'];
            $this->link = $row['link'];
            $this->dateAdded = $row['date_added'];
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->dbConnection->prepare($query);
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->tableName . " SET title = :title, link = :link WHERE id = :id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':link', $this->link);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
