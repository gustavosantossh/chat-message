<div class="h-screen" x-data="{
    promptShow: '',

    scrollToBottom() {
        const el = document.getElementById('element-box');
        el.style.scrollBehavior = 'smooth';
        el.scrollTop = el.scrollHeight;

    },

    boxBotton() {
        const el = document.getElementById('element-box');
        el.scrollTop = el.scrollHeight;
    },

}">

    <div class="absolute">
        @if (session()->has('success'))
            <x-toast-success />
        @endif
        @if (session()->has('AlreadyExists'))
            <x-toast-exists />
        @endif
        @if (session()->has('notFound'))
            <x-toast-not-found />
        @endif
    </div>

    <div class="h-full grid grid-rows-12">

        <section class="row-span-1">

            <div class="bg-slate-100 p-2 text-xl font-semibold flex items-center gap-4 h-full">

                <a href="/dashboard" wire:navigate.hover class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#000000">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
                    </svg>
                    <p>Back</p>
                </a>

                <div class="mx-auto my-0">
                    <img src="{{ asset('icons/google-gemini.png') }}" class="h-14">
                </div>

                <div class="my-0">
                    <button wire:click="deleteBotMessages()"
                        wire:confirm="Deseja deletar todo o histórico de conversas?">
                        <img src="{{ asset('icons/delete-icon.svg') }}" class="h-8">
                    </button>
                </div>

            </div>
        </section>

        <section class="row-span-9 relative">

            <button
                class="absolute flex justify-center items-center h-10 w-10 rounded-full z-50 right-5 bottom-5 bg-green-400"
                @click="scrollToBottom()">
                <img src="{{ asset('icons/keyboard_arrow_down-icon.svg') }}" alt="">
            </button>

            {{-- BOT --}}
            <div id="element-box" x-init="boxBotton()"
                class="bg-[#EFEAE2] h-full p-5 overflow-y-scroll relative">
                @foreach ($messages as $index => $message)
                    <div class="flex flex-col items-end ">
                        You
                        <p class="ttt bg-[#EFF6FF] rounded-md p-4 w-full md:w-2/4">
                            {{ $message->prompt }}
                        </p>

                    </div>

                    <div>
                        <span class="text-indigo-600">Gemini</span>

                        <div id="message-{{ $message->id }}"
                            class="rounded-md m-3 p-3 flex flex-col gap-2 overflow-auto max-w-[800px]"
                            x-on:message-up.window="typeText('message-{{ $message->id }}')">

                            <div>
                                {!! $message->message !!}
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($loading)
                    <div class="loading ">
                        <div class="loading border-blue-300 w-7 h-7 border-t-4 rounded-full animate-spin"></div>
                    </div>
                @endif

            </div>

        </section>

        <section class="row-span-2 bg-[#F0F2F5] px-2 py-2">
            <form class="flex w-full h-full" wire.prevent wire:submit="formPromptSubmit">

                <textarea type="text" class="w-full h-full rounded-md border-none focus:ring-0 resize-none" x-model="promptShow"
                    wire:model.live="promptInput" name="message"
                    placeholder="Pergunte algo interessante! Ex: 'Qual é a história por trás do universo?' 😊" required
                    maxlength="10000">
                </textarea>

                <button type="submit" class="w-28 flex items-center justify-center border-none">
                    <img src="{{ asset('icons/send-icon2.svg') }}" class="h-12">
                </button>

            </form>
        </section>

    </div>

</div>
