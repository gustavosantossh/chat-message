<div>
    {{-- Be like water. --}}

    @foreach ($listUsersChat as $item)

        <a wire:navigate href="{{route('chat.room', $item->id)}}" class="flex gap-4 p-2 shadow-md shadow-slate-300 items-center m-3 rounded-md hover:bg-slate-400 transition duration-700">

            <img class="rounded-full" src="{{$item->profile_photo_url}}">

             <p>{{$item->name}} </p>
        </a>

    @endforeach
</div>
