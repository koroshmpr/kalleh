<?php
$user_id = get_current_user_id();
$referralCode = ($user_id * 300) + 100000;
?>

<div class="text-center d-flex align-items-center justify-content-center gap-3">
    <h5 class="mb-0 fw-bold text-dark">کد معرف شما :</h5>
    <div class="col-lg-1 col-3 fs-3 text-secondary" id="referralCode"><?= $referralCode; ?></div>
    <input class="d-none" type="text" id="hiddenReferralCode" value="<?= $referralCode; ?>">
    <button class="btn bg-secondary p-2 rounded-1 text-white" onclick="copyReferralCode()">کپی کد</button>
</div>
<div class="text-center d-flex my-3 align-items-center justify-content-center gap-3">
    <h5 class="mb-0 fw-bold text-dark">اشتراک در: </h5>
    <a href="https://t.me/share/url?url=<?= home_url(); ?>&text=کد معرف : <?= $referralCode; ?>"
       target="_blank"
       class="btn rounded-1">
        <svg width="30" height="30" fill="#0088cc" class="bi bi-telegram" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
        </svg>
    </a>
    <a href="https://wa.me/?text=کد معرف : <?= $referralCode; ?> در وبسایت : <?= home_url(); ?>"
       target="_blank"
       class="btn rounded-1 text-secondary">
        <svg  width="30" height="30" fill="#25D366" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
        </svg>
    </a>
</div>
<?php
$message = $args['message'];
if ($message):
    ?>
    <article class="fs-4 px-3 mt-3 d-flex align-items-center gap-2 justify-content-center text-dark">
        <?= get_field('nomoreentry'); ?>
    </article>
<?php endif; ?>

<script>
    function copyReferralCode() {
        var copyText = document.getElementById("hiddenReferralCode");

        // Make the input field temporarily visible to select the text
        copyText.classList.remove('d-none');
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand("copy");

        // Hide the input field again
        copyText.classList.add('d-none');

        // Optionally, you can add a Bootstrap alert to notify the user
        var alertPlaceholder = document.getElementById("alertPlaceholder");
        if (!alertPlaceholder) {
            alertPlaceholder = document.createElement("div");
            alertPlaceholder.id = "alertPlaceholder";
            document.body.appendChild(alertPlaceholder);
        }
        var alertHTML = `
        <div id="copyAlert" class="position-fixed translate-middle-x bottom-0 start-50 mb-5 alert col-10 col-lg-3 mx-auto alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            کد معرف کپی شد
        </div>`;
        alertPlaceholder.innerHTML = alertHTML;
        setTimeout(function () {
            var copyAlert = document.getElementById("copyAlert");
            copyAlert.remove()
        }, 2000)
    }
</script>