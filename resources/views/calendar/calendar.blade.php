

@extends('master')

@section('content')


<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li class="active">Calendar</li>
</ol>

<h4 class="page-title">CALENDAR</h4>

<div class="block-area">

</div>

<div class="col-md-12 clearfix">

    <div id="calendar" class="p-relative p-10 m-b-20">
        <!-- Calendar Views -->
        <ul class="calendar-actions list-inline clearfix">
            <li class="p-r-0">
                <a data-view="month" href="#" class="tooltips" title="Month">
                    <i class="sa-list-month"></i>
                </a>
            </li>
            <li class="p-r-0">
                <a data-view="agendaWeek" href="#" class="tooltips" title="Week">
                    <i class="sa-list-week"></i>
                </a>
            </li>
            <li class="p-r-0">
                <a data-view="agendaDay" href="#" class="tooltips" title="Day">
                    <i class="sa-list-day"></i>
                </a>
            </li>
        </ul>
    </div>
</div>


<!-- Add event -->
<div class="modal fade" id="addNew-event">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add an Event</h4>
               </div>
               <div class="modal-body">
                    <form class="form-validation" role="form">
                         <div class="form-group">
                              <label for="eventName">Event Name</label>
                              <input type="text" class="input-sm form-control validate[required]" id="eventName" placeholder="...">
                         </div>

                         <input type="hidden" id="getStart" />
                         <input type="hidden" id="getEnd" />
                    </form>
               </div>

               <div class="modal-footer">
                    <input type="submit" class="btn btn-info btn-sm" id="addEvent" value="Add Event">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>

@endsection
@section('footer')

<script type="text/javascript">
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                 center: 'title',
                 left: 'prev, next',
                 right: ''
            },
        eventClick: function(calEvent, jsEvent, view) {

              alert('Event: ' + calEvent.title);
              //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
              //alert('View: ' + view.name);
              // change the border color just for fun
              $(this).css('border-color', 'red');

          },

            selectable: true,
            selectHelper: true,
            editable: false,
            eventSources: [

                {

                    headers : { 'X-CSRF-Token': '{{ csrf_token() }}' },
                    url: "{!! url('/getEvents/')!!}",
                    type: 'POST',
                    data: {
                        custom_param1: 'something',
                        custom_param2: 'somethingelse'
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: 'yellow',
                    textColor: 'black'
                }


            ],

            //On Day Select
            select: function(start, end, allDay) {
                $('#addNew-event').modal('show');
                $('#addNew-event input:text').val('');
                $('#getStart').val(start);
                $('#getEnd').val(end);
            },

            eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
                $('#editEvent').modal('show');

                var info =
                    "The end date of " + event.title + "has been moved " +
                    dayDelta + " days and " +
                    minuteDelta + " minutes."
                ;

                $('#eventInfo').html(info);


                $('#editEvent #editCancel').click(function(){
                     revertFunc();
                })
            }
        });

        $('body').on('click', '#addEvent', function(){
             var eventForm =  $(this).closest('.modal').find('.form-validation');
             eventForm.validationEngine('validate');

             if (!(eventForm).find('.formErrorContent')[0]) {

                  //Event Name
                  var eventName = $('#eventName').val();

                  //Render Event
                  $('#calendar').fullCalendar('renderEvent',{
                       title: eventName,
                       start: $('#getStart').val(),
                       end:  $('#getEnd').val(),
                       allDay: true,
                  },true ); //Stick the event

                  $('#addNew-event form')[0].reset()
                  $('#addNew-event').modal('hide');
             }
        });
    });

    //Calendar views
    $('body').on('click', '.calendar-actions > li > a', function(e){
        e.preventDefault();
        var dataView = $(this).attr('data-view');
        $('#calendar').fullCalendar('changeView', dataView);

        //Custom scrollbar
        var overflowRegular, overflowInvisible = false;
        overflowRegular = $('.overflow').niceScroll();
    });

</script>

@endsection

