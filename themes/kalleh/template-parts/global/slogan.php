<section class="text-center py-3 py-lg-5">
    <?php
    $front_page_id = get_option('page_on_front');
    get_template_part('template-parts/global/site_logo');
    ?>
    <h1 data-aos="fade-left" class="fw-bolder text-dark-subtle fs-2"><?= get_field('main_title' , $front_page_id) ?></h1>
    <h2 data-aos="fade-right" class="text-secondary fw-bold fs-4 <?= $args['cta'] ? 'mb-4' : '' ;?>"><?= get_field('main_title_caption', $front_page_id) ?></h2>
    <?php
    if($args['cta']) {?>
        <a class="bg-secondary px-3 d-block mx-auto text-white fs-4 py-2 rounded-1" style="width: 250px;" href="#registerForm">ثبت نام</a>
    <?php }
    ?>
</section>