<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Reservation</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8F7F4;
            padding: 40px 15px;
            color: #222;
        }

        .container {
            max-width: 650px;
            margin: auto;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 45px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .08);
        }

        .icon-circle {
            width: 95px;
            height: 95px;
            background: #E8F1FF;
            border-radius: 50%;
            margin: 0 auto;
            text-align: center;
            line-height: 95px;
        }

        .icon-circle img {
            width: 60px;
            height: 60px;
            vertical-align: middle;
        }

        .title {
            text-align: center;
            margin-top: 25px;
            font-size: 34px;
            font-weight: 700;
        }

        .line {
            width: 90px;
            height: 5px;
            background: #12364d;
            border-radius: 10px;
            margin: 18px auto 35px;
        }

        .greeting {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .message {
            color: #666;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 35px;
        }

        .details-card {
            background: #FAFAFA;
            border: 1px solid #ECECEC;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 35px;
        }

        .details-header {
            background: #EDF4FF;
            color: #12364d;
            font-weight: 700;
            font-size: 18px;
            padding: 18px 25px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #ECECEC;
        }

        .detail-row:last-child {
            border: none;
        }

        .left {
            display: flex;
            align-items: center;
            gap: 0;
        }


        .icon {
            display: none;
        }

        .icon img {
            width: 20px;
        }

        .label {
            color: #777;
            font-size: 15px;
        }

        .value {
            font-weight: 600;
            color: #111;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="icon-circle">
                <img src="https://img.icons8.com/ios-filled/100/2F80ED/calendar--v1.png">
            </div>

            <h1 class="title">
                Upcoming Reservation
            </h1>

            <div class="line"></div>

            <div class="greeting">
                Hi {{ $resident->first_name }},
            </div>

            <p class="message">
                Your reservation at <strong>{{ $facility->name }}</strong>
                is coming up on <strong>{{ $reservation->date->format('M j, Y') }}</strong>
                at <strong>{{ $reservation->start_time->format('H:i A') }} - {{ $reservation->end_time->format('H:i A') }}</strong>.
                Please review the details below.
            </p>

            <div class="details-card">

                <div class="details-header">
                    Reservation Details
                </div>
                <div class="detail-row">
                    <div class="left">
                        <div class="icon"></div>
                        <div>
                            <div class="label">
                                Reservation ID -
                            </div>
                        </div>
                    </div>

                    <div class="value">
                        {{ $reservation->code }}
                    </div>

                </div>

                <div class="detail-row">

                    <div class="left">

                        <div class="icon"></div>

                        <div>
                            <div class="label">
                                Facility -
                            </div>
                        </div>

                    </div>

                    <div class="value">
                        {{ $reservation->facility->name }}
                    </div>

                </div>

                <div class="detail-row">

                    <div class="left">

                        <div class="icon"></div>

                        <div>
                            <div class="label">
                                Date -
                            </div>
                        </div>

                    </div>

                    <div class="value">
                        {{ $reservation->date }}
                    </div>

                </div>

                <div class="detail-row">

                    <div class="left">

                        <div class="icon"></div>

                        <div>
                            <div class="label">
                                Time -
                            </div>
                        </div>

                    </div>

                    <div class="value">
                        {{ $reservation->start_time->format('H:i A') }} - {{ $reservation->end_time->format('H:i A') }}
                    </div>

                </div>

            </div>

            <div
                style="
    background:#EDF6FF;
    border-left:5px solid #00649a;
    border-radius:10px;
    padding:22px;
    margin-bottom:35px;
">

                <h3 style="
    color:#00649a;
    margin-bottom:15px;
    font-size:20px;
">
                    Please Remember
                </h3>

                <ul style="
    padding-left:18px;
    line-height:1.9;
    color:#555;
">

                    <li>Arrive at least <b>5 minutes early</b>.</li>

                    <li>Bring any required IDs or documents.</li>

                    <li>
                        If you cannot attend,
                        kindly cancel your reservation
                        in advance.
                    </li>

                </ul>

            </div>

            <div style="text-align:center; margin-bottom:45px;">

                {{-- <a href="{{ $reservationLink }}"
                    style="
display:inline-block;
background:linear-gradient(135deg,#00649a,#12364d);
color:#fff;
text-decoration:none;
padding:18px 42px;
border-radius:8px;
font-size:17px;
font-weight:600;
box-shadow:0 12px 30px rgba(37,99,235,.25);
">

                    View Reservation Details

                </a> --}}

            </div>

            <hr style="
border:none;
border-top:1px solid #ECECEC;
margin-bottom:28px;
">

            <div style="
text-align:center;
color:#777;
font-size:15px;
line-height:1.8;
">

                <strong style="
color:#1E3A8A;
font-size:16px;
">
                    Sunshine City Reservation System
                </strong>

                <br><br>

                Thank you for choosing our reservation system.

                <br>

                We look forward to serving you!

            </div>
        </div>

    </div>

    <style>
        @media(max-width:640px) {

            .card {
                padding: 28px 20px;
            }

            .title {
                font-size: 28px;
            }

            .greeting {
                font-size: 20px;
            }

            .message {
                font-size: 15px;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .value {
                margin-left: 58px;
            }

            .icon-circle {
                width: 80px;
                height: 80px;
            }

            .icon-circle img {
                width: 80px;
                height: 80px;
            }

            .icon {
                width: 38px;
                height: 38px;
            }

            .icon img {
                width: 18px;
            }

        }
    </style>

</body>

</html>
