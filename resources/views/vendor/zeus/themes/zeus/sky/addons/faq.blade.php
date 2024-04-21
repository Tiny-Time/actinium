<div>
    @if (!$faqs->isEmpty())
        <div class="max-w-4xl mx-auto mt-5">
            <h1
                class="text-3xl font-extrabold tracking-tight text-center sm:text-4xl text-primary-600 dark:text-primary-400">
                {{ __('Frequently Asked Questions') }}
            </h1>
            <div class="mx-auto mt-6 space-y-8 bg-white border border-gray-200">
                <ul class="shadow-box">
                    @foreach ($faqs as $faq)
                        <li class="relative border-b border-gray-200" x-data="{ selected: null }">

                            <button type="button" class="w-full px-8 py-6 text-left font-bold text-lg"
                                @click="selected !== {{ $faq->id }} ? selected = {{ $faq->id }} : selected = null">
                                <div class="flex items-center justify-between">
                                    <span>{{ $faq->question }} </span>
                                    <svg x-show="selected !== {{ $faq->id }} ? true : false"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    <svg x-show="selected !== {{ $faq->id }} ? false : true"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <div class="relative overflow-hidden transition-all duration-700 max-h-0" style=""
                                x-ref="container{{ $faq->id }}"
                                x-bind:style="selected == {{ $faq->id }} ? 'max-height: ' + $refs.container{{ $faq->id }}
                                    .scrollHeight + 'px' : ''">
                                <div class="p-6 prose dark:prose-invert max-w-none">
                                    {!! $faq->answer !!}
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        @include($skyTheme.'.partial.empty')
    @endif
</div>
