<div>
    <h1>{{ $count }}</h1>

    <button wire:click="increment">+</button>

    <button wire:click="decrement">-</button>

    <p>Kada budem bilo koju vrstu inputa, dobro bi bilo da to stavim u formu, jer onda mogu na form tag staviti wire:submit
        koji će prepoznati kada unesem u input nešto i kliknem enter, ne samo button koji možda imam
    </p>

    <form wire:submit="add">
        <input type="number" wire:model="count"> <!-- wire:model nam u biti povezuje ovo input polje i property u našem kontrolleru -->

        <button type="submit">Add</button>
    </form>

    <!-- Ova forma iznad radi iz raloga što ona u biti samo mijenja vrijednost propertya count-->
</div>

