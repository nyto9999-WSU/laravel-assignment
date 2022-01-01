document.addEventListener('DOMContentLoaded', function() {
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
      defaultDate: '2021-12-09',
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
      droppable: true, // this allows things to be dropped onto the calendar
      events: [
        {

          title: 'Job 1\n Model:cds12dw\n PD: 2021-12-09\n PT: Afternoon\n Address: Newtown\n Quantity: 5\n Type:Split System\n D&C : Domestic\n Contact: 063321689',
          start: '2021-12-09T09:00:00',
          end: '2021-12-09T11:59:00',
          color: '#6610f2'

        },
        {
          title: 'Job 2\n Model:dsc1231w\n PD: 2021-12-09\n PT: Afternoon\n Address: 148, crown st.\n Quantity: 2\n Type:Ducted System\n D&C : Commercial\n Contact: 063212222',
          start: '2021-12-09T09:00:00',
          end: '2021-12-09T11:59:00',
          color: '#ffc107'
        },
        {
          title: 'Job 3\n Model:asc1231w\n PD: 2021-12-09\n PT: Afternoon\n Address: 2 rose st. chippendale\n Quantity: 1\n Type:Package Unit\n D&C : Domestic\n Contact: 063212192',
          start: '2021-11-07',
          start: '2021-12-09T09:00:00',
          end: '2021-12-09T11:59:00',
          color: '#198754'
        },
        {
          title: 'Job 4\n Model:te23w\n PD: 2021-12-09\n PT: Afternoon\n Address: WSU\n Quantity: 12\n Type: Mini VRF\n D&C : Commercial\n Contact: 0632192322',
          start: '2021-11-07',
          start: '2021-12-09T09:00:00',
          end: '2021-12-09T11:59:00',
          color: '#dc3545'
        },
        {
          title: 'Job 4\n Model:feq1112\n PD: 2021-12-09\n PT: Afternoon\n Address: WSU\n Quantity: 12\n Type:Package Unit\n D&C : Commercial \n Contact: 063219292',
          start: '2021-11-07',
          start: '2021-12-09T09:00:00',
          end: '2021-12-09T11:59:00',
          color: '#dc3545'
        },

      ]
    });

    calendar.render();
  });