<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>cat</title>
</head>

<body>
    <div class="">
        <h1 style="text-align: center">Les catégories </h1>
        <br>
        <section>
            <ul class="nav nav-pills justify-content-sm-center mb-4 px-3">
                <?php
                $categories = array(
                    array("java", "JAVA", "/AllinOne/images/icones/java.png", "Dev JAVA", "This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "400 $"),
                    array("php", "PHP", "/AllinOne/images/icones/php.png", "Dev PHP", "This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "400 $"),
                    array("ruby", "RUBY", "/AllinOne/images/icones/ruby.png", "Dev RUBY", "This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "400 $"),
                    array("js", "JS", "/AllinOne/images/icones/js.png", "Dev Js", "This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "400 $"),
                    array("python", "PYTHON", "/AllinOne/images/icones/pyton.png", "Dev Python", "This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "400 $"),
                    // Ajoutez d'autres catégories ici
                );

                foreach ($categories as $category) {
                    echo '<li class="nav-item me-2 me-sm-5">
                            <button class="btn btn-outline-primary nav-link" data-bs-toggle="collapse" data-bs-target="#' . $category[0] . '" aria-expanded="false" aria-controls="' . $category[0] . '" type="button">
                                <img src="' . $category[2] . '" width="40px" alt="">' . $category[1] . '
                            </button>
                        </li>';
                }
                ?>
            </ul>
        </section>
    </div>
    <div class="row">
        <?php
        foreach ($categories as $category) {
            echo '<div class="col-md-4 collapse" id="' . $category[0] . '">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="' . $category[2] . '" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">' . $category[3] . '</h5>
                                <p class="card-text">' . $category[4] . '</p>
                                <p class="card-text"><small class="text-muted">' . $category[5] . '</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>

</body>

</html>
