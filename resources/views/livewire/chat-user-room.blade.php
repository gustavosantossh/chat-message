<div class="h-screen"
x-data="{dropdown: false}"
>

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
            <div class="bg-[#F0F2F5] p-2 text-xl font-semibold flex items-center gap-4 h-full">

                <div class="mx-auto ml-10 my-0 flex items-center gap-3">
                    <img src="https://picsum.photos/40" alt="avatar" class="rounded-full">
                    <p>{{$user->name}}</p>
                </div>


                <div class="">

                    <div @click="dropdown = !dropdown" class="cursor-pointer ">
                        <img src="{{asset('icons/keyboard_arrow_down-icon.svg')}}" alt="">
                    </div>

                    <span x-show="dropdown" x-collapse  class="absolute right-4 top-10 p-2 min-w-48 rounded-md border shadow-md min-h-24 text-left bg-white">
                        <ul>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Arquivar conversa</li>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Silenciar</li>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Fixar</li>
                            <li class="hover:bg-slate-200 py-2 px-3 cursor-pointer">Bloquear</li>
                            <li>
                                <button class="hover:bg-slate-200 py-2 px-3 w-full text-red-400 text-left border-t" wire:confirm="Deseja deletar este contato?" wire:click="deleteContact({{$user->id}})">Apagar contato</button>
                            </li>
                        </ul>
                    </span>

                </div>
            </div>
        </section>

        <section class="row-span-9">
            <div class="h-full px-5 overflow-y-scroll bg-[#EFEAE2]">
                @if(!empty($listAllMessages))
            <div class="overflow-y-auto overflow-x-hidden">
                @foreach ($listAllMessages as $message )
                    @if($message['sender'] != auth()->guard()->user()->name)
                        <div>
                            <div class="bg-[#576c99] text-white font-semibold w-full sm:w-2/3 md:w-1/3 max-w-max p-3 m-3 rounded-md break-words whitespace-normal inline-block">
                                <span class="text-amber-400">
                                    {{$user->name}}:
                                </span>
                                <P>{{ $message['message'] }}</P>
                            </div>
                        </div>
                    @else

                        <div class="text-right">
                            <div class="bg-[#5f97f8] text-white w-full sm:w-2/3 md:w-1/3 max-w-max p-3 m-3 rounded-md break-words whitespace-normal inline-block">

                                <p class="text-black text-left font-semibold ml-0">You:</p>

                                <div class="flex gap-3">
                                    <P class="text-left">{{$message['message']}}</P>
                                    <span class="text-xs self-end text-[#edeaea]">{{$message['created_at']}}</span>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="flex overflow-y-auto h-full justify-center items-center">
                <p>Say Hello To  {{$user->name}} </p>
            </div>
        @endif
            </div>
        </section>

        <section class="row-span-2 bg-[#F0F2F5] px-2 py-2">
            <div class=" h-full ">
                <form action="" class="flex items-center w-full h-full" wire.prevent wire:submit="sendMessage">
                    <textarea type="text" class="w-full h-full rounded-md border-none focus:ring-0 resize-none" wire:model="messageInputModel" name="message" placeholder="Digite algo incrível... ou apenas um 'oi' 😊" required  ></textarea>

                    <button type="submit" class="w-28 flex items-center justify-center border-none ">
                        <img src="{{asset('icons/send-icon2.svg')}}" class="h-12" >
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>
