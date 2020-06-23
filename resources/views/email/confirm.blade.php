<style>
    .container {
        margin: 0 auto;
        display: block;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
    }

    .bg-red {
        color: red;
        text-decoration: none;
        font-weight: bold;
    }

    .bg-blue {
        color: blue;
    }

    .fw-bold {
        font-weight: bold;
    }

    .principal {
        font-size: 30px;
    }

    .font-italic {
        font-style: italic;
    }
</style>

<div class="container my-5">
    <h1>Bienvenido! {{ $msg['name'] }} {{ $msg['surname'] }}</h1>

    <h2>Un saludo muy cordial desde nuestra plataforma <span class="bg-blue">Tienda Web!</span></h2>
    <p>Sólo queda un paso para que disfrutes de nuestros servicios</p>
    <p class="principal">Completa tu registro <a href="{{ route('user.confirm', $msg['email_token']) }}" class="bg-red fw-bold">aquí</a></p>

    <p class="font-italic">Ten un gran resto de día, atentamente El equipo de <span class="bg-blue fw-bold">Tienda Web</span></p>
</div>