<div>
    <form wire:submit.prevent="createPoll">
        <label for="">TITULO ENQUENTE</label>
        <input type="text" wire:model.live="title"/>



        <div class="mt-4 mb-4">
            <button class="btn" wire:click.prevent="addOption">Adicione uma opção</button>

        </div>
       <div class="mt-4">
           @foreach($options as $index => $option)
               <div class="mt-2">
                   <label> Opção {{ $index + 1 }}</label>
                   <div class="flex gap-2">
                       <input type="text" wire:model="options.{{$index}}">
                       <button class="btn" wire:click.prevent = "removeOption({{$index}})">Remover</button>
                   </div>
               </div>
           @endforeach

       </div>

        <div class="mt-2">
            @foreach($options as $index => $option)
               {{$index + 1}} => {{$option}} <br>
            @endforeach
        </div>
        <button type="submit" class="btn">Criar enquete</button>
    </form>
</div>
