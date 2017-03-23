<!-- Modal Default -->
<div class="modal fade modalAddAttendee" id="modalAddAttendee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeMettingAttendees" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Meeting Attendees</h4>
            </div>
            <div class="modal-body">

            <!-- Responsive Table -->
            <div class="block-area" id="responsiveTable">
                <div id="MeetingAttendeeNotification"></div>
                <div class="table-responsive overflow">
                    <table class="table tile table-striped" id="meetingAttendeesTable">
                        <thead>
                          <tr>
                                <th><a id='selecctall' data-value='0'>select/All</a></th>
                                <th>Name</th>
                                <th>Cellphone</th>
                                <th>Invited</th>
                                <th>Accepted</th>
                                <th>Attended</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>

            </div>
            <div class="modal-footer">


            </div>


        </div>
    </div>
</div>
