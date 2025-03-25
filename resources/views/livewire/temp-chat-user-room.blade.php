<div class="h-screen">
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

                <div class="mx-auto ml-10 my-0 flex items-center gap-3">
                    <img src="https://picsum.photos/40" alt="avatar" class="rounded-full">
                    <p>{{ $user->name }}</p>
                </div>
            </div>
        </section>

        <section class="row-span-10">
            <div class="h-full p-5 overflow-y-scroll bg-slate-400">
                @if (!empty($listAllMessages))
                    <div id="chatList" class="overflow-y-auto overflow-x-hidden">
                        @foreach ($listAllMessages as $message)
                            @if ($message['sender'] != auth()->guard()->user()->name)
                                <div>
                                    <div
                                        class="bg-[#576c99] text-white font-semibold w-full sm:w-2/3 md:w-1/3 max-w-max p-3 m-3 rounded-md break-words whitespace-normal inline-block">
                                        <span class="text-amber-400">
                                            {{ $user->name }}:
                                        </span>
                                        <P>{{ $message['message'] }}</P>
                                    </div>
                                </div>
                            @else
                                <div class="text-right">
                                    <div
                                        class="bg-[#5f97f8] text-white w-full sm:w-2/3 md:w-1/3 max-w-max p-3 m-3 rounded-md break-words whitespace-normal inline-block">
                                        <p class="text-black text-left font-semibold ml-0">You:</p>
                                        <P class="text-left">{{ $message['message'] }}</P>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex overflow-y-auto min-h-[calc(100vh-167px)] justify-center items-center">
                        <p>Say Hello To {{ $user->name }} </p>
                    </div>
                @endif
            </div>
        </section>

        <section class="row-span-1">
            <form action="" class="flex w-full h-full" wire.prevent wire:submit="sendMessage">

                <input type="text" class="w-full" wire:model="messageInputModel" name="message">

                <button type="submit"
                    class="w-28 flex items-center justify-center bg-green-600 border border-3 border-neutral-900">
                    <img src="{{ asset('icons/send-icon.svg') }}" class="h-12">
                </button>

            </form>
        </section>
    </div>
</div>
