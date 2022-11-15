<?php

date_default_timezone_set('UTC');
$addDate = date("m.d.y");
$connexion = 0;

function connexion()
{
    try {
        $user = "root";
        $pass = "";
        $pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $pass);
        return $pdo;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br>";
        die();
    }
}

function getAllUsers()
{
    $con = connexion();
    $requete = 'SELECT * from users';
    $rows = $con->query($requete);
    return $rows;
}

function createUser($lastName, $name, $mail, $mdp, $addDate)
{
    try {
        $conn = connexion();
        $sql = "INSERT INTO users (nom, prenom, mail, mdp, addDate, connexion)VALUES ('$lastName', '$name', '$mail', '$mdp', $addDate, 0)";
        $conn->exec($sql);
    } catch (PDOException $e) {
        print_r($sql . "<br>" . $e->getMessage());
    }
}

function readUser($id)
{
    $con = connexion();
    $requete = "SELECT * from users where id = '$id' ";
    $stmt = $con->query($requete);
    $row = $stmt->fetchAll();
    if (!empty($row)) {
        return $row[0];
    }
}

//met à jour le user
function updateUser($id, $nom, $prenom, $mail, $mdp, $addDate, $connexion)
{
    try {
        $con = connexion();
        $sql = "UPDATE users set 
						nom = '$nom',
						prenom = '$prenom',
						mail = '$mail',
						mdp = '$mdp',
                        add-date = '$addDate',
                        connexion = '$connexion'
						where id = '$id' ";
        $stmt = $con->query($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

// suprime un user
function deleteUser($id)
{
    try {
        $con = connexion();
        $sql = "DELETE from users where id = '$id' ";
        $stmt = $con->query($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function getNewUser()
{
    $user['id'] = "";
    $user['nom'] = "";
    $user['prenom'] = "";
    $user['mail'] = "";
    $user['mdp'] = "";
    $user['add-date'] = "";
    $user['connexion'] = "";
}
