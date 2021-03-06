<?php
?>
<div class="container signup hidden">
    <h2>Регистрация</h2>
    <form action="../php/signup.php" method="post">
        <label for="reg_login">Логин:</label>
        <input id="reg_login" required name="login" maxlength="25" type="text" />

        <label for="reg_pass">Пароль:</label>
        <input id="reg_pass" required name="pass" maxlength="25" type="password" />

        <label for="firstName">Имя:</label>
        <input id="firstName" required name="firstName" maxlength="25" type="text" />

        <label for="lastName">Фамилия:</label>
        <input id="lastName" required name="lastName" maxlength="25" type="text" />

        <label for="group">Группа:</label>
        <select required name="group" id="group">
            <?
                $groups = mysqli_query($connection, "(SELECT name FROM groups)");
                while ($rowGroup = mysqli_fetch_array($groups)) {
                    echo "<option>" . $rowGroup[0] . "</option>";
                }
            ?>
        </select>
        <label for="sex">Пол:</label>
        <select required name="sex" id="sex">
            <option>мужской</option>
            <option>женский</option>
        </select>
        <input type="submit" value="Зарегистрироваться">
    </form>
</div>
