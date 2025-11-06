<ul class="pl-3 list-none">
    @foreach ($units as $unit)
        <li class="mb-1">
            <a href="#" wire:click.prevent="$set('unit_id', {{ $unit->id }})"
                class="text-blue-600 hover:underline">
                📁 {{ $unit->name }}
            </a>
            @if ($unit->children->count())
                @include('employees.partials.unit-tree', ['units' => $unit->children])
            @endif
        </li>
    @endforeach
</ul>
