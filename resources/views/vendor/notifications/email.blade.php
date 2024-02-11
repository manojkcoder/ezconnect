<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang(' Best Regards'),<br>
{{ config('app.name') .' team'}}
@endif

<x-slot:subcopy>
{{-- Subcopy --}}
@isset($actionText)
    @lang(
        "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
        'into your web browser:',
        [
            'actionText' => $actionText,
        ]
    ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span><br><hr><small><i>This e-mail is confidential and is meant for the recipient only. If you are not the intended recipient, please inform the sender of this and destroy the message immediately.</i></small>
    @else
    <small><i>This e-mail is confidential and is meant for the recipient only. If you are not the intended recipient, please inform the sender of this and destroy the message immediately.</i></small>
@endisset
</x-slot:subcopy>

</x-mail::message>
