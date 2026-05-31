<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="css/sidebar.css">

    <title>Dashboard</title>

    @yield('style')
</head>
<body>
    <div class="d-flex">
        @include('include.sidebar')
        <div class="flex-grow-1 p-4 overflow-auto">
            @yield('content')
        </div>
    </div>

    @include('include.toast')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    @yield('script')
    <script>
        const currentPath = window.location.pathname;

        const subLinks = document.querySelectorAll('.collapse .nav-link');
        subLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname;

            if (currentPath === linkPath) {

            link.classList.add('active');
            link.classList.remove('text-white-50');

            const parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.add('show');

                const toggle = document.querySelector(
                `[data-bs-target="#${parentCollapse.id}"], [href="#${parentCollapse.id}"]`
                );
                if (toggle) toggle.setAttribute('aria-expanded', 'true');
            }
            }
        });
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>