<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise.index') }}"> जाहिरात करा </a></li>
                        <li class="breadcrumb-item active">मेल पाठवा</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <div class="container-fluid">
        <div class="select2-drpdwn">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('send-mail.send') }}" method="post">
                        @csrf
                        <iframe src="{{ asset('storage/'.$advertise->generate_pdf_url) }}" width="100%" height="400px" frameborder="0"></iframe>

                        @php $newsPaperEmail = ""; @endphp
                        @foreach($newsPapers as $newsPaper)
                        @php
                            $emails = explode(',', $newsPaper->email);
                            foreach($emails as $email){
                                $newsPaperEmail .= $email. ",  ";
                                @endphp
                                <input type="hidden" name="email[]" value="{{ $email }}">
                                @php
                            }
                        @endphp


                        @endforeach
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">वर्तमानपत्र ईमेल</label>
                            <input class="form-control" type="text" placeholder="वर्तमानपत्र ईमेल" value="{{ $newsPaperEmail }}" readonly>
                            <input type="hidden" name="id" value="{{ Request()->id }}">
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">ईमेल विषय</label>
                            <input class="form-control" type="text" name="subject" placeholder="ईमेल विषय" required>
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">ईमेल वर्णन</label>
                            <textarea name="description" class="form-control" placeholder="ईमेल वर्णन" cols="20" rows="10"></textarea>
                        </div>
                        <button class="btn btn-primary mb-3 mt-1" onclick="return confirm('Are you sure do you want to send email')" type="submit">मेल पाठवा</button>
                        <button class="btn btn-dark" id="cancelBtn" type="button">रद्द करा</button>

                    </form>
                    <form id="cancelMail" action="{{ route('mail.cancel') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="id" value="{{ Request()->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $('body').on('click', '#cancelBtn', function(event){
            var result = confirm("Are you sure you want to cancel this advertise");
            if (result) {
                event.preventDefault();
                document.getElementById('cancelMail').submit();
            }
        })
    </script>
    @endpush
</x-layout>
