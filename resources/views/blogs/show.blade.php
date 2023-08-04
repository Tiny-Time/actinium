<x-guest-layout>
    <x-slot name="header"></x-slot>
    <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Main Section: Listings --}}
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            {{-- Subsection 1: Blog  --}}
            <div class="md:col-span-2">
                {{-- Post Image --}}
                <img src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Post"
                    class="h-[400px] w-full object-cover">
                {{-- Post Title --}}
                <h1 class="text-xl sm:text-3xl font-bold mt-3 px-4 text-center">Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Soluta, expedita.</h1>
                {{-- Post Author/Date/Category --}}
                <div class="uppercase text-xs mt-3 flex justify-center flex-wrap gap-3 font-semibold">
                    <div class="flex gap-[2px] items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p>Oz</p>
                    </div>
                    <div class="flex gap-[2px] items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                        <p>NOVEMBER 6, 2022</p>
                    </div>
                    <div class="flex gap-[2px] items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        <p>Features</p>
                    </div>
                </div>
                {{-- Post Share buttons --}}
                <div class="uppercase font-semibold items-center mt-3 flex justify-center flex-wrap gap-2 text-sm">
                    <span>Share: </span>
                    <a href="https://www.facebook.com/sharer.php?u=POST_URL" class="hover:bg-olivine rounded shadow flex items-center px-2 py-1 gap-1 bg-blue-600 text-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 fill-current" viewBox="0 0 320 512">
                            <path
                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                        </svg>
                        <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=POST_TITLE&url=POST_URL" class="hover:bg-olivine rounded shadow flex items-center px-2 py-1 gap-1 bg-black text-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 fill-current" viewBox="0 0 512 512">
                            <path
                                d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                        </svg>
                        <span>Twitter</span>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url=POST_URL&media=POST_IMAGE&description=POST_TITLE" class="hover:bg-olivine rounded shadow flex items-center px-2 py-1 gap-1 bg-red-600 text-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 fill-current" viewBox="0 0 384 512">
                            <path
                                d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
                        </svg>
                        <span>Pinterest</span>
                    </a>
                </div>
                {{-- Post Content --}}
                <div class="prose dark:prose-invert mt-6">
                    {{-- Demo content --}}
                    @php
                        $markDown = \Laravel\Jetstream\Jetstream::localizedMarkdownPath('dmca.md');
                    @endphp
                    {!! \Str::markdown(file_get_contents($markDown)) !!}
                </div>
            </div>
            {{-- Subsection 2: Aside --}}
            @include('layouts.aside')
        </div>
    </div>
    <x-slot name="footer"></x-slot>
</x-guest-layout>
