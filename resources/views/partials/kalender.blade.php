<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.js"></script>

<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            timeFormat: 'H(:mm)',
            eventSources: [
                {
                    url: '/api/kalender-alat', // use the `url` property
                    color: 'yellow',    // an option!
                    textColor: 'black'
                }
            ],
        });
        calendar.render();
    });
</script>
