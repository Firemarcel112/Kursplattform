<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta name="x-apple-disable-message-reformatting">
        <title>{{ $subject ?? config('app.name') }}</title>
        <style>
            /* Reset */
            body {
                margin: 0;
                padding: 0;
                background-color: #ffffff;
                font-family: Arial, sans-serif;
                color: #333333;
            }

            table {
                border-collapse: collapse;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }

            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                display: block;
            }

            .email-container {
                max-width: 600px;
                margin: 0 auto;
            }

            /* Responsive */
            @media only screen and (max-width: 620px) {
                .email-container {
                    width: 100% !important;
                }

                .stack-column,
                .stack-column-center {
                    display: block !important;
                    width: 100% !important;
                    max-width: 100% !important;
                    margin: 0 auto !important;
                }

                .stack-column-center {
                    text-align: center !important;
                }

                .mobile-padding {
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }
            }
        </style>
    </head>

    <body style="margin:0; padding:0; background-color: #f4f4f4;">
        <center style="width: 100%; background-color: #f4f4f4;">
            <div class="email-container" style="max-width: 600px; margin: 0 auto;">
                <!-- Header -->
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin: auto;" width="100%">
                    <tr>
                        <td style="background-color: {{ config('app.primary_color') }}; padding: 30px; text-align: center; color: #fff; font-size: 24px; font-weight: bold;">
                            {{ config('app.name') }}
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td class="mobile-padding" style="padding: 40px 30px 20px 30px; background-color: #ffffff;">
                            {!! $slot !!}

                            {!! $subcopy ?? '' !!}
                        </td>
                    </tr>

                    <!-- Footer -->
                    @include('vendor.mail.html.footer')
                </table>
            </div>
        </center>
    </body>

</html>
