<?php
        require_once 'db/connect.php';
        require_once 'logic/validate.php';

        $cities = ['Sofia', 'Varna', 'Plovdiv', 'Bourgas'];
        $post = $_POST;
        $name = null;
        $family = null;
        $city = null;
        $sex = null;
        $age = null;
        $birthDate = null;
        $email = null;
        $notes = null;
        $createdAt = null;

        if (!empty($post)) {
            if (isset($post['add']) && $post['add'] == 3) {

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
                

                $date = new \DateTime();
                $createdAt = $date->format('Y-m-d H:i:s');

                if (empty($error)) {
                $sql = "INSERT INTO contact_data
                (`name`, `family`, city, sex,
                age, birthDate, email,
                notes, avatar, createdAt)
                VALUES
                ('$name', '$family', '$city', '$sex',
                '$age', '$birthDate', '$email',
                '$notes', '$avatar', '$createdAt')";
                if (mysqli_query($mysqli, $sql) === TRUE) {
                    mysqli_close($mysqli);
                    header('Location: index.php');
                } else {
                    echo "Error adding record: " . $mysqli->error;
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
    <title>Добавяне</title>
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
        <input type="text" value="" name="name" id="name"><br />
        <label for="family">Фамилия</label><br />
        <input type="text" value="" name="family" id="family"><br />
        <label for="city">Град</label><br />
        <select name="city" id="city">
            <?php foreach ($cities as $city) { ?>
            <option value="<?php echo $city;?>"><?php echo $city;?></option>
            <?php } ?>
        </select><br />
        <label for="age">Години</label><br />
        <input type="text" name="age" value=""><br />
        <label for="birthDate">Рожденна дата</label><br />
        <input type="text" name="birthDate" value="" placeholder="гггг-мм-дд"><br />
        <label for="sex">Пол</label><br />
        <input type="radio" name="sex" value="male" id="sex">Мъжки
        <input type="radio" name="sex" value="female" id="sex">Женски <br />
        <label for="email">Имейл</label><br />
        <input type="email" name="email" id="email"><br />
        <label for="notes">Бележки</label><br />
        <textarea name="notes" id="notes" rows="10" cols="50"></textarea><br />
        <label for="avatar">Аватар</label><br />
        <input type="file" name="avatar" id="avatar"><br /> <br />
        <button type="submit" name="add" value="3">Запази</button>
    </form>

</body>

</html>