<section class="bg-secondary py-lg-5 py-4 position-relative">
    <div class="container d-flex flex-column flex-lg-row justify-content-start justify-content-lg-center align-items-center">
        <img class="calendar-img pb-4 pb-lg-0"  src="<?= get_field('calendar_image')['url'] ?? ''; ?>"
             alt="<?= get_field('calendar_image')['title'] ?? ''; ?>" data-aos="flip-right">
        <div class="row col-lg-6 text-center">
            <h3 class="text-white fs-3 fw-bold"><?= get_field('calendar_title'); ?></h3>
            <h4 class="text-dark fw-bold fs-4"><?= get_field('calendar_date'); ?></h4>
            <h5 class="fs-2 mt-3 text-white fw-bolder"><?= get_field('lottery_title'); ?></h5>
            <article class="fw-bold text-dark fs-4"><?= get_field('lottery_content'); ?></article>
        </div>
    </div>
</section>
<style>
    @media (max-width: 768px) {
        .calendar-img {
            height: 140px!important;
        }
    }
    .calendar-img {
        height: 200px;
    }
</style>