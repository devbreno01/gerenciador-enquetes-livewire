<div>
    <form wire:submit.prevent="createPoll">
        <label for="">TITULO ENQUENTE</label>
        <input type="text" wire:model.live="title"/>

        <div class="mt-4 mb-4">
            <button class="btn" wire:click.prevent="addOption">Adicione uma opção</button>
        </div>

        @error("title")
            <div class="text-red-500">
                {{$message}}
            </div>
        @enderror

       <div class="mt-4">
           @foreach($options as $index => $option)
               <div class="mt-2">
                   <label> Opção {{ $index + 1 }}</label>
                   <div class="flex gap-2">
                       <input type="text" wire:model="options.{{$index}}">
                       <button class="btn" wire:click.prevent = "removeOption({{$index}})">Remover</button>
                   </div>
                   @error("options.{$index}")
                       <div class="text-red-500">
                           {{$message}}
                       </div>
                   @enderror
               </div>
           @endforeach

       </div>



        <button type="submit" class="btn mt-2">Criar enquete</button>
    </form>
</div>
