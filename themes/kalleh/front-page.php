<?php /* Template Name: Home */
get_header();

if (have_posts()) {
    the_post();
    ?>
    <?php
    $user_id = get_current_user_id();
    $front_page_id = get_option('page_on_front');
    $formId = get_field('formID', $front_page_id);
    echo get_template_part('template-parts/uploadedImages');
    if (is_user_logged_in()) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gf_entry';
        $query = "SELECT form_id, created_by FROM $table_name WHERE form_id = %d AND created_by = %d";
        $user_id = get_current_user_id();
        $prepared_query = $wpdb->prepare($query, $formId, $user_id);
        $results = $wpdb->get_results($prepared_query);
        // Check if the user has previously filled the form
        if ($results) {
            $args = array(
                'message' => true
            );
            get_template_part('template-parts/referral-code', null, $args);

        } else {
            get_template_part('template-parts/global/heroSlider'); ?>
            <?php get_template_part('template-parts/global/points-table'); ?>
            <?php get_template_part('template-parts/global/form-details'); ?>
            <section class="container py-2">
                <?= do_shortcode('[gravityform id=' . $formId . ' title="false" description="false" ajax="true"]'); ?>
            </section>
            <div style="display: none;" class="pt-5" id="referralCodeContainer">
                <?php
                $args = array(
                    'message' => false
                );
                get_template_part('template-parts/referral-code', null, $args); ?>
            </div>
        <?php }
    } else {
        get_template_part('template-parts/global/hero-banner');
        $args = array(
           'cta' => true
        );
        get_template_part('template-parts/global/slogan' , true , $args);
//        get_template_part('template-parts/global/prizes');
        get_template_part('template-parts/global/heroSlider');
        get_template_part('template-parts/global/steps');
        get_template_part('template-parts/global/calendar');
//        get_template_part('template-parts/global/Lottery-location');
        get_template_part('template-parts/global/points-table');
        get_template_part('template-parts/global/register-form');
        get_template_part('template-parts/global/winners');
        get_template_part('template-parts/global/aparat-video');
    }
    ?>
<?php }
get_footer();
