<section class="bg-secondary row align-items-center py-4 bg-cover px-0 h-100" >
    <div class="container text-center text-white p-lg-2 p-4">
        <h3 class="fw-bolder fs-3"><?= get_field('prize_title_first') ?></h3>
        <p class="fw-bolder fs-4"><?= get_field('prize_title_second') ?></p>
        <?php
        $prizes = get_field('prizes');
        if ($prizes) :
            $i=0;
            ?>
            <div class="row col-11 col-xl-8 mx-auto mt-4 row-cols-2 px-1 px-lg-0 overflow-hidden">
                <?php foreach ($prizes as $prize) :?>
                    <div class="p-2 rounded-3" data-aos="fade-up" data-aos-delay="<?= $i;?>0">
                        <img class="border-white p-3 mb-3 border border-2 shadow rounded-3 object-fit-contain" width="100" height="100" src="<?= $prize['image']['url'] ?? ''; ?>" alt="<?= $prize['image']['title'] ?? ''; ?>">
                        <h4 class="text-white fs-5"><?= $prize['name'] ?></h4>
                    </div>
                <?php
                $i+=5;
                endforeach; ?>
            </div>
        <?php endif;
        ?>
    </div>
</section>