{{-- resources/views/emails/welcome.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} | Boas-Vindas</title>
</head>
<body>
    {{-- Acessando como um array associativo --}}
    <h1>Olá, {{ $userData['name'] }}!</h1>
    
    <p>É um prazer tê-lo(a) em nosso Gerenciador de Tarefas!</p>
    <p>Seu e-mail de acesso é: **{{ $userData['email'] }}**</p>

    <p>Qualquer dúvida, estamos à disposição.</p>

    <p>Atenciosamente,<br>
    A Equipe.</p>
</body>
</html>