@props(['action', 'method' => 'POST'])

<form {{ $attributes->merge(['action' => $action, 'method' => 'POST', 'class' => 'bg-white rounded-lg shadow-md p-6']) }}>
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    {{ $slot }}
</form>
