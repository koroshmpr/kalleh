<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="keywords" content="<?= get_bloginfo('name'); ?>">
    <meta name="description" content="<?= get_bloginfo('description'); ?>">
    <meta name="author" content="<?= get_bloginfo('author'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
    <?= get_field('scripts', 'option') ?? '<!-- no-scripts added   -->'; ?>
</head>

<body <?php body_class(); ?> >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N6RDVXWS"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php if (!is_page_template('login.php')): ?>
<header data-refer="<?= get_field('referalPoint'); ?>" data-point="<?= get_field('refer-point'); ?>" id="mainHeader"
        class="position-fixed bg-white start-0 end-0 top-0 shadow-sm">
    <nav class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">

            <?php
            $user_id = get_current_user_id();
            $formId = get_field('formID');
            global $wpdb;
            $table_name = $wpdb->prefix . 'gf_entry';
            $query = "SELECT form_id, created_by FROM $table_name WHERE form_id = %d AND created_by = %d";
            $user_id = get_current_user_id();
            $prepared_query = $wpdb->prepare($query, $formId, $user_id);
            $results = $wpdb->get_results($prepared_query);
            if (is_user_logged_in()) {
                ?>
                <form class="text-center" action="<?php echo esc_url(wp_logout_url(home_url())); ?>"
                      method="post">
                    <button class="border-0 btn bg-white text-secondary fw-bold fs-5" type="submit">
                        خروج
                    </button>
                </form>
            <?php } elseif (!is_user_logged_in()) { ?>
                    <div class="d-flex gap-2 align-items-center fs-4 fw-bold text-dark">
                        <a class="text-dark pb-2" href="#registerForm">ثبت نام</a>
                        /
                        <a href="<?= home_url() ?>/login" class="text-secondary pb-2">ورود</a>
                    </div>
            <?php }
            if (!$results && is_user_logged_in()) { ?>
                <div class="d-flex border-start ps-3 border-secondary text-secondary gap-2"> امتیاز:
                    <div id="point"></div>
                </div>
            <?php }
            ?>
        </div>
        <?php
        get_template_part('template-parts/global/site_logo');
        ?>

    </nav>
</header>
<?php endif;?>
<main class="overflow-hidden">





