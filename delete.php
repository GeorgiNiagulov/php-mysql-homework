<?php 
        require_once 'logic/functions.php';
        require_once 'db/connect.php';
        $id = $_GET['id'];
        $contact = find_contact_by_id($id, $mysqli);
        
        if (!empty($_POST)) {
            $post = $_POST;
            if (isset($post['delete']) && $post['delete'] == 4) {
            $sql = "DELETE from contact_data WHERE id = '{$id}'";
            
            if (mysqli_query($mysqli, $sql) === TRUE) {
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
        <label for="name">Име</label><br />
        <input type="text" name="name" value="<?php echo htmlentities($contact['name']); ?>"><br />
        <label for="city">Град</label><br />
        <select name="city" id="city">
            <option value="<?php echo $contact['city']; ?>" >
                <?php echo $contact['city']; ?>
            </option>
        </select><br />
        <label for="sex">Пол</label><br />
        <input type="radio" name="sex" value="male" <?php echo ($contact['sex']=='male')?'checked':'' ?> size="17" >Мъжки
        <input type="radio" name="sex" value="female" <?php echo ($contact['sex']=='female')?'checked':'' ?> size="17" >Женски <br/>
        <label for="age">Години</label><br />
        <input type="text" name="age" value="<?php echo htmlentities($contact['age']); ?>"><br />
        <label for="birthDate">Рожденна дата</label><br />
        <input type="text" name="birthDate" value="<?php echo htmlentities($contact['birthdate']); ?>"><br />
        <label for="email">Имейл</label><br />
        <input type="email" name="email" id="email" value="<?php echo htmlentities($contact['email']); ?>"><br />
        <label for="notes">Бележки</label><br />
        <input type="textarea" name="notes" id="notes" value="<?php echo htmlentities($contact['notes']); ?>"><br />
        <label for="avatar">Аватар</label><br />
        <input type="file" name="avatar" id="avatar"><br />
        <button type="submit" name="delete" value="4" onclick="return confirm('Сигурни ли сте?');">Изтриване</button>
    </form>
    <a href="index.php">Назад</a>
    
</body>

</html>