<table align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%">
    <tr>
        <td style="
            padding: 20px;
            background-color: {{ $bgColor ?? '#f7fafc' }};
            border-left: 4px solid {{ $borderColor ?? '#007BFF' }};
            border-radius: 4px;
            color: #333;">
            {{ $slot }}
        </td>
    </tr>
</table>
