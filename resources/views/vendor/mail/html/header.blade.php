@props(['url'])
<tr>
    <td class="gradient-header">
        <h1 style="color: #ffffff; margin: 0 0 8px 0; font-size: 28px;">
            @if (trim($slot) === 'Laravel' || trim($slot) === 'Munir Jaya Abadi')
                📧 {{ trim($slot) }}
            @else
                {!! $slot !!}
            @endif
        </h1>
        <p style="color: #f3f4f6; margin: 0; font-size: 16px;">
            <a href="{{ $url }}" style="color: #ffffff; text-decoration: none;">
                {{ config('app.url') }}
            </a>
        </p>
    </td>
</tr>
