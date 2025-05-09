@props(['heading', 'selectId', 'modelName'])

<tr class="w-full h-full mt-auto">
    <td class="pt-[10px] w-[80%] align-bottom">
        <div class="flex flex-col items-center justify-center">
            <span class="mb-[5px] w-[80%] text-left text-black">{{ $heading }}</span>

            <select wire:loading.attr="disabled" wire:model={{$modelName}} id="" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[80%] pl-[10px] text-black" name="{{ $selectId }}">
                {{ $slot }}
            </select>
        </div>
    </td>
</tr>
