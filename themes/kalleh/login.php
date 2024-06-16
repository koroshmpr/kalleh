<?php /* Template Name: login */
get_header();
if(!is_user_logged_in()) :
?>
<div class="row min-vh-100">
    <section class="col-lg-8 h-100">
        <?php if (get_the_post_thumbnail_url()) { ?>
            <img src="<?php echo get_the_post_thumbnail_url() ?>"
                 data-aos="zoom-in" data-aos-delay="100" data-aos-duration="600"
                 class="w-100 object-fit-cover" height="300"
                 alt="<?php the_title(); ?>">
        <?php } ?>
    </section>
    <section data-aos="fade-right" data-aos-delay="300" class="col-lg-4 container">
        <?php get_template_part('template-parts/global/slogan'); ?>
        <a class="bg-secondary px-3 d-block mx-auto text-center text-white fs-4 py-2 rounded-1" style="width: 250px;" href="<?= home_url() ?>/#registerForm">ثبت نام</a>
        <form class="woocommerce-form woocommerce-form-login login text-primary border-0 my-0 p-lg-5 p-3"
              method="post">
            <?php do_action('woocommerce_login_form_start'); ?>

            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                <label class="pb-3 text-dark fw-bold" for="username">شماره موبایل را وارد کنید</label>
                <div class="border border-secondary border-1 bg-white rounded-1 p-3">
                    <input type="text"
                           class="w-100 border-0 bg-white"
                           style="padding-left: 58px!important;"
                           name="username"
                           id="username" autocomplete="username"
                           value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/>
                </div>
            </div>
            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                <input class="border border-secondary border-1 rounded-1 p-3 w-100"
                       type="password" placeholder="پسورد"
                       name="password" id="password" autocomplete="current-password"/>
            </div>

            <?php do_action('woocommerce_login_form'); ?>
            <p class="form-row">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <button type="submit"
                        class="w-100 btn bg-secondary text-white rounded-1 py-2 fw-bold fs-4 <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                        name="login"
                        value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
            </p>


            <?php do_action('woocommerce_login_form_end'); ?>
        </form>

    </section>
</div>
<?php
else :
    wp_redirect(home_url());
    exit;
endif;
get_footer();
?>
<style>
    @media (min-width: 768px) {
        img {
            height: 100vh;
        }
    }
</style>
