<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Списък</title>
</head>
<body>
    <?php 
        require_once 'db/connect.php';
        $sql = "SELECT * FROM contact_data";
        $contacts = mysqli_query($mysqli, $sql);
    ?>
    <a href="add.php">Добавяне</a>
    <table>
        <thead>
            <tr>
                <td>Име</td>
                <td>Фамилия</td>
                <td>Град</td>
                <td>Пол</td>
                <td>Години</td>
                <td>Рожденна дата</td>
                <td>Имейл</td>
                <td>Бележки</td>
                <td>Аватар</td>
                <td>Създаден на</td>
                <td>Редактиран на</td>
                <td>Действие</td>
            </tr>
        </thead>
        <?php if(isset($contacts)) { ?>
        <tbody>
            <?php foreach($contacts as $contact) {?>
                <tr>
                    <td><?=$contact['name']?></td>
                    <td><?=$contact['family']?></td>
                    <td><?=$contact['city']?></td>
                    <td><?=$contact['sex']?></td>
                    <td><?=$contact['age']?></td>
                    <td><?=$contact['birthdate']?></td>
                    <td><?=$contact['email']?></td>
                    <td><?=$contact['notes']?></td>
                    <td><img src="/uploads/<?=$contact['avatar']?>" alt="" width="200" height="200"><?=$contact['avatar']?></td>
                    <td><?=$contact['createdAt']?></td>
                    <td><?=$contact['editedAt']?></td>
                    <td><a href="edit.php?id=<?php echo urlencode($contact['id']); ?>"> Редактиране</a></td>
                    <td><a href="delete.php?id=<?php echo urlencode($contact['id']); ?>" >Изтриване</a></td>
                </tr>
            <?php } ?>
        </tbody>
        <?php } ?>
    </table>
</body>
</html>