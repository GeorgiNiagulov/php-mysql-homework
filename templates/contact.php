<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Контактна форма</title>
</head>
<body>
  <form action="getResponse.php" method="post">
    Име: <input type="text" name="name" id=""><br/><br/>
    Фамилия: <input type="text" name="lastName" id=""><br/><br/>
    Град: <select name="city" id=""><br/><br/>
            <?php
            $cities = ['София' , 'Пловдив', 'Бургас'];
            foreach($cities as $city) { ?>
              <option value="<?php echo $city;?>"><?php echo $city;?></option>
            <?php } ?>
          </select><br/><br/>
    Години: <input type="text" name="age" id=""><br/><br/>
    Рожденна дата: <input type="date" name="birthdate" id=""><br/><br/>
          
    Пол: <input type="radio" name="sex" value="m" id="male">
          <label for="male">м</label>
          <input type="radio" name="sex" value="f" id="female">
          <label for="female">ж</label>
          <br/><br/>
    Имейл: <input type="email" name="email" id=""><br/><br/>
    Бележки: <textarea name="notes" id="" cols="30" rows="10"></textarea><br/>
    Аватар: <input type="file" name="avatar" id=""><br />
    <button type="submit">Изпратете</button>
  </form>
</body>
</html>