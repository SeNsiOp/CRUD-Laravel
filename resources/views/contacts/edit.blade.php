{{-- <!-- resources/views/contacts/edit.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Edit Contact</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('Styles/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css"
        integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100">

    <article class="p-48 main-body ">
        <section class="addsection flex justify-center items-center">
            <form class="form-data form flex items-center justify-center"
                action="{{ route('contacts.update', $contact->id) }}" method="POST">
                <div class="card card-success w-50">
                    @method('put')
                    @csrf
                    <div class="card-header ">
                        <h1 class="card-title text-lg bold">EDIT CONTACT</h1>
                    </div>

                    <div class="card-body flex items-center justify-center flex-wrap space-y-3 rounded">
                        <input class="form-control" type="text" name="name" value="{{ $contact->name }}"
                            placeholder="Name" required>
                        <br>
                        <input class="form-control" type="email" name="email" value="{{ $contact->email }}"
                            placeholder="Email" required>
                        <br>
                        <input class="form-control" type="text" name="phone" value="{{ $contact->phone }}"
                            placeholder="Phone" maxlength=10 required>
                        <button type="submit" class="p-2  rounded" id="edtbtn"
                            style="background-color: #A6D6E1; color:mediumseagreen">Update
                            Contact</button>

                    </div>

                </div>
            </form>
        </section>
    </article>

    <script>
        $(document).ready(function() {
            $("#edtbtn").on("mouseover", function(e) {
                $(this).css("background-color", "mediumseagreen");
                $(this).css("color", "#A6D6E8");
            })
            $("#edtbtn").on("mouseout", function(e) {
                $(this).css("background-color", "#A6D6E8");
                $(this).css("color", "mediumseagreen");
            })
            $(".form-data").on("submit", function(e) {
                e.preventDefault();
                var name = $("[name='name']").val();
                var email = $("[name='email']").val();
                var phone = $("[name='phone']").val();
                $.ajax({
                    type: $(this).attr("method"),
                    @method('put'),
                    url: $(this).attr("action"),
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
                        alert('Contact Updated Successfully');
                    },

                })
            })
        })
    </script>
</body>

</html> --}}
