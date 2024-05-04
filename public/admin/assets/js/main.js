(function ($) {
    "use strict";
	//===== jquery code for sidebar menu
    $('.menu-item.has-submenu .menu-link').on('click', function(e){
        e.preventDefault();
        var $submenu = $(this).next('.submenu');
        if($submenu.is(':hidden')){
            $(this).parent('.has-submenu').siblings().find('.submenu').slideUp(200);
        }
        $submenu.slideToggle(200);
    });

    // Handling sub-submenu toggling
    $('.menu-item.has-submenu .sub-submenu > a').on('click', function(e){
        e.preventDefault();
        $(this).siblings('.sub-submenu-content').slideToggle(200);
    });

	// mobile offnavas triggerer for generic use
	$("[data-trigger]").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
		var offcanvas_id =  $(this).attr('data-trigger');
		$(offcanvas_id).toggleClass("show");
		$('body').toggleClass("offcanvas-active");
		$(".screen-overlay").toggleClass("show");

	});

	$(".screen-overlay, .btn-close").click(function(e){
		$(".screen-overlay").removeClass("show");
		$(".mobile-offcanvas, .show").removeClass("show");
		$("body").removeClass("offcanvas-active");
	});

	// minimize sideber on desktop

	$('.btn-aside-minimize').on('click', function(){
		if( window.innerWidth < 768) {
			$('body').removeClass('aside-mini');
			$(".screen-overlay").removeClass("show");
			$(".navbar-aside").removeClass("show");
			$("body").removeClass("offcanvas-active");
		}
		else {
			// minimize sideber on desktop
			$('body').toggleClass('aside-mini');
		}
	});

	//Nice select
	if ($('.select-nice').length) {
    	$('.select-nice').select2();
	}
    $(".js-select2").select2({
        closeOnSelect : false,
        placeholder : "Click to select an option",
        allowHtml: true,
        allowClear: true,
        tags: true // создает новые опции на лету
    });
    $('.icons_select2').select2({
		width: "100%",
		templateSelection: iformat,
		templateResult: iformat,
		allowHtml: true,
		placeholder: "Click to select an option",
		dropdownParent: $( '.select-icon' ),//обавили класс
		allowClear: true,
		multiple: false
	});


	function iformat(icon, badge,) {
		var originalOption = icon.element;
		var originalOptionBadge = $(originalOption).data('badge');

		return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
	}
	// Perfect Scrollbar
	if ($('#offcanvas_aside').length) {
		const demo = document.querySelector('#offcanvas_aside');
		const ps = new PerfectScrollbar(demo);
	}

	// Dark mode toogle
	$('.darkmode').on('click', function () {
		$('body').toggleClass("dark");
	});

})(jQuery);
