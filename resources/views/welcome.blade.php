@extends('layouts.admin')
@section('content')
<div x-data="{ items: [] }">
    <template x-for="item in items" :key="item">
        <p x-text="item"></p>
    </template>
    <p x-show="items.length === 0">Empty</p>
</div>
@endsection