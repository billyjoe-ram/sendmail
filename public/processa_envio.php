<?php
    // Verifica se veio o post para cá, se não olta pro index
    if (count($_POST)
        && isset($_POST['para'])
        && isset($_POST['assunto'] )
        && isset($_POST['mensagem'])) {
        require '../private/processa_envio.php';
    } else {
        header('Location: index.php');
    }