<?php

session_start();

include_once("conn.php");
include_once("url.php");

$data = $_POST;
// Modificações no Banco
if (!empty($data)) {
  if ($data["type"] === "create") {
    $name = $data["name"];
    $phone = $data["phone"];
    $observations = $data["observations"];

    $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato criado com sucesso";
    } catch (PDOException $e) {
      // Erro na conexão
      $error = $e->getMessage();
      echo "Erro: $error";
    }
    // Redirecionando o usuario para a home
    header("Location:" . $BASE_URL . "../index.php");
  }
  // Seleção de Dados
} else {
  $id;

  if (!empty($_GET)) {
    $id = $_GET["id"];
  }

  // Retorna o dado de um contato
  if (!empty($id)) {
    $query =  "SELECT * FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $contact = $stmt->fetch();
  } else {
    // Retorna os dados de todos os contatos
    $contacts = [];
    $query = "SELECT * FROM contacts";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $contacts = $stmt->fetchAll();
  }
}


// Fechar conexão
$conn = null;
