<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>
 

<div class="page-content">
    <div class="container-fluid">
    <div id='calendar'></div>

<div id="createEventModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4> Event</h4>
            </div>
            <div id="modalBody" class="modal-body">
                <p>
                    <strong>Account Number:</strong> <span id="account"></span><br>
                    <strong>Bank Name:</strong> <span id="accountName"></span><br>
                    <strong>Amount:</strong> <span id="amount"></span><br>
                    <strong>Description:</strong> <span id="description"></span><br>
                    <strong>Note:</strong> <span id="note"></span><br>
                    <strong>Reference:</strong> <span id="Reference"></span><br>
                    <strong>Date:</strong> <span id="date"></span><br>
                </p>
            </div>
        </div>
    </div>
</div>



<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var expenseData = <?php echo $events; ?>;  
    var incomeData = <?php echo $incomeevents; ?>;  

    // console.log(incomeData);
    // return false;

    // for expense data
        var expenseEvent = expenseData.map(function(eventData) {
          
        var dateParts = eventData.date.split('-');
        
        var formattedDate = dateParts[0] + '-' + dateParts[1] + '-' + dateParts[2];

        
        return {
            title: eventData.categoryName,
            start: formattedDate,
            account: eventData.account,
            bank: eventData.bank,
            amount: eventData.amount,
            description: eventData.description,
            note: eventData.note,
            reference: eventData.reference
        };
    });

    // for income data
        var incomeEvent = incomeData.map(function(eventData) {
           
        var dateParts = eventData.date.split('-');
       
        var formattedDate = dateParts[0] + '-' + dateParts[1] + '-' + dateParts[2];

       
        return {
            title: eventData.categoryName,
            start: formattedDate,
            account: eventData.account,
            bank: eventData.bank,
            amount: eventData.amount,
            description: eventData.description,
            note: eventData.note,
            reference: eventData.reference
        };
    });


        var joinevents = incomeEvent.concat(expenseEvent);
        console.log(joinevents);

        var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: joinevents,
        color: '#881fd8',
        eventColor: '#881fd8',
        firstDay: 1,
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        views: {},
        editable: true,
        selectable: true,
        eventClick: function(info)
        {
            $('#createEventModal').modal('show');
            $("#createEventModal .modal-body p").text(info.event.incomeCategory); 
            $("#account").text(info.event.extendedProps.account);
            $("#accountName").text(info.event.extendedProps.bank);
            $("#amount").text(info.event.extendedProps.amount);
            $("#description").text(info.event.extendedProps.description);
            $("#note").text(info.event.extendedProps.note);
            $("#Reference").text(info.event.extendedProps.reference);

            var eventDate = new Date(info.event.start);
            $("#date").text(eventDate.toLocaleString());
        },
    });

    calendar.render();

});

</script>




<!-- 
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: 'calendar', 
            editable: true,
            selectable: true,

            eventClick: function(info)
 {
                $('#createEventModal').modal('show');
                $("#createEventModal .modal-body p").text(info.event.expense_category); 
                $("#account").text(info.event.extendedProps.account);
                $("#accountName").text(info.event.extendedProps.bank);
                $("#amount").text(info.event.extendedProps.amount);
                $("#description").text(info.event.extendedProps.description);
                $("#note").text(info.event.extendedProps.note);
                $("#Reference").text(info.event.extendedProps.reference);
                $("#date").text(info.event.date);
            }, 
        });


        // events.forEach(function(event) {
        //     event.start = moment(event.start, 'DD-MMM-YYYY').format('YYYY-MM-DD');
        // });

        // calendar.addEventSource(events);

        calendar.render();
    });
    </script> -->


<!-- <script>
var eventdata = [
	{
		title: 'All Day Event',
		start: '2023-08-01'
	},
	{
		title: 'Long Event',
		start: '2023-08-07',
		end: '2023-08-10'
	},
	{
		title: 'Conference',
		start: '2023-08-11',
		end: '2023-08-13'
	},
	{
		title: 'Meeting',
		start: '2023-08-12T10:30:00',
		end: '2023-08-12T12:30:00'
	},
	{
		title: 'Lunch',
		start: '2023-08-12T12:00:00'
	},
	{
		title: 'Meeting',
		start: '2023-08-12T14:30:00'
	},
	{
		title: 'Happy Hour',
		start: '2023-08-12T17:30:00'
	},
	{
		title: 'Dinner',
		start: '2023-08-12T20:00:00'
	},
	{
		title: 'Birthday Party',
		start: '2023-08-13T07:00:00'
	},
	{
		title: 'Click for Google',
		url: 'https://google.com/',
		start: '2023-08-28'
	}
];

      document.addEventListener('DOMContentLoaded', function() {
      
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: 'calendar',
          editable: true,
          selectable: true,

          eventClick: function(data) {

           alert('Event: ' + data.event.title);
            $('#createEventModal').modal('show');
            $("#createEventModal .modal-body p").text( data.event.title);
        },

        });
        calendar.render();
      });

    </script> -->




<!-- End Page-content -->

<!-- end main content-->



<?= $this->endSection() ?>