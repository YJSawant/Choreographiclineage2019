<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Choreographic Lineage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Asap">
    <link rel="stylesheet" href="../css/global.css">
    <style>
        .portrait {
            width: 200px;
        }
        html,body{
            height: 100%;
            margin:0;
            padding:0;
        }
        .footer{
            margin-top: 13rem;
        }
    </style>
</head>

<body>


<div class="row">
    <div class="medium-8 column text-justify">
        <h2 class="text-center">Contact</h2>
        <hr>
        <section>
            <p><strong>Email ID : </strong><a href="mailto:choreographiclineage@gmail.com">choreographiclineage@gmail.com</a></p>
        </section>
        <section>
            <p><strong>Phone Number : </strong> +1 716-645-0605</p>
        </section>
    </div>

    <aside class="medium-4 column">
        <div class="callout primary">
            <div class="row text-center">
                <div class="small-6 column">
                    <a target="_blank" href="https://www.facebook.com/chlineage"><i class="fi-social-facebook"></i></a>
                </div>
                <div class="small-6 column">
                    <a target="_blank" href="https://twitter.com/ChLineage"><i class="fi-social-twitter"></i></a>
                </div>
            </div>
        </div>
    </aside>
</div>

</body>
<div class="footer">

<?php
include 'footer.php';
?>
</div>
</html>
