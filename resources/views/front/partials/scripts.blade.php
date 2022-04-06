 <!-- Vendor JS Files -->
 <script src="/front/assets/js/main.js/assets/vendor/purecounter/purecounter.js"></script>
 <script src="/front/assets/js/main.js/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="/front/assets/js/main.js/assets/vendor/glightbox/js/glightbox.min.js"></script>
 <script src="/front/assets/js/main.js/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
 <script src="/front/assets/js/main.js/assets/vendor/swiper/swiper-bundle.min.js"></script>
 <script src="/front/assets/js/main.js/front/assets/js/main.js/assets/vendor/php-email-form/validate.js"></script>

 <!-- Template Main JS File -->
 <script src="/front/assets/js/main.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 @if (session('newUser'))
     <script>
         Swal.fire({
             title: 'Contul a fost creat',
             text: 'A fost trimis un email ce contine un link pentru confirmarea contului. Linkul este valabil doua ore ',
             icon: 'success',
             confirmButtonText: 'OK',

         });
     </script>
 @endif
 @stack('customJs')
