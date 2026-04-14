<!--  template utama -->
@extends('layouts.app')

<!-- isi title -->
@section('title', 'home')

<!-- isi content rekan-rekan disini ya -->
@section('content')

     <!-- // Tab Utama: Drink / Food -->
<div class="bg-cafe-tan rounded-full p-1 mb-6 flex max-w-md mx-auto shadow-sm">
            <button onclick="setMainCategory('Drink')" id="btn-drink" class="flex-1 py-3 rounded-full text-center font-semibold text-cafe-brown bg-white shadow transition-all duration-300">
                Drink
            </button>
            <button onclick="setMainCategory('Food')" id="btn-food" class="flex-1 py-3 rounded-full text-center font-semibold text-gray-500 hover:text-cafe-brown transition-all duration-300">
                Food
            </button>
 </div>

        <!-- Tab Sub Kategori: Coffee, Non-Coffee, Main Course, Dessert, dll -->
        <div class="overflow-x-auto hide-scrollbar mb-8">
            <div id="sub-categories"
                class="flex gap-3 pb-2 w-max mx-auto md:mx-0 md:w-full md:justify-start">
            </div>
        </div>

        <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            </div>

        <button class="fixed bottom-6 right-6 md:bottom-10 md:right-10 bg-cafe-brown text-white w-14 h-14 md:w-16 md:h-16 rounded-full shadow-lg flex items-center justify-center text-xl md:text-2xl hover:scale-105 transition-transform duration-200 z-50">
            <i class="fa-solid fa-cart-shopping"></i>
        </button>

        <script>
        // Data Produk Mockup
        const products = [
            { id: 1, mainCat: 'Drink', subCat: 'Non-Coffee', name: 'Fresh Orange Juice', desc: 'Freshly squeezed orange juice', price: 4.50, img: 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=500&q=80' },
            { id: 2, mainCat: 'Drink', subCat: 'Non-Coffee', name: 'Berry Smoothie', desc: 'Blended berries with yogurt', price: 5.50, img: 'https://images.unsplash.com/photo-1553530666-ba11a77024ea?w=500&q=80' },
            { id: 3, mainCat: 'Drink', subCat: 'Coffee', name: 'Caramel Macchiato', desc: 'Espresso, vanilla, milk, caramel', price: 6.00, img: 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?w=500&q=80' },
            { id: 4, mainCat: 'Food', subCat: 'Main Course', name: 'Pasta Carbonara', desc: 'Creamy pasta with bacon and parmesan', price: 12.50, img: 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=500&q=80' },
            { id: 5, mainCat: 'Food', subCat: 'Main Course', name: 'Grilled Chicken Salad', desc: 'Fresh greens with grilled chicken', price: 11.00, img: 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80' },
            { id: 6, mainCat: 'Food', subCat: 'Dessert', name: 'Chocolate Lava Cake', desc: 'Warm cake with melted chocolate center', price: 8.50, img: 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?w=500&q=80' }
        ];

        const subCategories = {
            'Drink': ['Coffee', 'Non-Coffee'],
            'Food': ['Main Course', 'Dessert', 'Snack']
        };

        let currentMainCat = 'Drink';
        let currentSubCat = 'Non-Coffee';

        // Fungsi inisialisasi
        function init() {
            setMainCategory('Drink', 'Non-Coffee');
        }

        // Fungsi mengganti tab utama (Drink / Food)
        function setMainCategory(category, defaultSubCat = null) {
            currentMainCat = category;
            currentSubCat = defaultSubCat || subCategories[category][0];

            // Update UI Button Main Category
            const btnDrink = document.getElementById('btn-drink');
            const btnFood = document.getElementById('btn-food');

            if (category === 'Drink') {
                btnDrink.className = "flex-1 py-3 rounded-full text-center font-semibold text-cafe-brown bg-white shadow transition-all duration-300";
                btnFood.className = "flex-1 py-3 rounded-full text-center font-semibold text-gray-500 hover:text-cafe-brown transition-all duration-300";
            } else {
                btnFood.className = "flex-1 py-3 rounded-full text-center font-semibold text-cafe-brown bg-white shadow transition-all duration-300";
                btnDrink.className = "flex-1 py-3 rounded-full text-center font-semibold text-gray-500 hover:text-cafe-brown transition-all duration-300";
            }

            renderSubCategories();
            renderProducts();
        }

        // Fungsi mengganti sub tab (Coffee, Non-Coffee, dll)
        function setSubCategory(subCat) {
            currentSubCat = subCat;
            renderSubCategories();
            renderProducts();
        }

        // Fungsi menampilkan Sub Kategori
        function renderSubCategories() {
            const container = document.getElementById('sub-categories');
            container.innerHTML = '';

            subCategories[currentMainCat].forEach(subCat => {
                const isActive = subCat === currentSubCat;
                const activeClass = isActive 
                    ? 'bg-cafe-brown text-white shadow-md' 
                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50';
                
                const btn = document.createElement('button');
                btn.className = `px-5 py-2 rounded-full font-medium text-sm whitespace-nowrap transition-colors duration-200 ${activeClass}`;
                btn.innerText = subCat;
                btn.onclick = () => setSubCategory(subCat);
                container.appendChild(btn);
            });
        }

        // Fungsi menampilkan Grid Produk
        function renderProducts() {
            const container = document.getElementById('product-grid');
            container.innerHTML = '';

            const filteredProducts = products.filter(p => p.mainCat === currentMainCat && p.subCat === currentSubCat);

            if(filteredProducts.length === 0) {
                container.innerHTML = `<div class="col-span-full text-center text-gray-500 py-10">Menu belum tersedia.</div>`;
                return;
            }

            filteredProducts.forEach(product => {
                const card = `
                    <div class="bg-white rounded-2xl p-3 md:p-4 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition-shadow duration-300">
                        <div class="rounded-xl overflow-hidden mb-3 aspect-square bg-gray-100 relative">
                            <img src="${product.img}" alt="${product.name}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base leading-tight mb-1">${product.name}</h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2 flex-grow">${product.desc}</p>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="font-semibold text-gray-800 text-sm md:text-base">$${product.price.toFixed(2)}</span>
                            <button class="bg-cafe-brown hover:bg-yellow-900 text-white text-xs px-4 py-1.5 rounded-full font-medium transition-colors duration-200">
                                Add
                            </button>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }

        // Jalankan saat halaman dimuat
        window.onload = init;
    </script>
@endsection
<!-- akhir content -->