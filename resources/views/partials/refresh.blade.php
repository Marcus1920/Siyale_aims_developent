<script>

    var c = 0; max_count = 10; logout = true;
    $(document).ready(function () {
        var idleState = false;
        var idleTimer = null;
        $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            clearTimeout(idleTimer);
            if (idleState == true) {
                $('#logout_popup').modal('show');
                checkSession();

            }
            idleState = false;
            idleTimer = setTimeout(function () {

                idleState = true; }, 120000);
        });

    });


    function checkSession() {

        logout = true;
        c = 0;
        max_count = 10;
        $('#timer').html(max_count);

        startCount();

        $.post('{{ route('session.ajax.check') }}', { '_token' : '{!! csrf_token() !!}' }, function(data) {
            if (data == 'loggedOut') {

                document.location.href = '{{ url('/')}}';
            }
            else if (data != '') {

                $('#logout_popup').modal('show');
                $("#continueSession").on("click",function(){

                    $.post( "resetSession",{ '_token' : '{!! csrf_token() !!}' }, function( data ) {

                    });

                    $('#logout_popup').modal('hide');

                });

                $("#exitSession").on("click",function(){


                    $('#logout_popup').modal('hide');
                    document.location.href = '{{ url('/')}}';


                })

            }
        });
    }





    function resetTimer(){
        logout = false;
        $('#logout_popup').modal('hide');

    }

    function timedCount() {
        c = c + 1;
        remaining_time = max_count - c;
        if( remaining_time == 0 && logout ){
            $('#logout_popup').modal('hide');
            location.href = '{{ url('/')}}';

        }else{
            $('#timer').html(remaining_time);
            t = setTimeout(function(){timedCount()}, 1000);
        }
    }

    function startCount() {
        timedCount();
    }

</script>




