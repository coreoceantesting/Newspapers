<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise.index') }}"> Advertise </a></li>
                        <li class="breadcrumb-item active">Verify Advertise</li>
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
                            <label class="form-label" for="work_order_number">News paper Email</label>
                            <input class="form-control" type="text" placeholder="Work Order Number" value="{{ $newsPaperEmail }}" readonly>
                            <input type="hidden" name="id" value="{{ Request()->id }}">
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">Email Subject</label>
                            <input class="form-control" type="text" name="subject" placeholder="Enter email subject" required>
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">Email Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" cols="20" rows="10"></textarea>
                        </div>
                        <button class="btn btn-primary mb-3 mt-1" onclick="return confirm('Are you sure do you want to send email')" type="submit">Send Email</button>
                        <a href="{{ route('advertise.create') }}"><button class="btn btn-dark" type="button">Cancel</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
