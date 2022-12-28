<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../resources/assets/meta.html" ?>
    <style>
        .banner {
            background: rgb(141, 4, 133);
            background: #111111;
            padding: 200px 100px 100px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner .content {
            max-width: 700px;
        }

        .banner .content h2 {
            font-size: 3em;
            color: #fff;
            margin-bottom: 10px;
        }

        .banner .content p {
            font-size: 1em;
            color: #fff;
            margin: 10px;
        }

        .banner .content a {
            display: inline-block;
            background: #fff;
            color: #000;
            padding: 8px 20px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
        }

        .banner .image {
            max-width: 400px;
            margin-left: 30px;
        }

        @media(max-width:991px) {
            .banner {
                padding: 150px 20px 50px;
                flex-direction: column-reverse;
            }

            .banner .image {
                margin-left: 0;
                max-width: 80%;
                margin-bottom: 30px;
            }

            .banner .content h2 {
                font-size: 2em;
            }
        }

        @media(max-width:600px) {
            .banner .image {
                margin-top: 30px;
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <?php include "../resources/partials/header--default.html" ?>
    <div class="banner">
        <div class="content">
            <h2>SitePersist</h2>
            <p>SitePersist nace de un proyecto formativo de la Tecnica en Desarrollo de Software conformado por Mateo Londoño y Sebastian Lopez, estudiantes
                de SENA en convenio con la Institución Universitaria Salazar y Herrera. <br>
                SitePersist es simplicidad; un basico imprescindible que entiende que las gestiones se pueden hacer con claridad y orden al mismo tiempo.
                Por esto, nos dedicamos a pensar en la institución de hoy, para brindar herramientas de alta utilidad para sus procesos internos.</p>
            <a href="IUSH/">Ir a la IUSH</a>
        </div>
        <img src="/resources/assets/img/IUSH.png" class="image">
    </div>
    <?php include "../resources/partials/footer--default.html" ?>
</body>

</html>
