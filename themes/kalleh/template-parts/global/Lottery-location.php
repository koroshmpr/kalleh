<section class="bg-contain bg-dark" style="background-image: url('<?= get_field('lottery_image')['url'] ?? ''; ?>')">
    <div class="container lottery-location mx-auto text-white row align-content-center justify-content-center text-center">
        <h5 class="fs-2 text-dark fw-bolder"><?= get_field('lottery_title'); ?></h5>
        <article class="fw-bold fs-3"><?= get_field('lottery_content'); ?></article>
    </div>
</section>