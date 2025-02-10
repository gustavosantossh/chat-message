<div class="h-screen" x-data="{
    dropdown: false,
    scrollToBottom() {
        const el = document.getElementById('element-box');
        el.style.scrollBehavior = 'smooth';
        el.scrollTop = el.scrollHeight;
    },

    boxBotton() {
        const el = document.getElementById('element-box');
        el.scrollTop = el.scrollHeight;
    }

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

    <div class="h-full grid grid-rows-12 ">
        <section class="row-span-1">
            <div class="bg-[#F0F2F5] p-2 text-xl font-semibold flex items-center gap-4 h-full">

                <div class="mx-auto ml-10 my-0 flex items-center gap-3">
                    <img src="https://picsum.photos/40" alt="avatar" class="rounded-full">
                    <p>{{ $user->name }}</p>
                </div>


                <div class="">

                    <div @click="dropdown = !dropdown" class="cursor-pointer ">
                        <img src="{{ asset('icons/keyboard_arrow_down-icon.svg') }}" alt="">
                    </div>

                    <span x-show="dropdown" x-collapse
                        class="absolute right-4 top-10 p-2 min-w-48 rounded-md border shadow-md min-h-24 text-left bg-white z-50">
                        <ul>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Arquivar conversa</li>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Silenciar</li>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Fixar</li>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Bloquear</li>
                            <li>
                                <button class="hover:bg-slate-200 py-2 px-3 w-full text-red-400 text-left border-t"
                                    wire:confirm="Deseja deletar este contato?"
                                    wire:click="deleteContact({{ $user->id }})">Apagar contato</button>
                            </li>
                        </ul>
                    </span>

                </div>
            </div>
        </section>

        <section class="row-span-9 relative">

            <div id="element-box" x-init="boxBotton()" class="h-full px-5 overflow-y-scroll bg-[#f1eeea]">

                @if (!empty($listAllMessages))
                    <div class="overflow-auto max-w-[850px]">
                        @foreach ($listAllMessages as $message)
                            @if ($message['sender'] != auth()->guard()->user()->name)
                                <div>
                                    <div
                                        class="bg-[#576c99] text-white font-semibold min-w-36  lg:max-w-[512px] sm:max-w-[540px] md:max-w-[5800x] p-3 m-3 rounded-md break-words whitespace-normal inline-block">
                                        <span class="text-amber-400">
                                            {{ $user->name }}:
                                        </span>
                                        <div>{{ $message['message'] }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="text-right w-full">
                                    <div
                                        class="bg-[#7aabff] text-white font-semibold min-w-36 lg:max-w-[60%] sm:max-w-[80%] md:max-w-[70%] px-3 py-2 m-3 rounded-md break-words whitespace-normal inline-block">

                                        <p class="text-black text-left ml-0">You:</p>

                                        <div class="flex flex-col px-2">
                                            <P class="text-left">{{ $message['message'] }}</P>
                                            <span
                                                class="text-xs self-end text-[#edeaea]">{{ $message['created_at'] }}</span>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach

                        {{-- BUTTON SCROLL TO BOTTOM --}}
                        <button
                            class="absolute flex justify-center items-center h-10 w-10 rounded-full z-50 right-5 bottom-5 bg-green-400"
                            @click="scrollToBottom()">
                            <img src="{{ asset('icons/keyboard_arrow_down-icon.svg') }}" alt="">
                        </button>
                    </div>
                @else
                    <div class="flex overflow-y-auto h-full justify-center items-center">
                        <p>Say Hello To {{ $user->name }} </p>
                    </div>
                @endif
            </div>
        </section>

        <section class="row-span-2 bg-[#F0F2F5] px-2 py-2">
            <div class=" h-full ">
                <form action="" class="flex items-center w-full h-full" wire.prevent wire:submit="sendMessage">
                    <textarea type="text" class="w-full h-full rounded-md border-none focus:ring-0 resize-none"
                        wire:model="messageInputModel" name="message" placeholder="Digite algo incrível... ou apenas um 'oi' 😊" required
                        maxlength="4000">
                    </textarea>

                    <button type="submit" class="w-28 flex items-center justify-center border-none ">
                        <img src="{{ asset('icons/send-icon2.svg') }}" class="h-12">
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>
