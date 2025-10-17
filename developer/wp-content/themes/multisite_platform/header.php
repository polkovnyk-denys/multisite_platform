<!doctype html>
<html lang="uk"
    prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Multisite Platform">
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Open .main-wrapper -->

    <?php
    get_template_part(
        sections_path('header-section')
    );
    ?>

    <main class="wrapper flex justify-center">