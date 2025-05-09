@props(['text', 'image'])

<div class="flex items-center justify-center mt-8 mb-4">
    @svg($image, ['class' => 'w-6 mr-2'])
    <p class="ml-[10px] mr-auto text-base font-bold">{{ $text }}</p>
</div>
