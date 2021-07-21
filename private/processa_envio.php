<?php
    require_once '../private/mensagem.model.php';

    require_once '../private/mensagem.service.php';

    // Criando uma nova mensagem
    $mensagemEnvio = new Mensagem();

    // Criando variáveis para validação e verificação
    $para = $_POST['para'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $mensagemEnvio->__set('para', $para);
    $mensagemEnvio->__set('assunto', $assunto);
    $mensagemEnvio->__set('mensagem', $mensagem);

    $mensagemService = new MensagemService($mensagemEnvio);

    $mensagemStatus = $mensagemService->mensagemEnvia();
?>

<html lang="pt-br">
    <head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
			integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
			crossorigin="anonymous"
		>

	</head>
<body>
    <div class="container">
        <div class="py-3 text-center">
            <img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
            <h2>Send Mail</h2>
            <p class="lead">Seu app de envio de e-mails particular!</p>
        </div>

        <div class="row">
            <div class="col-12">
                <?php
                    if (isset($mensagemStatus)) {
                        if ($mensagemStatus['cd_status']) {
                            $estadoEnvio = 'success';
                        } else {
                            $estadoEnvio = 'warning';
                        ?>                          
                        <?php
                        }
                        ?>
                            <div class="alert alert-<?= $estadoEnvio ?>" role="alert">
                                <?= $mensagemStatus['ds_status']; ?>
                            </div>
                        <?php
                    } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Erro! Tente novamente mais tarde...
                        </div>
                <?php
                    }
                ?>
                <a href="../public/index.php" class="btn btn-success">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</body>
</html>
    