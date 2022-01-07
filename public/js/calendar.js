

document.addEventListener('DOMContentLoaded', function() {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      timeZone: 'UTC',
      allDaySlot: false,
      slotDuration: '03:00',
      minTime: "09:00",
      maxTime: "18:00",
      contentHeight: "auto",
      defaultView: 'timeGridWeek',
      defaultDate: new Date(),
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      handleWindowResize:true,
      Boolean, default: false,
      businessHours: {
        // days of week. an array of zero-based day of week integers (0=Sunday)
        daysOfWeek: [ 1, 2, 3, 4, 5 ], // Monday - Thursday

        startTime: '9:00', // a start time (10am in this example)
        endTime: '18:00', // an end time (6pm in this example)
      },
      editable: true,
      droppable: false, // this allows things to be dropped onto the calendar
      events: '/calendar',


    });

    calendar.render();
  });