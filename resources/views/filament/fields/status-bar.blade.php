@php
    $color = $color ?? '#3490dc';
@endphp

<div style="
    background-color: {{ $color }};
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-weight: bold;
    text-align: center;
">
    Hello
</div>
