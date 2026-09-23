AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";0
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
$conn->query("DELETE * FROM users WHERE id=$id");
148
​
149
header("Location: index.php");
150
exit;
151
?>
152
​
￼
￼
￼
￼
<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
$conn->query("DELETE * FROM users WHERE id=$id");
148
​
149
header("Location: index.php");
150
exit;
151
?>
152
​
￼
￼
￼
￼
<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
$conn->query("DELETE * FROM users WHERE id=$id");
148
​
149
header("Location: index.php");
150
exit;
151
?>
152
​
￼
￼
￼
￼
<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>
