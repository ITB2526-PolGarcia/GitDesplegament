AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** app/db.php ***

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>


*** Script MySQL per crear la BBDD ***

CREATE DATABASE IF NOT EXISTS crud_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE crud_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** app/index.php ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Accions</th>
        </tr>

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
    <form action="add.php" method="post">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** app/add.php ***

<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>


*** app/edit.php ***

<?php
include 'db.php';

$user = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
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

    <?php if ($user): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            Nom: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            <button type="submit">Desar</button>
        </form>
    <?php else: ?>
        <p>No s'ha trobat l'usuari.</p>
    <?php endif; ?>
</body>
</html>


*** app/delete.php ***

<?php
include 'db.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $conn->query("DELETE FROM users WHERE id = $id");
}

header("Location: index.php");
exit;
?>


*** Correcció dels errors principals ***

- localhost en lloc de locahost
- eliminat el "0" que hi havia després del nom d'usuari
- tancat correctament el bloc if ($conn->connect_error)
- canviat method="posts" per method="post"
- corregit VALUES (*, ?) per VALUES (?, ?)
- corregit UPDATE users where ... per UPDATE users SET ...
- corregit DELETE * FROM ... per DELETE FROM ...
- eliminat "Where false" del SQL, ja que és incorrecte
- eliminades les taules duplicades i fragments repetits
- corregit l'estructura general del projecte perquè sigui funcional
