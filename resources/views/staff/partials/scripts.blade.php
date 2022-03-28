 <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}">
 </script>
 <script src="{{ asset('admin/js/scripts.js') }}"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 @if (session('swalLoginStaff'))
     <script>
         Swal.fire({
             title: 'Logare reusita',
             text: 'Ati fost logat cu succes pe site ca membru staff',
             icon: 'success',
             confirmButtonText: 'Cool',

         })
     </script>
 @endif

 @stack('customJs')
 {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> --}}
 {{-- <script src="js/datatables-simple-demo.js"></script> --}}
