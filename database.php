<?php
class Database 
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructor để khởi tạo giá trị mặc định
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        // Khởi tạo kết nối
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        
        // Kiểm tra kết nối
        if (!$this->conn) {
            die("Unable to connect to MySQL: " . mysqli_connect_error());
        }
    }

    public function close_connect(){
        mysqli_close($this->conn);
    }

    public function get_row($sql){
        $this->connect();
        $result = mysqli_query($this->conn, $sql);
        if(!$result){
            die("Error: ". mysqli_error($this->conn));
        }
        $rows = []; // Khởi tạo mảng để lưu trữ các hàng
        while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row; // Thêm mỗi hàng vào mảng
        }
        $this->close_connect();
        return $rows;
    }
}
?>