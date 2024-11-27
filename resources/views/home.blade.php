@extends('templates.app')

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
        .menu-item img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-item:hover img {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-content {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .swiper-slide-active .hero-content {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-item {
            @apply relative overflow-hidden rounded-lg;
        }

        .gallery-item img {
            @apply w-full h-40 object-cover transition-transform duration-700 ease-[cubic-bezier(0.25, 1, 0.5, 1)];
            filter: grayscale(100%);
            transform: scale(1) rotate(0deg);
        }

        .gallery-item:hover img {
            @apply scale-110;
            filter: grayscale(0%);
            transform: scale(1.1) rotate(1deg);
        }

        .gallery-item:hover .gallery-overlay {
            @apply opacity-100;
        }

        .gallery-overlay {
            @apply absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 transition-opacity duration-500 ease-in-out;
        }

        .footer-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .footer-icon:hover {
            transform: scale(1.2);
            color: #ffffff;
        }
    </style>
@endpush
@section('content')
    <!-- Hero Section -->
    <div class="swiper-container h-screen">
        <div class="swiper-wrapper h-full">
            <div class="swiper-slide h-full bg-cover bg-center"
                style="background-image: url('https://png.pngtree.com/background/20230519/original/pngtree-an-old-coffee-shop-with-very-dark-walls-picture-image_2652909.jpg');">
                <div
                    class="flex flex-col justify-center items-center h-full bg-black bg-opacity-50 text-center hero-content">
                    <h1 class="text-white text-4xl md:text-6xl font-bold">OUR COFFEE</h1>
                    <p class="text-white text-lg md:text-xl mt-4">ONLY THE BEST OF SPECIALTY COFFEE FROM INDONESIA</p>
                    <p class="text-white text-sm md:text-md mt-2">9 VARIAN DARI ORIGIN TERBAIK INDONESIA</p>
                </div>

            </div>
            <div class="swiper-slide h-full bg-cover bg-center"
                style="background-image: url('https://png.pngtree.com/background/20230522/original/pngtree-coffee-shop-interior-design-jpg-on-iphone-picture-image_2690202.jpg');">
                <div
                    class="flex flex-col justify-center items-center h-full bg-black bg-opacity-50 text-center hero-content">
                    <h1 class="text-white text-4xl md:text-6xl font-bold">FRESHLY BREWED</h1>
                    <p class="text-white text-lg md:text-xl mt-4">EXPERIENCE THE AROMA AND TASTE OF FRESH COFFEE</p>
                    <p class="text-white text-sm md:text-md mt-2">CUP BY CUP, MADE JUST FOR YOU</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Menu Section -->
    <section class="bg-white py-16 mt-16">
        <div class="container mx-auto text-center">
            <p class="text-orange-600 text-sm uppercase tracking-widest font-semibold">From the best Indonesian specialty
                coffee to heart-warming foods</p>
            <h2 class="text-gray-800 text-3xl md:text-5xl font-bold mt-2">OUR MENU</h2>
            <div class="mt-8 w-16 h-1 bg-orange-500 mx-auto"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mt-12 px-4">
                @foreach ($products as $product)
                    <div class="menu-item text-center shadow-lg rounded-lg p-6 bg-orange-100">
                        <img src="{{ asset($product['img']) }}" alt="Our Beans" class="w-full rounded-lg h-40 object-cover">
                        <h3 class="text-xl font-bold text-gray-800 mt-4">{{ $product['name'] }}</h3>
                        <p class="text-gray-600 mt-2 text-sm">{{ $product['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="bg-orange-100 py-16 mt-16">
        <div class="container mx-auto text-center">
            <p class="text-orange-600 text-sm uppercase tracking-widest font-semibold">MOMENTS</p>
            <h2 class="text-gray-800 text-3xl md:text-5xl font-bold mt-2">GALLERY</h2>
            <div class="mt-8 w-16 h-1 bg-orange-500 mx-auto"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mt-12 px-4">
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.pexels.com/photos/302899/pexels-photo-302899.jpeg?cs=srgb&dl=pexels-chevanon-302899.jpg&fm=jpg"
                        alt="">
                    <div class="gallery-overlay">
                        <!-- No content here -->
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://t4.ftcdn.net/jpg/01/16/61/93/360_F_116619399_YA611bKNOW35ffK0OiyuaOcjAgXgKBui.jpg"
                        alt="">
                    <div class="gallery-overlay">
                        <!-- No content here -->
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://media.istockphoto.com/id/1484464555/photo/sip-savor-and-enjoy-a-perfectly-crafted-cappuccino-with-a-beautiful-twist.webp?a=1&b=1&s=612x612&w=0&k=20&c=dQFsMhiNBI11fJHMYi6yZByguqCtGn9yParKyF0BE5s="
                        alt="">
                    <div class="gallery-overlay">
                        <!-- No content here -->
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://t4.ftcdn.net/jpg/01/16/61/93/360_F_116619399_YA611bKNOW35ffK0OiyuaOcjAgXgKBui.jpg"
                        alt="">
                    <div class="gallery-overlay">
                        <!-- No content here -->
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://media.istockphoto.com/id/1484464555/photo/sip-savor-and-enjoy-a-perfectly-crafted-cappuccino-with-a-beautiful-twist.webp?a=1&b=1&s=612x612&w=0&k=20&c=dQFsMhiNBI11fJHMYi6yZByguqCtGn9yParKyF0BE5s="
                        alt="">
                    <div class="gallery-overlay">
                        <!-- No content here -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-orange-500 text-white py-8">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2024 Coffee Shop. All Rights Reserved.</p>
            <div class="mt-4">
                <a href="#" class="footer-icon text-white mx-4 hover:text-orange-500">About Us</a>
                <a href="#" class="footer-icon text-white mx-4 hover:text-orange-500">Contact</a>
                <a href="#" class="footer-icon text-white mx-4 hover:text-orange-500">Privacy Policy</a>
            </div>
            <div class="mt-4">
                <a href="#" class="footer-icon text-white mx-2 hover:text-orange-500"><i
                        class="fab fa-facebook"></i></a>
                <a href="#" class="footer-icon text-white mx-2 hover:text-orange-500"><i
                        class="fab fa-twitter"></i></a>
                <a href="#" class="footer-icon text-white mx-2 hover:text-orange-500"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
@endsection

@push('script')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
            speed: 1200,
        });

        AOS.init({
            duration: 1000, // Durasi animasi
            once: true, // Animasi hanya berjalan sekali
        });
    </script>
@endpush
