<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise.index') }}">List Advertise (जाहिरात यादी) </a></li>
                        <li class="breadcrumb-item active">Send Mail (मेल पाठवा)</li>
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
                            <label class="form-label" for="work_order_number">Email (वर्तमानपत्र ईमेल) <span class="error">*</span></label>
                            <input class="form-control" type="text" placeholder="वर्तमानपत्र ईमेल" value="{{ $newsPaperEmail }}" readonly>
                            <input type="hidden" name="id" value="{{ Request()->id }}">
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">Subject (ईमेल विषय) <span class="error">*</span></label>
                            <input class="form-control" type="text" name="subject" placeholder="ईमेल विषय" required>
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label" for="work_order_number">Description (ईमेल वर्णन) <span class="error">*</span></label>
                            <textarea name="description" class="form-control" placeholder="ईमेल वर्णन" cols="20" rows="10"></textarea>
                        </div>
                        <button class="btn btn-primary mb-3 mt-1" onclick="return confirm('After Send the mail you can\'t edit the advertise')" type="submit">Send mail (मेल पाठवा)</button>
                        <a href="{{ route('advertise.index') }}" class="btn btn-dark">Cancel (रद्द करा)</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
