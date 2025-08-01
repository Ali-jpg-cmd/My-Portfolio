<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="portfolio-app">
        <!-- React app will be served from frontend server -->
        <div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
            <h1>Qasim Ali - Portfolio</h1>
            <p>This is the WordPress backend for the portfolio.</p>
            <p>The React frontend should be accessed separately.</p>
            <p>REST API endpoints are available at:</p>
            <ul style="list-style: none; padding: 0;">
                <li><code>/wp-json/portfolio/v1/personal</code></li>
                <li><code>/wp-json/portfolio/v1/skills</code></li>
                <li><code>/wp-json/portfolio/v1/experience</code></li>
                <li><code>/wp-json/portfolio/v1/education</code></li>
                <li><code>/wp-json/portfolio/v1/contact</code> (POST)</li>
            </ul>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>