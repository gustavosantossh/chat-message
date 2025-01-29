<div class="w-full h-screen grid grid-cols-12" x-data="{ expanded: false, emailContact: '' }">

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

    <div class="w-full h-full col-span-4 px-3 py-4 border-r-2 shadow-md bg-white overflow-auto">

        <div class="flex flex-col gap-4">

            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Conversas</h1>

                <div class="">
                    <button @click="expanded = !expanded">
                        <img src="{{ asset('icons/add-icon.svg') }}" alt="">
                    </button>
                </div>

            </div>

            <div x-show="expanded" x-collapse>
                <form class="flex flex-col gap-3" wire:submit="AdicionarContato(emailContact)">

                    <label for="email" class="font-semibold text-base">Email: </label>

                    <div class="relative">
                        <img src="{{ asset('icons/mail-icon.svg') }}" class="absolute left-2 top-2" alt="icon mail">

                        <input class="bg-[#F0F2F5] h-9 pl-10 w-full rounded-md border-none focus:ring-0"
                            placeholder="email" type="email" name="email" id="email" required
                            x-model="emailContact">
                    </div>
                    <button type="submit"
                        class="w-full bg-[#29e06f] text-white font-semibold py-2 rounded-md">Adicionar Contato</button>
                </form>

            </div>

            <hr>

            <div>

                <div class="relative w-full">
                    <img src="{{ asset('icons/search-icon.svg') }}" class="absolute left-2 top-2" alt="icon mail">
                    <input class="bg-[#F0F2F5] h-9 w-full pl-10 rounded-md border-none focus:ring-0"
                        placeholder="Pesquisar" type="text" wire:model.live="searchContacts"
                        wire:keydown="updateContacts">
                </div>

            </div>

            <div class="flex flex-col gap-3 h-[490px] overflow-auto">

                <button wire:click="selectChatBot('gemini')"
                    class="bg-[#1A1C1E] hover:bg-[#2A2C2E] transition-colors duration-200 p-2 rounded-md">

                    <div class="flex gap-4 items-start justify-between ">

                        <div class="flex gap-4 items-center">
                            <img src="{{ asset('icons/google-gemini.png') }}" class="h-14">
                            <h1 class="text-lg text-white font-semibold">Gemini Bot</h1>
                        </div>

                    </div>

                </button>

                @foreach ($contacts as $contact)
                    <button wire:click="selectContact({{ $contact->id_contact }})"
                        class="hover:bg-slate-100 duration-100 p-2 border-b">

                        <div class="flex gap-4 items-start justify-between ">

                            <div class="flex gap-4">
                                <img src="https://picsum.photos/50" class="rounded-full">
                                <h1 class="text-base">{{ $contact->name }}</h1>
                            </div>

                        </div>

                    </button>
                @endforeach

            </div>

        </div>
    </div>

    <div class="col-span-8">

        @switch($chatType)
            @case('gemini')
                <livewire:gemini-chat-bot />
            @break

            @case('user')
                <livewire:chat-user-room :user_id="$selectedContactId" wire:key="chat-user-room-{{ $selectedContactId }}" />
            @break

            @default
                <div class="h-screen flex flex-col justify-center items-center bg-[#F0F2F5]">
                    <img src="{{ asset('icons/Chatting-amico.svg') }}" class="h-1/2">
                    <h1 class="text-xl font-semibold">Selecione um <span class="text-[#407BFF]">chat</span> para iniciar uma conversa.</h1>
                </div>
        @endswitch


        {{-- @if ($selectedContactId)

            <livewire:chat-user-room :user_id="$selectedContactId" wire:key="chat-user-room-{{ $selectedContactId }}" />

        @else

            <div class="h-screen flex justify-center items-center bg-[#F0F2F5]">
                <h1 class="text-xl font-semibold">Selecione um chat para iniciar uma conversa.</h1>
            </div>

        @endif --}}

    </div>

</div>
