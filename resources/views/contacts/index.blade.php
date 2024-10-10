<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contacts List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('Styles/style.css') }}">
</head>

<body class="body mb-2" style="background: linear-gradient(45deg, #282b2e, #5d5070);">
    <section class="card-header navbar-expand-lg bg-gray-200">
        <div class="container">
            <nav class="navbar">
                <div class="img-div"></div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse px-8" id="navbarNavAltMarkup">
                    <div class="navbar-nav d-flex justify-content-between align-items-center gap-3 ">
                        <a href="{{ route('contacts.index') }}"
                            class="nav-btn nav-link m-0.5x px-4 rounded text-blue">Home</a>
                        <a href="{{ route('contacts.create') }}" class="nav-btn nav-link m-0.5 rounded text-blue">Add
                            Contact</a>
                    </div>
                </div>
        </div>
        </nav>
        </div>
    </section>
    <article class="serach-card ">
        <div class="card-body rounded">
            <div class="form-container flex items-center justify-center mt-5">
                <form action="{{ route('contacts.index') }}" method="GET" class="mb-5">
                    <input type="text" name="nameS" placeholder="Search by name" value="{{ request('nameS') }}"
                        class="inp-field p-2 border rounded w-1/8 px-3 mx-10">

                    <input type="text" name="emailS" placeholder="Search by email" value="{{ request('emailS') }}"
                        class="inp-field p-2 border rounded w-1/8 px-3 mx-10">

                    <input type="text" name="phoneS" placeholder="Search by phone" value="{{ request('phoneS') }}"
                        class="inp-field p-2 border rounded w-1/8 px-3 mx-10">
                    <button type="submit" class="search-btn p-2 rounded px-5 mx-16 bg-green-500 text-white"
                        id="btn">Search</button>
                </form>
            </div>
        </div>
    </article>
    </div>
    <div class="container mx-auto">

        @if ($message = Session::get('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ $message }}</div>
        @endif

        @if ($contacts->isEmpty())
            <p class="text-red-500">No contacts found.</p>
        @else
            <section class="table-cards">
                <table class="table-auto w-full bg-white rounded shadow pt-0 mt-0 my-0">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="p-4 border-b-2">Name</th>
                            <th class="p-4 border-b-2">Email</th>
                            <th class="p-4 border-b-2">Phone</th>
                            <th class="p-4 border-b-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach ($contacts as $contact)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="p-4">{{ $contact->name }}</td>
                                <td class="p-4">{{ $contact->email }}</td>
                                <td class="p-4">{{ $contact->phone }}</td>
                                <td class="p-4">
                                    <a href="javascript:void(0);"
                                        class="edit-box inline-block p-2 bg-yellow-500 text-white rounded mr-2 text-decoration-none"
                                        id="edt" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        data-id="{{ $contact->id }}">Edit</a>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h1 class="card-title text-lg bold">EDIT CONTACT</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="modal-class-form form-data"
                                                        action="{{ route('contacts.update', ':id') }}" method="POST">
                                                        <div>
                                                            @csrf
                                                            @method('POST')
                                                            <div
                                                                class="card-body flex items-center justify-center flex-wrap space-y-3 rounded">
                                                                <input class="form-control" type="text"
                                                                    name="name" value="{{ $contact->name }}"
                                                                    placeholder="Name" pattern="[A-Za-z]" autofocus
                                                                    required>
                                                                <br>
                                                                <input class="form-control" type="email"
                                                                    name="email" value="{{ $contact->email }}"
                                                                    placeholder="Email"
                                                                    pattern="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]"
                                                                    required>
                                                                <br>
                                                                <input class="form-control" type="tel"
                                                                    name="phone" value="{{ $contact->phone }}"
                                                                    placeholder="Phone" min=10 maxlength=10 required
                                                                    pattern="[0-9]{10}">
                                                            </div>

                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="edtbtn">Save
                                                        changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="dtl-btn p-2 bg-red-500 text-white rounded"
                                            id="dlt">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
    </div>
    <div class="paginate">
        {{ $contacts->links() }}
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/pages/dashboard3.min.js"
        integrity="sha512-l8RWdqTMUrIWPpdL2yB14+n+2WBPFe/KhH65aa3YAi+fRVvRMKxMVgmdk0/EUXLRKLFJmUH4rBABfxBsribrJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        $(document).ready(function() {

            $(".edit-box").on("click", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('contacts.modal') }}",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);
                        var name = $("[name='name']").val(data.contact.name);
                        var email = $("[name='email']").val(data.contact.email);
                        var phone = $("[name='phone']").val(data.contact.phone);
                        var updateUrl = "{{ route('contacts.update', ':id') }}".replace(':id',
                            data.contact.id);
                        $(".modal-class-form").attr("action", updateUrl);
                    }
                })
            })

            $(".form-data").on("submit", function(e) {
                e.preventDefault();
                var name = $("[name='name']").val();
                var email = $("[name='email']").val();
                var phone = $("[name='phone']").val();
                $.ajax({
                    type: $(this).attr("method"),
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
<script></script>

</html>
