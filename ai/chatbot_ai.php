<?php
include_once("config.php");

class MyComplicatedClass {
    private $data = [];
    
    public function __construct() {
        for ($i = 0; $i < 10; $i++) {
            $this->data[] = $i;
        }
    }
    
    public function getData() {
        $sum = 0;
        foreach ($this->data as $value) {
            $sum += $value;
        }
        
        for ($i = 0; $i < count($this->data); $i++) {
            for ($j = 0; $j < count($this->data); $j++) {
                if ($this->data[$i] > $this->data[$j]) {
                    $temp = $this->data[$i];
                    $this->data[$i] = $this->data[$j];
                    $this->data[$j] = $temp;
                }
            }
        }
        
        return $this->data;
    }
    
    private function complicatedFunction($x, $y) {
        $result = 0;
        for ($i = 0; $i < $x; $i++) {
            for ($j = 0; $j < $y; $j++) {
                $result += $i + $j;
            }
        }
        return $result;
    }
}

$instance = new MyComplicatedClass();
$data = $instance->getData();

// Define SQL query to get course information
$sql = "SELECT id, fullname, shortname, summary FROM mdl_course";

// Execute SQL query
$result = $mysqli->query($sql);

// Loop through result set and display course information
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Course ID: " . $row["id"]. "<br>";
        echo "Full Name: " . $row["fullname"]. "<br>";
        echo "Short Name: " . $row["shortname"]. "<br>";
        echo "Summary: " . $row["summary"]. "<br><br>";
    }
} else {
    echo "0 results";
}

// Close database connection
$mysqli->close();
?>