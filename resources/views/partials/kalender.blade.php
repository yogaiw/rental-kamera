<link rel="stylesheet" href="/js/fullcalendar/main.css">
<script src="/js/fullcalendar/main.js"></script>

<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            navLinks: true,
            eventSources: [
                {
                    url: '/api/kalender-alat',
                    color: 'yellow',
                    textColor: 'black'
                }
            ],
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                hour12: false
            },
            headerToolbar: {
                left: 'dayGridMonth,timeGridDay',
                center: 'title',
            }
        });
        calendar.render();
    });
</script>
