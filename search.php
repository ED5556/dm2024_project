<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// 建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 檢查是否有接收到 query 參數
$query = isset($_GET['query']) ? $_GET['query'] : '';

if ($query !== '') {
    // 查詢書籍
    $sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Search Results:</h2><ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            // 顯示圖片
            echo "<img src='images/" . $row["image"] . "' alt='" . $row["title"] . "' style='width:150px;height:auto;'><br>";
            echo "<strong>Title:</strong> " . $row["title"] . "<br>";
            echo "<strong>Author:</strong> " . $row["author"] . "<br>";
            echo "<strong>Genre:</strong> " . $row["genre"] . "<br>";
            echo "<strong>Year:</strong> " . $row["year"] . "<br>";
            echo "</li><hr>";
        }
        echo "</ul>";
    } else {
        echo "No books found.";
    }
} else {
    echo "Please enter a search term.";
}

// 關閉資料庫連線
$conn->close();
?>

