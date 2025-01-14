<div class="h-screen">
    <div class="h-full grid grid-rows-12">
        <section class="row-span-1">
            <div class="bg-slate-100 p-2 text-xl font-semibold flex items-center gap-4 h-full">
                <a href="/dashboard" wire:navigate.hover class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    <p>Back</p>
                </a>

                <div class="mx-auto my-0">
                    <img src="{{asset('icons/google-gemini.png')}}" class="h-14">
                </div>
            </div>
        </section>

        <section class="row-span-10">
            {{-- BOT --}}
            <div class="h-full p-5 overflow-y-scroll bg-slate-400">
                <div>
                    Gemini
                    <p class="p-4 bg-cyan-600 w-full md:w-2/4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae minima illum, iure optio ipsum mollitia doloribus ex. Obcaecati illum quaerat laboriosam ex, ipsam molestias magni consequuntur consequatur, deserunt corporis placeat voluptatem quibusdam saepe ipsa incidunt nihil eos! Repellendus adipisci esse quia veritatis perspiciatis necessitatibus nesciunt fuga exercitationem labore, sequi ea nemo sunt officia modi eligendi vitae ullam odio blanditiis. Exercitationem asperiores ea recusandae cumque veritatis, doloribus dolore deleniti a commodi eveniet reiciendis ullam deserunt iusto explicabo ad nostrum consequatur? Eum, tempora? Distinctio veritatis quo similique placeat saepe fuga dicta, adipisci sint repellendus unde. Omnis, quisquam cupiditate. Id adipisci odit pariatur! lorem1000</p>
                </div>

                <div class="flex flex-col items-end">
                    You
                    <p class="p-4 bg-cyan-600 w-full md:w-2/4">{{$recentsMessageOnChat}}</p>
                </div>
            </div>
        </section>

        <section class="row-span-1">
            <form action="" class="flex w-full h-full" wire.prevent wire:submit="formPromptSubmit">

                <input type="text" class="w-full" wire:model="promptInput">
                <button class="w-28 flex items-center justify-center">
                    <img src="{{asset('icons/send-icon.svg')}}" class="h-12" >
                </button>
                
            </form>
        </section>

    </div>
</div>
