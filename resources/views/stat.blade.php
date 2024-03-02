@extends('template.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>

        <div class="masonry-item col-12">
            <div class="bd bgc-white">
                <div class="peers fxw-nw@lg+ ai-s">
                    <div class="peer peer-greed w-70p@lg+ w-100@lg- p-20">
                        <div class="layers">
                            <div class="layer w-100  mB-10">
                                <h6 class="lh-1">Статистика Рассылки:</h6>
                                <div id="stats">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <th style="background-color: #f2f2f2; padding: 8px;">Название</th>
                                            <th style="background-color: #f2f2f2; padding: 8px;">Процент отправки</th>
                                        </tr>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td style="border: 1px solid #ddd; padding: 8px;">{{ "$event->event_name" }}
                                                </td>
                                                <td style="border: 1px solid #ddd; padding: 8px;">{{ "$event->completion" }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        form {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
