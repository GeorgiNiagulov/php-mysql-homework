<?php
require_once 'logic/functions.php';
require_once 'db/connect.php';
$id = $_GET['id'];
$contact = find_contact_by_id($id, $mysqli);

if (!empty($_POST)) {
    $post = $_POST;
    if (isset($post['yes'])) {
        $sql = "DELETE from contact_data WHERE id = '{$id}'";

        if (mysqli_query($mysqli, $sql) === true) {
            mysqli_close($mysqli);
            header('Location: index.php');
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изтриване</title>
</head>

<body>
    <form method="post">
        <div>
            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
            <p>Сигурен ли си, че искаш да изтриеш този запис от контакти?</p>
            <p>
                <input type="submit" name="yes" value="Да">
                <a href="index.php">Не</a>
            </p>
        </div>
    </form>
</body>

</html>