import 'bootstrap';
import { Toast } from 'bootstrap';
import $ from 'jquery';
import 'swiper/css';
import Swiper from 'swiper/bundle';
import AOS from 'aos';
import 'aos/dist/aos.css';

let validReferalId, validReferalIdPoint, pointValue;
document.addEventListener('DOMContentLoaded', function () {
    AOS.init();
    const heroSlider = new Swiper('.hero_slider', {
        direction: 'horizontal',
        slidesPerView: 1,
        spaceBetween: 0,
        grabCursor: true,
        speed: 700,
        autoplay: {
            delay: 5000,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: true, // Ensures the keyboard control only works when Swiper is in viewport
        },
        effect: 'slide',
        on: {
            init: function () {
                const slides = this.slides;

                // Initialize all slides
                slides.forEach((slide, index) => {
                    let elementsWithAos = slide.querySelectorAll('[data-aos]');
                    elementsWithAos.forEach((element) => {
                        if (index === this.realIndex) {
                            element.classList.add('aos-animate');
                        } else {
                            element.classList.remove('aos-animate');
                        }
                    });
                });
            },
            slideChange: function () {
                const activeSlideIndex = this.realIndex;
                const slides = this.slides;

                // Handle slide change
                slides.forEach((slide, index) => {
                    let elementsWithAos = slide.querySelectorAll('[data-aos]');
                    elementsWithAos.forEach((element) => {
                        if (index === activeSlideIndex) {
                            element.classList.add('aos-animate');
                        } else {
                            element.classList.remove('aos-animate');
                        }
                    });
                });
            }
        }

    });
    const point = document.querySelector('#point');
    const totalPoint = document.querySelector('#totalPoint');
    const referPoint = $('#mainHeader').data('point');

    // Function to count elements with the class 'ginput_preview'
    function countGInputPreviewElements() {
        const ginputPreviewElements = document.querySelectorAll('.ginput_preview');
        let count = 0;
        for (let element of ginputPreviewElements) {
            if (element.querySelector('.gfield_fileupload_percent')) {
                count++;
            }
        }
        // console.log('Number of elements with class ginput_preview and a percentSpan child element:', count);
        pointValue = count;
        $('#point').empty();
        if (pointValue == 7) {
            pointValue = Number(10);
        }
        if (pointValue < 7) {
            pointValue = Number(count);
        }
        if (point) {
            point.append(pointValue);
        }
    }
    setInterval(function () {
        countGInputPreviewElements();
    },1000)

// Function to create a MutationObserver
    function observeGInputPreviewElements() {
        // Create a MutationObserver instance
        const observer = new MutationObserver(function (mutationsList, observer) {
            // Loop through all mutations in the list
            for (let mutation of mutationsList) {
                // Check if nodes were added
                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                    // Loop through added nodes
                    for (let node of mutation.addedNodes) {
                        // Check if the added node has the class 'ginput_preview'
                        setTimeout(function () {
                            if (node.classList && node.classList.contains('ginput_preview') && node.children.length > 0) {
                                // Check if the added node has a child element with class 'gfield_fileupload_percent'
                                const percentSpan = node.querySelector('.gfield_fileupload_percent');
                                if (percentSpan && percentSpan.textContent.trim() === '100%') {
                                    // Call the function to count elements with the class 'ginput_preview'
                                    countGInputPreviewElements();
                                }
                            }
                        }, 3000)
                    }
                }
            }
        });

        // Configure the MutationObserver to observe changes in the DOM
        observer.observe(document.body, {childList: true, subtree: true});
    }
    function setupDeleteListener() {
        $(document).on('click', '.dashicons-trash', function () {
            // Call the function to count elements with the class 'ginput_preview' and a percentSpan child element
            countGInputPreviewElements();
        });
    }

// Call the function to count elements with the class 'ginput_preview' initially
    countGInputPreviewElements();
// Call the function to create a MutationObserver to watch for changes
    observeGInputPreviewElements();
    setupDeleteListener();
// check existanse of refferal user
    $(document).ready(function () {
        $('#referalCheker').on('click', function () {
            const referalId = $('#input_3_2').val();
            if (!isNaN(referalId)) {
                $.ajax({
                    url: custom_login_vars.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'check_user_existence',
                        referal_id: referalId
                    },
                    success: function (response) {
                        if (response.success) {
                            if (response.data.exists) {
                                $('#input_3_2').removeClass('bg-danger bg-opacity-25').addClass('bg-success bg-opacity-25');
                                validReferalIdPoint = response.data.points;
                                validReferalId = referalId;
                                showToast('کد معرف درست می‌باشد.', 'bg-success');
                            } else {
                                validReferalId = false;
                                showToast('کد معرف اشتباه است.', 'bg-danger');
                                setTimeout(function(){
                                    $('#input_3_2').val('');
                                },1000)
                            }
                        } else {
                            $('#input_3_2').removeClass('bg-success bg-opacity-25').addClass('bg-danger bg-opacity-25');
                            showToast('کد معرف اشتباه است.', 'bg-danger');
                            setTimeout(function(){
                                $('#input_3_2').val('');
                            },1000)
                        }
                    },
                    error: function (xhr, status, error) {
                        showToast('ارتباط برقرار نشد.', 'bg-danger');
                    }
                });
            } else {
                showToast('کد معرف وجود ندارد.', 'bg-danger');
            }
        });

        function showToast(title, headerClass) {
            const toastHtml = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header ${headerClass} bg-opacity-75 text-white border-0">
                    <p class="me-auto fs-6 mb-0">${title}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

            const toastContainer = $('#toast-container');
            if (toastContainer.length === 0) {
                $('body').append('<div id="toast-container" class="toast-container position-fixed bottom-0 start-0 p-3"></div>');
            }

            $('#toast-container').append(toastHtml);
            const newToast = $('#toast-container .toast').last();
            const bootstrapToast = new Toast(newToast[0]);
            bootstrapToast.show();

            newToast.on('hidden.bs.toast', function () {
                $(this).remove();
            });
        }
    });
// add action after submit form
    jQuery(document).on('gform_confirmation_loaded', function (event, formId) {
        if (formId === 3) {
            event.preventDefault();
            if (validReferalId && validReferalIdPoint) {
                updateReferralPoints(validReferalId, validReferalIdPoint);
            }
            if (validReferalId && Number(validReferalId)) {
                pointValue = pointValue + referPoint;
            }
            updatePoints(pointValue);
            $('#descriptionPoint').hide(500);
            // Force a full page reload bypassing cache
            setTimeout(function() {
                location.reload(true);
            }, 1000); // Adjust the delay if necessary
        }
    });

    function updateReferralPoints(validReferalId, validReferalIdPoint) {
        jQuery.ajax({
            url: custom_login_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'update_referral_points', // Changed action name
                userReferralId: Number(validReferalId),
                additionalPoints: Number(validReferalIdPoint),
                nonce: custom_login_vars.nonce
            },
            success: function (response) {
                console.log('New referral points:', response);
            },
            error: function (xhr, status, error) {
                // Error handling
                console.error('AJAX request failed. Status: ' + status + ', Error: ' + error);
            },
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8'
        });
    }
    function updatePoints(pointValue) {
        jQuery.ajax({
            url: custom_login_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'update_user_points',
                pointValue: pointValue,
                nonce: custom_login_vars.nonce
            },
            success: function (response) {
                console.log('Success')
            },
            error: function (xhr, status, error) {
                // Error handling
                console.log('AJAX request failed. Status: ' + status + ', Error: ' + error);
            },
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8'
        });
    }
});