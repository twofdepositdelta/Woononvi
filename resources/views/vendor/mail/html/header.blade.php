@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" class="logo-text" style="display: inline-block;" align="center">
            {{-- @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Wôononvi Logo">
            @else
                {{ $slot }}
            @endif --}}

            <span class="logo-black">{{ explode('ō', FrontHelper::getAppName())[0] }}ō</span><span class="logo-yellow">{{ explode('ō', FrontHelper::getAppName())[1] }}</span>
        </a>


    </td>
</tr>



