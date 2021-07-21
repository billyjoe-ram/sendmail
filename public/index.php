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
      			<div class="col-md-12">
					  <div class="card-body font-weight-bold">
						<form action="processa_envio.php" method="POST">
							<div class="form-group">
								<label for="para">Para</label>
								<input
									type="email"
									class="form-control"
									id="para"
									name="para"
									placeholder="joao@dominio.com.br"
									minlength="7"
								>
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input
									type="text"
									class="form-control"
									id="assunto"
									name="assunto"
									placeholder="Assunto do e-mail"
									minlength="3"
								>
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea
									class="form-control"
									id="mensagem"
									name="mensagem"
									placeholder="Escreva aqui o corpo do e-mail a ser enviado"
									minlength="6"
									style="resize: none;"
								></textarea>
							</div>

							<div class="d-flex justify-content-end">
								<button
									type="submit"
									class="btn btn-primary btn-lg"
								>
									Enviar Mensagem
								</button>
							</div>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>