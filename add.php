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
        $avatar = null;
        $createdAt = null;

        if (!empty($post)) {
            if (isset($post['add']) && $post['add'] == 3) {

                $error = [];

                if (!empty($post['name'])) {
                    if(validateStringLength(2, 64, $post['name'], 'name')) {
                        $name = htmlspecialchars($post['name']);
                    } else {
                        $error['name'] = validateStringLength(2, 64, $post['name'], 'name');
                    }
                }
        
                if (!empty($post['family'])) {
                    if(validateStringLength(2, 64, $post['family'], 'family')) {
                        $name = htmlspecialchars($post['family']);
                    } else {
                        $error['family'] = validateStringLength(2, 64, $post['family'], 'family');
                    }
                }
        
                if (!empty($post['city'])) {
                    $city = $post['city'];
                }
        
                if (!empty($post['sex'])) {
                    $sex = $post['sex'];
                }
        
                if (!empty($post['birthDate'])) {
                    if(validateDate($post['birthDate'], 'birthDate')) {
                        $birthDate = $post['birthDate'];
                    } else {
                        $error['birthDate'] = validateDate($post['birthDate'], 'BirthDate');
                    }
                }
        
                if (!empty($post['age'])) {
                    if(validateNumber($post['age'], 'Age')) {
                        $age = $post['age'];
                    } else {
                        $error['age'] = validateNumber($post['age'], 'Age');
                    }
                } else {
                    $birthDate = explode("/", $birthDate);

                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                        ? ((date("Y") - $birthDate[2]) - 1)
                        : (date("Y") - $birthDate[2]));
                }
        
                if (!empty($post['email'])) {
                    if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                        $email = $post['email'];
                    } else {
                        $error['email'] = 'Имейлът не е правилен.';
                    }
                }
        
                if (!empty($post['notes'])) {
                    $notes = $post['notes'];
                }
        
                if (!empty($post['avatar'])) {
                    $avatar = $post['avatar'];
                }
        
                $createdAt = new \DateTime();

                if (empty($error)) {
                    $sql = "INSERT INTO contact_data 
                            (name, family, city, sex, 
                            age, birthdate, email,
                            notes, avatar, createdAt) 
                            VALUES 
                            ('$name', '$family', '$city', '$sex',
                            '$age', '$birthDate', '$email',
                            '$notes', '$avatar', '$createdAt')";
                    
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
    <form method="post">
        <label for="name">Име</label><br/>
        <input type="text" value="" name="name" id="name"><br/>
        <label for="family">Фамилия</label><br/>
        <input type="text" value="" name="family" id="family"><br/>
        <label for="city">Град</label><br/>
        <select name="city" id="city">
            <?php foreach ($cities as $city) { ?>
                <option value="<?php echo $city;?>"><?php echo $city;?></option>
            <?php } ?>
        </select><br/>
        <label for="age">Години</label><br />
        <input type="text" name="age" value=""><br />
        <label for="birthDate">Рожденна дата</label><br />
        <input type="date" name="birthDate" value=""><br />
        <label for="sex">Пол</label><br/>
        <input type="radio" name="sex" value="male" id="sex">Мъжки 
        <input type="radio" name="sex" value="female" id="sex">Женски <br/>
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