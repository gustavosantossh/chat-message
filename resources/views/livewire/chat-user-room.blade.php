<div class="flex flex-col">

    <div class="bg-green-400 p-4 text-center text-xl font-semibold">
        {{$user->name}}
    </div>


    @if(!empty($listAllMessages))
        <div class="overflow-y-auto min-h-[calc(100v-167px))] max-h-[calc(100vh-167px)]">
        {{-- {{dd($listAllMessages)}} --}}
            @foreach ($listAllMessages as $message )
                @if($message['sender'] != auth()->guard()->user()->name)
                    <div>
                        <div class="bg-[#576c99] text-white font-semibold w-full sm:w-2/3 md:w-1/3 max-w-max p-3 m-3 rounded-md break-words whitespace-normal inline-block">
                            <P>{{$message['message']}}</P>
                        </div>
                    </div>
                @else

                    <div class="text-right">
                        <div class="bg-teal-400 w-full sm:w-2/3 md:w-1/3 max-w-max p-3 m-3 rounded-md break-words whitespace-normal inline-block">

                            <P>{{$message['message']}}</P>

                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="flex overflow-y-auto min-h-[calc(100vh-167px)] justify-center items-center">
            <p>Say Hello To  {{$user->name}} </p>
        </div>
    @endif


    <div class="w-full">
        <form method="POST" wire.prevent wire:submit="sendMessage">
            <div class="flex">
                <x-input wire:model="messageInputModel" name="message" class="w-full" />
                <x-button type="submit" class="w-36 justify-center " > Enviar</x-button>
            </div>
        </form>
    </div>
</div>
