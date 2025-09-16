<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curriculo</title>
</head>
<body>
    <p>Confirme Suas informações de cadastro</p>
    <p>Nome: {{ $data['name'] }}</p><br/>
    <p>Email: {{ $data['email'] }}</p><br/>
    <p>Telefone: {{ $data['phone'] }}</p><br/>
    <p>Cargo: {{ $data['position'] }}</p><br/>
    <p>Formação: {{ $data['education'] }}</p><br/>
    <p>Observações: {{ $data['observations'] }}</p><br/>
</body>
</html>
