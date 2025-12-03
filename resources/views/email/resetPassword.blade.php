<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
            font-size: 24px;
        }
        .message {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            padding: 12px 24px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
        .footer {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Recuperação de Senha</h1>
        </div>

        <div class="message">
            <p>Olá,</p>
            <p>Recebemos uma solicitação para redefinir a senha da sua conta. Para continuar, clique no link abaixo:</p>
            <p><a href="{{ $link }}" class="button">Redefinir Senha</a></p>
            <p>Se você não solicitou a redefinição de senha, pode ignorar este e-mail.</p>
        </div>

        <div class="footer">
            <p>Se você tiver dificuldades, entre em contato com nosso suporte.</p>
            <p>&copy; {{ date('Y') }} Sua Empresa. Todos os direitos reservados.</p>
        </div>
    </div>

</body>
</html>
