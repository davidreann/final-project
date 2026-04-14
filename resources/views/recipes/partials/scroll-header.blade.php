<!-- Scroll Header (appears when scrolled down) -->
<div id="scroll-header" class="hidden fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-lg border-b border-slate-200 shadow-lg transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="hidden md:flex md:items-center md:justify-between md:gap-4">
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide">
                <a href="#top-recipes" class="scroll-to-anchor flex items-center gap-2 px-3 py-2 rounded-lg text-orange-600 hover:bg-orange-50 font-bold text-xs whitespace-nowrap transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0l4-4 4 4m6 0v12m0 0l4-4m0 0l-4 4-4-4"></path></svg>
                    Top
                </a>
                <a href="#new-recipes" class="scroll-to-anchor px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-xs whitespace-nowrap transition-colors">New</a>
                <a href="#main-dish" class="scroll-to-anchor px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-xs whitespace-nowrap transition-colors">Main Dish</a>
                <a href="#appetizer" class="scroll-to-anchor px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-xs whitespace-nowrap transition-colors">Appetizer</a>
                <a href="#side-dish" class="scroll-to-anchor px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-xs whitespace-nowrap transition-colors">Side Dish</a>
                <a href="#dessert" class="scroll-to-anchor px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-xs whitespace-nowrap transition-colors">Dessert</a>
            </div>

            <form action="{{ route('recipes.browse') }}" method="GET" class="relative group flex-shrink-0">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search recipes..."
                       class="w-64 px-4 py-2 bg-slate-100 border-2 border-transparent rounded-xl focus:bg-white focus:border-orange-500 focus:ring-0 transition-all duration-300 font-bold text-sm">
                <button type="submit" class="absolute right-3 top-2 text-slate-400 group-hover:text-orange-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="md:hidden">
            <div class="flex items-center justify-between">
                <button id="scroll-menu-toggle" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <form action="{{ route('recipes.browse') }}" method="GET" class="relative group flex-1 mx-3">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search..."
                           class="w-full px-3 py-2 bg-slate-100 border-2 border-transparent rounded-lg focus:bg-white focus:border-orange-500 focus:ring-0 transition-all duration-300 font-bold text-xs">
                    <button type="submit" class="absolute right-2 top-2.5 text-slate-400 group-hover:text-orange-500">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div id="scroll-mobile-menu" class="hidden pt-3 pb-2 space-y-2 border-t border-slate-100 mt-3">
                <a href="#top-recipes" class="scroll-to-anchor flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 font-bold text-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0l4-4 4 4m6 0v12m0 0l4-4m0 0l-4 4-4-4"></path></svg>
                    Back to Top
                </a>
                <a href="#new-recipes" class="scroll-to-anchor block w-full text-left px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-sm transition-colors">New</a>
                <a href="#main-dish" class="scroll-to-anchor block w-full text-left px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-sm transition-colors">Main Dish</a>
                <a href="#appetizer" class="scroll-to-anchor block w-full text-left px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-sm transition-colors">Appetizer</a>
                <a href="#side-dish" class="scroll-to-anchor block w-full text-left px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-sm transition-colors">Side Dish</a>
                <a href="#dessert" class="scroll-to-anchor block w-full text-left px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-bold text-sm transition-colors">Dessert</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const scrollHeader = document.getElementById('scroll-header');
        const scrollMenuToggle = document.getElementById('scroll-menu-toggle');
        const scrollMobileMenu = document.getElementById('scroll-mobile-menu');
        const scrollToAnchorLinks = document.querySelectorAll('.scroll-to-anchor');
        const scrollThreshold = 200;

        const closeMobileMenu = function () {
            if (scrollMobileMenu) {
                scrollMobileMenu.classList.add('hidden');
            }
        };

        scrollToAnchorLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                const href = this.getAttribute('href');

                if (!href || !href.startsWith('#')) {
                    return;
                }

                const target = document.querySelector(href);

                if (!target) {
                    return;
                }

                event.preventDefault();

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });

                closeMobileMenu();
            });
        });

        window.addEventListener('scroll', function () {
            const currentScrollPosition = window.scrollY || document.documentElement.scrollTop;

            if (currentScrollPosition > scrollThreshold) {
                scrollHeader.classList.remove('hidden');
            } else {
                scrollHeader.classList.add('hidden');
                closeMobileMenu();
            }
        });

        if (scrollMenuToggle) {
            scrollMenuToggle.addEventListener('click', function () {
                scrollMobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
