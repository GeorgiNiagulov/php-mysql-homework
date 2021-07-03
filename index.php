<?php 
    require_once 'db/connect.php';
    $sql = "SELECT * FROM contact_data";
    $post = $_POST;
    $searchName = '';
    $searchFamily = '';
    $searchCity = '';
    $searchFromDate = '';
    $searchToDate = '';
    $searchResult = '';

    if (!empty($post)) {
        if (isset($post['search']) && $post['search'] == 'Търсете') {
            $searchSql = "SELECT * FROM contact_data WHERE ";
            if (!empty($post['name'])) {
                $searchName = mysqli_real_escape_string($mysqli, $post['name']);
                $searchSql .="name LIKE '%".$searchName."%'";
            }

            if (!empty($post['family'])) {
                $searchFamily = mysqli_real_escape_string($mysqli, $post['family']);
                if(!empty($post['name'])) {
                    $searchSql .="AND family LIKE '%".$searchFamily."%'";
                } else {
                    $searchSql .="family LIKE '%".$searchFamily."%'";
                }
                
            }

            if (!empty($post['city'])) {
                $searchCity = mysqli_real_escape_string($mysqli, $post['city']);
                if(!empty($post['name']) || !empty($post['family'])) {
                    $searchSql .="AND city LIKE '%".$searchCity."%'";
                } else {
                    $searchSql .="city LIKE '%".$searchCity."%'";
                }
                
            }

            if (!empty($post['fromDate'])) {
                $searchFromDate = mysqli_real_escape_string($mysqli, $post['fromDate']);
                if(!empty($post['name']) || !empty($post['family']) || !empty($post['city'])) {
                    $searchSql .="AND (birthdate BETWEEN '$searchFromDate'"; 
                } else {
                    $searchSql .="(birthdate BETWEEN '$searchFromDate'";
                }
                
            }

            if (!empty($post['toDate'])) {
                $searchToDate = mysqli_real_escape_string($mysqli, $post['toDate']);
                $searchSql .=" AND '$searchToDate')";
            }
            $searchResult = mysqli_query($mysqli, $searchSql);
        
        }
    }
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Списък</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    Търсете по:
    <form method="post">
        <label for="name">Име</label>
        <input type="text" name="name" id="name">
        <label for="family">Фамилия</label>
        <input type="text" name="family" id="family">
        <label for="city">Град</label>
        <input type="text" name="city" id="city">
        <label for="fromDate">От дата на раждане</label>
        <input type="text" name="fromDate" id="fromDate">
        <label for="toDate">До дата на раждане</label>
        <input type="text" name="toDate" id="toDate">
        <input type="submit" name="search" value="Търсете">
    </form><br />

    <?php

    if($searchResult) {
        while ($row = mysqli_fetch_array($searchResult)){ 
            echo '<table><thead><tr><td>Име</td><td>Фамилия</td><td>Град</td><td>Пол</td><td>Години</td><td>Рожденна дата</td><td>Имейл</td><td>Бележки</td><td>Аватар</td><td>Създаден на</td><td>Редактиран на</td></thead><tbody><tr>'; 
            echo '<td>' .$row['name'].'</td>';
            echo '<td>' .$row['family'].'</td>';
            echo '<td>' .$row['city'].'</td>';
            echo '<td>' .$row['sex'].'</td>';
            echo '<td>' .$row['age'].'</td>';
            echo '<td>' .$row['birthdate'].'</td>';
            echo '<td>' .$row['email'].'</td>';
            echo '<td>' .$row['notes'].'</td>';
            echo '<td><img src='.$row['avatar'].' width="200" height="200"></td>';
            echo '<td>' .$row['createdAt'].'</td>';
            echo '<td>' .$row['editedAt'].'</td>';
            echo '<tr/></tbody></table>'; 
            } ?>
            <a href="index.php">Всички</a>
    <?php } else {

        $page = 1;
        if (isset($_GET['pageNo'])) {
            $page = $_GET['pageNo'];
        }

        $limit = 2;

        $offset = ($page - 1) * $limit;

        $sql = "SELECT COUNT(*) FROM contact_data";

        $total = mysqli_query($mysqli, $sql);

        $numrows = mysqli_fetch_row($total)[0];

        $totalPages = ceil($numrows/$limit);

        $prepSql = "SELECT * FROM contact_data ORDER BY name LIMIT $offset, $limit";

        $contacts = mysqli_query($mysqli, $prepSql);

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
            <?php foreach($contacts as $contact) { ?>
                <tr>
                    <td><?=$contact['name']?></td>
                    <td><?=$contact['family']?></td>
                    <td><?=$contact['city']?></td>
                    <td><?=$contact['sex']?></td>
                    <td><?=$contact['age']?></td>
                    <td><?=$contact['birthdate']?></td>
                    <td><?=$contact['email']?></td>
                    <td><?=$contact['notes']?></td>
                    <td><img src="<?php echo $contact['avatar'];?>" width="200" height="200"></td>
                    <td><?=$contact['createdAt']?></td>
                    <td><?=$contact['editedAt']?></td>
                    <td><a href="edit.php?id=<?php echo urlencode($contact['id']); ?>"> Редактиране</a></td>
                    <td><a href="delete.php?id=<?php echo urlencode($contact['id']); ?>" >Изтриване</a></td>
                </tr>
            <?php } ?>
        </tbody>
        <?php } ?>
    </table>

    <ul class="pagination">
        <li><a href="?pageNo=1">Първа</a></li>
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?pageNo=".($page - 1); } ?>">Предишна</a>
        </li>
        <li class="<?php if($page >= $totalPages){ echo 'disabled'; } ?>">
            <a href="<?php if($page >= $totalPages){ echo '#'; } else { echo "?pageNo=".($page + 1); } ?>">Следваща</a>
        </li>
        <li><a href="?pageNo=<?php echo $totalPages; ?>">Последна</a></li>
    </ul>

    <?php }?>
</body>
</html>