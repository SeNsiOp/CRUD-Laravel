<!-- resources/views/contacts/create.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Add Contact</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('Styles/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"
        integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css"
        integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="resources/css/app.css">
</head>

<body class="bg-gray-100">

    <article class="p-40 main-body">
        <section class="addsection flex justify-center items-center">
            <form class="form flex items-center justify-center">
                <div class="card card-success flex justify-center align-items-center" style="width: 500px;">
                    <div class="card-header ">
                        <h1 class="card-title text-lg bold">ADD CONTACTS</h1>
                    </div>
                    @csrf
                    <div class="card-body w-100 rounded">
                        <input class="form-control" type="text" name="name" placeholder="Name" pattern="[A-Za-z]"
                            autofocus required>
                        {{-- <br> --}}
                        <p id="error-msg1" class="msg-p text-danger"></p>
                        <br>
                        <input class="form-control" type="email" name="email" placeholder="Email"
                            pattern="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]" required>
                        {{-- <br> --}}
                        <p id="error-msg2" class="msg-p text-danger"></p>
                        <br>
                        <input class="form-control" type="tel" name="phone" placeholder="Phone" min=10
                            maxlength=10 required pattern="[0-9]{10}">
                        {{-- <br> --}}
                        <p id="error-msg3" class="msg-p text-danger"></p>


                    </div>
                    <button type="button" class="p-2 rounded" id="addbtn"
                        style="background-color: #A6D6E1; color:mediumseagreen">Add
                        Contact</button>


                </div>
            </form>
        </section>
        {{-- <div id="error-msg" class="msg flex justify-center align-bottom">
        </div> --}}
    </article>

    <script>
        $(document).ready(function() {
            $("#addbtn").on("mouseover", function(e) {
                $(this).css("background-color", "mediumseagreen");
                $(this).css("color", "#A6D6E8");
            })
            $("#addbtn").on("mouseout", function(e) {
                $(this).css("background-color", "#A6D6E8");
                $(this).css("color", "mediumseagreen");
            })


            $("#addbtn").on("click", function(e) {
                e.preventDefault();
                $('#error-msg1').empty();
                $('#error-msg2').empty();
                $('#error-msg3').empty();
                var name = $("[name='name']").val();
                var email = $("[name='email']").val();
                var phone = $("[name='phone']").val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('contacts.store') }}",
                    data: {
                        name: name,
                        email: email,
                        phone: phone,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        window.location.href = '/';
                        alert('Contact Added Successfully');
                    },
                    error: function(errors) {
                        let html = '';
                        // $.each(errors.responseJSON.errors, function(key, value) {
                        //     html += "<h6>" + value +
                        //         "</h6>";
                        // })

                        // for (let key in errors.responseJSON.errors) {
                        //     html += `${errors.responseJSON.errors[key]}`;

                        // }


                        $('#error-msg1').html(errors.responseJSON.errors.name);
                        $('#error-msg2').html(errors.responseJSON.errors.email);
                        $('#error-msg3').html(errors.responseJSON.errors.phone);
                    }
                })
            })
        })
    </script>
</body>

</html>
