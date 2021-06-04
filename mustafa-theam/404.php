<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body  class="white-background">
        <?php get_header(); ?>

        <div class="container text-center page-not-found">
            <img src="<?php echo get_template_directory_uri() . '/images/404-error-page.jpg' ?>" alt="page not found image" >
            <h1>Page Not Found!</h1>
            <p class="lead">We are sorry but the page you are looking for is not found.</p>
        </div>
            
        <div class="footer404"><?php get_footer(); ?></span>
    </body>
</html>