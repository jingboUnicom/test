<div class="bg-primary-150 bg-opacity-75 p-[15px] border-2 border-primary rounded-xl relative">
    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-12 gap-y-[15px] gap-x-0 xl:gap-y-0 xl:gap-x-[15px]">
            <div class="col-span-12">
                <div class="font-secondary font-bold text-[20px] text-primary uppercase mb-[15px] xl:ml-[15px]">{{
                    $content['title_search'] }}</div>
            </div>
            <div class="col-span-12 xl:col-span-3">
                <input wire:model="keyword" type="text" placeholder="{{ $content['label_keyword'] }}"
                    class="font-secondary bg-transparent w-full border-2 border-primary rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
            </div>
            <div class="col-span-12 xl:col-span-3">
                <select wire:model="classification"
                    class="bg-transparent w-full border-2 border-primary rounded-lg font-secondary font-semibold text-[16px] text-primary">
                    <option selected>{{ $content['label_classification'] }}</option>
                    @foreach($classifications as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 xl:col-span-3">
                <select wire:model="location"
                    class="bg-transparent w-full border-2 border-primary rounded-lg font-secondary font-semibold text-[16px] text-primary">
                    <option selected>{{ $content['label_location'] }}</option>
                    @foreach($locations as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 xl:col-span-3">
                <button wire:loading.attr="disabled" type="submit"
                    class="font-secondary font-semibold text-[16px] text-primary-150 uppercase bg-primary w-full h-[44px] rounded-lg hover:text-white hover:bg-primary-700 transition-all">
                    {{ $content['label_submit'] }}
                </button>
            </div>
        </div>
    </form>
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