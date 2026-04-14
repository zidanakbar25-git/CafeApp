<!-- BAGIAN HEADER JANGAN DIUBAH -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Cafe - Web Ordering</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'cafe-bg': '#F8F5F2',
                        'cafe-brown': '#8B5E3C',
                        'cafe-tan': '#E6DACE',
                        'cafe-white': '#FFFFFF',
                    }
                }
            }
        }
    </script>
    <style>
      body {
            margin: 0;
        }

        /* Custom scrollbar for horizontal scrolling menus */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
       
    </style>
</head>
<body class="bg-cafe-bg text-gray-800 font-sans min-h-screen pb-24">
    

        <!-- HEADER FULL WIDTH -->
    <header class="w-full bg-white shadow-sm px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center sticky top-0 z-50">
        <!-- LOGO -->
        <div class="flex items-center gap-3 text-cafe-brown text-lg sm:text-xl md:text-2xl font-bold">
            <div class="bg-cafe-brown text-white w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            Cozy Cafe
        </div>

        <!-- MEJA -->
        <div class="bg-cafe-tan text-cafe-brown px-3 py-1 sm:px-4 sm:py-2 rounded-full font-semibold text-xs sm:text-sm md:text-base">
            Meja 12
        </div>

    </header>



  </body>
</html>