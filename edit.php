<?php

require_once 'db/connect.php';
require_once 'logic/functions.php';
require_once 'logic/validate.php';

$contact = find_contact_by_id($_GET['id'], $mysqli);
if($contact == null) {
    echo 'Няма такъв контакт';
    return;
}
$cities = ['Sofia', 'Varna', 'Plovdiv', 'Bourgas'];

$name = null;
$family = null;
$city = null;
$sex = null;
$age = null;
$birthDate = null;
$email = null;
$notes = null;
$avatar = null;
$editedAt = null;
$id = $contact['id'];

if (!empty($_POST)) {
    $post = $_POST;
    if (isset($post['save']) && $post['save'] == 2) {

        $error = [];

        if (!empty($post['name'])) {
            $validName = validateStringLength(2, 64, $post['name'], 'name');
            if($validName === true) {
                $name = htmlspecialchars($post['name']);
            } else {
                $error['name'] = $validName;
            }
        }
        
        if (!empty($post['family'])) {
            $validFamily = validateStringLength(2, 64, $post['family'], 'family');
            if($validFamily === true) {
                $family = htmlspecialchars($post['family']);
            } else {
                $error['family'] = $validFamily;
            }
        }

        if (!empty($post['city'])) {
            $city = $post['city'];
        }

        if (!empty($post['sex'])) {
            $sex = $post['sex'];
        }

        if (!empty($post['birthDate'])) {
            $validDate = validateDate($post['birthDate'], 'birthDate');
            if($validDate === true) {
                $birthDate = $post['birthDate'];
            } else {
                $error['birthDate'] = $validDate;
            }
        }

        if (!empty($post['age'])) {
            $validAge = validateNumber($post['age'], 'Age');
            if($validAge === true) {
                $age = $post['age'];
            } else {
                $error['age'] = $validAge;
            }
        } else {
            $date = new DateTime($birthDate);
            $now = new DateTime();
            $interval = $now->diff($date);
            $age = $interval->y;
        }

        if (!empty($post['email'])) {
            if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $post['email'];
            } else {
                $error['email'] = 'Невалиден имейл.';
            }
        }

        if (!empty($post['notes'])) {
            $notes = $post['notes'];
        }

        if (!empty($post['avatar'])) {
            $avatar = $post['avatar'];
        }

        $date = new \DateTime();
        $editedAt = $date->format('Y-m-d H:i:s');

        if (empty($error)) {
            $sql = "UPDATE contact_data 
                    SET 
                        `name` = '$name', 
                        family = '$family', 
                        city = '$city', 
                        sex = '$sex',
                        age = '$age',
                        email = '$email',
                        notes = '$notes',
                        avatar = '$avatar',
                        editedAt = '$editedAt',
                        birthdate = '$birthDate'
                    WHERE id = '$id'";
            if (mysqli_query($mysqli, $sql) === TRUE) {
                mysqli_close($mysqli);
                header('Location: index.php');
            } else {
                echo "Error updating record: " . $mysqli->error;
            }
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
    <title>Редактиране</title>
</head>

<body>
    <?php 
        if(!empty($error)) {
            foreach($error as $v) {
                echo $v.'<br/>';
            }
        }
    ?>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <label for="name">Име</label><br />
        <input type="text" name="name" value="<?php echo htmlentities($contact['name']); ?>"><br />
        <label for="family">Фамилия</label><br />
        <input type="text" name="family" value="<?php echo htmlentities($contact['family']); ?>"><br />
        <label for="city">Град</label><br />
        <select name="city" id="city">
            <option value="<?php echo $contact['city']; ?>"><?php echo $contact['city']; ?></option>
            <?php
                foreach ( $cities as $city ):
                ?>
            <option value="<?php echo $city; ?>">
                <?php echo $city; ?>
            </option>
            <?php
                endforeach; ?>
        </select><br />
        <label for="age">Години</label><br />
        <input type="text" name="age" value="<?php echo htmlentities($contact['age']); ?>"><br />
        <label for="birthDate">Рожденна дата</label><br />
        <input type="text" name="birthDate" value="<?php echo htmlentities($contact['birthdate']); ?>"><br />
        <label for="sex">Пол</label><br />
        <input type="radio" name="sex" value="male" <?php echo ($contact['sex']=='male')?'checked':'' ?> size="17">Мъжки
        <input type="radio" name="sex" value="female" <?php echo ($contact['sex']=='female')?'checked':'' ?>
            size="17">Женски <br />
        <label for="email">Имейл</label><br />
        <input type="email" name="email" id="email" value="<?php echo htmlentities($contact['email']); ?>"><br />
        <label for="notes">Бележки</label><br />
        <input type="textarea" name="notes" id="notes" value="<?php echo htmlentities($contact['notes']); ?>"><br />
        <label for="avatar">Аватар</label><br />
        <input type="file" name="avatar" id="avatar"><br />
        <button type="submit" name="save" value="2">Редактиране</button>
    </form><br />
    <a href="index.php">Назад</a>

</body>

</html>