<?php

require_once "dbHandler.php";

class Tickets extends dbHandler {

    public function getAllTickets() {
        $query = "SELECT * FROM tickets;";

        $stmt = $this->connect()->prepare($query);
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getMyTicketsInfo($project_id, $user_id) {
        $query = "SELECT * FROM tickets WHERE project_id = ? AND created_by = ?;";

        $stmt = $this->connect()->prepare($query);
        
        $stmt->execute([$project_id, $user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function addTicket($project_id, $user_id, $title, $description, $category, $priority, $status) {
        try {
            $query = "INSERT INTO tickets (project_id, title, category, description, status, priority, created_by) VALUES (?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$project_id, $title, $category, $description, $status, $priority, $user_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function getFilteredTickets($filter) {
        $query = "SELECT tickets.*, projects.name AS project_name  FROM tickets INNER JOIN projects ON tickets.project_id = projects.id"; //inner join to get project name to display not id
        $parameters = [];
        $conditions = [];

        if (!empty($filter["title"])) {
            $conditions[] = "tickets.title LIKE ? " ;
            $parameters[] = "%". $filter["title"] . "%";
        }
        if (!empty($filter["category"])) {
            $conditions[] = "tickets.category = ?";
            $parameters[] = $filter["category"];
        }
        if (!empty($filter["priority"])) {
            $conditions[] = "tickets.priority = ?";
            $parameters[] = $filter["priority"];
        }
        if (!empty($filter["status"])) {
            $conditions[] = "tickets.status = ?";
            $parameters[] = $filter["status"];
        }
        if (!empty($filter["id"])) {
            $conditions[] = "tickets.id = ?";
            $parameters[] = $filter["id"];
        }
        if (!empty($filter["project_id"])) {
            $conditions[] = "tickets.project_id = ?";
            $parameters[] = $filter["project_id"];
        }
        if (!empty($filter["created_by"])) {
            $conditions[] = "tickets.created_by = ?";
            $parameters[] = $filter["created_by"];
        }
        if (!empty($filter["search"])) {
            $conditions[] = "(tickets.title LIKE ? OR tickets.description LIKE ?)" ;
            $parameters[] = "%". $filter["search"] . "%";
            $parameters[] = "%". $filter["search"] . "%";
        }


        if ($conditions) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        $query .= ";";

        $stmt = $this->connect()->prepare($query);
        
        $stmt->execute($parameters);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTicketInfo($ticketId) {
        $query = "SELECT tickets.*, projects.name AS project_name FROM tickets INNER JOIN projects ON tickets.project_id = projects.id WHERE tickets.id = ?" ; //inner join to get project name to display not id

        $stmt = $this->connect()->prepare($query);
        
        $stmt->execute([$ticketId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
        
    public function updateTicket($ticket_id, $project_id, $title, $description, $category, $priority, $status) {
        $query = "UPDATE tickets SET project_id = ?, title = ?, description = ?, category = ?, priority = ?, status = ? WHERE id = ?;";

        $stmt = $this->connect()->prepare($query);
        
        return $stmt->execute([$project_id, $title, $description, $category, $priority, $status, $ticket_id]);

    }

    public function deleteTicket($ticketId) {
        $query = "DELETE FROM tickets WHERE id = ?;";

        $stmt = $this->connect()->prepare($query);
        
        return $stmt->execute([$ticketId]);
    }

    public function numberOfTickets($type, $user_id = null) {
        if ($type == "Open") {
            $query = "SELECT COUNT(*) FROM tickets WHERE status = 'Open';";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        } else if ($type == "my_tickets") {
            $query = "SELECT COUNT(*) FROM tickets WHERE created_by = ? AND status = 'Open';";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$user_id]);
            return $stmt->fetchColumn();
        } else if ($type == "high_priority") {
            $query = "SELECT COUNT(*) FROM tickets WHERE priority = 'High';";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
    }

}