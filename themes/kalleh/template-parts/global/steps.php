<section class="container py-lg-4 py-2">
    <h4 class="text-secondary text-center mb-4 py-4 fw-bolder fs-2"><?= get_field('content-title'); ?></h4>
    <?php
    $steps = get_field('steps');
    if ($steps):
        foreach ($steps as $step) : ?>
        <div class="border-top border-secondary d-flex flex-wrap justify-content-center align-items-start mx-2">
            <h5 class="translate-middle-y fs-3 bg-white px-3 mb-0 text-secondary fw-bolder"><?= $step['title'] ?></h5>
            <article class="col-12 fs-5 py-lg-3 py-1 d-flex justify-content-center text-dark text-center"><?= $step['content'] ?></article>
        </div>
       <?php endforeach;
    endif;
    ?>
</section>