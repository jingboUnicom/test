<div>
    <div class="container mx-auto px-[15px]">
        <div
            class="font-primary font-semibold text-[30px] leading-[30px] md:text-[45px] md:leading-[45px] xl:text-[60px] xl:leading-[70px] text-primary mb-[15px] pt-[60px] xl:pt-[120px] pb-[40px] xl:pb-[80px]">
            @nl2br($content['title'])
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-[15px] relative">
        <form wire:submit.prevent="$emit('getGoogleRecaptchaToken')">
            <div class="grid grid-cols-12 gap-y-[10px] gap-x-[10px]">
                <div class="col-span-12 xl:col-span-6">
                    <input wire:model="company_name" type="text" placeholder="{{ $content['label_company_name'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('company_name') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <input wire:model="position" type="text" placeholder="{{ $content['label_position'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('position') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
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
                    <input wire:model="job_title" type="text" placeholder="{{ $content['label_job_title'] }}"
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
                    @error('job_title') <small class="font-primary text-red-500">{{ $message }}</small> @enderror
                </div>
                <div class="col-span-12">
                    <textarea wire:model="job_description" placeholder="{{ $content['label_job_description'] }}" rows=10
                        class="font-secondary bg-primary-75 w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary"></textarea>
                    @error('job_description') <small class="font-primary text-red-500">{{ $message }}</small>
                    @enderror
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
        <div wire:loading.delay class="absolute top-[-30px] right-[15px]">
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