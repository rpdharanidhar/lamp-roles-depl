<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['REQUEST_METHOD']; ?>" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="login">
    </form>

    <?php
    // echo "<script>console.log('Reached MYSQL DBl');</script>";
    echo "<script>console.log('Login successful');</script>";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $servername = "localhost";
        $username = "dharani";
        $password = "dharani";
        $dbname = "people";

        try{
        $conn = new mysqli($servername, $username, $password, $dbname);

        } catch (Exception $e) {
        // echo "<script>console.log('.Error: ". $e->getMessage()."')</script>";
            echo "<script>console.log('.$e.');</script>";

        }
        echo "<script>console.log('Reached MYSQL DBl after the conenction establishment');</script>";

        if ($conn->connect_error) {
            // die("Connection failed: " . $conn->connect_error);
            echo "<script>console.log('error in connection');</script>";
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        echo "<script>console.log('password block');</script>";


        try{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            // echo "<script>console.log(".$result.");</script>";
            echo "<script>console.log('trying block');</script>";

        } catch (Exception $e) {
            // echo "<script>console.log('.Error: ". $e->getMessage()."')</script>";
            echo "<script>console.log('.$e.');</script>";

        }


        if ($result->num_rows > 0) {
            // Fetch the user record
            $user = $result->fetch_assoc();
            // Verify password using password_verify
            if ($password == $user['password']) {
                echo "Login successful";
                echo "<script>console.log('Login successful');</script>";
            } else {
                echo "Invalid email or password";
                echo "<script>console.log('Invalid email or password');</script>";

            }
        } else {
            echo "Invalid email or password bhoooooooooooooooooooooo";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
