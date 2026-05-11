(function ($) {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const $window = $(window);
    const $document = $(document);
    const $header = $('[data-header]');
    const $progress = $('[data-scroll-progress]');
    const $cursor = $('.cursor-aura');

    function updateHeader() {
        $header.toggleClass('is-scrolled', $window.scrollTop() > 18);
    }

    function updateProgress() {
        const docHeight = $document.height() - $window.height();
        const progress = docHeight > 0 ? ($window.scrollTop() / docHeight) * 100 : 0;
        $progress.css('width', progress + '%');
    }

    function setActiveNav() {
        const $sectionLinks = $('.nav-link[data-section-link]');
        if (!$sectionLinks.length) {
            return;
        }

        const scrollTop = $window.scrollTop() + 130;
        let activeId = '';

        $('section[id]').each(function () {
            const $section = $(this);
            if ($section.offset().top <= scrollTop) {
                activeId = $section.attr('id');
            }
        });

        $sectionLinks.removeClass('active');
        if (activeId) {
            const $target = $('.nav-link[href="#' + activeId + '"]');
            if ($target.length) {
                $target.addClass('active');
            } else {
                $('.nav-link[href="#top"]').addClass('active');
            }
        }
    }

    function initReveal() {
        const revealItems = document.querySelectorAll('.reveal');

        if (prefersReducedMotion || !('IntersectionObserver' in window)) {
            revealItems.forEach((item) => item.classList.add('is-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '0px 0px -12% 0px',
            threshold: 0.14,
        });

        revealItems.forEach((item, index) => {
            item.style.transitionDelay = Math.min(index % 5, 4) * 70 + 'ms';
            observer.observe(item);
        });
    }

    function initSkillMarquee() {
        const $track = $('.skill-track');
        if (!$track.length || $track.data('cloned')) {
            return;
        }

        $track.append($track.children().clone());
        $track.attr('aria-hidden', 'false');
        $track.data('cloned', true);
    }

    function initCursor() {
        if (!$cursor.length || prefersReducedMotion || window.matchMedia('(pointer: coarse)').matches) {
            return;
        }

        $document.on('mousemove', function (event) {
            $cursor.addClass('is-visible');
            $cursor.css({
                transform: 'translate3d(' + event.clientX + 'px, ' + event.clientY + 'px, 0) translate3d(-50%, -50%, 0)',
            });
        });

        $('a, button, input, select, textarea, .tilt-card').on('mouseenter focus', function () {
            $cursor.addClass('is-active');
        }).on('mouseleave blur', function () {
            $cursor.removeClass('is-active');
        });
    }

    function initMagneticButtons() {
        if (prefersReducedMotion || window.matchMedia('(pointer: coarse)').matches) {
            return;
        }

        $('.magnetic').each(function () {
            const element = this;

            $(element).on('mousemove', function (event) {
                const rect = element.getBoundingClientRect();
                const relX = event.clientX - rect.left - rect.width / 2;
                const relY = event.clientY - rect.top - rect.height / 2;

                element.style.transform = 'translate(' + relX * 0.12 + 'px, ' + relY * 0.22 + 'px)';
            });

            $(element).on('mouseleave blur', function () {
                element.style.transform = '';
            });
        });
    }

    function initTiltCards() {
        if (prefersReducedMotion || window.matchMedia('(pointer: coarse)').matches) {
            return;
        }

        $('.tilt-card').each(function () {
            const card = this;

            $(card).on('mousemove', function (event) {
                const rect = card.getBoundingClientRect();
                const x = (event.clientX - rect.left) / rect.width - 0.5;
                const y = (event.clientY - rect.top) / rect.height - 0.5;
                card.style.transform = 'perspective(900px) rotateX(' + (-y * 4).toFixed(2) + 'deg) rotateY(' + (x * 5).toFixed(2) + 'deg)';
            });

            $(card).on('mouseleave blur', function () {
                card.style.transform = '';
            });
        });
    }

    function initNavClose() {
        $('.navbar-nav .nav-link').on('click', function () {
            const nav = document.getElementById('mainNav');
            if (nav && nav.classList.contains('show') && window.bootstrap) {
                window.bootstrap.Collapse.getOrCreateInstance(nav).hide();
            }
        });
    }

    function setStatus($status, message, type) {
        $status
            .removeClass('is-success is-error')
            .addClass('is-visible ' + (type === 'success' ? 'is-success' : 'is-error'))
            .text(message);
    }

    function clearErrors($form) {
        $form.find('.field-error').text('');
        $form.find('[aria-invalid="true"]').removeAttr('aria-invalid');
    }

    function paintErrors($form, errors) {
        Object.keys(errors || {}).forEach(function (field) {
            const message = errors[field];
            const $field = $form.find('[name="' + field + '"]');
            $field.attr('aria-invalid', 'true');
            $form.find('[data-error-for="' + field + '"]').text(message);
        });
    }

    function initBriefForm() {
        const $form = $('#briefForm');
        if (!$form.length) {
            return;
        }

        $form.on('submit', function (event) {
            event.preventDefault();

            const $submit = $form.find('[type="submit"]');
            const $status = $form.find('[data-form-status]');

            clearErrors($form);
            $status.removeClass('is-visible is-success is-error').text('');
            $submit.prop('disabled', true).text('Sending...');

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                dataType: 'json',
            }).done(function (response) {
                setStatus($status, response.message || 'Your brief has been received.', 'success');
                $form[0].reset();
            }).fail(function (xhr) {
                const response = xhr.responseJSON || {};
                setStatus($status, response.message || 'Something went wrong. Please try again.', 'error');
                paintErrors($form, response.errors || {});
            }).always(function () {
                $submit.prop('disabled', false).text('Send private brief');
            });
        });
    }

    $document.ready(function () {
        initReveal();
        initSkillMarquee();
        initCursor();
        initMagneticButtons();
        initTiltCards();
        initNavClose();
        initBriefForm();

        updateHeader();
        updateProgress();
        setActiveNav();
    });

    $window.on('scroll resize', function () {
        updateHeader();
        updateProgress();
        setActiveNav();
    });
})(jQuery);
