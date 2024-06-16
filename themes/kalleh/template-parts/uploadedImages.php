<?php
if (is_user_logged_in()) {
    global $wpdb;
    $formId = get_field('formID'); // Make sure you are retrieving the correct form ID
    $entry_table = $wpdb->prefix . 'gf_entry';
    $meta_table = $wpdb->prefix . 'gf_entry_meta';
    $form_meta_table = $wpdb->prefix . 'gf_form_meta';

    $user_id = get_current_user_id();

    // Retrieve form metadata to get field labels
    $form_meta_query = "SELECT display_meta FROM $form_meta_table WHERE form_id = %d";
    $form_meta_prepared_query = $wpdb->prepare($form_meta_query, $formId);
    $form_meta_results = $wpdb->get_var($form_meta_prepared_query);

    $form_meta = json_decode($form_meta_results, true);

    $query = "SELECT $meta_table.meta_value, $meta_table.meta_key 
              FROM $meta_table 
              INNER JOIN $entry_table 
              ON $meta_table.entry_id = $entry_table.id
              WHERE $entry_table.form_id = %d 
              AND $entry_table.created_by = %d
              AND $meta_table.meta_key NOT LIKE '%\_%'"; // Exclude internal keys

    $prepared_query = $wpdb->prepare($query, $formId, $user_id);
    $results = $wpdb->get_results($prepared_query);

    // Function to get field label by field ID
    function get_field_label($form_meta, $field_id)
    {
        if (isset($form_meta['fields']) && is_array($form_meta['fields'])) {
            foreach ($form_meta['fields'] as $field) {
                if (isset($field['id']) && $field['id'] == $field_id) {
                    return isset($field['label']) ? $field['label'] : '';
                }
            }
        }
        return '';
    } ?>

    <?php // Check if the user has previously filled the form
    if ($results) { ?>
        <section class="bg-secondary text-white d-flex justify-content-center align-items-center py-5 mb-4 bg-cover"
                 style="min-height: 30vh; background-image: url('<?php echo get_field('prize_bg')['url'] ?? ''; ?>');">
            <h1 class="fw-bolder display-1 text-center mb-0">
                <?php
                if ($user_id != 0) {
                    // Get user meta data for points
                    $points = get_user_meta($user_id, 'wps_wpr_points', true);
                    // Check if points exist
                    if ($points !== '') { ?>
                        <?php echo $points; ?>
                        <br>
                        <p class="display-6 fw-bolder">امتیاز</p>
                    <?php } else { ?>
                        <div>0 امتیاز</div>
                    <?php }
                } ?>
            </h1>
        </section>
        <h3 class="fw-bold text-center fs-4 text-dark-subtle">تصاویر ثبت شده</h3>
        <div class="container">
            <div class="row justify-content-center mb-2 py-4 mx-2">
                <?php
                $j = 1;
                $i = 500;
                foreach ($results as $result) {
                    $urls = json_decode($result->meta_value, true); // Decode the JSON string
                    $field_id = $result->meta_key;
                    $field_label = get_field_label($form_meta, $field_id);
                    if (is_array($urls)) {

                        foreach ($urls as $url) {
                            if ($url) {
                                $formatted_url = str_replace('\/', '/', $url); ?>
                                <div class="image-entry p-3 d-flex align-items-center justify-content-center border bg-dark bg-opacity-10 border-white border-2 <?php echo $j == 4 ? 'col-12' : 'col-4'; ?>">
                                    <img style="height:auto;max-height: 250px;" data-aos-delay="<?php echo $i; ?>" data-aos="zoom-out"
                                         title="<?php echo $field_label; ?>"
                                         class="img-fluid object-fit-contain" src="<?php echo esc_url($formatted_url); ?>"
                                         alt="<?php echo esc_html($field_label); ?>">
                                </div>
                                <?php
                                $j++;
                                $i += 50;
                            }
                        }
                    }
                } ?>
            </div>
        </div>
    <?php }
}
?>