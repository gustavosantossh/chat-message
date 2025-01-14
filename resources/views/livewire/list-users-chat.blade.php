<div>


    @if (session('success'))
        <script>
            toastr.success("{{session('success')}}")
        </script>
    @endif

    <div class="p-2 m-3" x-data="{expanded: true}"  >
        <button @click="expanded = ! expanded" class="bg-green-400 p-3 rounded-md">Adicionar contato</button>

        <div x-show="expanded" x-collapse>
            <div class="bg-red-400 mt-3 p-4">
                <form wire.prevent wire:submit="AdicionarContato(emailContact)">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" required x-model="emailContact">

                    <button>Adicionar</button>
                </form>
            </div>
        </div>

    </div>

    <div class="p-2 m-3">
        <span>Pesquisar contato:</span>
        <input type="text" wire:model.live="searchContacts" class="p-2 m-3"> {{$searchContacts}}
    </div>

    <hr class="p-2 m-3">

    <div class="p-2 m-3">
        <h1 class="text-4xl font-semibold">Contatos</h1>
    </div>

    <div>
        <a wire:navigate.hover href="{{route('chat.gemini')}}" class="bg-[#1A1C1E] text-white font-semibold flex gap-4 p-2 shadow-md shadow-slate-300 items-center m-3 rounded-md hover:bg-slate-400 transition duration-700">
                <img src="{{asset('icons/google-gemini.png')}}" class="h-14">
                <p>Gemini IA </p>
        </a>
        @foreach ($contacts->UserHasContacts as $contact)
        {{-- {{dd($contacts->UserHasContacts[0]->id)}} --}}

            <div class="flex mb-3">
                <a wire:navigate.hover href="{{route('chat.room', $contact->id)}}" class="flex gap-4 p-2 shadow-md shadow-slate-300 items-center m-3 rounded-md hover:bg-slate-400 transition duration-700 w-full">
                    <img class="rounded-full" src="{{$contact->profile_photo_url}}">
                     <p>{{$contact->name}} </p>
                    </a>

                <a wire:confirm="Deseja deletar este contato?" wire:click="deleteContact({{$contact->id}})" class="w-16 m-3 p-4 bg-red-600 rounded-md text-center align-items-center">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </a>
            </div>

        @endforeach
    </div>
</div>
