@props([
    'id',
    'title',
    'description',
    'href',
    'confirm_button',
    'delete' => false
])

<dialog id="{{ $id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <p class="py-4">{{ $description }}</p>

        <div class="modal-action">
            <form method="POST" action="{{ $href }}">
                @csrf
                @if($delete)
                    @method('DELETE')
                @endif
                <button class="btn btn-info">{{ $confirm_button }}</button>
            </form>
            <form method="dialog">
                <button class="btn btn-error">Cancelar</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button></button>
    </form>
</dialog>
