<link rel="stylesheet" href="/js/fullcalendar/main.css">
<script src="/js/fullcalendar/main.js"></script>

<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            timeFormat: 'H(:mm)',
            eventSources: [
                {
                    url: '/api/kalender-alat',
                    color: 'yellow',
                    textColor: 'black'
                }
            ],
        });
        calendar.render();
    });
</script>
