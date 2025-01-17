<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Sidebar Menu Bar CSS</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <input type="checkbox" id="check" checked>
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <!-- <i class="fas fa-times" id="cancel"></i> -->
    </label>
    <div class="sidebar">
        <header>My Expense</header>
        <ul>
            <li><a href="#"><i class="fas fa-qrcode"></i>Dashboard</a></li>
            <li><a href="#"><i class="fas fa-link"></i>Shortcuts</a></li>
            <li><a href="#"><i class="fas fa-stream"></i>Overview</a></li>
            <li><a href="#"><i class="fas fa-calendar-week"></i>Events</a></li>
            <li><a href="#"><i class="far fa-question-circle"></i>About</a></li>
            <li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li>
            <li><a href="#"><i class="far fa-envelope"></i>Contact</a></li>
        </ul>
    </div>
    <section>
        <main class="py-4">
            @yield('content')
        </main>
    </section>
</body>
</html>
