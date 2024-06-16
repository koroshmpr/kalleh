<section>
    <div class="row">
        <div class="col-lg-5 px-0">
            <?php get_template_part('template-parts/global/prizes'); ?>
        </div>
        <div class="col-lg-7 bg-secondary px-0 d-flex order-lg-last order-first justify-content-center align-items-center">
            <img class="object-fit-contain img-fluid" src="<?= get_field('header_image')['url'] ?? '' ?>" alt="<?= get_field('header_image')['title'] ?? '' ?>">
        </div>
    </div>
</section>