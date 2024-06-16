<section class="col-9 col-lg-6 col-xl-4 mx-auto">
    <form method="post" id="registerForm"
          class="woocommerce-form woocommerce-form-register  register border-0 bg-white bg-opacity-25 bd-blur-10 my-0 p-lg-5 p-3 text-dark text-opacity-75" <?php do_action('woocommerce_register_form_tag'); ?> >
        <?php do_action('woocommerce_register_form_start'); ?>

        <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
            <p class="woocommerce-form-row w-100 woocommerce-form-row--wide form-row form-row-wide border border-primary border-1 rounded-3">
                <input type="text"
                       class="woocommerce-Input woocommerce-Input--text input-text border-secondary rounded-1 p-3 bg-transparent"
                       name="username" id="reg_username" autocomplete="username"
                       placeholder="نام کاربری"
                       value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/>
            </p>
        <?php endif; ?>
        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2">
            <label class="pb-2 text-dark fw-bold w-100 text-lg-start fs-5 text-opacity-75 text-center" for="reg_email">شماره موبایل‌تون رو وارد کنین</label>
            <div class="border border-secondary border-1 rounded-1 p-3">
                <input type="email"
                       class="w-100 border-0 bg-transparent"
                       name="email" id="reg_email" autocomplete="email"
                       value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/>
            </div>
        </div>
        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                <label class="pb-2 text-dark fw-bold w-100 text-lg-start fs-5 text-opacity-75 text-center"
                       for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span
                            class="required">*</span></label>
                <div class="border border-secondary border-1 rounded-1 p-3">
                    <input type="password"
                           class="w-100 border-0 bg-transparent"
                           name="password" id="reg_password" autocomplete="new-password"/>
                </div>
            </div>
        <?php else : ?>
        <?php endif; ?>
        <?php do_action('woocommerce_register_form'); ?>
        <p class="woocommerce-form-row form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit"
                    class="w-100 btn border-0 bg-secondary text-white rounded-1 py-2 fw-bold fs-4 <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit"
                    name="register"
                    value="<?php esc_attr_e('Register', 'woocommerce'); ?>">ثبت نام</button>
        </p>
        <?php do_action('woocommerce_register_form_end'); ?>
    </form>
</section>