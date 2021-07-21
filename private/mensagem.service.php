<?php

    // Arquivos da biblioteca PHPMailer
    require '../public/libs/PHPMailer/Exception.php';
    require '../public/libs/PHPMailer/OAuth.php';
    require '../public/libs/PHPMailer/PHPMailer.php';
    require '../public/libs/PHPMailer/POP3.php';
    require '../public/libs/PHPMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    class MensagemService {
        private $mensagem;

        public function __construct(Mensagem $mensagem) {
            $this->mensagem = $mensagem;
        }
        
        private function mensagemValida() {
            // Reatribuindo valores filtrados            
            $para = trim($this->mensagem->para);         
            $assunto = trim($this->mensagem->assunto);
            $mensagem = trim($this->mensagem->mensagem);

            // Incialmente a mensagem não é válida, a menos que...
            $mensagemValida = false;

            // Como já foi verificado se o índice veio no POST, checo se não é uma string
            // vazia para poder seguir
            if (!empty($para) && !empty($assunto) && !empty($mensagem)) {
                // Verificando se as strings atendem ao tamanho mínimo
                if (
                    (strlen($para) >= 7)
                    && (strlen($assunto) >= 3)
                    && (strlen($mensagem) >= 6)
                ) {
                    $mensagemValida = true;
                }
            }

            return $mensagemValida;
        }

        public function mensagemEnvia() {
            // Eu preferi fazer a validação no próprio service antes de enviar para
            // aproveitar ao máximo o conceito de um serviço e reutilizar o máximo
            // de código que esteja no mesmo contexto, nesse caso (de mensagem)

            // Esse método vai retornar true se a mensagem tiver sido enviada ou
            // false se não tiver sido enviada ou não for válida
            if (!$this->mensagemValida()) {
                // return false;
                return;
            }

            // Seção trazida diretamente da documentação
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings

                //Enable verbose debug output
                $mail->SMTPDebug = false;
                //Send using SMTP
                $mail->isSMTP();
                //Set the SMTP server to send through
                $mail->Host = 'smtp.gmail.com';
                //Enable SMTP authentication
                $mail->SMTPAuth = true;
                //SMTP username
                $mail->Username = 'your_mail@gmail.com';
                //SMTP password
                $mail->Password = 'your_password!';
                //Enable implicit TLS encryption
                $mail->SMTPSecure = 'tls';
                //TCP port to connect to; use 587 if you have set
                // `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('your_mail@gmail.com');
                //Add a recipient
                $mail->addAddress($this->mensagem->para);

                //Content
                //Set email format to HTML
                $mail->isHTML(true);
                $mail->Subject = $this->mensagem->assunto;
                $mail->Body = '<pre>' . $this->mensagem->mensagem . '</pre>';
                $mail->AltBody = $this->mensagem->mensagem;
                
                $mail->send();

                $this->mensagem->status = [
                    'cd_status' => 1,
                    'ds_status' => 'E-mail enviado com sucesso!'
                ];
            } catch (Exception $e) {
                $this->mensagem->status = [
                    'cd_status' => 0,
                    'ds_status' => "Erro ao enviar e-mail: {$mail->ErrorInfo}"
                ];
            }

            return $this->mensagem->status;
        }
    }
