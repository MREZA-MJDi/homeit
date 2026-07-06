{{-- ====================================================================== --}}
{{-- HomeIT Admin Sidebar                                                   --}}
{{-- Version : 1.0                                                          --}}
{{-- RTL | TailwindCSS | Laravel Blade                                      --}}
{{-- ====================================================================== --}}

<aside
    id="sidebar"
    class="fixed top-0 right-0 z-50 flex h-screen w-72 flex-col border-l border-slate-800 bg-slate-950">

    {{-- ======================== Header ======================== --}}

    <div class="flex h-20 items-center justify-between border-b border-slate-800 px-6">

        <div class="flex items-center gap-4">

            {{-- Logo --}}

            <div
                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-xl font-black text-white shadow-lg shadow-blue-600/25">

                HI

            </div>

            {{-- Brand --}}

            <div>

                <h1
                    class="text-lg font-extrabold tracking-wide text-white">

                    HomeIT

                </h1>

                <p
                    class="mt-1 text-xs text-slate-400">

                    پنل مدیریت

                </p>

            </div>

        </div>

    </div>

    {{-- ======================== Navigation ======================== --}}

    <div
        class="flex-1 overflow-y-auto overflow-x-hidden">

        <div class="px-5 py-6">

            {{-- Section --}}

            <span
                class="mb-4 block px-3 text-[11px] font-bold uppercase tracking-[0.30em] text-slate-500">

                منوی اصلی

            </span>

            <nav class="space-y-2">
			                {{-- ======================== داشبورد ======================== --}}

                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                    group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200">

                    <i data-lucide="layout-dashboard"
                        class="h-5 w-5"></i>

                    <span>داشبورد</span>

                </a>

                {{-- ======================== کاربران ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="users"
                        class="h-5 w-5"></i>

                    <span>کاربران</span>

                </a>

                {{-- ======================== تکنسین‌ها ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="user-cog"
                        class="h-5 w-5"></i>

                    <span>تکنسین‌ها</span>

                </a>

                {{-- ======================== خدمات ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="wrench"
                        class="h-5 w-5"></i>

                    <span>خدمات</span>

                </a>

                {{-- ======================== سفارشات ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="clipboard-list"
                        class="h-5 w-5"></i>

                    <span>سفارشات</span>

                </a>

                <div class="my-6 border-t border-slate-800"></div>

                <span
                    class="mb-4 block px-3 text-[11px] font-bold uppercase tracking-[0.30em] text-slate-500">

                    سیستم

                </span>
				                {{-- ======================== پرداخت‌ها ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="wallet" class="h-5 w-5"></i>

                    <span>پرداخت‌ها</span>

                </a>

                {{-- ======================== گزارشات ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="bar-chart-3" class="h-5 w-5"></i>

                    <span>گزارشات</span>

                </a>

                {{-- ======================== نظرات ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="star" class="h-5 w-5"></i>

                    <span>نظرات کاربران</span>

                </a>

                {{-- ======================== تنظیمات ======================== --}}

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:bg-slate-800 hover:text-white">

                    <i data-lucide="settings" class="h-5 w-5"></i>

                    <span>تنظیمات</span>

                </a>

                {{-- ======================== خروج ======================== --}}

                <a href="#"
                    class="group mt-4 flex items-center gap-3 rounded-xl border border-red-500/20 px-4 py-3 text-sm font-medium text-red-400 transition-all duration-200 hover:bg-red-500/10 hover:text-red-300">

                    <i data-lucide="log-out" class="h-5 w-5"></i>

                    <span>خروج از حساب</span>

                </a>

            </nav>

        </div>

    </div>

    {{-- ======================== User Card ======================== --}}

    <div class="border-t border-slate-800 bg-slate-900/70 p-5">

        <div class="flex items-center gap-4">

            <div
                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-base font-bold text-white">

                م

            </div>

            <div class="flex flex-col">

                <span class="text-sm font-semibold text-white">

                    محمدرضا مجیدی

                </span>

                <span class="text-xs text-slate-400">

                    Administrator

                </span>

            </div>

        </div>

    </div>
	    {{-- ================================================================ --}}
    {{-- Sidebar Footer --}}
    {{-- ================================================================ --}}

    <div class="border-t border-slate-800 bg-slate-950 px-5 py-4">

        {{-- System Status --}}

        <div
            class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-900 px-4 py-3">

            <div>

                <p class="text-xs font-semibold text-slate-300">

                    وضعیت سیستم

                </p>

                <span class="mt-1 inline-flex items-center gap-2 text-[11px] text-emerald-400">

                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    Online

                </span>

            </div>

            <i data-lucide="activity"
                class="h-5 w-5 text-emerald-400"></i>

        </div>

        {{-- Version --}}

        <div
            class="mt-4 flex items-center justify-between text-xs text-slate-500">

            <span>

                HomeIT

            </span>

            <span>

                v1.0.0

            </span>

        </div>

    </div>

</aside>
{{-- ====================================================================== --}}
{{-- Sidebar End                                                            --}}
{{-- ====================================================================== --}}

{{-- Future Features (Keep These Notes) --}}
{{-- --------------------------------------------------------------- --}}
{{-- - Collapsible Sidebar (Desktop)                                --}}
{{-- - Mobile Drawer (Alpine.js)                                    --}}
{{-- - Dynamic Menu From Database                                   --}}
{{-- - Spatie Permission Visibility                                 --}}
{{-- - Notification Badge                                            --}}
{{-- --------------------------------------------------------------- --}}