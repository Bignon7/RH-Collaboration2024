<style>
    .fc-toolbar-title {
        color: #696cff;
    }

    .fc-daygrid-day {
        background-color: #f9fafb;
    }

    .fc-daygrid-day:hover {
        background-color: #e0e7ff;
    }

    .fc-event {
        background-color: #696cff;
        color: white;
    }

    .fc-daygrid-event-dot {
        background-color: transparent;
        /* Make the background transparent */
        color: #ff5733;
        /* Change this to your desired color */
    }

    .fc-day-today {
        background-color: #7f81f6f2 !important;
        /* Change this to your desired color */
    }

    .fc-prev-button:hover::before {
        content: 'Précédent';
    }

    .fc-next-button:hover::before {
        content: 'Suivant';
    }
</style>
@extends('pages.link')
@section('content')
    @include('pages.update.cal_partial')
@endsection
