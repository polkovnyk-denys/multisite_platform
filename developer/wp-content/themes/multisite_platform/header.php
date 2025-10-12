<!doctype html>
<html lang="uk"
    prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <link rel="shortcut icon" type="image/x-icon" href="/assets/favicon.ico" />
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Multisite Platform">

    <meta name="msapplication-TileImage" content="/assets/android-chrome-192x192.png">
    <meta name="msapplication-TileColor" content="#1c1c">
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Open .main-wrapper -->
    <header class="header">
        <?php
        get_template_part(
            sections_path('header-section')
        );
        ?>
    </header>
    <main class="wrapper">