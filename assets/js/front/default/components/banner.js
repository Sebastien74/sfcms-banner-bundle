import Carousel from '../../bootstrap/dist/carousel';

export default function () {

    let carousels = document.querySelectorAll('.banner-carousel');

    /** To check if carousel is in view port */
    let carouselInViewPort = function (carousel) {
        let inViewport = isInViewport(carousel);
        if (inViewport) {
            let activeBanner = carousel.querySelector('.carousel-item.active').querySelector('.banner');
            addOneView(activeBanner);
            carousel.addEventListener('slid.bs.carousel', function (ev) {
                let activeBanner = ev.relatedTarget.querySelector('.banner');
                let inViewport = isInViewport(carousel);
                if (inViewport && !activeBanner.classList.contains('already-show')) {
                    addOneView(activeBanner);
                }
            });
        }
    }

    /** On click */
    document.querySelectorAll('.banner').forEach(pub => {
        pub.addEventListener('click', evt => {
            if (!pub.classList.contains('already-click')) {
                let oReq = new XMLHttpRequest();
                oReq.onload = reqListener;
                oReq.open("POST", pub.getAttribute('data-path'), true);
                oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                oReq.send(new URLSearchParams({'event': 'click'}));
                pub.classList.add('already-click');
            }
        });
    });

    /** Active on load */
    carousels.forEach(carousel => {
        new Carousel(carousel);
        carouselInViewPort(carousel);
    });

    document.addEventListener('scroll', () => {
        carousels.forEach(carousel => {
            carouselInViewPort(carousel);
        });
    });

    /** To add one in count view */
    function addOneView(pub) {
        if (!pub.classList.contains('already-show')) {
            let oReq = new XMLHttpRequest();
            oReq.onload = reqListener;
            oReq.open("POST", pub.getAttribute('data-path'), true);
            oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            oReq.send(new URLSearchParams({'event': 'load'}));
            pub.classList.add('already-show');
        }
    }

    function isInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function reqListener() {
        let response = this.responseText;
        let responseDecoded = JSON.parse(response);
        if (!responseDecoded.success) {
            console.log(responseDecoded.message);
        }
    }
}