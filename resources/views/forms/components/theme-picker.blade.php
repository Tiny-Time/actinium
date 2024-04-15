<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ stateTemplate: $wire.$entangle('{{ $getStatePath() }}') }" >
        <div class="mt-3">
            <!-- Templates slide -->
            <div>
                <div class="relative flex items-center justify-center">
                    <!-- Left arrow -->
                    <div class="rounded-full p-1 md:p-3 bg-gray-300 cursor-pointer absolute top-[45%] left-2"
                        @click="(stateTemplate > 1) ? stateTemplate = stateTemplate - 1 : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                    <!-- Template -->
                    <div class="w-full" x-show="stateTemplate === 1">
                        <label for="template1">
                            <img alt="template1"
                                src="{{ Vite::asset('resources/images/Anniversary_ Enchanted_Midnight_Forest.png') }}"
                                class="w-full h-64 max-w-xl mx-auto rounded-lg shadow-md md:h-96">
                        </label>
                        <input type="radio" name="template_id" value="1"
                            x-model="stateTemplate" class="hidden" id="template1" checked>
                    </div>
                    <!-- Template -->
                    <div class="w-full" x-show="stateTemplate === 2">
                        <label for="template2">
                            <img alt="template2"
                                src="{{ Vite::asset('resources/images/Anniversary_ Scarlet_Serenity.png') }}"
                                class="w-full h-64 max-w-xl mx-auto rounded-lg shadow-md md:h-96">
                        </label>
                        <input type="radio" name="template_id" value="2"
                            x-model="stateTemplate" class="hidden" id="template2">
                    </div>
                    <!-- Template -->
                    <div class="w-full" x-show="stateTemplate === 3">
                        <label for="template3">
                            <img alt="template3"
                                src="{{ Vite::asset('resources/images/Birthday_ Dark_Blue_Sequins.png') }}"
                                class="w-full h-64 max-w-xl mx-auto rounded-lg shadow-md md:h-96">
                        </label>
                        <input type="radio" name="template_id" value="3"
                            x-model="stateTemplate" class="hidden" id="template3">
                    </div>
                    <!-- Right arrow -->
                    <div class="rounded-full p-1 md:p-3 bg-gray-300 cursor-pointer absolute top-[45%] right-2"
                        @click="(stateTemplate < 3) ? stateTemplate = stateTemplate + 1 : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
                <!-- Bullets -->
                <div class="flex justify-center gap-1 mt-3">
                    <button type="button" @click="stateTemplate = 1"
                        :class="stateTemplate == 1 ? 'bg-green-500' : 'bg-gray-300'"
                        class="w-2 h-2 rounded-full"><span class="sr-only">select
                            image</span></button>
                    <button type="button" @click="stateTemplate = 2"
                        :class="stateTemplate == 2 ? 'bg-green-500' : 'bg-gray-300'"
                        class="w-2 h-2 rounded-full"><span class="sr-only">select
                            image</span></button>
                    <button type="button" @click="stateTemplate = 3"
                        :class="stateTemplate == 3 ? 'bg-green-500' : 'bg-gray-300'"
                        class="w-2 h-2 rounded-full"><span class="sr-only">select
                            image</span></button>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
