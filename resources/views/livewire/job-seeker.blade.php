<div class="w-full">
    <div
        class="bg-primary-150 py-[15px] xl:py-[30px] px-[30px] xl:px-[60px] border-2 border-primary rounded-xl relative">
        <div class="font-primary font-semibold text-[30px] md:text-[45px] xl:text-[60px] text-primary mb-[15px]">{{
            $content['title'] }}</div>
        <form wire:submit.prevent="$emit('getGoogleRecaptchaToken')">
            <div class="grid grid-cols-12 gap-y-[10px] gap-x-[10px]">
                <div class="col-span-12 xl:col-span-6">
                    <input wire:model="name" type="text" placeholder="{{ $content['label_name'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('name') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <input wire:model="surname" type="text" placeholder="{{ $content['label_surname'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('surname') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <input wire:model="email" type="text" placeholder="{{ $content['label_email'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('email') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <input wire:model="phone" type="text" placeholder="{{ $content['label_phone'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('phone') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12">
                    <input wire:model="category_text" type="text" placeholder="{{ $content['label_category_text'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('category_text') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <div class="bg-primary-200 w-full h-[44px] border-2 border-primary rounded-lg relative">
                        <label for="resume"
                            class="absolute inset-0 hover:cursor-pointer flex items-center justify-between py-[8px] px-[12px]">
                            <div class="font-secondary font-semibold text-[16px] text-primary">
                                {{ $content['label_resume'] }}
                            </div>
                            @if ($this->resume)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            @endif
                            <input id="resume" wire:model="resume" type="file" class="sr-only" />
                        </label>
                    </div>
                    @error('resume') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <div class="bg-primary-200 w-full h-[44px] border-2 border-primary rounded-lg relative">
                        <label for="cover_letter"
                            class="absolute inset-0 hover:cursor-pointer flex items-center justify-between py-[8px] px-[12px]">
                            <div class="font-secondary font-semibold text-[16px] text-primary">
                                {{ $content['label_cover_letter'] }}
                            </div>
                            @if ($this->cover_letter)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            @endif
                            <input id="cover_letter" wire:model="cover_letter" type="file" class="sr-only" />
                        </label>
                    </div>
                    @error('cover_letter') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12">
                    <button wire:loading.attr="disabled" type="submit"
                        class="font-secondary font-semibold text-[16px] text-primary-150 uppercase bg-primary w-full h-[44px] rounded-lg hover:text-white hover:bg-primary-700 transition-all">
                        {{ $content['label_submit'] }}
                    </button>
                </div>
            </div>
        </form>
        <input wire:model="google_recaptcha_token" type="hidden">
        @if($show_error_recaptcha === true)
        <small class="font-primary text-red-500">{{ $content['error_recaptcha'] }}</small>
        @endif
        @if($show_message_success === true)
        <small x-data="" x-init="setTimeout(() => { $wire.emitSelf('hideMessageSuccess') }, 2000);"
            class="font-primary text-green-500">
            {{ $content['message_success'] }}
        </small>
        @endif
        @if($show_message_failure === true)
        <small x-data="" x-init="setTimeout(() => { $wire.emitSelf('hideMessageFailure') }, 2000);"
            class="font-primary text-red-500">
            {{ $content['message_failure'] }}
        </small>
        @endif
        <div wire:loading.delay class="absolute top-[15px] right-[15px]">
            <svg class="animate-spin text-primary w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js?render={{ $google['google_recaptcha_site_key'] }}">
    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('getGoogleRecaptchaToken', () => {
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ $google["google_recaptcha_site_key"] }}', {action: 'submit'})
                    .then(function(token) {
                        @this.emitSelf('setGoogleRecaptchaToken', token);
                    });
                });
            });
        });
    </script>
</div>