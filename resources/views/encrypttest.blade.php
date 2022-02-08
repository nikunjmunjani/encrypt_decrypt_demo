<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Encrypt Test</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">

            <div class=" row mt-5">
                <div class="col-md-8">
                    <form method="post" id="encryptFrm">
                        @csrf
                        <br><br>
                        <label >Enter encrypt string: </label>
                        <br>
                        <input type="text" name="encrypt_txt" class="form-control" id="encrypt_txt">
                        <br>
                        <input type="buttton" name="submitBtn" class="btn btn-success mt-2" id="submitBtn" value="Decrypt">
                        <br>
                        <br>
                        <div id="output"></div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on("click","#submitBtn",function(){
            $.ajax({
                url: "{{ route('decrypt') }}",
                type:"POST",
                dataType: 'JSON',
                data: $("#encryptFrm").serialize(),
                success:function(response){
                    
                    var html = '';
                    if(response.status){
                        html += "<b>Decrypted String: </b> "+ response.decrypted_str;
                        html += "<br><b>Encrypted String: </b> "+ response.encrypted_str;
                    }
                    $("#output").html(html);
                },
                error:function(response){
                    
                }
            });  
        });
    </script>
</html>
