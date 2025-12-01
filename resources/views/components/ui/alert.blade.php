<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    @if(isset($title))
        <strong class="font-bold">{{ $title }}</strong>
    @endif
    <span class="block">{{ $message ?? '' }}</span>
</div>