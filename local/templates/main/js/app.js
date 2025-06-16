document.addEventListener("DOMContentLoaded", function () {
	// header scroll
	let header = document.querySelector('.js--header');
	let old_value = window.pageYOffset || document.documentElement.scrollTop;
	let scroll_top;

	function checkScroll() {
		scroll_top = window.pageYOffset || document.documentElement.scrollTop;
		const productSticky = document.querySelector('.js--productside');

		if ( scroll_top>0 ) {
			header.classList.add('header__fixed')
		} else {
			header.classList.remove('header__fixed')
		}

		if(old_value > scroll_top) {
			header.classList.add('header__hide')
			if (productSticky && window.innerWidth > 992) {
				productSticky.style.top = '240px';
			}
		} else if(old_value < scroll_top) {
			header.classList.remove('header__hide')
			if (productSticky && window.innerWidth > 992) {
				productSticky.style.top = '40px';
			}
		}
		old_value = scroll_top
	}

	if (header) {
		checkScroll()
		window.addEventListener("scroll", function() {
			checkScroll()
		})
	}
	// /header scroll

	// fancybox
	Fancybox.bind("[data-fancybox]", {
		// options
	})


	// scroll crumbs to end
	const blockCrumbs = document.querySelector(".crumbs ol");
	if (blockCrumbs && window.innerWidth < 992 ) {
		blockCrumbs.scrollLeft = 9999;
	}
	// /scroll crumbs to end

	const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
	const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

	// phone mask
	let inputsPhone = document.querySelectorAll(".js--maskphone");
	if (inputsPhone) {
		var phoneMask = new Inputmask("+7 (999) 999 99 99");
		phoneMask.mask(inputsPhone);
	}

	// fancybox for modals
	Fancybox.bind("[data-fancybox-html]", {
		autoFocus: false,
		mainClass: 'fancy-newcontent',
		dragToClose: true,
	})
	// fancybox for filter
	Fancybox.bind("[data-fancybox-filter]", {
		autoFocus: false,
		mainClass: 'fancy-filter',
		dragToClose: true,
		closeButton: false,
		on: {
			done:(fancybox) => {
				checkfilteritems()
			}
		}
	})
	const filterBtnClose = document.querySelector('.js--filter-close');
	if (filterBtnClose) {
		filterBtnClose.addEventListener('click', function() {
			Fancybox.close();
		})
	}

	// counter cart
	const inputscartCount = document.querySelectorAll('.js--inputcount');
	if (inputscartCount) {
		Array.prototype.forEach.call(inputscartCount, function (inputbox) {
			let btnMinus = inputbox.querySelector('.js--inputcount-minus');
			let btnPlus = inputbox.querySelector('.js--inputcount-plus');
			let thisInput = inputbox.querySelector('.js--inputcount-input');
			let min = thisInput.min;
			let max = thisInput.max;

			btnMinus.addEventListener('click', function() {
				let inputVal = thisInput.value;
				inputVal = --inputVal
				if (inputVal>=min & inputVal<=max) {
					thisInput.value = inputVal
				}
				let wrapCard = inputbox.closest('.js--card-wrap');
				if (wrapCard) {
					if (inputVal == 0 & wrapCard.classList.contains('active')) {
						let btn = wrapCard.querySelector('.js--card-btn')

						btn.classList.remove('mbtn__active')
						btn.textContent = 'В корзину'
						wrapCard.classList.remove('active')
					}
				}
			})

			btnPlus.addEventListener('click', function() {
				let inputVal = thisInput.value;
				inputVal = ++inputVal
				if (inputVal>=min & inputVal<=max) {
					thisInput.value = inputVal
				}
			})
		})
	}
	// counter cart

	// смена блоков по кнопке "купить"
	const btnsToCart = document.querySelectorAll('.js--card-btn');
	Array.prototype.forEach.call(btnsToCart, function (btn) {
		btn.addEventListener('click', function() {
			let btnWrap = btn.closest('.js--card-wrap');
			if (!btn.classList.contains('active')) {
				btn.classList.add('mbtn__active')
				btn.textContent = 'В корзине'
			}
			if (!btnWrap.classList.contains('active')) {
				btnWrap.classList.add('active')
			}
		})
	})

	function checkAddedToCart() {
		Array.prototype.forEach.call(btnsToCart, function (btn) {
			let btnWrap = btn.closest('.js--card-wrap');
			if (btn.classList.contains('mbtn__active')) {
				btnWrap.classList.add('active')
				btn.textContent = 'В корзине'
			}
		})
	}
	checkAddedToCart()
	// /смена блоков по кнопке "купить"

	// filter mobile
	const filterSide = document.querySelector('.js--filter');
	const filterSideBtn = document.querySelector('.js--filter-btn-open');
	const filterSideClose = document.querySelector('.js--filter-btn-close');

	if (filterSide) {
		filterSideBtn.onclick = function () {
			filterSide.classList.add('filter-side__opened')
		}
		filterSideClose.onclick = function () {
			filterSide.classList.remove('filter-side__opened')
		}
	}
	// filter mobile

	// sorter
	const sortBtn = document.querySelector('.js--sort-btn');
	const sortBlock = document.querySelector('.js--sort');
	const sortLinks = document.querySelectorAll('.js--sort-link');

	if (sortBlock) {
		sortBtn.onclick = function () {
			sortBlock.classList.toggle('catalog__sort__mobile__opened')
		}

		Array.prototype.forEach.call(sortLinks, function (link) {
			link.onclick = function () {
				textLink = link.innerHTML;
				sortBlock.classList.remove('catalog__sort__mobile__opened')
				sortBtn.innerHTML= '<span>'+textLink+'</span>'
			}
		})
	}
	// sorter

	const crumbs = document.querySelector('.crumbs ol');
	if (crumbs) {
		blockForOffset = document.querySelector('.crumbs__offset');
		function crumbsOffset() {
			if (window.innerWidth<992) {
				crumbs.style.paddingLeft = blockForOffset.offsetLeft
				crumbs.style.paddingRight = blockForOffset.offsetLeft
			} else {
				crumbs.style.paddingLeft = "0"
				crumbs.style.paddingRight = "0"
			}
		}
		crumbsOffset()

		window.addEventListener('resize', () => {
			crumbsOffset()
		});

		window.addEventListener('orientationchange', () => {
			crumbsOffset()
		});
	}

	const tabsButtons = document.querySelectorAll('.js--tabs-link');

tabsButtons.forEach(btn => {
	btn.addEventListener('click', (event) => {
		event.preventDefault()
		const prevActiveItem = document.querySelector('.js--tabs-link.active');
		const prevActiveButton = document.querySelector('.js--tabs-item.active');

		if (prevActiveButton) {
			prevActiveButton.classList.remove('active');
		}

		if (prevActiveItem) {
			prevActiveItem.classList.remove('active');
		}
		const nextActiveItemId = `#${btn.getAttribute('data-tab')}`;
		const nextActiveItem = document.querySelector(nextActiveItemId);

		btn.classList.add('active');
		nextActiveItem.classList.add('active');

		if (window.innerWidth < 556) {
			const tabsNav = document.querySelector('.js--tabs-nav');
			const style= getComputedStyle(btn);
			if (!parseInt(style.marginLeft) == 0) {
				tabsNav.scrollLeft = 999;
			} else {
				tabsNav.scrollLeft = 0;
			}
		}
	})
})
;
	// mobile nav menu
const navBtn = document.querySelector('.js--mobilemenu-btn');
const nav = document.querySelector('.js--mobilemenu');

if (navBtn) {
	navBtn.onclick = function () {
		nav.classList.toggle('mobilemenu__opened');
		navBtn.classList.toggle('active');
		document.body.classList.toggle('no-scroll');

        let popupOpened = nav.querySelector('.active');
        if (popupOpened) {
            popupOpened.classList.remove('active');
        }
	}

	// mobile slide links menu
	let btnToSlide = document.getElementsByClassName('js--mobilemenu-linkslide');
	let i;

	for ( i = 0; i < btnToSlide.length; i++) {
		btnToSlide[i].addEventListener("click", function() {
			let item = this.closest('.mobilemenu__nav__link');
			let submenu = item.nextElementSibling;
            submenu.classList.add('active')
		})
	}
	let btnToClose = document.getElementsByClassName('js--mobilemenu-close');
	let y;

	for ( y = 0; y < btnToClose.length; y++) {
		btnToClose[y].addEventListener("click", function() {
			let submenu = this.closest('.mobilemenu__nav__sub');
            submenu.classList.remove('active')
		})
	}
    // /mobile slide links menu
}
;
	const textareas = document.querySelectorAll('.js--form-textarea');

if (textareas) {
	Array.prototype.forEach.call(textareas, (text) => {
		let wrap = text.closest('.form__textarea')

		text.onfocus = function() {
			wrap.classList.add('focus')
		}
		text.onblur = function() {
			// if (!text.value.length) {
			// 	console.log('!')
			// 	wrap.classList.remove('focus')
			// } else {
			// 	wrap.classList.add('focus')
			// }

			wrap.classList.remove('focus')
		}

		if (!text.value.length) {
			wrap.classList.remove('focus')
		} else {
			wrap.classList.add('focus')
		}
	})
}
;
	// faq
const btnFaqToSlide = document.getElementsByClassName('js--faq-link');
if (btnFaqToSlide) {
	for ( let y = 0; y < btnFaqToSlide.length; y++) {

		btnFaqToSlide[y].addEventListener("click", function() {
			let card = this.closest('.js--faq-card');
			card.classList.toggle("active")
			let faqContent = card.querySelector('.js--faq-slide');
			if (faqContent.style.maxHeight) {
				faqContent.style.maxHeight = null
			} else {
				faqContent.style.maxHeight = faqContent.scrollHeight + "px";
			}
		})
	}
}
// /faq


// filter slide
const filterBtnsTitle = document.getElementsByClassName('js--filter-title');
if (filterBtnsTitle) {
	for ( let i = 0; i < filterBtnsTitle.length; i++) {

		filterBtnsTitle[i].addEventListener("click", function() {
			this.classList.toggle("active")
			let filterContent = this.nextElementSibling;
			if (filterContent.style.maxHeight) {
				filterContent.style.maxHeight = null
			} else {
				filterContent.style.maxHeight = filterContent.scrollHeight + "px";
			}
			checkfilterBtns()
		})
	}

	function checkfilteritems() {
		const filterBtnsTitle = document.getElementsByClassName('js--filter-title');
		for ( let i = 0; i < filterBtnsTitle.length; i++) {

			if (filterBtnsTitle[i].classList.contains('active')) {
				let filterContent = filterBtnsTitle[i].nextElementSibling;
				filterContent.style.maxHeight = filterContent.scrollHeight + "px";
			}
		}
	}
	function checkfilterBtns() {
		const filterBtnsMore = document.querySelectorAll('.js--filter-btnmore');
		setTimeout(function() {
			for ( let i = 0; i < filterBtnsMore.length; i++) {

				let filterCard = filterBtnsMore[i].closest('.js--filter-slide');
				let filterContent = filterCard.querySelector('.js--filter-content');
				if (filterContent.offsetHeight < 168) {
					filterBtnsMore[i].closest('.js--filter-more').classList.add('removed')
				}

			}
		},500)
	}
	if (window.innerWidth > 1200 ) {
		checkfilteritems()
		checkfilterBtns()
	}

	// filter btn more
	const filterBtnsMore = document.querySelectorAll('.js--filter-btnmore');
	if (filterBtnsMore) {
		setTimeout(function() {
			for ( let i = 0; i < filterBtnsMore.length; i++) {
				filterBtnsMore[i].addEventListener("click", function(e) {
					e.preventDefault();
					this.classList.toggle('active')
					let filterCard = this.closest('.js--filter-slide');
					filterCard.classList.toggle('activeshow')
					filterCard.style.maxHeight = 560 + "px";
				})

			}
		},500)

		if (window.innerWidth > 1200 ) {
			checkfilterBtns()
		}
	}
	// /filter btn more
}
// /filter slide


;
	const slidersFull = document.querySelectorAll('.js--fullslider');

if (slidersFull) {
	slidersFull.forEach((slider) => {
		const sliderWrap = slider.closest('.js--fullslider-wrap');
		const sliderFullOffset = sliderWrap.querySelector('.js--fullslider-offset');
		const sliderbtnPrev = sliderWrap.querySelector('.js--fullslider-prev');
		const sliderbtnNext = sliderWrap.querySelector('.js--fullslider-next');

		const sliderCounter = sliderWrap.querySelector('.js--fullslider-counter');
		const sliderLenght = sliderWrap.querySelector('.js--fullslider-lenght');

		let spbSlides = 40;
		let spbSlidesMobile = 20;

		let left = function left() {
			let offsetLeft;
			return offsetLeft = sliderFullOffset.offsetLeft;
		};

		let swiperFull = new Swiper(slider, {
			init: false,
			slidesPerView: 'auto',
			freeMode: true,
			autoHeight: true,
			speed: 1000,
			slidesOffsetBefore: left(),
			slidesOffsetAfter: left(),
			spaceBetween: spbSlidesMobile,
			slideToClickedSlide: false,
			breakpoints: {
				992: {
					slidesPerView: 3,
					slidesPerGroup: 3,
					freeMode: false,
					spaceBetween: spbSlidesMobile,
					slidesOffsetBefore: 0,
					slidesOffsetAfter: 0,
				},
				1460: {
					slidesPerView: 4,
					slidesPerGroup: 4,
					freeMode: false,
					spaceBetween: spbSlides,
					slidesOffsetBefore: 0,
					slidesOffsetAfter: 0,
				}
			},
			navigation: {
				disabledClass: 'disabled',
				prevEl: sliderbtnPrev,
				nextEl: sliderbtnNext,
			},
		});

		swiperFull.init();

		window.addEventListener('resize', () => {
			if (window.innerWidth < 992) {
				swiperFull.params.slidesOffsetBefore = left();
				swiperFull.params.slidesOffsetAfter = left();
				swiperFull.update(true);
				if (swiperFull.activeIndex === 0) {
					swiperFull.slideTo(0);
				}
			}
		});

		window.addEventListener('orientationchange', () => {
			if (window.innerWidth < 992) {
				swiperFull.params.slidesOffsetBefore = left();
				swiperFull.params.slidesOffsetAfter = left();
				swiperFull.update(true);
				if (swiperFull.activeIndex === 0) {
					swiperFull.slideTo(0);
				}
			}
		});
	})
}
;
	const sliderWelcome = document.querySelector('.js--welcome');

if(sliderWelcome) {
	const welcomeSwiper = new Swiper(sliderWelcome, {
		loop: true,
		effect: "fade",
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},

        pagination: {
			el: '.js--welcome-pag',
			clickable: true,
			bulletClass: 'welcome__slider__dotts__bullet',
			bulletActiveClass: 'active'
		},

        navigation: {
			disabledClass: 'disabled',
			nextEl: '.js--welcome-next',
			prevEl: '.js--welcome-prev',
		},
	})
}
;
	const sliderGallery = document.querySelector('.js--gallery-slider');

if(sliderGallery) {
	const gallerySwiper = new Swiper(sliderGallery, {
		loop: true,
		slidesPerView: 1,
        slidesPerGroup: 1,
		autoHeight: true,
		spaceBetween: 10,
        
        breakpoints: {
			991: {			  
				slidesPerView: 2,
				slidesPerGroup: 1,
				spaceBetween: 40,
			}
		},

        pagination: {
			el: '.js--gallery-pag',
			clickable: true,
			bulletClass: 'slider__pag__bullet',
			bulletActiveClass: 'active'
		},

        navigation: {
			disabledClass: 'slider__nav__btn__disable',
			nextEl: '.js--gallery-next',
			prevEl: '.js--gallery-prev',
		},
	})
};
	const sliderCert = document.querySelector('.js--certslider');

if (sliderCert) {
	const sliderCertOffset = document.querySelector('.js--certslider-offset');

	console.log(sliderCertOffset.offsetLeft)

	let spbSlides2 = 40;
	let spbSlides2Mobile = 20;

	let leftcert = function leftcert() {
		let offsetLeft;
		return offsetLeft = sliderCertOffset.offsetLeft;
	};
	console.log(leftcert())

	let swiperCert = new Swiper(sliderCert, {
		init: false,
		slidesPerView: 'auto',
		freeMode: true,
		autoHeight: true,
		speed: 1000,
		slidesOffsetBefore: leftcert(),
		slidesOffsetAfter: leftcert(),
		spaceBetween: spbSlides2Mobile,
		slideToClickedSlide: false,
		breakpoints: {
			992: {
				slidesPerView: 4,
				slidesPerGroup: 4,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			},
			1200: {
				slidesPerView: 5,
				slidesPerGroup: 5,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			},
			1441: {
				slidesPerView: 6,
				slidesPerGroup: 6,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			}
		},

        pagination: {
			el: '.js--certslider-pag',
			clickable: true,
			bulletClass: 'stslider__pag__bullet',
			bulletActiveClass: 'active'
		},

        navigation: {
			disabledClass: 'disabled',
			prevEl: '.js--certslider-prev',
			nextEl: '.js--certslider-next',
		},
	});

	swiperCert.init();

	window.addEventListener('resize', () => {
		if (window.innerWidth < 992) {
			swiperCert.params.slidesOffsetBefore = leftcert();
			swiperCert.params.slidesOffsetAfter = leftcert();
			swiperCert.update(true);
			if (swiperCert.activeIndex === 0) {
				swiperCert.slideTo(0);
			}
		}
	});

	window.addEventListener('orientationchange', () => {
		if (window.innerWidth < 992) {
			swiperCert.params.slidesOffsetBefore = leftcert();
			swiperCert.params.slidesOffsetAfter = leftcert();
			swiperCert.update(true);
			if (swiperCert.activeIndex === 0) {
				swiperCert.slideTo(0);
			}
		}
	});
}
;
	const sliderReviews = document.querySelector('.js--reviewsslider');

if (sliderReviews) {
	const sliderReviewsOffset = document.querySelector('.js--reviewsslider-offset');

	console.log(sliderReviewsOffset.offsetLeft)

	let spbSlides2 = 40;
	let spbSlides2Mobile = 20;

	let leftcert = function leftcert() {
		let offsetLeft;
		return offsetLeft = sliderReviewsOffset.offsetLeft;
	};
	console.log(leftcert())

	let swiperReviews = new Swiper(sliderReviews, {
		init: false,
		slidesPerView: 'auto',
		freeMode: true,
		autoHeight: true,
		speed: 1000,
		slidesOffsetBefore: leftcert(),
		slidesOffsetAfter: leftcert(),
		spaceBetween: spbSlides2Mobile,
		slideToClickedSlide: false,
		breakpoints: {
			992: {
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			},
			1200: {
				slidesPerView: 2,
				slidesPerGroup: 2,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			},
			1441: {
				slidesPerView: 3,
				slidesPerGroup: 3,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			}
		},

        pagination: {
			el: '.js--reviewsslider-pag',
			clickable: true,
			bulletClass: 'stslider__pag__bullet',
			bulletActiveClass: 'active'
		},

        navigation: {
			disabledClass: 'disabled',
			prevEl: '.js--reviewsslider-prev',
			nextEl: '.js--reviewsslider-next',
		},
	});

	swiperReviews.init();

	window.addEventListener('resize', () => {
		if (window.innerWidth < 992) {
			swiperReviews.params.slidesOffsetBefore = leftcert();
			swiperReviews.params.slidesOffsetAfter = leftcert();
			swiperReviews.update(true);
			if (swiperReviews.activeIndex === 0) {
				swiperReviews.slideTo(0);
			}
		}
	});

	window.addEventListener('orientationchange', () => {
		if (window.innerWidth < 992) {
			swiperReviews.params.slidesOffsetBefore = leftcert();
			swiperReviews.params.slidesOffsetAfter = leftcert();
			swiperReviews.update(true);
			if (swiperReviews.activeIndex === 0) {
				swiperReviews.slideTo(0);
			}
		}
	});

	const reviewBtnsMore = document.querySelectorAll('.js--review-more');
	if (reviewBtnsMore) {
		Array.prototype.forEach.call(reviewBtnsMore, function (btnMore) {
			btnMore.addEventListener('click', function(e) {
				e.preventDefault()
				let text = this.querySelector('span')
				let card = this.closest('.js--review-card');

				this.classList.toggle('active')
				if (this.classList.contains('active')) {
					text.textContent = "Свернуть"
				} else {
					text.textContent = "Подробнее"
				}
				card.classList.toggle('active')
				swiperReviews.update()
			})
		})
	}
}
;
	const sliderElseBlog = document.querySelector('.js--elseblog');

if (sliderElseBlog) {
	const sliderElseBlogOffset = document.querySelector('.js--elseblog-offset');

	let spbSlides2 = 40;
	let spbSlides2Mobile = 20;

	let leftcert = function leftcert() {
		let offsetLeft;
		return offsetLeft = sliderElseBlogOffset.offsetLeft;
	};

	let swiperElseBlog = new Swiper(sliderElseBlog, {
		init: false,
		slidesPerView: 'auto',
		freeMode: true,
		autoHeight: true,
		speed: 1000,
		slidesOffsetBefore: leftcert(),
		slidesOffsetAfter: leftcert(),
		spaceBetween: spbSlides2Mobile,
		slideToClickedSlide: false,
		breakpoints: {
			992: {
				slidesPerView: 2,
				slidesPerGroup: 2,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			},
			1200: {
				slidesPerView: 3,
				slidesPerGroup: 3,
				spaceBetween: spbSlides2,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
			}
		},

        // pagination: {
		// 	el: '.js--elseblog-pag',
		// 	clickable: true,
		// 	bulletClass: 'stslider__pag__bullet',
		// 	bulletActiveClass: 'active'
		// },

        // navigation: {
		// 	disabledClass: 'disabled',
		// 	prevEl: '.js--elseblog-prev',
		// 	nextEl: '.js--elseblog-next',
		// },
	});

	swiperElseBlog.init();

	window.addEventListener('resize', () => {
		if (window.innerWidth < 992) {
			swiperElseBlog.params.slidesOffsetBefore = leftcert();
			swiperElseBlog.params.slidesOffsetAfter = leftcert();
			swiperElseBlog.update(true);
			if (swiperElseBlog.activeIndex === 0) {
				swiperElseBlog.slideTo(0);
			}
		}
	});

	window.addEventListener('orientationchange', () => {
		if (window.innerWidth < 992) {
			swiperElseBlog.params.slidesOffsetBefore = leftcert();
			swiperElseBlog.params.slidesOffsetAfter = leftcert();
			swiperElseBlog.update(true);
			if (swiperElseBlog.activeIndex === 0) {
				swiperElseBlog.slideTo(0);
			}
		}
	});
}
;
	const slImages = document.querySelector('.js--primages');
if (slImages) {
	const slImagesThumbs = document.querySelector('.js--primages-thumbs')
	const swiperImagesThumbs = new Swiper(slImagesThumbs, {
		loop: false,
		spaceBetween: 6,
		slidesPerView: 3,
		autoHeight: true,
		centeredSlides: true,
	})

	const swiperImages = new Swiper(slImages, {
		loop: false,
		effect: "fade",
		autoHeight: true,
		navigation: {
			disabledClass: 'disabled',
			nextEl: ".js--primages-next",
			prevEl: ".js--primages-prev",
		},
		controller: {
			control: swiperImagesThumbs,

		},
	})

	swiperImagesThumbs.controller.control = swiperImages;

	let anchors = document.querySelectorAll(".js--primages-thumbs-link");
    anchors.forEach(function (anchor, i) {
      anchor.addEventListener("click", function () {
        swiperImages.slideTo(i);
      })
    })
}
;
})

const mapBlock = document.querySelector('#js--map');

if (mapBlock) {
	ymaps.ready(init);
	const koord =$(".footer__map__place").data('koord').split(',');
	const adress =$(".footer__map__place").data('adress');
	const name =$(".footer__map__place").data('name');

	function init() {
		// Создаем карту
		let mapContacts = new ymaps.Map(mapBlock, {
			center: [parseFloat(koord[0]), parseFloat(koord[1])],
			zoom: 17,
			controls: [
				'zoomControl'
			],
			zoomMargin: [20]
		});

		// Точка на карте
		let PlacemarkContacts = new ymaps.Placemark(
			[parseFloat(koord[0]), parseFloat(koord[1])],
			{
				hintContent: name,
				balloonContent: adress
			}, {
				iconLayout: 'default#image',
				iconImageHref: './img/pin-map.svg',
				iconImageSize: [45, 52],
				iconImageOffset: [-22, -52]
			}
		);

		// Добавляем точку на карту
		mapContacts.geoObjects.add(PlacemarkContacts);
	}
}
;




