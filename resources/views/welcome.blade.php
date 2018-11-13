<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                font-weight: 100;
            }

            .container {
                /*text-align: center;
                display: table-cell;
                vertical-align: middle;*/
            }

            /*.content {
                text-align: center;
                display: inline-block;
            }*/

            .title {
                font-size: 96px;
            }
        </style>
        <script type="text/javascript">
            jQuery(function($) {
                
                $('#todoName').on('keyup',function(e){
                    if($(this).val()!='' && $(this).val().length>0 ){
                        $('#add').removeAttr('disabled');
                    }else{
                        $('#add').attr('disabled','disabled');
                    }
                });
                $('#add').on('click', function(e) {
                    e.preventDefault();
                    var todoName    = $('#todoName').val();
                    var url     = "{{route('list_todo_post')}}",
                        data    = {todoName:todoName, _token : '{{csrf_token()}}'};
                    $.post(url, data, function(data) {
                        loadData();
                        $('#todoName').val('');
                    }, 'json');

                    return false;
                });

                $(document).on('click', '.delete', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    deleteData(id);
                    //loadData();
                    return false;
                });

                // $(document).on('click', '.cb_data', function(e){
                //     //e.preventDefault();
                //     var id_data = $(this).attr('id_data');
                //     var id = $(this).attr('id');
                //     //alert(id);
                //     if($('.cb_data').prop("checked")){
                //         $('#name_'+id_data+'').css('text-decoration', 'line-through');    
                //     }else{
                //         $('#name_'+id_data+'').css('text-decoration', 'none');
                //     }
                    
                // })

                $(document).on('click', '#delete', function(e) {
                    e.preventDefault();
                    var checked = $('.cb_data:checked').size();
                    if (checked < 1) {
                        //alert('Pilih data yang akan dihapus.');
                        return false;
                    } 
                    var id_in = $('.cb_data:checked').map(function(){
                        return $(this).val()
                    }).get().join(',')
                    //alert(id_in);
                    var url     = "{{route('list_todo_delete')}}",
                        data    = {id_in:id_in, _token:'{{csrf_token()}}'};
                    $.post(url, data, function(data) {
                        if(data==1){
                            loadData();    
                        }
                    }, 'json');
                    return false;
                });

                loadData();

            });
            function loadData()
            {
                jQuery('#t_data').load("{{route('list_todo')}}");
                return false;
            }
            function deleteData(id)
            {
                var url     = "{{route('list_todo_delete')}}",
                    data    = {id:id, _token : '{{csrf_token()}}'};
                jQuery.post(url, data, function(result) {
                    if(result==1){
                        loadData();    
                    }
                    
                }, 'json');
                return false;
            }
            function lineText(count){
                if(jQuery('#cb_data_'+count+'').prop('checked')){
                    jQuery('#name_'+count+'').css('text-decoration', 'line-through');
                }else{
                    jQuery('#name_'+count+'').css('text-decoration', 'none')
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
          <h2>Todo List</h2>
          <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <input type="text" size="40" class="form-control" id="todoName" name="todoName">
                                <button type="submit" class="btn btn-success" id="add" name="add" disabled="disabled">Add Todo</button>
                            </div>          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span>Typing</span> <span id="typingTodoName"></span>          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">  
                        </div>
                        <div class="col-md-11">
                            <div id=t_data>
                            </div>  
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger" id="delete" name="delete">Delete Selected</button>           
                        </div>
                    </div>

                  <!--div class="form-group"> 
                    <input type="email" class="form-control" id="email">
                    <label for="email">Email address:</label>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button-->
                </form>
            </div>
          </div>
        </div>
    </body>
</html>
