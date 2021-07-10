<x-app-layout>
    <!-- Meta -->
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta charset="utf-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- CSS -->
   <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

   <!-- Script -->
   <script src="{{asset('jquery-3.3.1.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
   <div class="px-4 py-5 bg-white sm:p-6">
                        <!-- For defining autocomplete -->
                        <input type="text" id='user_search'>

                        <!-- For displaying selected option value from autocomplete suggestion -->
                        <input type="text" id='app_user_id' readonly>

                        <!-- Script -->
                        <script type="text/javascript">

                        // CSRF Token
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var URL = " {{route('vehicles.getUser')}} "
                        $(document).ready(function(){

                        $( "#user_search" ).autocomplete({
                            source: function( request, response ) {
                            // Fetch data
                            $.ajax({
                                url: URL,
                                type: 'post',
                                dataType: "json",
                                data: {
                                _token: CSRF_TOKEN,
                                search: request.term
                                    },
                                success: function( data ) {
                                response( data );
                                }
                            });
                            },
                            select: function (event, ui) {
                            // Set selection
                            $('#user_search').val(ui.item.label); // display the selected text
                            $('#app_user_id').val(ui.item.value); // save selected id to input
                            return false;
                            }
                        });

                        });
                        </script>
                    </div>

</x-app-layout>