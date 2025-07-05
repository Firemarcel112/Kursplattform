@props([
    'size' => 'medium',
])
<table align="{{ $align ?? 'center' }}" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 auto; text-align: {{ $align ?? 'center' }};">
    <tr>
        <td align="{{ $align ?? 'center' }}" bgcolor="{{ $bgColor ?? config('app.primary_color') }}" style="border-radius: 4px;">
            <a href="{{ $url }}" style="
                   display: inline-block;
                   padding: {{ $size === 'small' ? '8px 16px' : ($size === 'large' ? '16px 32px' : '12px 24px') }};
                   font-family: Arial, sans-serif;
                   font-size: {{ $size === 'small' ? '14px' : ($size === 'large' ? '18px' : '16px') }};
                   font-weight: bold;
                   line-height: 100%;
                   color: {{ $textColor ?? '#ffffff' }};
                   text-decoration: none;
                   -webkit-text-size-adjust: none;
                   mso-style-priority: 100 !important;
                   letter-spacing: .6px;
                   border-radius: 4px;
                   background-color: {{ $bgColor ?? config('app.primary_color') }};
                   border: 0;
                   text-align: center;" target="_blank">
                {{ $slot }}
            </a>
        </td>
    </tr>
</table>
