<button type="button" class="fs-4 bg-white text-center btn text-dark border-0 p-0"
        data-bs-toggle="modal"
        data-bs-target="#loginModal">
    <span class="text-secondary fw-bold fs-5">ثبت نام</span> / ورود
</button>
<!-- Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-1 bg-white bd-blur-10">
            <div class="modal-header bg-primary rounded-top">
                <h3 class="modal-title text-white fs-5" id="staticBackdropLabel">ورود</h3>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="woocommerce-form woocommerce-form-login login text-primary border-0 my-0 p-lg-5 p-3"
                      method="post">
                    <?php do_action('woocommerce_login_form_start'); ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                        <label class="pb-3 text-dark fw-bold" for="username">شماره موبایل</label>
                        <div class="border border-primary border-1 rounded-3 p-3">
                            <input type="text"
                                   class="w-100 border-0 border-bottom border-dark pb-1 bg-transparent"
                                   style="padding-left: 58px!important;"
                                   name="username"
                                   id="username" autocomplete="username"
                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/>
                        </div>
                    </div>
                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                        <input class="border border-primary border-1 rounded-3 p-3 w-100"
                               type="password" placeholder="پسورد"
                               name="password" id="password" autocomplete="current-password"/>
                    </div>

                    <?php do_action('woocommerce_login_form'); ?>
                    <p class="form-row">
                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <button type="submit"
                                class="w-100 btn bg-primary text-white rounded-3 py-2 fw-bold fs-4 <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                                name="login"
                                value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
                    </p>


                    <?php do_action('woocommerce_login_form_end'); ?>
                </form>
            </div>
        </div>
    </div>
</div>