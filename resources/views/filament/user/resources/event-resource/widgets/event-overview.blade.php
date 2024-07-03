<x-filament-widgets::widget>
    <h3 class="text-xl font-bold">Events</h3>
    <div class="grid gap-4 mt-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <div class="bg-white shadow rounded-xl overflow-clip dark:bg-gray-900 dark:ring-white/10">
            <div class="px-4 py-4 content">
                <div class="flex">
                    <div class="p-2 bg-indigo-500 rounded-md h-max w-max">
                        <svg class="w-12 h-12" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.625 15.625H14.0625C12.8193 15.625 11.627 16.1189 10.7479 16.9979C9.86886 17.877 9.375 19.0693 9.375 20.3125V35.9375C9.375 37.1807 9.86886 38.373 10.7479 39.2521C11.627 40.1311 12.8193 40.625 14.0625 40.625H29.6875C30.9307 40.625 32.123 40.1311 33.0021 39.2521C33.8811 38.373 34.375 37.1807 34.375 35.9375V20.3125C34.375 19.0693 33.8811 17.877 33.0021 16.9979C32.123 16.1189 30.9307 15.625 29.6875 15.625H28.125M15.625 23.4375L21.875 29.6875M21.875 29.6875L28.125 23.4375M21.875 29.6875V3.125M34.375 21.875H35.9375C37.1807 21.875 38.373 22.3689 39.2521 23.2479C40.1311 24.127 40.625 25.3193 40.625 26.5625V42.1875C40.625 43.4307 40.1311 44.623 39.2521 45.5021C38.373 46.3811 37.1807 46.875 35.9375 46.875H20.3125C19.0693 46.875 17.877 46.3811 16.9979 45.5021C16.1189 44.623 15.625 43.4307 15.625 42.1875V40.625"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-600">Total</p>
                        <h3 class="text-3xl font-bold break-all">
                            {{ \App\Models\Event::where('user_id', auth()->user()->id)->count() }}</h3>
                    </div>
                </div>
            </div>
            <div
                class="px-4 py-1 bg-gray-50 footer dark:bg-gray-900 dark:ring-white/10 dark:border-t dark:border-gray-50">
                <a href="/dashboard/events" class="font-semibold text-indigo-500">View all</a>
            </div>
        </div>
        <div class="bg-white shadow rounded-xl overflow-clip dark:bg-gray-900 dark:ring-white/10">
            <div class="px-4 py-4 content">
                <div class="flex">
                    <div class="p-2 bg-green-500 rounded-md h-max w-max">
                        <svg class="w-12 h-12" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.25 12.5V25H34.625M44 25C44 27.4623 43.515 29.9005 42.5727 32.1753C41.6305 34.4502 40.2493 36.5172 38.5082 38.2582C36.7672 39.9993 34.7002 41.3805 32.4253 42.3227C30.1505 43.265 27.7123 43.75 25.25 43.75C22.7877 43.75 20.3495 43.265 18.0747 42.3227C15.7998 41.3805 13.7328 39.9993 11.9917 38.2582C10.2506 36.5172 8.86953 34.4502 7.92726 32.1753C6.98498 29.9005 6.5 27.4623 6.5 25C6.5 20.0272 8.47544 15.2581 11.9917 11.7417C15.5081 8.22544 20.2772 6.25 25.25 6.25C30.2228 6.25 34.9919 8.22544 38.5082 11.7417C42.0246 15.2581 44 20.0272 44 25Z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-600">Published</p>
                        <h3 class="text-3xl font-bold break-all">
                            {{ \App\Models\Event::where('user_id', auth()->user()->id)->where('status', 1)->count() }}
                        </h3>
                    </div>
                </div>
            </div>
            <div
                class="px-4 py-1 bg-gray-50 footer dark:bg-gray-900 dark:ring-white/10 dark:border-t dark:border-gray-50">
                <a href="/dashboard/events?tableFilters[status][isActive]=true"
                    class="font-semibold text-indigo-500">View all</a>
            </div>
        </div>
        <div class="bg-white shadow rounded-xl overflow-clip dark:bg-gray-900 dark:ring-white/10">
            <div class="px-4 py-4 content">
                <div class="flex">
                    <div class="p-2 bg-yellow-500 rounded-md h-max w-max">
                        <svg class="w-12 h-12" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M44.25 25C44.25 27.4623 43.765 29.9005 42.8227 32.1753C41.8805 34.4502 40.4993 36.5172 38.7582 38.2582C37.0172 39.9993 34.9502 41.3805 32.6753 42.3227C30.4005 43.265 27.9623 43.75 25.5 43.75C23.0377 43.75 20.5995 43.265 18.3247 42.3227C16.0498 41.3805 13.9828 39.9993 12.2417 38.2582C10.5006 36.5172 9.11953 34.4502 8.17726 32.1753C7.23498 29.9005 6.75 27.4623 6.75 25C6.75 20.0272 8.72544 15.2581 12.2417 11.7417C15.7581 8.22544 20.5272 6.25 25.5 6.25C30.4728 6.25 35.2419 8.22544 38.7582 11.7417C42.2746 15.2581 44.25 20.0272 44.25 25Z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M19.25 19.9229C19.25 19.275 19.775 18.75 20.4229 18.75H30.5771C31.225 18.75 31.75 19.275 31.75 19.9229V30.0771C31.75 30.725 31.225 31.25 30.5771 31.25H20.425C20.2707 31.2505 20.1179 31.2206 19.9752 31.1619C19.8325 31.1032 19.7029 31.0168 19.5937 30.9078C19.4845 30.7988 19.3979 30.6693 19.3389 30.5267C19.2799 30.3842 19.2497 30.2314 19.25 30.0771V19.925V19.9229Z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-600">Draft</p>
                        <h3 class="text-3xl font-bold break-all">
                            {{ \App\Models\Event::where('user_id', auth()->user()->id)->where('status', 0)->count() }}
                        </h3>
                    </div>
                </div>
            </div>
            <div
                class="px-4 py-1 bg-gray-50 footer dark:bg-gray-900 dark:ring-white/10 dark:border-t dark:border-gray-50">
                <a href="/dashboard/events?tableFilters[status][isActive]=false"
                    class="font-semibold text-indigo-500">View all</a>
            </div>
        </div>
        <div class="bg-white shadow rounded-xl overflow-clip dark:bg-gray-900 dark:ring-white/10">
            <div class="px-4 py-4 content">
                <div class="flex">
                    <div class="p-2 bg-pink-600 rounded-md h-max w-max">
                        <svg class="w-12 h-12" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M42.9375 15.625L41.6354 37.775C41.5653 38.9689 41.0414 40.0907 40.1712 40.911C39.3009 41.7313 38.1501 42.188 36.9542 42.1875H14.5458C13.3499 42.188 12.1991 41.7313 11.3288 40.911C10.4586 40.0907 9.93474 38.9689 9.86458 37.775L8.5625 15.625M21.0625 24.2187L25.75 28.9062M25.75 28.9062L30.4375 33.5937M25.75 28.9062L30.4375 24.2187M25.75 28.9062L21.0625 33.5937M7.78125 15.625H43.7187C45.0125 15.625 46.0625 14.575 46.0625 13.2812V10.1562C46.0625 8.8625 45.0125 7.8125 43.7187 7.8125H7.78125C6.4875 7.8125 5.4375 8.8625 5.4375 10.1562V13.2812C5.4375 14.575 6.4875 15.625 7.78125 15.625Z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-600">Expired</p>
                        <h3 class="text-3xl font-bold break-all">
                            {{ \App\Models\Event::where('user_id', auth()->user()->id)->expired()->count() }}
                        </h3>
                    </div>
                </div>
            </div>
            <div
                class="px-4 py-1 bg-gray-50 footer dark:bg-gray-900 dark:ring-white/10 dark:border-t dark:border-gray-50">
                <a href="/dashboard/events?tableFilters[status][isActive]=false&tableFilters[expired][isActive]=true"
                    class="font-semibold text-indigo-500">View all</a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
