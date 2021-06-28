<?php 
        require_once 'logic/functions.php';
        require_once 'db/connect.php';
 
        $contact = find_contact_by_id($_GET['id'], $mysqli);
        $name = null;
        $city = null;
        $sex = null;
        $id = $contact['id'];
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        
        if (isset($_POST['city'])) {
            $city = $_POST['city'];
        }
        
        if (isset($_POST['sex'])) {
            $sex = $_POST['sex'];
        }
        
        if ($name  && isset($city) && isset($sex)) {
            $sql = "DELETE from contact_data WHERE id = '{$id}'";
            
            mysqli_query($mysqli, $sql);
            mysqli_close($mysqli);
            header('Location: index.php');
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
        <label for="name">Име</label><br />
        <input type="text" name="name" value="<?php echo htmlentities($contact['name']); ?>"><br />
        <label for="city">Град</label><br />
        <select name="city" id="city">
            <option value="<?php echo $contact['city']; ?>">
                <?php echo $contact['city']; ?>
            </option>
        </select><br />
        <label for="sex">Пол</label><br />
        <input type="radio" name="sex" value="male" <?php echo ($contact['sex']=='male')?'checked':'' ?> size="17">Мъжки
        <input type="radio" name="sex" value="female" <?php echo ($contact['sex']=='female')?'checked':'' ?> size="17">Женски <br/>
        <button type="submit">Изтриване</button>
    </form>
    <a href="index.php">Назад</a>
    
</body>

</html>