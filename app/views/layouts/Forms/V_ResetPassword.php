<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperació de Contrasenya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="public/css/stylesLogin.css">
</head>
<body>
    <div class="contenedor-recuperar">
        <h2>Recuperació de Contrasenya</h2>

        <div class="img-forgot">
            <img src="Images/forgot2.png" alt="">
        </div>
        
        <form action="index.php?controller=Login&method=send_reset_email" method="post">

            <label class="label-enviar" for="email">Correu electrònic</label>
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu correu" required>
            </div>

            <button type="submit" class="enviar">Enviar</button>
        </form>

        <script type='text/javascript'>document.addEventListener('DOMContentLoaded', function () {window.setTimeout(document.querySelector('svg').classList.add('animated'),1000);})</script>
    </div>
    
</body>
</html>