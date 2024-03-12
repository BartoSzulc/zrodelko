import LazyLoad from "vanilla-lazyload";
import { domReady } from '@roots/sage/client';
// import Header from "./components/Header";
import Carousels from "./components/Carousels";
import $ from "jquery";
import Alpine from 'alpinejs'
import AOS from 'aos';
import GLightbox from 'glightbox';
window.Alpine = Alpine

Alpine.start()



const lightbox = GLightbox({});

jQuery(function($) {
  // Listen for the success event when WooCommerce AJAX pagination is complete
  $(document.body).on('updated_wc_div', function() {
      // Scroll to the product list
      $('html, body').animate({
          scrollTop: $('#product-list').offset().top
      }, 1000); // You can adjust the scroll speed (1000 milliseconds in this example)
  });
});


// Check if the URL contains the slug "product"
if (window.location.href.includes("/produkt")) {
  // Check if the URL starts with "?pa-product_cat="
  if (window.location.search.startsWith("?pa-product_cat=")) {
    // Extract the query string starting with "?pa-product"
    const queryString = window.location.search.substring(window.location.search.indexOf("?pa-product"));
    
    // Build the new URL with the "alkohole" subpage and the query string
    const newUrl = "https://zrodelkoalkohole.pl/alkohole" + queryString;
    
    // Redirect to the new URL
    window.location.href = newUrl;

  }
}
if(window.location.href.includes("/alkohole")) {
  if (window.location.search.startsWith("?pa-product_cat=")) {
      $('html, body').animate({
          scrollTop: $('#product-list').offset().top
      }, 1000); // You can adju
  }
}


$('#btn_category_filter').click(function () {

  $('#category_filter').slideToggle();
  $(this).toggleClass('active');
  
});


$(document).ready(function () {
  $('#billing__billing_nip_field').add('#billing_adres_field').wrapAll('<div class="billing__billing_nip_field"></div>');
  $('#billing__billing_nip_field').add('#billing_adres_field').hide();


  $('#billing_chce_fakture_field').click(function () {

    if ($(this).find('input').is(':checked')) {
      $('#billing__billing_nip_field').add('#billing_adres_field').slideDown();
      }
      else {
        $('#billing__billing_nip_field').add('#billing_adres_field').slideUp();
      }
  });
});

$(document).ajaxComplete(function () {
  $('.bapf_parent_0 i').click(function () {
    $(this).siblings('ul').fadeToggle();
  });
});

AOS.init({
  offset: 0,
  duration: 600,
  easing: 'ease-in-sine',
  anchorPlacement: 'top-bottom'
});

$(document).ready(() => {
  if ($('#countdown').length > 0) {
    const endDate = new Date(countdownData.endDate);

    const updateCountdown = () => {
      const now = new Date();
      const timeLeft = endDate - now;

      if (timeLeft <= 0) {
        clearInterval(timer);
      } else {
        // const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor(timeLeft / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // $('.days').text(days);
        $('.hours-count').text(hours);
        $('.minutes-count').text(minutes);
        $('.seconds-count').text(seconds);
      }
    };

    const timer = setInterval(updateCountdown, 1000);
  }
  $('.mega-menu-link').wrapInner('<span class="mega-menu-link__text"></span>');

});
// Add click event handler to parent categories
$('.tab-links a').on('click', function (event) {
  event.preventDefault();

  $('.tab-links li').removeClass('active');

  const previousTab = $('.tab-content .tab.active');

  previousTab.fadeOut(300, function () {
    previousTab.removeClass('active');

    const target = $(event.target).attr('href');
    $(target).fadeIn(300).addClass('active');
  });

  $(event.target).parent().addClass('active');
});

const formsWithAnimatedLabels = document.querySelectorAll(
  ".formGeneral, .formNewsletter"
);
const focusedClass = "focused";
for (const form of formsWithAnimatedLabels) {
  const formControls = form.querySelectorAll(
    '[type="text"], [type="email"], [type="tel"]'
  );
  for (const formControl of formControls) {
    formControl.addEventListener("focus", function () {
      this.parentElement.nextElementSibling.classList.add(focusedClass);
    });
    formControl.addEventListener("blur", function () {
      if (!this.value) {
        this.parentElement.nextElementSibling.classList.remove(
          focusedClass
        );
      }
    });
  }
  form.parentElement.addEventListener("wpcf7mailsent", function () {
    const labels = document.querySelectorAll(".focused");
    for (const label of labels) {
      label.classList.remove(focusedClass);
    }
  });
}
/**
 * app.main
 */



const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  let lazyLoad = new LazyLoad({
    elements_selector: "[data-lazy]",
    load_delay: 300,
  });

  // let header = new Header();
  // header.init();

  let carousels = new Carousels();
  carousels.init();

  // let _mobileProductFilter = new MobileProductFilter();
  // _mobileProductFilter.init();


  // application code
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
