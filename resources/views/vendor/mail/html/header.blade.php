@props(['url'])
<tr>
    <td class="header" style="padding: 40px 0; text-align: center; background: #f8fafc;">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            <span style="font-size: 28px; font-weight: bold; color: #2d3748;">
                {!! $slot !!}
            </span>
        </a>
    </td>
</tr>
