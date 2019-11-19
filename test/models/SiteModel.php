<?php
    class SiteModel extends Model {
        public function addNewTask($name, $email, $text) {
            $sql = "INSERT INTO task (name, email, text)
                    VALUES (:name, :email, :text)
                    ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->bindValue(":text", $text, PDO::PARAM_STR);
            $stmt->execute();
            return true;	
        }

        public function getTasks() {
            $sql = "SELECT * FROM task";
            $result = array();
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$row['id']] = $row;
            }
    
            return $result;		
        }

        public function getLimitTasks($lim, $off) {
            $result = array();
            $sql = "SELECT * FROM task LIMIT :lim OFFSET :off";
            if (isset($_GET['type']) && isset($_GET['direction'])) {
                $type = $_GET['type'];
                $direction = $_GET['direction'];
                $sql = "SELECT * FROM task ORDER BY $type $direction LIMIT :lim OFFSET :off";
            }
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":lim", $lim, PDO::PARAM_INT);
            $stmt->bindValue(":off", $off, PDO::PARAM_INT);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$row['id']] = $row;
            }
            return $result;
    
        }

        public function completeTask($id) {
            $complete = 1; 
            $sql = "UPDATE task
                    SET is_complete = :is_complete
                    WHERE id =:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":is_complete", $complete); 
            $stmt->bindValue(":id", $id); 
            $stmt->execute();
            return true;	
        }

        public function editTask($id, $text) {
            $edited = 1; 
            $sql = "UPDATE task
                    SET text = :text, is_edited = :is_edited 
                    WHERE id =:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":text", $text); 
            $stmt->bindValue(":is_edited", $edited); 
            $stmt->bindValue(":id", $id); 
            $stmt->execute();
            return true;	
        }
    }
?>