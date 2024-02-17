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
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Создание рассылки</h6>
                                <form method="POST" action="{{ route('schedule.create') }}">
                                    @csrf
                                    <label for="event_name">Название рассылки:</label>
                                    <input type="text" name="event_name" id="event_name">

                                    <label for="sms_text">Текст Сообщения:</label>
                                    <textarea name="sms_text" id="sms_text" rows="4" cols="50"></textarea>
                                    
                                    <label for="send_time">Время отправки:</label>
                                    <input type="time" name="send_time" id="send_time">

                                    <label for="time_offset">За сколько дней до события происходит отправка?:</label>
                                    <input min="0" type="number" name="time_offset" id="time_offset">
                                    
                                    <div>
                                        <button type="submit">Создать</button>
                                    </div>

                                </form>
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

        textarea,
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

        input[type="time"] {
            width: 10%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="number"] {
            width: 5%;
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
