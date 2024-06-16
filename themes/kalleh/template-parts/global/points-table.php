<section class="text-center py-5 bg-cover position-relative" style="background-image: url('<?= get_field('prize_bg')['url'] ?? ''; ?>');">
    <h5 class="fw-bolder mb-4 fs-2 text-secondary"><?= get_field('points-title'); ?></h5>
    <?php
   $points = get_field('points');
   if($points):
       $i=0;
    foreach ($points as $point): ?>
        <div class="d-flex gap-3 col-10 mx-auto fs-5 col-lg-3 align-items-start justify-content-between">
            <div class="text-start text-dark-subtle fw-bld bg-white"><?= $point['title']; ?></div>
            <div data-aos="fade-right" data-aos-duration="400" data-aos-delay="<?= $i; ?>0" class="col-3 text-secondary bg-white bg-opacity-50 rounded-1 fw-bold"><?= $point['point']; ?> <span class="ms-2">امتیاز</span>  </div>
        </div>
    <?php
    $i+=5;
    endforeach;
    endif;

    ?>
</section>

