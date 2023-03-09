<?php

session_start();

include_once("conn.php");
include_once("url.php");

$data = $_POST;
// Modificações no Banco
if (!empty($data)) {
  print_r($data);
  if ($data["type"] === "create") {
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
